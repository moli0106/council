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
		$this->load->view($this->config->item('theme').'academic/hs_voc/course_catalogue_view',$data);
	}
	public function ag()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/hs_voc/ag_view',$data);
	}
	public function et()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/hs_voc/et_view',$data);
	}
	public function hs()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/hs_voc/hs_view',$data);
	}
	public function bc()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'academic/hs_voc/bc_view',$data);
	}
	
}
