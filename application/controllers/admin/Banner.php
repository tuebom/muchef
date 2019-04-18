<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->model('admin/banner_model');
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
            /* Title Page */
            $this->page_title->push(lang('menu_banner'));
            $this->data['pagetitle'] = $this->page_title->show();

            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            /* Data */
            $this->data['banner'] = $this->banner_model->get_all();

            $this->session->set_userdata('custom_dir', '/upload/banner/');

            /* Load Template */
            $this->template->admin_render('admin/banner/index', $this->data);
        }
	}

	public function add()
	{
		// $filename = $this->uri->segment(3);
		$filename = $this->input->post("filename");
		$this->banner_model->insert(array('filename' => $filename));
        
        return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'status' => TRUE
		)));
	}

	public function delete()
	{
        $banner_id = $this->uri->segment(4);
        $banner = $this->banner_model->get_by_id($banner_id);
        
        if (file_exists('upload/banner/' . $banner->filename))
            unlink('upload/banner/' . $banner->filename);
        if (file_exists('upload/banner/thumbnail/' . $banner->filename))
            unlink('upload/banner/thumbnail/' . $banner->filename);

        // hapus data
        $this->banner_model->delete($banner_id);
        
        return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'status' => TRUE
		)));
	}
}
