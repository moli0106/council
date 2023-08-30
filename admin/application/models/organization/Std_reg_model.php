<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_reg_model extends CI_Model
{

    public function getOrgIdFromTCID($tc_id){
        //echo $tc_id;exit;
        $this->db->select('tc_id_pk,organization_id_fk,tc_name');
        $this->db->from('council_organization_tc_details');
        $this->db->where('tc_id_pk',$tc_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
    public function getOrganization_detailsById($OrgId){
        //echo $OrgId;exit;
        $this->db->select('*');
        //$this->db->select('*');
        $this->db->from('council_organization_details');
        $this->db->where('organization_id_pk',$OrgId);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }


    }

    public function getDuration($course_id){

        $this->db->select('duration');
        $this->db->from('council_affiliation_group_master');
        $this->db->where('assessment_course_id_fk',$course_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{

            $this->db->select('duration');
            $this->db->from('council_course_master');
            $this->db->where('course_id_pk',$course_id);
            $query1 = $this->db->get()->result_array();

            if(!empty($query1)){
                return $query1[0];
            }else{
                return array();
            }
        }
    }

    public function insert_data($table,$data_array){
        $this->db->insert($table,$data_array);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    

    public function get_student_countByID($id,$type){
        $this->db->select('count(student_details_id_pk)');
        $this->db->from('council_organization_student_details');
        if($type=='tc'){
            $this->db->where('tc_id_fk',$id);
        }elseif ($type=='org') {
            $this->db->where('organization_id_fk',$id);
        }
       $query = $this->db->get()->result_array();
       if(!empty($query)){
            return $query;
       }else{
            return array();
       }
    }

    public function get_all_student($id,$type){

        $this->db->select('std.student_details_id_pk,std.first_name,std.middle_name,std.last_name,course.course_code,course.course_name,sector.sector_code,sector.sector_name');
        $this->db->from('council_organization_student_details as std');
        $this->db->join('council_course_master as course','course.course_id_pk = std.course_id_fk');
        $this->db->join('council_sector_master as sector','sector.sector_id_pk = std.sector_id_fk');
        if($type=='tc'){
            $this->db->where('std.tc_id_fk',$id);
        }elseif ($type=='org') {
            $this->db->where('std.organization_id_fk',$id);
        }
        $this->db->where('std.active_status',1);
       $query = $this->db->get()->result_array();
       if(!empty($query)){
            return $query;
       }else{
            return array();
       }
    }

    public function update_data($table,$update_array,$organization_id)
    {
        $this->db->where('organization_id_pk', $organization_id);
        $this->db->update($table, $update_array);
        //echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

    public function getSectorByCourse_id($course_id){
        $this->db->select('sector_id_fk,course_id_pk');
        //$this->db->select('*');
        $this->db->from('council_course_master');
        $this->db->where('course_id_pk',$course_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }

    }

    //add on 04-08-2023
    public function getStdDetailsByID($id_hash){
        $this->db->select('*');
        $this->db->from('council_organization_student_details');
        $this->db->where("MD5(CAST(student_details_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }

    }

    public function gaetUploadedDocById($id_hash){

        $this->db->select('image,signature,aadhar_doc');
        $this->db->from('council_organization_student_details');
        $this->db->where("MD5(CAST(student_details_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
}