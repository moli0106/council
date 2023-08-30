<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_qualification_model extends CI_Model {
    public function insert($insert_array = NULL){
        return $this->db->insert($insert_array['table_name'],$insert_array['data']);
    }
    public function get_qualification_count(){
        $query = $this->db->select("count(qualification_id_pk)")
            ->from("council_qualification")
            ->get();
        return $query->result_array();
    }
    public function get_qualification($limit = NULL, $offset = NULL){
        $query = $this->db->select("*")
            ->from("council_qualification")
            ->where(
                array(
                    "active_status" => 1
                )
            )
            ->limit($limit, $offset)
            ->get();
        return $query->result_array();
    }

    public function get_single_qualification($qualification_id_hash = NULL){
        $query = $this->db->select("*")
            ->from("council_qualification")

            ->where(
                array(
                    "MD5(CAST(qualification_id_pk AS character varying)) =" => $qualification_id_hash ,
                    "active_status" => 1
                )
            )
            ->order_by("qualification_id_pk","DESC")
            ->get();
        return $query->result_array();
    }
    public function delete_qualification($qualification_id_hash = NULL){
        $this->db->where('MD5(CAST(qualification_id_pk AS character varying)) =', $qualification_id_hash);
        return $this->db->delete('council_qualification');
    }




    /*public function get_sector_count(){
        $query = $this->db->select("count(course_id_pk)")
            ->from("council_course_master")
            ->get();
        return $query->result_array();
    }
    public function get_all_course(){
        $query = $this->db->select("sector_id_pk,sector_code,sector_name")
            ->from("council_sector_master")
            ->where(
                array(
                    "active_status" => 1,
                    "process_status_fk" => 5
                )
            )
            ->order_by("sector_name","ASC")
            ->get();
        return $query->result_array();
    }
    public function get_course_category(){
        $query = $this->db->select("course_category_id_pk, course_rate, category_name")
            ->from("pbssd_course_category")
            ->where("active_status",1)
            ->order_by("category_name","ASC")
            ->get();
        return $query->result_array();
    }
    public function get_course_project_type(){
        $query = $this->db->select("project_type_id_pk, project_type_name")
            ->from("pbssd_project_type_master")
            ->where("active_status",1)
            ->order_by("project_type_name","ASC")
            ->get();
        return $query->result_array();
    }
    public function get_single_course($course_id_hash = NULL){
        $query = $this->db->select("

            course.course_id_pk,
            course.course_name,
            course.course_code,
            sector.sector_id_pk,
            sector.sector_name,
            sector.sector_code,
            sector.sector_description,
            cat.course_category_id_pk,
            cat.category_name,
            cat.course_rate,
            project.project_type_id_pk,
            project.project_type_name,
            course.trainer_eligibility_criteria,
            course.minimum_educationl_qualification,
            course.domain_specific_working_experience,
            course.assessment_experience

            
            ")
            ->from("council_course_master as course")
            ->join("council_sector_master as sector", " course.sector_id_fk = sector.sector_id_pk")
            ->join("pbssd_course_category as cat", " course.course_category_id_fk = cat.course_category_id_pk", "LEFT")
            ->join("pbssd_project_type_master as project", " course.project_type_id_fk = project.project_type_id_pk","LEFT")

            ->where(
                array(
                    "MD5(CAST(course.course_id_pk AS character varying)) =" => $course_id_hash 
                )
            )
            ->order_by("course_id_pk","DESC")
            ->get();
        return $query->result_array();
    }
    public function delete_course($course_id_hash = NULL){
        $this->db->where('MD5(CAST(course_id_pk AS character varying)) =', $course_id_hash);
        return $this->db->delete('council_course_master');
    }

    public function get_domain_qualification($course_id_hash = NULL){
        $query = $this->db->select(
            "
            domain_map.course_qualification_map_id_pk,
            domain_map.domain_specific_working_experience,
            domain.domain_name,
            quali.qualification_id_pk,
            quali.qualification,
            course.course_id_pk,
            course.course_code,
            course.course_name,
            course.course_description,
            course.course_description,

            "
            )
            ->from("council_course_qualification_map as domain_map")
            ->join("council_qualification as quali","domain_map.qualification_id_fk = quali.qualification_id_pk")
            ->join("council_course_master as course","domain_map.course_id_fk = course.course_id_pk")
            ->join("council_domain_master as domain"," domain_map.domain_id_fk = domain.domain_id_pk")
            ->where(
                array(
                    "MD5(CAST(course_id_fk as character varying)) = " => $course_id_hash
                )
            )
            ->order_by("quali.qualification")
            ->get();
        return $query->result_array();

    }

    public function get_qualification(){
        $query = $this->db->select("*")
            ->from("council_qualification")
            ->where(
                array(
                    "active_status" => 1
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_domain(){
        $query = $this->db->select("*")
            ->from("council_domain_master")
            ->where(
                array(
                    "active_status" => 1
                )
            )
            ->get();
        return $query->result_array();
    }
    
    public function set_domain_map($map_array = NULL){
        return $this->db->insert('council_course_qualification_map', $map_array);
    }*/

    //public function get_course

}