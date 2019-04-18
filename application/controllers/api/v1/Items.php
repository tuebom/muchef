<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Items extends REST_Controller
{

    public function __construct()
    {
		parent::__construct();

		// $this->load->add_package_path(APPPATH.'third_party/ion_auth/');
		// $this->load->library('ion_auth');
		$this->load->helper('authorization');
		$this->config->load('jwt');		

		$this->load->model('stock_model');
	}

	public function index_get()
	{
        header('Access-Control-Allow-Origin: *');
        
        // $headers = $this->input->request_headers();
		// $headers = $this->input->post();

        // if (Authorization::tokenIsExist($headers)) {
        //     $token = Authorization::validateToken($headers['Authorization']);
        //     if ($token != false) {
        
                $kode    = urldecode($this->uri->segment(4));
                $product = $this->stock_model->get_by_kodeurl($kode);
                $context = 2;

                // log_message('Debug', 'PHPMailer class is loaded.');
        
                // set warehouse
                $wh = ($context == 1) ? urlencode("Bali HO - AS"): urlencode("WH ASOVIC Pusat - ASV");

                if ($product->master == 'Y') // check if master product
                {
                    $product = $this->stock_model->get_sample($kode);

                    $url_rate  = 'https://apgroup.id/api/resource/Item?fields=["standard_rate"]&filters=[["Item","item_code","=","'.urlencode($product->kdbar).'"]]';
                    $url_stock = 'https://apgroup.id/api/resource/Bin?fields=["actual_qty"]&filters=[["Bin","item_code","=","'.urlencode($product->kdbar).'"],["Bin","warehouse","=","'.$wh.'"]]';
                }
                else
                {
                    $url_rate  = 'https://apgroup.id/api/resource/Item?fields=["standard_rate"]&filters=[["Item","item_code","=","'.urlencode($kode).'"]]';
                    $url_stock = 'https://apgroup.id/api/resource/Bin?fields=["actual_qty"]&filters=[["Bin","item_code","=","'.urlencode($kode).'"],["Bin","warehouse","=","'.$wh.'"]]';
                }

                // log_message('Debug', 'Warehouse: '.$wh);
                
                // get stock balance
                $ch = curl_init($url_stock);
                curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');

                curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                curl_setopt($ch,CURLOPT_COOKIEJAR, 'cookie.txt');
                curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');
                curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                curl_setopt($ch,CURLOPT_TIMEOUT, 5);

                $response = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($response);
                
                // die(print_r($result->data));		
                // log_message('Debug', '***URL: '.urlencode($url));
                // log_message('Debug', '***item_code: '.$product->kdbar);
                // log_message('Debug', '***warehouse: '.$wh);
                // log_message('Debug', '***API result: '.$result->data[0]->actual_qty);
                

                $hjual  = 0;
                $hjualf = '0';
                $stok   = 0;

                if (isset($result->data))
                {
                
                    if (sizeof($result->data) > 0)
                    {
                        $stok = $result->data[0]->actual_qty;
                    }
                    else
                    {
                        $stok = 0;
                    }
                    
                    // get price
                    $ch = curl_init($url_rate);
                    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'GET');
                    // CURLOPT_POST => 1,
                    curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
                    curl_setopt($ch,CURLOPT_COOKIEJAR, 'cookie.txt');
                    curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');
                    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch,CURLOPT_TIMEOUT, 5);

                    $response = curl_exec($ch);
                    curl_close($ch);
                    $result = json_decode($response); //data harga jual

                    if (sizeof($result->data) > 0)
                    {
                        $hjual  = $result->data[0]->standard_rate;
                        $hjualf = number_format($result->data[0]->standard_rate, 0, '.', ',');
                    }
                }


                $data = array(
                    'kdbar'     => $product->kdbar,
                    'kdurl'     => $product->kdurl,
                    'nama'      => $product->nama,
                    'deskripsi' => $product->deskripsi,
                    'hjual'     => $hjual,
                    'hjualf'    => $hjualf, //number_format($hjual, 0, '.', ','),
                    'gambar'    => $product->gambar,
                    'gambar2'   => $product->gambar2,
                    'gambar3'   => $product->gambar3,
                    'pnj'       => $product->pnj,
                    'lbr'       => $product->lbr,
                    'tgi'       => $product->tgi,
                    'berat'     => $product->berat,
                    'stok'      => $stok,
                );

                $this->set_response([ 'status' => TRUE, 'data' => $data], REST_Controller::HTTP_OK);
		// 		return;
		// 	}
		// }
        // $response = [
        //     'status'  => REST_Controller::HTTP_FORBIDDEN,
        //     'message' => 'Forbidden',
        // ];
        // $this->set_response($response, REST_Controller::HTTP_FORBIDDEN);
	}


    private function paging($total,$curr_page,$url){
        
        $page = '';
        $total_page = ceil($total/8);
        
        if($total > 8) { // hasil bagi atau jumlah halaman lebih dari satu
        
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
                
            $page .= '</ul>';
        }
            
        return $page;
    }
}