<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Batch_declaration extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(140);
        $this->load->model('vtc_student/student_reg_model');

        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/batch_declare.js',

           
            3 => $this->config->item('theme_uri').'jQuery.print.min.js'
        );
    }

    public function index(){

        $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        //$data['academic_year'] = '2022-23';
        $data['vtcDetails'] = $this->student_reg_model->getVtcDetails($data['school_reg_id_pk'], $data['academic_year']);

        $data['batch'] = $this->student_reg_model->get_batch_details($data['school_reg_id_pk'],$data['academic_year']);

        $this->load->view($this->config->item('theme') . 'vtc_student/batch_declare/batch_declare_list_view',$data);

    }

    public function add(){

        $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        //$data['academic_year'] = '2022-23';
        $data['vtcDetails'] = $this->student_reg_model->getVtcDetails($data['school_reg_id_pk'], $data['academic_year']);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            // Set Group Value
            $course_name_id = $this->input->post('course_name_id');

            $vtc_code = $this->input->post('vtcCode');
            if(!empty($course_name_id)){

                $data['group'] = $this->student_reg_model->getGroupByVTCCode($course_name_id,$vtc_code, $data['academic_year']);
            }

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'current_year',
                    'label' => 'Affiliation Year',
                    'rules' => 'trim|required',
                    
                ),
                array('field' => 'course_name_id','label' => 'Course Name','rules' => 'trim|required'),

                array('field' => 'group_id','label' => 'Group /Trade Name','rules' => 'trim|required'),

                array('field' => 'batch_start_date','label' => 'Batch Start Date','rules' => 'trim|required'),

                array('field' => 'batch_end_date','label' => 'Batch End Date','rules' => 'trim|required')
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'vtc_student/batch_declare/batch_declare_view',$data);
            } else {

                $group_id = $this->input->post('group_id');

                //check student exist or not for academic year 2022-23
                $student = $this->student_reg_model->checkStudentByGroupId($data['school_reg_id_pk'],$data['academic_year'],$group_id);
                //echo "<pre>";print_r($student);exit;
                //Check previous Batch exist or not
                $batch_no = $this->student_reg_model->checkVTCBatch($data['school_reg_id_pk'],$data['academic_year'],$group_id);
                //echo "<pre>";print_r($batch_no);exit;
                //echo $batch_no['batch_create_status'];die;
                $tmp_date = explode('/', $this->input->post('batch_start_date'));
                $tmp_date1 = explode('/', $this->input->post('batch_end_date'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");

                $end_date = date_create($tmp_date1[2] . '-' . $tmp_date1[1] . '-' . $tmp_date1[0]);
                $end_date = date_format($end_date, "Y-m-d");

                $batch_array = array(
                    'vtc_id_fk' => $data['school_reg_id_pk'],
                    'vtc_code'=> $vtc_code,
                    'academic_year' => $data['academic_year'],
                    'group_id_fk' => $group_id,
                    'active_status' => 1,
                    'batch_created_date' => 'now()',
                    'batch_start_date' => $date,
                    'batch_end_date' => $end_date,
                    'class_id_fk'   => $this->input->post('course_name_id')
                );
                if ($data['academic_year'] == '2022-23' && empty($batch_no) && empty($student)) {
                    
                    $batch_array['batch_no'] = 1;
                }elseif ($data['academic_year'] == '2022-23' && empty($batch_no) && !empty($student)) {
                    
                    $batch_array['batch_no'] = 2;
                }
                elseif ($data['academic_year'] != '2022-23' && empty($batch_no)) {
                    
                    $batch_array['batch_no'] = 1;
                }elseif (!empty($batch_no)) {
                   
                    $batch_array['batch_no'] = $batch_no[0]['batch_no'] + 1;
                }
               
                if((empty($batch_no)) || ($batch_no[0]['reg_certificate_status'] == 1)){
                   $status =  $this->student_reg_model->insert_batch($batch_array);
                    if($status){
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Batch Declaration has been added successfully.');
                        redirect('admin/vtc_student/batch_declaration');
                    }else{
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add Batch at this time, Please try later.');

                        redirect('admin/vtc_student/batch_declaration/add');
                    }
                }elseif ($batch_no[0]['reg_certificate_status'] != 1) {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Previous Batch not complete yet.');
                    redirect('admin/vtc_student/batch_declaration');
                }
                
            }

        }else{

            $this->load->view($this->config->item('theme') . 'vtc_student/batch_declare/batch_declare_view',$data);
        }

    }


    public function getGroupName($course_name_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $vtc_code = $this->input->get('vtc_code');
            $academic_year  = $this->config->item('current_academic_year');
            //$academic_year = '2022-23';

            if($course_name_id !='' && $vtc_code !=''){

                $html        = '<option value="" hidden="true">Select Group/Trade Name</option>';
                $group = $this->student_reg_model->getGroupByVTCCode($course_name_id,$vtc_code, $academic_year);

                if (!empty($group)) {

                    foreach ($group as $key => $value) {
                        $html .= '
                                <option value="' . $value['group_id_pk'] . '">
                                    ' . $value['group_name'] . '
                                </option>
                            ';
                    }
                    echo json_encode($html);
                } else {

                    $html .= '<option value="" disabled="true">No Data found.</option>';
                    echo json_encode($html);
                }
            }

            
        }
    }
}
?>