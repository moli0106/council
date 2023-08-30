<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_seat_filling_model extends CI_Model
{ 
	public function fetch_institute_old()
	{

	$this->db->select('institute.college_id_pk,institute.college_name,institute.college_type,course.discipline_name');
	$this->db->from('council_polytechnic_spotcouncil_college_master as institute'); //JOIN VTC MASTER
	$this->db->join('council_polytechnic_spotcouncil_college_map_details as maping','maping.college_id_fk=institute.college_id_pk','LEFT');
	$this->db->join('council_polytechnic_spotcouncil_discipline_master as course','course.discipline_id_pk=maping.discipline_id_fk','LEFT');

	$query = $this->db->get()->result_array();
	return $query;	
	}
	public function fetch_institute()
	{

		$this->db->select('institute.vtc_id_pk,institute.vtc_name,institute.institute_category_id_fk,
		course.discipline_name,
		maping.discipline_id_fk,
		category.category_name');
		$this->db->from('council_polytechnic_spotcouncil_college_map_details as maping'); //JOIN VTC MASTER
		$this->db->join('council_affiliation_vtc_master as institute','maping.college_id_fk=institute.vtc_id_pk','LEFT');
		$this->db->join('council_qbm_discipline_master as course','course.discipline_id_pk=maping.discipline_id_fk','LEFT');
		$this->db->join('council_affiliation_institute_category_master as category','category.institute_category_id_pk=institute.institute_category_id_fk','LEFT');
		$this->db->group_by('maping.discipline_id_fk');
		$this->db->group_by('institute.vtc_id_pk');
		$this->db->group_by('institute.vtc_name');
		$this->db->group_by('institute.institute_category_id_fk');
		$this->db->group_by('course.discipline_name');
		$this->db->group_by('category.category_name');
		$this->db->order_by('institute.vtc_name');
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		return $query;	
	}
	
	public function insertData($arr)
	{

		$query=$this->db->insert_batch('council_jexpo_seat_booking',$arr);
		return $query;	
	}

	public function delete_data($id){
		$this->db->where('student_id', $id);
		$query=$this->db->delete('council_jexpo_seat_booking');
		return $query;
	}

	public function fetch_data($student_id){
		$this->db->where('student_id',$student_id);
		$this->db->order_by('priority', 'asc');
        $query = $this->db->get('council_jexpo_seat_booking')->result_array();
		//$query=$this->db->select('*')->get('council_jexpo_seat_booking')->order_by('priority','asc')->result_array();
		return $query;
	}

	public function getDetailsByid($student_id){
		$this->db->select('general_rank,sc_rank,st_rank,pc_rank,obc_a,obc_b,caste_id_fk');
		$this->db->from('council_polytechnic_counselling_student_data');
		$this->db->where('student_details_id_pk', $student_id);
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query[0];
		}else{
			return array();
		}

	}

	public function get_seat_details($student_id){

		$this->db->select('final_submit');
		$this->db->from('council_jexpo_seat_booking');
		$this->db->where('student_id', $student_id);
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query[0];
		}else{
			return array();
		}
	}
	public function std_choice_data($student_id){

		$this->db->select('institute_name,course_name,type,priority');
		$this->db->from('council_jexpo_seat_booking');
		$this->db->where('final_submit', 1);
		$this->db->where('student_id', $student_id);
		$this->db->order_by('priority');
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}

	public function getStdStatus($std_id){
		$this->db->select('counselling_updated_status,final_allotment');
		$this->db->from('council_polytechnic_counselling_student_data');
		$this->db->where('student_details_id_pk', $student_id);
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query[0];
		}else{
			return array();
		}
	}
} 