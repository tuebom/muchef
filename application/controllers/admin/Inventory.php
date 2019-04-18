<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
		
		$this->load->library('pagination');
		
		$this->lang->load('admin/inventory');
		$this->lang->load('auth');

		$this->load->model('admin/inventory_model');
		$this->load->model('golongan_model');
		$this->load->model('golongan2_model');
		$this->load->model('golongan3_model');

		$this->session->unset_userdata('catgry');
		$this->session->unset_userdata('brand');
		
		// $this->output->enable_profiler(TRUE);

        /* Title Page :: Common */
        // $this->page_title->push(lang('menu_inventory'));
        $this->data['pagetitle'] = '<h1>Inventory</h1>'; //$this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, 'Inventory', 'admin/inventory');
    }


	public function index()
	{
        if ( ! $this->ion_auth->logged_in() OR ! $this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
			$context = $this->session->userdata('context');

			/* Breadcrumbs */
            $this->data['breadcrumb'] = $this->breadcrumbs->show();

            $this->session->set_userdata('custom_dir', '/upload/gambar/');

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
			
			// get category data
			$catgry  = $this->input->get('c');

			if ($catgry)
			{
				// log_message('Debug', '$catgry: '.$catgry);

				$this->session->set_userdata('catgry', $catgry);
				
				// $brand  = $this->input->get('b');
				// if (!$brand)
				// {
					$this->data['brands']  = $this->inventory_model->all_brands_by_catgry($catgry);
					// log_message('Debug', '***Custom brand has been set.');
				// }
			}
			else
			{
				// load all brands
				$this->data['brands']  = $this->inventory_model->all_brands();
				log_message('Debug', '***Brand has been set.');
			}
			
			// get brand data
			$brand  = $this->input->get('b');

			if ($brand)
			{
				$this->session->set_userdata('brand', $brand);
				log_message('Debug', '***Brand session var has been set.');
			}
			// else
			// {
			// 	$this->session->unset_userdata('brand');
			// 	// log_message('Debug', '***Brand has been set.');
			// }

			$q  = $this->input->get('q');
			if ($q)
			{
				if ($brand)
				{
					$url = current_url() . '?b='.urlencode($brand).'&q='.$q.'&p=';
				}
				else
				{
					$url = current_url() . '?q='.$q.'&p=';
				}
				$this->session->set_userdata('q', $q);
			}
			else
			{
				if ($brand)
				{
					$url = current_url() . '?b='.urlencode($brand).'&p=';
				}
				else
				{
					$url = current_url() . '?p=';
				}
				$this->session->unset_userdata('q');
			}
			$this->session->set_userdata('url', $url.$page);

			$this->data['categories'] = $this->golongan2_model->get_all();
			// $this->data['brands']  = $this->inventory_model->all_brands();
			
			$this->data['inventory'] = $this->inventory_model->get_limit_data($pagingx, $offset, $q, $catgry, $brand);
			$total = $this->inventory_model->total_rows($q, $catgry, $brand);

			$this->data['pagination'] = $this->paging($total, $page, $url);

			/* Load Template */
            $this->template->admin_render('admin/inventory/index', $this->data);
        }
	}


	public function create()
	{
        /* Breadcrumbs */
        $this->breadcrumbs->unshift(2, 'Create Inventory', 'admin/inventory/create');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('kdbar',  'Item Code', 'required');
		$this->form_validation->set_rules('kdurl',  'Item URL', 'required');
		$this->form_validation->set_rules('nama',   'Name', 'required');

		$this->form_validation->set_rules('kdgol',  'Category', 'required');
		// $this->form_validation->set_rules('kdgol2', 'Sub Category', 'required');
		// $this->form_validation->set_rules('kdgol3', 'Sub Category 2', 'required');

		$this->form_validation->set_rules('satuan', 'Unit', 'required');
		// $this->form_validation->set_rules('merk',   'Brand', 'required');

		// $this->form_validation->set_rules('pnj',    'Length', 'required');
		// $this->form_validation->set_rules('lbr',    'Width', 'required');
		// $this->form_validation->set_rules('tgi',    'Height', 'required');
		// $this->form_validation->set_rules('hjual',  'Harga', 'required');
			
		$master = $this->input->post('master');
		if (!$master) $master = 'N';

		$parent = $this->input->post('parent');
		if (!$parent) $parent = NULL;

		if ($this->form_validation->run() == TRUE)
		{

			$inventory_data = array(
			'kdbar'      => $this->input->post('kdbar'),
			'kdurl'      => $this->input->post('kdurl'),
			'nama'       => $this->input->post('nama'),
			
			'kdgol'      => $this->input->post('kdgol'),
			'kdgol2'     => $this->input->post('kdgol2'),
			'kdgol3'     => $this->input->post('kdgol3'),
			
			'deskripsi'  => $this->input->post('deskripsi'),
			'satuan'     => $this->input->post('satuan'),
			'merk'       => $this->input->post('merk'),
			'size'       => $this->input->post('size'),
			'parent'     => $parent,

			'pnj'        => $this->input->post('pnj'),
			'lbr'        => $this->input->post('lbr'),
			'tgi'        => $this->input->post('tgi'),

			'listrik'    => $this->input->post('listrik'),
			'kapasitas'  => $this->input->post('kapasitas'),
			'gas'        => $this->input->post('gas'),
			'berat'      => $this->input->post('berat'),
			
			'fitur'      => $this->input->post('fitur'),
			'kriteria'   => $this->input->post('kriteria'),
			
			'tag'        => $this->input->post('tag'),
			'hjual'      => $this->input->post('hjual'),
			'hpromo'     => $this->input->post('hpromo'),

			'publish'    => $this->input->post('publish'),
			'master'     => $master, //$this->input->post('master'),

			'gambar'     => urldecode($this->input->post('gambar')),
			'gambar2'    => urldecode($this->input->post('gambar2')),
			'gambar3'    => urldecode($this->input->post('gambar3')),
			);
			
			$this->inventory_model->insert($inventory_data);
            redirect('admin/inventory', 'refresh');
		}
		else
		{

			$this->data['golongan']  = $this->golongan_model->get_all();
			// $this->data['golongan2'] = $this->golongan2_model->get_all();
			// $this->data['golongan3'] = $this->golongan3_model->get_all();

			$this->data['brands']  = $this->inventory_model->all_brands();
			$this->data['parents'] = $this->inventory_model->all_parents();
			
			$this->session->set_flashdata('kdgol',  $this->input->post('kdgol'));
			// $this->session->set_flashdata('kdgol2', $this->input->post('kdgol2'));
			// $this->session->set_flashdata('kdgol3', $this->input->post('kdgol3'));

			$this->session->set_flashdata('merk',   $this->input->post('merk'));

			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['kdbar'] = array(
				'name'  => 'kdbar',
				'id'    => 'kdbar',
				'type'  => 'text',
                'class' => 'form-control',
                'autocomplete' => 'off',
				'value' => $this->form_validation->set_value('kdbar'),
			);
			$this->data['kdurl'] = array(
				'name'  => 'kdurl',
				'id'    => 'kdurl',
				'type'  => 'text',
                'class' => 'form-control',
                'autocomplete' => 'off',
				'value' => $this->form_validation->set_value('kdurl'),
			);
			$this->data['nama'] = array(
				'name'  => 'nama',
				'id'    => 'nama',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('nama'),
			);
			
			$this->data['deskripsi'] = array(
				'name'  => 'deskripsi',
				'id'    => 'deskripsi',
                'class' => 'form-control',
				'rows'  => '5',
				'value' => $this->form_validation->set_value('deskripsi'),
			);
			
			$this->data['satuan'] = array(
				'name'  => 'satuan',
				'id'    => 'satuan',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('satuan'),
			);
			$this->data['merk'] = array(
				'name'  => 'merk',
				'id'    => 'merk',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('merk'),
			);
			
			$this->data['size'] = array(
				'name'  => 'size',
				'id'    => 'size',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('size'),
			);
			$this->data['parent'] = array(
				'name'  => 'parent',
				'id'    => 'parent',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('parent'),
			);
			
			$this->data['pnj'] = array(
				'name'  => 'pnj',
				'id'    => 'pnj',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('pnj'),
			);
			$this->data['lbr'] = array(
				'name'  => 'lbr',
				'id'    => 'lbr',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('lbr'),
			);
			$this->data['tgi'] = array(
				'name'  => 'tgi',
				'id'    => 'tgi',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('tgi'),
			);
			
			$this->data['listrik'] = array(
				'name'  => 'listrik',
				'id'    => 'listrik',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('listrik'),
			);
			$this->data['kapasitas'] = array(
				'name'  => 'kapasitas',
				'id'    => 'kapasitas',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('kapasitas'),
			);
			$this->data['gas'] = array(
				'name'  => 'gas',
				'id'    => 'gas',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('gas'),
			);
			$this->data['berat'] = array(
				'name'  => 'berat',
				'id'    => 'berat',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('berat'),
			);
			$this->data['fitur'] = array(
				'name'  => 'fitur',
				'id'    => 'fitur',
				'rows'  => '5',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('fitur'),
			);
			
			// $this->data['kriteria'] = array(
			// 	'name'  => 'kriteria',
			// 	'id'    => 'kriteria',
            //     'class' => 'form-control',
			// 	'value' => $this->form_validation->set_value('kriteria'),
			// );
			$this->data['tag'] = array(
				'name'  => 'tag',
				'id'    => 'tag',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('tag'),
			);
			$this->data['hjual'] = array(
				'name'  => 'hjual',
				'id'    => 'hjual',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('hjual'),
			);
			$this->data['hpromo'] = array(
				'name'  => 'hpromo',
				'id'    => 'hpromo',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('hpromo'),
			);
			
			$this->data['publish'] = array(
				'value' => $this->form_validation->set_value('publish'),
			);
			$this->data['master'] = array(
				'value' => $this->form_validation->set_value('master'),
			);
			
			$this->data['gambar'] = array(
				'name'  => 'gambar',
				'id'    => 'gambar',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('gambar'),
				'readonly' => '1'
			);
			$this->data['gambar2'] = array(
				'name'  => 'gambar2',
				'id'    => 'gambar2',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('gambar2'),
				'readonly' => '1'
			);
			$this->data['gambar3'] = array(
				'name'  => 'gambar3',
				'id'    => 'gambar3',
				'type'  => 'text',
                'class' => 'form-control',
				'value' => $this->form_validation->set_value('gambar3'),
				'readonly' => '1'
			);

            /* Load Template */
            $this->template->admin_render('admin/inventory/create', $this->data);
        }
	}


	public function delete()
	{
		$kdurl = $this->uri->segment(4);
		
		if (isset($_POST) && ! empty($_POST))
		{
			$kdurl   = $this->input->post('kdurl');
			$confirm = $this->input->post('confirm');
			
			if ($confirm == 'yes') {
		
				$filename = $this->input->post('old_pic');
				
				if ($filename) {
					$thumb_file = substr($_SESSION['custom_dir'],1).'thumbnail/'.$filename;
					$file = substr($_SESSION['custom_dir'],1).$filename;
					
					if (file_exists($thumb_file)) unlink($thumb_file);
					if (file_exists($file)) unlink($file);
				}
				
				$filename = $this->input->post('old_pic2');
				
				if ($filename) {
					$thumb_file = substr($_SESSION['custom_dir'],1).'thumbnail/'.$filename;
					$file = substr($_SESSION['custom_dir'],1).$filename;
					
					if (file_exists($thumb_file)) unlink($thumb_file);
					if (file_exists($file)) unlink($file);
				}
				
				$filename = $this->input->post('old_pic3');
				
				if ($filename) {
					$thumb_file = substr($_SESSION['custom_dir'],1).'thumbnail/'.$filename;
					$file = substr($_SESSION['custom_dir'],1).$filename;
					
					if (file_exists($thumb_file)) unlink($thumb_file);
					if (file_exists($file)) unlink($file);
				}
				
				$this->inventory_model->delete($kdurl);
			}

			redirect(isset($_SESSION['url'])?$_SESSION['url']:'admin/inventory', 'refresh');
		}
		
		$this->data['inventory'] = $this->inventory_model->get_by_id($kdurl);
		
		$this->data['kdurl'] = array(
			'kdurl' => $kdurl,
		);
		$this->data['old_pic'] = array(
			'old_pic' => $this->data['inventory']->gambar,
		);
		$this->data['old_pic2'] = array(
			'old_pic2' => $this->data['inventory']->gambar2,
		);
		$this->data['old_pic3'] = array(
			'old_pic3' => $this->data['inventory']->gambar3,
		);

        /* Load Template */
		$this->template->admin_render('admin/inventory/delete', $this->data);
	}


	public function edit($kode)
	{
		if ( ! $this->ion_auth->logged_in() OR ( ! $this->ion_auth->is_admin()))
		{
			redirect('auth', 'refresh');
		}
		$kode = urldecode($kode);

		$this->session->set_userdata('kdbar', $kode);

		/* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_inventory_edit'), 'admin/inventory/edit');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();

		/* Validate form input */
		$this->form_validation->set_rules('kdbar', 'lang:inventory_kdbar', 'required');
		$this->form_validation->set_rules('kdurl', 'lang:inventory_kdurl', 'required');
		$this->form_validation->set_rules('nama',  'lang:inventory_name', 'required');
		$this->form_validation->set_rules('satuan', 'lang:inventory_unit', 'required');

		if (isset($_POST) && ! empty($_POST))
		{

			$master = $this->input->post('master');
			if (!$master) $master = 'N';

			$parent = $this->input->post('parent');
			if (!$parent) $parent = NULL;
	
			if ($this->form_validation->run() == TRUE)
			{
				$data = array(
					'kdurl'      => $this->input->post('kdurl'),
					'nama'       => $this->input->post('nama'),

					'kdgol'      => $this->input->post('kdgol'),
					'kdgol2'     => $this->input->post('kdgol2'),
					'kdgol3'     => $this->input->post('kdgol3'),

					'deskripsi'  => $this->input->post('deskripsi'),
					'satuan'     => $this->input->post('satuan'),
					'merk'       => $this->input->post('merk'),
					'size'       => $this->input->post('size'),
					'parent'     => $parent,

					'pnj'        => $this->input->post('pnj'),
					'lbr'        => $this->input->post('lbr'),
					'tgi'        => $this->input->post('tgi'),

					'listrik'    => $this->input->post('listrik'),
					'kapasitas'  => $this->input->post('kapasitas'),
					'gas'        => $this->input->post('gas'),
					'berat'      => $this->input->post('berat'),
					
					'fitur'      => $this->input->post('fitur'),
					'kriteria'   => $this->input->post('kriteria'),
					
					'tag'        => $this->input->post('tag'),
					'hjual'      => $this->input->post('hjual'),
					'hpromo'     => $this->input->post('hpromo'),

					'publish'    => $this->input->post('publish'),
					'master'     => $master, //$this->input->post('master'),

					'gambar'     => urldecode($this->input->post('gambar')),
					'gambar2'    => urldecode($this->input->post('gambar2')),
					'gambar3'    => urldecode($this->input->post('gambar3')),
				);

                $this->inventory_model->update($kode, $data);

				if ($this->ion_auth->is_admin())
				{
					
					if (isset($_SESSION['b']))
					{
						redirect('admin/inventory?b='.urlencode($_SESSION['brand']).'&p='.$_SESSION['last_page'], 'refresh');
					}
					else
					if (isset($_SESSION['last_page'])) {
						
						if (isset($_SESSION['q']))
						{
							if (isset($_SESSION['brand']))
							{
								redirect('admin/inventory?b='.urlencode($_SESSION['brand']).'&q='.$_SESSION['q'].'&p='.$_SESSION['last_page'], 'refresh');
							}
							else
							{
								redirect('admin/inventory?q='.$_SESSION['q'].'&p='.$_SESSION['last_page'], 'refresh');
							}
						}
						else
						{
							redirect('admin/inventory?p='.$_SESSION['last_page'], 'refresh');
						}
					}
				}
				else
				{
					redirect('admin', 'refresh');
				}
			}
		}


        $context = $this->session->userdata('context');

		$this->data['inventory'] = $this->inventory_model->get_by_id($kode);
		
		$this->session->set_userdata('parent', $this->data['inventory']->parent);
		
		$brand  = $this->input->get('b');
		if ($brand)
			$this->session->set_userdata('brand', $brand);

		$this->data['golongan']  = $this->golongan_model->get_all();
		$this->data['golongan2'] = $this->golongan2_model->get_by_catid($this->data['inventory']->kdgol);
		$this->data['golongan3'] = $this->golongan3_model->get_by_catid($this->data['inventory']->kdgol2);

		$this->data['brands']  = $this->inventory_model->all_brands();
		$this->data['parents'] = $this->inventory_model->all_parents();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
		
		$this->session->set_flashdata('merk', isset($CI->form_validation) ? $this->form_validation->set_value('merk') : $this->data['inventory']->merk);
		$this->session->set_flashdata('parent', isset($CI->form_validation) ? $this->form_validation->set_value('parent') : $this->data['inventory']->parent);

		$this->data['kdbar'] = array(
			'name'  => 'kdbar',
			'id'    => 'kdbar',
			'type'  => 'text',
			'readonly' => TRUE,
			'class' => 'form-control',
			'autocomplete' => 'off',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('kdbar') : $this->data['inventory']->kdbar,
		);
		$this->data['kdurl'] = array(
			'name'  => 'kdurl',
			'id'    => 'kdurl',
			'type'  => 'text',
			'class' => 'form-control',
			'autocomplete' => 'off',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('kdurl') : $this->data['inventory']->kdurl,
		);
		$this->data['nama'] = array(
			'name'  => 'nama',
			'id'    => 'nama',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('nama') : $this->data['inventory']->nama,
		);
		$this->data['deskripsi'] = array(
			'name'  => 'deskripsi',
			'id'    => 'deskripsi',
			'class' => 'form-control',
			'rows'  => '5',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('deskripsi') : $this->data['inventory']->deskripsi,
		);

		$this->data['satuan'] = array(
			'name'  => 'satuan',
			'id'    => 'satuan',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('satuan') : $this->data['inventory']->satuan,
		);
		$this->data['merk'] = array(
			'name'  => 'merk',
			'id'    => 'merk',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('merk') : $this->data['inventory']->merk,
		);

		$this->data['size'] = array(
			'name'  => 'size',
			'id'    => 'size',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('size') : $this->data['inventory']->size,
		);
		$this->data['parent'] = array(
			'name'  => 'parent',
			'id'    => 'parent',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('parent') : $this->data['inventory']->parent,
		);

		$this->data['pnj'] = array(
			'name'  => 'pnj',
			'id'    => 'pnj',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('pnj') : $this->data['inventory']->pnj,
		);
		$this->data['lbr'] = array(
			'name'  => 'lbr',
			'id'    => 'lbr',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('lbr') : $this->data['inventory']->lbr,
		);
		$this->data['tgi'] = array(
			'name'  => 'tgi',
			'id'    => 'tgi',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('tgi') : $this->data['inventory']->tgi,
		);

		$this->data['listrik'] = array(
			'name'  => 'listrik',
			'id'    => 'listrik',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('listrik') : $this->data['inventory']->listrik,
		);
		$this->data['kapasitas'] = array(
			'name'  => 'kapasitas',
			'id'    => 'kapasitas',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('kapasitas') : $this->data['inventory']->kapasitas,
		);
		$this->data['gas'] = array(
			'name'  => 'gas',
			'id'    => 'gas',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('gas') : $this->data['inventory']->gas,
		);
		$this->data['berat'] = array(
			'name'  => 'berat',
			'id'    => 'berat',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('berat') : $this->data['inventory']->berat,
		);
		$this->data['fitur'] = array(
			'name'  => 'fitur',
			'id'    => 'fitur',
			'rows'  => '5',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('fitur') : $this->data['inventory']->fitur,
		);
		
		$this->data['kriteria'] = $this->data['inventory']->kriteria;

		$this->data['tag'] = array(
			'name'  => 'tag',
			'id'    => 'tag',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('tag') : $this->data['inventory']->tag,
		);
		$this->data['hjual'] = array(
			'name'  => 'hjual',
			'id'    => 'hjual',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('hjual') : $this->data['inventory']->hjual,
		);
		$this->data['hpromo'] = array(
			'name'  => 'hpromo',
			'id'    => 'hpromo',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('hpromo') : $this->data['inventory']->hpromo,
		);

		$this->data['publish'] = array(
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('publish') : $this->data['inventory']->publish,
		);
		$this->data['master'] = array(
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('master') : $this->data['inventory']->master,
		);

		$this->data['gambar'] = array(
			'name'  => 'gambar',
			'id'    => 'gambar',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('gambar') : $this->data['inventory']->gambar,
			'readonly' => '1'
		);
		$this->data['gambar2'] = array(
			'name'  => 'gambar2',
			'id'    => 'gambar2',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('gambar2') : $this->data['inventory']->gambar2,
			'readonly' => '1'
		);
		$this->data['gambar3'] = array(
			'name'  => 'gambar3',
			'id'    => 'gambar3',
			'type'  => 'text',
			'class' => 'form-control',
			'value' => isset($CI->form_validation) ? $this->form_validation->set_value('gambar3') : $this->data['inventory']->gambar3,
			'readonly' => '1'
		);
		$this->data['old_pic'] = array(
			'old_pic' => $this->data['inventory']->gambar,
		);
		$this->data['old_pic2'] = array(
			'old_pic2' => $this->data['inventory']->gambar2,
		);
		$this->data['old_pic3'] = array(
			'old_pic3' => $this->data['inventory']->gambar3,
		);

        /* Load Template */
		$this->template->admin_render('admin/inventory/edit', $this->data);
	}


	public function history($kode)
	{
		if ( ! $this->ion_auth->logged_in() OR ( ! $this->ion_auth->is_admin()))
		{
			redirect('auth', 'refresh');
		}
		$kode = urldecode($kode);

		// $this->session->set_userdata('kdbar', $kode);

		/* Breadcrumbs */
        $this->breadcrumbs->unshift(2, lang('menu_inventory_history'), 'admin/inventory/history');
        $this->data['breadcrumb'] = $this->breadcrumbs->show();
        $this->data['pagetitle'] = '<h1>Item History</h1>';
		$this->data['subtitle']  = $kode . ' - '. $this->inventory_model->get_by_id($kode)->nama;


		$this->data['golongan']  = $this->golongan_model->get_all();
		// $this->data['golongan2'] = $this->golongan2_model->get_by_catid($this->data['inventory']->kdgol);
		// $this->data['golongan3'] = $this->golongan3_model->get_by_catid($this->data['inventory']->kdgol2);

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
			// if ($brand)
			// {
			// 	$url   = current_url() . '?b='.urlencode($brand).'&q='.$q.'&p=';
			// }
			// else
			{
				$url   = current_url() . '?q='.$q.'&p=';
			}
			$this->session->set_userdata('q', $q);
		}
		else
		{
			// if ($brand)
			// {
			// 	$url   = current_url() . '?b='.urlencode($brand).'&p=';
			// }
			// else
			{
				$url   = current_url() . '?p=';
			}
			$this->session->unset_userdata('q');
		}
		$this->session->set_userdata('url', $url.$page);

		$this->data['history'] = $this->inventory_model->get_history($kode, $q);
		$total = $this->inventory_model->total_history_rows($kode, $q); //, $brand

		$this->data['pagination'] = $this->paging($total, $page, $url);

        /* Load Template */
		$this->template->admin_render('admin/inventory/history', $this->data);
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

	public function remove_item()
	{
		$content = file_get_contents("php://input");
		$selection = json_decode($content, true);

		// var_dump($selection);
		// log_message('Debug', '***item selection: '. $content);
		// die();
		
		// $arr_item  = explode(",", $selection);

		foreach($selection as $kode)
		{
			$this->inventory_model->delete($kode);
			// log_message('Debug', '***item deleted: '. $kode);
		}

		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'status' => TRUE
		)));
	}
	
	public function upload_file() {
		
		$config = array(
            'upload_path' => './upload/gambar/',
            'allowed_types' => 'png', //'gif|jpg|png',
            'file_name' => $_SESSION['kdbar'].'png', //.date_default_timezone_set('Asia/Taipei'), //dmYHis
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
		redirect(current_url(), 'refresh');
    }

	public function rmvimage()
	{
		$filename = $this->input->post("filename");
		
		$thumb_file = substr($_SESSION['custom_dir'],1).'thumbnail/'.$filename;
		$file = substr($_SESSION['custom_dir'],1).$filename;
		
		if (file_exists($thumb_file)) unlink($thumb_file);
		if (file_exists($file)) unlink($file);
		
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
			'status' => TRUE
		)));
	}

	public function level2()
	{
		$groupid = $this->uri->segment(4);
		// $groupid = $this->input->post("id");
		$data = $this->golongan_model->get_sub_category($groupid);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'data' => $data
		)));
	}

	public function level3()
	{
		$groupid = $this->uri->segment(4);
		// log_message('Debug', '$groupid: '.$groupid);
		$data = $this->golongan2_model->get_sub_category($groupid);
		return $this->output
		->set_content_type('application/json')
		->set_status_header(200)
		->set_output(json_encode(array(
				'data' => $data
		)));
	}

	public function isexists()
	{
		$kode = $this->uri->segment(4);
		$data = $this->inventory_model->code_exists($kode);

		if ($data) {
			return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
				'status' => TRUE
			)));
		} else {
			return $this->output
			->set_content_type('application/json')
			->set_status_header(200)
			->set_output(json_encode(array(
				'status' => FALSE
			)));
		}
	}
}
