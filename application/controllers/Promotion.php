<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends Public_Controller {

    public function __construct()
    {
		parent::__construct();
		
		$this->load->library('pagination');
		
		$this->load->model('golongan_model');
		$this->load->model('golongan2_model');
		$this->load->model('golongan3_model');
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
        
		$this->data['title']  = 'Promotion';
		
		$action  = $this->input->get('action');
		
		if ($action) {

			if ($action == 'add') {
			
				$kdbar = $this->input->get('code'); // kode barang => cart

				if ($kdbar != '') {
					
					// $detail = $this->stock_model->get_by_id($kdbar);
					$this->db->select('kdbar, kdurl, nama, deskripsi, hjual, format(hjual,0,"id") as hjualf, gambar, pnj, lbr, tgi, berat');
					$this->db->where('kdurl', $kdbar);
					
					$detail = $this->db->get('stock')->row();
						
					$qty = 1; //$this->input->post('qty');
					
					$itemArray = array( $kdbar => array( 'kdbar' => $detail->kdbar, 'kdurl' => $detail->kdurl,
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
								
								// $item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
								// $total_price += $item_price;
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
			
		
		if ($this->input->get('p')) {
			$page   = $this->input->get('p');
			$offset = ((int)$page-1)*8;
		} else {
			$page   = 1;
			$offset = 0;
		}
		
		$total = $this->stock_model->total_promotions();
		$url   = current_url() . '?p=';
		
		$this->data['products']    = $this->stock_model->get_promotion(8, $offset);
		$this->data['price_range'] = $this->stock_model->get_price_range2();
		
		$this->data['pagination'] = $this->paging($total, $page, $url);

		$this->load->view('layout/header', $this->data);
		$this->load->view('promotion/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
	
	
	public function paging($total,$curr_page,$url){
    
		$page = '';
		$total_page = ceil($total/8);
		
		if($total > 8) { // hasil bagi atau jumlah halaman lebih dari satu
		
			$page = '<ul class="pagination no-print">';
			
			if ($total_page > 9 && $curr_page > 2)
		   		$page .='<li><a href="'.$url.'1"><<</a></li>';
			if ($curr_page > 1)
				$page .='<li><a href="'.$url.($curr_page-1).'"><</a></li>';
		   
			if ($total_page < 10) {
				for($x = 1;$x <= $total_page;$x++) {
					
					$active = '';
					
					if($x == $curr_page)
						$active = 'class="active"';
					
					$page .='<li '.$active.'><a href="'.$url.$x.'">'.$x.'</a></li>';
					
				}
			}
			else
			{
				if ($curr_page > 3) {
					for($x = $curr_page-2;$x <= $curr_page-1; $x++) {
						$page .='<li><a href="'.$url.$x.'">'.$x.'</a></li>';
					}
				}
				else
				{
					for($x = 1;$x <= 2;$x++) {
						$active = '';
					
						if($x == $curr_page)
							$active = ' class="active"';
						
						$page .='<li'.$active.'><a href="'.$url.$x.'">'.$x.'</a></li>';
					}
				}

				if ($curr_page >= 3 && $total_page - $curr_page > 3)
					// $page .='<li><a href="#">'.($curr_page).' / '.$total_page.'</a></li>';
					$page .='<li class="active"><a href="#">'.($curr_page).'</a></li>';

				if ($total_page - $curr_page > 3) {
					
					if ($curr_page == 1) {
						for($x = $curr_page+2;$x <= $curr_page+3; $x++) {
							$page .='<li><a href="'.$url.$x.'">'.$x.'</a></li>';
						}
					}
					else
					{
						for($x = $curr_page+1;$x <= $curr_page+2; $x++) {
							$page .='<li><a href="'.$url.$x.'">'.$x.'</a></li>';
						}
					}
				}
			}
			if ($curr_page < $total_page)
				$page .='<li><a href="'.$url.($curr_page+1).'">></a></li>';
			if ($total_page > 9)
				$page .='<li><a href="'.$url.$total_page.'">>></a></li>';
				
			$page .='</ul>';
		}
			
		return $page;
	}
}
