<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cssvse_batch_model extends CI_Model
{
    public function getBatchList($school_reg_id_fk = NULL)
    {
        $this->db->select('
            batch.*, 
            scheme.assessment_scheme_name, 
            sector.sector_code,
            sector.sector_name,
            course.course_name,
            course.course_code,
            process.process_name,
        ');
        $this->db->from('council_cssvse_batch_details AS batch');

        $this->db->join('council_assessment_scheme_master AS scheme', 'scheme.assessment_scheme_id_pk = batch.assessment_scheme_id_fk', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = batch.course_id_fk', 'left');
        $this->db->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT");

        $this->db->where('school_reg_id_fk', $school_reg_id_fk);

        return $this->db->get()->result_array();
    }

    public function getAllJobRoleInSchool($school_reg_id = NULL)
    {
        $this->db->select("student.course_id_fk, COUNT(student.student_id_pk) ");
        $this->db->from("council_cssvse_school_registration AS school_reg");
        $this->db->join('council_cssvse_student_master AS student', 'student.udise_code = school_reg.udise_code', 'left');
        $this->db->where('school_reg.school_reg_id_pk', $school_reg_id);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.batch_assigned_status', 0);
        $this->db->group_by('student.course_id_fk');
        $jobroleList = $this->db->get()->result_array();

        foreach ($jobroleList as $key => $value) {

            $this->db->select("
                sector.sector_id_pk,
                sector.sector_code,
                sector.sector_name,
                course.course_id_pk,
                course.course_name,
                course.course_code,
            ");
            $this->db->from("council_cssvse_school_registration AS school_reg");

            $this->db->join('council_cssvse_student_master AS student', 'student.udise_code = school_reg.udise_code', 'left');
            $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
            $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');

            $this->db->where('school_reg.school_reg_id_pk', $school_reg_id);
            $this->db->where('student.course_id_fk', $value['course_id_fk']);
            $this->db->limit(1);

            $jobroleList[$key]['jobroleDetails'] = $this->db->get()->result_array()[0];
        }

        return $jobroleList;
    }

    public function getCreateBatchDetails($school_reg_id = NULL, $sid = NULL, $cid = NULL)
    {
        $this->db->select('
            student.*,
            sector.sector_code,
            sector.sector_name,
            course.course_name,
            course.course_code,
        ');

        $this->db->from("council_cssvse_school_registration AS school_reg");

        $this->db->join('council_cssvse_student_master AS student', 'student.udise_code = school_reg.udise_code', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');

        $this->db->where('school_reg.school_reg_id_pk', $school_reg_id);
        $this->db->where("MD5(CAST(student.sector_id_fk as character varying)) =", $sid);
        $this->db->where("MD5(CAST(student.course_id_fk as character varying)) =", $cid);
        $this->db->limit(1);

        return $this->db->get()->result_array()[0];
    }

    public function getStudentListForCreateBatch($school_reg_id = NULL, $sid = NULL, $cid = NULL)
    {
        $this->db->select('
            student.student_id_pk,
            student.udise_code,
            student.school_id_fk,
            student.class_id_fk,
            student.salutation_id_fk,
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mothers_name,
            student.guardian_name,
            student.gender_id_fk,
            student.image,
            student.batch_start_date,
            student.batch_end_date,
            student.batch_tentative_date,
            class.class_name,
        ');

        $this->db->from("council_cssvse_school_registration AS school_reg");

        $this->db->join('council_cssvse_student_master AS student', 'student.udise_code = school_reg.udise_code', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');
        $this->db->join('council_cssvse_class_master AS class', 'class.class_id_pk = student.class_id_fk', 'left');

        $this->db->where('school_reg.school_reg_id_pk', $school_reg_id);
        $this->db->where("MD5(CAST(student.sector_id_fk as character varying)) =", $sid);
        $this->db->where("MD5(CAST(student.course_id_fk as character varying)) =", $cid);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.batch_assigned_status', 0);

        $this->db->order_by('student.first_name');

        return $this->db->get()->result_array();
    }

    public function checkBatchCode($user_batch_id = NULL)
    {
        $query = $this->db->where('user_batch_id', $user_batch_id)->get('council_cssvse_batch_details')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return FALSE;
        }
    }

    public function updateBatchDetails($batch_id_pk = NULL, $update_array = NULL)
    {
        $this->db->where('batch_id_pk', $batch_id_pk);
        $this->db->update('council_cssvse_batch_details', $update_array);

        return $this->db->affected_rows();
    }

    public function updateStudentMaster($student_ids = NULL, $update_array = NULL)
    {
        $this->db->where_in('student_id_pk', $student_ids);
        $this->db->update('council_cssvse_student_master', $update_array);

        return $this->db->affected_rows();
    }

    public function insertBatch($batch_array = NULL)
    {
        $this->db->insert('council_cssvse_batch_details', $batch_array);
        return $this->db->insert_id();
    }

    public function insertBatchStudentMap($student_array = NULL)
    {
        $this->db->insert('council_cssvse_batch_student_map', $student_array);
        return $this->db->insert_id();
    }

    public function getPushBatchDetails($id_hash = NULL)
    {

        $this->db->select('
            batch.batch_id_pk,
            batch.user_batch_id,
            batch.batch_start_date,
            batch.batch_end_date,
            batch.batch_tentative_date,
            batch.batch_size,
            batch.active_status,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            sector.sector_code,
            sector.sector_name,
            course.course_code,
            course.course_name,
            batch.course_description,
            batch.course_duration,
            batch.course_rate,
            school.udise_code,
            school.school_name,
            school.school_mobile,
            school.school_email,
            school.pin_code,
            school.school_address,
            school.hoi_name,
            school.hoi_mobile,
            school.hoi_email,
            state.state_name,
            state.state_id_pk,
            district.district_name,
            district.lgd_code AS district_lgd_code,
            municipality.block_municipality_name,
        ');
        $this->db->from('council_cssvse_batch_details AS batch');

        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = batch.course_id_fk', 'left');
        $this->db->join('council_cssvse_school_registration AS school', 'school.school_master_id_fk = batch.school_id_fk', 'left');
        $this->db->join('council_state_master AS state', 'state.state_id_pk = school.state_id_fk', 'left');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = school.district_id_fk', 'left');
        $this->db->join('council_block_municipality_master AS municipality', 'municipality.block_municipality_id_pk = school.municipality_id_fk', 'left');

        $this->db->where("MD5(CAST(batch.batch_id_pk as character varying)) =", $id_hash);
        $batchDetails = $this->db->get()->result_array()[0];


        $this->db->select('
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.guardian_name,
            student.guardian_relationship,
            gender.gender_description,
            student.date_of_birth,
            student.caste,
            student.religion,
            student.mobile,
            student.email,
            student.image,
            student.pin,
            student.address,
            state.state_id_pk,
            state.state_name,
            district.district_name,
            district.lgd_code,
            municipality.block_municipality_name,
            municipality.lgd_code AS municipality_lgd_code,
        ');

        $this->db->from('council_cssvse_batch_student_map AS cbsm');
        $this->db->join('council_cssvse_student_master AS student', 'student.student_id_pk = cbsm.student_id_fk', 'left');
        $this->db->join('council_gender_master AS gender', 'gender.gender_id_pk = student.gender_id_fk', 'left');
        $this->db->join('council_state_master AS state', 'state.state_id_pk = student.state_id_fk', 'left');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = student.district_id_fk', 'left');
        $this->db->join('council_block_municipality_master AS municipality', 'municipality.block_municipality_id_pk = student.municipality_id_fk', 'left');

        $this->db->where("MD5(CAST(cbsm.batch_id_fk as character varying)) =", $id_hash);
        $studentList = $this->db->get()->result_array();

        return array(
            'batchDetails' => $batchDetails,
            'studentList' => $studentList
        );
    }

    public function insertAssessmentJsonData($data)
    {
        if ($this->db->insert('council_cssvse_assessment_json_data', $data)) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    public function updateAssessmentJsonData($id, $array)
    {
        $this->db->where('council_json_data_id_pk', $id)->update('council_cssvse_assessment_json_data', $array);
        return $this->db->affected_rows();
    }

    public function getBatchDetails($batch_id_hash)
    {
        $this->db->select('batch.*,
            scheme.assessment_scheme_name,
            sector.sector_code,
            sector.sector_name,
            course.course_name,
            course.course_code,
            process.process_name,
            ccaaa.assessor_name,
            ccaaa.assessor_email,
            ccaaa.assessor_mobile_no,
            ccaaa.proposed_assessment_date,
            ccaaa.assessor_assigned_date,
            ccaaa.assessor_action_date
        ');
        $this->db->from('council_cssvse_batch_details AS batch');
        $this->db->join('council_assessment_scheme_master AS scheme', 'scheme.assessment_scheme_id_pk = batch.assessment_scheme_id_fk', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = batch.course_id_fk', 'left');
        $this->db->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT");
        $this->db->join("council_cssvse_assessment_assigned_assessor AS ccaaa", "ccaaa.user_batch_code = batch.user_batch_id AND ccaaa.active_status = 1", "LEFT");
        $this->db->where('MD5(CAST("batch_id_pk" as character varying)) =', $batch_id_hash);

        return $this->db->get()->result_array();
    }

    public function getStudentList($batch_id_hash)
    {
        $this->db->select('
            student.student_id_pk,
            student.udise_code,
            student.school_id_fk,
            student.class_id_fk,
            student.salutation_id_fk,
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mothers_name,
            student.guardian_name,
            student.gender_id_fk,
            student.mobile,
            student.image,
            student.batch_start_date,
            student.batch_end_date,
            student.batch_tentative_date,
            student.date_of_birth,
			student.mobile,
            class.class_name,
            district.district_name,
            state.state_name,
        ');

        $this->db->from("council_cssvse_student_master AS student");

        $this->db->join('council_cssvse_batch_student_map AS batch_std_map', 'batch_std_map.student_id_fk = student.student_id_pk', 'left');
        //$this->db->join('council_cssvse_batch_details AS batch', 'batch.school_reg_id_fk = student.school_reg_id_fk', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');
        $this->db->join('council_cssvse_class_master AS class', 'class.class_id_pk = student.class_id_fk', 'left');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = student.district_id_fk', 'left');
        $this->db->join('council_state_master AS state', 'state.state_id_pk = student.state_id_fk', 'left');
        $this->db->where('MD5(CAST("batch_std_map"."batch_id_fk" as character varying)) =', $batch_id_hash);
        $this->db->where('student.active_status', 1);

        $this->db->order_by('student.first_name');

        return $this->db->get()->result_array();
    }

    public function getStudentInternalMarks($batch_id_hash = NULL)
    {
        $this->db->where('MD5(CAST("batch_id_fk" as character varying)) =', $batch_id_hash);

        return $this->db->get('council_cssvse_student_internal_marks')->result_array();
    }

    public function getInternalMarksByStudent_id($student_id_pk = NULL)
    {
        $this->db->where('student_id_fk', $student_id_pk);

        return $this->db->get('council_cssvse_student_internal_marks')->result_array();
    }

    public function removeAllBatchMarks($batch_id_fk = NULL)
    {
        $this->db->where('batch_id_fk', $batch_id_fk);
        $this->db->delete('council_cssvse_student_internal_marks');
    }

    public function insertStudentInternalMarksBatch($insertInternalMarksArray = NULL)
    {
        return $this->db->insert_batch('council_cssvse_student_internal_marks', $insertInternalMarksArray);
    }
}
