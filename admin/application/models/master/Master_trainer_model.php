<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_trainer_model extends CI_Model {

    public function getTrainerCount(){
        $query = $this->db->select("count(master_trainer_id_pk)")
            ->from("council_master_trainer")
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
    
    public function getJobRole($sector_id)
    {
        $query = $this->db->select("course_id_pk, course_name, course_code")
            ->from("council_course_master")
            ->where(
                array(
                    "active_status"     => 1,
                    "process_status_fk" => 5,
                    "sector_id_fk"      => $sector_id,
                )
            )
            ->order_by("course_name", "ASC")
            ->get();

        return $query->result_array();
    }

    public function insertMasterTrainer($array)
    {
        $this->db->insert('council_master_trainer', $array);

        return $this->db->insert_id();
    }
    
    public function mapTrainerCourse($mapArray)
    {
        return $this->db->insert_batch('council_trainer_course_map', $mapArray); 
    }
    
    public function getAllTrainer($limit = NULL, $offset = NULL)
    {
        // $query = $this->db->select("trainer.*, sector.sector_name")
        //     ->from("council_master_trainer as trainer")
        //     ->join("council_sector_master as sector","trainer.sector_id_fk = sector.sector_id_pk")
        $query = $this->db->select("trainer.*")
            ->from("council_master_trainer as trainer")
            ->limit($limit, $offset)
            ->order_by("trainer.master_trainer_id_pk", "DESC")
            ->get();
        return $query->result_array();
    }
    
    public function getTrainerByHashId($id_hash = NULL)
    {
        $query = $this->db->select("trainer.*, sector.sector_name")
            ->from("council_master_trainer as trainer")
            ->join("council_sector_master as sector","trainer.sector_id_fk = sector.sector_id_pk")
            ->where(
                array(
                    "MD5(CAST(trainer.master_trainer_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }
	
	public function getTrainerByHashIdEmail($id_hash = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_master_trainer as trainer")
            ->where(
                array(
                    "MD5(CAST(trainer.master_trainer_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }
    
    
	
	public function getSectorJobRole($id_hash)
    {
        $query = $this->db->select("tcm.trainer_course_map_id_pk, sector.sector_id_pk, sector.sector_name, sector.sector_code, course.course_id_pk, course.course_name, course.course_code, tcm.active_status")
            ->from("council_trainer_course_map as tcm")
            ->join("council_sector_master as sector", "tcm.sector_id_fk = sector.sector_id_pk")
            ->join("council_course_master as course", "tcm.course_id_fk = course.course_id_pk")
            ->where(
                array(
                    "MD5(CAST(tcm.master_trainer_id_fk as character varying)) =" => $id_hash
                )
            )
            ->order_by('sector.sector_name, course.course_name')
            ->get();
        return $query->result_array();
    }

    public function updateTrainer($id_hash, $updateArray)
	{
		$this->db->where(
			array(
				'MD5(CAST(master_trainer_id_pk AS character varying)) =' => $id_hash
			)
		)
		->update('council_master_trainer',$updateArray);
			
		return $this->db->affected_rows();

    }

    public function insertTrainerCredentials($array)
    {
        $this->db->insert('council_stake_holder_login', $array);

        return $this->db->insert_id();
    }
    
    public function stakeHolderLogin($id_hash, $updateArray)
    {
        $this->db->where(
			array(
				'MD5(CAST(stake_details_id_fk AS character varying)) =' => $id_hash,
				'stake_id_fk' => 8,
			)
		)
		->update('council_stake_holder_login',$updateArray);
			
		return $this->db->affected_rows();
    }
	
	
	public function getMasterTrainer($id_hash = NULL)
    {
        return $this->db->select("
            master_trainer_id_pk,
            f_name||' '||m_name||' '||l_name AS trainer_name,
            email,
            mobile
        ")
            ->where("MD5(CAST(master_trainer_id_pk as character varying)) =", $id_hash)->get("council_master_trainer")->result_array();
    }


public function verifyJobRole($sector_id = NULL, $course_id = NULL)
    {
        return $this->db->where(
            array(
                "sector_id_fk" => $sector_id,
                "course_id_pk" => $course_id,
            )
        )->get('council_course_master')->result_array();
    }

    public function insertSectorJobRole($array)
    {
        $this->db->insert('council_trainer_course_map', $array);

        return $this->db->insert_id();
    }

    public function updateJobRole($id_hash, $updateArray)
    {
        $this->db->where(
            array(
                'MD5(CAST(trainer_course_map_id_pk AS character varying)) =' => $id_hash
            )
        )
            ->update('council_trainer_course_map', $updateArray);

        return $this->db->affected_rows();
    }
	
	
	public function getAllSectorNotIn($sector_id = NULL, $trainer_course_ids = NULL)
    {
        $query = $this->db->select("course_id_pk, course_name, course_code")
            ->from("council_course_master")
            ->where(
                array(
                    "active_status"     => 1,
                    "process_status_fk" => 5,
                    "sector_id_fk"      => $sector_id,
                )
            )
            ->where_not_in('course_id_pk', $trainer_course_ids)
            ->order_by("course_name", "ASC")
            ->get();

        return $query->result_array();
    }

}
/* End of file Master_trainer_model.php */
?>