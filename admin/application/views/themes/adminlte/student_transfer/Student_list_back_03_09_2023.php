<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_list extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();

        parent::check_privilege(158);
        $this->load->model('institute_student/student_list_model');
        $this->load->model('affiliation/details_model');
		$this->load->model('student_profile/std_registration_model');
        $this->load->helper('email');
        $this->load->library('sms');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'institute_student/student.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            4 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			5 => $this->config->item('theme_uri').'jQuery.print.min.js'
        );
    }

    public function index( $offset = 0){

       $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        // echo '<pre>';print_r($data['vtc_id'] );
         $data['academic_year']  = "2022-23";
         //echo '<pre>';print_r($data['academic_year'] );die;
        // $data['academic_year']  = $this->config->item('previous_academic_year'); // Previous Year
       
        $data['offset']         = $offset;

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        $config['base_url']         = 'institute_student/Student_list/index/';
        $data["total_rows"] = $config['total_rows']       = $this->student_list_model->get_student_count($data['vtc_id'],$data['academic_year'])[0]['count'];
        $config['per_page']         = 52;
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



        $data['student_data_list'] = $this->student_list_model->getInsStudentList($config['per_page'],$offset,$data['vtc_id'],$data['academic_year']);

           //echo '<pre>'; print_r($data['student_data_list']) ; die;
        // added on 27-02-2023//
        if($this->input->post("aadhar") != NULL){
            $aadhar_search = $this->input->post("aadhar");

            // echo "</pre>"; print_r($search_array["stud.aadhar_no"]); 

        }
        // $aadhar_search =0
		
        if(count($aadhar_search)){
           
			$data['student_data_list'] = $this->student_list_model->get_aadhar_search($aadhar_search,$data['vtc_id'],$data['academic_year']);

        }
		//echo '<pre>'; print_r($data['student_data_list']) ; die;
		// end

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
                    'admission_type'     => $this->input->post('admission_type'),
                    'approve_reject_time'   => 'now()',
                );

                // echo "<pre>";print_r($updArray);exit;

                $approveStatus = $this->student_list_model->updateStudentData($std_id_hash,$updArray);

                

                if ($approveStatus) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Institution successfully approved.');
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


    public function studentViewByInstitute($institute_id_fk = Null, $inst_stud_id_pk = Null)
    {

          // echo  $institute_id_fk  .'-----'.
          // $inst_stud_id_pk; die;
       
       $data['exam_type'] = $this->student_list_model->getAllExamType();
       $data['nationality']  = $this->student_list_model->get_nationality();
       $data['salutations'] =  $this->student_list_model->get_salutation();
        $data['genders'] =  $this->student_list_model->get_gender();
        $data['casteList']  = $this->student_list_model->get_caste();
        $data['religion']  = $this->student_list_model->get_religion();
        $data['stateList']  = $this->student_list_model->getAllState();
        $data['board_name']  = $this->student_list_model->getAllBoard();

     $data['app_data'] = $this->student_list_model->studentviewByIns($institute_id_fk,$inst_stud_id_pk);
	 
	 //modify by amit on 04-05-2023
		$data['entrance'] = $this->std_registration_model->check_enrance($data['app_data']['exam_type_id_fk']);

		if($data['entrance'] == 0){
           $data['eligible_criteria'] =  $this->std_registration_model->getEligibilityCriteria($data['app_data']['exam_type_id_fk']);
           //echo "<pre>";print_r($data['eligible_criteria'] );exit;
        }
        
         //  echo '<pre>'; print_r($data['app_data']); die;

       if ($this->input->server("REQUEST_METHOD") == 'POST') {

        $formData['ins_code'] = set_value('vtcCode');
        $formData['exam_type_id'] = set_value('exam_type_id');
		$formData['course_id'] = set_value('course_id');
        $formData['state_id_fk']  = set_value('state');
        $formData['district_id_fk']  = set_value('district');
        $formData['sub_division_id_fk']  = set_value('subDivision');
        $formData['municipality_id_fk']  = set_value('municipality');
        $formData['caste_id']  = set_value('caste_id');

        $formData['phy_challenged']  = set_value('phy_challenged');
        $formData['citizenship']  = set_value('citizenship');

        $formData['gender']  = set_value('gender');
        $formData['marital_status']  = set_value('marital_status');
        $formData['board_id']  = set_value('board_id');
		$formData['eligible_criteria']  = set_radio('eligible_criteria');
    } else {

        $formData['ins_code'] = $data['app_data']['vtc_code'];
        $formData['exam_type_id'] = $data['app_data']['exam_type_id_fk'];
        $formData['course_id'] = $data['app_data']['course_id_fk'];

        $formData['state_id_fk']  = $data['app_data']['state_id_fk'];
        $formData['district_id_fk']  = $data['app_data']['district_id_fk'];
        $formData['sub_division_id_fk']  = $data['app_data']['sub_div_id_fk'];
        $formData['municipality_id_fk']  = $data['app_data']['municipality_id_fk'];
       
        $formData['caste_id']  = $data['app_data']['caste_id_fk'];
        // $formData['gender']  = $data['app_data']['caste_id_fk'];
        $formData['phy_challenged']  = $data['app_data']['handicapped'];
        $formData['citizenship']  = $data['app_data']['nationality_id_fk'];

        $formData['gender']  = $data['app_data']['gender_id_fk'];
        $formData['marital_status']  = $data['app_data']['marital_status'];
        $formData['board_id'] = $data['app_data']['board_id_pk'];
		$formData['eligible_criteria'] = $data['app_data']['eligibility_criteria_id_fk'];
    }

    if($formData['ins_code'] !='' && $formData['exam_type_id']!=''){

        $data['course'] = $this->student_list_model->getCourseByCode($formData['ins_code'],$formData['exam_type_id']);
     }

    if (!empty($formData['state_id_fk'])) {
        $data['district'] = $this->student_list_model->getDistrictByStateId($formData['state_id_fk']);
    }

    if (!empty($formData['district_id_fk'])) {
        $data['sub_division'] = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
    }

    if (!empty($formData['sub_division_id_fk'])) {
        $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($formData['sub_division_id_fk']);
    }

    if (!empty($formData['district_id_fk'])) {
        if ($formData['district_id_fk'] == 16) {

            $kolkataArray = array(
                0 => 682, // KOLKATA NORTH 
                1 => 683, // KOLKATA SOUTH
                2 => 16, // KOLKATA
            );

            $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
            $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
        } elseif (($formData['district_id_fk'] == 682) || ($formData['district_id_fk'] == 683)) {

            $kolkataArray = array(
                0 => $formData['district_id_fk'], // SOUTH / NORTH KOLKATA
                1 => 16, // KOLKATA
            );

            $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
            $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
        } else {

            $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
            $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($formData['district_id_fk']);
        }
    }
    $data['formData'] = $formData;

    if ($this->input->server("REQUEST_METHOD") == 'POST') {
        //echo "<pre>";print_r($_FILES);exit;
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
		
		//modify on 04-05-2023
		if($data['entrance'] == 0){

			$config = array(

				array('field' => 'eligible_criteria', 'label' => 'Eligibility Criteria', 'rules' => 'trim|required')
			);
			
			if ($data['app_data']['marksheet_doc'] == '') {

				$this->form_validation->set_rules('marksheet_doc', 'Marksheet Document', 'trim|callback_file_validation[marksheet_doc|application/pdf|200|required]');
			} else {
				$this->form_validation->set_rules('marksheet_doc', 'Marksheet Document', 'trim|callback_file_validation[marksheet_doc|application/pdf|200|]');
			}
			
			

			

		}else{
			$config = array(

				array('field' => 'fullmark', 'label' => 'Full Marks', 'rules' => 'trim|required',),
				array('field' => 'marks_obtain', 'label' => 'Marks Obtained', 'rules' => 'trim|required',),
				array('field' => 'percentage', 'label' => 'Percentage', 'rules' => 'trim|required',),
				array('field' => 'institute_name', 'label' => 'Institute Name', 'rules' => 'trim|required',),
				array('field' => 'passing_year', 'label' => 'Passing Year', 'rules' => 'trim|required',),
				array('field' => 'board_id', 'label' => 'Board Name', 'rules' => 'trim|required',),
			);
		}

        $config = array(

            array('field' => 'fname', 'label' => 'First Name', 'rules' => 'trim|required',),

            array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required',),

            // array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

            // array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

            array('field' => 'guardian_name', 'label' => 'Guardian Name', 'rules' => 'trim|required',),

            array('field' => 'guardian_relation', 'label' => 'Relationship with Guardian', 'rules' => 'trim|required',),

            array('field' => 'aadhar_no', 'label' => 'Aadhar Number', 'rules' => 'trim|required'),

            array('field' => 'email_id', 'label' => 'Email ID', 'rules' => 'trim|required',),

            array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required',),

            array('field' => 'district', 'label' => 'District', 'rules' => 'trim|required',),


            array('field' => 'pinCode', 'label' => 'Pin Code', 'rules' => 'trim|required|exact_length[6]|numeric',),

            array('field' => 'caste_id', 'label' => 'Caste', 'rules' => 'trim|required',),

            array('field' => 'phy_challenged', 'label' => 'Physically Challenged', 'rules' => 'trim|required',),

            array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required',),

            // array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

            array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required',),

            array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),

            array('field' => 'citizenship', 'label' => 'Citizenship', 'rules' => 'trim|required'),

            array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),

            //array('field' => 'fullmark', 'label' => 'Full Marks', 'rules' => 'trim|required',),

            //array('field' => 'marks_obtain', 'label' => 'Marks Obtained', 'rules' => 'trim|required',),
            //array('field' => 'percentage', 'label' => 'Percentage', 'rules' => 'trim|required',),
            //array('field' => 'institute_name', 'label' => 'Institute Name', 'rules' => 'trim|required',),
            //array('field' => 'passing_year', 'label' => 'Passing Year', 'rules' => 'trim|required',),
            //array('field' => 'board_id', 'label' => 'Board Name', 'rules' => 'trim|required',),
            // array('field' => 'kanyashree_no', 'label' => 'Kanyashree Enrollment No', 'rules' => 'trim|required'),
			 array('field' => 'mob_no', 'label' => 'Mobile Number', 'rules' => 'trim|required|exact_length[10]|numeric')


        );
        if ($this->input->post('state') == 19) {
            $config[] = array('field' => 'subDivision', 'label' => 'Sub Division', 'rules' => 'trim|required');
            $config[] = array('field' => 'municipality', 'label' => 'Municipality', 'rules' => 'trim|required');
        }

        if($this->input->post('gender')== 2 && $this->input->post('marital_status')== 2){
            $config[]=array('field' => 'kanyashree_no', 'label' => 'Kanyashree Enrollment No', 'rules' => 'trim');
        }
        if ($this->input->post('caste_id') != 1) {

            if ($data['app_data']['caste_doc'] == '') {

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');
            }else{

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|]');
            
            }
        }
        
        
        
        if ($this->input->post('phy_challenged') == 1) {
            if ($data['app_data']['phy_challenged_doc'] == '') {

                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');
            } else {
                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|]');
            }
        }

        if ($this->input->post('citizenship') != 1) {
            
            if ($data['app_data']['citizenship_approval_doc'] == '') {
            $this->form_validation->set_rules('citizenship_doc', 'Citizenship Document', 'trim|callback_file_validation[citizenship_doc|application/pdf|200|required]');
            }else{
                $this->form_validation->set_rules('citizenship_doc', 'Citizenship Document', 'trim|callback_file_validation[citizenship_doc|application/pdf|200|]'); 
            }
        }
        if ($data['app_data']['aadhar_doc'] == '') {

            $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
        } else {
            $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|]');
        }

           // photo sign validation //

           if ($data['app_data']['picture'] == '') {

            $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100|required]');
        } else {
            $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100|]');
        }

        if ($data['app_data']['sign'] == '') {

            $this->form_validation->set_rules('sign', 'Signature', 'trim|callback_file_validation[sign|image/jpeg|100|required]');
        } else {
            $this->form_validation->set_rules('sign', 'Signature', 'trim|callback_file_validation[sign|image/jpeg|100|]');
        }

        // end code//

        if($formData['exam_type_id'] == 3){
                
            $config[]= array('field' => 'phy_marks', 'label' => 'Marks Physics', 'rules' => 'trim|required');
            $config[]= array('field' => 'chem_marks', 'label' => 'Marks of Chemistry', 'rules' => 'trim|required');
            $config[]= array('field' => 'math_bio_marks', 'label' => 'Marks of  Life Science or Biology /Mathematics', 'rules' => 'trim|required');
        }

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == TRUE) {
            $data['validate_error'] = 0;
			
			if ($data['entrance'] == 0){

				if($_FILES["marksheet_doc"]['tmp_name'] != ''){
					$marksheet_doc = base64_encode(file_get_contents($_FILES["marksheet_doc"]['tmp_name']));
				}else{
					$marksheet_doc = $data['app_data']['marksheet_doc'];
				}

				$edu_qualification = array(
					"eligibility_criteria_id_fk" => $this->input->post("eligible_criteria"),
					"marksheet_doc" => $marksheet_doc
				);

			}

            
            if($this->input->post("citizenship") == 2){
                if($_FILES["citizenship_doc"]['tmp_name'] != ''){
                    $citizenship_doc = base64_encode(file_get_contents($_FILES["citizenship_doc"]['tmp_name']));
                }else{
                    $citizenship_doc = $data['app_data']['citizenship_approval_doc'];
                }
            }else{
                $citizenship_doc = '';
            }
            
            if($this->input->post("caste_id") != 1){
                
                    
                    if($_FILES["caste_doc"]['tmp_name'] != ''){
                        $caste_doc = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                    }else{
                        $caste_doc = $data['app_data']['caste_doc'];
                    }
                
            }else{
                $caste_doc = '';
            }
            
            if($this->input->post("phy_challenged") == 1){
                if($_FILES["phy_challenged_doc"]['tmp_name'] != ''){
                    $phy_challenged_doc = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                }else{
                    $phy_challenged_doc = $data['app_data']['phy_challenged_doc'];
                }
            }else{
                $phy_challenged_doc = '';
            }
            
            if($_FILES["aadhar_doc"]['tmp_name'] != ''){
                $aadhar_doc = base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name']));
            }else{
                $aadhar_doc = $data['app_data']['aadhar_doc'];
            }


            if($_FILES["photo"]['tmp_name'] != ''){
                $picture = base64_encode(file_get_contents($_FILES["photo"]['tmp_name']));
            }else{
                $picture = $data['app_data']['picture'];
            }

            if($_FILES["sign"]['tmp_name'] != ''){
                $sign = base64_encode(file_get_contents($_FILES["sign"]['tmp_name']));
            }else{
                $sign = $data['app_data']['sign'];
            }


            if($data['app_data']['exam_type_id_fk'] == 3){
                $edu_qualification['phy_marks'] = $this->input->post("phy_marks");
                $edu_qualification['chem_marks'] = $this->input->post("chem_marks");
                $edu_qualification['math_bio_marks'] = $this->input->post("math_bio_marks");
            }

            $qua_status = $this->student_list_model->updateStdQualifiDetails($data['app_data']['institute_student_details_id_pk'], $edu_qualification);
            
            $tmp_date = explode('-', $this->input->post('dob'));
            $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
            $date = date_format($date, "Y-m-d");


            $basic_details = array(


               "course_id_fk" => $this->input->post("course_id"),
               "exam_type_id_fk" => $this->input->post("exam_type_id"),
               "institute_d_save_status" => 1,

                "first_name" => $this->input->post("fname"),
                "middle_name" => $this->input->post("mname"),
                "last_name" => $this->input->post("lname"),
                "father_name" => $this->input->post("father_name"),
                "mothers_name" => $this->input->post("mother_name"),
                "guardian_name" => $this->input->post("guardian_name"),
                "guardian_relationship" => $this->input->post("guardian_relation"),
                "nationality_id_fk" => $this->input->post("citizenship"),
                "citizenship_approval_doc"     => $citizenship_doc,
                "email" => $this->input->post("email_id"),
                "address" => $this->input->post("address"),
                "address_2" => $this->input->post("address_2"),
                "address_3" => $this->input->post("address_3"),
                "state_id_fk" => $this->input->post("state"),
                "district_id_fk" => $this->input->post("district"),
                "sub_div_id_fk" => ($this->input->post("subDivision") != NULL) ? $this->input->post("subDivision") : NULL,
                "municipality_id_fk" => ($this->input->post("municipality") != NULL) ? $this->input->post("municipality") : NULL,
                "pincode" => $this->input->post("pinCode"),
                "caste_id_fk" => $this->input->post("caste_id"),
                "caste_doc"     => $caste_doc,
                "religion_id_fk" => $this->input->post("religion_id"),
                "handicapped" => $this->input->post("phy_challenged"),
                "phy_challenged_doc"     => $phy_challenged_doc,
                "date_of_birth" => $date,
                "aadhar_doc"     => $aadhar_doc,
                "gender_id_fk" => $this->input->post("gender"),
                "marital_status" => $this->input->post("marital_status"),
                "kanyashree_no" => ($this->input->post("kanyashree_no") == NULL) ? NULL : $this->input->post("kanyashree_no"),
                "basic_d_save_status" => 1,

                "picture"     => $picture,
                "sign"     => $sign,
                "photo_sign_save_status" => 1,

                "fullmarks" => ($this->input->post("fullmark") == NULL) ? NULL :$this->input->post("fullmark"),
                "marks_obtain" => ($this->input->post("marks_obtain") == NULL) ? NULL : $this->input->post("marks_obtain"),
                "percentage" => ($this->input->post("percentage") == NULL) ? NULL : $this->input->post("percentage"),
                "cgpa" => ($this->input->post("c_g_p_a") == Null)? NULL :$this->input->post("c_g_p_a"),

                "institute_name" => $this->input->post("institute_name"),
                "year_of_passing" => $this->input->post("passing_year"),
                "qualification_d_save_status" => 1,
				"board_id_pk" => ($this->input->post("board_id") == NULL) ? NULL : $this->input->post("board_id"),


                "updated_time" => "now()",
                "updated_ip" => $this->input->ip_address(),
                "updated_by" => $this->session->userdata('stake_details_id_fk'),
				"mobile_number" => $this->input->post("mob_no")

            );
			//Added by abhijit on 10-03-2023 start
			$login_update_array = array(

                "mobile_no" => $this->input->post("mob_no"),
                "stake_holder_details" => $this->input->post("fname") . ' ' . $this->input->post("mname") . ' ' . $this->input->post("lname"),
                "update_time" => "now()",
                "update_ip" => $this->input->ip_address()
                // "updated_by" => $this->session->userdata('stake_details_id_fk')

            );

			$spot_council_data = array(

                
                'mobile_number'    => $this->input->post("mob_no")
                
            );
           $spot_id_fk = $data['app_data']['spotcouncil_student_details_id_fk'];
		   
			//Added by abhijit on 10-03-2023 end
             // echo "<pre>";print_r($basic_details);
           $s= $data['app_data']['institute_student_details_id_pk'];
           // $t=$data['app_data']['institute_id_fk'];
		   
            $this->db->trans_start();
            $status = $this->student_list_model->updateStdDetails($s,$basic_details);
            // echo $status;die;
			
            if ($status == 1) {
                    $data['validate_error'] = 1;
                // echo "true"; die;

                //$this->session->set_flashdata('status', 'success');
                //$this->session->set_flashdata('alert_msg', 'Your data successfully saved.');
                // redirect('online_application_various_courses/registration','refresh');
				
				$login_update = $this->student_list_model->updateLoginDetails($spot_id_fk, $login_update_array);

                $spotcouncil_update = $this->student_list_model->updateSpotDetails($spot_id_fk, $spot_council_data);

                    

                if ($this->db->trans_status() === FALSE) {
                    # Something went wrong.
                    $this->db->trans_rollback();

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update data at this time, Please try later.');

                } else {

					$this->db->trans_commit();


					$this->session->set_flashdata('status', 'success');
					$this->session->set_flashdata('alert_msg', 'Your data successfully updated.');
                    
                } 


            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'have an error.');
            }
        }else {
            $data['validate_error'] = 1;
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
        }
}

       $this->load->view($this->config->item('theme') . 'institute_student/institute_std_details_view',$data);
    }

    public function download_citizenship_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_citizen_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=Citizenship-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['citizenship_approval_doc']);
        } else {
            show_404();
        }
    }

    public function download_caste_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_caste_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=Caste-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['caste_doc']);
        } else {
            show_404();
        }
    }

    public function download_handicap_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_handicap_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=handicap-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['phy_challenged_doc']);
        } else {
            show_404();
        }
    }


    public function download_aadhaar_doc($id_hash = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_aadhaar_file_content($id_hash);
         //echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=aadhaar-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['aadhar_doc']);
        } else {
            show_404();
        }
    }

    public function getCourseByInsCode($vtc_code = null,$exam_type_id =null)
    {
        // echo $this->input->is_ajax_request(); die;
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $vtc_code = $this->input->get('vtc_code');
            $exam_type_id = $this->input->get('exam_type_id');

            $course = $this->student_list_model->getCourseByCode($vtc_code, $exam_type_id);
            // echo "<pre>";print_r($course);exit;

            if (!empty($course)) {


                echo json_encode($course);
            }
        }
    }

    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->student_list_model->getDistrictByStateId($state_id);

            if (!empty($district)) {


                echo json_encode($district);
            }
        }
    }

    public function getSubDivision($district_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if ($district_id == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );

                $nodalOfficer     = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($district_id == 682) || ($district_id == 683)) {

                $kolkataArray = array(
                    0 => $district_id, // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $district_id  = 16;

                $nodalOfficer = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $nodalOfficer = $this->details_model->getNodalOfficerByDistrictId($district_id);
            }

            $subDivisionHtml = '<option value="" hidden="true">Select Sub Division</option>';
            $subDivision     = $this->details_model->getSubDivisionByDistrictId($district_id);



            $nodalOfficerHtml = '<option value="" hidden="true">Select Nodal</option>';

            if (!empty($nodalOfficer)) {

                foreach ($nodalOfficer as $key => $value) {
                    $nodalOfficerHtml .= '
                            <option value="' . $value['nodal_officer_id_pk'] . '">
                                ' . $value['nodal_centre_name'] . '
                            </option>
                        ';
                }
            } else {

                $nodalOfficerHtml .= '<option value="" disabled="true">No Data found.</option>';
            }

            $response = array(
                // 'subDivisionHtml'  => $subDivisionHtml,
                'subDivision'  => $subDivision,
                'nodalOfficerHtml' => $nodalOfficerHtml,
            );

            echo json_encode($response);
        }
    }

    public function getMunicipality($sub_division_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select Municipality</option>';
            $municipality = $this->details_model->getMunicipalityByDivisionId($sub_division_id);

            if (!empty($municipality)) {

                echo json_encode($municipality);
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


    public function getBanglashikhshaStudentDetails($std_code = NULL){

        $this->load->helper('banglashiksha');
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
            if(!empty($std_code)){

                // $std_code = '06604719002823';
                // $student_data = gettingStudentDetailsByBanglaShikshaCode($std_code);
                // echo "<pre>";print_r($student_data);exit;

                $insertData = array(
                    'student_code' => $std_code,
                    'entry_time'  => 'now()'

                );

                $insert_id = $this->student_list_model->insertData('council_banglashiksha_api_json_data', $insertData);

                $post_data = array(
                    'std_code' => $std_code
                );
                //$url = 'http://localhost/council_live/api_rest_server/vtc_student/banglashiksha/gettingStudentDetailsByBanglaShikshaCode';
				$url = 'http://172.20.140.171/api_rest_server/vtc_student/banglashiksha/gettingStudentDetailsByBanglaShikshaCode';
                $this->load->library('curl');
                $curl_response = $this->curl->curl_make_post_request($url, $post_data);
                $data_response = json_decode($curl_response, true);
                $student_data = $data_response['student_details'];
                 //echo "<pre>";print_r($student_data);exit;
                if(!empty($student_data)){

                    $district_id = gettingDistrictId($student_data['StuContactDistrict']);
                    $block_details  = gettingBlockId($student_data['StuContactBlock']);
                    // echo "<pre>";print_r($block_details);exit;
                    $block_id = $block_details['block_municipality_id_pk'];
                    $subdiv_id   = $block_details['subdiv_id_fk'];
                    $caste_id  = gettingCasteId($student_data['SocialCategoryCode']);
                    $religion_id = gettingReligionId($student_data['ReligionCode']);
                    $gender = gettingGender($student_data['GenderCode']);
                    $phy_challenged = ($student_data['CwsnYesNoCode'] != NULL) ? $student_data['CwsnYesNoCode'] : NULL;
                    //echo $student_data['StudentName'];exit;
                    $name = explode(' ', $student_data['StudentName']);
                    // echo"<pre>";print_r($name);exit;
                    $first_name = explode(' ', trim($student_data['StudentName']))[0];
                    $last_name = array_pop($name);
                    

                    $update_data = array(
                        'transaction_id' => $student_data['TransactionId'],
                        'json_data'     => json_encode($data_response)
                    );
                    $this->student_list_model->update_json_table_data($insert_id, $update_data);

                    $res = array(
                        'fullname' => $student_data['StudentName'],
                        // 'first_name'   =>  $first_name,
                        // 'last_name'   =>  $last_name,
                        'guardianName'  => $student_data['GuardianName'],
                        'fatherName'    => $student_data['FatherName'],
                        'aadhaarNumber' => $student_data['AadhaarNumber'],
                        'stuMobile' => $student_data['StuMobile'],
                        'nationality' => $student_data['NationalityCode'],
                        'state'   => $student_data['StuContactStateCode'],
                        'district' => $district_id,
                        'subdivision' => $subdiv_id,
                        'block'       => $block_id,
                        'stuContactPin' => $student_data['StuContactPin'],
                        'caste'         => $caste_id,
                        'religion'      => $religion_id,
                        'gender'        => $gender,
                        // 'phy_challenged' => $phy_challenged,
                        'date_of_birth'    => date('d-m-Y',strtotime($student_data['StuDob']))
                    );
                    echo json_encode($res);
                }
            }

           
        }
        
    }
	
	//Added by Moli on 25-03-2023
    //Mark Eligibility For Exam
    public function mark_eligible_student(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $stdIdArray = $this->input->get('stdIdArray');
            //echo "<pre>";print_r($stdIdArray);exit;

            if($stdIdArray){

                $upd_data = array(
                    'eligible_for_exam' => 1
                );
                $status = $this->student_list_model->updateStdEligibility($stdIdArray,$upd_data);
                if($status){
                    echo json_encode('done');
                }
            }
        }
    }
	
	public function download_marksheet_doc($id_hash = NULL)
    {

        //echo $id; die;
        $file_content = $this->std_registration_model->get_student_marksheet_file_content($id_hash);
         //echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=aadhaar-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['marksheet_doc']);
        } else {
            show_404();
        }
    }

