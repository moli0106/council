<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch_model extends CI_Model {

    public function getBatchCount($trainer_id){
        $query = $this->db->select("count(batch_ems_id_pk)")
            ->from("council_batch_ems")
            ->where(
                array(
                    "council_batch_ems.trainer_id" => $trainer_id
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getAllBatch($trainer_id, $limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("cbems.*, sector.sector_name, course.course_name")
            ->from("council_batch_ems as cbems")
            ->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
            ->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
            ->where(
                array(
                    "cbems.trainer_id" => $trainer_id
                )
            )
            ->limit($limit, $offset)
            ->order_by("cbems.batch_ems_id_pk", "DESC")
            ->get();
        return $query->result_array();
    }

    public function getBatchAssessorList($id_hash)
    {
        $query = $this->db->select("cbam.batch_assessor_map_id_pk, cbam.batch_ems_id_fk, cbam.assessor_id_fk, cbam.eligibility, cbam.exam_status, assessor.fname,assessor.mname, assessor.lname, assessor.mobile_no, assessor.email_id, result.con_eval_marks, result.trainee_attends")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")

            ->join("council_assessor_exam_result_details as result", "result.batch_id_fk = cbam.batch_ems_id_fk AND result.assessor_id_fk = cbam.assessor_id_fk", "left")

            ->where(
                array(
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $id_hash
                )
            )
            ->order_by("assessor.fname", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getAssessorIdInBatch($batch_id, $map_id)
    {
        $query = $this->db->select("batch_assessor_map_id_pk")
            ->from("council_batch_assessor_map")
            ->where(
                array(
				
				"MD5(CAST(batch_ems_id_fk as character varying)) =" => $batch_id
				)
            )
            ->where_not_in('batch_assessor_map_id_pk', $map_id)
            ->get();
        return $query->result_array();
    }

    public function updateAssessorEligibility($batch_id, $map_id, $update_array)
    {
        $this->db->where(
			array(
			
			"MD5(CAST(batch_ems_id_fk as character varying)) =" => $batch_id
			)
		)
        ->where_in('batch_assessor_map_id_pk', $map_id)
		->update('council_batch_assessor_map', $update_array);

        return $this->db->affected_rows();
    }

    public function getBatchDetails($id_hash)
    {
        $query = $this->db->select("cbems.*, sector.sector_name, course.course_name, cbqm.batch_question_map_id_pk")
            ->from("council_batch_ems as cbems")
            ->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
            ->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
            ->join("council_batch_question_map as cbqm", "cbqm.batch_id_fk = cbems.batch_ems_id_pk", "left")
            ->where(
                array(
                    "MD5(CAST(cbems.batch_ems_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }
    
    public function getQuestionModule($myArray)
    {
        $query = $this->db->select("module_id")
            ->distinct('module_id')
            ->where($myArray)
            ->order_by("module_id")
            ->get('council_question_bank');
        return $query->result_array();
    }

    public function getQuestionList($myArray)
    {
        $query = $this->db->select("question_id_pk")
            ->where($myArray)
            ->get('council_question_bank');
        return $query->result_array();
    }

    public function insertQuestionList($insertArray)
    {
        $this->db->insert('council_batch_question_map', $insertArray);

        return $this->db->insert_id();
    }

    public function getMapQuestionByBatchId($batch_id)
    {
        $query = $this->db->select("*")
            ->from("council_batch_question_map")
            ->where(
                array(
                    "batch_id_fk" => $batch_id,
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getRandomQuestionList($myArray, $old_set)
    {
        $query = $this->db->select("question_id_pk")
            ->where($myArray)
            ->where_not_in('question_id_pk', $old_set)
            ->get('council_question_bank');
        return $query->result_array();
    }
	
	//Added by Waseem on 27-04-2021
    public function batch_wise_assessor_details($id_hash)
    {
        $query = $this->db->select("cbam.batch_assessor_map_id_pk, cbam.batch_ems_id_fk, cbam.eligibility, assessor.fname, assessor.lname, assessor.mobile_no, assessor.email_id")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")
            ->where(
                array(
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $id_hash
                )
            )
            ->order_by("assessor.fname", "ASC")
            ->get();
        return $query->result_array();
    }

    public function update_training_link($array = NULL, $id_hash = NULL){
        $this->db->where('md5(cast(batch_ems_id_pk as character varying)) =', $id_hash);
        return $this->db->update('council_batch_ems', $array);
    }
	
	 public function update_con_eval_marks_and_trainee_attends($batch_id_hash = NULL, $assessor_id_fk = NULL, $updateArray = NULL)
    {
        $this->db->where('md5(cast(batch_id_fk as character varying)) =', $batch_id_hash);
        $this->db->where('assessor_id_fk', $assessor_id_fk);
        return $this->db->update('council_assessor_exam_result_details', $updateArray);
    }

    public function update_eval_marks_status($id_hash, $update_array)
    {
        $this->db->where(
            array(
                "MD5(CAST(batch_ems_id_pk as character varying)) =" => $id_hash
            )
        )
            ->update('council_batch_ems', $update_array);

        return $this->db->affected_rows();
    }
    
}
/* End of file Batch_model.php */
?>