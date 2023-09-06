<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Student_list extends NIC_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('student_transfer/student_model');
		$this->load->model('institute_student/student_list_model');
		//$this->output->enable_profiler(TRUE);

		$this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'student_transfer/student.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            4 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			5 => $this->config->item('theme_uri').'jQuery.print.min.js'
        );
	}


	public function index(){
		$ins_id=$this->session->userdata('stake_details_id_fk');
        $data['result']=$this->student_model->getStudentList($ins_id);
		$this->load->view($this->config->item('theme').'student_transfer/student_list_view.php',$data);
	}

	public function showApproveRejectModal($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_model->getStudentDetailsById($id_hash);
                

                //echo "<pre>";print_r($data);die;

                $html_view = $this->load->view($this->config->item('theme') . 'student_transfer/ajax/student_approve_reject_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }


    public function updateStudentApproveRejectStatus(){
        
       
        if ($this->input->server('REQUEST_METHOD') == "POST") {
           
          //echo "hii";die;  
            $status = $this->input->post('status');
            $remarks = $this->input->post('remarks');
            $std_id_hash = $this->input->post('std_id_hash');
            $data['student_data'] = $this->student_model->getStudentDetailsById($std_id_hash);
            if($status == 0){
                $updArray = array(
                    'transfer_verify_status'  => 0, //reject
                    'transfer_reject_note'     => $remarks,
                    'transfer_verify_reject_time'   => 'now()',
                    'transfer_institute_id_fk' => $data['student_data']['institute_id'],
                    'transfer_discipline_id_fk' => $data['student_data']['discipline_id_fk']
                );

                 //echo "<pre>";print_r($updArray);exit;

                $rejectStatus = $this->student_list_model->updateStudentData($std_id_hash,$updArray);

                

                if ($rejectStatus) {

                    

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Student successfully rejected.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/student_transfer/student_list'));

            }elseif ($status == 1) {

                $updArray = array(
                    'transfer_verify_status'  => 1,
                    
                    'transfer_verify_reject_time'   => 'now()',
                    'transfer_institute_id_fk' => $data['student_data']['institute_id'],
                    'transfer_discipline_id_fk' => $data['student_data']['discipline_id_fk']
                );

                // echo "<pre>";print_r($updArray);exit;

                $approveStatus = $this->student_list_model->updateStudentData($std_id_hash,$updArray);

                

                if ($approveStatus) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Institution successfully verified.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/student_transfer/student_list'));
            }
        }
    }

    public function getRejectNote($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_model->getStudentDetailsById($id_hash);

                // echo "<pre>";print_r($data['student_data']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'institute_student/ajax/student_rejected_note_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }


    public function verify_student(){
		$ins_id=$this->session->userdata('stake_details_id_fk');
        $data['result']=$this->student_model->getTransferVerifyStudentList($ins_id);
		$this->load->view($this->config->item('theme').'student_transfer/verify_student_list_view.php',$data);
	}

    public function admit_transfer_student($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_model->getStudentDetailsById($id_hash);

                    // echo "<pre>";print_r($data['student_data']);exit;
                    //echo "<pre>";print_r($transfer_institute_intake);exit;

                if($data['student_data']['transfer_verify_status'] !=1){
                    $updArray = array(  
                        'transfer_admitted_status'  => 1,
                        
                        'transfer_admitted_time'   => 'now()',
                        'institute_id_fk' => $data['student_data']['transfer_institute_id_fk'],
                        'course_id_fk' => $data['student_data']['transfer_discipline_id_fk'],
                        'old_institute_id_fk' => $data['student_data']['institute_id_fk'],
                        'old_discipline_id_fk' => $data['student_data']['course_id_fk']
                    );
                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction
                    $approveStatus = $this->student_list_model->updateStudentData($id_hash,$updArray);

                    //  !!----------------Update New 
                    //    Institute Intake----------------
                    //---------- !!
                    $transfer_institute_intake = $this->student_model->get_available_intake($data['student_data']['transfer_institute_id_fk'],$data['student_data']['transfer_discipline_id_fk']);
                    $intake_upd = array(
                        'final_intake' => $transfer_institute_intake['available_intake'] - 1,
                        'minus_intake' => $transfer_institute_intake['minus_intake'] + 1,
                        'add_intake' => $transfer_institute_intake['add_intake']
                    );
                    //echo "<pre>";print_r($intake_upd);exit;
                    $this->student_model->updateIntakeData($transfer_institute_intake['intake_id_pk'],$intake_upd);

                    //  !!----------------Update Old 
                    //    Institute Intake----------------
                    //---------- !!
                    $old_institute_intake = $this->student_model->get_available_intake($data['student_data']['institute_id_fk'],$data['student_data']['course_id_fk']);

                    $intake_upd1 = array(
                        'final_intake' => $old_institute_intake['available_intake'] + 1,
                        'minus_intake' => $old_institute_intake['minus_intake'],
                        'add_intake' => $old_institute_intake['add_intake']+1
                    );
                    //echo "<pre>";print_r($intake_upd1);exit;
                    $this->student_model->updateIntakeData($old_institute_intake['intake_id_pk'],$intake_upd1);

                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        echo json_encode('not done');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        echo json_encode('done');
                    }

                    //echo json_encode('done');
                }
            }
        }
    }


}