<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->lang->load('admin/shipping');
	
        $this->load->model('admin/preferences_model');
        $this->load->model('golongan_model');
		$this->load->model('provinsi_model');
		$this->load->model('kabupaten_model');
		$this->load->model('kecamatan_model');
        
        $this->load->library('rajaongkir');

        // $this->output->enable_profiler(TRUE);

        $this->data['pagetitle'] = '<h1>Shipping</h1>';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Shipping', 'admin/shipping');
	}

	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();
		
            $this->data['provinsi'] = $this->provinsi_model->get_all();
            $this->data['province'] = '';
            
            
            $action  = $this->input->get('action');

            if ($action) {

                if ($action == 'submit') {
                            
                    if (!empty($_POST)) {

                
                        /* Validate form input */
                        $this->form_validation->set_rules('province', 'lang:checkout_province', 'required');
                        $this->form_validation->set_rules('regency', 'lang:checkout_regency', 'required');
                        $this->form_validation->set_rules('district', 'lang:checkout_district', 'required');

                        // shipping address data
                        $province   = $this->input->post('province');
                        $regency    = $this->input->post('regency');
                        $district   = $this->input->post('district');
                        
                        $address_data = array(
                            'province'   => $province,
                            'regency'    => $regency,
                            'district'   => $district,
                        );
                        
                        // simpan data alamat pengiriman ke variabel session
                        $this->session->set_flashdata($address_data);

                        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                
                        if ($this->form_validation->run() == TRUE)
                        {
            
                            redirect('/', 'refresh');
                            return;
                            
                        }
                    }

                }
                
            }
            else
            {
                if (isset($_SESSION["province"])) {
                    $this->data['kabupaten'] = $this->kabupaten_model->get_by_province_id($_SESSION["province"]);
                    $this->data['kecamatan'] = $this->kecamatan_model->get_by_regency_id($_SESSION["regency"]);
                }
            }

            /* Load Template */
            $this->template->admin_render('admin/shipping/index', $this->data);
        }
	}

	public function regencies()
	{
		$provid = $this->uri->segment(4);
		// $provid = $this->input->post("id");
		$data = $this->kabupaten_model->search($provid);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'data' => $data
		)));
	}

	public function districts()
	{
		$kbpid = $this->uri->segment(4);
		$data = $this->kecamatan_model->search($kbpid);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'data' => $data
		)));
	}
}
