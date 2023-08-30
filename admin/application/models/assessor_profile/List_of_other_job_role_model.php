<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 *
 */
class List_of_other_job_role_model extends CI_Model {
    public function get_applications(){
        $query = $this->db->select("*")
            ->from("council_assessor_registration_application_nubmer")
            ->where(
                array(
                    "assessor_registration_details_fk" => $this->session->stake_details_id_fk,
                    "assessor_registration_application_no IS NOT NULL" => NULL,
                    "assessor_registration_application_no != " =>1  
                )
            )
            ->order_by("assessor_registration_application_no","ASC")
            ->get();
        return $query->result_array();
    }
}