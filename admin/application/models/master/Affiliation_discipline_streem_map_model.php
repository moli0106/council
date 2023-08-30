<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_discipline_streem_map_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
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

    public function insertBatchData($table, $data)
    {
        $this->db->insert_batch($table, $data);

        return true;
    }

    public function getAllMapList(){
        $this->db->select('discipline_streem_map.*,streem_master.streem_name,discipline_master.discipline_name')
        ->from('council_affiliation_discipline_streem_mapping as discipline_streem_map')
        ->join('council_affiliation_streem_name_master as streem_master', 'streem_master.streem_name_id_pk = discipline_streem_map.streem_name_id_fk')
        ->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = discipline_streem_map.discipline_id_fk');
        $query = $this->db->get()->result_array();
        return $query;
    
    }
}