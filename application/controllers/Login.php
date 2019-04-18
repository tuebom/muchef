<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Public_Controller {

    public function __construct()
    {
		parent::__construct();
        $this->lang->load('admin/users');
        $this->lang->load('auth');
        
		$this->load->model('golongan_model');
		$this->load->model('shopping_cart_model');
		
		// $this->session->unset_userdata('carrier');
		// $this->session->unset_userdata('paket');
        
        // $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
        $this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
		}
        
        if ( ! $this->ion_auth->logged_in())
        {
            
            $guest = $this->input->post('guest');
            $id    = $this->input->post('identity');

            if ($id) {
    
                /* Valid form */
                $this->form_validation->set_rules('identity', 'Email', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');

                if ($this->form_validation->run() == TRUE)
                {
                    $remember = (bool) $this->input->post('remember');

                    if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
                    {
                        
                        $this->session->set_userdata('mbrid', $this->ion_auth->user()->row()->id);

                        if ( ! $this->ion_auth->is_admin())
                        {
        
                            // get cart data if any
                            $result = $this->shopping_cart_model->get_by_mbrid($this->ion_auth->user()->row()->id);
                            // if ($result->num_rows > 0)
                            $shp_cart_id = $result ? $result->id : 0;
                            
                            if ($shp_cart_id > 0) {
                            
                                $this->session->set_userdata('shp_cart_id', $shp_cart_id);
                                $this->data['cart'] = $this->shopping_cart_model->get_detail_by_id($shp_cart_id);
                            
                                foreach ($this->data['cart'] as $item) {
                        
                                    $itemArray = array( $item->kdbar => array(
                                        'kdbar'   => $item->kdbar,
                                        'kdurl'   => $item->kdurl,
                                        'nama'    => $item->nama,
                                        'qty'     => $item->qty,
                                        'harga'   => $item->hjual,  //$result->data[0]->standard_rate, //
                                        'hargaf'  => $item->hjualf, //number_format($result->data[0]->standard_rate, 0, '.', ','), //
                                        'gambar'  => $item->gambar,
                                        'pnj'     => $item->pnj,
                                        'lbr'     => $item->lbr,
                                        'tgi'     => $item->tgi,
                                        'berat'   => $item->berat
                                    ));
                                    
                                    if(!empty($_SESSION["cart_item"])) {
            
                                        if(in_array($item->kdbar, array_keys($_SESSION["cart_item"]))) {
                        
                                            foreach($_SESSION["cart_item"] as $k => $v) {
                                                    
                                                if($item->kdbar == $k) {
                                                        
                                                    if(empty($_SESSION["cart_item"][$k]["qty"])) {
                                                        $_SESSION["cart_item"][$k]["qty"] = 0;
                                                    }
                                                    $_SESSION["cart_item"][$k]["qty"] += $item->qty;
                                                }
                                            }
                
                                        } else {
                                            $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                                        }
                                    } else {
                                        // data array kosong
                                        $_SESSION["cart_item"] = $itemArray;
                                    }

                                    $val = (int)$this->session->userdata('totqty') + $item->qty;
                                    $this->session->set_userdata('totqty', $val);
                                }
					
                                // inisiasi
                                $item_price  = 0;
                                $total_price = 0;
                                            
                                foreach($_SESSION["cart_item"] as $k => $v) {
                                    $item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
                                    $total_price += $item_price;
                                }
                                $this->session->set_userdata('tot_price', $total_price);
                            }
                            // log_message('Debug', '*** shp_cart_id: '.$shp_cart_id);

                            $this->session->set_flashdata('message', $this->ion_auth->messages());
                            
                            if (isset($_SESSION["cart_item"])) {
                                
                                if (count($_SESSION["cart_item"]) > 0)
                                {
                                    redirect('checkout', 'refresh');
                                }
                                else
                                {
                                    // redirect('/', 'refresh');
                                    if (isset($_SESSION['last_url']))
                                    {
                                        redirect($_SESSION['last_url'], 'refresh');
                                    }

                                    if ($context == 1)
                                    {
                                        redirect('equipment', 'refresh');
                                    }
                                    else
                                    {
                                        redirect('utensil', 'refresh');
                                    }
                                }
                            }
                            else
                            {
                                // redirect('/', 'refresh');
                                if ($context == 1)
                                {
                                    redirect('equipment', 'refresh');
                                }
                                else
                                {
                                    redirect('utensil', 'refresh');
                                }
                            }
                        }
                        else
                        {
                            /* Data */
                            // $this->data[''] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                            $this->session->set_flashdata('message', validation_errors() ? validation_errors() : $this->session->flashdata('message'));

                            /* Load Template */
                            // $this->template->auth_render('auth/choice', $this->data);
                            redirect('admin', 'refresh');
                            return;
                        }
                        
                    }
                    else
                    {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('login', 'refresh');
                        return;
                    }
                }
                else
                {

                    // $this->data['message_login'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
                    $this->session->set_flashdata('message', validation_errors() ? validation_errors() : $this->session->flashdata('message'));

                    $this->data['identity'] = array(
                        'name'        => 'identity',
                        'id'          => 'identity',
                        'type'        => 'email',
                        'value'       => $this->form_validation->set_value('identity'),
                        'class'       => 'form-control',
                        'placeholder' => lang('auth_your_email')
                    );
                    $this->data['password'] = array(
                        'name'        => 'password',
                        'id'          => 'password',
                        'type'        => 'password',
                        'class'       => 'form-control',
                        'placeholder' => lang('auth_your_password')
                    );

                    /* Load Template */
                    // $this->template->auth_render('auth/login', $this->data);
                }
            }
            elseif ($guest)
            {
                $remember = (bool) $this->input->post('remember');
                
                if ($this->ion_auth->login('guest@askitchen.com', 'zyxwv_98765', $remember)) {

                    $this->session->set_userdata('guest', TRUE);
                    $this->data['first_name'] = 'Guest';
                    $this->data['last_name']  = '';
                    
                    if (isset($_SESSION["cart_item"]))
                    {
                        if (count($_SESSION["cart_item"]) > 0)
                        {
                            redirect('checkout', 'refresh');
                        }
                        else
                        {
                            if (isset($_SESSION['last_url']))
                            {
                                redirect($_SESSION['last_url'], 'refresh');
                            }
    
                            if ($_SESSION['context'] == 1)
                            {
                                redirect('equipment', 'refresh');
                            }
                            else
                            {
                                redirect('utensil', 'refresh');
                            }
                        }
                    }
                    else
                    {
                        // if (isset($_SESSION['last_url']))
                        // {
                        //     redirect($_SESSION['last_url'], 'refresh');
                        // }

                        if ($_SESSION['context'] == 1)
                        {
                            redirect('equipment', 'refresh');
                        }
                        else
                        {
                            redirect('utensil', 'refresh');
                        }
                    }
                }
            }
		
            $action  = $this->input->get('action');
		
            if ($action) {
            
			    if ($action == 'remove') {
			
                    $kdbar = $this->input->get('code'); // kode barang => cart
		
                    if ($kdbar != '') {
                        
                        if(!empty($_SESSION["cart_item"])) {
            
                            if(in_array($kdbar, array_keys($_SESSION["cart_item"]))) {
            
                                foreach($_SESSION["cart_item"] as $k => $v) {
                                        
                                    if($kdbar == $k) {
                                            
                                        $val = (int)$this->session->userdata('totqty') - $_SESSION["cart_item"][$k]["qty"];
                                        $this->session->set_userdata('totqty', $val);
                                        unset($_SESSION['cart_item'][$k]);
                                    }
                                }
                            }
            
                        }
                
                    }
            
                    // inisiasi
                    $item_price  = 0;
                    $total_price = 0;
                                
                    foreach($_SESSION["cart_item"] as $k => $v) {
                        $item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
                        $total_price += $item_price;
                    }
                    $this->session->set_userdata('tot_price', $total_price);
                    
                    $url = strtok(current_url(), '?');
                    header("location: ".$url);
                }
            }
            
            if (isset($_SESSION['last_url']))
            {
                $this->session->set_flashdata('last_url', $_SESSION['last_url']);
            }
    
            $this->load->view('layout/header', $this->data);
            $this->load->view('login/index', $this->data);
            $this->load->view('layout/footer', $this->data);
        }
        else
        {
            if (isset($_SESSION['last_url']))
            {
                redirect($_SESSION['last_url'], 'refresh');
            }

            // redirect('/', 'refresh');
            if ($context == 1)
            {
                redirect('equipment', 'refresh');
            }
            else
            {
                redirect('utensil', 'refresh');
            }
        }
    }
}
