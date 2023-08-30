<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Question_list_model extends CI_Model {
	
	public function get_question($limit = NULL, $offset = NULL){
		$query = $this->db->select("a.*,eng_question.*,b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,g.module_name,h.level_name,i.nos_name,g.module_name")
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
			
			
			->where(
				array(
					"a.active_status" 	=> 1,
					"b.active_status" 	=> 1,
					"c.active_status" 	=> 1
				)
			)
			->where_in('a.process_status_id_fk',array(6,5))
			->limit($limit, $offset)
			->order_by("question_id_pk","ASC")
			->get();
		return $query->result_array();
	   }
	
	   public function question_count(){
			$query = $this->db->select("count(question_id_pk)")
				->from("council_question_bank")
				
				->where(
					array(
						"active_status" => 1,
						//"sector_id" => $sectors_id
					)
				)
				->where_in('process_status_id_fk',array(6,5))
				->get();
			return $query->result_array();
	   }


	public function get_question_search($sector_id = NULL,$course_id = NULL,$programme_id = NULL,$question_for_id = NULL,$question_type_id = NULL) {
			
		$this->db->select("a.*,eng_question.*,b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,g.module_name,h.level_name,i.nos_name,g.module_name");
		
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
			
			$this->db->where(
				array(
					"a.active_status" 	=> 1,
					"b.active_status" 	=> 1,
					"c.active_status" 	=> 1
				)
			);
			$this->db->where_in('a.process_status_id_fk',array(6,5));
			
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
			//$this->db->order_by('final_submission_time','ASC');
			$query =  $this->db->get();
		return $query->result_array();
	}



	public function get_question_details_by_id($id_hash = NULL){
		$query = $this->db->select("a.*,eng_question.*,b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,g.module_name,h.level_name,i.nos_name,g.module_name")
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
			
			
			->where(
				array(
					"a.active_status" 	=> 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $id_hash,
					"b.active_status" 	=> 1,
					"c.active_status" 	=> 1
				)
			)
			->where_in('a.process_status_id_fk',array(6,5))
			->order_by("question_id_pk","ASC")
			->get();
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
