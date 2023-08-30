<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration_model extends CI_Model
{

	public function get_gender()
	{
		$query = $this->db->select("*")
			->from("council_gender_master")
			// ->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_nationality()
	{
		$query = $this->db->select("*")
			->from("council_nationality_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_state()
	{
		$query = $this->db->select("*")
			->from("council_state_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_caste()
	{
		$query = $this->db->select("*")
			->from("council_caste_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_qualification()
	{
		$query = $this->db->select("*")
			->from("council_qualification_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_course()
	{
		$query = $this->db->select("*")
			// ->from("council_spot_course_master")
			->from("council_exam_type_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}
	public function get_religion()
	{
		$query = $this->db->select("*")
		->from("council_religion_master")
		->where("active_status", 1)
		->get();
	return $query->result_array();
	}

	public function get_district()
	{
		$query = $this->db->select("*")
			->from("council_district_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_police_station()
	{
		$query = $this->db->select("*")
			->from("council_police_station_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function getDistrictByStateId($state_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', $state_id)->order_by('district_name')->get('council_district_master')->result_array();
    }

	public function getSubDivisionByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('subdiv_name')
            ->get('council_subdiv_master')->result_array();
            // echo $this->db->last_query();exit;
    }
	public function insert_application_details($application_basic)
	{
		$this->db->insert('council_polytechnic_spotcouncil_student_details', $application_basic);
        return $this->db->insert_id();
	}
	public function getStdDetailsByIdHash($id_hash){

		$this->db->select('*');
		$this->db->from('council_polytechnic_spotcouncil_student_details as student');
		$this->db->where("MD5(CAST(student.student_details_id_pk as character varying)) =", $id_hash);
		$query =  $this->db->get()->row_array();
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}

	public function updateStdDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('student_details_id_pk', $id);
        $this->db->update('council_polytechnic_spotcouncil_student_details', $updateArray);
		// echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
	

	public function get_last_application_no($chaking_data = NULL)
    {
        return $query = $this->db->select('max(application_form_no) as code')
            ->from('council_polytechnic_spotcouncil_student_details')
            ->like('application_form_no', ($chaking_data))
            ->get()
            ->result_array();
    }

	public function get_student_preview_data_list($student_details_id_pk = Null)
    {
       
        $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,course.exam_type_name,gender.gender_description,nationality.nationality_name,stud.kanyashree,stud.kanyashree_unique_id,caste.caste_name,stud.handicapped,stud.date_of_birth,stud.aadhar_no,qualification.qualification_name,stud.fullmarks,stud.marks_obtain,stud.percentage,stud.cgpa,stud.institute_name,stud.year_of_passing,stud.address,stud.pincode,state.state_name,district.district_name,subdiv.subdiv_name,stud.mobile_number,stud.email,stud.application_form_no,stud.picture, stud.sign,religion.religion_name,stud.last_reg_no,stud.thirdyr_or_physics_or_math_result,stud.secondyear_or_chemistry_or_physicalscience_or_science_result,stud.firstyear_or_hs_english_or_lifescience_result,police.police_station_name,qualification.marks_subject1_corr_qualification,qualification.qualification_name,qualification.marks_subject2_corr_qualification,qualification.marks_subject3_corr_qualification,stud.course_id_fk")
            ->from("council_polytechnic_spotcouncil_student_details as stud")
            //  ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
			->join("council_exam_type_master as course", " course.exam_type_id_pk = stud.course_id_fk", "LEFT")
            ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 
            ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")
            ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")
            ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")
            ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
            ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")
            ->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")
            ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")
			->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")
            ->where(
                array(
                    "stud.active_status" => 1,
                    'MD5(CAST(student_details_id_pk AS character varying)) =' =>$student_details_id_pk
                )
            )
            ->get();
        return $query->result_array();

    }

    /* added by ATREYEE 03-01-2023 */
    public function get_specific_course_name_atz($course_id = NULL) {
    	$query = $this->db->select("course_name")
			->from("council_spot_course_master")
			->where("course_id_pk", $course_id)
			->where ("active_status",1)
			->get();
			//echo $this->db->last_query();
		 return $query->result_array();
    }

	//Added by Moli
	public function getBskData($ticket_no){
		$this->db->select('*');
		$this->db->from('council_bsk_api_json_data');
		$query = $this->db->get()->row_array();
		if(!empty($query)){
			return $query;
		}else{
			return array();
		}
	}

	public function bskStudentResponseData($bsk_ticket_no){
		$query = $this->db->select('student_details_id_pk,bsk_ticket_no,bsk_userid,mobile_number,application_form_no,entry_time')
		->from('council_polytechnic_spotcouncil_student_details')
		->where('bsk_ticket_no',$bsk_ticket_no)->get()->row_array();
		return array(
			"std_details" => $query
		);
	}

	public function updateBSKJsonTable($table, $updateArray = NULL,$bsk_ticket_no = NULL)
    {
        $this->db->where('ticketno', $bsk_ticket_no);
        $this->db->update($table, $updateArray);
		// echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
}
