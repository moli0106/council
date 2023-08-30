<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Batch extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
       // parent::check_privilege(143);
       parent::check_privilege();
        $this->load->model('organization_batch/organization_batch_model');
        $this->load->model('organization/std_reg_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            0 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            1 => $this->config->item('theme_uri') . 'organization_batch/timeline.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'organization_batch/batch.js',
        );
    }

    public function index($offset = 0)
    {
        $data['stake_details_id_fk'] = $this->session->userdata('stake_details_id_fk');
        $data['stake_id_fk'] = $this->session->userdata('stake_id_fk');

        if($data['stake_id_fk'] == 36){
            $data['tc_details'] = $this->std_reg_model->getOrgIdFromTCID($data['stake_details_id_fk']);
            
            $batch_data = $this->organization_batch_model->getBatchList($data['tc_details']['tc_id_pk'],'tc');
        }else{
            $OrgId = $data['stake_details_id_fk'];
            $batch_data = $this->organization_batch_model->getBatchList($OrgId,'org');
        }

        $data['batchList'] = $batch_data;

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'organization_batch/batch/batch_list_view', $data);
    }

    public function details($batch_id_hash = NULL)
    {
        $data['batchDetails'] = $this->organization_batch_model->getBatchDetails($batch_id_hash)[0];
        $data['batch_active_class'] = 'active';
        $data['stdList'] = $this->organization_batch_model->getStudentList($batch_id_hash);

        $this->load->view($this->config->item('theme') . 'organization_batch/batch/assessment_batch/batch_details_view', $data);
    }

    public function addInternalMarks($batch_id_hash = NULL)
    {
        $data['internal_marks'] = array();

        $data['batch_id_hash'] = $this->uri->segment(4);
        $data['stdList'] = $this->organization_batch_model->getStudentList($batch_id_hash);

        if (!empty($data['stdList'])) {

            $data['studentInternalMarks'] = $this->organization_batch_model->getStudentInternalMarks($data['batch_id_hash']);
            foreach ($data['stdList'] as $key => $value) {

                if ($this->input->server("REQUEST_METHOD") == 'POST') {
                    $data['internal_marks'][$value['student_id_pk']]    = set_value('internal_marks[' . $value['student_id_pk'] . ']');
                } else {
                    $student_marks = $this->organization_batch_model->getInternalMarksByStudent_id($value['student_id_pk']);
                    if (!empty($student_marks)) {

                        $data['internal_marks'][$value['student_id_pk']]    = $student_marks[0]['internal_marks'];
                    } else {
                        $data['internal_marks'][$value['student_id_pk']]     = NULL;
                    }
                }
            }

            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                foreach ($this->input->post('internal_marks') as $key => $value) {
                    $config = array(
                        array(
                            'field'     => 'internal_marks[' . $key . ']',
                            'label'     => '<b>Internal Marks</b>',
                            'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]|less_than_equal_to[20]',
                        )
                    );
                    $this->form_validation->set_rules($config);
                }

                if ($this->form_validation->run() != FALSE) {

                    $batchDetails = $this->organization_batch_model->getBatchDetails($batch_id_hash)[0];
                    foreach ($this->input->post('internal_marks') as $key => $value) {

                        $insertInternalMarksArray[] = array(
                            'school_id_fk' => $batchDetails['school_id_fk'],
                            'school_reg_id_fk'     => $batchDetails['school_reg_id_fk'],
                            'udise_code'          => $batchDetails['udise_code'],
                            'batch_id_fk'           => $batchDetails['batch_id_pk'],
                            'user_batch_id'        => $batchDetails['user_batch_id'],
                            'student_id_fk'             => $key,
                            'internal_marks'            => $this->input->post('internal_marks')[$key],
                            'active_status'          => 1,
                            'entry_ip'               => $this->input->ip_address()
                        );
                    }

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction

                    $this->organization_batch_model->removeAllBatchMarks($batchDetails['batch_id_pk']);

                    $this->organization_batch_model->insertStudentInternalMarksBatch($insertInternalMarksArray);

                    $this->organization_batch_model->updateBatchDetails($batchDetails['batch_id_pk'], array('internal_marks_entered_status' => 1));

                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add marks, Please try after sometime.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Marks has been added successfully.');
                    }

                    redirect('admin/cssvsebatch/batch/addInternalMarks/' . $data['batch_id_hash']);
                }
            }

            $this->load->view($this->config->item('theme') . 'cssvse/cssvsebatch/student_internal_marks', $data);
        } else {
            redirect('admin/cssvsebatch/batch');
        }
    }

    public function jobrolelist()
    {
        $school_reg_id = $this->session->userdata('stake_details_id_fk');
        $data['jobroleList'] = $this->organization_batch_model->getAllJobRoleInSchool($school_reg_id);

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'organization_batch/batch/jobrole_list_view', $data);
    }

    public function create()
    {
        $sid = $this->input->get('sid');
        $cid = $this->input->get('cid');

        if (!empty($sid) && !empty($cid)) {

            $tc_id = $this->session->userdata('stake_details_id_fk');
            $data['batchDetails'] = $this->organization_batch_model->getCreateBatchDetails($tc_id, $sid, $cid);

            $getPhase = $this->organization_batch_model->get_phase_by_id($tc_id);
            $phase= $getPhase['count'] + 1;   // council_vtc_batch_duration_master batch_duration_id_pk  January to June

            //$getVerticalCode = $this->organization_batch_model->getVerticalCodeById($data['batchDetails']['organization_id_fk']);
            if (!empty($data['batchDetails'])) {  

                $data['studentList'] = $this->organization_batch_model->getStudentListForCreateBatch($tc_id, $sid, $cid);
                //echo "<pre>";print_r($data['studentList']);exit;
                //$data['batch_code'] = date('Y'). '/' .$data['batchDetails']['institute_code'] . '/' . $data['batchDetails']['course_code'];

                $image_status = array_column($data['studentList'], 'image');
                if (in_array(null, $image_status, true) || in_array('', $image_status, true)) {
                    $data['image_status'] = 0;
                    $candidates_image = 1;
                } else {
                    $candidates_image = 0;
                    $data['image_status'] = 1;
                }

                if ($this->input->server("REQUEST_METHOD") == "POST") {

                    $post_data['assessment_year'] = $this->input->post('assessment_year');
                    //$post_data['batch_code'] = $this->input->post('batch_code');
                    $post_data['batch_start_date'] = $this->input->post('batch_start_date');
                    $post_data['batch_end_date'] = $this->input->post('batch_end_date');
                    $post_data['batch_tentative_date'] = $this->input->post('batch_tentative_date');

                    if (in_array(null, $post_data, true) || in_array('', $post_data, true)) {

                        $this->session->set_flashdata('status', 'warning');
                        $this->session->set_flashdata('alert_msg', 'Unable to create batch at this moment, please try again later.');

                        redirect('admin/organization_batch/batch/create?sid=' . $sid . '&cid=' . $cid);
                    } else {

                        $total_student = array_column($data['studentList'], 'registration_number');
                        $unique_student = array_unique($total_student);

                        if (count($total_student) == count($unique_student)) {
                            
                            $assessment_scheme_id = $data['batchDetails']['assessment_scheme_id_fk'];
                            

                            $batch_array = array(
                                'tc_id_fk' => $data['batchDetails']['tc_id_fk'],
                                'organization_id_fk' => $data['batchDetails']['organization_id_fk'],
                                'assessment_year' => $post_data['assessment_year'],
                                'vertical_code' => $data['batchDetails']['vertical_code'],

                                'assessment_scheme_id_fk' =>  $assessment_scheme_id,
                                //'user_batch_id' => $data['batch_code'],
                                'batch_size' => count($data['studentList']),
                                'sector_id_fk' => $data['batchDetails']['sector_id_fk'],
                                'course_id_fk' => $data['batchDetails']['course_id_fk'],
                                'course_description' => $data['batchDetails']['course_description'],
                                'course_duration' => $data['batchDetails']['course_duration'],
                                //'course_rate' => $data['batchDetails']['course_rate'],
                                //'nsqf_level' => $data['batchDetails']['nsqf_level'],
                                'batch_start_date' => $this->changeDateFormat($post_data['batch_start_date']),
                                'batch_end_date' => $this->changeDateFormat($post_data['batch_end_date']),
                                'batch_tentative_date' => $this->changeDateFormat($post_data['batch_tentative_date']),
                                'process_id_fk' => 1,
                                'active_status' => 1,
                                'entry_time' => 'now()',
                                'entry_ip' => $this->input->ip_address(),
                                'candidates_image' => $candidates_image,
                            );
                            //echo "<pre>";print_r($batch_array);exit;
                            // ! Starting Transaction
                            $this->db->trans_start(); # Starting Transaction

                            // $result = $this->organization_batch_model->checkBatchCode($data['batch_code']);

                            // if ($result) {

                            //     $batch_id_pk = $result['batch_id_pk'];
                            //     $update_array = array(
                            //         'batch_size' => $result['batch_size'] + count($data['studentList'])
                            //     );

                            //     $this->organization_batch_model->updateBatchDetails($batch_id_pk, $update_array);
                            // } else {
                                $batch_id_pk = $this->organization_batch_model->insertBatch($batch_array);
                           // }


                            if ($batch_id_pk) {
                                $batch_code = date('Y'). '/' .$phase. '/' .$data['batchDetails']['tc_id_fk']. '/' .$batch_id_pk. '/' .$data['batchDetails']['course_code'];   //Current_Year/phase/VTC_Code/batch_id_pk/course_code
                                $this->organization_batch_model->updateBatchDetails($batch_id_pk, array('user_batch_id' => $batch_code));
                                foreach ($data['studentList'] as $key => $value) {

                                    $student_array = array(
                                        'tc_id_fk' => $data['batchDetails']['tc_id_fk'],
                                        'organization_id_fk' => $data['batchDetails']['organization_id_fk'],
                                        'batch_id_fk' => $batch_id_pk,
                                        'user_batch_id' => $batch_code,
                                        'student_details_id_fk' => $value['student_details_id_pk'],
                                        'active_status' => 1,
                                        'entry_time' => 'now()',
                                        'entry_ip' => $this->input->ip_address(),
                                    );
                                    $this->organization_batch_model->insertBatchStudentMap($student_array);
                                }

                                $student_ids = array_column($data['studentList'], 'student_details_id_pk');
                                $this->organization_batch_model->updateStudentMaster($student_ids, array('batch_assigned_status' => 1));
                            

                                // ! Check All Query For Batch
                                if ($this->db->trans_status() === FALSE) {

                                    $this->db->trans_rollback(); # Something went wrong.

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to add batch, Please try after sometime.');
                                } else {

                                    $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'Batch has been created successfully.');
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Unable to add batch, Please try after sometime.');
                            }
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Duplicate Student found in batch.');
                        }

                        redirect('admin/organization_batch/batch');
                    }
                }

                // parent::pre($data);
                $this->load->view($this->config->item('theme') . 'organization_batch/batch/batch_create_view', $data);
            } else {

                $this->session->set_flashdata('status', 'warning');
                $this->session->set_flashdata('alert_msg', 'Unable to get data, please try again later.');

                redirect('admin/organization_batch/batch/jobrolelist');
            }
        } else {

            $this->session->set_flashdata('status', 'warning');
            $this->session->set_flashdata('alert_msg', 'Unable to get data, please try again later.');

            redirect('admin/organization_batch/batch/jobrolelist');
        }
    }

    public function getPushBatchDetails($id_hash = NULL)
    {
        $data['id_hash'] = $id_hash;
        if ($data['id_hash']) {

            $html_view = $this->load->view($this->config->item('theme') . 'organization_batch/batch/ajax/batch_push_view', $data, TRUE);
            echo json_encode($html_view);
        }
    }

    public function batchPushToCouncil($id_hash = NULL)
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $batch_id_hash = $this->input->post('batch_id');

            $date_1 = $this->input->post('date_1');
            $date_2 = $this->input->post('date_2');

            if (!empty($batch_id_hash) && !empty($date_1) && !empty($date_2)) {

                $batchData = $this->organization_batch_model->getBatchDetails($batch_id_hash);
                //echo '<pre>'; print_r( $batchData); echo '</pre>';die;
                if (!empty($batchData)) {

                    $date_1 = $this->changeDateFormat($date_1);
                    $date_2 = $this->changeDateFormat($date_2);

                    $update_array = array(
                        'prefered_assessment_date_1' => $date_1,
                        'prefered_assessment_date_2' => $date_2,
                        'process_id_fk' => 7
                    );

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction

                    $status = $this->organization_batch_model->updateBatchDetails($batchData[0]['batch_id_pk'], $update_array);
                    if ($status) {

                        // ! Prepare post data for api call
                        $this->load->library('apidata');
                        $data = $this->apidata->createOrganizationBatchRequestData($id_hash);
                        //echo '<pre>'; print_r($data); echo '</pre>';die;
                        // ! Push batch to Council
                        $councilBatchId = $this->batchPushApiCall($data['batchArray']);
                        //echo'<pre>'; print_r($councilBatchId); die;
                        if ($councilBatchId) {

                            $this->organization_batch_model->updateBatchDetails($batchData[0]['batch_id_pk'], array('council_batch_id' => $councilBatchId));

                            $data['traineeDocumentArray']['batchDetails']['councilBatchId'] = $councilBatchId;

                            $this->traineeDocApiCall($data['traineeDocumentArray']);

                            $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Batch has been successfully pushed.');
                        } else {

                            $this->db->trans_rollback(); # Something went wrong.

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to push batch, Please try after sometime.');
                        }
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    }
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Unable to push data, Batch not found.');
                }
            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Unable to push data, Due to inappropriate data.');
            }

            redirect('admin/organization_batch/batch');
        } else {

            $this->session->set_flashdata('status', 'warning');
            $this->session->set_flashdata('alert_msg', 'Access Desnied...');

            redirect('admin/organization_batch/batch');
        }
    }

    private function batchPushApiCall($batch_data = NULL)
    {
        if ($batch_data != NULL) {
            //echo '<pre>'; print_r($batch_data);die;
            //echo $json_data=json_encode($batch_data, TRUE);die;
        
            // ! API Call for Batch Push
            $this->load->config('wbsctvesd_api_config');
             $url = $this->config->item('CSSVSE_ASSESSMENT')['batch_push'];
            $this->load->library('curl');
            $curl_response = $this->curl->curl_make_post_request($url, $batch_data);
			
            //echo '<pre>'; print_r($curl_response);die;

            if ($curl_response) {
				//file_put_contents('terst.txt',$curl_response);
				
                $response = json_decode($curl_response, TRUE);
                
				//file_put_contents('terst.txt',$response->responseMsg->code);
				//echo '<pre>'; print_r($response); 
				//var_dump($response["responseMsg"]["code"]);die;
				//echo $response["responseMsg"]["code"];
				
				//echo '---'. $response["data"]["councilBatchDetails"]["councilBatchId"];die;
                if ($response["responseMsg"]["code"] == 'SM1') {
					//echo $response["responseMsg"]["code"];exit;
                    // ! Prepare json data for record
                    $json_data_array = array(
                        'batch_code' => $batch_data['batchDetails']['userBatchId'],
                        'json_data_type_id_fk' => 1,
                        'response_message_id_fk' => 1,
                        'assessment_json_file' => json_encode($batch_data, TRUE),
                        'entry_ip' => $this->input->ip_address(),
                        'entry_by_login_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_by_stake_id_fk' => $this->session->userdata('stake_id_fk'),
                        'active_status' => 1
                    );
                    $this->organization_batch_model->insertAssessmentJsonData($json_data_array);

                    return $response["data"]["councilBatchDetails"]["councilBatchId"];
					
                } elseif ($response["responseMsg"]["code"] == 'SM2') {
					//echo $response["responseMsg"]["code"];exit;
                    $errorData = (array)$response->data->errorData;
                    if (!empty($errorData)) {

                        $api_error_msg = '';
                        foreach ($errorData as $key => $value) {
                            $api_error_msg .= '<li>' . $value->reason . '</li>';
                        }

                        $this->session->set_flashdata('api_status', 'warning');
                        $this->session->set_flashdata('api_error_msg', $api_error_msg);
                        $this->session->set_flashdata('api_batch_code', $response->data->councilBatchDetails->userBatchId);
                    } else {
                        return FALSE;
                    }
                } else {
					
                    return FALSE;
                }
            } else {

                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    private function traineeDocApiCall($traineeDocumentArray = NULL)
    {
        if ($traineeDocumentArray != NULL) {
            //echo $json_data=json_encode($traineeDocumentArray, TRUE);die;
            // ! API Call for Batch Push
            $this->load->config('wbsctvesd_api_config');
            $url = $this->config->item('CSSVSE_ASSESSMENT')['trainee_image'];

            $this->load->library('curl');
            $curl_response = $this->curl->curl_make_post_request($url, $traineeDocumentArray);
            //echo '<pre>'; print_r($curl_response);die;
            if ($curl_response) {

                $response = json_decode($curl_response, TRUE);

                if ($response["responseMsg"]["code"] == 'SM10') {

                    // ! Prepare json data for record
                    $json_data_array = array(
                        'batch_code' => $traineeDocumentArray['batchDetails']['userBatchId'],
                        'json_data_type_id_fk' => 1,
                        'response_message_id_fk' => 1,
                        'assessment_json_file' => json_encode($traineeDocumentArray, TRUE),
                        'entry_ip' => $this->input->ip_address(),
                        'entry_by_login_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_by_stake_id_fk' => $this->session->userdata('stake_id_fk'),
                        'active_status' => 1
                    );
                    $this->organization_batch_model->insertAssessmentJsonData($json_data_array);

                    return TRUE;
                } else {

                    return FALSE;
                }
            } else {

                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function changeDateFormat($date = NULL)
    {
        $date_array = explode('/', $date);
        $tmp_date = date_create($date_array[2] . '-' . $date_array[1] . '-' . $date_array[0]);
        return date_format($tmp_date, "Y-m-d");
    }

    /** ADDED BY ATREYEE 23-02-2023 ***/
     // ! Marksheet & Certificate List 
     public function marksheet_certificate($batch_code_hash = NULL)
     {
        $assessment_batch_id = $this->organization_batch_model->getAssessmentBatchId($batch_code_hash)[0]['assessment_batch_id_pk'];
        // print_r($assessment_batch_id);die;
         $data['traineeList'] = $this->organization_batch_model->getTraineeList(md5($assessment_batch_id));
        // print_r($data['traineeList']);die;
         $this->load->view($this->config->item('theme') . 'organization_batch/batch/student_certificate_list_view', $data);
     }
    // end of  code

     // ! Download Certificate 
    public function download_certificate($id_hash = NULL)
    {
        $data['traineeDetails']    = $this->organization_batch_model->getTraineeDetails($id_hash)[0];
       
        $council_ncvet_course_status = $data['traineeDetails']['council_ncvet_course_status'];
        
        $traineeNosDetails = $this->organization_batch_model->getTraineeNosDetails($data['traineeDetails']['assessment_trainee_id_pk']);

        $total_marks = $total_marks_obtained = 0;
        foreach ($traineeNosDetails as $key => $value) {

            $total_marks_obtained += $value['total_marks'];

            $total_marks += ($value['nos_theory_marks'] + $value['nos_practical_marks'] + $value['nos_viva_marks']);
        }
        $data['trainee_percentage'] = round((($total_marks_obtained * 100) / $total_marks), 2);

        //$data['qr_text'] = str_replace(' ', '-', $data['traineeDetails']['trainee_full_name']) . '_' . str_replace('/', '-', $data['traineeDetails']['user_trainee_registration_no']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_no']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_council_code']);

        $data['qr_text'] = str_replace(' ', '-', $data['traineeDetails']['trainee_full_name']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_no']);
//echo'<pre>';print_r($data['qr_text']); die;
        $data['traineeQrCode'] = $this->qrcode($data['qr_text']);
//echo'<pre>';print_r($data['traineeQrCode']); die;
        if($council_ncvet_course_status==2){ 
            $html   = $this->load->view($this->config->item('theme') . 'vtc_student/batch/certificate/certificate_for_vtc_course', $data, true);
        }else if($council_ncvet_course_status==1){
            $html   = $this->load->view($this->config->item('theme') . 'vtc_student/batch/certificate/certificate_for_vtc_course_council_course', $data, true);
        }
        
        $pdfFilePath = 'Certificate-' . $data['traineeDetails']['certificate_no'] . ".pdf";

        $this->load->library('m_pdf');
        if($council_ncvet_course_status==2){
            $this->m_pdf->pdf->AddPage('L'); 
        }else{
            $this->m_pdf->pdf->AddPage('L','','','','',10,10,10,5,10,10);
        }
        
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->showWatermarkText = true;

        $this->m_pdf->pdf->WriteHTML($html);

        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
        // $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }

     // ! Generate QR Code of Trainee Information 
    public function qrcode($qrCodeData = NULL)
    {
        //echo'<pre>'; print_r($qrCodeData); die;
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
 // END 
}
