<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends Public_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('golongan_model');
        $this->load->model('stock_model');
    }


	public function index()
	{
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
        }

		if ($this->ion_auth->logged_in())
		{
			$member = $this->ion_auth->user()->row();
			$this->data['first_name'] = $member->first_name;
			$this->data['last_name']  = $member->last_name;
		}

		$this->load->view('layout/header', $this->data);
		$this->load->view('cart/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}

	public function add()
	{
        // menambah item ke cart
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
        }

        $kode = $this->input->post('kode');

        if ($kode != '') {
            
            // $detail = $this->stock_model->get_by_id($kode);
            $this->db->select('kdbar, kdurl, nama, hjual, format(hjual,0,"id") as hjualf, gambar, pnj, lbr, tgi');
            $this->db->where('kdbar', $kode);
            $detail = $this->db->get('stock')->row();
                
            $qty = $this->input->post('qty');
            
            $itemArray = array( $kode => array( 'kdbar' => $detail->kdbar,
                                                'kdurl' => $detail->kdurl,
                                                'nama'  => $detail->nama,
                                                'qty'   => $qty,
                                                'harga' => $detail->hjual,
                                                'hargaf'=> $detail->hjualf, // harga dgn pemisah ribuan
                                                'gambar'=> $detail->gambar,
                                                'pnj'   => $detail->pnj,
                                                'lbr'   => $detail->lbr,
                                                'tgi'   => $detail->tgi
                                            ));


            if(!empty($_SESSION["cart_item"])) {

                if(in_array($kode, array_keys($_SESSION["cart_item"]))) {

                    foreach($_SESSION["cart_item"] as $k => $v) {
                            
                        if($kode == $k) {
                                
                            if(empty($_SESSION["cart_item"][$k]["qty"])) {
                                $_SESSION["cart_item"][$k]["qty"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["qty"] += $qty;
                        }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
    
        }

        $_SESSION["totqty"] += $qty;
        
		$this->load->view('layout/header', $this->data);
		$this->load->view('cart/index', $this->data);
		$this->load->view('layout/footer', $this->data);
    }

	public function remove()
	{
		$this->data['golongan'] = $this->golongan_model->get_all();

		foreach ($this->data['golongan'] as $item) {
			$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
        }

        $kode = $this->input->post('kode');

        if ($kode != '') {
            
            $qty = $this->input->post('qty');

            if(!empty($_SESSION["cart_item"])) {

                if(in_array($kode, array_keys($_SESSION["cart_item"]))) {

                    foreach($_SESSION["cart_item"] as $k => $v) {
                            
                        if($kode == $k) {
                                
                            unset($_SESSION['cart_item'][$k]);
                        }
                    }
                }

            }
    
        }

        $_SESSION["totqty"] -= $qty;

        if(sizeof($_SESSION["cart_item"])>0)
        {
            header("location: ".base_url().'cart');
        }
        else
        {
            $this->session->set_userdata('tot_price', 0);
            
            if ($_SESSION['context'] == 1)
            {
                header("location: ".site_url('equipment'));
            }
            else
            {
                header("location: ".site_url('utensil'));
            }
        }
    }
}
