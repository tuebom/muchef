<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utensil extends Public_Controller {

    public function __construct()
    {
			parent::__construct();

			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
			$this->lang->load('auth');

			$this->load->model('golongan_model');
			$this->load->model('stock_model');
			$this->load->model('admin/banner_model');
			
			// unset($_SESSION["cart_item"]);
			// unset($_SESSION["totqty"]);
			// $this->output->enable_profiler(TRUE);
    }


	public function index()
	{
		$this->session->set_userdata('context', 2);
		$this->data['context']  = 2;
		$this->data['golongan'] = $this->golongan_model->get_all(2);

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		}
		
		$this->data['banner'] = $this->banner_model->get_all(2);

		if ($this->ion_auth->logged_in())
		{
			$member = $this->ion_auth->user()->row();
			$this->data['first_name'] = $member->first_name;
			$this->data['last_name']  = $member->last_name;
		}
		
		if(!isset($_SESSION["totqty"])) {
			$this->session->set_userdata('totqty', 0);
			$this->session->set_userdata('tot_price', 0);
			$this->session->set_userdata('cart_item', array());
		}

		$action  = $this->input->get('action');
		
		if ($action) {

			if ($action == 'add') {
			
				$kdbar = $this->input->get('code'); // kode barang => cart

				if ($kdbar != '') {
					
					// $detail = $this->stock_model->get_by_id($kdbar);
					$this->db->select('kdbar, kdurl, nama, hjual, format(hjual,0,"id") as hjualf, gambar, pnj, lbr, tgi, berat');
					$this->db->where('kdurl', $kdbar);
					
					$detail = $this->db->get('stock')->row();
						
					$qty = 1; //$this->input->post('qty');
					
					$itemArray = array( $kdbar => array('kdbar' => $detail->kdbar, 'kdurl' => $detail->kdurl,
														'nama'  => $detail->nama,
														'qty'   => $qty,
														'harga' => $detail->hjual,
														'hargaf'=> $detail->hjualf, // harga dgn pemisah ribuan
														'gambar'=> $detail->gambar,
														'pnj'   => $detail->pnj,
														'lbr'   => $detail->lbr,
														'tgi'   => $detail->tgi,
														'berat' => $detail->berat
													));
		
					if(!empty($_SESSION["cart_item"])) {
		
						if(in_array($kdbar, array_keys($_SESSION["cart_item"]))) {
		
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
			else
			{
			
				$kdbar = $this->input->get('code'); // kode barang => cart
		
				if ($kdbar != '') {
					
					// $qty = $this->input->post('qty');
					
		
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
				$item_price = 0;
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

		// $this->data['rnd_products'] = $this->stock_model->get_random_products();
		$this->data['rnd_products']  = $this->stock_model->get_new_products(4,0);
		$this->data['rnd_products2'] = $this->stock_model->get_new_products(4,1);
		$this->data['rnd_products3'] = $this->stock_model->get_new_products(4,5);

		$this->data['rnd_best']  = $this->stock_model->get_best_seller(4,0);
		$this->data['rnd_best2'] = $this->stock_model->get_best_seller(4,1);
		$this->data['rnd_best3'] = $this->stock_model->get_best_seller(4,5);

		$this->load->view('layout/header', $this->data);
		$this->load->view('dashboard/utensil/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}
