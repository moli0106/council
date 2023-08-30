<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege();
		$this->load->model('Dashboard_model');
		//$this->output->enable_profiler(TRUE);
	}
	public function index()
	{
		$stake_id = $this->session->userdata('stake_id_fk');
		
		
		if($stake_id == 2) 
		{ 
			$data['stake_name'] 		= "Admin";
			
		}elseif($stake_id == 3){
			$data['stake_name'] 		= "Assessor";
		
		}
		elseif($stake_id == 4){
			$data['stake_name'] 		= "Sub-Admin";
		
		}
		
		$this->load->view($this->config->item('theme').'council_dashboard_view', $data);
		
	}


}
