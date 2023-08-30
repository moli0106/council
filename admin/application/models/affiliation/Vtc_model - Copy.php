<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcList()
    {
        return $this->db->limit(10, 0)->get('council_affiliation_vtc_master')->result_array();
    }

    public function getHsVocCourseList($courseNotIn = NULL)
    {
        $this->db->where("course_name_id_fk", 1);
        $this->db->where("active_status", 1);

        if (!empty($courseNotIn)) {
            $this->db->where_not_in('streem_name_id_fk', $courseNotIn);
        }

        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getNqrCourseList()
    {
        $this->db->where("course_name_id_fk", 2);
        $this->db->where("active_status", 1);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getNsqfCourseList()
    {
        $this->db->where("course_name_id_fk", 3);
        $this->db->where("active_status", 1);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getCourseMasterById($id = NULL)
    {
        $this->db->where("course_id_pk", $id);
        $query = $this->db->get('council_affiliation_course_master')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function insertVtcDetails($array)
    {
        $this->db->insert('council_affiliation_vtc_details', $array);

        return $this->db->insert_id();
    }

    public function insertCourseSelectionData($array)
    {
        $this->db->insert_batch('council_affiliation_vtc_courses', $array);

        return $this->db->insert_id();
    }

    public function getVtcDetails($vtc_id_fk = NULL)
    {
        $this->db->select('cavd.*, cavm.*')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->where("MD5(CAST(cavd.vtc_id_fk as character varying)) =", $vtc_id_fk);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function checkVtcExist($vtc_id_fk = NULL)
    {
        $this->db->where("MD5(CAST(vtc_id_pk as character varying)) =", $vtc_id_fk);

        $query = $this->db->get('council_affiliation_vtc_master')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getVtcCourses($vtc_id_fk = NULL)
    {
        $this->db->where("MD5(CAST(vtc_id_fk as character varying)) =", $vtc_id_fk);

        return $this->db->get('council_affiliation_vtc_courses')->result_array();
    }

    public function updateVtcDetails($vtc_details_id, $updateArray)
    {
        $this->db->where("MD5(CAST(vtc_details_id_pk as character varying)) =", $vtc_details_id);

        $this->db->update('council_affiliation_vtc_details', $updateArray);

        return $this->db->affected_rows();
    }

    public function getDesignationList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('designation_name');

        return $this->db->get('council_affiliation_designation_master')->result_array();
    }

    public function getAttachedList()
    {
        $this->db->where('active_status', 1);

        // $this->db->order_by('attached_name');

        return $this->db->get('council_affiliation_attached_master')->result_array();
    }

    public function getEngagementList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('engagement_name');

        return $this->db->get('council_affiliation_engagement_master')->result_array();
    }

    public function getQualificationList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('qualification_name');

        return $this->db->get('council_affiliation_qualification_master')->result_array();
    }

    public function getVtcCourseByCourseName($tType = NULL, $id_hash = NULL)
    {
        $this->db->select('vtc_courses.vtc_course_id_pk, course_master.group_name, course_master.group_code');
        $this->db->from('council_affiliation_vtc_courses AS vtc_courses');
        $this->db->join('council_affiliation_course_master AS course_master', 'course_master.course_id_pk = vtc_courses.course_id_fk', 'left');
        $this->db->where("MD5(CAST(vtc_courses.vtc_id_fk as character varying)) =", $id_hash);
        $this->db->where('vtc_courses.active_status', 1);

        if ($tType == 1) {

            $this->db->where('vtc_courses.course_name_id_fk', 1);
        } elseif ($tType == 2) {

            $this->db->group_start();
            $this->db->where('vtc_courses.course_name_id_fk', 2);
            $this->db->or_where('vtc_courses.course_name_id_fk', 3);
            $this->db->group_end();
        } elseif ($tType == 3) {

            $this->db->where('vtc_courses.course_name_id_fk', 4);
        }

        $this->db->order_by('course_master.group_name');

        return $this->db->get()->result_array();
    }

    public function insertTeacherData($array = NULL)
    {
        $this->db->insert('council_affiliation_vtc_teachers', $array);

        return $this->db->insert_id();
    }

    public function getVtcTeacherList($vtc_id = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('active_status', 1);
        return $this->db->get('council_affiliation_vtc_teachers')->result_array();

        // this->db->get('council_affiliation_vtc_teachers', limit, offset);
    }
}

/* End of file Map_district_model.php */
