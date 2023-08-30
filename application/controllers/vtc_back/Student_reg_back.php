<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Student_reg_back extends NIC_Controller {
    function __construct()
	{
		
		parent::__construct();
		
        $this->title = 'Councils ' . $this->title;
        $this->load->model("vtc/student_reg_model");
        $this->load->model('online_app/inst/vtc/affiliation_model');
        
        
        $this->css_head = array(
            1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri').'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
        );
		
		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'councils/js/datepicker.js',
            2  => $this->config->item('theme_uri').'councils/js/custom/vtc/student_reg.js',
            3  => $this->config->item('theme_uri').'councils/js/select2.full.min.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
        
    }

    public function index(){

        $data['salutations'] =  $this->student_reg_model->get_salutation();
        $data['genders'] =  $this->student_reg_model->get_gender();
        $data['districtList']  = $this->affiliation_model->getDistrictList();
        $data['casteList']  = $this->student_reg_model->get_caste();
        $data['religion']  = $this->student_reg_model->get_religion();
        $data['last_exam']  = $this->student_reg_model->get_last_exam();
        $data['batchDurationList']  = $this->student_reg_model->get_batch_duration();
        $data['stateList']  = $this->student_reg_model->getAllState();
        $data['academic_year']  = $this->config->item('current_academic_year');

        $data['nationality']  = $this->student_reg_model->get_nationality();

        $data['boardList']  = $this->student_reg_model->getAllboard();
        
        // echo "<pre>";print_r($data['batchDurationList']);exit;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            // echo "<pre>";print_r($_POST);exit;

            // echo "<pre>";print_r($_POST);
            //     echo "<pre>";print_r($_FILES);
            //     exit;

            $data['form_data']['state'] = $this->input->post('state');
            $data['form_data']['district'] = $this->input->post('district');
            $data['form_data']['municipality_id_fk'] = $this->input->post('municipality');

            $data['form_data']['sub_division_id_fk'] = $this->input->post('subDivision');

            if (!empty($data['form_data']['state'])) {
                $data['district'] = $this->student_reg_model->getDistrictByStateId($data['form_data']['state']);
            }

            if (!empty($data['form_data']['sub_division_id_fk'])) {
                $data['municipality'] = $this->affiliation_model->getMunicipalityByDivisionId($data['form_data']['sub_division_id_fk']);
            }
			if(!empty($data['form_data']['district'])){
				if ($data['form_data']['district'] == 16) {

					$kolkataArray = array(
						0 => 682, // KOLKATA NORTH 
						1 => 683, // KOLKATA SOUTH
						2 => 16, // KOLKATA
					);
		
					$data['subDivision']  = $this->affiliation_model->getSubDivisionByDistrictId($data['form_data']['district']);
					$data['nodalOfficer'] = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
				} elseif (($data['form_data']['district'] == 682) || ($data['form_data']['district'] == 683)) {
		
					$kolkataArray = array(
						0 => $data['form_data']['district'], // SOUTH / NORTH KOLKATA
						1 => 16, // KOLKATA
					);
		
					$data['subDivision']  = $this->affiliation_model->getSubDivisionByDistrictId(16);
					$data['nodalOfficer'] = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
				} else {
		
					$data['subDivision']  = $this->affiliation_model->getSubDivisionByDistrictId($data['form_data']['district']);
					$data['nodalOfficer'] = $this->affiliation_model->getNodalOfficerByDistrictId($data['form_data']['district']);
				}
			}

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

                //array('field' => 'salutation','label' => 'Salutation','rules' => 'trim|required',),

                array('field' => 'fname','label' => 'First Name','rules' => 'trim|required',),

                array('field' => 'lname','label' => 'Last Name','rules' => 'trim|required',),

                //array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                //array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                array('field' => 'guardian_name','label' => 'Guardian Name','rules' => 'trim|required',),

                array('field' => 'guardian_relation','label' => 'Relationship with Guardian','rules' => 'trim|required'),

                array('field' => 'aadhar_no','label' => 'Aadhar Number','rules' => 'trim|required|callback_is_unique_aadhar_no'),

                array('field' => 'mob_no','label' => 'Mobile Number','rules' => 'trim|required'),

                array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required'),

                array('field' => 'address','label' => 'Address','rules' => 'trim|required'),

                array('field' => 'district','label' => 'District','rules' => 'trim|required'),

                // array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required'),

                // array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required',),

                array('field' => 'pinCode','label' => 'Pin Code','rules' => 'trim|required'),

                array('field' => 'caste_id','label' => 'Caste','rules' => 'trim|required'),

                array('field' => 'phy_challenged','label' => 'Physically Challenged','rules' => 'trim|required'),

                array('field' => 'dob','label' => 'Date of Birth','rules' => 'trim|required'),

                //array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                array('field' => 'gender','label' => 'Gender','rules' => 'trim|required'),

                array('field' => 'marital_status','label' => 'Marital Status','rules' => 'trim|required'),

                array('field' => 'course_name_id','label' => 'Course Name','rules' => 'trim|required'),

                array('field' => 'group_id','label' => 'Group/Trade Name','rules' => 'trim|required'),

                

                array('field' => 'citizenship','label' => 'Citizenship','rules' => 'trim|required'),

                array('field' => 'state','label' => 'State','rules' => 'trim|required'),

               
            );

            if($this->input->post('state') == 19){
                $config[] = array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required');

                $config[] = array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required');
            }

            $course_name_id = $this->input->post('course_name_id');

            $vtc_code = $this->input->post('vtcCode');
			if(!empty($vtc_code) && !empty($course_name_id)){
				$data['group'] = $this->student_reg_model->getGroupByVTCCode($course_name_id,$vtc_code, $data['academic_year']);
			}
			
			// Added By Moli On 11-10-2022
			$groupId = $this->input->post('group_id');
            if(!empty($groupId)){
               $data['group_details'] = $this->student_reg_model->getGroupDetails($groupId); 
            }
            // echo "<pre>";print_r($data['group']);exit;

            $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');
            
            $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');

            $this->form_validation->set_rules('std_signature', 'Student Image', 'trim|callback_file_validation[std_signature|image/jpeg|100|required]');


            if($this->input->post('caste_id') != 1){

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');

            }

            //if ($this->input->post('religion_id') == 4){
             //   $config[] = array('field' => 'otherReligionName','label' => 'Other Religion Name','rules' => 'trim|required');
            //}

            if($this->input->post('phy_challenged') == 1){

                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');

            }

            if($this->input->post('citizenship') == 2){

                $this->form_validation->set_rules('approval_doc', 'Approval Document', 'trim|callback_file_validation[approval_doc|application/pdf|200|required]');

            }

            if ($course_name_id == 4){
                $config[] = array('field' => 'batch_duration','label' => 'Batch Duration','rules' => 'trim|required');
                $config[] = array('field' => 'last_exam_id','label' => 'Last Exam','rules' => 'trim|required');
                $config[] = array('field' => 'haveRegisterNo','label' => 'Question','rules' => 'trim|required');

                if($this->input->post('haveRegisterNo') == 1){
					
					$config[] = array('field' => 'old_reg_no','label' => 'Registration Number','rules' => 'trim|required');
					$config[] = array('field' => 'old_reg_year','label' => 'Registration Year','rules' => 'trim|required');
				}
					

                $this->form_validation->set_rules('marksheet', 'Mark Sheet', 'trim|callback_file_validation[marksheet|application/pdf|200|required]');


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

                if($this->input->post('haveHSRegisterNo') == 1){
					$config[] = array('field' => 'old_hs_reg_no','label' => 'Registration Number','rules' => 'trim|required');
					$config[] = array('field' => 'old_hs_reg_year','label' => 'Registration Year','rules' => 'trim|required');
				}

                if($this->input->post('school_state')!= 19){

                    $this->form_validation->set_rules('migration_certificate', 'Migration Certificate', 'trim|callback_file_validation[migration_certificate|application/pdf|200|required]');
    
                }
    
                if($this->input->post('register_hs_course') == 1){
    
                    $this->form_validation->set_rules('transfer_certificate', 'Transfer Certificate', 'trim|callback_file_validation[transfer_certificate|application/pdf|200|required]');
    
                }

                $this->form_validation->set_rules('hs_marksheet', 'Mark Sheet', 'trim|callback_file_validation[hs_marksheet|application/pdf|200|required]');

            }

           // echo "<pre>";print_r($config);die;
            
            

            

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');


                $this->load->view($this->config->item('theme').'vtc/student_reg_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {
                // echo "<pre>";print_r($data['group']);exit;

                $vtc_code = $this->input->post('vtcCode');
                $vtc_details = $this->student_reg_model->getVtcDetails($vtc_code, $data['academic_year']);

                if($this->input->post('caste_id') != 1){
                    $caste_doc = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                }else{
                    $caste_doc = '';
                }

                if($this->input->post('phy_challenged') == 1){
                    $phy_challenged_doc = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                }else{
                    $phy_challenged_doc = '';
                }

                if($this->input->post('citizenship') != 1){
                    $approval_doc = base64_encode(file_get_contents($_FILES["approval_doc"]['tmp_name']));
                }else{
                    $approval_doc = '';
                }

                $tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");

                $std_data = array(

                    'institute_code'        => $vtc_code,
                    'institute_id_fk'       => $vtc_details['vtc_id_pk'],
                    'institute_reg_id_fk'   => $vtc_details['vtc_details_id_pk'],
                    'year_of_registration'      => $this->input->post('admissionYear'),
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
                    'district_id_fk'        => $this->input->post('district_id_pk'),
                    'municipality_id_fk'    => ($this->input->post('municipality') !=NULL) ? $this->input->post('municipality') : NULL ,
                    'subdiv_id_fk'    => ($this->input->post('subDivision') !=NULL) ? $this->input->post('subDivision') : NULL,

                    'pin'              => $this->input->post('pinCode'),
                    'image'             => base64_encode(file_get_contents($_FILES["std_image"]['tmp_name'])),

                    'caste'             => $this->input->post('caste_id'),
                    'caste_doc'             => $caste_doc,

                    'religion'              => ($this->input->post('religion_id') != NULL) ? $this->input->post('religion_id') : NULL,
                    //'other_religion_name'           => ($this->input->post('otherReligionName') != NULL) ? $this->input->post('otherReligionName') : '',
					'other_religion_name'				=> '',
     
                    'physically_challenged'            =>$this->input->post('phy_challenged'),
                    'phy_challenged_doc'             => $phy_challenged_doc,

                    'date_of_birth'                  =>$date,
                    'aadhar_doc'             => base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name'])),

                    'gender_id_fk'            =>$this->input->post('gender'),
                    'marital_status'            =>$this->input->post('marital_status'),
                    'kanyashree_no'            =>($this->input->post('kanyashree_no') !=NULL) ? $this->input->post('kanyashree_no') : NULL,

                    
                    'class_id_fk'           => $this->input->post('course_name_id'),
                    'phase'                     =>($this->input->post('batch_duration') != NULL) ? $this->input->post('batch_duration') : NULL,
                    'course_id_fk'                     =>($this->input->post('group_id') != NULL) ? $this->input->post('group_id') : NULL,
     
                    'entry_time'                => "now()",
                    'entry_ip'                  => $this->input->ip_address(),
                    'date_of_addmission'        => "now()",

                    'std_signature'             => base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name'])),

                    'nationality_id_fk'           => $this->input->post('citizenship'),
                    'citizenship_approval_doc'  => $approval_doc,
                    'address_2'                =>    $this->input->post('address_2'),
                    'address_3'                =>    $this->input->post('address_3'),
    
                );

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $std_id = $this->student_reg_model->insertData('council_vtc_student_master', $std_data);

                if ($std_id) {

                    if ($course_name_id == 4){

                        $council_register = $this->input->post('haveRegisterNo');
                        $marksheet  = base64_encode(file_get_contents($_FILES["marksheet"]['tmp_name']));

                    }elseif ($course_name_id == 1) {
                        
                        $council_register = $this->input->post('haveHSRegisterNo');
                        $marksheet = base64_encode(file_get_contents($_FILES["hs_marksheet"]['tmp_name']));
                    }

                    $academicData = array(
                        'student_id_fk'         => $std_id,
                        'last_academic_exam_id_fk'             => ($this->input->post('last_exam_id') == '') ? NULL : $this->input->post('last_exam_id'),
                        'board_id_fk'                           => ($this->input->post('board_name') == '')? NULL : $this->input->post('board_name'),
                        
                        'marksheet'             => $marksheet,
                        
                        'total_marks'                           => ($this->input->post('total_marks') == '') ? NULL : $this->input->post('total_marks'),
                        'aggregate_marks'                       => ($this->input->post('aggregate_marks') == '') ? NULL :$this->input->post('aggregate_marks'),
                        'percentage'                            => ($this->input->post('percentage_marks') == '') ? NULL : $this->input->post('percentage_marks'),
                        
                        'council_register'                      => $council_register,
                        
                        'ten_passing_year'          =>($this->input->post('ten_passing_year') == '') ? '' : $this->input->post('ten_passing_year'),
                        'ten_school_state'          =>($this->input->post('school_state') == '') ? NULL : $this->input->post('school_state'),
                        
                        'register_hs_course'        => ($this->input->post('register_hs_course') == '') ? NULL : $this->input->post('register_hs_course'),
                        'hs_passed'        => ($this->input->post('haveSHSPassed') == '') ? NULL : $this->input->post('haveSHSPassed'),
                    );
                    if($council_register == 1 && $council_register != ''){

                        $academicData['old_reg_no'] = $this->input->post('old_reg_no') ? $this->input->post('old_reg_no') : $this->input->post('old_hs_reg_no') ;
                        $academicData['old_reg_year'] = $this->input->post('old_reg_year') ? $this->input->post('old_reg_year') : $this->input->post('old_hs_reg_year');
                    }else{
                        $academicData['old_reg_no'] = '';
                        $academicData['old_reg_year'] = '';
                    }

                    // Migration Certificate
                    if(($course_name_id == 1) && ($this->input->post('school_state') != 19)){
                        $academicData['migration_certificate'] = base64_encode(file_get_contents($_FILES["migration_certificate"]['tmp_name']));
                    }else{
                        $academicData['migration_certificate'] = '';
                    }

                    //Transfer Certificate
                    if(($course_name_id == 1) && ($this->input->post('register_hs_course') == 1)){
                        $academicData['transfer_certificate'] = base64_encode(file_get_contents($_FILES["transfer_certificate"]['tmp_name']));
                    }else{
                        $academicData['transfer_certificate'] = '';
                    }

                    $result = $this->student_reg_model->insertData('council_vtc_student_last_examination', $academicData);

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
                        $this->session->set_flashdata('alert_msg', 'Student details has been added successfully.');
                    }

                    redirect('vtc/student_reg');

                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');

                    redirect('vtc/student_reg');
                }

            }
        }else{

            $this->load->view($this->config->item('theme').'vtc/student_reg_view',$data);
        }

    }

    public function is_unique_aadhar_no($aadhar_no){
        
        if(($aadhar_no!=NULL || $aadhar_no!=''))
		{
			$duplicate_no = $this->student_reg_model->get_duplicate_aadhar($aadhar_no);
			
		}
		
		if (empty($duplicate_no)) {
			return true;
		}
		else {
	
			$this->form_validation->set_message('is_unique_aadhar_no', 'The {field} field must contain a unique value.');
			return false;
		}
    }

    public function getSubDivision_old($district_id = NULL)
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

                $nodalOfficer     = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($district_id == 682) || ($district_id == 683)) {

                $kolkataArray = array(
                    0 => $district_id, // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $district_id  = 16;

                $nodalOfficer = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $nodalOfficer = $this->affiliation_model->getNodalOfficerByDistrictId($district_id);
            }

            $subDivisionHtml = '<option value="" hidden="true">Select Sub Division</option>';
            $subDivision     = $this->affiliation_model->getSubDivisionByDistrictId($district_id);

            if (!empty($subDivision)) {

                foreach ($subDivision as $key => $value) {
                    $subDivisionHtml .= '
                            <option value="' . $value['subdiv_id_pk'] . '">
                                ' . $value['subdiv_name'] . '
                            </option>
                        ';
                }
            } else {

                $subDivisionHtml .= '<option value="" disabled="true">No Data found.</option>';
            }

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
                'subDivisionHtml'  => $subDivisionHtml,
                'nodalOfficerHtml' => $nodalOfficerHtml,
            );

            echo json_encode($response);
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

                $nodalOfficer     = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($district_id == 682) || ($district_id == 683)) {

                $kolkataArray = array(
                    0 => $district_id, // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $district_id  = 16;

                $nodalOfficer = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $nodalOfficer = $this->affiliation_model->getNodalOfficerByDistrictId($district_id);
            }

            $subDivisionHtml = '<option value="" hidden="true">Select Sub Division</option>';
            $subDivision     = $this->affiliation_model->getSubDivisionByDistrictId($district_id);

            // if (!empty($subDivision)) {

            //     foreach ($subDivision as $key => $value) {
            //         $subDivisionHtml .= '
            //                 <option value="' . $value['subdiv_id_pk'] . '">
            //                     ' . $value['subdiv_name'] . '
            //                 </option>
            //             ';
            //     }
            // } else {

            //     $subDivisionHtml .= '<option value="" disabled="true">No Data found.</option>';
            // }

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

    public function getMunicipality_old($sub_division_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select Municipality</option>';
            $municipality = $this->affiliation_model->getMunicipalityByDivisionId($sub_division_id);

            if (!empty($municipality)) {

                foreach ($municipality as $key => $value) {
                    $html .= '
                            <option value="' . $value['block_municipality_id_pk'] . '">
                                ' . $value['block_municipality_name'] . '
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
	
	public function getMunicipality($sub_division_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select Municipality</option>';
            $municipality = $this->affiliation_model->getMunicipalityByDivisionId($sub_division_id);

            if (!empty($municipality)) {

                // foreach ($municipality as $key => $value) {
                //     $html .= '
                //             <option value="' . $value['block_municipality_id_pk'] . '">
                //                 ' . $value['block_municipality_name'] . '
                //             </option>
                //         ';
                // }
                // echo json_encode($html);
                echo json_encode($municipality);
            } 
            // else {

            //     $html .= '<option value="" disabled="true">No Data found.</option>';
            //     echo json_encode($html);
            // }
        }
    }
    

    public function getGroupName($course_name_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $vtc_code = $this->input->get('vtc_code');
            $academic_year  = $this->config->item('current_academic_year');
            

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


    public function getVtcName($vtcCode = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
            $academic_year  = $this->config->item('current_academic_year');
            $vtcDetails = $this->student_reg_model->getVtcDetailsByCode($vtcCode,$academic_year);

            //echo "<pre>";print_r($vtcDetails);exit;
            if (!empty($vtcDetails)) {

                if ($vtcDetails[0]['second_final_submit_status'] == 1) {

                    echo json_encode($vtcDetails[0]['vtc_name']);
                } else {

                    echo json_encode('');
                }
            }
        }
    }

    // ! File Validation 

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

    // Batch Duration

    public function getDuration_old($course_name_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $group_id = $this->input->get('group_id');

            if($course_name_id !='' && $group_id !=''){

                $html        = '<option value="" hidden="true">Select Batch Duration</option>';
                $group = $this->student_reg_model->getGroupDetails($group_id);

                if (!empty($group)) {

                    if($group['duration'] == 6){

                        $html .= '
                        <option value="2">
                            July to December (6 Months)
                        </option>
                        ';
                        $month = date('m');
                        if($month <= '06'){

                            $html .= '
                            <option value="2">
                                January to June (6 Months)
                            </option>
                            ';
                        }
                    }elseif ($group['duration'] == 12) {
                        $html .= '
                        <option value="1">
                            July to June (1 Year)
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
	
	public function getDuration($course_name_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $group_id = $this->input->get('group_id');

            if($course_name_id !='' && $group_id !=''){

                $html        = '<option value="" hidden="true">Select Batch Duration</option>';
                $group = $this->student_reg_model->getGroupDetails($group_id);

                if (!empty($group)) {

                    
                    $res = array(
                        'duration' => $group['duration']
                    );

                    
                    echo json_encode($res);
                } 
                
            }

            
        }
    }

    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->student_reg_model->getDistrictByStateId($state_id);

            if (!empty($district)) {

                // foreach ($district as $key => $value) {
                //     $html .= '
                //             <option  value="' . $value['district_id_pk'] . '">
                //                 ' . $value['district_name'] . '
                //             </option>
                //         ';
                // }
                echo json_encode($district);
            } 
            // else {

            //     $html .= '<option value="" disabled="true">No Data found.</option>';
            //     echo json_encode($html);
            // }
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

                $insert_id = $this->student_reg_model->insertData('council_banglashiksha_api_json_data', $insertData);
				
				
                $post_data = array(
                    'std_code' => $std_code
                );
                $url = 'http://172.20.140.171/api_rest_server/vtc_student/banglashiksha/gettingStudentDetailsByBanglaShikshaCode';
                $this->load->library('curl');
                $curl_response = $this->curl->curl_make_post_request($url, $post_data);
                $data_response = json_decode($curl_response, true);
                $student_data = $data_response['student_details'];
                //echo "<pre>";print_r($student_data);exit;
                if(!empty($student_data)){

                    $district_id = gettingDistrictId($student_data['StuContactDistrict']);
                    $block_details  = gettingBlockId($student_data['StuContactBlock']);
                    
                    $block_id = $block_details['block_municipality_id_pk'];
                    $subdiv_id   = $block_details['subdiv_id_fk'];
                    $caste_id  = gettingCasteId($student_data['SocialCategoryCode']);
                    $religion_id = gettingReligionId($student_data['ReligionCode']);
                    $gender = gettingGender($student_data['GenderCode']);
                    $phy_challenged = ($student_data['CwsnYesNoCode'] != NULL) ? $student_data['CwsnYesNoCode'] : NULL;
                    //echo $student_data['StudentName'];exit;
                    
					$update_data = array(
                        'transaction_id' => $student_data['TransactionId'],
                        'json_data'     => json_encode($data_response)
                    );
                    $this->student_reg_model->update_json_table_data($insert_id, $update_data);
					
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
                        'date_of_birth'    => date('d/m/Y',strtotime($student_data['StuDob']))
                    );
					
                    echo json_encode($res);
                }
            }

           
        }
        
    }
}