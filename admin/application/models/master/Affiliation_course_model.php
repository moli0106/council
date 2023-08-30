<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_course_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCourseMasterCount()
    {
        return $this->db->select("count(affiliation_course_master_id_pk)")
            ->from("council_affiliation_course_master")
            ->where('active_status', 1)
            ->get()->result_array();
    }

    public function getCourseList($limit = NULL, $offset = NULL)
    {
        $this->db->select('CM.*, CN.course_name, SM.streem_name, DM.discipline_name, subject_master.subject_name, subject_master.subject_code, category_master.subject_category_name');
        $this->db->from('council_affiliation_course_master AS CM');
        $this->db->join('council_affiliation_course_name_master AS CN', 'CN.course_name_id_pk = CM.course_name_id_fk', 'LEFT');
        $this->db->join('council_affiliation_streem_name_master AS SM', 'SM.streem_name_id_pk = CM.streem_name_id_fk', 'LEFT');
        $this->db->join('council_affiliation_discipline_master AS DM', 'DM.discipline_id_pk = CM.discipline_id_fk', 'LEFT');

        $this->db->join('council_affiliation_subject_master AS subject_master', 'subject_master.subject_name_id_pk = CM.subject_name_id_fk', 'LEFT');
        $this->db->join('council_qbm_subject_category_master AS category_master', 'category_master.subject_category_id_pk = CM.subject_category_id_fk', 'LEFT');

        $this->db->where("CM.active_status", 1);
        // $this->db->order_by("CN.course_name");
        // $this->db->order_by("CN.course_name");
        $this->db->order_by("CM.affiliation_course_master_id_pk");
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function getCourseNameList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("course_name");
        return $this->db->get('council_affiliation_course_name_master')->result_array();
    }

    public function getStreemNameList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("streem_name");
        return $this->db->get('council_affiliation_streem_name_master')->result_array();
    }

    public function getDisciplineList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("discipline_name");
        return $this->db->get('council_affiliation_discipline_master')->result_array();
    }
   

    public function insertCourseMaster($array)
    {
        $this->db->insert('council_affiliation_course_master', $array);
        // echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    // public function getCourseMasterByIdHash($id_hash = NULL)
    // {
    //     $this->db->where("MD5(CAST(course_id_pk as character varying)) =", $id_hash);
    //     return $this->db->get('council_affiliation_course_master')->result_array();
    // }

    public function updateCourseMaster($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(affiliation_course_master_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_affiliation_course_master', $updateArray);
        // echo $this->db->last_query();exit;

        return $this->db->affected_rows();
    }

    // Added by Moli for new Modification

    public function getGroupList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_group_master')->result_array();
    }
    
    public function getSubjectList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("subject_name");
        return $this->db->get('council_affiliation_subject_master')->result_array();
    }

    public function getSubjectCategory()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("subject_category_name");
        return $this->db->get('council_qbm_subject_category_master')->result_array();
    }

    public function getgroupDetailsById($group_id)
    {
        $this->db->where("active_status", 1);
        $this->db->where("group_id_pk",$group_id);
        return $this->db->get('council_affiliation_group_master')->row_array();
    }

    public function getCourseMasterByIdHash($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(affiliation_course_master_id_pk as character varying)) =", $id_hash);
        return $this->db->get('council_affiliation_course_master')->result_array();
    }
}

/* End of file Map_district_model.php */
