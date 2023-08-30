<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends NIC_Controller
{
    function __construct()
    {

        parent::__construct();
        //redirect("https://www.pbssd.gov.in/council/admin/maintenance");
        //$this->lang->load('council_header_footer_lang', $this->language);
        //$this->lang->load('council_lang', $this->language);
        $this->title = 'Councils ' . $this->title;
        $this->load->model("online_application_various_courses/registration_model");
        //$this->load->model('admin/affiliation/details_model');
        //$this->css_head = array(
        //1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
        //);

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri') . 'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
        );

        $this->js_foot = array(
            1  => $this->config->item('theme_uri') . 'councils/js/datepicker.js',
            2  => $this->config->item('theme_uri') . 'councils/js/custom/online_application_various_courses.js',
            3  => $this->config->item('theme_uri') . 'councils/js/select2.full.min.js',
            //4  => $this->config->item('theme_uri') . 'councils/js/custom/online_application_various_courses.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
    }

    public function index($ticket_no= NULL)
    {
        //echo $ticket_no;exit;
        
        // echo "<pre>";
        // print_r($ticket_no);
        // echo "</pre>";exit;
        $data = array();
		
		// For BSK API
		if($this->input->post('bsk_ticket_no') !=''){
            $data['ticket_no'] = $this->input->post('bsk_ticket_no');
        }else{

            $data['ticket_no'] = $ticket_no;
        }
        if($data['ticket_no'] !=''){
            $data['bsk_data'] = $this->registration_model->getBskData($data['ticket_no']);
            //echo "<pre>";print_r($data['bsk_data']);die;
        }
		
        $data['courses'] =  $this->registration_model->get_course();
        // echo "<pre>";print_r( $data['courses']);die;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $course = $this->input->post('courses');
            $config = array(
                array(
                    'field' => 'fullname',
                    'label' => 'Name',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'stdMobileNo',
                    'label' => 'Mobile No',
                    'rules' => 'trim|required|exact_length[10]|numeric'
                ),
                array(
                    'field' => 'stdEmail',
                    'label' => 'Student Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'courses',
                    'label' => 'Course Applied For',
                    'rules' => 'trim|required|max_length[250]|integer'
                ),
                array(
                    'field' => 'aadhar_no',
                    'label' => 'Aadhar No',
                    'rules' => 'trim|required|exact_length[12]|callback_check_course_wise_aadhar_no['.$course.']'
                    // 'rules' => 'trim|required|exact_length[12]'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
				
                $this->load->view($this->config->item('theme') . 'online_application_various_courses/std_email_phone_verify_view', $data);
            } else {

                $stdDetails = array(

                    'candidate_name' => $this->input->post('fullname'),
                    'mobile_number' => $this->input->post('stdMobileNo'),
                    'email' => $this->input->post('stdEmail'),
                    'exam_type_id_fk'=> $this->input->post('courses'),
                    'aadhar_no'=> $this->input->post('aadhar_no'),

                    //Added by moli on 22-03-2023
                    'entry_time' => 'now()',
                    'entry_ip' => $this->input->ip_address(),
                );

                //Added by moli on 22-03-2023
                if($data['ticket_no'] !=''){
                    $stdDetails['bsk_ticket_no'] = $data['bsk_data']['ticketno'];
                    $stdDetails['bsk_status'] =1;
                    $stdDetails['bsk_userid'] =$data['bsk_data']['userid'];
                }
                //echo "<pre>";print_r($stdDetails);die();

                $std_id = $this->registration_model->insert_application_details($stdDetails);
                /** added by ATREYEE ***/
                 $course_id = $this->input->post('courses');
                 $course = $this->registration_model->get_specific_course_name_atz($course_id);
                 //$course_name = 'PDME';
                if (!empty($std_id)) {
                    // echo $course_name; exit;
                   //print_r($course); exit;

                    $data = array(
                        'url' => base_url('online_application_various_courses/registration/email_verify/' . md5($std_id)),
						 'year'=> '2022-23',
                         'course_name' => $course[0]['course_name']
                    );

                    $email_subject = "Email Verification";
                    $email_message = $this->load->view($this->config->item('theme') . 'online_application_various_courses/email_template_view', $data, TRUE);
                    $status = send_email($this->input->post('stdEmail'), $email_message, $email_subject);

                    if ($status) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, We have sent you a verification link on your registered email. Please verify your email.');
                    } else {

                        $url = '<a href="' . $data['url'] . '" target="_blank">Click Here</a>';

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Please ' . $url);
                    }
                    // }
                    redirect('online_application_various_courses/registration');
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'online_application_various_courses/std_email_phone_verify_view', $data);
          
        }
    }

    public function check_course_wise_aadhar_no($aadhar_no, $params)
    {
        // list($aadhar_no) = explode(".", $params, 2);
        // //     // echo "table: " . $table." --- field: " .$field;
            // echo $aadhar_no." -- ".$params."---";exit;

             $data = $this->registration_model->check_aadharno_course($aadhar_no,$params);

             if($data === TRUE)
             {
                $this->form_validation->set_message('check_course_wise_aadhar_no','This Aadhar no already exists in this course.');
                return FALSE;
             }else{
                return TRUE;
             }
    }


    public function check_application(){
        $dat['get_duplicate'] = $this->registration_model->get_duplicate();
        $this->load->view($this->config->item('theme') . 'online_application_various_courses/show_dupli_app_no', $data);
    }

    public function genarateApplicationFormNo($courses_id, $exam_year)
    {
        $start_code = $courses_id;

        // $exam_year = date('Y');

        $chaking_data = ($start_code . '/' . $exam_year);
        $check_exist_code = $this->registration_model->get_last_application_no($chaking_data)[0];
        // echo "<pre>";print_r($check_exist_code);exit;
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
        // echo $number;exit;

        $application_form_no = $start_code . '/' . $exam_year . '/' . $number;



        return $application_form_no;
    }

    public function std_info($id_hash = NULL)
    { 

       // echo '<pre>'; print_r($_POST); die;
       
        if(isset($_GET['link'])){
           $data['draft_data'] = $_GET['link'];
        }else{
            $data['draft_data'] ='';
        }
        if(($data['draft_data'] ==1) ||($this->input->post('draft_data')==1)){

             // echo "test" ; die;

            $draft_data  = $this->registration_model->getdrafteditByIdHash($id_hash);
            $data['stdDetails'] = $draft_data;

             // echo '<pre>';print_r($data['stdDetails']); die;

             $data['stdDetails']['student_details_id_pk']=$draft_data['student_details_id_fk'];

             // echo '<pre>';print_r( $data['stdDetails']['student_details_id_pk']); die;
        }else{

            // echo "else"; die;
			
			// check draft data exit or not
			$draft_data  = $this->registration_model->getdrafteditByIdHash($id_hash);
			if(!empty($draft_data)){
				$data['stdDetails'] = $draft_data;
				$data['stdDetails']['student_details_id_pk']=$draft_data['student_details_id_fk'];
			}else{
				$main_data  = $this->registration_model->getStdDetailsByIdHash($id_hash);
				$data['stdDetails'] = $main_data;
			}
            

        }
        // echo '<pre>';print_r($data['stdDetails']); die;
        //echo'm here'; die;
        $data['courses'] =  $this->registration_model->get_course();
        // echo "<pre>";print_r($data['stdDetails']);die();

        $data['genders'] =  $this->registration_model->get_gender();
        $data['nationality'] =  $this->registration_model->get_nationality();
        $data['states'] =  $this->registration_model->get_state();
        $data['police_station'] =  $this->registration_model->get_police_station();
        // echo '<pre>'; print_r($data); die;
        $data['castes'] =  $this->registration_model->get_caste();
        $data['religions'] =  $this->registration_model->get_religion();
        $data['qualifications'] =  $this->registration_model->get_qualification();
        $stdDetails['police_station'] =  $this->registration_model->get_police_station();
        $stdDetails['district'] =  $this->registration_model->get_district();
        $stdDetails['subDivision'] =  $this->registration_model->get_subdivision();


        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $formdata['fullname'] = set_value('fullname');
			$formdata['email'] = set_value('stdEmail');
            $formdata['guardian_name'] = set_value('guardian_name');
            $formdata['mobile_number'] = set_value('stdMobileNo');
            $formdata['handicapped'] = set_value('handicapped');
            $formdata['aadhar_no'] = set_value('aadhar_no');
            $formdata['last_qualification_id_fk'] = set_value('last_qualification');
            $formdata['fullmarks'] = set_value('fullmark');
            $formdata['percentage'] = set_value('percentage');
            $formdata['institute_name'] = set_value('institute_name');
            $formdata['applied_under_tfw'] = set_value('tfw');
            $formdata['land_loser'] = set_value('land_loser');
            $formdata['wards_of_exserviceman'] = set_value('exserviceman');
            $formdata['ews'] = set_value('ews');
            $formdata['wards_of_exserviceman'] = set_value('exserviceman');
            $formdata['kanyashree_unique_id'] = set_value('unique_id');
            $formdata['kanyashree'] = set_value('kanyashree');
            $formdata['nationality_id_fk'] = set_value('nationality');
            $formdata['last_reg_no'] = set_value('last_reg_no');
            $formdata['udise_code'] = set_value('udise_code');
            $formdata['year_of_passing'] = set_value('passing_year');
            $formdata['marks_obtain'] = set_value('marks_obtain');
            $formdata['address'] = set_value('address');
            $formdata['pincode'] = set_value('pincode');
            $formdata['state_id_fk'] = set_value('state');
            $formdata['caste_id_fk'] = set_value('category');
            $formdata['religion_id_fk'] = set_value('religion');
            $formdata['district_id_fk'] = set_value('district');
            $formdata['sub_div_id_fk'] = set_value('subDivision');
            $formdata['date_of_birth'] = set_value('dob');
            $formdata['picture'] = set_value('std_image');
            $formdata['sign'] = set_value('std_signature');
            $formdata['police_station_id_fk'] = set_value('police_station');
            $formdata['course_id_fk'] = set_value('courses');
            $formdata['gender_id_fk'] = set_value('gender');
            $formdata['exam_type_name'] = set_value('exam_type_name');


        }else{
            $formdata['fullname'] = $data['stdDetails']['candidate_name'];
			$formdata['email'] = $data['stdDetails']['email'];
			
            $formdata['guardian_name'] = $data['stdDetails']['guardian_name'];
            $formdata['mobile_number'] = $data['stdDetails']['mobile_number'];
            
            //$formdata['caste_id_fk'] = $data['stdDetails']['caste_id_fk'];
            $formdata['course_id_fk'] = $data['stdDetails']['exam_type_id_fk'];
          //  print_r($formdata['course_id_fk']); die;
            $formdata['nationality_id_fk'] = $data['stdDetails']['nationality_id_fk'];
            $formdata['gender_id_fk'] = $data['stdDetails']['gender_id_fk'];
            $formdata['handicapped'] = $data['stdDetails']['handicapped'];
            $formdata['aadhar_no'] = $data['stdDetails']['aadhar_no'];
            $formdata['last_qualification_id_fk'] = $data['stdDetails']['last_qualification_id_fk'];
            $formdata['fullmarks'] = $data['stdDetails']['fullmarks'];
            $formdata['percentage'] = $data['stdDetails']['percentage'];
            $formdata['institute_name'] = $data['stdDetails']['institute_name'];
            $formdata['year_of_passing'] = $data['stdDetails']['year_of_passing'];
            $formdata['district_id_fk'] = $data['stdDetails']['district_id_fk'];
            $formdata['sub_div_id_fk'] = $data['stdDetails']['sub_div_id_fk'];
            $formdata['religion_id_fk'] = $data['stdDetails']['religion_id_fk'];
            $formdata['land_loser'] = $data['stdDetails']['land_loser'];
            $formdata['wards_of_exserviceman'] = $data['stdDetails']['wards_of_exserviceman'];
            $formdata['ews'] = $data['stdDetails']['ews'];
            $formdata['applied_under_tfw'] = $data['stdDetails']['applied_under_tfw'];
            $formdata['kanyashree_unique_id'] = $data['stdDetails']['kanyashree_unique_id'];
            $formdata['kanyashree'] = $data['stdDetails']['kanyashree'];
            $formdata['last_reg_no'] = $data['stdDetails']['last_reg_no'];
            $formdata['udise_code'] = $data['stdDetails']['udise_code'];
            $formdata['marks_obtain'] = $data['stdDetails']['marks_obtain'];
            $formdata['address'] = $data['stdDetails']['address'];
            $formdata['pincode'] = $data['stdDetails']['pincode'];
            $formdata['date_of_birth'] = $data['stdDetails']['date_of_birth'];
            $formdata['caste_id_fk'] = $data['stdDetails']['caste_id_fk'];
            $formdata['state_id_fk'] = $data['stdDetails']['state_id_fk'];
            $formdata['picture'] = $data['stdDetails']['picture'];
            $formdata['sign'] = $data['stdDetails']['sign'];
            $formdata['police_station_id_fk'] = $data['stdDetails']['police_station_id_fk'];
            $formdata['exam_type_name'] = $data['stdDetails']['exam_type_name'];

        }
        

        if (!empty($formdata['state_id_fk'])) {
            $data['district'] = $this->registration_model->getDistrictByStateId($formdata['state_id_fk']);
        }
    
        if (!empty($formdata['district_id_fk'])) {
            $data['subDivision'] = $this->registration_model->getSubDivisionByDistrictId($formdata['district_id_fk']);
       //  echo '<pre>'; print_r($data['subDivision']); die;
        }

        if (!empty($formdata['district_id_fk'])) {
            if ($formdata['district_id_fk'] == 16) {
    
                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );
    
                $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId($formdata['district_id_fk']);
               // $data['nodalOfficer'] = $this->registration_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($formdata['district_id_fk'] == 682) || ($formdata['district_id_fk'] == 683)) {
    
                $kolkataArray = array(
                    0 => $formdata['district_id_fk'], // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );
    
                $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId(16);
                // $data['nodalOfficer'] = $this->registration_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {
    
                $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId($formdata['district_id_fk']);
                // $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($formdata['district_id_fk']);
            }
        }
    

        $data['formdata'] = $formdata;
        // echo '<pre>'; print_r($data); die;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {


            $student_details_id_pk =$this->input->post('student_details_id_pk');
            // echo $student_details_id_pk;die;
            $category = $this->input->post('category');
            $percentage = $this->input->post('percentage');
            $course = $this->input->post('courses');
            $handicapped = $this->input->post('handicapped');
            // print_r($course); die;
            //  echo'<pre>';print_r($_POST);echo'</pre>';// die;


            $district = $this->input->post('district');
            if (($this->input->post('state')) != '') {
                $data['district'] = $this->registration_model->getDistrictByStateId($this->input->post('state'));
            }
            if (!empty($district)) {

                if ($district == 16) {

                    $kolkataArray = array(
                        0 => 682, // KOLKATA NORTH 
                        1 => 683, // KOLKATA SOUTH
                        2 => 16, // KOLKATA
                    );

                    $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId($district);
                } elseif (($district == 682) || ($district == 683)) {

                    $kolkataArray = array(
                        0 => $district, // SOUTH / NORTH KOLKATA
                        1 => 16, // KOLKATA
                    );

                    $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId(16);
                } else {

                    $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId($district);
                }
            }
            $this->load->library('form_validation');


            // $this->form_validation->set_rules(
            //     'courses',
            //     '<b>courses</b>',
            //     'trim|required|integer',
            //     array('integer' => 'The %s field is invalid')
            // );
            $this->form_validation->set_rules('fullname', '<b>Fullname</b>', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('guardian_name', '<b>Guardian_name</b>', 'trim|required');
            $this->form_validation->set_rules('gender', '<b>Gender</b>', 'trim|required');

            $this->form_validation->set_rules('stdEmail', '<b>Email</b>', 'trim|required');
            $this->form_validation->set_rules('stdMobileNo', '<b>Mobile No</b>', 'trim|required');

            if ($this->input->post('gender') == 2) {
                $this->form_validation->set_rules('kanyashree', '<b>Kanyashree</b>', 'trim|required');

                //kanyashree_unique_id
                if ($this->input->post('kanyashree') == 'yes') {
                    $this->form_validation->set_rules('unique_id', '<b>Unique Id</b>', 'trim|required');
                }
            }

            $this->form_validation->set_rules('nationality', '<b>Nationality</b>', 'trim|required');

            $this->form_validation->set_rules('category', '<b>Category</b>', 'trim|required');

        //     $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');


        //    $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|50|required]');

        if ($data['stdDetails']['picture'] == '') {

            $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');
        } else {
            $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|]');
        }

        if ($data['stdDetails']['sign'] == '') {

            $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|100|required]');
        } else {
            $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|100|]');
        }

        // added by moli on 06-03-2023
        if ($this->input->post('category') != 1) {
            if ($data['stdDetails']['caste_doc'] == '') {

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');
            }else{

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|]');
            }

        }
        if ($this->input->post('handicapped') == 'yes') {

            if ($data['stdDetails']['phy_challenged_doc'] == '') {

                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');
            }else{

                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|]');
            }

        }
        // added by moli on 06-03-2023

            /* open after checking*/
            // $this->form_validation->set_rules(
                // 'percentage',
                // '<b>Percentage</b>',
                // "trim|required|callback_check_category_wise_percentage[$category.$course.$handicapped]"

            // );

            $this->form_validation->set_rules(
                'handicapped',
                 '<b>Handicapped</b>',
                  'trim|required'
                );
            $this->form_validation->set_rules(
                'dob',
                '<b>Date of Birth</b>',
                'trim|required'

            );
            //callback_date_validate

            $this->form_validation->set_rules('religion', '<b>Religion.</b>', 'trim|required');

            // FOR 4 EXTRA fields adding by Sudesna
            
            if($course==1 ||$course==2 ||$course==4 ||$course==5 ||$course==6 ||$course==7 ) {
            $this->form_validation->set_rules( 'land_loser','<b>Land Loser</b>', 'trim|required');
                $this->form_validation->set_rules( 'ews', '<b>EWS</b>', 'trim|required' );
                    $this->form_validation->set_rules('exserviceman', '<b>Are You Wards of Ex-Serviceman</b>','trim|required' );
                        $this->form_validation->set_rules( 'tfw', '<b>TFW</b>', 'trim|required'  );
            }
           // end of code



            
            $this->form_validation->set_rules(
                'last_qualification',
                '<b>Last Qualification</b>',
                'trim|required'

            );
            // $this->form_validation->set_rules('fullmark', '<b>Full Marks</b>', 'trim|required');
           // $this->form_validation->set_rules('marks_obtain', '<b>marks_obtain</b>', 'trim|required');
            // $this->form_validation->set_rules('percentage', '<b>Percentage</b>', 'trim|required');
            

             if($course==3 ||$course==8 ||$course==9 ) {
                //  start code for the fields of Pharmacy course 
                $this->form_validation->set_rules('c_g_p_a', '<b>CGPA</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m1', '<b>Percentage of marks (3rd yr Diploma / Physics / Mathematics)</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m2', '<b>Percentage of marks (2nd yr / Chemistry / Physics / Science)</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m3', '<b>Percentage of Marks (1st yr / English(H.S) / Life Science)</b>', 'trim|required');

             }

              

            $this->form_validation->set_rules('institute_name', '<b>Institute Name</b>', 'trim|required');
            $this->form_validation->set_rules('passing_year', '<b>Passing Year</b>', 'trim|required|exact_length[4]');
            $this->form_validation->set_rules('address', '<b>Address</b>', 'trim|required');
            $this->form_validation->set_rules('state', '<b>State</b>', 'trim|required');
            $this->form_validation->set_rules('district', '<b>District</b>', 'trim|required');
            //$this->form_validation->set_rules('police_station', '<b>Police Station</b>', 'required');

            if ($this->input->post('state') == 19) {
                $this->form_validation->set_rules('subDivision', '<b>subDivision</b>', 'trim|required');
            }
            $this->form_validation->set_rules('pincode', '<b>Pincode</b>', 'trim|required|exact_length[6]');
            $this->form_validation->set_rules('last_reg_no', '<b>Reg No</b>', 'trim|required');



            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                // echo "hii";
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
                $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
            } else {


                $year = date('Y') . '-' . date('y', strtotime(date('Y') . "+ 1 year"));
                 $courses = $this->input->post('courses');
                $application_form_no = $this->genarateApplicationFormNo($courses, $year);

                $thirdyr_or_physics_or_math_result = $this->input->post('p_o_m1');
                
                $secondyear_or_chemistry_or_physicalscience_or_science_result = $this->input->post('p_o_m2');

               

                $firstyear_or_hs_english_or_lifescience_result = $this->input->post('p_o_m3');
                
               
                $aggregate_marks = (($thirdyr_or_physics_or_math_result + $secondyear_or_chemistry_or_physicalscience_or_science_result + $firstyear_or_hs_english_or_lifescience_result)/300);
            //    //  echo $aggregate_marks; die;


            if($_FILES["std_image"]['tmp_name'] != ''){
                $picture = base64_encode(file_get_contents($_FILES["std_image"]['tmp_name']));
            }else{
                $picture = $data['stdDetails']['picture'];
            }
    
            if($_FILES["std_signature"]['tmp_name'] != ''){
                $sign = base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name']));
            }else{
                $sign = $data['stdDetails']['sign'];
            }

            // added by moli
            if($this->input->post('handicapped') == 'yes'){

                if($_FILES["phy_challenged_doc"]['tmp_name'] != ''){
                    $phy_challenged_doc = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                }else{
                    $phy_challenged_doc = $data['stdDetails']['phy_challenged_doc'];
                }
            }else{
                $phy_challenged_doc = '';
            }

            if($this->input->post('category') != 1){

                if($_FILES["caste_doc"]['tmp_name'] != ''){
                    $caste_doc = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                }else{
                    $caste_doc = $data['stdDetails']['caste_doc'];
                }
            }else{
                $caste_doc = '';
            }

			if($this->input->post('dob')){
            $tmp_date = explode('/', $this->input->post('dob'));
            $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
            $date = date_format($date, "Y-m-d");
            }
                $application_basic = array(
                    "student_details_id_fk"=>$student_details_id_pk,
                    "application_form_no" => $application_form_no,
                    "exam_type_id_fk" => $this->input->post("courses"),
                    "mobile_number" => $this->input->post("stdMobileNo"),
                    "mobile_no_verify_status" => 1,
                    "email" => $this->input->post("stdEmail"),
                    "email_verify_status" => 1,
                    "candidate_name" => $this->input->post("fullname"),
                    "guardian_name" => $this->input->post("guardian_name"),
                    "gender_id_fk" => $this->input->post("gender"),
                    "kanyashree" => $this->input->post("kanyashree"),
                    "kanyashree_unique_id" => $this->input->post("unique_id"),
                    "udise_code" => $this->input->post("udise_code"),
                    "nationality_id_fk" => $this->input->post("nationality"),
                    "caste_id_fk" => $this->input->post("category"),
                    "handicapped" => $this->input->post("handicapped"),
                    "date_of_birth" => $date,
                    "religion_id_fk" => $this->input->post("religion"),
                    "aadhar_no" => $this->input->post("aadhar_no"),
                    "last_qualification_id_fk" => $this->input->post("last_qualification"),
                    "fullmarks" =>($this->input->post("fullmark")!= NULL) ? $this->input->post("fullmark") : NULL,
                    "marks_obtain" => ($this->input->post("marks_obtain")!= NULL) ? $this->input->post("marks_obtain") : NULL,
                    "percentage" =>($this->input->post("percentage")!= NULL) ? $this->input->post("percentage") : NULL,
                    "cgpa" => $this->input->post("c_g_p_a"),
                    "thirdyr_or_physics_or_math_result" => ($this->input->post("p_o_m1")!= NULL) ? $this->input->post("p_o_m1") : NULL,
                    "secondyear_or_chemistry_or_physicalscience_or_science_result" => ($this->input->post("p_o_m2")!= NULL) ? $this->input->post("p_o_m2") : NULL,
                    "firstyear_or_hs_english_or_lifescience_result" => ($this->input->post("p_o_m3")!= NULL) ? $this->input->post("p_o_m3") : NULL,
                    "institute_name" => $this->input->post("institute_name"),
                    "year_of_passing" => $this->input->post("passing_year"),
                    "address" => $this->input->post("address"),
                    "state_id_fk" => $this->input->post("state"),
                    "district_id_fk" => $this->input->post("district"),
                    "sub_div_id_fk" => ($this->input->post("subDivision") != NULL) ? $this->input->post("subDivision") : NULL,
                    "pincode" => $this->input->post("pincode"),
                    // "police_station_id_fk" => $this->input->post("police_station"),
                    "entry_time" => "now()",
                    "entry_ip" => $this->input->ip_address(),
                    "active_status" => 1,
                    "picture"             => $picture,
                    "sign"             => $sign,
                    "last_reg_no"             => $this->input->post('last_reg_no'),
                    "registration_year" => $year,
                    "aggregate_marks" => $aggregate_marks,
					"added_by_system" => 1,
                    "land_loser"=>$this->input->post("land_loser"),
                    "applied_under_tfw"=>$this->input->post("tfw"),
                    "wards_of_exserviceman"=>$this->input->post("exserviceman"),
                    "police_station_id_fk" => $this->input->post("police_station"),
                    "ews "=>$this->input->post("ews"),
                    "phy_challenged_doc" => $phy_challenged_doc,
                    "caste_doc"         => $caste_doc

                );

                //    echo "<pre>";
                // print_r($application_basic);
                // die;
 

                // $std_id = $this->registration_model->insert_application_details($application_basic);

                // $status = $this->registration_model->updateStdDetails($data['stdDetails']['student_details_id_pk'], $application_basic);

                // for preview student data using draft table
                if($draft_data ==''){

                     // echo "if"; die;

                   $st = $this->registration_model->insert_std_draft_details($application_basic);

                   // echo $st  .'<br>';
                   $status = md5($st);
                   $stdidfk=md5($application_basic['student_details_id_fk']);
                    //echo $status ; die;
                   
                  //  echo '<pre>'; print_r($data['stdDetails']); die;
                   // echo $status ; die;
                }else{

                   // echo "else"; die;
                   $data['stdDetails']['student_details_id_fk'];
                   $stdidfk=md5($application_basic['student_details_id_fk']);

                    $status = $this->registration_model->update_std_draft_details($application_basic,$data['stdDetails']['student_details_id_fk']);
                  // echo $status; die;  
                }
                // $status =1;
                // echo "<pre>";print_r( $status );die;
                if ($status !='') {
                     
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'You have successfully Registered.');
                   // atreyee//
                    // $std_id_details = $data['stdDetails']['student_details_id_fk'];
                    // echo "<pre>";print_r($std_id_details);die;
                    // $this->show_acknowledge_page(md5($data['stdDetails']['student_details_id_pk']));

                    redirect("online_application_various_courses/registration/show_preview_page/".$stdidfk);
                  
                    
                    
                    
                    // for preview of the student details
                  

                    // redirect('online_application_various_courses/registration/payment'); //this payment is done in the acknowledge page 
        
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
                }
            }
        } else {  //echo'm hereee'; die;
            $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
        }
       
    }
    
 /** ADDED BY ATREYEE ***/
    public function show_acknowledge_page($std_id_hash = NULL)
    {

       // echo $std_id_hash; die;

        $data['std_id_hash'] = $std_id_hash;
        $data['stdDetails']  = $this->registration_model->getStdDetailsByIdHash($data['std_id_hash']); //Moli on 24-02-2023
		
		$payment_details = $this->registration_model->getPaymentDetailsByStdId($data['stdDetails']['student_details_id_pk']);
         //echo "<pre>";print_r($payment_details);exit;
        //echo "<pre>";print_r($data);exit;
        if($payment_details){
            $data['reg_fee_status'] = 1;
			$data['transaction_id'] = $payment_details['transaction_id'];
        }else{
            $data['reg_fee_status'] = 0;
        }

        $this->load->view($this->config->item('theme') . 'online_application_various_courses/register_successfully', $data);
    }
    /* End*/

