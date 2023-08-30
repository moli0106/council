<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finalsubmit extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(71);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/finalsubmit_model');

        $this->load->model('affiliation/teachers_model'); //Added by moli

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/vtc.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",

            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
        );
    }

    public function index()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->finalsubmit_model->getVtcDetails(md5($data['vtc_id']), $data['academic_year']);


        //OLD Course
        // $data['vtcCourseList']  = $this->finalsubmit_model->getVtcCourseList($data['vtc_id'], $data['academic_year']);

        // if (!empty($data['vtcCourseList'])) {

        //     if (!empty($data['vtcCourseList']['hs_voc_discipline'])) {
        //         $data['vtcCourseList']['hs_voc_discipline'] = explode(',', $data['vtcCourseList']['hs_voc_discipline']);
        //         $data['vtcCourseList']['hs_voc_courses']    = explode(',', $data['vtcCourseList']['hs_voc_courses']);

        //         $data['hsDiscipline']  = $this->finalsubmit_model->getDisciplineById($data['vtcCourseList']['hs_voc_discipline']);
        //         $data['hsCourseList']  = $this->finalsubmit_model->getCourseListById($data['vtcCourseList']['hs_voc_courses']);
        //     }

        //     if (!empty($data['vtcCourseList']['stc_discipline'])) {
        //         $data['vtcCourseList']['stc_discipline']    = explode(',', $data['vtcCourseList']['stc_discipline']);
        //         $data['vtcCourseList']['stc_course']        = explode(',', $data['vtcCourseList']['stc_course']);

        //         $data['stcDiscipline'] = $this->finalsubmit_model->getDisciplineById($data['vtcCourseList']['stc_discipline']);
        //         $data['stcCourseList'] = $this->finalsubmit_model->getCourseListById($data['vtcCourseList']['stc_course']);
        //     }
        // }

        // Added by moli on 20-06-2022

        $data['vtcCourseList']  = $this->finalsubmit_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']);


        $group_id = array();
        $course_name_id_fk = array();
        foreach($data['vtcCourseList'] as $key=>$course){
            if($course['course_name_id_fk']== 1){

                array_push($course_name_id_fk,$course['course_name_id_fk']);
                foreach ($course['group'] as $value) {
                    array_push($group_id, $value['group_id_fk']);
                }
            }
        }
        
        //Check All category subject exist or not 
        if(!empty($course_name_id_fk)){

            $data['vtcHsSubjectForEleven'] = $this->teachers_model->checkHsHsSubjectForEleven($data['vtc_id'], $data['academic_year'],$group_id);
            $data['vtcHsSubjectForTwelve'] = $this->teachers_model->checkHsHsSubjectForTwelve($data['vtc_id'], $data['academic_year'],$group_id);
        }else{
            $data['vtcHsSubjectForEleven'] = 'match';
            $data['vtcHsSubjectForTwelve'] = 'match';
        }


        $data['teacherList'] = $this->finalsubmit_model->getVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['academic_year']);
        
        // Check All Teacher mapping is complete or not
        $getTeacherMap = $this->finalsubmit_model->getTotalMappingTeacherId($data['vtcDetails']['vtc_id_fk'], $data['academic_year']);
        if(count($data['teacherList']) == count($getTeacherMap) ){
            $data['allTeacherMapping'] = 'yes';
        }else{
            $data['allTeacherMapping'] = 'no';
        }
        $data['studentCountDetails'] = $this->finalsubmit_model->getStudentCountDetails($data['vtc_id'], $data['academic_year']);

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/final_submit_view', $data);
    }

    public function submit_final_data()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');

            $vtcDetails = $this->finalsubmit_model->getVtcDetails(md5($data['vtc_id']), $data['academic_year']);

            $result = $this->finalsubmit_model->submit_final_data(md5($vtcDetails['vtc_details_id_pk']), array('final_submit_status' => 1));

            if ($result) {

                echo json_encode('submited');
            }
        }
    }
}
