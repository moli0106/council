<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_group extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(120);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('master/affiliation_group_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
            2 => $this->config->item('theme_uri') . 'council/css/autocomplete-jquery-ui.css'
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'master/affiliation_course.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            4  => $this->config->item('theme_uri') . 'council/js/autocomplete-jquery-ui.min.js'
        );
    }

    public function index($offset = 0){

        $data['offset'] = $offset;

        $data['groupList'] = $this->affiliation_group_model->getAllGroupList();

        if ($this->input->server('REQUEST_METHOD') == "POST") {

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
                array(
                    'field' => 'group_code',
                    'label' => 'Group/Trade Code',
                    // 'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]|is_unique[council_affiliation_group_master.group_code]',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]|callback_check_group_code',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'master/affiliation_group/group_view',$data);
            } else {

                $post_data = array(
                    'group_name'  => $this->input->post('group_name'),
                    'group_code'  => $this->input->post('group_code'),
                    'entry_ip'                  => $this->input->ip_address(),
                    'entry_by_login_id'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                );

                $last_id = $this->affiliation_group_model->insertData('council_affiliation_group_master',$post_data);
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Group added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/master/affiliation_group'));
            }


           
        }else{

            $this->load->view($this->config->item('theme') . 'master/affiliation_group/group_view',$data);
        }

    }

    public function removeGroup(){

        if(!$this->input->is_ajax_request()){
            exit('No direct script access allowed');
        }else{

            $id_hash = $this->input->get('id_hash');
            if (!empty($id_hash)) {

               
                $this->affiliation_group_model->updateGroupMaster($id_hash, array('active_status' => 0));
                echo json_encode('Done');
            }
        }
    }

    public function check_group_code(){

        $group_code = $this->input->post('group_code');

        if($group_code !=''){

            $code_count = $this->affiliation_group_model->get_same_group_code($group_code);

            if($code_count['count'] == 0){
                return TRUE;
            } else {
                $this->form_validation->set_message('check_group_code', 'The group code field must contain a unique value. ');
                return FALSE;
            }
        }
    }

    public function downloadExcelForGroupList(){

        $this->load->library('excel');

        $fileName    = 'Affiliation Group List - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Group Name')
            ->SetCellValue('C1', 'Group Code');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
       

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
        $row = 2;

        
        $groupList = $this->affiliation_group_model->getAllGroupList();

        foreach ($groupList as $value) {
           
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['group_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $value['group_code']);
           
            

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':C' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':C' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':C' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':C' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        redirect('admin/master/affiliation_group');
    }

    public function affiliation_group_details($id_hash = NULL){

        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            if(!empty($id_hash)) {

                
                $data['groupDetails'] = $this->affiliation_group_model->getGroupDetails($id_hash);

                // echo "<pre>";print_r($data['groupDetails']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'master/affiliation_group/ajax_view/group_details_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }

    }

    public function updateGroupDetails($id_hash){

      
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if(!empty($id_hash)) {

                $updateArray = array(
                    'group_code'  => $this->input->post('group_code'),
                    'duration'  => $this->input->post('duration'),
                    'update_ip'                  => $this->input->ip_address(),
                    'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'update_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                );

                $updateItem = $this->affiliation_group_model->updateGroupMaster($id_hash, $updateArray);
                if ($updateItem) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Affiliation Group Details updated successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/master/affiliation_group'));

            }

        }else{

            redirect(base_url('admin/master/affiliation_group'));
        }
    }

    //

    public function getCourseList(){
    
        $sub = $this->input->get('sub');
         $query = "SELECT 
         course.course_id_pk, 
         course.sector_id_fk, 
         course.course_code, 
         course.course_name,
         sector.sector_name, 
         sector.sector_code
         FROM council_course_master as course
         left join council_sector_master as sector on sector.sector_id_pk = course.sector_id_fk 
         WHERE  course.course_name ilike '%".$sub."%' and course.active_status = 1 ";    
         $res = $this->db->query($query);
        // echo $this->db->last_query();
         // echo '<pre>';
         // print_r($res);
     
         $arrData = $res->result_array();
         //echo '<pre>';
        // echo'gg';
         //print_r($arrData); exit;
        $cart= array();
        foreach ($arrData as $key => $val){
            //array_push($cart , $val['course_id_pk'].','.$val['course_name']);
           array_push($cart , $val['course_name'].' '.'('.$val['course_code'].')' .'|'.$val['course_id_pk'].'|'.$val['sector_id_fk'].'|'. $val['sector_name'] );
        }
        //   echo '<pre>';
        //  // echo'gg';
        //   print_r($cart); exit;
                     
             echo json_encode($cart);
    }


    public function assessment_course_select($id_hash){

        if(!empty($id_hash)) {
    
            $data['groupDetails'] = $this->affiliation_group_model->getGroupDetails($id_hash);
    
            //echo "<pre>";print_r($data);exit;
            //$id = MD5($data['groupDetails']['group_id_pk']);
    
            //$html_view = $this->load->view($this->config->item('theme') . 'master/affiliation_group/ajax_view/group_details_view', $data, TRUE);
            //echo json_encode($html_view);
    
           $this->load->view($this->config->item('theme') . 'master/affiliation_group/select_assessment_course',$data);
        }
    
    
    }
}
