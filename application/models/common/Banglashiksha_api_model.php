<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Banglashiksha_api_model extends CI_Model {

   public function getDistrictIdByCode($district_code = NULL){

      // echo $district_code;exit;
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

   public function getReligionIdByCode($religion_code = NULL){

      $query =  $this->db->from('council_religion_master')->where('code', $religion_code)->get()->row_array();
      return $query;
   }

   public function getGenderIdByCode($gender_code = NULL){

      $query =  $this->db->from('council_gender_master')->where('code', $gender_code)->get()->row_array();
      return $query;
   }
}