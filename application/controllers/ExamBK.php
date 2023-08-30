<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Exam extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function hs_voc_academic_callender()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'exam/hs_voc_academic_callender_view',$data);
	}
	public function class_x_vse_academic_callender()
	{
		$data['data'] ='';
		//$this->load->view($this->config->item('theme').'exam/class_x_vse_academic_callender_view',$data);
		$this->load->view($this->config->item('theme').'coming_soon_view',$data);
	}
	public function class_viii_x_stc_academic_callender()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'exam/class_viii_x_stc_academic_callender_view',$data);
	}
	public function nqr_academic_callender()
	{
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'exam/nqr_academic_callender_view',$data);
	}
	public function class_xiii_vhse_academic_callender()
	{
		$data['data'] ='';
		//$this->load->view($this->config->item('theme').'exam/class_x_vse_academic_callender_view',$data);
		$this->load->view($this->config->item('theme').'coming_soon_view',$data);
	}
	public function stvt_academic_callender()
	{
		$data['data'] ='';
		//$this->load->view($this->config->item('theme').'exam/class_x_vse_academic_callender_view',$data);
		$this->load->view($this->config->item('theme').'coming_soon_view',$data);
	}

	public function polytechnic_callender()
	{
		$data['data'] ='';
		//$this->load->view($this->config->item('theme').'exam/class_x_vse_academic_callender_view',$data);
		$this->load->view($this->config->item('theme').'exam/polytechnic_callender_view',$data);
	}
	
	
}
