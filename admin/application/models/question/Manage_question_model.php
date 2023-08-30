<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Manage_question_model extends CI_Model {

	public function get_sectors_query($stake_details_id_fk){
		$query = $this->db->select('b.sector_id_pk,b.sector_code,b.sector_name')
		->from('council_question_creator_moderator_sector_map as a')
		->join('council_sector_master as b','a.sector_id_fk=b.sector_id_pk')
		->where('a.active_status',1)
		->where('a.creator_moderator_id_fk',$stake_details_id_fk)
		->order_by('sector_name')
	   	->get();
	   	return $query->result_array();
	}
	
	public function get_question($limit = NULL, $offset = NULL,$sectors_ids = NULL){
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
					//"sector_id" 		=> $sectors_id,
					"b.active_status" 	=> 1,
					"c.active_status" 	=> 1,
					// "e.active_status" 	=> 1,
					// "f.active_status" 	=> 1,
					// "g.active_status" 	=> 1,
					// "h.active_status" 	=> 1,
				)
			)
			->where_in('a.sector_id',$sectors_ids)
			->where_in('a.process_status_id_fk',array(0,6))
			->limit($limit, $offset)
			->order_by("question_id_pk","ASC")
			->get();
		return $query->result_array();
	   }
	
	   public function question_count($sectors_id=NULL){
			$query = $this->db->select("count(question_id_pk)")
				->from("council_question_bank")
				
				->where(
					array(
						"active_status" => 1,
						//"sector_id" => $sectors_id
					)
				)
				->where_in('process_status_id_fk',array(0,6))
				->where_in('sector_id',$sectors_id)
				->get();
			return $query->result_array();
	   }


	public function updateQuestion_status($id_hash, $updateArray)
	{
		$this->db->where(
			array(
				'MD5(CAST(question_id_pk AS character varying)) =' => $id_hash
			)
		)
		->update('council_question_bank',$updateArray);
			
		return $this->db->affected_rows();

    }

