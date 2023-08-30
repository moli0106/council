<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tc_reg_model extends CI_Model
{

    public function insert_data($table,$insert_data){

        $this->db->insert($table,$insert_data);
        return $this->db->insert_id();
    }

    public function getOrganizationDetails($organization_id){
        $this->db->select('organization_id_pk,mobile_no,tp_code');
        $this->db->from('council_organization_details');
        $this->db->where('organization_id_pk',$organization_id);
        $query=$this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function get_tc_countById($organization_id){
        $this->db->select('count(tc_id_pk)');
        $this->db->from('council_organization_tc_details');
        $this->db->where('organization_id_fk',$organization_id);
        $query=$this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function getTCListById($organization_id,$limit,$offset){

        $this->db->select('tc_id_pk,tc_name,mobile,email');
        $this->db->from('council_organization_tc_details');
        $this->db->where('organization_id_fk',$organization_id);
        $this->db->limit($limit,$offset);
        $query=$this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function getTCDetailById($tc_id_hash){
        $this->db->select('*');
        $this->db->from('council_organization_tc_details');
        $this->db->where("MD5(CAST(tc_id_pk as character varying)) =", $tc_id_hash);
        $query=$this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function get_last_certificate_no($chaking_data = NULL)
    {
        return $query = $this->db->select('max(tc_code) as code')
            ->from('council_organization_tc_details')
            ->like('tc_code', ($chaking_data))
            ->get()
            ->result_array();
    }

    public function getTcAllCourseList($tc_id){
        $this->db->select('tc_course.tc_course_id_pk,
        tc_course.sector_id_fk,
        tc_course.course_id_fk,
        course.course_code,
        course.course_name,
        sector.sector_code,
        sector.sector_name');
        $this->db->from('council_organization_tc_course_details as tc_course');
        $this->db->join('council_course_master as course','course.course_id_pk = tc_course.course_id_fk','left');
        $this->db->join('council_sector_master as sector','sector.sector_id_pk = tc_course.sector_id_fk','left');
        $this->db->where('tc_id_fk', $tc_id);
        $query=$this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
}