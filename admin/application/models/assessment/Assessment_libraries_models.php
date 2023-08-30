<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_libraries_models extends CI_Model
{

    public function getBatchInformation($id_hash = NULL)
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
            batch.process_id_fk,
            batch.flag_assessor_inability_status,
            batch.prefered_assessment_date_1,
            batch.prefered_assessment_date_2,
            
            process.process_name,

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
            ->join("wbtetsd_vertical_master AS vertical", "vertical.vertical_code = batch.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch.process_id_fk", "LEFT")
            ->join("council_district_master AS district", "district.lgd_code = tc_details.tc_district_lgd", "LEFT")
            ->join("council_course_master AS course", "course.course_code = batch.course_code", "LEFT")
            ->where(
                array(
                    "MD5(CAST(batch.assessment_batch_id_pk as character varying)) =" => $id_hash
                )
            )
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
                    'empanelled.empanelment_validity >='  => date("Y-m-d"),
                )
            )
            ->group_by('empanelled.assessor_id_fk')
            ->order_by('assessment_count')->get()->result_array();

        foreach ($batch_details as $key => $value) {
            $assessor_id_fk = $value['assessor_id_fk'];

            $query = $this->db->where('assessor_id_fk', $assessor_id_fk)
                ->where('purpose_assessment_date', $array['assessment_date'])
                ->where('active_status', 1)
                ->get('council_assessment_batch_assessor_map')->result_array();

            if (empty($query)) {
                $result = array(array('assessor_id_fk' => $assessor_id_fk));
                break;
            }
        }

        return $result;
    }

    public function getMapDistrict($district_id)
    {
        $result = $this->db->select('district_map_id_fk')->where('district_id_fk', $district_id)->get('council_assessment_district_map');

        return $result->result_array();
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
                    'empanelled.empanelment_validity >='  => date("Y-m-d"),
                )
            )
            ->where_in('district.district_id_pk', $array['district_ids'])

            ->group_by('empanelled.assessor_id_fk')
            ->order_by('assessment_count')->get()->result_array();

        foreach ($batch_details as $key => $value) {
            $assessor_id_fk = $value['assessor_id_fk'];

            $query = $this->db->where('assessor_id_fk', $assessor_id_fk)
                ->where('purpose_assessment_date', $array['assessment_date'])
                ->where('active_status', 1)
                ->get('council_assessment_batch_assessor_map')->result_array();

            if (empty($query)) {
                $result = array(array('assessor_id_fk' => $assessor_id_fk));
                break;
            }
        }

        return $result;
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
}

/* End of file Assessment_libraries_models.php */
