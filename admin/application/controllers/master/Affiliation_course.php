<?php
defined('BASEPATH') or exit('No direct script access allowed');

class affiliation_course extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(59);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/affiliation_course_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'master/affiliation_course.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0)
    {
        $data['offset'] = $offset;

        $this->load->library('pagination');

        $config['base_url']         = 'master/affiliation_course/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->affiliation_course_model->getCourseMasterCount()[0]['count'];
        $config['per_page']         = 500;
        $config['num_links']        = 3;
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
        $data['courseList']  = $this->affiliation_course_model->getCourseList($config['per_page'], $offset);

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_list_view', $data);
    }

    public function add()
    {
        $data['courseNameList'] = $this->affiliation_course_model->getCourseNameList();
        $data['streemNameList'] = $this->affiliation_course_model->getStreemNameList();
        $data['disciplineList'] = $this->affiliation_course_model->getDisciplineList();

        // Added by Moli on 09-06-2022

        $data['groupList'] = $this->affiliation_course_model->getGroupList();
        $data['subjectList'] = $this->affiliation_course_model->getSubjectList();
        $data['subjectCategory'] = $this->affiliation_course_model->getSubjectCategory();

        // Added by Moli on 09-06-2022

        // echo "<pre>";print_r($data);exit;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'group_name',
                    'label' => 'Group/Trade Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                // array(
                //     'field' => 'group_code',
                //     'label' => 'Group/Trade Code',
                //     'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                //     'errors' => array(
                //         'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                //     )
                // ),
                array(
                    'field' => 'course_name_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required|numeric'
                ),
                // array(
                //     'field' => 'streem_name_id',
                //     'label' => 'Streem Name',
                //     'rules' => 'trim|required|numeric'
                // ),
                array(
                    'field' => 'discipline_id',
                    'label' => 'Discipline',
                    'rules' => 'trim|required|numeric'
                ),

                // array(
                //     'field' => 'category_id',
                //     'label' => 'Subject Category',
                //     'rules' => 'trim|required|numeric'
                // ),
                // array(
                //     'field' => 'subject_name_id',
                //     'label' => 'Subject Name',
                //     'rules' => 'trim|required|numeric'
                // ),
            );

            // Added by moli 09-06-2022
            if($this->input->post('course_name_id') == 1){
                $config[] = array(
                    'field' => 'class_name','label' => 'Class','rules' => 'trim|required'
                );
                // $config[] = array(
                //     'field' => 'streem_name_id','label' => 'Streem Name','rules' => 'trim|required'
                // );

                $config[] = array(
                    'field' => 'category_id','label' => 'Subject Category','rules' => 'trim|required|numeric'
                );

                $config[] = array(
                    'field' => 'subject_name_id','label' => 'Subject Name','rules' => 'trim|required|numeric'
                );
            }

            if($this->input->post('category_id') != ''){

                $category_id = $this->input->post('category_id');
            }else{
                $category_id = NULL;
            }

            if($this->input->post('subject_name_id') != ''){

                $subject_name_id = $this->input->post('subject_name_id');
            }else{
                $subject_name_id = NULL;
            }

            if($this->input->post('streem_name_id') != ''){

                $streem_name_id = $this->input->post('streem_name_id');
            }else{
                $streem_name_id = NULL;
            }

            if($this->input->post('class_name') != ''){

                $class_name = $this->input->post('class_name');
            }else{
                $class_name = NULL;
            }

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_add_view', $data);
            } else {

                $group_id = $this->input->post('group_name');

                $getGroupDetails = $this->affiliation_course_model->getgroupDetailsById($group_id); //Added by Moli on 10-06-2022

                // echo "<pre>";print_r($getGroupDetails);exit;

                $insertArray = array(
                    'course_name_id_fk' => $this->input->post('course_name_id'),
                    'streem_name_id_fk' => $streem_name_id,
                    'discipline_id_fk'  => $this->input->post('discipline_id'),
                    // 'group_name'        => $this->input->post('group_name'),
                    // 'group_code'        => $this->input->post('group_code'),
                    'entry_ip'          => $this->input->ip_address(),
                    'entry_by_login_id' => $this->session->userdata('stake_holder_login_id_pk'),

                    //Added by Moli
                    'course_id_pk' => $group_id,
                    'group_name'        => $getGroupDetails['group_name'],
                    'group_code'        => $getGroupDetails['group_code'],
                    'subject_category_id_fk' => $category_id,
                    'subject_name_id_fk' => $subject_name_id,
                    'class_name' => $class_name,
                );
                // parent::pre($insertArray);

                $result = $this->affiliation_course_model->insertCourseMaster($insertArray);

                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Course Master added successfully.');

                    redirect('admin/master/affiliation_course');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/master/affiliation_course/add');
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_add_view', $data);
        }
    }

    public function removeCourseMaster()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            if (!empty($id_hash)) {

                $courseMaster = $this->affiliation_course_model->getCourseMasterByIdHash($id_hash);
                if (!empty($courseMaster)) {

                    $status = $this->affiliation_course_model->updateCourseMaster($id_hash, array('active_status' => 0));

                    if ($status) {
                        echo json_encode('Done');
                    }
                }
            }
        }
    }

    public function update($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $courseMaster = $this->affiliation_course_model->getCourseMasterByIdHash($id_hash);
            // echo "<pre>";print_r($courseMaster);exit;
            if (!empty($courseMaster)) {

                $data['courseMaster']   = $courseMaster[0];
                $data['courseNameList'] = $this->affiliation_course_model->getCourseNameList();
                $data['streemNameList'] = $this->affiliation_course_model->getStreemNameList();
                $data['disciplineList'] = $this->affiliation_course_model->getDisciplineList();

                // Added by Moli on 09-06-2022

                $data['groupList'] = $this->affiliation_course_model->getGroupList();
                $data['subjectList'] = $this->affiliation_course_model->getSubjectList();
                $data['subjectCategory'] = $this->affiliation_course_model->getSubjectCategory();

                // Added by Moli on 09-06-2022


                // parent::pre($data);

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $data['formData'] = array(
                        'course_name_id_fk' => set_value('course_name_id'),
                        'streem_name_id_fk' => set_value('streem_name_id'),
                        'group_name'        => set_value('group_name'),
                        'group_code'        => set_value('group_code'),
                        'discipline_id'     => set_value('discipline_id'),

                        // Added by Moli
                        'class_name' => set_value('class_name'),
                        'subject_name_id_fk' => set_value('subject_name_id'),
                        'subject_category_id_fk' => set_value('category_id'),
                    );
                } else {
                    $data['formData'] = array(
                        'course_name_id_fk' => $data['courseMaster']['course_name_id_fk'],
                        'streem_name_id_fk' => $data['courseMaster']['streem_name_id_fk'],
                        // 'group_name'        => $data['courseMaster']['group_name'],
                        'group_code'        => $data['courseMaster']['group_code'],
                        'discipline_id'     => $data['courseMaster']['discipline_id_fk'],
                        
                        // Added by Moli
                        'subject_name_id_fk'     => $data['courseMaster']['subject_name_id_fk'],
                        'subject_category_id_fk'     => $data['courseMaster']['subject_category_id_fk'],
                        'class_name'     => $data['courseMaster']['class_name'],
                        'group_name'        => $data['courseMaster']['course_id_pk'],

                    );
                }

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'group_name',
                            'label' => 'Group/Trade Name',
                            'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                            'errors' => array(
                                'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                            )
                        ),
                        // array(
                        //     'field' => 'group_code',
                        //     'label' => 'Group/Trade Code',
                        //     'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                        //     'errors' => array(
                        //         'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        //     )
                        // ),
                        array(
                            'field' => 'course_name_id',
                            'label' => 'Course Name',
                            'rules' => 'trim|required|numeric'
                        ),
                        // array(
                        //     'field' => 'streem_name_id',
                        //     'label' => 'Streem Name',
                        //     'rules' => 'trim|required|numeric'
                        // ),
                        array(
                            'field' => 'discipline_id',
                            'label' => 'Discipline',
                            'rules' => 'trim|required|numeric'
                        ),

                        // array(
                        //     'field' => 'category_id',
                        //     'label' => 'Subject Category',
                        //     'rules' => 'trim|required|numeric'
                        // ),
                        // array(
                        //     'field' => 'subject_name_id',
                        //     'label' => 'Subject Name',
                        //     'rules' => 'trim|required|numeric'
                        // ),
                    );

                    // Added by moli 09-06-2022

                    if($this->input->post('course_name_id') == 1){
                        $config[] = array(
                            'field' => 'class_name','label' => 'Class','rules' => 'trim|required'
                        );
                        // $config[] = array(
                        //     'field' => 'streem_name_id','label' => 'Streem Name','rules' => 'trim|required'
                        // );

                        $config[] = array(
                            'field' => 'category_id','label' => 'Subject Category','rules' => 'trim|required|numeric'
                        );
        
                        $config[] = array(
                            'field' => 'subject_name_id','label' => 'Subject Name','rules' => 'trim|required|numeric'
                        );
                    }

                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_update_view', $data);
                    } else {

                        $group_id = $this->input->post('group_name');

                        $getGroupDetails = $this->affiliation_course_model->getgroupDetailsById($group_id); //Added by Moli on 10-06-2022

                        if($this->input->post('streem_name_id') != ''){

                            $streem_name_id = $this->input->post('streem_name_id');
                        }else{
                            $streem_name_id = NULL;
                        }

                        if($this->input->post('class_name') != ''){

                            $class_name = $this->input->post('class_name');
                        }else{
                            $class_name = NULL;
                        }

                        if($this->input->post('category_id') != ''){

                            $category_id = $this->input->post('category_id');
                        }else{
                            $category_id = NULL;
                        }
                        
                        if($this->input->post('subject_name_id') != ''){
            
                            $subject_name_id = $this->input->post('subject_name_id');
                        }else{
                            $subject_name_id = NULL;
                        }

                        $updateArray = array(
                            'course_name_id_fk' => $this->input->post('course_name_id'),
                            'streem_name_id_fk' => $streem_name_id,
                            'discipline_id_fk'  => $this->input->post('discipline_id'),
                            // 'group_name'        => $this->input->post('group_name'),
                            // 'group_code'        => $this->input->post('group_code'),
                            'entry_ip'          => $this->input->ip_address(),
                            'entry_by_login_id' => $this->session->userdata('stake_holder_login_id_pk'),

                            //Added by Moli
                            'course_id_pk' => $group_id,
                            'group_name'        => $getGroupDetails['group_name'],
                            'group_code'        => $getGroupDetails['group_code'],
                            'subject_category_id_fk' => $category_id,
                            'subject_name_id_fk' => $subject_name_id,
                            'class_name' => $class_name,
                        );
                        // parent::pre($updateArray);

                        $result = $this->affiliation_course_model->updateCourseMaster($id_hash, $updateArray);

                        if ($result) {

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Course Master updated successfully.');

                            redirect('admin/master/affiliation_course');
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                            // redirect('admin/master/affiliation_course/add');
                            $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_update_view', $data);
                        }
                    }
                } else {

                    $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_update_view', $data);
                }
            } else {
                redirect('admin/master/affiliation_course');
            }
        } else {
            redirect('admin/master/affiliation_course');
        }
    }

    public function downloadExcelForCourseList(){

        $this->load->library('excel');

        $fileName    = 'Affiliation Course Master List - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Course Name')
            ->SetCellValue('C1', 'Discipline')
            ->SetCellValue('D1', 'Group/Trade Name')
            ->SetCellValue('E1', 'Group/Trade Code')
            ->SetCellValue('F1', 'Class')
            ->SetCellValue('G1', 'Subject Category')
            ->SetCellValue('H1', 'Subject Name')
            ->SetCellValue('I1', 'Subject Code');
           

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
       

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
        $row = 2;

        $courseList  = $this->affiliation_course_model->getCourseList($limit = NULL, $offset = NULL);

        foreach ($courseList as $value) {

            if($value['class_name'] != NULL){

                if($value['class_name'] == 1){
                    $class_name = 'XI'; 
                }elseif($value['class_name'] == 2){

                    $class_name = 'XII';
                }

            }else{
                $class_name = '--';
            }

           
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['course_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $value['discipline_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $value['group_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $value['group_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $class_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, ($value['subject_category_name'] != NULL) ? $value['subject_category_name'] : '--');
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, ($value['subject_name'] != NULL) ? $value['subject_name'] : '--');
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, ($value['subject_code'] != NULL) ? $value['subject_code'] : '--');
            

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':I' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':I' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/master/affiliation_course');
    }


}
