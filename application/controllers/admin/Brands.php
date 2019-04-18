<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('admin/brands');
		$this->load->model('brands_model');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_brands'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_brands'), 'admin/brands');
        // $this->output->enable_profiler(TRUE);
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

            $this->data['brands'] = $this->brands_model->get_all();

            /* Load Template */
            $this->template->admin_render('admin/brands/index', $this->data);
        }
    }


	public function create()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('brands_create'), 'admin/brands/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('name', 'Brand Name', 'required');

		if ($this->form_validation->run() == TRUE)
		{
            $brand_data = array(
                'name' => $this->input->post('name')
            );
            
            $this->brands_model->insert($brand_data);
            // $this->session->set_flashdata('message', '');
            redirect('admin/brands', 'refresh');
		}
		else
		{
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['brand_name'] = array(
				'name'  => 'name',
				'id'    => 'name',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('name')
			);

            /* Load Template */
            $this->template->admin_render('admin/brands/create', $this->data);
		}
	}


	public function delete()
	{
        if ( ! $this->ion_auth->logged_in())
        {
            redirect('auth/login', 'refresh');
        }
        elseif ( ! $this->ion_auth->is_admin())
		{
            return show_error('You must be an administrator to view this page.');
        }
        else
        {
            $brand_name = urldecode($this->uri->segment(4));
		
            if (isset($_POST) && ! empty($_POST))
            {
                $brand_name  = urldecode($this->input->post('brand_name'));
                $confirm     = $this->input->post('confirm');
                
                if ($confirm == 'yes') {
                    
                    $this->brands_model->delete($brand_name);
                }
                redirect('admin/brands', 'refresh');
            }
            
            $this->data['brand'] = array(
                'brand_name' => $brand_name,
            );
    
            $this->template->admin_render('admin/brands/delete', $this->data);
        }
	}


	public function edit($id)
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_brands_edit'), 'admin/brands/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		$brand = $this->brands_model->get_by_name(urldecode($id));

		/* Validate form input */
        $this->form_validation->set_rules('brand_name', 'Brand Name', 'required');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->form_validation->run() == TRUE)
			{
                $this->brands_model->update(urldecode($id), array('name' => $this->input->post('brand_name')));

                $this->session->set_flashdata('message', '');
                redirect('admin/brands', 'refresh');
			}
		}

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['brand'] = $brand;

		$this->data['brand_name'] = array(
			'type'    => 'text',
			'name'    => 'brand_name',
			'id'      => 'brand_name',
			'value'   => isset($CI->form_validation) ? $this->form_validation->set_value('name') : $this->data['brand']->name,
            'class'   => 'form-control',
		);

        /* Load Template */
        $this->template->admin_render('admin/brands/edit', $this->data);
	}
}
