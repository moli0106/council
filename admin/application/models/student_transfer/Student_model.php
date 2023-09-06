<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_model extends CI_Model
{
	public function getStudentList($ins_id){
		$query=$this->db->select('
		c2.transfer_id_pk,
		c2.institute_student_details_id_fk,
		c1.first_name,c1.middle_name,
		c1.last_name,
		c1.transfer_verify_status,
		c2.institute_name,
		c2.institute_id,
		c2.discipline_id_fk,
		c2.course_name')
		->from('council_institute_student_details as c1')
		->join('council_institute_course_student_transfer as c2','c1.institute_student_details_id_pk = c2.institute_student_details_id_fk','INNER')
		->where('c2.final_allotement',1)->where('c1.institute_id_fk',$ins_id)->get()->result_array();
		//echo $this->db->last_query();exit;
		return $query;
	}


	public function getStudentDetailsById($id_hash = NULL)
    {
		//$this->db->select('student.*');
		$this->db->select('
		student.institute_student_details_id_pk,
		student.first_name,
		student.middle_name, 
		student.last_name,
		student.institute_id_fk,
		student.course_id_fk,
		student.transfer_institute_id_fk,
		student.transfer_discipline_id_fk,
		c2.institute_id,
		c2.discipline_id_fk,
		student.transfer_verify_status,
		student.transfer_verify_reject_time,
		student.transfer_reject_note');
        $this->db->from('council_institute_student_details AS student');
		$this->db->join('council_institute_course_student_transfer as c2','student.institute_student_details_id_pk = c2.institute_student_details_id_fk','INNER');
        $this->db->where('c2.final_allotement',1);
		$this->db->where("MD5(CAST(student.institute_student_details_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }

	public function getTransferVerifyStudentList($ins_id){
		$query=$this->db->select('
		c1.institute_student_details_id_pk,
		c1.first_name,c1.middle_name,
		c1.last_name,
		c1.transfer_verify_status,
		c1.institute_id_fk,
		c1.course_id_fk,
		c1.transfer_institute_id_fk,
		c1.transfer_discipline_id_fk,
		c1.transfer_admitted_status,
		vtc.vtc_name as transfer_from,
		vtc.vtc_code,
		course1.discipline_name as transfer_from_course,
		course2.discipline_name as transfer_to_course')
		->from('council_institute_student_details as c1')
		->join('council_affiliation_vtc_master as vtc','c1.institute_id_fk = vtc.vtc_id_pk','Left')
		->join('council_qbm_discipline_master as course1','c1.course_id_fk = course1.discipline_id_pk','Left')
		->join('council_qbm_discipline_master as course2','c1.transfer_discipline_id_fk = course2.discipline_id_pk','Left')
		->where('c1.transfer_verify_status',1)->where('c1.transfer_institute_id_fk',4230)->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}


	public function get_available_intake($institute_id,$discipline_id){
		$this->db->select('intake_id_pk,available_intake,add_intake,minus_intake,final_intake');
		$this->db->from('council_institute_intake_for_transfer');
		$this->db->where('institute_id_fk',$institute_id);
		$this->db->where('discipline_id_fk',$discipline_id);
		$query=$this->db->get()->result_array();
		//echo $this->db->last_query();die;
		if(!empty($query)){

			return $query[0];
		}else{
			return array();
		}
	}

	public function updateIntakeData($intake_id = NULL, $updateArray = NULL)
    {
        $this->db->where("intake_id_pk", $intake_id);
        $this->db->update('council_institute_intake_for_transfer', $updateArray);
        return $this->db->affected_rows();
    }
}