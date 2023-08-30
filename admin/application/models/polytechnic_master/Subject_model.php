<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_subject_count(){
        $query = $this->db->select("count(subject_id_pk)")
        ->from("council_qbm_subject_master")
        ->get();
         return $query->result_array();
    }

    public function get_all_subject($limit = NULL, $offset = NULL){
        $this->db->select('subject_id_pk,subject_name,subject_code')
       ->from('council_qbm_subject_master')
       ->where('active_status',1)
       ->limit($limit, $offset)
        ->order_by('subject_id_pk','ASC');
       $query = $this->db->get();
       return $query->result_array(); 
    }

    public function insertData($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

   

    public function get_same_discipline_code($discipline_code){

        $query = $this->db->select("count(subject_id_pk)")
            ->from("council_qbm_subject_master")
            ->where(
                array(
                    "active_status" => 1,
                    "discipline_code" => $discipline_code,
                   
                )
            )
            ->get();
        return $query->row_array();
    }

    public function get_all_semester(){
        $query = $this->db->select('*')
        ->from('council_qbm_semester_master')
        ->where('active_status', 1)->get();
        return $query->result_array();
    }

    
}