<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Master_model extends CI_Model {
	
	function get_gender(){
		$query = $this->db->select('*')
			->from('elearning_gender_master')
			->get();
		return $query->result_array();
	}
	
	
	/*
		function related to elearning module begins from here...
	*/

	function getDegrees()
	{
		$query = $this->db->select("code
		,degree_name")
		->from("elearning_degree_code_master")
		->get();
		return $query->result();
	}

	function getCourses($degree_id)
	{
		$query = $this->db->select("code
		,degree_code
		,course_name")
		->from("elearning_course_code_master")
		->where("degree_code",$degree_id)
		->get();
		return $query->result();
	}

	function getSubjects($course_id)
	{
		$query = $this->db->select("code
		,degree_code
		,course_code
		,subject_name")
		->from("elearning_subject_code_master")
		->where("course_code",$course_id)
		->get();

		//print $this->db->last_query();
		return $query->result();
	}

	
	function getLevels($subject_id)
	{
		$query = $this->db->select("code
		,degree_code
		,course_code
		,subject_code
		,level_name")
		->from("elearning_level_code_master")
		->where("subject_code",$subject_id)
		->get();

		//print $this->db->last_query();
		return $query->result();
	}


	function getCollege()
	{
		$query = $this->db->select("institute_name
		,institute_id_pk")
		->from("elearning_wbtetsd_institutes")
		->where(
			array('active_status' => 1)
		)
		->order_by('institute_name')
		->get();
		return $query->result_array();
	}



	
	public function get_course_query($degree_code){
		$query = $this->db->select('*')->from('elearning_course_code_master')
		->where('degree_code',$degree_code)
		->order_by('course_name')
		   ->get();
		   return $query->result_array();
	}

	public function get_semester_query($course_code){
		$query = $this->db->select('*')->from('elearning_semester_code_master')
		->where('course_code',$course_code)
		->order_by('semester_name')
		   ->get();
		   return $query->result_array();
	}

	public function get_subject_query($semester_id){
		$query = $this->db->select('*')->from('elearning_subject_code_master')
		->where('semester_code',$semester_id)
		->order_by('subject_name')
		   ->get();
		   return $query->result_array();
	}


	public function get_module_query($subject_code){
		$query = $this->db->select('*')->from('elearning_module_code_master')
		->where('subject_code',$subject_code)
		->order_by('module_name')
		   ->get();
		   return $query->result_array();
	}


	public function get_level_query($module_code){
		$query = $this->db->select('*')->from('elearning_level_code_master')
		->where('module_code',$module_code)
		->order_by('level_name')
		   ->get();
		//echo $this->db->last_query(); 
		   return $query->result_array();
	}

	/*
		function related to elearning module begins from here...
	*/
	

	
}