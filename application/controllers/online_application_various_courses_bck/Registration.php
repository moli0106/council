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

    function decrypt_data($encryptedData)
	{
        $decryptionKey = 'IP16TDW0L5AQB41V6S6J8QLTPLRXBV2W';
        $initializationVector = "V0ZMZO6WZ45KY2PL";
        $algo='aes-256-cbc';
        $options = 0;

        $plaintext = openssl_decrypt(
            $encryptedData,
            $algo,
            $decryptionKey,
            $options,
            $initializationVector
        );
        return $plaintext;  
        
 		
	}

    public function index($ticket_no= NULL)
    {
        //$this->load->library('apidata');

        
        // echo "<pre>";print_r($_POST);exit;

        if(isset($_POST['encData'])){
           

            $decrypt_rest = $this->decrypt_data($_POST['encData']);
            $decryptedData_arr = json_decode($decrypt_rest);
            //echo "<pre>";print_r($decryptedData_arr);die;

            $api_arr = array(
                'user_id'							=> $decryptedData_arr->userid,
                'ticket_no'							=> $decryptedData_arr->ticketno,
                'citizenname'					=> $decryptedData_arr->citizenname,
                'citizenmobile'			=> $decryptedData_arr->citizenmobile,
                'encrypted_str'					=> $_POST['encData']
            );
        
            // $data['api_arr'] = $api_arr;
            $this->session->set_userdata('api_arr',$api_arr);
        }
        $data['api_arr'] = $this->session->userdata('api_arr');
        // echo "<pre>";print_r( $data['api_arr']);die;
       
        $data['courses'] =  $this->registration_model->get_course();
        // echo "<pre>";print_r( $data['courses']);die;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
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
                    'rules' => 'trim|required|exact_length[12]'
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
                    'course_id_fk'=> $this->input->post('courses'),
                    'aadhar_no'=> $this->input->post('aadhar_no')
                );

                //Added by Moli on 23-02-2023 for BSK
                if($data['api_arr']['ticket_no'] !=''){
                    $stdDetails['bsk_ticket_no'] = $data['api_arr']['ticket_no'];
                    $stdDetails['bsk_status'] = 1;
                    $stdDetails['bsk_userid'] = $data['api_arr']['user_id'];
                }
                // echo "<pre>";print_r($stdDetails);die();

                $std_id = $this->registration_model->insert_application_details($stdDetails);
                /** added by ATREYEE ***/
                $course_id = $this->input->post('courses');
                $course = $this->registration_model->get_specific_course_name_atz($course_id);
                //$course_name = 'PDME';
                if (!empty($std_id)) {
                    // echo $course_name; exit;
                   //print_r($course); exit;

                   /** Added By Moli on 23-02-2023 */

                    /* 
                            ============================================= 
                        !   SEND Response In BSK Portal       ! 

                        !   If student entry into BSK Portal  !
                            ============================================= 
                    */

                    // ! Prepare post data for api call

                    if($data['ticket_no'] !=''){

                        $this->load->library('bskapidata');
                        $stdResponse = $this->bskapidata->studentEntryData($data['ticket_no']);
                        // echo "<pre>";print_r($stdResponse);
    
                        $encryptStdRes = $this->encrypt_student_response(json_encode($stdResponse));
                        // echo $encryptStdRes;exit;

                        $upd_json_data = array(
                            'email_verify_sending_json' => json_encode($stdResponse),
                            'email_verify_sending_time' => 'now()',
                            'email_verify_sending_enc_data' => $encryptStdRes
                        );
                        $this->registration_model->updateBSKJsonTable('council_bsk_api_json_data',$upd_json_data,$data['ticket_no']);

                        // ! API Call for assessor is assigned
                        $this->load->config('wbsctvesd_api_config');
                        $url = $this->config->item('assessor_assign_url')[$result['vertical_code']];

                        $this->load->library('curl');
                        $curl_response = $this->curl->curl_make_post_request($url, $assessorAssignResponse);

                        if (!$curl_response) {

                            $this->assessing_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                        }
                    }

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

    function encrypt_data(){
		// $this->config->set_item('csrf_protection', 'false');
		//$data = $_POST['test'];
		$data='{"userid":"8527419636","ticketno":"20221202153322882","citizenmobile":"9963258
963","citizenname":"Anupam Ghosh"}';
		$encryptionKey = "IP16TDW0L5AQB41V6S6J8QLTPLRXBV2W"; 
		 $initializationVector = "V0ZMZO6WZ45KY2PL";
		 $options = 0;
		 $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $encryptionKey, $options, 
		$initializationVector);
		 echo $encryptedData;
		
		 
		// echo $data;
	}

    public function encrypt_student_response($stdResponse){

        $encryptionKey = "IP16TDW0L5AQB41V6S6J8QLTPLRXBV2W"; 
        $initializationVector = "V0ZMZO6WZ45KY2PL";
        $options = 0;
        $encryptedData = openssl_encrypt($stdResponse, 'aes-256-cbc', $encryptionKey, $options, 
       $initializationVector);
        return $encryptedData;
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

        $data['stdDetails']  = $this->registration_model->getStdDetailsByIdHash($id_hash);

        $data['courses'] =  $this->registration_model->get_course();
        // echo "<pre>";print_r($data['courses']);die();

        $data['genders'] =  $this->registration_model->get_gender();
        $data['nationality'] =  $this->registration_model->get_nationality();
        $data['states'] =  $this->registration_model->get_state();
        $data['police_station'] =  $this->registration_model->get_police_station();
        // echo '<pre>'; print_r($data); die;
        $data['castes'] =  $this->registration_model->get_caste();
        $data['religions'] =  $this->registration_model->get_religion();
        $data['qualifications'] =  $this->registration_model->get_qualification();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {




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

            $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');


            $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|50|required]');



            /* open after checking*/
            $this->form_validation->set_rules(
                'percentage',
                '<b>Percentage</b>',
                "trim|required|callback_check_category_wise_percentage[$category.$course.$handicapped]"

            );

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
            
            $this->form_validation->set_rules(
                'last_qualification',
                '<b>Last Qualification</b>',
                'trim|required'

            );
            $this->form_validation->set_rules('fullmark', '<b>Full Marks</b>', 'trim|required');
            $this->form_validation->set_rules('marks_obtain', '<b>marks_obtain</b>', 'trim|required');
            // $this->form_validation->set_rules('percentage', '<b>Percentage</b>', 'trim|required');
            $this->form_validation->set_rules('c_g_p_a', '<b>CGPA</b>', 'trim|required');

            if ($course == 1 || $course== 9||$course == 8||$course == 3) { //for pdpc/pdme/jxpo/Pharmacy additional fields
                $this->form_validation->set_rules('p_o_m1', '<b>Percentage of marks (3rd yr Diploma / Physics / Mathematics)</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m2', '<b>Percentage of marks (2nd yr / Chemistry / Physics / Science)</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m3', '<b>Percentage of Marks (1st yr / English(H.S) / Life Science)</b>', 'trim|required');
    
               } else if($course == 2) { //for voclet additional fields
                $this->form_validation->set_rules('p_o_m3', '<b>Percentage of Marks (English(H.S))</b>','trim|required');
               } else if($course == 7) { //for HMCT additional fields
                $this->form_validation->set_rules('p_o_m3', '<b>Percentage of Marks of English</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m2', '<b>Percentage of Marks of Physical Science or Science</b>', 'trim|required');
                $this->form_validation->set_rules('p_o_m1', '<b>Percentage of Marks of Mathematics </b>', 'trim|required');
               }



            // $this->form_validation->set_rules('p_o_m1', '<b>Percentage of marks (3rd yr Diploma / Physics / Mathematics)</b>', 'trim|required');
            // $this->form_validation->set_rules('p_o_m2', '<b>Percentage of marks (2nd yr / Chemistry / Physics / Science)</b>', 'trim|required');
            // $this->form_validation->set_rules('p_o_m3', '<b>Percentage of Marks (1st yr / English(H.S) / Life Science)</b>', 'trim|required');

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
            //    echo $aggregate_marks; die;
			
				$tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");
				
                $application_basic = array(
                    "application_form_no" => $application_form_no,
                    "course_id_fk" => $this->input->post("courses"),
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
                    "fullmarks" => $this->input->post("fullmark"),
                    "marks_obtain" => $this->input->post("marks_obtain"),
                    "percentage" => $this->input->post("percentage"),
                    "cgpa" => $this->input->post("c_g_p_a"),
                    "thirdyr_or_physics_or_math_result" => $this->input->post("p_o_m1"),
                    "secondyear_or_chemistry_or_physicalscience_or_science_result" => $this->input->post("p_o_m2"),
                    "firstyear_or_hs_english_or_lifescience_result" => $this->input->post("p_o_m3"),
                    "institute_name" => $this->input->post("institute_name"),
                    "year_of_passing" => $this->input->post("passing_year"),
                    "address" => $this->input->post("address"),
                    "state_id_fk" => $this->input->post("state"),
                    "district_id_fk" => $this->input->post("district"),
                    "sub_div_id_fk" => ($this->input->post("subDivision") != NULL) ? $this->input->post("subDivision") : NULL,
                    "pincode" => $this->input->post("pincode"),
                    "police_station_id_fk" => $this->input->post("police_station"),
                    "entry_time" => "now()",
                    "entry_ip" => $this->input->ip_address(),
                    "active_status" => 1,
                    "picture"             => base64_encode(file_get_contents($_FILES["std_image"]['tmp_name'])),
                    "sign"             => base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name'])),
                    "last_reg_no"             => $this->input->post('last_reg_no'),
                    "registration_year" => $year,
                    "aggregate_marks" => $aggregate_marks,
					"added_by_system" => 1

                );
                //    echo "<pre>";
                // print_r($application_basic);
                // die;
 

                // $std_id = $this->registration_model->insert_application_details($application_basic);
                $status = $this->registration_model->updateStdDetails($data['stdDetails']['student_details_id_pk'], $application_basic);
                // echo "<pre>";print_r( $status );die;
                if ($status) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'You have successfully Registered.');
                   // atreyee//
                    $std_id_details = $data['stdDetails']['student_details_id_pk'];
                    $this->show_acknowledge_page(md5($data['stdDetails']['student_details_id_pk']));

                    //redirect('online_application_various_courses/registration/payment');
        
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
                }
            }
        } else {
            $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
        }
       
    }
    
 /** ADDED BY ATREYEE ***/
    public function show_acknowledge_page($std_id_hash = NULL)
    {

        $data['std_id_hash'] = $std_id_hash;
        $data['stdDetails']  = $this->registration_model->getStdDetailsByIdHash($data['std_id_hash']); //Moli on 24-02-2023

        $this->load->view($this->config->item('theme') . 'online_application_various_courses/register_successfully', $data);
    }
    /* End*/

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

    // public function check_category_wise_percentage_old($percentage, $params = null/*,$course = null*/)
    // {
    //     list($category, $course) = explode(".", $params, 2);
    //     // echo "table: " . $table." --- field: " .$field;
    //     //  echo $percentage." -- ".$category."---";exit;
    //     if ($category == 1 && $course == 1||$course == 6 && $percentage < 50) {
    //         $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 50');
    //         return false;
    //     } else if ($category != 1  && $percentage < 45) {
    //         $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 45');
    //         return false;
    //     } else {
    //         return true;
    //     }
    //     // echo $category.'-----'.$percentage;die;

    // }
    // public function check_category_wise_percentage_old_04_01_2023($percentage, $params = null/*,$course = null*/)
    // {
    //     list($category, $course,$handicapped) = explode(".", $params, 3);
    //     // echo "table: " . $table." --- field: " .$field;
    //     //  echo $percentage." -- ".$category."---".$course;exit;
    //     if (($category == 1 && ($course == 1 || $course == 9) && $percentage < 50)|| ($handicapped='yes' && ($course == 1 || $course == 9) && $percentage < 50) ) {
    //         $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 50');
    //         return false0
    //     }  elseif ($category != 1   && $percentage < 45) { /*&& ($course == 1 || $course == 9)*/
    //         $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 45');
    //         return false;
    //     } else {
    //         return true;
    //     }
    //     // echo $category.'-----'.$percentage;die;

    // }

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
        // echo $category.'-----'.$percentage;die;

    }


    public function email_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
            // echo "<pre>";print_r($stdDetails);die;
            if (!empty($stdDetails)) {
                if ($stdDetails['email_verify_status'] == 0 || $stdDetails['mobile_no_verify_status'] == 0) {
                    // echo "if";exit;

                    // if (empty($result)) {

                    $mobile_otp = rand(100000, 999999);

                    $updateArray = array(
                        'mobile_otp'          => $mobile_otp,
                        'email_verify_status' => 1,
                    );
                    $status = $this->registration_model->updateStdDetails($stdDetails['student_details_id_pk'], $updateArray);

                    if ($status) {

                        //$sms_message = "Your mobile verification code for registration is " . $mobile_otp;
						$sms_message = $mobile_otp." is your OTP for your application towards Post Diploma course, PDPC/PDME at sctvesd.wb.gov.in. Regards WBSCT&VE&SD";
                        // $sms_message ="Your mobile verification code for registration as Assessor/ Expert  Trainer of Trainers under WBSCTVESD is ".$mobile_otp;

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
            // echo "<pre>";print_r($stdDetails);
            if (!empty($stdDetails)) {

                if ($stdDetails['mobile_no_verify_status'] == 0 || $stdDetails['mobile_no_verify_status'] == '') {

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
    {

        $data['user_details'] = $this->registration_model->get_student_preview_data_list($std_id_hash);
        // echo "<pre>";
        // print_r($data['user_details']);
        //  die;
        $html = $this->load->view($this->config->item('theme') . 'online_application_various_courses/pdf_view', $data, true);
        $pdfFilePath = 'My_pdf_file-' . date('d-m-Y:h-i-s') . ".pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
        $this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->Output($pdfFilePath, 'D');
        // $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        redirect('download/thassos_wonder_brochure', 'refresh'); 
    }

    public function payment()
    {
    //  echo "redirect page for payment";
     $this->load->view($this->config->item('theme') . 'online_application_various_courses/payment_view');
    }

    /*-----------------------OTP Testing-------------------------*/

    // function send()
    // {
    //     $mobile_no = 7003650317;
    //     $template = 0;
    //     $mobile_otp=123456;
    //     $message = $mobile_otp."is your OTP for your application towards Post Diploma course, PDPC/PDME at sctvesd.wb.gov.in. Regards WBSCT&VE&SD";
    //     $mobile         = urlencode($mobile_no);
    //     $msg            = urlencode($message);
    //     $template_id    = urlencode($template);
    //     $ukey           = 'xa1a8ogxRdKjGM62zMO3yti3P';  //ukey assigned to account xa1a8ogxRdKjGM62zMO3yti3P
    //     $senderid       = 'TVESD';      //Source address of the msg
    //     $language       = 0;    //0-For English,2-For Multilingual
    //     $credittype     = 7;    //1-Promo,2-Trans,7-Testing

    //     $url = "http://125.16.147.178/VoicenSMS/webresources/CreateSMSCampaignGet?ukey=$ukey&msisdn=$mobile&language=$language&credittype=$credittype&senderid=$senderid&templateid=$template_id&message=$msg&filetype=2";

    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_HEADER, 0);
    //     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    //     // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //     // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    //     // curl_setopt($ch, CURLOPT_CAINFO, '/etc/pki/tls/certs/ca-bundle.crt');
    //     $curl_output = curl_exec($ch);

    //     /*-------------------Instead of curl you can use this-----------------*/
    //     /*
    //         $send = file_get_contents($url);
    //         print_r($send);die;

    //     */

    //     if ($err = curl_error($ch)) {
    //         return FALSE;
    //         // echo 'f';
    //         print_r($err);
    //     } else {
    //         return TRUE;
    //         // echo 't';
    //         print_r($curl_output);
    //     }
    //     // echo "string";
    //     // print_r($curl_output);
    // }
}
