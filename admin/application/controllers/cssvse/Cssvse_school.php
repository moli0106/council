<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cssvse_school extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(110);
        $this->load->model('cssvse/cssvse_school_model');
        $this->load->model('cssvse/student_model');
        $this->load->model('cssvse/school_model');
        // $this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'bower_components/select2/dist/css/select2.min.css',
        );

        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'cssvse/cssvse_school.js',
            3 => $this->config->item('theme_uri') . 'bower_components/select2/dist/js/select2.full.min.js',
            //2 => $this->config->item('theme_uri')."council/empanelled_assessor_list.js",
            4 => $this->config->item('theme_uri') . 'jQuery.print.min.js', // added parag 12-01-2021
        );
    }

    public function index($offset = 0)
    {


        $data['offset'] = $offset;

        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('udise_code', 'UDISE Code', 'trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->input->post('udise_code') == '') {

            $config['base_url']         = 'cssvse/cssvse_school/index/';
            $data["total_rows"]         = $config['total_rows'] = $this->cssvse_school_model->getSchoolListCount()[0]['count'];
            $config['per_page']         = 100;
            $config['num_links']        = 5;
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
            $data['schoolList']     = $this->cssvse_school_model->getSchoolList($config['per_page'], $offset);
        } else {

            $data['schoolList']         = $this->cssvse_school_model->get_school_search($this->input->post('udise_code'));
        }

        $this->load->view($this->config->item('theme') . 'cssvse/admin/school/school_list_view', $data);
    }

    public function school_details($school_id_pk = NULL)
    {

        // echo "<pre>";print_r($school_id_pk);exit;
        $check_registration_status = $this->cssvse_school_model->check_registration_status($school_id_pk)[0];
        // echo "<pre>";print_r($check_registration_status);exit;
        if ($check_registration_status['active_status'] == 1) {


            $data['school_id_pk'] = $school_id_pk;
            $data['districtList']  = $this->student_model->getDistrictList();
            $data['schoolDetails'] = $this->cssvse_school_model->getSchoolDetails($school_id_pk)[0];
            $data['municipality'] = $this->school_model->getMunicipalityByDistrict($data['schoolDetails']['district_id_fk']);
            $data['school_active_class'] = 'active';
            $data['student_active_class'] = NULL;
            // echo "<pre>";print_r($data);exit;
            // $this->load->view($this->config->item('theme') . 'cssvse/admin/school/school_details_view_old', $data);
            $this->load->view($this->config->item('theme') . 'cssvse/admin/school/school_details_view', $data);
        } else {

            $data['SchoolMasterDetails'] = $this->cssvse_school_model->getSchoolMasterDetails($school_id_pk)[0];
            $this->load->view($this->config->item('theme') . 'cssvse/admin/school/school_master_details_view', $data);
        }
    }

    public function schoolMasterUpdate($school_id_pk = NULL)
    {
        // echo "<pre>";print_r($_POST);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $udise_code = $this->input->post('udise_code');
            $school_email = $this->input->post('school_email');
            $hoi_email = $this->input->post('hoi_email');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'udise_code',
                    'label' => 'UDISE Code',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'school_email',
                    'label' => 'School email id',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'hoi_email',
                    'label' => 'HOI email',
                    'rules' => 'trim|required'
                )

            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Unable to update school Details, Please try after sometime.');
                // parent::pre(validation_errors());
                redirect(base_url('admin/cssvse/cssvse_school/details/' . $school_id_pk));
            } else {
                $updateArray = array(
                    'udise_code'           => $udise_code,
                    'hoi_email'      => $hoi_email,
                    'school_email'      => $school_email,
                );
                $this->cssvse_school_model->updateSchoolMaster($school_id_pk, $updateArray);
                $this->cssvse_school_model->updateStudentMaster($school_id_pk, $udise_code);
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'School Master has been Updated successfully.');

                redirect(base_url('admin/cssvse/cssvse_school'));
                exit();
            }
        }
    }

    public function student_list($school_id_pk = NULL)
    {

        $data['schoolDetails'] = $this->cssvse_school_model->getSchoolDetails($school_id_pk)[0];
        $data['school_id_pk'] = $school_id_pk;

        $data['school_active_class'] = NULL;
        $data['student_active_class'] = 'active';

        $udise_code = $data['schoolDetails']['udise_code'];
        $data['studentList'] = $this->cssvse_school_model->getStudentListByUdiseCode($udise_code);
        // echo "<pre>";print_r($data);exit;
        $this->load->view($this->config->item('theme') . 'cssvse/admin/school/student_list_view', $data);
    }

    public function student_details($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($id_hash != NULL) {

            $data['studentDetails'] = $this->student_model->getStudentDetails($id_hash);
            if (!empty($data['studentDetails'])) {

                $data['studentDetails'] = $data['studentDetails'][0];

                $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
                $data['school_data'] = $this->student_model->getRegDetails($data['school_reg_id_pk'])[0];

                $data['salutationList'] =  $this->student_model->getSalutation();
                $data['genderList'] =  $this->student_model->getGender();
                $data['districtList']  = $this->student_model->getDistrictList();
                $data['municipality'] = $this->student_model->getMunicipalityByDistrict($data['school_data']['district_id_fk']);
                $data['classList']  = $this->student_model->getClassList();
                $data['sectorList']  = $this->student_model->getSectorList();
                $data['courseList'] = $this->student_model->getCourseList($data['studentDetails']['sector_id_fk']);

                $data['start_year'] = date('Y') - 2;
                $data['end_year'] = date('Y') + 3;

                $html_view = $this->load->view($this->config->item('theme') . 'cssvse/admin/school/ajax/student_details_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }
    }

    public function getMunicipalityList($district_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($district_id != NULL) {

            $html = '<option value="" hidden="true">Select Block / Municipality / Corporation</option>';
            $municipality = $this->student_model->getMunicipalityByDistrict($district_id);

            if (!empty($municipality)) {
                foreach ($municipality as $key => $value) {
                    $html .= '
                    <option value="' . $value['block_municipality_id_pk'] . '">
                        ' . $value['block_municipality_name'] . '
                    </option>
                ';
                }
            } else {
                $html .= '<option>No Data Found...</option>';
            }
            echo json_encode($html);
        }
    }

    public function openUdiseModal()
    {
        $data['stdIdArray'] = $this->input->get('stdIdArray');
        $data['schoolId'] = $this->input->get('schoolId');
        // echo "<pre>";print_r($array);exit;
        $html_view = $this->load->view($this->config->item('theme') . 'cssvse/admin/school/ajax/change_udise_code_view', $data, TRUE);
        echo json_encode($html_view);
    }

    public function update_udise_code()
    {
        $udise_code = $this->input->post('udise_code');
        $student_id_hash = explode(",", $this->input->post('student_id_hash'));
        $old_school_id_hash = $this->input->post('school_id_hash');

        $check_udise_code = $this->cssvse_school_model->check_udise_code($udise_code)[0];
        if ($check_udise_code) {

            $get_school_reg_pk = $this->cssvse_school_model->get_school_reg_pk($udise_code)[0];
            if ($get_school_reg_pk) {
                $school_reg_id_pk = $get_school_reg_pk['school_reg_id_pk'];
            } else {
                $school_reg_id_pk = NULL;
            }
            foreach ($student_id_hash as $key => $value) {

                $update_array = array(
                    'school_id_fk' => $check_udise_code['school_id_pk'],
                    'udise_code' => $udise_code,
                    'school_reg_id_fk' => $school_reg_id_pk
                );
                $this->cssvse_school_model->updateStudentUdiseCode($value, $update_array);
            }

            $this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('alert_msg', 'UDISE code successfully changed');
            redirect(base_url('admin/cssvse/cssvse_school/student_list/' . $old_school_id_hash));
            exit();
        } else {
            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Oops! Please check udise code.');
            redirect(base_url('admin/cssvse/cssvse_school/student_list/' . $old_school_id_hash));
            exit();
        }
    }

    public function getSchoolReport()
    {
        $schoolData = $this->cssvse_school_model->getSchoolReport();

        $this->load->library('excel');

        $fileName = 'CSS-VSE School Report ' . date('Ymd')  . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(35);

        $objPHPExcel->setActiveSheetIndex(0);

        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'UDISE Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'School Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'HOI Contact No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'District.');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Whether Registered( Yes/No)');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Sector');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Job Role');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'No. of students (as per Excel Sheet)');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'No. of Student Added by School');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'No. of Student Registered');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Batch Created(yes/no)');
        $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Batch pushed to Council (Yes/No)');

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);

        $rowCount = 2;

        foreach ($schoolData as $key1 => $school) {
            foreach ($school['courseList'] as $key2 => $course) {

                $registered = ($school['active_status'] == 1) ? 'Yes' : 'No';
                $batchCreated = ($course['batch_id_pk'] != NULL) ? 'Yes' : 'No';
                $batchPushed = ($course['process_id_fk'] == 7) ? 'Yes' : 'No';

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $school['udise_code']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $school['school_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $school['hoi_mobile']);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $school['district_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $registered);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $course['sector_name'] . ' ' . $course['sector_code']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $course['course_name'] . ' ' . $course['course_code']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $course['added_by_excel']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $course['added_by_institute']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $course['total_student']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $batchCreated);
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $batchPushed);


                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':M' . $rowCount)->applyFromArray($styleCellArray);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':M' . $rowCount)->getAlignment()->setWrapText(true);

                $rowCount++;
            }
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':M' . $rowCount);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':M' . $rowCount)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $fileName);
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }
}
