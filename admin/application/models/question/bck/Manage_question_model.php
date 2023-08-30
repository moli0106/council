<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Manage_question_model extends CI_Model {

	public function get_sectors_query($stake_details_id_fk){
		$query = $this->db->select('b.sector_id_pk,b.sector_code,b.sector_name')
		->from('council_question_creator_moderator_details as a')
		->join('council_sector_master as b','a.sector_id_fk=b.sector_id_pk')
		//->where('creator_moderator_id_pk',$stake_id_fk)
		->where('a.creator_moderator_id_pk',$stake_details_id_fk)
		->order_by('sector_name')
	   	->get();
	   	return $query->result_array();
	}
	
	public function get_question($limit = NULL, $offset = NULL,$sectors_id = NULL){
		$query = $this->db->select("a.*,b.sector_name,c.course_name,d.programme_name,e.question_for_name,f.question_type_name,g.module_name,h.level_name")
			->from("council_question_bank as a")
			->join('council_sector_master as b','a.sector_id=b.sector_id_pk',"LEFT")
			->join('council_course_master as c','a.course_id=c.course_id_pk',"LEFT")
			->join('council_programme_master as d','a.programme_id=d.programme_id_pk',"LEFT")
			->join('council_question_for_master as e','a.question_for_id=e.question_for_id_pk',"LEFT")
			->join('council_question_type_master as f','a.question_type_id=f.question_type_id_pk',"LEFT")
			->join('council_question_module_master as g','a.module_id=g.module_id_pk',"LEFT")
			->join('council_question_level_master as h','a.level_id=h.level_id_pk',"LEFT")
			
			
			->where(
				array(
					"a.active_status" => 1,
					"sector_id" 	=> $sectors_id,
					"b.active_status" => 1,
					"c.active_status" => 1,
					"e.active_status" => 1,
					"f.active_status" => 1,
					"g.active_status" => 1,
					"h.active_status" => 1,
				)
			)
			->where_in('process_status_id_fk',array(0,6))
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
						"sector_id" => $sectors_id
					)
				)
				->where_in('process_status_id_fk',array(0,6))
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
		$query = $this->db->select("a.*")
			->from("council_question_bank as a")
			->where(
				array(
					"a.active_status" => 1,
					"MD5(CAST(a.question_id_pk AS character varying)) ="	=> $question_id_hash
				)
			)
			->get();
		return $query->result_array();
	   }

	public function question_update($question_id_hash , $data)
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
