<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Cart extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        // $this->load->model('golongan_model');
        // $this->load->model('stock_model');
    }

	public function index_get()
	{
        // $context = 2; //$this->session->userdata('context');
        
        // inisiasi
        $item_price  = 0;
        $total_price = 0;

        if(!empty($_SESSION["cart_item"])) {
            
            $data = [];
            
            // prepare data & calculate total
            foreach($_SESSION["cart_item"] as $k => $v) {
                
                array_push($data, $v);
                
                $item_price  = (float)$_SESSION["cart_item"][$k]["qty"]*$_SESSION["cart_item"][$k]["harga"];
                $total_price += $item_price;
            }
            
        } else {
            $data = [];
        }
                    
        $this->set_response([ 'status' => TRUE, 'data' => $data, 'total' => $total_price ], REST_Controller::HTTP_OK);
    }

	public function index_post()
	{
        // menambah item ke cart

		// $this->data['golongan'] = $this->golongan_model->get_all();

		// foreach ($this->data['golongan'] as $item) {
		// 	$this->data['item_'.$item->kdgol] = $this->golongan_model->get_sample($item->kdgol);
        // }

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
                                                'hargaf'=> number_format($detail->hjual, 0, ',', '.'), //$detail->hjualf, // harga dgn pemisah ribuan
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

        if (!isset($_SESSION["totqty"]))
        {
            $this->session->set_userdata('totqty', $qty);
        }
        else
        {
            $_SESSION["totqty"] += $qty;
        }

        $this->set_response(['status' => TRUE, 'totqty' => $_SESSION["totqty"] ], REST_Controller::HTTP_OK);
    }

	public function total_items_get()
	{

        if (!isset($_SESSION["totqty"]))
        {
            // $this->session->set_userdata('totqty', $qty);
            $this->set_response( ['status' => FALSE ], REST_Controller::HTTP_OK);
        }
        else
        {
            $this->set_response( ['status' => TRUE, 'totqty' => $_SESSION["totqty"] ], REST_Controller::HTTP_OK);
        }
    }

    public function remove_post()
    {
    
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

        $this->set_response([ 'status' => TRUE, 'totqty' => $_SESSION["totqty"] ], REST_Controller::HTTP_OK);
    }
}