//    
    // for previw student details
    public function show_preview_page($stdidfk = null)
    {
         // echo "$status"; die;

        $data['stdDetails'] = $this->registration_model->getStdDraftDetailsByIdHash($stdidfk);
        
        // $data['stdDetails'] = $stdDetails_data;
        // echo "<pre>";
        // print_r($data['stdDetails']);
        // die;
        $stdDetails['courses'] =  $this->registration_model->get_course();
       //  echo "<pre>";print_r($data['courses']);die();

        $stdDetails['genders'] =  $this->registration_model->get_gender();
        $stdDetails['nationality'] =  $this->registration_model->get_nationality();
        $stdDetails['states'] =  $this->registration_model->get_state();
        $stdDetails['police_station'] =  $this->registration_model->get_police_station();
        $stdDetails['district'] =  $this->registration_model->get_district();
        $stdDetails['subDivision'] =  $this->registration_model->get_subdivision();

        $stdDetails['castes'] =  $this->registration_model->get_caste();
        $stdDetails['religions'] =  $this->registration_model->get_religion();
        $stdDetails['qualifications'] =  $this->registration_model->get_qualification();

        // echo "<pre>";
        // print_r($data);
        // die;
        $this->load->view($this->config->item('theme') . 'online_application_various_courses/preview_std_view', $data);
    }
    // end of code


    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->registration_model->getDistrictByStateId($state_id);

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

            $subDivision     = $this->registration_model->getSubDivisionByDistrictId($district_id);

            $response = array(
                'subDivision'  => $subDivision,
            );

            echo json_encode($response);
        }
    }

    

    public function check_category_wise_percentage($percentage, $params = null/*,$course = null*/)
    {
        list($category, $course,$handicapped) = explode(".", $params, 4);
        // echo "table: " . $table." --- field: " .$field;
         // echo $percentage." -- ".$category."---".$course."----kkk ".$handicapped;exit;   
        // if (($category == 1 && ($course == 1 || $course == 9) && $percentage < 50)|| ($handicapped='yes' && ($course == 1 || $course == 9) && $percentage < 50) ) {
        //     $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 50');
        //     return false;
        // } else if ($category != 1  && ($course == 1 || $course == 9) && $percentage < 45) {
        //     $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 45');
        //     return false;
        // } else {
        //     return true;
        // }

         if ($category == 1  && ($course == 8 || $course == 9) && $percentage < 50) {
            $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 50');
            return false;
        } else if ($category != 1 && ($course == 8 || $course == 9) && $percentage < 45) {
            $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 45');
            return false;
        }else if($handicapped=='yes' && ($course == 8 || $course == 9) && $percentage < 50){

            $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 50');
            return false;
        } else {
            return true;
        }

    }


    public function email_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
			$draft_data  = $this->registration_model->getdrafteditByIdHash($id_hash);
			//echo "<pre>";print_r($draft_data);exit;
            if (!empty($stdDetails)) {
                if (($stdDetails['email_verify_status'] != 0 || $stdDetails['mobile_no_verify_status'] != 0 || $stdDetails['email_verify_status'] == 0 || $stdDetails['mobile_no_verify_status'] == 0) && $draft_data['final_submit_status'] !=1) {
                    // echo "if";exit;

                    // if (empty($result)) {

                    $mobile_otp = rand(100000, 999999);

                    $updateArray = array(
                        'mobile_otp'          => $mobile_otp,
                        'email_verify_status' => 1,
                    );
                    $status = $this->registration_model->updateStdDetails($stdDetails['student_details_id_pk'], $updateArray);

                    if ($status) {

                        $sms_message = "Your mobile verification code for registration is " . $mobile_otp;
						//$sms_message = $mobile_otp." is your OTP for your application in the portal sctvesd.wb.gov.in towards Diploma course for JEXPO/VOCLET Examination. Regards WBSCT&VE&SD";
                        $sms_message =$mobile_otp." is your OTP for your application towards Post Diploma course, PDPC/PDME at sctvesd.wb.gov.in. Regards WBSCT&VE&SD";

                        $template_id = 0;
                        $this->sms->send($stdDetails['mobile_number'], $sms_message, $template_id);

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Email verified successfully.');

                        redirect('online_application_various_courses/registration/mobile_verify/' . $id_hash);
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your email at this time, please try again later.');

                        redirect('online_application_various_courses/registration');
                    }
                    // } 
                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function mobile_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
			$draft_data  = $this->registration_model->getdrafteditByIdHash($id_hash);
            // echo "<pre>";print_r($stdDetails);
            if (!empty($stdDetails)) {

                if (($stdDetails['mobile_no_verify_status'] != 0 || $stdDetails['mobile_no_verify_status'] == '' || $stdDetails['mobile_no_verify_status'] == 0) && $draft_data['final_submit_status'] !=1) {

                    $data['id']     = $id_hash;
                    $data['otp']    = $stdDetails['mobile_otp'];
                    $data['mobile'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $stdDetails['mobile_number']);

                    if ($this->input->server('REQUEST_METHOD') == 'POST') {
                        // echo "if";exit;
                        $this->load->library('form_validation');
                        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                        $config = array(
                            array(
                                'field' => 'otp',
                                'label' => 'OTP',
                                'rules' => 'trim|required|exact_length[6]|numeric',
                            )
                        );
                        $this->form_validation->set_rules($config);

                        if ($this->form_validation->run() != FALSE) {

                            $otp = $this->input->post('otp');
                            if ($otp == $data['otp']) {


                                $updateArray = array(
                                    'mobile_no_verify_status' => 1,
                                    'active_status'           => 1,
                                );
                                $status = $this->registration_model->updateStdDetails($stdDetails['student_details_id_pk'], $updateArray);

                                if ($status) {


                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'Verified successfully.');
                                    redirect('online_application_various_courses/registration/std_info/' . $id_hash);
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('online_application_various_courses/registration');
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('online_application_various_courses/registration/mobile_verify/' . $id_hash);
                            }
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'online_application_various_courses/std_mobile_verify_view', $data);
                } else {
                    // echo 'else';exit;

                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        } else {

            redirect(base_url());
        }
    }

    public function resend_otp($id_hash = NULL)
    {
        if ($id_hash) {

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
            if (!empty($stdDetails)) {

                $mobile_otp = rand(100000, 999999);

                $updateArray = array(
                    'mobile_otp'          => $mobile_otp,
                    'email_verify_status' => 1,
                );
                $status = $this->registration_model->updateStdDetails($stdDetails['student_details_id_pk'], $updateArray);

                if ($status) {

                    $sms_message = $mobile_otp." is your OTP for your application towards Post Diploma course, PDPC/PDME at sctvesd.wb.gov.in. Regards WBSCT&VE&SD";
                    //$sms_message ="Your mobile verification code for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD is ".$mobile_otp;
                    $template_id = 0;
                    $this->sms->send($stdDetails['mobile_number'], $sms_message, $template_id);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'OTP has been sent to Student Mobile.');

                    redirect('online_application_various_courses/registration/mobile_verify/' . $id_hash);
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! We are unable to send otp.');

                    redirect('online_application_various_courses/registration');
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
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

    public function std_acknowledgement_pdf_download($std_id_hash)
    { //echo $std_id_hash; die;

        $data['user_details'] = $this->registration_model->get_student_preview_data_list($std_id_hash);
         /*echo "<pre>";
         print_r($data['user_details']);
          die; */
        $html = $this->load->view($this->config->item('theme') . 'online_application_various_courses/pdf_view', $data, true);
		//print $html; die;
        $pdfFilePath = 'My_pdf_file-' . date('d-m-Y:h-i-s') . ".pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
        $this->m_pdf->pdf->WriteHTML($html);
        // $this->m_pdf->pdf->Output($pdfFilePath, 'D');
        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
       // redirect('download/thassos_wonder_brochure', 'refresh'); 
    }

    public function payment()
    {
    //  echo "redirect page for payment";
     $this->load->view($this->config->item('theme') . 'online_application_various_courses/payment_view');
    }
    public function acknowledgementSlip_old()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('applicationNo', '<b>Application No</b>', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                // echo "hii";
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
                $this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
            } else {
                $status = $this->registration_model->getApplicationNo($this->input->post("applicationNo"));
                // echo "<pre>";print_r($status);die;
                // $download= $this->show_acknowledge_page($status);
                // echo "<pre>";print_r($download);die;
                redirect('online_application_various_courses/registration/show_acknowledge_page/'.md5($status[0]['student_details_id_pk']));

            }

        $this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
		} else {

			$this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
		  
		}
    }
	
	public function acknowledgement_slip()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('applicationNo', '<b>Application No</b>', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                // echo "hii";
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
                $this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
            } else {
                $status = $this->registration_model->getApplicationNo($this->input->post("applicationNo"));
                // echo "<pre>";print_r($status);die;
                // $download= $this->show_acknowledge_page($status);
                // echo "<pre>";print_r($download);die;
				if($status){
					redirect('online_application_various_courses/registration/show_acknowledge_page/'.md5($status[0]['student_details_id_pk']));
				}else{
					$this->session->set_flashdata('status', 'danger');
					$this->session->set_flashdata('alert_msg', 'oops! Data Not Found ,  Error.');
					$this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
				}
                

            }

        $this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
    } else {

        $this->load->view($this->config->item('theme') . 'online_application_various_courses/acknowledgement_slip_view');
      
    }
    }

    public function finalSubmit($student_details_id_fk)
    {
        // echo "<pre>";print_r($_POST);die;
        // echo $student_details_id_fk;
        if($student_details_id_fk !=''){

            $final_data = $this->registration_model->getStdDetailsForFinalSubmit($student_details_id_fk);
			//echo "<pre>";print_r($final_data);die;
			// ! Starting Transaction
            $this->db->trans_start(); # Starting Transaction
            $status = $this->registration_model->updateStdData('council_polytechnic_spotcouncil_student_details',$final_data,$student_details_id_fk);
			if($status){
				$this->registration_model->update_draft_save_status($student_details_id_fk);
			}
            // echo "<pre>";print_r($final_data);die;
			
			// ! Check All Query For Trainee
			if ($this->db->trans_status() === FALSE) {
				# Something went wrong.
				$this->db->trans_rollback();

				$this->session->set_flashdata('status', 'danger');
				$this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');
				redirect("online_application_various_courses/registration/std_info/".md5($final_data['student_details_id_pk']));
			} else {
				# Everything is Perfect. Committing data to the database.
				$this->db->trans_commit();

				redirect("online_application_various_courses/registration/show_acknowledge_page/".md5($final_data['student_details_id_pk']));
			}
			
        }
    }

    public function download_caste_doc($id_hash = NULL)
    {

       
        $draft_data  = $this->registration_model->getdrafteditByIdHash($id_hash);
        // echo '<pre>';print_r($draft_data); die;
        if (count($draft_data)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=Caste-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($draft_data['caste_doc']);
        } else {
            show_404();
        }
    }


    public function download_handicap_doc($id = NULL)
    {

        
        $draft_data  = $this->registration_model->getdrafteditByIdHash($id_hash);
        // echo '<pre>';print_r($draft_data); die;
        if (count($draft_data)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=handicap-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($draft_data['phy_challenged_doc']);
        } else {
            show_404();
        }
    }

    //abhijit on 20-04-2023

    function db_image($picture = NULL)
	{

		$data = base64_decode($picture);



		$im = imagecreatefromstring($data);
		if ($im !== false) {

		ob_start();
		imagejpeg($im);
		$bhh=ob_get_contents();
		ob_end_clean();
		// header('Content-Type: image/jpeg');
		// imagepng($im);
		imagedestroy($im);
		$data = base64_encode ( $bhh); 
		return $data ; 
		}
		else {
		return  'An error occurred.';
		}

	}

    public function download_admit_card_online_application_student($student_id_hash = NULL)
    {
     
        $data['admitDetails']    = $this->registration_model->getStudAdmitDetails($student_id_hash);
        // echo '<pre>'; print_r($data['admitDetails']); die;
        $data['admitDetails'][0]['picture1'] = $this->db_image($data['admitDetails'][0]['picture']);
        $data['admitDetails'][0]['sign1'] = $this->db_image($data['admitDetails'][0]['sign']);
        //echo '<pre>'; print_r($data['admitDetails']); die;

        $date_of_birth = date('d-m-Y', strtotime($data['admitDetails'][0]['date_of_birth']));
        $application_form_no = $data['admitDetails'][0]['application_form_no'];
        $data['barcode'] = $this->barcode($application_form_no, $date_of_birth);
        $data['watherMark'] = base_url() . "admin/themes/adminlte/assets/image/certificate/bg-image5.png";
        //
        // echo '<pre>'; print_r($data['barcod']); die;
        $html   = $this->load->view($this->config->item('theme') . 'online_application_various_courses/admit_card_download_view.html', $data, true);
        // echo $html;die;
        $pdfFilePath = 'Admit-' . $data['admitDetails'][0]['application_form_no'] . ".pdf";
        $this->load->library('m_pdf');
      
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->showWatermarkText = true;

        $this->m_pdf->pdf->WriteHTML($html);

        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
    }

    // public function download_admit_card_online_application_student($student_id_hash = NULL)
    // {
    //     $this->load->library('m_pdf');
    //     $data = '';
    //     $html   = $this->load->view($this->config->item('theme') . 'online_application_various_courses/admit_card_download_view.html', $data, true);    
    //     $css   = $this->load->view($this->config->item('theme') . 'online_application_various_courses/pdf.css',true);            
    //     $mpdf= new mPDF();
    //     $stylesheet = file_get_contents($css); // external css
    //     $mpdf->WriteHTML($stylesheet,1);
    //     $mpdf->WriteHTML($html,2);
    //     $mpdf->Output();
    // }

  public function barcode($application_form_no = null, $date_of_birth = null)
  {
    $info = $application_form_no . ' ' . $date_of_birth;

    $this->load->library('zend');
    //load in folder Zend
    $this->zend->load('Zend/Barcode');

    //generate barcode
    $barcode = Zend_Barcode::factory('code128', 'image', array('text' => $application_form_no,'barWeidth' => 20, 'barHeight' => 15, 'factor' => 1.5), array('imageType' => 'png'));
    //set dir path for barcode image store
    //$path = './you/dir/path/'.$application_form_no.'.png';
    ob_start();
    imagepng($barcode->draw());
    $bhh = ob_get_contents();
    ob_end_clean();

    return base64_encode($bhh);
  }


    
}
