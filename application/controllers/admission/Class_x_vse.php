<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Class_x_vse extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'admission/class_x_vse_view.php',$data);
	}
	
}
