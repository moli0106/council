<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Assessment extends NIC_Controller
{
    protected $ci;

    public function __construct()
    {
        $this->CI = &get_instance();

        $this->CI->load->model('assessment/assessment_libraries_models');
    }

    // ! Days Interval logic
    public function daysIntervalLogic($check_array = NULL)
    {
        $current_date = new DateTime(date('Y-m-d'));
        $assment_date = new DateTime($check_array['assessment_date']);

        $diff_date = $current_date->diff($assment_date)->format("%r%a");

        if ($diff_date < 5) {

            $check_array['assessment_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day'));
        }

        return $check_array;
    }

    //  ! Find Assessor to assign in Batch
    public function findAssessor($check_array = NULL)
    {
        $check_result   = $this->CI->assessment_libraries_models->checkAssessor($check_array);
        $assessor_id_fk = NULL;

        if (!empty($check_result)) {

            $assessor_id_fk = $check_result[0]['assessor_id_fk'];
        } else {

            $map_district = $this->CI->assessment_libraries_models->getMapDistrict($check_array['district_id']);

            if (!empty($map_district)) {

                $map_district = array_column($map_district, 'district_map_id_fk');

                $check_array = array(
                    'course_id'       => $check_array['course_id'],
                    'district_ids'    => $map_district,
                    'assessment_date' => $check_array['assessment_date']
                );

                $check_result = $this->CI->assessment_libraries_models->checkAssessorForAnotherDistrict($check_array);

                if (!empty($check_result)) {

                    $assessor_id_fk = $check_result[0]['assessor_id_fk'];
                }
            }
        }

        return $assessor_id_fk;
    }

    // ! Assign Assessor Function
    public function assignAssessor($batchDetails = NULL)
    {
        $assessor_id_fk = NULL;

        // ! Find assessor for prefered assessment date 1
        $check_array    = array(
            'course_id'       => $batchDetails['course_id_pk'],
            'district_id'     => $batchDetails['district_id_pk'],
            'assessment_date' => $batchDetails['prefered_assessment_date_1']
        );

        // if ($batchDetails['assessment_scheme_id_fk'] == 1) { // ? 1: STT, 2: RPL
        if ($batchDetails['assessment_scheme_id_fk'] != 2) { // ? 1: STT, 2: RPL
            $check_array = $this->daysIntervalLogic($check_array);
        } else {
            if ($batchDetails['preferred_district_lgd'] != NULL) {

                $check_array['district_id'] = $batchDetails['preferred_district_id_pk'];
            }
        }

        $assessor_id_fk = $this->findAssessor($check_array);

        if ($assessor_id_fk == NULL) {

            // ! Find assessor for prefered assessment date 2
            $check_array['assessment_date'] = $batchDetails['prefered_assessment_date_2'];

            // if ($batchDetails['assessment_scheme_id_fk'] == 1) { // ? 1: STT, 2: RPL
            if ($batchDetails['assessment_scheme_id_fk'] != 2) { // ? 1: STT, 2: RPL
                $check_array = $this->daysIntervalLogic($check_array);
            }

            $assessor_id_fk = $this->findAssessor($check_array);

            // if (($assessor_id_fk == NULL) && ($batchDetails['assessment_scheme_id_fk'] == 1)) {
            if (($assessor_id_fk == NULL) && ($batchDetails['assessment_scheme_id_fk'] != 2)) {

                // ! Find assessor on next 60 days
                $startDate   = new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day')));
                $endDate   = new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day')));

                $oneDay    = new DateInterval("P1D");

                $endDate->modify("+60 days");

                $holiDays = $this->CI->assessment_libraries_models->getHolidays($startDate->format("Y-m-d"), $endDate->format("Y-m-d"));

                foreach (new DatePeriod($startDate, $oneDay, $endDate->add($oneDay)) as $day) {

                    $dayNum  = $day->format("N");
                    $dayDate = $day->format("Y-m-d");

                    // ! Excluding Saturday, Sunday & Holiday
                    if (!in_array($dayDate, $holiDays)) {

                        $check_array['assessment_date'] = $dayDate;
                        $assessor_id_fk = $this->findAssessor($check_array);

                        if ($assessor_id_fk != NULL) {
                            break;
                        }
                    }
                }
            }
        }

        if ($assessor_id_fk != NULL) {

            return array(
                'assessor_id_fk' => $assessor_id_fk,
                'assinged_date' => $check_array['assessment_date'],
            );
        } else {
            return FALSE;
        }
    }
}

/* End of file Assessment.php */
