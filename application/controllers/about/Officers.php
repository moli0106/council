<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Officers extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'about/officers_view',$data);
	}
	
}
