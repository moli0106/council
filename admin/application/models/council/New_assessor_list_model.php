<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_assessor_list_model extends CI_Model {
	
   public function get_assessor($limit = NULL, $offset = NULL){
    $query = $this->db->select("assessor.assessor_registration_details_pk,assessor.fname,assessor.mname,assessor.lname,assessor.pan,assessor.assessor_code,salutation.salutation_desc,assessor.mobile_no,assessor.process_status_id_fk,process.process_name")
        ->from("council_assessor_registration_details as assessor")
        ->join("council_salutation_master as salutation","assessor.salutation_id_fk = salutation.salutation_id_pk","LEFT")
        ->join("council_process_master as process","assessor.process_status_id_fk = process.process_id_pk","LEFT")
        ->where(
            array(
                "assessor.active_status" => 1,
                "assessor.final_flag" => TRUE
            )
        )
        ->limit($limit, $offset)
        ->order_by("final_submission_time","ASC")
        ->get();
    return $query->result_array();
   }

   public function assessor_count(){
        $query = $this->db->select("count(assessor_registration_details_pk)")
            ->from("council_assessor_registration_details")
            ->where(
                array(
                    "active_status" => 1,
                    "final_flag" => TRUE
                )
            )
            ->get();
        return $query->result_array();
   }

   public function get_assessor_search($pan_no = NULL ,$ssc_wbsctvesd_certified = NULL) {
        
    $this->db->select("assessor.assessor_registration_details_pk,assessor.fname,assessor.mname,assessor.lname,assessor.pan,assessor.assessor_code,salutation.salutation_desc,assessor.mobile_no,assessor.process_status_id_fk,process.process_name");
        $this->db->from("council_assessor_registration_details as assessor");
        $this->db->join("council_salutation_master as salutation","assessor.salutation_id_fk = salutation.salutation_id_pk","LEFT");
        $this->db->join("council_process_master as process","assessor.process_status_id_fk = process.process_id_pk","LEFT");
        
        $this->db->where("assessor.active_status", 1);
        $this->db->where("assessor.final_flag", TRUE);
        if($pan_no != NULL){
            $this->db->where('assessor.pan', $pan_no);
        }
		if($ssc_wbsctvesd_certified != NULL){
            $this->db->where('assessor.ssc_wbsctvesd_certified', $ssc_wbsctvesd_certified);
        }
        $this->db->order_by('final_submission_time','ASC');
        $query =  $this->db->get();
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

    //added parag 12-01-2021
    public function get_vtc_pbssd($assessor_id_hash = NULL){
        $query = $this->db->select("map.working_map_id_pk,map.centre_code,map.centre_name,working.working_name")
            ->from("council_assessor_working_map as map")
            ->join("council_assessor_working_master as working","map.working_id_fk = working.working_id_pk")
            ->where(
                array(
                    "working.active_status" => 1,
                    "MD5(CAST(map.assessor_id_fk as character varying)) = " => $assessor_id_hash
                )
            )
            ->get();
            return $query->result_array();
    }

    public function get_ssc_wbsctvesed_certificate($assessor_registration_application_no = NULL,$assessor_id = NULL){
		$query = $this->db->select('map.council_ssc_wbsctvesd_certified_map_id_pk,course.course_name,course.course_code,map.ssc_wbsctvesd_certified,map.attended_any_toa,map.cf_validity')
			->from('council_assessor_ssc_wbsctvesd_certified_map AS map')
			->join('council_course_master as course','map.course_id_fk = course.course_id_pk')
			->where('map.assessor_registration_details_fk',$assessor_id)
			->where('map.active_status ',1)
			->where('map.assessor_registration_application_no =',$assessor_registration_application_no)
			->get();
		return $query->result_array();
	}

    public function get_jobroles($assessor_id_hash = NULL,$assessor_registration_application_no = NULL){
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
			
			apply_for_assessor_status,
            apply_for_expert_status,
            expart_type_academic_status,
            expart_type_industrial_status,
            apply_for_trainer_of_trainer_status,
            apply_for_approve_reject_status
            ")
			//Added by Waseem on 02-02-2021
            ->from("council_assessor_registration_jobrole_sector_map as jobrole")
            ->join("council_course_master as course","jobrole.course_id_fk = course.course_id_pk")
            ->join("council_sector_master as sector","course.sector_id_fk = sector.sector_id_pk")
            ->join("council_qualification as quali","jobrole.apply_highest_quali = quali.qualification_id_pk","LEFT")
            ->join("council_domain_master as domain","jobrole.domain_id_fk = domain.domain_id_pk","LEFT")
            ->where(
                array(
                    "jobrole.active_status" => 1,
                    "MD5(CAST(jobrole.assessor_registration_details_fk as character varying)) =" => $assessor_id_hash,
                    "jobrole.assessor_registration_application_no" => $assessor_registration_application_no
                )
            )
            ->get();
        return $query->result_array();
    }


    public function get_jobroles_apply_for($assessor_id_hash = NULL){
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
            process_name
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
                    "MD5(CAST(jobrole.assessor_registration_details_fk as character varying)) =" => $assessor_id_hash
                )
            ) //25-03-2021 updated parag start
            ->group_start()
                    ->or_where(
                        array(
                            "jobrole.assessor_registration_application_no" => 1,
                            "jobrole.assessor_registration_application_no IS NULL" => NULL
                        )
                    )
            ->group_end()
            //25-03-2021 updated parag end
            ->get();
        return $query->result_array();
    }
	
	
	 public function get_jobroles_apply_for_accept_reject($assessor_id_hash = NULL){
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
            process_name
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
                    "jobrole.process_status_id_fk" => 5,
                    "MD5(CAST(jobrole.assessor_registration_details_fk as character varying)) =" => $assessor_id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_certificates($assessor_id_hash = NULL,$assessor_registration_application_no=NULL){
        $query = $this->db->select("council_assessor_registration_certified_map_id_pk,assessing_body,certificate_number")
            ->from("council_assessor_registration_certified_map")
            ->where(
                array(
                    "active_status" => 1,
                    "MD5(CAST(assessor_registration_details_fk as character varying)) =" => $assessor_id_hash,
                    "assessor_registration_application_no" => $assessor_registration_application_no
                )
            )
            ->get();
        return $query->result_array();
    }
    public function get_work_exp($assessor_id_hash = NULL,$assessor_registration_application_no=NULL){
        $query = $this->db->select("assessor_work_experience_id_pk,assessor_id_fk,organisation_name,area_of_work,no_of_years,no_of_months")
            ->from("council_assessor_work_experience_map")
            ->where(
                array(
                    "active_status" => 1,
                    "MD5(CAST(assessor_registration_details_fk as character varying)) =" => $assessor_id_hash,
                    "assessor_registration_application_no" => $assessor_registration_application_no
                )
            )
            ->get();
        return $query->result_array();
    }
    public function get_assessor_expert($assessor_id_hash = NULL,$assessor_registration_application_no =NULL){
        $query = $this->db->select("
            asex.assessor_registration_assessor_expert_map_id_pk,
            asex.nsqf_level,
            exp_as_assessor_work_years,
            asex.exp_as_assessor_work_months, 
            course.course_name, course.course_code")
            ->from("council_assessor_registration_assessor_expert_map as asex")
            ->join("council_course_master course","asex.exp_as_assessor_job_role_id_fk = course.course_id_pk","LEFT")
            ->where(
                array(
                    "asex.active_status" => 1,
                    "MD5(CAST(asex.assessor_registration_details_fk as character varying)) =" => $assessor_id_hash,
                    "asex.assessor_registration_application_no" => $assessor_registration_application_no
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_cv($id_hash =  NULL){
        $query = $this->db->select("cv")
            ->from("council_assessor_registration_details")
            ->where(
                array(
                    "MD5(CAST(assessor_registration_details_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
	//added parag 12-01-2021
    public function get_pan($id_hash =  NULL){
        $query = $this->db->select("pan_file")
            ->from("council_assessor_registration_details")
            ->where(
                array(
                    "MD5(CAST(assessor_registration_details_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
    public function assessor_registration_cert($id_hash =  NULL){
        $query = $this->db->select("certificate_doc")
            ->from("council_assessor_registration_certified_map")
            ->where(
                array(
                    "MD5(CAST(council_assessor_registration_certified_map_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
    public function assessor_work_exp($id_hash =  NULL){
        $query = $this->db->select("upload_doc")
            ->from("council_assessor_work_experience_map")
            ->where(
                array(
                    "MD5(CAST(assessor_work_experience_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
    public function assessor_experience($id_hash =  NULL){
        $query = $this->db->select("exp_as_assessor_doc")
            ->from("council_assessor_registration_assessor_expert_map")
            ->where(
                array(
                    "MD5(CAST(assessor_registration_assessor_expert_map_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
    public function get_assessor_id($id_hash =  NULL){
        $query = $this->db->select("assessor_registration_details_fk")
            ->from("council_assessor_registration_jobrole_sector_map")
            ->where(
                array(
                    "MD5(CAST(assessor_registration_jobrole_sector_map_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
    public function approve_reject($array = NULL, $id_hash = NULL){
        $this->db->where('md5(cast(assessor_registration_details_pk as character varying)) =', $id_hash);
        return $this->db->update('council_assessor_registration_details', $array);
    }

    public function course_approve_reject($array = NULL, $id_hash = NULL){
        $this->db->where('md5(cast(assessor_registration_jobrole_sector_map_id_pk as character varying)) =', $id_hash);
        return $this->db->update('council_assessor_registration_jobrole_sector_map', $array);
    }

    public function update_apply_for_status_data($assessor_apply_for_data = NULL,$id_hash = NULL){
		$this->db->where('md5(CAST(assessor_registration_details_fk AS character varying)) =', $id_hash);
		return $this->db->update('council_assessor_registration_jobrole_sector_map',$assessor_apply_for_data);
	}

    public function get_toa_certificate($id_hash =  NULL){
        $query = $this->db->select("toa_certificate")
            ->from("council_assessor_registration_details")
            ->where(
                array(
                    "MD5(CAST(assessor_registration_details_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
            return $query->result_array();
    }
	
	public function ssc_wbsctvesd_details($id_hash = NULL){
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
                "MD5(CAST(assessor.assessor_registration_details_pk as character varying)) =" => $id_hash
            )
        )
        ->get();
        return $query->result_array();
    }

    public function ssc_wbsctvesd_status_update($id_hash, $array)
    {
        $this->db->where('md5(cast(assessor_registration_details_pk as character varying)) =', $id_hash);
        return $this->db->update('council_assessor_registration_details', $array);
    }
}