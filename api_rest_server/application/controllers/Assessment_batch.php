<?php defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_batch extends NIC_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->library(array('form_validation', 'assessment_response_library'));

		$this->load->model('assessment_batch_model');
	}

	/**
	 * Action: Create assessment batch from the request
	 * Method: Post
	 * @param array $this->post()
	 */
	public function create_assessment_batch_post()
	{
		// Create an array to store validation errors.
		$emptyArray = $candidates = array();

		// Sed delimiters to validation errors.
		$this->form_validation->set_error_delimiters('', '|');

		// Get data from post request
		$requestData = $this->post();

		$candidates  = $requestData['batchDetails']['candidates'];

		// Check length of candidates in a batch
		if ($requestData['assessmentSchemeId'] == 1) {

			$batchStrength = 30;
		} elseif ($requestData['assessmentSchemeId'] == 2) {

			$batchStrength = 50;
		} else {
			$batchStrength = 200;
		}

		// Check Minimum number of candidates in abatch
		if ($requestData['assessmentSchemeId'] == 1 || $requestData['assessmentSchemeId'] == 2) {

			$min_candidates_count = 10;
		} else {

			$min_candidates_count = 1;
		}

		// Check length of candidates in a batch
		if ((count($candidates) >= $min_candidates_count) && (count($candidates) <= $batchStrength)) {
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
							'rules' => 'trim|required|max_length[100]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][middleName]',
							'label' => 'Trainee Middle Name',
							'rules' => 'trim|max_length[100]'
							// 'rules' => 'trim|alpha|max_length[100]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][lastName]',
							'label' => 'Trainee Last Name',
							'rules' => 'trim|max_length[100]'
							// 'rules' => 'trim|alpha|max_length[100]'
						),
						//Added by Waseem 
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][fatherName]',
							'label' => 'Trainee Father Name',
							'rules' => 'trim|required|max_length[150]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][motherName]',
							'label' => 'Trainee Mother Name',
							'rules' => 'trim|required|max_length[150]'
						),
						//Added by Waseem 
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][guardianName]',
							'label' => 'Trainee Guardian Name',
							'rules' => 'trim|max_length[150]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][dob]',
							'label' => 'Trainee DOB',
							'rules' => 'trim|required|callback_check_date'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][basicDetails][attendancePercentage]',
							'label' => 'Trainee Attendance Percentage',
							'rules' => 'trim|required|numeric'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][contactDetails][mobileNumber]',
							'label' => 'Trainee Mobile Number',
							'rules' => 'trim|required|numeric|exact_length[10]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][contactDetails][communicationAddress][stateName]',
							'label' => 'Trainee State Name',
							'rules' => 'trim|required|max_length[255]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][contactDetails][communicationAddress][stateId]',
							'label' => 'Trainee State LGD Code',
							'rules' => 'trim|required|numeric'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][contactDetails][communicationAddress][districtName]',
							'label' => 'Trainee District Name',
							'rules' => 'trim|required|max_length[255]'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][contactDetails][communicationAddress][districtId]',
							'label' => 'Trainee District LGD Code',
							'rules' => 'trim|required|numeric'
						),
						array(
							'field' => 'batchDetails[candidates][' . $key . '][contactDetails][communicationAddress][address1]',
							'label' => 'Trainee Address 1',
							'rules' => 'trim|required|max_length[255]'
						),
					)
				);
			}
		} else {
			// Push error message for candidates
			array_push($emptyArray, array("reason" => "Minimum 10 & Maximum " . $batchStrength . " Candidates are required for assessment."));
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
					* Creating Sets of Rules for Batch Details 
				*/

				array(
					'field' => 'batchDetails[userBatchId]',
					'label' => 'User Batch ID',
					// 'rules' => 'trim|required',
					'rules' => 'trim|required|is_unique[council_assessment_batch_details.user_batch_id]',
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
					'field' => 'batchDetails[status]',
					'label' => 'Batch Status',
					'rules' => 'trim|required|alpha'
				),
				array(
					'field' => 'batchDetails[dateTimes][preferedAssessmentDate1]',
					'label' => 'Prefered Assessment Date 1',
					'rules' => 'trim|required|callback_check_date'
				),
				array(
					'field' => 'batchDetails[dateTimes][preferedAssessmentDate2]',
					'label' => 'Prefered Assessment Date 2',
					'rules' => 'trim|required|callback_check_date'
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
					'field' => 'batchDetails[jobRoles][courseDetails][courseDuration]',
					'label' => 'Course Duration',
					'rules' => 'trim|required|numeric'
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
					* Creating Sets of Rules for TP Details 
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
					// 'rules' => 'trim|required|numeric|exact_length[10]'
					'rules' => 'trim|required|numeric|max_length[20]'
				),
				array(
					'field' => 'tpDetails[contactDetails][email]',
					'label' => 'TP Email',
					'rules' => 'trim|required|valid_email'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][stateName]',
					'label' => 'TP State Name',
					'rules' => 'trim|required|max_length[255]'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][stateId]',
					'label' => 'TP State ID',
					'rules' => 'trim|required|numeric'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][districtName]',
					'label' => 'TP District Name',
					'rules' => 'trim|required|max_length[255]'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][districtId]',
					'label' => 'TP District ID',
					'rules' => 'trim|required|numeric'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][blockMunicipalityId]',
					'label' => 'TP Block Municipality LGD',
					'rules' => 'trim|numeric'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][pinCode]',
					'label' => 'TP Pin Code',
					'rules' => 'trim|required|numeric|exact_length[6]'
				),
				array(
					'field' => 'tpDetails[contactDetails][communicationAddress][address1]',
					'label' => 'TP Address 1',
					'rules' => 'trim|required'
				),
				array(
					'field' => 'tpDetails[contactDetails][spoc][spocName]',
					'label' => 'TP spoc Name',
					'rules' => 'trim|required|max_length[255]'
				),
				array(
					'field' => 'tpDetails[contactDetails][spoc][mobileNumber]',
					'label' => 'TP spoc Mobile Number',
					'rules' => 'trim|required|numeric|max_length[20]'
				),
				array(
					'field' => 'tpDetails[contactDetails][spoc][email]',
					'label' => 'TP spoc Email',
					'rules' => 'trim|required|valid_email'
				),

				/* 
					* Creating Sets of Rules for TC Details 
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
					'rules' => 'trim|required|numeric|max_length[20]'
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
					'field' => 'tcDetails[contactDetails][communicationAddress][blockMunicipalityId]',
					'label' => 'TC Block Municipality LGD',
					'rules' => 'trim|numeric'
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
				),
				array(
					'field' => 'tcDetails[contactDetails][spoc][spocName]',
					'label' => 'TC spoc Name',
					'rules' => 'trim|required|max_length[255]'
				),
				array(
					'field' => 'tcDetails[contactDetails][spoc][mobileNumber]',
					'label' => 'TC spoc Mobile Number',
					'rules' => 'trim|required|numeric|max_length[20]'
				),
				array(
					'field' => 'tcDetails[contactDetails][spoc][email]',
					'label' => 'TC spoc Email',
					'rules' => 'trim|required|valid_email'
				),
				array(
					'field' => 'tcDetails[contactDetails][location][longitude]',
					'label' => 'TC Longitude',
					'rules' => 'trim',
					// 'rules' => 'trim|required|regex_match[/^[-]?(([0-9]?[0-9])\.(\d+))|(180(\.0+)?)$/]',
					'errors' => array(
						'regex_match' => 'The TC Longitude field is invalid'
					)
				),
				array(
					'field' => 'tcDetails[contactDetails][location][latitude]',
					'label' => 'TC Latitude',
					'rules' => 'trim',
					// 'rules' => 'trim|required|regex_match[/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/]',
					'errors' => array(
						'regex_match' => 'The TC Latitude field is invalid'
					)
				),
			)
		);

		// ! Check for RPL Batch
		$assessmentSchemeId  = $requestData['assessmentSchemeId'];
		if ($assessmentSchemeId == 2) {

			// ! Set validation rules for assessmentPreferredLocation
			$assessmentPreferredLocation  = $requestData['batchDetails']['assessmentPreferredLocation'];
			if (!empty($assessmentPreferredLocation)) {

				// ? Set validation rules for post data
				$this->form_validation->set_rules(
					array(
						array(
							'field' => 'batchDetails[assessmentPreferredLocation][districtName]',
							'label' => 'Assessment Preferred Location District Name',
							'rules' => 'trim|required|max_length[255]'
						),
						array(
							'field' => 'batchDetails[assessmentPreferredLocation][districtID]',
							'label' => 'Assessment Preferred Location District LGD',
							'rules' => 'trim|required|numeric'
						),
						array(
							'field' => 'batchDetails[assessmentPreferredLocation][preferredLocation]',
							'label' => 'Assessment Preferred Location Preferred Location',
							'rules' => 'trim|required'
						),
					)
				);
			} else {
				// Push error message for assessmentPreferredLocation
				array_push($emptyArray, array("reason" => "assessmentPreferredLocation is required."));
			}
		}

		if ($this->form_validation->run() == FALSE) {
			$emptyArrayTmp = explode('|', validation_errors());
			array_pop($emptyArrayTmp);
			foreach ($emptyArrayTmp as $key => $value) {
				array_push($emptyArray, array('reason' => $value));
			}

			// Send error response to client
			$responseData = $this->assessment_response_library->creatBatchErrorResponse($emptyArray, $requestData);
			$this->response($responseData, REST_Controller::HTTP_OK);
		} else {

			if (!empty($emptyArray)) {
				// Send error response to client
				$responseData = $this->assessment_response_library->creatBatchErrorResponse($emptyArray, $requestData);
				$this->response($responseData, REST_Controller::HTTP_OK);
			} else {

				// $this->db->trans_start();

				// Insert requested data as a JSON format
				$assessmentJsonData = array(
					"user_batch_code"                => $requestData['batchDetails']['userBatchId'],
					"json_data_type_id_fk"           => 1, // 1: Request & 2: Response
					"council_response_message_id_fk" => NULL,
					"council_assessment_json_file"   => json_encode($requestData, true),
					"entry_ip"                       => $this->input->ip_address(),
					"entry_by_login_id_fk"           => NULL,
					"entry_by_stake_id_fk"           => NULL,
					"active_status"                  => 1,
				);
				$assessmentJsonDataId = $this->assessment_batch_model->insertData('council_assessment_json_data', $assessmentJsonData);

				if ($assessmentJsonDataId) {
					/*
						! TP Details Block 
					*/

					// Check TP municipality ID either NULL or NOT
					if (isset($requestData['tpDetails']['contactDetails']['communicationAddress']['blockMunicipalityId']) && !empty($requestData['tpDetails']['contactDetails']['communicationAddress']['blockMunicipalityId'])) {
						$tp_municipality_lgd  = $requestData['tpDetails']['contactDetails']['communicationAddress']['blockMunicipalityId'];
						$tp_municipality_name = $requestData['tpDetails']['contactDetails']['communicationAddress']['blockMunicipalityName'];
					} else {
						$tp_municipality_lgd  = NULL;
						$tp_municipality_name = NULL;
					}

					// Generate an array for TP information
					$tpDetails = array(
						"council_tp_name"            => $requestData['tpDetails']['userTpName'],
						"user_tp_institute_name"     => $requestData['tpDetails']['userTpName'],
						"user_tp_institute_id"       => $requestData['tpDetails']['userTpId'],
						"tp_type"                    => (isset($requestData['tpDetails']['TrainingPartnerType'])) ? $requestData['tpDetails']['TrainingPartnerType'] : NULL,
						"tp_mobile_no"               => $requestData['tpDetails']['contactDetails']['mobileNumber'],
						"tp_email"                   => $requestData['tpDetails']['contactDetails']['email'],
						"tp_spoc_name"               => $requestData['tpDetails']['contactDetails']['spoc']['spocName'],
						"tp_spoc_mobile_no"          => $requestData['tpDetails']['contactDetails']['spoc']['mobileNumber'],
						"tp_spoc_email"              => $requestData['tpDetails']['contactDetails']['spoc']['email'],
						"tp_address"                 => $requestData['tpDetails']['contactDetails']['communicationAddress']['address1'],
						"tp_pincode"                 => $requestData['tpDetails']['contactDetails']['communicationAddress']['pinCode'],
						"tp_landmark"                => (isset($requestData['tpDetails']['contactDetails']['communicationAddress']['landmark'])) ? $requestData['tpDetails']['contactDetails']['communicationAddress']['landmark'] : NULL,
						"tp_state_lgd"               => $requestData['tpDetails']['contactDetails']['communicationAddress']['stateId'],
						"tp_state_name"              => $requestData['tpDetails']['contactDetails']['communicationAddress']['stateName'],
						"tp_district_lgd"            => $requestData['tpDetails']['contactDetails']['communicationAddress']['districtId'],
						"tp_district_name"           => $requestData['tpDetails']['contactDetails']['communicationAddress']['districtName'],
						"tp_block_municipality_lgd"  => $tp_municipality_lgd,
						"tp_block_municipality_name" => $tp_municipality_name,
						"entry_ip"                   => $this->input->ip_address(),
						"active_status"              => 1
					);

					// Check TP infromation is all ready stored in table or not
					$tpCondition = array(
						'user_tp_institute_id' => $tpDetails['user_tp_institute_id'],
						'active_status'        => 1,
					);
					$checkTpDetails = $this->assessment_batch_model->getData('council_assessment_tp_institute_details', $tpCondition);

					if (empty($checkTpDetails) && count($checkTpDetails) == 0) {
						// Insert TP information and update the code
						$tp_id = $this->assessment_batch_model->insertData('council_assessment_tp_institute_details', $tpDetails);

						$updateTpStatus = $this->assessment_batch_model->UpdateTpData($tp_id, array('council_tp_code' => 'TP_' . sprintf("%07d", $tp_id)));
					} else {
						$tp_id = $checkTpDetails[0]['assessment_tp_id_pk'];
					}

					/* =============== END TP Details Block =============== */

					/*
						! TC Details Block 
					*/

					// Check TC municipality ID either NULL or NOT
					if (isset($requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityId']) && !empty($requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityId'])) {
						$tc_municipality_lgd  = $requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityId'];
						$tc_municipality_name = $requestData['tcDetails']['contactDetails']['communicationAddress']['blockMunicipalityName'];
					} else {
						$tc_municipality_lgd  = NULL;
						$tc_municipality_name = NULL;
					}

					// Generate an array for TC information
					$tcDetails = array(
						"council_tc_name"            => $requestData['tcDetails']['userTcName'],
						"assessment_tp_id_fk"        => $tp_id,
						"user_tc_name"               => $requestData['tcDetails']['userTcName'],
						"user_tc_code"               => $requestData['tcDetails']['userTcId'],
						"tc_mobile_no"               => $requestData['tcDetails']['contactDetails']['mobileNumber'],
						"tc_email"                   => $requestData['tcDetails']['contactDetails']['email'],
						"tc_spoc_name"               => $requestData['tcDetails']['contactDetails']['spoc']['spocName'],
						"tc_spoc_mobile_no"          => $requestData['tcDetails']['contactDetails']['spoc']['mobileNumber'],
						"tc_spoc_email"              => $requestData['tcDetails']['contactDetails']['spoc']['email'],
						"tc_address"                 => $requestData['tcDetails']['contactDetails']['communicationAddress']['address1'],
						"tc_pincode"                 => $requestData['tcDetails']['contactDetails']['communicationAddress']['pinCode'],
						"tc_landmark"                => (isset($requestData['tcDetails']['contactDetails']['communicationAddress']['landmark'])) ? $requestData['tcDetails']['contactDetails']['communicationAddress']['landmark'] : NULL,
						"tc_latitude"                => $requestData['tcDetails']['contactDetails']['location']['longitude'],
						"tc_longitude"               => $requestData['tcDetails']['contactDetails']['location']['latitude'],
						"tc_state_lgd"               => $requestData['tcDetails']['contactDetails']['communicationAddress']['stateId'],
						"tc_state_name"              => $requestData['tcDetails']['contactDetails']['communicationAddress']['stateName'],
						"tc_district_lgd"            => $requestData['tcDetails']['contactDetails']['communicationAddress']['districtId'],
						"tc_district_name"           => $requestData['tcDetails']['contactDetails']['communicationAddress']['districtName'],
						"tc_block_municipality_lgd"  => $tc_municipality_lgd,
						"tc_block_municipality_name" => $tc_municipality_name,
						"entry_ip"                   => $this->input->ip_address(),
						"active_status"              => 1
					);

					// Check TC infromation is all ready stored in table or not
					$tcCondition = array(
						'user_tc_code'  => $tcDetails['user_tc_code'],
						'active_status' => 1,
					);
					$checkTcDetails = $this->assessment_batch_model->getData('council_assessment_tc_details', $tcCondition);

					if (empty($checkTcDetails) && count($checkTcDetails) == 0) {
						// Insert TC information and update the code
						$tc_id = $this->assessment_batch_model->insertData('council_assessment_tc_details', $tcDetails);

						$updateTcStatus = $this->assessment_batch_model->UpdateTcData($tc_id, array('council_tc_code' => 'TC_' . sprintf("%07d", $tc_id)));
					} else {
						$tc_id = $checkTcDetails[0]['assessment_tc_id_pk'];
					}

					/* =============== END TC Details Block =============== */

					/*
						! Batch Details Block 
					*/

					// Generate an array for Batch information
					$batchDetails = array(
						"vertical_code"           => $requestData['verticalId'],
						"assessment_scheme_id_fk" => $requestData['assessmentSchemeId'],
						"user_batch_id"           => $requestData['batchDetails']['userBatchId'],
						"assessment_tc_id_fk"     => $tc_id,
						"batch_size"              => $requestData['batchDetails']['batchSize'],
						"course_code"             => $requestData['batchDetails']['jobRoles']['courseDetails']['courseCode'],
						"course_name"             => $requestData['batchDetails']['jobRoles']['courseDetails']['courseName'],
						"sector_code"             => $requestData['batchDetails']['jobRoles']['sectorDetails']['sectorId'],
						"sector_name"             => $requestData['batchDetails']['jobRoles']['sectorDetails']['sectorName'],
						"course_duration"         => $requestData['batchDetails']['jobRoles']['courseDetails']['courseDuration'],
						"course_rate"             => (isset($requestData['batchDetails']['jobRoles']['courseDetails']['courseRate'])) ? $requestData['batchDetails']['jobRoles']['courseDetails']['courseRate'] : NULL,
						"batch_start_date"        => $this->date_format_us($requestData['batchDetails']['batchStartDate']),
						"batch_end_date"          => $this->date_format_us($requestData['batchDetails']['batchEndDate']),
						"batch_tentative_assessment_date" => $this->date_format_us($requestData['batchDetails']['batchTentativeAssessmentDate']),
						"prefered_assessment_date_1" => $this->date_format_us($requestData['batchDetails']['dateTimes']['preferedAssessmentDate1']),
						"prefered_assessment_date_2" => $this->date_format_us($requestData['batchDetails']['dateTimes']['preferedAssessmentDate2']),
						"entry_ip"                => $this->input->ip_address(),
						"active_status"           => 1,
						"process_id_fk"           => 7,
					);

					// ! assessmentPreferredLocation for RPL BATCH
					if (
						isset($requestData['batchDetails']['assessmentPreferredLocation'])
						&&
						!empty($requestData['batchDetails']['assessmentPreferredLocation'])
					) {

						$batchDetails["preferred_district_name"]    = $requestData['batchDetails']['assessmentPreferredLocation']['districtName'];
						$batchDetails["preferred_district_lgd"]       = $requestData['batchDetails']['assessmentPreferredLocation']['districtID'];
						$batchDetails["preferred_location"]           = $requestData['batchDetails']['assessmentPreferredLocation']['preferredLocation'];
					}

					// Insert Batch information
					$batch_id = $this->assessment_batch_model->insertData('council_assessment_batch_details', $batchDetails);

					/* =============== END Batch Details Block =============== */

					if ($batch_id) {
						foreach ($candidates as $key => $candidate) {

							$candidateDetails = array();

							// Check Candidate municipality ID either NULL or NOT
							if (isset($candidate['contactDetails']['communicationAddress']['blockMunicipalityId']) && !empty($candidate['contactDetails']['communicationAddress']['blockMunicipalityId'])) {
								$trainee_municipality_lgd  = $candidate['contactDetails']['communicationAddress']['blockMunicipalityId'];
								$trainee_municipality_name = $candidate['contactDetails']['communicationAddress']['blockMunicipalityName'];
							} else {
								$trainee_municipality_lgd  = NULL;
								$trainee_municipality_name = NULL;
							}

							// Get full name of Candidate
							if (isset($candidate['basicDetails']['middleName']) && !empty($candidate['basicDetails']['middleName'])) {
								$trainee_full_name = $candidate['basicDetails']['firstName'] . ' ' . $candidate['basicDetails']['middleName'] . ' ' . $candidate['basicDetails']['lastName'];
							} else {
								$trainee_full_name = $candidate['basicDetails']['firstName'] . ' ' . $candidate['basicDetails']['lastName'];
							}

							// Generate an array for Candidate information
							$candidateDetails = array(
								"assessment_batch_id_fk"       => $batch_id,
								"user_trainee_id"              => $candidate['traineeId'],
								"user_trainee_registration_no" => $candidate['traineeRegistrationNumber'],
								"trainee_full_name"            => $trainee_full_name,
								//Added by Waseem
								"trainee_father_name"        => (isset($candidate['basicDetails']['fatherName'])) ? $candidate['basicDetails']['fatherName'] : NULL,
								"trainee_mother_name"        => (isset($candidate['basicDetails']['motherName'])) ? $candidate['basicDetails']['motherName'] : NULL,
								//Added by Waseem
								"trainee_guardian_name"        => (isset($candidate['basicDetails']['guardianName'])) ? $candidate['basicDetails']['guardianName'] : NULL,
								"guardian_relationship"        => (isset($candidate['basicDetails']['relationWithGuardian'])) ? $candidate['basicDetails']['relationWithGuardian'] : NULL,
								"trainee_gender"               => (isset($candidate['basicDetails']['gender'])) ? $candidate['basicDetails']['gender'] : NULL,
								"trainee_dob"                  => $this->date_format_us($candidate['basicDetails']['dob']),
								"attendance_percentage"        => $candidate['basicDetails']['attendancePercentage'],
								"trainee_caste"                => (isset($candidate['basicDetails']['caste'])) ? $candidate['basicDetails']['caste'] : NULL,
								"trainee_religion"             => (isset($candidate['basicDetails']['religion'])) ? $candidate['basicDetails']['religion'] : NULL,
								"trainee_mobile_no"            => $candidate['contactDetails']['mobileNumber'],
								"trainee_email"                => (isset($candidate['contactDetails']['email'])) ? $candidate['contactDetails']['email'] : NULL,
								"trainee_address"              => $candidate['contactDetails']['communicationAddress']['address1'],
								"trainee_pincode"              => (isset($candidate['contactDetails']['communicationAddress']['pinCode'])) ? $candidate['contactDetails']['communicationAddress']['pinCode'] : NULL,
								"trainee_state_lgd"            => $candidate['contactDetails']['communicationAddress']['stateId'],
								"trainee_state_name"           => $candidate['contactDetails']['communicationAddress']['stateName'],
								"trainee_district_lgd"         => $candidate['contactDetails']['communicationAddress']['districtId'],
								"trainee_district_name"        => $candidate['contactDetails']['communicationAddress']['districtName'],
								"trainee_block_municipality_lgd"  => $trainee_municipality_lgd,
								"trainee_block_municipality_name" => $trainee_municipality_name,
								"entry_ip"                     => $this->input->ip_address(),
								"active_status"                => 1,
								"process_id_fk"                => 1,
								"trainee_details_entry_time"   => 'now()',
							);

							// Insert Candidate information and update the code
							$trainee_id = $this->assessment_batch_model->insertData('council_assessment_trainee_details', $candidateDetails);

							$updateTrStatus = $this->assessment_batch_model->UpdateTraineeData($trainee_id, array('council_trainee_code' => 'TR_' . sprintf("%010d", $trainee_id)));
						}
					}

					// Send success response to client
					$responseData = $this->assessment_response_library->creatBatchSuccessResponse($batch_id);
					$this->response($responseData, REST_Controller::HTTP_OK);

					/* if ($this->db->trans_status() === FALSE)
					{
						$this->db->trans_rollback();
					}
					else
					{
						$this->db->trans_commit();
					} */
				}
			}
		}
	}

	/**
	 * ! Action: Receive Trainee Document from The Request
	 * ? Method: Post
	 * @param array $this->post()
	 */
	public function trainee_document_post()
	{
		// Create an array to store validation errors.
		$emptyArray = array();

		// Set delimiters to validation errors.
		$this->form_validation->set_error_delimiters('', '|');

		// Get data from post request
		$requestData = $this->post();
		$candidates  = $requestData['batchDetails']['candidates'];

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
						'field' => 'batchDetails[candidates][' . $key . '][documents][photo]',
						'label' => 'Trainee Photo',
						'rules' => 'trim|required'
					)
				)
			);
		}

		// Set post data for validation
		$this->form_validation->set_data($requestData);

		// Set validation rules for post data
		$this->form_validation->set_rules(
			array(
				array(
					'field' => 'requestType',
					'label' => 'Request Type',
					'rules' => 'trim|required|alpha'
				),
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
					'rules' => 'trim|required'
				),
				array(
					'field' => 'batchDetails[councilBatchId]',
					'label' => 'Council Batch Id',
					'rules' => 'trim|required'
				),
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$emptyArrayTmp = explode('|', validation_errors());
			array_pop($emptyArrayTmp);

			foreach ($emptyArrayTmp as $key => $value) {
				array_push($emptyArray, array('reason' => $value));
			}

			// Send error response to client
			$responseData = $this->assessment_response_library->traineeDocumentErrorResponse($emptyArray, $requestData);
			$this->response($responseData, REST_Controller::HTTP_OK);
		} else {
			if (!empty($emptyArray)) {

				// Send error response to client
				$responseData = $this->assessment_response_library->creatBatchErrorResponse($emptyArray, $requestData);
			} else {

				// Insert requested data as a JSON format
				$assessmentJsonData = array(
					"user_batch_code"                => $requestData['batchDetails']['userBatchId'],
					"json_data_type_id_fk"           => 1, // 1: Request & 2: Response
					"council_response_message_id_fk" => 13,
					"council_assessment_json_file"   => json_encode($requestData, true),
					"entry_ip"                       => $this->input->ip_address(),
					"entry_by_login_id_fk"           => NULL,
					"entry_by_stake_id_fk"           => NULL,
					"active_status"                  => 1,
				);
				$assessmentJsonDataId = $this->assessment_batch_model->insertData('council_assessment_json_data', $assessmentJsonData);

				if ($assessmentJsonDataId) {

					$userBatchId    = $requestData['batchDetails']['userBatchId'];
					$councilBatchId = $requestData['batchDetails']['councilBatchId'];

					$batchDetails = $this->assessment_batch_model->getBatchDetails($userBatchId, $councilBatchId);
					if (!empty($batchDetails)) {

						$batch_id_pk = $batchDetails[0]['assessment_batch_id_pk'];
						$errorResponse = 0;

						// ! Starting Transaction
						$this->db->trans_start(); # Starting Transaction

						foreach ($candidates as $key => $value) {

							$insertImage = $whereCondition = array();

							$insertImage = array(
								'trainee_image'      => $value['documents']['photo'],
								'image_entry_time' => 'now()',
							);

							$whereCondition = array(
								'assessment_batch_id_fk' => $batch_id_pk,
								'user_trainee_id'           => $value['traineeId']
							);

							$this->assessment_batch_model->updateTraineeImageData($whereCondition, $insertImage);
						}

						// ! Completing transaction
						$this->db->trans_complete(); # Completing transaction

						// ! Check All Query For Trainee
						if ($this->db->trans_status() === FALSE) {

							# Something went wrong.
							$this->db->trans_rollback();
							array_push($emptyArray, array('reason' => 'Unable to upload trainee image.'));
						} else {

							# Everything is Perfect. Committing data to the database.
							$this->db->trans_commit();
						}

						if (!empty($emptyArray)) {

							$responseData = $this->assessment_response_library->traineeDocumentErrorResponse($emptyArray, $requestData);
						} else {

							$responseData = $this->assessment_response_library->traineeDocumentSuccessResponse($requestData);
						}
					} else {

						$emptyArray = array(
							'reason' => 'Batch not found in Council.'
						);
						$responseData = $this->assessment_response_library->traineeDocumentErrorResponse($emptyArray, $requestData);
					}
				} else {
					$emptyArray = array(
						'reason' => 'Oops!! Something went wrong with API.'
					);
					$responseData = $this->assessment_response_library->traineeDocumentErrorResponse($emptyArray, $requestData);
				}
			}

			$this->response($responseData, REST_Controller::HTTP_OK);
		}
	}



	/**
	 * ! Action: Receive Trainee Father/Mother Details from The Request
	 * ? Method: Post
	 * @param array $this->post()
	 */
	public function update_trainee_details_post()
	{
		// Create an array to store validation errors.
		$emptyArray = array();

		// Set delimiters to validation errors.
		$this->form_validation->set_error_delimiters('', '|');

		// Get data from post request
		$requestData = $this->post();
		$candidates  = $requestData['batchDetails']['candidates'];

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
						'field' => 'batchDetails[candidates][' . $key . '][traineeData][fatherName]',
						'label' => 'Trainee Father Name',
						'rules' => 'trim|required|max_length[150]'
					),
					array(
						'field' => 'batchDetails[candidates][' . $key . '][traineeData][motherName]',
						'label' => 'Trainee Mother Name',
						'rules' => 'trim|required|max_length[150]'
					)
				)
			);
		}

		// Set post data for validation
		$this->form_validation->set_data($requestData);

		// Set validation rules for post data
		$this->form_validation->set_rules(
			array(
				array(
					'field' => 'requestType',
					'label' => 'Request Type',
					'rules' => 'trim|required|alpha'
				),
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
					'rules' => 'trim|required'
				),
				array(
					'field' => 'batchDetails[councilBatchId]',
					'label' => 'Council Batch Id',
					'rules' => 'trim|required'
				),
			)
		);

		if ($this->form_validation->run() == FALSE) {

			$emptyArrayTmp = explode('|', validation_errors());
			array_pop($emptyArrayTmp);

			foreach ($emptyArrayTmp as $key => $value) {
				array_push($emptyArray, array('reason' => $value));
			}

			// Send error response to client
			$responseData = $this->assessment_response_library->traineeDetailsUpdateErrorResponse($emptyArray, $requestData);
			$this->response($responseData, REST_Controller::HTTP_OK);
		} else {
			if (!empty($emptyArray)) {

				// Send error response to client
				$responseData = $this->assessment_response_library->traineeDetailsUpdateErrorResponse($emptyArray, $requestData);
			} else {

				// Insert requested data as a JSON format
				$assessmentJsonData = array(
					"user_batch_code"                => $requestData['batchDetails']['userBatchId'],
					"json_data_type_id_fk"           => 1, // 1: Request & 2: Response
					"council_response_message_id_fk" => 15,
					"council_assessment_json_file"   => json_encode($requestData, true),
					"entry_ip"                       => $this->input->ip_address(),
					"entry_by_login_id_fk"           => NULL,
					"entry_by_stake_id_fk"           => NULL,
					"active_status"                  => 1,
				);
				$assessmentJsonDataId = $this->assessment_batch_model->insertData('council_assessment_json_data', $assessmentJsonData);

				if ($assessmentJsonDataId) {

					$userBatchId    = $requestData['batchDetails']['userBatchId'];
					$councilBatchId = $requestData['batchDetails']['councilBatchId'];

					$batchDetails = $this->assessment_batch_model->getBatchDetails($userBatchId, $councilBatchId);
					if (!empty($batchDetails)) {

						$batch_id_pk = $batchDetails[0]['assessment_batch_id_pk'];
						$errorResponse = 0;

						// ! Starting Transaction
						$this->db->trans_start(); # Starting Transaction

						foreach ($candidates as $key => $value) {

							$insertTraineeDetails = $whereCondition = array();

							$insertTraineeDetails = array(
								'trainee_father_name'      => $value['traineeData']['fatherName'],
								'trainee_mother_name'      	=> $value['traineeData']['motherName'],
								'trainee_details_entry_time' => 'now()',
							);

							$whereCondition = array(
								'assessment_batch_id_fk' => $batch_id_pk,
								'user_trainee_id'           => $value['traineeId']
							);

							$this->assessment_batch_model->updateTraineeDetails($whereCondition, $insertTraineeDetails);
						}

						// ! Completing transaction
						$this->db->trans_complete(); # Completing transaction

						// ! Check All Query For Trainee
						if ($this->db->trans_status() === FALSE) {

							# Something went wrong.
							$this->db->trans_rollback();
							array_push($emptyArray, array('reason' => 'Unable to upload trainee image.'));
						} else {

							# Everything is Perfect. Committing data to the database.
							$this->db->trans_commit();
						}

						if (!empty($emptyArray)) {

							$responseData = $this->assessment_response_library->traineeDetailsUpdateErrorResponse($emptyArray, $requestData);
						} else {

							$responseData = $this->assessment_response_library->traineeDetailsUpdateSuccessResponse($requestData);
						}
					} else {

						$emptyArray = array(
							'reason' => 'Batch not found in Council.'
						);
						$responseData = $this->assessment_response_library->traineeDetailsUpdateErrorResponse($emptyArray, $requestData);
					}
				} else {
					$emptyArray = array(
						'reason' => 'Oops!! Something went wrong with API.'
					);
					$responseData = $this->assessment_response_library->traineeDetailsUpdateErrorResponse($emptyArray, $requestData);
				}
			}

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

	// ! Test cURL function
	public function test_function_post()
	{
		/* $returnData = array(
			"name"    => "Birendra Singh",
			"email"   => "13cse169@gmail.com",
			"mobile"  => "8093855687",
			"companies" => array(
				"Aaaa",
				"Bbbb",
				"Cccc",
			)
		); */

		$returnData = $this->post();

		$this->response($returnData, REST_Controller::HTTP_OK);
	}

	public function port_test_function_post()
	{
		$response_data = $this->post();

		$insertArray = array(
			'user_name'   => $response_data['user_name'],
			'user_mobile' => $response_data['user_mobile'],
			'user_email'  => $response_data['user_email'],
		);

		$this->db->insert('test_api_table', $insertArray);

		$responseArray = array(
			'userID'      => $this->db->insert_id(),
			'userDetails' => $insertArray,
		);

		$this->response($responseArray, REST_Controller::HTTP_OK);
	}

	public function creatBatchSuccessResponseTest_get()
	{
		$requestData = $this->get();
		$batch_id = $requestData['batch_id'];
		$responseData = $this->assessment_response_library->creatBatchSuccessResponse($batch_id);
		$this->response($responseData, REST_Controller::HTTP_OK);
	}
}
