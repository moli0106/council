<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo_qr extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		
	}
	public function index(){
		$this->load->view($this->config->item('theme') . 'demo_qr_view');
	}
	
	public function qrcode($qr_code = NULL)
	{
		$this->load->library('ciqrcode');
		//print("jjjjjjj");

		header("Content-Type: image/png");
		$params['data'] = $qr_code;
		$this->ciqrcode->generate($params);
		
		//$params['data'] = 'This is a text to encode become QR Code';
		//$params['level'] = 'H';
		//$params['size'] = 10;
		//$params['savename'] = FCPATH.'tes.png';
		//$this->ciqrcode->generate($params);
		//echo '<img src="'.base_url().'tes.png" />';
	}
}
