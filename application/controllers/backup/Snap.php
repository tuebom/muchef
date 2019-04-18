<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends CI_Controller {

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
		$params = array('server_key' => 'VT-server-d-KO3kU-77lXF3IY1iWhfw7p', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	
    }

    // public function index()
    // {
    // 	$this->load->view('checkout_snap');
    // }

    public function token()
    {

			//*** siapkan data untuk laporan order di backend ***
			
			// mulai transaksi
			$this->db->trans_start();
			
			$address_data = array(
				'first_name' => $_SESSION["first_name"],
				'last_name'  => $_SESSION["last_name"],
				'company'    => $_SESSION["company"],
				'address'    => $_SESSION["address"],
				'province'   => $_SESSION["province"],
				'regency'    => $_SESSION["regency"],
				'district'   => $_SESSION["district"],
				'post_code'  => $_SESSION["post_code"],
				'phone'      => $_SESSION["phone"],
				'email'      => $_SESSION["email"],
			);
		
			$this->db->insert('address', $address_data);
			$addrid = $this->db->insert_id();

			$mbrid      = $this->input->post('mbrid');
			$total      = $this->input->post('total');
			$shipcost   = $this->input->post('shipcost');
			$tax        = $this->input->post('tax');
			$gtotal     = $this->input->post('gtotal');
			
			$note       = $_SESSION["note"];
			$delivery   = $this->input->post('delivery');
			
			// $payment    = $this->input->post('payment');

			$tglinput   = date('Y-m-d');

			$orders_data = array(
				'tglinput' => $tglinput,
				'mbrid'    => $mbrid,
				'addrid'   => $addrid,
				'total'    => $total,
				'tax'      => $tax,
				'shipcost' => $shipcost,
				'gtotal'   => $gtotal,
				// 'payment'  => $payment,
				'note'     => $note,
				'delivery' => $delivery,
			);
			$this->db->insert('orders', $orders_data);
			// save order number
			$orderid = $this->db->insert_id();
	
			$urut = 1;

			// simpan detail
			foreach ($_SESSION["cart_item"] as $item) {						
			
				$item_price  = (float)$item["qty"]*$item["harga"];
				
				$detail_data = array(
					'id'       => $orderid,
					'tglinput' => $tglinput,
					'urut'     => $urut,
					'kdbar'    => $item["kdbar"],
					'qty'      => $item["qty"],
					'hjual'    => $item["harga"],
					'jumlah'   => $item_price
				);
				$this->db->insert('orders_detail', $detail_data);
				$urut++;
			}
			
			$this->db->trans_complete(); // commit
		
			
			//*** siapkan data untuk trx midtrans ***
			$transaction_details = array(
				'order_id'     => $orderid, //Math.round((new Date()).getTime() / 1000),
				'gross_amount' => $gtotal   //$_SESSION["total"], // no decimal allowed for creditcard
			);

			// Note: pembayaran dengan ongkos kirim tidak menyertakan item karena akan menghasilkan jumlah yang berbeda
			
			// prepare item detail
			// $item_details = array();

			// foreach ($_SESSION["cart_item"] as $item)
			// {
			// 	$item_data = array(
			// 		'id'       => $item["kdbar"],
			// 		'price'    => $item["harga"],
			// 		'quantity' => $item["qty"],
			// 		'name'     => $item["nama"]
			// 	);

			// 	// add item
			// 	array_push( $item_details, $item_data );
			// }

			// Optional
			$billing_address = array(
				'first_name'    => $_SESSION["first_name"],
				'last_name'     => $_SESSION["last_name"],
				'address'       => $_SESSION["address"],
				'city'          => $_SESSION["regency"],
				'postal_code'   => $_SESSION["post_code"],
				'phone'         => $_SESSION["phone"],
				'country_code'  => 'IDN' // Indonesia
			);

			// Optional
			$shipping_address = array(
				'first_name'    => $_SESSION["first_name"],
				'last_name'     => $_SESSION["last_name"],
				'address'       => $_SESSION["address"],
				'city'          => $_SESSION["regency"],
				'postal_code'   => $_SESSION["post_code"],
				'phone'         => $_SESSION["phone"],
				'country_code'  => 'IDN' // Indonesia
			);

			// Optional
			$customer_details = array(
				'first_name'       => $_SESSION["first_name"],
				'last_name'        => $_SESSION["last_name"],
				'email'            => $_SESSION["email"],
				'phone'            => $_SESSION["phone"],
				'billing_address'  => $billing_address,
				'shipping_address' => $shipping_address
			);

			// remove session variabel
			
			// $array_items = array('company', 'address', // 'first_name', 'last_name', 
			// 	'province', 'regency', 'district', 'post_code', 'phone', 'email', 'note');
			// $this->session->unset_userdata($array_items);
        
			// if(!empty($_SESSION["cart_item"])) {
	
			// 	foreach($_SESSION["cart_item"] as $k => $v) {
			// 			unset($_SESSION['cart_item'][$k]);
			// 	}
			// }
			// $this->session->set_userdata('totqty', 0);
			// $this->session->set_userdata('tot_price', 0);

			
			// Data yang akan dikirim untuk request redirect_url.
			$credit_card['secure'] = true;
			//ser save_card true to enable oneclick or 2click
			//$credit_card['save_card'] = true;

			$time = time();
			$custom_expiry = array(
					'start_time' => date("Y-m-d H:i:s O",$time),
					'unit'       => 'minute', 
					'duration'   => 2
			);
			
			$transaction_data = array(
					'transaction_details'=> $transaction_details,
					// 'item_details'       => $item_details,
					'customer_details'   => $customer_details,
					'credit_card'        => $credit_card,
					'expiry'             => $custom_expiry
			);

			error_log(json_encode($transaction_data));
			$snapToken = $this->midtrans->getSnapToken($transaction_data);
			error_log($snapToken);
			echo $snapToken;
    }

    public function finish()
    {
    	$result = json_decode($this->input->post('result_data'));
    	echo 'RESULT <br><pre>';
    	var_dump($result);
    	echo '</pre>' ;
    }
}
