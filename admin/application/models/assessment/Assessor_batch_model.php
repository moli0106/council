<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessor_batch_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTraineeBatchCount()
    {
        $query = $this->db->select("count(assessment_batch_id_pk)")
            ->from("council_assessment_batch_details AS batch")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->where(
                array(
                    'cabam.assessor_id_fk' => $this->session->userdata('stake_details_id_fk'),
                    'cabam.process_id_fk !='  => 10,
                    'cabam.active_status !='  => 0
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getAllTraineeBatch($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("
            cabam.assessment_batch_assessor_map_id_pk,
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.user_batch_id,
            batch.sector_name,
            batch.sector_code,
            batch.course_name,
            batch.course_code,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.entry_time,
            batch.process_id_fk,
            batch.flag_finalize_assessment,

            scheme_master.assessment_scheme_name,

            process.process_name,

            tc_details.council_tc_name,
            tc_details.user_tc_code,
            tc_details.user_tc_name,

            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,

            cabam.purpose_assessment_date AS purpose_date
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    'cabam.assessor_id_fk' => $this->session->userdata('stake_details_id_fk'),
                    'cabam.process_id_fk !='  => 10,
                    'cabam.active_status !='  => 0
                )
            )
            ->order_by("batch.entry_time", "DESC")
            ->limit($limit, $offset)
            ->get();

        return $query->result_array();
    }

    public function getBatchDetailsForApproveInability($map_id_hash = NULL)
    {
        $batch_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.process_id_fk,

            process.process_name,

            vertical.vertical_name,

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

            ->from("council_assessment_batch_assessor_map as cabam")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        return $batch_details[0];
    }

    public function getTraineeBatch($map_id_hash = NULL)
    {
        $batch_details = $this->db->select("
            cabam.assessment_batch_assessor_map_id_pk,
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.batch_size,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.course_duration,
            batch.course_rate,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.entry_time,
            batch.proposed_assessment_date,
            batch.process_id_fk,
            batch.preferred_district_name,
            batch.preferred_district_lgd,
            batch.preferred_location,

            process.process_name,

            vertical.vertical_name,

            scheme_master.assessment_scheme_name,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            tc_details.tc_mobile_no,
            tc_details.tc_email,
            tc_details.tc_spoc_name,
            tc_details.tc_spoc_mobile_no,
            tc_details.tc_spoc_email,
            tc_details.tc_address,
            tc_details.tc_pincode,
            tc_details.tc_landmark,
            tc_details.tc_latitude,
            tc_details.tc_longitude,
            tc_details.tc_state_name,
            tc_details.tc_district_name,
            tc_details.tc_block_municipality_name,

            tp_details.council_tp_name,
            tp_details.council_tp_code,
            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,
            tp_details.tp_type,
            tp_details.tp_mobile_no,
            tp_details.tp_email,
            tp_details.tp_spoc_name,
            tp_details.tp_spoc_mobile_no,
            tp_details.tp_spoc_email,
            tp_details.tp_address,
            tp_details.tp_pincode,
            tp_details.tp_landmark,
            tp_details.tp_state_name,
            tp_details.tp_district_name,
            tp_details.tp_block_municipality_name,
            
        ")

            ->from("council_assessment_batch_assessor_map as cabam")
            // ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            // ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk,
            trainee.trainee_full_name,
            trainee.council_trainee_code, 
            trainee.user_trainee_id, 
            trainee.trainee_mobile_no, 
            trainee.trainee_state_name, 
            trainee.trainee_district_name, 
            trainee.trainee_dob, 
            trainee.trainee_image, 
            attendance.trainee_in_time,
        ")
            ->from("council_assessment_trainee_details AS trainee")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = trainee.assessment_batch_id_fk", "LEFT")
            ->join('council_assessment_trainee_attendance AS attendance', 'attendance.trainee_id_fk = trainee.assessment_trainee_id_pk', 'left')
            ->where(array(
                "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
            ))
            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => (!empty($batch_details)) ? $batch_details[0] : array(),
            "tranee_details" => $tranee_details
        );
    }

    public function getTraineeBatchForUploadMarks($map_id_hash = NULL)
    {
        $batch_details = $this->db->select("
            cabam.assessment_batch_assessor_map_id_pk,
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.batch_size,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.course_duration,
            batch.course_rate,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.entry_time,
            batch.proposed_assessment_date,
            batch.process_id_fk,
            batch.flag_finalize_assessment,
            batch.assessment_doc,

            process.process_name,

            vertical.vertical_name,

            scheme_master.assessment_scheme_name,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            tc_details.tc_mobile_no,
            tc_details.tc_email,
            tc_details.tc_spoc_name,
            tc_details.tc_spoc_mobile_no,
            tc_details.tc_spoc_email,
            tc_details.tc_address,
            tc_details.tc_pincode,
            tc_details.tc_landmark,
            tc_details.tc_latitude,
            tc_details.tc_longitude,
            tc_details.tc_state_name,
            tc_details.tc_district_name,
            tc_details.tc_block_municipality_name,

            tp_details.council_tp_name,
            tp_details.council_tp_code,
            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,
            tp_details.tp_type,
            tp_details.tp_mobile_no,
            tp_details.tp_email,
            tp_details.tp_spoc_name,
            tp_details.tp_spoc_mobile_no,
            tp_details.tp_spoc_email,
            tp_details.tp_address,
            tp_details.tp_pincode,
            tp_details.tp_landmark,
            tp_details.tp_state_name,
            tp_details.tp_district_name,
            tp_details.tp_block_municipality_name,
            
            marks.theory_marks,
            marks.practical_marks,
            marks.theory_percentage,
            marks.practical_percentage,

        ")

            ->from("council_assessment_batch_assessor_map as cabam")
            // ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            // ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->join("council_assessment_course_marks AS marks", "marks.course_id_fk = course.course_id_pk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk,
            trainee.trainee_full_name,
            trainee.council_trainee_code, 
            trainee.user_trainee_id, 
            trainee.trainee_mobile_no, 
            trainee.trainee_state_name, 
            trainee.trainee_district_name, 
            trainee.trainee_dob, 

            result.theory_marks,
            result.practical_marks,
            result.total_marks,
            result.trainee_exam_status,
        ")
            /* ->from("council_assessment_trainee_details as trainee")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_trainee_result_details AS result", "result.trainee_id_fk = trainee.assessment_trainee_id_pk", "LEFT") */
            ->from("council_assessment_batch_assessor_map AS cabam")
            ->join("council_assessment_trainee_attendance AS attendance", "attendance.assessment_batch_id_fk = cabam.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_trainee_details AS trainee", "trainee.assessment_trainee_id_pk = attendance.trainee_id_fk", "LEFT")
            ->join("council_assessment_trainee_result_details AS result", "result.trainee_id_fk = trainee.assessment_trainee_id_pk", "LEFT")
            ->where(array(
                "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash,
            ))
            ->order_by("trainee.trainee_full_name", "ASC")
            ->order_by("trainee.council_trainee_code", "ASC")
            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => (!empty($batch_details)) ? $batch_details[0] : array(),
            "tranee_details" => $tranee_details
        );
    }

    public function getTraineeBatchForPdf($map_id_hash = NULL)
    {
        $batch_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.batch_size,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.proposed_assessment_date,

            vertical.vertical_name,

            scheme_master.assessment_scheme_name,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,

        ")

            ->from("council_assessment_batch_assessor_map as cabam")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $assessor_details = $this->db->select("
            assessor.assessor_registration_details_pk AS assessor_id_pk,
            assessor.fname,
            assessor.lname,
            assessor.assessor_code,
            assessor.mobile_no,
            assessor.email_id,
            state.state_name,
            district.district_name,
            assessor.pin, 
        ")
            ->from("council_assessment_batch_assessor_map AS cabam")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = cabam.assessor_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.district_id_pk = assessor.district_id_fk", "LEFT")
            ->join("council_state_master AS state", "state.state_id_pk = assessor.state_id_fk", "LEFT")

            ->where(array(
                "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
            ))

            ->get();

        $assessor_details = $assessor_details->result_array();

        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk,
            trainee.trainee_full_name,
            trainee.council_trainee_code, 
            trainee.user_trainee_id, 
            trainee.trainee_mobile_no,
        ")
            ->from("council_assessment_trainee_details as trainee")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = trainee.assessment_batch_id_fk", "LEFT")
            ->where(array(
                "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
            ))
            ->order_by('trainee.trainee_full_name', 'ASC')
            ->order_by('trainee.council_trainee_code', 'ASC')
            ->get()->result_array();

        $nos_details = $this->db->select("nos.nos_name, nos.nos_code")
            ->from("council_assessment_nos_course_marks_master AS nos")
            ->join("council_course_master AS course", "course.course_id_pk = nos.course_id_fk", "LEFT")
            ->where("course.course_code", $batch_details[0]['course_code'])
            ->where("nos.active_status", 1)
            ->order_by('nos.nos_code')
            ->get()->result_array();

        return array(
            "batch_details"     => $batch_details[0],
            "assessor_details"  => (!empty($assessor_details)) ? $assessor_details[0] : array(),
            "tranee_details"    => $tranee_details,
            "nos_details"       => $nos_details
        );
    }

    public function updateBatchAssessorMap($map_id_hash, $array)
    {
        $this->db->where(
            array(
                "MD5(CAST(assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
            )
        )
            ->update('council_assessment_batch_assessor_map', $array);
        return $this->db->affected_rows();
    }

    public function getBatchMapData($map_id_hash)
    {
        $result = $this->db->where(
            array(
                "MD5(CAST(assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
            )
        )
            ->get('council_assessment_batch_assessor_map');

        return $result->result_array();
    }

    public function updateAssessmentBatchDetails($id_hash, $array)
    {
        $this->db->where(
            array(
                "MD5(CAST(assessment_batch_id_pk as character varying)) =" => $id_hash
            )
        )
            ->update('council_assessment_batch_details', $array);
        return $this->db->affected_rows();
    }

    public function getBasicBatchInformation($id_hash = NULL, $assessor_id = NULL)
    {
        $batch_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            
            course.course_id_pk,
            
            district.district_id_pk,

            preferred_district.district_id_pk AS preferred_district_id_pk,
            
            cabam.purpose_assessment_date,
            cabam.assessor_assign_notes,
            cabam.entry_by_id_fk,
            cabam.entry_time,
            cabam.entry_ip,

            vertical.vertical_name,
            vertical.vertical_code,
            ")

            ->from("council_assessment_batch_details as batch")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.lgd_code = tc_details.tc_district_lgd", "LEFT")
            ->join("council_district_master AS preferred_district", "preferred_district.lgd_code = batch.preferred_district_lgd", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(batch.assessment_batch_id_pk as character varying)) =" => $id_hash,
                    "cabam.assessor_id_fk" => $assessor_id
                )
            )
            ->get();

        return $batch_details->result_array();
    }

    public function getBasicMapBatchInformation($map_id_hash = NULL, $assessor_id = NULL)
    {
        $batch_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            
            course.course_id_pk,
            
            district.district_id_pk,
            
            cabam.purpose_assessment_date,
            cabam.assessor_assign_notes,
            cabam.entry_by_id_fk,
            cabam.entry_time,
            cabam.entry_ip,

            vertical.vertical_name,
            vertical.vertical_code,
            ")

            ->from("council_assessment_batch_details as batch")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.lgd_code = tc_details.tc_district_lgd", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash,
                    "cabam.assessor_id_fk" => $assessor_id
                )
            )
            ->get();

        return $batch_details->result_array();
    }

    public function createBatchAssessorMap($array)
    {
        $this->db->insert('council_assessment_batch_assessor_map', $array);

        return $this->db->insert_id();
    }

    public function assignedAssessorResponse($map_id = NULL)
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
            
            assessor_batch_process.process_id_pk AS assessor_batch_process_id,
            assessor_batch_process.process_name AS assessor_batch_process_name,

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
                    "cabam.assessment_batch_assessor_map_id_pk" => $map_id
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
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = trainee.assessment_batch_id_fk", "LEFT")
            ->where(array(
                "cabam.assessment_batch_assessor_map_id_pk" => $map_id
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

    public function batchInsertTraineeResult($array = NULL)
    {

        $this->db->insert_batch('council_assessment_trainee_result_details', $array);

        return true;
    }

    public function updateTraineeMarks($whereArray = NULL, $updateArray = NULL)
    {
        $this->db->where($whereArray);

        $this->db->update('council_assessment_trainee_result_details', $updateArray);

        return true;
    }

    public function getAssessmentDoc($id_hash)
    {
        $this->db->select('assessment_doc, vertical_code, assessment_batch_id_pk');

        $this->db->where("MD5(CAST(assessment_batch_id_pk as character varying)) =", $id_hash);

        return $this->db->get('council_assessment_batch_details')->result_array();
    }

    public function assessorCompleteData($batch_id = NULL)
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

    public function assessorApproveResponse($map_id = NULL)
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
            cabam.assessor_confirm_date,
            
            assessor_batch_process.process_id_pk AS assessor_batch_process_id,
            assessor_batch_process.process_name AS assessor_batch_process_name,

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
                    "cabam.assessment_batch_assessor_map_id_pk" => $map_id
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
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = trainee.assessment_batch_id_fk", "LEFT")
            ->where(array(
                "cabam.assessment_batch_assessor_map_id_pk" => $map_id
            ))
            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => $batch_details[0],
            "tranee_details" => $tranee_details
        );
    }

    public function getTraineeList($map_id_hash)
    {
        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk,
            trainee.assessment_batch_id_fk,
            trainee.trainee_full_name,
            trainee.council_trainee_code,
            trainee.user_trainee_id,
            trainee.trainee_mobile_no,
            trainee.trainee_state_name,
            trainee.trainee_district_name,
            trainee.trainee_dob,
            trainee.total_marks,
            trainee.exam_result,
            batch.user_batch_id,
            batch.assessment_scheme_id_fk,
            batch.proposed_assessment_date,
            batch.flag_finalize_assessment,
            batch.flag_batch_marks_status,
            batch.batch_marks_status_comment,
            batch.batch_marks_status_updated_date,
            batch.flag_trainee_attendance_captured,
            attendance.trainee_in_time,
            trainee.trainee_image,
        ")
            ->from("council_assessment_trainee_details as trainee")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_trainee_attendance AS attendance", "attendance.trainee_id_fk = trainee.assessment_trainee_id_pk", "LEFT")
            ->where(array(
                "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash
            ))
            ->order_by('trainee.trainee_full_name')
            ->get();

        return $tranee_details->result_array();
    }

    public function getCourseDetails($trainee_id_hash)
    {
        $tranee_details = $this->db->select("
            trainee.assessment_trainee_id_pk, 
            trainee.user_trainee_id, 
            trainee.council_trainee_code, 
            trainee.trainee_full_name, 
            trainee.trainee_email, 
            trainee.trainee_mobile_no, 
            batch.assessment_batch_id_pk, 
            batch.course_name, 
            batch.course_code, 
            batchMap.assessment_batch_assessor_map_id_pk,
            batch.flag_finalize_assessment
        ")
            ->from("council_assessment_trainee_details as trainee")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_batch_assessor_map AS batchMap", "batchMap.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->where(array(
                "batchMap.active_status" => 1,
                "MD5(CAST(trainee.assessment_trainee_id_pk as character varying)) =" => $trainee_id_hash
            ))
            ->get();

        return $tranee_details->result_array();
    }

    public function getCourseMarksDetails($trainee_id_hash)
    {
        $tranee_details = $this->db->select("nos.*, batch.assessment_batch_id_pk, pass_marks.total_marks, pass_marks.total_pass_marks, pass_marks.pass_in_every_nos")
            ->from("council_assessment_nos_course_marks_master AS nos")
            ->join("council_course_master AS course", "course.course_id_pk = nos.course_id_fk", "LEFT")
            ->join("council_assessment_course_pass_marks AS pass_marks", "course.course_id_pk = pass_marks.course_id_fk", "LEFT")
            ->join("council_assessment_batch_details AS batch", "batch.course_code = course.course_code", "LEFT")
            ->join("council_assessment_trainee_details AS trainee", "trainee.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->where(array(
                "MD5(CAST(trainee.assessment_trainee_id_pk as character varying)) =" => $trainee_id_hash,
                "nos.active_status" => 1
            ))
            ->order_by('nos.nos_code')
            ->get();

        return $tranee_details->result_array();
    }

    public function getCourseMarksById($id)
    {
        return $this->db->where('course_marks_id_pk', $id)->get('council_assessment_nos_course_marks_master')->result_array();
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
            batch.user_batch_id,
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

    public function getTraineeMarksDetails($batch_id, $trainee_id_hash)
    {
        return $this->db->where('assessment_batch_id_fk', $batch_id)
            ->where("MD5(CAST(trainee_id_fk as character varying)) =", $trainee_id_hash)
            ->get('council_assessment_trainee_result_details')->result_array();
    }

    public function getTraineeResultByNos($batch_id, $trainee_id_hash, $course_marks_id)
    {
        return $this->db->where('assessment_batch_id_fk', $batch_id)
            ->where('course_marks_id_fk', $course_marks_id)
            ->where("MD5(CAST(trainee_id_fk as character varying)) =", $trainee_id_hash)
            ->get('council_assessment_trainee_result_details')->result_array();
    }

    public function updateTraineeResult($trainee_id, $array)
    {
        $this->db->where('assessment_trainee_id_pk', $trainee_id)
            ->update('council_assessment_trainee_details', $array);
        return $this->db->affected_rows();
    }

    public function getHolidays($startDate, $endDate)
    {
        $this->db->select('start_date, end_date');
        $this->db->where('start_date >=', $startDate);
        $this->db->where('end_date <=', $endDate);
        $this->db->order_by('start_date');

        $result = $this->db->get('council_holiday_calendar')->result_array();

        $holiDays  = array();
        $startDate = array_column($result, 'start_date');
        $endDate   = array_column($result, 'end_date');

        foreach ($startDate as $key => $date) {

            if ($date != $endDate[$key]) {

                $end = new DateTime($endDate[$key]);
                $end->modify('+1 day');

                $period = new DatePeriod(new DateTime($date), new DateInterval('P1D'), $end);

                foreach ($period as $key1 => $value1) {

                    array_push($holiDays, $value1->format('Y-m-d'));
                }
            } else {

                array_push($holiDays, $date);
            }
        }

        return $holiDays;
    }

    public function getMapDistrict($district_id)
    {
        $result = $this->db->select('district_map_id_fk')->where('district_id_fk', $district_id)->get('council_assessment_district_map');

        return $result->result_array();
    }

    public function checkAssessor_old($array = NULL)
    {
        $batch_details = $this->db->select("
            empanelled.assessor_id_fk
        ")
            ->from("council_assessor_empanelled_map as empanelled")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = empanelled.assessor_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.district_id_pk = assessor.district_id_fk", "LEFT")
            ->join("council_assessment_batch_assessor_map AS batch_assessor_map", "batch_assessor_map.assessor_id_fk = empanelled.assessor_id_fk", "LEFT")
            ->where(
                array(
                    'empanelled.active_status' => 1,
                    'empanelled.course_id_fk'  => $array['course_id'],
                    'district.district_id_pk'  => $array['district_id'],
                )
            )
            ->group_start()
            ->where("batch_assessor_map.purpose_assessment_date !=", $array['assessment_date'])
            ->or_where("batch_assessor_map.purpose_assessment_date", NULL)
            ->group_end()
            ->order_by('empanelled.assessor_id_fk', 'RANDOM')
            ->limit(1)
            ->get();
        return $batch_details->result_array();
    }

    public function checkAssessor($array = NULL)
    {
        $result = array();

        $batch_details = $this->db->select("empanelled.assessor_id_fk, COUNT(batch_assessor_map.assessor_id_fk) AS assessment_count")
            ->from("council_assessor_empanelled_map as empanelled")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = empanelled.assessor_id_fk", "LEFT")
            ->join("council_assessment_batch_assessor_map AS batch_assessor_map", "batch_assessor_map.assessor_id_fk = empanelled.assessor_id_fk", "LEFT")
            ->where(
                array(
                    'empanelled.active_status' => 1,
                    'empanelled.course_id_fk'  => $array['course_id'],
                    'assessor.district_id_fk'  => $array['district_id'],
                )
            )
            ->group_by('empanelled.assessor_id_fk')
            // ->order_by('empanelled.assessor_id_fk', 'RANDOM')
            ->order_by('assessment_count')->get()->result_array();

        // shuffle($batch_details);
        // shuffle($batch_details);

        foreach ($batch_details as $key => $value) {
            $assessor_id_fk = $value['assessor_id_fk'];

            $query = $this->db->where('assessor_id_fk', $assessor_id_fk)
                ->where('purpose_assessment_date', $array['assessment_date'])
                ->get('council_assessment_batch_assessor_map')->result_array();

            if (empty($query)) {
                $result = array(array('assessor_id_fk' => $assessor_id_fk));
                break;
            }
        }

        return $result;
    }

    public function checkAssessorForAnotherDistrict_old($array = NULL)
    {
        $batch_details = $this->db->select("
            empanelled.assessor_id_fk
        ")
            ->from("council_assessor_empanelled_map as empanelled")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = empanelled.assessor_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.district_id_pk = assessor.district_id_fk", "LEFT")
            ->join("council_assessment_batch_assessor_map AS batch_assessor_map", "batch_assessor_map.assessor_id_fk = empanelled.assessor_id_fk", "LEFT")
            ->where(
                array(
                    'empanelled.active_status' => 1,
                    'empanelled.course_id_fk'  => $array['course_id'],
                    // 'district.district_id_pk'  => $array['district_id'],
                )
            )
            ->where_in('district.district_id_pk', $array['district_ids'])
            ->group_start()
            ->where("batch_assessor_map.purpose_assessment_date !=", $array['assessment_date'])
            ->or_where("batch_assessor_map.purpose_assessment_date", NULL)
            ->group_end()
            ->order_by('empanelled.assessor_id_fk', 'RANDOM')
            ->limit(1)
            ->get();
        return $batch_details->result_array();
    }

    public function checkAssessorForAnotherDistrict($array = NULL)
    {
        $result = array();

        $batch_details = $this->db->select("empanelled.assessor_id_fk, COUNT(batch_assessor_map.assessor_id_fk) AS assessment_count")
            ->from("council_assessor_empanelled_map as empanelled")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = empanelled.assessor_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.district_id_pk = assessor.district_id_fk", "LEFT")
            ->join("council_assessment_batch_assessor_map AS batch_assessor_map", "batch_assessor_map.assessor_id_fk = empanelled.assessor_id_fk", "LEFT")
            ->where(
                array(
                    'empanelled.active_status' => 1,
                    'empanelled.course_id_fk'  => $array['course_id'],
                )
            )
            ->where_in('district.district_id_pk', $array['district_ids'])

            ->group_by('empanelled.assessor_id_fk')
            // ->order_by('empanelled.assessor_id_fk', 'RANDOM')
            ->order_by('assessment_count')->get()->result_array();

        // shuffle($batch_details);
        // shuffle($batch_details);

        foreach ($batch_details as $key => $value) {
            $assessor_id_fk = $value['assessor_id_fk'];

            $query = $this->db->where('assessor_id_fk', $assessor_id_fk)
                ->where('purpose_assessment_date', $array['assessment_date'])
                ->get('council_assessment_batch_assessor_map')->result_array();

            if (empty($query)) {
                $result = array(array('assessor_id_fk' => $assessor_id_fk));
                break;
            }
        }

        return $result;
    }

    public function insertMapQuestionList($array)
    {
        $this->db->insert_batch('council_assessment_batch_question_map', $array);

        return TRUE;
    }

    public function getMapQuestionList($map_id_hash = NULL)
    {
        $result = $this->db->select("cabqm.*")
            ->from("council_assessment_batch_assessor_map as cabam")
            ->join("council_assessment_batch_question_map AS cabqm", "cabqm.assessment_batch_id_fk = cabam.assessment_batch_id_fk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash,
                    "cabqm.active_status" => 1,
                    "cabqm.question_list !=" => NULL
                )
            )
            ->get()->result_array();

        return $result;
    }

    public function prepairQuestionList($map_id_hash = NULL)
    {
        $nos_details = $this->db->select("
            nos.course_marks_id_pk,
            nos.nos_wise_no_of_theory_question,
            batch.assessment_batch_id_pk,
            batch.assessment_scheme_id_fk,
        ")

            ->from("council_assessment_batch_assessor_map as cabam")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->join("council_assessment_nos_course_marks_master AS nos", "nos.course_id_fk = course.course_id_pk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash,
                    "nos.active_status" => 1
                )
            )
            ->get()->result_array();

        if (!empty($nos_details)) {

            foreach ($nos_details as $nos_key => $nos) {

                $programme_id = ($nos['assessment_scheme_id_fk'] == 1) ? 2 : 1;

                $question_bank = $this->db->select('question_id_pk')
                    ->from('council_question_bank AS cqb')
                    ->where(array(
                        'cqb.nos_id'               => $nos['course_marks_id_pk'],
                        'cqb.active_status'        => 1,
                        //'cqb.programme_id'         => $programme_id, // 1: RPL, 2: STT, 3: CSSVSE
                        'cqb.question_type_id'     => 1, // 1: Domain, 2: Platform
                        'cqb.question_for_id'      => 1, // 1: Trainee, 2: Assessor
                        'cqb.process_status_id_fk' => 5,
                    ));

                // ! for CSSVSE question
                if ($nos['assessment_scheme_id_fk'] == 3) {

                    $question_bank = $question_bank->where('cqb.programme_id', 3);
                }
                $question_bank = $question_bank->order_by('question_id_pk', 'RANDOM')
                    ->limit($nos['nos_wise_no_of_theory_question'])
                    ->get()->result_array();

                if (!empty($question_bank) && count($question_bank) >= $nos['nos_wise_no_of_theory_question']) {

                    $nos_details[$nos_key]['question_id_list'] = implode(',', array_column($question_bank, 'question_id_pk'));
                } else {

                    return FALSE;
                }
            }
        } else {

            return FALSE;
        }

        return $nos_details;
    }

    public function getQuestionListForPdf($nos_id_fk = NULL, $questionList = NULL)
    {
        $nos_details = $this->db->where('course_marks_id_pk', $nos_id_fk)->get('council_assessment_nos_course_marks_master')->result_array()[0];

        $question_bank = $this->db->select('question_id_pk')
            ->from('council_question_bank AS')
            ->where_in('question_id_pk', $questionList)
            ->get()->result_array();

        foreach ($question_bank as $question_key => $question) {

            $eng_questions = $this->db->select('
                eng_question_id_pk,
                question,
                option1,
                option2,
                option3,
                option4,
                question_pic,
                option1_pic,
                option2_pic,
                option3_pic,
                option4_pic,
            ')
                ->from('council_question_bank_english_lang')
                ->where(array(
                    'question_id_fk' => $question['question_id_pk'],
                    'active_status'  => 1,
                ))
                ->get()->result_array();

            $beng_questions = $this->db->select('
                beng_question_id_pk,
                question,
                option1,
                option2,
                option3,
                option4,
                question_pic,
                option1_pic,
                option2_pic,
                option3_pic,
                option4_pic
            ')
                ->from('council_question_bank_bengali_lang')
                ->where(array(
                    'question_id_fk' => $question['question_id_pk'],
                    'active_status'  => 1,
                ))
                ->get()->result_array();

            $question_bank[$question_key]['eng_questions'] = $eng_questions;
            $question_bank[$question_key]['beng_questions'] = $beng_questions;
        }

        $nos_details['question_list'] = $question_bank;

        return $nos_details;
    }

    public function getBasicBatchDetails($map_id_hash = NULL)
    {
        $nos_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.proposed_assessment_date,

            tc_details.user_tc_name,
            tc_details.user_tc_code,
            
            vertical.vertical_name,
            scheme_master.assessment_scheme_name,
        ")

            ->from("council_assessment_batch_assessor_map as cabam")
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = cabam.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where(
                array(
                    "MD5(CAST(cabam.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_id_hash,
                )
            )
            ->get()->result_array()[0];

        return $nos_details;
    }

    public function getBatchDetailsForTcMail($batch_id_hash = NULL)
    {
        $batch_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.user_batch_id,
            batch.sector_code,
            batch.sector_name,
            batch.course_code,
            batch.course_name,
            batch.proposed_assessment_date,

            tc_details.tc_email,
        ")

            ->from("council_assessment_batch_details AS batch")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")

            ->where("MD5(CAST(batch.assessment_batch_id_pk as character varying)) =", $batch_id_hash)
            ->get();

        $batch_details = $batch_details->result_array();

        if (!empty($batch_details)) {
            return $batch_details[0];
        } else {
            return array();
        }
    }

    public function getBatchDetailsForTraineeMarksPdf($id_hash = NULL)
    {
        $batch_details = $this->db->select("
            batch.assessment_batch_id_pk,
            batch.vertical_code,
            batch.assessment_scheme_id_fk,
            batch.user_batch_id,
            batch.course_code,
            batch.course_name,
            batch.sector_code,
            batch.sector_name,
            batch.proposed_assessment_date,
            vertical.vertical_name,
            scheme_master.assessment_scheme_name,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            assessor.fname,
            assessor.lname,
            assessor.assessor_code,
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join('council_assessment_batch_assessor_map AS cabam', 'cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk', 'left')
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = cabam.assessor_id_fk", "LEFT")
            ->where(
                array(
                    "cabam.active_status" => 1,
                    "MD5(CAST(batch.assessment_batch_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get()->result_array();

        return $batch_details[0];
    }

    public function getTraineeByIdHash($trainee_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(assessment_trainee_id_pk as character varying)) =", $trainee_id_hash);

        return $this->db->get('council_assessment_trainee_details')->result_array();
    }

    public function insertTraineeAttendance($trainee_attendance_data = NULL)
    {

        $this->db->insert('council_assessment_trainee_attendance', $trainee_attendance_data);

        return $this->db->insert_id();
    }

    public function updateTraineeProfilePic($id_hash = NULL, $update_array = NULL)
    {
        $this->db->where('MD5(CAST("assessment_trainee_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_assessment_trainee_details', $update_array);

        return $this->db->affected_rows();
    }

    public function getAssessorMapId($id_hash = NULL)
    {
        $this->db->select('assessment_batch_assessor_map_id_pk');
        $this->db->from('council_assessment_batch_assessor_map');
        $this->db->where('MD5(CAST("assessment_batch_id_fk" as character varying)) =', $id_hash);
        $this->db->where('active_status', 1);

        return $this->db->get()->result_array();
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
                    "cabam.process_id_fk" => 13,
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        return array(
            "batch_details"  => $batch_details[0]
        );
    }

    public function getBatchListForPrintingExpenditure($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("
        cabam.assessment_batch_assessor_map_id_pk,
        batch.assessment_batch_id_pk,
        batch.user_batch_id,
        batch.batch_size,
        batch.sector_name,
        batch.sector_code,
        batch.course_name,
        batch.course_code,
        batch.process_id_fk,
        cabam.purpose_assessment_date AS purpose_date,

        caped.printing_expenditure_id_pk,
        caped.marks_foil,
        caped.attendance_sheet,
        caped.question_paper,
        caped.total_no_of_pages,
        caped.amount_claimed,
        caped.bill_doc,
    ")

            ->from("council_assessment_batch_details as batch")
            ->join("council_assessment_batch_assessor_map AS cabam", "cabam.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->join("council_assessment_printing_expenditure_details AS caped", "caped.assessment_batch_id_fk = batch.assessment_batch_id_pk", "LEFT")
            ->where(
                array(
                    'cabam.assessor_id_fk' => $this->session->userdata('stake_details_id_fk'),
                    'cabam.process_id_fk !='  => 10,
                    'batch.process_id_fk >'  => 11,
                    'cabam.active_status !='  => 0
                )
            )
            ->order_by("batch.entry_time", "DESC")
            ->limit($limit, $offset)
            ->get();

        return $query->result_array();
    }

    public function getBatchDetailsForPrintingExpenditure($map_batch_id = NULL)
    {
        $this->db->select('batch_map.assessment_batch_assessor_map_id_pk, batch_map.assessment_batch_id_fk, batch_map.assessor_id_fk');
        $this->db->from('council_assessment_batch_assessor_map AS batch_map');
        // $this->db->join('council_assessment_batch_details AS batch', 'batch.assessment_batch_id_pk = batch_map.assessment_batch_id_fk', 'left');
        $this->db->where(
            array(
                "MD5(CAST(batch_map.assessment_batch_assessor_map_id_pk as character varying)) =" => $map_batch_id
            )
        );
        return $this->db->get()->result_array();
    }

    public function insertPrintingExpenditure($insertArray = NULL)
    {
        $this->db->insert('council_assessment_printing_expenditure_details', $insertArray);

        return $this->db->insert_id();
    }

    public function getPrintingExpenditureDetails($id_hash = NULL)
    {
        $this->db->where(
            array(
                "MD5(CAST(printing_expenditure_id_pk as character varying)) =" => $id_hash
            )
        );
        return $this->db->get('council_assessment_printing_expenditure_details')->result_array();
    }

    public function updatePrintingExpenditure($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where(
            array(
                "MD5(CAST(printing_expenditure_id_pk as character varying)) =" => $id_hash
            )
        );

        $this->db->update('council_assessment_printing_expenditure_details', $updateArray);

        return $this->db->affected_rows();
    }
}
