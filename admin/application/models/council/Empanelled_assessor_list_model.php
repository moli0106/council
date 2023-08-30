<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empanelled_assessor_list_model extends CI_Model {
	
   public function get_assessor($limit = NULL, $offset = NULL){
    $query = $this->db->select("assessor.assessor_registration_details_pk,upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.email_id,assessor.assessor_code,assessor.mobile_no,assessor.process_status_id_fk,assessor.post_opffice,assessor.police,sector.sector_name,c.course_name,dist.district_name as permanent_district ,present_dist.district_name as present_district,assessor.certified_by_any_assessor,caem.empanelment_validity,caem.course_grouping_status,caem.course_id_fk as emp_course_id")
        ->from("council_assessor_empanelled_map as caem")
        ->join("council_assessor_registration_details as assessor","assessor.assessor_registration_details_pk = caem.assessor_id_fk","LEFT")
        ->join("council_sector_master as sector","sector.sector_id_pk = caem.sector_id_fk","LEFT")
        ->join("council_course_master as c","c.course_id_pk=caem.course_id_fk","LEFT")
        ->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT")
        ->join("council_district_master as present_dist","present_dist.district_id_pk=assessor.district_id_fk","LEFT")
        ->where(
            array(
                "assessor.active_status" => 1,
                "assessor.process_status_id_fk" => 5,
                "caem.active_status" => 1,
            )
        )
        ->limit($limit, $offset)
        //->group_by("assessor.assessor_registration_details_pk,sector.sector_name")
        ->order_by("sector.sector_name,assessor.fname,caem.course_grouping_status")
        ->get();
    return $query->result_array();
   }

   public function assessor_count(){
        $query = $this->db->select("count(assessor.assessor_registration_details_pk)")
            ->from("council_assessor_empanelled_map as caem")
            ->join("council_assessor_registration_details as assessor","assessor.assessor_registration_details_pk = caem.assessor_id_fk","LEFT")
            ->where(
                array(
                    "assessor.active_status" => 1,
                    "assessor.process_status_id_fk" => 5,
                    "caem.active_status" => 1,
                    
                )
            )
            ->get();
        return $query->result_array();
   }

   public function get_assessor_search($pan_no = NULL ,$ssc_wbsctvesd_certified = NULL) {
        
    $this->db->select("assessor.assessor_registration_details_pk,upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.email_id,assessor.assessor_code,assessor.mobile_no,assessor.process_status_id_fk,sector.sector_name,c.course_name,dist.district_name as permanent_district ,present_dist.district_name as present_district,assessor.certified_by_any_assessor,caem.empanelment_validity,caem.course_grouping_status,caem.course_id_fk as emp_course_id");
        $this->db->from("council_assessor_empanelled_map as caem");
        $this->db->join("council_assessor_registration_details as assessor","assessor.assessor_registration_details_pk = caem.assessor_id_fk");
        $this->db->join("council_sector_master as sector","sector.sector_id_pk = caem.sector_id_fk","LEFT");
        $this->db->join("council_course_master as c","c.course_id_pk=caem.course_id_fk","LEFT");
        $this->db->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT");
        $this->db->join("council_district_master as present_dist","present_dist.district_id_pk=assessor.district_id_fk","LEFT");
        //$this->db->join("council_salutation_master as salutation","assessor.salutation_id_fk = salutation.salutation_id_pk","LEFT");
        //$this->db->join("council_process_master as process","assessor.process_status_id_fk = process.process_id_pk","LEFT");
        
        $this->db->where("assessor.active_status", 1);
        $this->db->where("assessor.final_flag", TRUE);
        $this->db->where("caem.active_status", 1);
        if($pan_no != NULL){
            $this->db->where('assessor.pan', $pan_no);
        }
		
        //$this->db->order_by('final_submission_time','ASC');
        //$this->db->group_by("assessor.assessor_registration_details_pk,sector.sector_name");
        $this->db->order_by("sector.sector_name");
        $this->db->order_by("assessor.fname");
        $query =  $this->db->get();
    return $query->result_array();
}

   

public function getSectorJobRole($id_hash)
{
    $query = $this->db->select("sector.sector_name, course.course_name,assessor.assessor_registration_details_pk,upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,caem.course_id_fk,caem.sector_id_fk")
        ->from("council_assessor_empanelled_map as caem")
        ->join("council_assessor_registration_details as assessor","assessor.assessor_registration_details_pk = caem.assessor_id_fk","LEFT")
        ->join("council_sector_master as sector", "caem.sector_id_fk = sector.sector_id_pk")
        ->join("council_course_master as course", "caem.course_id_fk = course.course_id_pk")
        ->where(
            array(
                "MD5(CAST(caem.assessor_id_fk as character varying)) =" => $id_hash,
                "caem.active_status" => 1,
            )
        )
        ->get();
    return $query->result_array();
}

public function get_course_map_details($course_ids,$emp_course_id)
{
    $query = $this->db->select("course.course_id_pk, ccg.course_grouping_id_fk,course.course_name,sector.sector_id_pk,sector.sector_name")
        ->from("council_course_grouping as ccg")
        ->join("council_course_master as course", "ccg.course_grouping_id_fk = course.course_id_pk")
        ->join("council_sector_master as sector", "course.sector_id_fk = sector.sector_id_pk")
        ->where(
            array(
                "ccg.active_status" => 1,
                "MD5(CAST(ccg.course_id_fk as character varying)) =" => $emp_course_id,
            )
        )
        ->where_not_in("course.course_id_pk",$course_ids)
        //->where_in("sector.sector_id_pk",$sector_ids)
        ->get();
    return $query->result_array();
}

public function getAssesserInformation($assessor_id_hash = NULL){
    $query = $this->db->select("assessor.assessor_registration_details_pk")
        ->from("council_assessor_registration_details as assessor")
        
        ->where(
            array(
                "assessor.active_status" => 1,
                "assessor.process_status_id_fk" => 5,
                "MD5(CAST(assessor.assessor_registration_details_pk as character varying)) =" => $assessor_id_hash,
            )
        )
        
        ->get();
    return $query->result_array();
   }

   public function getCourseInformation($course_id = NULL){
    $query = $this->db->select("course.course_id_pk,course.sector_id_fk")
        ->from("council_course_master as course")
        
        ->where(
            array(
                "course.active_status" => 1,
                //"course.process_status_id_fk" => 5,
                "course.course_id_pk" => $course_id,
                
            )
        )
        
        ->get();
    return $query->result_array();
   }

   public function getEmpanelmentValidityInformation($course_emp_id_hash = NULL, $assessor_id_hash = NULL){
    $query = $this->db->select("assessor_emp.empanelment_validity")
        ->from("council_assessor_empanelled_map as assessor_emp")
        
        ->where(
            array(
                "assessor_emp.active_status" => 1,
                
                "MD5(CAST(assessor_emp.assessor_id_fk as character varying)) =" => $assessor_id_hash,
                "MD5(CAST(assessor_emp.course_id_fk as character varying)) =" => $course_emp_id_hash,
            )
        )
        
        ->get();
    return $query->result_array();
   }

   public function createEmpanelledAssessorMap($array)
    {
        $this->db->insert('council_assessor_empanelled_map', $array);

        return $this->db->insert_id();
    }
        
   
}