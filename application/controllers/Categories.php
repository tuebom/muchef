<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Public_Controller {

    public function __construct()
    {
		parent::__construct();

		$this->load->model('golongan_model');
		$this->load->model('stock_model');
		$this->load->model('brands_model');
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
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
        
        $kode = $this->uri->segment(2);
		
		if (strlen($kode) == 2) {
			$this->data['title'] = $this->golongan_model->get_by_id($kode)->nama;
			$this->data['kdgol'] = $kode;
		} else {
			$this->data['title'] = $this->golongan_model->get_by_subid($kode)->nama;
			$this->data['kdgol'] = substr($kode,0,2);
		}

		
		$this->data['kode'] = $kode;
		
		$this->load->view('layout/header', $this->data);
		$this->load->view('categories/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
