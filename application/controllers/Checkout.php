<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->lang->load('checkout');

		$this->load->model('golongan_model');
		$this->load->model('provinsi_model');
		$this->load->model('kabupaten_model');
		$this->load->model('kecamatan_model');
		
		$this->load->model('carrier_model');

		$this->load->library('rajaongkir');

		// clear variable (?)
		$this->session->unset_userdata('address_id');
		$this->session->unset_userdata('order_id');
		
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		}
		
		$this->data['carrier']  = $this->carrier_model->get_all_active();
		$this->data['provinsi'] = $this->provinsi_model->get_all();
		$this->data['province'] = '';

		$this->session->set_userdata('carrier', 'JNE');
		// $this->session->unset_userdata('carrier');
		$this->session->unset_userdata('paket');
		
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('login', 'refresh');
		}
		else
		{
			// siapkan data member
			$member = $this->ion_auth->user()->row();
			$this->data['anggota']    = $member;
			$this->data['first_name'] = $member->first_name;
			$this->data['last_name']  = $member->last_name;
				
			if ($this->ion_auth->logged_in() && !isset($_SESSION['guest'])) {
				
				$address_data = array(
					'first_name' => $member->first_name,
					'last_name'  => $member->last_name,
					'company'    => $member->company,
					'address'    => $member->address,
					'province'   => $member->province,
					'regency'    => $member->regency,
					'district'   => $member->district,
					'post_code'  => $member->post_code,
					'phone'      => $member->phone,
					'email'      => $member->email,
				);
				
				// simpan data alamat pengiriman ke variabel session
				$this->session->set_userdata($address_data);
	
				// note: data provinsi dan kota kemungkinan kosong
				$provid = (int)$member->province;
				if ($provid == 0) $provid = 1;
				$this->data['kabupaten'] = $this->kabupaten_model->get_by_province_id($provid);
				
				$kbpid = (int)$member->regency;
				if ($kbpid == 0) $kbpid = 114;
				$result = json_decode($this->rajaongkir->subdistrict($kbpid));
				$this->data['kecamatan'] = $result->rajaongkir->results;
		
				
				if ($member->regency > 0)
				{
					$origin      = 114; //denpasar
					$destination = $member->regency;
					
					$result      = json_decode($this->rajaongkir->cost($origin, $destination, 1000, 'jne'));
					$this->data['paket'] = $result->rajaongkir->results[0]->costs;
					
					$this->session->set_flashdata('carrier', 'jne');
					$this->session->set_flashdata('paket', $result->rajaongkir->results[0]->costs[0]->service);
				}
			}
		}
            
		
		$action  = $this->input->get('action');

		if ($action) {
			
			if ($action == 'remove')
			{
			
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
				
				if ($total_price > 0)
				{
					$url = strtok(current_url(), '?');
					header("location: ".$url);
				}
				else
				{
					// redirect('/', 'refresh');
					if ($_SESSION['context'] == 1)
					{
						redirect('equipment', 'refresh');
					}
					else
					{
						redirect('utensil', 'refresh');
					}
				}
			}
		}
			

		if (!empty($_POST)) {
	
			/* Validate form input */
			$this->form_validation->set_rules('first_name', 'lang:checkout_first_name', 'required');
			$this->form_validation->set_rules('last_name', 'lang:checkout_last_name', 'required');
			
			$this->form_validation->set_rules('address', 'lang:checkout_address', 'required');

			$this->form_validation->set_rules('province', 'lang:checkout_province', 'required');
			$this->form_validation->set_rules('regency', 'lang:checkout_regency', 'required');
			$this->form_validation->set_rules('district', 'lang:checkout_district', 'required');
			
			$this->form_validation->set_rules('post_code', 'lang:checkout_post_code', 'required');

			$this->form_validation->set_rules('phone', 'lang:checkout_phone', 'required');
			$this->form_validation->set_rules('email', 'lang:checkout_email', 'required|valid_email');
			
			// item delivery
			$this->form_validation->set_rules('carrier', 'lang:checkout_carrier', 'required');
			$this->form_validation->set_rules('package', 'lang:checkout_package_type', 'required');


			// shipping address data
			$first_name = $this->input->post('first_name');
			$last_name  = $this->input->post('last_name');
			$company    = $this->input->post('company');
			$address    = $this->input->post('address');

			$province   = $this->input->post('province');
			$regency    = $this->input->post('regency');
			$district   = $this->input->post('district');
			$post_code  = $this->input->post('post_code');
			$phone      = $this->input->post('phone');
			$email      = strtolower($this->input->post('email'));
			$note       = $this->input->post('note');
			
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
				'note'       => $note,
			);
			
			// simpan data alamat pengiriman ke variabel session
			$this->session->set_userdata($address_data);
	
			// $this->data['kabupaten'] = $this->kabupaten_model->get_by_province_id($_SESSION["province"]);
			
			// if ($this->form_validation->run())
			// {
			// 	// $this->session->set_userdata('gtotal', $gtotal); // get tot_price
			// }
			// else // validasi input gagal
			if (!$this->form_validation->run())
			{
				$this->data['message'] = (validation_errors() ? validation_errors() : 'Input data belum benar!');
			}
		}

		$this->load->view('layout/header', $this->data);
		$this->load->view('checkout/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	public function regencies()
	{
		$provid = $this->uri->segment(3);
		// $provid = $this->input->post("id");
		$data = $this->kabupaten_model->search($provid);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'data' => $data
		)));
	}

	public function post_code()
	{
		$kbpid = $this->uri->segment(3);
		$data = $this->kabupaten_model->post_code($kbpid);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'data' => $data
		)));
	}

	public function districts()
	{
		$kbpid  = $this->uri->segment(3);
		$result = json_decode($this->rajaongkir->subdistrict($kbpid));
		$data   = $result->rajaongkir->results;
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'data' => $data
		)));
	}

	public function ongkir()
	{
		$origin      = 114; //denpasar
		$kurir       = $this->uri->segment(3);
		$destination = $this->uri->segment(4);
		
		$result      = json_decode($this->rajaongkir->cost($origin, $destination, 1000, $kurir));
		$data        = $result->rajaongkir->results[0]->costs;
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'data' => $data
		)));
	}

	public function hitung_ongkir()
	{
		$context = $this->session->userdata('context');
		$cost    = (float)$this->uri->segment(3);

		$item_cost  = 0;
		$total_cost = 0;
		
		$item_weight  = 0;
		$total_weight = 0;

		foreach ($_SESSION['cart_item'] as $item) {

			$item_weight = (float)$item['qty']*$item['berat'];
			$total_weight += $item_weight;
		}

				
		if ($context == 1)
		{
			$whole = floor($total_weight);
		}
		else
		{
			$whole = floor($total_weight / 1000);
		}
		
		$fraction = $total_weight - $whole;
		// jika ada kelebihan berat, tambahkan ongkos
		if ($fraction > 0)
			$total_weight = $whole + 1;

		$total_cost = $total_weight * $cost;
	
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'data' => array(
				'cost' => $cost,
				'weight' => $total_weight,
				'shipcost' => $total_cost
			)
		)));
	}
}