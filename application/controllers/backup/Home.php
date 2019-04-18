<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_Controller {

	public function __construct()
	{
		parent::__construct();

		// Get cURL resource
		$ch = curl_init('https://apgroup.id/api/method/login');

		curl_setopt($ch,CURLOPT_POST, true);
		// curl_setopt($ch,CURLOPT_POSTFIELDS, array('usr' => 'aswin@ask.c', 'pwd' => 'askitchen123'));
		curl_setopt($ch,CURLOPT_POSTFIELDS, array('usr' => 'administrator', 'pwd' => 'askitchen123'));
		curl_setopt($ch,CURLOPT_CUSTOMREQUEST, 'POST');
		// common description bellow
		curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch,CURLOPT_COOKIEJAR, 'cookie.txt');
		curl_setopt($ch,CURLOPT_COOKIEFILE, 'cookie.txt');
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_TIMEOUT, 5);

		// Send the request & save response to $resp
		$resp = curl_exec($ch);
		// Close request to clear up some resources
		curl_close($ch);
		// die($resp);		
	}


	public function index()
	{
		$this->load->view('layout/header', $this->data);
		$this->load->view('dashboard/index', $this->data);
		$this->load->view('layout/footer', $this->data);
	}
}

