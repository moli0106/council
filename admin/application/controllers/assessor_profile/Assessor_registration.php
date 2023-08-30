<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_registration extends NIC_Controller 
{
	public function __construct(){
		
		parent::__construct();
		parent::check_privilege(7);
		
		$this->load->model('assessor_profile/assessor_registration_model');
		//$this->output->enable_profiler(TRUE);
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
			//3 => $this->config->item('theme_uri').'finance/css/style.css'
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
			3 => $this->config->item('theme_uri').'assessor_profile/js/assessor_reg.js',
			//4 => $this->config->item('theme_uri').'js/moment.js',
			5 => $this->config->item('theme_uri').'jQuery.print.min.js',  // added parag 12-01-2021
		);
		$this->load->helper('email');
        $this->load->library('sms');

		$this->title = "Assessor Registration Form";
	}

	//basic
	public function basic($app_id_hash = NULL) {
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		
		$data['salutations'] =  $this->assessor_registration_model->get_salutation();
        $data['genders'] =  $this->assessor_registration_model->get_gender();
        $data['languages'] =  $this->assessor_registration_model->get_language();
		$data['id_types'] =  $this->assessor_registration_model->get_id_type();
		
		$this->load->library('form_validation');

		//$this->form_validation->set_rules('salutation', '<b>salutation</b>', 'trim|required|integer',
        //    array('integer' => 'The %s field is invalid')
        //);
        //$this->form_validation->set_rules('fname', '<b>fname</b>', 'trim|required|max_length[20]|alpha');
        //$this->form_validation->set_rules('mname', '<b>mname</b>', 'trim|max_length[20]|alpha');
        //$this->form_validation->set_rules('lname', '<b>lname</b>', 'trim|required|max_length[20]|alpha');
        $this->form_validation->set_rules('gender', '<b>gender</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );
        $this->form_validation->set_rules('dob', '<b>dob</b>', 'trim|required|callback_date_validate');
        $this->form_validation->set_rules('language', '<b>language</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );
        $this->form_validation->set_rules('id_type_alt', '<b>ID type</b>', 'trim|required|integer',
            array('integer' => 'The %s field is invalid')
        );
        $this->form_validation->set_rules('id_no_alt', '<b>ID No.</b>', 'trim|required|max_length[15]|min_length[10]');
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE)  {

			$assessor_basic = array(
                //"salutation_id_fk" => $this->input->post("salutation"),
                //"fname" => $this->input->post("fname"),
                //"mname" => $this->input->post("mname"),
                //"lname" => $this->input->post("lname"),
                "gender_id_fk" => $this->input->post("gender"),
                "dob" => $this->_us_date_format($this->input->post("dob")),
                "language_id_fk" => $this->input->post("language"),
                //"pan" => $this->input->post("pan"),
                "id_type_alt_id_fk" => $this->input->post("id_type_alt"),
                "id_no_alt" => $this->input->post("id_no_alt"),
            );
			if($this->assessor_registration_model->update_assessor_details($assessor_basic,$app_id_hash)){
					$data['status'] = TRUE;
					$data['message'] = 'Basic details updated successfully';
					$this->session->set_flashdata('alert_msg',' Basic details updated successfully'); 
					redirect('admin/assessor_profile/assessor_registration/basic');
				} else {
					
					$data['status'] = FALSE;
					$data['message'] = 'Some thing went wrong! Please try again';
					
				}
			
			}

		$this->load->view($this->config->item('theme').'assessor_profile/basic_view',$data);
	}




	// For Course Details
	public function course(){

		//$this->output->enable_profiler();
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['domains'] = array();
		$data['domain_experiances'] = array();
		$data['courses'] = array();
		$data['jobroles'] = array();
		//$this->output->enable_profiler(TRUE);

		//24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 start


		if($this->input->method(TRUE) == "GET"){

			$data['assessor'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			$data['jobroles'] = $this->assessor_registration_model->get_assessor_jobroles($this->session->userdata('stake_details_id_fk'));


			//print_r($data['jobroles']);


			if($data['assessor'][0]["apply_highest_quali"] != NULL){
				$data['domain_experiances'] = $this->assessor_registration_model->get_domain_experiance($data['assessor'][0]["apply_highest_quali"]);
				
				$data['domains'] = $this->assessor_registration_model->get_experience_domain($data['assessor'][0]["apply_highest_quali"],$data['assessor'][0]["domain_exp"]);
				
				//print_r($data['domain_experiances']);

				//$courses = $this->assessor_registration_model->get_data($quali,$domain_exp,$domain);

				if(
					$data['assessor'][0]["apply_highest_quali"] != NULL &&
					$data['assessor'][0]["domain_exp"] != NULL &&
					$data['assessor'][0]["domain_id_fk"] != NULL
				){
					$data['courses'] = $this->assessor_registration_model->get_data($data['assessor'][0]["apply_highest_quali"],$data['assessor'][0]["domain_exp"],$data['assessor'][0]["domain_id_fk"]);
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
				$this->form_validation->set_rules('job_role['.$k.']', 'job role', 'trim|integer|required|callback_check_course_duplicate');
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
				$jobrole_sector_data[$i]["apply_highest_quali"] = $this->input->post("apply_highest_quali");
				$jobrole_sector_data[$i]["domain_exp"] = $this->input->post("domain_exp");
				$jobrole_sector_data[$i]["domain_id_fk"] = $this->input->post("domain");
				$jobrole_sector_data[$i]["apply_for_assessor"] = $this->input->post("apply_for_assessor");
				$jobrole_sector_data[$i]["apply_for_expert"] = $this->input->post("apply_for_expert");
				$jobrole_sector_data[$i]["expart_type_academic"] = $this->input->post("expart_type_academic");
				$jobrole_sector_data[$i]["expart_type_industrial"] = $this->input->post("expart_type_industrial");
				$jobrole_sector_data[$i]["apply_for_trainer_of_trainer"] = $this->input->post("trainer_of_trainers");

				//update module 24-03-2021
				$jobrole_sector_data[$i]["assessor_registration_application_no"] = $this->input->post("application_no");
				$jobrole_sector_data[$i]["assessor_registration_application_nubmer_id_fk"] = $this->input->post("application_count_id");

				$i++;
			}

			if($this->assessor_registration_model->update_course_data($assessor_main_data,$this->session->userdata('stake_details_id_fk'),$jobrole_sector_data)){
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

		$this->load->view($this->config->item('theme').'assessor_profile/course_details_view',$data);

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

	//added parag 04-02-2021
	public function download_certificate_pdf($council_assessor_registration_certified_map_id_pk = NULL){
		$doc = $this->assessor_registration_model->get_cert_pdf($council_assessor_registration_certified_map_id_pk)[0]['certificate_doc'];
		header("Content-type:application/pdf");
        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=Doc_$council_assessor_registration_certified_map_id_pk.pdf");

        echo base64_decode ($doc);	
	}
	//Qualifications & Professional Experience
	public function edu_quali_indus_profe_exp(){

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
				$certified_data[$j]["certified_by_any_assessor"]             = $this->input->post("certified");
				$certified_data[$j]["highest_qualification_id_pk"]           = $this->input->post("highest_quali");
				$certified_data[$j]["discipline"]           				 = $this->input->post("discipline");
				$certified_data[$j]["othert_quali"]              			 = $this->input->post("othert_quali");
				$certified_data[$j]["current_emp_status_id_fk"]     	     = $this->input->post("current_emp_status");
				$certified_data[$j]["edu_qualification_flag"]                = 1;
				$certified_data[$j]["entry_time"]           = "now()";
				//24-03-2021 start
				$j++;
			}
		} else { //24-03-2021 start
			
			$certified_data[0]["assessor_registration_application_no"]           = $this->input->post("application_no");
			$certified_data[0]["assessor_registration_application_nubmer_id_fk"] = $this->input->post("application_count_id");
			$certified_data[0]["assessor_registration_details_fk"]      = $this->session->userdata('stake_details_id_fk');
			$certified_data[0]["certified_by_any_assessor"]             = $this->input->post("certified");
			$certified_data[0]["highest_qualification_id_pk"]           = $this->input->post("highest_quali");
			$certified_data[0]["discipline"]           				 = $this->input->post("discipline");
			$certified_data[0]["othert_quali"]              			 = $this->input->post("othert_quali");
			$certified_data[0]["current_emp_status_id_fk"]     	     = $this->input->post("current_emp_status");
			$certified_data[0]["edu_qualification_flag"]                = 1;
			$certified_data[0]["entry_time"]           = "now()";
			
		} //24-03-2021 end
		if($this->assessor_registration_model->update_certificate_data($assessor_data,$this->session->userdata('stake_details_id_fk'),$certified_data)){
			$data['status'] = TRUE;
			$data['message'] = 'Qualification and Professional experience updated successfully';
		} else {
			
			$data['status'] = FALSE;
			$data['message'] = 'Some thing went wrong! Please try again';
			
		}

		}
		$data['assessor_certificates'] = $this->assessor_registration_model->get_assessor_certificates($this->session->userdata('stake_details_id_fk'));
		//print_r($data['assessor']);
		//print_r($data['assessor_certificates']);
		$this->load->view($this->config->item('theme').'assessor_profile/edu_quali_indus_profe_exp_view',$data);
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

				if($this->assessor_registration_model->assessor_document_upload($document_insert_array, $assessor_update_array, $this->session->userdata('stake_details_id_fk'))){
					$data["message"] = "Document added successfully.";
				} else {
					$data["message"] = "Fail! Please trya again.";

				}
				
				// echo "<pre>";
				// print_r($document_insert_array);
				// echo "</pre>";
            } 

			$data["docs"] = $this->assessor_registration_model->get_assessor_document(1, $this->session->userdata('stake_details_id_fk'));

			//print_r($data["docs"]);
		$this->load->view($this->config->item('theme').'assessor_profile/document_upload_view',$data);
	}

	public function download_doc($doc_id_hash = NULL){

	}

	//contact
	public function contact() {
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->title = "Contact Details";
		// $data['districts'] = array();
		// $data['blocks']		= array();
		$data["states"] = $this->assessor_registration_model->get_states();
        //$data["districts"] = $this->assessor_registration_model->get_districts();
		$data['app_data'] = array();

		

		if(set_value('state')){
			$data['districts'] = $this->assessor_registration_model->get_districts(set_value('state'));
		}

		if(set_value('district')){
			$data['blocks'] = $this->assessor_registration_model->get_blocks(set_value('district'));
		}



		if(set_value('permanent_state')){
			$data['districts_per'] = $this->assessor_registration_model->get_districts(set_value('permanent_state'));
		}
		if(set_value('permanent_district')){
			$data['permanent_blocks'] = $this->assessor_registration_model->get_blocks(set_value('permanent_district'));
		}

		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('house_flat_building', 'house or flat or building', 'trim|required');
		$this->form_validation->set_rules('street', 'street', 'trim|required');
		$this->form_validation->set_rules('post_opffice', 'post opffice', 'trim|required');
		$this->form_validation->set_rules('police', 'police', 'trim');
		$this->form_validation->set_rules('state', 'state', 'trim|required|numeric');
		$this->form_validation->set_rules('district', 'district', 'trim|required|numeric');
		if($this->input->post("state")==19){
			$this->form_validation->set_rules('block', 'block', 'trim|required|numeric');
		}
		$this->form_validation->set_rules('pin', 'pin', 'trim|required|numeric|exact_length[6]');



		$this->form_validation->set_rules('permanent_house_flat_building', 'house or flat or building', 'trim|required');
		$this->form_validation->set_rules('permanent_street', 'permanent street', 'trim|required');
		$this->form_validation->set_rules('permanent_post_office', 'posto office', 'trim|required');
		$this->form_validation->set_rules('permanent_police', 'permanent police', 'trim');
		$this->form_validation->set_rules('permanent_state', 'state', 'trim|required');
		$this->form_validation->set_rules('permanent_district', 'district', 'trim|required');
		if($this->input->post("permanent_state")==19){
			$this->form_validation->set_rules('permanent_block', 'block', 'trim|required');
		}
		$this->form_validation->set_rules('permanent_pin', 'permanent pin', 'trim|required|numeric|exact_length[6]');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			$contact_array = array(
				"house_flat_building"           => $this->input->post("house_flat_building"),
				"street"                        => $this->input->post("street"),
				"post_opffice"                  => $this->input->post("post_opffice"),
				"police"                        => $this->input->post("police"),
				"state_id_fk"                   => $this->input->post("state"),
				"district_id_fk"                => $this->input->post("district"),
				"block_id_fk"                   => $this->input->post('block')==NULL?NULL:$this->input->post('block'),
				"pin"                           => $this->input->post("pin"),

				"permanent_house_flat_building" => $this->input->post("permanent_house_flat_building"),
				"permanent_street"              => $this->input->post("permanent_street"),
				"permanent_post_office"         => $this->input->post("permanent_post_office"),
				"permanent_police"         		=> $this->input->post("permanent_police"),
				"permanent_state_id_fk"         => $this->input->post("permanent_state"),
				"permanent_district_id_fk"      => $this->input->post("permanent_district"),
				"permanent_block_id_fk"         => $this->input->post('permanent_block')==NULL?NULL:$this->input->post('permanent_block'),
				"permanent_pin"                 => $this->input->post("permanent_pin"),
				"residential_address_flag"      => TRUE,
			);
				if($this->assessor_registration_model->update_assessor_details($contact_array,$app_id_hash))
				{
					$data['status'] = TRUE;
					$data['message'] = "Contact details updated successfully";
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = "Contact details addition failed. Please try again";
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

		$this->load->view($this->config->item('theme').'assessor_profile/contact_details_view',$data);
	}




	public function work_experience(){
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$data['work_experiences'] = $this->assessor_registration_model->get_work_experiences($app_id_hash);
		$this->title = "Work Experience";

		// 24-03-2021 start
		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 End

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
			
			$work_flag_update=$this->assessor_registration_model->update_assessor_details($work_flage_array,$app_id_hash);
			$inser_id=$this->assessor_registration_model->insert_work_experience($work_experience_array);

			if($work_flag_update!='' and $inser_id!='')
				{
					$data['status'] = TRUE;
					$data['message'] = "Work Experience Added successfully";
					$this->session->set_flashdata('alert_msg',' Work Experience Added successfully'); 
					redirect('admin/assessor_profile/assessor_registration/work_experience');
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = "Work Experiences addition failed. Please try again";
				}
		}


		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->load->view($this->config->item('theme').'assessor_profile/work_experience_view',$data);

	}

	


	public function assessor_experience(){

		//24-03-2021 start 

		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 end

		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$data['jobroles'] = $this->assessor_registration_model->get_assessor_jobroles_for_assessor_experience($this->session->userdata('stake_details_id_fk'));
		//print_r($data['jobroles']);
		if(!empty($data['jobroles'])){
			$apply_highest_quali=$data['jobroles'][0]['apply_highest_quali'];
			$domain_exp=$data['jobroles'][0]['domain_exp'];
			$domain_id_fk=$data['jobroles'][0]['domain_id_fk'];
			$data['assessor_courses'] = $this->assessor_registration_model->get_all_courses_by_assessor($apply_highest_quali,$domain_exp,$domain_id_fk);
		}
		//$data['assessor_courses'] =  $this->assessor_registration_model->get_all_courses();
		$data['assessor_experience'] = $this->assessor_registration_model->get_assessor_experience($app_id_hash);

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
			
			$work_flag_update=$this->assessor_registration_model->update_assessor_details($ssessor_experience_flage_array,$app_id_hash);
			$inser_id=$this->assessor_registration_model->insert_assessor_experience($assessor_experience_array);

			if($work_flag_update!='' and $inser_id!='')
				{
					$data['status'] = TRUE;
					$data['message'] = "Work Experience Added successfully";
					$this->session->set_flashdata('alert_msg',' Experience As Assessor / Expert of syllabus committee Added successfully'); 
					redirect('admin/assessor_profile/assessor_registration/assessor_experience');
				}
				else
				{
					$data['status'] = FALSE;
					$data['message'] = "Experience As Assessor / Expert of syllabus committee addition failed. Please try again";
				}
		}


		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->load->view($this->config->item('theme').'assessor_profile/assessor_experience_view',$data);

	}


	// public function professional_details(){
	// 	$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
	// 	$data['working_with_centre'] = array();
	// 	$data['assessor_working_centre'] = array();
	// 	//$this->output->enable_profiler(TRUE);


	// 	if($this->input->method(TRUE) == "GET"){

	// 		$data['assessor'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
	// 		$data['assessor_working_centre'] = $this->assessor_registration_model->get_assessor_working_with_centre($this->session->userdata('stake_details_id_fk'));
	// 		$data["working_with_centre"] = $this->assessor_registration_model->get_working_with_centre();

			
	// 	} elseif($this->input->method(TRUE) == "POST") {
	// 		$data["working_with_centre"] = $this->assessor_registration_model->get_working_with_centre();
	// 	}
		
	// 	$data["qualifications"] = $this->assessor_registration_model->get_qualification();
    //     //$data['domains'] = $this->assessor_registration_model->get_all_domains();
	// 	$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);

	// 	$this->load->library('form_validation');
	// 	$this->form_validation->set_rules('cv', 'CV', 'trim|callback_file_validation[cv|application/pdf|200|required]');
	// 	$this->form_validation->set_rules('photo', 'photo', 'trim|callback_file_validation[photo|image/jpeg|50|required]');

        
    //     if($this->input->method(TRUE) == "POST"){
            
    //         //Working Validation
	// 	   //$working_in_array = $this->input->post("working_in") == "" ? array() : $this->input->post("working_in");
	// 		foreach($this->input->post("working_in") as $k => $v){
	// 			$this->form_validation->set_rules('working_in['.$k.']', 'working in any', 'trim|integer|required');
	// 			$this->form_validation->set_rules('centre_code['.$k.']', 'centre code', 'trim|required');
	// 			$this->form_validation->set_rules('centre_name['.$k.']', 'centre name', 'trim');
	// 		}
	// 	}
		

	// 	$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
    //     if ($this->form_validation->run() == FALSE) {

	// 	} else {

	// 		$assessor_main_data = array( // update
	// 			"apply_highest_quali"           => $this->input->post("apply_highest_quali"),
	// 			"domain_exp"                    => $this->input->post("domain_exp"),
	// 			"domain_id_fk"                  => $this->input->post("domain"),
	// 			"apply_for_assessor"            => $this->input->post("apply_for_assessor"),
	// 			"apply_for_expert"              => $this->input->post("apply_for_expert"),
	// 			"expart_type_academic"          => $this->input->post("expart_type_academic"),
	// 			"expart_type_industrial"        => $this->input->post("expart_type_industrial"),
	// 			"apply_for_trainer_of_trainer"	=> $this->input->post("trainer_of_trainers"),
	// 			"course_flag"					=> TRUE

	// 		);

	// 		$jobrole_sector_data = array();
	// 		$i = 1;
	// 		foreach($this->input->post("job_role") as $k  => $v){
	// 			$jobrole_sector_data[$i]["course_id_fk"]       = $this->input->post("job_role[". $k."]");
	// 			$jobrole_sector_data[$i]["job_role_sp_quali"]  = $this->input->post("job_role_sp_quali[". $k."]");
	// 			$jobrole_sector_data[$i]["assessor_registration_details_fk"]      = $this->session->userdata('stake_details_id_fk');
	// 			$jobrole_sector_data[$i]["active_status"]      = 1;
	// 			//new addition
	// 			$jobrole_sector_data[$i]["apply_highest_quali"] = $this->input->post("apply_highest_quali");
	// 			$jobrole_sector_data[$i]["domain_exp"] = $this->input->post("domain_exp");
	// 			$jobrole_sector_data[$i]["domain_id_fk"] = $this->input->post("domain");
	// 			$jobrole_sector_data[$i]["apply_for_assessor"] = $this->input->post("apply_for_assessor");
	// 			$jobrole_sector_data[$i]["apply_for_expert"] = $this->input->post("apply_for_expert");
	// 			$jobrole_sector_data[$i]["expart_type_academic"] = $this->input->post("expart_type_academic");
	// 			$jobrole_sector_data[$i]["expart_type_industrial"] = $this->input->post("expart_type_industrial");
	// 			$jobrole_sector_data[$i]["apply_for_trainer_of_trainer"] = $this->input->post("trainer_of_trainers");
	// 			$i++;
	// 		}

	// 		if($this->assessor_registration_model->update_course_data($assessor_main_data,$this->session->userdata('stake_details_id_fk'),$jobrole_sector_data)){
    //             //$data["assessment_id"] = 
    //             $data['success'] = "success";
    //             $data['message'] = "Course details has been successfully updated";
    //         } else {
    //             $data['success'] = "danger";
    //             $data['message'] = "Something went wrongt. Plwase try again";
    //        }
	// 		//echo "Success";
	// 	}
	// 	$this->load->view($this->config->item('theme').'assessor_profile/professional_details_view',$data);

	//  }


	//  public function ajax_working_with_center($working_with_block_add_count = NULL){
        
    //     //$this->output->enable_profiler();
         
    //     $data["working_with_block_add_count"] = $working_with_block_add_count + 1;
    //     $data["working_with_centre"] = $this->assessor_registration_model->get_working_with_centre();
    //     $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_workinh_with_centre_view',$data);
	// }
	public function professional_details(){
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$data['assessor_working_centre'] = $this->assessor_registration_model->get_assessor_working_with_centre($this->session->userdata('stake_details_id_fk'));
		$data["working_with_centre"] = $this->assessor_registration_model->get_working_with_centre();
		$data["working_with_pbssd_vtc"] = $this->assessor_registration_model->get_working_with_pbssd_vtc();

		$this->title = "Professional details";

		$this->load->library('form_validation');
		$this->form_validation->set_rules('working_in', 'Working', 'trim|required');
		if($this->input->post("working_in")==3){
			$this->form_validation->set_rules('centre_code', 'Centre Code', 'trim');
			$this->form_validation->set_rules('centre_name', 'Centre Name', 'trim');
		}else{
			$this->form_validation->set_rules('centre_code', 'Centre Code', 'trim|required');
			$this->form_validation->set_rules('centre_name', 'Centre Name', 'trim|required');
		}
		
		// $this->form_validation->set_rules('cv', 'CV', 'trim|callback_file_validation[cv|application/pdf|200|required]');
		// $this->form_validation->set_rules('photo', 'photo', 'trim|callback_file_validation[photo|image/jpeg|50|required]');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			if($this->input->post("working_in")==3){
				$centre_code=NULL;
				$centre_name=NULL;
			}else{
				$centre_code=$this->input->post("centre_code");
				$centre_name=$this->input->post("centre_name");
			}
			$professional_details_array = array(
				"working_id_fk"		=> $this->input->post("working_in"),
				"centre_code"       => $centre_code,
				"centre_name"       => $centre_name,
				"assessor_id_fk"  	=> $this->session->userdata('stake_details_id_fk'),
				"active_status"  	=> 1,
				// "cv"                            => base64_encode(file_get_contents($_FILES["cv"]['tmp_name'])),
				// "photo"                         => base64_encode(file_get_contents($_FILES["photo"]['tmp_name'])),
				//"professional_details_flag"     => TRUE,
			);

			$ssessor_experience_flage_array = array(
				"professional_details_flag"   	=> TRUE
				);
			
			$work_flag_update=$this->assessor_registration_model->update_assessor_details($ssessor_experience_flage_array,$app_id_hash);
			$inser_id=$this->assessor_registration_model->insert_professional_details($professional_details_array);
			
			
			//$work_flag_update=$this->assessor_registration_model->update_assessor_details($professional_details_array,$app_id_hash);
			//$inser_id=$this->assessor_registration_model->insert_assessor_experience($assessor_experience_array);

			if($work_flag_update!='')
			{
				$data['status'] = TRUE;
				$data['message'] = "Professional details updated successfully";
				$this->session->set_flashdata('alert_msg',' Professional details Added successfully'); 
				redirect('admin/assessor_profile/assessor_registration/professional_details');
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = "Professional details updated failed. Please try again";
			}
		}


		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->load->view($this->config->item('theme').'assessor_profile/professional_details_view',$data);

	}


	//Added by Waseem on 25-02-2021
	//SSC/ WBSCTVESD certified
	public function ssc_wbsctvesd_certified() {

		//24-03-2021 start 

		$data['assessor_courses'] = $this->assessor_registration_model->get_courses_by_assessor($this->session->userdata('stake_details_id_fk'),1);


		$data['application_count'] = $this->assessor_registration_model->get_assessor_application_count();
		//print_r($data['application_count']);

		// 24-03-2021 end
		//$this->output->enable_profiler(TRUE);
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
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

		

			$ssc_wbsctvesd_certified_array = array(
				"ssc_wbsctvesd_certified"       => $this->input->post('ssc_wbsctvesd_certified'),
				"attended_any_toa"       		=> $attended_any_toa,
				"toa_certificate"               => $toa_certificate,
				"ssc_wbsctvesd_certified_flag"  => TRUE,
			);

			//24-03-2021 start parag
			// $ssc_wbsctvesd_certified_array_map_table = array(
			// 	"ssc_wbsctvesd_certified"       => $this->input->post('ssc_wbsctvesd_certified'),
			// 	"attended_any_toa"       		=> $attended_any_toa,
			// 	"toa_certificate"               => $toa_certificate,
			// 	"ssc_wbsctvesd_certified_flag"  => TRUE,
			// 	"assessor_registration_application_no" =>$this->input->post("application_no"),
			// 	"assessor_registration_application_nubmer_id_fk" => $this->input->post("application_count_id"),
			// 	"assessor_registration_details_fk" => $this->session->userdata('stake_details_id_fk'),
			// 	"active_status" => 1,
			// 	"insert_date"	=> "now()"
			// );

			//24-03-2021 start parag
			$ssc_wbsctvesd_certified_array_map_table = array(
				"ssc_wbsctvesd_certified"       => $this->input->post('ssc_wbsctvesd_certified'),
				"attended_any_toa"       		=> $attended_any_toa,
				"toa_certificate"               => $toa_certificate,
				"ssc_wbsctvesd_certified_flag"  => TRUE,
				"assessor_registration_application_no" => 1,
				"assessor_registration_application_nubmer_id_fk" => $this->input->post("application_count_id"),
				"assessor_registration_details_fk" => $this->session->userdata('stake_details_id_fk'),
				"active_status" => 1,
				"insert_date"	=> "now()",
				"cf_validity"					=> $this->input->post("ssc_wbsctvesd_certified") == 1 ? $this->_us_date_format($this->input->post("cf_validity")) : NULL,
				"course_id_fk"					=> $this->input->post("course_id")
			);
			//24-03-2021 end 
				if($this->assessor_registration_model->update_assessor_details_for_new_update($ssc_wbsctvesd_certified_array,$app_id_hash,$ssc_wbsctvesd_certified_array_map_table)) //24-03-2021 end
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

		$data['certificates'] = $this->assessor_registration_model->get_ssc_wbsctvesed_certificate(1,$this->session->userdata('stake_details_id_fk'));

		$this->load->view($this->config->item('theme').'assessor_profile/ssc_wbsctvesd_certified_view',$data);
	}
	//Added by Waseem on 25-02-2021



	public function resume_photo(){
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);

		$this->title = "Resume & Photo";

		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('cv', 'CV', 'trim|callback_file_validation[cv|application/pdf|200|required]');
		$this->form_validation->set_rules('photo', 'photo', 'trim|callback_file_validation[photo|image/jpeg|100|required]');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		if ($this->form_validation->run() == TRUE) {
			$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
			$resume_photo_array = array(
				"cv"                            => base64_encode(file_get_contents($_FILES["cv"]['tmp_name'])),
				"photo"                         => base64_encode(file_get_contents($_FILES["photo"]['tmp_name'])),
				"resume_photo_flag"     		=> TRUE,
			);
			
			$resume_photo_update=$this->assessor_registration_model->update_assessor_details($resume_photo_array,$app_id_hash);

			if($resume_photo_update!='')
			{
				$data['status'] = TRUE;
				$data['message'] = "Resume & photo updated successfully";
			}
			else
			{
				$data['status'] = FALSE;
				$data['message'] = "Resume & photo updated failed. Please try again";
			}
		}


		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
		$this->load->view($this->config->item('theme').'assessor_profile/resume_photo_view',$data);

	}




	//Final Submit
	
	public function final_submit()
	{
		$this->title = "Final Submit";
		$app_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($app_id_hash);
	 	$this->load->view($this->config->item('theme').'assessor_profile/final_submit_view',$data);
	}


	public function ajax_confirm_final_submit($cen_hash=NULL)
	{
		if($cen_hash!=NULL && strlen($cen_hash)==32)
		{
			$data['cen_hash'] = $cen_hash;
			//print_r($data);die;
			$this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_confirm_final_submit_view',$data);
		}
		else
		{
			show_404();
		}
	}
	public function ajax_confirm_final_submit_button($id_hash = NULL)
	{
		$data['app_data'] = $this->assessor_registration_model->get_assessor_application($id_hash);
		
		$this->load->helper('string');
        $assessor_code = "AS".time().strtoupper(random_string('alpha', 2));

		$final_submit_update_array = array(
				'final_flag' 					=> TRUE,
				'process_status_id_fk' 			=> 2,
				"assessor_code"                 => $assessor_code,
                "final_submission_ip"           => $this->input->ip_address(),
                "final_submission_time"         =>"now()",
			);

		$final_submit_count_update_array = array( // count table update
			'final_submission_status' 		=> 1,
			'process_status_id_fk' 			=> 2,
			"final_submission_ip"           => $this->input->ip_address(),
			"final_submission_time"         =>"now()",
			//"assessor_registration_details_fk"	=>,
			"assessor_registration_application_no"	=> 1,
			
		);

			$final_submit_update=$this->assessor_registration_model->update_assessor_details($final_submit_update_array,$id_hash);
			$final_submit_count_update=$this->assessor_registration_model->update_assessor_details_app_count($final_submit_count_update_array,$id_hash,1);
			//$this->db->where('MD5(CAST(assessor_registration_details_pk AS character varying)) =', $id_hash);

			if($final_submit_update!='' && $final_submit_count_update !=''){

				$email_subject = "Thanks for registering your details with WBSCTVESD";
				$email_message = $this->load->view($this->config->item('theme').'assessor_profile/council_email_template_part_b_final_submit_view',$data,TRUE);;
				send_email($data["app_data"][0]['email_id'],$email_message,$email_subject);
				//$sms_message ="Application ID no ". $data['app_data'][0]['acknowledgement']." Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD submitted successfully.";
				$sms_message ="Application ID no ". $data['app_data'][0]['acknowledgement']." Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD submitted successfully.";
				$template_id=0;
				$this->sms->send($data["app_data"][0]['mobile_no'],$sms_message,$template_id);
		
			echo json_encode(array('response' => "TRUE"));
			
		} 
		else 
		{
			echo json_encode(array('response' => "FALSE"));
		}
	}



	public function ajax_get_centre_details($working_value = NULL,$centre_code_hash){
		if($working_value==1){
			$centre_details = $this->assessor_registration_model->get_vtc_centre($centre_code_hash);
		}elseif($working_value==2){
			$centre_details = $this->assessor_registration_model->get_pbssd_centre($centre_code_hash);
		}elseif($working_value==4){
			$centre_details = $this->assessor_registration_model->get_css_vse_school_centre($centre_code_hash);
		}
		
		if(count($centre_details)){
			echo json_encode(array(
				'exists' => 1,
				'centre'	=> $centre_details[0]
			));
		} else {
			echo json_encode(array(
				'exists' => 0,
			));
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
	
	public function ajax_assessor_certified($assessing_body_count = NULL){
        $data['assessing_body_count'] = $assessing_body_count;

        $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_assessor_certified_view',$data);
	}
	
	//file validation
    public function file_validation($fild = NULL, $file_name = NULL){

        $file_array = explode("|",$file_name);
		//print_r($file_array);
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


	//added Waseem 25-01-2021
	public function get_quali_domain($qualification_id_pk = NULL,$domain_exp=NULL){
		//$this->output->enable_profiler();
		$domains = $this->assessor_registration_model->get_experience_domain($qualification_id_pk,$domain_exp);
		echo '<option value="">-- Select Domain --</option>';
		foreach($domains as $domain){
		echo '<option value="'. $domain['domain_id_pk'] .'">'. $domain['domain_name'] .'</option>';
		}
	}
//added Waseem 25-01-2021

	public function ajax_get_domain_experiance($qualification_id = NULL){
		//$this->output->enable_profiler();
        //ajax_domain_experiance_view.php
        $data['domain_experiances'] = $this->assessor_registration_model->get_domain_experiance($qualification_id);
        $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_domain_experiance_view',$data);

	}

	public function ajax_jobrole_course($course_sector_block_count = NULL,$quali = NULL, $domain_exp = NULL, $domain =NULL){
        
        //$this->output->enable_profiler();
         
        $data["course_sector_block_count"] = $course_sector_block_count + 1;
        $data["courses"] = $this->assessor_registration_model->get_data($quali,$domain_exp,$domain);
        $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_job_role_course_view',$data);
	}
	
	public function get_sector_and_other($course_id_hash = NULL){
        //$this->output->enable_profiler();
        $sector = $this->assessor_registration_model->get_sector_and_other($course_id_hash);

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
	
	public function ajax_jobrole_select($quali,$domain_exp,$domain){

        $courses = $this->assessor_registration_model->get_data($quali,$domain_exp,$domain);

        ?><option value="">-- Select Job Role --</option><?php
        foreach($courses as $course){ ?>
        <option value="<?php echo $course["course_id_pk"] ?>"><?php echo $course["course_name"] ?> (<?php echo $course["course_code"] ?>)</option>
        <?php }
	}
	//ajax district
	public function ajax_district($state_id = NULL){
		if($state_id != NULL){
			$districts = $this->assessor_registration_model->get_districts($state_id);
			?><option value="">-- Select District --</option><?php
			foreach($districts as $district){ ?>
			<option value="<?php echo $district['district_id_pk']; ?>"><?php echo $district['district_name']; ?></option>
			<?php }
		} else {
			show_404();
		}
	}

	public function ajax_block($district_id = NULL){
        //$this->output->enable_profiler();
        $blocks = $this->assessor_registration_model->get_blocks($district_id);
        echo '<option value="">-- Select Block / Municipality --</option> ';
        foreach($blocks as $block){
            echo '<option value="'.$block['block_municipality_id_pk'].'">'.$block['block_municipality_name'].'</option>';
        }
	}
	
	public function ajax_work_experiance($count_work_experience = NULL){
        $data['count_work_experience'] = $count_work_experience;
        $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_work_experiance_view',$data);
	}
	
	public function ajax_experiance_as_assessor($count_experience_section = NULL){
        $data['count_experience_section'] = $count_experience_section;
        $data['assessor_courses'] =  $this->assessor_registration_model->get_all_courses();
        $this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_experiance_as_assessor_view',$data);
	}
	
	public function download_work_exp_file($id = NULL){
		$file_content = $this->assessor_registration_model->get_work_exp_file_content($id);
		if(count($file_content)){

			$this->output->set_header('Content-Disposition: attachment; filename="work_exp.pdf"');
			$this->output
				->set_content_type('application/pdf')
				->set_output(base64_decode(pg_unescape_bytea($file_content[0]['upload_doc'])));
			//echo base64_decode(pg_unescape_bytea($file_content[0]['pdf_file_data']));
		} else {
			show_404();
		}
	}
	public function download_doc_file($id = NULL){
		$file_content = $this->assessor_registration_model->get_doc_file_content($id);

		//print_r($file_content);die;
		if(count($file_content)){

			$this->output->set_header('Content-Disposition: attachment; filename="doc.pdf"');
			$this->output
				->set_content_type('application/pdf')
				->set_output(base64_decode(pg_unescape_bytea($file_content[0]['certificate_file'])));
			//echo base64_decode(pg_unescape_bytea($file_content[0]['pdf_file_data']));
		} else {
			show_404();
		}
	}


	public function ajax_remove_work_exp($work_expe_id=NULL)
	{
		if($work_expe_id!=NULL && strlen($work_expe_id)==32)
		{
			//$data['trainer_dtls'] = $this->special_tc_registration_model->get_trainer_details_by_trainer_id($trainer_hash);
			$data['work_expe_id'] = $work_expe_id;
			//$data['cen_hash'] = $cen_hash;
			//print_r($data);die;
			$this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_work_exp_remove_view',$data);
		}
		else
		{
			show_404();
		}
	}
	public function ajax_delete_work_exp_dtls($id_hash = NULL, $centre_hash = NULL)
	{
		if($this->assessor_registration_model->delete_work_exp_dtls($id_hash))
		{
			echo json_encode(array('response' => "TRUE"));
			//echo '{"response":"TRUE","csrf_token":"'.$this->security->get_csrf_hash().'"}';
		} 
		else 
		{
			echo json_encode(array('response' => "FALSE"));
			//echo '{"response":"FALSE","csrf_token":"'.$this->security->get_csrf_hash().'"}';
		}
	}





	public function download_asse_exp_file($id = NULL){
		$file_content = $this->assessor_registration_model->get_assessor_exp_file_content($id);
		if(count($file_content)){

			$this->output->set_header('Content-Disposition: attachment; filename="work_exp.pdf"');
			$this->output
				->set_content_type('application/pdf')
				->set_output(base64_decode(pg_unescape_bytea($file_content[0]['exp_as_assessor_doc'])));
			//echo base64_decode(pg_unescape_bytea($file_content[0]['pdf_file_data']));
		} else {
			show_404();
		}
	}


	public function ajax_remove_assessor_exp($work_expe_id=NULL)
	{
		if($work_expe_id!=NULL && strlen($work_expe_id)==32)
		{
			//$data['trainer_dtls'] = $this->special_tc_registration_model->get_trainer_details_by_trainer_id($trainer_hash);
			$data['work_expe_id'] = $work_expe_id;
			//$data['cen_hash'] = $cen_hash;
			//print_r($data);die;
			$this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_assessor_exp_remove_view',$data);
		}
		else
		{
			show_404();
		}
	}
	public function ajax_delete_assessor_exp_dtls($id_hash = NULL, $centre_hash = NULL)
	{
		if($this->assessor_registration_model->delete_assessor_exp_dtls($id_hash))
		{
			echo json_encode(array('response' => "TRUE"));
			//echo '{"response":"TRUE","csrf_token":"'.$this->security->get_csrf_hash().'"}';
		} 
		else 
		{
			echo json_encode(array('response' => "FALSE"));
			//echo '{"response":"FALSE","csrf_token":"'.$this->security->get_csrf_hash().'"}';
		}
	}


	public function ajax_remove_assessor_professional($work_professional_id=NULL)
	{
		if($work_professional_id!=NULL && strlen($work_professional_id)==32)
		{
			//$data['trainer_dtls'] = $this->special_tc_registration_model->get_trainer_details_by_trainer_id($trainer_hash);
			$data['work_professional_id'] = $work_professional_id;
			//$data['cen_hash'] = $cen_hash;
			//print_r($data);die;
			$this->load->view($this->config->item('theme').'assessor_profile/ajax/ajax_assessor_professional_remove_view',$data);
		}
		else
		{
			show_404();
		}
	}
	public function ajax_delete_assessor_professional_dtls($id_hash = NULL, $centre_hash = NULL)
	{
		if($this->assessor_registration_model->delete_assessor_professional_dtls($id_hash))
		{
			echo json_encode(array('response' => "TRUE"));
			//echo '{"response":"TRUE","csrf_token":"'.$this->security->get_csrf_hash().'"}';
		} 
		else 
		{
			echo json_encode(array('response' => "FALSE"));
			//echo '{"response":"FALSE","csrf_token":"'.$this->security->get_csrf_hash().'"}';
		}
	}

	public function download_cv_file($id = NULL){
		$file_content = $this->assessor_registration_model->get_assessor_cv_file_content($id);
		if(count($file_content)){

			$this->output->set_header('Content-Disposition: attachment; filename="assessor_cv.pdf"');
			$this->output
				->set_content_type('application/pdf')
				->set_output(base64_decode(pg_unescape_bytea($file_content[0]['cv'])));
			//echo base64_decode(pg_unescape_bytea($file_content[0]['pdf_file_data']));
		} else {
			show_404();
		}
	}

	


	public function download_pan_file($id = NULL){
		$file_content = $this->assessor_registration_model->get_pan_card_file_content($id);
		if(count($file_content)){

			$this->output->set_header('Content-Disposition: attachment; filename="pan_card.pdf"');
			$this->output
				->set_content_type('application/pdf')
				->set_output(base64_decode(pg_unescape_bytea($file_content[0]['pan_file'])));
			//echo base64_decode(pg_unescape_bytea($file_content[0]['pdf_file_data']));
		} else {
			show_404();
		}
	}

	//updated parag 12-01-2021
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
		$data['wbsctvesed_certificates'] = $this->assessor_registration_model->get_ssc_wbsctvesed_certificate(1,$this->session->userdata('stake_details_id_fk'));

		$data["docs"] = $this->assessor_registration_model->get_assessor_document(1, $this->session->userdata('stake_details_id_fk'));
        //echo "<pre>";
        //print_r($data['wbsctvesed_certificates']);
        //echo "</pre>";
        // echo "<pre>";
        // print_r($data['get_asse_exps']);
        // echo "</pre>";
        $this->load->view($this->config->item('theme').'council/assessor_details_profile_view',$data);
	}
	

	//added parag 12-01-2021
	public function download_pdf($file_type = NULL, $id_hash){

		$this->load->model('council/assessor_list_model');

        if($file_type == "cv"){
            $data = $this->assessor_list_model->get_cv($id_hash)[0]['cv'];
            $name="cv";
        } elseif($file_type == "ascer"){
            $data = $this->assessor_list_model->assessor_registration_cert($id_hash)[0]['certificate_doc'];
            $name="certificate";

        } elseif($file_type == "wex"){
            $data = $this->assessor_list_model->assessor_work_exp($id_hash)[0]['upload_doc'];
            $name="Work Experience";

        } elseif($file_type == "eaaesc"){
            $data = $this->assessor_list_model->assessor_experience($id_hash)[0]['exp_as_assessor_doc'];
            $name="assessor_experience";
            //echo "aaa";

        } elseif($file_type == "pan"){
            $data = $this->assessor_list_model->get_pan($id_hash)[0]['pan_file'];
            $name="pan card";
            //echo "aaa";

        } elseif($file_type == "ssc_wbsctvesd_certified"){
            $data = $this->assessor_list_model->get_toa_certificate($id_hash)[0]['toa_certificate'];
            $name="ssc_wbsctvesd_certified";
            //echo "aaa";

        } 

        header("Content-type:application/pdf");

        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$name.pdf");

        echo base64_decode ($data);
     }



	 //Added by Waseem on 26-02-2021
	 public function download_toa_certificate_file($id = NULL){
		$file_content = $this->assessor_registration_model->get_toa_certificate_file_content($id);
		if(count($file_content)){

			$this->output->set_header('Content-Disposition: attachment; filename="TOA_certificate.pdf"');
			$this->output
				->set_content_type('application/pdf')
				->set_output(base64_decode(pg_unescape_bytea($file_content[0]['toa_certificate'])));
			//echo base64_decode(pg_unescape_bytea($file_content[0]['pdf_file_data']));
		} else {
			show_404();
		}
	}

}