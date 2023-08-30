<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 *
 */
class Add_other_job_role_model extends CI_Model {
    public function get_application_number_status(){
        $query = $this->db->select("*")
            ->from("council_assessor_registration_application_nubmer")
            ->where(
                array(
                    "assessor_registration_details_fk" => $this->session->stake_details_id_fk,
                    "active_status" => 1
                )
            )
            ->order_by("assessor_registration_application_no","DESC")
            ->limit(1)
            ->get();
        return $query->result_array();
    }

    public function apply_new_application($insert_array = NULL, $table = NULL){
        return $this->db->insert($table, $insert_array);
    }
}