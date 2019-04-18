<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Member extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->config->load('jwt');		
		$this->load->library('form_validation');
    }

    public function index_get()
    {
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
        $headers = $this->input->post();

        // if (Authorization::tokenIsExist($headers)) {
            // $token = Authorization::validateToken($headers['Authorization']);
            // if ($token != false) {
                $mbrid = number_format($this->uri->segment(2)); //$token->mbrid;

                $data = $this->db->get_where('users', array('id' => $mbrid))->row();
                $this->set_response($data, REST_Controller::HTTP_OK);
                // return;
            // }
        // }
        // $response = [
            // 'status' => REST_Controller::HTTP_FORBIDDEN,
            // 'message' => 'Forbidden',
        // ];
        // $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }

    public function index_post()
    {
        header('Access-Control-Allow-Origin: *');
    
        $first_name = $this->input->post('first_name');
        $last_name  = $this->input->post('last_name');
        $email      = $this->input->post('email');
        $password   = $this->input->post('password');
        $gcmid      = $this->input->post('gcmid');
                
        $user = $this->db->get_where('users', array('email' => $email));

        if(count($user->result())>0)
        {
            $this->set_response(['status' => FALSE, 'message' => 'Alamat email sudah terdaftar. Silahkan gunakan alamat email yang lain.'], REST_Controller::HTTP_OK);
            return;
        }
        
        $data = $this->db->query("CALL proc_daftar_mbr ( $reffid, '$nama', '$nohp', '$gcmid' );")->row();
        $response = [
            'status' => TRUE,
            'mbrid' => $data->mbrid,
            'message' => $data->message
        ];
        $this->set_response($response, REST_Controller::HTTP_OK);
    }
    
    public function wishlist_post()
    {
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
        $headers = $this->input->post();

        if (Authorization::tokenIsExist($headers)) {
            
            $token = Authorization::validateToken($headers['Authorization']);
            
            if ($token != false) {
                
                $mbrid = $token->mbrid;
                // $pwd   = $token->pwd;

                $kdbar = $this->input->post('kdbar');
                
                // check if data exists
                $data = $this->db->get_where('wishlist', array('userid' => $mbrid, 'kdbar' => $kdbar));
                if(count($data->result())>0)
                {
                    $this->set_response(['status' => FALSE, 'message' => 'Item sudah terdaftar dalam daftar wishlist anda.'], REST_Controller::HTTP_OK);
                    return;
                }
        
                $sql = "insert into wishlist (userid, kdbar, tglinput) values ( $mbrid, '".$this->db->escape($kdbar)."', CURRENT_TIMESTAMP() );";
                $this->db->query($sql);
                $this->set_response(['status' => $status, 'message' => ''], REST_Controller::HTTP_OK);
                return;
            }
        }
        $response = [
            'status'  => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }
    
    public function gantipwd_post()
    {
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
        $headers = $this->input->post();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            
            if ($token != false) {
                
                $mbrid   = $token->mbrid;

                $pwdlama = $this->input->post('pwdlama');
                $pwdbaru = $this->input->post('pwdbaru');

                $data    = $this->db->query("CALL ganti_password ( $mbrid, '$pwdlama', '$pwdbaru' );")->row();
                $status  = ($data->status === 'success');
                $message = $data->message;

                if ($status) {

                    $data = array(
                        'mbrid' => $token->mbrid,
                        'nama'  => $token->nama,
                        'pwd'   => $pwdbaru,
                        'role'  => 'user',
                    );

                    $this->set_response([
                        'status'  => $status,
                        'message' => $message,
                        'token'   => Authorization::generateToken($data)
                    ], REST_Controller::HTTP_OK);
                    return;
                    
                } else {
                    $this->set_response(['status' => FALSE, 'message' => $data->message], REST_Controller::HTTP_OK);
                    return;
                }
            }
        }
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }
    
    public function histori_post()
    {
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
        $headers = $this->input->post();

        if (Authorization::tokenIsExist($headers)) {
            $token = Authorization::validateToken($headers['Authorization']);
            if ($token != false) {
                $mbrid = $token->mbrid;
                $tgltrx = $this->input->post('tgltrx');

                $data = $this->db->query("CALL get_histori($mbrid, '$tgltrx');")->result();
                // $response = [
                    // 'status' => TRUE,
                    // 'data' => $data
                // ];
                $this->set_response($data, REST_Controller::HTTP_OK);
                return;
            }
        }
        $response = [
            'status' => REST_Controller::HTTP_FORBIDDEN,
            'message' => 'Forbidden',
        ];
        $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
    }

    public function regcmid_post()
    {

        header('Access-Control-Allow-Origin: *');
        
        $nohp = $this->input->post('nohp');
        $gcmid = $this->input->post('gcmid');

        $this->db->query("UPDATE bintree SET gcmid = '$gcmid' WHERE nohp = '$nohp';");
        $this->set_response(['status' => TRUE], REST_Controller::HTTP_OK);
    }
}
