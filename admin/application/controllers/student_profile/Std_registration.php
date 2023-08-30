<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_registration extends NIC_Controller
{
    function __construct()
    {
		
        parent::__construct();
        parent::check_privilege(160);
        $this->load->model('student_profile/std_registration_model');
        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
            2 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri') . "student_profile/student_reg.js",
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            4 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			5 => $this->config->item('theme_uri').'jQuery.print.min.js'
        );
    }
	
	public function index(){
		
        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['stake_id_fk']         = $this->session->userdata('stake_id_fk');
        $data['app_data']    = $this->std_registration_model->getStdDetails(md5($data['std_id']), $data['stake_id_fk']);
        
        //echo '<pre>'; print_r($data['app_data']) ; die;

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
			//echo "if";exit;
            $form_data['ins_code'] = set_value('vtcCode');
            $form_data['exam_type_id'] = set_value('exam_type_id');
			$form_data['course_id'] = set_value('course_id');
        }else{
			//echo "else";exit;
            $form_data['ins_code'] = $data['app_data']['vtc_code'];
            $form_data['exam_type_id'] = $data['app_data']['exam_type_id_fk'];
			$form_data['course_id'] = $data['app_data']['course_id_fk'];
        }
        if($form_data['ins_code'] !='' && $form_data['exam_type_id']!=''){

           $data['course'] = $this->std_registration_model->getCourseByCode($form_data['ins_code'],$form_data['exam_type_id']);
        }
        $data['form_data'] = $form_data;
		
        $data['active_class'] = 'ins_details';
		$data['exam_type'] = $this->std_registration_model->getAllExamType();

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
			//echo "<pre>";print_r($_POST);exit;

            $course_id_fk = array(
               "course_id_fk" => $this->input->post("course_id"),
               "exam_type_id_fk" => $this->input->post("exam_type_id"),
               "institute_d_save_status" => 1
            );
            $status = $this->std_registration_model->updateInstituteDetails($data['app_data']['institute_student_details_id_pk'], $course_id_fk);

            if ($status == 1) {
                  
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Your data successfully updated.');
                // redirect('online_application_various_courses/registration','refresh');
        
        
            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'have an error.');
            }
        }
      
        $this->load->view($this->config->item('theme') . 'student_profile/institute_details_view', $data);
	}
	
	public function basic_details()
    {
		//echo "hii";exit;
		//echo "<pre>";print_r($_POST);exit;
        $data['stake_id_fk']         = $this->session->userdata('stake_id_fk');

        $data['salutations'] =  $this->std_registration_model->get_salutation();
        $data['genders'] =  $this->std_registration_model->get_gender();
        //$data['districtList']  = $this->affiliation_model->getDistrictList();
        $data['casteList']  = $this->std_registration_model->get_caste();
        $data['religion']  = $this->std_registration_model->get_religion();
        $data['nationality']  = $this->std_registration_model->get_nationality();
        $data['stateList']  = $this->std_registration_model->getAllState();
		
		$data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['active_class'] = 'basic_details';
        $data['app_data']    = $this->std_registration_model->getStdDetails(md5($data['std_id']),$data['stake_id_fk']);
		//echo "<pre>";print_r($data['app_data']);exit;
		
		if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $formData['state_id_fk']  = set_value('state');
            $formData['district_id_fk']  = set_value('district');
            $formData['sub_division_id_fk']  = set_value('subDivision');
            $formData['municipality_id_fk']  = set_value('municipality');
            $formData['caste_id']  = set_value('caste_id');

            $formData['phy_challenged']  = set_value('phy_challenged');
            $formData['citizenship']  = set_value('citizenship');

            $formData['gender']  = set_value('gender');
            $formData['marital_status']  = set_value('marital_status');
        } else {
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
        }
		
		if ($formData['state_id_fk']!='') {
            $data['district'] = $this->std_registration_model->getDistrictByStateId($formData['state_id_fk']);
        }
		
		if ($formData['district_id_fk']!='') {
            $data['sub_division'] = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
        }

        if ($formData['sub_division_id_fk']!='') {
            $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($formData['sub_division_id_fk']);
        }
		
		if ($formData['district_id_fk']!='') {
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
		
		//echo "<pre>";print_r($data['app_data']);exit;
		
		if ($this->input->server("REQUEST_METHOD") == 'POST') {
			//echo "<pre>";print_r($_FILES);exit;
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array('field' => 'fname', 'label' => 'First Name', 'rules' => 'trim|required'),

                array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required'),

                // array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                // array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                array('field' => 'guardian_name', 'label' => 'Guardian Name', 'rules' => 'trim|required'),

                array('field' => 'guardian_relation', 'label' => 'Relationship with Guardian', 'rules' => 'trim|required'),

                array('field' => 'aadhar_no', 'label' => 'Aadhar Number', 'rules' => 'trim|required'),

                array('field' => 'email_id', 'label' => 'Email ID', 'rules' => 'trim|required'),

                array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),

                array('field' => 'district', 'label' => 'District', 'rules' => 'trim|required'),


                array('field' => 'pinCode', 'label' => 'Pin Code', 'rules' => 'trim|required|exact_length[6]|numeric'),

                array('field' => 'caste_id', 'label' => 'Caste', 'rules' => 'trim|required'),

                array('field' => 'phy_challenged', 'label' => 'Physically Challenged', 'rules' => 'trim|required'),

                array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required'),

                // array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),

                array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),

                array('field' => 'citizenship', 'label' => 'Citizenship', 'rules' => 'trim|required'),

                array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required')
                // array('field' => 'kanyashree_no', 'label' => 'Kanyashree Enrollment No', 'rules' => 'trim|required'),


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

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {
				$data['validate_error'] = 0;
				
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
					//if($data['app_data']['caste_doc'] !=''){
						
						if($_FILES["caste_doc"]['tmp_name'] != ''){
							$caste_doc = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
						}else{
							$caste_doc = $data['app_data']['caste_doc'];
						}
					//}else{
					//	$caste_doc = '';
					//}
					
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
				
				$tmp_date = explode('-', $this->input->post('dob'));
				$date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
				$date = date_format($date, "Y-m-d");

                $basic_details = array(

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


                    "entry_time" => "now()",
                    "entry_ip" => $this->input->ip_address()

                );
				//echo "<pre>";print_r($basic_details);exit;

                // echo '<pre>';
                // print_r($basic_details);
                // die;

                $status = $this->std_registration_model->updateStdDetails($data['app_data']['institute_student_details_id_pk'], $basic_details);
                // echo $status;die;

                if ($status == 1) {
						$data['validate_error'] = 1;
                    // echo "true"; die;

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Your data successfully saved.');
                    // redirect('online_application_various_courses/registration','refresh');


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
        // echo "<pre>";print_r($data);exit;
        $this->load->view($this->config->item('theme') . 'student_profile/student_basic_details_view', $data);
	}
	
	public function photo_signature()
    {
      

        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['stake_id_fk']         = $this->session->userdata('stake_id_fk');
        $data['active_class'] = 'photoSign';
        $data['app_data']    = $this->std_registration_model->getStdDetails(md5($data['std_id']));
        // echo "<pre>";print_r($data['std_details']);exit;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        // $config = array(
        //     array('field' => 'sign', 'label' => 'Signature', 'rules' => 'trim|callback_file_validation[sign|image/jpeg|200|required]'),
        //     array('field' => 'photo', 'label' => 'Photo', 'rules' => 'trim|callback_file_validation[photo|image/jpeg|200|required]'),
        // );

       // echo '<pre>';print_r($data['app_data']['picture']); die;

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

         //$this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('theme') . 'student_profile/photo_signature_view', $data);
        } else {

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

            $photo_sign = array(
                "picture"     => $picture,
                "sign"     => $sign,
                "photo_sign_save_status" => 1,
            );
            $photo_sign_status = $this->std_registration_model->updatePhotosign($data['app_data']['institute_student_details_id_pk'], $photo_sign);

            if($photo_sign_status !='')
			{
				$data['status'] = TRUE;
				$data['message'] = "Sign & photo updated successfully";
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = "Sign & photo updated failed. Please try again";
			}

            

            $this->load->view($this->config->item('theme') . 'student_profile/photo_signature_view', $data);
        }
    }
    public function edu_qualification()
    {
        //echo "hii";
        //echo "<pre>";print_r()

        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['stake_id_fk']         = $this->session->userdata('stake_id_fk');
        $data['active_class'] = 'education';
        $data['app_data']    = $this->std_registration_model->getStdDetails(md5($data['std_id']) ,$data['stake_id_fk']);
		$data['board_name'] = $this->std_registration_model->getAllBoardName();

        //23-04-2023
        $data['entrance'] = $this->std_registration_model->check_enrance($data['app_data']['exam_type_id_fk']);
         //echo "<pre>";print_r($data['app_data'] );exit;
        if($data['entrance'] == 0){
           $data['eligible_criteria'] =  $this->std_registration_model->getEligibilityCriteria($data['app_data']['exam_type_id_fk']);
           //echo "<pre>";print_r($data['eligible_criteria'] );exit;
        }
		
		if ($this->input->server("REQUEST_METHOD") == 'POST') {
			$formData['board_id']  = set_value('board_id');
			$formData['eligible_criteria']  = set_radio('eligible_criteria');
		}else{
			$formData['board_id'] = $data['app_data']['board_id_pk'];
			$formData['eligible_criteria'] = $data['app_data']['eligibility_criteria_id_fk'];
		}
		$data['formData'] = $formData;

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            if($data['entrance'] == 0){

                $config = array(
    
                    array('field' => 'eligible_criteria', 'label' => 'Eligibility Criteria', 'rules' => 'trim|required')
                );
                if ($data['app_data']['marksheet_doc'] == '') {

                    if($_FILES["marksheet_doc"]== ''){
                        $this->form_validation->set_rules('marksheet_doc', 'Marksheet', 'trim|callback_file_validation[sign|application/pdf|200|required]');
                    }
                } else {
                    $this->form_validation->set_rules('marksheet_doc', 'Marksheet', 'trim|callback_file_validation[sign|application/pdf|200|]');
                }

                

            }else{

                $config = array(
    
                    array('field' => 'fullmark', 'label' => 'Full Marks', 'rules' => 'trim|required'),
    
                    array('field' => 'marks_obtain', 'label' => 'Marks Obtained', 'rules' => 'trim|required'),
                    array('field' => 'percentage', 'label' => 'Percentage', 'rules' => 'trim|required'),
                    
                    array('field' => 'institute_name', 'label' => 'Institute Name', 'rules' => 'trim|required'),
                    array('field' => 'passing_year', 'label' => 'Passing Year', 'rules' => 'trim|required'),
                    array('field' => 'board_id', 'label' => 'Board Name', 'rules' => 'trim|required')
                );
                if($data['app_data']['exam_type_id_fk'] == 3){
                   
                    $config[]= array('field' => 'phy_marks', 'label' => 'Marks Physics', 'rules' => 'trim|required');
                    $config[]= array('field' => 'chem_marks', 'label' => 'Marks of Chemistry', 'rules' => 'trim|required');
                    $config[]= array('field' => 'math_bio_marks', 'label' => 'Marks of  Life Science or Biology /Mathematics', 'rules' => 'trim|required');
                }
            }


            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {

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

                }else{

                    $edu_qualification = array(
    
                        "fullmarks" => $this->input->post("fullmark"),
                        "marks_obtain" => $this->input->post("marks_obtain"),
                        "percentage" => $this->input->post("percentage"),
                        "cgpa" => ($this->input->post("c_g_p_a") == Null)? NULL :$this->input->post("c_g_p_a"),
                        //"thirdyr_or_physics_or_math_result" => $this->input->post("p_o_m1"),
                        //"secondyear_or_chemistry_or_physicalscience_or_science_result" => $this->input->post("p_o_m2"),
                        //"firstyear_or_hs_english_or_lifescience_result" => $this->input->post("p_o_m3"),
                        "institute_name" => $this->input->post("institute_name"),
                        "year_of_passing" => $this->input->post("passing_year"),
                        "qualification_d_save_status" => 1,
                        "board_id_pk" => $this->input->post("board_id")
    
                    );
                    
                    if($data['app_data']['exam_type_id_fk'] == 3){
                        $edu_qualification['phy_marks'] = $this->input->post("phy_marks");
                        $edu_qualification['chem_marks'] = $this->input->post("chem_marks");
                        $edu_qualification['math_bio_marks'] = $this->input->post("math_bio_marks");
                    }
                }
                // echo '<pre>'; print_r($edu_qualification); die;

                $qua_status = $this->std_registration_model->updateStdQualifiDetails($data['app_data']['institute_student_details_id_pk'], $edu_qualification);

                if ($qua_status == 1) {


                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Your Qualification data saved successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'have an error.');
                }
            }
        }

        $this->load->view($this->config->item('theme') . 'student_profile/edu_qualification_view', $data);
    }


    public function final_submit()
    {

        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['active_class'] = 'Final Submit';
        $this->title = "Final Submit";
        $data['app_data']    = $this->std_registration_model->getStdDetails(md5($data['std_id']));
        // echo "<pre>";print_r($data['app_data']);exit;
        //echo "<pre>";print_r($data);exit;

		$payment_details = $this->std_registration_model->getPaymentDetailsByStdId($data['std_id']);
         //echo "<pre>";print_r($payment_details);exit;
        //echo "<pre>";print_r($data);exit;
        if($payment_details){
            $data['reg_fee_status'] = 1;
        }else{
            $data['reg_fee_status'] = 0;
        }

        $this->load->view($this->config->item('theme') . 'student_profile/final_submit_view', $data);
    }

    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->std_registration_model->getDistrictByStateId($state_id);

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

    public function file_validation_old($fild = NULL, $file_name = NULL)
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

    public function download_citizenship_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->std_registration_model->get_student_citizen_file_content($id);
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
        $file_content = $this->std_registration_model->get_student_caste_file_content($id);
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
        $file_content = $this->std_registration_model->get_student_handicap_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=handicap-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['phy_challenged_doc']);
        } else {
            show_404();
        }
    }

    public function ajax_confirm_final_submit($cen_hash=NULL)
	{
		if($cen_hash!=NULL && strlen($cen_hash)==32)
		{
			$data['cen_hash'] = $cen_hash;
			//print_r($data);die;
			$this->load->view($this->config->item('theme').'student_profile/ajax/ajax_confirm_final_submit_view',$data);
		}
		else
		{
			show_404();
		}
	}

    public function ajax_confirm_final_submit_button($id_hash = NULL)
	{
		$data['app_data']    = $this->std_registration_model->getStdDetails($id_hash);
		
		

		$final_submit_update_array = array(
            'final_save_status' 					=> 1,
            
            // "final_submission_ip"           => $this->input->ip_address(),
            // "final_submission_time"         =>"now()",
        );

		

        $final_submit_update = $this->std_registration_model->updateStdDetails($data['app_data']['institute_student_details_id_pk'], $final_submit_update_array);

		if($final_submit_update!=''){

				
		
			echo json_encode(array('response' => "TRUE"));
			
		} 
		else 
		{
			echo json_encode(array('response' => "FALSE"));
		}
	}

    public function preview_details(){
		//echo "hii";exit;
        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['app_data']    = $this->std_registration_model->getStdPreviewDetails(md5($data['std_id']));
		//echo "<pre>";print_r($data['app_data']);exit;
        $this->load->view($this->config->item('theme').'student_profile/student_details_profile_view',$data);
	}

    public function download_aadhaar_doc($id_hash = NULL)
    {

        //echo $id; die;
        $file_content = $this->std_registration_model->get_student_aadhaar_file_content($id_hash);
         //echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=aadhaar-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['aadhar_doc']);
        } else {
            show_404();
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
	
	// Bangla Sikha
    //Add by Moli on 11-02-2023
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

                $insert_id = $this->std_registration_model->insertData('council_banglashiksha_api_json_data', $insertData);

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
                    $this->std_registration_model->update_json_table_data($insert_id, $update_data);

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
	
	public function getCourseByInsCode()
    {
        // echo $this->input->is_ajax_request(); die;
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $vtc_code = $this->input->get('vtc_code');
            $exam_type_id = $this->input->get('exam_type_id');

            $course = $this->std_registration_model->getCourseByCode($vtc_code, $exam_type_id);
            // echo "<pre>";print_r($course);exit;

            if (!empty($course)) {


                echo json_encode($course);
            }
        }
    }

    
}
