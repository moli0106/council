<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_response_library
{
    /**
     * CI instance
     *
     * @var object
     */
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * Send success response to client
     *
     * @param string $batch_id		  The batch_id to get information about batch (Required)
     * 
     * @return array API's response
     */
    public function creatBatchSuccessResponse($batch_id = NULL)
    {
        if ($batch_id) {
            $responseDetails = $this->CI->assessment_batch_model->successResponseDetails($batch_id);
            extract($responseDetails);

            $tranee_array = array();
            foreach ($tranee_details as $key => $tranee) {
                $tmp_array = array(
                    "traineeId"        => $tranee['user_trainee_id'],
                    "councilTraineeId" => $tranee['council_trainee_code'],
                    "traineeName"      => $tranee['trainee_full_name']
                );

                array_push($tranee_array, $tmp_array);
            }

            $responseArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM1",
                    "msgDetails" => "Batch Created Successfully and SSC Assigned"
                ),
                "data"       => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"        => $batch_details['user_batch_id'],
                        "councilBatchId"     => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus" => $batch_details['process_name'],
                        "dateTimes"          => array(
                            "councilBatchCreatedDate" => date("d-m-Y h:i:s", strtotime($batch_details['entry_time'])),
                            "sscAssignDate"           => date("d-m-Y h:i:s", strtotime($batch_details['entry_time']))
                        ),
                        "jobRoles" => array(
                            "courseDetails" => array(
                                "courseName" => $batch_details['course_name'],
                                "courseCode" => $batch_details['course_code']
                            ),
                            "sectorDetails" => array(
                                "sectorId"   => $batch_details['sector_code'],
                                "sectorName" => $batch_details['sector_name']
                            )
                        ),
                        "candidates" => $tranee_array
                    ),
                    "tpDetails" => array(
                        "councilTpId"   => $batch_details['council_tp_code'],
                        "councilTpName" => $batch_details['council_tp_name'],
                        "userTpId"      => $batch_details['user_tp_institute_id'],
                        "userTpName"    => $batch_details['user_tp_institute_name']
                    ),
                    "tcDetails" => array(
                        "councilTcId"   => $batch_details['council_tc_code'],
                        "councilTcName" => $batch_details['council_tc_name'],
                        "userTcId"      => $batch_details['user_tc_code'],
                        "userTcName"    => $batch_details['user_tc_name']
                    )
                )
            );

            return $responseArray;
        }
    }

    /**
     * Send error response to client
     *
     * @param string $error_array		  All errors are stored in a array i.e. $error_array (Required)
     * @param string $request_array		  All data from the request (Required)
     * 
     * @return array API's response
     */
    public function creatBatchErrorResponse($error_array = NULL, $request_array = NULL)
    {
        if (!empty($error_array) && !empty($request_array)) {
            $responseArray = array(
                'verticalId'     => (isset($request_array['verticalId'])) ? $request_array['verticalId'] : NULL,
                'responseMsg'     => array(
                    'type'         => 'SUCCESSS',
                    'code'         => 'SM2',
                    'msgDetails' => 'Batch Creation Failed due to Inappropriate Data'
                ),
                'data' => array(
                    'verticalName'          => (isset($request_array["verticalName"])) ? $request_array["verticalName"] : NULL,
                    'assessmentSchemeName' => (isset($request_array['assessmentSchemeName'])) ? $request_array['assessmentSchemeName'] : NULL,
                    'assessmentSchemeId'   => (isset($request_array['assessmentSchemeId'])) ? $request_array['assessmentSchemeId'] : NULL,
                    'errorData'            => $error_array,
                    'councilBatchDetails'  => (isset($request_array['batchDetails'])) ? $request_array['batchDetails'] : NULL,
                    'tpDetails'            => (isset($request_array['tpDetails'])) ? $request_array['tpDetails'] : NULL,
                    'tcDetails'            => (isset($request_array['tcDetails'])) ? $request_array['tcDetails'] : NULL,
                )
            );

            return $responseArray;
        }
    }

    public function traineeDocumentSuccessResponse($request_array = NULL)
    {
        if (!empty($request_array)) {
            $responseArray = array(
                'verticalId'     => (isset($request_array['verticalId'])) ? $request_array['verticalId'] : NULL,
                'responseMsg'     => array(
                    'type'         => 'SUCCESSS',
                    'code'         => 'SM10',
                    'msgDetails'   => 'Trainee Photo Send Successfully.'
                ),
                'data' => array(
                    'verticalName'          => (isset($request_array["verticalName"])) ? $request_array["verticalName"] : NULL,
                    'councilBatchDetails'  => array(
                        'userBatchId'    => (isset($request_array['batchDetails']['userBatchId'])) ? $request_array['batchDetails']['userBatchId'] : NULL,
                        'councilBatchId' => (isset($request_array['batchDetails']['councilBatchId'])) ? $request_array['batchDetails']['councilBatchId'] : NULL,
                    )
                )
            );

            return $responseArray;
        }
    }

    public function traineeDocumentErrorResponse($error_array = NULL, $request_array = NULL)
    {
        if (!empty($error_array) && !empty($request_array)) {
            $responseArray = array(
                'verticalId'     => (isset($request_array['verticalId'])) ? $request_array['verticalId'] : NULL,
                'responseMsg'     => array(
                    'type'         => 'SUCCESSS',
                    'code'         => 'SM11',
                    'msgDetails'   => 'Failed to Send Trainee Photo due to Inappropriate Data.'
                ),
                'data' => array(
                    'verticalName'          => (isset($request_array["verticalName"])) ? $request_array["verticalName"] : NULL,
                    'errorData'            => $error_array,
                    'councilBatchDetails'  => array(
                        'userBatchId'    => (isset($request_array['batchDetails']['userBatchId'])) ? $request_array['batchDetails']['userBatchId'] : NULL,
                        'councilBatchId' => (isset($request_array['batchDetails']['councilBatchId'])) ? $request_array['batchDetails']['councilBatchId'] : NULL,
                    )
                )
            );

            return $responseArray;
        }
    }
	
	
	public function traineeDetailsUpdateSuccessResponse($request_array = NULL)
    {
        if (!empty($request_array)) {
            $responseArray = array(
                'verticalId'     => (isset($request_array['verticalId'])) ? $request_array['verticalId'] : NULL,
                'responseMsg'     => array(
                    'type'         => 'SUCCESSS',
                    'code'         => 'SM8',
                    'msgDetails'   => 'Response Consumed Successfully.'
                ),
                'data' => array(
                    'verticalName'          => (isset($request_array["verticalName"])) ? $request_array["verticalName"] : NULL,
                    'councilBatchDetails'  => array(
                        'userBatchId'    => (isset($request_array['batchDetails']['userBatchId'])) ? $request_array['batchDetails']['userBatchId'] : NULL,
                        'councilBatchId' => (isset($request_array['batchDetails']['councilBatchId'])) ? $request_array['batchDetails']['councilBatchId'] : NULL,
                    )
                )
            );

            return $responseArray;
        }
    }

    public function traineeDetailsUpdateErrorResponse($error_array = NULL, $request_array = NULL)
    {
        if (!empty($error_array) && !empty($request_array)) {
            $responseArray = array(
                'verticalId'     => (isset($request_array['verticalId'])) ? $request_array['verticalId'] : NULL,
                'responseMsg'     => array(
                    'type'         => 'SUCCESSS',
                    'code'         => 'SM9',
                    'msgDetails'   => 'Response Consumption Failed'
                ),
                'data' => array(
                    'verticalName'          => (isset($request_array["verticalName"])) ? $request_array["verticalName"] : NULL,
                    'errorData'            => $error_array,
                    'councilBatchDetails'  => array(
                        'userBatchId'    => (isset($request_array['batchDetails']['userBatchId'])) ? $request_array['batchDetails']['userBatchId'] : NULL,
                        'councilBatchId' => (isset($request_array['batchDetails']['councilBatchId'])) ? $request_array['batchDetails']['councilBatchId'] : NULL,
                    )
                )
            );

            return $responseArray;
        }
    }
}

/* End of file Assessment_response_library.php */
