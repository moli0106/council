<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teachers extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(72);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/teachers_model');

        $this->css_head = array(
            0 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/vtc.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            4 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',

            5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            6 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
        );
    }

    public function index()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        // $data['academic_year']  = $this->config->item('academic_year');
        $data['academic_year']  = $this->config->item('current_academic_year');

        $data['previous_academic_year']  = $this->config->item('previous_academic_year');
        $data['vtcDetails']     = $this->teachers_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        // $data['active_class'] = 'active';
        // $data['previous_data'] = 'yes';

        $data['vtcCourseList'] = $this->teachers_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']);

        if (!empty($data['vtcDetails'])) {

            $data['teacherList'] = $this->teachers_model->getVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['academic_year']);
        }

        $data['previousTeacherList'] = $this->teachers_model->getVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['previous_academic_year']);

        // echo "<pre>";print_r($data['teacherList']);exit;

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/teachers_list', $data);
    }

    public function detail($teacher_id = NULL)
    {
        $data['teacher'] = $this->teachers_model->getTeacherDetails($teacher_id);

        $data['GroupSubject'] = $this->teachers_model->getAssignedSubjectGroupByTeacherId($teacher_id,  $data['teacher']['teacher_type']);

        // $data['assignedSubject'] = '';
        // if(!empty($Subject)){
        //     if(count($Subject)){
        //         foreach ($Subject as $key => $value) {
        //             $data['assignedSubject'] .= $value['subject_name'];
        //             $data['assignedSubject'] .= ',';
        //         }
        //     }
        // }

        // echo "<pre>";print_r($data);exit;

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/teachers_detail_view', $data);
    }

    public function add()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->teachers_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        $data['designationList']   = $this->teachers_model->getDesignationList();
        $data['engagementList']    = $this->teachers_model->getEngagementList();
        $data['qualificationList'] = $this->teachers_model->getQualificationList();

        $data['vtcCourseList'] = $this->teachers_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']);

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
        // echo "<pre>";print_r($data['vtcHsSubjectForEleven']);exit;
        // parent::pre($data);

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'teacher_type',
                    'label' => 'Teacher Type',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'teacher_name',
                    'label' => 'Teacher Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                /* array(
                    'field' => 'engagement_type',
                    'label' => 'Engagement Type',
                    'rules' => 'trim|required'
                ), */
                array(
                    'field' => 'mobile_no',
                    'label' => 'Mobile No.',
                    'rules' => 'trim|required|numeric|exact_length[10]'
                ),
                array(
                    'field' => 'email_id',
                    'label' => 'Email Id',
                    'rules' => 'trim|required|valid_email'
                ),
                // array(
                //     'field' => 'qualification_subjects',
                //     'label' => 'Subjects Of Qualification',
                //     'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                //     'errors' => array(
                //         'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                //     )
                // ),
                 array(
                    'field' => 'aadhar_no',
                    'label' => 'Aadhar Number',
                    'rules' => 'trim|required|numeric'
                ), 
                array(
                    'field' => 'pan_no',
                    'label' => 'PAN Number',
                    // 'rules' => 'trim|required|max_length[10]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]|callback_check_unique_pan_for_vtc',
                    'rules' => 'trim|required|max_length[10]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'employee_id',
                    'label' => 'Employee ID',
                    'rules' => 'trim|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),

                // Added by Moli

                array(
                    'field' => 'dob',
                    'label' => 'Date of Birth',
                    'rules' => 'trim|required'
                ),
            );

            // if (($this->input->post('teacher_type') == 1) || ($this->input->post('teacher_type') == 3)) {
            //     $config[] = array(
            //         'field' => 'course_id',
            //         'label' => 'course_id',
            //         'rules' => 'trim|required|numeric'
            //     );
            // } else {
            //     $config[] = array(
            //         'field' => 'course_name',
            //         'label' => 'Course Name',
            //         'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
            //         'errors' => array(
            //             'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
            //         )
            //     );

            //     $config[] = array(
            //         'field' => 'subjects_attached_with',
            //         'label' => 'Subjects Attached With',
            //         'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
            //         'errors' => array(
            //             'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
            //         )
            //     );
            // }

            if ($this->input->post('designation') == 'Other') {
                $config[] = array(
                    'field' => 'other_designation',
                    'label' => 'Designation',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                );
            } else {
                $config[] = array(
                    'field' => 'designation',
                    'label' => 'Designation',
                    'rules' => 'trim|required|numeric'
                );
            }

            if ($this->input->post('highest_qualification') == 'Other') {
                $config[] = array(
                    'field' => 'other_qualification',
                    'label' => 'Qualification',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                );
            } else {
                $config[] = array(
                    'field' => 'highest_qualification',
                    'label' => 'Highest Qualification',
                    'rules' => 'trim|required|numeric'
                );
            }

            if ($this->input->post('engagement_type') == 'Other') {
                $config[] = array(
                    'field' => 'other_engagement',
                    'label' => 'Engagement Type',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                );
            } else {
                $config[] = array(
                    'field' => 'engagement_type',
                    'label' => 'Engagement Type',
                    'rules' => 'trim|required'
                );
            }

            $this->form_validation->set_rules($config);

            $this->form_validation->set_rules('qualification_certificate', 'Qualification Certificate', 'trim|callback_file_validation[qualification_certificate|application/pdf|200|required]');

            $this->form_validation->set_rules('pan_no_image', 'PAN No. Image', 'trim|callback_file_validation[pan_no_image|image/jpeg|100|required]');

            // Added By Moli 

            $this->form_validation->set_rules('aadhar_no_image', 'Aadhar Image', 'trim|callback_file_validation[aadhar_no_image|image/jpeg|100|required]');
            $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100|required]');

            if ($this->form_validation->run() != FALSE) {

               

                $insertArray = array(
                    'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'             => $data['vtcDetails']['academic_year'],
                    'teacher_type'              => $this->input->post('teacher_type'),
                    'course_id_fk'              => ($this->input->post('course_id') == NULL) ? NULL : $this->input->post('course_id'),
                    'course_name'               => ($this->input->post('course_name') == NULL) ? NULL : $this->input->post('course_name'),
                    'attached_subjects'         => ($this->input->post('subjects_attached_with') == NULL) ? NULL : $this->input->post('subjects_attached_with'),
                    'teacher_name'              => $this->input->post('teacher_name'),
                    'designation_id_fk'         => ($this->input->post('designation') == 'Other') ? NULL : $this->input->post('designation'),
                    'other_designation'         => ($this->input->post('other_designation') == NULL) ? NULL : $this->input->post('other_designation'),
                    'engagement_id_fk'          => ($this->input->post('engagement_type') == 'Other') ? NULL : $this->input->post('engagement_type'),
                    'other_engagement'          => ($this->input->post('other_engagement') == NULL) ? NULL : $this->input->post('other_engagement'),
                    'qualification_id_fk'       => ($this->input->post('highest_qualification') == 'Other') ? NULL : $this->input->post('highest_qualification'),
                    'other_qualification'       => ($this->input->post('other_qualification') == NULL) ? NULL : $this->input->post('other_qualification'),
                    'qualification_subjects'    => ($this->input->post('qualification_subjects') == '') ? $this->input->post('qualification_subjects') : NULL,
                    'mobile_no'                 => $this->input->post('mobile_no'),
                    'email_id'                  => $this->input->post('email_id'),
                    'qualification_certificate' => base64_encode(file_get_contents($_FILES["qualification_certificate"]['tmp_name'])),
                    'pan_no_image'              => base64_encode(file_get_contents($_FILES["pan_no_image"]['tmp_name'])),
                    'entry_ip'                  => $this->input->ip_address(),
                    'aadhar_no'                 => ($this->input->post('aadhar_no') == NULL) ? NULL : $this->input->post('aadhar_no'),
                    'pan_no'                    => $this->input->post('pan_no'),
                    'employee_id'               => ($this->input->post('employee_id') == NULL) ? NULL : $this->input->post('employee_id'),
                    
                    
                    'whats_app_mob_no'               => ($this->input->post('whats_app_no') == NULL) ? NULL : $this->input->post('whats_app_no'),
                    'date_of_birth'               => ($this->input->post('dob') == NULL) ? NULL : $this->input->post('dob'),
                );

                if (!empty($_FILES['aadhar_no_image']['tmp_name'])) {

                    $insertArray['aadhar_no_image'] = base64_encode(file_get_contents($_FILES["aadhar_no_image"]['tmp_name']));
                } else {
                    $insertArray['aadhar_no_image'] = NULL;
                }

                // added by Moli

                if (!empty($_FILES['photo']['tmp_name'])) {

                    $insertArray['photo'] = base64_encode(file_get_contents($_FILES["photo"]['tmp_name']));
                } else {
                    $insertArray['photo'] = NULL;
                }

                $result = $this->teachers_model->insertTeacherData($insertArray);

                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Teacher added successfully.');

                    redirect('admin/affiliation/teachers/add');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/affiliation/teachers/add');
                }
            }
        }

        $this->load->view($this->config->item('theme') . 'affiliation/teacher_add', $data);
    }

    public function update($teacher_id = NULL)
    {
        $data['teacher'] = $this->teachers_model->getTeacherDetails($teacher_id);
        // echo "<pre>";print_r($data['teacher']);exit;
        if (!empty($data['teacher'])) {

            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');
            $data['vtcDetails']     = $this->teachers_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

            $data['designationList']   = $this->teachers_model->getDesignationList();
            $data['engagementList']    = $this->teachers_model->getEngagementList();
            $data['qualificationList'] = $this->teachers_model->getQualificationList();

            $formData['teacher_id_pk']             = (set_value('teacher_id_pk') != NULL)             ? set_value('teacher_id_pk')             : $data['teacher']['teacher_id_pk'];
            $formData['vtc_id_fk']                 = (set_value('vtc_id_fk') != NULL)                 ? set_value('vtc_id_fk')                 : $data['teacher']['vtc_id_fk'];
            $formData['vtc_details_id_fk']         = (set_value('vtc_details_id_fk') != NULL)         ? set_value('vtc_details_id_fk')         : $data['teacher']['vtc_details_id_fk'];
            $formData['academic_year']             = (set_value('academic_year') != NULL)             ? set_value('academic_year')             : $data['teacher']['academic_year'];
            $formData['teacher_type']              = (set_value('teacher_type') != NULL)              ? set_value('teacher_type')              : $data['teacher']['teacher_type'];
            $formData['course_id_fk']              = (set_value('course_id_fk') != NULL)              ? set_value('course_id_fk')              : $data['teacher']['course_id_fk'];
            $formData['course_name']               = (set_value('course_name') != NULL)               ? set_value('course_name')               : $data['teacher']['course_name'];
            $formData['attached_subjects']         = (set_value('attached_subjects') != NULL)         ? set_value('attached_subjects')         : $data['teacher']['attached_subjects'];
            $formData['teacher_name']              = (set_value('teacher_name') != NULL)              ? set_value('teacher_name')              : $data['teacher']['teacher_name'];
            $formData['designation_id_fk']         = (set_value('designation_id_fk') != NULL)         ? set_value('designation_id_fk')         : $data['teacher']['designation_id_fk'];
            $formData['other_designation']         = (set_value('other_designation') != NULL)         ? set_value('other_designation')         : $data['teacher']['other_designation'];
            $formData['engagement_id_fk']          = (set_value('engagement_id_fk') != NULL)          ? set_value('engagement_id_fk')          : $data['teacher']['engagement_id_fk'];
            $formData['qualification_id_fk']       = (set_value('qualification_id_fk') != NULL)       ? set_value('qualification_id_fk')       : $data['teacher']['qualification_id_fk'];
            $formData['other_qualification']       = (set_value('other_qualification') != NULL)       ? set_value('other_qualification')       : $data['teacher']['other_qualification'];
            $formData['qualification_subjects']    = (set_value('qualification_subjects') != NULL)    ? set_value('qualification_subjects')    : $data['teacher']['qualification_subjects'];
            $formData['mobile_no']                 = (set_value('mobile_no') != NULL)                 ? set_value('mobile_no')                 : $data['teacher']['mobile_no'];
            $formData['email_id']                  = (set_value('email_id') != NULL)                  ? set_value('email_id')                  : $data['teacher']['email_id'];
            $formData['qualification_certificate'] = (set_value('qualification_certificate') != NULL) ? set_value('qualification_certificate') : $data['teacher']['qualification_certificate'];
            $formData['pan_no_image']              = (set_value('pan_no_image') != NULL)              ? set_value('pan_no_image')              : $data['teacher']['pan_no_image'];
            $formData['aadhar_no_image']           = (set_value('aadhar_no_image') != NULL)           ? set_value('aadhar_no_image')           : $data['teacher']['aadhar_no_image'];
            $formData['pan_no']                    = (set_value('pan_no') != NULL)                    ? set_value('pan_no')                    : $data['teacher']['pan_no'];
            $formData['aadhar_no']                 = (set_value('aadhar_no') != NULL)                 ? set_value('aadhar_no')                 : $data['teacher']['aadhar_no'];
            $formData['other_engagement']          = (set_value('other_engagement') != NULL)          ? set_value('other_engagement')          : $data['teacher']['other_engagement'];
            $formData['employee_id']               = (set_value('employee_id') != NULL)               ? set_value('employee_id')               : $data['teacher']['employee_id'];

            $formData['date_of_birth']               = (set_value('date_of_birth') != NULL)               ? set_value('dob')               : $data['teacher']['date_of_birth'];
            $formData['photo']               = (set_value('photo') != NULL)               ? set_value('photo')               : $data['teacher']['photo'];
            $formData['whats_app_mob_no']               = (set_value('whats_app_mob_no') != NULL)               ? set_value('whats_app_no')               : $data['teacher']['whats_app_mob_no'];

            $data['formData']       = $formData;
            $data['vtc_courseList'] = array();

            // $courseList = $this->teachers_model->getVtcCourseForTeacher(md5($data['vtc_id']), $data['academic_year']);
            // if ($formData['teacher_type'] == 1) {

            //     $data['vtc_courseList'] = $this->teachers_model->getCourseWhereIdIn(explode(',', $courseList['hs_voc_courses']));
            // } elseif ($formData['teacher_type'] == 3) {

            //     $data['vtc_courseList'] = $this->teachers_model->getCourseWhereIdIn(explode(',', $courseList['stc_course']));
            // }

            // parent::pre($formData);

            if ($this->input->server('REQUEST_METHOD') == "POST") {

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                $config = array(
                    array(
                        'field' => 'teacher_type',
                        'label' => 'Teacher Type',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'teacher_name',
                        'label' => 'Teacher Name',
                        'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),
                    array(
                        'field' => 'mobile_no',
                        'label' => 'Mobile No.',
                        'rules' => 'trim|required|numeric|exact_length[10]'
                    ),
                    array(
                        'field' => 'email_id',
                        'label' => 'Email Id',
                        'rules' => 'trim|required|valid_email'
                    ),
                    // array(
                    //     'field' => 'qualification_subjects',
                    //     'label' => 'Subjects Of Qualification',
                    //     'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    //     'errors' => array(
                    //         'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    //     )
                    // ),

                    array(
                        'field' => 'aadhar_no',
                        'label' => 'Aadhar Number',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'pan_no',
                        'label' => 'PAN Number',
                        'rules' => 'trim|required|max_length[10]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),
                    array(
                        'field' => 'employee_id',
                        'label' => 'Employee ID',
                        'rules' => 'trim|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),

                    // Added by Moli

                    array(
                        'field' => 'dob',
                        'label' => 'Date of Birth',
                        'rules' => 'trim|required'
                    ),
                );

                // if (($this->input->post('teacher_type') == 1) || ($this->input->post('teacher_type') == 3)) {
                //     $config[] = array(
                //         'field' => 'course_id',
                //         'label' => 'course_id',
                //         'rules' => 'trim|required|numeric'
                //     );
                // } else {
                //     $config[] = array(
                //         'field' => 'course_name',
                //         'label' => 'Course Name',
                //         'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                //         'errors' => array(
                //             'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                //         )
                //     );

                //     $config[] = array(
                //         'field' => 'subjects_attached_with',
                //         'label' => 'Subjects Attached With',
                //         'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                //         'errors' => array(
                //             'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                //         )
                //     );
                // }

                if ($this->input->post('designation') == 'Other') {
                    $config[] = array(
                        'field' => 'other_designation',
                        'label' => 'Designation',
                        'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    );
                } else {
                    $config[] = array(
                        'field' => 'designation',
                        'label' => 'Designation',
                        'rules' => 'trim|required|numeric'
                    );
                }

                if ($this->input->post('highest_qualification') == 'Other') {
                    $config[] = array(
                        'field' => 'other_qualification',
                        'label' => 'Qualification',
                        'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    );
                } else {
                    $config[] = array(
                        'field' => 'highest_qualification',
                        'label' => 'Highest Qualification',
                        'rules' => 'trim|required|numeric'
                    );
                }

                if ($this->input->post('engagement_type') == 'Other') {
                    $config[] = array(
                        'field' => 'other_engagement',
                        'label' => 'Engagement Type',
                        'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    );
                } else {
                    $config[] = array(
                        'field' => 'engagement_type',
                        'label' => 'Engagement Type',
                        'rules' => 'trim|required'
                    );
                }

                $this->form_validation->set_rules($config);

                $this->form_validation->set_rules('qualification_certificate', 'Qualification Certificate', 'trim|callback_file_validation[qualification_certificate|application/pdf|100]');

                $this->form_validation->set_rules('pan_no_image', 'PAN No. Image', 'trim|callback_file_validation[pan_no_image|image/jpeg|100]');

                $this->form_validation->set_rules('aadhar_no_image', 'Aadhar Image', 'trim|callback_file_validation[aadhar_no_image|image/jpeg|100|]');
                
                if($data['teacher']['photo'] != ''){

                    $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100]');
                    
                }else{

                    $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100|required]');

                }

                if ($this->form_validation->run() != FALSE) {

                    $tmp_date = explode('/', $this->input->post('dob'));
					$date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
					$date = date_format($date, "Y-m-d");

                    $updateArray = array(
                        'teacher_type'              => $this->input->post('teacher_type'),
                        'course_id_fk'              => ($this->input->post('course_id') == NULL) ? NULL : $this->input->post('course_id'),
                        'course_name'               => ($this->input->post('teacher_type') == 2) ? $this->input->post('course_name') : NULL,
                        'attached_subjects'         => ($this->input->post('teacher_type') == 2) ? $this->input->post('subjects_attached_with') : NULL,
                        'teacher_name'              => $this->input->post('teacher_name'),
                        'designation_id_fk'         => ($this->input->post('designation') == 'Other') ? NULL : $this->input->post('designation'),
                        'other_designation'         => ($this->input->post('designation') == 'Other') ? $this->input->post('other_designation') : NULL,
                        'engagement_id_fk'          => ($this->input->post('engagement_type') == 'Other') ? NULL : $this->input->post('engagement_type'),
                        'other_engagement'          => ($this->input->post('engagement_type') == 'Other') ? $this->input->post('other_engagement') : NULL,
                        'qualification_id_fk'       => ($this->input->post('highest_qualification') == 'Other') ? NULL : $this->input->post('highest_qualification'),
                        'other_qualification'       => ($this->input->post('highest_qualification') == 'Other') ? $this->input->post('other_qualification') : NULL,
                        'qualification_subjects'    => ($this->input->post('qualification_subjects') == '') ? $this->input->post('qualification_subjects') : NULL,
                        'mobile_no'                 => $this->input->post('mobile_no'),
                        'email_id'                  => $this->input->post('email_id'),
                        'aadhar_no'                 => ($this->input->post('aadhar_no') == NULL) ? NULL : $this->input->post('aadhar_no'),
                        'pan_no'                    => $this->input->post('pan_no'),
                        'employee_id'               => ($this->input->post('employee_id') == NULL) ? NULL : $this->input->post('employee_id'),


                        'whats_app_mob_no'               => ($this->input->post('whats_app_no') == NULL) ? NULL : $this->input->post('whats_app_no'),
                        'date_of_birth'               => ($date == NULL) ? NULL : $date,
                        'update_ip'                  => $this->input->ip_address(),
                        'update_time'                  => 'now()',
                    );

                    if (!empty($_FILES['qualification_certificate']['tmp_name'])) {

                        $updateArray['qualification_certificate'] = base64_encode(file_get_contents($_FILES["qualification_certificate"]['tmp_name']));
                    }

                    if (!empty($_FILES['pan_no_image']['tmp_name'])) {

                        $updateArray['pan_no_image'] = base64_encode(file_get_contents($_FILES["pan_no_image"]['tmp_name']));
                    }

                    if (!empty($_FILES['aadhar_no_image']['tmp_name'])) {

                        $updateArray['aadhar_no_image'] = base64_encode(file_get_contents($_FILES["aadhar_no_image"]['tmp_name']));
                    }

                    // Added by Moli

                    if (!empty($_FILES['photo']['tmp_name'])) {

                        $updateArray['photo'] = base64_encode(file_get_contents($_FILES["photo"]['tmp_name']));
                    }

                    // parent::pre($updateArray);

                    $result = $this->teachers_model->updateTeacherData($formData['teacher_id_pk'], $updateArray);

                    if ($result) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Teacher details updated successfully.');

                        redirect('admin/affiliation/teachers/update/' . md5($formData['teacher_id_pk']));
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                        redirect('admin/affiliation/teachers/update/' . md5($formData['teacher_id_pk']));
                    }
                }
            }

            $this->load->view($this->config->item('theme') . 'affiliation/teacher_update_view', $data);
        } else {
            redirect('admin/affiliation/teachers');
        }
    }

    public function check_unique_pan_for_vtc($pan_no)
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->teachers_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        $result = $this->teachers_model->checkVtcPanNo($data['vtcDetails']['vtc_id_pk'], $pan_no);

        if (count($result) > 0) {

            $this->form_validation->set_message('check_unique_pan_for_vtc', 'PAN Number is alreday exist in system.');
            return false;
        } else {
            return true;
        }
    }

    public function getVtcCourseForTeacher()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $tType   = $this->input->get('tType');
            $id_hash = $this->input->get('vtc_id');

            $academic_year = $this->config->item('academic_year');

            if (!empty($tType) && !empty($id_hash) && ($tType == 1 || $tType == 3)) {

                $courseList = $this->teachers_model->getVtcCourseForTeacher($id_hash, $academic_year);
                if (!empty($courseList)) {

                    if ($tType == 1) {
                        if (!empty($courseList['hs_voc_courses'])) {
                            $vtc_courseList = $this->teachers_model->getCourseWhereIdIn(explode(',', $courseList['hs_voc_courses']));
                        } else {
                            $vtc_courseList = NULL;
                        }
                    } elseif ($tType == 3) {
                        if (!empty($courseList['stc_course'])) {
                            $vtc_courseList = $this->teachers_model->getCourseWhereIdIn(explode(',', $courseList['stc_course']));
                        } else {
                            $vtc_courseList = NULL;
                        }
                    }

                    if (!empty($vtc_courseList)) {
                        $html = '<option value="" hidden="true">Select Course</option>';

                        foreach ($vtc_courseList as $key => $value) {
                            $html .= '
                                <option value="' . $value['course_id_pk'] . '">
                                    ' . $value['group_name'] . ' [' . $value['group_code'] . ']
                                </option>
                            ';
                        }
                        echo json_encode($html);
                    } else {
                        echo json_encode(0);
                    }
                } else {
                    echo json_encode(0);
                }
            }
        }
    }

    public function file_validation($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);

        if ($file_array[1] == "application/pdf") {
            $ext = "PDF";
        } elseif ($file_array[1] == "image/jpeg") {
            $ext = "JPG";
        }
        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            }
        }
    }

    public function download_qualification_certificate($id_hash = NULL)
    {
        if ($id_hash == NULL) {
            redirect('admin/affiliation/teachers');
        } else {

            $result = $this->teachers_model->getTeacherDetails($id_hash);
            if (!empty($result)) {

                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename=Qualification-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
                echo base64_decode($result['qualification_certificate']);
            } else {
                redirect('admin/affiliation/teachers');
            }
        }
    }

    public function download_pan_image($id_hash = NULL)
    {
        if ($id_hash == NULL) {
            redirect('admin/affiliation/teachers');
        } else {

            $result = $this->teachers_model->getTeacherDetails($id_hash);
            if (!empty($result)) {

                header("Content-type:image/jpeg");
                header("Content-Disposition:attachment;filename=PAN-Image-" . date('ymd') . "-" . date('His') . ".jpeg");
                echo base64_decode($result['pan_no_image']);
            } else {
                redirect('admin/affiliation/teachers');
            }
        }
    }

    public function download_aadhar_image($id_hash = NULL)
    {
        if ($id_hash == NULL) {
            redirect('admin/affiliation/teachers');
        } else {

            $result = $this->teachers_model->getTeacherDetails($id_hash);
            if (!empty($result)) {

                header("Content-type:image/jpeg");
                header("Content-Disposition:attachment;filename=Aadhar-Image-" . date('ymd') . "-" . date('His') . ".jpeg");
                echo base64_decode($result['aadhar_no_image']);
            } else {
                redirect('admin/affiliation/teachers');
            }
        }
    }

    public function removeTeacher()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            if (!empty($id_hash)) {

                $teacherDetails = $this->teachers_model->getTeacherDetails($id_hash);
                if (!empty($teacherDetails)) {

                    $this->teachers_model->removeTeacherData($teacherDetails['teacher_id_pk'], array('active_status' => 0));
                    echo json_encode('Done');

                    // echo json_encode($teacherDetails);
                }
            }
        }
    }

    public function download_profile_photo($id_hash = NULL)
    {
        if ($id_hash == NULL) {
            redirect('admin/affiliation/teachers');
        } else {

            $result = $this->teachers_model->getTeacherDetails($id_hash);
            if (!empty($result)) {

                header("Content-type:image/jpeg");
                header("Content-Disposition:attachment;filename=Profile-Photo-" . date('ymd') . "-" . date('His') . ".jpeg");
                echo base64_decode($result['photo']);
            } else {
                redirect('admin/affiliation/teachers');
            }
        }
    }

    // Added By Moli

    public function openTeacherSubjectModal($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
               

                $data['teacherDetails'] = $this->teachers_model->getTeacherDetails($id_hash);
                $data['teacher_type'] = $data['teacherDetails']['teacher_type'];
                $subjectGroup = $this->teachers_model->getAssignedSubjectGroupByTeacherId($id_hash, $data['teacher_type']);

                $data['assignedSubjectGroup'] = array();

                if(!empty($subjectGroup)){

                    foreach ($subjectGroup as $key => $value) {
                        array_push($data['assignedSubjectGroup'], $value['subject_group_id_fk']);
                    }
                }

                if($data['teacher_type'] == 1){

                    $data['vtcSubject'] = $this->teachers_model->getSubjectByVTCId($data['teacherDetails']['vtc_id_fk'], $data['teacherDetails']['academic_year']);
                
                }elseif ($data['teacher_type'] == 3) {

                    $data['vtcGroup'] = $this->teachers_model->getGrouptByVTCId($data['teacherDetails']['vtc_id_fk'], $data['teacherDetails']['academic_year']);

                }
                // echo "<pre>";print_r($data);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/teachers/teacher_subject_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }

    }

    public function checkSubjectTeacherExist(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $subjectIdArr = $this->input->get('subject_group_id');

            if(!empty($subjectIdArr)){

                $vtc_id         = $this->session->userdata('stake_details_id_fk');
                $academic_year  = $this->config->item('current_academic_year');

                $data['vtcDetails']     = $this->teachers_model->getVtcDetails($vtc_id, $academic_year);

                $lastArrsubjectId = end($subjectIdArr);

                $techerExist = $this->teachers_model->checkTeacherExist($subjectIdArr, $data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                if(empty($techerExist)){

                    echo json_encode('done');
                }else{
                    $return = array(
                        'msg' => 'Teacher already exist in this Subject/Group ! Can you proceed ?',
                    );
                    echo json_encode($return);

                }
            }
            

        }
    }

    public function assignSubjectForTeacher()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $teacher_id = $this->input->post('teacher_id');
            $subject_name = $this->input->post('subject_group_name');
            $teacher_type = $this->input->post('teacher_type');

            if($teacher_id != ''){
                if(count($subject_name) > 0){

                    $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
                    $data['academic_year']  = $this->config->item('current_academic_year');
                    $data['vtcDetails']     = $this->teachers_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

                    $Subject = $this->teachers_model->getAssignedSubjectGroupByTeacherId(md5($teacher_id), $teacher_type);

                    if(!empty($Subject)){

                        $this->teachers_model->updateTeacherSubjectMap('council_affiliation_vtc_teacher_subject_group_map', array('active_status' => 0), $teacher_id);
                    }

                    $mapArray = array();

                    foreach ($subject_name as $key => $value) {

                        $tmp_data = array(
                            'teacher_id_fk' => $teacher_id,
                            'subject_group_id_fk' => $value,
                            'teacher_type' => $teacher_type,

                            'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                            'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                            'academic_year'            => $data['academic_year'],
                        );

                        array_push($mapArray , $tmp_data);
                    }

                    $result = $this->teachers_model->insertBatchData('council_affiliation_vtc_teacher_subject_group_map', $mapArray);
                    if($result){
                        echo json_encode('done');
                    }
                }
            }

        }
    }

    //  Current Academic Year

    public function current_data()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->teachers_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['current_class'] = 'active';

        $data['vtcCourseList'] = $this->teachers_model->getVtcAllCourseList($data['vtc_id'], $data['academic_year']);
        
        if (!empty($data['vtcDetails'])) {

            $data['teacherList'] = $this->teachers_model->getVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['academic_year']);
        }else{
            $data['teacherList'] = array();
        }

        // echo "<pre>";print_r($data['teacherList']);exit;

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/teachers_list', $data);
    }

    public function moveTeacherToNextYear(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            // $teacherId = $this->input->get('teacherIdArray');
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['previous_academic_year']  = $this->config->item('previous_academic_year');
            $teacherList = $this->teachers_model->getVtcTeacherList($data['vtc_id'], $data['previous_academic_year']);
            if(!empty($teacherList)){
                foreach ($teacherList as $key => $value) {

                    $teacherId = $value['teacher_id_pk'];

                    $getTeacherDetails = $this->teachers_model->getAllTeacherDetailsById($teacherId);
                    $getMappingData = $this->teachers_model->getTeacherSubjectMapData($teacherId);

                    $last_id = $this->teachers_model->insertTeacherData($getTeacherDetails);
                    
                    if(!empty($getMappingData)){
                        $this->teachers_model->insertMapData($getMappingData,$last_id);
                    }
                    // echo "<pre>";print_r($getMappingData);exit;
                }
                echo json_encode('done');
               
            }
           
           
        }

    }
}
