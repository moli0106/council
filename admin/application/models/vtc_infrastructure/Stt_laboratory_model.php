<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stt_laboratory_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_id_pk', $vtc_id)
            // ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getVtcCourseList($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        // $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_courses')->result_array();


        $hs_voc_courses= explode(",",$query[0]['hs_voc_courses']);
        

        $stc_course= explode(",",$query[0]['stc_course']);

        $courseArray = array_merge($hs_voc_courses,$stc_course);

        // ! get Group name

        $this->db->where_in('course_id_pk', $courseArray);
        $this->db->where('active_status', 1);

        $groupName = $this->db->get('council_affiliation_course_master')->result_array();

        // echo "<pre>";print_r($groupName);exit;


        if (!empty($groupName)) {
            return $groupName;
        } else {
            return array();
        }
    }

}