<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Online_exam_model extends CI_Model
{

	public function updateBatchAssessorMap($condition, $updateArray)
	{
		$this->db->where($condition)->update('council_batch_assessor_map', $updateArray);
		return $this->db->affected_rows();
	}

	public function getBatchAssessorMap($condition)
	{
		return $this->db->where($condition)->get('council_batch_assessor_map')->result_array();
	}

	public function getAssessorExamDetails($id_hash)
	{
		$query = $this->db->select("cbems.*,sector.sector_name, course.course_name, exam_type.question_type_name, exame_venue.institute_name, cbam.eligibility, camd.assessment_mode_name, cbam.exam_status, cbam.exam_start_time")
			->from("council_batch_assessor_map as cbam")
			->join("council_batch_ems as cbems", "cbam.batch_ems_id_fk = cbems.batch_ems_id_pk", "left")
			->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")
			->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
			->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
			->join("council_question_type_master as exam_type", "exam_type.question_type_id_pk = cbems.batch_type", "left")
			->join("council_exame_venue_details as exame_venue", "exame_venue.venue_id_pk = cbems.venue", "left")
			->join("council_assessment_mode_details as camd", "camd.assessment_mode_id_pk = cbems.assment_mode", "left")
			->where(
				array(
					"cbam.assessor_id_fk" => $id_hash
				)
			)
			->order_by('cbems.end_date', 'ASC')
			->get();
		return $query->result_array();
	}
	public function getAssessorBatchDetails($batch_id_hash, $assessor_id)
	{
		$query = $this->db->select("cbems.*,sector.sector_name, course.course_name, exam_type.question_type_name, exame_venue.institute_name, cbam.eligibility, camd.assessment_mode_name, cbam.exam_status, cbam.exam_start_time")
			->from("council_batch_ems as cbems")
			->join("council_batch_assessor_map as cbam", "cbam.batch_ems_id_fk=cbems.batch_ems_id_pk", "left")
			->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")
			->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
			->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
			->join("council_question_type_master as exam_type", "exam_type.question_type_id_pk = cbems.batch_type", "left")
			->join("council_exame_venue_details as exame_venue", "exame_venue.venue_id_pk = cbems.venue", "left")
			->join("council_assessment_mode_details as camd", "camd.assessment_mode_id_pk = cbems.assment_mode", "left")
			->where(
				array(
					'MD5(CAST(cbems.batch_ems_id_pk AS character varying)) =' => $batch_id_hash,
					"cbam.assessor_id_fk" => $assessor_id
				)
			)
			->get();
		return $query->result_array();
	}


	public function get_batch_questions($batch_id_hash = null)
	{
		$query = $this->db->select("*")
			->from("council_batch_question_map as cbqm")
			->where(
				array(
					'MD5(CAST(cbqm.batch_id_fk AS character varying)) =' => $batch_id_hash
				)
			)
			->get();
		return $query->result_array();
	}

	public function fetchQuestions($qusetion_id, $exam_question_no = NULL, $status = NULL)
	{

		if ($status == "view_correct_response" and $exam_question_no != NULL) {
			$query = $this->db->select("question_id_pk,question,option1,option2,option3,option4,right_answer")
				->from("council_question_bank")
				->where_in("question_id_pk", $qusetion_id)
				->get();
		} else if ($status == NULL and $exam_question_no == NULL) {
			$query = $this->db->select("question_id_pk,question,option1,option2,option3,option4")
				->from("council_question_bank")
				->where_in("question_id_pk", $qusetion_id)
				->get();
		}

		//print $this->db->last_query(); die;
		return $query->result_array();
	}


	public function fetchAnswers($qusetion_id)
	{
		$query = $this->db->select("question_id_pk,right_answer")
			->from("council_question_bank")
			->where_in("question_id_pk", $qusetion_id)
			->get();
		//print $this->db->last_query(); die;
		return $query->result_array();
	}

	public function result_submit($data)
	{
		$this->db->trans_start();
		$this->db->insert('council_assessor_exam_result_details', $data);

		//echo $this->db->last_query(); die;

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
			$this->db->trans_commit();
			return TRUE;
		}
	}




























	public function fetchQuestions_old($degree_code, $course_code, $subject_code, $level_code, $semester_code, $module_code, $exam_question_no = NULL, $status = NULL)
	{

		if ($status == "view_correct_response" and $exam_question_no != NULL) {
			$query = $this->db->select("question_no,question,option1,option2,option3,option4,right_answer")
				->from("elearning_question_bank")
				->where("degree_code", $degree_code)
				->where("course_code", $course_code)
				->where("subject_code", $subject_code)
				->where("level_code", $level_code)
				->where("semester_code", $semester_code)
				->where("module_code", $module_code)
				->where_in("question_no", $exam_question_no)
				->get();
		} else if ($status == NULL and $exam_question_no == NULL) {
			$query = $this->db->select("question_no,question,option1,option2,option3,option4")
				->from("elearning_question_bank")
				->where("degree_code", $degree_code)
				->where("course_code", $course_code)
				->where("subject_code", $subject_code)
				->where("level_code", $level_code)
				->where("semester_code", $semester_code)
				->where("module_code", $module_code)
				->get();
		}

		//print $this->db->last_query(); die;
		return $query->result_array();
	}

	/*
		public function fetchAnswers($degree_code,$course_code,$subject_code,$level_code,$semester_code,$module_code)
		{
			$query = $this->db->select("degree_code,course_code,subject_code,level_code,semester_code,module_code,question_no,right_answer")
			->from("elearning_question_bank")
			->where("degree_code",$degree_code)
			->where("course_code",$course_code)
			->where("subject_code",$subject_code)
			->where("level_code",$level_code)
			->where("semester_code",$semester_code)
			->where("module_code",$module_code)
			->get();
			//print $this->db->last_query(); die;
			return $query->result_array();
		}
		*/






	public function fetchResult($login_id)
	{
		$query = $this->db->select("*")
			->from("elearning_exam_details")
			->where("login_id", $login_id)
			->order_by('exam_taken_date', 'desc')
			->limit('1')
			->get();
		//print $this->db->last_query();
		return $query->result_array();
	}


	public function get_semester_query($course_code)
	{
		$query = $this->db->select('*')->from('elearning_semester_code_master')
			->where('course_code', $course_code)
			->order_by('semester_name')
			->get();
		return $query->result();
	}

	public function get_subject_query($semester_id)
	{
		$query = $this->db->select('*')->from('elearning_subject_code_master')
			->where('semester_code', $semester_id)
			->order_by('subject_name')
			->get();
		return $query->result();
	}


	public function get_module_query($subject_code)
	{
		$query = $this->db->select('*')->from('elearning_module_code_master')
			->where('subject_code', $subject_code)
			->order_by('module_name')
			->get();
		return $query->result();
	}


	public function get_level_query($module_code)
	{
		$query = $this->db->select('*')->from('elearning_level_code_master')
			->where('module_code', $module_code)
			->order_by('level_name')
			->get();
		//echo $this->db->last_query(); 
		return $query->result();
	}

	public function getQuestionForExan($qusetion_id = NULL)
	{
		$this->db->where("question_id_fk", $qusetion_id);
		return $this->db->get('council_question_bank_english_lang')->result_array();
	}

	public function getUserAnsByQuestionId($qusetion_id = NULL, $batch_id = NULL, $assessor_id = NULL)
	{
		$this->db->where(array(
			"question_id_fk"  => $qusetion_id,
			"batch_ems_id_fk" => $batch_id,
			"assessor_id_fk"  => $assessor_id,
		));
		return $this->db->get('council_assessor_answer_sheet')->result_array();
	}

	public function getAssessorAnswerSheet($batch_id_hash, $assessor_id_fk)
	{
		$this->db->where(array(
			'MD5(CAST(batch_ems_id_fk AS character varying)) =' => $batch_id_hash,
			'assessor_id_fk'  => $assessor_id_fk,
		));
		return $this->db->get('council_assessor_answer_sheet')->result_array();
	}

	public function getAssessorResult($batch_id_hash, $assessor_id_fk)
	{
		$this->db->where(array(
			'MD5(CAST(batch_id_fk AS character varying)) =' => $batch_id_hash,
			'assessor_id_fk'  => $assessor_id_fk,
		));
		return $this->db->get('council_assessor_exam_result_details')->result_array();
	}

	public function insertOrUpdateAnswerSheet($dataArray = NULL)
	{
		$this->db->where(array(
			'batch_ems_id_fk' => $dataArray['batch_ems_id_fk'],
			'assessor_id_fk'  => $dataArray['assessor_id_fk'],
			'question_id_fk'  => $dataArray['question_id_fk'],
		));
		$userAnswer = $this->db->get('council_assessor_answer_sheet')->result_array();

		if (!empty($userAnswer)) {

			$userAnswer = $userAnswer[0];
			$dataArray['update_time'] = "now()";

			$this->db->where('answer_sheet_id_pk', $userAnswer['answer_sheet_id_pk']);
			$this->db->update('council_assessor_answer_sheet', $dataArray);

			return $this->db->affected_rows();
		} else {

			$this->db->insert('council_assessor_answer_sheet', $dataArray);
			return $this->db->insert_id();
		}
	}
}
