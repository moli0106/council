<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Client_ip extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
        $response_ip = $this->input->get('ip');
        $this->session->set_userdata('client_ip', $response_ip);
        // echo $this->session->userdata('client_ip');exit;
	}
	
}