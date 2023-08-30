<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Infrastructure extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(120);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('master/infrastructure_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'master/infrastructure_item.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0){

        $data['offset'] = $offset;
       

        
        $data['infrastructureItem'] = $this->infrastructure_model->getAllInfrastructureItem(100, $offset);
        $data['infrastructureMapCourseList'] = $this->infrastructure_model->getAllInfrastructureMapCourseList(1000, $offset);
        $data['disciplineList'] = $this->infrastructure_model->getdisciplineList();
        $data['courseNameList'] = $this->infrastructure_model->getCourseNameList();
       
        // get course name
        

        // echo "<pre>";print_r($data['infrastructureMapCourseList']);exit;

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $submitInfrastructureItem = $this->input->post('submitInfrastructureItem');
            $mapInfrastructureWithCourse = $this->input->post('mapInfrastructureWithCourse');

            if($submitInfrastructureItem == 1){

                $config = array(
                    array(
                        'field' => 'item_name',
                        'label' => 'Item Name',
                        'rules' => 'trim|required|max_length[200]'
                        
                    ),

                    array(
                        'field' => 'category_name',
                        'label' => 'Category Name',
                        'rules' => 'trim|required|numeric'
                        
                    )
                    
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'master/vtc_infrastructure/infrastructure_view', $data);
                } else {

                    $post_data = array(
                        'item_name'  => $this->input->post('item_name'),
                        'category_name'  => $this->input->post('category_name'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                    );

                    $last_id = $this->infrastructure_model->insertInfrastructureItem($post_data);
                    if ($last_id) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Infrastructure Item added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                    redirect(base_url('admin/master/infrastructure'));
                }
            }elseif ($mapInfrastructureWithCourse == 2) {

                $config = array(
                    array(
                        'field' => 'course_name_id',
                        'label' => 'Course Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'discipline_id',
                        'label' => 'Discipline Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'course_id',
                        'label' => 'Group Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'item_id[]',
                        'label' => 'Item Name',
                        'rules' => 'trim|required'
                    ),
                    
                );
                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'master/vtc_infrastructure/infrastructure_view', $data);
                } else {

                    $infrastructure_item_id = $this->input->post('item_id');
                    if(count($infrastructure_item_id) > 0){

                        $mapDataArray = array();
                        foreach ($infrastructure_item_id as $key => $value) {
                           
                            $post_data = array(
                                'course_name_id_fk' => $this->input->post('course_name_id'),
                                'discipline_id_fk' => $this->input->post('discipline_id'),
                                'course_id_fk' => $this->input->post('course_id'),
                                'infrastructure_item_id_fk'  => $value,
                                'entry_ip'                  => $this->input->ip_address(),
                                'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                            );
                            array_push($mapDataArray, $post_data);
                        }
                       
                        if (!empty($mapDataArray)) {
    
                            $this->infrastructure_model->insertMultipleData('council_affiliation_infrastructure_item_course_map',$mapDataArray);
    
                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Successfully mapped Infrastructure Item with Course.');
                        } else {
                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                        }
                    }

                    


                    redirect(base_url('admin/master/infrastructure'));

                }

            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                redirect(base_url('admin/master/infrastructure'));
            }
        }else{

            $this->load->view($this->config->item('theme') . 'master/vtc_infrastructure/infrastructure_view', $data);
        }

    }

    public function getDisciplineList($course_name_id = NULL){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{
            if(!empty($course_name_id)){

                
                $discipline = $this->infrastructure_model->getdiscipline($course_name_id);
                

                $html = '<option value="" hidden="true">-- Select Discipline --</option>';
    
                if (!empty($discipline)) {
                    foreach ($discipline as $key => $value) {
                        $html .= '
                        <option value="' . $value['discipline_id_pk'] . '">
                            ' . $value['discipline_name'] . '
                        </option>
                    ';
                    }
                } else {
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
            }
        }
        

    }

    public function getGroupList($course_name_id = NULL, $discipline_id = NULL){
        
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{

            $course_name_id = $this->input->get('course_name_id');
            $discipline_id = $this->input->get('discipline_id');
           
            if(!empty($course_name_id) &&  !empty($discipline_id)){

                
                $group = $this->infrastructure_model->getgroupByDisciplineId($course_name_id , $discipline_id);

                $html = '<option value="" hidden="true">-- Select Group/Trade --</option>';
    
                if (!empty($group)) {
                    foreach ($group as $key => $value) {
                        $html .= '
                        <option value="' . $value['course_id_pk'] . '">
                            ' . $value['group_name'] . '[ '. $value['group_code'] .'] 
                        </option>
                    ';
                    }
                } else {
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
                

                
            }
        }

    }


    public function delete_infrastructure_item()
    {
       
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $id_hash = $this->input->post('item_id');

            $delete = $this->infrastructure_model->deleteInfrastructureItem($id_hash, array('active_status' => 0));
            if ($delete) {
                

                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Infrastructure Item deleted successfully.');
            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
            }

            redirect(base_url('admin/master/infrastructure'));
        }else{
            redirect(base_url('admin/master/infrastructure'));

        }
        
    }

    public function infrastructure_item_details($id_hash = NULL){

        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            if(!empty($id_hash)) {

                
                $data['itemDetails'] = $this->infrastructure_model->getInfrastructureItemDetails($id_hash);

                // echo "<pre>";print_r($data['itemDetails']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'master/vtc_infrastructure/ajax_view/item_details_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }

    }

    public function updateInfrastructureItem($id_hash = NULL){
        if (!$this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                if(!empty($id_hash)) {

                    $updateArray = array(
                        'item_name'  => $this->input->post('item_name'),
                        'category_name'  => $this->input->post('category_name'),
                        'update_ip'                  => $this->input->ip_address(),
                        'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'update_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                    );

                    $updateItem = $this->infrastructure_model->updateInfrastructureItem($updateArray,$id_hash );
                    if ($updateItem) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Infrastructure Item updated successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                    redirect(base_url('admin/master/infrastructure'));

                }

            }
        }
    }
    public function delete_infrastructure_map($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if (!empty($id_hash)) {

                $delete = $this->infrastructure_model->updateMapData($id_hash, array('active_status' => 0));
                if ($delete) {
                    echo json_encode('done');
                }
            }
        }
    }

    public function infrastructure_map_details($id_hash = NULL){
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            if(!empty($id_hash)) {

                $offset = 0;
                $data['infrastructureItem'] = $this->infrastructure_model->getAllInfrastructureItem(100, $offset);
                $data['disciplineList'] = $this->infrastructure_model->getdisciplineList();
                $data['map_details'] = $this->infrastructure_model->getInfrastructureMapDetails($id_hash);

                // echo "<pre>";print_r($data['map_details']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'master/vtc_infrastructure/ajax_view/item_course_map_details_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }
    }

    public function downloadExcel(){

        $this->load->library('excel');

        $fileName    = 'Map Infrastructure with course - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Course Name')
            ->SetCellValue('C1', 'Discipline')
            ->SetCellValue('D1', 'Group/Trade Name')
            ->SetCellValue('E1', 'Group/Trade Code')
            ->SetCellValue('F1', 'Infrastructure Item');
           
           

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
       
       

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);
        $row = 2;

        
        $infrastructureMapCourseList = $this->infrastructure_model->getAllInfrastructureMapCourseList($limit = NULL, $offset = NULL);

        foreach ($infrastructureMapCourseList as $value) {

           

           
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['course_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $value['discipline_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $value['group_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $value['group_code']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $value['item_name']);
            

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':F' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':F' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/master/infrastructure');
    }
}