<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends Public_Controller {

    public function __construct()
    {
		parent::__construct();

		$this->load->helper('captcha');

		$this->load->model('golongan_model');
		$this->load->model('stock_model');
		require_once(APPPATH.'third_party/recaptcha-master/src/autoload.php');

		// $this->output->enable_profiler(TRUE);
	}

	
	public function index()
	{

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

		// // $this->data['cap'] = $cap;
		// // $this->data['image'] = $cap['image'];
		// // $this->data['file_path'] = BASEPATH . "../captcha/"; //. $this->session->userdata['image'];

		// if (isset($this->session->userdata['image'])) {
		// 	// if (file_exists(BASEPATH . "../captcha/" . $this->session->userdata['image']))
		// 	// unlink(BASEPATH . "../captcha/" . $this->session->userdata['image']);

		// 	if (file_exists($file . $this->session->userdata['image']))
		// 		unlink($file . $this->session->userdata['image']);
		// }

		// $this->session->set_userdata(array('captcha' => $captcha, 'image' => $cap['time'] . '.jpg'));
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
		
		$this->load->view('layout/header', $this->data);
		$this->load->view('contact-us/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
