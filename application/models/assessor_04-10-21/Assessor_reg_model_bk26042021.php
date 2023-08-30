<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Assessor_reg_model extends CI_Model
{
	public function get_data($quali,$domain_exp,$domain){

		
		$query = $this->db->select("course.course_id_pk, course.sector_id_fk, course.course_code, course_name")
			->from("council_course_master as course")
			->join("council_course_qualification_map as map","course.course_id_pk = map.course_id_fk")
			->where(
				array(
					"map.qualification_id_fk" => $quali,
					"map.domain_specific_working_experience" => $domain_exp,
					"map.domain_id_fk" => $domain
				)
			)
			->order_by("course.course_name","ASC")
			->where("course.active_status",1)
			->get();
		return $query->result_array();

	}

	public function get_sector_and_other($course_id_hash = NULL){
			$query = $this->db->select("course.course_id_pk,sector.sector_id_pk,sector.sector_code, sector.sector_name, course.minimum_educationl_qualification, course.domain_specific_working_experience, course.assessment_experience, course.trainer_eligibility_criteria")
			->from("council_sector_master as sector")
			->join("council_course_master as course","course.sector_id_fk = sector.sector_id_pk")
			->where(
				array(
					"course.course_id_pk" => $course_id_hash,
					"sector.active_status" => 1,
					"sector.active_status" => 1
				)
			)
			->get();
		return $query->result_array();
	}
	public function get_qualification(){
		$query = $this->db->select("*")
			->from("council_qualification")
			//->order_by("qualification","ASC")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_domain_experiance($qualification_id = NULL){
		//$this->output->enable_profiler();
		$query = $this->db->select("
		distinct(domain_map.domain_specific_working_experience)
		")
			->from("council_course_qualification_map as domain_map")
			//->join("council_domain_master as domain"," domain_map.domain_id_fk = domain.domain_id_pk")
			->where("domain_map.qualification_id_fk",$qualification_id)
			->where("domain_map.active_status",1)
			->get();
		return $query->result_array();
	}
	
	//Saltuations
	public function get_salutation(){
		//$this->output->enable_profiler();
		$query = $this->db->select("*")
			->from("council_salutation_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}
	//Saltuations
	public function get_gender(){
		//$this->output->enable_profiler();
		$query = $this->db->select("*")
			->from("council_gender_master")
			//->where("active_status",1)
			->get();
		return $query->result_array();
	}
	//Language
	public function get_language(){
		//$this->output->enable_profiler();
		$query = $this->db->select("*")
			->from("council_language_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}
	//Language
	public function get_id_type(){
		//$this->output->enable_profiler();
		$query = $this->db->select("*")
			->from("council_id_type_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	//insert 
	public function insert_assessor_draft($assessor_basic = NULL){
		$this->db->insert('council_assessor_registration_draft', $assessor_basic);
		return $this->db->insert_id();
	}

	public function get_draft_info($insert_id_hash = NULL){
		$query = $this->db->select("

			ad.assessor_registration_draft_id_pk,
			salutation.salutation_desc,
			ad.fname,ad.mname,
			ad.lname,
			gender.gender_description,
			ad.dob,
			lang.language_desc,
			td_type.id_type_name,
			ad.id_no_alt,
			ad.mobile_no,
			ad.landline_no,
			ad.email_id,
			ad.pan

			")
			->from("council_assessor_registration_draft as ad")
			->join("council_salutation_master as salutation","ad.salutation_id_fk = salutation.salutation_id_pk","LEFT")
			->join("council_gender_master as gender","ad.gender_id_fk = gender.gender_id_pk","LEFT")
			->join("council_language_master as lang","ad.language_id_fk = lang.language_id_pk","LEFT")
			->join("council_id_type_master as td_type","ad.id_type_alt_id_fk = td_type.id_type_id_pk","LEFT")
			->where("ad.active_status",1)
			->where("MD5(CAST(ad.assessor_registration_draft_id_pk as character varying)) =",$insert_id_hash)
			->get();
		return $query->result_array();
	}

	public function get_assessor_draft($insert_id_hash = NULL){
		$query = $this->db->select("salutation_id_fk, fname, mname, lname, gender_id_fk, dob, language_id_fk, pan, id_type_alt_id_fk, id_no_alt, mobile_no, landline_no, email_id, entry_time, entry_ip,active_status,pan_file")
			->from("council_assessor_registration_draft")
			->where("MD5(CAST(assessor_registration_draft_id_pk as character varying)) =", $insert_id_hash)
			->get();
		return $query->result_array();
	}

	public function assessor_migrate($assessor_draft_array = NULL, $insert_id_hash = NULL){
	
		//query 1
		$this->db->insert('council_assessor_registration_details', $assessor_draft_array);
		
		//query 2
		$this->db->set('active_status', 0);
		$this->db->where('MD5(CAST(assessor_registration_draft_id_pk as character varying)) =', $insert_id_hash);
		$this->db->update('council_assessor_registration_draft');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return 0;
		} else {
			$this->db->trans_commit();
			return $this->db->insert_id();
		}
	}
	public function get_states(){
		$query = $this->db->select("*")
			->from("pbssd_state_master")
			->where("state_id_pk",19)
			->get();
		return $query->result_array();
	}
	public function get_districts(){
		$query = $this->db->select("*")
			->from("pbssd_district_master")
			->where("state_id_fk",19)
			->get();
		return $query->result_array();
	}
	public function get_blocks($dist_id = NULL){
		$query = $this->db->select("*")
			->from("pbssd_block_municipality_master")
			->where("district_id_fk",$dist_id)
			->get();
		return $query->result_array();
	}
	public function get_employments(){
		$query = $this->db->select("*")
			->from("council_employment_status")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_all_courses(){
		$query = $this->db->select("*")
			->from("council_course_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_assessor_id($assessor_registration_id_hash = NULL){
		$query = $this->db->select("assessor_registration_details_pk,assessor_code,email_id")
			->from("council_assessor_registration_details")
			->where(
				array(
					"active_status" => 1,
					//"assessor_code IS NULL" => NULL,
					"MD5(CAST(assessor_registration_details_pk as character varying)) =" => $assessor_registration_id_hash
				)
			)
			->get();
		return $query->result_array();
	}

	//update and insert all data
	public function update_assessor_data($assessor_main_data,$assessor_id,$jobrole_sector_data,$certified_data,$work_experience_data,$assessor_experience_data){
		$this->db->trans_begin();

		$this->db->where('assessor_registration_details_pk', $assessor_id);
		$this->db->update('council_assessor_registration_details', $assessor_main_data);

		$this->db->insert_batch('council_assessor_registration_jobrole_sector_map', $jobrole_sector_data);

		if(count($certified_data)){
			$this->db->insert_batch('council_assessor_registration_certified_map', $certified_data);
		}

		$this->db->insert_batch('council_assessor_work_experience_map', $work_experience_data);
		$this->db->insert_batch('council_assessor_registration_assessor_expert_map', $assessor_experience_data);

		if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
		}
	}
	public function get_all_domains(){
		$query = $this->db->select("*")
			->from("council_domain_master")
			->order_by("domain_name","asc")
			->get();
		return $query->result_array();
	}

	public function create_login($login_array = NULL){
		$this->db->insert('council_stake_holder_login', $login_array);
		return $this->db->insert_id();
	}
	
	//check duplicate //22-02-2021 start
	public function check_duplicate($duplicate_check_array = NULL){
		
		$query = $this->db->select("mobile_no,email_id,email_id,pan")
			->from("council_assessor_registration_details")
			->where("mobile_no",$duplicate_check_array['mobile_no'])
			->or_where("email_id",$duplicate_check_array['email_id'])
			->or_where("pan",$duplicate_check_array['pan'])
			->get();
		return $query->result_array();
	
	}
	//check duplicate //22-02-2021 end
		
	
}