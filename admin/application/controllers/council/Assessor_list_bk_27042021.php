<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_list extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(5);
        $this->load->model('council/assessor_list_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
    }

    public function index($offset = 0){

		
		 $this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            2 => $this->config->item('theme_uri')."council/assessor_list.js",
            3 => $this->config->item('theme_uri').'jQuery.print.min.js', // added parag 12-01-2021
		);
		
        $data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'council/assessor_list/index/';
            $config['total_rows']       = $this->assessor_list_model->assessor_count()[0]['count'];	
            $config['per_page']         = 25;
            $config['num_links']        = 2;
            $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
            $config['full_tag_close']   = '</ul>';
            $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open']   = '<li class="">';
            $config['first_tag_close']  = '</li>';
            $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open']    = '<li class="">';
            $config['last_tag_close']   = '</li>';
            $config['first_tag_open']   = '<li>';
            $config['first_tag_close']  = '</li>';
            $config['prev_link']        = '<i class="fa fa-backward"></i>';
            $config['prev_tag_open']    = '<li class="prev">';
            $config['prev_tag_close']   = '</li>';
            $config['next_link']        = '<i class="fa fa-forward"></i>';
            $config['next_tag_open']    = '<li>';
            $config['next_tag_close']   = '</li>';
            $config['last_tag_open']    = '<li>';
            $config['last_tag_close']   = '</li>';
            $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
            $config['cur_tag_close']    = '</a></li>';
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            
            $this->pagination->initialize($config);
            $data['assessors']  	= $this->assessor_list_model->get_assessor($config['per_page'],$offset);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim');
			$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/ WBSCTVESD certified assessor', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

			if ($this->form_validation->run() == TRUE){
					$data['assessors'] 		= $this->assessor_list_model->get_assessor_search($this->input->post('pan_no'),$this->input->post('ssc_wbsctvesd_certified'));
			} 
			else {
				$data['assessors'] = array();
			}
		}
			$data['offset']         = $offset;
			//$this->load->view($this->config->item('theme').'finance/trainee_payment_file_list_view',$data);

        //print_r($data['assessors']);
        $this->load->view($this->config->item('theme').'council/assessor_list_view',$data);
    }

	// updated parag 12-01-2021
    public function view_details($assessor_id_hash = NULL){
        // added parag 12-01-2021
        $this->js_foot = array(
            1 => $this->config->item('theme_uri')."council/assessor_list.js",
            2 => $this->config->item('theme_uri').'jQuery.print.min.js', 
        );
        //$this->output->enable_profiler();
        //$data['offset'] = "";
        $data['vtc_pbssd'] = $this->assessor_list_model->get_vtc_pbssd($assessor_id_hash);

        // echo "<pre>";
        // print_r($data['vtc_pbssd']);
        // echo "</pre>";

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
        $this->load->view($this->config->item('theme').'council/assessor_details_view',$data);
    }
	
	
	
     public function download_pdf($file_type = NULL, $id_hash){

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

		// added parag 12-01-2021
        } elseif($file_type == "pan"){
            $data = $this->assessor_list_model->get_pan($id_hash)[0]['pan_file'];
            $name="pan card";
            //echo "aaa";

        }elseif($file_type == "ssc_wbsctvesd_certified"){
            $data = $this->assessor_list_model->get_toa_certificate($id_hash)[0]['toa_certificate'];
            $name="ssc_wbsctvesd_certified";
            //echo "aaa";

        } 

        header("Content-type:application/pdf");

        // It will be called downloaded.pdf
        header("Content-Disposition:attachment;filename=$name.pdf");

        echo base64_decode ($data);
     }

     //approvr
     public function approve_assessor($assessor_id_hash = NULL){
        $data['assessor_id_hash'] = $assessor_id_hash;
        //print_r($data['assessor']);
        if($this->input->method(TRUE) == "POST"){
        $assessor_id_hash= $this->input->post("assessor");
        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles_apply_for_accept_reject($assessor_id_hash);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('assessor', 'assessor', 'required|exact_length[32]');

        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {
            //$this->output->enable_profiler();
            $array = array(
                "process_status_id_fk"  => 5,
                "approve_reject_by_login_id"   => $this->session->userdata('stake_holder_login_id_pk'),
                "approve_reject_time"          => "now()",
                "approve_reject_ip"            => $this->input->ip_address()
            );
            //print_r($data['assessor']);
            $update_approve_status=$this->assessor_list_model->approve_reject($array, $assessor_id_hash);

            if($update_approve_status){
                $email_subject = "Acceptance of application for Registration as Assessor/Expert/ Training of Trainers under WBSCTVESD";

                $email_message = $this->load->view($this->config->item('theme').'council/assessor_approve_email_template_view',$data,TRUE);
                
                send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);
                
				$sms_message ="Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD is accepted. Please check your mail regularly for further details.";
				$template_id=1107161201158836463;
                $this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);
                 $data['success']  = "success";
            } else {
                 $data['danger']  = "danger";

            }

        }
    }
        $this->load->view($this->config->item('theme').'council/approve_assessor_view',$data);
     }



     //reject
     public function reject_assessor($assessor_id_hash = NULL){
        $data['assessor_id_hash'] = $assessor_id_hash;
        if($this->input->method(TRUE) == "POST"){
        $assessor_id_hash= $this->input->post("assessor");
        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles_apply_for_accept_reject($assessor_id_hash);
        $assessor_dtls = $this->assessor_list_model->assessor_details_all($assessor_id_hash);
        $jobrole_dtls = $this->assessor_list_model->assessor_jobrole_details_all($assessor_id_hash);
        $assessor_expert_dtls = $this->assessor_list_model->assessor_assessor_expert_details_all($assessor_id_hash);
        $assessor_certified_dtls = $this->assessor_list_model->assessor_assessor_certified_details_all($assessor_id_hash);
        $assessor_work_experience_dtls = $this->assessor_list_model->assessor_assessor_work_experience_details_all($assessor_id_hash);
		$assessor_working_map_dtls = $this->assessor_list_model->assessor_assessor_working_map_details_all($assessor_id_hash);

       // echo "<pre>";print_r($jobrole_dtls);die;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('assessor', 'assessor', 'required|exact_length[32]');
        $this->form_validation->set_rules('reject_reason', 'Reason', 'required|max_length[200]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {
            $data['reject_reason']=$this->input->post("reject_reason");
            //$this->output->enable_profiler();
            $archive_insert_array=array(
                'assessor_registration_details_pk'          => $assessor_dtls[0]['assessor_registration_details_pk'],
                'salutation_id_fk'                          => $assessor_dtls[0]['salutation_id_fk'],
                'fname'                                     => $assessor_dtls[0]['fname'],
                'mname'                                     => $assessor_dtls[0]['mname'],
                'lname'                                     => $assessor_dtls[0]['lname'],
                'gender_id_fk'                              => $assessor_dtls[0]['gender_id_fk'],
                'dob'                                       => $assessor_dtls[0]['dob'],
                'language_id_fk'                            => $assessor_dtls[0]['language_id_fk'],
                'pan'                                       => $assessor_dtls[0]['pan'],
                'id_type_alt_id_fk'                         => $assessor_dtls[0]['id_type_alt_id_fk'],
                'id_no_alt'                                 => $assessor_dtls[0]['id_no_alt'],
                'mobile_no'                                 => $assessor_dtls[0]['mobile_no'],
                'landline_no'                               => $assessor_dtls[0]['landline_no'],
                'email_id'                                  => $assessor_dtls[0]['email_id'],
                'entry_time'                                => $assessor_dtls[0]['entry_time'],
                'entry_ip'                                  => $assessor_dtls[0]['entry_ip'],
                'active_status'                             => $assessor_dtls[0]['active_status'],
                'acknowledgement'                           => $assessor_dtls[0]['acknowledgement'],
                'apply_for_assessor'                        => $assessor_dtls[0]['apply_for_assessor'],
                'apply_for_expert'                          => $assessor_dtls[0]['apply_for_expert'],
                'expart_type_academic'                      => $assessor_dtls[0]['expart_type_academic'],
                'expart_type_industrial'                    => $assessor_dtls[0]['expart_type_industrial'],
                'assessor_certified_status'                 => $assessor_dtls[0]['assessor_certified_status'],
                'highest_qualification_id_pk'               => $assessor_dtls[0]['highest_qualification_id_pk'],
                'discipline'                                => $assessor_dtls[0]['discipline'],
                'othert_quali'                              => $assessor_dtls[0]['othert_quali'],
                'current_emp_status_id_fk'                  => $assessor_dtls[0]['current_emp_status_id_fk'],
                'house_flat_building'                       => $assessor_dtls[0]['house_flat_building'],
                'street'                                    => $assessor_dtls[0]['street'],
                'post_opffice'                              => $assessor_dtls[0]['post_opffice'],
                'police'                                    => $assessor_dtls[0]['police'],
                'state_id_fk'                               => $assessor_dtls[0]['state_id_fk'],
                'district_id_fk'                            => $assessor_dtls[0]['district_id_fk'],
                'block_id_fk'                               => $assessor_dtls[0]['block_id_fk'],
                'pin'                                       => $assessor_dtls[0]['pin'],
                'permanent_house_flat_building'             => $assessor_dtls[0]['permanent_house_flat_building'],
                'permanent_street'                          => $assessor_dtls[0]['permanent_street'],
                'permanent_post_office'                     => $assessor_dtls[0]['permanent_post_office'],
                'permanent_police'                          => $assessor_dtls[0]['permanent_police'],
                'permanent_state_id_fk'                     => $assessor_dtls[0]['permanent_state_id_fk'],
                'permanent_district_id_fk'                  => $assessor_dtls[0]['permanent_district_id_fk'],
                'permanent_block_id_fk'                     => $assessor_dtls[0]['permanent_block_id_fk'],
                'permanent_pin'                             => $assessor_dtls[0]['permanent_pin'],
                'working_in'                                => $assessor_dtls[0]['working_in'],
                'centre_code'                               => $assessor_dtls[0]['centre_code'],
                'centre_name'                               => $assessor_dtls[0]['centre_name'],
                'cv'                                        => $assessor_dtls[0]['cv'],
                'photo'                                     => $assessor_dtls[0]['photo'],
                'apply_highest_quali'                       => $assessor_dtls[0]['apply_highest_quali'],
                'domain_exp'                                => $assessor_dtls[0]['domain_exp'],
                'certified_by_any_assessor'                 => $assessor_dtls[0]['certified_by_any_assessor'],
                'assessor_code'                             => $assessor_dtls[0]['assessor_code'],
                'final_submission_time'                     => $assessor_dtls[0]['final_submission_time'],
                'final_submission_ip'                       => $assessor_dtls[0]['final_submission_ip'],
                'domain_id_fk'                              => $assessor_dtls[0]['domain_id_fk'],
                'course_flag'                               => $assessor_dtls[0]['course_flag'],
                'edu_qualification_flag'                    => $assessor_dtls[0]['edu_qualification_flag'],
                'residential_address_flag'                  => $assessor_dtls[0]['residential_address_flag'],
                'work_experience_flag'                      => $assessor_dtls[0]['work_experience_flag'],
                'experience_assessor_flag'                  => $assessor_dtls[0]['experience_assessor_flag'],
                'professional_details_flag'                 => $assessor_dtls[0]['professional_details_flag'],
                'final_flag'                                => $assessor_dtls[0]['final_flag'],
                'basic_flag'                                => $assessor_dtls[0]['basic_flag'],
                'process_status_id_fk'                      => $assessor_dtls[0]['process_status_id_fk'],
                'reject_reason'                             => $assessor_dtls[0]['reject_reason'],
                'pan_file'                                  => $assessor_dtls[0]['pan_file'],
                'apply_for_trainer_of_trainer'              => $assessor_dtls[0]['apply_for_trainer_of_trainer'],
                'resume_photo_flag'                         => $assessor_dtls[0]['resume_photo_flag'],
                'approve_reject_by_login_id'                => $assessor_dtls[0]['approve_reject_by_login_id'],
                'approve_reject_time'                       => $assessor_dtls[0]['approve_reject_time'],
                'approve_reject_ip'                         => $assessor_dtls[0]['approve_reject_ip'],
                'ssc_wbsctvesd_certified'                   => $assessor_dtls[0]['ssc_wbsctvesd_certified'],
                'attended_any_toa'                          => $assessor_dtls[0]['attended_any_toa'],
                'toa_certificate'                           => $assessor_dtls[0]['toa_certificate'],
                'ssc_wbsctvesd_certified_flag'              => $assessor_dtls[0]['ssc_wbsctvesd_certified_flag'],
                'ssc_wbsctvesd_status'                      => $assessor_dtls[0]['ssc_wbsctvesd_status'],
                'admin_level_one_approve_status'            => $assessor_dtls[0]['admin_level_one_approve_status'],
                'approve_reject_time_course'                => $assessor_dtls[0]['approve_reject_time_course'],
                'approve_reject_ip_course'                  => $assessor_dtls[0]['approve_reject_ip_course'],
                'approve_reject_by_login_id_course'         => $assessor_dtls[0]['approve_reject_by_login_id_course'],
                'archived_by'								=> $this->session->stake_holder_login_id_pk,
				'archive_time'								=> date('Y-m-d H:i:s'),
				'archive_ip'								=> $this->input->ip_address()
            );

            $arr['jobrole_final_arr'] = array();

            foreach($jobrole_dtls as $job_dtls)
			{
                $jobrole_array=array(
                    'assessor_registration_jobrole_sector_map_id_pk'	=> $job_dtls['assessor_registration_jobrole_sector_map_id_pk'],
                    'assessor_registration_details_fk'	=> $job_dtls['assessor_registration_details_fk'],
                    'course_id_fk'	=> $job_dtls['course_id_fk'],
                    'sector_id_fk'	=> $job_dtls['sector_id_fk'],
                    'job_role_sp_quali'	=> $job_dtls['job_role_sp_quali'],
                    'active_status'	=> $job_dtls['active_status'],
                    'entry_time'	=> $job_dtls['entry_time'],
                    'apply_highest_quali'	=> $job_dtls['apply_highest_quali'],
                    'domain_exp'	=> $job_dtls['domain_exp'],
                    'domain_id_fk'	=> $job_dtls['domain_id_fk'],
                    'apply_for_assessor'	=> $job_dtls['apply_for_assessor'],
                    'apply_for_expert'	=> $job_dtls['apply_for_expert'],
                    'expart_type_academic'	=> $job_dtls['expart_type_academic'],
                    'expart_type_industrial'	=> $job_dtls['expart_type_industrial'],
                    'apply_for_trainer_of_trainer'	=> $job_dtls['apply_for_trainer_of_trainer'],
                    'process_status_id_fk'	=> $job_dtls['process_status_id_fk'],
                    'apply_for_assessor_status'	=> $job_dtls['apply_for_assessor_status'],
                    'apply_for_expert_status'	=> $job_dtls['apply_for_expert_status'],
                    'expart_type_academic_status'	=> $job_dtls['expart_type_academic_status'],
                    'expart_type_industrial_status'	=> $job_dtls['expart_type_industrial_status'],
                    'apply_for_trainer_of_trainer_status'	=> $job_dtls['apply_for_trainer_of_trainer_status'],
                    'apply_for_approve_reject_status'	=> $job_dtls['apply_for_approve_reject_status'],
                    'archived_by'								=> $this->session->stake_holder_login_id_pk,
				    'archive_time'								=> date('Y-m-d H:i:s'),
				    'archive_ip'								=> $this->input->ip_address()
                );
				
				array_push($arr['jobrole_final_arr'],$jobrole_array);
			}


            $assessor_expert_final_arr = array();

            foreach($assessor_expert_dtls as $assessor_expert)
			{
                $assessor_expert_array=array(
                    
                    'assessor_registration_assessor_expert_map_id_pk'	=> $assessor_expert['assessor_registration_assessor_expert_map_id_pk'],
                    'exp_as_assessor_job_role_id_fk'	=> $assessor_expert['exp_as_assessor_job_role_id_fk'],
                    'nsqf_level'	=> $assessor_expert['nsqf_level'],
                    'exp_as_assessor_work_years'	=> $assessor_expert['exp_as_assessor_work_years'],
                    'exp_as_assessor_work_months'	=> $assessor_expert['exp_as_assessor_work_months'],
                    'exp_as_assessor_doc'	=> $assessor_expert['exp_as_assessor_doc'],
                    'active_status'	=> $assessor_expert['active_status'],
                    'entry_time'	=> $assessor_expert['entry_time'],
                    'assessor_registration_details_fk'	=> $assessor_expert['assessor_registration_details_fk'],
                    'archived_by'								=> $this->session->stake_holder_login_id_pk,
				    'archive_time'								=> date('Y-m-d H:i:s'),
				    'archive_ip'								=> $this->input->ip_address()
                );
				
				array_push($assessor_expert_final_arr,$assessor_expert_array);
			}


            $assessor_certified_final_arr = array();

            foreach($assessor_certified_dtls as $assessor_certified)
			{
                $assessor_certified_array=array(
                    
                    'council_assessor_registration_certified_map_id_pk'	=> $assessor_certified['council_assessor_registration_certified_map_id_pk'],
                    'assessing_body'	=> $assessor_certified['assessing_body'],
                    'certificate_number'	=> $assessor_certified['certificate_number'],
                    'certificate_doc'	=> $assessor_certified['certificate_doc'],
                    'active_status'	=> $assessor_certified['active_status'],
                    'entry_time'	=> $assessor_certified['entry_time'],
                    'assessor_registration_details_fk'	=> $assessor_certified['assessor_registration_details_fk'],
                    'archived_by'								=> $this->session->stake_holder_login_id_pk,
				    'archive_time'								=> date('Y-m-d H:i:s'),
				    'archive_ip'								=> $this->input->ip_address()
                );
				
				array_push($assessor_certified_final_arr,$assessor_certified_array);
			}

            $assessor_work_experience_final_arr = array();

            foreach($assessor_work_experience_dtls as $work_experience)
			{
                $assessor_work_experience_array=array(
                    
                    'assessor_work_experience_id_pk'	=> $work_experience['assessor_work_experience_id_pk'],
                    'assessor_id_fk'	=> $work_experience['assessor_id_fk'],
                    'organisation_name'	=> $work_experience['organisation_name'],
                    'area_of_work'	=> $work_experience['area_of_work'],
                    'no_of_years'	=> $work_experience['no_of_years'],
                    'no_of_months'	=> $work_experience['no_of_months'],
                    'upload_doc'	=> $work_experience['upload_doc'],
                    'active_status'	=> $work_experience['active_status'],
                    'entry_time'	=> $work_experience['entry_time'],
                    'assessor_registration_details_fk'	=> $work_experience['assessor_registration_details_fk'],
                    'archived_by'								=> $this->session->stake_holder_login_id_pk,
				    'archive_time'								=> date('Y-m-d H:i:s'),
				    'archive_ip'								=> $this->input->ip_address()
                );
				
				array_push($assessor_work_experience_final_arr,$assessor_work_experience_array);
			}
			
			$assessor_working_map_final_arr = array();

            foreach($assessor_working_map_dtls as $assessor_working_map)
			{
                $assessor_working_map_array=array(
                    
                    'working_map_id_pk'	=> $assessor_working_map['working_map_id_pk'],
                    'assessor_id_fk'	=> $assessor_working_map['assessor_id_fk'],
                    'working_id_fk'	=> $assessor_working_map['working_id_fk'],
                    'centre_code'	=> $assessor_working_map['centre_code'],
                    'centre_name'	=> $assessor_working_map['centre_name'],
                    'active_status'	=> $assessor_working_map['active_status'],
                    'archived_by'								=> $this->session->stake_holder_login_id_pk,
				    'archive_time'								=> date('Y-m-d H:i:s'),
				    'archive_ip'								=> $this->input->ip_address()
                );
				
				array_push($assessor_working_map_final_arr,$assessor_working_map_array);
			}

            $array_main_table = array(
                "process_status_id_fk"         => 6,
                "reject_reason"                => $this->input->post("reject_reason"),
                "approve_reject_by_login_id"   => $this->session->userdata('stake_holder_login_id_pk'),
                "approve_reject_time"          => "now()",
                "approve_reject_ip"            => $this->input->ip_address(),
                "final_flag"                   => NULL,
                "ssc_wbsctvesd_status"         =>NULL
            );

            $array_job_map = array(
                "process_status_id_fk"         => NULL,
                "apply_for_approve_reject_status"=>NULL
            );
            //$update_reject_status=1;

            $this->db->trans_begin();
            $insert_archive_data = $this->assessor_list_model->insert_archive_assessor_data($archive_insert_array); //Insert Main Table
            $insert_archive_jobrole = $this->assessor_list_model->insert_archive_assessor_jobrole_data($arr); //Insert Jobrole map table
            $insert_archive_assessor_expert = $this->assessor_list_model->insert_archive_assessor_expert_data($assessor_expert_final_arr); //Insert assessor_expert map table
            $insert_archive_assessor_certified = $this->assessor_list_model->insert_archive_assessor_certified_data($assessor_certified_final_arr); //Insert assessor_certified map table
            $insert_archive_assessor_work_experience = $this->assessor_list_model->insert_archive_assessor_work_experience_data($assessor_work_experience_final_arr); //Insert assessor_work_experience map table
			$insert_archive_assessor_working_map = $this->assessor_list_model->insert_archive_assessor_working_map_data($assessor_working_map_final_arr); //Insert assessor_working map table

            $update_job_map_status=$this->assessor_list_model->update_job_map_status($array_job_map, $this->input->post("assessor"));
            $update_reject_status=$this->assessor_list_model->approve_reject($array_main_table, $this->input->post("assessor"));


            if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                }
                else
                {
                    $error = 1;
                    if($insert_archive_data != NULL){
                        $error=0;
                    }
                    if($insert_archive_jobrole != NULL){
                        $error=0;
                    }
                    if($insert_archive_assessor_expert != NULL){
                        $error=0;
                    }
                    if($insert_archive_assessor_certified != NULL){
                        $error=0;
                    }
                    if($insert_archive_assessor_work_experience != NULL){
                        $error=0;
                    }
					if($insert_archive_assessor_working_map != NULL){
                        $error=0;
                    }
                    if($update_job_map_status != NULL){
                        $error=0;
                    }
                    if($update_reject_status != NULL){
                        $error=0;
                    }
                }
            if($error==0){
                $this->db->trans_commit();

                $email_subject = "Rejection of application for Registration as Assessor/Expert/ Training of Trainers under WBSCTVESD";

                $email_message = $this->load->view($this->config->item('theme').'council/assessor_reject_email_template_view',$data,TRUE);
                
                send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);
                
				$sms_message ="Application for registration as an Assessor/ Expert/ Training of Trainers under WBSCTVESD is rejected. Please check your mail for further details.";
				$template_id=1107161201167036976;
                $this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);

                 $data['success']  = "success";
            } else {
                $this->db->trans_rollback();
                 $data['danger']  = "danger";

            }

        }
    }
        $this->load->view($this->config->item('theme').'council/reject_assessor_view',$data);
    }

   public function view_course_details($assessor_id_hash = NULL){

        $this->js_foot = array(
            1 => $this->config->item('theme_uri')."council/assessor_course_list.js",
            //2 => $this->config->item('theme_uri').'assets/js/sweetalert.min.js', 
            3 => $this->config->item('theme_uri').'assets/js/sweetalert.js',
        );

        $data['assessor'] = $this->assessor_list_model->assessor_details($assessor_id_hash);
        $data['jobroles'] = $this->assessor_list_model->get_jobroles_apply_for($assessor_id_hash);
        $data['ssc_wbsctvesd'] = $this->assessor_list_model->ssc_wbsctvesd_details($assessor_id_hash);
        
        $this->load->view($this->config->item('theme').'council/assessor_course_details_view',$data);

        // echo'<pre>';print_r($data['assessor']);exit();
    }

    public function updateAssessorCourseInformation(){
        extract($this->input->get('myArray'));

        $assessor_apply_for_data = array(
            "apply_for_assessor_status"                => ($apply_for_assessor     == '') ? NULL : $apply_for_assessor,
            "apply_for_expert_status"                  => ($apply_for_expert       == '') ? NULL : $apply_for_expert,
            "apply_for_trainer_of_trainer_status"	   => ($trainer_of_trainers    == '') ? NULL : $trainer_of_trainers,
            "expart_type_academic_status"              => ($expart_type_academic   == '') ? NULL : $expart_type_academic,
            "expart_type_industrial_status"            => ($expart_type_industrial == '') ? NULL : $expart_type_industrial,
            "apply_for_approve_reject_status"          => 1
        );
        $status_1 = $this->assessor_list_model->update_apply_for_status_data($assessor_apply_for_data, $assessor_id_hash);

        if($status_1)
        {
            $sscWbsctvesdArray = array('ssc_wbsctvesd_status' => $certifiedStatus);

            if(in_array($this->session->stake_id_fk, array(2, 5)))
            {
                $sscWbsctvesdArray['admin_level_one_approve_status'] = 1;
            }
            $status_2 = $this->assessor_list_model->ssc_wbsctvesd_status_update($assessor_id_hash, $sscWbsctvesdArray);

            if($status_2)
            {
                foreach ($courseList as $key => $value) 
                {
                    $value = ($value == '') ? NULL : $value;
        
                    $this->assessor_list_model->course_approve_reject(array("process_status_id_fk" => $value), $key);
                }


                $myArray = array(
                    "process_status_id_fk"              => 3,
                    "approve_reject_time_course"        => "now()",
                    "approve_reject_ip_course"          => $this->input->ip_address(),
                    "approve_reject_by_login_id_course" => $this->session->userdata('stake_holder_login_id_pk'),
                );
                
                $this->assessor_list_model->approve_reject($myArray, $assessor_id_hash);
        
                echo json_encode("Done");
            }
        }

    }

    public function confirm_course_submit(){
        if($this->input->method(TRUE) == "POST"){
            $assessor_id_hash=$this->input->post("assessor_id_hash");
            $assessor_apply_for_data = array( // update
				"apply_for_assessor_status"                => $this->input->post("apply_for_assessor")==NULL?0:$this->input->post("apply_for_assessor"),
				"apply_for_expert_status"                  => $this->input->post("apply_for_expert"),
				"expart_type_academic_status"              => $this->input->post("expart_type_academic"),
				"expart_type_industrial_status"            => $this->input->post("expart_type_industrial"),
				"apply_for_trainer_of_trainer_status"	   => $this->input->post("trainer_of_trainers"),
				"apply_for_approve_reject_status"          => 1

            );
            //print_r($assessor_apply_for_data);die;

            $array = array(
                "process_status_id_fk" => 3
            );
            $ass_reg_process_status=$this->assessor_list_model->approve_reject($array, $assessor_id_hash);
            $assessor_apply_update=$this->assessor_list_model->update_apply_for_status_data($assessor_apply_for_data,$assessor_id_hash);

            if($ass_reg_process_status!='' && $assessor_apply_update!='' ){
                
                echo json_encode(array('response' => "TRUE"));
            } else {
                echo json_encode(array('response' => "FALSE"));
           }
        }

    }

    //Assessor Course approvr
    public function approve_assessor_course($assessor_course_id_hash = NULL){
        $data['assessor_course_id_hash'] = $assessor_course_id_hash;
        //$assessor_id=$this->assessor_list_model->get_assessor_id($assessor_course_id_hash)[0]['assessor_registration_details_fk'];
        //$data['assessor_id']=md5($assessor_id);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('assessor_course_id', 'assessor_course_id', 'required|exact_length[32]');

        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {

            //$this->output->enable_profiler();
            $array = array(
                "process_status_id_fk" => 5
            );
            if($this->assessor_list_model->course_approve_reject($array, $this->input->post("assessor_course_id"))){
                 $data['success']  = "success";
            } else {
                 $data['danger']  = "danger";

            }

        }
        $this->load->view($this->config->item('theme').'council/ajax_approve_assessor_course_view',$data);
     }
     //Assessor Course reject
     public function reject_assessor_course($assessor_course_id_hash = NULL){
        $data['assessor_course_id_hash'] = $assessor_course_id_hash;
        $this->load->library('form_validation');
        $this->form_validation->set_rules('assessor_course_id', 'assessor_course_id', 'required|exact_length[32]');
        //$this->form_validation->set_rules('reject_reason', 'Reason', 'required|max_length[200]');

        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {

            //$this->output->enable_profiler();
            $array = array(
                "process_status_id_fk" => 6,
                //"reject_reason"         => $this->input->post("reject_reason")
            );
            if($this->assessor_list_model->course_approve_reject($array, $this->input->post("assessor_course_id"))){
                 $data['success']  = "success";
            } else {
                 $data['danger']  = "danger";

            }

        }
        $this->load->view($this->config->item('theme').'council/ajax_reject_assessor_course_view',$data);
    }
}