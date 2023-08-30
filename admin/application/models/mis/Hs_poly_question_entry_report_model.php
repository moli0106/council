<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hs_poly_question_entry_report_model extends CI_Model {
	
   

   public function get_question_bank_report($limit = NULL, $offset = NULL){
    $query = $this->db->select("course.course_name,semester.semester_name,discipline.discipline_name,group_trade.group_trade_name,group_trade.group_trade_code,sub_cat.subject_category_name,
subject.subject_name,subject.subject_code,qcm_details.fname||' '||qcm_details.mname||' '||qcm_details.lname as qc_name,qcm_details.email_id,qcm_details.mobile_no,qcm_details.creator_moderator_code,
count(CASE WHEN qbm_main.process_status_id_fk = 1 AND qbm_main.active_status = 1 THEN 1 ELSE NULL END) as new_question,
count(CASE WHEN qbm_main.process_status_id_fk = 16 AND qbm_main.active_status = 1 THEN 1 ELSE NULL END) as question_set_submitted,
count(CASE WHEN qbm_main.process_status_id_fk = 5 AND qbm_main.active_status = 1 THEN 1 ELSE NULL END) as question_set_approved")
        ->from("council_qbm_question_creator_moderator_details as qcm_details")
        ->join('council_qbm_question_bank as qbm_main','qbm_main.entry_by = qcm_details.creator_moderator_id_pk',"LEFT")
        ->join('council_qbm_course_master as course','course.course_id_pk = qbm_main.course_id',"LEFT")
		
        ->join('council_qbm_semester_master as semester','semester.semester_id_pk = qbm_main.sam_year_id',"LEFT")
        ->join('council_qbm_subject_master as subject','subject.subject_id_pk = qbm_main.subject_id',"LEFT")
        ->join('council_qbm_subject_semester_group_trade_map as sub_map','sub_map.subject_id_fk = subject.subject_id_pk',"LEFT")
        ->join('council_qbm_discipline_master as discipline','discipline.discipline_id_pk = sub_map.discipline_id_fk',"LEFT")
        
        ->join('council_qbm_group_trade_master as group_trade','group_trade.group_trade_id_pk = sub_map.group_trade_id_fk',"LEFT")
        ->join('council_qbm_subject_category_master as sub_cat','sub_cat.subject_category_id_pk = sub_map.sub_cat_id_fk',"LEFT")

        /*->where(
            array(
                "qbm_main.active_status" 	=> 1
            )
        )*/
        ->limit($limit, $offset)
        ->group_by("sub_cat.subject_category_name,group_trade.group_trade_name,group_trade.group_trade_code,discipline.discipline_name,subject.subject_name,subject.subject_code,semester.semester_name,
course.course_name,qcm_details.fname,qcm_details.mname,qcm_details.lname,qcm_details.email_id,qcm_details.mobile_no,qcm_details.creator_moderator_code")
        ->order_by("course.course_name","ASC")
        ->get();
    return $query->result_array();
   }

   public function question_bank_report_count(){

    $sql="select count(*) from (
        SELECT count(qcm_details.creator_moderator_id_pk)
		from council_qbm_question_creator_moderator_details as qcm_details
		LEFT JOIN council_qbm_question_bank as qbm_main on qbm_main.entry_by = qcm_details.creator_moderator_id_pk
		LEFT JOIN council_qbm_course_master as course on course.course_id_pk = qbm_main.course_id
		LEFT JOIN council_qbm_semester_master as semester on semester.semester_id_pk = qbm_main.sam_year_id
		LEFT JOIN council_qbm_subject_master as subject on subject.subject_id_pk = qbm_main.subject_id
		LEFT JOIN council_qbm_subject_semester_group_trade_map as sub_map on sub_map.subject_id_fk = subject.subject_id_pk
		LEFT JOIN council_qbm_discipline_master as discipline on discipline.discipline_id_pk = sub_map.discipline_id_fk
		LEFT JOIN council_qbm_group_trade_master as group_trade on group_trade.group_trade_id_pk = sub_map.group_trade_id_fk
		LEFT JOIN council_qbm_subject_category_master as sub_cat on sub_cat.subject_category_id_pk = sub_map.sub_cat_id_fk

		
		GROUP BY sub_cat.subject_category_name,group_trade.group_trade_name,group_trade.group_trade_code,discipline.discipline_name,subject.subject_name,subject.subject_code,semester.semester_name,
		course.course_name,qcm_details.fname,qcm_details.mname,qcm_details.lname,qcm_details.email_id,qcm_details.mobile_no
		ORDER BY course.course_name ) as a
        ";    
    $query = $this->db->query($sql);
    return $query->result_array();
    

   }

        
   
}