<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Add_question_jexpo_model extends CI_Model {
	
	
	public function getAllExamType($stake_details_id_fk){
		$query = $this->db->select('b.exam_type_id_pk,b.exam_type_name')
		->from('council_question_creator_moderator_jexpo_details as a')
		->join('council_exam_type_master as b','a.exam_type_id_fk=b.exam_type_id_pk')
		//->where('creator_moderator_id_pk',$stake_id_fk)
		->where('a.creator_moderator_id_pk',$stake_details_id_fk)
		->order_by('exam_type_name')
	   	->get();
	   	return $query->result_array();
	}
	
	public function get_subject_query($exam_type,$stake_details_id_fk){
		$query = $this->db->select('b.subject_id_pk,b.subject_name')
		->from('council_question_creator_moderator_jexpo_details as a')
		->join('council_exam_type_subject_mapping as b','a.subject_id_fk=b.subject_id_pk')
		->where('b.exam_type_id_fk',$exam_type)
		->where('a.creator_moderator_id_pk',$stake_details_id_fk)
		->order_by('subject_name')
	   	->get();
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
		->from('council_question_level_master_for_jexpo')
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
		$this->db->insert('council_question_bank_jexpo_voclet', $data);
		return $this->db->insert_id();
		
		// //echo $this->db->last_query(); die;

		// $this->db->trans_complete(); 
		// if ($this->db->trans_status() === FALSE) {
		// 	$this->db->trans_rollback();
		// 	return FALSE;
		// } 
		// else {
		// 	$this->db->trans_commit();
		// 	return TRUE;
		// }
	}





	public function get_question_pattern_query(){
		$query = $this->db->select('*')
		->from('council_question_option_pattern_master')
		->where('active_status',1)
		//->order_by('course_name')
	   	->get();
		//echo $this->db->last_query(); 
	   	return $query->result_array();
	}


	public function question_language_submit($data){
		
		$this->db->trans_start();
		$this->db->insert('council_question_bank_jexpo_voclet_english_lang', $data);
		
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

	function get_duplicate_eng_question($question=NULL)
	{
		//$question_dtls = $this->get_question_details_by_id($question_id_hash);
		$encrypt_question=openssl_encrypt($question, $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
		$query = $this->db->select('eng_question.question_id_fk')
						  ->from('council_question_bank_jexpo_voclet_english_lang as eng_question')
						  ->where(
						  	array(  
						  		'eng_question.question'	=> $encrypt_question
						  	)
						  )
						  //->where_not_in('eng_question.question_id_fk',$question_dtls[0]['question_id_fk'])
						  ->get();
		return $query->result_array();
	}


	
}
