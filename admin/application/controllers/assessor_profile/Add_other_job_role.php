<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_other_job_role extends NIC_Controller 
{
    public $application_no = NULL;
    public $application_approve_status = NULL;
    public $application_message = "";
    public $final_submission_status = NULL;
    public $assessor_registration_application_nubmer_id = NULL;
    public $mood = NULL;

	public function __construct(){
		
		parent::__construct();
		parent::check_privilege(17);


		//$this->load->model('assessor_profile/assessor_registration_model');
		//$this->output->enable_profiler(TRUE);
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
			//3 => $this->config->item('theme_uri').'finance/css/style.css'
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			3 => $this->config->item('theme_uri').'assessor_profile/js/new_assessor_reg.js',
			//4 => $this->config->item('theme_uri').'js/moment.js',
			5 => $this->config->item('theme_uri').'jQuery.print.min.js',  // added parag 12-01-2021
		);
		$this->load->helper('email');
        $this->load->library('sms');


        $this->load->model("assessor_profile/add_other_job_role_model");
        $this->load->model('assessor_profile/Assessor_registration_add_more_model',"assessor_registration_model");
        $application_status = $this->add_other_job_role_model->get_application_number_status();
        
        if(count($application_status)){
           if($application_status[0]['assessor_registration_application_no'] != NULL){
                $this->application_no = $application_status[0]['assessor_registration_application_no'];
           }
           if($application_status[0]['approve_status'] == 1 && $application_status[0]['final_submission_status'] == 1){
                //final submit and approved
                $this->application_approve_status = $application_status[0]['approve_status'];
                $this->application_message = "Your previous application is approved. Now you can apply for new application";
                $this->application_no = ((int)$application_status[0]['assessor_registration_application_no'] + 1);
                $this->mood = 1;

           } elseif($application_status[0]['approve_status'] == 0 && $application_status[0]['final_submission_status'] == 1) {
               //funal submit but not approved
                $this->application_approve_status = $application_status[0]['approve_status'];
                $this->application_message = "Your previous application is not approved. After approval you can apply for new application..";
                $this->mood = 2;
           } elseif($application_status[0]['approve_status'] == 0 && $application_status[0]['final_submission_status'] == NULL){
               //not final submit
               if($application_status[0]['assessor_registration_application_no'] == 1){
                   //if first application
                    $this->application_approve_status = $application_status[0]['approve_status'];
                    $this->application_message = "Your first application is not submitted yet. Please submit it and after approval you can apply for new application";
                    $this->mood = 3;
               } else {
                    $this->application_approve_status = $application_status[0]['approve_status'];
                    $this->assessor_registration_application_nubmer_id = $application_status[0]['assessor_registration_application_nubmer_id_pk'];
                    $this->application_message = "This is application no ". $application_status[0]['assessor_registration_application_no'];
                    $this->application_no = $application_status[0]['assessor_registration_application_no'];
                    $this->mood = 4;
               }
                
           } else {
               //echo "invalid";
               $this->mood = 5;
           }
        } else {
            $this->application_message ="No Application found";
        }
       
    }
    public function index(){
        $data['aa'] = array();
        //echo "other job role";

       //echo $this->application_message;
       //echo $this->assessor_registration_application_nubmer_id;

        //echo "<pre>";
        //print_r($this->application_status);
        //echo "</pre>";


        $this->load->view($this->config->item('theme').'assessor_profile/add_other_jobrole_view',$data);
    }
    
    public function new_application(){
        $this->load->library('form_validation');
        
        
        
        $this->form_validation->set_rules('app_no', 'application no', 'trim|required|integer');
        if ($this->form_validation->run() == FALSE){
            echo form_error('app_no');
        } else {
            $new_app_entry = array(
                "assessor_registration_details_fk" => $this->session->stake_details_id_fk,
                "assessor_registration_application_no" => $this->input->post("app_no"),
                "insert_date" => "now()",
                "insert_ip" => $this->input->ip_address(),
                "approve_status" => 0,
                "active_status" => 1
                
            );
            //echo "<pre>";
            //print_r($new_app_entry);
            //echo "</pre>";
            
            if($this->add_other_job_role_model->apply_new_application($new_app_entry,"council_assessor_registration_application_nubmer")){
                redirect("admin/assessor_profile/add_other_job_role/new_application_form");
            } else {
                echo "fail";
                
            }
        }
        
        
    }
    
    public function new_application_form(){
        $app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['domains'] = array();
		$data['domain_experiances'] = array();
		$data['courses'] = array();
		$data['jobroles'] = array();
		//$this->output->enable_profiler(TRUE);

		//24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		// echo "<pre>";
		// print_r($data['application_count']);
		// echo "</pre>";

		// 24-03-2021 start


		if($this->input->method(TRUE) == "GET"){

			$data['assessor'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			//$data['assessor2'] = $this->assessor_registration_model->get_assessor_application_course_details($app_id_hash);

			$data['jobroles'] = $this->assessor_registration_model->get_assessor_jobroles($this->session->userdata('stake_details_id_fk'),$data['application_count'][0]['assessor_registration_application_no']);


			//print_r($data['jobroles']);


			if($data['assessor'][0]["apply_highest_quali"] != NULL){
				$data['domain_experiances'] = $this->assessor_registration_model->get_domain_experiance($data['application_count'][0]['apply_highest_quali']);
				
				//$data['domains'] = $this->assessor_registration_model->get_experience_domain($data['assessor'][0]["apply_highest_quali"],$data['assessor'][0]["domain_exp"]);
				$data['domains'] = $this->assessor_registration_model->get_experience_domain($data['application_count'][0]['apply_highest_quali'],$data['application_count'][0]['domain_exp']);
				
				//print_r($data['domain_experiances']);

				//$courses = $this->assessor_registration_model->get_data($quali,$domain_exp,$domain);

				if(
					$data['assessor'][0]["apply_highest_quali"] != NULL &&
					$data['assessor'][0]["domain_exp"] != NULL &&
					$data['assessor'][0]["domain_id_fk"] != NULL
				){
					$data['courses'] = $this->assessor_registration_model->get_data($data['application_count'][0]['apply_highest_quali'],$data['application_count'][0]['domain_exp'],$data['application_count'][0]['domain_id_fk']);
					//print_r($data['courses']);
				} 
				
			}
			
			//print_r($data['assessor']);
			
		} elseif($this->input->method(TRUE) == "POST") {

			if(
				$this->input->post("apply_highest_quali") != NULL &&
				$this->input->post("domain_exp") != NULL &&
				$this->input->post("domain") != NULL
			){
				$data['courses'] = $this->assessor_registration_model->get_data($this->input->post("apply_highest_quali"),$this->input->post("domain_exp"),$this->input->post("domain"));
			}
			if($this->input->post("apply_highest_quali") != NULL){
				//Domain Select
				//$data['domains'] = $this->assessor_registration_model->get_experience_domain($this->input->post("apply_highest_quali"));
				
				$data['domains'] = $this->assessor_registration_model->get_experience_domain($this->input->post("apply_highest_quali"),$this->input->post("domain_exp"));
				//Experience Select
				$data['domain_experiances'] = $this->assessor_registration_model->get_domain_experiance($this->input->post("apply_highest_quali"));
			}
		}
		
		$data["qualifications"] = $this->assessor_registration_model->get_qualification();
        //$data['domains'] = $this->assessor_registration_model->get_all_domains();
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		//print_r($data['app_data']);
		$this->load->library('form_validation');


		$this->form_validation->set_rules('apply_highest_quali', 'highest qualification', 'trim|required');
        $this->form_validation->set_rules('domain_exp', 'domain experience', 'trim|required');
        $this->form_validation->set_rules('domain', 'domain experience', 'trim|required');

        
        if($this->input->method(TRUE) == "POST"){
            
            //Applying for?
            if(set_value("apply_for_assessor") == NULL && set_value("apply_for_expert") == NULL && set_value("trainer_of_trainers") == NULL){
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

		   //jobrole sector validation
		   $job_role_array = $this->input->post("job_role") == "" ? array() : $this->input->post("job_role");
			foreach($this->input->post("job_role") as $k => $v){
				$this->form_validation->set_rules('job_role['.$k.']', 'job role', 'trim|integer|required|callback_jobrole_dublication_check|callback_check_course_duplicate');
				$this->form_validation->set_rules('sector['.$k.']', 'Sector', 'trim|required');
				$this->form_validation->set_rules('job_role_sp_quali['.$k.']', 'expart type industrial', 'trim');
			}
		}
		

		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE) {

		} else {

			$assessor_main_data = array( // update
				"apply_highest_quali"           => $this->input->post("apply_highest_quali"),
				"domain_exp"                    => $this->input->post("domain_exp"),
				"domain_id_fk"                  => $this->input->post("domain"),
				"apply_for_assessor"            => $this->input->post("apply_for_assessor"),
				"apply_for_expert"              => $this->input->post("apply_for_expert"),
				"expart_type_academic"          => $this->input->post("expart_type_academic"),
				"expart_type_industrial"        => $this->input->post("expart_type_industrial"),
				"apply_for_trainer_of_trainer"	=> $this->input->post("trainer_of_trainers"),
				"course_flag"					=> TRUE

			);

			$jobrole_sector_data = array();
			$i = 1;
			foreach($this->input->post("job_role") as $k  => $v){
				$jobrole_sector_data[$i]["course_id_fk"]       = $this->input->post("job_role[". $k."]");
				$jobrole_sector_data[$i]["job_role_sp_quali"]  = $this->input->post("job_role_sp_quali[". $k."]");
				$jobrole_sector_data[$i]["assessor_registration_details_fk"]      = $this->session->userdata('stake_details_id_fk');
				$jobrole_sector_data[$i]["active_status"]      = 1;
				//new addition
				$jobrole_sector_data[$i]["apply_highest_quali"] = $this->input->post("apply_highest_quali"); // will be dynamic
				$jobrole_sector_data[$i]["domain_exp"] = $this->input->post("domain_exp"); // will be dynamic
				$jobrole_sector_data[$i]["domain_id_fk"] = $this->input->post("domain"); // will be dynamic
				$jobrole_sector_data[$i]["apply_for_assessor"] = $this->input->post("apply_for_assessor"); // will be dynamic
				$jobrole_sector_data[$i]["apply_for_expert"] = $this->input->post("apply_for_expert"); // will be dynamic
				$jobrole_sector_data[$i]["expart_type_academic"] = $this->input->post("expart_type_academic"); // will be dynamic
				$jobrole_sector_data[$i]["expart_type_industrial"] = $this->input->post("expart_type_industrial"); // will be dynamic
				$jobrole_sector_data[$i]["apply_for_trainer_of_trainer"] = $this->input->post("trainer_of_trainers"); // will be dynamic

				//update module 24-03-2021
				$jobrole_sector_data[$i]["assessor_registration_application_no"] = $this->input->post("application_no");
				$jobrole_sector_data[$i]["assessor_registration_application_nubmer_id_fk"] = $this->input->post("application_count_id");

				$i++;
			}

			//$assessor_registration_application_no = $this->input->post("application_no");

			if($this->assessor_registration_model->update_course_data($assessor_main_data,$this->session->userdata('stake_details_id_fk'),$jobrole_sector_data,$this->input->post("application_no"))){
                //$data["assessment_id"] = 
                $data['success'] = "success";
                $data['message'] = "Course details has been successfully updated";
            } else {

				//$this->output->enable_profiler();
                $data['success'] = "danger";
                $data['message'] = "Something went wrongt. Plwase try again";
           }
			//echo "Success";
		}

		$this->load->view($this->config->item('theme').'assessor_profile/new_course_details_view',$data);

        //echo "Application form will be here";
    }

	//course duplicate validation
	public function check_course_duplicate($val) {
		// if ($val == 'test') {
		// 		$this->form_validation->set_message('check_course_duplicate', 'The {field} field can not be the word "test"');
		// 		return FALSE;
		// } else {
		// 		return TRUE;
		// }

		$course_array = $this->input->post('job_role');
		$val = NULL;

		//$i = 1;
		$duplicate = 0;
		//echo "<pre>";
		foreach($course_array as $key0 => $val0){
			$val = $this->input->post('job_role['.$key0.']');
			
			foreach($course_array as $key1 => $val1){
				if($key0 !== $key1){
					if($val0 == $val1){
						$duplicate = 1;

						
					} 
				}
			}
		} 

		if($duplicate == 1){
			$this->form_validation->set_message('check_course_duplicate', 'The {field} is duplicate');
			return FALSE;
		} else {
			return TRUE;
		}
		//echo "</pre>";
		//echo $duplicate;
    }
	public function jobrole_dublication_check($jobrole=NULL){
		// if ($str == 'test')
		// {
		// 		$this->form_validation->set_message('username_check', 'The {field} field can not be the word "test"');
		// 		return FALSE;
		// }
		// else
		// {
		// 		return TRUE;
		// }

		$assessor_id = $this->session->stake_details_id_fk;
		$application_no = $this->input->post("application_no");

		$courses_count = $this->assessor_registration_model->get_applied_courses($jobrole,$application_no,$assessor_id);
		//print_r($courses_count);

		if($courses_count[0]['count'] == 0){
			return TRUE;
		} else {
			$this->form_validation->set_message('jobrole_dublication_check', 'This <b>job role</b> is already inserted');
			return FALSE;
		}
	}

    public function edu_quali_indus_profe_exp(){

		//$this->output->enable_profiler();
		        //24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 start
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['assessor'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		//print_r($data['assessor']);
		
		$this->load->library('form_validation');
		$data["employments"] = $this->assessor_registration_model->get_employments();
		$data["qualifications"] = $this->assessor_registration_model->get_qualification();
		$this->title = "Educational Qualification and Industry/Professional Experience";
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);

		//certified
		if($this->input->post("certified") == 1){
			//echo print_r($this->input->post("assessing_body"));
			 foreach($this->input->post("assessing_body") as $k => $v){
				 $this->form_validation->set_rules('assessing_body['.$k.']', 'assessing body', 'trim|required');
				 $this->form_validation->set_rules('certificate_number['.$k.']', 'certificate number', 'trim|required');
				 $this->form_validation->set_rules('certificate_doc_'.$k, 'certificate doc', 'trim|callback_file_validation[certificate_doc_'.$k.'|application/pdf|100|required]');
			 }

			 
		 }
		$this->form_validation->set_rules('highest_quali', 'highest qualification', 'trim|required|numeric');
		$this->form_validation->set_rules('discipline', 'discipline', 'trim|required');
		$this->form_validation->set_rules('othert_quali', 'other quali', 'trim');
		$this->form_validation->set_rules('current_emp_status', 'current employment status', 'trim|required|numeric');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)  {	
		$assessor_data = array( // update
			"certified_by_any_assessor"     => $this->input->post("certified"),
			"highest_qualification_id_pk"   => $this->input->post("highest_quali"),
			"discipline"                    => $this->input->post("discipline"),
			"othert_quali"                  => $this->input->post("othert_quali"),
			"current_emp_status_id_fk"      => $this->input->post("current_emp_status"),
			"edu_qualification_flag"      	=> TRUE,
		);

		//certified data
		$certified_data = array();
		$j = 0;

		//05-04-2021 start

		//$edu_quali_data = array();
		$edu_quali_data = array(
			"certified_by_any_assessor" => $this->input->post("certified") == 0 ? 0 : 1,
			"highest_qualification_id_pk" => $this->input->post("highest_quali"),
			"discipline" => $this->input->post("discipline"),
			"othert_quali" => $this->input->post("othert_quali"),
			"current_emp_status_id_fk" => $this->input->post("current_emp_status"),
			"edu_qualification_flag" => 't'
		);
		//echo "<pre>";
		//print_r($edu_quali_data);
		//echo "</pre>";
		//05-04-2021 end

		if($this->input->post("certified") == 1){
			foreach($this->input->post("assessing_body") as $k  => $v){
				$certified_data[$j]["assessing_body"]       = $this->input->post("assessing_body[". $k."]");
				$certified_data[$j]["certificate_number"]   = $this->input->post("certificate_number[". $k."]");
				$certified_data[$j]["certificate_doc"]      = base64_encode(file_get_contents($_FILES["certificate_doc_". $k]['tmp_name']));
				$certified_data[$j]["assessor_registration_details_fk"]      = $this->session->userdata('stake_details_id_fk');
				$certified_data[$j]["active_status"]        = 1;
				
				//24-03-2021 start
				$certified_data[$j]["assessor_registration_application_no"]           			=  $this->input->post("application_no");
				$certified_data[$j]["assessor_registration_application_nubmer_id_fk"]           =  $this->input->post("application_count_id");
				//$certified_data[$j]["certified_by_any_assessor"]             = $this->input->post("certified");
				//$certified_data[$j]["highest_qualification_id_pk"]           = $this->input->post("highest_quali");
				///$certified_data[$j]["discipline"]           				 = $this->input->post("discipline");
				//$certified_data[$j]["othert_quali"]              			 = $this->input->post("othert_quali");
				//$certified_data[$j]["current_emp_status_id_fk"]     	     = $this->input->post("current_emp_status");
				//$certified_data[$j]["edu_qualification_flag"]                = 1;
				$certified_data[$j]["entry_time"]           = "now()";
				//24-03-2021 end


				$j++;
			}
		} else { //24-03-2021 start
			
			//$certified_data[0]["assessor_registration_application_no"]           = $this->input->post("application_no");
			//$certified_data[0]["assessor_registration_application_nubmer_id_fk"] = $this->input->post("application_count_id");
			//$certified_data[0]["assessor_registration_details_fk"]      = $this->session->userdata('stake_details_id_fk');
			//$certified_data[0]["certified_by_any_assessor"]             = $this->input->post("certified");
			//$certified_data[0]["highest_qualification_id_pk"]           = $this->input->post("highest_quali");
			//$certified_data[0]["discipline"]           				 = $this->input->post("discipline");
			//$certified_data[0]["othert_quali"]              			 = $this->input->post("othert_quali");
			//$certified_data[0]["current_emp_status_id_fk"]     	     = $this->input->post("current_emp_status");
			//$certified_data[0]["edu_qualification_flag"]                = 1;
			//$certified_data[0]["entry_time"]           = "now()";
			
		} //24-03-2021 end
		if($this->assessor_registration_model->update_certificate_data($edu_quali_data,$this->session->userdata('stake_details_id_fk'),$certified_data)){
			$data['status'] = TRUE;
			$data['message'] = 'Qualification and Professional experience updated successfully';
		} else {
			
			$data['status'] = FALSE;
			$data['message'] = 'Some thing went wrong! Please try again';
			
		}

	}
	$data['assessor_certificates'] = $this->assessor_registration_model->get_assessor_certificates($this->session->userdata('stake_details_id_fk'),$data['application_count'][0]['assessor_registration_application_no']);
	//print_r($data['assessor']);
	//print_r($data['assessor_certificates']);
	$this->load->view($this->config->item('theme').'assessor_profile/new_edu_quali_indus_profe_exp_view',$data);
    }

	//new additional module 20-04-2021
	public function document_upload(){

		//$this->output->enable_profiler();
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);

		$data["qualifications"] = $this->assessor_registration_model->get_qualification();
		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);
		
		// echo "<pre>";
		// print_r($data["app_data"]);
		// echo "</pre>";

		$this->load->library('form_validation');
		
			$this->form_validation->set_rules('qualification', 'qualification', 'trim|required|integer',array("integer" => "Invalid Qualification"));
			$this->form_validation->set_rules('institute', 'institute', 'trim|required|max_length[200]');
			$this->form_validation->set_rules('certificate_no', 'certificate no', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('certificate', 'certificate', 'trim|callback_file_validation[certificate|application/pdf|200|required]');

            if ($this->form_validation->run() == TRUE) {
                $document_insert_array = array(
					"qualification_id_fk"							 => $this->input->post("qualification"),
					"institute_name"								 => $this->input->post("institute"),
					"certificate_no"								 => $this->input->post("certificate_no"),
					"certificate_file"								 =>  base64_encode(file_get_contents($_FILES["certificate"]['tmp_name'])),
					"active_status"									 => 1,
					"insert_date" 									 => "NOW()",
					"assessor_registration_application_no"			 => $this->input->post("application_no"),
					"assessor_registration_application_nubmer_id_fk" => $this->input->post("application_count_id"),
					"assessor_registration_details_fk"				 => $this->session->userdata('stake_details_id_fk')
				);
				$assessor_update_array = array(
					"document_upload_flag" => 't'
				);

				if($this->assessor_registration_model->assessor_document_upload($document_insert_array, $assessor_update_array, $this->session->userdata('stake_details_id_fk'),$this->input->post("application_no"))){
					$data["message"] = "Document added successfully.";
				} else {
					$data["message"] = "Fail! Please trya again.";

				}
				
				// echo "<pre>";
				// print_r($document_insert_array);
				// echo "</pre>";
            } 

			$data["docs"] = $this->assessor_registration_model->get_assessor_document($data['application_count'] [0]['assessor_registration_application_no'], $this->session->userdata('stake_details_id_fk'));

			//print_r($data["docs"]);
		$this->load->view($this->config->item('theme').'assessor_profile/new_document_upload_view',$data);
	}
    public function work_experience(){

		// 24-03-2021 start
		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 End

        //$data['work_experiences'] = array();
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$data['work_experiences'] = $this->assessor_registration_model->get_work_experiences($app_id_hash,$data['application_count'][0]['assessor_registration_application_no']);
		$this->title = "Work Experience";

		

		$this->load->library('form_validation');
		$this->form_validation->set_rules('org_name', 'org name', 'trim|required');
		$this->form_validation->set_rules('work_area', 'work area', 'trim|required');
		$this->form_validation->set_rules('work_years', 'work years', 'trim|required|numeric');
		$this->form_validation->set_rules('work_months', 'work months', 'trim|required|numeric');
		$this->form_validation->set_rules('experience', 'experience doc', 'trim|callback_file_validation[experience|application/pdf|200|required]');
		//$this->form_validation->set_rules('experience', 'experience doc', 'trim|callback_file_validation[experience|application/pdf|100|required]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			$work_experience_array = array(
			"organisation_name"   	=> $this->input->post("org_name"),
			"area_of_work"       	=> $this->input->post("work_area"),
			"no_of_years"         	=> $this->input->post("work_years"),
			"no_of_months"        	=> $this->input->post("work_months"),
			"upload_doc"          	=> base64_encode(file_get_contents($_FILES["experience"]['tmp_name'])),
			"assessor_registration_details_fk"      => $this->session->userdata('stake_details_id_fk'),
			"active_status"       	=> 1,
			"assessor_registration_application_no" => $this->input->post("application_no"),
			"assessor_registration_application_nubmer_id_fk" =>$this->input->post("application_count_id")
			);
			$work_flage_array = array(
				"work_experience_flag"   	=> TRUE
				);
			
			$work_flag_update=$this->assessor_registration_model->update_assessor_details($work_flage_array,$app_id_hash,$this->input->post("application_no"));
			$inser_id=$this->assessor_registration_model->insert_work_experience($work_experience_array);

			if($work_flag_update!='' and $inser_id!='')
				{
					$data['status'] = TRUE;
					$data['message'] = "Work Experience Added successfully";
					$this->session->set_flashdata('alert_msg',' Work Experience Added successfully'); 
					redirect('admin/assessor_profile/add_other_job_role/work_experience');
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = "Work Experiences addition failed. Please try again";
				}
		}
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->load->view($this->config->item('theme').'assessor_profile/new_work_experience_view',$data);

    }
    public function assessor_experience(){
        //24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 end

		//$this->output->enable_profiler();
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$data['jobroles'] = $this->assessor_registration_model->get_assessor_jobroles_for_assessor_experience($this->session->userdata('stake_details_id_fk'),$data['application_count'][0]["assessor_registration_application_no"]);
		//print_r($data['jobroles']);
		if(!empty($data['jobroles'])){
			$apply_highest_quali=$data['jobroles'][0]['apply_highest_quali'];
			$domain_exp=$data['jobroles'][0]['domain_exp'];
			$domain_id_fk=$data['jobroles'][0]['domain_id_fk'];
			$data['assessor_courses'] = $this->assessor_registration_model->get_all_courses_by_assessor($apply_highest_quali,$domain_exp,$domain_id_fk);
		}
		//$data['assessor_courses'] =  $this->assessor_registration_model->get_all_courses();
		$data['assessor_experience'] = $this->assessor_registration_model->get_assessor_experience($app_id_hash,$data['application_count'][0]['assessor_registration_application_no']);

		$this->title = "Experience As Assessor / Expert of syllabus committee";

		$this->load->library('form_validation');
		$this->form_validation->set_rules('exp_as_assessor_job_role', 'Job Role', 'trim|required');
		$this->form_validation->set_rules('nsqf_level', 'NSQF Level', 'trim|required');
		$this->form_validation->set_rules('exp_as_assessor_work_years', 'No of Years', 'trim|required|numeric');
		$this->form_validation->set_rules('exp_as_assessor_work_months', 'No of Months', 'trim|required|numeric');
		$this->form_validation->set_rules('exp_as_assessor_doc', 'experience doc', 'trim|callback_file_validation[exp_as_assessor_doc|application/pdf|200|required]');
		//$this->form_validation->set_rules('experience', 'experience doc', 'trim|callback_file_validation[experience|application/pdf|100|required]');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			$assessor_experience_array = array(
			"exp_as_assessor_job_role_id_fk"   	=> $this->input->post("exp_as_assessor_job_role"),
			"nsqf_level"       					=> $this->input->post("nsqf_level"),
			"exp_as_assessor_work_years"        => $this->input->post("exp_as_assessor_work_years"),
			"exp_as_assessor_work_months"       => $this->input->post("exp_as_assessor_work_months"),
			"exp_as_assessor_doc"          		=> base64_encode(file_get_contents($_FILES["exp_as_assessor_doc"]['tmp_name'])),
			"assessor_registration_details_fk"  => $this->session->userdata('stake_details_id_fk'),
			"active_status"       				=> 1,
			"assessor_registration_application_no" => $this->input->post("application_no"),
			"assessor_registration_application_nubmer_id_fk" => $this->input->post("application_count_id"),
 			);
			$ssessor_experience_flage_array = array(
				"experience_assessor_flag"   	=> TRUE
				);
			
			$work_flag_update=$this->assessor_registration_model->update_assessor_details($ssessor_experience_flage_array,$app_id_hash,$this->input->post("application_no"));
			$inser_id=$this->assessor_registration_model->insert_assessor_experience($assessor_experience_array);

			if($work_flag_update!='' and $inser_id!='')
				{
					$data['status'] = TRUE;
					$data['message'] = "Work Experience Added successfully";
					$this->session->set_flashdata('alert_msg',' Experience As Assessor / Expert of syllabus committee Added successfully'); 
					redirect('admin/assessor_profile/add_other_job_role/assessor_experience');
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = "Experience As Assessor / Expert of syllabus committee addition failed. Please try again";
				}
		}

		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->load->view($this->config->item('theme').'assessor_profile/new_assessor_experience_view',$data);

    }
    public function ssc_wbsctvesd_certified(){
        //24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);
		$data['assessor_courses'] = $this->assessor_registration_model->get_courses_by_assessor($this->session->userdata('stake_details_id_fk'),$data['application_count'][0]['assessor_registration_application_no']);

		
		// 24-03-2021 end
		//$data['jobroles'] = $this->assessor_registration_model->l($this->session->userdata('stake_details_id_fk'),$data['application_count'][0]["assessor_registration_application_no"]);
		//print_r($data['jobroles']);
		
		//$this->output->enable_profiler(TRUE);
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash,$data['application_count'][0]['assessor_registration_application_no']);
		$this->title = "SSC/ WBSCTVESD certified";
		$data['app_data'] = array();

		$this->load->library('form_validation');
		$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/wbsctvesd certified', 'trim|required|numeric');
		if($this->input->post("ssc_wbsctvesd_certified") == 1){
			$this->form_validation->set_rules('cf_validity', '<b>certificate validation</b>', 'trim|required|callback_date_validate');
		}
		$this->form_validation->set_rules('course_id', '<b>course</b>', 'trim|required|integer');
		if($this->input->post("ssc_wbsctvesd_certified")==1){
			$this->form_validation->set_rules('attended_any_toa', 'attended any TOA', 'trim|required|numeric');
			
		}

		if($this->input->post("attended_any_toa")==1){
			$this->form_validation->set_rules('toa_certificate', 'TOA certificate', 'trim|callback_file_validation[toa_certificate|application/pdf|100|required]');
			
		}
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			if($this->input->post('ssc_wbsctvesd_certified')==1){
				$attended_any_toa=$this->input->post('attended_any_toa');
				//$toa_certificate=base64_encode(file_get_contents($_FILES["toa_certificate"]['tmp_name']));
			}else{
				$attended_any_toa=NULL;
				//$toa_certificate='';
			}

			if($this->input->post('attended_any_toa')==1){
				//$attended_any_toa=$this->input->post('attended_any_toa');
				$toa_certificate=base64_encode(file_get_contents($_FILES["toa_certificate"]['tmp_name']));
				
			}else{
				//$attended_any_toa=2;
				$toa_certificate='';
			}

		

			$update_assessor_table = array(
				"ssc_wbsctvesd_certified_flag"       => 't'
			);

			//24-03-2021 start parag
			$ssc_wbsctvesd_certified_array_map_table = array(
				"ssc_wbsctvesd_certified"       => $this->input->post('ssc_wbsctvesd_certified'),
				"attended_any_toa"       		=> $attended_any_toa,
				"toa_certificate"               => $toa_certificate,
				"ssc_wbsctvesd_certified_flag"  => TRUE,
				"assessor_registration_application_no" =>$this->input->post("application_no"),
				"assessor_registration_application_nubmer_id_fk" => $this->input->post("application_count_id"),
				"assessor_registration_details_fk" => $this->session->userdata('stake_details_id_fk'),
				"active_status" => 1,
				"insert_date"	=> "now()",
				"cf_validity"					=> $this->input->post("ssc_wbsctvesd_certified") == 1 ? $this->_us_date_format($this->input->post("cf_validity")) : NULL,
				"course_id_fk"					=> $this->input->post("course_id")
			);
			//24-03-2021 end 
				if($this->assessor_registration_model->update_assessor_details_for_new_update($update_assessor_table,$this->input->post("application_no"), $ssc_wbsctvesd_certified_array_map_table, $this->session->userdata('stake_details_id_fk'))) //24-03-2021 end
				{
					$data['status'] = TRUE;
					$data['message'] = "SSC/ WBSCTVESD certified details updated successfully";
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = "SSC/ WBSCTVESD certified details addition failed. Please try again";
				}
		}
		
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);

		if($data['app_data'][0]['state_id_fk']){
			$data['districts'] = $this->assessor_registration_model->get_districts($data['app_data'][0]['state_id_fk']);
		}
		if($data['app_data'][0]['district_id_fk']){
			$data['blocks'] = $this->assessor_registration_model->get_blocks($data['app_data'][0]['district_id_fk']);
		}


		if($data['app_data'][0]['permanent_state_id_fk']){
			$data['districts_per'] = $this->assessor_registration_model->get_districts($data['app_data'][0]['permanent_state_id_fk']);
		}
		if($data['app_data'][0]['permanent_district_id_fk']){
			$data['permanent_blocks'] = $this->assessor_registration_model->get_blocks($data['app_data'][0]['permanent_district_id_fk']);
		}
		//
		$data['certificates'] = $this->assessor_registration_model->get_ssc_wbsctvesed_certificate($data['application_count'][0]["assessor_registration_application_no"],$this->session->userdata('stake_details_id_fk'));

		//print_r($data['certificates']);
		$this->load->view($this->config->item('theme').'assessor_profile/new_ssc_wbsctvesd_certified_view',$data);
    }
    public function final_submit(){

		//24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 start

        $this->title = "Final Submit";
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);

		
	 	$this->load->view($this->config->item('theme').'assessor_profile/new_final_submit_view',$data);
    }

	public function ajax_jobrole_course($course_sector_block_count = NULL,$quali = NULL, $domain_exp = NULL, $domain =NULL){
        
        //$this->output->enable_profiler();
         
        $data["course_sector_block_count"] = $course_sector_block_count + 1;
        $data["courses"] = $this->assessor_registration_model->get_data($quali,$domain_exp,$domain);
        $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_job_role_course_view',$data);
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

	function date_validate($date_uk = NULL) {
		$date_array = explode("-",$date_uk);
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

	private function _us_date_format($uk_date=NULL)
	{
		if($uk_date != NULL)
		{
			$date_array = explode('-', $uk_date);
			return $date_array[2].'-'.$date_array[1].'-'.$date_array[0];
		} 
		else 
		{
			show_404();
		}
	}
	//added parag 04-02-2021
	public function download_certificate_pdf($council_ssc_wbsctvesd_certified_map_id_pk = NULL){
		$doc = $this->assessor_registration_model->get_new_cert_pdf($council_ssc_wbsctvesd_certified_map_id_pk)[0]['toa_certificate'];
		header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=Doc_$council_assessor_registration_certified_map_id_pk.pdf");

        echo base64_decode ($doc);	
	}

	///-----------------------------
	public function ajax_confirm_final_submit_button($id_hash = NULL)
	{

		 //24-03-2021 start 

		 $data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		 //print_r($data['application_count']);
 
		 // 24-03-2021 end

		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($id_hash);
		
		$this->load->helper('string');
        $assessor_code = "AS".time().strtoupper(random_string('alpha', 2));

		$final_submit_update_array = array(
				'final_submission_status' 					=> 1,
				'process_status_id_fk' 			=> 2,
				//"assessor_code"                 => $assessor_code,
                "final_submission_ip"           => $this->input->ip_address(),
                "final_submission_time"         =>"now()",
			);

			$final_submit_update=$this->assessor_registration_model->update_assessor_details($final_submit_update_array,$id_hash, $data['application_count'][0]["assessor_registration_application_no"]);
			//$this->db->where('MD5(CAST(assessor_registration_details_pk AS character varying)) =', $id_hash);

			if($final_submit_update!=''){

				$email_subject = "Thanks for registering your details with WBSCTVESD";
				$email_message = $this->load->view($this->config->item('theme').'assessor_profile/council_email_template_part_b_final_submit_view',$data,TRUE);;
				//send_email($data["app_data"][0]['email_id'],$email_message,$email_subject);
				//$sms_message ="Application ID no ". $data['app_data'][0]['acknowledgement']." Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD submitted successfully.";
				//$template_id=1107161201150707058;
				$sms_message ="Application ID no ". $data['app_data'][0]['acknowledgement']." Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD submitted successfully.";
				$template_id=0;
				//$this->sms->send($data["app_data"][0]['mobile_no'],$sms_message,$template_id);
		
			echo json_encode(array('response' => "TRUE"));
			
		} 
		else 
		{
			echo json_encode(array('response' => "FALSE"));
		}
	}

	////updated parag 12-01-2021
	public function view_details($assessor_id_hash = NULL){
        //$this->output->enable_profiler();
		//$data['offset'] = "";
		$assessor_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		//added parag 12-01-2021
		$this->load->model('council/assessor_list_model');
		
		//added parag 12-01-2021
		$data['vtc_pbssd'] = $this->assessor_list_model->get_vtc_pbssd($assessor_id_hash);

        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles($assessor_id_hash);
        $data['certificates'] = $this->assessor_list_model->get_certificates($assessor_id_hash);
        $data['get_work_exps'] = $this->assessor_list_model->get_work_exp($assessor_id_hash);
        $data['get_assessor_experts'] = $this->assessor_list_model->get_assessor_expert($assessor_id_hash);

        //echo "<pre>";
        //print_r($data['jobroles']);
        //echo "</pre>";
        // echo "<pre>";
        // print_r($data['get_asse_exps']);
        // echo "</pre>";
        $this->load->view($this->config->item('theme').'council/assessor_details_profile_view',$data);
	}

	//updated parag 12-01-2021
	public function new_view_details(){

		//24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 end

     	//$this->output->enable_profiler();
		//$data['offset'] = "";
		$assessor_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		//added parag 12-01-2021
		$this->load->model('council/new_assessor_list_model','assessor_list_model');
		
		//added parag 12-01-2021
		//$data['vtc_pbssd'] = $this->assessor_list_model->get_vtc_pbssd($assessor_id_hash);
		$data['ssc_certificates'] = $this->assessor_registration_model->get_ssc_wbsctvesed_certificate($data['application_count'][0]["assessor_registration_application_no"],$this->session->userdata('stake_details_id_fk'));
		//print_r($data['certificates']);
        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles($assessor_id_hash,$data['application_count'][0]['assessor_registration_application_no']);
        $data['certificates'] = $this->assessor_list_model->get_certificates($assessor_id_hash,$data['application_count'][0]['assessor_registration_application_no']);
        $data['get_work_exps'] = $this->assessor_list_model->get_work_exp($assessor_id_hash,$data['application_count'][0]['assessor_registration_application_no']);
        $data['get_assessor_experts'] = $this->assessor_list_model->get_assessor_expert($assessor_id_hash,$data['application_count'][0]['assessor_registration_application_no']);
		$data["docs"] = $this->assessor_registration_model->get_assessor_document($data['application_count'] [0]['assessor_registration_application_no'], $this->session->userdata('stake_details_id_fk'));
        //echo "<pre>";
        //print_r($data['jobroles']);
        //echo "</pre>";
        // echo "<pre>";
        // print_r($data['get_asse_exps']);
        // echo "</pre>";
        $this->load->view($this->config->item('theme').'council/new_assessor_details_profile_view',$data);
	}
}