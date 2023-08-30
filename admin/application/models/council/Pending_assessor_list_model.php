<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending_assessor_list_model extends CI_Model {
	
   public function get_assessor($limit = NULL, $offset = NULL){
    $ignore = array(5, 6);
    $query = $this->db->select("appno.final_submission_status,appno.assessor_registration_application_no,appno.process_status_id_fk,assessor.assessor_registration_details_pk, upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,assessor.assessor_code,appno.final_submission_time,process.process_name,c.course_name,d.sector_name,dist.district_name")
        ->from("council_assessor_registration_application_nubmer as appno")
        ->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
        ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
        //->from("council_assessor_registration_details as assessor")
        ->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no","LEFT")
        ->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT")
        ->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT")
        ->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT")
        //->join("council_process_master as process","assessor.process_status_id_fk = process.process_id_pk","LEFT")
        ->where(
            array(
                "assessor.active_status" => 1,
                "b.active_status" => 1,
                "appno.final_submission_status" => 1
            )
        )
        ->where_not_in("appno.process_status_id_fk",$ignore)
		//->where("b.process_status_id_fk", NULL, FALSE)
        ->limit($limit, $offset)
        //->group_by("assessor.assessor_registration_details_pk,sector.sector_name")
        ->order_by("assessor_name")
        ->get();
    return $query->result_array();
   }

   public function assessor_count(){
    $ignore = array(5, 6);
    $query = $this->db->select("count(assessor.assessor_registration_details_pk)")
        ->from("council_assessor_registration_application_nubmer as appno")
        ->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
        ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
        //->from("council_assessor_registration_details as assessor")
        ->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no","LEFT")
        ->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT")
        ->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT")
        ->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT")
    ->where(
        array(
            "assessor.active_status" => 1,
            "b.active_status" => 1,
            "appno.final_submission_status" => 1
        )
    )
	//->where("b.process_status_id_fk", NULL, FALSE)
    ->where_not_in("appno.process_status_id_fk",$ignore)
    ->get();
    return $query->result_array();

   }

   public function get_assessor_search($pan_no = NULL,$submit_date = NULL) {
    $ignore = array(5, 6);
    $this->db->select("appno.final_submission_status,appno.assessor_registration_application_no,appno.process_status_id_fk,assessor.assessor_registration_details_pk, upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,assessor.assessor_code,appno.final_submission_time,process.process_name,c.course_name,d.sector_name,dist.district_name");
        $this->db->from("council_assessor_registration_application_nubmer as appno");
        $this->db->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk");
        $this->db->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT");
        //->from("council_assessor_registration_details as assessor")
        //$this->db->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT");
		$this->db->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no","LEFT");
        $this->db->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT");
        $this->db->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT");
        $this->db->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT");
        
        $this->db->where("assessor.active_status", 1);
        $this->db->where("appno.final_submission_status", 1);
        $this->db->where("b.active_status", 1);
        $this->db->where_not_in("appno.process_status_id_fk",$ignore);
		//$this->db->where("b.process_status_id_fk", NULL, FALSE);
        if($pan_no != NULL){
            $this->db->where('assessor.pan', $pan_no);
        }
        if($submit_date != NULL){
            $this->db->where('CAST(appno.final_submission_time as date) =', $this->date_format_change($submit_date));
        }
		
        $this->db->order_by('assessor_name');
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

public function date_format_change($uk_date = NULL){
    $parts = explode("-", $uk_date);
    return  $parts[2] . "-" . $parts[1] . "-" . $parts[0];
}

        
   
}