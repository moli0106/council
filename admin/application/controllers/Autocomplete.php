<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Autocomplete extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        // parent::check_privilege(140);
        $this->load->model('vtc_student/student_reg_model');

        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/student_reg.js',

            3 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
        );
    }

    public function index(){

        
        $this->load->view($this->config->item('theme') . 'autocomplete');
    }

    public function getsublist(){
        $sub = $this->input->get('sub');
        $query = "SELECT subject_name ,subject_code FROM council_affiliation_subject_master WHERE  subject_name ilike '%".$sub."%' and active_status = 1 ";
        $cart = array();
        $res = $this->db->query($query);
        $arrData = $res->result_array();
        // for($i=0;$i<=count($arrData);$i++){
        //     $cart[] = $arrData[$i]['subject_name'];  
        // }
        $cart= array();
        foreach ($arrData as $key => $val){
            // $data['id'] =$val['subject_code'];
            // $data['value'] =$val['subject_name'];
            // array_push($cart , $data);
            array_push($cart , $val['subject_name'].','.'('.$val['subject_code'].')');
        }
                    
            echo json_encode($cart);
    }

    
}