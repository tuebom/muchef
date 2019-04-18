<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->lang->load('account');
		
		$this->load->model('golongan_model');
		$this->load->model('stock_model');

		$this->load->model('admin/orders_model');
		
		$this->load->model('provinsi_model');
		$this->load->model('kabupaten_model');
		// $this->load->model('kecamatan_model');

		$this->load->library('rajaongkir');
		
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
			// siapkan data member

			$member = $this->ion_auth->user()->row();
			$this->data['anggota']    = $member;
			$this->data['first_name'] = $member->first_name;
			$this->data['last_name']  = $member->last_name;
		}
		
		$page = $this->input->get('p');

		if ($page) {

			$this->load->view('layout/header', $this->data);
			$this->load->view('akun/sidemenu', $this->data);

			// $this->data['detil']  = $this->orders_model->get_item_bb($member->id);
			if ($page === 'pending') {
				$this->data['detil']  = $this->orders_model->get_item_pending($member->id);
				$this->load->view('akun/belanja-bb', $this->data);
			}
			elseif ($page === 'process') {
				$this->data['detil']  = $this->orders_model->get_item_processed($member->id);
				$this->load->view('akun/belanja-bk', $this->data);
			}
			elseif ($page === 'deliver') {
				$this->data['detil']  = $this->orders_model->get_item_shipped($member->id);
				$this->load->view('akun/belanja-bt', $this->data);
			}
			elseif ($page === 'finish') {
				$this->data['detil']  = $this->orders_model->get_item_delivered($member->id);
				$this->load->view('akun/belanja-bs', $this->data);
			}
			else { // histori
				$this->data['detil']  = $this->orders_model->get_history($member->id);
				$this->load->view('akun/histori', $this->data);
			}
			$this->load->view('layout/footer', $this->data);

			return;
		}
		else // halaman profil
		{
			$this->data['provinsi']  = $this->provinsi_model->get_all();
			$this->data['kabupaten'] = $this->kabupaten_model->get_by_province_id($member->province);
			// $this->data['kecamatan'] = $this->kecamatan_model->get_by_regency_id($member->regency);
			$result = json_decode($this->rajaongkir->subdistrict($member->regency));
			$this->data['kecamatan'] = $result->rajaongkir->results;
		}

		
		$submit = $this->input->post('submit1');

		if ($submit) {

			// $this->form_validation->set_rules('email', 'Email', 'required');
			
			// if ($this->form_validation->run() == TRUE)
			// {
			// 	// send email
			// }
			// else
			// {
			// 	$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			// }

			$id = $this->input->post('mbrid');

			$user_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'company'    => $this->input->post('company'),
				'address'    => $this->input->post('address'),
				'province'   => $this->input->post('province'),
				'regency'    => $this->input->post('regency'),
				'district'   => $this->input->post('district'),
				'post_code'  => $this->input->post('post_code'),
				'phone'      => $this->input->post('phone'),
				'email'      => $this->input->post('email'),
			);
		
			$this->db->where('id =', $id);
			$this->db->update('users', $user_data);

			// $this->session->set_userdata($user_data);
			$this->data['anggota'] = $this->ion_auth->user()->row();
		}

		$this->load->view('layout/header', $this->data);
		$this->load->view('akun/sidemenu', $this->data);
		$this->load->view('akun/profil', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
	
	public function upload_file() {
		
		$config = array(
            'upload_path' => './upload/avatar/',
            'allowed_types' => 'png', //'gif|jpg|png',
            'file_name' => 'user'.$_SESSION['mbrid'], //date_default_timezone_set('Asia/Taipei'), //dmYHis
            'file_ext_tolower' => TRUE,
            'overwrite' => TRUE,
            'max_size' => 512,
            'max_width' => 640,
            'max_height' => 640,           
            'min_width' => 32,
            'min_height' => 32,     
            'max_filename' => 0,
            'remove_spaces' => TRUE
        );

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
			$hasil = $this->upload->display_errors();
			$this->session->set_flashdata('message', '<label class="label label-danger msg">Upload file gagal!</label>'.
				'<table class="table table-hover table-bordered">'.
				'<tr><td><strong>'.$hasil.'</strong></td></tr>'.
				'</table>');
        }
		redirect('akun', 'refresh');
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
		$data  = $this->kabupaten_model->post_code($kbpid);
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
}
