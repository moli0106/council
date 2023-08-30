<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tc_reg_model extends CI_Model
{

    public function getTcDetailsByIdHash($id_hash){
        $this->db->select('tc_id_pk,email,tc_name,organization_mobile,tc_email_verify_status,organization_mobile_verify_status,organization_mobile_otp');
        $this->db->from('council_organization_tc_details');
        $this->db->where("MD5(CAST(tc_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function updateTcDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('tc_id_pk', $id);
        $this->db->update('council_organization_tc_details', $updateArray);

        return $this->db->affected_rows();
    }

    public function insertTcCredentials($tcCredentials = NULL)
    {
        $this->db->insert('council_stake_holder_login', $tcCredentials);

        return $this->db->insert_id();
    }

}