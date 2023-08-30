<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Manage_question_jexpo_model extends CI_Model {

	public function get_ExamType_subject($stake_details_id_fk){
		$query = $this->db->select('b.exam_type_id_pk,c.subject_id_pk')
		->from('council_question_creator_moderator_jexpo_details as a')
		->join('council_exam_type_master as b','a.exam_type_id_fk=b.exam_type_id_pk')
		->join('council_exam_type_subject_mapping as c','a.subject_id_fk=c.subject_id_pk')
		->where('a.creator_moderator_id_pk',$stake_details_id_fk)
	   	->get();
	   	return $query->result_array();
	}
	
	public function get_question($limit = NULL, $offset = NULL,$exam_type=NULL,$subject_id=NULL){
		$query = $this->db->select("a.*,eng_question.*,b.exam_type_name,c.subject_name,d.level_name,a.process_status_id_fk as process_status_main")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			->join('council_exam_type_master as b','a.exam_type_id_fk=b.exam_type_id_pk',"LEFT")
			->join('council_exam_type_subject_mapping as c','a.subject_id_fk=c.subject_id_pk',"LEFT")
			->join('council_question_level_master_for_jexpo as d','a.level_id=d.level_id_pk',"LEFT")
			->where(
				array(
					"a.active_status" 	=> 1,
					"a.exam_type_id_fk" => $exam_type,
					"a.subject_id_fk" => $subject_id,
					"b.active_status" 	=> 1,
					"c.active_status" 	=> 1,
					
				)
			)
			->where_in('a.process_status_id_fk',array(0,6))
			->limit($limit, $offset)
			->order_by("question_id_pk","ASC")
			->get();
		return $query->result_array();
	   }

	   public function get_question_qm($limit = NULL, $offset = NULL,$exam_type=NULL,$subject_id=NULL){
		$query = $this->db->select("a.*,eng_question.*,b.exam_type_name,c.subject_name,d.level_name,a.process_status_id_fk as process_status_main")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			->join('council_exam_type_master as b','a.exam_type_id_fk=b.exam_type_id_pk',"LEFT")
			->join('council_exam_type_subject_mapping as c','a.subject_id_fk=c.subject_id_pk',"LEFT")
			->join('council_question_level_master_for_jexpo as d','a.level_id=d.level_id_pk',"LEFT")
			->where(
				array(
					"a.active_status" 	=> 1,
					"a.exam_type_id_fk" => $exam_type,
					"a.subject_id_fk" => $subject_id,
					"b.active_status" 	=> 1,
					"c.active_status" 	=> 1,
					"a.bengali_lan_quesstion_status" => 1
					
				)
			)
			->where_in('a.process_status_id_fk',array(0,6))
			->limit($limit, $offset)
			->order_by("question_id_pk","ASC")
			->get();
		return $query->result_array();
	   }
	
	   public function question_count($exam_type=NULL,$subject_id=NULL){
			$query = $this->db->select("count(question_id_pk)")
				->from("council_question_bank_jexpo_voclet as a")
				//->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
				
				->where(
					array(
						"a.active_status" => 1,
						"a.exam_type_id_fk" => $exam_type,
						"a.subject_id_fk" => $subject_id
					)
				)
				->where_in('a.process_status_id_fk',array(0,6))
				->get();
			return $query->result_array();
	   }

	   public function question_count_qm($exam_type=NULL,$subject_id=NULL){
		$query = $this->db->select("count(question_id_pk)")
			->from("council_question_bank_jexpo_voclet as a")
			//->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			
			->where(
				array(
					"a.active_status" => 1,
					"a.exam_type_id_fk" => $exam_type,
					"a.subject_id_fk" => $subject_id,
					"a.bengali_lan_quesstion_status" => 1
				)
			)
			->where_in('a.process_status_id_fk',array(0,6))
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
		->update('council_question_bank_jexpo_voclet',$updateArray);
			
		return $this->db->affected_rows();

    }

//For Question edit

	public function get_question_details($question_id_hash = NULL){
		$query = $this->db->select("a.*,eng_question.*")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			->where(
				array(
					"a.active_status" => 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $question_id_hash
				)
			)
			->get();
		return $query->result_array();
	   }
	   
	public function get_ben_question_details($question_id_hash = NULL){
		$query = $this->db->select("beng_question.beng_question_id_pk")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_bengali_lang as beng_question','a.question_id_pk=beng_question.question_id_fk',"LEFT")
			->where(
				array(
					"a.active_status" => 1,
					"beng_question.active_status" => 1,
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
		$this->db->update('council_question_bank_jexpo_voclet',$data);
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
		$this->db->update('council_question_bank_jexpo_voclet_english_lang',$data);
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
	
	public function question_update_beng_lang($question_id_hash , $data)
	{	
		 $this->db->trans_start();
		 $this->db->where(
    		array(
    			'md5(CAST(question_id_fk AS character varying)) =' =>  $question_id_hash
    		)
    	);
		$this->db->update('council_question_bank_jexpo_voclet_bengali_lang',$data);
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
		$query = $this->db->select("a.*,ben_question.*,b.exam_type_name,c.subject_name,d.level_name,e.question_pattern_name as que_pattern_name ,f.question_pattern_name as option_pattern_name")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_bengali_lang as ben_question','a.question_id_pk=ben_question.question_id_fk',"LEFT")
			->join('council_exam_type_master as b','a.exam_type_id_fk=b.exam_type_id_pk',"LEFT")
			->join('council_exam_type_subject_mapping as c','a.subject_id_fk=c.subject_id_pk',"LEFT")
			->join('council_question_level_master_for_jexpo as d','a.level_id=d.level_id_pk',"LEFT")
			->join('council_question_option_pattern_master as e','a.question_pattern=e.question_pattern_id_pk',"LEFT")
			->join('council_question_option_pattern_master as f','a.option_pattern=f.question_pattern_id_pk',"LEFT")
			->where(
				array(
					"a.active_status" => 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $question_id_hash
				)
			)
			->get();
		return $query->result_array();
	   }
	   
	   public function get_eng_question_details($question_id_hash = NULL){
		$query = $this->db->select("a.question_id_pk,eng_question.right_answer,eng_question.question_pic,eng_question.option1_pic,eng_question.option2_pic,eng_question.option3_pic,eng_question.option4_pic")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
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
		$this->db->insert('council_question_bank_jexpo_voclet_bengali_lang', $data);
		
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
		$this->db->update('council_question_bank_jexpo_voclet_bengali_lang',$data);
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
		$this->db->update('council_question_bank_jexpo_voclet',$update_ben_ques_array);
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
		$query = $this->db->select("a.*,eng_question.*")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_english_lang as eng_question','a.question_id_pk=eng_question.question_id_fk',"LEFT")
			->where(
				array(
					"a.active_status" 	=> 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $id_hash
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
		
		$encrypt_question=openssl_encrypt($question, $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));

		$query = $this->db->select('eng_question.question_id_fk')
						  ->from('council_question_bank_jexpo_voclet_english_lang as eng_question')
						  ->where(
						  	array(  
						  		'eng_question.question'	=> $encrypt_question
						  	)
						  )
						  ->where_not_in('eng_question.question_id_fk',$question_dtls[0]['question_id_fk'])
						  ->get();
		return $query->result_array();
	}

	public function get_beng_question_details_by_id($id_hash = NULL){
		$query = $this->db->select("a.question_id_pk,beng_question.question_id_fk")
			->from("council_question_bank_jexpo_voclet as a")
			->join('council_question_bank_jexpo_voclet_bengali_lang as beng_question','a.question_id_pk=beng_question.question_id_fk',"LEFT")
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

	function get_duplicate_beng_question($question=NULL,$question_id_hash)
	{
		$question_dtls = $this->get_beng_question_details_by_id($question_id_hash);
		$encrypt_question=openssl_encrypt($question, $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));

		$query = $this->db->select('beng_question.question_id_fk')
						  ->from('council_question_bank_jexpo_voclet_bengali_lang as beng_question')
						  ->where(
						  	array(  
						  		'beng_question.question'	=> $encrypt_question
						  	)
						  )
						  ->where_not_in('beng_question.question_id_fk',$question_dtls[0]['question_id_fk'])
						  ->get();
		return $query->result_array();
	}

	function get_duplicate_for_add_beng_question($question=NULL)
	{
		//$question_dtls = $this->get_question_details_by_id($question_id_hash);
		$encrypt_question=openssl_encrypt($question, $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
		$query = $this->db->select('beng_question.question_id_fk')
							->from('council_question_bank_jexpo_voclet_bengali_lang as beng_question')
							->where(
								array(  
									'beng_question.question'	=> $encrypt_question
								)
							)
						  //->where_not_in('eng_question.question_id_fk',$question_dtls[0]['question_id_fk'])
						  ->get();
		return $query->result_array();
	}
	
	
	
	
}
