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

    public function getAssessorIdInBatch($batch_id, $map_id)
    {
        $query = $this->db->select("batch_assessor_map_id_pk")
            ->from("council_batch_assessor_map")
            ->where(
                array("batch_ems_id_fk" => $batch_id)
            )
            ->where_not_in('batch_assessor_map_id_pk', $map_id)
            ->get();
        return $query->result_array();
    }

    public function updateAssessorEligibility($batch_id, $map_id, $update_array)
    {
        $this->db->where(
			array('batch_ems_id_fk' => $batch_id)
		)
        ->where_in('batch_assessor_map_id_pk', $map_id)
		->update('council_batch_assessor_map', $update_array);

        return $this->db->affected_rows();
    }

    public function getBatchDetails($id_hash)
    {
        $query = $this->db->select("cbems.*, sector.sector_name, course.course_name")
            ->from("council_batch_ems as cbems")
            ->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
            ->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
            ->where(
                array(
                    "MD5(CAST(cbems.batch_ems_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }
    
    public function getQuestionList($sector_id, $course_id)
    {
        $query = $this->db->select("question_id_pk")
            ->from("council_question_bank")
            ->where(
                array(
                    "sector_id" => $sector_id,
                    "course_id" => $course_id
                )
            )
            ->order_by('question_id_pk', 'RANDOM')
            ->limit(10)
            ->get();
        return $query->result_array();
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
    
}
/* End of file Batch_model.php */
?>