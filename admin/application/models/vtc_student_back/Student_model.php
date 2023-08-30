<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_model extends CI_Model
{

    public function getStudentList($school_reg_id_pk = NULL)
    {
        $this->db->select('
            student.student_id_pk,
            student.institute_code,
            student.institute_id_fk,
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mobile,
            student.image,
			student.roll_number
        ');
        $this->db->from('council_vtc_student_master AS student');
        
        $this->db->where('student.institute_id_fk', $school_reg_id_pk);
        $this->db->where('student.active_status', 1);
        $this->db->order_by('first_name');

        return $this->db->get()->result_array();
    }

    public function getSalutation()
    {
        return $this->db->get("council_salutation_master")->result_array();
    }

    public function getGender()
    {
        return $this->db->get("council_gender_master")->result_array();
    }

    public function getDistrictList()
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', 19)->order_by('district_name')->get('council_district_master')->result_array();
    }

    public function getClassList()
    {
        return $this->db->get('council_cssvse_class_master')->result_array();
    }

    public function getSectorList()
    {
        return $this->db->where('active_status', 1)->order_by('sector_name')->get('council_sector_master')->result_array();
    }

    public function getMunicipalityByDistrict($district = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district)->order_by('block_municipality_name')->get('council_block_municipality_master')->result_array();
    }

    public function getCourseList($sector_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('sector_id_fk', $sector_id)->order_by('course_name')->get('council_course_master')->result_array();
    }

    public function getRegDetails($school_reg_id_pk = NULL)
    {
        $this->db->select('school_master.vtc_id_pk, school_reg.*');
        $this->db->from('council_affiliation_vtc_details AS school_reg');

        $this->db->join('council_affiliation_vtc_master AS school_master', 'school_master.vtc_id_pk = school_reg.vtc_id_fk', 'left');

        $this->db->where('school_master.vtc_id_pk', $school_reg_id_pk);
        $this->db->where('active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getStudentDetails($id_hash = NULL)
    {
        $this->db->select('student.*, class.class_name');
        $this->db->from('council_vtc_student_master AS student');

        $this->db->join('council_cssvse_class_master AS class', 'class.class_id_pk = student.class_id_fk', 'left');

        $this->db->where("MD5(CAST(student.student_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->result_array();
    }

    public function insertStudentData($insertArray = NULL)
    {
        $this->db->insert('council_vtc_student_master', $insertArray);

        return $this->db->insert_id();
    }

    public function updateStudentData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(student_id_pk as character varying)) =", $student_id);
        $this->db->update('council_vtc_student_master', $updateArray);
        return $this->db->affected_rows();
    }

    // ------------ Added By Moli -------------------//

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

    public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_id_pk', $vtc_id)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
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

    public function getAcademicYearList(){
        $this->db->from('council_affiliation_academic_year_master')->where('active_status', 1);
        return $this->db->get()->result_array();
    }

    public function getStudentListByVTCId($limit, $start, $orderColumn, $orderType,$selected_year,$vtc_id_pk){

        $this->db->select('
            student.*,course_name_master.course_name,group_master.group_name
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_affiliation_course_name_master as course_name_master', 'course_name_master.course_name_id_pk = student.class_id_fk');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = student.course_id_fk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_pk);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.year_of_registration', $selected_year);
        $this->db->order_by('first_name');
        $this->db->limit($limit, $offset);

        return $this->db->get()->result_array();

    }

    public function getStudentListCount($selected_year)
    {
        return $this->db->select("count(student_id_pk)")
            ->from("council_vtc_student_master")
            ->where('active_status', 1)
            ->where('year_of_registration', $selected_year)
            ->get()->result_array();
    }

    public function getStudentDetailsById($id_hash = NULL)
    {
        $this->db->select('student.*,student_last_exam.*');
        $this->db->from('council_vtc_student_master AS student');

        $this->db->join('council_vtc_student_last_examination AS student_last_exam', 'student_last_exam.student_id_fk = student.student_id_pk', 'left');

        $this->db->where("MD5(CAST(student.student_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }

    public function insertData($table,$std_data = NULL)
    {
        $this->db->insert($table, $std_data);
        

        return $this->db->insert_id();
    }

    public function updateStudentAcademicData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(student_id_fk as character varying)) =", $student_id);
        $this->db->update('council_vtc_student_last_examination', $updateArray);
        return $this->db->affected_rows();
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

    
}
