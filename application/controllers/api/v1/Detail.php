<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Detail extends REST_Controller
{

    public function __construct()
    {
		parent::__construct();

		$this->load->helper('captcha');
		$this->load->helper('authorization');
		$this->config->load('jwt');		
		$this->load->library('form_validation');

		$this->load->model('golongan_model');
		$this->load->model('stock_model');
		$this->load->model('reviews_model');
		$this->load->model('shopping_cart_model');
		
		require_once(APPPATH.'third_party/recaptcha-master/src/autoload.php');
		
		// $this->output->enable_profiler(TRUE);
	}

	
	public function index_get()
	{

		// if ($this->ion_auth->logged_in())
		// {
		// 	$member = $this->ion_auth->user()->row();
		// 	$this->data['first_name'] = $member->first_name;
		// 	$this->data['last_name']  = $member->last_name;
		// }
		
		// $this->data['golongan'] = $this->golongan_model->get_all();

		// foreach ($this->data['golongan'] as $item) {
		// 	$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		// }
		
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
		
		$kode = urldecode($this->uri->segment(4));

		$product = $this->stock_model->get_by_kodeurl($kode);


		// set warehouse
		$wh = ($context == 1) ? urlencode("Bali HO - AS"): urlencode("WH ASOVIC Pusat - ASV");

		if ($product->master == 'Y') // check if master product
		{
			$product = $this->stock_model->get_sample($kode);

			$url_rate  = 'https://apgroup.id/api/resource/Item?fields=["standard_rate"]&filters=[["Item","item_code","=","'.urlencode($product->kdbar).'"]]';
			$url_stock = 'https://apgroup.id/api/resource/Bin?fields=["actual_qty"]&filters=[["Bin","item_code","=","'.urlencode($product->kdbar).'"],["Bin","warehouse","=","'.$wh.'"]]';

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
			$stok = $result->data[0]->actual_qty;
		}
		else
		{
			$stok = 0;
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
			$hjualf = number_format($result->data[0]->standard_rate, 0, '.', ',');
			$hjual  = $result->data[0]->standard_rate;
		}
		else
		{
			$hjualf = 0;
			$hjual  = 0;
		}

		if ($hjual > 0)
		{
			// update harga jual
			$item_data = array(
				'hjual' => $hjual
			);

			$this->stock_model->update($product->kdbar, $item_data);
		}

		$varian = NULL;
		// get varian
		if ($product->parent) // cek kode parent
		{
			$varian = $this->stock_model->get_varian($product->parent);
		}
		
		if ($product->size)
			$this->session->set_userdata('varian', $product->size);

		if ($product->kdgol3)
		{
			$related = $this->stock_model->get_related($product->kdgol3, $kode);
		}
		else
		{
			$related = $this->stock_model->get_related($product->kdgol2, $kode);
		}
		$promotion = $this->stock_model->get_promotion();

		
		$item_rating = $this->reviews_model->get_rating($kode)->rating;
		
		$totrevs = $this->reviews_model->total_rows($kode);
		
		$showbutton = false;
		// if (!$action) // tampilkan tombol 'get all reviews'
		// {
			if ($totrevs > 3) $showbutton = true;
			$reviews = $this->reviews_model->get_limit_data(3,0,$kode);
		// }
		// else
		// {
		// 	// if ($action == 'getall') unset($this->data['showbutton']);
		// 	$reviews = $this->reviews_model->get_all($kode);
		// }

		$this->set_response([
			'status' => TRUE,
			'data'   => array(
				'product'     => $product,
				'stock'       => $stok,
				'hjual'       => $hjual,
				'hjualf'      => $hjualf,
				'varian'      => $varian,
				'item_rating' => $item_rating,
				'tot_reviews' => $totrevs,
				'reviews'     => $reviews,
			),
		], REST_Controller::HTTP_OK);
	}
}
