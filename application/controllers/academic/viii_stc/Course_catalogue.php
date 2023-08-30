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
		$this->load->view($this->config->item('theme').'academic/viii_stc/course_catalogue_view',$data);
	}
	
	public function et(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/viii_stc/et_view',$data);
	}
	public function ag(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/viii_stc/ag_view',$data);
	}
	public function hs(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/viii_stc/hs_view',$data);
	}
	public function bc(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/viii_stc/bc_view',$data);
	}
	public function pm(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/viii_stc/pm_view',$data);
	}

	
}
