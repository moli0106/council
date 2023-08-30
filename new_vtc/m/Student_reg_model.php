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

	public function insertData($table,$std_data = NULL)
    {
        $this->db->insert($table, $std_data);
		// echo $this->db->last_query();exit;

        return $this->db->insert_id();
    }

	public function getVtcDetailsByCode($vtcCode = NULL, $academic_year = NULL)
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
            ->order_by("exam_type_name", "ASC")
            ->get();
        return $query->result_array();
    } 


}