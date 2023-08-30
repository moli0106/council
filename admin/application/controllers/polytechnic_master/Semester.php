<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(177);
        $this->load->model('polytechnic_master/subject_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri')."polytechnic_master/subject.js"
        );
		
    } 
    public function index(){

        $data['semester'] = $this->subject_model->get_all_semester();
        $this->load->view($this->config->item('theme').'polytechnic_master/semester_view',$data);

    }
}
?>