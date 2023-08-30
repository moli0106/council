<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other_job_role_app extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(32);
        $this->load->model('council/other_job_role_app_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
            2 => $this->config->item('theme_uri').'assets/css/datepicker.css',
			
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            2 => $this->config->item('theme_uri')."council/other_job_role.js",
            3 => $this->config->item('theme_uri').'jQuery.print.min.js', // added parag 12-01-2021
            4  => $this->config->item('theme_uri').'assets/js/datepicker.js',
		);
    }

    public function index($offset = 0){
        $data['apps'] = array();
        $search_array = array();
		$data['sectors'] = $this->other_job_role_app_model->get_all_course();


        $this->load->library('form_validation');
        $this->form_validation->set_rules('pan', 'NAP', 'trim|exact_length[10]');
        $this->form_validation->set_rules('assessor_code', 'assessor code', 'trim|max_length[15]|min_length[10]');
		$this->form_validation->set_rules('sector_id', 'sector', 'trim|numeric');

        if ($this->form_validation->run() == FALSE) {
            if($this->session->stake_id_fk   == 4){
                $data['apps'] = $this->other_job_role_app_model->get_other_course_application(array(2,3,4,5,6,NULL));
    
            } elseif($this->session->stake_id_fk   == 5){
                $data['apps'] = $this->other_job_role_app_model->get_other_course_application(array(3,4,5,6));
            }
        } else {

            if($this->input->post("pan") != NULL){
                $search_array["ass.pan"] = $this->input->post("pan");
            }
            if($this->input->post("assessor_code") != NULL){
                $search_array["ass.assessor_code"] = $this->input->post("assessor_code");
            }
			//added
             if($this->input->post("certified") != NULL){
                $search_array["ass.certified_by_any_assessor"] = $this->input->post("certified");
            }
			
			if($this->input->post("sector_id") != NULL){
                $search_array["sector_master.sector_id_pk"] = $this->input->post("sector_id");
            }
            if($this->input->post("submit_date") != NULL){
                $raw_date=explode('-',$this->input->post('submit_date'));
			    $submit_date=$raw_date[2].'-'.$raw_date[1].'-'.$raw_date[0];
                //$search_array["ass.final_submission_time"] = $submit_date;
                $search_array["CAST(appno.final_submission_time as date)="] = $submit_date;
            }

            if(count($search_array)){
                if($this->session->stake_id_fk   == 4){
                    $data['apps'] = $this->other_job_role_app_model->get_other_course_application_search(array(2,3,4,5,6,NULL), $search_array);
        
                } elseif($this->session->stake_id_fk   == 5){
                    $data['apps'] = $this->other_job_role_app_model->get_other_course_application_search(array(3,4,5,6), $search_array);
                }
            } else {
                if($this->session->stake_id_fk   == 4){
                    $data['apps'] = $this->other_job_role_app_model->get_other_course_application(array(2,3,4,5,6,NULL));
        
                } elseif($this->session->stake_id_fk   == 5){
                    $data['apps'] = $this->other_job_role_app_model->get_other_course_application(array(3,4,5,6));
                }
            }

            
          
        }

       
        // echo $this->session->stake_id_fk  ;
        // $data['apps'] = $this->other_job_role_app_model->get_other_course_application();
        
       

        //print_r($data['apps']);

        $this->load->view($this->config->item('theme').'council/other_job_role_app_view',$data);
        //echo "test";
    }

    //
    public function accept_course($application_nubmer_id = NULL, $assessor_id_hash = NULL, $application_no = NULL){

        $data['application_nubmer_id'] = $application_nubmer_id;
        $data['application_no'] = $application_no;
        

        $data['assessor'] = $this->other_job_role_app_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->other_job_role_app_model->get_jobroles_apply_for($assessor_id_hash,$application_no);
        $data['ssc_wbsctvesd'] = $this->other_job_role_app_model->ssc_wbsctvesd_details($assessor_id_hash);
        $data['ssc_certificates'] = $this->other_job_role_app_model->get_ssc_wbsctvesed_certificate($assessor_id_hash,$application_no);
		$data['assessor_appno'] = $this->other_job_role_app_model->assessor_appno_details($assessor_id_hash,$application_no,$application_nubmer_id);	//Added by Waseem on 06-09-2021
        //$this->output->enable_profiler();
        // echo "<pre>";
        // print_r($data['ssc_certificates']);
        // echo "</pre>";


        $this->load->library('form_validation');
        //echo count($data['jobroles']);
        $this->form_validation->set_error_delimiters('<div class="text-danger" style="background-color:yellow; padding:5px;">', '</div>');
        if($this->input->method(TRUE) == "POST"){
            foreach($data['jobroles'] as $job){
                //echo $job["assessor_registration_jobrole_sector_map_id_pk"].'<br>';
                $this->form_validation->set_rules('radio['.$job["assessor_registration_jobrole_sector_map_id_pk"].']', 'Jobrole', 'required',
                    array(
                        "required" => "Select accept or reject"
                    )
                );
            }

            foreach($data['ssc_certificates'] as $certificate){
                $this->form_validation->set_rules('cf['.$certificate["council_ssc_wbsctvesd_certified_map_id_pk"].']', 'cf', 'required',
                    array(
                        "required" => "Select accept or reject"
                    )
                );
            }
        }

        if($this->session->stake_id_fk == 5){
            $this->form_validation->set_rules('app_approve_reject', 'approve or reject', 'trim|required');
        }
        // for($i = 1, $i <= $val,$i++){
        //     echo "a";
        // }

        if ($this->form_validation->run() == TRUE){
            $i= 1;
            foreach($this->input->post("radio") as $key => $val){
                $course_update_array[$key] =  $this->input->post("radio[".$key."]");
    

               
                $i++;
            }

            $i= 1;
            foreach($this->input->post("cf") as $key => $val){
                $cf_update_array[$key] = $this->input->post("cf[".$key."]");

               
                $i++;
            }

            $full_post = $_POST;
            $condition_array = array(

                "application_nubmer_id" => $application_nubmer_id,
                "assessor_id_hash"      => $assessor_id_hash,
                "application_no"        => $application_no

            );


            if($this->other_job_role_app_model->second_level_jobrole_approve($course_update_array,$cf_update_array,$full_post,$condition_array)){
                $data["message"] = "Job role approve or reject completed";

                if($this->session->stake_id_fk   == 5 && $this->input->post("app_approve_reject") == 5){
                    
                    $email_subject = "Acceptance of application for Registration as Assessor/Expert/ Training of Trainers under WBSCTVESD";

                    $email_message = $this->load->view($this->config->item('theme').'council/assessor_approve_email_template_view',$data,TRUE);
                    
                    send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);
                    
                    //$sms_message ="Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD is accepted. Please check your mail regularly for further details.";
                    //$template_id=1107161201158836463;
					$sms_message="Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD is accepted. Please check your mail regularly for further details.";
				$template_id=0;
                    $this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);
                }
            } else {
                $data["message"] = "Fail, Please try again";
            }

            // echo "<pre>";
            // print_r($course_update_array);
            // echo "</pre>";

            // echo "<pre>";
            // print_r($cf_update_array);
            // echo "</pre>";

            // echo "<pre>";
            // print_r($full_post);
            // echo "</pre>";

            // echo "<pre>";
            // print_r($condition_array);
            // echo "</pre>";
           
        } 

        $data['assessor_appno'] = $this->other_job_role_app_model->assessor_appno_details($assessor_id_hash,$application_no,$application_nubmer_id);	//Added by Waseem on 06-09-2021
        $data['jobroles'] = $this->other_job_role_app_model->get_jobroles_apply_for($assessor_id_hash,$application_no);
        $this->load->view($this->config->item('theme').'council/new_course_approve_view',$data);
    }

    public function new_view_details($assessor_registration_application_no,$assessor_id_hash=NULL,$assessor_id=NULL){
		 $data["assessor_registration_application_no"] = $assessor_registration_application_no;
        
        //$this->output->enable_profiler();
        $this->load->model('assessor_profile/Assessor_registration_add_more_model',"assessor_registration_model");

     	//$this->output->enable_profiler();
		//$data['offset'] = "";
		//$assessor_id_hash=md5($this->session->userdata('stake_details_id_fk'));
		//added parag 12-01-2021
		$this->load->model('council/new_assessor_list_model','assessor_list_model');
		
		//added parag 12-01-2021
		//$data['vtc_pbssd'] = $this->assessor_list_model->get_vtc_pbssd($assessor_id_hash);
		$data['ssc_certificates'] = $this->assessor_registration_model->get_ssc_wbsctvesed_certificate($assessor_registration_application_no,$assessor_id);
		//print_r($data['certificates']);
        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles($assessor_id_hash,$assessor_registration_application_no);
        $data['certificates'] = $this->assessor_list_model->get_certificates($assessor_id_hash,$assessor_registration_application_no);
        $data['get_work_exps'] = $this->assessor_list_model->get_work_exp($assessor_id_hash,$assessor_registration_application_no);
        $data['get_assessor_experts'] = $this->assessor_list_model->get_assessor_expert($assessor_id_hash,$assessor_registration_application_no);
		$data["docs"] = $this->assessor_registration_model->get_assessor_document($assessor_registration_application_no, $assessor_id);
        //echo "<pre>";
        //print_r($data['jobroles']);
        //echo "</pre>";
        // echo "<pre>";
        // print_r($data['get_asse_exps']);
        // echo "</pre>";
        $this->load->view($this->config->item('theme').'council/new_assessor_details_profile_view',$data);
	}

    //added parag 12-01-2021
	public function download_pdf($file_type = NULL, $app_no = NULL, $id_hash = NULL){

		//$this->load->model('council/other_job_role_app_model');

        if($file_type == "doc"){
           $data = $this->other_job_role_app_model->doc_file($id_hash,$app_no)[0]['certificate_file'];
            $name="doc";
        } elseif($file_type == "work_experience"){
            $data = $this->other_job_role_app_model->work_experience_file($id_hash,$app_no)[0]['upload_doc'];
            $name="work-experience";

        } elseif($file_type == "assessor_exp"){
            $data = $this->other_job_role_app_model->assessor_exp_file($id_hash,$app_no)[0]['exp_as_assessor_doc'];
            $name="assessor-exp";

        } elseif($file_type == "ssc_certificate"){
            $data = $this->other_job_role_app_model->ssc_certificate_file($id_hash,$app_no)[0]['toa_certificate'];
            $name="ssc_ccertificate";

        } 

        header("Content-type:application/pdf");

        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$name.pdf");

        echo base64_decode ($data);
     }
}