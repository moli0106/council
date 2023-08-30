<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessor_result_model extends CI_Model
{
    public function getAssessorCount()
    {
        $query = $this->db->select('count(assessor_id_fk)')
            ->where('active_status', 1)
            ->where('eligibility', 1)
            ->group_by('assessor_id_fk')
            ->having('count(assessor_id_fk) >', 1)
            ->get('council_batch_assessor_map')->result_array();

        return count($query);
    }

    public function getAssessorList($limit = NULL, $offset = NULL)
    {
        $assessorList = array();

        $query = $this->db->select('count(assessor_id_fk), assessor_id_fk')
            ->where('active_status', 1)
            ->where('eligibility', 1)
            ->group_by('assessor_id_fk')
            ->having('count(assessor_id_fk) >', 1)
            ->get('council_batch_assessor_map')->result_array();

        foreach ($query as $key => $assessor) {

            $assessorList[$key] = $this->db->select('assessor_registration_details_pk AS assessor_id_pk, fname, mname,lname, mobile_no, email_id')
                ->where('assessor_registration_details_pk', $assessor['assessor_id_fk'])
                ->get('council_assessor_registration_details')->result_array()[0];

            $this->db->select('
                batch.batch_ems_id_pk,
                batch_map.batch_assessor_map_id_pk,
                batch_map.exam_status,
                batch_map.active_status,
                batch.batch_type,
                result.marks,
				batch.batch_exam_date,
                result.con_eval_marks,
                sector.sector_code,
                sector.sector_name,
                course.course_code,
                course.course_name,
                empanelled.empanelled_id_pk
            ')
                ->from('council_batch_assessor_map AS batch_map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = batch_map.batch_ems_id_fk', 'LEFT')
                ->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id', 'LEFT')
                ->join('council_course_master AS course', 'course.course_id_pk = batch.course_id', 'LEFT')
                ->join("council_assessor_exam_result_details AS result", "result.batch_id_fk = batch_map.batch_ems_id_fk AND result.assessor_id_fk = batch_map.assessor_id_fk", "LEFT")
                ->join("council_assessor_empanelled_map AS empanelled", "empanelled.batch_id_fk = batch.batch_ems_id_pk AND empanelled.assessor_id_fk = batch_map.assessor_id_fk AND empanelled.sector_id_fk = batch.sector_id AND empanelled.course_id_fk = batch.course_id", "LEFT")
                ->where(
                    array(
                        'batch.batch_type' => 1,
                        'batch_map.assessor_id_fk' => $assessor['assessor_id_fk']
                    )
                );

            $domain = $this->db->get()->result_array();

            if (!empty($domain)) {

                $assessorList[$key]['exam_details']['domain'] = $domain;
            } else {

                $assessorList[$key]['exam_details']['domain'] = array();
            }

            $this->db->select('
                batch.batch_ems_id_pk,
                batch_map.batch_assessor_map_id_pk,
                batch_map.exam_status,
                batch_map.active_status,
                batch.batch_type,
				batch.batch_exam_date,
                result.marks,
                result.con_eval_marks,
            ')
                ->from('council_batch_assessor_map AS batch_map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = batch_map.batch_ems_id_fk', 'LEFT')
                ->join("council_assessor_exam_result_details AS result", "result.batch_id_fk = batch_map.batch_ems_id_fk AND result.assessor_id_fk = batch_map.assessor_id_fk", "LEFT")
                ->where(
                    array(
                        'batch.batch_type' => 2,
                        'batch_map.assessor_id_fk' => $assessor['assessor_id_fk']
                    )
                );

            $platform = $this->db->get()->result_array();

            if (!empty($platform)) {

                $assessorList[$key]['exam_details']['platform'] = $platform[0];
            } else {

                $assessorList[$key]['exam_details']['platform'] = array();
            }
        }

        return $assessorList;
    }

    public function getAssessorListOLD($limit = NULL, $offset = NULL)
    {
        $assessorList = array();

        $query = $this->db->select('count(assessor_id_fk), assessor_id_fk')
            ->where('active_status', 1)
            ->where('eligibility', 1)
            ->group_by('assessor_id_fk')
            ->having('count(assessor_id_fk) >', 1)
            ->get('council_batch_assessor_map')->result_array();

        foreach ($query as $key => $assessor) {

            $assessorList[$key] = $this->db->select('assessor_registration_details_pk AS assessor_id_pk, fname, lname, mobile_no, email_id')
                ->where('assessor_registration_details_pk', $assessor['assessor_id_fk'])
                ->get('council_assessor_registration_details')->result_array()[0];

            $this->db->select('
                batch.batch_ems_id_pk,
                batch_map.batch_assessor_map_id_pk,
                batch_map.exam_status,
                batch_map.active_status,
                batch.batch_type,
                result.marks,
                result.con_eval_marks,
            ')
                ->from('council_batch_assessor_map AS batch_map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = batch_map.batch_ems_id_fk', 'LEFT')
                ->join("council_assessor_exam_result_details AS result", "result.batch_id_fk = batch_map.batch_ems_id_fk AND result.assessor_id_fk = batch_map.assessor_id_fk", "LEFT")
                ->where(
                    array(
                        'batch_map.assessor_id_fk' => $assessor['assessor_id_fk']
                    )
                );

            $assessorList[$key]['exam_details'] = $this->db->get()->result_array();
        }

        return $assessorList;
    }

    //    public function getAssessorBatchMapDetails($map_id = NULL)
    //     {
    //         $query = $this->db->select('
    //             batch_map.assessor_id_fk,
    //             batch.batch_ems_id_pk,
    //             batch.sector_id,
    //             sector.sector_name,
    //             sector.sector_code,
    //             batch.course_id,
    //             course.course_name,
    //             course.course_code,
    //             batch.batch_exam_date,
    //         ')
    //             ->from('council_batch_assessor_map AS batch_map')
    //             ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = batch_map.batch_ems_id_fk', 'LEFT')
    //             ->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id', 'LEFT')
    //             ->join('council_course_master AS course', 'course.course_id_pk = batch.course_id', 'LEFT')
    //             ->where(
    //                 array(
    //                     "MD5(CAST(batch_map.batch_assessor_map_id_pk as character varying)) =" => $map_id
    //                 )
    //             )
    //             ->get()->result_array();

    //         if (!empty($query)) {
    //             return $query[0];
    //         } else {
    //             return array();
    //         }
    //     }
    public function getAssessorBatchMapDetails($map_id = NULL)
    {
        $query = $this->db->select('
        batch_map.assessor_id_fk,
        assessor.fname,
        assessor.mname,
        assessor.lname,
        batch.batch_ems_id_pk,
        batch.sector_id,
        sector.sector_name,
        sector.sector_code,
        batch.course_id,
        batch.batch_exam_date,
        course.course_name,
        course.course_code,
		assessor.email_id
    ')
            ->from('council_batch_assessor_map AS batch_map')
            ->join('council_assessor_registration_details AS assessor', 'assessor.assessor_registration_details_pk = batch_map.assessor_id_fk', 'LEFT')
            ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = batch_map.batch_ems_id_fk', 'LEFT')
            ->join('council_sector_master AS sector', 'sector.sector_id_pk = batch.sector_id', 'LEFT')
            ->join('council_course_master AS course', 'course.course_id_pk = batch.course_id', 'LEFT')
            ->where(
                array(
                    "MD5(CAST(batch_map.batch_assessor_map_id_pk as character varying)) =" => $map_id
                )
            )
            ->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getOldEmpanelledAssessorList()
    {
        $emArray = array('CCCPB4971M', 'BAOPK4161M', 'AIWPB7042H', 'ECTPS1281Q', 'BBBPD1455K', 'ALQPD1239F', 'ALQPG8079E', 'BNAPA5004Q', 'AGIPD4722E', 'CBHPK8141C', 'BZDPM7040K');

        return $this->db->select('
        empanelled.empanelled_id_pk,
        empanelled.assessor_id_fk,
        assessor.fname,
        assessor.mname,
        assessor.lname,
        assessor.pan,
        course.course_name,
        course.course_code,assessor.email_id
    ')
            ->from('council_assessor_empanelled_map AS empanelled')
            ->join('council_assessor_registration_details AS assessor', 'assessor.assessor_registration_details_pk = empanelled.assessor_id_fk', 'LEFT')
            ->join('council_course_master AS course', 'course.course_id_pk = empanelled.course_id_fk', 'LEFT')
            ->where('empanelled.batch_id_fk', 0)
            ->where_not_in('assessor.pan', $emArray)
            ->get()->result_array();
    }

    public function upddateEmailStatus($id)
    {
        $this->db->where("empanelled_id_pk", $id);
        $this->db->update("council_assessor_empanelled_map", array('send_email_status' => 1, 'send_email_date' => "now()"));
        return true;
    }
    public function assign_assessor_empanelled($insertArray)
    {
        $this->db->insert('council_assessor_empanelled_map', $insertArray);

        return $this->db->insert_id();
    }

    public function getCourseGrouping($course_id = NULL)
    {
        $this->db->select('course_grouping.*, course_master.sector_id_fk, course_master.course_name, course_master.course_code');

        $this->db->from('council_course_grouping AS course_grouping');

        $this->db->join('council_course_master AS course_master', 'course_master.course_id_pk = course_grouping.course_grouping_id_fk', 'left');

        $this->db->where('course_grouping.course_id_fk', $course_id);
        $this->db->where('course_grouping.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function checkEmpanelledAssessor($assessor_id_fk = NULL, $course_id_fk = NULL)
    {
        $this->db->where('assessor_id_fk', $assessor_id_fk);
        $this->db->where('course_id_fk', $course_id_fk);
        $this->db->where('active_status', 1);

        return $this->db->get('council_assessor_empanelled_map')->result_array();
    }
}
/* End of file Assessor_batch_result_model.php */
