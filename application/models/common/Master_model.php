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

	/*
		function related to elearning module begins from here...
	*/
	
	
	
	
	
}