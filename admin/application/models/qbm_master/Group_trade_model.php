<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_trade_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGroupTradeMasterCount()
    {
        return $this->db->select("count(group_trade_id_pk)")
            ->from("council_qbm_group_trade_master")
            ->where('active_status', 1)
            ->get()->result_array();
    }
    

    public function getGroupTradeList($limit = NULL, $offset = NULL)
    {
        $this->db->select('group_trade.group_trade_id_pk,group_trade.group_trade_name, group_trade.group_trade_code');
        $this->db->from('council_qbm_group_trade_master AS group_trade');
        $this->db->where("group_trade.active_status", 1);
        $this->db->order_by("group_trade.group_trade_name");
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function getDiscilineGroupTradeMapList($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("map.discipline_group_trade_map_id_pk,course.course_name,discipline.discipline_name,discipline.discipline_code,group.group_trade_name,group.group_trade_code")
            ->from("council_qbm_discipline_group_trade_map as map")
            ->join("council_qbm_course_master as course","course.course_id_pk = map.course_id_fk")
            ->join("council_qbm_discipline_master as discipline","discipline.discipline_id_pk = map.discipline_id_fk")
            ->join("council_qbm_group_trade_master as group","group.group_trade_id_pk = map.group_trade_id_fk")
            ->limit($limit, $offset)
            ->order_by("map.discipline_group_trade_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getCourseNameList()
    {
        $this->db->where("active_status", 1);
		$this->db->where_in("course_id_pk", array(1,2));
        $this->db->order_by("course_name");
        return $this->db->get('council_qbm_course_master')->result_array();
    }

    public function getDisciplineList($course_code = NULL){
        $query = $this->db->select("*")
            ->from("council_qbm_course_discipline_map as map")
            ->join("council_qbm_discipline_master as discipline","discipline.discipline_id_pk = map.discipline_id_fk","LEFT")
            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.course_id_fk"     => $course_code
                )
            )
            ->order_by("discipline_name", "ASC")
            ->get();
        return $query->result_array();
    }
   

    public function insertGroupTradeMaster($array)
    {
        $this->db->insert('council_qbm_group_trade_master', $array);
        return $this->db->insert_id();
    }

    public function get_same_course_discipline_group_trade_data($course_id,$discipline_id,$group_trade_id){
        $query = $this->db->select("count(map.discipline_group_trade_map_id_pk)")
            ->from("council_qbm_discipline_group_trade_map as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.course_id_fk" => $course_id,
                    "map.discipline_id_fk" => $discipline_id,
                    "map.group_trade_id_fk" => $group_trade_id,
                )
            )
            ->get();
        return $query->result_array();

    }

    public function map_course_discipline_group_trade($mapArray)
    {
        return $this->db->insert('council_qbm_discipline_group_trade_map', $mapArray); 
    }







}

/* End of file Map_district_model.php */
