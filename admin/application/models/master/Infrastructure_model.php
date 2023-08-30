<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Infrastructure_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getdisciplineList(){

        $this->db->where('active_status', 1);
        $this->db->order_by('discipline_name');

        $query = $this->db->get('council_affiliation_discipline_master')->result_array();
        return $query;
    }

    

    public function getAllInfrastructureItem($limit = NULL, $offset = NULL){

        $query = $this->db->select("*")
        ->from("council_affiliation_infrastructure_item_master")
        ->where('active_status', 1)
        ->limit($limit, $offset)
        ->order_by("item_name")
        ->get()->result_array();

       

        foreach ($query as $key => $value) {
           $item_id = $value['infrastructure_item_id_pk'];

           $checkItemId = $this->db->select("count(infrastructure_item_course_map_id_pk)")
            ->from("council_affiliation_infrastructure_item_course_map")
            ->where(
                array(
                    'active_status' => 1,
                    'infrastructure_item_id_fk' => $item_id
                )
            )
            ->get()->row_array();

            if($checkItemId['count'] != 0){
                $map_status = 'yes';
            }else{

                $map_status = 'no';

            }
            $query[$key]['map_status'] = $map_status;
        }
        return $query;
    }

    public function getAllInfrastructureMapCourseList($limit = NULL, $offset = NULL){

        $query = $this->db->select('item_course_map.*, course_name.course_name, discipline_master.discipline_name, item_master.item_name, group_master.group_name,group_master.group_code')
            ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
            ->join('council_affiliation_course_name_master as course_name', 'item_course_map.course_name_id_fk = course_name.course_name_id_pk', 'LEFT')
            ->join('council_affiliation_discipline_master as discipline_master', 'item_course_map.discipline_id_fk = discipline_master.discipline_id_pk', 'LEFT')
            ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
            ->join('council_affiliation_group_master as group_master', 'item_course_map.course_id_fk = group_master.group_id_pk', 'LEFT')
            ->where('item_course_map.active_status', 1)
            ->get();
        return $query->result_array();

    }

    public function insertInfrastructureItem($array)
    {
        $this->db->insert('council_affiliation_infrastructure_item_master', $array);

        return $this->db->insert_id();
    }

    

    

    public function getgroupByDisciplineId($course_name_id =NULL, $discipline_id = NULL){

       
        $this->db->select('DISTINCT(course_id_pk),group_code,group_name');
        $this->db->where(
            array(
                'course_name_id_fk' => $course_name_id,
                'active_status' => 1,
                'discipline_id_fk' => $discipline_id
            )
        );
        $this->db->order_by('group_name');
        $query = $this->db->get('council_affiliation_course_master')->result_array();
       
        // echo "<pre>";print_r($query);exit;

        if (!empty($query)) {
            return $query;
        } else {
            return array();
        }

    }

    public function insertMultipleData($table, $array = NULL)
    {

        $this->db->insert_batch($table, $array);

        return true;
    }

    public function deleteInfrastructureItem($item_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(infrastructure_item_id_pk as character varying)) =", $item_id);
        $this->db->update('council_affiliation_infrastructure_item_master', $updateArray);
        return $this->db->affected_rows();
    }

    public function getInfrastructureItemDetails($item_id = NULL){
       
        $query = $this->db->select("*")
        ->from("council_affiliation_infrastructure_item_master")
        ->where('active_status', 1)
        ->where("MD5(CAST(infrastructure_item_id_pk as character varying)) =", $item_id)
        ->get()->row_array();
        return $query;
    }

    public function updateMapData($map_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(infrastructure_item_course_map_id_pk as character varying)) =", $map_id);
        $this->db->update('council_affiliation_infrastructure_item_course_map', $updateArray);
        return $this->db->affected_rows();
    }

    public function getInfrastructureMapDetails($map_id = NULL){

        $query = $this->db->select('item_course_map.*, course_name.course_name, discipline_master.discipline_name, item_master.item_name, course_master.group_name')
            ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
            ->join('council_affiliation_course_name_master as course_name', 'item_course_map.course_name_id_fk = course_name.course_name_id_pk', 'LEFT')
            ->join('council_affiliation_discipline_master as discipline_master', 'item_course_map.discipline_id_fk = discipline_master.discipline_id_pk', 'LEFT')
            ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
            ->join('council_affiliation_course_master as course_master', 'item_course_map.course_id_fk = course_master.course_id_pk', 'LEFT')
            ->where('item_course_map.active_status', 1)
            ->where("MD5(CAST(infrastructure_item_course_map_id_pk as character varying)) =", $map_id)
            ->get();
        return $query->row_array();
    }

    public function updateInfrastructureItem($updateArray = NULL,$id = NULL)
    {
        $this->db->where("MD5(CAST(infrastructure_item_id_pk as character varying)) =", $id);
        $this->db->update('council_affiliation_infrastructure_item_master', $updateArray);

        return $this->db->affected_rows();
    }

    public function getCourseNameList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("course_name");
        return $this->db->get('council_affiliation_course_name_master')->result_array();
    }
}