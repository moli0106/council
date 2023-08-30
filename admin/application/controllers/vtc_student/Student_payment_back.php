<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_payment extends NIC_Controller
{
    function __construct()
    {
		
	   parent::__construct();
	   
        parent::check_privilege(148);

        $this->load->model('vtc_student/student_payment_model');
		
        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/student_payment.js',

            
        );
		

        
    }

    public function index(){
		
        // $this->session->userdata('client_ip');
		
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
		         
        $data['stdByGroup'] = $this->student_payment_model->getStdCountByGroup($data['vtc_id_fk'] , $data['academic_year']);
		//echo "<pre>";print_r($data);exit;

        $this->load->view($this->config->item('theme') . 'vtc_student/student/student_payment_view', $data);
    }


    public function groupWiseStdRequest($group_id = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if($group_id != NULL){
                $std_no = $this->input->get('std_no');

                $vtc_id_fk =  $this->session->userdata('stake_details_id_fk');
                $academic_year = $this->config->item('current_academic_year'); 

                $rquest_array = array(
                    'vtc_id_fk' =>      $vtc_id_fk,
                    'academic_year'     => $academic_year,
                    'group_id_fk'       => $group_id,
                    'no_of_student'     => $std_no,
                    'approve_status'    => 0,
                    'requested_time'    => 'now()',
                    'requested_ip'      => $this->input->ip_address()
                );
                echo "<pre>";print_r($rquest_array);exit;
                // $request_id = $this->student_payment_model->insertData('council_vtc_requested_student_details', $rquest_array);
                // echo $request_id;
            }

        }
    }

    public function groupWiseStdPayment($group_id = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($group_id !=NULL){
                $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
                $data['academic_year'] = $this->config->item('current_academic_year');

                $getStudent = $this->student_payment_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);

                //Insert Payment Details
                $payment_details = array(
                    'created_date' => 'mow()',
                    'payment_for' =>  'vtc student'
                );
                //$payment_details_id = $this->student_payment_model->insertData('council_payment_details', $payment_details);


                $std_id = array();
                if(!empty($getStudent)){
                    
                    foreach ($getStudent as $key => $value) {
                        array_push($std_id, $value['student_id_pk']);
                    }

                    
                }
                // echo "<pre>";print_r($std_id);
                // echo implode(",",$std_id);
                // exit;

                //Insert Lot Table
                $paymentLotData = array(
                    'payment_details_id_fk' => $payment_details_id,
                    'group_id_fk'       =>  $group_id,
                    'student_id_fk'     => implode(",",$std_id),
                    'vtc_id_fk'         => $data['vtc_id_fk'],
                    'academic_year'     => $data['academic_year']
                );

                // update Student Table
                $update_std_data = array(
                    'payment_status' => 'yes',
                    'payment_date'   => 'now()'
                );
                
                
            }
        }

    }

    public function generateStdRegNo($group_id = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($group_id !=NULL){
                $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
                $data['academic_year'] = $this->config->item('current_academic_year');

                $getStudent = $this->student_payment_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);
                if(!empty($getStudent)){
                    // echo "<pre>";print_r($getStudent);exit;

                    foreach ($getStudent as $key => $value) {
                        if($value['class_id_fk'] == 4){
                            
                        }

                    }
                }
            }
        }
    }


    


    public function proceed_to_pay(){
       //echo "<pre>";print_r($_POST);
       $group_id = $_POST['group_id'];
       $data['total_std'] = $_POST['std_no'];
       $data['group_details'] = $this->student_payment_model->getGroupDetailsById($group_id);
        //    echo "<pre>";print_r($data['group_details']);
        if(!empty($data['group_details'])){

            $this->load->view($this->config->item('theme') . 'vtc_student/student/payment_proceed_view', $data);
        }else{
            redirect('admin/vtc_student/student_payment');

        }
    }


    

    
}