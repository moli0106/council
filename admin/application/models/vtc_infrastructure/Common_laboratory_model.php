<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_laboratory_model extends CI_Model
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

    public function getVtcDisciplineList($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        // $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_courses')->result_array();
        // echo "<pre>";print_r($query);exit;

        if(!empty($query)){

            $hs_voc_discipline= explode(",",$query[0]['hs_voc_discipline']);
        

            $stc_discipline= explode(",",$query[0]['stc_discipline']);

            $disciplineArray = array_merge($hs_voc_discipline,$stc_discipline);

            // ! get Group name

            
            $this->db->where_in('discipline_id_pk', $disciplineArray);
            $this->db->where('active_status', 1);
            // $this->db->where('discipline_id_pk NOT IN(SELECT discipline_id_fk FROM council_affiliation_vtc_other_common_laboratory WHERE active_status=1 and vtc_id_fk='.$vtc_id_fk.')');

            $disciplineName = $this->db->get('council_affiliation_discipline_master')->result_array();

            // echo "<pre>";print_r($disciplineName);exit;


            if (!empty($disciplineName)) {
                return $disciplineName;
            } else {
                return array();
            }
        }else{
            return array();
        }

        
    }

    public function getInfrastructureItem($discipline_id = NULL, $course_name_id= NULL, $vtc_id= NULL){

        $query = $this->db->select('item_course_map.infrastructure_item_id_fk, item_master.item_name')
                ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
                ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
                ->where('item_course_map.active_status', 1)
                ->where('item_course_map.discipline_id_fk', $discipline_id)
                ->where('item_course_map.course_name_id_fk', $course_name_id)
                ->group_by('item_course_map.infrastructure_item_id_fk')
                ->group_by('item_master.item_name')
                ->where('item_master.category_name', 2)
                ->where('item_course_map.infrastructure_item_id_fk NOT IN(SELECT infrastructure_item_id_fk FROM council_affiliation_vtc_other_common_laboratory WHERE active_status=1 and vtc_id_fk='.$vtc_id.')')

                ->get();
                // echo $this->db->last_query();exit;
        return $query->result_array();
             
    }

    public function getDisciplineName_old($course_name_id,$vtc_id_fk = NULL, $academic_year = NULL){

        if($course_name_id == 1){
            $this->db->select('hs_voc_discipline as discipline');
        }else{
            $this->db->select('stc_discipline as discipline');
        }
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_courses')->result_array();
        // echo "<pre>";print_r($query);exit;

        if(!empty($query)){

            $disciplineArray = explode(",",$query[0]['discipline']);

            // ! get Group name

            
            $this->db->where_in('discipline_id_pk', $disciplineArray);
            $this->db->where('active_status', 1);
            // $this->db->where('discipline_id_pk NOT IN(SELECT discipline_id_fk FROM council_affiliation_vtc_other_common_laboratory WHERE active_status=1 and vtc_id_fk='.$vtc_id_fk.')');

            $disciplineName = $this->db->get('council_affiliation_discipline_master')->result_array();

            // echo "<pre>";print_r($disciplineName);exit;


            if (!empty($disciplineName)) {
                return $disciplineName;
            } else {
                return array();
            }
        }else{
            return array();
        }

    }

    public function insertCommonLabData($postArray){

        $this->db->insert('council_affiliation_vtc_other_common_laboratory', $postArray);
        return $this->db->insert_id();
    }

    public function getAllCommonLabData($vtc_id = NULL, $academic_year = NULL){

        $query = $this->db->select('cmn_lab.*, item_master.item_name, discipline.discipline_name')
                ->from('council_affiliation_vtc_other_common_laboratory as cmn_lab')
                ->join('council_affiliation_infrastructure_item_master as item_master', 'cmn_lab.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk','left')
                ->join('council_affiliation_discipline_master as discipline', 'cmn_lab.discipline_id_fk = discipline.discipline_id_pk','left')
                ->where('cmn_lab.active_status',1)
                ->where('cmn_lab.vtc_id_fk' , $vtc_id)
                ->where('cmn_lab.academic_year' , $academic_year)
                ->get();
            return $query->result_array();
    }

    public function getCommonLabDetailsById($lab_id_hash = NULL){

        $query = $this->db->select('cmn_lab.*, item_master.item_name, discipline.discipline_name')
        ->from('council_affiliation_vtc_other_common_laboratory as cmn_lab')
        ->join('council_affiliation_infrastructure_item_master as item_master', 'cmn_lab.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk','left')
        ->join('council_affiliation_discipline_master as discipline', 'cmn_lab.discipline_id_fk = discipline.discipline_id_pk','left')
        ->where('cmn_lab.active_status',1)
        ->where('MD5(CAST(cmn_lab.vtc_other_common_lab_id_pk as character varying)) =' , $lab_id_hash)
        ->get();
        return $query->row_array();
    }

    public function updateCommonLabData($updateArray = NULL,$lab_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(vtc_other_common_lab_id_pk as character varying)) =", $lab_id_hash);
        $this->db->update('council_affiliation_vtc_other_common_laboratory', $updateArray);
        return $this->db->affected_rows();
    }

    public function getDisciplineName($course_name_id,$vtc_id_fk = NULL, $academic_year = NULL){

        
        $this->db->select('
            DISTINCT(course_selection.discipline_id_fk),
            course_selection.vtc_id_fk,
            course_selection.course_name_id_fk,
            course_selection.academic_year,
            course_selection.active_status,
            discipline_master.discipline_id_pk, 
            discipline_master.discipline_name
        ');
        $this->db->from('council_affiliation_vtc_course_selection as course_selection');
        $this->db->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = course_selection.discipline_id_fk');
        $this->db->where('course_selection.vtc_id_fk', $vtc_id_fk);
        $this->db->where('course_selection.academic_year', $academic_year);
        $this->db->where('course_selection.active_status', 1);
        $this->db->where('course_selection.course_name_id_fk', $course_name_id);

        $disciplineName = $this->db->get()->result_array();
        // echo "<pre>";print_r($disciplineName);exit;

    
        if (!empty($disciplineName)) {
            return $disciplineName;
        } else {
            return array();
        }
       

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

    public function checkVtcHSCourseExist($vtc_id = NULL, $academic_year = NULL){
        $this->db->select('*');
        $this->db->from('council_affiliation_vtc_course_selection');
        $this->db->where(
            array(
                'vtc_id_fk' => $vtc_id,
                'active_status'=>1,
                'academic_year' => $academic_year,
                'course_name_id_fk'=> 1
            )
        );
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }

    }

}