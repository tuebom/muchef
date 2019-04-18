<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Snap extends Public_Controller {

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
		// $params = array('server_key' => 'VT-server-eiVTUqAKGHhXROiX6GL3JDd0', 'production' => true);
		$params = array('server_key' => 'VT-server-d-KO3kU-77lXF3IY1iWhfw7p', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');	

		$this->load->model('brands_model');
		$this->load->model('golongan_model');
		$this->load->model('shopping_cart_model');
	}

	public function token()
	{

		//*** siapkan data untuk laporan order di backend ***

		// mulai transaksi
		$this->db->trans_start();
		
		$first_name = $this->input->post('first_name');
		$last_name  = $this->input->post('last_name');
		$company    = $this->input->post('company');
		$address    = $this->input->post('address');
		$province   = $this->input->post('province');
		$regency    = $this->input->post('regency');
		$district   = $this->input->post('district');
		$post_code  = $this->input->post('post_code');
		$phone      = $this->input->post('phone');
		$email      = $this->input->post('email');
	
		$address_data = array(
			'first_name' => $first_name,
			'last_name'  => $last_name,
			'company'    => $company,
			'address'    => $address,
			'province'   => $province,
			'regency'    => $regency,
			'district'   => $district,
			'post_code'  => $post_code,
			'phone'      => $phone,
			'email'      => $email,
		);
	
		if (!isset($_SESSION["address_id"]))
		{
			$this->db->insert('address', $address_data);
			$addrid = $this->db->insert_id();
			$this->session->set_userdata('address_id', $addrid);
		}
		else
		{
			$this->db->where('id', $_SESSION["address_id"]);
			$this->db->update('address', $address_data);
			$addrid = $_SESSION["address_id"];
		}

		$mbrid      = $this->input->post('mbrid');
		$total      = $this->input->post('total');
		$shipcost   = $this->input->post('shipcost');
		$tax        = $this->input->post('tax');
		$gtotal     = $this->input->post('gtotal');
		
		$note       = $this->input->post('note');
		
		$delivery   = $this->input->post('carrier');
		$package    = $this->input->post('svcname');

		$tglinput   = date('Y-m-d');

		$orders_data = array(
			'tglinput' => $tglinput,
			'mbrid'    => $mbrid,
			'addrid'   => $addrid,
			'total'    => $total,
			'tax'      => $tax,
			'shipcost' => $shipcost,
			'gtotal'   => $gtotal,
			'note'     => $note,
			'delivery' => $delivery,
			'package'  => $package,
		);


		if (!isset($_SESSION["order_id"]))
		{
			// log_message('Debug', '***$_SESSION["order_id"] is not defined.');
			$bEdit = FALSE;
			$this->db->insert('orders', $orders_data);
			// save order number
			$orderid = $this->db->insert_id();
			$this->session->set_userdata('order_id', $orderid);
		}
		else
		{
			// log_message('Debug', '***$_SESSION["order_id"] is defined.');
			// log_message('Debug', '***$_SESSION["order_id"] is '.$_SESSION["order_id"]);
			$bEdit = TRUE;
			$this->db->where('id', $_SESSION["order_id"]);
			$this->db->update('orders', $orders_data);
			$orderid = $_SESSION["order_id"];
		}


		// hapus detil item order yang lama
		if ($bEdit) {
			$this->db->where('id', $_SESSION["order_id"]);
			$this->db->delete('orders_detail');
		}

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
			'gross_amount' => $gtotal,  // no decimal allowed for creditcard
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

		$billing_address = array(
			'first_name'    => $first_name,
			'last_name'     => $last_name,
			'address'       => $address,
			'city'          => $regency,
			'postal_code'   => $post_code,
			'phone'         => $phone,
			'country_code'  => 'IDN' // Indonesia
		);

		$shipping_address = array(
			'first_name'    => $first_name,
			'last_name'     => $last_name,
			'address'       => $address,
			'city'          => $regency,
			'postal_code'   => $post_code,
			'phone'         => $phone,
			'country_code'  => 'IDN' // Indonesia
		);

		$customer_details = array(
			'first_name'       => $first_name,
			'last_name'        => $last_name,
			'email'            => $email,
			'phone'            => $phone,
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		);
		
		// "enabled_payments": ["bca_va"],
		// "bca_va": {
		//   "va_number": "12345678911",
		//   "sub_company_code": "00000",
		//   "free_text": {
		// 	"inquiry": [
		// 	  {
		// 		"en": "text in English",
		// 		"id": "text in Bahasa Indonesia"
		// 	  }
		// 	],
		// 	"payment": [
		// 	  {
		// 		"en": "text in English",
		// 		"id": "text in Bahasa Indonesia"
		// 	  }
		// 	]
		//   }
		// }

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
		
		// delete shopping cart data
		if (isset($_SESSION["shp_cart_id"])) {
			$this->shopping_cart_model->delete($_SESSION["shp_cart_id"]);
			$this->shopping_cart_model->delete_detail($_SESSION["shp_cart_id"]);
		}
		
		// remove session variabel
		$array_items = array('company', 'address', 'order_id', // 'first_name', 'last_name', 
			'province', 'regency', 'district', 'post_code', 'phone', 'email', 'note', 'shp_cart_id');
		$this->session->unset_userdata($array_items);
			
		if(!empty($_SESSION["cart_item"])) {

			foreach($_SESSION["cart_item"] as $k => $v) {
					unset($_SESSION['cart_item'][$k]);
			}
		}
		$this->session->set_userdata('totqty', 0);
		$this->session->set_userdata('tot_price', 0);
		
		$this->data['brands']   = $this->brands_model->get_all();
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		}

		if ($this->ion_auth->logged_in())
		{
			$member = $this->ion_auth->user()->row();
			$this->data['first_name'] = $member->first_name;
			$this->data['last_name']  = $member->last_name;
		}

		$result = json_decode($this->input->post('result_data'));
		// echo 'RESULT <br><pre>';
		// var_dump($result);
		// echo '</pre>' ;

		// number_format($result->data[0]->standard_rate, 0, '.', ','), //$detail->hjualf,
		$this->data['status_message'] = $result->status_message;
		$this->data['order_id']       = $result->order_id;

		// $numbers = explode('.', $result->gross_amount)
		$this->data['gross_amount'] = number_format($result->gross_amount, 0, '.', ',');

		switch ($result->payment_type) {
			
			case 'credit_card':
				$this->data['payment_type'] = 'Credit Card';
				break;
			case 'bank_transfer':
				$this->data['payment_type'] = 'Bank Transfer';
				$this->data['bank']         = $result->va_numbers[0]->bank;
				$this->data['va_number']    = $result->va_numbers[0]->va_number;
				break;
			case 'bca_klikpay':
				$this->data['payment_type'] = 'BCA KlikPay';
				$this->data['bank']         = 'BCA';
				break;
			case 'bca_klikbca':
				$this->data['payment_type'] = 'KlikBCA';
				$this->data['bank']         = 'BCA';
				break;
			case 'bri_epay':
				$this->data['payment_type'] = 'e-Pay BRI';
				$this->data['bank']         = 'BRI';
				break;
			case 'mandiri_clickpay':
				$this->data['payment_type'] = 'Mandiri Clickpay';
				$this->data['bank']         = 'Mandiri';
				break;
			case 'cimb_clicks':
				$this->data['payment_type'] = 'CIMB Clicks';
				$this->data['bank']         = 'CIMB';
				break;
			case 'telkomsel_cash':
				$this->data['payment_type'] = 'Telkomsel Cash';
				break;
			case 'echannel':
				$this->data['payment_type'] = 'E-Channel';
				break;
			case 'indosat_dompetku':
				$this->data['payment_type'] = 'Indosat Dompetku';
				break;
			case 'mandiri_ecash':
				$this->data['payment_type'] = 'Mandiri E-Cash';
				$this->data['bank']         = 'Mandiri';
				break;
			case 'cstore':
				$this->data['payment_type'] = 'Convenience Store';
				break;
		}

		$this->load->view('layout/header', $this->data);
		$this->load->view('snap-finish/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}