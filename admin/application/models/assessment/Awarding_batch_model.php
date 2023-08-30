<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Awarding_batch_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTraineeBatchCount()
    {
        $query = $this->db->select("count(assessment_batch_id_pk)")
            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_assessor_map AS assessor_map", "assessor_map.assessment_batch_id_fk = batch.assessment_batch_id_pk")
            ->where(
                array(
                    'batch.active_status' => 1,
                    'assessor_map.active_status' => 1
                )
            )
            ->where_in('batch.process_id_fk', [9, 11, 12, 13, 14, 15])
            ->get();
        return $query->result_array();
    }

    public function getAllTraineeBatch($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.assessment_batch_id_pk,
            batch.entry_time,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.user_batch_id,
            batch.process_id_fk,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            batch.flag_finalize_assessment,
            batch.flag_assessor_inability_status,
            batch.flag_batch_marks_status,
            
            process.process_name,

            vertical.vertical_name,
            vertical.vertical_code,

            scheme_master.assessment_scheme_name,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            
            tp_details.council_tp_name,
            tp_details.council_tp_code,
            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_assessor_map AS assessor_map", "assessor_map.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    'batch.active_status' => 1,
                    'assessor_map.active_status' => 1
                )
            )
            // ->where('batch.process_id_fk >', 7)
            ->where_in('batch.process_id_fk', [9, 11, 12, 13, 14, 15])
            ->order_by("batch.entry_time", "DESC")
            ->limit($limit, $offset)
            ->get();

        return $query->result_array();
    }

    public function getTraineeAttendanceList($id_hash = NULL)
    {
        return $this->db->select('
            trainee.council_trainee_code,
            trainee.user_trainee_id,
            trainee.trainee_full_name,
            trainee.trainee_mobile_no,
            trainee.trainee_email,
            attendance.trainee_in_time,
            trainee.attendance_percentage,
        ')
            ->from('council_assessment_trainee_details AS trainee')
            ->join('council_assessment_trainee_attendance AS attendance', 'attendance.trainee_id_fk = trainee.assessment_trainee_id_pk', 'LEFT')
            ->where("MD5(CAST(trainee.assessment_batch_id_fk as character varying)) =", $id_hash)
            ->get()->result_array();
    }

    public function getTraineeMarks($id_hash = NULL)
    {
        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk, 
            trainee.council_trainee_code, 
            trainee.user_trainee_id, 
            trainee.trainee_full_name, 
            trainee.trainee_mobile_no, 
            trainee.trainee_email, 
            trainee.trainee_address, 
            trainee.trainee_pincode,
            trainee.total_marks,
            trainee.exam_result,
            batch.flag_batch_marks_status,
            batch.batch_marks_status_comment,
            batch.batch_marks_status_updated_date,
            attendance.trainee_in_time
        ")
            ->from('council_assessment_trainee_details AS trainee')
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_trainee_attendance AS attendance", "attendance.trainee_id_fk = trainee.assessment_trainee_id_pk", "LEFT")
            ->where("MD5(CAST(trainee.assessment_batch_id_fk as character varying)) =", $id_hash)
            ->order_by("trainee_full_name", "ASC")
            ->get()->result_array();

        foreach ($tranee_details as $key => $tranee) {

            $result = $this->db->select('
                result.course_marks_id_fk,
                result.theory_marks,
                result.practical_marks,
                result.viva_marks,
                result.total_marks,
                result.entry_time,
                result.nos_result,
                
                nos.nos_name,
                nos.nos_code,

                pass_marks.total_marks AS total_course_marks,
                pass_marks.total_pass_marks,
            ')
                ->from('council_assessment_trainee_result_details AS result')
                ->join("council_assessment_nos_course_marks_master AS nos", "nos.course_marks_id_pk = result.course_marks_id_fk", "LEFT")
                ->join("council_assessment_course_pass_marks AS pass_marks", "pass_marks.course_id_fk = nos.course_id_fk", "LEFT")
                ->where('trainee_id_fk', $tranee['assessment_trainee_id_pk'])
                ->get()->result_array();

            $tranee_details[$key]['tranee_marks'] = $result;
        }

        return $tranee_details;
    }

    public function getAssessmentDoc($id_hash)
    {
        $this->db->select('assessment_doc, attendance_doc, vertical_code, assessment_batch_id_pk');

        $this->db->where("MD5(CAST(assessment_batch_id_pk as character varying)) =", $id_hash);

        return $this->db->get('council_assessment_batch_details')->result_array();
    }

    public function getBatchByIdHash($id_hash)
    {
        $result = $this->db->where(
            array(
                "MD5(CAST(assessment_batch_id_pk as character varying)) =" => $id_hash
            )
        )
            ->get('council_assessment_batch_details');

        return $result->result_array();
    }

    public function updateTraineeMarksStatus($data)
    {
        $id_hash = $data['id_hash'];
        unset($data['id_hash']);

        $this->db->where(
            array(
                "MD5(CAST(assessment_batch_id_pk as character varying)) =" => $id_hash
            )
        )
            ->update('council_assessment_batch_details', $data);
        return $this->db->affected_rows();
    }

    public function assessmentCompleteData($batch_id = NULL)
    {
        $batch_details = $this->db->select("
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.assessment_batch_id_pk,
            batch.entry_time,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.user_batch_id,
            batch.assessment_completed_date AS assessmentCompletedDate,
            batch.proposed_assessment_date,

            batch_process.process_id_pk AS batch_process_id,
            batch_process.process_name AS batch_process_name,
            
            card.assessor_registration_details_pk,
            card.fname,
            card.lname,
            card.email_id,
            card.mobile_no,
            card.assessor_code,
            
            cabam.entry_time AS assessorAssignDate,
            cabam.assessor_assign_notes,
            cabam.purpose_assessment_date,
            
            vertical.vertical_name,
            vertical.vertical_code,

            scheme_master.assessment_scheme_name,
            course.course_id_pk,
            district.district_id_pk,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            tc_details.tc_district_lgd,
            
            tp_details.council_tp_name,
            tp_details.council_tp_code,
            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS batch_process", "batch_process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.lgd_code = tc_details.tc_district_lgd", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->join("council_assessor_registration_details AS card", "card.assessor_registration_details_pk = cabam.assessor_id_fk", "LEFT")
            ->join("council_process_master AS assessor_batch_process", "assessor_batch_process.process_id_pk = cabam.process_id_fk", "LEFT")
            ->where(
                array(
                    "batch.assessment_batch_id_pk" => $batch_id,
                    "cabam.process_id_fk" => 9,
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $tranee_details = $this->db->select("
            trainee.user_trainee_id AS traineeId,
            trainee.council_trainee_code AS councilTraineeId,
            trainee.trainee_full_name AS traineeName, 
        ")
            ->from("council_assessment_trainee_details as trainee")
            ->where(array(
                "trainee.assessment_batch_id_fk" => $batch_id
            ))
            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => $batch_details[0],
            "tranee_details" => $tranee_details
        );
    }

    public function insertAssessmentjsonData($data)
    {
        if ($this->db->insert('council_assessment_json_data', $data)) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    public function updateAssessmentjsonData($id, $array)
    {
        $this->db->where(
            array(
                'council_json_data_id_pk' => $id
            )
        )
            ->update('council_assessment_json_data', $array);
        return $this->db->affected_rows();
    }

    public function getTraineeList($id_hash = NULL)
    {
        return $this->db->where("MD5(CAST(assessment_batch_id_fk as character varying)) =", $id_hash)
            ->where("total_marks !=", NULL)->get('council_assessment_trainee_details')->result_array();
    }

    public function getTraineeDetails($id_hash = NULL)
    {
        $query = $this->db->select("
            trainee.assessment_trainee_id_pk, 
            trainee.user_trainee_registration_no, 
            trainee.trainee_full_name, 
            trainee.trainee_guardian_name, 
            trainee.trainee_qr_code, 
            trainee.exam_result,
			trainee.trainee_image,
			trainee.certificate_no,
            trainee.certificate_council_code,

            batch.assessment_batch_id_pk AS batch_id_pk,
            batch.sector_code,
            batch.sector_name,
            course.course_id_pk,
            course.course_level,
            batch.course_code,
            batch.course_name,
            batch.course_duration,
			batch.batch_marks_status_updated_date,

            tc_details.council_tc_name,
            tc_details.tc_state_name,
            tc_details.tc_district_name,
        ")
            ->from('council_assessment_trainee_details AS trainee')
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where("MD5(CAST(trainee.assessment_trainee_id_pk as character varying)) =", $id_hash)
            ->get()->result_array();

        return $query;
    }

    public function getTraineeNosDetails($trainee_id = NULL)
    {
        $query = $this->db->select('
            nos.nos_code,
            nos.nos_name,
            nos_type.nos_id_pk,
            nos_type.nos_name AS nos_type,

            nos.nos_theory_marks,
            nos.nos_practical_marks,
            nos.nos_viva_marks,

            result.total_marks,
        ')
            ->from('council_assessment_trainee_result_details AS result')
            ->join("council_assessment_nos_course_marks_master AS nos", "nos.course_marks_id_pk = result.course_marks_id_fk", "LEFT")
            ->join("council_nos_master AS nos_type", "nos_type.nos_id_pk = nos.nos_type", "LEFT")
            ->where('result.trainee_id_fk', $trainee_id)
            ->get()->result_array();

        return $query;
    }

    public function getAllSector()
    {
        $this->db->where(
            array(
                'active_status' => 1,
            )
        );

        $this->db->order_by('sector_name', 'asc');

        return $this->db->get('council_sector_master')->result_array();
    }

    public function getCourseBySector($sector_code)
    {
        $this->db->select("course.*")->from("council_course_master AS course")
            ->join("council_sector_master AS sector", "sector.sector_id_pk = course.sector_id_fk", "left")
            ->where(
                array(
                    'course.active_status' => 1,
                    'sector.sector_code'   => $sector_code,
                )
            );

        $this->db->order_by('course_name', 'asc');

        return $this->db->get()->result_array();
    }

    public function searchTraineeBatch($searchArray)
    {
        $query = $this->db->select("
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.assessment_batch_id_pk,
            batch.entry_time,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.user_batch_id,
            batch.process_id_fk,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            batch.flag_finalize_assessment,
            batch.flag_assessor_inability_status,
            batch.flag_batch_marks_status,
            
            process.process_name,

            vertical.vertical_name,
            vertical.vertical_code,

            scheme_master.assessment_scheme_name,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            
            tp_details.council_tp_name,
            tp_details.council_tp_code,
            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_assessor_map AS assessor_map", "assessor_map.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    'batch.active_status' => 1,
                    'assessor_map.active_status' => 1
                )
            )
            ->where_in('batch.process_id_fk', [9, 11, 12, 13, 14, 15])
            ->order_by("batch.entry_time", "DESC");

        if ($searchArray['batch_code'] != '') {

            $query = $query->where('batch.user_batch_id', $searchArray['batch_code']);
        }

        if ($searchArray['sector_code'] != '') {

            $query = $query->where('batch.sector_code', $searchArray['sector_code']);
        }

        if ($searchArray['course_code'] != '') {

            $query = $query->where('batch.course_code', $searchArray['course_code']);
        }

        if ($searchArray['assessment_status'] != '') {

            $query = $query->where('batch.process_id_fk', $searchArray['assessment_status']);
        }

        if ($searchArray['proposed_assessment_date'] != '') {

            $query = $query->where('batch.proposed_assessment_date', $searchArray['proposed_assessment_date']);
        }

        if ($searchArray['assessment_scheme'] != '') {

            $query = $query->where('batch.assessment_scheme_id_fk', $searchArray['assessment_scheme']);
        }

        return $query->get()->result_array();
    }

    public function getAssessorEmailData($id_hash = NULL)
    {
        return $this->db->select("
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.user_batch_id,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_marks_status_comment,

            tc_details.user_tc_name,
            tc_details.user_tc_code,

            assessor.fname,
            assessor.lname,
            assessor.mobile_no,
            assessor.email_id,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_batch_assessor_map AS assessor_map", "assessor_map.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = assessor_map.assessor_id_fk", "LEFT")
            ->where("MD5(CAST(batch.assessment_batch_id_pk as character varying)) =", $id_hash)
            ->where(
                array(
                    'batch.active_status' => 1,
                    'assessor_map.active_status' => 1
                )
            )
            ->get()->result_array();
    }

    public function passing_statistics_report($scheme_id = NULL)
    {
        $this->db->select("
            batch.assessment_batch_id_pk,
            batch.user_batch_id,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_size,
            batch.process_id_fk,

            assessor_map.assessor_id_fk,
            assessor_map.purpose_assessment_date,

            assessor.fname||' '||assessor.mname||' '||assessor.lname as assessor_name,

            tc_details.user_tc_name,
        ");
        $this->db->from('council_assessment_batch_details AS batch');
        $this->db->join("council_assessment_batch_assessor_map AS assessor_map", "assessor_map.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT");
        $this->db->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = assessor_map.assessor_id_fk", "LEFT");
        $this->db->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT");
        $this->db->where('assessor_map.active_status', 1);
        $this->db->where('batch.process_id_fk >', 11);
        $this->db->where('batch.assessment_scheme_id_fk', $scheme_id);

        return $this->db->get()->result_array();
    }

    public function passing_statistics_trainee_report($batch_id_pk = NULL)
    {
        $this->db->select("
            COUNT(trainee.assessment_trainee_id_pk) AS total_trainee,
            COUNT(CASE WHEN attendance.trainee_in_time IS NOT NULL THEN 1 END) AS present_trainee,
            COUNT(CASE WHEN trainee.exam_result = 1 THEN 1 END) AS pass_trainee,
            COUNT(CASE WHEN trainee.exam_result = 2 THEN 1 END) AS fail_trainee,
            COUNT(CASE WHEN trainee.total_marks = 0 THEN 1 END) AS absent_trainee
        ");
        $this->db->from('council_assessment_trainee_details AS trainee');
        $this->db->join("council_assessment_trainee_attendance AS attendance", "attendance.trainee_id_fk = trainee.assessment_trainee_id_pk", "LEFT");
        $this->db->where('trainee.assessment_batch_id_fk', $batch_id_pk);

        return $this->db->get()->result_array()[0];
    }

    public function getAssessmentScheme()
    {
        return $this->db->where('active_status', 1)->get('council_assessment_scheme_master')->result_array();
    }

    public function getNqrCode($courseCode = NULL)
    {
        return $this->db->where('qp_code', $courseCode)->get('council_nqr_codes')->result_array();
    }

    public function get_last_certificate_no($chaking_data = NULL)
    {
        return $query = $this->db->select('max(certificate_council_code) as code')
            ->from('council_assessment_trainee_details')
            ->like('certificate_council_code', ($chaking_data))
            ->get()
            ->result_array();
    }

    public function getTraineeByBatchIdHash($id_hash = NULL)
    {
        $query = $this->db->select("
            trainee.assessment_trainee_id_pk, 
            trainee.user_trainee_registration_no, 
            trainee.trainee_full_name, 
            trainee.trainee_guardian_name, 
            trainee.trainee_qr_code, 
            trainee.exam_result,

            batch.assessment_batch_id_pk AS batch_id_pk,
            batch.sector_code,
            batch.sector_name,
            course.course_id_pk,
            course.course_level,
            batch.course_code,
            batch.course_name,
            batch.course_duration
        ")
            ->from('council_assessment_trainee_details AS trainee')
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where("MD5(CAST(trainee.assessment_batch_id_fk as character varying)) =", $id_hash)
            ->where("trainee.exam_result", 1)
            ->get()->result_array();

        return $query;
    }

    public function update_trainee_certificate_no_dtls($appl_id = NULL, $update_data = NULL)
    {
        $this->db->where(
            array(
                'assessment_trainee_id_pk'        => $appl_id,
            )
        );
        $this->db->update('council_assessment_trainee_details', $update_data);
        return $this->db->affected_rows();
    }

    public function marksheetGeneratedResponseData($batch_id = NULL)
    {
        $batch_details = $this->db->select("
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.assessment_batch_id_pk,
            batch.entry_time,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.user_batch_id,
            batch.assessment_completed_date AS assessmentCompletedDate,
            batch.proposed_assessment_date,
            batch.batch_marks_status_comment,
            batch.batch_marks_status_updated_date,

            batch_process.process_id_pk AS batch_process_id,
            batch_process.process_name AS batch_process_name,
            
            vertical.vertical_name,
            vertical.vertical_code,

            scheme_master.assessment_scheme_name,
            course.course_id_pk,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_process_master AS batch_process", "batch_process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where(
                array(
                    "batch.assessment_batch_id_pk" => $batch_id,
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk,
            trainee.user_trainee_id AS traineeId,
            trainee.council_trainee_code AS councilTraineeId,
            trainee.trainee_full_name AS traineeName, 
            trainee.certificate_no AS certificateKey, 
            trainee.certificate_no_entry_time AS certificateGeneratedDate, 
            trainee.exam_result AS resultStatusId, 
            trainee.total_marks AS marksObtained, 
        ")
            ->from("council_assessment_trainee_details as trainee")
            ->where(array(
                "trainee.assessment_batch_id_fk" => $batch_id
            ))
            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => $batch_details[0],
            "tranee_details" => $tranee_details
        );
    }

    public function certificateGeneratedResponseData($batch_id = NULL)
    {
        $batch_details = $this->db->select("
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.assessment_batch_id_pk,
            batch.entry_time,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.user_batch_id,
            batch.assessment_completed_date AS assessmentCompletedDate,
            batch.proposed_assessment_date,

            batch_process.process_id_pk AS batch_process_id,
            batch_process.process_name AS batch_process_name,
            
            vertical.vertical_name,
            vertical.vertical_code,

            scheme_master.assessment_scheme_name,
            course.course_id_pk,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_process_master AS batch_process", "batch_process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where(
                array(
                    "batch.assessment_batch_id_pk" => $batch_id,
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $tranee_details = $this->db->select("
            trainee.user_trainee_id AS traineeId,
            trainee.council_trainee_code AS councilTraineeId,
            trainee.trainee_full_name AS traineeName, 
            trainee.certificate_no AS certificateKey, 
            trainee.certificate_no_entry_time AS certificateGeneratedDate, 
            trainee.exam_result AS resultStatusId, 
            trainee.total_marks AS marksObtained, 
        ")
            ->from("council_assessment_trainee_details as trainee")
            ->where(array(
                "trainee.assessment_batch_id_fk" => $batch_id
            ))
            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => $batch_details[0],
            "tranee_details" => $tranee_details
        );
    }

    public function downloadCertificateData($batch_code_hash = NULL, $trainee_code_hash = NULL, $certificate_code_hash = NULL)
    {
        $this->db->select('
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.user_batch_id,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.course_duration,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.proposed_assessment_date,
            batch.assessment_completed_date,
            batch.assessment_batch_id_pk,
            batch.batch_marks_status_updated_date,

            scheme.assessment_scheme_id_pk,
            scheme.vertical_code,
            scheme.assessment_scheme_name,
            
            trainee.assessment_trainee_id_pk,
            trainee.user_trainee_id,
            trainee.user_trainee_registration_no,
            trainee.trainee_full_name,
            trainee.trainee_guardian_name,
            trainee.guardian_relationship,
            trainee.trainee_gender,
            trainee.trainee_dob,
            trainee.trainee_mobile_no,
            trainee.trainee_email,
            trainee.total_marks,
            trainee.exam_result,
            trainee.trainee_image,
            trainee.certificate_no,
            trainee.certificate_council_code,

            tc_details.council_tc_name,
            tc_details.tc_state_name,
            tc_details.tc_district_name,
        ');
        $this->db->from('council_assessment_batch_details AS batch');

        $this->db->join('council_assessment_scheme_master AS scheme', 'scheme.assessment_scheme_id_pk = batch.assessment_scheme_id_fk', 'left');
        $this->db->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT");
        $this->db->join('council_assessment_trainee_details AS trainee', 'trainee.assessment_batch_id_fk = batch.assessment_batch_id_pk', 'left');

        $this->db->where("MD5(CAST(batch.user_batch_id as character varying)) =", $batch_code_hash);
        $this->db->where("MD5(CAST(trainee.user_trainee_id as character varying)) =", $trainee_code_hash);
        // $this->db->where("MD5(CAST(trainee.certificate_no as character varying)) =", $certificate_code_hash);

        return $this->db->get()->result_array();
    }

    public function getBatchIdByCode($batch_ids = NULL)
    {
        $this->db->select('assessment_batch_id_pk');
        $this->db->from('council_assessment_batch_details');
        $this->db->where_in('user_batch_id', $batch_ids);
        return $this->db->get()->result_array();
    }
}

/* End of file Awarding_batch_model.php */