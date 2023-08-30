<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Delete_batch_list extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(51);

        ini_set('memory_limit', '512M');
        ini_set('max_execution_time', 0);
        // $this->output->enable_profiler(TRUE);

        $this->load->model('assessment/assessing_batch_model');
        $this->load->model('assessment_batch_model');
        $this->load->helper('email');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'assets/css/datepicker.css',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri') . 'assets/js/datepicker.js',
            5 => $this->config->item('theme_uri') . 'assessment/assessing_batch.js',
        );
    }

    // ! List all assessment list
    public function index($offset = 0)
    {
        $data['offset']      = $offset;
        $data['page_links']  = NULL;
        $data['course_list'] = NULL;
        $data['sector_list'] = $this->assessing_batch_model->getAllSector();
        $data['assessment_scheme'] = $this->assessing_batch_model->getAssessmentScheme();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['excel_export'] = base_url('admin/assessment/assessing/batch/downloadAssessmentInExcel?');

            if ($this->input->post('batch_code') == NULL) {
                $batch_code = NULL;
                $data['excel_export'] .= 'bc=';
            } else {
                $batch_code = trim($this->input->post('batch_code'));
                $data['excel_export'] .=  'bc=' . base64_encode($batch_code);
            }

            if ($this->input->post('sector_code') == NULL) {
                $sector_code = NULL;
                $data['excel_export'] .= '&sc=';
            } else {
                $sector_code = $this->input->post('sector_code');
                $data['excel_export'] .=  '&sc=' . base64_encode($sector_code);
                $data['course_list'] = $this->assessing_batch_model->getCourseBySector($sector_code);
            }

            if ($this->input->post('course_code') == NULL) {
                $course_code = NULL;
                $data['excel_export'] .= '&cc=';
            } else {
                $course_code = $this->input->post('course_code');
                $data['excel_export'] .= '&cc=' . base64_encode($course_code);
            }

            $searchArray = array(
                'batch_code'    => $batch_code,
                'sector_code'   => $sector_code,
                'course_code'   => $course_code,
            );

            if (!empty($batch_code) || !empty($sector_code) || !empty($course_code) || !empty($proposed_assessment_date) || !empty($assessment_status) || !empty($assessment_scheme)) {

                $data['batch_list']  = $this->assessing_batch_model->searchArchiveBatch($searchArray);
            } else {
                redirect('admin/assessment/assessing/delete_batch_list');
            }
        } else {

            $this->load->library('pagination');

            $config['base_url']         = 'assessment/assessing/delete_batch_list/index/';
            $data["total_rows"]         = $config['total_rows'] = $this->assessing_batch_model->getArchiveBatchCount()[0]['count'];
            $config['per_page']         = 50;
            $config['num_links']        = 9;
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
            $data['batch_list']  = $this->assessing_batch_model->getAllArchiveBatch($config['per_page'], $offset);

            $data['excel_export'] = base_url('admin/assessment/assessing/batch/downloadAssessmentInExcel?sc=&cc=&as=&pad=&ast=');
        }

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'assessment/assessing/delete_batch_list_view', $data);
    }

    public function getCourseBySector($sector_code = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $sector_code = $this->input->get('sector_code');

            if ($sector_code != NULL) {

                $html   = '<option value="" hiddden="true">Select Course</option>';
                $result = $this->assessing_batch_model->getCourseBySector($sector_code);

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

    // ! Download Assessment data in Excel
    public function downloadAssessmentInExcel($searchArray = NULL)
    {
        $bc   = ($this->input->get('bc') == NULL) ? NULL : base64_decode($this->input->get('bc'));
        $sc   = ($this->input->get('sc') == NULL) ? NULL : base64_decode($this->input->get('sc'));
        $cc   = ($this->input->get('cc') == NULL) ? NULL : base64_decode($this->input->get('cc'));
        $as   = ($this->input->get('as') == NULL) ? NULL : base64_decode($this->input->get('as'));
        $pad = ($this->input->get('pad') == NULL) ? NULL : base64_decode($this->input->get('pad'));
        $ast = ($this->input->get('ast') == NULL) ? NULL : base64_decode($this->input->get('ast'));

        $searchArray = array(
            'batch_code'   => $bc,
            'sector_code'   => $sc,
            'course_code'   => $cc,
            // 'assessment_status' => $as,
            // 'proposed_assessment_date' => $pad,
            // 'assessment_scheme' => $ast,
        );

        $this->load->library('excel');

        $fileName    = 'Assessment Batch Report - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Name of T.C.')
            ->SetCellValue('C1', 'District')
            ->SetCellValue('D1', 'Batch Code')
            ->SetCellValue('E1', 'Date of Assessment')
            ->SetCellValue('F1', 'Sector')
            ->SetCellValue('G1', 'Name of Job Role')
            ->SetCellValue('H1', 'Name of Assessor')
            ->SetCellValue('I1', 'PAN No.')
            ->SetCellValue('J1', 'Mobile No.')
            ->SetCellValue('K1', 'Assessment Completed (Yes/No)')
            ->SetCellValue('L1', 'Marks Uploaded (Yes/No)')
            ->SetCellValue('M1', 'Assessment Status');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(31);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);
        $row = 2;

        $excel_data = $this->assessing_batch_model->getExcelData($searchArray);

        foreach ($excel_data as $batch) {

            $assessmentCompleted = $marksUploaded = 'No';

            if ($batch['process_id_fk'] == 13) {
                $assessmentCompleted = 'Yes';
            }

            if ($batch['process_id_fk'] == 12) {
                $marksUploaded = 'Yes';
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $batch['user_tc_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $batch['tc_district_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $batch['user_batch_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $batch['proposed_assessment_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $batch['sector_name'] . ' (' . $batch['sector_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $batch['course_name'] . ' (' . $batch['course_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $batch['fname'] . ' ' . $batch['mname'] . ' ' . $batch['lname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $batch['pan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $batch['mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $assessmentCompleted);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $row, $marksUploaded);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $row, $batch['process_name']);

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':M' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':M' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/assessment/assessing/batch');
    }

    // ! View details of assessment
    public function details($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {

                $result = $this->assessing_batch_model->getTraineeBatch($id_hash);
                $data = array(
                    'batch_details'    => $result['batch_details'],
                    'assessor_details' => $result['assessor_details'],
                    'tranee_details'   => $result['tranee_details']
                );

                if ($batch_code = $data['batch_details']['assessment_scheme_id_fk'] == 3) {
                    $data['batch_type'] = "CSSVSE";
                } else {

                    $batch_code = $data['batch_details']['user_batch_id'];
                    if (strpos($batch_code, 'ORG') !== false) {
                        $data['batch_type'] = "ORG";
                    } else {
                        $data['batch_type'] = "PBSSD";
                    }
                }

                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessing/ajax/batch_details_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // ! Mark Trainee Attendance as Present
    public function attendance_status($trainee_id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($trainee_id_hash != NULL) {

                $tranee_details = $this->assessing_batch_model->getTraineeByIdHash($trainee_id_hash);
                if (!empty($tranee_details)) {

                    $tranee_details = $tranee_details[0];

                    $trainee_attendance_data = array(
                        'assessment_batch_id_fk'   => $tranee_details['assessment_batch_id_fk'],
                        'trainee_id_fk'                => $tranee_details['assessment_trainee_id_pk'],
                        'trainee_in_time'            => 'now()',
                        'active_status'               => 1,
                        'process_id_fk'               => 1,
                        'attendance_by_assessor' => 1,
                    );

                    $result = $this->assessing_batch_model->insertTraineeAttendance($trainee_attendance_data);
                    if ($result) {

                        $present = '<span class="badge bg-aqua">Present</span>';
                        echo json_encode($present);
                    }
                }
            }
        }
    }

    // ! Assign Assessor
    public function assignAssessor_old()
    {
        if (!$this->input->is_ajax_request()) {

            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            if ($id_hash != NULL) {

                $result = $this->assessing_batch_model->getBatchInformation($id_hash)[0];
                if (!empty($result) && ($result['process_id_fk'] == 7 || $result['process_id_fk'] == 10)) {

                    $assessor_id_fk = $assingedDate = NULL;

                    // ! Find assessor for prefered assessment date 1

                    $check_array    = array(
                        'course_id'       => $result['course_id_pk'],
                        'district_id'     => $result['district_id_pk'],
                        'assessment_date' => $result['prefered_assessment_date_1']
                    );

                    // ! 5 Days logic
                    $current_date = new DateTime(date('Y-m-d'));
                    $assment_date = new DateTime($result['prefered_assessment_date_1']);

                    $diff_date = $current_date->diff($assment_date)->format("%r%a");

                    if ($diff_date < 5) {

                        $check_array['assessment_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day'));
                    }
                    // ! END

                    $assingedDate   = $check_array['assessment_date'];
                    $assessor_id_fk = $this->findAssessor($check_array);

                    if ($assessor_id_fk == NULL) {

                        // ! Find assessor for prefered assessment date 2

                        // ! 5 Days logic
                        $current_date = new DateTime(date('Y-m-d'));
                        $assment_date = new DateTime($result['prefered_assessment_date_2']);

                        $diff_date = $current_date->diff($assment_date)->format("%r%a");

                        if ($diff_date < 5) {

                            $check_array['assessment_date'] = date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day'));
                        } else {

                            $check_array['assessment_date'] = $result['prefered_assessment_date_2'];
                        }
                        // ! END

                        $assingedDate   = $check_array['assessment_date'];
                        $assessor_id_fk = $this->findAssessor($check_array);

                        if ($assessor_id_fk == NULL) {

                            // ! Find assessor on next 60 days

                            $startDate = new DateTime($result['prefered_assessment_date_1']);
                            // $endDate   = new DateTime($result['prefered_assessment_date_1']);
                            $endDate   = new DateTime(date('Y-m-d', strtotime(date('Y-m-d') . ' +5 day')));
                            $oneDay    = new DateInterval("P1D");

                            $endDate->modify("+60 days");

                            $holiDays = $this->assessing_batch_model->getHolidays($startDate->format("Y-m-d"), $endDate->format("Y-m-d"));

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

                    if ($assessor_id_fk == NULL) {

                        $ajaxResponse = array(
                            'ok'     => 2,
                            'msg'    => 'Assessor nither found in prefered assessment date 1 nor date 2 nor for next 60 days.',
                        );
                    } else {

                        $map_array = array(
                            'assessment_batch_id_fk'  => $result['assessment_batch_id_pk'],
                            'assessor_id_fk'          => $assessor_id_fk,
                            'purpose_assessment_date' => $assingedDate,
                            'active_status'           => 1,
                            'entry_by_id_fk'          => $this->session->userdata('stake_holder_login_id_pk'),
                            'entry_ip'                => $this->input->ip_address(),
                            'assessor_assign_notes'   => NULL,
                            'process_id_fk'           => 8,
                            'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                        );

                        $map_id = $this->assessing_batch_model->createBatchAssessorMap($map_array);

                        if ($map_id) {
                            $update_batch = array(
                                'proposed_assessment_date' => $assingedDate,
                                'process_id_fk' => 8
                            );
                            $this->assessing_batch_model->updateAssessmentBatchDetails($result['assessment_batch_id_pk'], $update_batch);

                            /* 
                                * ============================================= *
                                !   Send assessor asigned data to the client    ! 
                                * ============================================= *
                            */

                            // ! Prepare post data for api call
                            $this->load->library('apidata');
                            $assessorAssignResponse = $this->apidata->assignAssessorData($map_id);

                            $json_data_array = array(
                                'user_batch_code'              => $result['user_batch_id'],
                                'json_data_type_id_fk'         => 2,
                                'council_assessment_json_file' => json_encode($assessorAssignResponse, TRUE),
                                'entry_ip'                     => $this->input->ip_address(),
                                'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                'active_status'                => 1
                            );
                            $json_data_id = $this->assessing_batch_model->insertAssessmentjsonData($json_data_array);

                            // ! API Call for assessor is assigned
                            $this->load->config('wbsctvesd_api_config');
                            $url = $this->config->item('assessor_assign_url')[$result['vertical_code']];

                            $this->load->library('curl');
                            $curl_response = $this->curl->curl_make_post_request($url, $assessorAssignResponse);

                            if (!$curl_response) {

                                $this->assessing_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                            }

                            // Send email to assessor
                            $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($map_id);

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


                            $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessing/assessor_assign_email_template', $email_data, TRUE);
                            send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                            $ajaxResponse = array(
                                'ok'  => 1,
                                'msg' => 'Success! Assessor assign successfully.'
                            );
                        } else {

                            $ajaxResponse = array(
                                'ok'     => 2,
                                'msg'    => 'Oops! Unable to assing assessor.',
                            );
                        }
                    }
                } else {

                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found..',
                    );
                }
            } else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }

            echo json_encode($ajaxResponse);
        }
    }

    public function assignAssessor()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            if ($id_hash != NULL) {

                $result = $this->assessing_batch_model->getBatchInformation($id_hash)[0];
                if (!empty($result) && ($result['process_id_fk'] == 7 || $result['process_id_fk'] == 10)) {

                    // ! Find assessor for the batch
                    $this->load->library('assessment');
                    $assessor_data = $this->assessment->assignAssessor($result);

                    if (empty($assessor_data)) {

                        $ajaxResponse = array(
                            'ok'     => 2,
                            'msg'    => 'Assessor nither found in prefered assessment date 1 nor date 2 nor for next 60 days.',
                        );
                    } else {

                        $map_array = array(
                            'assessment_batch_id_fk'  => $result['assessment_batch_id_pk'],
                            'assessor_id_fk'              => $assessor_data['assessor_id_fk'],
                            'purpose_assessment_date' => $assessor_data['assinged_date'],
                            'active_status'           => 1,
                            'entry_by_id_fk'          => $this->session->userdata('stake_holder_login_id_pk'),
                            'entry_ip'                => $this->input->ip_address(),
                            'assessor_assign_notes'   => NULL,
                            'process_id_fk'           => 8,
                            'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                        );

                        $map_id = $this->assessing_batch_model->createBatchAssessorMap($map_array);

                        if ($map_id) {
                            $update_batch = array(
                                'proposed_assessment_date' => $assessor_data['assinged_date'],
                                'process_id_fk' => 8
                            );
                            $this->assessing_batch_model->updateAssessmentBatchDetails($result['assessment_batch_id_pk'], $update_batch);

                            /* 
                                 ============================================= 
                                !   Send assessor asigned data to the client    ! 
                                 ============================================= 
                            */

                            // ! Prepare post data for api call
                            $this->load->library('apidata');
                            $assessorAssignResponse = $this->apidata->assignAssessorData($map_id);

                            $json_data_array = array(
                                'user_batch_code'              => $result['user_batch_id'],
                                'json_data_type_id_fk'         => 2,
                                'council_response_message_id_fk'         => 3,
                                'council_assessment_json_file' => json_encode($assessorAssignResponse, TRUE),
                                'entry_ip'                     => $this->input->ip_address(),
                                'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                'active_status'                => 1
                            );
                            $json_data_id = $this->assessing_batch_model->insertAssessmentjsonData($json_data_array);

                            // ! API Call for assessor is assigned
                            $this->load->config('wbsctvesd_api_config');
                            $url = $this->config->item('assessor_assign_url')[$result['vertical_code']];

                            $this->load->library('curl');
                            $curl_response = $this->curl->curl_make_post_request($url, $assessorAssignResponse);

                            if (!$curl_response) {

                                $this->assessing_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                            }

                            // Send email to assessor
                            $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($map_id);

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


                            $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessing/assessor_assign_email_template', $email_data, TRUE);
                            send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                            $ajaxResponse = array(
                                'ok'  => 1,
                                'msg' => 'Success! Assessor assign successfully.'
                            );
                        } else {

                            $ajaxResponse = array(
                                'ok'     => 2,
                                'msg'    => 'Oops! Unable to assing assessor.',
                            );
                        }
                    }
                } else {

                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found..',
                    );
                }
            } else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }

            echo json_encode($ajaxResponse);
        }
    }

    // ! Re Assign Assessor
    public function reAssignAssessor()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            if ($id_hash != NULL) {

                $result = $this->assessing_batch_model->getBatchInformation($id_hash)[0];
                if (!empty($result) && ($result['process_id_fk'] == 8 || $result['process_id_fk'] == 9)) {

                    $assignedAssessor = $this->assessing_batch_model->getAssignedAssessorInBatch($id_hash);
                    $assignedAssessor = end($assignedAssessor);

                    $assessor_id_fk = $assingedDate = NULL;

                    /* $check_array    = array(
                        'course_id'       => $result['course_id_pk'],
                        'district_id'     => $result['district_id_pk'],
                        'assessment_date' => $assignedAssessor['purpose_assessment_date']
                    );

                    $assessor_id_fk = $this->findAssessor($check_array);

                    if ($assessor_id_fk == NULL) { */

                    // ! Find another assessor for the batch
                    $this->load->library('assessment');
                    $assessor_data = $this->assessment->assignAssessor($result);

                    if (empty($assessor_data)) {

                        $ajaxResponse = array(
                            'ok'     => 2,
                            'msg'    => 'Unable to find the Assessor',
                        );
                    } else {

                        $insertAssessorMapData = array(
                            'assessment_batch_id_fk'  => $result['assessment_batch_id_pk'],
                            'assessor_id_fk'          => $assessor_data['assessor_id_fk'],
                            'purpose_assessment_date' => $assessor_data['assinged_date'],
                            'active_status'           => 1,
                            'entry_by_id_fk'          => $this->session->userdata('stake_holder_login_id_pk'),
                            'entry_ip'                => $this->input->ip_address(),
                            'assessor_assign_notes'   => NULL,
                            'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                        );

                        if ($assignedAssessor['process_id_fk'] == 9) {

                            $insertAssessorMapData['process_id_fk']   = 9;
                            $insertAssessorMapData['reassign_status_on_approved_assessment'] = 1;
                        } else {
                            $insertAssessorMapData['process_id_fk'] = 8;
                            $insertAssessorMapData['reassign_status_on_assigned_assessment'] = 1;
                        }

                        $updateAssessorMapData = array(
                            'active_status'           => 0,
                            'process_id_fk'           => 10,
                        );

                        $status = $this->assessing_batch_model->updateBatchAssessorMap($assignedAssessor['assessment_batch_assessor_map_id_pk'], $updateAssessorMapData);
                        $map_id = $this->assessing_batch_model->createBatchAssessorMap($insertAssessorMapData);
                        if ($map_id) {

                            // ! Send email to assessor
                            $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($map_id);
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
                            $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessing/assessor_assign_email_template', $email_data, TRUE);
                            send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                            // ! Send email to assessor for cancled assessment
                            $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($assignedAssessor['assessment_batch_assessor_map_id_pk']);
                            $email_message = "
                                Dear Sir/Madam,<br>
                                Your assigned assessment on " .
                                date('d-m-Y', strtotime($assignedAssessorResponse['batch_details']['assessorAssignDate']))
                                . " has been cancled by State Admin, WBSCTVESD
                            ";
                            send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch Cancled");

                            $ajaxResponse = array(
                                'ok'  => 1,
                                'msg' => 'Success! Assessor assign successfully.'
                            );
                        } else {

                            $ajaxResponse = array(
                                'ok'     => 2,
                                'msg'    => 'Oops! Unable to assing assessor.',
                            );
                        }
                    }
                } else {

                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found...',
                    );
                }
            } else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }

            echo json_encode($ajaxResponse);
        }
    }

    //  ! Find Assessor to assign in Batch
    private function findAssessor($check_array = NULL)
    {
        $check_result   = $this->assessing_batch_model->checkAssessor($check_array);
        $assessor_id_fk = NULL;

        if (!empty($check_result)) {

            $assessor_id_fk = $check_result[0]['assessor_id_fk'];
        } else {

            $map_district = $this->assessing_batch_model->getMapDistrict($check_array['district_id']);
            if (!empty($map_district)) {

                $map_district = array_column($map_district, 'district_map_id_fk');

                $check_array = array(
                    'course_id'       => $check_array['course_id'],
                    'district_ids'    => $map_district,
                    'assessment_date' => $check_array['assessment_date']
                );

                $check_result = $this->assessing_batch_model->checkAssessorForAnotherDistrict($check_array);

                if (!empty($check_result)) {

                    $assessor_id_fk = $check_result[0]['assessor_id_fk'];
                }
            }
        }

        return $assessor_id_fk;
    }

    // ! Download Assessment Question List
    public function question_list_download($batch_id_hash = NULL)
    {
        $mapQuestionList = $this->assessing_batch_model->getMapQuestionList($batch_id_hash);

        if (empty($mapQuestionList)) {

            $result = $this->assessing_batch_model->prepairQuestionList($batch_id_hash);
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

                $this->assessing_batch_model->insertMapQuestionList($questionArray);
                $mapQuestionList = $this->assessing_batch_model->getMapQuestionList($batch_id_hash);
            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Question not uploaded yet, Please contact admin.');

                redirect('admin/assessment/assessing/batch', 'refresh');

                exit();
            }
        }

        if (!empty($mapQuestionList)) {
            $nosList = array();

            foreach ($mapQuestionList as $key => $value) {

                $questionIds  = explode(',', $value['question_list']);
                $nosQuestions = $this->assessing_batch_model->getQuestionListForPdf($value['nos_id_fk'], $questionIds);

                array_push($nosList, $nosQuestions);
            }
            $batchDetails   = $this->assessing_batch_model->getBasicBatchDetails($batch_id_hash);

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

            // parent::pre($data);
            // $this->load->view($this->config->item('theme') . 'assessment/download_question_list_view', $data);

            $html   = $this->load->view($this->config->item('theme') . 'assessment/assessing/download_question_list_view', $data, true);

            //this the the PDF filename that user will get to download
            $pdfFilePath = $batchDetails['vertical_code'] . $batchDetails['assessment_batch_id_pk'] . ".pdf";

            //load mPDF library
            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
            $this->m_pdf->pdf->showWatermarkText = true;

            $this->m_pdf->pdf->WriteHTML($html);

            //download it.
            $this->m_pdf->pdf->Output($pdfFilePath, "I");
            // $this->m_pdf->pdf->Output($pdfFilePath, "D");
        } else {

            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Question not uploaded yet, Please contact admin.');

            redirect('admin/assessment/assessing/batch', 'refresh');

            exit();
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

    public function test_add_user_function()
    {
        $requestedData = array(
            'user_name'   => "Birendra Singh",
            'user_mobile' => "8093855687",
            'user_email'  => "birendra.singh.5070276@gmail.com",
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://164.100.228.244/api_server/council_assessment/Batch_assessment_response_PBSSD/test_add_user',
            // CURLOPT_URL => 'https://164.100.228.244/api_server/test/TestApiController/test_add_user',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestedData,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $result     = curl_exec($curl);
        $curl_info  = curl_getinfo($curl);
        $curl_error = curl_error($curl);

        curl_close($curl);

        echo '<pre><h2>' . $curl_error . '</h2>';
        print_r(array('result' => $result, 'curl_info' => $curl_info, 'curl_error' => $curl_error));
    }

    public function test_get_batch_function()
    {
        $requestedData = array(
            'req_msg'   => "Api for get demo batch",
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://164.100.228.244/api_server/council_assessment/Batch_assessment_response_PBSSD/test_send_batch',
            // CURLOPT_URL => 'https://164.100.228.244/api_server/test/TestApiController/test_send_batch',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestedData,
            CURLOPT_SSL_VERIFYPEER => false
        ));

        $result     = curl_exec($curl);
        $curl_info  = curl_getinfo($curl);
        $curl_error = curl_error($curl);

        curl_close($curl);

        if ($curl_info['http_code'] != 200) {

            echo '<pre><h2>' . $curl_error . '</h2>';
            print_r(array('result' => $result, 'curl_info' => $curl_info, 'curl_error' => $curl_error));
        } else {

            $requestData = json_decode($result, TRUE);
            $requestData = $requestData['batchDetails'];
            $candidates  = $requestData['batchDetails']['candidates'];

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

                // Insert Batch information
                $batch_id = $this->assessment_batch_model->insertData('council_assessment_batch_details', $batchDetails);

                /* =============== END Batch Details Block =============== */

                if ($batch_id) {
                    foreach ($candidates as $key => $candidate) {
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
                        );

                        // Insert Candidate information and update the code
                        $trainee_id = $this->assessment_batch_model->insertData('council_assessment_trainee_details', $candidateDetails);

                        $updateTrStatus = $this->assessment_batch_model->UpdateTraineeData($trainee_id, array('council_trainee_code' => 'TR_' . sprintf("%010d", $trainee_id)));
                    }
                }

                redirect('admin/assessment/assessing/batch');
            }
        }
    }

    // ! Re Assign Assessor
    public function test_reAssignAssessor($id_hash = NULL)
    {
        $id_hash = $this->input->get('id_hash');
        if ($id_hash != NULL) {

            $result = $this->assessing_batch_model->getBatchInformation($id_hash)[0];
            if (!empty($result) && ($result['process_id_fk'] == 8 || $result['process_id_fk'] == 9)) {

                $assignedAssessor = $this->assessing_batch_model->getAssignedAssessorInBatch($id_hash);
                $assignedAssessor = end($assignedAssessor);

                $assessor_id_fk = $assingedDate = NULL;

                $check_array    = array(
                    'course_id'       => $result['course_id_pk'],
                    'district_id'     => $result['district_id_pk'],
                    'assessment_date' => $assignedAssessor['purpose_assessment_date']
                );


                $assessor_id_fk = $this->test_findAssessor($check_array);

                echo '<pre>';
                print_r($assessor_id_fk);
                exit();

                if ($assessor_id_fk == NULL) {

                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Unable to find the Assessor on ' . date('d-m-mY', strtotime($check_array['assessment_date'])),
                    );
                } else {

                    $insertAssessorMapData = array(
                        'assessment_batch_id_fk'  => $result['assessment_batch_id_pk'],
                        'assessor_id_fk'          => $assessor_id_fk,
                        'purpose_assessment_date' => $check_array['assessment_date'],
                        'active_status'           => 1,
                        'entry_by_id_fk'          => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_ip'                => $this->input->ip_address(),
                        'assessor_assign_notes'   => NULL,
                        'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                    );

                    if ($assignedAssessor['process_id_fk'] == 9) {

                        $insertAssessorMapData['process_id_fk']   = 9;
                        $insertAssessorMapData['reassign_status_on_approved_assessment'] = 1;
                    } else {
                        $insertAssessorMapData['process_id_fk'] = 8;
                        $insertAssessorMapData['reassign_status_on_assigned_assessment'] = 1;
                    }

                    $updateAssessorMapData = array(
                        'active_status'           => 0,
                        'process_id_fk'           => 10,
                    );

                    $status = $this->assessing_batch_model->updateBatchAssessorMap($assignedAssessor['assessment_batch_assessor_map_id_pk'], $updateAssessorMapData);
                    $map_id = $this->assessing_batch_model->createBatchAssessorMap($insertAssessorMapData);
                    if ($map_id) {

                        // ! Send email to assessor
                        $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($map_id);
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
                        $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessing/assessor_assign_email_template', $email_data, TRUE);
                        // send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                        // ! Send email to assessor for cancled assessment
                        $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($assignedAssessor['assessment_batch_assessor_map_id_pk']);
                        $email_message = "Your assigned assessment has been cancled by State Admin, WBSCTVED";
                        // send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch Cancled");

                        $ajaxResponse = array(
                            'ok'  => 1,
                            'msg' => 'Success! Assessor assign successfully.'
                        );
                    } else {

                        $ajaxResponse = array(
                            'ok'     => 2,
                            'msg'    => 'Oops! Unable to assing assessor.',
                        );
                    }
                }
            } else {

                $ajaxResponse = array(
                    'ok'     => 2,
                    'msg'    => 'Oops! Data not found...',
                );
            }
        } else {

            $ajaxResponse = array(
                'ok'     => 0,
                'msg'    => 'Oops! Something went wrong.',
            );
        }

        echo json_encode($ajaxResponse);
    }

    private function test_findAssessor($check_array = NULL)
    {
        $check_result   = $this->assessing_batch_model->checkAssessor($check_array);
        $assessor_id_fk = NULL;

        if (!empty($check_result)) {

            $assessor_id_fk = $check_result[0]['assessor_id_fk'];
        } else {

            $map_district = $this->assessing_batch_model->getMapDistrict($check_array['district_id']);

            if (!empty($map_district)) {

                $map_district = array_column($map_district, 'district_map_id_fk');

                $check_array = array(
                    'course_id'       => $check_array['course_id'],
                    'district_ids'    => $map_district,
                    'assessment_date' => $check_array['assessment_date']
                );

                $check_result = $this->assessing_batch_model->checkAssessorForAnotherDistrict($check_array);

                echo $this->db->last_query();


                echo '<pre>';
                print_r($check_result);
                exit();


                if (!empty($check_result)) {

                    $assessor_id_fk = $check_result[0]['assessor_id_fk'];
                }
            }
        }

        return $assessor_id_fk;
    }

    public function testAssessorAssign()
    {
        $batch_id_hash = md5(1125);

        $login_assessor_id = 2864;

        $batch_info = $this->assessing_batch_model->getBatchInformation($batch_id_hash, $login_assessor_id)[0];

        $this->load->library('assessment');
        $assessor_data = $this->assessment->assignAssessor($batch_info);

        echo '<pre>';
        print_r($batch_info);
        print_r($assessor_data);
    }

    public function testEmaiFunction()
    {
        $to = 'birendra.singh.5070276@gmail.com';

        $msg = 'Hello Birendra';

        $status = send_email($to, $msg, "Test Email Function");

        if ($status) {
            echo 'Email sent successfully';
        } else {
            echo 'Unable to send email';
        }
    }

    // ! Get List of Assessor
    public function getChangeAssessorList($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {

                $data['id_hash'] = $id_hash;
                $batchDetails = $this->assessing_batch_model->getBatchInformation($id_hash)[0];

                // if ($batchDetails['assessment_scheme_id_fk'] == 1) { // ? 1: STT, 2: RPL
                if ($batchDetails['assessment_scheme_id_fk'] != 2) { // ? 1: STT, 2: RPL
                    $district_id = $batchDetails['district_id_pk'];
                } else {
                    $district_id = $batchDetails['preferred_district_id_pk'];
                }

                $mapDistrict = $this->assessing_batch_model->getMapDistrict($district_id);

                $mapDistrict = array_column($mapDistrict, 'district_map_id_fk');
                array_push($mapDistrict, $district_id);

                $check_array = array(
                    'course_id'       => $batchDetails['course_id_pk'],
                    'district_ids'    => $mapDistrict,
                    'assessment_date' => $batchDetails['proposed_assessment_date']
                );

                $data['assessorList'] = $this->assessing_batch_model->getChangeAssessorList($check_array);

                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessing/ajax/change_assessor_list_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // ! Change Assessor From Batch
    public function changeAssessorFromBatch()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            $assessor_id = $this->input->get('assessor_id');

            if (($id_hash != NULL) && ($assessor_id != NULL)) {

                $updateArray = array('active_status' => 0, 'process_id_fk' => 10, 'change_assessor_status' => 1);

                $status = $this->assessing_batch_model->markAssessorAsInability($id_hash, $updateArray);
                if ($status) {

                    $batchDetails = $this->assessing_batch_model->getBatchInformation($id_hash)[0];
                    $map_array = array(
                        'assessment_batch_id_fk'  => $batchDetails['assessment_batch_id_pk'],
                        'assessor_id_fk'              => $assessor_id,
                        'purpose_assessment_date' => $batchDetails['proposed_assessment_date'],
                        'active_status'           => 1,
                        'entry_by_id_fk'          => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_ip'                => $this->input->ip_address(),
                        'assessor_assign_notes'   => NULL,
                        'process_id_fk'           => $batchDetails['process_id_fk'],
                        'entry_by_stake_id_fk'    => $this->session->userdata('stake_id_fk'),
                    );

                    $map_id = $this->assessing_batch_model->createBatchAssessorMap($map_array);
                    if ($map_id) {

                        // Send email to assessor
                        $assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($map_id);

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

                        $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessing/assessor_assign_email_template', $email_data, TRUE);
                        send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                        echo json_encode('success');
                    }
                }
            }
        }
    }

    //  ! Get Assessors Remuneration Report
    public function assessorsRemunerationReport()
    {
        $result = $this->assessing_batch_model->assessorsRemunerationReport();
        foreach ($result as $key => $value) {

            $total_treainee = $this->assessing_batch_model->getTotalPresentTrainee($value['assessment_batch_id_pk']);
            $value['total_treainee'] = $total_treainee;

            $assessment_remuneration_rate = $this->config->item('assessment_remuneration_rate'); // ? 150
            $assessment_remuneration_max_rate = $this->config->item('assessment_remuneration_max_rate'); // ? 4000

            $amount = $total_treainee * $assessment_remuneration_rate;
            $value['amount'] = ($amount > $assessment_remuneration_max_rate) ? $assessment_remuneration_max_rate : $amount;

            $result[$key] = $value;
        }

        $this->load->library('excel');

        $fileName    = 'Assessors Remuneration Report - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Name of T.C.');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'T.C. Phone Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'District T.C.');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'District (Assessment Venue)');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Location (Address)');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Batch Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Date of Assessment');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Sector');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Name of Job Role');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Name of Assessor');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'PAN No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Mobile No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Bank Account Holder Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Bank Account No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'Bank IFSC Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'Bank Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'Branch Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'Total Present Trainee');
        $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'Total Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'Date of Issue of Certificate');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(31);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:U1')->applyFromArray($styleArray);
        $row = 2;

        foreach ($result as $batch) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $batch['user_tc_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $batch['tc_mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $batch['tc_district_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $batch['preferred_district_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $batch['preferred_location']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $batch['user_batch_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $batch['proposed_assessment_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $batch['sector_name'] . ' (' . $batch['sector_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $batch['course_name'] . ' (' . $batch['course_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $batch['fname'] . ' ' . $batch['mname'] . ' ' . $batch['lname']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $row, $batch['pan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $row, $batch['mobile_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $row, $batch['bank_account_holder_name']);
            $objPHPExcel->getActiveSheet()->setCellValueExplicit('O' . $row, $batch['bank_account_no'], PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $row, $batch['bank_ifsc']);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $row, $batch['bank_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('R' . $row, $batch['bank_branch_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('S' . $row, $batch['total_treainee']);
            $objPHPExcel->getActiveSheet()->SetCellValue('T' . $row, $batch['amount']);
            $objPHPExcel->getActiveSheet()->SetCellValue('U' . $row, date('Y-m-d', strtotime($batch['batch_marks_status_updated_date'])));

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':U' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':U' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/assessment/assessing/batch');
    }

    public function exportCssvseStudentMarksReport($course_code = NULL)
    {
        // $class_x = array('AGR/Q0402', 'AMH/Q0301', 'ASC/Q1401', 'BWS/Q0101', 'CON/Q0102', 'ELE/Q3104', 'HSS/Q5102', 'SSC/Q2212', 'PSC/Q0104', 'PSS/Q0107', 'RAS/Q0101', 'THC/Q0307', 'MEP/Q7101');
        // $class_xii_old = array('ASC/Q1402', 'CON/Q0103', 'ELE/Q4601', 'HSS/Q5101', 'SSC/Q0110', 'PSC/Q0110', 'RAS/Q0104', 'THC/Q4502', 'SSS/Q0101');

        $excel_data = $this->assessing_batch_model->exportCssvseStudentMarksReport($course_code);

        $fileName    = 'MIS Report for Marks Generation - ' . date('dmyhis') . '.xls';

        $this->load->library('excel');
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'UDISE Code')
            ->SetCellValue('C1', 'School Name')
            ->SetCellValue('D1', 'District')
            ->SetCellValue('E1', 'Registration No.')
            ->SetCellValue('F1', 'Student Name')
            ->SetCellValue('G1', 'Sex')
            ->SetCellValue('H1', 'Father Name')
            ->SetCellValue('I1', 'Full Marks QP')
            ->SetCellValue('J1', 'Marks Obtained')
            ->SetCellValue('K1', '% Marks')
            ->SetCellValue('L1', 'Marks Out of 50')
            ->SetCellValue('M1', 'Marks Out of 20')
            ->SetCellValue('N1', 'Total Marks');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);
        $row = 2;

        foreach ($excel_data as $batch) {

            $percentage = ($batch['total_marks'] * 100) / $batch['full_marks'];
            $percentage = number_format((float)$percentage, 2, '.', '');

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $batch['udise_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $batch['council_tc_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $batch['tc_district_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $batch['user_trainee_registration_no']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $batch['trainee_full_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $batch['trainee_gender']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $batch['trainee_guardian_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $batch['full_marks']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $batch['total_marks']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $percentage);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $row, round($percentage / 2));
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $row, $batch['internal_marks']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $row, (round($percentage / 2) + $batch['internal_marks']));

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':N' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':N' . $row)->getAlignment()->setWrapText(true);

            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':N' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':N' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/assessment/assessing/batch');
    }

    public function getProposeDate($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['batch_details'] = $this->assessing_batch_model->getProposeDateById($id_hash);

                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessing/ajax/change_propose_date_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // !! Change Propose Date
    public function change_propose_date()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $batch_id = $this->input->post('batch_id_hash');
            $propose_date = $this->input->post('propose_date');
            $batch_start_date = $this->input->post('start_date');
            $batch_end_date = $this->input->post('end_date');

            $propose_date = date('Y-m-d', strtotime($propose_date));
            $batch_start_date = date('Y-m-d', strtotime($batch_start_date));
            $batch_end_date = date('Y-m-d', strtotime($batch_end_date));

            if ($batch_id != '') {

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $result = $this->assessing_batch_model->getProposeDateById(md5($batch_id));

                // ! Check Assessor on that day
                $assessor_id = $result['assessor_id_fk'];
                $checkAssessor = $this->assessing_batch_model->checkAssessorOnthatDay($assessor_id, $propose_date);

                if (empty($checkAssessor)) {

                    $update_array = array(

                        'batch_start_date'          => $batch_start_date,
                        'batch_end_date'          => $batch_end_date,
                        'proposed_assessment_date'          => $propose_date,
                        'update_proposed_date_status'       => 1,
                        'updated_proposed_date_time'      => date('Y-m-d'),
                        'updated_proposed_date_ip'         => $this->input->ip_address(),
                        'updated_proposed_date_stake_id'  => $this->session->userdata('stake_id_fk'),
                        'updated_proposed_date_login_id'  => $this->session->userdata('stake_holder_login_id_pk'),

                    );

                    $batch_update_status = $this->assessing_batch_model->updateAssessmentBatchDetails($batch_id, $update_array);

                    if ($batch_update_status) {

                        $map_update_status = $this->assessing_batch_model->updateBatchAssessorMapByBatchId($batch_id, array('purpose_assessment_date' => $propose_date));

                        if ($this->db->trans_status() === FALSE) {

                            $this->db->trans_rollback(); # Something went wrong.
                        } else {

                            $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

                            /* 
                            ============================================= 
                            !   Send New Proposed date to the client    ! 
                            ============================================= 
                            */

                            // ! Prepare post data for api call
                            $this->load->library('apidata');
                            $changeProposedDateResponse = $this->apidata->changeProposedDateResponseData($batch_id);

                            // echo "<pre>";print_r($changeProposedDateResponse);exit;

                            $json_data_array = array(
                                'user_batch_code'              => $result['user_batch_id'],
                                'json_data_type_id_fk'         => 2,
                                'council_response_message_id_fk'         => 15,
                                'council_assessment_json_file' => json_encode($changeProposedDateResponse, TRUE),
                                'entry_ip'                     => $this->input->ip_address(),
                                'entry_by_login_id_fk'         => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_by_stake_id_fk'         => $this->session->userdata('stake_id_fk'),
                                'active_status'                => 1
                            );
                            $json_data_id = $this->assessing_batch_model->insertAssessmentjsonData($json_data_array);

                            // ! API Call for assessor is assigned
                            $this->load->config('wbsctvesd_api_config');
                            $url = $this->config->item('assessor_assign_url')[$result['vertical_code']];

                            $this->load->library('curl');
                            $curl_response = $this->curl->curl_make_post_request($url, $changeProposedDateResponse);

                            if (!$curl_response) {

                                $this->assessing_batch_model->updateAssessmentjsonData($json_data_id, array('response_status' => 0));
                            }
                            echo json_encode('done');
                        }
                    }
                } else {
                    $data['batch_details'] = $result;

                    $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessing/ajax/change_propose_date_view', $data, TRUE);

                    $return = array(
                        'msg' => 'Assessor have already assessment on ' . $propose_date . '.',
                        'html' => $html_view
                    );

                    echo json_encode($return);
                }
            }
        }
    }

    public function printingExpenditureReport()
    {
        $this->load->library('excel');

        $fileName    = 'Printing Expenditure Report - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Batch ID')
            ->SetCellValue('C1', 'Scheme Name')
            ->SetCellValue('D1', 'Date of Assessment')
            ->SetCellValue('E1', 'Sector')
            ->SetCellValue('F1', 'Job Role')
            ->SetCellValue('G1', 'Batch Size')
            ->SetCellValue('H1', 'Marks Foil')
            ->SetCellValue('I1', 'Attendance Sheet')
            ->SetCellValue('J1', 'Question Paper')
            ->SetCellValue('K1', 'Total No. of Pages')
            ->SetCellValue('L1', 'Total Amount (Rs) Considering Rs 2/- per page')
            ->SetCellValue('M1', 'Amount Claimed')
            ->SetCellValue('N1', 'Amount Payable (Lower Amount between col (11) and (12))')
            ->SetCellValue('O1', 'Scanned copy of Bills')
            ->SetCellValue('P1', 'Certificate Issued Date');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(70);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($styleArray);
        $row = 2;

        $excel_data = $this->assessing_batch_model->exportPrintingExpenditureReport();

        foreach ($excel_data as $data) {

            $total_amount = ($data['total_no_of_pages'] * 2);

            $amount_payable = ($data['amount_claimed'] > $total_amount) ? $total_amount : $data['amount_claimed'];

            switch ($data['assessment_scheme_id_fk']) {
                case 1:
                    $scheme_name = 'PBSSD STT';
                    break;

                case 2:
                    $scheme_name = 'PBSSD RPL';
                    break;

                default:
                    $scheme_name = 'CSSVSE';
                    break;
            }

            $download_link = '<a href="' . base_url('admin/assessment/assessor/batch/downloadPrintingExpenditureDoc/' . md5($data['printing_expenditure_id_pk'])) . '">Download</a>';


            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $data['user_batch_id']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $scheme_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $data['proposed_assessment_date']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $data['sector_name'] . ' (' . $data['sector_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $data['course_name'] . ' (' . $data['course_code'] . ')');
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $data['batch_size']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $data['marks_foil']);
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $data['attendance_sheet']);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $data['question_paper']);
            $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $data['total_no_of_pages']);
            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $row, $total_amount);
            $objPHPExcel->getActiveSheet()->SetCellValue('M' . $row, $data['amount_claimed']);
            $objPHPExcel->getActiveSheet()->SetCellValue('N' . $row, $amount_payable);
            $objPHPExcel->getActiveSheet()->SetCellValue('O' . $row, $download_link);
            $objPHPExcel->getActiveSheet()->SetCellValue('P' . $row, $data['batch_marks_status_updated_date']);

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':N' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':N' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':P' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':P' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/assessment/assessing/batch');
    }

    // Added By Moli For Batch Delete

    public function openBatchDeleteModal($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['batch_details'] = $this->assessing_batch_model->getBatchDetails($id_hash);

                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessing/ajax/batch_delete_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }
    

    // public function deleteAssessmentBatch(){

    //     if (!$this->input->is_ajax_request()) {
    //         exit('No direct script access allowed');
    //     } else {

    //         $batch_id = $this->input->post('batch_id_hash');
    //         $remarks = $this->input->post('remarks');

    //         if($batch_id !=''){

    //             $update_array = array(

    //                 'process_id_fk'          => 17,
    //                 'delete_remarks'          => $remarks,
    //                 'delete_time'      => date('Y-m-d'),
    //                 'delete_ip'         => $this->input->ip_address(),
    //                 'delete_by_stake_id'  => $this->session->userdata('stake_id_fk'),
    //                 'delete_by_login_id'  => $this->session->userdata('stake_holder_login_id_pk'),
    //                 // 'active_status'      =>0,

    //             );
    //             $batch_update_status = $this->assessing_batch_model->updateAssessmentBatchDetails($batch_id, $update_array);

    //             if($batch_update_status){
    //                 echo json_encode('done');
    //             }
    //         }
    //     }
    // }

    // public function deleteAssessmentBatch(){

    //     if ($this->input->server("REQUEST_METHOD") == "POST") {

    //         $batch_id = $this->input->post('batch_id_hash');
    //         $remarks = $this->input->post('remarks');

    //         if($batch_id !=''){

    //             $update_array = array(

    //                 'process_id_fk'          => 18,
    //                 'delete_remarks'          => $remarks,
    //                 'delete_time'      => date('Y-m-d'),
    //                 'delete_ip'         => $this->input->ip_address(),
    //                 'delete_by_stake_id'  => $this->session->userdata('stake_id_fk'),
    //                 'delete_by_login_id'  => $this->session->userdata('stake_holder_login_id_pk'),
    //                 // 'active_status'      =>0,

    //             );
    //             $batch_update_status = $this->assessing_batch_model->updateAssessmentBatchDetails($batch_id, $update_array);

    //             if($batch_update_status){
    //                  $this->session->set_flashdata('status', 'success');
    //                 $this->session->set_flashdata('alert_msg', 'Assessment batch successfully deleted.!');

    //                 redirect(base_url('admin/assessment/assessing/batch'), 'refresh');
    //             }else{
    //                 $this->session->set_flashdata('status', 'danger');
    //                 $this->session->set_flashdata('alert_msg', 'Oops! Unable to delete the assessment Batch, Please try again later.');

    //                 redirect(base_url('admin/assessment/assessing/batch'), 'refresh');
    //             }
    //         }
    //     }
    // }

    public function showDeleteRemarksModal($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['batch_details'] = $this->assessing_batch_model->getArchiveBatchDetails($id_hash);

                $html_view = $this->load->view($this->config->item('theme') . 'assessment/assessing/ajax/batch_delete_remarks_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }






    public function deleteAssessmentBatch(){

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $batch_id = $this->input->post('batch_id_hash');
            $remarks = $this->input->post('remarks');

            if($batch_id !=''){

                $batch_details = $this->assessing_batch_model->getBatchDetails(md5($batch_id));
                $trainee_details = $this->assessing_batch_model->getTraineeDetailsByBatchId($batch_id);

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $batch_delete = $this->assessing_batch_model->deleteAssessmentBatch($batch_id);

                if($batch_delete){

                    $archive_arr = array(
                        'delete_remarks'  => $remarks,
                        'archive_ip'		=> $this->input->ip_address(),
                        'archive_time'		=> date('Y-m-d H:i:s'),
                        'archive_by_stake_id'  => $this->session->userdata('stake_id_fk'),
                        'archive_by_login_id'  => $this->session->userdata('stake_holder_login_id_pk'),
                    );
                    $batch_archive_insert_arr = array();
                    $batch_archive_insert_arr = array_merge($batch_details,$archive_arr);

                    // echo "<pre>";print_r($batch_archive_insert_arr);exit;
                    $batchArchiveInsert = $this->assessing_batch_model->insertArchiveData($batch_archive_insert_arr,'council_assessment_batch_details_archive');

                    $trainee_delete = $this->assessing_batch_model->deleteTraineeByBatchId($batch_id);


                    if(count($trainee_details) > 0){

                        $traineeArchiveData = array();
                        for ($i=0; $i < count($trainee_details); $i++) {
                            
                            $archive_arr2 = array(
                                'archive_ip'		=> $this->input->ip_address(),
                                'archive_time'		=> date('Y-m-d H:i:s'),
                                'archive_by_stake_id'  => $this->session->userdata('stake_id_fk'),
                                'archive_by_login_id'  => $this->session->userdata('stake_holder_login_id_pk'),
                            );
                            $trainee_archive_insert_arr = array();
                            $trainee_archive_insert_arr = array_merge($trainee_details[$i],$archive_arr2);

                            array_push($traineeArchiveData,$trainee_archive_insert_arr);
                        }
                        $traineeArchiveInsert = $this->assessing_batch_model->insertMultipleData('council_assessment_trainee_details_archive',$traineeArchiveData);
                        // echo "<pre>";print_r($traineeArchiveData);exit;
                    }

                    

                    if ($this->db->trans_status() === FALSE) {

                        $this->db->trans_rollback(); # Something went wrong.
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to delete the assessment Batch, Please try again later.');

                    } else {

                        $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Assessment batch successfully deleted.!');
                    }

                    redirect(base_url('admin/assessment/assessing/batch'), 'refresh');
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to delete the assessment Batch, Please try again later.');

                    redirect(base_url('admin/assessment/assessing/batch'), 'refresh');
                }
            }
        }
    }
}

/* End of file Batch.php */
