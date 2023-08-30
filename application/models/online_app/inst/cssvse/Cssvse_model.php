<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cssvse_model extends CI_Model
{
    public function getSchoolDetailsByUdiseCode($udiseCode = NULL)
    {
        return $this->db->where('udise_code', $udiseCode)->get('council_cssvse_school_master')->result_array();
    }

    public function checkSchoolRegistratedData($udiseCode = NULL)
    {
        return $this->db->where('udise_code', $udiseCode)->where('active_status', 1)->get('council_cssvse_school_registration')->result_array();
    }

    public function checkSchoolRegistratedDataByIdHash($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(school_reg_id_pk as character varying)) =", $id_hash);
        return $this->db->get('council_cssvse_school_registration')->result_array();
    }

    public function getDistrictList()
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', 19)->order_by('district_name')->get('council_district_master')->result_array();
    }

    public function getMunicipalityByDistrict($district = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district)->order_by('block_municipality_name')->get('council_block_municipality_master')->result_array();
    }

    public function insertCssvseDetails($school_data = NULL)
    {
        $this->db->insert('council_cssvse_school_registration', $school_data);
        return $this->db->insert_id();
    }

    public function updateSchoolRegDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('school_reg_id_pk', $id);
        $this->db->update('council_cssvse_school_registration', $updateArray);

        return $this->db->affected_rows();
    }

    public function insertSchoolCredentials($schoolCredentials = NULL)
    {
        $this->db->insert('council_stake_holder_login', $schoolCredentials);

        return $this->db->insert_id();
    }
}
