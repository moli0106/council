<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_reg_admin extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
        $this->load->model('vtc_student_admin/student_reg_admin_model');

        $this->load->model('vtc_student/student_reg_model');

        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css'
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student_admin/student_reg_admin.js',

            3 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
            5 => $this->config->item('theme_uri').'jQuery.print.min.js' 
        );
    }

    public function index($vtc_id = NULL ,$offset = 0){
        //echo $vtc_id;exit;
		$data['offset']      = $offset;
        $data['page_links']  = NULL;
        $data['yearlist']  = $this->student_reg_admin_model->getAcademicYearList();
		//echo "<pre>";print_r($this->student_reg_admin_model->getAllDataCount);exit;
		
		// if ($this->input->server('REQUEST_METHOD') == 'POST') {
		// 	$vtc_code = $this->input->post('vtc_code');
		// 	if (!empty($vtc_code)){
		// 		$data['all_std_data'] = $this->student_reg_admin_model->getAllDataBySearch($vtc_code);
		// 		//echo "<pre>";print_r($data['all_std_data']);exit;
		// 	}else {
        //         redirect('admin/vtc_student_admin/student_reg_admin');
        //     }
			
		// }else{
		
		// 	$this->load->library('pagination');

        //     $config['base_url']         = 'vtc_student_admin/student_reg_admin/index/';
        //     $data["total_rows"]         = $config['total_rows'] = count($this->student_reg_admin_model->getAllDataCount());
        //     $config['per_page']         = 50;
        //     $config['num_links']        = 2;
        //     $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        //     $config['full_tag_close']   = '</ul>';
        //     $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        //     $config['first_tag_open']   = '<li class="">';
        //     $config['first_tag_close']  = '</li>';
        //     $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        //     $config['last_tag_open']    = '<li class="">';
        //     $config['last_tag_close']   = '</li>';
        //     $config['first_tag_open']   = '<li>';
        //     $config['first_tag_close']  = '</li>';
        //     $config['prev_link']        = '<i class="fa fa-backward"></i>';
        //     $config['prev_tag_open']    = '<li class="prev">';
        //     $config['prev_tag_close']   = '</li>';
        //     $config['next_link']        = '<i class="fa fa-forward"></i>';
        //     $config['next_tag_open']    = '<li>';
        //     $config['next_tag_close']   = '</li>';
        //     $config['last_tag_open']    = '<li>';
        //     $config['last_tag_close']   = '</li>';
        //     $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        //     $config['cur_tag_close']    = '</a></li>';
        //     $config['num_tag_open']     = '<li>';
        //     $config['num_tag_close']    = '</li>';

        //     $this->pagination->initialize($config);

        //     $data['page_links']  = $this->pagination->create_links();
            

		// 	$data['all_std_data'] = $this->student_reg_admin_model->getAllData($config['per_page'], $offset);
		// }

        $data['vtc_id']         = $vtc_id;
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->student_reg_admin_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        //echo "<pre>";print_r($data['vtcDetails']);exit;
        $data['all_std_data'] = $this->student_reg_admin_model->getAllDataByVTCID($data['vtcDetails']['vtc_id_fk'], $data['academic_year']);
		//echo "<pre>";print_r($data['all_std_data']);exit;
        $this->load->view($this->config->item('theme') . 'vtc_student_admin/student_view', $data);
    }

    public function group_wise_student_list($vtc_id_pk_hash,$group_id){
        if($vtc_id_pk_hash!='' && $group_id!=''){

            //$data['vtc_id']         = $vtc_id;
            $data['academic_year']  = $this->config->item('current_academic_year');
            $data['vtcDetails']     = $this->student_reg_admin_model->getVtcDetails($vtc_id_pk_hash, $data['academic_year']);
            //echo "<pre>";print_r($data['vtcDetails']);exit;
            $data['std_list'] = $this->student_reg_admin_model->get_std_listByGroup($vtc_id_pk_hash,$group_id);
            $data['group'] = $this->student_reg_admin_model->get_group_details($group_id);
           // echo "<pre>";print_r($data['std_list']);exit;
            if(!empty($data)){
                $this->load->view($this->config->item('theme') . 'vtc_student_admin/group_wise_student_view', $data);
            }
            
        }else{
            redirect('/vtc_student_admin/student_reg_admin/index/'.$vtc_id_pk_hash);
        }
    }



    //VTC REG
    public function genarate_student_reg_certificate(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $institute_id_fk = $this->input->get('vtc_id');
            $course_id = $this->input->get('course_id');
            if ($institute_id_fk != NULL && $course_id !='') {

                $student_list = $this->student_reg_admin_model->getStudentListByVTCGroup($institute_id_fk,$course_id);
                //echo '<pre>';print_r($student_list);exit;
                if($student_list){
                    foreach ($student_list as $key => $value) {
                        $certificate_no = $this->generate_certificate_no($value['class_id_fk'], $value['year_of_registration']);
                        //echo $certificate_no['certificateCode'];exit;
                        if (!empty($certificate_no['certificateCode'])) {
                            // ! Starting Transaction
                            
                            $upd_array = array(
                                'registration_number'  => $certificate_no['certificateCode'],
                                'reg_certificate_genarated_time'    => 'now()',
                                'reg_certificate_genarated_by'      => $this->session->userdata('stake_details_id_fk'),
                                'reg_status'                        => 1
                               
                            );
                            $status= $this->student_reg_admin_model->update_certificate_no($value['student_id_pk'], $upd_array);
                            
                        }
                    }

                    //added by moli on 09-05-2023
                    $academic_year  = $this->config->item('current_academic_year');
                    $this->student_reg_admin_model->update_Batch_declaration_master($institute_id_fk,$course_id,$academic_year);

                    $ajaxResponse = array(
                        'ok'  => 1,
                        'msg' => 'Success! Certificate number genarated successfully.'
                    );
                }else{
                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found..',
                    );
                }
                
            }else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }
            echo json_encode($ajaxResponse);
        }


    }

    public function generate_certificate_no($class_id_fk,$registration_year){

        // $state_code = "WB";
        if($class_id_fk == 4){
            $start_code = "STC";
        }elseif ($class_id_fk == 1) {
            $start_code = "HS";
        }

        // $exam_year = date('Y');
        //$reg_year = str_replace('-', '', substr($registration_year, 2));

        $reg_year = str_replace('-', '', substr($registration_year, 2));
        $chaking_data = ($start_code . $reg_year);

        //echo $chaking_data;exit;
        $check_exist_code = $this->student_reg_admin_model->get_last_certificate_no($chaking_data)[0];

        if ($check_exist_code['code'] == "") {
            $number = "00001";
        } else {

            $code = $check_exist_code['code'];
            $cd = (int)str_pad(substr($code, -5), strlen($code));

            $cd = $cd + 1;
            $number = $cd;
            $no_of_digit = 5;
            $length = strlen((string)$number);

            for ($i = $length; $i < $no_of_digit; $i++) {
                $number = '0' . $number;
            }
            $number;
        }

        $certificateCode = $start_code . $reg_year . $number;

        return array(
            
            'certificateCode' => $certificateCode
        );
    }

    //Added by Moli on 12-05-2023
    public function student_details($id_hash = NULL){

        
        $data['student_data'] = $this->student_reg_model->getStudentDetailsById($id_hash);
        //echo "<pre>";print_r($data['student_data']);exit;
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['school_data']     = $this->student_reg_admin_model->getVtcDetails(md5($data['student_data']['institute_id_fk']), $data['academic_year']);

        $data['salutations'] =  $this->student_reg_model->getSalutation();
        $data['genders'] =  $this->student_reg_model->getGender();
        //$data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['casteList']  = $this->student_reg_model->get_caste();
        $data['religion']  = $this->student_reg_model->get_religion();
        $data['last_exam']  = $this->student_reg_model->get_last_exam();
        $data['batchDurationList']  = $this->student_reg_model->get_batch_duration();

        $data['stateList']  = $this->student_reg_model->getAllState();
        $data['nationality']  = $this->student_reg_model->get_nationality();

        //$data['student_data'] = $this->student_reg_model->getStudentDetailsById($id_hash);
        $data['boardList']  = $this->student_reg_model->getAllboard();
		
		$data['guardian_relation'] = $this->student_reg_model->getGuardianRelation();
        // echo "<pre>";print_r($data['student_data']);exit;

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $data['from_data']['vtc_code'] = $this->input->post('vtcCode');
            // $data['form_data']['vtc_name'] = $this->input->post('stdEmail');
            $data['form_data']['udise_code'] = $this->input->post('udise_code');
            $data['form_data']['bangla_shiksha_reg_number'] = $this->input->post('bengShikshaRegNo');
            // $data['form_data']['salutation_id_fk'] = $this->input->post('salutation');
            $data['form_data']['first_name'] = $this->input->post('fname');
            $data['form_data']['middle_name'] = $this->input->post('mname');
            $data['form_data']['last_name'] = $this->input->post('lname');
            $data['form_data']['father_name'] = $this->input->post('father_name');
            $data['form_data']['mothers_name'] = $this->input->post('mother_name');
            $data['form_data']['guardian_name'] = $this->input->post('guardian_name');
            $data['form_data']['guardian_relationship'] = $this->input->post('guardian_relation');
            $data['form_data']['nationality_id_fk'] = $this->input->post('citizenship');
            $data['form_data']['aadhar_no'] = $this->input->post('aadhar_no');
            $data['form_data']['mobile'] = $this->input->post('mob_no');
            $data['form_data']['email'] = $this->input->post('email_id');
            $data['form_data']['address'] = $this->input->post('address');
            $data['form_data']['district_id_fk'] = $this->input->post('district');
            $data['form_data']['subdiv_id_fk'] = $this->input->post('subDivision');
            $data['form_data']['municipality_id_fk'] = $this->input->post('municipality');
            $data['form_data']['pin'] = $this->input->post('pinCode');
            $data['form_data']['caste'] = $this->input->post('caste_id');
            $data['form_data']['religion'] = $this->input->post('religion_id');
            $data['form_data']['other_religion_name'] = $this->input->post('otherReligionName');
            $data['form_data']['physically_challenged'] = $this->input->post('phy_challenged');
            $data['form_data']['date_of_birth'] = $this->input->post('dob');
            $data['form_data']['gender_id_fk'] = $this->input->post('gender');
            $data['form_data']['marital_status'] = $this->input->post('marital_status');
            $data['form_data']['kanyashree_no'] = $this->input->post('kanyashree_no');
            $data['form_data']['class_id_fk'] = $this->input->post('course_name_id');
            $data['form_data']['course_id_fk'] = $this->input->post('group_id');
            $data['form_data']['phase'] = $this->input->post('batch_duration');
            $data['form_data']['last_academic_exam_id_fk'] = $this->input->post('last_exam_id');
            $data['form_data']['council_register'] = $this->input->post('haveRegisterNo') ? $this->input->post('haveRegisterNo') : $this->input->post('haveHSRegisterNo') ;
            $data['form_data']['old_reg_no'] = $this->input->post('old_reg_no') ? $this->input->post('old_reg_no') : $this->input->post('old_hs_reg_no') ;
            $data['form_data']['old_reg_year'] = $this->input->post('old_reg_year') ? $this->input->post('old_reg_year') : $this->input->post('old_hs_reg_year') ;
            $data['form_data']['ten_passing_year'] = $this->input->post('ten_passing_year');
            $data['form_data']['ten_school_state'] = $this->input->post('ten_school_state');
            $data['form_data']['total_marks'] = $this->input->post('total_marks');
            $data['form_data']['aggregate_marks'] = $this->input->post('aggregate_marks');
            $data['form_data']['percentage'] = $this->input->post('percentage_marks');
            $data['form_data']['register_hs_course'] = $this->input->post('register_hs_course');
            $data['form_data']['hs_passed'] = $this->input->post('haveSHSPassed');
            $data['form_data']['state_id_fk'] = $this->input->post('state');
            $data['form_data']['address_2'] = $this->input->post('address_2');
            $data['form_data']['address_3'] = $this->input->post('address_3');
            $data['form_data']['board_id_fk'] = $this->input->post('board_name');
        }else{

            $data['from_data']['vtc_code'] = $data['student_data']['institute_code'];
            // $data['form_data']['vtc_name'] = $data['student_data']['first_name'];
            $data['form_data']['udise_code'] = $data['student_data']['udise_code'];
            $data['form_data']['bangla_shiksha_reg_number'] = $data['student_data']['bangla_shiksha_reg_number'];
            // $data['form_data']['salutation_id_fk'] = $data['student_data']['salutation_id_fk'];
            $data['form_data']['first_name'] = $data['student_data']['first_name'];
            $data['form_data']['middle_name'] = $data['student_data']['middle_name'];
            $data['form_data']['last_name'] = $data['student_data']['last_name'];
            $data['form_data']['father_name'] = $data['student_data']['father_name'];
            $data['form_data']['mothers_name'] = $data['student_data']['mothers_name'];
            $data['form_data']['guardian_name'] = $data['student_data']['guardian_name'];
            $data['form_data']['guardian_relationship'] = $data['student_data']['guardian_relationship'];
            $data['form_data']['nationality_id_fk'] = $data['student_data']['nationality_id_fk'];
            $data['form_data']['aadhar_no'] = $data['student_data']['aadhar_no'];
            $data['form_data']['mobile'] = $data['student_data']['mobile'];
            $data['form_data']['email'] = $data['student_data']['email'];
            $data['form_data']['address'] = $data['student_data']['address'];
            $data['form_data']['district_id_fk'] = $data['student_data']['district_id_fk'];
            $data['form_data']['subdiv_id_fk'] = $data['student_data']['subdiv_id_fk'];
            $data['form_data']['municipality_id_fk'] = $data['student_data']['municipality_id_fk'];
            $data['form_data']['pin'] = $data['student_data']['pin'];
            $data['form_data']['caste'] = $data['student_data']['caste'];
            $data['form_data']['religion'] = $data['student_data']['religion'];
            $data['form_data']['other_religion_name'] = $data['student_data']['other_religion_name'];
            $data['form_data']['physically_challenged'] = $data['student_data']['physically_challenged'];
            $data['form_data']['date_of_birth'] = $data['student_data']['date_of_birth'];
            $data['form_data']['gender_id_fk'] = $data['student_data']['gender_id_fk'];
            $data['form_data']['marital_status'] = $data['student_data']['marital_status'];
            $data['form_data']['kanyashree_no'] = $data['student_data']['kanyashree_no'];
            $data['form_data']['class_id_fk'] = $data['student_data']['class_id_fk'];
            $data['form_data']['course_id_fk'] = $data['student_data']['course_id_fk'];
            $data['form_data']['phase'] = $data['student_data']['phase'];
            $data['form_data']['last_academic_exam_id_fk'] = $data['student_data']['last_academic_exam_id_fk'];
            $data['form_data']['council_register'] = $data['student_data']['council_register'];
            $data['form_data']['old_reg_no'] = $data['student_data']['old_reg_no'];
            $data['form_data']['old_reg_year'] = $data['student_data']['old_reg_year'];
            $data['form_data']['ten_passing_year'] = $data['student_data']['ten_passing_year'];
            $data['form_data']['ten_school_state'] = $data['student_data']['ten_school_state'];
            $data['form_data']['total_marks'] = $data['student_data']['total_marks'];
            $data['form_data']['aggregate_marks'] = $data['student_data']['aggregate_marks'];
            $data['form_data']['percentage'] = $data['student_data']['percentage'];
            $data['form_data']['register_hs_course'] = $data['student_data']['register_hs_course'];
            $data['form_data']['hs_passed'] = $data['student_data']['hs_passed'];
            $data['form_data']['state_id_fk'] = $data['student_data']['state_id_fk'];
            $data['form_data']['address_2'] = $data['student_data']['address_2'];
            $data['form_data']['address_3'] = $data['student_data']['address_3'];
            $data['form_data']['board_id_fk'] = $data['student_data']['board_id_fk'];
        }



        //echo "<pre>";print_r($data['form_data']);exit;
        if (!empty($data['form_data']['state_id_fk'])) {
            $data['districtList'] = $this->student_reg_model->getDistrictByStateId($data['form_data']['state_id_fk']);
        }

        if (!empty($data['form_data']['subdiv_id_fk'])) {
            $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($data['form_data']['subdiv_id_fk']);
        }

        if(!empty($data['form_data']['district_id_fk'])){

            if ($data['form_data']['district_id_fk'] == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district_id_fk']);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($data['form_data']['district_id_fk'] == 682) || ($data['form_data']['district_id_fk'] == 683)) {

                $kolkataArray = array(
                    0 => $data['form_data']['district_id_fk'], // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district_id_fk']);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($data['form_data']['district_id_fk']);
            }
        }

        if (!empty($data['form_data']['class_id_fk'])) {
            $data['group'] = $this->student_reg_model->getGroupByVTCCode($data['form_data']['class_id_fk'],$data['school_data']['vtc_code'], $data['academic_year']);
        }

        $group_id = $this->input->post('group_id');

        if(!empty($data['form_data']['course_id_fk'])){
            $data['group_details'] = $this->student_reg_model->getGroupDetails($data['form_data']['course_id_fk']);
        }else{
            $data['group_details']= array();
        }


        

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'vtcCode',
                    'label' => 'VTC Code',
                    'rules' => 'trim|required',
                    
                ),
                array('field' => 'vtcName','label' => 'VTC Name','rules' => 'trim|required',),

                array('field' => 'admissionYear','label' => 'Admission Year','rules' => 'trim|required',),

                // array('field' => 'salutation','label' => 'Salutation','rules' => 'trim|required',),

                array('field' => 'fname','label' => 'First Name','rules' => 'trim|required',),

                array('field' => 'lname','label' => 'Last Name','rules' => 'trim|required',),

                // array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                // array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                array('field' => 'guardian_name','label' => 'Guardian Name','rules' => 'trim|required',),

                array('field' => 'guardian_relation','label' => 'Relationship with Guardian','rules' => 'trim|required',),

                array('field' => 'aadhar_no','label' => 'Aadhar Number','rules' => 'trim|required|exact_length[12]|numeric'),

                array('field' => 'mob_no','label' => 'Mobile Number','rules' => 'trim|required',),

                array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required',),

                array('field' => 'address','label' => 'Address','rules' => 'trim|required',),

                array('field' => 'district','label' => 'District','rules' => 'trim|required',),

                // array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required',),

                // array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required',),

                array('field' => 'pinCode','label' => 'Pin Code','rules' => 'trim|required',),

                array('field' => 'caste_id','label' => 'Caste','rules' => 'trim|required',),

                array('field' => 'phy_challenged','label' => 'Physically Challenged','rules' => 'trim|required',),

                array('field' => 'dob','label' => 'Date of Birth','rules' => 'trim|required',),

                // array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                array('field' => 'gender','label' => 'Gender','rules' => 'trim|required'),

                array('field' => 'marital_status','label' => 'Marital Status','rules' => 'trim|required'),

                array('field' => 'course_name_id','label' => 'Course Name','rules' => 'trim|required'),

                array('field' => 'group_id','label' => 'Group/Trade Name','rules' => 'trim|required',),

                array('field' => 'citizenship','label' => 'Citizenship','rules' => 'trim|required'),
                array('field' => 'state','label' => 'State','rules' => 'trim|required'),
                //array('field' => 'kanyashree_no','label' => 'Kanyashree Number','rules' => 'trim|exact_length[20]')
				

            
            );
            
            if(($this->input->post('gender') == 2) && ($this->input->post('marital_status') == 2)){
               
                $config[] = array('field' => 'kanyashree_no','label' => 'Kanyashree Number','rules' => 'trim|exact_length[20]');
            }

            if($this->input->post('state') == 19){
                $config[] = array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required');

                $config[] = array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required');
            }

            if ($data['student_data']['image'] == '') {

                $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');

            }else{
                $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|]');
            }

            if ($data['student_data']['std_signature'] == '') {

                $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|100|required]');


            }else{
                $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|100|]');
            }

            if ($data['student_data']['aadhar_doc'] == '') {

                $this->form_validation->set_rules('aadhar_doc', 'D.O.B Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
            }else{
                $this->form_validation->set_rules('aadhar_doc', 'D.O.B Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|]');
            }
           

            if(($this->input->post('caste_id') != 1) && ($data['student_data']['caste_doc'] == '')){

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');

            }

            // if ($this->input->post('religion_id') == 4){
            //     $config[] = array('field' => 'otherReligionName','label' => 'Other Religion Name','rules' => 'trim|required');
            // }

            if(($this->input->post('phy_challenged') == 1) && ($data['student_data']['phy_challenged_doc'] == '')){

                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');

            }

            if(($this->input->post('citizenship') == 2) && ($data['student_data']['citizenship_approval_doc'] == '')){

                $this->form_validation->set_rules('approval_doc', 'Approval Document', 'trim|callback_file_validation[approval_doc|application/pdf|200|required]');
                
            }else{
                
                $this->form_validation->set_rules('approval_doc', 'Approval Document', 'trim|callback_file_validation[approval_doc|application/pdf|200|]');
            }

            $course_name_id = $data['form_data']['class_id_fk'];

            if ($course_name_id == 4){

                //$config[] = array('field' => 'batch_duration','label' => 'Batch Duration','rules' => 'trim|required');
                $config[] = array('field' => 'last_exam_id','label' => 'Last Exam','rules' => 'trim|required');
                $config[] = array('field' => 'haveRegisterNo','label' => 'Question','rules' => 'trim|required');

                if($this->input->post('haveRegisterNo') == 1){

                    $config[] = array('field' => 'old_reg_no','label' => 'Registration Number','rules' => 'trim|required');
                    $config[] = array('field' => 'old_reg_year','label' => 'Registration Year','rules' => 'trim|required');
                }

                if(($data['student_data']['marksheet'] == '')){

                    $this->form_validation->set_rules('marksheet', 'Mark Sheet', 'trim|callback_file_validation[marksheet|application/pdf|200|required]');
                }else{
                    
                    $this->form_validation->set_rules('marksheet', 'Mark Sheet', 'trim|callback_file_validation[marksheet|application/pdf|200|]');
                }

            }elseif ($course_name_id == 1) {



                $config[] = array('field' => 'board_name','label' => 'Board/Council','rules' => 'trim|required');
                $config[] = array('field' => 'ten_passing_year','label' => 'year of passing','rules' => 'trim|required');
                $config[] = array('field' => 'school_state','label' => 'State of location of school','rules' => 'trim|required');

                $config[] = array('field' => 'total_marks','label' => 'Total Marks','rules' => 'trim|required');

                $config[] = array('field' => 'aggregate_marks','label' => 'Aggregate Marks','rules' => 'trim|required');

                $config[] = array('field' => 'percentage_marks','label' => 'Percentage','rules' => 'trim|required');

                
                $config[] = array('field' => 'haveHSRegisterNo','label' => 'Question','rules' => 'trim|required');
                $config[] = array('field' => 'register_hs_course','label' => 'Question','rules' => 'trim|required');
                $config[] = array('field' => 'haveSHSPassed','label' => 'passed Higher Secondary','rules' => 'trim|required');

                $config[] = array('field' => 'old_hs_reg_no','label' => 'Registration Number','rules' => 'trim|required');
                $config[] = array('field' => 'old_hs_reg_year','label' => 'Registration Year','rules' => 'trim|required');

                if(($this->input->post('school_state')!= 19) && ($data['student_data']['migration_certificate'] == '')){

                    $this->form_validation->set_rules('migration_certificate', 'Migration Certificate', 'trim|callback_file_validation[migration_certificate|application/pdf|200|required]');
    
                }
    
                if(($this->input->post('register_hs_course') == 1) && ($data['student_data']['transfer_certificate'] == '')){
    
                    $this->form_validation->set_rules('transfer_certificate', 'Transfer Certificate', 'trim|callback_file_validation[transfer_certificate|application/pdf|200|required]');
    
                }

                if($data['student_data']['marksheet'] == ''){

                    $this->form_validation->set_rules('hs_marksheet', 'Mark Sheet', 'trim|callback_file_validation[hs_marksheet|application/pdf|200|required]');
                }

            }

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Validation Error, Please try later.');
                $this->load->view($this->config->item('theme').'vtc_student_admin/student_reg_details_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {

                $tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");

                $update_data = array(

                    
                    'bangla_shiksha_reg_number' => ($this->input->post('bengShikshaRegNo') != NULL) ? $this->input->post('bengShikshaRegNo') : NULL,
                    'udise_code'                => ($this->input->post('udise_code') != NULL) ? $this->input->post('udise_code') : NULL,
                    
                    'salutation_id_fk'      => ($this->input->post('salutation') != NULL) ? $this->input->post('salutation') : NULL ,
                    'first_name'            => $this->input->post('fname'),
                    'middle_name'           => ($this->input->post('mname') != NULL) ? $this->input->post('mname') : NULL,
                    'last_name'             => $this->input->post('lname'),
                    'father_name'           => ($this->input->post('father_name') != NULL) ? $this->input->post('father_name') : '',
                    'mothers_name'           => ($this->input->post('mother_name') != NULL) ? $this->input->post('mother_name') : '' ,

                    'guardian_name'            => $this->input->post('guardian_name'),
                    'guardian_relationship' =>$this->input->post('guardian_relation'),

                    'aadhar_no'              =>$this->input->post('aadhar_no'), 
                    'mobile'                =>    $this->input->post('mob_no'),
                    'email'                =>    $this->input->post('email_id'),
                    'address'                =>    $this->input->post('address'),

                    'state_id_fk'           =>$this->input->post('state'),
                    'district_id_fk'        => $this->input->post('district'),
                    'municipality_id_fk'    => ($this->input->post('municipality') !=NULL) ? $this->input->post('municipality') : NULL ,
                    'subdiv_id_fk'    => ($this->input->post('subDivision') !=NULL) ? $this->input->post('subDivision') : NULL,

                    'pin'              => $this->input->post('pinCode'),

                    'caste'             => $this->input->post('caste_id'),

                    'religion'              => ($this->input->post('religion_id') != NULL) ? $this->input->post('religion_id') : NULL,
                    'other_religion_name'           => ($this->input->post('otherReligionName') != NULL) ? $this->input->post('otherReligionName') : '',
    
                    'physically_challenged'            =>$this->input->post('phy_challenged'),
                    'date_of_birth'                  =>$date,

                    'gender_id_fk'            =>$this->input->post('gender'),
                    'marital_status'            =>$this->input->post('marital_status'),
                    'kanyashree_no'            =>($this->input->post('kanyashree_no') ==NULL) ? NULL : $this->input->post('kanyashree_no'),

                    
                    'class_id_fk'           => $this->input->post('course_name_id'),
                    'phase'                     =>($this->input->post('batch_duration') != NULL) ? $this->input->post('batch_duration') : NULL,
                    'course_id_fk'                     =>($this->input->post('group_id') != NULL) ? $this->input->post('group_id') : NULL,
    
                    'updated_time'                => "now()",
                    'updated_ip'                  => $this->input->ip_address(),

                    
                    'nationality_id_fk'           => $this->input->post('citizenship'),
                    'address_2'                =>    $this->input->post('address_2'),
                    'address_3'                =>    $this->input->post('address_3'),
    
                );
                if (!empty($_FILES['std_image']['tmp_name'])) {

                    $update_data['image'] = base64_encode(file_get_contents($_FILES["std_image"]['tmp_name']));
                }
                if (!empty($_FILES['phy_challenged_doc']['tmp_name'])) {

                    $update_data['phy_challenged_doc'] = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                }
                if (!empty($_FILES['caste_doc']['tmp_name'])) {

                    $update_data['caste_doc'] = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                }
                if (!empty($_FILES['aadhar_doc']['tmp_name'])) {

                    $update_data['aadhar_doc'] = base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name']));
                }
                if (!empty($_FILES['std_signature']['tmp_name'])) {

                    $update_data['std_signature'] = base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name']));
                }

                if($this->input->post('citizenship') != 1){
                    if(!empty($_FILES['approval_doc']['tmp_name'])){

                        $update_data['citizenship_approval_doc'] = base64_encode(file_get_contents($_FILES["approval_doc"]['tmp_name']));
                    }
                }else{
                    $approval_doc = '';
                }

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $result = $this->student_reg_model->updateStudentData($id_hash, $update_data);

                if ($result) {

                    if ($course_name_id == 4){

                        $council_register = $this->input->post('haveRegisterNo');

                    }elseif ($course_name_id == 1) {
                        
                        $council_register = $this->input->post('haveHSRegisterNo');
                       
                    }
                    

                    $academicData = array(
                        
                        'last_academic_exam_id_fk'             => ($this->input->post('last_exam_id') == '') ? NULL : $this->input->post('last_exam_id'),
                        'board_id_fk'                           => ($this->input->post('board_name') == '')? NULL : $this->input->post('board_name'),
                        
                        'total_marks'                           => ($this->input->post('total_marks') == '') ? NULL : $this->input->post('total_marks'),
                        'aggregate_marks'                       => ($this->input->post('aggregate_marks') == '') ? NULL :$this->input->post('aggregate_marks'),
                        'percentage'                            => ($this->input->post('percentage_marks') == '') ? NULL : $this->input->post('percentage_marks'),
                        
                        'council_register'                      => $council_register,
                        
                        'ten_passing_year'          =>($this->input->post('ten_passing_year') == '') ? '' : $this->input->post('ten_passing_year'),
                        'ten_school_state'          =>($this->input->post('school_state') == '') ? NULL : $this->input->post('school_state'),
                        
                        'register_hs_course'        => ($this->input->post('register_hs_course') == '') ? NULL : $this->input->post('register_hs_course'),
                        'hs_passed'        => ($this->input->post('haveSHSPassed') == '') ? NULL : $this->input->post('haveSHSPassed'),
                    );

                    if ($course_name_id == 4){

                        if (!empty($_FILES['marksheet']['tmp_name'])) {

                           
                            $academicData['marksheet'] = base64_encode(file_get_contents($_FILES["marksheet"]['tmp_name']));
                        }

                        

                    }elseif ($course_name_id == 1) {
                        
                        

                        if (!empty($_FILES['hs_marksheet']['tmp_name'])) {

                           
                            $academicData['marksheet'] = base64_encode(file_get_contents($_FILES["hs_marksheet"]['tmp_name']));
                        }
                    }

                    
                    if($council_register == 1 && $council_register != ''){

                        $academicData['old_reg_no'] = $this->input->post('old_reg_no') ? $this->input->post('old_reg_no') : $this->input->post('old_hs_reg_no') ;
                        $academicData['old_reg_year'] = $this->input->post('old_reg_year') ? $this->input->post('old_reg_year') : $this->input->post('old_hs_reg_year');
                    }else{
                        $academicData['old_reg_no'] = '';
                        $academicData['old_reg_year'] = '';
                    }

                    // Migration Certificate
                    if(($course_name_id == 1) && ($this->input->post('school_state') != 19)){

                        if (!empty($_FILES['migration_certificate']['tmp_name'])) {

                           
                            $academicData['migration_certificate'] = base64_encode(file_get_contents($_FILES["migration_certificate"]['tmp_name']));
                        }

                    }else{
                        $academicData['migration_certificate'] = '';
                    }



                    //Transfer Certificate
                    if(($course_name_id == 1) && ($this->input->post('register_hs_course') == 1)){

                        if (!empty($_FILES['transfer_certificate']['tmp_name'])) {

                            $academicData['transfer_certificate'] = base64_encode(file_get_contents($_FILES["transfer_certificate"]['tmp_name']));
                        }
                    }else{
                        $academicData['transfer_certificate'] = '';
                    }

                    // echo "<pre>";print_r($academicData);exit;

                    $result_1 = $this->student_reg_model->updateStudentAcademicData($id_hash, $academicData);

                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Student details has been updated successfully.');
                    }

                    redirect('admin/vtc_student_admin/student_reg_admin/group_wise_student_list/'.md5($data['student_data']['institute_id_fk']).'/'.$data['student_data']['course_id_fk'],'refresh');

                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update student at this time, Please try later.');

                    redirect('admin/vtc_student_admin/student_reg_admin/group_wise_student_list/'.md5($data['student_data']['institute_id_fk']).'/'.$data['student_data']['course_id_fk'],'refresh');
                }

            }
        }else{

            $this->load->view($this->config->item('theme').'vtc_student_admin/student_reg_details_view',$data);
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
}