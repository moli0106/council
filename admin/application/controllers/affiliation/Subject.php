<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(71);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/subject_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            //1 => $this->config->item('theme_uri') . 'affiliation/course_old1.js',
            1 => $this->config->item('theme_uri') . 'affiliation/course.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index(){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->subject_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['hsGroupTrade'] = $this->subject_model->getHsGroupTrade($data['vtc_id'], $data['academic_year']);

        // echo "<pre>";print_r($data['hsGroupTrade']);exit;

        $data['vtcSubjectList']  = $this->subject_model->getVtcAllSubjectList($data['vtc_id'], $data['academic_year']);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            // echo "<pre>";print_r($_POST);exit;

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'class_name',
                    'label' => 'Class',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'category_id',
                    'label' => 'Subject Category',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'group_id',
                    'label' => 'Group Name',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'subject_name_id[]',
                    'label' => 'Subject Name',
                    'rules' => 'trim|required',
                    
                ),
               
            );
            
            

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view', $data);

            } else {

                $insertArray = array(
                    'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'            => $data['academic_year'],
                    'class_name' =>   ($this->input->post('class_name') !='') ? $this->input->post('class_name'):NULL,
                    'group_id_fk'           => $this->input->post('group_id'),
                    'subject_category_id_fk'           => ($this->input->post('category_id')!='') ? $this->input->post('category_id'):NULL,
                    'entry_ip'                 => $this->input->ip_address(),
                    'entry_time'                => 'now()',
                );

                $this->db->trans_start(); # Starting Transaction

                $subjectSelectionId = $this->subject_model->insertVtcSubjectData($insertArray);

                if ($subjectSelectionId) {

                   

                    $subject_name_id = $this->input->post('subject_name_id');

                    if(count($subject_name_id) > 0){

                        $mapArray = array();
                        foreach ($subject_name_id as $key => $value) {

                            $tmp_array = array(

                                
                                'subject_name_id_fk' => $value,
                                'course_subject_id_fk'=>$subjectSelectionId,
                                'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                                'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                                'academic_year'            => $data['academic_year'],

                            );

                            array_push($mapArray,$tmp_array);
                        }
                    }

                    $result = $this->subject_model->insertBatchData('council_affiliation_vtc_course_selection_subject_map',$mapArray);

                    $data['vtcSubjectList']  = $this->subject_model->getVtcAllSubjectList($data['vtc_id'], $data['academic_year']);
                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add subject, Please try after sometime.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Subject added successfully.');
                    }

                    

                    // redirect('admin/affiliation/subject');
                    $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view', $data);
                   
                }else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    // redirect('admin/affiliation/subject');
                    $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view', $data);
                }

            }

        } else {
            $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view', $data);
        }

    }


    public function index_new(){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->subject_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['hsGroupTrade'] = $this->subject_model->getHsGroupTrade($data['vtc_id'], $data['academic_year']);

        // echo "<pre>";print_r($data['hsGroupTrade']);exit;

        $data['vtcSubjectList']  = $this->subject_model->getVtcAllSubjectList($data['vtc_id'], $data['academic_year']);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            // echo "<pre>";print_r($_POST);exit;

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'class_name',
                    'label' => 'Class',
                    'rules' => 'trim|required',
                    
                ),
                // array(
                //     'field' => 'category_id',
                //     'label' => 'Subject Category',
                //     'rules' => 'trim|required',
                    
                // ),
                array(
                    'field' => 'group_id',
                    'label' => 'Group Name',
                    'rules' => 'trim|required',
                    
                ),
                // array(
                //     'field' => 'subject_name_id[]',
                //     'label' => 'Subject Name',
                //     'rules' => 'trim|required',
                    
                // ),
               
            );
            $class_name_id = $this->input->post('class_name');
            $group_id = $this->input->post('group_id');

            if($class_name_id !='' && $group_id!=''){
                
                $data['subCategory'] = $this->subject_model->getAllSubjectAndCategory($class_name_id,$group_id);

                if(!empty($data['subCategory'])){
                    foreach ($data['subCategory'] as $key => $val) {
                        // foreach ($data['subCategory'][$key] as $value) {
                            $config[] = array(
                                'field' => strtolower(str_replace(" ","",$key)).'[]','label' => $key,'rules' => 'trim|required'
                            );
                        // }
                    }
                
                }
            }
            
            

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view_new', $data);

            } else {

                $insertArray = array(
                    'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'            => $data['academic_year'],
                    'class_name' =>   ($this->input->post('class_name') !='') ? $this->input->post('class_name'):NULL,
                    'group_id_fk'           => $this->input->post('group_id'),
                    'subject_category_id_fk'           => ($this->input->post('category_id')!='') ? $this->input->post('category_id'):NULL,
                    'entry_ip'                 => $this->input->ip_address(),
                    'entry_time'                => 'now()',
                );

                $this->db->trans_start(); # Starting Transaction

                $subjectSelectionId = $this->subject_model->insertVtcSubjectData($insertArray);

                if ($subjectSelectionId) {

                   

                    $subject_name_id = $this->input->post('subject_name_id');

                    if(count($subject_name_id) > 0){

                        $mapArray = array();
                        foreach ($subject_name_id as $key => $value) {

                            $tmp_array = array(

                                
                                'subject_name_id_fk' => $value,
                                'course_subject_id_fk'=>$subjectSelectionId,
                                'vtc_id_fk'                => $data['vtcDetails']['vtc_id_pk'],
                                'vtc_details_id_fk'        => $data['vtcDetails']['vtc_details_id_pk'],
                                'academic_year'            => $data['academic_year'],

                            );

                            array_push($mapArray,$tmp_array);
                        }
                    }

                    $result = $this->subject_model->insertBatchData('council_affiliation_vtc_course_selection_subject_map',$mapArray);

                    $data['vtcSubjectList']  = $this->subject_model->getVtcAllSubjectList($data['vtc_id'], $data['academic_year']);
                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add subject, Please try after sometime.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Subject added successfully.');
                    }

                    

                    // redirect('admin/affiliation/subject');
                    $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view_new', $data);
                   
                }else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    // redirect('admin/affiliation/subject');
                    $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view_new', $data);
                }

            }

        } else {
            $this->load->view($this->config->item('theme') . 'affiliation/subject/subject_view_new', $data);
        }

    }

    public function getSubjectCategoryByClassName(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $class_name_id = $this->input->get('class_name_id');
            if(!empty($class_name_id) && $class_name_id!= 'undefined'){
               
                $data['subCategory'] = $this->subject_model->getsubCategoryByClassName($class_name_id);

                // echo "<pre>";print_r( $data);exit;

                if (!empty($data['subCategory'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/subject_category_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Subject Category --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
    
               
            }

        }
    }

    public function getSubjectList(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $group = $this->input->get('group');
            if(!empty($group) && $group!= 'undefined'){

                $sub_cat_id = $this->input->get('category_id');

                
                $class_name = $this->input->get('class_name');

                
                $vtc_id         = $this->session->userdata('stake_details_id_fk');
                $academic_year  = $this->config->item('current_academic_year');
               
                $data['subjectName'] = $this->subject_model->getSubjectList($class_name, $group, $sub_cat_id, $vtc_id, $academic_year);

                // echo "<pre>";print_r( $data);exit;

                if (!empty($data['subjectName'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/courses/subject_name_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Subject Name --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
    
               
            }

        }
    }

    public function removeVtcSubject(){

        if(!$this->input->is_ajax_request()){
            exit('No direct script access allowed');
        }else{
            $id_hash = $this->input->get('id_hash');

            if (!empty($id_hash)) {

                $subjectDetails = $this->subject_model->getSubjectDetails($id_hash);
                // echo "<pre>";print_r($subjectDetails);exit;

                $subjectNameId = $this->subject_model->getSubjectFromMap($id_hash);
                $teacher_type = 1;

                $checkTeacher = $this->subject_model->getTeacher($subjectNameId,$subjectDetails['vtc_id_fk'], $subjectDetails['academic_year'], $teacher_type);

                // echo "<pre>";print_r($checkTeacher);exit;
                if(count($checkTeacher)!= 0){

                    $return = array(
                        'msg' => 'Delete is not possible ! Already mapped with teacher.'
                    );
                    echo json_encode($return);
                }else{

                    $this->subject_model->updateSubjectMap($id_hash, array('active_status' => 0));
                    $this->subject_model->updateSubjectSelection($id_hash, array('active_status' => 0));
                    echo json_encode('done');
                }

               


            }
        }
    }

    public function resetAllSubject()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');

            $vtcDetails = $this->subject_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

            
            $this->subject_model->resetTeacherSubjectMap($data['vtc_id'], $data['academic_year']);

            $this->subject_model->resetSubject($data['vtc_id'], $data['academic_year']);

            

            echo json_encode('done');
        }
    }

    // 18-07-2022

    public function getAllSubjectAndCategory(){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $class_name_id = $this->input->get('class_name_id');
            if(!empty($class_name_id) && $class_name_id!= 'undefined'){
               
                $group_id = $this->input->get('group_id');
                $data['subCategory'] = $this->subject_model->getAllSubjectAndCategory($class_name_id,$group_id);

                // echo "<pre>";print_r( $data['subCategory']);exit;

                if (!empty($data['subCategory'])) {

                    $html = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/subject/subject_category_view', $data, TRUE);
                } else {

                    $html = '<option value="" hidden="true">-- Select Subject Category --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
    
               
            }

        }
    }
    // 18-07-2022

    public function downloadExcelForSubject(){

        $this->load->library('excel');

        $fileName    = 'HS-Voc Subject List - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Group / Trade')
            ->SetCellValue('C1', 'Class')
            ->SetCellValue('D1', 'Subject Category')
            ->SetCellValue('E1', 'Subject');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);
       

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->applyFromArray($styleArray);
        $row = 2;

        
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');

        // echo "<pre>";print_r($data['hsGroupTrade']);exit;

        $vtcSubjectList  = $this->subject_model->getVtcAllSubjectList($data['vtc_id'], $data['academic_year']);

        foreach ($vtcSubjectList as $value) {

            if ($value['class_name'] == 1){
                $class = 'XI';
            }elseif ($value['class_name'] == 2) {
                $class = 'XII';
            }
            $subject = array();
            if (!empty($value['subject'])) {
                foreach ($value['subject'] as $sub) { 
                    $subject[] = $sub['subject_name'] .' ['.$sub['subject_code'] .']';
                }
                $subject_value = implode(' , ', $subject);
                
            }else{
                $subject_value = '';
            }
           
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['group_name'].' ['.$value['group_code'] .']');
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $class);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $value['subject_category_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $subject_value);
           
            

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':E' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':E' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':E' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':E' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/affiliation/subject');
    }
}