<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Add_question_model extends CI_Model {
	
	
	public function get_sectors_query($stake_details_id_fk){
		$query = $this->db->select('b.sector_id_pk,b.sector_code,b.sector_name')
		->from('council_question_creator_moderator_details as a')
		->join('council_sector_master as b','a.sector_id_fk=b.sector_id_pk')
		//->where('creator_moderator_id_pk',$stake_id_fk)
		->where('a.creator_moderator_id_pk',$stake_details_id_fk)
		->order_by('sector_name')
	   	->get();
	   	return $query->result_array();
	}
	
	public function get_course_query($sector_id){
		$query = $this->db->select('course_id_pk,course_code,course_name')
		->from('council_course_master')
		->where('sector_id_fk',$sector_id)
		->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}

	public function get_programmes_query(){
		$query = $this->db->select('*')
		->from('council_programme_master')
		->where('active_status',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}
	public function get_levels_query(){
		$query = $this->db->select('*')
		->from('council_question_level_master')
		->where('active_status',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}
	public function get_questions_type_query(){
		$query = $this->db->select('*')
		->from('council_question_type_master')
		->where('active_status',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}

	public function get_questions_type_trainee_query(){
		$query = $this->db->select('*')
		->from('council_question_type_master')
		->where('active_status',1)
		->where('question_type_id_pk',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}
	public function get_questions_for_query(){
		$query = $this->db->select('*')
		->from('council_question_for_master')
		->where('active_status',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}

	public function get_questions_module_query(){
		$query = $this->db->select('*')
		->from('council_question_module_master')
		->where('active_status',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}

	public function question_submit($data){
		
		$this->db->trans_start();
		$this->db->insert('council_question_bank', $data);
		
		//echo $this->db->last_query(); die;

		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}
	}












	
	
	public function get_max_quest_no(){
		
		$query = $this->db->select('max(question_no)as max_id')->from('elearning_question_bank')
	   			 ->get();
	   	return $query->result_array();
		
	}

	
}
