<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessing_cssvsebatch_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getCssvseBatchCount()
    {
        $query = $this->db->select("count(assessment_batch_id_pk)")
            ->from("council_assessment_batch_details")
            ->where(
                array(
                    'active_status' => 1,
                    'assessment_scheme_id_fk' => 3
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getAllCssvseBatch($limit = NULL, $offset = NULL)
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
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    'batch.active_status' => 1,
                    'batch.assessment_scheme_id_fk' => 3
                )
            )
            ->order_by("batch.entry_time", "DESC")
            ->limit($limit, $offset)
            ->get();

        return $query->result_array();
    }

    public function getCssvseTraineeBatchDetails($id_hash = NULL)
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
            batch.course_duration,
            batch.course_rate,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_assessment_date,
            batch.entry_time,
            batch.proposed_assessment_date,
            batch.process_id_fk,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            batch.flag_finalize_assessment,
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
            tp_details.tp_block_municipality_name
        ")

            ->from("council_assessment_batch_details as batch")
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    "MD5(CAST(batch.assessment_batch_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $assessor_details = $this->db->select("
            assessor.assessor_registration_details_pk AS assessor_id_pk,
            assessor.fname,
            assessor.lname,
            assessor.pan,
            assessor.assessor_code,
            assessor.mobile_no,
            assessor.email_id,
            state.state_name,
            district.district_name,
            assessor.pin, 

            cabam.entry_time, 
            cabam.purpose_assessment_date, 
            cabam.assessor_assign_notes, 
            cabam.assessor_confirm_date, 
            cabam.assessor_confirm_notes, 
        ")
            ->from("council_assessment_batch_assessor_map AS cabam")
            ->join("council_assessor_registration_details AS assessor", "assessor.assessor_registration_details_pk = cabam.assessor_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.district_id_pk = assessor.district_id_fk", "LEFT")
            ->join("council_state_master AS state", "state.state_id_pk = assessor.state_id_fk", "LEFT")

            ->where(array(
                "cabam.active_status" => 1,
                "MD5(CAST(cabam.assessment_batch_id_fk as character varying)) =" => $id_hash
            ))

            ->get();

        $assessor_details = $assessor_details->result_array();

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
            ->join('council_assessment_trainee_attendance AS attendance', 'attendance.trainee_id_fk = trainee.assessment_trainee_id_pk', 'left')

            ->where(array(
                "MD5(CAST(trainee.assessment_batch_id_fk as character varying)) =" => $id_hash
            ))
            ->order_by('trainee.trainee_full_name')

            ->get();

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"     => $batch_details[0],
            "assessor_details"  => (!empty($assessor_details)) ? $assessor_details[0] : array(),
            "tranee_details"    => $tranee_details
        );
    }

    public function getCssvseSchoolBatch($user_batch_id = NULL)
    {
        $query = $this->db->where('user_batch_id', $user_batch_id)->get('council_cssvse_batch_details')->result_array();

        return $query[0];
    }

    public function getBasicBatchDetails($batch_id_hash = NULL)
    {
        $this->db->select('batch.assessment_batch_id_pk, batch.user_batch_id, batch.sector_code, batch.sector_name, batch.course_code, batch.course_name, sector.sector_id_pk, course.course_id_pk');
        $this->db->from('council_assessment_batch_details AS batch');
        $this->db->join('council_sector_master AS sector', 'sector.sector_code = batch.sector_code', 'left');
        $this->db->join('council_course_master AS course', 'course.course_code = batch.course_code', 'left');

        $this->db->where("MD5(CAST(batch.assessment_batch_id_pk as character varying)) =", $batch_id_hash);
        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return FALSE;
        }
    }

    public function getCssvseSchoolDetails($udise_code = NULL)
    {
        $this->db->select('school_master.school_id_pk, school_reg.*');
        $this->db->from('council_cssvse_school_registration AS school_reg');

        $this->db->join('council_cssvse_school_master AS school_master', 'school_master.udise_code = school_reg.udise_code', 'left');

        $this->db->where('school_reg.udise_code', $udise_code);
        $this->db->where('active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return FALSE;
        }
    }

    public function getSalutation()
    {
        return $this->db->get("council_salutation_master")->result_array();
    }

    public function getGender()
    {
        return $this->db->get("council_gender_master")->result_array();
    }

    public function getDistrictList()
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', 19)->order_by('district_name')->get('council_district_master')->result_array();
    }

    public function getClassList()
    {
        return $this->db->get('council_cssvse_class_master')->result_array();
    }

    public function getMunicipalityByDistrict($district = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district)->order_by('block_municipality_name')->get('council_block_municipality_master')->result_array();
    }

    public function insertStudentInCssvseStudentMaster($insertArray = NULL)
    {
        $this->db->insert('council_cssvse_student_master', $insertArray);

        return $this->db->insert_id();
    }

    public function insertBatchStudentMap($student_array = NULL)
    {
        $this->db->insert('council_cssvse_batch_student_map', $student_array);
        return $this->db->insert_id();
    }

    public function insertStudentInternalMarks($internal_marks_array = NULL)
    {
        $this->db->insert('council_cssvse_student_internal_marks', $internal_marks_array);
        return $this->db->insert_id();
    }

    public function insertAssessmentCandidate($insert_array = NULL)
    {
        $this->db->insert('council_assessment_trainee_details', $insert_array);
        return $this->db->insert_id();
    }

    public function getMunicipalityDetails($municipality = NULL)
    {
        $this->db->select('state.state_id_pk, state.state_name, district.lgd_code AS district_lgd_code, district.district_name, municipality.lgd_code AS municipality_lgd_code, municipality.block_municipality_name');
        $this->db->from('council_block_municipality_master AS municipality');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = municipality.district_id_fk', 'left');
        $this->db->join('council_state_master AS state', 'state.state_id_pk = district.state_id_fk', 'left');
        $this->db->where('municipality.block_municipality_id_pk', $municipality);
        return $this->db->get()->result_array();
    }

    public function updateAssessmentCandidateData($trainee_id = NULL, $update_array = NULL)
    {
        $this->db->where('assessment_trainee_id_pk', $trainee_id);
        $this->db->update('council_assessment_trainee_details', $update_array);

        return $this->db->affected_rows();
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
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->where(
                array(
                    'batch.active_status' => 1,
                )
            );

        if ($searchArray['batch_code'] != '') {

            $query = $query->where('batch.user_batch_id', $searchArray['batch_code']);
        }
        $query = $query->where('batch.active_status', 1)
            ->order_by("batch.entry_time", "DESC")
            ->get();

        return $query->result_array();
    }
}
