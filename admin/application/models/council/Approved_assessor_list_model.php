<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approved_assessor_list_model extends CI_Model {
	
   public function get_assessor($limit = NULL, $offset = NULL){
    $query = $this->db->select("appno.final_submission_status,b.assessor_registration_application_no,appno.process_status_id_fk,assessor.assessor_registration_details_pk, upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,assessor.assessor_code,appno.final_submission_time,process.process_name,c.course_name,d.sector_name,dist.district_name")
        ->from("council_assessor_registration_application_nubmer as appno")
        ->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
        ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
        //->from("council_assessor_registration_details as assessor")
        //->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT")
		 ->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no","LEFT")
        ->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT")
        ->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT")
        ->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT")
		->join("council_assessor_empanelled_map AS empanelled", "empanelled.assessor_id_fk = assessor.assessor_registration_details_pk AND empanelled.sector_id_fk = d.sector_id_pk AND empanelled.course_id_fk = c.course_id_pk", "LEFT")
		
		//->join("council_batch_assessor_map AS cbam", "cbam.assessor_id_fk = assessor.assessor_registration_details_pk", "LEFT")
        //->join("council_batch_ems AS cbems", "cbems.batch_ems_id_pk = cbam.batch_ems_id_fk AND cbems.sector_id = d.sector_id_pk AND cbems.course_id = c.course_id_pk", "LEFT")
		
        ->where(
            array(
                "assessor.active_status" => 1,
                "appno.process_status_id_fk" => 5,
                "b.active_status" => 1,
                "b.process_status_id_fk" => 5,
				"empanelled.empanelled_id_pk" => NULL,
				//"cbam.assessor_id_fk" => NULL
            )
        )
        ->limit($limit, $offset)
        //->group_by("assessor.assessor_registration_details_pk,sector.sector_name")
        ->order_by("assessor_name")
        ->get();
    return $query->result_array();
   }

   public function assessor_count(){
    $query = $this->db->select("count(assessor.assessor_registration_details_pk)")
        ->from("council_assessor_registration_application_nubmer as appno")
        ->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
        ->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT")
        //->from("council_assessor_registration_details as assessor")
        //->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT")
		->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no","LEFT")
        ->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT")
        ->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT")
        ->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT")
		->join("council_assessor_empanelled_map AS empanelled", "empanelled.assessor_id_fk = assessor.assessor_registration_details_pk AND empanelled.sector_id_fk = d.sector_id_pk AND empanelled.course_id_fk = c.course_id_pk", "LEFT")
    ->where(
        array(
            "assessor.active_status" => 1,
            "appno.process_status_id_fk" => 5,
            "b.active_status" => 1,
            "b.process_status_id_fk" => 5,
			"empanelled.empanelled_id_pk" => NULL
        )
    )
    ->get();
    return $query->result_array();

   }

   public function get_assessor_search($pan_no = NULL) {
        
    $this->db->select("appno.final_submission_status,b.assessor_registration_application_no,appno.process_status_id_fk,assessor.assessor_registration_details_pk, upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,assessor.assessor_code,appno.final_submission_time,process.process_name,c.course_name,d.sector_name,dist.district_name");
        $this->db->from("council_assessor_registration_application_nubmer as appno");
        $this->db->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk");
        $this->db->join("council_process_master as process","appno.process_status_id_fk = process.process_id_pk","LEFT");
        //->from("council_assessor_registration_details as assessor")
        //$this->db->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk","LEFT");
		$this->db->join("council_assessor_registration_jobrole_sector_map as b","b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no","LEFT");
        $this->db->join("council_course_master as c","c.course_id_pk=b.course_id_fk","LEFT");
        $this->db->join("council_sector_master as d","d.sector_id_pk=c.sector_id_fk","LEFT");
        $this->db->join("council_district_master as dist","dist.district_id_pk=assessor.permanent_district_id_fk","LEFT");
		$this->db->join("council_assessor_empanelled_map AS empanelled", "empanelled.assessor_id_fk = assessor.assessor_registration_details_pk AND empanelled.sector_id_fk = d.sector_id_pk AND empanelled.course_id_fk = c.course_id_pk", "LEFT");
        
        $this->db->where("assessor.active_status", 1);
        $this->db->where("appno.process_status_id_fk", 5);
        $this->db->where("b.process_status_id_fk", 5);
        //$this->db->where("assessor.final_flag", TRUE);
        $this->db->where("b.active_status", 1);
		$this->db->where("empanelled.empanelled_id_pk", NULL);
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




// public function get_assessor_submission_time(){
//     $query = $this->db->select("assessor.assessor_registration_details_pk,appno.final_submission_status,appno.assessor_registration_application_no,appno.process_status_id_fk, upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) as assessor_name,assessor.pan,assessor.mobile_no,assessor.email_id,assessor.assessor_code,appno.final_submission_status, appno.assessor_registration_application_no,appno.process_status_id_fk as application_no_status,
//     assessor.process_status_id_fk as assessor_table_status, assessor.final_submission_time as assessor_table_time,appno.final_submission_time as appno_table_time")
//         ->from("council_assessor_registration_application_nubmer as appno")
//         ->join("council_assessor_registration_details as assessor","appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
        
//         ->where(
//             array(
//                 "assessor.active_status" => 1,
//                 "appno.process_status_id_fk" => 5,
//                 "assessor.process_status_id_fk" => 5,
//                 "appno.assessor_registration_application_no" => 1,
                
//             )
//         )
        
//         ->order_by("assessor.fname")
//         ->get();
//     return $query->result_array();
//    }

        
   
}