<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mis_list extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        // parent::check_privilege(66);
         parent::check_privilege(164);
        //$this->output->enable_profiler(TRUE);
        
         $this->load->model('poly_institute/mis_list_model');


        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',

           
            3 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            4 => $this->config->item('theme_uri') . 'council/css/autocomplete-jquery-ui.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'poly_institute/institute_list.js',
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


    public function index($offset = 0)
    {

            $this->load->library('excel');
    
            $fileName    = 'All Student Basic Information List - ' . date('dmyhis') . '.xls';
            $objPHPExcel = new PHPExcel();
    
            $objPHPExcel->setActiveSheetIndex(0);
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'SL.NO')
                ->SetCellValue('B1', 'STUDENT NAME')
                ->SetCellValue('C1', 'FATHER NAME')
                ->SetCellValue('D1', 'YEAR')
                ->SetCellValue('E1', 'SESSION')
                ->SetCellValue('F1', 'MOTHER NAME')
                ->SetCellValue('G1', 'GUARDIAN NAME')
                ->SetCellValue('H1', 'RELATIONSHIP WITH GUARDIAN')
                ->SetCellValue('I1', 'AADHAR NO')
                ->SetCellValue('J1', 'DATE OF BIRTH')
                ->SetCellValue('K1', 'KANYASHREE ID')
                ->SetCellValue('L1', 'Registration Number (Bangla Shiksha Portal)')
                ->SetCellValue('M1', 'MOBILE NO')
                ->SetCellValue('N1', 'EMAIL ID')
                ->SetCellValue('O1', 'RELIGION')
                ->SetCellValue('P1', 'NATION')
                ->SetCellValue('Q1', 'CASTE')
                ->SetCellValue('R1', 'PH (Y/N)')
                ->SetCellValue('S1', 'LLQ')
                ->SetCellValue('T1', 'TFW')
                ->SetCellValue('U1', 'GENDER')
                ->SetCellValue('V1', 'MARATIAL STATUS')
                ->SetCellValue('W1', 'ADDRESS')
                ->SetCellValue('X1', 'STATE')
                ->SetCellValue('Y1', 'PIN')
                ->SetCellValue('Z1', 'DIST')
                ->SetCellValue('AA1', 'INSTITUTE NAME')
                ->SetCellValue('AB1', 'INSTITUTE CODE')
                ->SetCellValue('AC1', 'EXAM TYPE - DIPLOMA 1st/LATERAL/PHARMACY')
                ->SetCellValue('AD1', 'BRANCH OR COURSE NAME')
                ->SetCellValue('AE1', 'BRANCH CODE .e. CE/ME/EE. ETC')
                ->SetCellValue('AF1', 'REGISTRATION NO GENERATED')
                ->SetCellValue('AG1', 'INSTITUTE TYPE')
                ->SetCellValue('AH1', 'INSTITUTE CATEGORY')
                ->SetCellValue('AI1', 'REJECTED/ APPROVED/REAPPROVED')
                ->SetCellValue('AJ1', 'REJECTED NOTE')
                ->SetCellValue('AK1', 'ACTIVE/ DEACTIVE STATUS')
                ->SetCellValue('AL1', 'ADMISSION TYPE - COUNSELLING/ MANAGEMENT/OTHERS')
                ->SetCellValue('AM1', 'BOARD NAME (MADHYAMIK/H.S.)')
                ->SetCellValue('AN1', 'NAME OF LAST INSTITUTE')
                ->SetCellValue('AO1', 'YEAR OF PASSING')
                ->SetCellValue('AP1', 'TOTAL AGGREGATE')
                ->SetCellValue('AQ1', 'MARKS OBTAINED')
                ->SetCellValue('AR1', 'PERCENTAGE')
                ;
    
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
    
            $objPHPExcel->getActiveSheet()->getStyle('A1:AS1')->applyFromArray($styleArray);
            $row = 2;
    
            
            $studentUnderInstitute = $this->mis_list_model->getStudentListAllinstitute();
             
            //  echo '<pre>'; print_r($studentUnderInstitute); die;
            $present_year =  date("Y"); 

           
    
            foreach ($studentUnderInstitute as $value) {

                
                // if($value['marital_status'] == 1){
                //     $m_status = 'Married';
                // }else if($value['marital_status'] == 2){
                //     $m_status = 'Unmarried';
                // }else{
                //     $m_status = '';
                // }
               
                if($value['handicapped'] ==1){
                    $handicapped = 'Yes';
                }else if($value['handicapped'] == 0){
                    $handicapped = 'No';
                }else{
                    $handicapped = '';
                }
               
                if($value['marital_status'] == 1){
                    $m_status = 'Married';
                }else if($value['marital_status'] == 2){
                    $m_status = 'Unmarried';
                }else{
                    $m_status = '';
                }

                
            if($value['vtc_type'] ==3){
                $inst_type = 'ET';
            }else if($value['vtc_type'] ==4){
                $inst_type = 'P';
            }else{
                $inst_type = 'P & ET';
            }

            if($value['approve_reject_status'] ==1){
                $approve_reject_status = 'Approved';
            }else if($value['approve_reject_status'] ==2){
                $approve_reject_status = 'Reapproved';
            }else if($value['approve_reject_status'] ==0){
                $approve_reject_status = 'Rejected';
            }else
            {
                $approve_reject_status='';
            }

            if($value['council_approvedreject_status'] ==1 || $value['council_approvedreject_status'] == NULL){
                $active_de_status = 'ACTIVE';
            }else if($value['council_approvedreject_status'] ==0){
                $active_de_status = 'DEACTIVE';
            } 

            if($value['admission_type'] ==1){

                $addmission = 'JEXPO/VOCLET/PHARMACY Counselling';
            }else if($value['admission_type'] ==2){
                $addmission = 'Under Management Quota';
            }else if(['admission_type'] ==3){
                $addmission = 'Other form of Admission';
            }else{

            } 

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $value['first_name'].$value['middle_name'].$value['last_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $value['father_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row,    $present_year);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $value['registration_year']);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $value['mothers_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $value['guardian_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $value['guardian_relationship']);
                $objPHPExcel->getActiveSheet()->SetCellValue('I' . $row, $value['aadhar_no']);
                $objPHPExcel->getActiveSheet()->SetCellValue('J' . $row, $value['date_of_birth']);
                $objPHPExcel->getActiveSheet()->SetCellValue('K' . $row, $value['kanyashree_no']);
                $objPHPExcel->getActiveSheet()->SetCellValue('L' . $row, $value['bangla_shiksha_reg_number']);
                $objPHPExcel->getActiveSheet()->SetCellValue('M' . $row, $value['mobile_number']);
                $objPHPExcel->getActiveSheet()->SetCellValue('N' . $row, $value['email']);
                $objPHPExcel->getActiveSheet()->SetCellValue('O' . $row, $value['religion_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('P' . $row, $value['nationality_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $row, $value['caste_name']);
                 $objPHPExcel->getActiveSheet()->SetCellValue('R' . $row, $handicapped);
                $objPHPExcel->getActiveSheet()->SetCellValue('S' . $row, $value['land_looser']);
                $objPHPExcel->getActiveSheet()->SetCellValue('T' . $row, $value['applied_under_tfw']);
                $objPHPExcel->getActiveSheet()->SetCellValue('U' . $row, $value['gender_description']);
                $objPHPExcel->getActiveSheet()->SetCellValue('V' . $row, $m_status);
                $objPHPExcel->getActiveSheet()->SetCellValue('W' . $row, $value['address'].$value['address_2'].$value['address_3']);
                $objPHPExcel->getActiveSheet()->SetCellValue('X' . $row, $value['state_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Y' . $row, $value['pincode']);
                $objPHPExcel->getActiveSheet()->SetCellValue('Z' . $row, $value['district_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AA' . $row, $value['vtc_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AB' . $row, $value['vtc_code']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AC' . $row, $value['name_for_std_reg']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AD' . $row, $value['discipline_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AE' . $row, $value['discipline_code']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AF' . $row, $value['reg_certificate_number']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AG' . $row, $inst_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('AH' . $row, $value['institute_category']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AI' . $row, $approve_reject_status);
                $objPHPExcel->getActiveSheet()->SetCellValue('AJ' . $row, $value['reject_note']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AK' . $row, $active_de_status);
                $objPHPExcel->getActiveSheet()->SetCellValue('AL' . $row, $addmission);
                $objPHPExcel->getActiveSheet()->SetCellValue('AM' . $row, $value['board_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AN' . $row, $value['institute_name']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AO' . $row, $value['year_of_passing']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AP' . $row, $value['fullmarks']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AQ' . $row, $value['marks_obtain']);
                $objPHPExcel->getActiveSheet()->SetCellValue('AR' . $row, $value['percentage']);
               
                
    
                $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AS' . $row)->applyFromArray($styleCellArray);
                $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AS' . $row)->getAlignment()->setWrapText(true);
                $row++;
            }
    
            $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':AS' . $row);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':AS' . $row)->applyFromArray($styleArrayFooter);
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));
    
            // $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '"');
            header('Cache-Control: max-age=0');
    
            $objWriter->save('php://output');
    
            redirect('admin/poly_institute/mis_list');
        
    }



}
