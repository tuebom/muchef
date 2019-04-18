<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detail extends Public_Controller {

    public function __construct()
    {
		parent::__construct();

		$this->load->helper('captcha');

		$this->load->model('golongan_model');
		$this->load->model('stock_model');
		$this->load->model('reviews_model');
		$this->load->model('shopping_cart_model');
		
		require_once(APPPATH.'third_party/recaptcha-master/src/autoload.php');
		
		// $this->output->enable_profiler(TRUE);
	}

	
	public function index()
	{

		if ($this->ion_auth->logged_in())
		{
			$member = $this->ion_auth->user()->row();
			$this->data['first_name'] = $member->first_name;
			$this->data['last_name']  = $member->last_name;
		}
		
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		}
		
		$recaptchaSecret = '6LeVG44UAAAAACHx9hSaJB861f6bjQhQMB-KodyD';
		
		if (!empty($_POST)) {

			// validate the ReCaptcha, if something is wrong, we throw an Exception,
			// i.e. code stops executing and goes to catch() block
			
			if (!isset($_POST['g-recaptcha-response'])) {
				throw new \Exception('ReCaptcha is not set.');
			}
			$recaptcha = new \ReCaptcha\ReCaptcha($recaptchaSecret, new \ReCaptcha\RequestMethod\CurlPost());
		
			// we validate the ReCaptcha field together with the user's IP address
		
			$response = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

			if (!$response->isSuccess()) {
				throw new \Exception('ReCaptcha was not validated.');
			}
		}
		
		$kode = urldecode($this->uri->segment(2));
		
		$this->data['product'] = $this->stock_model->get_by_kodeurl($kode);


		// set warehouse
		$wh = ($context == 1) ? urlencode("Bali HO - AS"): urlencode("WH ASOVIC Pusat - ASV");

		if ($this->data['product']->master == 'Y') // check if master product
		{
			// get sample item
			// if ($this->data['product']->kdgol3)
			// {
				$this->data['product'] = $this->stock_model->get_sample($kode); //$this->data['product']->kdgol3, 
			// }
			// else
			// {
			// 	$this->data['product'] = $this->stock_model->get_sample($this->data['product']->kdgol2, $kode);
			// }

			// $url = 'https://apgroup.id/api/resource/Item?limit_start=1'; //&limit_page_length=1';
			// $url = 'https://apgroup.id/api/resource/Bin?fields=[%22item_code%22,%22actual_qty%22]&limit_start=1&limit_page_length=20'; //%22,%22Bali%20HO%20-%20AS%22

			$url_rate  = 'https://apgroup.id/api/resource/Item?fields=["standard_rate"]&filters=[["Item","item_code","=","'.urlencode($this->data['product']->kdbar).'"]]';
			$url_stock = 'https://apgroup.id/api/resource/Bin?fields=["actual_qty"]&filters=[["Bin","item_code","=","'.urlencode($this->data['product']->kdbar).'"],["Bin","warehouse","=","'.$wh.'"]]';

			// log_message('Debug', '***Item code: '.$this->data['product']->kdbar);
    }
		else
		{
			$url_rate  = 'https://apgroup.id/api/resource/Item?fields=["standard_rate"]&filters=[["Item","item_code","=","'.urlencode($kode).'"]]';
			$url_stock = 'https://apgroup.id/api/resource/Bin?fields=["actual_qty"]&filters=[["Bin","item_code","=","'.urlencode($kode).'"],["Bin","warehouse","=","'.$wh.'"]]';
			
			// log_message('Debug', '***Item code: '.$kode);
		}
		
		// get stock balance
		$ch = curl_init($url_stock);
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');

		curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch,CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch,CURLOPT_TIMEOUT, 5);

		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response);
		
		// die(print_r($result->data));		
		// log_message('Debug', '***URL: '.urlencode($url));
		// log_message('Debug', '***item_code: '.$this->data['product']->kdbar);
		// log_message('Debug', '***warehouse: '.$wh);
		// log_message('Debug', '***API result: '.$result->data[0]->actual_qty);
		

		if (sizeof($result->data) > 0)
		{
			$this->data['stok'] = $result->data[0]->actual_qty;
		}
		else
		{
			$this->data['stok'] = 0;
		}
		
		// get price
		$ch = curl_init($url_rate);
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
    // CURLOPT_POST => 1,

		curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch,CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_TIMEOUT, 5);

		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response); //data harga jual

		if (sizeof($result->data) > 0)
		{
			$this->data['hjual'] = number_format($result->data[0]->standard_rate, 0, '.', ',');
			$hjual = $result->data[0]->standard_rate;
		}
		else
		{
			$this->data['hjual'] = 0;
			$hjual = 0;
		}

		if ($hjual > 0)
		{
			// update harga jual
			$item_data = array(
				'hjual' => $hjual
			);

			$this->stock_model->update($this->data['product']->kdbar, $item_data);
		}

		// get varian
		if ($this->data['product']->parent)
		{
			$this->data['varian']  = $this->stock_model->get_varian($this->data['product']->parent);
		}
		
		if ($this->data['product']->size)
			$this->session->set_userdata('varian', $this->data['product']->size);

		if ($this->data['product']->kdgol3)
		{
			$this->data['related'] = $this->stock_model->get_related($this->data['product']->kdgol3, $kode);
		}
		else
		{
			$this->data['related'] = $this->stock_model->get_related($this->data['product']->kdgol2, $kode);
		}
		$this->data['promotion'] = $this->stock_model->get_promotion();

		$action  = $this->input->get('action');
		
		if ($action) {

			if ($action == 'add'):
				
				$kdbar = $this->input->get('code'); // kode barang => cart
				$qty   = $this->input->get('qty');  // qty barang  => cart
				
				
				if (!$this->ion_auth->logged_in())
				{
					$this->session->set_flashdata('last_url', current_url());
					redirect('login', 'refresh');
				}
					

				if ($kdbar != '') {
					
					// $detail = $this->stock_model->get_by_id($kdbar);
					$this->db->select('kdbar, kdurl, nama, hjual, format(hjual,0,"id") as hjualf, gambar, pnj, lbr, tgi, berat');
					$this->db->where('kdurl', $kdbar);
					
					$detail = $this->db->get('stock')->row();
						
					if (!$qty) $qty = 1; //$this->input->post('qty');
							
					$itemArray = array( $kdbar => array(
														'kdbar'   => $detail->kdbar,
														'kdurl'   => $detail->kdurl,
														'nama'    => $detail->nama,
														'qty'     => $qty,
														'harga'   => $result->data[0]->standard_rate, //$detail->hjual,
														'hargaf'  => number_format($result->data[0]->standard_rate, 0, '.', ','), //$detail->hjualf,
														'gambar'  => $detail->gambar,
														'pnj'     => $detail->pnj,
														'lbr'     => $detail->lbr,
														'tgi'     => $detail->tgi,
														'berat'   => $detail->berat
													));
		
					$bExists = FALSE;

					if(!empty($_SESSION["cart_item"])) {
		
						if(in_array($kdbar, array_keys($_SESSION["cart_item"]))) {
		
							$bExists = TRUE;
							foreach($_SESSION["cart_item"] as $k => $v) {
									
								if($kdbar == $k) {
										
									if(empty($_SESSION["cart_item"][$k]["qty"])) {
										$_SESSION["cart_item"][$k]["qty"] = 0;
									}
									$_SESSION["cart_item"][$k]["qty"] += $qty;
								}
							}

						} else {
							$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
						}
					} else {
						// data array kosong
						$_SESSION["cart_item"] = $itemArray;
					}

					$val = (int)$this->session->userdata('totqty') + $qty;
					$this->session->set_userdata('totqty', $val);
				}
			
				
				if (!isset($_SESSION['guest'])) {
					// save shopping cart data - only for member

					// get shopping cart id
					if (!isset($_SESSION["shp_cart_id"]))
					{
						$this->db->insert('shopping_cart', ['mbrid' => $this->ion_auth->user()->row()->id]);
						$shp_cart_id = $this->db->insert_id();
						$this->session->set_userdata('shp_cart_id', $shp_cart_id);
					}
					else
					{
						$shp_cart_id = $_SESSION["shp_cart_id"];
					}

					if (!$bExists)
					{
						$urut = $this->shopping_cart_model->get_total_item_by_id($shp_cart_id) + 1;

						// save detail
						$cart_data = array(
							'id'       => $shp_cart_id,
							'urut'     => $urut,
							'kdbar'    => $kdbar,
							'qty'      => $qty,
							'hjual'    => $result->data[0]->standard_rate,
						);
						$this->db->insert('shopping_cart_detail', $cart_data);
					}
					else
					{
						$this->db->query('update shopping_cart_detail set qty = qty + '.$qty.' where id = '.$shp_cart_id.' and kdbar = "'.$kdbar.'";');
					}
				}
				
				
				// inisiasi - hitung total
				$item_price  = 0;
				$total_price = 0;
							
				foreach($_SESSION["cart_item"] as $k => $v) {
					$item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
					$total_price += $item_price;
				}
				$this->session->set_userdata('tot_price', $total_price);

				
				$url = strtok(current_url(), '?');
				header("location: ".$url);
			
			elseif ($action == 'remove'):
			
				$kdbar = $this->input->get('code'); // kode barang => cart
		
				if ($kdbar != '') {
					
					if(!empty($_SESSION["cart_item"])) {
		
						if(in_array($kdbar, array_keys($_SESSION["cart_item"]))) {
		
							foreach($_SESSION["cart_item"] as $k => $v) {
									
								if($kdbar == $k) {
										
									$val = (int)$this->session->userdata('totqty') - $_SESSION["cart_item"][$k]["qty"];
									$this->session->set_userdata('totqty', $val);
									unset($_SESSION['cart_item'][$k]);
								}
							}
						}
		
					}
			
				}
		
				// inisiasi
				$item_price  = 0;
				$total_price = 0;
							
				// hitung total dan simpan di variabel session
				foreach($_SESSION["cart_item"] as $k => $v) {
					$item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
					$total_price += $item_price;
				}
				$this->session->set_userdata('tot_price', $total_price);
				
				$url = strtok(current_url(), '?');
				header("location: ".$url);
			
			else:

				$this->form_validation->set_rules('name', 'Name', 'required');
				$this->form_validation->set_rules('email', 'Email', 'required');
				$this->form_validation->set_rules('comment', 'Comment', 'required');

				if ($this->form_validation->run() == TRUE)
				{
					$data = array(
						"kdbar"    => $this->input->post('kdbar'),
						"name"     => $this->input->post('name'),
						"email"    => $this->input->post('email'),
						"comment"  => $this->input->post('comment'),
						"rating"   => $this->input->post('rating')
					);
					
					$captcha = $this->input->post('captcha');
					$url 	   = $this->input->post('url');

					if ($captcha == $this->session->userdata('captcha'))
					{

						if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
							$file = 'D:\xampp\htdocs\askitchen\images\captcha\\';
						} else {
							$file = './captcha/';
						}
						if (file_exists($file . $this->session->userdata['image']))
							unlink($file . $this->session->userdata['image']);
			
						$this->session->unset_userdata('captcha');
						$this->session->unset_userdata('image');

						$this->reviews_model->insert($data);
						header("location: ".$url);
					}
					else
					{

						// $this->session->set_flashdata('message', 'Kode yang Anda masukkan tidak cocok.');
						$this->data['name']    = $this->input->post('name');
						$this->data['email']   = $this->input->post('email');
						$this->data['comment'] = $this->input->post('comment');
						$this->data['rating']  = $this->input->post('rating');
						$this->data['message'] = 'Kode yang Anda masukkan tidak cocok.';
					}
				}
				else
				{
					$this->data['message'] = (validation_errors()) ? validation_errors() : '';
				}

			endif;
		}
		
		// // prepare captcha
		// $original_string = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

		// $original_string = implode("", $original_string);

		// $captcha = substr(str_shuffle($original_string), 0, 6);
		
		// if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		// 	$file = 'D:\xampp\htdocs\askitchen\images\captcha\\';
		// } else {
		// 	$file = './captcha/';
		// }

		// $vals = array(

		// 	'word' => $captcha,
		// 	'img_path' => $file, //'D:\xampp\htdocs\askitchen\images\captcha\\', //'./captcha'
		// 	'img_url' => base_url('images/captcha'),

		// 	'font_size' => 10,
		// 	'img_width' => 150,
		// 	'img_height' => 50,
		// 	'expiration' => 7200
		// );

		// // note: pastikan folder captcha sudah dibuat
		// $cap = create_captcha($vals);

		// if (isset($this->session->userdata['image'])) {

		// 	if (file_exists($file . $this->session->userdata['image']))
		// 		unlink($file . $this->session->userdata['image']);
		// }

		// $this->session->set_userdata(array('captcha' => $captcha, 'image' => $cap['time'] . '.jpg'));
		
		$this->data['item_rating'] = $this->reviews_model->get_rating($kode);
		
		$totrevs = $this->reviews_model->total_rows($kode);
		
		if (!$action) // tampilkan tombol 'get all reviews'
		{
			if ($totrevs > 3) $this->data['showbutton'] = true;
			$this->data['reviews'] = $this->reviews_model->get_limit_data(3,0,$kode);
		}
		else
		{
			if ($action == 'getall') unset($this->data['showbutton']);
			$this->data['reviews'] = $this->reviews_model->get_all($kode);
		}
		$this->data['totreviews'] = $totrevs;

		$this->load->view('layout/header', $this->data);
		$this->load->view('detail/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
