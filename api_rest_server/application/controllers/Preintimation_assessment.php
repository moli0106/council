<?php defined('BASEPATH') or exit('No direct script access allowed');

class Preintimation_assessment extends NIC_Controller
{

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->load->library(array('form_validation', 'preintimation_assessment_library'));

        $this->load->model('assessment_preintimation_model');
    }

    /**
     * ! preintimation_assessment_request
     * Action: Preintimation assessment for batch request
     * ? Method: Post
     * @param array $this->post()
     */
    public function preintimation_assessment_request_post()
    {
        // Create an array to store validation errors.
        $emptyArray = array();

        // Sed delimiters to validation errors.
        $this->form_validation->set_error_delimiters('', '|');

        // Get data from post request
        $requestData = $this->post();

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
                    'field' => 'assessmentSchemeName',
                    'label' => 'Assessment Scheme Name',
                    'rules' => 'trim|required|max_length[100]'
                ),
                array(
                    'field' => 'assessmentSchemeId',
                    'label' => 'Assessment Scheme ID',
                    'rules' => 'trim|required|numeric' // callback from tbl....council_vertical_wise_assessment_scheme_master id pk
                ),

                /* 
					! Creating Sets of Rules for Batch Details 
				*/

                array(
                    'field' => 'batchDetails[userBatchId]',
                    'label' => 'User Batch ID',
                    'rules' => 'trim|required|is_unique[council_assessment_preintimation.user_batch_id]',
                    'errors' => array(
                        'is_unique' => "Batch request all ready submited to WBSCTVESD Council."
                    )
                ),
                array(
                    'field' => 'batchDetails[batchStartDate]',
                    'label' => 'Batch Start Date',
                    'rules' => 'trim|required|callback_check_date'
                ),
                array(
                    'field' => 'batchDetails[batchEndDate]',
                    'label' => 'Batch End Date',
                    'rules' => 'trim|required|callback_check_date'
                ),
                array(
                    'field' => 'batchDetails[batchTentativeAssessmentDate]',
                    'label' => 'Batch Tentative Assessment Date',
                    'rules' => 'trim|required|callback_check_date'
                ),
                array(
                    'field' => 'batchDetails[batchSize]',
                    'label' => 'Batch Size',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'batchDetails[jobRoles][courseDetails][courseName]',
                    'label' => 'Course Name',
                    'rules' => 'trim|required|max_length[255]'
                ),
                array(
                    'field' => 'batchDetails[jobRoles][courseDetails][courseCode]',
                    'label' => 'Course Code',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'batchDetails[jobRoles][sectorDetails][sectorId]',
                    'label' => 'Sector ID',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'batchDetails[jobRoles][sectorDetails][sectorName]',
                    'label' => 'sector Name',
                    'rules' => 'trim|required|max_length[255]'
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
                array(
                    'field' => 'tpDetails[contactDetails][mobileNumber]',
                    'label' => 'TP Mobile Number',
                    'rules' => 'trim|required|numeric|exact_length[10]'
                ),
                array(
                    'field' => 'tpDetails[contactDetails][email]',
                    'label' => 'TP Email',
                    'rules' => 'trim|required|valid_email'
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
                ),
                array(
                    'field' => 'tcDetails[contactDetails][mobileNumber]',
                    'label' => 'TC Mobile Number',
                    'rules' => 'trim|required|numeric|exact_length[10]'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][email]',
                    'label' => 'TC Email',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][communicationAddress][stateName]',
                    'label' => 'TC State Name',
                    'rules' => 'trim|required|max_length[255]'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][communicationAddress][stateId]',
                    'label' => 'TC State ID',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][communicationAddress][districtName]',
                    'label' => 'TC District Name',
                    'rules' => 'trim|required|max_length[255]'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][communicationAddress][districtId]',
                    'label' => 'TC District ID',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][communicationAddress][pinCode]',
                    'label' => 'TC Pin Code',
                    'rules' => 'trim|required|numeric|exact_length[6]'
                ),
                array(
                    'field' => 'tcDetails[contactDetails][communicationAddress][address1]',
                    'label' => 'TC Address 1',
                    'rules' => 'trim|required'
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
            $responseData = $this->preintimation_assessment_library->creatErrorResponse($emptyArray, $requestData);
            $this->response($responseData, REST_Controller::HTTP_OK);
        } else {

            if (isset($requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityId']) && !empty($requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityId'])) {
                $tc_municipality_lgd  = $requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityId'];
                $tc_municipality_name = $requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityName'];
            } else {
                $tc_municipality_lgd  = NULL;
                $tc_municipality_name = NULL;
            }

            $preintimation_data = array(
                'vertical_code'          => $requestData['verticalId'],
                'vertical_name'          => $requestData['verticalName'],
                'assessment_scheme_name' => $requestData['assessmentSchemeName'],
                'assessment_scheme_id'   => $requestData['assessmentSchemeId'],

                'user_batch_id'          => $requestData['batchDetails']['userBatchId'],
                'batch_start_date'       => $this->date_format_us($requestData['batchDetails']['batchStartDate']),
                'batch_end_date'         => $this->date_format_us($requestData['batchDetails']['batchEndDate']),
                'batch_tentative_assessment_date' => $this->date_format_us($requestData['batchDetails']['batchTentativeAssessmentDate']),
                'batch_size'             => $requestData['batchDetails']['batchSize'],

                'course_name'            => $requestData['batchDetails']['jobRoles']['courseDetails']['courseName'],
                'course_code'            => $requestData['batchDetails']['jobRoles']['courseDetails']['courseCode'],

                'sector_code'            => $requestData['batchDetails']['jobRoles']['sectorDetails']['sectorId'],
                'sector_name'            => $requestData['batchDetails']['jobRoles']['sectorDetails']['sectorName'],

                'tp_user_id'             => $requestData['tpDetails']['userTpId'],
                'tp_user_name'           => $requestData['tpDetails']['userTpName'],
                'tp_mobile_number'       => $requestData['tpDetails']['contactDetails']['mobileNumber'],
                'tp_email'               => $requestData['tpDetails']['contactDetails']['email'],

                'tc_user_id'             => $requestData['tcDetails']['userTcId'],
                'tc_user_name'           => $requestData['tcDetails']['userTcName'],
                'tc_mobile_number'       => $requestData['tcDetails']['contactDetails']['mobileNumber'],
                'tc_email'               => $requestData['tcDetails']['contactDetails']['email'],
                'tc_state_name'          => $requestData['tcDetails']['contactDetails']['communicationAddress']['stateName'],
                'tc_state_id'            => $requestData['tcDetails']['contactDetails']['communicationAddress']['stateId'],
                'tc_district_name'       => $requestData['tcDetails']['contactDetails']['communicationAddress']['districtName'],
                'tc_district_id'         => $requestData['tcDetails']['contactDetails']['communicationAddress']['districtId'],
                'tc_block_municipality_name' => $tc_municipality_name,
                'tc_block_municipality_id'   => $tc_municipality_lgd,
                'tc_pincode'             => $requestData['tcDetails']['contactDetails']['communicationAddress']['pinCode'],
                'tc_address_1'           => $requestData['tcDetails']['contactDetails']['communicationAddress']['address1'],
                'tc_landmark'            => (isset($requestData['tcDetails']['contactDetails']['communicationAddress']['landmark'])) ? $requestData['tcDetails']['contactDetails']['communicationAddress']['landmark'] : NULL,

                'active_status'          => 1,
                'process_id_fk'          => 1,
            );

            $preintimation_id = $this->assessment_preintimation_model->insertData('council_assessment_preintimation', $preintimation_data);

            // Send success response to client
            $responseData = $this->preintimation_assessment_library->creatSuccessResponse($preintimation_id);
            $this->response($responseData, REST_Controller::HTTP_OK);
        }
    }

    public function date_format_us($date_uk = NULL)
    {
        $date_array = explode("-", $date_uk);
        return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
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
