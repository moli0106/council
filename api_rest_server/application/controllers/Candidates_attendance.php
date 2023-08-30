<?php defined('BASEPATH') or exit('No direct script access allowed');

class Candidates_attendance extends NIC_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->library(array('form_validation'));

        $this->load->model('candidates_attendance_model');
    }

    /**
     * ! Trainee Attendance Request
     * Action: Trainee Attendance Request for Exam
     * ? Method: Post
     * @param array $this->post()
     */
    public function trainee_attendance_request_post()
    {
        // Create an array to store validation errors.
        $emptyArray = $unknownTrainee = array();

        // Sed delimiters to validation errors.
        $this->form_validation->set_error_delimiters('', '|');

        // Get data from post request
        $requestData = $this->post();
        $candidates  = $requestData['batchDetails']['candidates'];

        // Check length of candidates in a batch
        if (count($candidates) >= 1) {
            foreach ($candidates as $key => $candidate) {
                // Set validation rules for candidate
                $this->form_validation->set_rules(
                    array(
                        array(
                            'field' => 'batchDetails[candidates][' . $key . '][traineeId]',
                            'label' => 'Trainee ID',
                            'rules' => 'trim|required|max_length[255]|regex_match[/^[a-zA-Z0-9 -\/]+$/]',
                            'errors' => array(
                                'regex_match' => 'Trainee ID field is invalid'
                            )
                        ),
                        array(
                            'field' => 'batchDetails[candidates][' . $key . '][traineeRegistrationNumber]',
                            'label' => 'Trainee Registration Number',
                            'rules' => 'trim|required|max_length[255]|regex_match[/^[a-zA-Z0-9 -\/]+$/]',
                            'errors' => array(
                                'regex_match' => 'Trainee Registration Number field is invalid'
                            )
                        ),
                        array(
                            'field' => 'batchDetails[candidates][' . $key . '][basicDetails][firstName]',
                            'label' => 'Trainee First Name',
                            'rules' => 'trim|required|alpha|max_length[255]'
                        ),
                        array(
                            'field' => 'batchDetails[candidates][' . $key . '][basicDetails][lastName]',
                            'label' => 'Trainee Last Name',
                            'rules' => 'trim|required|alpha|max_length[255]'
                        ),
                        array(
                            'field' => 'batchDetails[candidates][' . $key . '][attendanceDetails][inTime]',
                            'label' => 'Trainee DOB',
                            'rules' => 'trim|required'
                            // 'rules' => 'trim|required|callback_check_date'
                        )
                    )
                );
            }
        } else {
            // Push error message for candidates
            array_push($emptyArray, array("reason" => "Minimum 10 Candidates are required for assessment."));
        }

        // Set post data for validation
        $this->form_validation->set_data($requestData);

        // Set validation rules for post data
        $this->form_validation->set_rules(
            array(

                array(
                    'field' => 'verticalId',
                    'label' => 'Vartical ID',
                    'rules' => 'trim|required|alpha'
                ),
                array(
                    'field' => 'verticalName',
                    'label' => 'Vertical Name',
                    'rules' => 'trim|required|max_length[100]'
                ),
                array(
                    'field' => 'batchDetails[userBatchId]',
                    'label' => 'User Batch ID',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'batchDetails[batchProposedAssessmentDate]',
                    'label' => 'Batch Proposed Assessment Date',
                    'rules' => 'trim|required|callback_check_date'
                ),
                array(
                    'field' => 'batchDetails[batchAttendanceFinalizeDate]',
                    'label' => 'Batch Attendance Finalize Date',
                    'rules' => 'trim|required|callback_check_date'
                ),

                /* 
					! Creating Sets of Rules for TP Details 
				*/

                array(
                    'field' => 'tpDetails[userTpId]',
                    'label' => 'User TP ID',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'tpDetails[userTpName]',
                    'label' => 'User TP Name',
                    'rules' => 'trim|required|max_length[255]'
                ),

                /* 
					! Creating Sets of Rules for TC Details 
				*/

                array(
                    'field' => 'tcDetails[userTcId]',
                    'label' => 'User TC ID',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'tcDetails[userTcName]',
                    'label' => 'User TC Name',
                    'rules' => 'trim|required|max_length[255]'
                )
            )
        );

        if ($this->form_validation->run() == FALSE) {

            $emptyArrayTmp = explode('|', validation_errors());
            array_pop($emptyArrayTmp);

            foreach ($emptyArrayTmp as $key => $value) {
                array_push($emptyArray, array('reason' => $value));
            }

            // Send error response to client
            $responseData = array(

                "responseMsg" => array(

                    "type"       => "SUCCESS",
                    "code"       => "SM9",
                    "msgDetails" => "Response Consumption Failed"
                ),
                "errorData"     => $emptyArray,
                "requestedData" => $requestData
            );

            $this->response($responseData, REST_Controller::HTTP_OK);
        } else {

            $batchData = $this->candidates_attendance_model->getBatchDetails($requestData['batchDetails']['userBatchId']);
            if (!empty($batchData)) {

                $updateBatchData = array(
                    'process_id_fk'                    => 11,
                    // 'attendance_finalize_date'         => date('Y-m-d', strtotime($requestData['batchDetails']['batchAttendanceFinalizeDate'])),
                    'attendance_finalize_date'         => $this->date_format_us($requestData['batchDetails']['batchAttendanceFinalizeDate']),
                    'flag_trainee_attendance_captured' => 1,
                );

                $this->candidates_attendance_model->updateBatchDetails($batchData[0]['assessment_batch_id_pk'], $updateBatchData);

                foreach ($candidates as $key => $candidate) {

                    $traineeData = $this->candidates_attendance_model->getTraineeDetails($batchData[0]['assessment_batch_id_pk'], $candidate['traineeId']);
                    if (!empty($traineeData)) {

                        $attendance_data = array(
                            'assessment_batch_id_fk' => $batchData[0]['assessment_batch_id_pk'],
                            'trainee_id_fk'          => $traineeData[0]['assessment_trainee_id_pk'],
                            // "trainee_in_time"        => date('Y-m-d h:i:s', strtotime($candidate['attendanceDetails']['inTime'])),
                            'trainee_in_time'         => $this->date_format_us_time($candidate['attendanceDetails']['inTime']),
                            'active_status'          => 1,
                            'process_id_fk'          => 1,
                        );

                        $attendanceData = $this->candidates_attendance_model->getTraineeAttendance($attendance_data['assessment_batch_id_fk'], $attendance_data['trainee_id_fk']);

                        if (!empty($attendanceData)) {

                            $attendance_data['update_time'] = "now()";

                            $this->candidates_attendance_model->updateAttendance($attendanceData[0]['attendance_id_pk'], $attendance_data);
                        } else {

                            $this->candidates_attendance_model->insertAttendance($attendance_data);
                        }
                    } else {

                        array_push($unknownTrainee, $candidate);
                    }
                }

                // Send success response to client
                $responseData = array(

                    "responseMsg" => array(

                        "type"       => "SUCCESS",
                        "code"       => "SM8",
                        "msgDetails" => "Response Consumed Successfully"
                    ),
                    "requestedData" => $requestData
                );

                if (!empty($unknownTrainee)) {
                    $responseData['unknownTrainee'] = $unknownTrainee;
                }

                $this->response($responseData, REST_Controller::HTTP_OK);
            } else {

                // Send error response to client
                $responseData = array(

                    "responseMsg" => array(

                        "type"       => "SUCCESS",
                        "code"       => "SM9",
                        "msgDetails" => "Response Consumption Failed"
                    ),
                    "errorData"     => array(
                        "Requested Batch is not found."
                    ),
                    "requestedData" => $requestData
                );

                $this->response($responseData, REST_Controller::HTTP_OK);
            }
        }
    }

    public function date_format_us($date_uk = NULL)
    {
        $date_array = explode("-", $date_uk);
        return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
    }

    public function date_format_us_time($date_uk = NULL)
    {
        $date_time_array =  explode(" ", $date_uk);
        $date_array = explode("-",  $date_time_array[0]);
        return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0] . " " .  $date_time_array[1];
    }

    public function check_date($date)
    {
        if ($date != "") {
            $date_arr  = explode('-', $date);
            if (count($date_arr) == 3 && is_numeric($date_arr[0]) && is_numeric($date_arr[1]) && is_numeric($date_arr[2])) {
                if (checkdate($date_arr[1], $date_arr[0], $date_arr[2])) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('check_date', 'The {field} field is incorrect');
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('check_date', 'The {field} field is incorrect');
                return FALSE;
            }
        }
    }
}
