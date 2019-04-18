<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('admin/subcategory');
		$this->load->model('golongan_model');

        /* Title Page :: Common */
        // $this->page_title->push(lang('menu_categories'));
        $this->data['pagetitle'] = '<h1>Categories</h1>'; //$this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_categories'), 'admin/categories');
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

            $this->data['categories']  = $this->golongan_model->get_all();

            /* Load Template */
            $this->template->admin_render('admin/categories/index', $this->data);
        }
    }
}