//For Question edit

	public function get_question_details($question_id_hash = NULL){
		$query = $this->db->select("a.*,eng_question.*")
			->from("council_question_bank as a")
			->join('council_question_bank_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			->where(
				array(
					"a.active_status" => 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $question_id_hash
				)
			)
			->get();
		return $query->result_array();
	   }

	public function question_update_main_qui_bank($question_id_hash , $data)
	{	
		 $this->db->trans_start();
		 $this->db->where(
    		array(
    			'md5(CAST(question_id_pk AS character varying)) =' =>  $question_id_hash
    		)
    	);
		$this->db->update('council_question_bank',$data);
		$affected_rows = $this->db->affected_rows();	
		$this->db->trans_complete(); 
		if ($affected_rows== 1) {
			$this->db->trans_commit();
			return TRUE;
		} 
		else {
			$this->db->trans_rollback();
			return FALSE;
		}
	}

	public function question_update_eng_lang($question_id_hash , $data)
	{	
		 $this->db->trans_start();
		 $this->db->where(
    		array(
    			'md5(CAST(question_id_fk AS character varying)) =' =>  $question_id_hash
    		)
    	);
		$this->db->update('council_question_bank_english_lang',$data);
		$affected_rows = $this->db->affected_rows();	
		$this->db->trans_complete(); 
		if ($affected_rows== 1) {
			$this->db->trans_commit();
			return TRUE;
		} 
		else {
			$this->db->trans_rollback();
			return FALSE;
		}
	}
	


	// Add bengali language question
	public function get_question_main_details($question_id_hash = NULL){
		$query = $this->db->select("a.*,ben_question.*,b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,h.level_name,i.nos_name,g.module_name,j.question_pattern_name as que_pattern_name ,k.question_pattern_name as option_pattern_name")
			->from("council_question_bank as a")
			->join('council_question_bank_bengali_lang as ben_question','a.question_id_pk=ben_question.question_id_fk',"LEFT")
			->join('council_sector_master as b','a.sector_id=b.sector_id_pk',"LEFT")
			->join('council_course_master as c','a.course_id=c.course_id_pk',"LEFT")
			->join('council_programme_master as d','a.programme_id=d.programme_id_pk',"LEFT")
			->join('council_question_for_master as e','a.question_for_id=e.question_for_id_pk',"LEFT")
			->join('council_question_type_master as f','a.question_type_id=f.question_type_id_pk',"LEFT")
			->join('council_question_level_master as h','a.level_id=h.level_id_pk',"LEFT")
			->join('council_assessment_nos_course_marks_master as i','a.nos_id=i.course_marks_id_pk',"LEFT")
			->join('council_question_module_master as g','a.module_id=g.module_id_pk',"LEFT")
			->join('council_question_option_pattern_master as j','a.question_pattern=j.question_pattern_id_pk',"LEFT")
			->join('council_question_option_pattern_master as k','a.option_pattern=k.question_pattern_id_pk',"LEFT")
			->where(
				array(
					"a.active_status" => 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $question_id_hash
				)
			)
			->get();
		return $query->result_array();
	   }


	   public function get_question_answer_details($question_id_hash = NULL){
		$query = $this->db->select("a.question_id_pk,eng_question.right_answer")
			->from("council_question_bank as a")
			->join('council_question_bank_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			->where(
				array(
					"a.active_status" => 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $question_id_hash
				)
			)
			->get();
		return $query->result_array();
	   }


	   public function question_ben_language_insert($data){
		
		$this->db->trans_start();
		$this->db->insert('council_question_bank_bengali_lang', $data);
		
		//echo $this->db->last_query(); die;

		$this->db->trans_complete(); 
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} 
		else {
			$this->db->trans_commit();
			return TRUE;
		}
	}

	public function question_ben_language_update($data,$beng_question_id_pk)
	{	
		 $this->db->trans_start();
		 $this->db->where(
    		array(
    			'beng_question_id_pk' =>  $beng_question_id_pk
    		)
    	);
		$this->db->update('council_question_bank_bengali_lang',$data);
		$affected_rows = $this->db->affected_rows();	
		$this->db->trans_complete(); 
		if ($affected_rows== 1) {
			$this->db->trans_commit();
			return TRUE;
		} 
		else {
			$this->db->trans_rollback();
			return FALSE;
		}
	}

	public function question_benk_master_ben_question_status($update_ben_ques_array,$question_id_pk)
	{	
		 $this->db->trans_start();
		 $this->db->where(
    		array(
    			'question_id_pk' =>  $question_id_pk
    		)
    	);
		$this->db->update('council_question_bank',$update_ben_ques_array);
		$affected_rows = $this->db->affected_rows();	
		$this->db->trans_complete(); 
		if ($affected_rows== 1) {
			$this->db->trans_commit();
			return TRUE;
		} 
		else {
			$this->db->trans_rollback();
			return FALSE;
		}
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
			->where_in('eng_question.process_status_id_fk',array(0,6))
			->order_by("question_id_pk","ASC")
			->get();
		return $query->result_array();
	   }
	   function get_duplicate_eng_question($question=NULL,$question_id_hash)
	   {
		   $question_dtls = $this->get_question_details_by_id($question_id_hash);
		   $query = $this->db->select('eng_question.question_id_fk')
							 ->from('council_question_bank_english_lang as eng_question')
							 ->where(
								 array(  
									 'eng_question.question'	=> $question
								 )
							 )
							 ->where_not_in('eng_question.question_id_fk',$question_dtls[0]['question_id_fk'])
							 ->get();
		   return $query->result_array();
	   }


	   public function get_beng_question_details_by_id($id_hash = NULL){
		$query = $this->db->select("a.question_id_pk,beng_question.question_id_fk")
			->from("council_question_bank as a")
			->join('council_question_bank_bengali_lang as beng_question','a.question_id_pk=beng_question.question_id_fk',"LEFT")
			->where(
				array(
					"a.active_status" 	=> 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $id_hash
				)
			)
			->where_in('beng_question.process_status_id_fk',array(0,6))
			->order_by("question_id_pk","ASC")
			->get();
		return $query->result_array();
	   }

	
	
	function get_duplicate_beng_question($question=NULL,$question_id_hash,$question_for_id)
	{
		$question_dtls = $this->get_beng_question_details_by_id($question_id_hash);
		$query = $this->db->select('beng_question.question_id_fk')
						  ->from('council_question_bank_bengali_lang as beng_question')
						  ->where(
						  	array(  
						  		'beng_question.question'	=> $question,
								'main_que.question_for_id'	=> $question_for_id
						  	)
						  )
						  ->where_not_in('beng_question.question_id_fk',$question_dtls[0]['question_id_fk'])
						  ->get();
		return $query->result_array();
	}

	function get_unique_beng_question($question=NULL,$question_for_id=NULL)
	{

		$query = $this->db->select('beng_question.question_id_fk')
						  ->from('council_question_bank_bengali_lang as beng_question')
						  ->join('council_question_bank as main_que','beng_question.question_id_fk = main_que.question_id_pk','LEFT')
						  ->where(
						  	array(  
						  		'beng_question.question'		=> $question,
						  		'main_que.question_for_id'	=> $question_for_id,
						  	)
						  )
						  ->get();
		return $query->result_array();
	}


	

	









	
	   public function get_assessor_search($pan_no = NULL ,$ssc_wbsctvesd_certified = NULL) {
			
		$this->db->select("assessor.assessor_registration_details_pk,assessor.fname,assessor.mname,assessor.lname,assessor.pan,assessor.assessor_code,salutation.salutation_desc,assessor.mobile_no,assessor.process_status_id_fk,process.process_name");
			$this->db->from("council_assessor_registration_details as assessor");
			$this->db->join("council_salutation_master as salutation","assessor.salutation_id_fk = salutation.salutation_id_pk","LEFT");
			$this->db->join("council_process_master as process","assessor.process_status_id_fk = process.process_id_pk","LEFT");
			
			$this->db->where("assessor.active_status", 1);
			$this->db->where("assessor.final_flag", TRUE);
			if($pan_no != NULL){
				$this->db->where('assessor.pan', $pan_no);
			}
			if($ssc_wbsctvesd_certified != NULL){
				$this->db->where('assessor.ssc_wbsctvesd_certified', $ssc_wbsctvesd_certified);
			}
			$this->db->order_by('final_submission_time','ASC');
			$query =  $this->db->get();
		return $query->result_array();
	}
	
	
	
	
}
