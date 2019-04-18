<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Category extends REST_Controller
{

    public function __construct()
    {
		parent::__construct();

		// $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
		// $this->load->library('ion_auth');
		$this->load->helper('authorization');
		$this->config->load('jwt');		

		$this->load->model('golongan_model');
		$this->load->model('stock_model');
		$this->load->model('brands_model');
		// $this->output->enable_profiler(TRUE);
	}

	public function index_post()
	{
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
		$headers = $this->input->post();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            if ($token != false) {
        
				$data = $this->golongan_model->get_all();

				$this->set_response([
					'status' => TRUE,
					'data'   => $data,
				], REST_Controller::HTTP_OK);
				return;
			}
		}
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
	}

	public function index_get()
	{
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
		$headers = $this->input->post();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            if ($token != false) {
        
				// $this->data['brands']   = $this->brands_model->get_all();
				$data = $this->golongan_model->get_all();

				$this->set_response([
					'status' => TRUE,
					'data'   => $data,
				], REST_Controller::HTTP_OK);
				return;
			}
		}
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
	}

	public function sample_get()
	{
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();

        // if (Authorization::tokenIsExist($headers)) {
        //     $token = Authorization::validateToken($headers['Authorization']);
        //     if ($token != false) {
        
				// $context = 2; //$this->session->userdata('context');
                $kode = $this->uri->segment(5);

				$data = $this->golongan_model->get_sample($kode);

				$this->set_response([
					'status' => TRUE,
					'data'   => $data,
				], REST_Controller::HTTP_OK);
				// return;
			// }
		// }
        // $response = [
        //     'status' => REST_Controller::HTTP_FORBIDDEN,
        //     'message' => 'Forbidden',
        // ];
        // $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
	}
}
