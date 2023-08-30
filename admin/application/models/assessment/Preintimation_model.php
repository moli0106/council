<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Preintimation_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getPreintimationCount()
    {
        $query = $this->db->select("count(preintimation_assessment_id_pk)")
            ->from("council_assessment_preintimation")
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
        $query = $this->db->select("preintimation.*, process.process_name")
            ->from("council_assessment_preintimation AS preintimation")
            ->join("council_process_master AS process", "process.process_id_pk = preintimation.process_id_fk", "LEFT")
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
