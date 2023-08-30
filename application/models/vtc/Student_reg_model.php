<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Student_reg_model extends CI_Model
{

    public function get_salutation(){
		$query = $this->db->select("*")
			->from("council_salutation_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}
	
	public function get_gender(){
		$query = $this->db->select("*")
			->from("council_gender_master")
			//->where("active_status",1)
			->get();
		return $query->result_array();
	}

    public function get_caste(){
		$query = $this->db->select("*")
			->from("council_caste_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

    public function get_religion(){
		$query = $this->db->select("*")
			->from("council_religion_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

    public function get_last_exam(){
		$query = $this->db->select("*")
			->from("council_last_academic_exam_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_batch_duration(){
		$query = $this->db->select("*")
			->from("council_vtc_batch_duration_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_duplicate_aadhar($aadhar_no = NULL){

		$this->db->select('*');
		// $this->db->from('council_vtc_student_master');
		$this->db->where(array(
			'aadhar_no' => $aadhar_no,
			'active_status' => 1
		));
		return $this->db->get('council_vtc_student_master')->result_array();
	}
	public function getGroupByVTCCode($course_name_id = NULL,$vtc_code = NULL, $academic_year = NULL){

		$this->db->select('course_selection.vtc_course_id_pk');
		$this->db->from('council_affiliation_vtc_master as vtc_master');
		$this->db->join('council_affiliation_vtc_course_selection as course_selection','course_selection.vtc_id_fk = vtc_master.vtc_id_pk');
		$this->db->where('vtc_master.vtc_code', $vtc_code);
		$this->db->where('course_selection.course_name_id_fk', $course_name_id);
		$this->db->where('course_selection.active_status', 1);
		$this->db->where('course_selection.academic_year', $academic_year);
		$query = $this->db->get()->result_array();

		if(!empty($query)){

			$vtc_course_id = array();
			foreach($query as $val){
				array_push($vtc_course_id, $val['vtc_course_id_pk']);
			}

			$this->db->select('group_map.group_id_fk,group_master.group_id_pk, group_master.group_name, group_master.group_code');
			$this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
			$this->db->join('council_affiliation_group_master as group_master','group_map.group_id_fk = group_master.group_id_pk');
			$this->db->where_in('group_map.vtc_course_id_fk', $vtc_course_id);
			$this->db->where('group_map.active_status', 1);
			$this->db->where('group_map.academic_year', $academic_year);
			$group = $this->db->get()->result_array();

			if(!empty($group)){

				return $group;
			}else{
				return array();
			}
		}else{
			return array();
		}

	}

	

	public function getVtcDetails($vtc_code = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_code', $vtc_code)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

	public function getInsDetails($vtc_code = NULL)
    {
        $this->db->select('cavm.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->where('cavm.vtc_code', $vtc_code)
            ->where('cavm.vtc_active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

	public function insertData($table,$std_data = NULL)
    {
        $this->db->insert($table, $std_data);
		// echo $this->db->last_query();exit;

        return $this->db->insert_id();
    }

	public function getVtcDetailsByCode_old($vtcCode = NULL, $academic_year = NULL)
    {
		$this->db->select('cavm.*,cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_code', $vtcCode)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);
            // ->where('cavd.second_final_submit_status', 1);

			$query = $this->db->get()->result_array();

			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
    }
	public function getVtcDetailsByCode($vtcCode = NULL, $academic_year = NULL,$registration_for)
    {
		if($registration_for == 1){
			$this->db->select('cavm.*,cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_code', $vtcCode)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);
			// ->where('cavd.second_final_submit_status', 1);
			$query = $this->db->get()->result_array();

		}else{
			$this->db->select('cavm.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->where('cavm.vtc_code', $vtcCode)
            ->where('cavm.active_status', 1);
			$query = $this->db->get()->result_array();
		}
		
			// echo $this->db->last_query();
			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
    }

	public function getGroupDetails($group_id = NULL){
		$this->db->select('*')
		->from('council_affiliation_group_master')
		->where('group_id_pk', $group_id);
		$query = $this->db->get()->row_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

	public function getAllState(){
		$this->db->select('*');
		$this->db->from('council_state_master');
		$this->db->where('active_status',1);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

	public function get_nationality(){
		$this->db->select('*');
		$this->db->from('council_nationality_master');
		$this->db->where('active_status',1);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

	public function getDistrictByStateId($state_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', $state_id)->order_by('district_name')->get('council_district_master')->result_array();
    }

	public function getAllboard(){
		$this->db->select('*');
		$this->db->from('council_board_master');
		$this->db->where('active_status',1);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

	public function getGuardianRelationList(){
		$this->db->select('*');
		$this->db->from('council_guardian_relationship_master');
		$this->db->where('active_status',1);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

	public function update_json_table_data($last_id = NULL, $updateArray = NULL)
    {
        $this->db->where('banglashiksha_api_json_data_id_pk', $last_id);
        $this->db->update('council_banglashiksha_api_json_data', $updateArray);
        return $this->db->affected_rows();
    }


	//Generic 

	public function geteInstituteDetails($instituteCode = NULL)
    {//echo $instituteCode;exit;
		$this->db->select('*')
            ->from('council_institue_master')
            ->where('institute_code', $instituteCode)
            ->where('active_status', 1);

			$query = $this->db->get()->result_array();
		
			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
    }

	public function getAllExamType(){
        $query = $this->db->select("*")
            ->from("council_exam_type_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            //->order_by("sort_order", "ASC")
            ->get();
        return $query->result_array();
    } 

	// Arman

	public function getDetailsByAdharNum($aadhar_no = NULL)
    {
		// $this->db->select('student_details.*,college_map.course_id_fk,college_map.institute_id_fk,college_map.institue_reg_id_fk')
		$this->db->select('student_details.*')
            ->from('council_polytechnic_spotcouncil_student_details AS student_details')
			// ->join('council_polytechnic_spotcouncil_student_college_map as college_map', 'student_details.student_details_id_pk = college_map.student_details_id_fk')
            ->where('student_details.aadhar_no', $aadhar_no);
			$query = $this->db->get()->row_array();

			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
    }

	public function getInstituteDetails_old($vtc_name = NULL, $academic_year = NULL,$registration_for)
    {
		
		if($registration_for == 1){
			$query = $this->db->query("SELECT cavm.*, cavd.*
			FROM council_affiliation_vtc_master AS cavm
			LEFT JOIN council_affiliation_vtc_details AS cavd ON cavd.vtc_id_fk = cavm.vtc_id_pk
			WHERE cavm.vtc_name iLIKE '%".$vtc_name."%'
			AND cavd.academic_year = '".$academic_year."'
			AND cavd.active_status = 1");
			// echo $this->db->last_query();
		}else{
			$query = $this->db->query("SELECT cavm.*
			FROM council_affiliation_vtc_master AS cavm
			WHERE cavm.vtc_name iLIKE '%".$vtc_name."%'
			AND cavm.vtc_active_status = 1 AND cavm.vtc_type = 3");
			// echo $this->db->last_query();
		}
		return $query->result_array();
			// echo $this->db->last_query();
			// if (!empty($query)) {
			// 	return $query;
			// } else {
			// 	return array();
			// }
    }
	
	public function getInstituteDetails($vtc_name = NULL, $academic_year = NULL,$registration_for)
    {
		
		if($registration_for == 1){
			$query = $this->db->query("SELECT cavm.*, cavd.*,ins_cat.category_name
			FROM council_affiliation_vtc_master AS cavm
			LEFT JOIN council_affiliation_vtc_details AS cavd ON cavd.vtc_id_fk = cavm.vtc_id_pk
			LEFT JOIN council_affiliation_institute_category_master AS ins_cat ON ins_cat.institute_category_id_pk = cavm.institute_category_id_fk
			WHERE cavm.vtc_name iLIKE '%".$vtc_name."%'
			AND cavd.academic_year = '".$academic_year."'
			AND cavd.active_status = 1");
			// echo $this->db->last_query();
		}else{
			$query = $this->db->query("SELECT cavm.*,ins_cat.category_name
			FROM council_affiliation_vtc_master AS cavm
			LEFT JOIN council_affiliation_institute_category_master AS ins_cat ON ins_cat.institute_category_id_pk = cavm.institute_category_id_fk
			WHERE cavm.vtc_name iLIKE '%".$vtc_name."%'
			AND cavm.vtc_active_status = 1 AND cavm.vtc_type = 3");
			// echo $this->db->last_query();
		}
		return $query->result_array();
			// echo $this->db->last_query();
			// if (!empty($query)) {
			// 	return $query;
			// } else {
			// 	return array();
			// }
    }

	public function getCouncilStdDetails($aadhar_no = NULL,$mob_no = NULL)
    {
		
		$this->db->select('student_details.*')
            ->from('council_polytechnic_spotcouncil_student_details AS student_details')
			->where('student_details.aadhar_no', $aadhar_no)
			->where('student_details.mobile_number', $mob_no);
			$query = $this->db->get()->row_array();

			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
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
	
	public function updateStdDetails($id = NULL, $updateArray = NULL , $non_entrace = null)
    {
        
		if($non_entrace == 1){
			$this->db->where('institute_student_details_id_pk', $id);
			$this->db->update('council_institute_student_details', $updateArray);

		}else{
			$this->db->where('student_details_id_pk', $id);

			$this->db->update('council_polytechnic_spotcouncil_student_details', $updateArray);
		}

        return $this->db->affected_rows();
    }

	public function getStdDetailsForFinalSubmit($id_hash = NULL){

		$this->db->select('
		student_details_id_pk,
		candidate_name,
		date_of_birth,
		guardian_name,
		mobile_number,
		category,
		physically_challenged,
		picture,
		sign,
		caste_id_fk,
		nationality_id_fk,
		gender_id_fk,
		handicapped,
		aadhar_no,
		state_id_fk,
		district_id_fk,
		sub_div_id_fk,
		pincode,
		address,
		religion_id_fk,
		email,
		college_id_fk,
		course_id_fk,
		registration_year,
		exam_type_id_fk,
		bangla_shiksha_reg_number,
		institute_category
		');
		$this->db->from('council_polytechnic_spotcouncil_student_details as student');
		$this->db->where("MD5(CAST(student.student_details_id_pk as character varying)) =", $id_hash);
		$data =  $this->db->get()->row_array();

		 
		//echo "<pre>";print_r($data);exit;
		// unset($data[$key]['academic_year']);
		$data['spotcouncil_student_details_id_fk'] = $data['student_details_id_pk'];     
		$data['institute_id_fk'] = $data['college_id_fk']; 
		$data['institute_reg_id_fk'] = NULL;     
		$data['entry_time'] = 'now()';     
		$data['entry_ip'] = $this->input->ip_address(); 
        unset($data['student_details_id_pk']);
		if(!empty($data)){

			return $data;
		}else{
			return array();
		}
	}

	public function insertStdData($table,$array = NULL)
    {
        $this->db->insert($table, $array);

        return $this->db->insert_id();
    }

	public function insertStdCredentials($vtcCredentials = NULL)
    {
		//echo "<pre>";print_r($vtcCredentials);
        $this->db->insert('council_stake_holder_login', $vtcCredentials);
		//echo $this->db->last_query();exit;

        return $this->db->insert_id();
    }

	public function getCourseByCode_old($vtc_code = NULL){
		$this->db->select('qbm_disciplne.discipline_id_pk,qbm_disciplne.discipline_name,qbm_disciplne.discipline_code,');
		$this->db->from('council_institute_qbm_discipline_map as ins_dis_map');
		$this->db->join('council_qbm_discipline_master as qbm_disciplne', 'ins_dis_map.discipline_id_fk = qbm_disciplne.discipline_id_pk');
		$this->db->join('council_affiliation_vtc_master as vtc_master', 'ins_dis_map.institute_id_fk = vtc_master.vtc_id_pk');
		$this->db->where('vtc_master.vtc_code',$vtc_code);
		$query = $this->db->get()->result_array();
		// echo $this->db->last_query();exit;
		return $query;

	}
	public function getCourseByCode($vtc_code = NULL,$exam_type_id= null){
		$this->db->select('qbm_disciplne.discipline_id_pk,qbm_disciplne.discipline_name,qbm_disciplne.discipline_code,');
		$this->db->from('council_institute_qbm_discipline_map as ins_dis_map');
		$this->db->join('council_qbm_discipline_master as qbm_disciplne', 'ins_dis_map.discipline_id_fk = qbm_disciplne.discipline_id_pk');
		$this->db->join('council_affiliation_vtc_master as vtc_master', 'ins_dis_map.institute_id_fk = vtc_master.vtc_id_pk');
		$this->db->where('vtc_master.vtc_code',$vtc_code);
		
		if($exam_type_id== 1 ||$exam_type_id== 2 ){
			$this->db->where('ins_dis_map.exam_type_id_fk',1);
		}else{
			$this->db->where('ins_dis_map.exam_type_id_fk',$exam_type_id);
		}
		
		$this->db->where('ins_dis_map.active_status',1);
		$query = $this->db->get()->result_array();
		 //echo $this->db->last_query();exit;
		return $query;

	}


	//date 22-04-2023

	public function check_enrance($exam_type_id){

		$result = $this->db->select('enrance_exam')->from('council_exam_type_master')->where('exam_type_id_pk',$exam_type_id)->get();
		$query = $result->result_array();
		if(!empty($query)){
			return $query[0]['enrance_exam'];
		}else{
			return array();
		}

	}

	public function getNonEntranceStdDetailsByIdHash($id_hash){

		$this->db->select('institute_student_details_id_pk,final_mobile_otp,final_mobile_no_verify_status,mobile_number,aadhar_no,candidate_name');
		$this->db->from('council_institute_student_details');
		$this->db->where("MD5(CAST(institute_student_details_id_pk as character varying)) =", $id_hash);
		$query =  $this->db->get()->row_array();
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}

	public function checkStudentExist($aadhar_no){
		$this->db->select('institute_student_details_id_pk,final_mobile_otp,final_mobile_no_verify_status,mobile_number,aadhar_no,candidate_name');
		$this->db->from('council_institute_student_details');
		$this->db->where('aadhar_no', $aadhar_no);
		$query =  $this->db->get()->row_array();
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}

	}
	
	


}