<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 *
 */
class Add_bank_details_model extends CI_Model
{

    public function getAssessorBankDetails($assessor_id = NULL)
    {
        $this->db->select('bank_ifsc, bank_account_holder_name, bank_account_no, bank_name, bank_branch_name');
        $this->db->from('council_assessor_registration_details');
        $this->db->where('assessor_registration_details_pk', $assessor_id);
        return $this->db->get()->result_array();
    }

    public function getBankDetailsByIfscCode($ifscCode = NULL)
    {
        $this->db->select('bank_name, bank_ifsc, branch');
        $this->db->from('council_bank_master_ifms');
        $this->db->where('bank_ifsc', $ifscCode);
        return $this->db->get()->result_array();
    }

    public function addBankDetails($assessor_id = NULL, $insertArray = NULL)
    {
        $this->db->where('assessor_registration_details_pk', $assessor_id);
        $this->db->update('council_assessor_registration_details', $insertArray);
        return $this->db->affected_rows();
    }
}
