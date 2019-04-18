<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviews extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('admin/reviews');
		$this->load->model('reviews_model');

        /* Title Page :: Common */
        // $this->page_title->push(lang('menu_categories'));
        $this->data['pagetitle'] = '<h1>Reviews</h1>'; //$this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_reviews'), 'admin/reviews');
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

			$pagingx = isset($_SESSION['paging']) ? $_SESSION['paging'] : 10;

			if ($this->input->get('p')) {
				$page   = $this->input->get('p');
				$offset = ((int)$page-1)*$pagingx;
			} else {
				$page   = 1;
				$offset = 0;
			}
				
            $this->session->set_userdata('last_page', $page);
            $this->session->set_userdata('start', $offset);
			
			$q  = $this->input->get('q');
			if ($q)
			{
				$url   = current_url() . '?q='.$q.'&p=';
				$this->session->set_userdata('q', $q);
			}
			else
			{
				$url   = current_url() . '?p=';
				$this->session->unset_userdata('q');
			}
			$this->session->set_userdata('url', $url.$page);

			$this->data['reviews']  = $this->reviews_model->get_limit_data($pagingx, $offset, $q);
			$total = $this->reviews_model->total_rows($q);

			$this->data['pagination'] = $this->paging($total, $page, $url);

            /* Load Template */
            $this->template->admin_render('admin/reviews/index', $this->data);
        }
    }


	public function detail()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            $catid = $this->uri->segment(4);
            $this->data['catid']  =  $catid;
            $this->data['subtitle']  = $this->golongan_model->get_by_id($catid)->nama;
            $this->data['subcategories'] = $this->golongan_model->get_sub_category($catid);
            $this->session->set_userdata('kdgol', $catid);

            /* Load Template */
            $this->template->admin_render('admin/subcategories/index', $this->data);
        }
    }


	public function create()
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('subcategory_create'), 'admin/subcategories/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        
        $total = (int)$this->golongan_model->total_sub_category($_SESSION['kdgol']) + 1;
        $newcode = $total < 10 ? str_pad($total, 2, '0', STR_PAD_LEFT) : $total;
        $newcode = $_SESSION['kdgol'].'.'. $newcode;
        $this->session->set_flashdata('newcode', $newcode);

        /* Validate form input */
        $this->form_validation->set_rules('nama', 'Sub Category Name', 'required');

        if ($this->form_validation->run() == TRUE)
        {
            $category_data = array(
                'kdgol'  => $this->input->post('kdgol'),
                'kdgol2' => $this->input->post('kdgol2'),
                'nama'   => $this->input->post('nama'),
                'info'   => $this->input->post('info'),
                'gambar' => $this->input->post('gambar')
            );
            
            $this->golongan2_model->insert($category_data);
            // $this->session->set_flashdata('message', '');
            redirect('admin/subcategories/detail/'.$_SESSION['kdgol'], 'refresh');
        }
        else
        {
            $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $this->data['kdgol'] = array(
                'kdgol' => $this->session->userdata['kdgol'],
            );
            
            $this->data['kdgol2'] = array(
                'name'  => 'kdgol2',
                'id'    => 'kdgol2',
                'type'  => 'text',
                'readonly' => TRUE,
                'class' => 'form-control',
                'value' => isset($CI->form_validation) ? $this->form_validation->set_value('kdgol2') : $_SESSION['newcode']
            );
            $this->data['nama'] = array(
                'name'  => 'nama',
                'id'    => 'nama',
                'type'  => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('nama')
            );
			$this->data['info'] = array(
				'name'  => 'info',
				'id'    => 'info',
                'class' => 'form-control',
				'rows'  => '3',
				'value' => $this->form_validation->set_value('info'),
			);
			$this->data['gambar'] = array(
				'name'  => 'gambar',
				'id'    => 'gambar',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('gambar'),
				'readonly' => '1'
			);
        }

        /* Load Template */
        $this->template->admin_render('admin/subcategories/create', $this->data);
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
			$id = $this->uri->segment(4);
		
			if (isset($_POST) && ! empty($_POST))
			{
				$id      = $this->input->post('id');
				$confirm = $this->input->post('confirm');
				
				if ($confirm == 'yes') {
			
					$this->reviews_model->delete($id);
				}
				redirect(isset($_SESSION['url'])?$_SESSION['url']:'admin/reviews', 'refresh');
			}
			$nama = $this->reviews_model->get_by_id($id)->name;
			$this->data['id'] = array(
				'id' => $id,
			);
			$this->data['nama'] = array(
				'nama' => $nama,
			);
	
			/* Load Template */
			$this->template->admin_render('admin/reviews/delete', $this->data);
        }
	}


	public function edit($id)
	{
		if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin() OR ! $id OR empty($id))
		{
			redirect('auth', 'refresh');
		}

        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_subcategory_edit'), 'admin/subcategories/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

        /* Variables */
		$subcategories = $this->golongan2_model->get_by_id($id);
        // $catid = $this->uri->segment(4);

		/* Validate form input */
        $this->form_validation->set_rules('nama', 'Sub Category Name', 'required');

		if (isset($_POST) && ! empty($_POST))
		{
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'kdgol2'     => $this->input->post('kdgol2'),

					'nama'       => $this->input->post('nama'),
					'info'       => $this->input->post('info'),
					'gambar'     => $this->input->post('gambar'),
				);

                $this->golongan2_model->update($id, $data);
                $this->session->set_flashdata('message', '');
                redirect('admin/subcategories/detail/'.$_SESSION['kdgol'], 'refresh');
			}
		}

        $this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        $this->data['subcategories'] = $subcategories;

        $this->data['kdgol2'] = array(
            'name'  => 'kdgol2',
            'id'    => 'kdgol2',
            'type'  => 'text',
			'readonly' => TRUE,
            'class' => 'form-control',
            'value' => isset($CI->form_validation) ? $this->form_validation->set_value('kdgol2') : $this->data['subcategories']->kdgol2,
        );

        $this->data['nama'] = array(
			'type'    => 'text',
			'name'    => 'nama',
			'id'      => 'nama',
			'value'   => isset($CI->form_validation) ? $this->form_validation->set_value('nama') : $this->data['subcategories']->nama,
            'class'   => 'form-control',
		);
		$this->data['info'] = array(
			'name'  => 'info',
			'id'    => 'info',
			'class' => 'form-control',
			'rows'  => '3',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('info') : $this->data['subcategories']->info,
		);
		$this->data['gambar'] = array(
			'name'  => 'gambar',
			'id'    => 'gambar',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('gambar') : $this->data['subcategories']->gambar,
			'readonly' => '1'
		);
		$this->data['old_pic'] = array(
			'old_pic' => $this->data['subcategories']->gambar,
		);

        /* Load Template */
        $this->template->admin_render('admin/subcategories/edit', $this->data);
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
		$pagingx = isset($_SESSION['paging']) ? $_SESSION['paging'] : 10;
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
}
