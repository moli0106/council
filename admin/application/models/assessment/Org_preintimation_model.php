<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Org_preintimation_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getPreintimationCount()
    {
        $query = $this->db->select("count(batch_id_pk)")
            ->from("council_organization_batch_details")
            ->where(
                array(
                    'active_status' => 1
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getAllPreintimation($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("preintimation.*, process.process_name,scheme.assessment_scheme_name,tc.tc_name as tc_user_name,tc.email,
        tc.mobile,
        state.state_name,
        district.district_name,
        course.course_name,
        course.course_code,
        sector.sector_name,
        sector.sector_code
        ")
            ->from("council_organization_batch_details AS preintimation")
            ->join("council_process_master AS process", "process.process_id_pk = preintimation.process_id_fk", "LEFT")
            ->join("council_assessment_scheme_master AS scheme", "scheme.assessment_scheme_id_pk = preintimation.assessment_scheme_id_fk", "LEFT")
            ->join("council_organization_tc_details AS tc", "tc.tc_id_pk = preintimation.tc_id_fk", "LEFT")
            ->join("council_state_master AS state", "tc.state_id_fk = state.state_id_pk", "LEFT")
            ->join("council_district_master AS district", "tc.district_id_fk = district.district_id_pk", "LEFT")
            ->join("council_course_master AS course", "course.course_id_pk = preintimation.course_id_fk", "LEFT")
            ->join("council_sector_master AS sector", "sector.sector_id_pk = preintimation.sector_id_fk", "LEFT")
            ->where("preintimation.active_status", 1)
            ->limit($limit, $offset)
            ->order_by("preintimation.entry_time", "DESC")
            ->get();
        return $query->result_array();
    }

    public function searchPreintimation($searchArray)
    {
        $query = $this->db->select("preintimation.*, process.process_name")
            ->from("council_assessment_preintimation AS preintimation")
            ->join("council_process_master AS process", "process.process_id_pk = preintimation.process_id_fk", "LEFT");

        if ($searchArray['sector_code'] != '') {

            $query = $query->where('preintimation.sector_code', $searchArray['sector_code']);
        }

        if ($searchArray['course_code'] != '') {

            $query = $query->where('preintimation.course_code', $searchArray['course_code']);
        }

        $query = $query->get();
        return $query->result_array();
    }

    public function getAllSector()
    {
        $this->db->where(
            array(
                'active_status' => 1,
            )
        );

        $this->db->order_by('sector_name', 'asc');

        return $this->db->get('council_sector_master')->result_array();
    }

    public function getCourseBySector($sector_code)
    {
        $this->db->select("course.*")->from("council_course_master AS course")
            ->join("council_sector_master AS sector", "sector.sector_id_pk = course.sector_id_fk", "left")
            ->where(
                array(
                    'course.active_status' => 1,
                    'sector.sector_code'   => $sector_code,
                )
            );

        $this->db->order_by('course_name', 'asc');

        return $this->db->get()->result_array();
    }
}
