<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cssvse_school_model extends CI_Model
{

    public function getSchoolList($limit = NULL, $offset = NULL)
    {
        $this->db->select('
            school_master.udise_code,
            school_master.school_name,
            school_master.school_email,
            school_master.hoi_mobile,
            school_master.school_address,
            school_master.school_id_pk,
            ccsr.entry_time,
            ccsr.active_status
        ')
            ->from('council_cssvse_school_master AS school_master')
            ->join("council_cssvse_school_registration AS ccsr", "school_master.udise_code = ccsr.udise_code AND ccsr.active_status = 1", "LEFT")
            ->order_by('ccsr.active_status')
            ->order_by('school_master.udise_code')
            ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function get_school_search($udise_code)
    {

        $this->db->select('
            school_master.udise_code,
            school_master.school_name,
            school_master.school_email,
            school_master.hoi_mobile,
            school_master.school_address,
            school_master.school_id_pk,
            ccsr.entry_time,
            ccsr.active_status
        ')
            ->from('council_cssvse_school_master AS school_master')
            ->join("council_cssvse_school_registration AS ccsr", "school_master.udise_code = ccsr.udise_code  AND ccsr.active_status = 1", "LEFT")
            ->where('school_master.udise_code', $udise_code);

        return $this->db->get()->result_array();
    }

    public function getSchoolListCount()
    {
        return $this->db->select("count(school_id_pk)")
            ->from("council_cssvse_school_master")
            ->get()->result_array();
    }

    public function check_registration_status($id_hash = NULL)
    {
        // echo $id_hash;exit;

        $this->db->select('
            school_master.udise_code,
            ccsr.active_status
        ')
            ->from('council_cssvse_school_master AS school_master')
            ->join("council_cssvse_school_registration AS ccsr", "school_master.udise_code = ccsr.udise_code   AND ccsr.active_status = 1", "LEFT")
            ->where('MD5(CAST("school_master"."school_id_pk" as character varying)) =', $id_hash);

        return $this->db->get()->result_array();
    }

    public function getSchoolMasterDetails($id_hash = NULL)
    {

        $this->db->select('school_master.*,state.state_name,district.district_name,block_municipality.block_municipality_name')
            ->from('council_cssvse_school_master AS school_master')
            ->join('council_district_master AS district', 'district.district_id_pk = school_master.district_id_fk', 'LEFT')
            ->join('council_state_master AS state', 'state.state_id_pk = school_master.state_id_fk', 'LEFT')
            ->join('council_block_municipality_master AS block_municipality', 'block_municipality.block_municipality_id_pk = school_master.municipality_id_fk', 'LEFT')
            ->where('MD5(CAST("school_master"."school_id_pk" as character varying)) =', $id_hash);

        return $this->db->get()->result_array();
    }

    public function updateSchoolMaster($id_hash = NULL, $update_array = NULL)
    {

        $this->db->where('MD5(CAST("school_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_cssvse_school_master', $update_array);
        return $this->db->affected_rows();
    }

    public function updateStudentMaster($id_hash = NULL, $udise_code = NULL)
    {
        $data = array(
            'udise_code' => $udise_code
        );
        $this->db->where('MD5(CAST("school_id_fk" as character varying)) =', $id_hash);
        $this->db->update('council_cssvse_student_master', $data);
        return $this->db->affected_rows();
    }

    public function getSchoolDetails($id_hash = NULL)
    {
        $this->db->select('
            school_master.udise_code as ud_code,
            ccsr.*
        ')
            ->from('council_cssvse_school_registration AS ccsr')
            ->join('council_cssvse_school_master AS school_master', 'school_master.udise_code = ccsr.udise_code', 'LEFT')
            ->where('MD5(CAST("school_master"."school_id_pk" as character varying)) =', $id_hash);
        return $this->db->get()->result_array();
    }
    public function getStudentListByUdiseCode($udise_code)
    {
        $this->db->select('student_master.*, gender.gender_description')
            ->from('council_cssvse_student_master AS student_master')
            ->join('council_gender_master AS gender', 'gender.gender_id_pk = student_master.gender_id_fk', 'LEFT')
            ->where('student_master.udise_code', $udise_code)
            ->where('student_master.active_status', 1);
        return $this->db->get()->result_array();
    }

    public function check_udise_code($udise_code)
    {

        $this->db->select('
        school_master.school_id_pk
        ')
            ->from('council_cssvse_school_master AS school_master')
            ->where('school_master.udise_code', $udise_code);

        return $this->db->get()->result_array();
    }
    public function get_school_reg_pk($udise_code)
    {
        $this->db->select('
        ccsr.school_reg_id_pk
        ')
            ->from('council_cssvse_school_registration AS ccsr')
            ->where('ccsr.udise_code', $udise_code);

        return $this->db->get()->result_array();
    }

    public function updateStudentUdiseCode($id_hash = NULL, $update_array = NULL)
    {

        $this->db->where('MD5(CAST("student_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_cssvse_student_master', $update_array);
        return $this->db->affected_rows();
    }

    public function getSchoolReport()
    {
        $this->db->select('school_master.school_id_pk, school_master.udise_code, school_master.school_name, school_master.hoi_mobile, ccsr.active_status, district.district_name');
        $this->db->from('council_cssvse_school_master AS school_master');
        $this->db->join("council_cssvse_school_registration AS ccsr", "school_master.udise_code = ccsr.udise_code AND ccsr.active_status = 1", "LEFT");
        $this->db->join("council_cssvse_student_master AS student_master", "school_master.udise_code = student_master.udise_code", "LEFT");
        $this->db->join("council_district_master AS district", "district.district_id_pk = school_master.district_id_fk", "LEFT");
        $this->db->group_By('school_master.school_id_pk, school_master.udise_code, school_master.school_name, school_master.hoi_mobile, ccsr.active_status, district.district_name');
        $this->db->order_by('school_master.udise_code, school_master.school_name');
        $schoolList = $this->db->get()->result_array();


        foreach ($schoolList as $key => $school) {

            $this->db->select('sector.sector_id_pk, sector.sector_code, sector.sector_name, course.course_id_pk, course.course_name, course.course_code,
                batch.batch_id_pk, batch.process_id_fk, COUNT(student.student_id_pk) total_student,
                COUNT(CASE WHEN student.nsqf_level IS NOT NULL THEN 1 ELSE NULL END) added_by_excel,
                COUNT(CASE WHEN student.nsqf_level IS NULL THEN 1 ELSE NULL END) added_by_institute
            ');
            $this->db->from('council_cssvse_student_master AS student');
            $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
            $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');
            $this->db->join('council_cssvse_batch_details AS batch', 'batch.school_id_fk = student.school_id_fk AND batch.course_id_fk = student.course_id_fk', 'left');
            $this->db->where('student.school_id_fk', $school['school_id_pk']);
            $this->db->group_by('student.course_id_fk, sector.sector_id_pk, sector.sector_code, sector.sector_name, course.course_id_pk, course.course_name, course.course_code,batch.batch_id_pk, batch.process_id_fk');
            $coursList = $this->db->get()->result_array();

            $schoolList[$key]['courseList'] = $coursList;
        }

        return $schoolList;
    }
}
