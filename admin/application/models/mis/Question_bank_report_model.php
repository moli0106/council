<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_bank_report_model extends CI_Model {
	
   

   public function get_question_bank_report($limit = NULL, $offset = NULL){
    $query = $this->db->select("b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,h.level_name,i.nos_name,g.module_name,qc.fname||' '||qc.mname||' '||qc.lname as paper_setter_name,count(a.question_id_pk) as questions_entered,qm.fname||' '||qm.mname||' '||qm.lname as paper_moderator_name,count(CASE WHEN a.process_status_id_fk=5 OR a.process_status_id_fk=6 THEN 1 END) as questions_moderated,a.question_for_id")
        ->from("council_question_bank as a")
        ->join('council_question_bank_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
        ->join('council_sector_master as b','a.sector_id=b.sector_id_pk',"LEFT")
        ->join('council_course_master as c','a.course_id=c.course_id_pk',"LEFT")
        ->join('council_programme_master as d','a.programme_id=d.programme_id_pk',"LEFT")
        ->join('council_question_for_master as e','a.question_for_id=e.question_for_id_pk',"LEFT")
        ->join('council_question_type_master as f','a.question_type_id=f.question_type_id_pk',"LEFT")
        
        ->join('council_question_level_master as h','a.level_id=h.level_id_pk',"LEFT")
        ->join('council_assessment_nos_course_marks_master as i','a.nos_id=i.course_marks_id_pk',"LEFT")
        ->join('council_question_module_master as g','a.module_id=g.module_id_pk',"LEFT")
        ->join('council_stake_holder_login as login','login.stake_holder_login_id_pk=a.entry_by',"LEFT")
        ->join('council_question_creator_moderator_details as qc','qc.creator_moderator_id_pk=login.stake_details_id_fk',"LEFT")

        ->join('council_stake_holder_login as login_qm','login_qm.stake_holder_login_id_pk=a.approve_reject_by',"LEFT")
        ->join('council_question_creator_moderator_details as qm','qm.creator_moderator_id_pk=login_qm.stake_details_id_fk',"LEFT")

        ->where(
            array(
                "a.active_status" 	=> 1,
                "b.active_status" 	=> 1,
                "c.active_status" 	=> 1,
            )
        )
        //->where_in('eng_question.process_status_id_fk',array(0,6))
        ->limit($limit, $offset)
        ->group_by("b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,g.module_name,h.level_name,i.nos_name,g.module_name,qc.creator_moderator_id_pk,qm.creator_moderator_id_pk,a.question_for_id")
        ->order_by("b.sector_name","ASC")
        ->get();
    return $query->result_array();
   }

   public function question_bank_report_count(){

    $sql="select count(*) from (
        SELECT count(cm.creator_moderator_id_pk) as total_creator_moderator
        FROM council_question_bank as a
        LEFT JOIN council_question_bank_english_lang as eng_question ON a.question_id_pk=eng_question.question_id_fk
        LEFT JOIN council_sector_master as b ON a.sector_id=b.sector_id_pk
        LEFT JOIN council_course_master as c ON a.course_id=c.course_id_pk
        LEFT JOIN council_programme_master as d ON a.programme_id=d.programme_id_pk
        LEFT JOIN council_question_for_master as e ON a.question_for_id=e.question_for_id_pk
        LEFT JOIN council_question_type_master as f ON a.question_type_id=f.question_type_id_pk
        LEFT JOIN council_question_level_master as h ON a.level_id=h.level_id_pk
        LEFT JOIN council_assessment_nos_course_marks_master as i ON a.nos_id=i.course_marks_id_pk
        LEFT JOIN council_question_module_master as g ON a.module_id=g.module_id_pk
        LEFT JOIN council_stake_holder_login as login ON login.stake_holder_login_id_pk=eng_question.entry_by
        LEFT JOIN council_question_creator_moderator_details as cm ON cm.creator_moderator_id_pk=login.stake_details_id_fk
        WHERE a.active_status = 1
        AND b.active_status = 1
        AND c.active_status = 1
        GROUP BY b.sector_name, c.course_name, d.programme_name, e.question_for_name, f.question_type_name, g.module_name, h.level_name, 
        i.nos_name, g.module_name, cm.creator_moderator_id_pk ) as a
        ";    
    $query = $this->db->query($sql);
    return $query->result_array();
    

   }

   public function question_bank_report_search($sector_id = NULL,$course_id = NULL,$programme_id = NULL,$question_for_id = NULL,$question_type_id = NULL, $limit = NULL, $offset = NULL) {
    $this->db->select("b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,h.level_name,i.nos_name,g.module_name,qc.fname||' '||qc.mname||' '||qc.lname as paper_setter_name,count(a.question_id_pk) as questions_entered,qm.fname||' '||qm.mname||' '||qm.lname as paper_moderator_name,count(CASE WHEN a.process_status_id_fk=5 OR a.process_status_id_fk=6 THEN 1 END) as questions_moderated,a.question_for_id");
    $this->db->from("council_question_bank as a");
    $this->db->join('council_question_bank_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT");
    $this->db->join('council_sector_master as b','a.sector_id=b.sector_id_pk',"LEFT");
    $this->db->join('council_course_master as c','a.course_id=c.course_id_pk',"LEFT");
    $this->db->join('council_programme_master as d','a.programme_id=d.programme_id_pk',"LEFT");
    $this->db->join('council_question_for_master as e','a.question_for_id=e.question_for_id_pk',"LEFT");
    $this->db->join('council_question_type_master as f','a.question_type_id=f.question_type_id_pk',"LEFT");
        
    $this->db->join('council_question_level_master as h','a.level_id=h.level_id_pk',"LEFT");
    $this->db->join('council_assessment_nos_course_marks_master as i','a.nos_id=i.course_marks_id_pk',"LEFT");
    $this->db->join('council_question_module_master as g','a.module_id=g.module_id_pk',"LEFT");
    $this->db->join('council_stake_holder_login as login','login.stake_holder_login_id_pk=a.entry_by',"LEFT");
    $this->db->join('council_question_creator_moderator_details as qc','qc.creator_moderator_id_pk=login.stake_details_id_fk',"LEFT");

    $this->db->join('council_stake_holder_login as login_qm','login_qm.stake_holder_login_id_pk=a.approve_reject_by',"LEFT");
    $this->db->join('council_question_creator_moderator_details as qm','qm.creator_moderator_id_pk=login_qm.stake_details_id_fk',"LEFT");
        $this->db->where("a.active_status", 1);
        $this->db->where("b.active_status", 1);
        $this->db->where("c.active_status", 1);
        
        if($sector_id != NULL){
            $this->db->where('a.sector_id', $sector_id);
        }
        if($course_id != NULL){
            $this->db->where('a.course_id', $course_id);
        }
        if($programme_id != NULL){
            $this->db->where('a.programme_id', $programme_id);
        }
        if($question_for_id != NULL){
            $this->db->where('a.question_for_id', $question_for_id);
        }
        if($question_type_id != NULL){
            $this->db->where('a.question_type_id', $question_type_id);
        }
		$this->db->limit($limit, $offset);
        $this->db->group_by("b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,g.module_name,h.level_name,i.nos_name,g.module_name,qc.creator_moderator_id_pk,qm.creator_moderator_id_pk,a.question_for_id");
        $this->db->order_by("b.sector_name","ASC");

        $query =  $this->db->get();
    return $query->result_array();
}

   

// Added by Waseem 
public function get_all_sector(){
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

public function get_course_query($sector_id){
    $query = $this->db->select('course_id_pk,course_code,course_name')
    ->from('council_course_master')
    ->where('sector_id_fk',$sector_id)
    ->order_by('course_name')
       ->get();
    //echo $this->db->last_query(); 
       return $query->result_array();
}

public function get_programmes_query(){
    $query = $this->db->select('*')
    ->from('council_programme_master')
    ->where('active_status',1)
    //->order_by('course_name')
       ->get();
    //echo $this->db->last_query(); 
       return $query->result_array();
}
// public function get_levels_query(){
//     $query = $this->db->select('*')
//     ->from('council_question_level_master')
//     ->where('active_status',1)
//     //->order_by('course_name')
//        ->get();
//     //echo $this->db->last_query(); 
//        return $query->result_array();
// }

public function get_questions_type_query(){
    $query = $this->db->select('*')
    ->from('council_question_type_master')
    ->where('active_status',1)
    //->order_by('course_name')
       ->get();
    //echo $this->db->last_query(); 
       return $query->result_array();
}

public function get_questions_type_trainee_query(){
    $query = $this->db->select('*')
    ->from('council_question_type_master')
    ->where('active_status',1)
    ->where('question_type_id_pk',1)
    //->order_by('course_name')
       ->get();
    //echo $this->db->last_query(); 
       return $query->result_array();
}
public function get_questions_for_query(){
    $query = $this->db->select('*')
    ->from('council_question_for_master')
    ->where('active_status',1)
    //->order_by('course_name')
       ->get();
    //echo $this->db->last_query(); 
       return $query->result_array();
}
        
   
}