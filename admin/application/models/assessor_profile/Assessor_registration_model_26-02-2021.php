<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 * Course master entry model
 * @category	model
 * @author		NIC PBSSD Team
 *
 */
class Assessor_registration_model extends CI_Model {



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

	public function get_assessor_application($app_id_hash = NULL){
		$query = $this->db->select('*')
			->from('council_assessor_registration_details AS crd')
			//->join('pbssd_centre_entity_master AS cem','crd.centre_entity_id_fk = cem.centre_entity_id_pk','left')
			->where('md5(CAST(assessor_registration_details_pk as character varying)) =',$app_id_hash)
			->get();
		return $query->result_array();
	}

	public function update_assessor_details($basic_array = NULL,$insert_id_hash = NULL){
		$this->db->where('md5(CAST(assessor_registration_details_pk AS character varying)) =', $insert_id_hash);
		return $this->db->update('council_assessor_registration_details',$basic_array);
	}


	public function get_employments(){
		$query = $this->db->select("*")
			->from("council_employment_status")
			->where("active_status",1)
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

	public function get_all_domains(){
		$query = $this->db->select("*")
			->from("council_domain_master")
			->order_by("domain_name","asc")
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

public function get_states(){
	$query = $this->db->select("*")
		->from("council_state_master")
		//->where("state_id_pk",19)
		->order_by('state_name')
		->get();
	return $query->result_array();
}
public function get_districts($state_id=NULL){
	$query = $this->db->select("*")
		->from("council_district_master")
		->where("state_id_fk",$state_id)
		->where("active_status",1)
		->order_by("district_name")
		->get();
	return $query->result_array();
}
public function get_blocks($dist_id = NULL){
	$query = $this->db->select("*")
		->from("council_block_municipality_master")
		->where("district_id_fk",$dist_id)
		->where("active_status",1)
		->order_by("block_municipality_name")
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

public function insert_work_experience($work_experience_array){

	$this->db->insert('council_assessor_work_experience_map', $work_experience_array);
	return $this->db->insert_id();
}

public function get_work_experiences(){
	$query = $this->db->select("*")
	->from("council_assessor_work_experience_map")
	->where("active_status",1)
	->where("assessor_registration_details_fk",$this->session->userdata('stake_details_id_fk'))
	->get();
return $query->result_array();

}
public function get_work_exp_file_content($doc_id_pk){
	$this->db->select("upload_doc");
	$this->db->from("council_assessor_work_experience_map");
	$this->db->where("assessor_work_experience_id_pk",$doc_id_pk);
	//$this->db->limit($limit,$offset);
	$query = $this->db->get();
	return $query->result_array(); 

}

public function delete_work_exp_dtls($id_hash = NULL)
	{
		$asseaor_id=md5($this->session->userdata('stake_details_id_fk'));
		if($id_hash != NULL && strlen($id_hash) == 32)
		{
			$this->db->where('md5(CAST(assessor_work_experience_id_pk AS character varying)) =', $id_hash);
			$this->db->where('md5(CAST(assessor_registration_details_fk as character varying)) =', $asseaor_id);
			$this->db->delete('council_assessor_work_experience_map');
			$eff_rows = $this->db->affected_rows();
			
			if($eff_rows>0)
			{
				if($this->get_count_work_exp_count($asseaor_id) > 0 )
				{
					return $eff_rows;
				} 
				else 
				{
					$this->update_assessor_reg_work_exp_flag(FALSE, $asseaor_id);
					return $eff_rows;
				}
			} 
			else 
			{
				return $eff_rows;
			}
		} 
		else 
		{
			return FALSE;
		}
		
	}

	public function update_assessor_reg_work_exp_flag($flag = TRUE, $hash_id=NULL)
	{
		$this->db->where('md5(CAST(assessor_registration_details_pk as character varying)) =', $hash_id);
		$this->db->update('council_assessor_registration_details', array('work_experience_flag' => $flag));
		return $this->db->affected_rows();	
	}
	 public function get_count_work_exp_count($asseaor_id=NULL)
	 {
	 	$query = $this->db->select('assessor_work_experience_id_pk, assessor_registration_details_fk')
						->from('council_assessor_work_experience_map')
						->where('md5(CAST(assessor_registration_details_fk as character varying)) =', $asseaor_id)
						->get();
		return $query->num_rows();
	 }






	 public function get_assessor_experience($app_id_hash = NULL){
		$query = $this->db->select('*,b.course_id_pk,b.course_code,b.course_name')
			->from('council_assessor_registration_assessor_expert_map as a')
			->join('council_course_master AS b','b.course_id_pk = a.exp_as_assessor_job_role_id_fk','left')
			->where('md5(CAST(assessor_registration_details_fk as character varying)) =',$app_id_hash)
			->get();
		return $query->result_array();
	}
	public function insert_assessor_experience($work_experience_array){

		$this->db->insert('council_assessor_registration_assessor_expert_map', $work_experience_array);
		return $this->db->insert_id();
	}

	public function get_assessor_exp_file_content($doc_id_pk){
		$this->db->select("exp_as_assessor_doc");
		$this->db->from("council_assessor_registration_assessor_expert_map");
		$this->db->where("assessor_registration_assessor_expert_map_id_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}

	public function delete_assessor_exp_dtls($id_hash = NULL)
	{
		$asseaor_id=md5($this->session->userdata('stake_details_id_fk'));
		if($id_hash != NULL && strlen($id_hash) == 32)
		{
			$this->db->where('md5(CAST(assessor_registration_assessor_expert_map_id_pk AS character varying)) =', $id_hash);
			$this->db->where('md5(CAST(assessor_registration_details_fk as character varying)) =', $asseaor_id);
			$this->db->delete('council_assessor_registration_assessor_expert_map');
			$eff_rows = $this->db->affected_rows();
			
			if($eff_rows>0)
			{
				if($this->get_count_assessor_work_exp_count($asseaor_id) > 0 )
				{
					return $eff_rows;
				} 
				else 
				{
					$this->update_assessor_reg_as_assessor_exp_flag(FALSE, $asseaor_id);
					return $eff_rows;
				}
			} 
			else 
			{
				return $eff_rows;
			}
		} 
		else 
		{
			return FALSE;
		}
		
	}

	public function update_assessor_reg_as_assessor_exp_flag($flag = TRUE, $hash_id=NULL)
	{
		$this->db->where('md5(CAST(assessor_registration_details_pk as character varying)) =', $hash_id);
		$this->db->update('council_assessor_registration_details', array('experience_assessor_flag' => $flag));
		return $this->db->affected_rows();	
	}
	 public function get_count_assessor_work_exp_count($asseaor_id=NULL)
	 {
	 	$query = $this->db->select('assessor_registration_assessor_expert_map_id_pk, assessor_registration_details_fk')
						->from('council_assessor_registration_assessor_expert_map')
						->where('md5(CAST(assessor_registration_details_fk as character varying)) =', $asseaor_id)
						->get();
		return $query->num_rows();
	 }


	 public function delete_assessor_professional_dtls($id_hash = NULL)
	{
		$asseaor_id=md5($this->session->userdata('stake_details_id_fk'));
		if($id_hash != NULL && strlen($id_hash) == 32)
		{
			$this->db->where('md5(CAST(working_map_id_pk AS character varying)) =', $id_hash);
			$this->db->where('md5(CAST(assessor_id_fk as character varying)) =', $asseaor_id);
			$this->db->delete('council_assessor_working_map');
			$eff_rows = $this->db->affected_rows();
			
			if($eff_rows>0)
			{
				if($this->get_count_assessor_professional_count($asseaor_id) > 0 )
				{
					return $eff_rows;
				} 
				else 
				{
					$this->update_assessor_reg_as_professional_flag(FALSE, $asseaor_id);
					return $eff_rows;
				}
			} 
			else 
			{
				return $eff_rows;
			}
		} 
		else 
		{
			return FALSE;
		}
		
	}

	public function update_assessor_reg_as_professional_flag($flag = TRUE, $hash_id=NULL)
	{
		$this->db->where('md5(CAST(assessor_registration_details_pk as character varying)) =', $hash_id);
		$this->db->update('council_assessor_registration_details', array('professional_details_flag' => $flag));
		return $this->db->affected_rows();	
	}
	 public function get_count_assessor_professional_count($asseaor_id=NULL)
	 {
	 	$query = $this->db->select('working_map_id_pk, assessor_id_fk')
						->from('council_assessor_working_map')
						->where('md5(CAST(assessor_id_fk as character varying)) =', $asseaor_id)
						->get();
		return $query->num_rows();
	 }


	//added Waseem 25-01-2021
	public function get_experience_domain($qualification_id_fk = NULL,$domain_exp=NULL){
		//$this->output->enable_profiler();
		$query = $this->db->select("distinct(domain.domain_id_pk), domain.domain_name")
			->from("council_domain_master as domain")
			->join("council_course_qualification_map as map","domain.domain_id_pk = map.domain_id_fk")
			->where(
				array(
					"map.qualification_id_fk" 					=> $qualification_id_fk,
					"map.domain_specific_working_experience" 	=> $domain_exp
				)
			)
			->get();
		return $query->result_array();
	}
	public function get_assessor_jobroles($assessor_registration_details_fk = NULL){
		$query = $this->db->select("map.course_id_fk,map.sector_id_fk,map.job_role_sp_quali,sector.sector_name")
			->from("council_assessor_registration_jobrole_sector_map as map")
			->join("council_course_master as course","map.course_id_fk = course.course_id_pk")
			->join("council_sector_master as sector","course.sector_id_fk = sector.sector_id_pk")
			->where(
				array(
					"map.active_status" => 1,
					"assessor_registration_details_fk" => $assessor_registration_details_fk
				)
			)
			->get();
		return $query->result_array();
	}

	public function update_course_data($assessor_main_data,$assessor_id,$jobrole_sector_data){
		$this->db->trans_begin();

		$this->db->where('assessor_registration_details_pk', $assessor_id);
		$this->db->update('council_assessor_registration_details', $assessor_main_data);

		$this->db->set('active_status', 0);
		$this->db->where('assessor_registration_details_fk', $assessor_id);
		$this->db->update('council_assessor_registration_jobrole_sector_map');

		$this->db->insert_batch('council_assessor_registration_jobrole_sector_map', $jobrole_sector_data);

		

		if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
		}
	}

	public function get_assessor_certificates($assessor_registration_details_fk = NULL){
		$query = $this->db->select("council_assessor_registration_certified_map_id_pk,assessing_body,certificate_number")
			->from("council_assessor_registration_certified_map")
			->where(
				array(
					"assessor_registration_details_fk" => $assessor_registration_details_fk,
					"active_status" => 1
				)
			)
			->get();
		return $query->result_array();
	}

	public function update_certificate_data($assessor_main_data,$assessor_id,$certificate_data){
		$this->db->trans_begin();

		$this->db->where('assessor_registration_details_pk', $assessor_id);
		$this->db->update('council_assessor_registration_details', $assessor_main_data);

		$this->db->set('active_status', 0);
		$this->db->where('assessor_registration_details_fk', $assessor_id);
		$this->db->update('council_assessor_registration_certified_map');

		if(count($certificate_data)){
		$this->db->insert_batch('council_assessor_registration_certified_map', $certificate_data);
		}

		

		if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return FALSE;
			} else {
				$this->db->trans_commit();
				return TRUE;
		}
	}

	public function get_cert_pdf($council_assessor_registration_certified_map_id_pk = NULL){
		$query = $this->db->select("certificate_doc")
			->from("council_assessor_registration_certified_map")
			->where(
				array(
					"council_assessor_registration_certified_map_id_pk" => $council_assessor_registration_certified_map_id_pk
				)
			)->get();
		return $query->result_array();
				
	}

	public function get_assessor_cv_file_content($asseaor_id){
		$this->db->select("cv");
		$this->db->from("council_assessor_registration_details");
		$this->db->where('md5(CAST(assessor_registration_details_pk as character varying)) =', $asseaor_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}

	public function get_assessor_photo_file_content($asseaor_id){
		$this->db->select("photo");
		$this->db->from("council_assessor_registration_details");
		$this->db->where('md5(CAST(assessor_registration_details_pk as character varying)) =', $asseaor_id);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}

	public function get_pan_card_file_content($asseaor_id
	){
		$this->db->select("pan_file");
		$this->db->from("council_assessor_registration_details");
		$this->db->where('md5(CAST(assessor_registration_details_pk as character varying)) =', $asseaor_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}






	public function get_assessor_working_with_centre($assessor_registration_details_fk = NULL){
		$query = $this->db->select("*")
			->from("council_assessor_working_map as map")
			->join("council_assessor_working_master as working_master","map.working_id_fk = working_master.working_id_pk")
			//->join("council_sector_master as sector","course.sector_id_fk = sector.sector_id_pk")
			->where(
				array(
					"map.active_status" => 1,
					"map.assessor_id_fk" => $assessor_registration_details_fk
				)
			)
			->get();
		return $query->result_array();
	}
	public function get_working_with_centre(){
		$query = $this->db->select("*")
			->from("council_assessor_working_master")
			->where(
				array(
					"active_status" => 1
				)
			)
			->order_by('working_id_pk')
			->get();
		return $query->result_array();
	}
	
	
	//Added by Waseem on 23-01-2021

	public function get_working_with_pbssd_vtc(){
		$query = $this->db->select("*")
			->from("council_assessor_working_master")
			->where(
				array(
					"active_status" => 1,
					"working_id_pk !="=> 3 
				)
			)
			->order_by('working_id_pk')
			->get();
		return $query->result_array();
	}

	//Added by Waseem on 23-01-2021

	public function insert_professional_details($work_experience_array){

		$this->db->insert('council_assessor_working_map', $work_experience_array);
		return $this->db->insert_id();
	}

	public function get_pbssd_centre($centre_code_hash = NULL){

        $query = $this->db->select('centre_id_pk as centre_id,centre_code as centre_code,centre_name as working_centre_name')
            ->from('pbssd_centre_reg_details')
            ->where(
                array(
                    "MD5(CAST(centre_code as character varying)) =" => $centre_code_hash
                )
            )->get();
        return $query->result_array();
	}
	
	public function get_vtc_centre($centre_code_hash = NULL){

        $query = $this->db->select('vtc_id_pk as centre_id,vtc_code as centre_code,institute_name as working_centre_name')
            ->from('council_vocational_training_centres')
            ->where(
                array(
                    "MD5(CAST(vtc_code as character varying)) =" => $centre_code_hash
                )
            )->get();
        return $query->result_array();
	}

	public function get_assessor_jobroles_for_assessor_experience($assessor_registration_details_fk = NULL){
		$query = $this->db->select("map.course_id_fk,map.sector_id_fk,map.job_role_sp_quali,sector.sector_name,map.apply_highest_quali,map.domain_exp,map.domain_id_fk")
			->from("council_assessor_registration_jobrole_sector_map as map")
			->join("council_course_master as course","map.course_id_fk = course.course_id_pk")
			->join("council_sector_master as sector","course.sector_id_fk = sector.sector_id_pk")
			->where(
				array(
					"map.active_status" => 1,
					"assessor_registration_details_fk" => $assessor_registration_details_fk
				)
			)
			->get();
		return $query->result_array();
	}
	public function get_all_courses_by_assessor($quali,$domain_exp,$domain){

		
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
}