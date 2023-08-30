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

    public function index($pdf_download = NULL,$std_id_hash = NULL){
            
        $data = array();
        if($pdf_download == 1){

            $this->std_acknowledgement_pdf_download($std_id_hash);

        }

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
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'online_application_various_courses/std_email_phone_verify_view', $data);
            } else {

                $stdDetails = array(

                    'candidate_name' => $this->input->post('fullname'),
                    'mobile_number' => $this->input->post('stdMobileNo'),
                    'email' => $this->input->post('stdEmail'),
                );
                $std_id = $this->registration_model->insert_application_details($stdDetails);

                if(!empty($std_id)){
                    // echo $std_id;exit;

                    $data = array(
                        'url' => base_url('online_application_various_courses/registration/email_verify/'.md5($std_id)),
                        'year'=> '2022-23'
                    );
    
                    $email_subject = "Email Verification";
                    $email_message = $this->load->view($this->config->item('theme') . 'online_application_various_courses/email_template_view', $data, TRUE);
                    $status = send_email($this->input->post('vtcEmail'), $email_message, $email_subject);

                    if ($status) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, We have sent you a verification link on your VTC email. Please verify your email.');
                    } else {

                        $url = '<a href="' . $data['url'] . '" target="_blank">Click Here</a>';

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Please ' . $url);
                    }
                    // }
                    redirect('online_application_various_courses/registration');
                }


            }
        }else{

            $this->load->view($this->config->item('theme') . 'online_application_various_courses/std_email_phone_verify_view', $data);
        }
    }

    public function genarateApplicationFormNo($courses_id, $exam_year)
    {
        $start_code = $courses_id;

        // $exam_year = date('Y');

        $chaking_data = ($start_code .'/'. $exam_year);
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

        $application_form_no = $start_code .'/'. $exam_year . '/' . $number;

        

        return $application_form_no;
    }
   

    public function std_info($id_hash = NULL)
    {
       
        $data['stdDetails']  = $this->registration_model->getStdDetailsByIdHash($id_hash);

        $data['courses'] =  $this->registration_model->get_course();
        $data['genders'] =  $this->registration_model->get_gender();
        $data['nationality'] =  $this->registration_model->get_nationality();
        $data['states'] =  $this->registration_model->get_state();
        // $data['districts'] =  $this->registration_model->get_district();
        $data['castes'] =  $this->registration_model->get_caste();
        $data['religions'] =  $this->registration_model->get_religion();
        $data['qualifications'] =  $this->registration_model->get_qualification();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            


            $category = $this->input->post('category');
            $percentage = $this->input->post('percentage');

            $district = $this->input->post('district');
            if (!empty($this->input->post('state'))) {
                $data['district'] = $this->registration_model->getDistrictByStateId($this->input->post('state'));
            }
            if(!empty($district)){

                if ($district == 16) {

                    $kolkataArray = array(
                        0 => 682, // KOLKATA NORTH 
                        1 => 683, // KOLKATA SOUTH
                        2 => 16, // KOLKATA
                    )
                    ;
        
                    $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId($district);
                } elseif (($district== 682) || ($district == 683)) {
        
                    $kolkataArray = array(
                        0 => $district, // SOUTH / NORTH KOLKATA
                        1 => 16, // KOLKATA
                    )
                    ;
        
                    $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId(16);
                } else {
        
                    $data['subDivision']  = $this->registration_model->getSubDivisionByDistrictId($district);
                }
            }
            $this->load->library('form_validation');


            $this->form_validation->set_rules(
                'courses',
                '<b>courses</b>',
                'trim|required|integer',
                array('integer' => 'The %s field is invalid')
            );
            $this->form_validation->set_rules('fullname', '<b>Fullname</b>', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('guardian_name', '<b>Guardian_name</b>', 'trim|required');
            $this->form_validation->set_rules('gender', '<b>Gender</b>', 'trim|required');

            $this->form_validation->set_rules('stdEmail', '<b>Email</b>', 'trim|required');
            $this->form_validation->set_rules('stdMobileNo', '<b>Mobile No</b>', 'trim|required');

            if($this->input->post('gender') == 2){
                $this->form_validation->set_rules('kanyashree', '<b>Kanyashree</b>', 'trim|required');

                //kanyashree_unique_id
                if($this->input->post('kanyashree') == 'yes'){
                    $this->form_validation->set_rules('unique_id', '<b>Unique Id</b>', 'trim|required');
                    
                }
            }
            
            $this->form_validation->set_rules('nationality', '<b>Nationality</b>', 'trim|required');

            $this->form_validation->set_rules('category','<b>Category</b>','trim|required');

            $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');
                
            
            $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|50|required]');


            // if($category == 1){
            //     if(!empty($percentage) && $percentage <50){
            //         // echo "1";exit;
            //         $this->form_validation->set_rules('percentage', '<b>Percentage must be 50</b>', 'trim|required');
 
            //     }
            // }else{

            //     if(!empty($percentage) && $percentage <45){
            //         $this->form_validation->set_rules('percentage', '<b>Percentage must be 45</b>', 'trim|required');
 
            //     }

            // }
            /* open after checking*/ 
            // $this->form_validation->set_rules(
            //     'percentage',
            //    '<b>Percentage</b>',
            //     "callback_check_category_wise_percentage[$category,$percentage]|trim|required",

            // );

            // $this->form_validation->set_rules(
            //     'percentage',
            //    '<b>Percentage</b>',
            //     'callback_check_category_wise_percentage['.$category.',percentagee|trim|required]',

            // );
            $this->form_validation->set_rules('handicapped', '<b>Handicapped</b>', 'trim|required');
            $this->form_validation->set_rules(
                'dob',
                '<b>Date of Birth</b>',
                'trim|required'

            );
            //callback_date_validate

            $this->form_validation->set_rules('religion', '<b>Religion.</b>', 'trim|required');
            $this->form_validation->set_rules(
                'aadhar_no',
                '<b>Aadhar No</b>',
                'trim|required|is_unique[council_polytechnic_spotcouncil_student_details.aadhar_no]',
                array('is_unique' => "Aadhar card is already registered")
            );
            $this->form_validation->set_rules(
                'last_qualification',
                '<b>Last Qualification</b>',
                'trim|required'

            );
            $this->form_validation->set_rules('fullmark', '<b>Full Marks</b>', 'trim|required');
            $this->form_validation->set_rules('marks_obtain', '<b>marks_obtain</b>', 'trim|required');
            // $this->form_validation->set_rules('percentage', '<b>Percentage</b>', 'trim|required');
            $this->form_validation->set_rules('c_g_p_a', '<b>CGPA</b>', 'trim|required');
            $this->form_validation->set_rules('institute_name', '<b>Institute Name</b>', 'trim|required');
            $this->form_validation->set_rules('passing_year', '<b>Passing Year</b>', 'trim|required');
            $this->form_validation->set_rules('address', '<b>Address</b>', 'trim|required');
            $this->form_validation->set_rules('state', '<b>State</b>', 'trim|required');
            $this->form_validation->set_rules('district', '<b>District</b>', 'trim|required');
            
           if($this->input->post('state')==19){
               $this->form_validation->set_rules('subDivision', '<b>subDivision</b>', 'trim|required');
            }
            $this->form_validation->set_rules('pincode', '<b>Pincode</b>', 'trim|required');
            $this->form_validation->set_rules('last_reg_no', '<b>Reg No</b>', 'trim|required');
            


            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == FALSE) {
                // echo validation_errors();
                //die;
                // echo "hii";
                // die;

                // $data["captcha"] = $this->load_captcha();

                //print_r( $data["captcha"]);

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'oops! something went wrong.');
                $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
            } else {

                
                $year = '2022-23';
                $courses = $this->input->post('courses');
                $application_form_no = $this->genarateApplicationFormNo($courses,$year);

                $application_basic = array(
                    "application_form_no" =>$application_form_no,
                    "course_id_fk" => $this->input->post("courses"),
                    "candidate_name" => $this->input->post("fullname"),
                    "guardian_name" => $this->input->post("guardian_name"),
                    "gender_id_fk" => $this->input->post("gender"),
                    "kanyashree" => $this->input->post("kanyashree"),
                    "kanyashree_unique_id" => $this->input->post("unique_id"),
                    "nationality_id_fk" => $this->input->post("nationality"),
                    "caste_id_fk" => $this->input->post("category"),
                    "handicapped" => $this->input->post("handicapped"),
                    "date_of_birth" => $this->input->post("dob"),
                    "religion_id_fk" => $this->input->post("religion"),
                    "aadhar_no" => $this->input->post("aadhar_no"),
                    "last_qualification_id_fk" => $this->input->post("last_qualification"),
                    "fullmarks" => $this->input->post("fullmark"),
                    "marks_obtain" => $this->input->post("marks_obtain"),
                    "percentage" => $this->input->post("percentage"),
                    "cgpa" => $this->input->post("c_g_p_a"),
                    "institute_name" => $this->input->post("institute_name"),
                    "year_of_passing" => $this->input->post("passing_year"),
                    "address" => $this->input->post("address"),
                    "state_id_fk" => $this->input->post("state"),
                    "district_id_fk" => $this->input->post("district"),
                    "sub_div_id_fk" => ($this->input->post("subDivision") !=NULL) ? $this->input->post("subDivision") : NULL,
                    "pincode" => $this->input->post("pincode"),
                    "entry_time" => "now()",
                    "entry_ip" => $this->input->ip_address(),
                    "active_status" => 1,
                    "picture"             => base64_encode(file_get_contents($_FILES["std_image"]['tmp_name'])),
                    "sign"             => base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name'])),
                    "last_reg_no"             => $this->input->post('last_reg_no'),
                    "registration_year" => $year,
                ); 
                //    echo "<pre>";
                //print_r($application_basic);
                //die;
          

                // $std_id = $this->registration_model->insert_application_details($application_basic);
                $status = $this->registration_model->updateStdDetails($data['stdDetails']['student_details_id_pk'], $application_basic);
                if($status){

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'You have successfully Registered.');
                    redirect('online_application_various_courses/registration','refresh');
                    $this->std_acknowledgement_pdf_download(md5($data['stdDetails']['student_details_id_pk']));
                    $pdf_download = 1;
                    $std_id_hash = md5($data['stdDetails']['student_details_id_pk']);
                    // redirect('online_application_various_courses/registration','refresh');
                    
                    
                    

                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
                }
            
                
                
            }
        } else {
            $this->load->view($this->config->item('theme') . 'online_application_various_courses/registration_view', $data);
        }
    }

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

    public function check_category_wise_percentage($category,$percentage)
    {
        // echo $percentage;exit;
        if($category==1 && $percentage<50)
        {
            $this->form_validation->set_message('check_category_wise_percentage', 'Percentage must be at least 50');
            return false;
        }
        // echo $category.'-----'.$percentage;die;

    }


    public function email_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
            // echo "<pre>";print_r($stdDetails);
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

                            $sms_message = $mobile_otp."is your OTP for your application towards Post Diploma course, PDPC/PDME at sctvesd.wb.gov.in. Regards WBSCT&VE&SD";

                            //$sms_message = "Your mobile verification code for registration is " . $mobile_otp;
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
                                    'active_status'               => 1,
                                );
                                $status = $this->registration_model->updateStdDetails($stdDetails['student_details_id_pk'], $updateArray);

                                if ($status) {

                                    
                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'Verified successfully.');
                                    redirect('online_application_various_courses/registration/std_info/'.$id_hash);
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
       
        $data['user_details']=$this->registration_model->get_student_preview_data_list($std_id_hash);
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
        // redirect('online_application_various_courses/registration','refresh');
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

                    $sms_message = "Your mobile verification code for registration is " . $mobile_otp;
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
}
