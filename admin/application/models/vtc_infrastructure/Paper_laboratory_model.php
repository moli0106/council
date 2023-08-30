<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paper_laboratory_model extends CI_Model
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
            ->where('cavd.academic_year', $academic_year)
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
        // $this->db->where('course_id_pk NOT IN(SELECT course_id_fk FROM council_affiliation_vtc_vocational_paper_laboratory WHERE active_status=1 and vtc_id_fk='.$vtc_id_fk.')');

        $groupName = $this->db->get('council_affiliation_course_master')->result_array();

        // echo "<pre>";print_r($groupName);exit;


        if (!empty($groupName)) {
            return $groupName;
        } else {
            return array();
        }
    }

   

    public function getVTCPaperLabData($vtc_id = NULL){
        $this->db->select('paper_lab.*,group_master.group_name,item_master.item_name');
        $this->db->from('council_affiliation_vtc_vocational_paper_laboratory as paper_lab');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = paper_lab.group_id_fk');
        $this->db->join('council_affiliation_infrastructure_item_master as item_master', 'item_master.infrastructure_item_id_pk = paper_lab.infrastructure_item_id_fk');
        $this->db->where('paper_lab.vtc_id_fk', $vtc_id);
        $this->db->where('paper_lab.active_status', 1);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function getPaperLabDetails($id_hash = NULL){

        $this->db->select('paper_lab.*,group_master.group_name, item_master.item_name');
        $this->db->from('council_affiliation_vtc_vocational_paper_laboratory as paper_lab');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = paper_lab.group_id_fk');
        $this->db->join('council_affiliation_infrastructure_item_master as item_master', 'item_master.infrastructure_item_id_pk = paper_lab.infrastructure_item_id_fk');
        $this->db->where("MD5(CAST(paper_lab.vtc_vocational_paper_lab_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getInfrastructureItem($course_id = NULL, $vtc_id_fk = NULL){

       $query = $this->db->select('item_course_map.infrastructure_item_id_fk, item_course_map.course_id_fk, item_master.item_name')
                ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
                ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
                ->where('item_course_map.active_status', 1)
                ->where('item_course_map.course_id_fk', $course_id)
                ->where('item_master.category_name', 1)
                ->where('item_course_map.infrastructure_item_id_fk NOT IN(SELECT infrastructure_item_id_fk FROM council_affiliation_vtc_vocational_paper_laboratory WHERE active_status=1 and vtc_id_fk='.$vtc_id_fk.')')

                ->get();
        return $query->result_array();
            
    }

    public function insertPaperLabData($postData){

        $this->db->insert('council_affiliation_vtc_vocational_paper_laboratory',$postData);
        return $this->db->insert_id();
    }

    public function updatePaperLabData($updateArray = NULL,$lab_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(vtc_vocational_paper_lab_id_pk as character varying)) =", $lab_id_hash);
        $this->db->update('council_affiliation_vtc_vocational_paper_laboratory', $updateArray);
        return $this->db->affected_rows();
    }

    public function getVtcGroupList($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->select('
            DISTINCT(group_map.group_id_fk),
            
            group_master.group_name, 
            group_master.group_code, 
            group_master.group_id_pk
        ');
        $this->db->from('council_affiliation_vtc_course_selection as course_selection');
        $this->db->join('council_affiliation_vtc_course_selection_group_map as group_map', 'group_map.vtc_course_id_fk = course_selection.vtc_course_id_pk','LEFT');

        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk','LEFT');
        $this->db->where('course_selection.vtc_id_fk', $vtc_id_fk);
        $this->db->where('course_selection.academic_year', $academic_year);
        $this->db->where('course_selection.active_status', 1);
        
        // $this->db->where('group_id_pk NOT IN(SELECT group_id_fk FROM council_affiliation_vtc_vocational_paper_laboratory WHERE active_status=1 and vtc_id_fk='.$vtc_id_fk.')');

        $groupName = $this->db->get()->result_array();

        // echo "<pre>";print_r($groupName);exit;


        if (!empty($groupName)) {
            return $groupName;
        } else {
            return array();
        }
    }

}