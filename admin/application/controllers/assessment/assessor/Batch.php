<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Batch extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(53);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('assessment/assessor_batch_model');
        $this->load->helper('email');

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . 'assets/js/datepicker.js',
            5 => $this->config->item('theme_uri') . 'assessment/assessor_batch.js',
        );
    }

    // ! List all assigned batch list
    public function index($offset = 0)
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');

        $config['base_url']         = 'assessment/assessor/batch/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->assessor_batch_model->getTraineeBatchCount()[0]['count'];
        $config['per_page']         = 25;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open']    = '<li class="">';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '<i class="fa fa-backward"></i>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fa fa-forward"></i>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $data['page_links']  = $this->pagination->create_links();
        $data['batch_list']  = $this->assessor_batch_model->getAllTraineeBatch($config['per_page'], $offset);

        // parent::pre($data['batch_list']);
        $this->load->view($this->config->item('theme') . 'assessment/assessor/batch_list_view', $data);
    }

    // ! View details of assessment
    public function details($map_id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($map_id_hash != NULL) {

                $result = $this->assessor_batch_model->getTraineeBatch($map_id_hash);
                $data = array(
                    'batch_details'  => $result['batch_details'],
                    'tranee_details' => $result['tranee_details']
                );

                // parent::pre($data);
                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessor/ajax/batch_details_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // ! View details of assessment for batch approve inability
    public function batch_approve_inability($map_id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if ($map_id_hash != NULL) {

                $result = $this->assessor_batch_model->getBatchDetailsForApproveInability($map_id_hash);
                $data = array(
                    'batch_details'  => $result,
                    'map_id_hash'    => $map_id_hash
                );

                // parent::pre($data);
                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessor/ajax/approve_inability_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // ! Update batch confirmation
    public function batchConfirmation()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $batch_notes   = $this->input->get('batch_notes');
            $batch_status  = $this->input->get('batch_status');
            $map_id_hash   = $this->input->get('map_id_hash');
            $batch_id_hash = $this->input->get('batch_id_hash');

            if ($map_id_hash != NULL && $batch_id_hash != NULL) {

                if ($batch_status != NULL) {

                    if ($batch_notes == NULL) {

                        echo json_encode('notes');
                    } else {

                        $login_assessor_id = $this->session->userdata('stake_details_id_fk');
                        $batch_info        = $this->assessor_batch_model->getBasicBatchInformation($batch_id_hash, $login_assessor_id)[0];

                        if ($batch_status == 'approve') {

                            $process_id_fk = 9;
                            $active_status = 1;
                            $status_html   = '<small class="label label-info">Assessor Approved <i class="fa fa-check" aria-hidden="true"></i></small>';

                            $update_array = array(
                                'active_status'          => $active_status,
                                'process_id_fk'          => $process_id_fk,
                                'assessor_confirm_notes' => ($batch_notes) ? $batch_notes : NULL,
                                'assessor_confirm_date'  => date('Y-m-d')
                            );

                            $map_update_status = $this->assessor_batch_model->updateBatchAssessorMap($map_id_hash, $update_array);

                            if ($map_update_status) {

                                $batch_update_status = $this->assessor_batch_model->updateAssessmentBatchDetails($batch_id_hash, array('process_id_fk' => 9));

                                // ! Prepare post data for api call
                                $this->load->library('apidata');

                                $batch_map_data = $this->assessor_batch_model->getBatchMapData($map_id_hash);
                                $assessorApproveResponse = $this->apidata->assessorApproveData($batch_map_data[0]['assessment_batch_assessor_map_id_pk']);

                                $json_data_array = array(
                                    'user_batch_code'              => $batch_info['user_batch_id'],
                                    'json_data_type_id_fk'         => 2,
                                    'council_response_message_id_fk' => 4,
                                    'council_assessment_json_file' => json_encode($assessorApproveResponse, TRUE),
                                    'entry_ip'                     => $this->input->ip_address(),
                                    'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                    'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                    'active_status'                => 1
                                );
                                $json_data_id = $this->assessor_batch_model->insertAssessmentjsonData($json_data_array);

                                // ! API Call for assessor is assigned
                                $this->load->config('wbsctvesd_api_config');
                                $url = $this->config->item('assessor_assign_url')[$batch_info['vertical_code']];

                                $this->load->library('curl');
                                $curl_response = $this->curl->curl_make_post_request($url, $assessorApproveResponse);

                                if (!$curl_response) {

                                    $this->assessor_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                                }

                                // ! Send email to TC for assessor assigned
                                $emailBatchData = $this->assessor_batch_model->getBatchDetailsForTcMail($batch_id_hash);
                                $email_message  = $this->load->view($this->config->item('theme') . 'assessment/assessor/email_template_for_tc_assigned_assessor', $emailBatchData, TRUE);
                                send_email($emailBatchData['tc_email'], $email_message, "Assessor Assigned To Batch");

                                echo json_encode('done');
                            } else {

                                echo json_encode('unable');
                            }
                        } else {

                            $process_id_fk = 10;
                            $active_status = 0;
                            $status_html   = '<small class="label label-danger">Assessor Inability <i class="fa fa-times" aria-hidden="true"></i></small>';

                            if (strlen(str_replace(' ', '', $batch_notes)) < 10) {

                                echo json_encode('notes100');
                                exit();
                            } else {

                                $update_array = array(
                                    'active_status'          => $active_status,
                                    'process_id_fk'          => $process_id_fk,
                                    'assessor_confirm_notes' => ($batch_notes) ? $batch_notes : NULL,
                                    'assessor_confirm_date'  => date('Y-m-d')
                                );

                                // ! Find another assessor for the batch
                                $this->load->library('assessment');
                                $assessor_data = $this->assessment->assignAssessor($batch_info);

                                if (!empty($assessor_data)) {

                                    $map_array = array(
                                        'assessment_batch_id_fk'  => $batch_info['assessment_batch_id_pk'],
                                        'assessor_id_fk'              => $assessor_data['assessor_id_fk'],
                                        'purpose_assessment_date' => $assessor_data['assinged_date'],
                                        'active_status'                => 1,
                                        'entry_by_id_fk'               => $this->session->userdata('stake_holder_login_id_pk'),
                                        'entry_ip'                   => $this->input->ip_address(),
                                        'assessor_assign_notes'   => NULL,
                                        'process_id_fk'             => 8,
                                        'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                                    );
                                    $map_id = $this->assessor_batch_model->createBatchAssessorMap($map_array);

                                    if ($map_id) {

                                        $map_update_status = $this->assessor_batch_model->updateBatchAssessorMap($map_id_hash, $update_array);
                                        if ($map_update_status) {

                                            $update_status = $this->assessor_batch_model->updateAssessmentBatchDetails($batch_id_hash, array('proposed_assessment_date' => $assessor_data['assinged_date']));

                                            // ! Send email to assessor
                                            $assignedAssessorResponse = $this->assessor_batch_model->assignedAssessorResponse($map_id);

                                            $email_data = array(
                                                'assessor_details' => array(
                                                    'fname' => $assignedAssessorResponse['batch_details']['fname'],
                                                    'lname' => $assignedAssessorResponse['batch_details']['lname']
                                                ),
                                                'batch_details' => array(
                                                    'sector_code' => $assignedAssessorResponse['batch_details']['sector_code'],
                                                    'sector_name' => $assignedAssessorResponse['batch_details']['sector_name'],
                                                    'course_code' => $assignedAssessorResponse['batch_details']['course_code'],
                                                    'course_name' => $assignedAssessorResponse['batch_details']['course_name']
                                                )
                                            );
                                            $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessor/assessor_assign_email_template', $email_data, TRUE);
                                            send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                                            echo json_encode('inability');
                                        }
                                    } else {

                                        echo json_encode('unable');
                                    }
                                } else {

                                    echo json_encode('unable');
                                }
                            }
                        }
                    }
                } else {

                    echo json_encode('status');
                }
            }
        }
    }

    // ! Update batch confirmation
    public function batchConfirmation_OLD()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $batch_notes   = $this->input->get('batch_notes');
            $batch_status  = $this->input->get('batch_status');
            $map_id_hash   = $this->input->get('map_id_hash');
            $batch_id_hash = $this->input->get('batch_id_hash');

            if ($map_id_hash != NULL && $batch_id_hash != NULL) {

                if ($batch_status != NULL) {

                    if ($batch_notes == NULL) {

                        echo json_encode('notes');
                    } else {

                        if ($batch_status == 'approve') {

                            $process_id_fk = 9;
                            $active_status = 1;
                            $status_html   = '<small class="label label-info">Assessor Approved <i class="fa fa-check" aria-hidden="true"></i></small>';
                        } else {

                            $process_id_fk = 10;
                            $active_status = 0;
                            $status_html   = '<small class="label label-danger">Assessor Inability <i class="fa fa-times" aria-hidden="true"></i></small>';

                            if (strlen(str_replace(' ', '', $batch_notes)) < 10) {

                                echo json_encode('notes100');
                                exit();
                            }
                        }

                        $update_array = array(
                            'active_status'          => $active_status,
                            'process_id_fk'          => $process_id_fk,
                            'assessor_confirm_notes' => ($batch_notes) ? $batch_notes : NULL,
                            'assessor_confirm_date'  => date('Y-m-d')
                        );

                        $result = $this->assessor_batch_model->updateBatchAssessorMap($map_id_hash, $update_array);

                        if ($result) {

                            if ($process_id_fk == 9) {

                                $update_status = $this->assessor_batch_model->updateAssessmentBatchDetails($batch_id_hash, array('process_id_fk' => 9));

                                /* 
                                    * ============================================= *
                                    !   Send assessor asigned data to the client    ! 
                                    * ============================================= *
                                */
                                // ! Prepare post data for api call
                                $this->load->library('apidata');

                                $batch_map_data = $this->assessor_batch_model->getBatchMapData($map_id_hash);
                                $assessorApproveResponse = $this->apidata->assessorApproveData($batch_map_data[0]['assessment_batch_assessor_map_id_pk']);

                                $login_assessor_id = $this->session->userdata('stake_details_id_fk');
                                $batch_info        = $this->assessor_batch_model->getBasicBatchInformation($batch_id_hash, $login_assessor_id)[0];

                                $json_data_array = array(
                                    'user_batch_code'              => $batch_info['user_batch_id'],
                                    'json_data_type_id_fk'         => 2,
                                    'council_assessment_json_file' => json_encode($assessorApproveResponse, TRUE),
                                    'entry_ip'                     => $this->input->ip_address(),
                                    'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                    'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                    'active_status'                => 1
                                );
                                $json_data_id = $this->assessor_batch_model->insertAssessmentjsonData($json_data_array);

                                // ! API Call for assessor is assigned
                                $this->load->config('wbsctvesd_api_config');
                                $url = $this->config->item('assessor_assign_url')[$batch_info['vertical_code']];

                                $this->load->library('curl');
                                $curl_response = $this->curl->curl_make_post_request($url, $assessorApproveResponse);

                                if (!$curl_response) {

                                    $this->assessor_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                                }

                                // ! Send email to TC for assessor assigned
                                $emailBatchData = $this->assessor_batch_model->getBatchDetailsForTcMail($batch_id_hash);
                                $email_message  = $this->load->view($this->config->item('theme') . 'assessment/assessor/email_template_for_tc_assigned_assessor', $emailBatchData, TRUE);
                                send_email($emailBatchData['tc_email'], $email_message, "Assessor Assigned To Batch");
                            } else {

                                $this->assignAssessor($batch_id_hash);

                                echo json_encode('inability');
                                exit();
                            }

                            $response_array = array(
                                'map_id_hash' => $map_id_hash,
                                'status_html' => $status_html,
                            );
                            echo json_encode($response_array);
                        }
                    }
                } else {

                    echo json_encode('status');
                }
            }
        }
    }

    public function testAssessorEmail($batch_id_hash = NULL)
    {
        // ! Send email to TC for assessor assigned
        $emailBatchData = $this->assessor_batch_model->getBatchDetailsForTcMail($batch_id_hash);
        $email_message  = $this->load->view($this->config->item('theme') . 'assessment/assessor/email_template_for_tc_assigned_assessor', $emailBatchData, TRUE);
        $status = send_email('birendra.singh.5070276@gmail.com', $email_message, "Assessor Assigned To Batch");

        echo var_dump($status);
    }

    public function dateDiffInDays($date1, $date2)
    {
        // Calculating the difference in timestamps
        $diff = strtotime($date2) - strtotime($date1);

        // 1 day = 24 hours
        // 24 * 60 * 60 = 86400 seconds
        return abs(round($diff / 86400));
    }

    // ! Assign Assessor
    public function assignAssessor($batch_id_hash = NULL)
    {
        $login_assessor_id = $this->session->userdata('stake_details_id_fk');
        $batch_info        = $this->assessor_batch_model->getBasicBatchInformation($batch_id_hash, $login_assessor_id)[0];

        $getDate     = $assingedDate = $assessor_id_fk = '';
        $check_array = array(
            'course_id'       => $batch_info['course_id_pk'],
            'district_id'     => $batch_info['district_id_pk'],
            'assessment_date' => $batch_info['prefered_assessment_date_1']
        );

        // ! 5 Days logic
        /* $current_date = new DateTime(date('Y-m-d'));
        $assment_date = new DateTime($batch_info['prefered_assessment_date_1']);

        $diff_date = $current_date->diff($assment_date)->format("%r%a"); */

        $diff_date = $this->dateDiffInDays($batch_info['prefered_assessment_date_1'], date('Y-m-d'));

        if ($diff_date < 5) {

            $check_array['assessment_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day'));
        }
        // ! END

        $assingedDate   = $check_array['assessment_date'];
        $assessor_id_fk = $this->findAssessor($check_array);

        if ($assessor_id_fk == NULL) {
            // ! Find assessor for prefered assessment date 2
            // ! 5 Days logic
            /*  $current_date = new DateTime(date('Y-m-d'));
            $assment_date = new DateTime($batch_info['prefered_assessment_date_2']);

            $diff_date = $current_date->diff($assment_date)->format("%r%a"); */

            $diff_date = $this->dateDiffInDays($batch_info['prefered_assessment_date_2'], date('Y-m-d'));

            if ($diff_date < 5) {

                $check_array['assessment_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day'));
            } else {

                $check_array['assessment_date'] = $batch_info['prefered_assessment_date_2'];
            }
            // ! END

            $assingedDate   = $check_array['assessment_date'];
            $assessor_id_fk = $this->findAssessor($check_array);

            if ($assessor_id_fk == NULL) {

                // ! Find assessor on next 60 days

                $startDate = new DateTime($batch_info['prefered_assessment_date_1']);
                // $endDate   = new DateTime($result['prefered_assessment_date_1']);
                $endDate   = new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day')));
                $oneDay    = new DateInterval("P1D");

                $endDate->modify("+60 days");

                $holiDays = $this->assessor_batch_model->getHolidays($startDate->format("Y-m-d"), $endDate->format("Y-m-d"));

                foreach (new DatePeriod($startDate, $oneDay, $endDate->add($oneDay)) as $day) {

                    $dayNum  = $day->format("N");
                    $dayDate = $day->format("Y-m-d");

                    // ! Excluding Saturday, Sunday & Holiday
                    // if (($dayNum < 6) && (!in_array($dayDate, $holiDays))) {
                    if (!in_array($dayDate, $holiDays)) {

                        $check_array['assessment_date'] = $dayDate;
                        $assessor_id_fk = $this->findAssessor($check_array);

                        if ($assessor_id_fk != NULL) {

                            $assingedDate = $dayDate;
                            break;
                        }
                    }
                }
            }
        }

        if ($assessor_id_fk != '') {

            $map_array = array(
                'assessment_batch_id_fk'  => $batch_info['assessment_batch_id_pk'],
                'assessor_id_fk'          => $assessor_id_fk,
                'purpose_assessment_date' => $assingedDate,
                'active_status'           => 1,
                'entry_by_id_fk'          => $this->session->userdata('stake_holder_login_id_pk'),
                'entry_ip'                => $this->input->ip_address(),
                'assessor_assign_notes'   => NULL,
                'process_id_fk'           => 8,
                'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
            );

            $map_id = $this->assessor_batch_model->createBatchAssessorMap($map_array);

            if ($map_id) {

                $update_status = $this->assessor_batch_model->updateAssessmentBatchDetails($batch_id_hash, array('proposed_assessment_date' => $assingedDate));

                // Send email to assessor
                $assignedAssessorResponse = $this->assessor_batch_model->assignedAssessorResponse($map_id);

                $email_data = array(
                    'assessor_details' => array(
                        'fname' => $assignedAssessorResponse['batch_details']['fname'],
                        'lname' => $assignedAssessorResponse['batch_details']['lname']
                    ),
                    'batch_details' => array(
                        'sector_code' => $assignedAssessorResponse['batch_details']['sector_code'],
                        'sector_name' => $assignedAssessorResponse['batch_details']['sector_name'],
                        'course_code' => $assignedAssessorResponse['batch_details']['course_code'],
                        'course_name' => $assignedAssessorResponse['batch_details']['course_name']
                    )
                );
                $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessor/assessor_assign_email_template', $email_data, TRUE);
                send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");
            }
        } else {

            $update_status = $this->assessor_batch_model->updateAssessmentBatchDetails(
                $batch_id_hash,
                array(
                    'flag_assessor_inability_status' => 1,
                    'process_id_fk' => 10
                )
            );
        }
    }

    //  ! Find Assessor to assign in Batch
    private function findAssessor($check_array = NULL)
    {
        $check_result   = $this->assessor_batch_model->checkAssessor($check_array);
        $assessor_id_fk = NULL;

        if (!empty($check_result)) {

            $assessor_id_fk = $check_result[0]['assessor_id_fk'];
        } else {

            $map_district = $this->assessor_batch_model->getMapDistrict($check_array['district_id']);

            if (!empty($map_district)) {

                $map_district = array_column($map_district, 'district_map_id_fk');

                $check_array = array(
                    'course_id'       => $check_array['course_id'],
                    'district_ids'    => $map_district,
                    'assessment_date' => $check_array['assessment_date']
                );

                $check_result = $this->assessor_batch_model->checkAssessorForAnotherDistrict($check_array);

                if (!empty($check_result)) {

                    $assessor_id_fk = $check_result[0]['assessor_id_fk'];
                }
            }
        }

        return $assessor_id_fk;
    }

    // ! Download document of Trainee Attendence List
    public function downloadTraineeAttendenceList($map_id_hash = NULL)
    {
        $result = $this->assessor_batch_model->getTraineeBatchForPdf($map_id_hash);

        if (!empty($result['nos_details'])) {
            // parent::pre($result);
            // $this->load->view($this->config->item('theme') . 'assessment/assessor/download_trainee_attendence_list_view', $result);

            $html   = $this->load->view($this->config->item('theme') . 'assessment/assessor/download_trainee_attendence_list_view', $result, true);

            //this the the PDF filename that user will get to download
            $pdfFilePath = $result['batch_details']['vertical_code'] . "-" . date('Ymd') . "-Trainee-Attendence-List.pdf";

            //load mPDF library
            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
            $this->m_pdf->pdf->showWatermarkText = true;

            $this->m_pdf->pdf->WriteHTML($html);

            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
        } else {

            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Course NoS not entered, Please contact council admin.');

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! Download document of Trainee Marks List
    public function downloadTraineeMarksList($map_id_hash = NULL)
    {
        $result = $this->assessor_batch_model->getTraineeBatchForPdf($map_id_hash);

        if (!empty($result['nos_details'])) {
            // parent::pre($result);
            // $this->load->view($this->config->item('theme') . 'assessment/assessor/download_trainee_marks_list_view', $result);

            $html   = $this->load->view($this->config->item('theme') . 'assessment/assessor/download_trainee_marks_list_view', $result, true);

            //this the the PDF filename that user will get to download
            $pdfFilePath = $result['batch_details']['vertical_code'] . "-" . date('Ymd') . "-Trainee-Marks-List.pdf";

            //load mPDF library
            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
            $this->m_pdf->pdf->showWatermarkText = true;

            $this->m_pdf->pdf->WriteHTML($html);

            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
        } else {

            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Course NoS not entered, Please contact council admin.');

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! Download Assessment Question List
    public function question_list_download($map_id_hash = NULL)
    {
        $mapQuestionList = $this->assessor_batch_model->getMapQuestionList($map_id_hash);
        if (empty($mapQuestionList)) {

            $result = $this->assessor_batch_model->prepairQuestionList($map_id_hash);
            if ($result) {

                foreach ($result as $key => $value) {

                    $questionArray[] = array(
                        'assessment_batch_id_fk' => $value['assessment_batch_id_pk'],
                        'nos_id_fk'              => $value['course_marks_id_pk'],
                        'question_list'          => $value['question_id_list'],
                        'entry_by_login_id_fk'   => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_ip'               => $this->input->ip_address(),
                        'active_status'          => 1,
                    );
                }

                $this->assessor_batch_model->insertMapQuestionList($questionArray);
                $mapQuestionList = $this->assessor_batch_model->getMapQuestionList($map_id_hash);
            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Question not uploaded yet, Please contact admin.');

                redirect('admin/assessment/assessor/batch', 'refresh');

                exit();
            }
        }

        if (!empty($mapQuestionList)) {
            $nosList = array();

            foreach ($mapQuestionList as $key => $value) {

                $questionIds  = explode(',', $value['question_list']);
                $nosQuestions = $this->assessor_batch_model->getQuestionListForPdf($value['nos_id_fk'], $questionIds);

                array_push($nosList, $nosQuestions);
            }
            $batchDetails   = $this->assessor_batch_model->getBasicBatchDetails($map_id_hash);

            $question = array_column($nosList, 'nos_wise_no_of_theory_question');
            $marks    = array_column($nosList, 'no_of_marks_each_question_carries');

            $total_marks = 0;
            foreach ($question as $key => $value) {
                $total_marks = ($total_marks + ($value * $marks[$key]));
            }

            $data = array(
                'batch_details' => $batchDetails,
                'nos_list'      => $nosList,
                'total_marks'   => $total_marks
            );

            /* echo '<pre>';
            print_r($data);
            exit(); */
            // $this->load->view($this->config->item('theme') . 'assessment/assessor/download_question_list_view', $data);

            $html   = $this->load->view($this->config->item('theme') . 'assessment/assessor/download_question_list_view', $data, true);

            //this the the PDF filename that user will get to download
            $pdfFilePath = $batchDetails['vertical_code'] . $batchDetails['assessment_batch_id_pk'] . ".pdf";

            //load mPDF library
            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
            $this->m_pdf->pdf->showWatermarkText = true;

            $this->m_pdf->pdf->WriteHTML($html);

            //download it.
            // $this->m_pdf->pdf->Output($pdfFilePath, "I");
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
        } else {

            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Question not uploaded yet, Please contact admin.');

            redirect('admin/assessment/assessor/batch', 'refresh');

            exit();
        }
    }

    // ! View all trainee list
    public function trainee_list($map_id_hash = NULL)
    {
        if ($map_id_hash != NULL) {

            $data['tranee_list'] = $this->assessor_batch_model->getTraineeList($map_id_hash);
            $data['map_id_hash'] = $map_id_hash;


            if ($data['tranee_list'][0]['assessment_scheme_id_fk'] == 3) {
                $data['batch_type'] = "CSSVSE";
            } else {

                $batch_code = $data['tranee_list'][0]['user_batch_id'];
                if (strpos($batch_code, 'ORG') !== false) {
                    $data['batch_type'] = "ORG";
                } else {
                    $data['batch_type'] = "PBSSD";
                }
            }

            $this->load->view($this->config->item('theme') . 'assessment/assessor/trainee_list_view', $data);
        } else {

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! Mark Trainee Attendance as Present
    public function attendance_status($trainee_id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($trainee_id_hash != NULL) {

                $tranee_details = $this->assessor_batch_model->getTraineeByIdHash($trainee_id_hash);
                if (!empty($tranee_details)) {

                    $tranee_details = $tranee_details[0];

                    $trainee_attendance_data = array(
                        'assessment_batch_id_fk'   => $tranee_details['assessment_batch_id_fk'],
                        'trainee_id_fk'                => $tranee_details['assessment_trainee_id_pk'],
                        'trainee_in_time'            => NULL,
                        'trainee_in_time'            => 'now()',
                        'active_status'               => 1,
                        'process_id_fk'               => 1,
                        'attendance_by_assessor' => 1,
                        'assessor_id_fk'              => $this->session->userdata('stake_details_id_fk'),
                    );

                    $result = $this->assessor_batch_model->insertTraineeAttendance($trainee_attendance_data);
                    if ($result) {

                        $n_a = '<span class="badge bg-orange">N/A</span>';

                        $upload_marks = '<a href="' . base_url('admin/assessment/assessor/batch/upload_marks/' . md5($tranee_details['assessment_trainee_id_pk'])) . '" class="btn btn-success btn-xs btn-block">Upload Marks</a>';

                        $responseArray = array(
                            'n_a' => $n_a,
                            'upload_marks' => $upload_marks
                        );

                        echo json_encode($responseArray);
                    }
                }
            }
        }
    }

    // ! Upload marks of assessment for trainee
    public function upload_marks($trainee_id_hash = NULL)
    {
        if ($trainee_id_hash != NULL) {

            $data['course_details']  = $this->assessor_batch_model->getCourseDetails($trainee_id_hash)[0];
            $data['course_marks']    = $this->assessor_batch_model->getCourseMarksDetails($trainee_id_hash);
            $data['trainee_marks']   = $this->assessor_batch_model->getTraineeMarksDetails($data['course_details']['assessment_batch_id_pk'], $trainee_id_hash);
            // parent::pre($data);

            foreach ($data['course_marks'] as $key => $nos) {
                if ($this->input->server("REQUEST_METHOD") == 'POST') {

                    $data['theory_marks'][$nos['course_marks_id_pk']]    = set_value('theory_marks[' . $nos['course_marks_id_pk'] . ']');
                    $data['practical_marks'][$nos['course_marks_id_pk']] = set_value('practical_marks[' . $nos['course_marks_id_pk'] . ']');
                    $data['viva_marks'][$nos['course_marks_id_pk']]      = set_value('viva_marks[' . $nos['course_marks_id_pk'] . ']');
                    $data['total_marks'][$nos['course_marks_id_pk']]     = set_value('total_marks[' . $nos['course_marks_id_pk'] . ']');
                } else {

                    if (!empty($data['trainee_marks'])) {

                        $traineeResult = $this->assessor_batch_model->getTraineeResultByNos($data['course_details']['assessment_batch_id_pk'], $trainee_id_hash, $nos['course_marks_id_pk'])[0];

                        $data['theory_marks'][$nos['course_marks_id_pk']]    = $traineeResult['theory_marks'];
                        $data['practical_marks'][$nos['course_marks_id_pk']] = $traineeResult['practical_marks'];
                        $data['viva_marks'][$nos['course_marks_id_pk']]      = $traineeResult['viva_marks'];
                        $data['total_marks'][$nos['course_marks_id_pk']]     = $traineeResult['total_marks'];
                    } else {
                        $data['theory_marks'][$nos['course_marks_id_pk']]    = NULL;
                        $data['practical_marks'][$nos['course_marks_id_pk']] = NULL;
                        $data['viva_marks'][$nos['course_marks_id_pk']]      = NULL;
                        $data['total_marks'][$nos['course_marks_id_pk']]     = NULL;
                    }
                }
            }

            if ($this->input->server("REQUEST_METHOD") == "POST") {

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                if ($this->input->post('theory_marks') != '' && count($this->input->post('theory_marks')) > 0) {
                    foreach ($this->input->post('theory_marks') as $key => $value) {

                        $config = array(
                            array(
                                'field'     => 'theory_marks[' . $key . ']',
                                'label'     => '<b>Theory Marks</b>',
                                'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]|less_than_equal_to[' . $this->input->post('nos_theory_marks')[$key] . ']',
                            ),
                            array(
                                'field'     => 'practical_marks[' . $key . ']',
                                'label'     => '<b>Practical Marks</b>',
                                'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]|less_than_equal_to[' . $this->input->post('nos_practical_marks')[$key] . ']',
                            )
                        );

                        $marksData = $this->assessor_batch_model->getCourseMarksById($key)[0];
                        if ($marksData['nos_viva_marks'] != 0 && $marksData['nos_viva_marks'] != NULL) {

                            $config[] = array(
                                'field'     => 'viva_marks[' . $key . ']',
                                'label'     => '<b>Viva Marks</b>',
                                'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]|less_than_equal_to[' . $this->input->post('nos_viva_marks')[$key] . ']',
                            );
                        }

                        $this->form_validation->set_rules($config);
                    }

                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view($this->config->item('theme') . 'assessment/assessor/upload_trainee_marks_view', $data);
                    } else {

                        $traineeResultArray = array();
                        $totalTraineeMarks  = $failInAnyNos = 0;

                        foreach ($this->input->post('theory_marks') as $key => $value) {

                            $theory    = ($this->input->post('theory_marks')[$key])    ? $this->input->post('theory_marks')[$key]    : 0;
                            $practical = ($this->input->post('practical_marks')[$key]) ? $this->input->post('practical_marks')[$key] : 0;
                            $viva      = ($this->input->post('viva_marks')[$key])      ? $this->input->post('viva_marks')[$key]      : 0;

                            $tmpArray = array(
                                'assessment_batch_id_fk' => $this->input->post('batchIdPk'),
                                'course_marks_id_fk'     => $key,
                                'trainee_id_fk'          => $this->input->post('traineeIdPk'),
                                'theory_marks'           => $theory,
                                'practical_marks'        => $practical,
                                'viva_marks'             => ($viva != 0) ? $viva : NULL,
                                'total_marks'            => ($theory + $practical + $viva),
                                'active_status'          => 1,
                                'entry_by_login_id_fk'   => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_ip'               => $this->input->ip_address()
                            );

                            // ! Check trainee NOS result
                            // ? 1: PASS, 2: FAIL, 3: ABSENT

                            $totalTraineeMarks = ($tmpArray['total_marks'] + $totalTraineeMarks);
                            $traineeNosResult  = 1; // 1: PASS, 2: FAIL, 3: ABSENT
                            $nosDetails        = array();
                            $nosTotalMarks     = 0;

                            // ! Getting NoS Details
                            foreach ($data['course_marks'] as $nosKey => $nosDetails) {
                                if ($nosDetails['course_marks_id_pk'] == $key) {
                                    $nosDetails = $nosDetails;

                                    $nos_theory    = ($nosDetails['nos_theory_marks'])    ? $nosDetails['nos_theory_marks']    : 0;
                                    $nos_practical = ($nosDetails['nos_practical_marks']) ? $nosDetails['nos_practical_marks'] : 0;
                                    $nos_viva      = ($nosDetails['nos_viva_marks'])      ? $nosDetails['nos_viva_marks']      : 0;

                                    $nosTotalMarks = ($nos_theory + $nos_practical + $nos_viva);
                                    break;
                                }
                            }

                            // ! Check for Theory Marks
                            if (($nosDetails['theory_pass_marks'] != 0) && ($nosDetails['theory_pass_marks'] != NULL)) {

                                $theoryPassMarks = (($nosDetails['nos_theory_marks'] * $nosDetails['theory_pass_marks']) / 100);

                                if ($tmpArray['theory_marks'] < $theoryPassMarks) {

                                    $traineeNosResult  = 2;
                                }
                            }

                            // ! Check for Practical Marks
                            if (($traineeNosResult != 2) && ($nosDetails['practical_pass_marks'] != 0) && ($nosDetails['practical_pass_marks'] != NULL)) {

                                $practicalPassMarks = (($nosDetails['nos_practical_marks'] * $nosDetails['practical_pass_marks']) / 100);

                                if ($tmpArray['practical_marks'] < $practicalPassMarks) {

                                    $traineeNosResult  = 2;
                                }
                            }

                            // ! Check for Viva Marks
                            if (($nosDetails['nos_viva_marks'] != 0) && ($nosDetails['nos_viva_marks'] != NULL)) {

                                if (($traineeNosResult != 2) && ($nosDetails['viva_pass_marks'] != 0) && ($nosDetails['viva_pass_marks'] != NULL)) {

                                    $vivaPassMarks = (($nosDetails['nos_viva_marks'] * $nosDetails['viva_pass_marks']) / 100);

                                    if ($tmpArray['viva_marks'] < $vivaPassMarks) {

                                        $traineeNosResult  = 2;
                                    }
                                }
                            }

                            // ! Check for NoS Marks
                            if (($traineeNosResult != 2) && ($nosDetails['pass_marks_for_each_nos'] != 0) && ($nosDetails['pass_marks_for_each_nos'] != NULL)) {

                                $nosPassMarks = (($nosTotalMarks * $nosDetails['pass_marks_for_each_nos']) / 100);

                                if ($tmpArray['total_marks'] < $nosPassMarks) {

                                    $traineeNosResult  = 2;
                                }
                            }

                            $tmpArray['nos_result'] = $traineeNosResult;

                            if ($traineeNosResult == 2) {
                                $failInAnyNos = 2;
                            }

                            // ! END trainee result checking


                            if (!empty($data['trainee_marks'])) {

                                $whereArray = array(
                                    'assessment_batch_id_fk' => $data['course_details']['assessment_batch_id_pk'],
                                    'trainee_id_fk'          => $data['course_details']['assessment_trainee_id_pk'],
                                    'course_marks_id_fk'     => $key,
                                );

                                unset($tmpArray['assessment_batch_id_fk']);
                                unset($tmpArray['course_marks_id_fk']);
                                unset($tmpArray['trainee_id_fk']);

                                $tmpArray['update_time'] = 'now()';

                                $this->assessor_batch_model->updateTraineeMarks($whereArray, $tmpArray);
                            } else {

                                array_push($traineeResultArray, $tmpArray);
                            }
                        }

                        if (!empty($data['trainee_marks'])) {

                            $result = 1;
                        } else {

                            $result = $this->assessor_batch_model->batchInsertTraineeResult($traineeResultArray);
                        }
                        if ($result) {

                            // ! Check final result of trainee
                            $traineeUpdateArray = array('total_marks' => $totalTraineeMarks);
                            if ($failInAnyNos != 2) {

                                if ($totalTraineeMarks >= $nosDetails['total_pass_marks']) {
                                    $traineeUpdateArray['exam_result'] = 1;
                                } else {
                                    $traineeUpdateArray['exam_result'] = 2;
                                }
                            } else {
                                $traineeUpdateArray['exam_result'] = 2;
                            }
                            $this->assessor_batch_model->updateTraineeResult($this->input->post('traineeIdPk'), $traineeUpdateArray);

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Trainee marks uploaded for assessment successfully.');
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                        }

                        redirect('admin/assessment/assessor/batch/trainee_list/' . md5($data['course_details']['assessment_batch_assessor_map_id_pk']), 'refresh');
                    }
                } else {
                    redirect('admin/assessment/assessor/batch', 'refresh');
                }
            } else {

                $this->load->view($this->config->item('theme') . 'assessment/assessor/upload_trainee_marks_view', $data);
            }
        } else {

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    //  ! finalize trainee marks for assessment
    public function finalize_marks($map_id_hash = NULL)
    {
        if ($map_id_hash != NULL) {

            $data['tranee_list'] = $this->assessor_batch_model->getTraineeList($map_id_hash);
            $data['map_id_hash'] = $map_id_hash;

            $batch_code = $data['tranee_list'][0]['user_batch_id'];

            if ($this->input->server("REQUEST_METHOD") == "POST") {

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                $this->form_validation->set_rules('assessment_doc', 'Assessment Doc', 'trim|callback_file_validation[assessment_doc|application/pdf|500|required]');

                if (strpos($batch_code, 'ORG') == true) {
                    $this->form_validation->set_rules('attendance_doc', 'Attendance Doc', 'trim|callback_file_validation[attendance_doc|application/pdf|500|required]');
                }

                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'assessment/assessor/trainee_list_view', $data);
                } else {

                    $updateArray = array(
                        'process_id_fk'                => 12,
                        'flag_finalize_assessment'     => 2,
                        'finalize_assessment_date'     => date('Y-m-d'),
                        'assessment_completed_date'    => date('Y-m-d'),
                        'finalize_assessment_ip'       => $this->input->ip_address(),
                        'finalize_assessment_login_id' => $this->session->userdata('stake_holder_login_id_pk'),
                        'assessment_doc'               => base64_encode(file_get_contents($_FILES["assessment_doc"]['tmp_name'])),
                        'flag_batch_marks_status'      => NULL,
                    );

                    if ($_FILES["attendance_doc"]['tmp_name'] != '') {
                        $updateArray['attendance_doc'] = base64_encode(file_get_contents($_FILES["attendance_doc"]['tmp_name']));
                    }

                    $result = $this->assessor_batch_model->updateAssessmentBatchDetails(md5($data['tranee_list'][0]['assessment_batch_id_fk']), $updateArray);

                    if ($result) {
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Trainee marks successfully submited.');
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    }

                    redirect('admin/assessment/assessor/batch/trainee_list/' . $data['map_id_hash'], 'refresh');
                }
            } else {
                redirect('admin/assessment/assessor/batch', 'refresh');
            }
        } else {

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! Upload marks of assessment for trainee
    public function upload_marks_OLD($map_id_hash = NULL)
    {
        if ($map_id_hash != NULL) {

            $result = $this->assessor_batch_model->getTraineeBatchForUploadMarks($map_id_hash);

            if (!empty($result)) {

                $data = array(
                    'batch_details'  => $result['batch_details'],
                    'tranee_details' => $result['tranee_details']
                );

                foreach ($data['tranee_details'] as $trainee) {
                    if ($this->input->server("REQUEST_METHOD") == 'POST') {

                        $data['total_marks'][$trainee['assessment_trainee_id_pk']] = set_value('traineeTotalMarks[' . $trainee['assessment_trainee_id_pk'] . ']');
                        $data['practical_marks'][$trainee['assessment_trainee_id_pk']] = set_value('traineePracticalMarks[' . $trainee['assessment_trainee_id_pk'] . ']');
                        $data['theory_marks'][$trainee['assessment_trainee_id_pk']] = set_value('traineeTheoryMarks[' . $trainee['assessment_trainee_id_pk'] . ']');
                    } else {

                        $data['total_marks'][$trainee['assessment_trainee_id_pk']] = $trainee['total_marks'];
                        $data['practical_marks'][$trainee['assessment_trainee_id_pk']] = $trainee['practical_marks'];
                        $data['theory_marks'][$trainee['assessment_trainee_id_pk']] = $trainee['theory_marks'];
                    }
                }

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                if ($this->input->server("REQUEST_METHOD") == 'POST') {

                    if ($this->input->post('traineeTheoryMarks') != '' && count($this->input->post('traineeTheoryMarks')) > 0) {
                        foreach ($this->input->post('traineeTheoryMarks') as $key => $value) {

                            $config = array(
                                array(
                                    'field'     => 'traineeTheoryMarks[' . $key . ']',
                                    'label'     => '<b>Theory Marks</b>',
                                    'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]|less_than_equal_to[' . $this->input->post('theoryMarks') . ']',
                                ),
                                array(
                                    'field'     => 'traineePracticalMarks[' . $key . ']',
                                    'label'     => '<b>Practical Marks</b>',
                                    'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]|less_than_equal_to[' . $this->input->post('practicalMarks') . ']',
                                ),
                                array(
                                    'field'     => 'traineeTotalMarks[' . $key . ']',
                                    'label'     => '<b>Total Marks</b>',
                                    'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                                )
                            );

                            $this->form_validation->set_rules($config);
                        }

                        if ($result['batch_details']['flag_finalize_assessment'] == '') {
                            $this->form_validation->set_rules('assessment_doc', 'Assessment Doc', 'trim|callback_file_validation[assessment_doc|application/pdf|100|required]');
                        }
                    } else {
                        echo 'Oops.! Something went wrong in trainee & practical theory marks. Go back & retry.';
                    }

                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view($this->config->item('theme') . 'assessment/upload_marks_view', $data);
                    } else {

                        $traineeResultArray    = array();
                        $traineeTheoryMarks    = $this->input->post('traineeTheoryMarks');
                        $traineePracticalMarks = $this->input->post('traineePracticalMarks');
                        $traineeTotalMarks     = $this->input->post('traineeTotalMarks');

                        foreach ($traineeTheoryMarks as $key => $value) {

                            $tp = (100 * $traineeTheoryMarks[$key]) / $result['batch_details']['theory_marks'];
                            $pp = (100 * $traineePracticalMarks[$key]) / $result['batch_details']['practical_marks'];

                            if (($tp >= $result['batch_details']['theory_percentage']) && ($pp >= $result['batch_details']['practical_percentage'])) {

                                $trainee_exam_status = 1;
                            } else {

                                $trainee_exam_status = 2;
                            }

                            $tmpArray = array(
                                'assessment_batch_id_fk' => $result['batch_details']['assessment_batch_id_pk'],
                                'trainee_id_fk'          => $key,
                                'theory_marks'           => $traineeTheoryMarks[$key],
                                'practical_marks'        => $traineePracticalMarks[$key],
                                'total_marks'            => $traineeTotalMarks[$key],
                                'trainee_exam_status'    => $trainee_exam_status,
                                'active_status'          => 1,
                                'process_id_fk'          => 1,
                                'entry_by_login_id_fk'   => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_ip'               => $this->input->ip_address()
                            );

                            if ($result['batch_details']['flag_finalize_assessment'] == 1) {

                                $whereArray = array(
                                    'assessment_batch_id_fk' => $result['batch_details']['assessment_batch_id_pk'],
                                    'trainee_id_fk'          => $key
                                );

                                unset($tmpArray['assessment_batch_id_fk']);
                                unset($tmpArray['trainee_id_fk']);

                                $tmpArray['update_time'] = 'now()';

                                $this->assessor_batch_model->updateTraineeMarks($whereArray, $tmpArray);
                            } else {

                                array_push($traineeResultArray, $tmpArray);
                            }
                        }

                        if ($result['batch_details']['flag_finalize_assessment'] == 1) {

                            $traineeResultStatus = 1;
                        } else {

                            $traineeResultStatus = $this->assessor_batch_model->batchInsertTraineeResult($traineeResultArray);
                        }


                        if ($traineeResultStatus) {

                            if ($this->input->post('saveUploadMarks') == 2) {

                                $updateArray = array(
                                    'process_id_fk'                => 12,
                                    'flag_finalize_assessment'     => 2,
                                    'finalize_assessment_date'     => date('Y-m-d'),
                                    'assessment_completed_date'    => date('Y-m-d'),
                                    'finalize_assessment_ip'       => $this->input->ip_address(),
                                    'finalize_assessment_login_id' => $this->session->userdata('stake_holder_login_id_pk'),
                                );

                                if ($_FILES["assessment_doc"]['tmp_name'] != '') {
                                    $updateArray['assessment_doc'] = base64_encode(file_get_contents($_FILES["assessment_doc"]['tmp_name']));
                                }
                            } else {

                                $updateArray = array(
                                    'flag_finalize_assessment' => 1,
                                );

                                if ($_FILES["assessment_doc"]['tmp_name'] != '') {
                                    $updateArray['assessment_doc'] = base64_encode(file_get_contents($_FILES["assessment_doc"]['tmp_name']));
                                }
                            }

                            $this->assessor_batch_model->updateAssessmentBatchDetails(md5($result['batch_details']['assessment_batch_id_pk']), $updateArray);

                            if ($this->input->post('saveUploadMarks') == 2) {
                                /* 
                                * ============================================= *
                                !   Send assessment complete data to the client    ! 
                                * ============================================= *
                                */
                                // ! Prepare post data for api call
                                $this->load->library('apidata');

                                $batch_map_data = $this->assessor_batch_model->getBatchMapData($map_id_hash);
                                $assessmentCompleteRequestData = $this->apidata->assessorCompleteData($result['batch_details']['assessment_batch_id_pk']);

                                $json_data_array = array(
                                    'user_batch_code'              => $result['batch_details']['user_batch_id'],
                                    'json_data_type_id_fk'         => 2,
                                    'council_assessment_json_file' => json_encode($assessmentCompleteRequestData, TRUE),
                                    'entry_ip'                     => $this->input->ip_address(),
                                    'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                    'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                    'active_status'                => 1
                                );
                                $json_data_id = $this->assessor_batch_model->insertAssessmentjsonData($json_data_array);

                                // ! API Call for assessor is assigned
                                $this->load->config('wbsctvesd_api_config');
                                $url = $this->config->item('assessor_assign_url')[$result['batch_details']['vertical_code']];

                                $this->load->library('curl');
                                $curl_response = $this->curl->curl_make_post_request($url, $assessmentCompleteRequestData);

                                if (!$curl_response) {

                                    $this->assessor_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                                }
                            }

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Trainee marks uploaded for assessment successfully.');
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                        }

                        redirect('admin/assessment/assessor/batch/upload_marks/' . md5($result['batch_details']['assessment_batch_assessor_map_id_pk']), 'refresh');
                    }
                } else {

                    $this->load->view($this->config->item('theme') . 'assessment/upload_marks_view', $data);
                }
            } else {

                redirect('admin/assessment/assessor/batch', 'refresh');
            }
        } else {

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! Upload marks of assessment for trainee
    public function view_trainee_marks($batch_id_hash = NULL)
    {
        if ($batch_id_hash != NULL) {

            $data['batch_id_hash']  = $batch_id_hash;
            $data['tranee_details'] = $this->assessor_batch_model->getTraineeMarks($batch_id_hash);

            $batch_code = $data['tranee_details'][0]['user_batch_id'];

            if (strpos($batch_code, 'ORG') !== false) {
                $data['batch_type'] = "ORG";
            } else {
                $data['batch_type'] = "PBSSD";
            }

            $this->load->view($this->config->item('theme') . 'assessment/assessor/trainee_marks_details_view', $data);
        } else {

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! Download marks of assessment for trainee
    public function download_trainee_marks($batch_id_hash = NULL)
    {
        if ($batch_id_hash != NULL) {

            $data['batch_id_hash']  = $batch_id_hash;
            $data['batch_details']   = $this->assessor_batch_model->getBatchDetailsForTraineeMarksPdf($batch_id_hash);
            $data['tranee_details'] = $this->assessor_batch_model->getTraineeMarks($batch_id_hash);

            // parent::pre($data);
            // $this->load->view($this->config->item('theme') . 'assessment/assessor/download_trainee_marks_view', $data);


            $html = $this->load->view($this->config->item('theme') . 'assessment/assessor/download_trainee_marks_view', $data, true);

            //this the the PDF filename that user will get to download
            $pdfFilePath = $data['batch_details']['vertical_code'] . "-" . date('Ymd') . "-Trainee-Marks.pdf";

            //load mPDF library
            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
            $this->m_pdf->pdf->showWatermarkText = true;

            $this->m_pdf->pdf->WriteHTML($html);

            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
        } else {

            redirect('admin/assessment/assessor/batch', 'refresh');
        }
    }

    // ! File validation function
    public function file_validation($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);

        if ($file_array[1] == "application/pdf") {
            $ext = "PDF";
        } elseif ($file_array[1] == "image/jpeg") {
            $ext = "JPG";
        }
        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'The max size is ' . $file_array[2] . ' KB  for Document.');

                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'The Document file type must be ' . $ext);

                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required.');

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'The Document file is required.');

                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
    }

    // ! Mark Batch as Inability
    public function markApprovedBatchInability()
    {
        $map_id_hash = $this->input->get('batch_map_id_hash');
        $inability_reason = $this->input->get('batchInabilityReason');

        if (!empty($map_id_hash) && !empty($inability_reason)) {

            $this->load->library('assessment');

            $login_assessor_id = $this->session->userdata('stake_details_id_fk');
            $batch_info        = $this->assessor_batch_model->getBasicMapBatchInformation($map_id_hash, $login_assessor_id)[0];

            $assessor_data = $this->assessment->assignAssessor($batch_info);
            if (!empty($assessor_data)) {

                $map_array = array(
                    'assessment_batch_id_fk'  => $batch_info['assessment_batch_id_pk'],
                    'assessor_id_fk'              => $assessor_data['assessor_id_fk'],
                    'purpose_assessment_date' => $assessor_data['assinged_date'],
                    'active_status'                => 1,
                    'entry_by_id_fk'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_ip'                   => $this->input->ip_address(),
                    'assessor_assign_notes'   => NULL,
                    'process_id_fk'             => 8,
                    'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                );
                $map_id = $this->assessor_batch_model->createBatchAssessorMap($map_array);

                if ($map_id) {

                    $batch_details_update_array = array(
                        'process_id_fk'          => 8,
                        'proposed_assessment_date' => $assessor_data['assinged_date'],
                    );

                    $update_status = $this->assessor_batch_model->updateAssessmentBatchDetails(md5($batch_info['assessment_batch_id_pk']), $batch_details_update_array);

                    $assessor_map_update_array = array(
                        'active_status'          => 0,
                        'process_id_fk'          => 10,
                        'approved_batch_inability_reason' => $inability_reason,
                        'approved_batch_inability_date'  => date('Y-m-d'),
                        'approved_batch_inability_status' => 1,
                    );

                    $map_update_status = $this->assessor_batch_model->updateBatchAssessorMap($map_id_hash, $assessor_map_update_array);
                    if ($map_update_status) {

                        // ! Send email to assessor
                        $assignedAssessorResponse = $this->assessor_batch_model->assignedAssessorResponse($map_id);

                        $email_data = array(
                            'assessor_details' => array(
                                'fname' => $assignedAssessorResponse['batch_details']['fname'],
                                'lname' => $assignedAssessorResponse['batch_details']['lname']
                            ),
                            'batch_details' => array(
                                'sector_code' => $assignedAssessorResponse['batch_details']['sector_code'],
                                'sector_name' => $assignedAssessorResponse['batch_details']['sector_name'],
                                'course_code' => $assignedAssessorResponse['batch_details']['course_code'],
                                'course_name' => $assignedAssessorResponse['batch_details']['course_name']
                            )
                        );

                        $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessor/assessor_assign_email_template', $email_data, TRUE);
                        // send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                        echo json_encode('done');
                    }
                } else {

                    echo json_encode('unable');
                }
            } else {

                echo json_encode('unable');
            }
        }
    }

    public function updateTraineeProfilePic($id_hash = NULL)
    {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $batch_id_hash = $this->input->post('batch_id');
            $assessorMapId  = $this->assessor_batch_model->getAssessorMapId($batch_id_hash)[0];


            // print_r(md5($assessorMapId['assessment_batch_assessor_map_id_pk']));exit;


            $file_validation_err = 0;
            $max_size = 502400; // 100KB Size

            if ($_FILES['profile_pic']['name'] != '') {

                $file_name = $_FILES['profile_pic']['name'];
                $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                if ($_FILES['profile_pic']['size'] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                    $file_validation_err = 1;
                    $data['file_error'] = "Max 100 kb and JPG/JPEG";
                } else {
                    $profile_pic = base64_encode(file_get_contents($_FILES["profile_pic"]['tmp_name']));
                }
            }

            if ($file_validation_err == 0) {

                $updateArray = array(
                    'image_uploaded_by'           => $this->session->userdata('stake_details_id_fk'),
                    'trainee_image'      => $profile_pic,
                    'image_entry_time' => date('Y-m-d H:i:s'),
                );
                // echo "<pre>";print_r($updateArray);exit;
                $this->assessor_batch_model->updateTraineeProfilePic($id_hash, $updateArray);
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Profile Image Uploaded Successfully');

                redirect(base_url('admin/assessment/assessor/batch/trainee_list/' . md5($assessorMapId['assessment_batch_assessor_map_id_pk'])), 'refresh');
                exit();
            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Please provide valid file(JPG/JPEG) within mentioned size');

                redirect(base_url('admin/assessment/assessor/batch/trainee_list/' . md5($assessorMapId['assessment_batch_assessor_map_id_pk'])), 'refresh');
                exit();
            }
        }
    }

    // ! SEND ASSESSMENT COMPLETED RESPONSE
    public function complete_assessor_assessment($batch_id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // ! Starting Transaction
            $this->db->trans_start(); # Starting Transaction

            $map_id_hash = $this->input->get('map_id_hash');
            $login_assessor_id = $this->session->userdata('stake_details_id_fk');

            $batch_info        = $this->assessor_batch_model->getBasicBatchInformation($batch_id_hash, $login_assessor_id)[0];
            $map_update_status = $this->assessor_batch_model->updateBatchAssessorMap($map_id_hash, array('process_id_fk' => 13));

            if ($map_update_status) {

                $update_array = array(
                    'process_id_fk'          => 13,
                    'assessment_completed_date'  => date('Y-m-d')
                );
                $batch_update_status = $this->assessor_batch_model->updateAssessmentBatchDetails($batch_id_hash, $update_array);

                // ! Prepare post data for api call
                $this->load->library('apidata');

                $batch_map_data = $this->assessor_batch_model->getBatchMapData($map_id_hash);
                $assessmentCompleteRequestData = $this->apidata->sendAssessmentCompletedResponseDatas($batch_map_data[0]['assessment_batch_id_fk']);

                if ($this->db->trans_status() === FALSE) {

                    $this->db->trans_rollback(); # Something went wrong.
                } else {

                    $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

                    $json_data_array = array(
                        'user_batch_code'              => $batch_info['user_batch_id'],
                        'json_data_type_id_fk'         => 1,
                        'council_response_message_id_fk'         => 5,
                        'council_assessment_json_file' => json_encode($assessmentCompleteRequestData, TRUE),
                        'entry_ip'                     => $this->input->ip_address(),
                        'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                        'active_status'                => 1
                    );
                    $json_data_id = $this->assessor_batch_model->insertAssessmentjsonData($json_data_array);

                    $this->load->config('wbsctvesd_api_config');
                    $url = $this->config->item('assessor_assign_url')[$batch_info['vertical_code']];

                    $this->load->library('curl');
                    $curl_response = $this->curl->curl_make_post_request($url, $assessmentCompleteRequestData);

                    if (!$curl_response) {

                        $this->assessor_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                    }

                    echo json_encode('done');
                }
            }
        }
    }

    // ! List all printing Expenditure list
    public function printingExpenditure($offset = 0)
    {
        $data['batch_list']  = $this->assessor_batch_model->getBatchListForPrintingExpenditure();

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field'     => 'map_batch_id',
                    'label'     => '<b>Batch ID</b>',
                    'rules'     => 'trim|required',
                ),
                array(
                    'field'     => 'marks_foil',
                    'label'     => '<b>Marks Foil</b>',
                    'rules'     => 'trim|required|numeric',
                ),
                array(
                    'field'     => 'attendance_sheet',
                    'label'     => '<b>Attendance Sheet</b>',
                    'rules'     => 'trim|required|numeric',
                ),
                array(
                    'field'     => 'question_paper',
                    'label'     => '<b>Question Paper</b>',
                    'rules'     => 'trim|required|numeric',
                ),
                array(
                    'field'     => 'total_no_of_pages',
                    'label'     => '<b>Total no of Pages</b>',
                    'rules'     => 'trim|required|numeric',
                ),
                array(
                    'field'     => 'amount_claimed',
                    'label'     => '<b>Amount Claimed</b>',
                    'rules'     => 'trim|required|numeric',
                ),
            );

            $this->form_validation->set_rules('scanned_copy_of_bill', 'Scanned Copy of Bill', 'trim|callback_file_validation[scanned_copy_of_bill|application/pdf|500|required]');

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Check your data and try again.');

                $this->load->view($this->config->item('theme') . 'assessment/assessor/printing_expenditure/batch_list_view', $data);
            } else {

                $batch_details  = $this->assessor_batch_model->getBatchDetailsForPrintingExpenditure($this->input->post('map_batch_id'));

                $insertArray = array(
                    'assessment_batch_assessor_map_id_fk' => $batch_details[0]['assessment_batch_assessor_map_id_pk'],
                    'assessment_batch_id_fk' => $batch_details[0]['assessment_batch_id_fk'],
                    'assessor_id_fk' => $batch_details[0]['assessor_id_fk'],
                    'marks_foil' => $this->input->post('marks_foil'),
                    'attendance_sheet' => $this->input->post('attendance_sheet'),
                    'question_paper' => $this->input->post('question_paper'),
                    'total_no_of_pages' => $this->input->post('total_no_of_pages'),
                    'amount_claimed' => $this->input->post('amount_claimed'),
                    'bill_doc' => base64_encode(file_get_contents($_FILES["scanned_copy_of_bill"]['tmp_name'])),
                    'entry_by_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_ip' => $this->input->ip_address(),
                );
                $insertedId  = $this->assessor_batch_model->insertPrintingExpenditure($insertArray);

                if ($insertedId) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Printing expenditure add successfully.');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to add printing expenditure at this momment, please try later.');
                }

                redirect('admin/assessment/assessor/batch/printingExpenditure');
            }
        } else {

            $this->load->view($this->config->item('theme') . 'assessment/assessor/printing_expenditure/batch_list_view', $data);
        }
    }

    public function updatePrintingExpenditure()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field'     => 'id_hash',
                    'label'     => '<b>ID</b>',
                    'rules'     => 'trim|required',
                )
            );

            $this->form_validation->set_rules('scanned_copy_of_bill', 'Scanned Copy of Bill', 'trim|callback_file_validation[scanned_copy_of_bill|application/pdf|500|required]');

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Check your file and try again.');

                redirect('admin/assessment/assessor/batch/printingExpenditure');
            } else {

                $id_hash = $this->input->post('id_hash');

                $updateArray = array(
                    'bill_doc' => base64_encode(file_get_contents($_FILES["scanned_copy_of_bill"]['tmp_name'])),
                );
                $status  = $this->assessor_batch_model->updatePrintingExpenditure($id_hash, $updateArray);

                if ($status) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Printing expenditure bill updated successfully.');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update printing expenditure bill at this momment, please try later.');
                }

                redirect('admin/assessment/assessor/batch/printingExpenditure');
            }
        } else {
            redirect('admin/assessment/assessor/batch/printingExpenditure');
        }
    }

    public function downloadPrintingExpenditureDoc()
    {
        $id_hash = $this->uri->segment(5);
        if (!empty($id_hash)) {

            $printing_expenditure_details  = $this->assessor_batch_model->getPrintingExpenditureDetails($id_hash);
            if (!empty($printing_expenditure_details)) {

                header("Content-type:application/pdf");

                header("Content-Disposition:attachment;filename=Assessment-Printing-Expenditure-" . date('Ymd') . "-" . $printing_expenditure_details[0]['printing_expenditure_id_pk'] . ".pdf");

                echo base64_decode($printing_expenditure_details[0]['bill_doc']);
            } else {
                redirect('admin/assessment/assessor/batch/printingExpenditure');
            }
        } else {
            redirect('admin/assessment/assessor/batch/printingExpenditure');
        }
    }
}