/*** ADDED BY AVIJIT 23-03-2023 **/
 public function download_misinst_end()
     {
       
           $data['academic_year']  = "2022-23";

           $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');

                $this->load->library('excel');
        
                $fileName    = 'All Student Details List - ' . date('dmyhis') . '.xls';
                $objPHPExcel = new PHPExcel();
        
                $objPHPExcel->setActiveSheetIndex(0);
                $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SL.NO')
                    ->SetCellValue('B1', 'REG. NO')
                    ->SetCellValue('C1', 'CANDIDATE NAME')
                    ->SetCellValue('D1', 'GUARDIAN NAME')
                    ->SetCellValue('E1', 'COURSE NAME')
                    ->SetCellValue('F1', 'AADHAR NO')
                    ->SetCellValue('G1', 'EXAM TYPE')
                    ->SetCellValue('H1', 'STATUS')
                    ->SetCellValue('I1', 'ADMISSION TYPE - COUNSELLING/ MANAGEMENT/OTHERS')
                    ->SetCellValue('J1', 'MOBILE NO')
                    ->SetCellValue('K1', 'EMAIL ID')
                    ;
        
                $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
               
        
                /*================================== Excel style array starts ==================================*/
                $styleArray = array(
                    'borders' => array(
                        'inside'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => '000000'
                            )
                        ),
                        'outline'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => '000000'
                            )
                        )
                    ),
                    'font' => array(
                        'bold' => true,
                        'name'  => 'Cambria'
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical'     => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'F0FFF0')
                    )
        
                );
        
                $styleCellArray = array(
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    ),
                    'borders' => array(
                        'inside'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => '000000'
                            )
                        ),
                        'outline'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => '000000'
                            )
                        )
                    ),
                    'font' => array(
                        'name'  => 'Cambria'
                    ),
                );
        
                $styleArrayFooter = array(
                    'borders' => array(
                        'inside'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => '000000'
                            )
                        ),
                        'outline'     => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN,
                            'color' => array(
                                'argb' => '000000'
                            )
                        )
                    ),
                    'font' => array(
                        'bold' => true,
                        'name'  => 'Cambria'
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                        'vertical'     => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    ),
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'FFF0F5')
                    )
        
                );
                /*=============================== Excel style array ends ===============================*/
        
                $objPHPExcel->getActiveSheet()->getStyle('A1:K1')->applyFromArray($styleArray);
                $row = 2;
        
                // getInsStudentList 
            $studentUnderInstitute = $this->student_list_model->getInsStudentListforMis($data['vtc_id'] ,$data['academic_year']);
                 
                  //  echo '<pre>'; print_r($studentUnderInstitute); die;
               
                foreach ($studentUnderInstitute as $value) {


                    if($value['approve_reject_status'] ==1){
                        $approve_reject_status = 'Approved';
                    }else if($value['approve_reject_status'] ==2){
                        $approve_reject_status = 'Reapproved';
                    }else if($value['approve_reject_status'] ==0){
                        $approve_reject_status = 'Rejected';
                    }else
                    {
                        $approve_reject_status='';
                    }

                    if($value['admission_type'] ==1){

                        $addmission = 'JEXPO/VOCLET/PHARMACY Counselling';
                    }else if($value['admission_type'] ==2){
                        $addmission = 'Under Management Quota';
                    }else if(['admission_type'] ==3){
                        $addmission = 'Other form of Admission';
                    }else{
        
                    } 

                    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['reg_certificate_number']);
					$objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, '');
                    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $value['first_name'].' '.$value['middle_name'].' '.$value['last_name']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $value['guardian_name']);
                    
                    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $value['discipline_name']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $value['aadhar_no']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $value['name_for_std_reg']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $approve_reject_status);
                    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $addmission);
                    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $value['mobile_number']);
                    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $value['email']);
                 
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':K' . $row)->applyFromArray($styleCellArray);
                    $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':K' . $row)->getAlignment()->setWrapText(true);
                    $row++;
                }
        
                $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':K' . $row);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':K' . $row)->applyFromArray($styleArrayFooter);
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));
        
                // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . $fileName . '"');
                header('Cache-Control: max-age=0');
        
                $objWriter->save('php://output');
        
                redirect('admin/institute_student/student_list');
            
        }

/*******************************************************/

    

}
?>