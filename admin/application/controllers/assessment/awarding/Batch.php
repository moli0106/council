<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Batch extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(52);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('assessment/awarding_batch_model');

        ini_set('memory_limit', '512M');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'assets/css/datepicker.css',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri') . 'assets/js/datepicker.js',
            5 => $this->config->item('theme_uri') . 'assessment/awarding_batch.js',
        );
        $this->load->library('ciqrcode');
    }

    // ! List all assessment list
    public function index($offset = 0)
    {
        $data['offset']      = $offset;
        $data['page_links']  = NULL;
        $data['course_list'] = NULL;
        $data['sector_list'] = $this->awarding_batch_model->getAllSector();
        $data['assessment_scheme'] = $this->awarding_batch_model->getAssessmentScheme();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if ($this->input->post('batch_code') == NULL) {
                $batch_code = NULL;
            } else {
                $batch_code = trim($this->input->post('batch_code'));
            }

            if ($this->input->post('sector_code') == NULL) {
                $sector_code = NULL;
            } else {
                $sector_code = $this->input->post('sector_code');
                $data['course_list'] = $this->awarding_batch_model->getCourseBySector($sector_code);
            }

            if ($this->input->post('course_code') == NULL) {
                $course_code = NULL;
            } else {
                $course_code = $this->input->post('course_code');
            }

            if ($this->input->post('assessment_status') == NULL) {
                $assessment_status = NULL;
            } else {
                $assessment_status = $this->input->post('assessment_status');
            }

            if ($this->input->post('proposed_assessment_date') == NULL) {
                $proposed_assessment_date = NULL;
            } else {
                $proposed_assessment_date = $this->date_format_us($this->input->post('proposed_assessment_date'));
            }

            if ($this->input->post('assessment_scheme') == NULL) {
                $assessment_scheme = NULL;
                $data['excel_export'] .= '&ast=';
            } else {
                $assessment_scheme = $this->input->post('assessment_scheme');
                $data['excel_export'] .= '&ast=' . base64_encode($assessment_scheme);
            }

            $searchArray = array(
                'batch_code'    => $batch_code,
                'sector_code'   => $sector_code,
                'course_code'   => $course_code,
                'assessment_status' => $assessment_status,
                'proposed_assessment_date' => $proposed_assessment_date,
                'assessment_scheme' => $assessment_scheme,
            );

            if (!empty($batch_code) || !empty($sector_code) || !empty($course_code) || !empty($proposed_assessment_date) || !empty($assessment_status) || !empty($assessment_scheme)) {

                $data['batch_list']  = $this->awarding_batch_model->searchTraineeBatch($searchArray);
            } else {
                redirect('admin/assessment/awarding/batch');
            }
        } else {

            $this->load->library('pagination');

            $config['base_url']         = 'assessment/awarding/batch/index/';
            $data["total_rows"]         = $config['total_rows'] = $this->awarding_batch_model->getTraineeBatchCount()[0]['count'];
            $config['per_page']         = 50;
            $config['num_links']        = 8;
            $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
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
            $data['batch_list']  = $this->awarding_batch_model->getAllTraineeBatch($config['per_page'], $offset);
        }

        $this->load->view($this->config->item('theme') . 'assessment/awarding/batch_list_view', $data);
    }

    // ! View trainee marks of assessment
    public function traine_attendance($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $data['id_hash']     = $id_hash;
            $data['trainee_list'] = $this->awarding_batch_model->getTraineeAttendanceList($id_hash);
            // parent::pre($data);

            $this->load->view($this->config->item('theme') . 'assessment/awarding/traine_attendance_list_view', $data);
        } else {

            redirect('admin/assessment/awarding/batch/', 'refresh');
        }
    }

    // ! View trainee marks of assessment
    public function traine_marks($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $data['id_hash']        = $id_hash;
            $data['tranee_details'] = $this->awarding_batch_model->getTraineeMarks($id_hash);
            // parent::pre($data);

            $this->load->view($this->config->item('theme') . 'assessment/awarding/trainee_marks_details_view', $data);
        } else {

            redirect('admin/assessment/awarding/batch/', 'refresh');
        }
    }

    // ! Download assessment document
    public function download_assessment_pdf($id_hash = NULL)
    {
        $result  = $this->awarding_batch_model->getAssessmentDoc($id_hash)[0];

        $assessment_pdf          = $result['assessment_doc'];
        $vertical_code           = $result['vertical_code'];
        $assessment_batch_id_pk  = $result['assessment_batch_id_pk'];

        header("Content-type:application/pdf");

        header("Content-Disposition:attachment;filename=Assessment_Trainee_Result_" . $vertical_code . "_" . $assessment_batch_id_pk . ".pdf");

        echo base64_decode($assessment_pdf);
    }

    // ! Download assessment document
    public function download_trainee_attendance_pdf($id_hash = NULL)
    {
        $result  = $this->awarding_batch_model->getAssessmentDoc($id_hash)[0];

        if (!empty($result['attendance_doc'])) {
            $assessment_pdf          = $result['attendance_doc'];
            $vertical_code           = $result['vertical_code'];
            $assessment_batch_id_pk  = $result['assessment_batch_id_pk'];

            header("Content-type:application/pdf");

            header("Content-Disposition:attachment;filename=Assessment_Trainee_attendance_" . $vertical_code . "_" . $assessment_batch_id_pk . ".pdf");

            echo base64_decode($assessment_pdf);
        } else {
            $this->session->set_flashdata('status', 'warning');
            $this->session->set_flashdata('alert_msg', 'Oops! Attendance not found.');

            redirect(base_url('admin/assessment/awarding/batch/traine_marks/' . $id_hash));
        }
    }

    // ! Accept or Decline marks of trainee assessment
    public function acceptdeclinemarks_ODL($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {

                if ($this->input->server("REQUEST_METHOD") == "POST") {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $status  = $this->input->post('status');
                    $id_hash = $this->input->post('id_hash');

                    if (!empty($status) && !empty($id_hash)) {

                        $updateArray = array();

                        $post_data = array(
                            'id_hash' => $this->input->post('id_hash'),
                            'status'  => $this->input->post('status')
                        );

                        $batch_data = $this->awarding_batch_model->getBatchByIdHash($post_data['id_hash']);

                        if (!empty($batch_data)) {
                            $batch_data = $batch_data[0];

                            if ($this->input->post('status') == 2) {

                                $updateArray['flag_finalize_assessment'] = 1;

                                $config = array(
                                    array(
                                        'field' => 'comment',
                                        'label' => 'Comment',
                                        'rules' => 'required'
                                    )
                                );
                                $this->form_validation->set_rules($config);

                                if ($this->form_validation->run() == FALSE) {

                                    $form_html = $this->load->view($this->config->item('theme') . 'assessment/awarding/ajax/accept_decline_marks_view', $post_data, TRUE);

                                    echo json_encode(array('status' => 1, 'msg' => $form_html));

                                    exit();
                                }
                            }

                            $updateArray['id_hash']                             = $post_data['id_hash'];
                            $updateArray['flag_batch_marks_status']             = $post_data['status'];
                            $updateArray['batch_marks_status_comment']          = ($this->input->post('comment')) ? $this->input->post('comment') : NULL;
                            $updateArray['batch_marks_status_updated_date']     = "now()";
                            $updateArray['batch_marks_status_updated_login_id'] = $this->session->userdata('stake_holder_login_id_pk');

                            if ($this->input->post('status') == 2) {

                                $updateArray['flag_finalize_assessment'] = 1;
                            } else {

                                $updateArray['process_id_fk'] = 13;
                            }

                            $result = $this->awarding_batch_model->updateTraineeMarksStatus($updateArray);

                            if ($result) {
                                $post_data['updated'] = 1;

                                if ($this->input->post('status') == 2) {

                                    // Send email to assessor
                                    $emailData     = $this->awarding_batch_model->getAssessorEmailData($this->input->post('id_hash'))[0];
                                    $email_message = $this->load->view($this->config->item('theme') . 'assessment/awarding/trainee_marks_decline_email_template', $emailData, TRUE);
                                    $this->load->helper('email');
                                    // send_email('birendra.singh.5070276@gmail.com', $email_message, "Assessment Trainee Marks Is Declined");
                                    send_email($emailData['email_id'], $email_message, "Assessment Trainee Marks Is Declined");
                                } else {

                                    /* 
                                        * ============================================= *
                                        !   Send assessment complete data to the client    ! 
                                        * ============================================= *
                                    */

                                    // ! Prepare post data for api call
                                    /* $this->load->library('apidata');
                                    $assessmentCompleteRequestData = $this->apidata->assessmentCompleteData($batch_data['assessment_batch_id_pk']);
                    
                                    $json_data_array = array(
                                        'user_batch_code'              => $batch_data['user_batch_id'],
                                        'json_data_type_id_fk'         => 2,
                                        'council_assessment_json_file' => json_encode($assessmentCompleteRequestData, TRUE),
                                        'entry_ip'                     => $this->input->ip_address(),
                                        'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                        'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                        'active_status'                => 1
                                    );
                                    $json_data_id = $this->awarding_batch_model->insertAssessmentjsonData($json_data_array);
                    
                                    // ! API Call for assessment complete
                                    $this->load->config('wbsctvesd_api_config');
                                    $url = $this->config->item('assessor_assign_url')[$batch_data['vertical_code']];
                    
                                    $this->load->library('curl');
                                    $curl_response = $this->curl->curl_make_post_request($url, $assessmentCompleteRequestData);
                    
                                    if (!$curl_response) {
                    
                                        $this->awarding_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                                    } */
                                }

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Status of trainee marks successfully updated.');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                            }

                            $form_html = $this->load->view($this->config->item('theme') . 'assessment/awarding/ajax/accept_decline_marks_view', $post_data, TRUE);

                            echo json_encode(array('status' => 1, 'msg' => $form_html));
                        } else {

                            echo json_encode(array('status' => 10, 'msg' => "Oops! Something went wrong."));
                        }
                    } else {

                        echo json_encode(array('status' => 10, 'msg' => "Oops! Something went wrong."));
                    }
                } else {

                    $data = array(
                        'id_hash' => $id_hash,
                        'status'  => $this->input->get('marksStatus')
                    );

                    $form_html = $this->load->view($this->config->item('theme') . 'assessment/awarding/ajax/accept_decline_marks_view', $data, TRUE);

                    echo json_encode(array('status' => 1, 'msg' => $form_html));
                }
            } else {

                echo json_encode(array('status' => 0, 'msg' => "Oops! Unable to get data."));
            }
        }
    }

    public function acceptdeclinemarks($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {

                if ($this->input->server("REQUEST_METHOD") == "POST") {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $status  = $this->input->post('status');
                    $id_hash = $this->input->post('id_hash');

                    if (!empty($status) && !empty($id_hash)) {

                        $updateArray = array();

                        $post_data = array(
                            'id_hash' => $this->input->post('id_hash'),
                            'status'  => $this->input->post('status')
                        );

                        $batch_data = $this->awarding_batch_model->getBatchByIdHash($post_data['id_hash']);

                        $trainee_data = $this->awarding_batch_model->getTraineeByBatchIdHash($post_data['id_hash']);    //Added by Waseem

                        if (!empty($batch_data)) {
                            $batch_data = $batch_data[0];

                            if ($this->input->post('status') == 2) {

                                $updateArray['flag_finalize_assessment'] = 1;

                                $config = array(
                                    array(
                                        'field' => 'comment',
                                        'label' => 'Comment',
                                        'rules' => 'required'
                                    )
                                );
                                $this->form_validation->set_rules($config);

                                if ($this->form_validation->run() == FALSE) {

                                    $form_html = $this->load->view($this->config->item('theme') . 'assessment/awarding/ajax/accept_decline_marks_view', $post_data, TRUE);

                                    echo json_encode(array('status' => 1, 'msg' => $form_html));

                                    exit();
                                }
                            }

                            $updateArray['id_hash']                             = $post_data['id_hash'];
                            $updateArray['flag_batch_marks_status']             = $post_data['status'];
                            $updateArray['batch_marks_status_comment']          = ($this->input->post('comment')) ? $this->input->post('comment') : NULL;
                            $updateArray['batch_marks_status_updated_date']     = "now()";
                            $updateArray['batch_marks_status_updated_login_id'] = $this->session->userdata('stake_holder_login_id_pk');

                            if ($this->input->post('status') == 2) {

                                $updateArray['flag_finalize_assessment'] = 1;
                            } else {

                                $updateArray['process_id_fk'] = 15;
                            }

                            // ! Starting Transaction
                            $this->db->trans_start(); # Starting Transaction

                            $result = $this->awarding_batch_model->updateTraineeMarksStatus($updateArray);

                            if ($result) {
                                $post_data['updated'] = 1;

                                if ($this->input->post('status') == 2) {

                                    $this->db->trans_commit();

                                    // Send email to assessor
                                    $emailData     = $this->awarding_batch_model->getAssessorEmailData($this->input->post('id_hash'))[0];
                                    $email_message = $this->load->view($this->config->item('theme') . 'assessment/awarding/trainee_marks_decline_email_template', $emailData, TRUE);
                                    $this->load->helper('email');
                                    send_email($emailData['email_id'], $email_message, "Assessment Trainee Marks Is Declined");
                                } else {

                                    // ! Generate certificate and council code for trainee
                                    $course_code = $batch_data['course_code'];
                                    $exam_year = date('y', strtotime($batch_data['proposed_assessment_date']));

                                    foreach ($trainee_data as $trainee) {
                                        $certificate_no = $this->generate_certificate_no($course_code, $exam_year);

                                        if (!empty($certificate_no['certificateCode']) && !empty($certificate_no['councilCode'])) {

                                            $trainee_update_array = array(
                                                'certificate_no'            => $certificate_no['certificateCode'],
                                                'certificate_council_code'  => $certificate_no['councilCode'],
                                                'certificate_no_entry_time'    => "now()",
                                                'certificate_no_entry_ip'    => $this->input->ip_address(),
                                                'certificate_no_enrty_by'    => $this->session->userdata('stake_holder_login_id_pk'),
                                            );

                                            $this->awarding_batch_model->update_trainee_certificate_no_dtls($trainee['assessment_trainee_id_pk'], $trainee_update_array);
                                        }
                                    }

                                    // ! Check All Query For Trainee
                                    if ($this->db->trans_status() === FALSE) {

                                        $this->db->trans_rollback();
                                        exit();
                                    } else {

                                        $this->db->trans_commit();
                                    }

                                    /* 
                                        * ============================================= *
                                        !   Send assessment complete data to the client    ! 
                                        * ============================================= *
                                    */

                                    // ! Prepare post data for api call
                                    $this->load->library('apidata');

                                    // ? Send Response for Marksheet
                                    $marksheetGeneratedResponseData = $this->apidata->marksheetGeneratedResponseData($batch_data['assessment_batch_id_pk']);
                                    $json_data_array_marksheet = array(
                                        'user_batch_code'              => $batch_data['user_batch_id'],
                                        'json_data_type_id_fk'         => 2,
                                        'council_response_message_id_fk'         => 6,
                                        'council_assessment_json_file' => json_encode($marksheetGeneratedResponseData, TRUE),
                                        'entry_ip'                     => $this->input->ip_address(),
                                        'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                        'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                        'active_status'                => 1
                                    );
                                    $json_data_id_marksheet = $this->awarding_batch_model->insertAssessmentjsonData($json_data_array_marksheet);

                                    // ? Send Response for Certificate
                                    $certificateGeneratedResponseData = $this->apidata->certificateGeneratedResponseData($batch_data['assessment_batch_id_pk']);
                                    $json_data_array_certificate = array(
                                        'user_batch_code'              => $batch_data['user_batch_id'],
                                        'json_data_type_id_fk'         => 2,
                                        'council_response_message_id_fk'         => 7,
                                        'council_assessment_json_file' => json_encode($certificateGeneratedResponseData, TRUE),
                                        'entry_ip'                     => $this->input->ip_address(),
                                        'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                        'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                        'active_status'                => 1
                                    );
                                    $json_data_id_certificate = $this->awarding_batch_model->insertAssessmentjsonData($json_data_array_certificate);

                                    // ! API Call for assessment complete
                                    $this->load->config('wbsctvesd_api_config');
                                    $url = $this->config->item('assessor_assign_url')[$batch_data['vertical_code']];

                                    $this->load->library('curl');

                                    $curl_response = $this->curl->curl_make_post_request($url, $marksheetGeneratedResponseData);
                                    if (!$curl_response) {
                                        $this->awarding_batch_model->updateAssessmentjsonData($json_data_id_marksheet, array('response_status' => 0));
                                    }

                                    $curl_response = $this->curl->curl_make_post_request($url, $certificateGeneratedResponseData);
                                    if (!$curl_response) {
                                        $this->awarding_batch_model->updateAssessmentjsonData($json_data_id_certificate, array('response_status' => 0));
                                    }
                                }

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Status of trainee marks successfully updated.');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                            }

                            $form_html = $this->load->view($this->config->item('theme') . 'assessment/awarding/ajax/accept_decline_marks_view', $post_data, TRUE);

                            echo json_encode(array('status' => 1, 'msg' => $form_html));
                        } else {

                            echo json_encode(array('status' => 10, 'msg' => "Oops! Something went wrong."));
                        }
                    } else {

                        echo json_encode(array('status' => 10, 'msg' => "Oops! Something went wrong."));
                    }
                } else {

                    $data = array(
                        'id_hash' => $id_hash,
                        'status'  => $this->input->get('marksStatus')
                    );

                    $form_html = $this->load->view($this->config->item('theme') . 'assessment/awarding/ajax/accept_decline_marks_view', $data, TRUE);

                    echo json_encode(array('status' => 1, 'msg' => $form_html));
                }
            } else {

                echo json_encode(array('status' => 0, 'msg' => "Oops! Unable to get data."));
            }
        }
    }

    // ! Marksheet & Certificate List 
    public function marksheet_certificate($id_hash = NULL)
    {
        $data['traineeList'] = $this->awarding_batch_model->getTraineeList($id_hash);

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'assessment/awarding/marksheet_certificate_list_view', $data);
    }

    // ! Download Marksheet 
    public function download_marksheet($id_hash = NULL)
    {
        $data['traineeDetails']    = $this->awarding_batch_model->getTraineeDetails($id_hash)[0];

        $certificate_no_array = explode('-', $data['traineeDetails']['certificate_no']);
        $data['nqr_code'] = substr($certificate_no_array[0], 9);

        $data['traineeNosDetails'] = $this->awarding_batch_model->getTraineeNosDetails($data['traineeDetails']['assessment_trainee_id_pk']);

        $data['qr_text'] = str_replace(' ', '-', $data['traineeDetails']['trainee_full_name']) . '_' . str_replace('/', '-', $data['traineeDetails']['user_trainee_registration_no']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_no']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_council_code']);

        $data['traineeQrCode'] = $this->qrcode($data['qr_text']);

        $remain_nos = 0;
        $total_nos  = count($data['traineeNosDetails']);

        if ($total_nos <= 10) {

            $remain_nos = (10 - $total_nos);
            $data['total_page'] = 1;
        } else {

            $remain_nos = (26 - $total_nos);
            $data['total_page'] = 2;
        }

        $data['traineeNosDetailsCopy'] = $data['traineeNosDetails'];

        if ($remain_nos != 0) {
            for ($i = 0; $i < $remain_nos; $i++) {

                $data['traineeNosDetails'][count($data['traineeNosDetails'])] = array(
                    'nos_code'            => '&nbsp;',
                    'nos_name'            => '&nbsp;',
                    'nos_type'            => '&nbsp;',
                    'nos_theory_marks'    => '&nbsp;',
                    'total_marks'         => '&nbsp;',
                );
            }
        }

        // parent::pre($data);
        //$this->load->view($this->config->item('theme') . 'assessment/awarding/marksheet/marksheet_for_pbssd_course', $data);

        $html   = $this->load->view($this->config->item('theme') . 'assessment/awarding/marksheet/marksheet_for_pbssd_course', $data, true);
        $pdfFilePath = 'Marksheet-' . $data['traineeDetails']['certificate_no'] . ".pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->showWatermarkText = true;

        //$this->m_pdf->pdf->WriteHTML($html);
        $this->m_pdf->pdf->WriteHTML(utf8_encode($html));
        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        // $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // ! Download Certificate 
    public function download_certificate($id_hash = NULL)
    {
        $data['traineeDetails']    = $this->awarding_batch_model->getTraineeDetails($id_hash)[0];

        $traineeNosDetails = $this->awarding_batch_model->getTraineeNosDetails($data['traineeDetails']['assessment_trainee_id_pk']);

        $total_marks = $total_marks_obtained = 0;
        foreach ($traineeNosDetails as $key => $value) {

            $total_marks_obtained += $value['total_marks'];

            $total_marks += ($value['nos_theory_marks'] + $value['nos_practical_marks'] + $value['nos_viva_marks']);
        }
        $data['trainee_percentage'] = round((($total_marks_obtained * 100) / $total_marks), 2);

        $data['qr_text'] = str_replace(' ', '-', $data['traineeDetails']['trainee_full_name']) . '_' . str_replace('/', '-', $data['traineeDetails']['user_trainee_registration_no']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_no']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_council_code']);

        $data['traineeQrCode'] = $this->qrcode($data['qr_text']);

        //$this->load->view($this->config->item('theme') . 'assessment/awarding/certificate/certificate_for_pbssd_short_term_course', $data);

        $html   = $this->load->view($this->config->item('theme') . 'assessment/awarding/certificate/certificate_for_pbssd_short_term_course', $data, true);
        $pdfFilePath = 'Certificate-' . $data['traineeDetails']['certificate_no'] . ".pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->AddPage('L');
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->showWatermarkText = true;

        $this->m_pdf->pdf->WriteHTML($html);

        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        // $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

    // ! Generate QR Code of Trainee Information 
    public function qrcode($qrCodeData = NULL)
    {
        $this->load->library('ciqrcode');

        $traineeData  = explode('_', $qrCodeData);
        $traineeRegNo = end($traineeData);

        $params['level']    = 'H';
        $params['size']     = 10;
        $params['data']     = $qrCodeData;
        $params['savename'] = FCPATH . 'themes/adminlte/assessment/qr-code/' . $traineeRegNo . '.png';

        $this->ciqrcode->generate($params);

        $path   = $_SERVER['DOCUMENT_ROOT'] . '/admin/themes/adminlte/assessment/qr-code/' . $traineeRegNo . '.png';
        $type   = pathinfo($path, PATHINFO_EXTENSION);
        $data   = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);



        /* if (unlink($path)) {
            echo 'File deleted';
        } else {
            echo 'Cannot remove that file';
        } */


        return $base64;
    }

    public function qrcode_old($qr_code = NULL)
    {
        $this->load->library('ciqrcode');

        header("Content-Type: image/png");
        $params['data'] = $qr_code;
        $this->ciqrcode->generate($params);

        //$params['data'] = 'This is a text to encode become QR Code';
        //$params['level'] = 'H';
        //$params['size'] = 10;
        //$params['savename'] = FCPATH.'tes.png';
        //$this->ciqrcode->generate($params);
        //echo '<img src="'.base_url().'tes.png" />';
    }

    public function date_format_us($date_uk = NULL)
    {
        $date_array = explode("-", $date_uk);
        return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
    }

    public function getCourseBySector($sector_code = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $sector_code = $this->input->get('sector_code');

            if ($sector_code != NULL) {

                $html   = '<option value="" hiddden="true">Select Course</option>';
                $result = $this->awarding_batch_model->getCourseBySector($sector_code);

                if (!empty($result)) {
                    foreach ($result as $key => $course) {

                        $html .= '<option value="' . $course['course_code'] . '">' . $course['course_name'] . ' [' . $course['course_code'] . ']</option>';
                    }
                } else {

                    $html = '<option value="" disabled="true">No course found...</option>';
                }

                echo json_encode($html);
            }
        }
    }

    public function passing_statistics_report($scheme_id = NULL)
    {
        $this->load->library('excel');

        $fileName    = 'Passing Statistics Report - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Date of Assessment');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Name of Assessor');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Name of T.C.');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Batch Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Sector');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Name of Job Role');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'No. of Total Trainee');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'No. of Present Trainees');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'No. of Passed Traineess');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'No. of Failed Traineess');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Pass Percentage');

        /*================================== Excel style array starts ==================================*/
        $styleArray = array(
            'borders' => array(
                'inside'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => '000000'
                    )
                ),
                'outline'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => '000000'
                    )
                )
            ),
            'font' => array(
                'bold' => true,
                'name'  => 'Cambria'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical'     => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'F0FFF0')
            )

        );

        $styleCellArray = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'borders' => array(
                'inside'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => '000000'
                    )
                ),
                'outline'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => '000000'
                    )
                )
            ),
            'font' => array(
                'name'  => 'Cambria'
            ),
        );

        $styleArrayFooter = array(
            'borders' => array(
                'inside'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => '000000'
                    )
                ),
                'outline'     => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'argb' => '000000'
                    )
                )
            ),
            'font' => array(
                'bold' => true,
                'name'  => 'Cambria'
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical'     => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'FFF0F5')
            )

        );
        /*=============================== Excel style array ends ===============================*/

        $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($styleArray);

        $rowCount = 2;

        $excel_data = $this->awarding_batch_model->passing_statistics_report($scheme_id);

        foreach ($excel_data as $batch) {

            $trainee_data = $this->awarding_batch_model->passing_statistics_trainee_report($batch['assessment_batch_id_pk']);

            if ($scheme_id == 3) {
                $trainee_data['present_trainee'] = ($trainee_data['total_trainee'] - $trainee_data['absent_trainee']);
            }

            $pass_percentage = (($trainee_data['pass_trainee'] * 100) / $trainee_data['present_trainee']);
            $pass_percentage = number_format((float)$pass_percentage, 2, '.', '');

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $batch['purpose_assessment_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $batch['assessor_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $batch['user_tc_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $batch['user_batch_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $batch['sector_name'] . ' (' . $batch['sector_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $batch['course_name'] . ' (' . $batch['course_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $trainee_data['total_trainee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $trainee_data['present_trainee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $trainee_data['pass_trainee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $trainee_data['fail_trainee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $pass_percentage);

            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':L' . $rowCount)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':L' . $rowCount)->getAlignment()->setWrapText(true);

            $rowCount++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':L' . $rowCount);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':L' . $rowCount)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function generate_certificate_no($course_code, $exam_year)
    {
        $state_code = "WB";

        $exam_year = date('Y');

        $chaking_data = ($state_code . $exam_year . '/' . $course_code);
        $check_exist_code = $this->awarding_batch_model->get_last_certificate_no($chaking_data)[0];

        if ($check_exist_code['code'] == "") {
            $number = "00001";
        } else {

            $code = $check_exist_code['code'];
            $cd = (int)str_pad(substr($code, -5), strlen($code));

            $cd = $cd + 1;
            $number = $cd;
            $no_of_digit = 5;
            $length = strlen((string)$number);

            for ($i = $length; $i < $no_of_digit; $i++) {
                $number = '0' . $number;
            }
            $number;
        }

        $councilCode = $state_code . $exam_year . '/' . $course_code . '/' . $number;

        $nqrCode    = $this->awarding_batch_model->getNqrCode($course_code);
        if (!empty($nqrCode)) {

            $yearCode = (chr(substr(date('Y'), 0, 2) + ord('A') - 20) . chr(substr(date('Y'), 2) + ord('A')));

            //? AW: yearCode, WB: stateCode, C: awardingBodyCategory, 1901: awardingBodyCode
            $certificateCode = $yearCode . 'WB' . 'C' . '1901' . $nqrCode[0]['certificate_code'] . '-' . $number;
        } else {
            $certificateCode = NULL;
        }

        return array(
            'councilCode' => $councilCode,
            'certificateCode' => $certificateCode,
        );
    }

    public function testMarksheetResponse($batch_id = NULL)
    {
        $this->load->library('apidata');

        $response = $this->apidata->marksheetGeneratedResponseData($batch_id);

        echo '<pre>';
        print_r(json_encode($response));
    }

    public function marksheetCertificateTempData()
    {
        $batch_ids = array('PJ-4/7533/KARTHA/001/AMH/Q1947/000004',
		'PJ-4/7531/KARTHA/001/AMH/Q1947/000003',
		'PJ-4/7499/KARTHA/001/AMH/Q1947/000002',
		'PJ-4/7369/KARTHA/001/AMH/Q1947/000001');
        $batch_ids = $this->awarding_batch_model->getBatchIdByCode($batch_ids);

        foreach ($batch_ids as $key => $value) {

            $id_hash = md5($value['assessment_batch_id_pk']);
            $batch_data = $this->awarding_batch_model->getBatchByIdHash($id_hash);

            // ! Prepare post data for api call
            $this->load->library('apidata');

            // ? Send Response for Marksheet
            $marksheetGeneratedResponseData = $this->apidata->marksheetGeneratedResponseData($batch_data[0]['assessment_batch_id_pk']);
            $json_data_array_marksheet = array(
                'user_batch_code'              => $batch_data[0]['user_batch_id'],
                'json_data_type_id_fk'         => 2,
                'council_response_message_id_fk'         => 6,
                'council_assessment_json_file' => json_encode($marksheetGeneratedResponseData, TRUE),
                'entry_ip'                     => $this->input->ip_address(),
                'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                'active_status'                => 1,
                'response_status'                => 0
            );
            $json_data_id_marksheet = $this->awarding_batch_model->insertAssessmentjsonData($json_data_array_marksheet);

            // ? Send Response for Certificate
            $certificateGeneratedResponseData = $this->apidata->certificateGeneratedResponseData($batch_data[0]['assessment_batch_id_pk']);
            $json_data_array_certificate = array(
                'user_batch_code'              => $batch_data[0]['user_batch_id'],
                'json_data_type_id_fk'         => 2,
                'council_response_message_id_fk'         => 7,
                'council_assessment_json_file' => json_encode($certificateGeneratedResponseData, TRUE),
                'entry_ip'                     => $this->input->ip_address(),
                'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                'active_status'                => 1,
                'response_status'                => 0
            );
            $json_data_id_certificate = $this->awarding_batch_model->insertAssessmentjsonData($json_data_array_certificate);
        }

        // ! API Call for assessment complete
        /* $this->load->config('wbsctvesd_api_config');
        $url = $this->config->item('assessor_assign_url')[$batch_data['vertical_code']]; */

        // $this->load->library('curl');

        /* $curl_response = $this->curl->curl_make_post_request($url, $marksheetGeneratedResponseData);
        if (!$curl_response) {
            $this->awarding_batch_model->updateAssessmentjsonData($json_data_id_marksheet, array('response_status' => 0));
        } */

        /* $curl_response = $this->curl->curl_make_post_request($url, $certificateGeneratedResponseData);
        if (!$curl_response) {
            $this->awarding_batch_model->updateAssessmentjsonData($json_data_id_certificate, array('response_status' => 0));
        } */
    }
}

/* End of file Batch.php */
