<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apidata
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
     ! Send assigned assessor request to client
     *
     * @param string $map_id		  The map_id to get information about assessor which is assign in the batch (Required)
     * 
     * @return array API's request
     */
    public function assignAssessorData($map_id = NULL)
    {
        if ($map_id) {

            extract($this->CI->assessing_batch_model->assignedAssessorResponse($map_id));

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM3",
                    "msgDetails" => "Assessor Assigned"
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus"  => $batch_details['batch_process_name'],
                        "dateTimes" => array(
                            "assessorAssignDate"     => date("d-m-Y h:i:s", strtotime($batch_details['assessorAssignDate'])),
                            "proposedAssessmentDate" => date("d-m-Y h:i:s", strtotime($batch_details['purpose_assessment_date']))
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
                        "candidates"      => $tranee_details,
                        "assessorDetails" => array(
                            "assessorName" => $batch_details['fname'] . ' ' . $batch_details['lname'],
                            "assessorId"   => $batch_details['assessor_code'],
                            "email"        => $batch_details['email_id'],
                            "mobile"       => $batch_details['mobile_no'],
                            "actionStatus" => array(
                                "statusId"           => $batch_details['assessor_batch_process_id'],
                                "statusName"         => $batch_details['assessor_batch_process_name'],
                                "assessorAssignDate" => date("d-m-Y h:i:s", strtotime($batch_details['assessorAssignDate'])),
                                "assignComments"     => $batch_details['assessor_assign_notes']
                            )
                        )
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

            return $requestArray;
        } else {

            return FALSE;
        }
    }

    /**
     ! Send approved assessor request to client
     *
     * @param string $map_id		  The map_id to get information about assessor which is approve the batch (Required)
     * 
     * @return array API's request
     */
    public function assessorApproveData($map_id)
    {
        if ($map_id) {

            extract($this->CI->assessor_batch_model->assessorApproveResponse($map_id));

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM4",
                    "msgDetails" => "Assessor Approved"
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus"  => $batch_details['batch_process_name'],
                        "dateTimes" => array(
                            "assessorAssignDate"     => date("d-m-Y h:i:s", strtotime($batch_details['assessorAssignDate'])),
                            "proposedAssessmentDate" => date("d-m-Y h:i:s", strtotime($batch_details['proposed_assessment_date'])),
                            "assessorActionDate"     => date("d-m-Y h:i:s", strtotime($batch_details['assessor_confirm_date'])),
                            "finalAssessmentDate"    => NULL
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
                        "candidates"      => $tranee_details,
                        "assessorDetails" => array(
                            "assessorName" => $batch_details['fname'] . ' ' . $batch_details['lname'],
                            "assessorId"   => $batch_details['assessor_code'],
                            "email"        => $batch_details['email_id'],
                            "mobile"       => $batch_details['mobile_no'],
                            "actionStatus" => array(
                                "statusId"           => $batch_details['assessor_batch_process_id'],
                                "statusName"         => $batch_details['assessor_batch_process_name'],
                                "assessorAssignDate" => date("d-m-Y h:i:s", strtotime($batch_details['assessorAssignDate'])),
                                "assignComments"     => $batch_details['assessor_assign_notes']
                            )
                        )
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

            return $requestArray;
        } else {

            return FALSE;
        }
    }

    /**
     ! Send assessment complete request to client
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */
    public function assessmentCompleteData($batch_id = NULL)
    {
        if ($batch_id) {

            extract($this->CI->awarding_batch_model->assessmentCompleteData($batch_id));

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM5",
                    "msgDetails" => "Assessment Completed"
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus"  => $batch_details['batch_process_name'],
                        "dateTimes"          => array(
                            "proposedAssessmentDate"  => date('d-m-Y', strtotime($batch_details["proposed_assessment_date"])),
                            "finalAssessmentDate"     => date('d-m-Y', strtotime($batch_details["proposed_assessment_date"])),
                            "assessmentCompletedDate" => date('d-m-Y', strtotime($batch_details["assessmentCompletedDate"]))
                        ),
                        "assessorDetails" => array(
                            "assessorName" => $batch_details['fname'] . ' ' . $batch_details['lname'],
                            "assessorId"   => $batch_details['assessor_code'],
                            "email"        => $batch_details['email_id'],
                            "mobile"       => $batch_details['mobile_no'],
                            "actionStatus" => array(
                                "statusId"           => $batch_details['batch_process_id'],
                                "statusName"         => $batch_details['batch_process_name'],
                                "assessmentCompletedDate"     => date('d-m-Y', strtotime($batch_details["assessmentCompletedDate"])),
                                "assessmentCompletedComments" => NULL // Not define yet...
                            )
                        )
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

            return $requestArray;
        } else {

            return FALSE;
        }
    }

    /**
     ! Send Marksheet generated response to client
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */
    public function marksheetGeneratedResponseData($batch_id = NULL)
    {
        if ($batch_id) {

            extract($this->CI->awarding_batch_model->marksheetGeneratedResponseData($batch_id));

            $traineeNosDetails = $this->CI->awarding_batch_model->getTraineeNosDetails($tranee_details[0]['assessment_trainee_id_pk']);

            $totalMarks = 0;

            foreach ($traineeNosDetails as $key => $nosDetails) {
                $totalMarks += $nosDetails['nos_theory_marks'] + $nosDetails['nos_practical_marks'] + $nosDetails['nos_viva_marks'];
            }

            $candidatesArray = array();

            foreach ($tranee_details as $key => $trainee) {
                if ($trainee['resultStatusId'] == 1 || $trainee['resultStatusId'] == 2) {

                    $tmpArray = array(
                        'traineeId' => $trainee['traineeId'],
                        'councilTraineeId' => $trainee['councilTraineeId'],
                        'traineeName' => $trainee['traineeName'],
                        'resultStatusId' => $trainee['resultStatusId'],
                        'resultStatusName' => ($trainee['resultStatusId'] == 1) ? 'PASS' : 'FAIL',
                        'totalMarks' => $totalMarks,
                        'marksObtained' => $trainee['marksObtained'],
                        'markSheetLocation' => base_url('admin/assessment/download/marksheet/' . md5($batch_details['user_batch_id']) . '/' . md5($trainee['traineeId']) . '/' . md5($trainee['certificateKey'])),
                        'markSheetKey' => NULL,
                        'resultUploadedOn' => date('d-m-Y H:i:s', strtotime($trainee['certificateGeneratedDate'])),
                    );

                    array_push($candidatesArray, $tmpArray);
                } else {
                    $tmpArray = array(
                        'traineeId' => $trainee['traineeId'],
                        'councilTraineeId' => $trainee['councilTraineeId'],
                        'traineeName' => $trainee['traineeName'],
                        'resultStatusId' => 3,
                        'resultStatusName' => 'ABSENT',
                        'totalMarks' => $totalMarks,
                        'marksObtained' => 0,
                        'markSheetLocation' => NULL,
                        'markSheetKey' => NULL,
                        'resultUploadedOn' => NULL,
                    );

                    array_push($candidatesArray, $tmpArray);
                }
            }

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM6",
                    "msgDetails" => "Mark Sheet Generated"
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus"  => $batch_details['batch_process_name'],
                        "dateTimes" => array(
                            "assessmentApprovalDate" => date('d-m-Y', strtotime($batch_details["batch_marks_status_updated_date"]))
                        ),
                        "assessmentApprovalComments" => $batch_details['batch_marks_status_comment'],
                        "candidates"          => $candidatesArray
                    )
                )
            );

            return $requestArray;
        } else {

            return FALSE;
        }
    }

    /**
     ! Send Certificate generated response to client
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */
    public function certificateGeneratedResponseData($batch_id = NULL)
    {
        if ($batch_id) {

            extract($this->CI->awarding_batch_model->certificateGeneratedResponseData($batch_id));

            $candidatesArray = array();

            foreach ($tranee_details as $key => $trainee) {
                if ($trainee['resultStatusId'] == 1) {

                    $tmpArray = array(
                        'traineeId' => $trainee['traineeId'],
                        'councilTraineeId' => $trainee['councilTraineeId'],
                        'traineeName' => $trainee['traineeName'],
                        'certificateLocation' => base_url('admin/assessment/download/certificate/' . md5($batch_details['user_batch_id']) . '/' . md5($trainee['traineeId']) . '/' . md5($trainee['certificateKey'])),
                        'certificateKey' => NULL,
                        'certificateGeneratedDate' => date('d-m-Y H:i:s', strtotime($trainee['certificateGeneratedDate'])),
                    );

                    array_push($candidatesArray, $tmpArray);
                }
            }

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM7",
                    "msgDetails" => "Certificate Generated"
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus"  => $batch_details['batch_process_name'],
                        "candidates"          => $candidatesArray
                    )
                )
            );

            return $requestArray;
        } else {

            return FALSE;
        }
    }

    /**
     ! Send CSSVSE Batch Data to Council
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */
    public function createCssvseBatchRequestData($batch_id_hash = NULL)
    {
        if ($batch_id_hash) {

            $data = $this->CI->cssvse_batch_model->getPushBatchDetails($batch_id_hash);

            $traineeData = array();
            $traineeImage = array();

            foreach ($data['studentList'] as $key => $student) {
                $tmp_1 = array(
                    'traineeId' => $student['registration_number'],
                    'traineeRegistrationNumber' => $student['registration_number'],
                    'basicDetails' => array(
                        'firstName' => $student['first_name'],
                        'middleName' => $student['middle_name'],
                        'lastName' => $student['last_name'],
                        'guardianName' => $student['guardian_name'],
                        'relationWithGuardian' => $student['guardian_relationship'],
                        'gender' => $student['gender_description'],
                        'dob' => date('d-m-Y', strtotime($student['date_of_birth'])),
                        'caste' => $student['caste'],
                        'religion' => $student['religion'],
                        'attendancePercentage' => 0
                    ),
                    'contactDetails' => array(
                        'mobileNumber' => $student['mobile'],
                        'email' => $student['email'],
                        'communicationAddress' => array(
                            'stateName' => $student['state_name'],
                            'stateId' => $student['state_id_pk'],
                            'districtName' => $student['district_name'],
                            'districtId' => $student['lgd_code'],
                            'blockMunicipalityName' => $student['block_municipality_name'],
                            'blockMunicipalityId' => $student['municipality_lgd_code'],
                            'pinCode' => $student['pin'],
                            'address1' => $student['address']
                        )
                    )
                );
                array_push($traineeData, $tmp_1);

                $tmp_2 = array(
                    'traineeId' => $student['registration_number'],
                    'traineeRegistrationNumber' => $student['registration_number'],
                    'documents' => array(
                        'photo' => $student['image']
                    )
                );
                array_push($traineeImage, $tmp_2);
            }

            $batchArray = array(
                "requestType" => "BatchCreate",
                "verticalId" => "CSSVSE",
                "verticalName" => "CSS-VSE",
                "assessmentSchemeName" => "CSSVSE - Short Term Training (STT)",
                "assessmentSchemeId" => "3",
                "batchDetails" => array(
                    "userBatchId" => $data['batchDetails']['user_batch_id'],
                    "batchStartDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_start_date'])),
                    "batchEndDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_end_date'])),
                    "batchTentativeAssessmentDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_tentative_date'])),
                    "batchSize" => $data['batchDetails']['batch_size'],
                    "status" => 'Approved',
                    "dateTimes" => array(
                        "preferedAssessmentDate1" => date('d-m-Y', strtotime($data['batchDetails']['prefered_assessment_date_1'])),
                        "preferedAssessmentDate2" => date('d-m-Y', strtotime($data['batchDetails']['prefered_assessment_date_2']))
                    ),
                    "jobRoles" => array(
                        "courseDetails" => array(
                            "courseName" => $data['batchDetails']['course_name'],
                            "courseCode" => $data['batchDetails']['course_code'],
                            "courseDesc" => $data['batchDetails']['course_description'],
                            "courseRate" => $data['batchDetails']['course_rate'],
                            "courseDuration" => $data['batchDetails']['course_duration']
                        ),
                        "sectorDetails" => array(
                            "sectorId" => $data['batchDetails']['sector_code'],
                            "sectorName" => $data['batchDetails']['sector_name']
                        )
                    ),
                    "candidates" => $traineeData,
                ),
                "tpDetails" => array(
                    "userTpId" => $data['batchDetails']['udise_code'],
                    "userTpName" => $data['batchDetails']['school_name'],
                    "TrainingPartnerType" => "School",
                    "contactDetails" => array(
                        "mobileNumber" => $data['batchDetails']['school_mobile'],
                        "email" => $data['batchDetails']['school_email'],
                        "communicationAddress" => array(
                            "stateName" => $data['batchDetails']['state_name'],
                            "stateId" => $data['batchDetails']['state_id_pk'],
                            "districtName" => $data['batchDetails']['district_name'],
                            "districtId" => $data['batchDetails']['district_lgd_code'],
                            "blockMunicipalityName" => $data['batchDetails']['block_municipality_name'],
                            "pinCode" => $data['batchDetails']['pin_code'],
                            "address1" => $data['batchDetails']['school_address']
                        ),
                        "spoc" => array(
                            "spocName" => $data['batchDetails']['hoi_name'],
                            "mobileNumber" => $data['batchDetails']['hoi_mobile'],
                            "email" => $data['batchDetails']['hoi_email']
                        )
                    )
                ),
                "tcDetails" => array(
                    "userTcId" => $data['batchDetails']['udise_code'],
                    "userTcName" => $data['batchDetails']['school_name'],
                    "contactDetails" => array(
                        "mobileNumber" => $data['batchDetails']['school_mobile'],
                        "email" => $data['batchDetails']['school_email'],
                        "communicationAddress" => array(
                            "stateName" => $data['batchDetails']['state_name'],
                            "stateId" => $data['batchDetails']['state_id_pk'],
                            "districtName" => $data['batchDetails']['district_name'],
                            "districtId" => $data['batchDetails']['district_lgd_code'],
                            "blockMunicipalityName" => $data['batchDetails']['block_municipality_name'],
                            "pinCode" => $data['batchDetails']['pin_code'],
                            "address1" => $data['batchDetails']['school_address'],
                            "landmark" => $data['batchDetails']['school_address']
                        ),
                        "spoc" => array(
                            "spocName" => $data['batchDetails']['hoi_name'],
                            "mobileNumber" => $data['batchDetails']['hoi_mobile'],
                            "email" => $data['batchDetails']['hoi_email']
                        ),
                        "location" => array(
                            "longitude" => 0000,
                            "latitude" => 0000
                        )
                    )
                )
            );

            $traineeDocumentArray = array(
                'requestType' => 'TraineeDocument',
                'verticalId' => 'CSSVSE',
                'verticalName' => 'CSS-VSE',
                'batchDetails' => array(
                    'userBatchId' => $data['batchDetails']['user_batch_id'],
                    'councilBatchId' => NULL,
                    'candidates' => $traineeImage
                )
            );

            return array(
                'batchArray' => $batchArray,
                'traineeDocumentArray' => $traineeDocumentArray
            );
        } else {

            return FALSE;
        }
    }

    // ! SEND ASSESSMENT COMPLETED RESPONSE
    public function sendAssessmentCompletedResponseDatas($batch_id = NULL)
    {
        if ($batch_id) {

            extract($this->CI->assessor_batch_model->assessmentCompleteData($batch_id));

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM5",
                    "msgDetails" => "Assessment Completed"
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "councilBatchStatus"  => $batch_details['batch_process_name'],
                        "dateTimes"          => array(
                            "proposedAssessmentDate"  => date('d-m-Y', strtotime($batch_details["proposed_assessment_date"])),
                            "finalAssessmentDate"     => date('d-m-Y', strtotime($batch_details["proposed_assessment_date"])),
                            "assessmentCompletedDate" => date('d-m-Y', strtotime($batch_details["assessmentCompletedDate"]))
                        ),
                        "assessorDetails" => array(
                            "assessorName" => $batch_details['fname'] . ' ' . $batch_details['lname'],
                            "assessorId"   => $batch_details['assessor_code'],
                            "email"        => $batch_details['email_id'],
                            "mobile"       => $batch_details['mobile_no'],
                            "actionStatus" => array(
                                "statusId"           => $batch_details['batch_process_id'],
                                "statusName"         => $batch_details['batch_process_name'],
                                "assessmentCompletedDate"     => date('d-m-Y', strtotime($batch_details["assessmentCompletedDate"])),
                                "assessmentCompletedComments" => 'Assessment completed by: ' . $batch_details['fname'] . ' ' . $batch_details['lname'] . ' on ' . date('d-m-Y', strtotime($batch_details["assessmentCompletedDate"])) . '.'
                            )
                        )
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

            return $requestArray;
        } else {

            return FALSE;
        }
    }

    /**
        ! Send Changed Proposed Date request to client
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */

    public function changeProposedDateResponseData($batch_id = NULL)
    {

        if ($batch_id) {

            extract($this->CI->assessing_batch_model->assessmentProposedDateData($batch_id));

            $requestArray = array(
                "verticalId"  => $batch_details['vertical_code'],
                "responseMsg" => array(
                    "type"       => "SUCCESSS",
                    "code"       => "SM12",
                    "msgDetails" => "Reschedule Assessment Date Response."
                ),
                "data" => array(
                    "verticalName"         => $batch_details['vertical_name'],
                    "assessmentSchemeName" => $batch_details['assessment_scheme_name'],
                    "assessmentSchemeId"   => $batch_details['assessment_scheme_id_fk'],
                    "councilBatchDetails"  => array(
                        "userBatchId"         => $batch_details['user_batch_id'],
                        "councilBatchId"      => $batch_details['assessment_batch_id_pk'],
                        "dateTimes"          => array(
                            "newBatchStartDate"          => date('d-m-Y', strtotime($batch_details["batch_start_date"])),
                            "newBatchEndDate"          => date('d-m-Y', strtotime($batch_details["batch_end_date"])),
                            "newProposedAssessmentDate"  => date('d-m-Y', strtotime($batch_details["proposed_assessment_date"]))
                        ),

                    ),

                )
            );

            return $requestArray;
        } else {
            return FALSE;
        }
    }
	
	
	/**
     ! Send VTC Batch Data to Council
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */
    public function createVtcBatchRequestData($batch_id_hash = NULL)
    {
        if ($batch_id_hash) {

            $data = $this->CI->batch_model->getPushBatchDetails($batch_id_hash);

            $traineeData = array();
            $traineeImage = array();

            foreach ($data['studentList'] as $key => $student) {
                $tmp_1 = array(
                    'traineeId' => $student['registration_number'],
                    'traineeRegistrationNumber' => $student['registration_number'],
                    'basicDetails' => array(
                        'firstName' => $student['first_name'],
                        'middleName' => $student['middle_name'],
                        'lastName' => $student['last_name'],
                        'guardianName' => $student['guardian_name'],
                        'motherName' => $student['mothers_name'],
                        'relationWithGuardian' => $student['guardian_relationship'],
                        'gender' => $student['gender_description'],
                        'dob' => date('d-m-Y', strtotime($student['date_of_birth'])),
                        'caste' => $student['caste'],
                        'religion' => $student['religion'],
                        'attendancePercentage' => 0
                    ),
                    'contactDetails' => array(
                        'mobileNumber' => $student['mobile'],
                        'email' => $student['email'],
                        'communicationAddress' => array(
                            'stateName' => $student['state_name'],
                            'stateId' => $student['state_id_pk'],
                            'districtName' => $student['district_name'],
                            'districtId' => $student['lgd_code'],
                            'blockMunicipalityName' => $student['block_municipality_name'],
                            'blockMunicipalityId' => $student['municipality_lgd_code'],
                            'pinCode' => $student['pin'],
                            'address1' => $student['address']
                        )
                    )
                );
                array_push($traineeData, $tmp_1);

                $tmp_2 = array(
                    'traineeId' => $student['registration_number'],
                    'traineeRegistrationNumber' => $student['registration_number'],
                    'documents' => array(
                        'photo' => $student['image']
                    )
                );
                array_push($traineeImage, $tmp_2);
            }
            //echo '<pre>'; print_r($data['batchDetails']); die;
            //added by ATREYEE
            if($data['batchDetails']['assessment_scheme_id_fk'] == '7') {
                $SchemeName = 'XII+';
            } else {
                $SchemeName = 'VII+';
            }
            $batchArray = array(
                "requestType" => "BatchCreate",
                "verticalId" => "VTC",
                "verticalName" => "VTC",
               // "assessmentSchemeName" => "VIII+",
               // "assessmentSchemeId" => "4",assessment_scheme_id_fk
                 "assessmentSchemeName" => $SchemeName , //EDITED BY ATREYEE
                "assessmentSchemeId" => $data['batchDetails']['assessment_scheme_id_fk'],

                "batchDetails" => array(
                    "userBatchId" => $data['batchDetails']['user_batch_id'],
                    "batchStartDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_start_date'])),
                    "batchEndDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_end_date'])),
                    "batchTentativeAssessmentDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_tentative_date'])),
                    "batchSize" => $data['batchDetails']['batch_size'],
                    "status" => 'Approved',
                    "dateTimes" => array(
                        "preferedAssessmentDate1" => date('d-m-Y', strtotime($data['batchDetails']['prefered_assessment_date_1'])),
                        "preferedAssessmentDate2" => date('d-m-Y', strtotime($data['batchDetails']['prefered_assessment_date_2']))
                    ),
                    "jobRoles" => array(
                        "courseDetails" => array(
                            "courseName" => $data['batchDetails']['course_name'],
                            "courseCode" => $data['batchDetails']['course_code'],
                            "courseDesc" => $data['batchDetails']['course_description'],
                            "courseRate" => $data['batchDetails']['course_rate'],
                            "courseDuration" => $data['batchDetails']['course_duration']
                        ),
                        "sectorDetails" => array(
                            "sectorId" => $data['batchDetails']['sector_code'],
                            "sectorName" => $data['batchDetails']['sector_name']
                        )
                    ),
                    "candidates" => $traineeData,
                ),
                "tpDetails" => array(
                    "userTpId" => $data['batchDetails']['udise_code'],
                    "userTpName" => $data['batchDetails']['school_name'],
                    "TrainingPartnerType" => "VTC",
                    "contactDetails" => array(
                        "mobileNumber" => $data['batchDetails']['school_mobile'],
                        "email" => $data['batchDetails']['school_email'],
                        "communicationAddress" => array(
                            "stateName" => $data['batchDetails']['state_name'],
                            "stateId" => $data['batchDetails']['state_id_pk'],
                            "districtName" => $data['batchDetails']['district_name'],
                            "districtId" => $data['batchDetails']['district_lgd_code'],
                            "blockMunicipalityName" => $data['batchDetails']['block_municipality_name'],
                            "pinCode" => $data['batchDetails']['pin_code'],
                            "address1" => $data['batchDetails']['school_address']
                        ),
                        "spoc" => array(
                            "spocName" => $data['batchDetails']['hoi_name'],
                            "mobileNumber" => $data['batchDetails']['hoi_mobile'],
                            "email" => $data['batchDetails']['hoi_email']
                        )
                    )
                ),
                "tcDetails" => array(
                    "userTcId" => $data['batchDetails']['udise_code'],
                    "userTcName" => $data['batchDetails']['school_name'],
                    "contactDetails" => array(
                        "mobileNumber" => $data['batchDetails']['school_mobile'],
                        "email" => $data['batchDetails']['school_email'],
                        "communicationAddress" => array(
                            "stateName" => $data['batchDetails']['state_name'],
                            "stateId" => $data['batchDetails']['state_id_pk'],
                            "districtName" => $data['batchDetails']['district_name'],
                            "districtId" => $data['batchDetails']['district_lgd_code'],
                            "blockMunicipalityName" => $data['batchDetails']['block_municipality_name'],
                            "pinCode" => $data['batchDetails']['pin_code'],
                            "address1" => $data['batchDetails']['school_address'],
                            "landmark" => $data['batchDetails']['school_address']
                        ),
                        "spoc" => array(
                            "spocName" => $data['batchDetails']['hoi_name'],
                            "mobileNumber" => $data['batchDetails']['hoi_mobile'],
                            "email" => $data['batchDetails']['hoi_email']
                        ),
                        "location" => array(
                            "longitude" => 0000,
                            "latitude" => 0000
                        )
                    )
                )
            );

            $traineeDocumentArray = array(
                'requestType' => 'TraineeDocument',
                'verticalId' => 'VTC',
                'verticalName' => 'VTC',
                'batchDetails' => array(
                    'userBatchId' => $data['batchDetails']['user_batch_id'],
                    'councilBatchId' => NULL,
                    'candidates' => $traineeImage
                )
            );
            //echo '<pre>'; print_r($batchArray); die;
            return array(
                'batchArray' => $batchArray,
                'traineeDocumentArray' => $traineeDocumentArray
            );
        } else {

            return FALSE;
        }
    }



    /**
     ! Send Organization Batch Data to Council
     *
     * @param string $batch_id		  The batch_id to get all information in the batch (Required)
     * 
     * @return array API's request
     */
    public function createOrganizationBatchRequestData($batch_id_hash = NULL)
    {
        //echo $batch_id_hash;exit;
        if ($batch_id_hash) {

            $data = $this->CI->organization_batch_model->getPushBatchDetails($batch_id_hash);
            //echo "<pre>";print_r($data);exit;
            $traineeData = array();
            $traineeImage = array();

            foreach ($data['studentList'] as $key => $student) {
                $tmp_1 = array(
                    'traineeId' => $student['registration_number'],
                    'traineeRegistrationNumber' => $student['registration_number'],
                    'basicDetails' => array(
                        'firstName' => $student['first_name'],
                        'middleName' => $student['middle_name'],
                        'lastName' => $student['last_name'],
                        'fatherName' => $student['father_name'],
                        'guardianName' => $student['guardian_name'],
                        'motherName' => $student['mother_name'],
                        'relationWithGuardian' => $student['guardian_relationship'],
                        'gender' => $student['gender_id_pk'],
                        'dob' => date('d-m-Y', strtotime($student['dob'])),
                        //'caste' => $student['caste'],
                        //'religion' => $student['religion'],
                        'attendancePercentage' => 0
                    ),
                    'contactDetails' => array(
                        'mobileNumber' => $student['mob_no'],
                        'email' => $student['email_id'],
                        'communicationAddress' => array(
                            'stateName' => $student['state_name'],
                            'stateId' => $student['state_id_pk'],
                            'districtName' => $student['district_name'],
                            'districtId' => $student['lgd_code'],
                            'blockMunicipalityName' => $student['block_municipality_name'],
                            'blockMunicipalityId' => $student['municipality_lgd_code'],
                            'pinCode' => $student['pin_code'],
                            'address1' => $student['street_vill_town'].','.$student['post_office'].','.$student['police_station']
                        )
                    )
                );
                array_push($traineeData, $tmp_1);

                $tmp_2 = array(
                    'traineeId' => $student['registration_number'],
                    'traineeRegistrationNumber' => $student['registration_number'],
                    'documents' => array(
                        'photo' => $student['image']
                    )
                );
                array_push($traineeImage, $tmp_2);
            }
            //echo '<pre>'; print_r($data['batchDetails']); die;
            //added by ATREYEE
            if($data['batchDetails']['assessment_scheme_id_fk'] == '9') {
                $SchemeName = 'PDCL';
            } 
            $batchArray = array(
                "requestType" => "BatchCreate",
                "verticalId" => $data['studentList'][0]['vertical_code'],
                "verticalName" => $data['studentList'][0]['vertical_code'],
               // "assessmentSchemeName" => "VIII+",
               // "assessmentSchemeId" => "4",assessment_scheme_id_fk
                 "assessmentSchemeName" => $SchemeName , //EDITED BY ATREYEE
                "assessmentSchemeId" => $data['batchDetails']['assessment_scheme_id_fk'],

                "batchDetails" => array(
                    "userBatchId" => $data['batchDetails']['user_batch_id'],
                    "batchStartDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_start_date'])),
                    "batchEndDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_end_date'])),
                    "batchTentativeAssessmentDate" => date('d-m-Y', strtotime($data['batchDetails']['batch_tentative_date'])),
                    "batchSize" => $data['batchDetails']['batch_size'],
                    "status" => 'Approved',
                    "dateTimes" => array(
                        "preferedAssessmentDate1" => date('d-m-Y', strtotime($data['batchDetails']['prefered_assessment_date_1'])),
                        "preferedAssessmentDate2" => date('d-m-Y', strtotime($data['batchDetails']['prefered_assessment_date_2']))
                    ),
                    "jobRoles" => array(
                        "courseDetails" => array(
                            "courseName" => $data['batchDetails']['course_name'],
                            "courseCode" => $data['batchDetails']['course_code'],
                            "courseDesc" => $data['batchDetails']['course_description'],
                            "courseRate" => $data['batchDetails']['course_rate'],
                            "courseDuration" => $data['batchDetails']['course_duration']
                        ),
                        "sectorDetails" => array(
                            "sectorId" => $data['batchDetails']['sector_code'],
                            "sectorName" => $data['batchDetails']['sector_name']
                        )
                    ),
                    "candidates" => $traineeData,
                ),
                "tpDetails" => array(
                    "userTpId" => $data['batchDetails']['udise_code'],
                    "userTpName" => $data['batchDetails']['school_name'],
                    "TrainingPartnerType" => "VTC",
                    "contactDetails" => array(
                        "mobileNumber" => $data['batchDetails']['school_mobile'],
                        "email" => $data['batchDetails']['school_email'],
                        "communicationAddress" => array(
                            "stateName" => $data['batchDetails']['state_name'],
                            "stateId" => $data['batchDetails']['state_id_pk'],
                            "districtName" => $data['batchDetails']['district_name'],
                            "districtId" => $data['batchDetails']['district_lgd_code'],
                            "blockMunicipalityName" => $data['batchDetails']['block_municipality_name'],
                            "pinCode" => $data['batchDetails']['pin_code'],
                            "address1" => $data['batchDetails']['street_vill_town'].','.$student['post_office'].','.$student['police_station']
                           
                        ),
                        "spoc" => array(
                            "spocName" => $data['batchDetails']['spoc_name'],
                            "mobileNumber" => $data['batchDetails']['spoc_mobile'],
                            "email" => $data['batchDetails']['spoc_email']
                        )
                    )
                ),
                "tcDetails" => array(
                    "userTcId" => $data['batchDetails']['udise_code'],
                    "userTcName" => $data['batchDetails']['school_name'],
                    "contactDetails" => array(
                        "mobileNumber" => $data['batchDetails']['school_mobile'],
                        "email" => $data['batchDetails']['school_email'],
                        "communicationAddress" => array(
                            "stateName" => $data['batchDetails']['state_name'],
                            "stateId" => $data['batchDetails']['state_id_pk'],
                            "districtName" => $data['batchDetails']['district_name'],
                            "districtId" => $data['batchDetails']['district_lgd_code'],
                            "blockMunicipalityName" => $data['batchDetails']['block_municipality_name'],
                            "pinCode" => $data['batchDetails']['pin_code'],
                            "address1" => $data['batchDetails']['street_vill_town'].','.$student['post_office'].','.$student['police_station'],
                           
                            "landmark" => $data['batchDetails']['street_vill_town']
                        ),
                        "spoc" => array(
                            "spocName" => $data['batchDetails']['spoc_name'],
                            "mobileNumber" => $data['batchDetails']['spoc_mobile'],
                            "email" => $data['batchDetails']['spoc_email']
                        ),
                        "location" => array(
                            "longitude" => $data['batchDetails']['longititude'],
                            "latitude" => $data['batchDetails']['latitude']
                        )
                    )
                )
            );

            $traineeDocumentArray = array(
                'requestType' => 'TraineeDocument',
                'verticalId' => $data['studentList'][0]['vertical_code'],
                'verticalName' => $data['studentList'][0]['vertical_code'],
                'batchDetails' => array(
                    'userBatchId' => $data['batchDetails']['user_batch_id'],
                    'councilBatchId' => NULL,
                    'candidates' => $traineeImage
                )
            );
            //echo '<pre>'; print_r($batchArray); die;
            return array(
                'batchArray' => $batchArray,
                'traineeDocumentArray' => $traineeDocumentArray
            );
        } else {

            return FALSE;
        }
    }
	
}

/* End of file Apidata.php */