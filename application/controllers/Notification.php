<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();

		$this->load->model('admin/orders_model');

		$params = array('server_key' => 'VT-server-d-KO3kU-77lXF3IY1iWhfw7p', 'production' => false); // sandbox
		// $params = array('server_key' => 'VT-server-eiVTUqAKGHhXROiX6GL3JDd0', 'production' => false); // production
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		
		$this->load->helper('url');
	}

	public function index()
	{
		
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result);

		if($result){
			$notif = $this->midtrans->status($result->order_id);
		}

		// error_log(print_r($result,TRUE));

		//notification handler sample
		
		$transaction = $notif->transaction_status;
		$type        = $notif->payment_type;
		$order_id    = $notif->order_id;
		$fraud       = $notif->fraud_status;

		$save_trx = FALSE;

		if ($transaction == 'capture'){
			
			// For credit card transaction, we need to check whether transaction is challenge by FDS or not
		  if ($type == 'credit_card'){
				
				if($fraud == 'challenge'){
		      // TODO set payment status in merchant's database to 'Challenge by FDS'
		      // TODO merchant should decide whether this transaction is authorized or not in MAP
		      echo "Transaction order_id: " . $order_id ." is challenged by FDS";
				}
				else
				{
		      // TODO set payment status in merchant's database to 'Success'
					// echo "Transaction order_id: " . $order_id ." successfully captured using " . $type;
					// if ($save_trx)
					$save_trx = TRUE;
				}
			}
		}
		else if ($transaction == 'settlement'){
		  // TODO set payment status in merchant's database to 'Settlement'
		  // echo "Transaction order_id: " . $order_id ." successfully transfered using " . $type;
			$save_trx = TRUE;
		} 
		// else if($transaction == 'pending'){
		//   // TODO set payment status in merchant's database to 'Pending'
		//   echo "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
		// } 
		// else if ($transaction == 'deny'){
		//   // TODO set payment status in merchant's database to 'Denied'
		//   echo "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
		// }

		if (save_trx) {
			
			$order_data = array (
				'payment' => $type,
				'status'  => 'PAID',
			);
			
			$this->orders_model->update($order_id, $order_data);
			$order_detail = $this->orders_model->get_order_detail($order_id);
			$total_amount = 0;

			// set item details
			$item_details = array();
			foreach ($order_detail as $item)
			{
				$item_data = array(
					'item_code' => $item->kdbar,
					'qty'       => $item->qty,
					'rate'      => $item->hjual,
				);

				$total_amount += $item->jumlah;

				// add item
				array_push( $item_details, $item_data );
			}

			// set payment details
			$payment_details = array();

			$payment_data = array(
				'mode_of_payment' => 'BCA ASOVIC 9993',
				'account'         => 'BCA ASOVIC 9993 - ASV',
				'amount'          => $total_amount,
				'base_amount'     => $total_amount,
			);

			// add item
			array_push( $item_details, $item_data );

			// Get cURL resource
			// $ch = curl_init('https://apgroup.id/api/resource/Sales Invoice');

			// curl_setopt($ch,CURLOPT_POST, true);
			// curl_setopt($ch,CURLOPT_POSTFIELDS, array(
			// 	'customer' => 'administrator',
			// 	'submit_on_creation' => 1,
			// 	'is_pos' => 1,
			// 	'update_stock' => 1,
			// 	'items' => $item_details,
			// 	'is_paid' => 1,
			// 	'doc_status' => 1,
			// 	'payments' => $payment_details
			// ));

			// curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
			// // common description bellow
			// curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
			// curl_setopt($ch,CURLOPT_COOKIEJAR, 'cookie.txt');
			// curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');
			// curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			// curl_setopt($ch,CURLOPT_TIMEOUT, 5);

			// // Send the request & save response to $resp
			// $resp = curl_exec($ch);
			// $error_no = curl_errno($ch);
			// // Close request to clear up some resources
			// curl_close($ch);
			
			// if ($error_no!=200){
			// 	// do something for post error
			// }

		}

	}
}
