<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_student extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(140);
        $this->load->model('vtc_student/register_student_model');

        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css'
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/student_reg.js',

            3 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
            5 => $this->config->item('theme_uri').'jQuery.print.min.js'
        );
    

        //$this->load->library('Sbi_biller_utils/biller_security_util');
    }

    public function index(){

        // $this->session->userdata('client_ip');

        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');

        // add on 14-03-2023
        $data['vtc_details'] = $this->register_student_model->getVtcDetails($data['vtc_id_fk'], $data['academic_year']);
        //echo "<pre>";print_r($data['vtc_details']);exit;

        

        $data['stdByGroup'] = $this->register_student_model->getGroupByVTCId($data['vtc_id_fk'] , $data['academic_year']);
        

        //echo "<pre>";print_r($data['stdByGroup']);exit;
        $this->load->view($this->config->item('theme') . 'vtc_student/register_student/vtc_group_view', $data);
    }

    public function group_wise_student_list($group_id=NULL,$batch=NULL){
       
        $data['offset']=0;
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->register_student_model->getVtcDetails($data['vtc_id_fk'], $data['academic_year']);
        //echo "<pre>";print_r($data['vtcDetails']);exit;
        $data['std_list'] = $this->register_student_model->get_std_listByGroup($data['vtc_id_fk'],$group_id,$batch); //Modify by Moli on 06-06-2023
        $data['group'] = $this->register_student_model->get_group_details($group_id);
        //echo "<pre>";print_r($data['std_list']);exit;
        if(!empty($data)){
            $this->load->view($this->config->item('theme') . 'vtc_student/student/group_wise_student_view', $data);
        }
    }
}