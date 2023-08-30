<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_course_model extends CI_Model {
    public function insert($insert_array = NULL){
        return $this->db->insert($insert_array['table_name'],$insert_array['data']);
    }
    public function get_course($limit = NULL, $offset = NULL){
        $query = $this->db->select("course.course_id_pk,course.course_code,course.course_name,sector.sector_code,sector.sector_name")
            ->from("council_course_master as course")
            ->join("council_sector_master as sector","course.sector_id_fk = sector.sector_id_pk")
            ->limit($limit, $offset)
            ->order_by("course_id_pk","DESC")
            ->get();
        return $query->result_array();
    }
    public function get_sector_count(){
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
            ->from("council_course_category")
            ->where("active_status",1)
            ->order_by("category_name","ASC")
            ->get();
        return $query->result_array();
    }
    public function get_course_project_type(){
        $query = $this->db->select("project_type_id_pk, project_type_name")
            ->from("council_project_type_master")
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
            course.assessment_experience,
            course.course_description,
            course.sector_id_fk,
            course.course_category_id_fk,
            course.project_type_id_fk,
			course.course_level

            
            ")
            ->from("council_course_master as course")
            ->join("council_sector_master as sector", " course.sector_id_fk = sector.sector_id_pk")
            ->join("council_course_category as cat", " course.course_category_id_fk = cat.course_category_id_pk", "LEFT")
            ->join("council_project_type_master as project", " course.project_type_id_fk = project.project_type_id_pk","LEFT")

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
    }

    //added parag 10-01-2021
    public function get_single_course_name($course_id_hash = NULL){
        $query = $this->db->select("course_name,course_code,course_id_pk")
            ->from("council_course_master")
            ->where(
                array(
                    "active_status" => 1,
                    "MD5(CAST(course_id_pk as character varying)) =" => $course_id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_domain_by_quali($qualification_id = NULL){
        $query = $this->db->select("domain.domain_id_pk,domain.domain_name")
            ->from("council_domain_master as domain")
            ->join("council_qualification_domain_map as map","domain.domain_id_pk = map.domain_id_fk")
            ->where(
                array(
                    "domain.active_status" => 1,
                    "map.qualification_id_fk" => $qualification_id
                )
            )
            ->get();
        return $query->result_array();

    }
    public function delete_course_qualification_map($map_id = NULL){
        $this->db->where('course_qualification_map_id_pk', $map_id);
        return $this->db->delete('council_course_qualification_map');
    }


//Update for Course details
    function get_course_name_count($course_name,$course_id_hash)
	{
		$query = $this->db->select('count(course_id_pk) as course_id_count')
						  ->from('council_course_master')
						  ->where(
							  array(
								  'course_name'	=> $course_name,
								  'MD5(CAST(course_id_pk AS character varying)) !='	=> $course_id_hash
							  )
						  )
						  ->get();
		return $query->result_array()[0]['course_id_count'];
    }
    
    function get_course_code_count($course_code,$course_id_hash)
	{
		$query = $this->db->select('count(course_id_pk) as course_id_count')
						  ->from('council_course_master')
						  ->where(
							  array(
								  'course_code'	=> $course_code,
								  'MD5(CAST(course_id_pk AS character varying)) !='	=> $course_id_hash
							  )
						  )
						  ->get();
		return $query->result_array()[0]['course_id_count'];
    }
    
    function update_course_details($update_array,$course_id_hash)
	{

		$this->db->where(
			array(
				'MD5(CAST(course_id_pk AS character varying)) ='	=> $course_id_hash
			)
		)
			->update('council_course_master',$update_array);
			
		return $this->db->affected_rows();

    }

    public function getSingleDomainQualification($domain_id_hash = NULL){
        $query = $this->db->select("domain_map.course_qualification_map_id_pk, domain_map.domain_specific_working_experience, domain.domain_name, quali.qualification")
            ->from("council_course_qualification_map as domain_map")
            ->join("council_qualification as quali","domain_map.qualification_id_fk = quali.qualification_id_pk")
            ->join("council_domain_master as domain"," domain_map.domain_id_fk = domain.domain_id_pk")
            ->where(
                array(
                    "MD5(CAST(course_qualification_map_id_pk as character varying)) = " => $domain_id_hash
                )
            )
            ->order_by("quali.qualification")
            ->get();
        return $query->result_array();
    }

    function updateDomainDetails($update_array, $domain_id_hash)
	{
		$this->db->where(
			array(
				"MD5(CAST(course_qualification_map_id_pk as character varying)) = " => $domain_id_hash
			)
		)
		->update('council_course_qualification_map', $update_array);
			
		return $this->db->affected_rows();

    }

    public function misJobRoleReport()
    {
        $query = $this->db->select("
            course.course_id_pk, 
            course.course_name, 
            course.course_code, 
            
            sector.sector_name, 
            sector.sector_code,
            
            course.minimum_educationl_qualification,
            course.domain_specific_working_experience,

            domain.domain_name
            
            ")
            ->from("council_course_master as course")
            ->join("council_sector_master as sector", " course.sector_id_fk = sector.sector_id_pk")
            ->join("council_course_qualification_map as maptable", " course.course_id_pk = maptable.course_id_fk")
            ->join("council_domain_master as domain", " domain.domain_id_pk = maptable.domain_id_fk")

            ->order_by("course.course_name", "ASC")
            ->get();
        
        return $query->result_array();
    }

    public function sectorWiseAssessor()
    {
        $query = $this->db->select('sector.sector_id_pk, sector.sector_name, course.course_name, assessor.assessor_registration_details_pk, CONCAT(assessor.fname, assessor.lname) AS assessor_name')
            ->from('council_sector_master AS sector')
            ->join('council_course_master AS course', 'course.sector_id_fk = sector.sector_id_pk', 'left')
            ->join('council_assessor_registration_jobrole_sector_map AS sector_map', 'sector_map.course_id_fk = course.course_id_pk', 'right')
            ->join('council_assessor_registration_details AS assessor', 'assessor.assessor_registration_details_pk = sector_map.assessor_registration_details_fk', 'left')
            ->order_by('sector_name', 'ASC')
            ->get();

        return $query->result_array();
    }
    
    //Update for Course details

}