<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_sector_model extends CI_Model {
    public function insert($insert_array = NULL){
        return $this->db->insert($insert_array['table_name'],$insert_array['data']);
    }
    public function get_sector($limit = NULL, $offset = NULL){
        $query = $this->db->select("*")
            ->from("council_sector_master")
            ->where("active_status",1)
            ->limit($limit, $offset)
            ->order_by("sector_name","ASC")
            ->get();
        return $query->result_array();
    }
    public function get_sector_count(){
        $query = $this->db->select("count(sector_id_pk)")
            ->from("council_sector_master")
            ->get();
        return $query->result_array();
    }
    public function get_sector_details($sector_id_hash = NULL){
        $query = $this->db->select("*")
            ->from("council_sector_master")
            ->where("active_status",1)
            ->where("MD5(CAST(sector_id_pk as character varying)) =",$sector_id_hash)
            ->order_by("sector_name","ASC")
            ->get();
        return $query->result_array();
    }
	
	function get_course_name_count($course_name,$course_id_hash)
	{
		$query = $this->db->select('count(sector_id_pk) as course_id_count')
						  ->from('council_sector_master')
						  ->where(
							  array(
								  'sector_name'	=> $course_name,
								  'MD5(CAST(sector_id_pk AS character varying)) !='	=> $course_id_hash
							  )
						  )
						  ->get();
		return $query->result_array()[0]['course_id_count'];
    }
    
    function get_course_code_count($course_code,$course_id_hash)
	{
		$query = $this->db->select('count(sector_id_pk) as course_id_count')
						  ->from('council_sector_master')
						  ->where(
							  array(
								  'sector_code'	=> $course_code,
								  'MD5(CAST(sector_id_pk AS character varying)) !='	=> $course_id_hash
							  )
						  )
						  ->get();
		return $query->result_array()[0]['course_id_count'];
    }
    
    function update_course_details($update_array,$course_id_hash)
	{

		$this->db->where(
			array(
				'MD5(CAST(sector_id_pk AS character varying)) ='	=> $course_id_hash
			)
		)
			->update('council_sector_master',$update_array);
			
		return $this->db->affected_rows();

    }
}