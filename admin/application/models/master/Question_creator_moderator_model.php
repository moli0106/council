<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_creator_moderator_model extends CI_Model {

    public function get_creator_moderatorCount(){
        $query = $this->db->select("count(creator_moderator_id_pk)")
            ->from("council_question_creator_moderator_details")
            ->get();
        return $query->result_array();
    }

    public function getAllSector(){
        $query = $this->db->select("sector_id_pk, sector_code, sector_name")
            ->from("council_sector_master")
            ->where(
                array(
                    "active_status"     => 1,
                    "process_status_fk" => 5
                )
            )
            ->order_by("sector_name", "ASC")
            ->get();
        return $query->result_array();
    } 
    
   

    public function insert_question_creator_moderator($array)
    {
        $this->db->insert('council_question_creator_moderator_details', $array);

        return $this->db->insert_id();
    }
    
    public function map_question_creator_moderator_sector($mapArray)
    {
        return $this->db->insert_batch('council_question_creator_moderator_sector_map', $mapArray); 
     }
    
    public function getAll_question_creator_moderator($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("qcm.*")
            ->from("council_question_creator_moderator_details as qcm")
            //->join("council_question_creator_moderator_sector_map as sector_map","sector_map.creator_moderator_id_fk = qcm.creator_moderator_id_pk")
            //->join("council_sector_master as sector","sector_map.sector_id_fk = sector.sector_id_pk")
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
    
    public function stakeHolderLogin($id_hash, $updateArray,$stake_id_fk)
    {
        $this->db->where(
			array(
				'MD5(CAST(stake_details_id_fk AS character varying)) =' => $id_hash,
                'stake_id_fk' => $stake_id_fk,
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


    public function getSector($id_hash)
    {
        $query = $this->db->select("sector.sector_name,tcm.creator_moderator_sector_map_id_pk,tcm.creator_moderator_id_fk,tcm.active_status")
            ->from("council_question_creator_moderator_sector_map as tcm")
            ->join("council_sector_master as sector", "tcm.sector_id_fk = sector.sector_id_pk")
            //->join("council_course_master as course", "tcm.course_id_fk = course.course_id_pk")
            ->where(
                array(
                    "MD5(CAST(tcm.creator_moderator_id_fk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_question_cm_details($id_hash)
    {
        $query = $this->db->select("tcm.creator_moderator_id_pk,tcm.creator_moderator_type,fname||' '||mname||' '||lname AS qcm_name,email_id,mobile_no")
            ->from("council_question_creator_moderator_details as tcm")
            ->where(
                array(
                    "MD5(CAST(tcm.creator_moderator_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function verify_qcm_sector($qcm_id = NULL,$sector_id = NULL)
    {
        $query = $this->db->select("count(creator_moderator_sector_map_id_pk)")
            ->from("council_question_creator_moderator_sector_map as tcm")
            ->where(
                array(
                    "tcm.creator_moderator_id_fk" => $qcm_id,
                    "tcm.sector_id_fk"            => $sector_id
                )
            )
            ->get();
        return $query->result_array();
    }

    public function insertSectorJobRole($array)
    {
        $this->db->insert('council_question_creator_moderator_sector_map', $array);

        return $this->db->insert_id();
    }

    public function updateJobRole($id_hash, $updateArray)
    {
        $this->db->where(
            array(
                'MD5(CAST(creator_moderator_sector_map_id_pk AS character varying)) =' => $id_hash
            )
        )
            ->update('council_question_creator_moderator_sector_map', $updateArray);

        return $this->db->affected_rows();
    }


}
/* End of file Master_trainer_model.php */
?>