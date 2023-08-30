<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Preintimation_assessment_library
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
     * @param string $preintimation_id		  The preintimation_id to get information about batch (Required)
     * 
     * @return array API's response
     */
    public function creatSuccessResponse($preintimation_id = NULL)
    {
        if ($preintimation_id) {

            $condition = array('preintimation_assessment_id_pk' => $preintimation_id);

            $data = $this->CI->assessment_preintimation_model->getData('council_assessment_preintimation', $condition)[0];

            $responseArray = array(

                'responseMsg'    => array(

                    'type'       => 'SUCCESSS',
                    'code'       => 'SM8',
                    'msgDetails' => 'Response Consumed Successfully.'
                ),
                'requestedData' => array(

                    'verticalId'           => $data['vertical_code'],
                    'verticalName'         => $data['vertical_name'],
                    'assessmentSchemeName' => $data['assessment_scheme_name'],
                    'assessmentSchemeId'   => $data['assessment_scheme_id'],
                    'batchDetails'         => array(

                        "userBatchId"       => $data['user_batch_id'],
                        "batchStartDate"    => $data['batch_start_date'],
                        "batchEndDate"      => $data['batch_end_date'],
                        "batchTentativeAssessmentDate" => $data['batch_tentative_assessment_date'],
                        "batchSize"         => $data['batch_size'],
                        "jobRoles"          => array(
                            "courseDetails" => array(

                                "courseName" => $data['course_name'],
                                "courseCode" => $data['course_code']
                            ),
                            "sectorDetails" => array(

                                "sectorId"   => $data['sector_code'],
                                "sectorName" => $data['sector_name']
                            )
                        )
                    ),
                    'tpDetails'            => array(

                        "userTpId"         => $data['tp_user_id'],
                        "userTpName"       => $data['tp_user_name'],
                        "contactDetails"   => array(

                            "mobileNumber" => $data['tp_mobile_number'],
                            "email"        => $data['tp_email']
                        )
                    ),
                    'tcDetails'            => array(

                        "userTcId"         => $data['tc_user_id'],
                        "userTcName"       => $data['tc_user_name'],
                        "contactDetails"   => array(

                            "mobileNumber" => $data['tc_mobile_number'],
                            "email"        => $data['tc_email'],
                            "communicationAddress" => array(

                                "stateName"    => $data['tc_state_name'],
                                "stateId"      => $data['tc_state_id'],
                                "districtName" => $data['tc_district_name'],
                                "districtId"   => $data['tc_district_id'],
                                "blockMunicipalityName" => $data['tc_block_municipality_name'],
                                "blockMunicipalityId"   => $data['tc_block_municipality_id'],
                                "pinCode"     => $data['tc_pincode'],
                                "address1"    => $data['tc_address_1'],
                                "landmark"    => $data['tc_landmark']
                            )
                        )
                    ),
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
    public function creatErrorResponse($error_array = NULL, $request_array = NULL)
    {
        if (!empty($error_array) && !empty($request_array)) {

            $responseArray = array(

                'responseMsg'     => array(

                    'type'         => 'SUCCESSS',
                    'code'         => 'SM9',
                    'msgDetails'   => 'Response Consumption Failed'
                ),
                'requestedData' => array(

                    'verticalId'           => (isset($request_array['verticalId'])) ? $request_array['verticalId'] : NULL,
                    'verticalName'         => (isset($request_array["verticalName"])) ? $request_array["verticalName"] : NULL,
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
}

/* End of file Preintimation_assessment_library.php */
