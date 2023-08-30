<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class course_catalogue extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/stvt/course_catalogue_view',$data);
	}

	public function et(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/stvt/et_view',$data);
	}

	public function hs(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/stvt/hs_view',$data);
	}

	public function bc(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/stvt/bc_view',$data);
	}
	
}
