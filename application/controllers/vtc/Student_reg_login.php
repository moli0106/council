<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Student_reg_login extends NIC_Controller {
    function __construct()
	{
		
		parent::__construct();
		
        $this->title = 'Councils ' . $this->title;
        // $this->load->model("vtc/student_reg_model");
        // $this->load->model('online_app/inst/vtc/affiliation_model');
        
        
        $this->css_head = array(
            1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri').'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
            3  => $this->config->item('theme_uri').'councils/css/autocomplete-jquery-ui.css',
        );
		
		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'councils/js/datepicker.js',
            2  => $this->config->item('theme_uri').'councils/js/custom/vtc/student_reg.js',
            3  => $this->config->item('theme_uri').'councils/js/select2.full.min.js',
            4  => $this->config->item('theme_uri').'councils/js/autocomplete-jquery-ui.min.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
        
    }

   public function index()
   {
    $this->load->view($this->config->item('theme') . 'vtc/student_reg_login_view');
   }    
}