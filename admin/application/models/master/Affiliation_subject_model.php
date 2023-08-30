<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_subject_model extends CI_Model
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

    public function insertData($table, $data){
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function getAllSubjectList(){
        $this->db->select('*');
        $this->db->where('active_status', 1);
        $this->db->order_by('subject_name_id_pk', ASC);
        $query = $this->db->get('council_affiliation_subject_master')->result_array();
        return $query;
    }

    public function updateSubjectData($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(subject_name_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_affiliation_subject_master', $updateArray);
        // echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

    public function get_same_subject_code($subject_code){

        $query = $this->db->select("count(subject_name_id_pk)")
            ->from("council_affiliation_subject_master")
            ->where(
                array(
                    "active_status" => 1,
                    "subject_code" => $subject_code,
                   
                )
            )
            ->get();
        return $query->row_array();
    }

    //**************** Developed by Abhijit Pradhan **********/



    public function getSubjectType($id_hash = NULL){

        $this->db->select('*');
        $this->db->where("MD5(CAST(subject_name_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get('council_affiliation_subject_master')->row_array();
        return $query;

    }

    public function getSubjectType_deta()
    {
        $this->db->select('*');
        $query = $this->db->get('council_affiliation_subject_type_master')->result_array();
        return $query;
    }

    public function updatesubjectTypeMaster($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(subject_name_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_affiliation_subject_master', $updateArray);
        // echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

    public function getautocomp_subject_data($sub = NULL)
    {
        $query = $this->db->query("select subject_name ,subject_code FROM council_affiliation_subject_master WHERE  subject_name ilike '%".$sub."%' and active_status = 1 and subject_type_id_fk = 1");
        // $this->db->query($query)
        // ->get();
        //   echo $this->db->last_query();exit;
            return $query->result_array();
    }

    public function get_subject_id($postsubjectcode_data = null)
    {
        $query = $this->db->select("subject_name_id_pk")
        ->from("council_affiliation_subject_master")
        ->where_in('subject_code',$postsubjectcode_data)
            
        ->get();
    return $query->result_array();
    }

    public function insertsdata($postsubcode = null)
    {
        $this->db->insert('council_affiliation_subject_master', $postsubcode);
        // echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    //**************End Code *************** //

}