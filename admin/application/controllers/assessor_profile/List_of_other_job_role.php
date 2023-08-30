<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class List_of_other_job_role extends NIC_Controller 
{
	public function __construct(){
		
		parent::__construct();
		parent::check_privilege(18);
		
		$this->load->model('assessor_profile/list_of_other_job_role_model');
		//$this->output->enable_profiler(TRUE);
		$this->css_head = array(
			//1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			//2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
			//3 => $this->config->item('theme_uri').'finance/css/style.css'
		);
		$this->js_foot = array(
			//1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			//2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			//3 => $this->config->item('theme_uri').'assessor_profile/js/assessor_reg.js',
			//4 => $this->config->item('theme_uri').'js/moment.js',
			//5 => $this->config->item('theme_uri').'jQuery.print.min.js',  // added parag 12-01-2021
		);
		//$this->load->helper('email');
        //$this->load->library('sms');

		$this->title = "List of other Job Roles";
	}
    public function index(){
        $data["applications"] = $this->list_of_other_job_role_model->get_applications();

        //print_r($data["applications"]);
        //echo "List of other job roles";
        $this->load->view($this->config->item('theme').'assessor_profile/list_of_other_jobroles_view',$data);
    }

    public function new_view_details($assessor_registration_application_no = NULL){

        $this->load->model('assessor_profile/Assessor_registration_add_more_model',"assessor_registration_model");

     	//$this->output->enable_profiler();
		//$data['offset'] = "";
		$assessor_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		//added parag 12-01-2021
		$this->load->model('council/new_assessor_list_model','assessor_list_model');
		
		//added parag 12-01-2021
		//$data['vtc_pbssd'] = $this->assessor_list_model->get_vtc_pbssd($assessor_id_hash);
		$data['ssc_certificates'] = $this->assessor_registration_model->get_ssc_wbsctvesed_certificate($assessor_registration_application_no,$this->session->userdata('stake_details_id_fk'));
		//print_r($data['certificates']);
        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles($assessor_id_hash,$assessor_registration_application_no);
        $data['certificates'] = $this->assessor_list_model->get_certificates($assessor_id_hash,$assessor_registration_application_no);
        $data['get_work_exps'] = $this->assessor_list_model->get_work_exp($assessor_id_hash,$assessor_registration_application_no);
        $data['get_assessor_experts'] = $this->assessor_list_model->get_assessor_expert($assessor_id_hash,$assessor_registration_application_no);
		$data["docs"] = $this->assessor_registration_model->get_assessor_document($assessor_registration_application_no, $this->session->userdata('stake_details_id_fk'));
        //echo "<pre>";
        //print_r($data['jobroles']);
        //echo "</pre>";
        // echo "<pre>";
        // print_r($data['get_asse_exps']);
        // echo "</pre>";
        $this->load->view($this->config->item('theme').'council/new_assessor_details_profile_view',$data);
	}
} 
