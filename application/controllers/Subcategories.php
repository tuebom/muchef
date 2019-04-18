<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategories extends Public_Controller {

    public function __construct()
    {
		parent::__construct();

		$this->load->model('golongan_model');
		$this->load->model('golongan2_model');
		$this->load->model('golongan3_model');
		$this->load->model('stock_model');
		$this->load->model('brands_model');
		
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$context = $this->session->userdata('context');
		
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
        
		$kode = $this->uri->segment(3);
		// die($kode);
		
		// if (strlen($kode) == 2) {
			$this->data['title']  = $this->golongan2_model->get_by_id($kode)->nama;
			$this->data['kdgol']  = substr($kode,0,2);
			$this->data['kdgol2'] = $kode;
		// } else {
		// 	$this->data['title'] = $this->golongan2_model->get_by_subid($kode)->nama;
		// 	$this->data['kdgol'] = substr($kode,0,2);
		// }
		
		$this->data['brands']   = $this->brands_model->get_by_id($kode); //get_all();

		$this->data['item_'.$kode] = $this->golongan2_model->get_sub_category($kode);
		$this->data['kode'] = $kode;
		
		$action  = $this->input->get('action');
		
		if ($action) {
		
				if ($action == 'remove') {

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
												
						foreach($_SESSION["cart_item"] as $k => $v) {
								$item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
								$total_price += $item_price;
						}
						$this->session->set_userdata('tot_price', $total_price);
						
						$url = strtok(current_url(), '?');
						header("location: ".$url);
				}
		}

		$this->load->view('layout/header', $this->data);
		$this->load->view('subcategories/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
