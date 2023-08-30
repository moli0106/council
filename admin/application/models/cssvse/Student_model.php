<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_model extends CI_Model
{

    public function getStudentList($school_reg_id_pk = NULL)
    {
        $this->db->select('
            student.student_id_pk,
            student.udise_code,
            student.school_id_fk,
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mobile,
            student.image
        ');
        $this->db->from('council_cssvse_student_master AS student');
        $this->db->join('council_cssvse_school_master AS school_master', 'school_master.udise_code = student.udise_code', 'left');
        $this->db->join('council_cssvse_school_registration AS school_reg', 'school_reg.udise_code = school_master.udise_code', 'left');


        $this->db->where('school_reg.school_reg_id_pk', $school_reg_id_pk);
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
        $this->db->select('school_master.school_id_pk, school_reg.*');
        $this->db->from('council_cssvse_school_registration AS school_reg');

        $this->db->join('council_cssvse_school_master AS school_master', 'school_master.udise_code = school_reg.udise_code', 'left');

        $this->db->where('school_reg_id_pk', $school_reg_id_pk);
        $this->db->where('active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getStudentDetails($id_hash = NULL)
    {
        $this->db->select('student.*, class.class_name');
        $this->db->from('council_cssvse_student_master AS student');

        $this->db->join('council_cssvse_class_master AS class', 'class.class_id_pk = student.class_id_fk', 'left');

        $this->db->where("MD5(CAST(student.student_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->result_array();
    }

    public function insertStudentData($insertArray = NULL)
    {
        $this->db->insert('council_cssvse_student_master', $insertArray);

        return $this->db->insert_id();
    }

    public function updateStudentData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(student_id_pk as character varying)) =", $student_id);
        $this->db->update('council_cssvse_student_master', $updateArray);
        return $this->db->affected_rows();
    }
}
