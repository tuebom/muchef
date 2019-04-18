<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carrier extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
		
		$this->load->library('pagination');
		
		$this->lang->load('admin/carrier');
		$this->load->model('carrier_model');
		
        // $this->output->enable_profiler(TRUE);
        
        // https://rajaongkir.com/dokumentasi

        /* Title Page :: Common */
        $this->data['pagetitle'] = '<h1>Carrier</h1>';

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Carrier', 'admin/carrier');
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

			// $pagingx = isset($_SESSION['paging']) ? $_SESSION['paging'] : 10;

			// if ($this->input->get('p')) {
			// 	$page   = $this->input->get('p');
			// 	$offset = ((int)$page-1)*$pagingx;
			// } else {
			// 	$page   = 1;
			// 	$offset = 0;
			// }
				
            // $this->session->set_userdata('last_page', $page);
            // $this->session->set_userdata('start', $offset);
			
			// $q  = $this->input->get('q');
			// if ($q)
			// {
            //     $url   = current_url() . '?q='.$q.'&p=';
			// 	$this->session->set_userdata('q', $q);
			// }
			// else
			// {
            //     $url   = current_url() . '?p=';
			// 	$this->session->unset_userdata('q');
			// }
			// $this->session->set_userdata('url', $url.$page);
			
			$this->data['carrier'] = $this->carrier_model->get_all(); //get_limit_data($pagingx, $offset, $q);
			// $total = $this->carrier_model->total_rows($q);

			// $this->data['pagination'] = $this->paging($total, $page, $url);

			/* Load Template */
            $this->template->admin_render('admin/carrier/index', $this->data);
        }
	}


	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create Carrier', 'admin/carrier/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('code',  'Carrier Code', 'required');
		$this->form_validation->set_rules('name',  'Carrier Name', 'required');

		if ($this->form_validation->run() == TRUE)
		{

			$carrier_data = array(
			'code'       => $this->input->post('code'),
			'name'       => $this->input->post('name'),
			'active'     => $this->input->post('active'),
			);
			
			$this->carrier_model->insert($carrier_data);
            redirect('admin/carrier', 'refresh');
		}
		else
		{

			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['code'] = array(
				'name'  => 'code',
				'id'    => 'code',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('code'),
			);
			$this->data['name'] = array(
				'name'  => 'name',
				'id'    => 'name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('name'),
			);
			
			$this->data['active'] = array(
				'name'  => 'active',
				'id'    => 'active',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('active'),
			);

            /* Load Template */
            $this->template->admin_render('admin/carrier/create', $this->data);
        }
	}


	public function delete()
	{
		$code = $this->uri->segment(4);
		
		if (isset($_POST) && ! empty($_POST))
		{
			$code    = $this->input->post('code');
			$confirm = $this->input->post('confirm');
			
			if ($confirm == 'yes') {
				$this->carrier_model->delete($code);
			}

			redirect(isset($_SESSION['url'])?$_SESSION['url']:'admin/carrier', 'refresh');
		}
		
		$this->data['carrier'] = $this->carrier_model->get_by_id($code);
		
		$this->data['code'] = array(
			'code' => $code,
		);

        /* Load Template */
		$this->template->admin_render('admin/carrier/delete', $this->data);
	}


	public function edit()
	{

		if ( ! $this->ion_auth->logged_in() OR ( ! $this->ion_auth->is_admin()))
		{
			redirect('auth', 'refresh');
		}
		
		$code = $this->uri->segment(4);

		$this->session->set_userdata('code', $code);

		/* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_carrier_edit'), 'admin/carrier/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('code', 'lang:carrier_code', 'required');
		$this->form_validation->set_rules('name', 'lang:carrier_name', 'required');

		if (isset($_POST) && ! empty($_POST))
		{

			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					// 'code'       => $this->input->post('code'),
					'name'       => $this->input->post('name'),
					'active'     => $this->input->post('active'),
				);

                $this->carrier_model->update($code, $data);

                if ($this->ion_auth->is_admin())
                {
                    
                    if (isset($_SESSION['last_page'])) {
                        
                        if (isset($_SESSION['q']))
                        {
                            redirect('admin/carrier?q='.$_SESSION['q'].'&p='.$_SESSION['last_page'], 'refresh');
                        }
                        else
                        {
                            redirect('admin/carrier?p='.$_SESSION['last_page'], 'refresh');
                        }
                    }
                }
                else
                {
                    redirect('admin', 'refresh');
                }
			}
		}


		$this->data['carrier'] = $this->carrier_model->get_by_id($code);

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		$this->data['code'] = array(
			'name'  => 'code',
			'id'    => 'code',
			'type'  => 'text',
			'readonly' => TRUE,
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('code') : $this->data['carrier']->code,
		);
		$this->data['name'] = array(
			'name'  => 'name',
			'id'    => 'name',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('name') : $this->data['carrier']->name,
		);
		$this->data['active'] = array(
			'name'  => 'active',
			'id'    => 'active',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('active') : $this->data['carrier']->active,
		);

        /* Load Template */
		$this->template->admin_render('admin/carrier/edit', $this->data);
	}
	
	public function setpaging($length){

		$length = (int) $length;
		$this->session->set_userdata('paging', $length);

		$data = array(
			'status' => TRUE
		);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'data' => $data
		)));
	}
	
	
	public function paging($total,$curr_page,$url){
    
		$page = '';
		$pagingx    = isset($_SESSION['paging']) ? $_SESSION['paging'] : 10;
		$total_page = ceil($total/$pagingx);
		
		if($total > $pagingx) { // hasil bagi atau jumlah halaman lebih dari satu
		
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

	public function activate()
	{
		$content = file_get_contents("php://input");
		$selection = json_decode($content, true);

		// unset all items
		$this->db->set(array('active' => 'N'));
		$this->db->update('carrier');
		
		foreach($selection as $code)
		{
			$this->carrier_model->update($code, array('active' => 'Y'));
		}

		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'status' => TRUE
		)));
	}
}
