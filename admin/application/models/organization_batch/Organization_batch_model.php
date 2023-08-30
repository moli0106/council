<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organization_batch_model extends CI_Model
{
    public function getBatchList($id = NULL,$type)
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
        $this->db->from('council_organization_batch_details AS batch');

        $this->db->join('council_assessment_scheme_master AS scheme', 'scheme.assessment_scheme_id_pk = batch.assessment_scheme_id_fk', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = batch.course_id_fk', 'left');
        $this->db->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT");
        if($type == 'tc'){

            $this->db->where('tc_id_fk', $id);
        }else{
            $this->db->where('organization_id_fk', $id);

        }

        return $this->db->get()->result_array();
    }

    public function getAllJobRoleInSchool($tc_id_fk = NULL)
    {
        $this->db->select("student.course_id_fk, COUNT(student.student_details_id_pk) ");
        $this->db->from('council_organization_student_details AS student');
        $this->db->where('student.tc_id_fk', $tc_id_fk);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.batch_assigned_status', 0);
        $this->db->group_by('student.course_id_fk');
        $jobroleList = $this->db->get()->result_array();
       //echo "<pre>";print_r($jobroleList);
        foreach ($jobroleList as $key => $value) {

            $this->db->select("
                sector.sector_id_pk,
                sector.sector_code,
                sector.sector_name,
                course.course_id_pk,
                course.course_name,
                course.course_code,
            ");
            $this->db->from("council_organization_tc_details AS school_reg");

            $this->db->join('council_organization_student_details AS student', 'student.tc_id_fk = school_reg.tc_id_pk', 'left');
            $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
            $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');

            $this->db->where('school_reg.tc_id_pk', $tc_id_fk);
            $this->db->where('student.course_id_fk', $value['course_id_fk']);
            $this->db->limit(1);

            $jobroleList[$key]['jobroleDetails'] = $this->db->get()->result_array()[0];
        }

        return $jobroleList;
    }

    public function getCreateBatchDetails($tc_id = NULL, $sid = NULL, $cid = NULL)
    {
        $this->db->select('
            student.*,
            sector.sector_code,
            sector.sector_name,
            course.course_name,
            course.course_code,
            course.course_description
        ');

        

        $this->db->from('council_organization_student_details AS student');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');

        $this->db->where('student.tc_id_fk', $tc_id);
		$this->db->where('student.active_status', 1);       
        $this->db->where("MD5(CAST(student.sector_id_fk as character varying)) =", $sid);
        $this->db->where("MD5(CAST(student.course_id_fk as character varying)) =", $cid);
        $this->db->limit(1);

        return $this->db->get()->result_array()[0];
    }

    public function getStudentListForCreateBatch($tc_id = NULL, $sid = NULL, $cid = NULL)
    {
        //echo "hii";exit;
        $this->db->select('
            student.student_details_id_pk,
            student.tc_id_fk,
            student.salutation_id_fk,
            student.organization_id_fk,
            
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mother_name,
            student.guardian_name,
            student.gender_id_fk,
            student.image,
            student.batch_start_date,
            student.batch_end_date,
            student.batch_tentative_date
            
        ');

        //$this->db->from("council_affiliation_vtc_details AS school_reg");

        $this->db->from('council_organization_student_details AS student');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');
        

        $this->db->where('student.tc_id_fk', $tc_id);
        $this->db->where("MD5(CAST(student.sector_id_fk as character varying)) =", $sid);
        $this->db->where("MD5(CAST(student.course_id_fk as character varying)) =", $cid);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.batch_assigned_status', 0);

        $this->db->order_by('student.first_name');

        return $this->db->get()->result_array();
    }

    public function checkBatchCode($user_batch_id = NULL)
    {
        $query = $this->db->where('user_batch_id', $user_batch_id)->get('council_vtc_batch_details')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return FALSE;
        }
    }

    public function updateBatchDetails($batch_id_pk = NULL, $update_array = NULL)
    {
        $this->db->where('batch_id_pk', $batch_id_pk);
        $this->db->update('council_organization_batch_details', $update_array);
       // echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

    public function updateStudentMaster($student_ids = NULL, $update_array = NULL)
    {
        $this->db->where_in('student_details_id_pk', $student_ids);
        $this->db->update('council_organization_student_details', $update_array);

        return $this->db->affected_rows();
    }

    public function insertBatch($batch_array = NULL)
    {
        $this->db->insert('council_organization_batch_details', $batch_array);
        //echo $this->db->last_query();exit;
        return $this->db->insert_id();
    }

    public function insertBatchStudentMap($student_array = NULL)
    {
        $this->db->insert('council_organization_batch_student_map', $student_array);
        return $this->db->insert_id();
    }

    public function getPushBatchDetails($id_hash = NULL)
    {
        // echo $id_hash;exit;
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
            batch.assessment_scheme_id_fk,
            sector.sector_code,
            sector.sector_name,
            course.course_code,
            course.course_name,
            batch.course_description,
            batch.course_duration,
            batch.course_rate,


            org_master.organization_code as udise_code,
            org_master.organization_name as school_name,
            school.mobile as school_mobile,
            school.email as school_email,
            school.pin_code,
            school.street_vill_town,
            school.post_office,
            school.police_station,
            school.spoc_name,
            school.spoc_mobile,
            school.spoc_email,
            school.latitude,
            school.longititude,
            state.state_name,
            state.state_id_pk,
            district.district_name,
            district.lgd_code AS district_lgd_code,
            municipality.block_municipality_name,
        ');
        $this->db->from('council_organization_batch_details AS batch');

        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = batch.course_id_fk', 'left');
        $this->db->join('council_organization_details AS org_master', 'org_master.organization_id_pk = batch.organization_id_fk', 'left');
        $this->db->join('council_organization_tc_details AS school', 'school.tc_id_pk = batch.tc_id_fk', 'left');
        $this->db->join('council_state_master AS state', 'state.state_id_pk = school.state_id_fk', 'left');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = school.district_id_fk', 'left');
        $this->db->join('council_block_municipality_master AS municipality', 'municipality.block_municipality_id_pk = school.municipality', 'left');

        $this->db->where("MD5(CAST(batch.batch_id_pk as character varying)) =", $id_hash);
        $batchDetails = $this->db->get()->result_array()[0];
        //echo "<pre>";print_r($batchDetails);exit;

        $this->db->select('
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.guardian_name,
            student.mother_name,
            student.guardian_relationship,
            gender.gender_id_pk,
            student.dob,
            student.mob_no,
            student.email_id,
            student.image,
            student.pin_code,
            student.street_vill_town,
            student.post_office,
            student.police_station,
            student.vertical_code,
            state.state_id_pk,
            student.father_name,
            state.state_name,
            district.district_name,
            district.lgd_code,
            municipality.block_municipality_name,
            municipality.lgd_code AS municipality_lgd_code,
        ');

        $this->db->from('council_organization_batch_student_map AS cbsm');
        $this->db->join('council_organization_student_details AS student', 'student.student_details_id_pk = cbsm.student_details_id_fk', 'left');
        $this->db->join('council_gender_master AS gender', 'gender.gender_id_pk = student.gender_id_fk', 'left');
        $this->db->join('council_state_master AS state', 'state.state_id_pk = student.state_id_fk', 'left');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = student.district_id_fk', 'left');
        $this->db->join('council_block_municipality_master AS municipality', 'municipality.block_municipality_id_pk = student.municipality', 'left');

        $this->db->where("MD5(CAST(cbsm.batch_id_fk as character varying)) =", $id_hash);
        $studentList = $this->db->get()->result_array();

        return array(
            'batchDetails' => $batchDetails,
            'studentList' => $studentList
        );
    }

    public function insertAssessmentJsonData($data)
    {
        //echo "<pre>";print_r($data);exit;
        if ($this->db->insert('council_organization_assessment_json_data', $data)) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    public function updateAssessmentJsonData($id, $array)
    {
        $this->db->where('council_json_data_id_pk', $id)->update('council_organization_assessment_json_data', $array);
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
        $this->db->from('council_organization_batch_details AS batch');
        $this->db->join('council_assessment_scheme_master AS scheme', 'scheme.assessment_scheme_id_pk = batch.assessment_scheme_id_fk', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = batch.course_id_fk', 'left');
        $this->db->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT");
        $this->db->join("council_vtc_assessment_assigned_assessor AS ccaaa", "ccaaa.user_batch_code = batch.user_batch_id AND ccaaa.active_status = 1", "LEFT");
        $this->db->where('MD5(CAST("batch_id_pk" as character varying)) =', $batch_id_hash);

        return $this->db->get()->result_array();
    }

    public function getStudentList($batch_id_hash)
    {
        $this->db->select('
            student.student_details_id_pk,
            student.tc_id_fk,
            student.organization_id_fk,
            student.salutation_id_fk,
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mother_name,
            student.guardian_name,
            student.gender_id_fk,
            student.mob_no,
            student.image,
            student.batch_start_date,
            student.batch_end_date,
            student.batch_tentative_date,
            student.dob,
           
            district.district_name,
            state.state_name,
        ');

        $this->db->from("council_organization_student_details AS student");

        $this->db->join('council_organization_batch_student_map AS batch_std_map', 'batch_std_map.student_details_id_fk = student.student_details_id_pk', 'left');
        //$this->db->join('council_vtc_batch_details AS batch', 'batch.school_reg_id_fk = student.school_reg_id_fk', 'left');
        $this->db->join('council_sector_master AS sector', 'sector.sector_id_pk = student.sector_id_fk', 'left');
        $this->db->join('council_course_master AS course', 'course.course_id_pk = student.course_id_fk', 'left');
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

    /*** ADDED BY ATREYEE ON 23-02-2023 *****/
       // for student certificate list
    public function getAssessmentBatchId($batch_code_hash = NULL)
    {
        $this->db->select('batch.assessment_batch_id_pk,batch.user_batch_id');
        $this->db->from('council_assessment_batch_details AS batch');
        $this->db->where('MD5(CAST("user_batch_id" as character varying)) =', $batch_code_hash);
        // echo $this->db->last_query();die;

        return $this->db->get()->result_array();
    }

          public function getTraineeList($id_hash = NULL)
    {
        return $this->db->where("MD5(CAST(assessment_batch_id_fk as character varying)) =", $id_hash)
            ->where("total_marks !=", NULL)->get('council_assessment_trainee_details')->result_array();
    }
// end of code for list

// for download certificate
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
            course.council_ncvet_course_status,
            course.course_code,
            course.course_name,
            batch.course_duration,
            batch.batch_marks_status_updated_date,
            batch.assessment_scheme_id_fk,
            batch.preferred_district_name,

            tc_details.council_tc_name,
            tc_details.tc_state_name,
            tc_details.tc_district_name,
            trainee.trainee_father_name,
            tc_details.user_tc_code,

            student.guardian_name
        ")
            ->from('council_assessment_trainee_details AS trainee')
            ->join("council_assessment_batch_details AS batch", "batch.assessment_batch_id_pk = trainee.assessment_batch_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->JOIN ("council_organization_student_details AS student" , "student.registration_number = trainee.user_trainee_registration_no")
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

    public function get_phase_by_id($tc_id){
        $this->db->select('count(batch_id_pk)');
        $this->db->from('council_organization_batch_details');
        $this->db->where('tc_id_fk',$tc_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }


}
