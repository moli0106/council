<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Discipline_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_discipline($limit = NULL, $offset = NULL){
       $this->db->select('discipline_id_pk,discipline_name,discipline_code')
       ->from('council_qbm_discipline_master')
       ->where('active_status',1)
       ->limit($limit, $offset)
        ->order_by('discipline_id_pk','ASC');
       $query = $this->db->get();
       return $query->result_array(); 
    }

    public function get_all_discipline_count(){
        $query = $this->db->select("count(discipline_id_pk)")
        ->from("council_qbm_discipline_master")
        ->get();
         return $query->result_array();
    }

    public function insertData($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

   

    public function get_same_discipline_code($discipline_code){

        $query = $this->db->select("count(discipline_id_pk)")
            ->from("council_qbm_discipline_master")
            ->where(
                array(
                    "active_status" => 1,
                    "discipline_code" => $discipline_code,
                   
                )
            )
            ->get();
        return $query->row_array();
    }

    public function getDisciplineDetails($id_hash= NULL){
        $this->db->select('discipline_id_pk,discipline_name,discipline_code')
        ->from('council_qbm_discipline_master')
        ->where('active_status',1)
        ->where("MD5(CAST(discipline_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get();
        return $query->row_array(); 
    }

    public function updateDisciplineMaster($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(discipline_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_qbm_discipline_master', $updateArray);
        // echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
}
?>