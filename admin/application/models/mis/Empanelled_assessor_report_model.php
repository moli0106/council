<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empanelled_assessor_report_model extends CI_Model
{
    public function getSectorList()
    {
        return $this->db->where('active_status', 1)->order_by('sector_name')->get('council_sector_master')->result_array();
    }
    public function getCourseListBySectorId($sector_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('sector_id_fk', $sector_id)->order_by('course_name')->get('council_course_master')->result_array();
    }

    public function getCountData()
    {
        $query = $this->db->select("count(assessor.assessor_registration_details_pk)")
            ->from("council_assessor_registration_application_nubmer as appno")
            ->join("council_assessor_registration_details as assessor", "appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
            ->join("council_assessor_registration_jobrole_sector_map as b", "b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no", "LEFT")
            ->join("council_course_master as course", "course.course_id_pk = b.course_id_fk", "LEFT")
            ->join("council_sector_master as sector", "sector.sector_id_pk = course.sector_id_fk", "LEFT")
            ->join("council_assessor_empanelled_map AS empanelled", "empanelled.assessor_id_fk = assessor.assessor_registration_details_pk AND empanelled.sector_id_fk = sector.sector_id_pk AND empanelled.course_id_fk = course.course_id_pk", "LEFT")
            ->where(
                array(
                    "assessor.active_status" => 1,
                    "appno.process_status_id_fk" => 5,
                    "b.active_status" => 1,
                    "b.process_status_id_fk" => 5,
                    "empanelled.empanelled_id_pk" => NULL
                )
            )
            ->get();
        return $query->result_array();
    }

    public function getEmpanelledAssessorReport($limit = NULL, $offset = NULL, $searchArray = NULL)
    {
        $query = $this->db->select("
            assessor.assessor_registration_details_pk AS assessor_id_pk,
            upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) AS assessor_name,
            sector.sector_id_pk,
            sector.sector_name,
            course.course_id_pk,
            course.course_name,
            empanelled.empanelled_id_pk,
			assessor.pan
        ")
            ->from("council_assessor_registration_application_nubmer as appno")
            ->join("council_assessor_registration_details as assessor", "appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
            ->join("council_assessor_registration_jobrole_sector_map as b", "b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no", "LEFT")
            ->join("council_course_master as course", "course.course_id_pk = b.course_id_fk", "LEFT")
            ->join("council_sector_master as sector", "sector.sector_id_pk = course.sector_id_fk", "LEFT")
            ->join("council_assessor_empanelled_map AS empanelled", "empanelled.assessor_id_fk = assessor.assessor_registration_details_pk AND empanelled.sector_id_fk = sector.sector_id_pk AND empanelled.course_id_fk = course.course_id_pk", "LEFT")
            ->where(
                array(
                    "assessor.active_status"      => 1,
                    "appno.process_status_id_fk"  => 5,
                    "b.active_status"             => 1,
                    "b.process_status_id_fk"      => 5,
                )
            );

        if ($searchArray != NULL) {

            if (isset($searchArray['sector_id']) && !empty($searchArray['sector_id'])) {
                $query = $query->where('sector.sector_id_pk', $searchArray['sector_id']);
            }

            if (isset($searchArray['course_id']) && !empty($searchArray['course_id'])) {
                $query = $query->where('course.course_id_pk', $searchArray['course_id']);
            }
			
			if (isset($searchArray['pan']) && !empty($searchArray['pan'])) {
                $query = $query->where('assessor.pan', $searchArray['pan']);
            }

            if (isset($searchArray['empanelled']) && !empty($searchArray['empanelled'])) {
                if ($searchArray['empanelled'] == 1) {
                    $query = $query->where('empanelled.empanelled_id_pk !=', NULL);
                } elseif ($searchArray['empanelled'] == 2) {
                    $query = $query->where('empanelled.empanelled_id_pk', NULL);
                }
            }
        }

        $query = $query->limit($limit, $offset)
            ->order_by("assessor_name, sector.sector_name, course.course_name")
            ->get()->result_array();


        $assessorList = array();
        foreach ($query as $key => $value) {

            $domainQuery = $this->db->select('result.marks')
                ->from('council_batch_assessor_map AS map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = map.batch_ems_id_fk', 'LEFT')
                ->join('council_assessor_exam_result_details AS result', 'result.batch_id_fk = map.batch_ems_id_fk AND  result.assessor_id_fk = map.assessor_id_fk', 'LEFT')
                ->where(array(
                    'map.assessor_id_fk' => $value['assessor_id_pk'],
                    'batch.sector_id'    => $value['sector_id_pk'],
                    'batch.course_id'    => $value['course_id_pk'],
                    'map.active_status'  => 1,
                    'batch.batch_type'   => 1,
                ))->get()->result_array();

            if (!empty($domainQuery) && ($domainQuery[0]['marks'] >= 50))
                $query[$key]['domain_training'] = 1;

            else
                $query[$key]['domain_training'] = 0;

            $platformQuery = $this->db->select('
                result.marks,
                result.con_eval_marks,
            ')
                ->from('council_batch_assessor_map AS map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = map.batch_ems_id_fk', 'LEFT')
                ->join('council_assessor_exam_result_details AS result', 'result.batch_id_fk = map.batch_ems_id_fk AND  result.assessor_id_fk = map.assessor_id_fk', 'LEFT')
                ->where(array(
                    'map.assessor_id_fk' => $value['assessor_id_pk'],
                    'map.active_status'  => 1,
                    'batch.batch_type'   => 2,
                ))->get()->result_array();

            if (!empty($platformQuery) && ($platformQuery[0]['marks'] >= 50) && ($platformQuery[0]['con_eval_marks'] >= 25))
                $query[$key]['platform_training'] = 1;

            else
                $query[$key]['platform_training'] = 0;

            $assessorList[$key] = $query[$key];
        }

        return $assessorList;
    }

    public function downloadEmpanelledAssessorReport()
    {
        $query = $this->db->select("
            assessor.assessor_registration_details_pk AS assessor_id_pk,
            upper(assessor.fname)||' '||upper(assessor.mname)||' '||upper(assessor.lname) AS assessor_name,
            sector.sector_id_pk,
            sector.sector_name,
            course.course_id_pk,
            course.course_name,
            empanelled.empanelled_id_pk,
        ")
            ->from("council_assessor_registration_application_nubmer as appno")
            ->join("council_assessor_registration_details as assessor", "appno.assessor_registration_details_fk = assessor.assessor_registration_details_pk")
            ->join("council_assessor_registration_jobrole_sector_map as b", "b.assessor_registration_details_fk = assessor.assessor_registration_details_pk AND appno.assessor_registration_application_no = b.assessor_registration_application_no", "LEFT")
            ->join("council_course_master as course", "course.course_id_pk = b.course_id_fk", "LEFT")
            ->join("council_sector_master as sector", "sector.sector_id_pk = course.sector_id_fk", "LEFT")
            ->join("council_assessor_empanelled_map AS empanelled", "empanelled.assessor_id_fk = assessor.assessor_registration_details_pk AND empanelled.sector_id_fk = sector.sector_id_pk AND empanelled.course_id_fk = course.course_id_pk", "LEFT")
            ->where(
                array(
                    "assessor.active_status"      => 1,
                    "appno.process_status_id_fk"  => 5,
                    "b.active_status"             => 1,
                    "b.process_status_id_fk"      => 5,
                )
            )
            ->order_by("assessor_name, sector.sector_name, course.course_name")
            ->get()->result_array();

        foreach ($query as $key => $value) {

            $domainQuery = $this->db->select('result.marks')
                ->from('council_batch_assessor_map AS map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = map.batch_ems_id_fk', 'LEFT')
                ->join('council_assessor_exam_result_details AS result', 'result.batch_id_fk = map.batch_ems_id_fk AND  result.assessor_id_fk = map.assessor_id_fk', 'LEFT')
                ->where(array(
                    'map.assessor_id_fk' => $value['assessor_id_pk'],
                    'batch.sector_id'    => $value['sector_id_pk'],
                    'batch.course_id'    => $value['course_id_pk'],
                    'map.active_status'  => 1,
                    'batch.batch_type'   => 1,
                ))->get()->result_array();

            if (!empty($domainQuery) && ($domainQuery[0]['marks'] >= 50))
                $query[$key]['domain_training'] = 1;

            else
                $query[$key]['domain_training'] = 0;

            $platformQuery = $this->db->select('
                result.marks,
                result.con_eval_marks,
            ')
                ->from('council_batch_assessor_map AS map')
                ->join('council_batch_ems AS batch', 'batch.batch_ems_id_pk = map.batch_ems_id_fk', 'LEFT')
                ->join('council_assessor_exam_result_details AS result', 'result.batch_id_fk = map.batch_ems_id_fk AND  result.assessor_id_fk = map.assessor_id_fk', 'LEFT')
                ->where(array(
                    'map.assessor_id_fk' => $value['assessor_id_pk'],
                    'batch.sector_id'    => $value['sector_id_pk'],
                    'batch.course_id'    => $value['course_id_pk'],
                    'map.active_status'  => 1,
                    'batch.batch_type'   => 2,
                ))->get()->result_array();

            if (!empty($platformQuery) && ($platformQuery[0]['marks'] >= 50) && ($platformQuery[0]['con_eval_marks'] >= 25))
                $query[$key]['platform_training'] = 1;

            else
                $query[$key]['platform_training'] = 0;
        }

        return $query;
    }
}
