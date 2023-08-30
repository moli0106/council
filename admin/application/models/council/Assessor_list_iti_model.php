<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_list_iti_model extends CI_Model {
	
//    public function get_assessor($limit = NULL, $offset = NULL){
//     $query = $this->db->select("assessor.assessor_registration_details_pk, upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,assessor.assessor_code,c.course_name,d.sector_name,working_master.working_name,working_map.centre_code,working_map.centre_name,working_master.working_id_pk")
//         ->from("council_assessor_registration_details as assessor")
//         ->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT")
//         ->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT")
//         ->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT")
//         //->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT")
// 		->JOIN("council_assessor_working_map as working_map","assessor.assessor_registration_details_pk = working_map.assessor_id_fk","LEFT")
// 		->JOIN("council_assessor_working_master as working_master" ,"working_master.working_id_pk = working_map.working_id_fk","LEFT")
//         ->where(
//             array(
//                 "assessor.active_status" => 1,
//                 //"assessor.process_status_id_fk" => 5,
//                 "b.active_status" => 1,
//                 //"b.process_status_id_fk" => 5
//             )
//         )
//         ->limit($limit, $offset)
//         //->group_by("assessor.assessor_registration_details_pk,sector.sector_name")
//         ->order_by("assessor.fname")
//         ->get();
//     return $query->result_array();
//    }


public function get_assessor($limit = NULL, $offset = NULL){
    $query = $this->db->select("distinct(assessor.assessor_registration_details_pk), upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,work_experience_map.organisation_name,work_experience_map.area_of_work")
        ->from("council_assessor_registration_details as assessor")
		->JOIN("council_assessor_work_experience_map as work_experience_map" ,"work_experience_map.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT")
        ->where(
            array(
                "assessor.active_status" => 1,
                "assessor.final_flag"=>TRUE
            )
        )
        ->limit($limit, $offset)
        //->group_by("assessor.assessor_registration_details_pk,sector.sector_name")
        ->order_by("assessor.assessor_registration_details_pk")
        ->get();
    return $query->result_array();
   }

   public function assessor_count(){
    $query = $this->db->select("count(distinct(assessor.assessor_registration_details_pk))")
    ->from("council_assessor_registration_details as assessor")
    ->JOIN("council_assessor_work_experience_map as work_experience_map" ,"work_experience_map.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT")
    ->where(
        array(
            "assessor.active_status" => 1,
            "assessor.final_flag"=>TRUE
        )
    )
    ->get();
    return $query->result_array();

   }

   public function get_assessor_search($pan_no = NULL, $working_id = NULL) {
        
    $this->db->select("distinct(assessor.assessor_registration_details_pk), upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,work_experience_map.organisation_name,work_experience_map.area_of_work");
        $this->db->from("council_assessor_registration_details as assessor");
        
		$this->db->JOIN("council_assessor_work_experience_map as work_experience_map" ,"work_experience_map.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT");
        //$this->db->join("council_process_master as process","assessor.process_status_id_fk = process.process_id_pk","LEFT");
        
        $this->db->where("assessor.active_status", 1);
        $this->db->where("assessor.final_flag", TRUE);
        if($pan_no != NULL){
            $this->db->where('assessor.pan', $pan_no);
        }
		
		
        //$this->db->order_by('final_submission_time','ASC');
        //$this->db->group_by("assessor.assessor_registration_details_pk,sector.sector_name");
        $query =  $this->db->get();
    return $query->result_array();
}

   

public function getSectorJobRole($id_hash)
{
    $query = $this->db->select("sector.sector_name, course.course_name")
        ->from("council_assessor_empanelled_map as caem")
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

public function get_all_working_master()
{
    $query = $this->db->select("working_id_pk, working_name")
        ->from("council_assessor_working_master")
        ->where(
            array(
                "active_status" => 1,
            )
        )
		->order_by("sort_order")
        ->get();
    return $query->result_array();
}

        
   
}