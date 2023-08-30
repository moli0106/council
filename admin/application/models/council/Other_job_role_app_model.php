<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Other_job_role_app_model extends CI_Model {

    public function get_other_course_application($whare_in = NULL){
        $query = $this->db->select("
            distinct(ass.assessor_registration_details_pk), 
            appno.assessor_registration_application_nubmer_id_pk,
            ass.pan,
            ass.fname,
            ass.mname,
            ass.lname,
            ass.assessor_code,
            appno.approve_status,
            appno.assessor_registration_application_no,
            appno.final_submission_status,
            appno.final_submission_time,
            process.process_name,
            process.process_id_pk,
			sector_master.sector_name
            ")
            ->from("council_assessor_registration_application_nubmer as appno")
            ->join("council_assessor_registration_details as ass","appno.assessor_registration_details_fk = ass.assessor_registration_details_pk")
            ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
			
			->join("council_assessor_registration_jobrole_sector_map as jobrole_map","ass.assessor_registration_details_pk = jobrole_map.assessor_registration_details_fk and appno.assessor_registration_application_no = jobrole_map.assessor_registration_application_no")
            ->join("council_course_master as course_master","jobrole_map.course_id_fk = course_master.course_id_pk")
            ->join("council_sector_master as sector_master","course_master.sector_id_fk = sector_master.sector_id_pk")

            ->where(
                array(
                    "appno.assessor_registration_application_no >" => 1,
                    "appno.final_submission_status" => 1,
					"jobrole_map.active_status"=>1,
					"jobrole_map.assessor_registration_application_no > "=>1
                )
            )

            ->where_in("appno.process_status_id_fk", $whare_in)
            ->order_by("appno.assessor_registration_application_nubmer_id_pk","desc")
            ->get();
        return $query->result_array();
    }

    public function get_other_course_application_count($whare_in = NULL){
        $query = $this->db->select("
            
            count(distinct(appno.assessor_registration_application_nubmer_id_pk)),
            
            ")
            ->from("council_assessor_registration_application_nubmer as appno")
            ->join("council_assessor_registration_details as ass","appno.assessor_registration_details_fk = ass.assessor_registration_details_pk")
            ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
			
			->join("council_assessor_registration_jobrole_sector_map as jobrole_map","ass.assessor_registration_details_pk = jobrole_map.assessor_registration_details_fk and appno.assessor_registration_application_no = jobrole_map.assessor_registration_application_no")
            ->join("council_course_master as course_master","jobrole_map.course_id_fk = course_master.course_id_pk")
            ->join("council_sector_master as sector_master","course_master.sector_id_fk = sector_master.sector_id_pk")

            ->where(
                array(
                    "appno.assessor_registration_application_no >" => 1,
                    "appno.final_submission_status" => 1,
					"jobrole_map.active_status"=>1,
					"jobrole_map.assessor_registration_application_no > "=>1
                )
            )

            ->where_in("appno.process_status_id_fk", $whare_in)
            ->order_by("appno.assessor_registration_application_nubmer_id_pk","desc")
            ->get();
        return $query->result_array();
    }

    public function get_other_course_application_search($whare_in = NULL,$search_array= NULL){
        $query = $this->db->select("
            distinct(ass.assessor_registration_details_pk), 
            appno.assessor_registration_application_nubmer_id_pk,
            ass.pan,
            ass.fname,
            ass.mname,
            ass.lname,
            ass.assessor_code,
            appno.approve_status,
            appno.assessor_registration_application_no,
            appno.final_submission_status,
            appno.final_submission_time,
            process.process_name,
            process.process_id_pk,
			sector_master.sector_name
            ")
            ->from("council_assessor_registration_application_nubmer as appno")
            ->join("council_assessor_registration_details as ass","appno.assessor_registration_details_fk = ass.assessor_registration_details_pk")
            ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
			
			->join("council_assessor_registration_jobrole_sector_map as jobrole_map","ass.assessor_registration_details_pk = jobrole_map.assessor_registration_details_fk and appno.assessor_registration_application_no = jobrole_map.assessor_registration_application_no")
            ->join("council_course_master as course_master","jobrole_map.course_id_fk = course_master.course_id_pk")
            ->join("council_sector_master as sector_master","course_master.sector_id_fk = sector_master.sector_id_pk")

            ->where(
                array(
                    "appno.assessor_registration_application_no >" => 1,
                    "appno.final_submission_status" => 1,
					"jobrole_map.active_status"=>1,
					"jobrole_map.assessor_registration_application_no > "=>1
                )
            )
            ->where($search_array)

            ->where_in("appno.process_status_id_fk", $whare_in)
            ->order_by("appno.assessor_registration_application_nubmer_id_pk","desc")
            ->get();
        return $query->result_array();
    }

    public function assessor_details($assessor_id_hash = NULL){
        $query = $this->db->select("
    
                assessor.assessor_registration_details_pk,
                salutation.salutation_desc,
                assessor.process_status_id_fk,
                assessor.admin_level_one_approve_status,
                assessor.fname,
                assessor.mname,
                assessor.lname,
                assessor.photo,
                gender.gender_description,
                assessor.dob,
                language.language_desc,
                assessor.pan,
                id_type.id_type_name,
                assessor.id_no_alt,
                assessor.mobile_no,
                assessor.landline_no,
                assessor.email_id,
                assessor.apply_for_assessor,
                assessor.apply_for_expert,
                assessor.expart_type_academic,
                assessor.expart_type_industrial,
                assessor.assessor_certified_status,
                assessor.apply_for_assessor,
                quali.qualification as domain_qualification,
                assessor.domain_exp,
                domain.domain_name,
                hquali.qualification as highest_qualification,
                assessor.discipline,
                assessor.othert_quali,
                emps.employment_status,
    
                assessor.house_flat_building,
                assessor.street,
                assessor.post_opffice,
                assessor.police,
                state.state_name,
                dist.district_name,
                block.block_municipality_name,
                assessor.pin,
    
                assessor.permanent_house_flat_building,
                assessor.permanent_street,
                assessor.permanent_post_office,
                assessor.permanent_police,
                statep.state_name as permanent_state_name,
                distp.district_name as permanent_district_name,
                blockp.block_municipality_name as permanent_block_municipality_name,
                assessor.permanent_pin,
                assessor.working_in,
                assessor.centre_code,
                assessor.centre_name,
                assessor.apply_for_trainer_of_trainer,
                assessor.ssc_wbsctvesd_certified,
                assessor.attended_any_toa,
                assessor.toa_certificate
    
    
                
                ")
                ->from("council_assessor_registration_details as assessor")
                ->join("council_salutation_master as salutation","assessor.salutation_id_fk = salutation.salutation_id_pk AND salutation.active_status = 1","LEFT")
                ->join("council_gender_master as gender","assessor.gender_id_fk = gender.gender_id_pk","LEFT")
                ->join("council_language_master as language","assessor.language_id_fk = language.language_id_pk AND language.active_status = 1","LEFT")
                ->join("council_id_type_master as id_type","assessor.id_type_alt_id_fk = id_type.id_type_id_pk AND id_type.active_status = 1","LEFT")
                ->join("council_qualification as quali","assessor.apply_highest_quali = quali.qualification_id_pk","LEFT")
                ->join("council_domain_master as domain","assessor.domain_id_fk = domain.domain_id_pk","LEFT")
                ->join("council_qualification as hquali","assessor.highest_qualification_id_pk = hquali.qualification_id_pk","LEFT")
                ->join("council_employment_status as emps","assessor.current_emp_status_id_fk = emps.employment_status_id_pk","LEFT")
    
                ->join("council_state_master as state","assessor.state_id_fk = state.state_id_pk AND state.state_id_pk = 19 ","LEFT")
                ->join("council_district_master as dist","assessor.district_id_fk = dist.district_id_pk","LEFT")
                ->join("council_block_municipality_master as block","assessor.block_id_fk = block.block_municipality_id_pk","LEFT")
    
                ->join("council_state_master as statep","assessor.state_id_fk = statep.state_id_pk AND state.state_id_pk = 19 ","LEFT")
                ->join("council_district_master as distp","assessor.district_id_fk = distp.district_id_pk","LEFT")
                ->join("council_block_municipality_master as blockp","assessor.block_id_fk = blockp.block_municipality_id_pk","LEFT")
    
                ->where(
                    array(
                        "assessor.active_status" => 1,
                        "MD5(CAST(assessor.assessor_registration_details_pk as character varying)) =" => $assessor_id_hash
                    )
                )
                ->get();
            return $query->result_array();
        }
        public function get_jobroles_apply_for($assessor_id_hash = NULL, $application_no = NULL){
            $query = $this->db->select("
                jobrole.assessor_registration_jobrole_sector_map_id_pk,
                course.course_name,
                course.course_code,
                sector.sector_name,
                sector.sector_code,
                jobrole.job_role_sp_quali,
                jobrole.domain_exp,
                quali.qualification,
                domain.domain_name,
                apply_for_assessor,
                apply_for_expert,
                expart_type_academic,
                expart_type_industrial,
                apply_for_trainer_of_trainer,
                process_status_id_fk,
                
                apply_for_assessor_status,
                apply_for_expert_status,
                expart_type_academic_status,
                expart_type_industrial_status,
                apply_for_trainer_of_trainer_status,
                apply_for_approve_reject_status,
                process_name,
                jobrole.assessor_registration_application_no
                ")
                ->from("council_assessor_registration_jobrole_sector_map as jobrole")
                ->join("council_course_master as course","jobrole.course_id_fk = course.course_id_pk")
                ->join("council_sector_master as sector","course.sector_id_fk = sector.sector_id_pk")
                ->join("council_qualification as quali","jobrole.apply_highest_quali = quali.qualification_id_pk","LEFT")
                ->join("council_domain_master as domain","jobrole.domain_id_fk = domain.domain_id_pk","LEFT")
                ->join("council_process_master as process","jobrole.process_status_id_fk = process.process_id_pk","LEFT")
                ->where(
                    array(
                        "jobrole.active_status" => 1,
                        "MD5(CAST(jobrole.assessor_registration_details_fk as character varying)) =" => $assessor_id_hash,
                        "jobrole.assessor_registration_application_no" => $application_no
                    )
                ) 
                ->get();
            return $query->result_array();
        }

        public function ssc_wbsctvesd_details($id_hash = NULL,$application_no = NULL){
            $query = $this->db->select("
                assessor.assessor_registration_details_pk,
                assessor.ssc_wbsctvesd_certified,
                assessor.attended_any_toa,
                assessor.toa_certificate,
                assessor.ssc_wbsctvesd_status
            ")
            ->from("council_assessor_registration_details as assessor")
            ->where(
                array(
                    "assessor.active_status" => 1,
                    "MD5(CAST(assessor.assessor_registration_details_pk as character varying)) =" => $id_hash,
                    
                )
            )
            ->get();
            return $query->result_array();
        }

        public function get_ssc_wbsctvesed_certificate($assessor_id_hash = NULL,$application_no = NULL){
            $query = $this->db->select('map.council_ssc_wbsctvesd_certified_map_id_pk,
            course.course_name,course.course_code,
            map.ssc_wbsctvesd_certified,
            map.attended_any_toa,map.cf_validity,
            map.process_status_id_fk
            ')
                ->from('council_assessor_ssc_wbsctvesd_certified_map AS map')
                ->join('council_course_master as course','map.course_id_fk = course.course_id_pk')
                ->where('MD5(CAST(map.assessor_registration_details_fk as character varying)) =',$assessor_id_hash)
                ->where('map.active_status ',1)
                ->where('map.assessor_registration_application_no =',$application_no)
                ->order_by("map.council_ssc_wbsctvesd_certified_map_id_pk","asc")
                ->get();
            return $query->result_array();
        }
		
		
		//Added by Waseem on 06-09-2021
		public function assessor_appno_details($assessor_id_hash = NULL,$application_no = NULL,$application_nubmer_id = NULL){
			
            $query = $this->db->select("assessor_appno.assessor_registration_application_nubmer_id_pk,assessor_appno.assessor_registration_details_fk,assessor_appno.assessor_registration_application_no,assessor_appno.approve_status,assessor_appno.process_status_id_fk
            ")
            ->from("council_assessor_registration_application_nubmer as assessor_appno")
            ->where(
                array(
                    "assessor_appno.active_status" => 1,
                    "MD5(CAST(assessor_appno.assessor_registration_details_fk as character varying)) =" => $assessor_id_hash,
					"assessor_appno.assessor_registration_application_nubmer_id_pk" => $application_nubmer_id,
					"assessor_appno.assessor_registration_application_no" => $application_no
                    
                )
            )
            ->get();
            return $query->result_array();
        }
		
		//Added by Waseem on 06-09-2021

        public function second_level_jobrole_approve($course_array=NULL,$cf_array=NULL,$full_post,$condition_array=NULL){

            $this->db->trans_begin();

            //course approve reject
            foreach($course_array as $key => $val){

                if(isset($full_post["apply_for_assessor"])){
                    $this->db->set('apply_for_assessor_status', 1);
                }
                if(isset($full_post["apply_for_expert"])){
                    $this->db->set('apply_for_expert_status', 1);
                }
                if(isset($full_post["trainer_of_trainers"])){
                    $this->db->set('apply_for_trainer_of_trainer_status', 1);
                }
                if(isset($full_post["expart_type_academic"])){
                    $this->db->set('expart_type_academic_status', 1);
                }
                if(isset($full_post["expart_type_industrial"])){
                    $this->db->set('expart_type_industrial_status', 1);
                }

                //$this->db->set('apply_for_approve_reject_status', 1);

                //$this->db->set('process_status_id_fk', $val);
				
				//Added by Waseem on 31-08-2021
                if($this->session->stake_id_fk == 4){
                    $this->db->set('apply_for_approve_reject_status', 1);
                    $this->db->set('process_status_id_fk', $val);
                }else{
                    if($this->input->post("app_approve_reject") == 5){
                        $this->db->set('apply_for_approve_reject_status', 1);
                        $this->db->set('process_status_id_fk', $val);
                    }else{
                        $this->db->set('apply_for_approve_reject_status', NULL);
                        $this->db->set('process_status_id_fk', 0);
                    }
                }
                //Added by Waseem on 31-08-2021
				
                $this->db->where('assessor_registration_jobrole_sector_map_id_pk', $key);
                $this->db->where('MD5(CAST(assessor_registration_details_fk as character varying)) =', $condition_array['assessor_id_hash']);
                $this->db->where('assessor_registration_application_no', $condition_array['application_no']);
                $this->db->update('council_assessor_registration_jobrole_sector_map');
            }

            //certificate approve reject
            foreach($cf_array as $key => $val){
                $this->db->set('process_status_id_fk', $val);
                $this->db->where('council_ssc_wbsctvesd_certified_map_id_pk', $key);
                $this->db->where('MD5(CAST(assessor_registration_details_fk as character varying)) =', $condition_array['assessor_id_hash']);
                $this->db->where('assessor_registration_application_no', $condition_array['application_no']);
                $this->db->update('council_assessor_ssc_wbsctvesd_certified_map');
            }
            
            //application status change
            if($this->session->stake_id_fk == 4){
                $this->db->set('process_status_id_fk', 4);
            } else {
                
                //Added by Waseem on 31-08-2021
                $this->db->set('process_status_id_fk', $this->input->post('app_approve_reject'));
                if($this->input->post("app_approve_reject") == 5){
                    $this->db->set('approve_status', 1);
                }else{
                    $this->db->set('final_submission_status', NULL);
                }

                //Added by Waseem on 31-08-2021
            }
            $this->db->where('assessor_registration_application_nubmer_id_pk', $condition_array['application_nubmer_id']);
            $this->db->where('MD5(CAST(assessor_registration_details_fk as character varying)) =', $condition_array['assessor_id_hash']);
            $this->db->where('assessor_registration_application_no', $condition_array['application_no']);
            $this->db->update('council_assessor_registration_application_nubmer');

            


            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            }

            /*echo "<pre>";
            print_r($course_array);
            echo "</pre>";

            echo "<pre>";
            print_r($cf_array);
            echo "</pre>";

            echo "<pre>";
            print_r($full_post);
            echo "</pre>";

            echo "<pre>";
            print_r($condition_array);
            echo "</pre>";*/
        }
		
	//pdf download for other jobrole module
    public function doc_file($id_hash = NULL,$app_no = NULL){
        $query = $this->db->select("certificate_file")
            ->from("council_assessor_registration_document_map")
            ->where(
                array(
                    "MD5(CAST(council_assessor_registration_document_map_id_pk as character varying)) = " => $id_hash,
                    "assessor_registration_application_no" => $app_no
                )
            )->get();
            return $query->result_array();

    }
    public function work_experience_file($id_hash = NULL,$app_no = NULL){
        $query = $this->db->select("upload_doc")
            ->from("council_assessor_work_experience_map")
            ->where(
                array(
                    "MD5(CAST(assessor_work_experience_id_pk as character varying)) = " => $id_hash,
                    "assessor_registration_application_no" => $app_no
                )
            )->get();
            return $query->result_array();
        
    }
    public function assessor_exp_file($id_hash = NULL,$app_no = NULL){
        $query = $this->db->select("exp_as_assessor_doc")
        ->from("council_assessor_registration_assessor_expert_map")
        ->where(
            array(
                "MD5(CAST(assessor_registration_assessor_expert_map_id_pk as character varying)) = " => $id_hash,
                "assessor_registration_application_no" => $app_no
            )
        )->get();
        return $query->result_array();
        
    }
    public function ssc_certificate_file($id_hash = NULL,$app_no = NULL){
        $query = $this->db->select("toa_certificate")
        ->from("council_assessor_ssc_wbsctvesd_certified_map")
        ->where(
            array(
                "MD5(CAST(council_ssc_wbsctvesd_certified_map_id_pk as character varying)) = " => $id_hash,
                "assessor_registration_application_no" => $app_no
            )
        )->get();
        return $query->result_array();
    }
	
	// Added by Waseem 
	public function get_all_course(){
        $query = $this->db->select("sector_id_pk,sector_code,sector_name")
            ->from("council_sector_master")
            ->where(
                array(
                    "active_status" => 1,
                    "process_status_fk" => 5
                )
            )
            ->order_by("sector_name","ASC")
            ->get();
        return $query->result_array();
    }
}