<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_model extends CI_Model
{
    public function getVtcType()
    {
        return $this->db->where('active_status', 1)->order_by('vtc_type_name')
            ->get('council_affiliation_vtc_type_master')->result_array();
    }

    public function getMediumOfInstruction()
    {
        return $this->db->where('active_status', 1)->order_by('medium_of_instruction')
            ->get('council_affiliation_medium_of_instruction_master')->result_array();
    }

    public function getDistrictList()
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', 19)->order_by('district_name')
            ->get('council_district_master')->result_array();
    }

    public function getSubDivisionByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('subdiv_name')
            ->get('council_subdiv_master')->result_array();
            // echo $this->db->last_query();exit;
    }

    public function getNodalOfficerByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('nodal_centre_name')
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getNodalOfficerByWhereInDistrictId($kolkataArray = NULL)
    {
        return $this->db->where('active_status', 1)->where_in('district_id_fk', $kolkataArray)->order_by('nodal_centre_name')
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getMunicipalityByDivisionId($sub_division_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('subdiv_id_fk', $sub_division_id)->order_by('block_municipality_name')
            ->get('council_block_municipality_master')->result_array();
    }

    public function getVtcDetailsByCode($vtcCode = NULL)
    {
        return $this->db->where('vtc_code', $vtcCode)->get('council_affiliation_vtc_master')->result_array();
    }

    public function getVtcMasterList()
    {
        return $this->db->where('vtc_active_status', 1)->order_by('vtc_name')->get('council_affiliation_vtc_master')->result_array();
    }

    public function checkVtcName($vtcName = NULL)
    {
        return $this->db->where('vtc_name', $vtcName)->get('council_affiliation_vtc_master')->result_array();
    }

    public function insertVtcMasterDetails($vtcMasterArray = NULL)
    {
        $this->db->insert('council_affiliation_vtc_master', $vtcMasterArray);

        return $this->db->insert_id();
    }

    public function checkVtcByAcademicYear($vtcMasterId = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtcMasterId);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_vtc_details')->result_array();
    }

    public function insertVtcDetails($vtcDetailsArray = NULL)
    {
        $this->db->insert('council_affiliation_vtc_details', $vtcDetailsArray);

        return $this->db->insert_id();
    }

    public function checkVerifiedAcademicYear($vtcMasterId = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtcMasterId);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('vtc_email_verify_status', 1);

        return $this->db->get('council_affiliation_vtc_details')->result_array();
    }

    public function batchInsertNearByVtc($batchArray = NULL)
    {
        $this->db->insert_batch('council_affiliation_nearby_vtc', $batchArray);
    }

    public function getVtcDetailsByIdHash($id_hash)
    {
        $this->db->select('cavd.*, cavm.vtc_name, cavm.vtc_code, cavm.vtc_type')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->where("MD5(CAST(cavd.vtc_details_id_pk as character varying)) =", $id_hash);
        return $this->db->get()->result_array();
    }

    public function checkVtcAcademicYearActive($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_vtc_details')->result_array();
    }

    public function updateVtcDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('vtc_details_id_pk', $id);
        $this->db->update('council_affiliation_vtc_details', $updateArray);

        return $this->db->affected_rows();
    }
    

    public function insertVtcCredentials($vtcCredentials = NULL)
    {
        $this->db->insert('council_stake_holder_login', $vtcCredentials);

        return $this->db->insert_id();
    }

    public function getVtcGroupTradeCode_old($vtcCourse = NULL)
    {
        $this->db->where('course_name_id_fk', $vtcCourse);
        $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    // Added By Moli on 12-08-2022

    public function getVtcGroupTradeCode($vtcCourse = NULL)
    {
        $this->db->select('DISTINCT(course_id_pk),group_name,group_code');
        
        $this->db->where('course_name_id_fk', $vtcCourse);
        $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_course_master')->result_array();
    }
    // Added By Moli on 20-07-2022

    public function getHoiDesignationList()
    {
        return $this->db->where('active_status', 1)->order_by('designation_name')
            ->get('council_affiliation_hoi_designation_master')->result_array();
    }
    public function getDesignationNameById($designation_id)
    {
        return $this->db->where('active_status', 1)->where('hoi_designation_id_pk',$designation_id)
            ->get('council_affiliation_hoi_designation_master')->row_array();
    }

    public function getInstituteCategory()
    {
        return $this->db->where('active_status', 1)->order_by('category_name')
            ->get('council_affiliation_institute_category_master')->result_array();
    }
    public function getDisabilityList()
    {
        return $this->db->where('active_status', 1)->order_by('disability_name')
            ->get('council_disability_master')->result_array();
    }
    public function getdisadvantageGroupList()
    {
        return $this->db->where('active_status', 1)->order_by('disadvantage_group_name')
            ->get('council_disadvantage_group_master')->result_array();
    }


    // Generic Institute Registration create Moli on 13-01-2023
    public function getInstituteDetailsByCode($vtcCode = NULL)
    {
        return $this->db->where('college_code', $vtcCode)->get('council_polytechnic_spotcouncil_college_master')->result_array();
    }

    public function updateVTCMaster($id = NULL, $updateArray = NULL)
    {
        $this->db->where('vtc_id_pk', $id);
        $this->db->update('council_affiliation_vtc_master', $updateArray);

        return $this->db->affected_rows();
    }
}
