<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_list extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();

        parent::check_privilege(158);
        $this->load->model('institute_student/student_list_model');

        $this->load->helper('email');
        $this->load->library('sms');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'institute_student/student.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index( $offset = 0){
       
        $data['offset']         = $offset;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        $config['base_url']         = 'institute_student/Student_list/index/';
        $data["total_rows"] = $config['total_rows']       = $this->student_list_model->get_student_count()[0]['count'];
        $config['per_page']         = 50;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open']    = '<li class="">';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '<i class="fa fa-backward"></i>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fa fa-forward"></i>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $data['page_links']     = $this->pagination->create_links();



        $data['student_data_list'] = $this->student_list_model->getInsStudentList($config['per_page'],$offset);
        //echo '<pre>'; print_r($data) ; die;

        $this->load->view($this->config->item('theme') . 'institute_student/student_list_view', $data);
    }

    public function showApproveRejectModal($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_list_model->getStudentDetailsById($id_hash);

                // echo "<pre>";print_r($data['student_data']);

                $html_view = $this->load->view($this->config->item('theme') . 'institute_student/ajax/student_approve_reject_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    public function updateStudentApproveRejectStatus(){
        
       
        if ($this->input->server('REQUEST_METHOD') == "POST") {
           
            
            $status = $this->input->post('status');
            $remarks = $this->input->post('remarks');
            $std_id_hash = $this->input->post('std_id_hash');
            $data['student_data'] = $this->student_list_model->getStudentDetailsById($std_id_hash);
            if($status == 0){
                $updArray = array(
                    'approve_reject_status'  => 0,
                    'reject_note'     => $remarks,
                    //'approve_reject_time'   => 'now()',
                );

                // echo "<pre>";print_r($updArray);exit;

                $rejectStatus = $this->student_list_model->updateStudentData($std_id_hash,$updArray);

                

                if ($rejectStatus) {

                    

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Student successfully rejected.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/institute_student/student_list'));

            }elseif ($status == 1) {

                $updArray = array(
                    'approve_reject_status'  => 1,
                    //'management_quota'     => $this->input->post('management_quota'),
                    //'approve_reject_time'   => 'now()',
                );

                // echo "<pre>";print_r($updArray);exit;

                $approveStatus = $this->student_list_model->updateStudentData($std_id_hash,$updArray);

                

                if ($approveStatus) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'VTC successfully approved.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/institute_student/student_list'));
            }
        }
    }

    public function getRejectNote($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_list_model->getStudentDetailsById($id_hash);

                // echo "<pre>";print_r($data['student_data']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'institute_student/ajax/student_rejected_note_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }
}
?>