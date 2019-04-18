<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Auth extends REST_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->lang->load('auth');
		$this->config->load('jwt');		
		$this->load->library('form_validation');
		
		$this->load->add_package_path(APPPATH.'third_party/ion_auth/');
		$this->load->library('ion_auth');
		$this->load->helper('authorization');
	}


    function login_post()
	{
        // if ( ! $this->ion_auth->logged_in())
        // {
            /* Load */
            // $this->load->config('admin/dp_config');
            $this->load->config('common/dp_config');

            /* Valid form */
            $this->form_validation->set_rules('identity', 'Identity', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            /* Data */
            $this->data['auth_social_network'] = $this->config->item('auth_social_network');
            $this->data['forgot_password']     = $this->config->item('forgot_password');
			$this->data['new_membership']      = $this->config->item('new_membership');
			
			$email = filter_input(INPUT_POST, "identity", FILTER_VALIDATE_EMAIL);
			$pwd   = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

            if ($this->form_validation->run() == TRUE)
            {
                $remember = (bool) $this->input->post('remember');

                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
                {
					
					if ( ! $this->ion_auth->is_admin())
                    {
                        // $this->session->set_flashdata('message', $this->ion_auth->messages());
						// redirect('/', 'refresh');
						$role = 'user';
					}
                    else
                    {
                        /* Load Template */
                        // $this->template->auth_render('auth/choice', $this->data);
                        // redirect('admin', 'refresh');
						$role = 'admin';
                    }
					
					$data = array(
						'mbrid' => $this->ion_auth->user()->row()->id,
						'nama'  => $this->ion_auth->user()->row()->username,
						'role'  => $role,

						// 'pin' => $member->pin,
						// 'email' => $usermail,
						// 'logged_in' => true,
					);
					// $this->session->set_userdata($data);
						
					$this->set_response([
						'status' => TRUE,
						'mbrid'  => $this->ion_auth->user()->row()->id,
						'token'  => Authorization::generateToken($data)
					], REST_Controller::HTTP_OK);

				}
                else
                {
					// $this->session->set_flashdata('message', $this->ion_auth->errors());
				    // redirect('auth/login', 'refresh');

					$this->set_response([
						'status'  => FALSE,
						'message' => $this->ion_auth->errors()
					], REST_Controller::HTTP_OK);
                }
            }
            else
            {

				$this->set_response([
					'status'  => FALSE,
					'message' => validation_errors()
				], REST_Controller::HTTP_OK);
			}
    }


    function logout_get()
	{
        $logout = $this->ion_auth->logout();
		
		$this->set_response([
			'status'  => TRUE,
			'message' => $this->ion_auth->messages(),
		], REST_Controller::HTTP_OK);
	}

	// activate the user
	function activate($id, $code=false)
	{
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("/", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	// forgot password
	function forgot_password()
	{
		// setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			// setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// siapkan data golongan
			// $this->data['golongan'] = $this->golongan_model->get_all();

			// foreach ($this->data['golongan'] as $item) {
			// 	$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
			// }
	
			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			
			// $this->_render_page('auth/forgot_password', $this->data);
			$this->load->view('layout/header', $this->data);
			$this->load->view('forgot-password/index', $this->data);
			$this->load->view('layout/footer', $this->data);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            		$this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("auth/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				// redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
				redirect("login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name'    => 'new',
					'id'      => 'new',
					'type'    => 'password',
					'class'   => 'form-control',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name'    => 'new_confirm',
					'id'      => 'new_confirm',
					'type'    => 'password',
					'class'   => 'form-control',
					'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
				);
				$this->data['user_id'] = array(
					'name'  => 'user_id',
					'id'    => 'user_id',
					'type'  => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// siapkan data golongan
				// $this->data['golongan'] = $this->golongan_model->get_all();

				// foreach ($this->data['golongan'] as $item) {
				// 	$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
				// }

				// render
				// $this->_render_page('auth/reset_password', $this->data);
				$this->load->view('layout/header', $this->data);
				$this->load->view('reset-password/index', $this->data);
				$this->load->view('layout/footer', $this->data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						// redirect("auth/login", 'refresh');
						redirect("login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
