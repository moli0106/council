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
        $this->load->model("dupli/registration_model");
        //$this->load->model('admin/affiliation/details_model');
        //$this->css_head = array(
        //1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
        //);
		
		$this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );

        $this->js_foot = array(
           
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",

            
			3 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');

        
    }
	
	public function genarateApplicationFormNo_test($courses_id, $exam_year)
    {
        $start_code = $courses_id;

        // $exam_year = date('Y');

        $chaking_data = ($start_code . '/' . $exam_year);
        $check_exist_code = $this->registration_model->get_last_application_no_test($chaking_data)[0];
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
	
	public function change_duplicate_app_no(){
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $stdIdArray = $this->input->get('stdIdArray');
            //echo "<pre>";print_r($stdIdArray);exit;

            if($stdIdArray){
				
				foreach($stdIdArray as $key=>$val){
					
					$year = date('Y') . '-' . date('y', strtotime(date('Y') . "+ 1 year"));
					$courses = 1; //exam_type_id_fk 
					$application_form_no = $this->genarateApplicationFormNo_test($courses, $year);
					$upd_data = array(
						'application_form_no' => $application_form_no,
						'duplicate_flag' 	=> 2
					);
					
					// ! Starting Transaction
					$this->db->trans_start(); # Starting Transaction
					$status = $this->registration_model->updateStdEligibility($val,$upd_data);
					
					$status2 = $this->registration_model->updateStdDraft($val,$upd_data);
					
					if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();
                        
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                    }
					
				}
				//exit;
				echo json_encode('done');
                
                
				
            }
        }
	}
	
    public function check_application(){
		//echo "hi";
        $data['get_duplicate'] = $this->registration_model->get_duplicate();
		//echo "<pre>";print_r($query);exit;
        $this->load->view($this->config->item('theme') . 'dupli/show_dupli_app_no', $data);
    }

    public function index($ticket_no= NULL)
    {
        
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
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
                    'aadhar_no'=> $this->input->post('aadhar_no')
                );
                // echo "<pre>";print_r($stdDetails);die();

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
						 'year'=> '2023-24',
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

 

   

   
	
	
}
