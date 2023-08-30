<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requested_std_model extends CI_Model
{

    public function getRequestedDataCount(){
        $query = $this->db->select("count(requested_student_details_id_pk)")
            ->from("council_vtc_requested_student_details")
            ->where(
                array(
                    //'active_status' => 1
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getAllRequestedData(){
        $this->db->select('request_data.*, group_master.group_name,group_master.group_code,vtc_master.vtc_name,vtc_master.vtc_code');
        $this->db->from('council_vtc_requested_student_details as request_data');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = request_data.group_id_fk','LEFT');
        $this->db->join('council_affiliation_vtc_master as vtc_master', 'vtc_master.vtc_id_pk = request_data.vtc_id_fk','LEFT');
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    
}