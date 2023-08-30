<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(71);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/students_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/vtc.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->students_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        // echo "<pre>";print_r($data['vtcDetails']);
        // $data['vtcCourseList']  = $this->students_model->getVtcCourseList($data['vtc_id'], $data['academic_year']);  //Old

        //13-07-2022
        $data['vtcCourseList']  = $this->students_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']); //new
        // echo "<pre>";print_r($data['vtcCourseList']);
        // parent::pre($data['vtcDetails']);

        if (!empty($data['vtcCourseList'])) {

            // if (!empty($data['vtcCourseList']['hs_voc_courses'])) {
            //     $data['vtc_hs_courseList']  = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['hs_voc_courses']));
            // } else {
            //     $data['vtc_hs_courseList'] = array();
            // }
            // echo "<pre>";print_r($data['vtc_hs_courseList']);exit;

            // if (!empty($data['vtcCourseList']['stc_course'])) {
            //     $data['vtc_stc_courseList'] = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['stc_course']));
            // } else {
            //     $data['vtc_stc_courseList'] = array();
            // }

            $data['vtc_hs_courseList'] = array();
            $data['vtc_stc_courseList'] = array();

            foreach ($data['vtcCourseList'] as $key => $value) {
                if($value['course_name_id_fk'] == 1){

                    foreach ($value['group'] as $key1 => $group) {
                       
                        array_push($data['vtc_hs_courseList'], $group);
                    }
                }
                elseif($value['course_name_id_fk'] == 4){

                    foreach ($value['group'] as $key1 => $group) {
                       
                        array_push($data['vtc_stc_courseList'], $group);
                    }
                }
            }

           
            // echo "<pre>";print_r($data['vtc_hs_courseList']);exit;

            $data['vtc_courseList'] = array_merge($data['vtc_hs_courseList'], $data['vtc_stc_courseList']);

            $studentCountDetails = $this->students_model->getStudentCountDetails($data['vtc_id'], $data['academic_year']);

            // parent::pre([$data['vtc_hs_courseList'], $data['vtc_stc_courseList'], $studentCountDetails]);

            // echo "<pre>";print_r($studentCountDetails);exit;


            foreach ($data['vtc_hs_courseList'] as $key => $courseList) {
                if (!empty($studentCountDetails)) {
                    $data['hs_enrolled_student'][$key] = '';
                    foreach ($studentCountDetails as $key2 => $studentCount) {
                        if ($studentCount['course_id_fk'] == $courseList['group_id_fk']) {
                            $data['hs_enrolled_student'][$key] = $studentCountDetails[$key2]['enrolled_student'];
                        }
                    }
                } else {
                    $data['hs_enrolled_student'][$key] = NULL;
                }
            }
            // echo "<pre>";print_r($data['hs_enrolled_student']);exit;

            foreach ($data['vtc_stc_courseList'] as $key => $courseList) {
                if (!empty($studentCountDetails)) {

                    $data['stc_enrolled_student'][$key] = '';

                    foreach ($studentCountDetails as $key2 => $studentCount) {
                        if ($studentCount['course_id_fk'] == $courseList['group_id_fk']) {
                            $data['stc_enrolled_student'][$key] = $studentCountDetails[$key2]['enrolled_student'];
                        }
                    }
                } else {
                    $data['stc_enrolled_student'][$key] = NULL;
                }
            }

            $data['studentCountDetails'] = $studentCountDetails;
        }
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/student_view', $data);
    }

    public function add()
    {
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');
            $data['vtcDetails']     = $this->students_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
            // $data['vtcCourseList']  = $this->students_model->getVtcCourseList($data['vtc_id'], $data['academic_year']); //old

            //13-07-2022
            $data['vtcCourseList']  = $this->students_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']); //new


            $hs_enrolled_student  = $this->input->post('hs_enrolled_student');
            $stc_enrolled_student = $this->input->post('stc_enrolled_student');

            if (!empty($data['vtcCourseList'])) {

                // if (!empty($data['vtcCourseList']['hs_voc_courses'])) {
                //     $data['vtc_hs_courseList']  = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['hs_voc_courses']));
                // } else {
                //     $data['vtc_hs_courseList'] = array();
                // }

                // if (!empty($data['vtcCourseList']['stc_course'])) {
                //     $data['vtc_stc_courseList'] = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['stc_course']));
                // } else {
                //     $data['vtc_stc_courseList'] = array();
                // }

                $data['vtc_hs_courseList'] = array();
                $data['vtc_stc_courseList'] = array();

                foreach ($data['vtcCourseList'] as $key => $value) {
                    if($value['course_name_id_fk'] == 1){

                        foreach ($value['group'] as $key1 => $group) {
                        
                            array_push($data['vtc_hs_courseList'], $group);
                        }
                    }
                    elseif($value['course_name_id_fk'] == 4){

                        foreach ($value['group'] as $key1 => $group) {
                        
                            array_push($data['vtc_stc_courseList'], $group);
                        }
                    }
                }

                $data['vtc_courseList'] = array_merge($data['vtc_hs_courseList'], $data['vtc_stc_courseList']);
            }

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            foreach ($data['vtc_hs_courseList'] as $key => $courseList) {

                $data['hs_enrolled_student'][$key] = $this->input->post('hs_enrolled_student')[$key];

                $config = array(
                    array(
                        'field'     => 'hs_course_id[' . $key . ']',
                        'label'     => '<b>Course</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    ),
                    array(
                        'field'     => 'hs_enrolled_student[' . $key . ']',
                        'label'     => '<b>Enrolled Student</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    )
                );

                $this->form_validation->set_rules($config);
            }

            foreach ($data['vtc_stc_courseList'] as $key => $courseList) {

                $data['stc_enrolled_student'][$key] = $this->input->post('stc_enrolled_student')[$key];

                $config = array(
                    array(
                        'field'     => 'stc_course_id[' . $key . ']',
                        'label'     => '<b>Course</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    ),
                    array(
                        'field'     => 'stc_enrolled_student[' . $key . ']',
                        'label'     => '<b>Enrolled Student</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    )
                );

                $this->form_validation->set_rules($config);
            }

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/student_view', $data);
            } else {

                // $studentCountDetails = $this->students_model->getStudentCountDetails($data['vtc_id'], $data['academic_year']);
                // if(count($studentCountDetails)!=0){
                //     $this->students_model->updateStudentCountStatus($data['vtc_id'], $data['academic_year']);
                // }

                $insertArray = array();

                foreach ($data['vtc_hs_courseList'] as $key => $courseList) {
                    $tmpArray = array(
                        'vtc_id_fk'         => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk' => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'     => $data['academic_year'],
                        'selected_year'     => $this->input->post('running_year'),
                        // 'course_id_fk'      => $courseList['course_id_pk'],
                        'course_id_fk'      => $courseList['group_id_fk'],
                        'enrolled_student'  => $hs_enrolled_student[$key],
                        'entry_ip'          => $this->input->ip_address(),
                    );

                    array_push($insertArray, $tmpArray);
                }

                foreach ($data['vtc_stc_courseList'] as $key => $courseList) {
                    $tmpArray = array(
                        'vtc_id_fk'         => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk' => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'     => $data['academic_year'],
                        'selected_year'     => $this->input->post('running_year'),
                        // 'course_id_fk'      => $courseList['course_id_pk'],
                        'course_id_fk'      => $courseList['group_id_fk'],
                        'enrolled_student'  => $stc_enrolled_student[$key],
                        'entry_ip'          => $this->input->ip_address(),
                    );

                    array_push($insertArray, $tmpArray);
                }

                $result = $this->students_model->insertBatchStudentDetails($insertArray);

                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Student details added successfully.');

                    redirect('admin/affiliation/students');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/affiliation/students');
                }
            }
        } else {

            redirect('admin/affiliation/students');
        }
    }

    public function update()
    {
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');
            $data['vtcDetails']     = $this->students_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
            // $data['vtcCourseList']  = $this->students_model->getVtcCourseList($data['vtc_id'], $data['academic_year']); //old

            //13-07-2022
            $data['vtcCourseList']  = $this->students_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']); //new


            $hs_enrolled_student  = $this->input->post('hs_enrolled_student');
            $stc_enrolled_student = $this->input->post('stc_enrolled_student');

            if (!empty($data['vtcCourseList'])) {

                // if (!empty($data['vtcCourseList']['hs_voc_courses'])) {
                //     $data['vtc_hs_courseList']  = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['hs_voc_courses']));
                // } else {
                //     $data['vtc_hs_courseList'] = array();
                // }

                // if (!empty($data['vtcCourseList']['stc_course'])) {
                //     $data['vtc_stc_courseList'] = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['stc_course']));
                // } else {
                //     $data['vtc_stc_courseList'] = array();
                // }

                $data['vtc_hs_courseList'] = array();
                $data['vtc_stc_courseList'] = array();
    
                foreach ($data['vtcCourseList'] as $key => $value) {
                    if($value['course_name_id_fk'] == 1){
    
                        foreach ($value['group'] as $key1 => $group) {
                           
                            array_push($data['vtc_hs_courseList'], $group);
                        }
                    }
                    elseif($value['course_name_id_fk'] == 4){
    
                        foreach ($value['group'] as $key1 => $group) {
                           
                            array_push($data['vtc_stc_courseList'], $group);
                        }
                    }
                }

                $data['vtc_courseList'] = array_merge($data['vtc_hs_courseList'], $data['vtc_stc_courseList']);
            }

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            foreach ($data['vtc_hs_courseList'] as $key => $courseList) {

                $data['hs_enrolled_student'][$key] = $this->input->post('hs_enrolled_student')[$key];

                $config = array(
                    array(
                        'field'     => 'hs_course_id[' . $key . ']',
                        'label'     => '<b>Course</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    ),
                    array(
                        'field'     => 'hs_enrolled_student[' . $key . ']',
                        'label'     => '<b>Enrolled Student</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    )
                );

                $this->form_validation->set_rules($config);
            }

            foreach ($data['vtc_stc_courseList'] as $key => $courseList) {

                $data['stc_enrolled_student'][$key] = $this->input->post('stc_enrolled_student')[$key];

                $config = array(
                    array(
                        'field'     => 'stc_course_id[' . $key . ']',
                        'label'     => '<b>Course</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    ),
                    array(
                        'field'     => 'stc_enrolled_student[' . $key . ']',
                        'label'     => '<b>Enrolled Student</b>',
                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                    )
                );

                $this->form_validation->set_rules($config);
            }

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/student_view', $data);
            } else {

                foreach ($data['vtc_hs_courseList'] as $key => $courseList) {
                    $tmpArray = array(
                        'vtc_id_fk'         => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk' => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'     => $data['academic_year'],
                        'selected_year'     => $this->input->post('running_year'),
                        // 'course_id_fk'      => $courseList['course_id_pk'],
                        'course_id_fk'      => $courseList['group_id_fk'],
                        'enrolled_student'  => $hs_enrolled_student[$key],
                        'entry_ip'          => $this->input->ip_address(),
                    );
                    // echo "<pre>";print_r($tmpArray);exit;

                    $result = $this->students_model->updateStudentDetails($tmpArray);
                }

                foreach ($data['vtc_stc_courseList'] as $key => $courseList) {
                    $tmpArray = array(
                        'vtc_id_fk'         => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk' => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'     => $data['academic_year'],
                        'selected_year'     => $this->input->post('running_year'),
                        // 'course_id_fk'      => $courseList['course_id_pk'],
                        'course_id_fk'      => $courseList['group_id_fk'],
                        'enrolled_student'  => $stc_enrolled_student[$key],
                        'entry_ip'          => $this->input->ip_address(),
                    );

                    $result = $this->students_model->updateStudentDetails($tmpArray);
                }

                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Student details updated successfully.');

                redirect('admin/affiliation/students');
            }
        } else {

            redirect('admin/affiliation/students');
        }
    }

    public function old_details(){
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->students_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['vtcCourseList']  = $this->students_model->getVtcCourseList($data['vtc_id'], $data['academic_year']);  //Old

        

        // parent::pre($data['vtcDetails']);

        if (!empty($data['vtcCourseList'])) {

            if (!empty($data['vtcCourseList']['hs_voc_courses'])) {
                $data['vtc_hs_courseList']  = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['hs_voc_courses']));
            } else {
                $data['vtc_hs_courseList'] = array();
            }
            

            if (!empty($data['vtcCourseList']['stc_course'])) {
                $data['vtc_stc_courseList'] = $this->students_model->getCourseWhereIdIn(explode(',', $data['vtcCourseList']['stc_course']));
            } else {
                $data['vtc_stc_courseList'] = array();
            }

           

           
            // echo "<pre>";print_r($data['vtc_hs_courseList']);exit;

            $data['vtc_courseList'] = array_merge($data['vtc_hs_courseList'], $data['vtc_stc_courseList']);

            $studentCountDetails = $this->students_model->getStudentCountDetails_old($data['vtc_id'], $data['academic_year']);

            // parent::pre([$data['vtc_hs_courseList'], $data['vtc_stc_courseList'], $studentCountDetails]);

            

            foreach ($data['vtc_hs_courseList'] as $key => $courseList) {
                if (!empty($studentCountDetails)) {
                    $data['hs_enrolled_student'][$key] = '';
                    foreach ($studentCountDetails as $key2 => $studentCount) {
                        if ($studentCount['course_id_fk'] == $courseList['course_id_pk']) {
                            $data['hs_enrolled_student'][$key] = $studentCountDetails[$key2]['enrolled_student'];
                        }
                    }
                } else {
                    $data['hs_enrolled_student'][$key] = NULL;
                }
            }
            // echo "<pre>";print_r($data['hs_enrolled_student']);exit;

            foreach ($data['vtc_stc_courseList'] as $key => $courseList) {
                if (!empty($studentCountDetails)) {

                    $data['stc_enrolled_student'][$key] = '';

                    foreach ($studentCountDetails as $key2 => $studentCount) {
                        if ($studentCount['course_id_fk'] == $courseList['course_id_pk']) {
                            $data['stc_enrolled_student'][$key] = $studentCountDetails[$key2]['enrolled_student'];
                        }
                    }
                } else {
                    $data['stc_enrolled_student'][$key] = NULL;
                }
            }

            $data['studentCountDetails'] = $studentCountDetails;
        }
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/student_view_old', $data);
    
    }
}
