<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration_model extends CI_Model
{

    public function check_index_number($index_number,$courses){

        $this->db->select('student_details_id_pk,apply_for_counselling,counselling_otp,counselling_mobile_verify_status');
        $this->db->from('council_polytechnic_counselling_student_data');
        $this->db->where('index_number',$index_number);
        $this->db->where('exam_type_id_fk',$courses);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }


    }

    public function updateStdDetails($id = NULL, $updateArray = NULL)
    {
        
		
        $this->db->where('student_details_id_pk', $id);

        $this->db->update('council_polytechnic_counselling_student_data', $updateArray);

        return $this->db->affected_rows();
    }

    public function getStdDetailsByIdHash($id_hash){

        $this->db->select('student_details_id_pk,candidate_name,apply_for_counselling,counselling_otp,counselling_mobile_verify_status,index_number,mobile_number');
        $this->db->from('council_polytechnic_counselling_student_data');
       $this->db->where("MD5(CAST(student_details_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
    public function insertStdCredentials($vtcCredentials = NULL)
    {
		//echo "<pre>";print_r($vtcCredentials);
        $this->db->insert('council_stake_holder_login', $vtcCredentials);
		//echo $this->db->last_query();exit;

        return $this->db->insert_id();
    }
}