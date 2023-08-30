<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zone_student_count extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(153);
        //$this->output->enable_profiler(TRUE);
        
         $this->load->model('spot_council/zone_wise_student_count_model');


        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',

           
            3 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            4 => $this->config->item('theme_uri') . 'council/css/autocomplete-jquery-ui.css',
        );

        $this->js_foot = array(
            // 1 => $this->config->item('theme_uri') . 'poly_institute/institute_list.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",

            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
            
            6 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            7  => $this->config->item('theme_uri') . 'council/js/autocomplete-jquery-ui.min.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
    }


    public function index()
    {

        $data['pref_zone'] = $this->zone_wise_student_count_model->get_prefzone_student_data();
         // echo "<pre>"; print_r($data['pref_zone1']); die;
        //$pref_zone2 = $this->zone_wise_student_count_model->get_prefzone2_student_data();
        // echo "<pre>"; print_r($pref_zone2); die;
       
       
        //echo "<pre>"; print_r($data['zone_count']); die;
        //$this->mis_student_count_report($district_id_fk,$data);

        $this->load->view($this->config->item('theme') . 'spot_council/zone_wise_student_count_view',$data);
        
    } 

    public function std_count_report()
    {
        $this->load->library('excel');
    
        $fileName    = 'All Student List - ' . date('dmyhis') . '.xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SL.NO')
            ->SetCellValue('B1', 'DISTRICT NAME')
            ->SetCellValue('C1', 'PREFERED ZONE 1')
            ->SetCellValue('D1', 'PREFERED ZONE 2');
            
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
    
            $objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
            $row = 2;
    
            
            // $studentUnderInstitute = $this->mis_list_model->getStudentListAllinstitute($vtcIDArray,$etype_name);
             
            $std_data_count = $this->zone_wise_student_count_model->get_prefzone_student_data();
              //echo '<pre>'; print_r($std_data_count); die;
            // $present_year =  date("Y"); 

           
    
            foreach ($std_data_count as $value) {
               
               

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['district_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $value['count1']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $value['count2'] );

                
                $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AD' . $row)->applyFromArray($styleCellArray);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AD' . $row)->getAlignment()->setWrapText(true);
                $row++;
            }
    
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':AD' . $row);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AD' . $row)->applyFromArray($styleArrayFooter);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));
    
            // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
    
            $objWriter->save('php://output');
    
            redirect('admin/spot_council/zone_student_count');
        }  
    

  

}