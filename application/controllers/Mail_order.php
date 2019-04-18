<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail_order extends Public_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('captcha');

		$this->load->model('golongan_model');
		$this->load->model('stock_model');

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


		$this->load->view('layout/header', $this->data);
		$this->load->view('mail-order/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
