<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Courses extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(71);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/course_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/course.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

   

    public function index()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

       

        $data['current_academic_year'] = $this->config->item('current_academic_year'); // Current Year
        
        $data['vtcCourseList']  = $this->course_model->getVtcAllCourseList($data['vtc_id'], $data['current_academic_year']);

        $data['subjectCategory'] = $this->course_model->getAllSubjectCategory();
        

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_name_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'discipline',
                    'label' => 'Discipline Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'group_id[]',
                    'label' => 'Group Name',
                    'rules' => 'trim|required',
                    
                ),

               
            );
            


            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/courses_view', $data);
                // redirect('admin/affiliation/courses/add');
            } else {

                
                $insertArray = array(
                    'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'            => $data['academic_year'],
                    'course_name_id_fk' =>   $this->input->post('course_name_id'),
                    'class_name' =>   ($this->input->post('class_name') !='') ? $this->input->post('class_name'):NULL,
                    'discipline_id_fk'        => $this->input->post('discipline'),
                    // 'group_id_fk'           => $this->input->post('group_id'),
                    'subject_category_id_fk'           => ($this->input->post('category_id')!='') ? $this->input->post('category_id'):NULL,
                    'entry_ip'                 => $this->input->ip_address(),
                    'entry_time'                => 'now()',
                );
                

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $courseSelectionId = $this->course_model->insertVtcCourseData($insertArray);

                if ($courseSelectionId) {

                    

                    $group_id = $this->input->post('group_id');

                    if(count($group_id) > 0){

                        $mapArray = array();
                        foreach ($group_id as $key => $value) {

                            $tmp_array = array(

                                'vtc_course_id_fk' => $courseSelectionId,
                                'group_id_fk' => $value,

                                'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                                'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                                'academic_year'            => $data['academic_year'],

                            );

                            array_push($mapArray,$tmp_array);
                        }
                    }

                    $result = $this->course_model->insertBatchData('council_affiliation_vtc_course_selection_group_map',$mapArray);
                   

                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add courses, Please try after sometime.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Courses added successfully.');
                    }

                    

                    redirect('admin/affiliation/courses');
                    
                    // $this->load->view($this->config->item('theme') . 'affiliation/courses_view', $data);
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/affiliation/courses');
                }
            }
        } else {
            $this->load->view($this->config->item('theme') . 'affiliation/courses_view', $data);
        }
    }

    public function addCourse()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('academic_year');
            $data['vtcDetails']     = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_name_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'discipline',
                    'label' => 'Discipline Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'group_id',
                    'label' => 'Group Name',
                    'rules' => 'trim|required',
                    
                ),
            );
            if($this->input->post('course_name_id') == 1){
                $config[] = array(
                    'field' => 'class_name','label' => 'Class','rules' => 'trim|required'
                );
            }


            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/courses_view', $data);
                // redirect('admin/affiliation/courses/add');
            } else {

                $insertArray = array(
                    'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'            => $data['academic_year'],
                    'hs_voc_course_name_id_fk' => 1,
                    'hs_voc_discipline'        => implode(',', $hs_discipline),
                    'hs_voc_courses'           => implode(',', $hs_courses),
                    'stc_course_name_id_fk'    => 4,
                    'stc_discipline'           => implode(',', $stc_discipline),
                    'stc_course'               => implode(',', $stc_courses),
                    'entry_ip'                 => $this->input->ip_address(),
                );

                $result = $this->course_model->insertVtcCourseData($insertArray);

                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Courses added successfully.');

                    redirect('admin/affiliation/courses');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/affiliation/courses');
                }
            }
        } else {
            redirect('admin/affiliation/courses');
        }
    }

    public function getHsEquivalentDisciplineCourse()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $courseName = 1;
            $discipline = $this->input->get('discipline');

            $html       = '';
            $courseList = $this->course_model->getCourseListByNameDiscipline($courseName, $discipline);

            foreach ($courseList as $key => $value) {
                $html .= '
                    <option value="' . $value['course_id_pk'] . '">
                        ' . $value['group_name'] . ' [' . $value['group_code'] . ']
                    </option>
                ';
            }
            echo json_encode($html);
        }
    }

    public function getNqrNsqfDisciplineCourse()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $discipline = $this->input->get('discipline');

            $nqrHtml    = '<optgroup label="Courses from VIII+ NQR" data-select2-id="select2-data-nqr">';
            $nsqfHtml   = '<optgroup label="Courses from VIII+ NSQF" data-select2-id="select2-data-nsqf">';
            $viiXHtml   = '<optgroup label="Courses from VIII+ / X+ STC" data-select2-id="select2-data-nsqf">';

            $nqrCourseList  = $this->course_model->getCourseListByNameDiscipline(2, $discipline);
            $nsqfCourseList = $this->course_model->getCourseListByNameDiscipline(3, $discipline);
            $viiXCourseList = $this->course_model->getCourseListByNameDiscipline(5, $discipline);

            if (count($nqrCourseList) > 0) {
                foreach ($nqrCourseList as $key => $value) {
                    $nqrHtml .= '
                        <option value="' . $value['course_id_pk'] . '">
                            ' . $value['group_name'] . ' [' . $value['group_code'] . ']
                        </option>
                    ';
                }

                $nqrHtml .= '</optgroup>';
            } else {
                $nqrHtml .= '
                    <option value="" disabled="true">No data found...</option>
                    </optgroup>
                ';
            }

            if (count($nsqfCourseList) > 0) {
                foreach ($nsqfCourseList as $key => $value) {
                    $nsqfHtml .= '
                        <option value="' . $value['course_id_pk'] . '">
                            ' . $value['group_name'] . ' [' . $value['group_code'] . ']
                        </option>
                    ';
                }

                $nsqfHtml .= '</optgroup>';
            } else {
                $nsqfHtml .= '
                    <option value="" disabled="true">No data found...</option>
                    </optgroup>
                ';
            }

            if (count($viiXCourseList) > 0) {
                foreach ($viiXCourseList as $key => $value) {
                    $viiXHtml .= '
                        <option value="' . $value['course_id_pk'] . '">
                            ' . $value['group_name'] . ' [' . $value['group_code'] . ']
                        </option>
                    ';
                }

                $viiXHtml .= '</optgroup>';
            } else {
                $viiXHtml .= '
                    <option value="" disabled="true">No data found...</option>
                    </optgroup>
                ';
            }

            $nqrHtml .= $nsqfHtml;

            $nqrHtml .= $viiXHtml;

            echo json_encode($nqrHtml);
        }
    }

    public function resetCourseTeacherStudent()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('academic_year');

            $vtcDetails = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

            $this->course_model->resetCourseTeacherStudent($vtcDetails['vtc_id_pk'], $vtcDetails['vtc_details_id_pk']);

            echo json_encode('done');
        }
    }

    // Added by Moli on 13-06-2022 For New Modification

    public function getDisciplineByCourseName($course_name_id){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if(!empty($course_name_id) && $course_name_id!= 'undefined'){

                $vtcCourseId = $this->input->get('vtcCourseId');

                if($vtcCourseId != ''){
                    $data['course'] = $this->course_model->getCourseDetailsById($vtcCourseId);
                }else{
                    $data['course'] = array();
                }

                if($course_name_id == 1){

                    $hs_science = $this->input->get('hs_science');
                    $hs_biology = $this->input->get('hs_biology');
                    $hs_comerce = $this->input->get('hs_comerce');

                    $data['disciplineList'] = $this->course_model->getDisciplineListByCourseAndStreemId($course_name_id, $hs_science, $hs_biology, $hs_comerce);

                }elseif($course_name_id == 4){
                
                    $data['disciplineList'] = $this->course_model->getDisciplineListByCourseName($course_name_id);
                   
                }
                if (!empty($data['disciplineList'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/discipline_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Discipline --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                // echo $html;exit;
                echo json_encode($html);
    
               
            }

        }
    }

    public function getEquivalentGroupByDiscipline()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $courseName = $this->input->get('course_name_id');

            if(!empty($courseName) && $courseName!= 'undefined'){

                $discipline = $this->input->get('discipline');
    
                $vtcCourseId = $this->input->get('vtcCourseId');
                if($vtcCourseId != ''){
                    $data['course'] = $this->course_model->getCourseDetailsById($vtcCourseId);
                }else{
                    $data['course'] = array();
                }
    
                if($courseName == 1){
    
                    $data['courseName'] = 1;
                    // $data['groupList'] = $this->course_model->getCourseListByNameDiscipline($courseName, $discipline);

                    $hs_science = $this->input->get('hs_science');
                    $hs_biology = $this->input->get('hs_biology');
                    $hs_comerce = $this->input->get('hs_comerce');

                    $data['groupList'] = $this->course_model->getCourseListByNameDisciplineAndStreem($courseName, $discipline, $hs_science, $hs_biology, $hs_comerce);

        
                    if (!empty($data['groupList'])) {
    
                        $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/group_view', $data, TRUE);
                    } else {
    
                        $html = '<option value="" hidden="true">-- Select Group/Trade --</option>';
                        $html .= '<option>No Data Found...</option>';
                    }
                    //    echo $html;exit;
                    echo json_encode($html);
    
                }elseif ($courseName == 4) {
    
                    $data['courseName'] = 4;
        
                    $data['nqrCourseList']  = $this->course_model->getCourseListByNameDiscipline(2, $discipline);
                    $data['nsqfCourseList'] = $this->course_model->getCourseListByNameDiscipline(3, $discipline);
                    $data['viiXCourseList'] = $this->course_model->getCourseListByNameDiscipline(5, $discipline);
        
                   
    
                    if (!empty($data)) {
    
                        $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/group_view', $data, TRUE);
                    } else {
    
                        $html = '<option value="" hidden="true">-- Select Group/Trade --</option>';
                        $html .= '<option>No Data Found...</option>';
                    }
                    echo json_encode($html);
                    
                }
            }


        }
    }

   
    public function getSubjectCategory(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_name_id = $this->input->get('course_name_id');
            if(!empty($course_name_id) && $course_name_id!= 'undefined'){

                $group = $this->input->get('group');
                $discipline = $this->input->get('discipline');
                $class_name = $this->input->get('class_name');

                $vtcCourseId = $this->input->get('vtcCourseId');
                if($vtcCourseId != ''){
                    $data['course'] = $this->course_model->getCourseDetailsById($vtcCourseId);
                }else{
                    $data['course'] = array();
                }

                

               
                $data['subCategory'] = $this->course_model->getsubCategory($course_name_id, $class_name, $discipline, $group);

                

                if (!empty($data['subCategory'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/subject_category_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Subject Category --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
    
               
            }

        }
    }

    public function getSubjectList(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_name_id = $this->input->get('course_name_id');
            if(!empty($course_name_id) && $course_name_id!= 'undefined'){

                $sub_cat_id = $this->input->get('category_id');

                $group = $this->input->get('group');
                $discipline = $this->input->get('discipline');
                $class_name = $this->input->get('class_name');

                $vtcCourseId = $this->input->get('vtcCourseId');
                if($vtcCourseId != ''){
                    $data['course'] = $this->course_model->getCourseDetailsById($vtcCourseId);
                    $courseSubject = $this->course_model->getSubjectNameByVTCId($vtcCourseId);

        
                    $data['subjectArray'] = array();
                    if(!empty($courseSubject)){

                    
                        foreach ($courseSubject as $key => $value) {
                        array_push($data['subjectArray'], $value['subject_name_id_fk']);
                        }
                    }
                }else{
                    $data['course'] = array();
                    $data['subjectArray'] = array();
                }

               
                $data['subjectName'] = $this->course_model->getSubjectList($course_name_id, $class_name, $discipline, $group, $sub_cat_id);

               

                if (!empty($data['subjectName'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/subject_name_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Subject Name --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
    
               
            }

        }
    }

    public function detail($vtc_course_id = NULL){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        $data['course'] = $this->course_model->getCourseDetailsById($vtc_course_id);
        $data['courseSubject'] = $this->course_model->getSubjectNameByVTCId($vtc_course_id);

        $data['subjectCategory'] = $this->course_model->getAllSubjectCategory();
        
        $data['subjectArray'] = array();
        if(!empty($data['courseSubject'])){

           
            foreach ($data['courseSubject'] as $key => $value) {
               array_push($data['subjectArray'], $value['subject_name_id_fk']);
            }
        }
        

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            

           

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_name_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'discipline',
                    'label' => 'Discipline Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'group_id',
                    'label' => 'Group Name',
                    'rules' => 'trim|required',
                    
                ),

               
            );
            if($this->input->post('course_name_id') == 1){
                $config[] = array(
                    'field' => 'class_name','label' => 'Class','rules' => 'trim|required'
                );

                $config[] = array(
                    'field' => 'category_id','label' => 'Subject Category','rules' => 'trim|required'
                );

                $config[] = array(
                    'field' => 'subject_name_id[]','label' => 'Subject Name','rules' => 'trim|required'
                );
            }


            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                // redirect('admin/affiliation/courses/detail/' . $vtc_course_id);
                $this->load->view($this->config->item('theme') . 'affiliation/courses_details_view', $data);
            } else {

                $UpdateArray = array(
                    'course_name_id_fk' =>   $this->input->post('course_name_id'),
                    'class_name' =>   ($this->input->post('class_name') !='') ? $this->input->post('class_name'):NULL,
                    'discipline_id_fk'        => $this->input->post('discipline'),
                    'group_id_fk'           => $this->input->post('group_id'),
                    'subject_category_id_fk'           => ($this->input->post('category_id')!='') ? $this->input->post('category_id'):NULL,
                    'update_ip'                 => $this->input->ip_address(),
                    'update_time'                => 'now()',
                );

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $upd_result = $this->course_model->updateVtcCourseData($UpdateArray, $vtc_course_id);

                if ($upd_result) {
                    

                    $deleteCourseSubject = $this->course_model->deleteCourseSubjectByCourseId($vtc_course_id);

                    $subject_name_id = $this->input->post('subject_name_id');

                    if(count($subject_name_id) > 0){

                        $mapArray = array();
                        foreach ($subject_name_id as $key => $value) {

                            $tmp_array = array(

                                'vtc_course_id_fk' => $data['course']['vtc_course_id_pk'],
                                'subject_name_id_fk' => $value,

                            );

                            array_push($mapArray,$tmp_array);
                        }
                    }

                    $result = $this->course_model->insertBatchData('council_affiliation_vtc_course_selection_subject_map',$mapArray);


                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to update courses, Please try after sometime.');
                    } else {

                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Courses updated successfully.');
                    }

                    redirect('admin/affiliation/courses');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/affiliation/courses');
                }
            }
        } else {
           
            $this->load->view($this->config->item('theme') . 'affiliation/courses_details_view', $data);
        }


    }

    public function updateCourse($vtc_course_id = NULL){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        
        $data['vtcCourseList']  = $this->course_model->getVtcCourseList($data['vtc_id'], $data['academic_year']);

        
    }

    public function view_old_course()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['courseNameList'] = $this->course_model->getCourseNameList();
        $data['disciplineList'] = $this->course_model->getDisciplineList();
        $data['vtcCourseList']  = $this->course_model->getVtcCourseList($data['vtc_id'], $data['academic_year']);
        
        
        if (!empty($data['vtcCourseList'])) {

            if (!empty($data['vtcCourseList']['hs_voc_discipline'])) {

                $data['vtcCourseList']['hs_voc_discipline'] = explode(',', $data['vtcCourseList']['hs_voc_discipline']);
                $data['vtcCourseList']['hs_voc_courses']    = explode(',', $data['vtcCourseList']['hs_voc_courses']);
                $data['hsCourseList']  = $this->course_model->getCourseListById($data['vtcCourseList']['hs_voc_courses']);
            } else {
                $data['hsCourseList'] = array();
            }
            
            // echo "<pre>";print_r($data);exit;
            if (!empty($data['vtcCourseList']['stc_discipline'])) {

                $data['vtcCourseList']['stc_discipline']    = explode(',', $data['vtcCourseList']['stc_discipline']);
                $data['vtcCourseList']['stc_course']        = explode(',', $data['vtcCourseList']['stc_course']);
                $data['stcCourseList'] = $this->course_model->getCourseListById($data['vtcCourseList']['stc_course']);
            } else {
                $data['stcCourseList'] = array();
            }

            $data['hs_voc_discipline'] = $data['vtcCourseList']['hs_voc_discipline'];
        } else {

            $data['hs_voc_discipline'] = array();
        }
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/courses_view_old', $data);
    }

    public function getSubjectCategoryByClassName(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $class_name_id = $this->input->get('class_name_id');
            if(!empty($class_name_id) && $class_name_id!= 'undefined'){

                
                

                $vtcCourseId = $this->input->get('vtcCourseId');
                if($vtcCourseId != ''){
                    $data['course'] = $this->course_model->getCourseDetailsById($vtcCourseId);
                }else{
                    $data['course'] = array();
                }

               

               
                $data['subCategory'] = $this->course_model->getsubCategoryByClassName($class_name_id);

                
                if (!empty($data['subCategory'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/subject_category_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Subject Category --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
    
               
            }

        }
    }

    public function removeVtcCourse(){

        if(!$this->input->is_ajax_request()){
            exit('No direct script access allowed');
        }else{

            $id_hash = $this->input->get('id_hash');
            if (!empty($id_hash)) {

                $course = $this->course_model->getCourseDetailsById($id_hash);

                // echo "<pre>";print_r($course);exit;
               
                $group_id_fk = array();
                if(!empty($course['group'])){
                    foreach($course['group'] as $val){
                        array_push($group_id_fk, $val['group_id_fk']);
                    }
                }

                if($course['course_name_id_fk']== 1){

                    $getSubject = $this->course_model->getSubjectByGroupId($group_id_fk, $course['vtc_id_fk'], $course['academic_year']);
                }elseif ($course['course_name_id_fk']== 4) {
                    $teacher_type = 3;
                    $teacherByGroup = $this->course_model->getTeacher($group_id_fk, $course['vtc_id_fk'], $course['academic_year'], $teacher_type);
                }
                // echo "<pre>";print_r($getSubject);exit;

                if(count($teacherByGroup)!=0){
                    $return = array(
                        'msg' => 'Delete is not possible ! Already mapped with teacher.'
                    );
                    echo json_encode($return);

                } elseif(count($getSubject)!= 0){
                    
                    $subjectName = array();
                    $course_subject_id = array();

                    foreach ($getSubject as $key => $value) {
                        array_push($subjectName, $value['subject_name_id_fk']);
                        array_push($course_subject_id, $value['course_subject_id_pk']);
                    }

                    $teacher_type = 1;
                    $teacher = $this->course_model->getTeacher($subjectName, $course['vtc_id_fk'], $course['academic_year'], $teacher_type);
                    
                    if(count($teacher)!=0){
                        $return = array(
                            'msg' => 'Delete is not possible ! Already mapped with teacher.'
                        );
                        echo json_encode($return);
                    }else{

                        $deleteSubjectMap = $this->course_model->updateSubjectMap($course_subject_id, array('active_status' => 0));

                        $deleteSubject = $this->course_model->updateSubjectByGroupId($group_id_fk, array('active_status' => 0));

                        $this->course_model->updateVtcCourseGroupMapData(array('active_status' => 0), $id_hash);
                        $this->course_model->updateVtcCourseData(array('active_status' => 0), $id_hash);
        
                        
                        echo json_encode('done');
                    }

                    

                    // $this->course_model->deleteTeacherForSubject($subjectName, array('active_status' => 0));
                }else{

                    $this->course_model->updateVtcCourseGroupMapData(array('active_status' => 0), $id_hash);
                    $this->course_model->updateVtcCourseData(array('active_status' => 0), $id_hash);
    
                    // echo "<pre>";print_r($getSubject);exit;
                    echo json_encode('done');
                }

               
            }
        }
    }

    public function getGroupCount(){
        if(!$this->input->is_ajax_request()){
            exit('No direct script access allowed');
        }else{

            $group_id = $this->input->get('group_id');

            $course_name_id = $this->input->get('course_name_id');

            if(!empty($group_id) && !empty($course_name_id)){

                if($course_name_id == 1){
                    $msg = 'You can choose maximum four group codes for Hs-Voc';
                }else{
                    $msg = 'You can choose maximum four trade codes for VIII+STC';
                }

                $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
                $data['academic_year']  = $this->config->item('current_academic_year');

                $groupIdExist = $this->course_model->getGroupIdByVTCId($data['vtc_id'], $data['academic_year'],$course_name_id);

                

                if ((count($group_id) + count($groupIdExist)) > 4){

                    $return = array(
                        'msg' => $msg.'. Already '.count($groupIdExist).' groups are added .',
                    );

                    echo json_encode($return);

                }else{
                    echo json_encode('done');
                }

            }
        }
    }

    // 12-07-2022

    public function resetAllCourse()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');

            $vtcDetails = $this->course_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

            $this->course_model->resetCourseGroup($data['vtc_id'], $data['academic_year']);

            $this->course_model->resetTeacherSubjectMap($data['vtc_id'], $data['academic_year']);

            $this->course_model->resetSubject($data['vtc_id'], $data['academic_year']);

            $this->course_model->resetCourseTeacherStudent($vtcDetails['vtc_id_pk'], $data['academic_year']);

            echo json_encode('done');
        }
    }

}
