<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_group_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertData($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function getAllGroupList(){
        $this->db->select('*');
        $this->db->where('active_status', 1);
        $this->db->order_by('group_name');
        $query = $this->db->get('council_affiliation_group_master')->result_array();
        return $query;
    }

    public function updateGroupMaster($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(group_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_affiliation_group_master', $updateArray);
        // echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

    public function get_same_group_code($group_code){

        $query = $this->db->select("count(group_id_pk)")
            ->from("council_affiliation_group_master")
            ->where(
                array(
                    "active_status" => 1,
                    "group_code" => $group_code,
                   
                )
            )
            ->get();
        return $query->row_array();
    }

    public function getGroupDetails($id_hash = NULL){

        $this->db->select('*');
        $this->db->where("MD5(CAST(group_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get('council_affiliation_group_master')->row_array();
        return $query;

    }
}