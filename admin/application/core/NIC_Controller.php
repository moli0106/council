<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NIC_Controller extends CI_Controller {

    public $css_head = array();
    public $css_foot = array();
    public $js_head = array();
    public $js_foot = array();
    
	public function __construct(){
	    parent::__construct();
	    $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
	    $this->output->set_header("Pragma: no-cache");
	    $this->output->set_header("X-Frame-Options: SAMEORIGIN");
	    $this->output->set_header("X-Content-Type-Options: nosniff");
	    $this->output->set_header("X-XSS-Protection: 1; mode=block");
		$this->output->set_header("Referrer-Policy: same-origin");
		//$this->output->set_header("Content-Security-Policy: default-src 'self' 'unsafe-inline' 'unsafe-eval'; img-src 'self' data:; script-src 'self' 'unsafe-inline' 'unsafe-eval'; frame-src 'self' 'unsafe-inline' 'unsafe-eval'; object-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; connect-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:8080 https://wbkanyashree.gov.in; font-src 'self' 'unsafe-inline' 'unsafe-eval';");
	    $this->title = $this->config->item("title");
	}
	
	public function check_public(){
		if($this->session->userdata('login_id') != NULL){
			redirect('admin/dashboard', 'location');
		}
	}
	
	public function check_login(){
		if($this->session->userdata('login_id') == NULL){
			redirect('admin', 'location');
			die();
		}
	}
	
	public function check_privilege($privilege_id = NULL){
		
		$this->check_login();

		//Page visit log
		$this->load->model('common/page_visit_model');
		$this->page_visit_model->set();

		//generate privilege and menu
		$this->load->model('common/privilege_model');
		$this->menu = $this->privilege_model->stake_privilege();

		//check privilege
		if($privilege_id != NULL)
		{
			 $flag = 1;
			 foreach($this->menu as $key)
			 {
			 	if($key['council_privilege_id_pk'] == $privilege_id)
				{
			 		$flag = 0;
			 	}
			 }
			 if($flag == 1)
			 {
			 	show_404();
			 }
		}
	}

}
