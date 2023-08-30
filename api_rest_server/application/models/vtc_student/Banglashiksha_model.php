<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Banglashiksha_model extends CI_Model
{
    public function getDistrictIdByCode($district_code = NULL){

        $query =  $this->db->from('council_district_master')->where('schcd', $district_code)->get()->row_array();
        return $query;
    }
  
    public function getBlockIdByCode($block_code = NULL){

        $query =  $this->db->from('council_block_municipality_master')->where('schcd', $block_code)->get()->row_array();
        return $query;
    }
    
    public function getCasteIdByCode($caste_code = NULL){

        $query =  $this->db->from('council_caste_master')->where('code', $caste_code)->get()->row_array();
        return $query;
    }
}