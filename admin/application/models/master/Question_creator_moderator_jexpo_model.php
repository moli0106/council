<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_creator_moderator_jexpo_model extends CI_Model {

    public function get_creator_moderatorCount(){
        $query = $this->db->select("count(creator_moderator_id_pk)")
            ->from("council_question_creator_moderator_jexpo_details")
            ->get();
        return $query->result_array();
    }

    public function getAllExamType(){
        $query = $this->db->select("*")
            ->from("council_exam_type_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("exam_type_name", "ASC")
            ->get();
        return $query->result_array();
    } 
    
   

    public function insert_question_creator_moderator($array)
    {
        $this->db->insert('council_question_creator_moderator_jexpo_details', $array);

        return $this->db->insert_id();
    }
    
    public function get_subject_query($exam_type=NULL){
        $query = $this->db->select("*")
            ->from("council_exam_type_subject_mapping")
            ->where(
                array(
                    "active_status"     => 1,
                    "exam_type_id_fk"   => $exam_type
                )
            )
            ->order_by("subject_name", "ASC")
            ->get();
        return $query->result_array();
    } 
    
    public function getAll_question_creator_moderator($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("qcm.*,exam_type.exam_type_name,subject.subject_name")
            ->from("council_question_creator_moderator_jexpo_details as qcm")
            ->join("council_exam_type_master as exam_type","qcm.exam_type_id_fk = exam_type.exam_type_id_pk")
            ->join("council_exam_type_subject_mapping as subject","qcm.subject_id_fk = subject.subject_id_pk")
            ->limit($limit, $offset)
            ->order_by("qcm.creator_moderator_id_pk", "DESC")
            ->get();
        return $query->result_array();
    }
    
    // public function getTrainerByHashId($id_hash = NULL)
    // {
    //     $query = $this->db->select("trainer.*, sector.sector_name")
    //         ->from("council_master_trainer as trainer")
    //         ->join("council_sector_master as sector","trainer.sector_id_fk = sector.sector_id_pk")
    //         ->where(
    //             array(
    //                 "MD5(CAST(trainer.master_trainer_id_pk as character varying)) =" => $id_hash
    //             )
    //         )
    //         ->get();
    //     return $query->result_array();
    // }
    
    // public function getSectorJobRole($id_hash)
    // {
    //     $query = $this->db->select("sector.sector_name, course.course_name")
    //         ->from("council_trainer_course_map as tcm")
    //         ->join("council_sector_master as sector", "tcm.sector_id_fk = sector.sector_id_pk")
    //         ->join("council_course_master as course", "tcm.course_id_fk = course.course_id_pk")
    //         ->where(
    //             array(
    //                 "MD5(CAST(tcm.master_trainer_id_fk as character varying)) =" => $id_hash
    //             )
    //         )
    //         ->get();
    //     return $query->result_array();
    // }

    public function update_creator_moderator($id_hash, $updateArray)
	{
		$this->db->where(
			array(
				'MD5(CAST(creator_moderator_id_pk AS character varying)) =' => $id_hash
			)
		)
		->update('council_question_creator_moderator_details',$updateArray);
			
		return $this->db->affected_rows();

    }

    

    public function insert_question_creator_moderator_credentials($array)
    {
        $this->db->insert('council_stake_holder_login', $array);

        return $this->db->insert_id();
    }
    
    public function stakeHolderLogin($id_hash, $updateArray)
    {
        $this->db->where(
			array(
				'MD5(CAST(stake_details_id_fk AS character varying)) =' => $id_hash
			)
		)
		->update('council_stake_holder_login',$updateArray);
			
		return $this->db->affected_rows();
    }

    public function get_sector_code($sctor_id=NULL){
        $query = $this->db->select("sector_id_pk, sector_code, sector_name")
            ->from("council_sector_master")
            ->where(
                array(
                    "active_status"     => 1,
                    "process_status_fk" => 5,
                    "sector_id_pk" => $sctor_id,
                )
            )
            ->order_by("sector_name", "ASC")
            ->get();
        return $query->result_array();
    } 


    public function update_update_qcm_code($id, $updateArray)
	{
		$this->db->where(
			array(
				'creator_moderator_id_pk' => $id
			)
		)
		->update('council_question_creator_moderator_details',$updateArray);
			
		return $this->db->affected_rows();

    }

}

?>