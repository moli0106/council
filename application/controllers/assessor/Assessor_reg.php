<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Assessor_reg extends NIC_Controller {
    function __construct()
	{
		
		parent::__construct();
		//redirect("https://www.pbssd.gov.in/council/admin/maintenance");
		//$this->lang->load('council_header_footer_lang', $this->language);
		//$this->lang->load('council_lang', $this->language);
        $this->title = 'Councils ' . $this->title;
        $this->load->model("assessor/assessor_reg_model");
        //$this->css_head = array(
            //1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
        //);
        
        $this->css_head = array(
            1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri').'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
        );
		
		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'councils/js/datepicker.js',
            2  => $this->config->item('theme_uri').'councils/js/custom/assessor_reg.js',
            3  => $this->config->item('theme_uri').'councils/js/select2.full.min.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
        
    }

    public function index(){

        $data['salutations'] =  $this->assessor_reg_model->get_salutation();
        $data['genders'] =  $this->assessor_reg_model->get_gender();
        $data['languages'] =  $this->assessor_reg_model->get_language();
        $data['id_types'] =  $this->assessor_reg_model->get_id_type();
        
        $this->load->library('form_validation');


        $this->form_validation->set_rules('salutation', '<b>salutation</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );
        $this->form_validation->set_rules('fname', '<b>fname</b>', 'trim|required|max_length[20]|alpha');
        $this->form_validation->set_rules('mname', '<b>mname</b>', 'trim|max_length[20]|alpha');
        $this->form_validation->set_rules('lname', '<b>lname</b>', 'trim|required|max_length[20]|alpha');
        $this->form_validation->set_rules('gender', '<b>gender</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );
        $this->form_validation->set_rules('dob', '<b>dob</b>', 'trim|required|callback_date_validate');
        $this->form_validation->set_rules('language', '<b>language</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );
        $this->form_validation->set_rules('pan', '<b>PAN</b>', 'trim|required|regex_match[/^[A-Z]{3}[ABCFGHLJPT][A-Z][0-9]{4}[A-Z]$/]|is_unique[council_assessor_registration_details.pan]',
            array('is_unique' => "PAN card is already registered")
        );
        $this->form_validation->set_rules('panphoto', '<b>Photo Copy of PAN</b>', 'trim|callback_file_validation[panphoto|application/pdf|100|required]');
        $this->form_validation->set_rules('id_type_alt', '<b>ID type</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );

        //$this->form_validation->set_rules('id_no_alt', '<b>ID No.</b>', 'trim|required|regex_match[/^[A-Z]{3}[ABCFGHLJPT][A-Z][0-9]{4}[A-Z]$/]');
        $this->form_validation->set_rules('id_no_alt', '<b>ID No.</b>', 'trim|required|max_length[15]|min_length[10]');
        $this->form_validation->set_rules('mobile_no', '<b>Mobile No.</b>', 'trim|required|exact_length[10]|integer|is_unique[council_assessor_registration_details.mobile_no]',
            array('integer' => "The %s field must contain only numbers.")
        );
        $this->form_validation->set_rules('landline', '<b>landline</b>', 'trim|min_length[10]|max_length[11]|integer',
            array('integer' => "The %s field must contain only numbers.")
        );
        $this->form_validation->set_rules('email_id', '<b>email ID</b>', 'trim|required|max_length[50]|valid_email|is_unique[council_assessor_registration_details.email_id]');
        $this->form_validation->set_rules('captcha_code', '<b>captcha code</b>', 'trim|required|callback_captcha_check['.$this->input->post('token').']');


        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {

            $data["captcha"] = $this->load_captcha();

            //print_r( $data["captcha"]);
            $this->load->view($this->config->item('theme').'assessor/assessor_reg_basic_info_view',$data);
        } else {

            $assessor_basic = array(
                "salutation_id_fk" => $this->input->post("salutation"),
                "fname" => $this->input->post("fname"),
                "mname" => $this->input->post("mname"),
                "lname" => $this->input->post("lname"),
                "gender_id_fk" => $this->input->post("gender"),
                "dob" => $this->date_fornat_us($this->input->post("dob")),
                "language_id_fk" => $this->input->post("language"),
                "pan" => $this->input->post("pan"),
                "id_type_alt_id_fk" => $this->input->post("id_type_alt"),
                "id_no_alt" => $this->input->post("id_no_alt"),
                "mobile_no" => $this->input->post("mobile_no"),
                "landline_no" => $this->input->post("landline"),
                "email_id" => $this->input->post("email_id"),
                "entry_time" => "now()",
                "entry_ip" => $this->input->ip_address(),
                "active_status" => 1,
                "pan_file"  => base64_encode(file_get_contents($_FILES["panphoto"]['tmp_name'])),
            );
          
            if($insert_id = $this->assessor_reg_model->insert_assessor_draft($assessor_basic)) {

                //$this->output->enable_profiler();

                $this->session->otp_url = base_url()."assessor/assessor_reg/check_otp/".md5($insert_id);
                //generate otp
                $this->load->helper('string');
                $this->session->sms_otp = random_string('numeric', 6);
                $this->session->otp_send_time = (int)time();
                $this->session->mobile_no = $this->input->post("mobile_no");

                //echo "OTP: ". $this->session->sms_otp;
                //echo "<br/>URL: ". $this->session->otp_url;

                //send email
                $data['email_subject'] = "Email Verification WBSCTVE & SD";
                $data['url'] = $this->session->otp_url;

                $email_subject = "Email Verification";
                $email_message = $this->load->view($this->config->item('theme').'assessor/council_email_template_view',$data,TRUE);
				
                $send_mail_status = send_email($this->input->post("email_id"),$email_message,$email_subject);
                //echo $send_mail_status;die;
                
                //send otp
                //$this->load->library('sms');
                $sms_message ="Your mobile verification code for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD is ". $this->session->sms_otp;
				//$template_id=1107161201120409862; //pbssd
				$template_id=0;
                $this->sms->send($this->input->post("mobile_no"),$sms_message,$template_id);
                


                $this->load->view($this->config->item('theme').'assessor/assessor_reg_basic_success_view',$data);

            } else {
                $data["captcha"] = $this->load_captcha();
                //print_r( $data["captcha"]);
                $this->load->view($this->config->item('theme').'assessor/assessor_reg_basic_info_view',$data);
            }


           
        }
    }

    public function check_otp($insert_id_hash = NULL){

        $data['otp_life_time'] = 601;
        //print_r($_POST);
        //echo "OTP: ". $this->session->sms_otp;
        //echo "<br/>URL: ". $this->session->otp_url;

        //$this->output->enable_profiler();

        if($insert_id_hash != NULL){

            $data["captcha"] = $this->load_captcha();

            $data["assessor"] = $this->assessor_reg_model->get_draft_info($insert_id_hash);
			//print_r($data["assessor"]);
			//22-02-2021 start
            if(count($data["assessor"])){
				
				$duplicate_check_array = array(
					"mobile_no" => $data["assessor"][0]["mobile_no"],
					"email_id"	=> $data["assessor"][0]["email_id"],
					"pan" => $data["assessor"][0]["pan"]
				);
				
			$duplicate_data = $this->assessor_reg_model->check_duplicate($duplicate_check_array);
						
			if(count($duplicate_data)){
				$data['duplicate_status'] = TRUE;
				$data['duplicate_result'] = array_intersect($duplicate_check_array, $duplicate_data[0]);
				
				
			}
			//22-02-2021 end
			

				if(count($data["assessor"])){

					//print_r($data["assessor"]);
					$this->load->library('form_validation');
					$this->form_validation->set_rules('captcha_code', '<b>captcha_code</b>', 'trim|required');
					$this->form_validation->set_rules('submit', '<b>submit</b>', 'trim|required');
					$this->form_validation->set_rules('captcha_code', '<b>captcha code</b>', 'trim|required|callback_captcha_check['.$this->input->post('token').']');

					if($this->input->post("submit") == "otp_submit") {
						$this->form_validation->set_rules('mobile_otp', '<b>OTP</b>', 'trim|required');
					}

					if ($this->form_validation->run() == FALSE) {

					} else {
						//
						if($this->input->post("submit") == "resend_otp"){
							//echo "otp change";

							//generate otp
							$this->load->helper('string');
							$this->session->sms_otp = random_string('numeric', 6);
							$this->session->otp_send_time = (int)time();
							$this->session->mobile_no = $data["assessor"][0]['mobile_no'];
							//$sms_message ="Your mobile verification code for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD is ". $this->session->sms_otp;
							$sms_message ="Your mobile verification code for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD is ". $this->session->sms_otp;
							//$template_id=1707163169674139456; //council
							$template_id=0;
							$this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);




						} elseif($this->input->post("submit") == "otp_submit") {
							if($this->input->post("mobile_otp") == $this->session->sms_otp){
								//echo "correct otp";
								session_destroy();

								$this->load->helper('string');

								//table data migration here
								$assessor_draft = $this->assessor_reg_model->get_assessor_draft($insert_id_hash)[0];
								$assessor_draft["acknowledgement"] = "ACK".time().strtoupper(random_string('alpha', 2));
								$assessor_draft["entry_time"] = "now()";
								$assessor_draft["entry_ip"] = $this->input->ip_address();
								$assessor_draft["basic_flag"] = TRUE;


								// echo "<pre>";
								// print_r($assessor_draft);
								// echo "</pre>";

								if($new_insert_id = $this->assessor_reg_model->assessor_migrate($assessor_draft,$insert_id_hash)){
									//assessor/assessor_reg/reg_form/
									
									$data['email_subject'] = "Assessor Registration (Part B)";
									$data['url'] = base_url()."assessor/assessor_reg/reg_form/".md5($new_insert_id);

									//$email_subject = "Assessor Registration (Part B)";
									//$email_message = $this->load->view($this->config->item('theme').'assessor/council_email_template_part_b_view',$data,TRUE);;
									//send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);

									//redirect(base_url()."assessor/assessor_reg/reg_form/".md5($new_insert_id));

									//send this link to email again with aacknowledgement code

									$ass_id = $assessor_draft['email_id'];;
									$pass = $this->gen_password();

									$login_array = array(
										"stake_id_fk"       => 3,
										"login_id"          => $ass_id,
										"login_password"    => hash("sha256",$pass),
										//"activation_date"   => "NOW()",
										"active_status"     => 1,
										"entry_time"        => "NOW()",
										"entry_ip"          => $this->input->ip_address(),
										"stake_holder_details" => $this->input->post("full_name"),
										"stake_details_id_fk"  => $new_insert_id,
										"base_password"     => $pass,
										"base_login_id"     => $ass_id

									);
									// echo "<pre>";
									// print_r($generate_login);
									// echo "</pre>";

									if($this->assessor_reg_model->create_login($login_array)){
										
										$data["success"] = "success";
										$data["message"] = "OTP verification done successfully. Please check your email";

										$data['user_name'] = $ass_id;
										$data['password']  = $pass;
										$data['full_name'] = $this->input->post('full_name');
										$data['login_url'] = base_url()."admin/";
										$email_subject = "Assessor Login";
										$email_message = $this->load->view($this->config->item('theme').'assessor/council_email_template_id_password_view',$data,TRUE);;
										send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);

										$sms_message ="Login id and password for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD sent to your registered mail id. Please login to complete application process.";
										//$this->sms->sendotp($this->session->mobile_no,$sms_message);
										//$template_id=1107161201130031686; //pbssd
										$template_id=0;
										$this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);
									} else {
										$data["success"] = "danger";
										$data["message"] = "Something is wrong. Please try again";
									}

								} 
								


							} else {
								$data["wrong_otp_message"] = "Wrong OTP. Please try again";
							}
						} else {
							show_404();
						}
					}

					if($this->session->sms_otp == NULL || $this->session->otp_send_time == NULL){
						//echo "Invalid Page hit";
					} else {

						$data['otp_sms'] = $this->session->sms_otp;
						$data['otp_life_time'] = (time() - $this->session->otp_send_time);

					}

					$this->load->view($this->config->item('theme').'assessor/assessor_check_otp_view',$data);
				} else {
					show_404();
				}
			}
        } else {
            show_404();
        }
    }
    
    public function gen_assessor_login_id($assessor_id_pk = NULL){

        $max = 4;
        $count = strlen($assessor_id_pk);
        $cont = "0";

        //$max = $max - $count;

        //echo $count;

        for($i= 0; $i <= ($max - $count) ; $i++){
            $cont .= "0";
        }

       // echo  $cont;

        //$this->load->helper('string');
         //$rand = random_string('alnum', 4);
         return "ASR" . $cont . $assessor_id_pk;
    }
    public function gen_password(){
        $this->load->helper('string');
         return random_string('alnum', 8);
         //return $rand;
    }

    public function reg_form($assessor_id_hash = NULL){

        //$this->output->enable_profiler();
        
        if(strlen($assessor_id_hash) == 32){
            $assessors_data = $this->assessor_reg_model->get_assessor_id($assessor_id_hash);

            //print_r($assessors_data);
            if(count($assessors_data) != 1){
               show_404();
            } else {
                if($assessors_data[0]['assessor_code'] == NULL){
                    $data['assessor_id_pk'] = $assessors_data[0]["assessor_registration_details_pk"];
                    $this->session->email_id = $assessors_data[0]["email_id"];
                } else {
                    show_404();
                }
                
            }

            //print_r($assessors_dataa);
        } else {
            show_404();
        }

        $data['assessor_id_hash'] = $assessor_id_hash;   
        //$data["courses"] = $this->assessor_reg_model->get_data();
        $data["qualifications"] = $this->assessor_reg_model->get_qualification();
        $data["states"] = $this->assessor_reg_model->get_states();
        $data["districts"] = $this->assessor_reg_model->get_districts();
        $data["employments"] = $this->assessor_reg_model->get_employments();
        $data['assessor_courses'] =  $this->assessor_reg_model->get_all_courses();

        $data["blocks"] = array();
        $data["permanent_blocks"] = array();
        $data['domain_experiances'] = array();
        $data['domains'] = $this->assessor_reg_model->get_all_domains();

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";

        $this->load->library('form_validation');

        $this->form_validation->set_rules('apply_highest_quali', 'highest qualification', 'trim|required');
        $this->form_validation->set_rules('domain_exp', 'domain experiance', 'trim|required');
        $this->form_validation->set_rules('domain', 'domain experiance', 'trim|required');

        
        if($this->input->method(TRUE) == "POST"){
            
            //Applying for?
            if(set_value("apply_for_assessor") == NULL && set_value("apply_for_expert") == NULL){
                $data['apply_for'] = "<b>Apply for</b> is required";
                //
            } elseif(set_value("apply_for_assessor") != NULL && set_value("apply_for_expert") == NULL) {
                $this->form_validation->set_rules('apply_for_assessor', 'apply_for_assessor', 'trim|integer');
            } elseif(set_value("apply_for_assessor") == NULL && set_value("apply_for_expert") != NULL){
                $this->form_validation->set_rules('apply_for_expert', 'apply_for_expert', 'trim|integer');
            } elseif(set_value("apply_for_assessor") != NULL && set_value("apply_for_expert") != NULL){
                $this->form_validation->set_rules('apply_for_assessor', 'apply_for_assessor', 'trim|integer');
                $this->form_validation->set_rules('apply_for_expert', 'apply_for_expert', 'trim|integer');
            }

            //Expert
           if($this->input->post("apply_for_expert") != NULL){
               if(set_value("expart_type_academic") == NULL && set_value("expart_type_industrial") == NULL){
                    $data['academic_expert'] = "<b>Expert type</b> is required";
                    //
               } elseif(set_value("expart_type_academic") != NULL && set_value("expart_type_industrial") == NULL){
                    $this->form_validation->set_rules('expart_type_academic', 'expart type academic', 'trim|integer');
               } elseif(set_value("expart_type_academic") == NULL && set_value("expart_type_industrial") != NULL){
                    $this->form_validation->set_rules('expart_type_industrial', 'expart type industrial', 'trim|integer');
               } elseif(set_value("expart_type_academic") == NULL && set_value("expart_type_industrial") != NULL){
                    $this->form_validation->set_rules('expart_type_academic', 'expart type academic', 'trim|integer');
                    $this->form_validation->set_rules('expart_type_industrial', 'expart type industrial', 'trim|integer');
               }
           }

           //certified
           if($this->input->post("certified") == 1){
               //echo "aaa";
                foreach($this->input->post("assessing_body") as $k => $v){
                    $this->form_validation->set_rules('assessing_body['.$k.']', 'assessing body', 'trim|required');
                    $this->form_validation->set_rules('certificate_number['.$k.']', 'certificate number', 'trim|required');
                    $this->form_validation->set_rules('certificate_doc_'.$k, 'certificate doc', 'trim|callback_file_validation[certificate_doc_'.$k.'|application/pdf|100|required]');
                }

                
            }
            
           //work experience
           foreach($this->input->post("org_name") as $k => $v){
                $this->form_validation->set_rules('org_name['.$k.']', 'org name', 'trim|required');
                $this->form_validation->set_rules('work_area['.$k.']', 'work area', 'trim|required');
                $this->form_validation->set_rules('work_years['.$k.']', 'work years', 'trim|required|numeric');
                $this->form_validation->set_rules('work_months['.$k.']', 'work months', 'trim|required|numeric');
                $this->form_validation->set_rules('experience_'.$k, 'experience doc', 'trim|callback_file_validation[experience_'.$k.'|application/pdf|100|required]');
            }

            //work experience
           foreach($this->input->post("exp_as_assessor_job_role") as $k => $v){
                $this->form_validation->set_rules('exp_as_assessor_job_role['.$k.']', 'job role', 'trim|required');
                $this->form_validation->set_rules('nsqf_level['.$k.']', 'NSQF Level', 'trim|required');
                $this->form_validation->set_rules('exp_as_assessor_work_years['.$k.']', 'work years', 'trim|required|numeric');
                $this->form_validation->set_rules('exp_as_assessor_work_months['.$k.']', 'work months', 'trim|required|numeric');
                $this->form_validation->set_rules('exp_as_assessor_doc_'.$k, 'Upload doc', 'trim|callback_file_validation[exp_as_assessor_doc_'.$k.'|application/pdf|100|required]');
            }

            $this->form_validation->set_rules('highest_quali', 'highest qualification', 'trim|required|numeric');
            $this->form_validation->set_rules('discipline', 'discipline', 'trim|required');
            $this->form_validation->set_rules('othert_quali', 'other quali', 'trim|required');
            $this->form_validation->set_rules('current_emp_status', 'current employment status', 'trim|required|numeric');

            $this->form_validation->set_rules('house_flat_building', 'house or flat or building', 'trim|required');
            $this->form_validation->set_rules('street', 'street', 'trim|required');
            $this->form_validation->set_rules('post_opffice', 'post_opffice', 'trim|required');
            $this->form_validation->set_rules('police', 'police', 'trim');
            $this->form_validation->set_rules('state', 'state', 'trim|required|numeric');
            $this->form_validation->set_rules('district', 'district', 'trim|required|numeric');
            $this->form_validation->set_rules('block', 'block', 'trim|required|numeric');
            $this->form_validation->set_rules('pin', 'pin', 'trim|required|numeric|exact_length[6]');

            $this->form_validation->set_rules('permanent_house_flat_building', 'house or flat or building', 'trim|required');
            $this->form_validation->set_rules('permanent_street', 'permanent_street', 'trim|required');
            $this->form_validation->set_rules('permanent_post_office', 'posto office', 'trim|required');
            $this->form_validation->set_rules('permanent_police', 'permanent_police', 'trim');
            $this->form_validation->set_rules('permanent_state', 'state', 'trim|required');
            $this->form_validation->set_rules('permanent_district', 'district', 'trim|required');
            $this->form_validation->set_rules('permanent_block', 'block', 'trim|required');
            $this->form_validation->set_rules('permanent_pin', 'permanent_pin', 'trim|required|numeric|exact_length[6]');

            $this->form_validation->set_rules('working_in', 'working in', 'trim');

            $this->form_validation->set_rules('cv', 'CV', 'trim|callback_file_validation[cv|application/pdf|200|required]');
            $this->form_validation->set_rules('photo', 'photo', 'trim|callback_file_validation[photo|image/jpeg|50|required]');
            $this->form_validation->set_rules('declaration', 'declaration', 'trim|required');
            $this->form_validation->set_rules('captcha_code', 'captcha code', 'trim|required|callback_captcha_check['.$this->input->post('token').']');
            
            if($this->input->post("working_in") != NULL){
                $this->form_validation->set_rules('centre_code', 'centre code', 'trim|required');
            }


           //jobrole sector validation
           foreach($this->input->post("job_role") as $k => $v){
                $this->form_validation->set_rules('job_role['.$k.']', 'job role', 'trim|integer|required');
                $this->form_validation->set_rules('sector['.$k.']', 'Sector', 'trim|required');
                $this->form_validation->set_rules('job_role_sp_quali['.$k.']', 'expart type industrial', 'trim');
           }



            //Sat array course
            if($this->input->post("apply_highest_quali") != NULL && $this->input->post("domain_exp") != NULL && $this->input->post("domain") != NULL){
                $data['courses'] = $this->assessor_reg_model->get_data($this->input->post("apply_highest_quali"),$this->input->post("domain_exp"),$this->input->post("domain"));
                //print_r($data['courses']);
            }
            if($this->input->post("apply_highest_quali") != NULL){
                $data['domain_experiances'] = $this->assessor_reg_model->get_domain_experiance($this->input->post("apply_highest_quali"));
            }

            if($this->input->post("district") != NULL){
                $data['blocks'] = $this->assessor_reg_model->get_blocks($this->input->post("district"));
            }
            if($this->input->post("permanent_district") != NULL){
                $data['permanent_blocks'] = $this->assessor_reg_model->get_blocks($this->input->post("permanent_district"));
            }
        }

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {
            
            $data["captcha"] = $this->load_captcha();
            if(set_value("apply_highest_quali")){
                $data['domain_experiances'] = $this->assessor_reg_model->get_domain_experiance(set_value("apply_highest_quali"));
            }
            $this->load->view($this->config->item('theme').'assessor/assessor_reg_view',$data);
        } else {
           //final submission

           if(isset($data['academic_expert']) || isset($data['apply_for'])){
             //echo "not Final Submit";
                $data["captcha"] = $this->load_captcha();

                $this->load->view($this->config->item('theme').'assessor/assessor_reg_view',$data);
           } else {

            $this->load->helper('string');

            //table data migration here
            //
            $assessor_code = "AS".time().strtoupper(random_string('alpha', 2));
                //final submit
                $assessor_main_data = array( // update
                    "apply_highest_quali"           => $this->input->post("apply_highest_quali"),
                    "domain_exp"                    => $this->input->post("domain_exp"),
                    "domain_id_fk"                  => $this->input->post("domain"),
                    "apply_for_assessor"            => $this->input->post("apply_for_assessor"),
                    "apply_for_expert"              => $this->input->post("apply_for_expert"),
                    "expart_type_academic"          => $this->input->post("expart_type_academic"),
                    "expart_type_industrial"        => $this->input->post("expart_type_industrial"),
                    "certified_by_any_assessor"     => $this->input->post("certified"),
                    "highest_qualification_id_pk"   => $this->input->post("highest_quali"),
                    "discipline"                    => $this->input->post("discipline"),
                    "othert_quali"                  => $this->input->post("othert_quali"),
                    "current_emp_status_id_fk"      => $this->input->post("current_emp_status"),

                    "house_flat_building"           => $this->input->post("house_flat_building"),
                    "street"                        => $this->input->post("street"),
                    "post_opffice"                  => $this->input->post("post_opffice"),
                    "police"                        => $this->input->post("police"),
                    "state_id_fk"                   => $this->input->post("state"),
                    "district_id_fk"                => $this->input->post("district"),
                    "block_id_fk"                   => $this->input->post("block"),
                    "pin"                           => $this->input->post("pin"),

                    "permanent_house_flat_building" => $this->input->post("permanent_house_flat_building"),
                    "permanent_street"              => $this->input->post("permanent_street"),
                    "permanent_post_office"         => $this->input->post("permanent_post_office"),
                    "permanent_state_id_fk"         => $this->input->post("permanent_state"),
                    "permanent_district_id_fk"      => $this->input->post("permanent_district"),
                    "permanent_block_id_fk"         => $this->input->post("permanent_block"),
                    "permanent_pin"                 => $this->input->post("permanent_pin"),

                    "working_in"                    => $this->input->post("working_in"),
                    "centre_code"                   => $this->input->post("centre_code"),
                    "centre_name"                   => $this->input->post("centre_name"),
                    "cv"                            => base64_encode(file_get_contents($_FILES["cv"]['tmp_name'])),
                    "photo"                         => base64_encode(file_get_contents($_FILES["photo"]['tmp_name'])),
                    "assessor_code"                 => $assessor_code,
                    "final_submission_ip"           => $this->input->ip_address(),
                    "final_submission_time"         =>"now()",
                );
                
                //Jobrole sector data
                $i = 0;
                $jobrole_sector_data = array();
                foreach($this->input->post("job_role") as $k  => $v){
                    $jobrole_sector_data[$i]["course_id_fk"]       = $this->input->post("job_role[". $k."]");
                    $jobrole_sector_data[$i]["job_role_sp_quali"]  = $this->input->post("job_role_sp_quali[". $k."]");
                    $jobrole_sector_data[$i]["assessor_registration_details_fk"]      = $this->input->post("assessor_id");
                    $jobrole_sector_data[$i]["active_status"]      = 1;
                    //$jobrole_sector_data[$i]["entry_time"]         = "now()";
                    $i++;
                }

                //certified data
                $certified_data = array();
                $j = 0;
                if($this->input->post("certified") == 1){
                    foreach($this->input->post("assessing_body") as $k  => $v){
                        $certified_data[$j]["assessing_body"]       = $this->input->post("assessing_body[". $k."]");
                        $certified_data[$j]["certificate_number"]   = $this->input->post("certificate_number[". $k."]");
                        $certified_data[$j]["certificate_doc"]      = base64_encode(file_get_contents($_FILES["certificate_doc_". $k]['tmp_name']));
                        $certified_data[$j]["assessor_registration_details_fk"]      = $this->input->post("assessor_id");
                        $certified_data[$j]["active_status"]        = 1;
                        //$certified_data[$i]["entry_time"]           = "now()";
                        $j++;
                    }
                }

                //work experience data
                $work_experience_data = array();
                $o = 0;
                foreach($this->input->post("org_name") as $m  => $v){
                    $work_experience_data[$o]["organisation_name"]   = $this->input->post("org_name[". $m."]");
                    $work_experience_data[$o]["area_of_work"]        = $this->input->post("work_area[". $m."]");
                    $work_experience_data[$o]["no_of_years"]         = $this->input->post("work_years[". $m."]");
                    $work_experience_data[$o]["no_of_months"]        = $this->input->post("work_months[". $m."]");
                    $work_experience_data[$o]["upload_doc"]          = base64_encode(file_get_contents($_FILES["experience_". $m]['tmp_name']));
                    $work_experience_data[$o]["assessor_registration_details_fk"]      = $this->input->post("assessor_id");
                    $work_experience_data[$o]["active_status"]       = 1;
                    //$work_experience_data[$i]["entry_time"]          = "now()";
                    $o++;
                }

                //Assessor experience
                $assessor_experience_data = array();
                $l = 0;
                foreach($this->input->post("exp_as_assessor_job_role") as $n => $v){
                    $assessor_experience_data[$l]["exp_as_assessor_job_role_id_fk"]   = $this->input->post("exp_as_assessor_job_role[". $n."]");
                    $assessor_experience_data[$l]["nsqf_level"]                       = $this->input->post("nsqf_level[". $n."]");
                    $assessor_experience_data[$l]["exp_as_assessor_work_years"]       = $this->input->post("exp_as_assessor_work_years[". $n."]");
                    $assessor_experience_data[$l]["exp_as_assessor_work_months"]      = $this->input->post("exp_as_assessor_work_months[". $n."]");
                    $assessor_experience_data[$l]["assessor_registration_details_fk"]      = $this->input->post("assessor_id");
                    $assessor_experience_data[$l]["exp_as_assessor_doc"]              = base64_encode(file_get_contents($_FILES["exp_as_assessor_doc_". $n]['tmp_name']));
                    $assessor_experience_data[$l]["active_status"]                    = 1;
                    //$assessor_experience_data[$i]["entry_time"]                       = "now()";
                    $l++;
                }

                // echo "<pre>";
                // print_r($assessor_main_data);
                // print_r($jobrole_sector_data);
                // print_r($certified_data);
                // print_r($work_experience_data);
                // print_r($assessor_experience_data);
                // echo "</pre>";
           }

           if($this->assessor_reg_model->update_assessor_data($assessor_main_data,$this->input->post("assessor_id"),$jobrole_sector_data,$certified_data,$work_experience_data,$assessor_experience_data)){
                //$data["assessment_id"] = 
                $data['success'] = "success";
                $data['message'] = "Your Assessor Registration Form Submitted Successfully with Acknowledgement. No- <b>".$assessor_code."</b>. Please keep it safe for further use.";

                $data['email_subject'] = "Assessor Registration Success";
                $data['assessor_code'] = $assessor_code;

                $email_subject = "Assessor Registration Success";
                $email_message = $this->load->view($this->config->item('theme').'assessor/council_email_success_template_view',$data,TRUE);;
                send_email($this->session->email_id,$email_message,$email_subject);
                
                $this->load->view($this->config->item('theme').'assessor/assessor_reg_success_view',$data);
            } else {
                $data['success'] = "danger";
                $data['message'] = "Something went wrongt. Plwase try again";
                $this->load->view($this->config->item('theme').'assessor/assessor_reg_success_view',$data);
           }
           
        }
    }
    //

    public function ajax_block($district_id = NULL){
        //$this->output->enable_profiler();
        $blocks = $this->assessor_reg_model->get_blocks($district_id);
        echo '<option value="">-- Select Block / Municipality --</option> ';
        foreach($blocks as $block){
            echo '<option value="'.$block['block_municipality_id_pk'].'">'.$block['block_municipality_name'].'</option>';
        }
    }
    
    //file validation
    public function file_validation($fild = NULL, $file_name = NULL){

        $file_array = explode("|",$file_name);

        if($file_array[1] == "application/pdf"){
            $ext = "PDF";
        } elseif($file_array[1] == "image/jpeg"){
            $ext = "JPG";
        }
        if($file_array[3] == "required"){
            $file_data = $_FILES[$file_array[0]];
            if($file_data['name'] != NULL){
                if($file_data['type'] == $file_array[1]){ // mime
                    if($file_data['size'] <= $file_array[2]*1000){ // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is '.$file_array[2].' KB  for {field}');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be '. $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if($file_data['name'] != NULL){
                if($file_data['type'] == $file_array[1]){ // mime
                    if($file_data['size'] <= $file_array[2]*1000){ // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is '.$file_array[2].' KB  for {field}');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be '.$ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
    }

    public function ajax_jobrole_course($course_sector_block_count = NULL,$quali = NULL, $domain_exp = NULL, $domain =NULL){
        
        //$this->output->enable_profiler();
         
        $data["course_sector_block_count"] = $course_sector_block_count + 1;
        $data["courses"] = $this->assessor_reg_model->get_data($quali,$domain_exp,$domain);
        $this->load->view($this->config->item('theme').'assessor/ajax_job_role_course_view',$data);
    }

    public function ajax_jobrole_select($quali,$domain_exp,$domain){

        $courses = $this->assessor_reg_model->get_data($quali,$domain_exp,$domain);

        ?><option value="">-- Select Job Role --</option><?php
        foreach($courses as $course){ ?>
        <option value="<?php echo $course["course_id_pk"] ?>"><?php echo $course["course_name"] ?> (<?php echo $course["course_code"] ?>)</option>
        <?php }
    }

    public function get_sector_and_other($course_id_hash = NULL){
        //$this->output->enable_profiler();
        $sector = $this->assessor_reg_model->get_sector_and_other($course_id_hash);

        if(count($sector)){
            $array_value = array(
                "success" => 1,
                "data" =>  $sector[0]
            );
        } else {
            $array_value = array(
                "success" => 0
            );
        }

        print_r(json_encode($array_value));
    }

    public function ajax_assessor_certified($assessing_body_count = NULL){
        $data['assessing_body_count'] = $assessing_body_count;

        $this->load->view($this->config->item('theme').'assessor/ajax_assessor_certified_view',$data);
    }

    public function ajax_work_experiance($count_work_experience = NULL){
        $data['count_work_experience'] = $count_work_experience;
        $this->load->view($this->config->item('theme').'assessor/ajax_work_experiance_view',$data);
    }

    public function ajax_experiance_as_assessor($count_experience_section = NULL){
        $data['count_experience_section'] = $count_experience_section;
        $data['assessor_courses'] =  $this->assessor_reg_model->get_all_courses();
        $this->load->view($this->config->item('theme').'assessor/ajax_experiance_as_assessor_view',$data);
    }

    public function ajax_get_domain_experiance($qualification_id = NULL){

        //ajax_domain_experiance_view.php
        $data['domain_experiances'] = $this->assessor_reg_model->get_domain_experiance($qualification_id);
        $this->load->view($this->config->item('theme').'assessor/ajax_domain_experiance_view',$data);

    }

    // date format and validation
    function date_fornat_us($date_uk = NULL){
		$date_array = explode("/",$date_uk);
		return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
	}
	function date_validate($date_uk = NULL) {
		$date_array = explode("/",$date_uk);
		if(count($date_array) == 3) {
            if(checkdate ($date_array[1],$date_array[0],$date_array[2])) {
                return TRUE;
            }  else {
                $this->form_validation->set_message('date_validate', 'The {field} date format is wrong.');
                return FALSE;
            }
		} else  {
            $this->form_validation->set_message('date_validate', 'The {field} date format is wrong .');
            return FALSE;
		}
    }
    
    //validation for captcha
	public function captcha_check($captcha,$security_code){
        //echo $captcha;     

		if($captcha != ""){
			if(hash('sha256',strtoupper($captcha).$this->config->item('encryption_key')) == $security_code){
                return TRUE;
			} else {
				$this->form_validation->set_message('captcha_check', 'The {field} is incorrect');
	            return FALSE;
			}
		}
	}

    function load_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
			//'word'          => 'AbCd',
			'img_path'      => './captcha/',
			'img_url'       => 'captcha/',
			//'font_path'     => './captcha4.ttf',
			'img_width'     => '132',
			'img_height'    => 38,
			'expiration'    => 7200,
			'word_length'   => 5,
			'font_size'     => 16,
			//'img_id'        => 'Imageid',
			//'pool'          => '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ',
			'pool'          => '123456789abcdefghjkmnpqrstuvwxyz',
	
			// White background and border, black text and red grid
			'colors'        => array(
                'background' => array(255, 255, 255),
                'border' => array(200, 200, 200),
                'text' => array(100, 100, 100),
                'grid' => array(200, 200, 200)
			)
		);
		$cap = create_captcha($vals);
		$captcha_word = hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key'));
		$captcha = array('image'=>$cap['image'],'word'=>$captcha_word);
		return $captcha;

    }
    
    public function email_temp(){
        $data['email_subject'] = "Email Verification";
        $data['url'] = "http://192.168.1.16/utkarshbangla/assessor/assessor_reg/email_temp";
        echo $this->load->view($this->config->item('theme').'assessor/council_email_template_view',$data,TRUE);
    }

    public function email_temp_part_b(){
        $data['email_subject'] = "Email Verification";
        $data['url'] = "http://192.168.1.16/utkarshbangla/assessor/assessor_reg/email_temp";
        echo $this->load->view($this->config->item('theme').'assessor/council_email_template_part_b_view',$data,TRUE);
    }

    public function email_temp_success(){
        $data['email_subject'] = "Assessor Registration Success";
        $data['assessor_code'] = "AW78776777887766AA";
        echo $this->load->view($this->config->item('theme').'assessor/council_email_success_template_view',$data,TRUE);
    }

    public function email_temp_send_id_pw(){
        $data['user_name'] = "ASR0099823";
        $data['full_name'] = "Parag Dhali";
        $data['password']  = "G6yt6sS";
        $data['login_url'] = "https://www.pbssd.gov.in/admin/";
        echo $this->load->view($this->config->item('theme').'assessor/council_email_template_id_password_view',$data,TRUE);
    }

    
}