<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_creator_moderator_model extends CI_Model {

    public function get_creator_moderatorCount(){
        $query = $this->db->select("count(creator_moderator_id_pk)")
            ->from("council_qbm_question_creator_moderator_details")
            ->get();
        return $query->result_array();
    }

    public function getAll_question_creator_moderator($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("qcm.*")
            ->from("council_qbm_question_creator_moderator_details as qcm")
            ->limit($limit, $offset)
            ->order_by("qcm.creator_moderator_id_pk", "DESC")
            ->get();
        return $query->result_array();
    }
    public function getAllcourse(){
        $query = $this->db->select("*")
            ->from("council_qbm_course_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("course_name", "ASC")
            ->get();
        return $query->result_array();
    } 

   

    public function getDisciplineList($course_code = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_discipline_master as dis_mas")
            ->join("council_qbm_course_discipline_map as dis_map","dis_map.discipline_id_fk = dis_mas.discipline_id_pk")
            ->where(
                array(
                    "dis_mas.active_status"     => 1,
                    "dis_map.course_id_fk"      => $course_code
                )
            )
            ->order_by("dis_mas.discipline_name", "ASC")
            ->get();
        return $query->result_array();
        
    }

    public function get_subject_List($course_id = NULL)
    {
        $query = $this->db->select("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->from("council_qbm_subject_master as subject_mas")
            ->join("council_qbm_subject_semester_group_trade_map as sub_map","sub_map.subject_id_fk = subject_mas.subject_id_pk")
            ->where(
                array(
                    "subject_mas.active_status"     => 1,
                    "sub_map.course_id_fk"      => $course_id
                )
            )
            ->group_by("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->order_by("subject_mas.subject_name", "ASC")
            ->get();
        return $query->result_array();
    }
    public function insert_question_creator_moderator($array)
    {
        $this->db->insert('council_qbm_question_creator_moderator_details', $array);

        return $this->db->insert_id();
    }

    public function map_question_creator_moderator_subject($mapArray)
    {
        return $this->db->insert('council_qbm_question_creator_moderator_subject_map', $mapArray); 
    }

    public function update_creator_moderator($id_hash, $updateArray)
	{
		$this->db->where(
			array(
				'MD5(CAST(creator_moderator_id_pk AS character varying)) =' => $id_hash
			)
		)
		->update('council_qbm_question_creator_moderator_details',$updateArray);
			
		return $this->db->affected_rows();

    }
    public function insert_question_creator_moderator_credentials($array)
    {
        $this->db->insert('council_stake_holder_login', $array);

        return $this->db->insert_id();
    }

    public function update_update_qcm_code($id, $updateArray)
	{
		$this->db->where(
			array(
				'creator_moderator_id_pk' => $id
			)
		)
		->update('council_qbm_question_creator_moderator_details',$updateArray);
			
		return $this->db->affected_rows();

    }

    public function get_question_cm_details($id_hash)
    {
        $query = $this->db->select("tcm.creator_moderator_id_pk,tcm.creator_moderator_type,fname||' '||mname||' '||lname AS qcm_name,email_id,mobile_no")
            ->from("council_qbm_question_creator_moderator_details as tcm")
            ->where(
                array(
                    "MD5(CAST(tcm.creator_moderator_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function get_qcm_subject_details($id_hash)
    {
        $query = $this->db->select("course.course_name,qbm_sub_map.creator_moderator_subject_map_id_pk,qbm_sub_map.creator_moderator_id_fk,qbm_sub_map.active_status,subject.subject_name,subject.subject_code")
            ->from("council_qbm_question_creator_moderator_subject_map as qbm_sub_map")
            ->join("council_qbm_course_master as course", "qbm_sub_map.course_id_fk = course.course_id_pk")
            //->join("council_qbm_discipline_master as disciplne", "qbm_sub_map.discipline_id_fk = disciplne.discipline_id_pk")
            ->join("council_qbm_subject_master as subject", "qbm_sub_map.subject_id_fk = subject.subject_id_pk")
            ->where(
                array(
                    "MD5(CAST(qbm_sub_map.creator_moderator_id_fk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }

    public function verify_qcm_subject($qcm_id = NULL, $course_id = NULL , $subject_id = NULL)
    {
        $query = $this->db->select("count(creator_moderator_subject_map_id_pk)")
            ->from("council_qbm_question_creator_moderator_subject_map as tcm")
            ->where(
                array(
                    "tcm.creator_moderator_id_fk" => $qcm_id,
                    "tcm.course_id_fk"            => $course_id,
                    //"tcm.discipline_id_fk"        => $discipline_id,
                    "tcm.subject_id_fk"           => $subject_id,
                )
            )
            ->get();
        return $query->result_array();
    }

    public function insertSubject($array)
    {
        $this->db->insert('council_qbm_question_creator_moderator_subject_map', $array);

        return $this->db->insert_id();
    }

	public function get_qcm_details_report(){
		$query = $this->db->select("qcm.fname||' '||qcm.mname||' '||qcm.lname as qc_name,qcm.email_id,qcm.mobile_no,subject.subject_name,subject.subject_code,qcm.creator_moderator_type,qcm.creator_moderator_code,course.course_name")
			->from('council_qbm_question_creator_moderator_details as qcm')
			->join('council_qbm_question_creator_moderator_subject_map as qcm_map','qcm_map.creator_moderator_id_fk = qcm.creator_moderator_id_pk',"LEFT")
			->join('council_qbm_subject_master as subject','subject.subject_id_pk = qcm_map.subject_id_fk',"LEFT")
			->join('council_qbm_course_master as course','course.course_id_pk = qcm_map.course_id_fk',"LEFT")
			
			->where(
				array(
					"qcm.active_status" 	=> 1
				)
			)
			->order_by("qcm.fname","ASC")
			->get();
		return $query->result_array();
	   }
	   
	   
	   function get_qcm_login_dtls($creator_moderator_id_pk = NULL,$creator_moderator_type = NULL)
	{
		$query = $this->db->select('base_login_id,base_password,stake_holder_details')
			->from('council_stake_holder_login')
			->where(
				array(
					'stake_details_id_fk' 	=> $creator_moderator_id_pk,
					'stake_id_fk'			=> $creator_moderator_type
				)
			)->get();
		return $query->result_array();
	}	
	function get_qcm_email($id_hash = NULL)
	{
		$query = $this->db->select('creator_moderator_id_pk,email_id,mobile_no,creator_moderator_type')
			->from('council_qbm_question_creator_moderator_details as qcm')
			->where(
                array(
                    "MD5(CAST(qcm.creator_moderator_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
		return $query->result_array();
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