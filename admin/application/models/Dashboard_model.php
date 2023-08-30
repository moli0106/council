<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Dashboard_model extends CI_Model {

	public function getTotalAvailableTest()
	{
		$query=$this->db->select("distinct(degree_code,course_code,subject_code,level_code)")
		->from("elearning_question_bank")
		->get();
		return $query->result_array();
	}
	
	public function getTotalAttemptedTest()
	{
		$query=$this->db->select("count(examinee_id)")
		->from("elearning_exam_details")
		->where("examinee_id",$this->session->userdata('stake_details_id_fk'))
		->get();
  
	  	return $query->result_array();
	}
	
	public function getHighestMarksSecured()
	{
		$query=$this->db->select("max(marks)")
		->from("elearning_exam_details")
		->where("examinee_id",$this->session->userdata('stake_details_id_fk'))
		->get();
  
	  	return $query->result_array();
	}	
	
	public function getTotalQuestion()
	{
		$query=$this->db->select("count(question_no)")
		->from("elearning_question_bank")
		//->where("examinee_id",$this->session->userdata('stake_details_id_fk'))
		->get();
  
	  	return $query->result_array();
	}
}
