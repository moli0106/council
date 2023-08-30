<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organization_preintimation extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(38);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('assessment/org_preintimation_model');
    }

    // ! List all assessment list
    public function index($offset = 0)
    {
        $data['offset'] = $offset;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['page_links']     = '';
            $data['sector_list']    = $this->org_preintimation_model->getAllSector();

            $searchArray = array(
                'sector_code'   => $this->input->post('sector_code'),
                'course_code'   => $this->input->post('course_code'),
            );

            $data['preintimation_list']  = $this->org_preintimation_model->searchPreintimation($searchArray);

            // parent::pre($data);
            $this->load->view($this->config->item('theme') . 'assessment/preintimation_list_view', $data);
        } else {
            $this->load->library('pagination');

            $config['base_url']         = 'assessment/organization_preintimation/index/';
            $data["total_rows"]         = $config['total_rows'] = $this->org_preintimation_model->getPreintimationCount()[0]['count'];
            $config['per_page']         = 10;
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
            $data['page_links'] = $this->pagination->create_links();

            $data['preintimation_list']  = $this->org_preintimation_model->getAllPreintimation($config['per_page'], $offset);

            $data['sector_list']    = $this->org_preintimation_model->getAllSector();

            // parent::pre($data);
            $this->load->view($this->config->item('theme') . 'assessment/organization_preintimation_list_view', $data);
        }
    }

    public function getCourseBySector($sector_code = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $sector_code = $this->input->get('sector_code');

            if ($sector_code != NULL) {

                $html   = '<option value="" hiddden="true">Select Course</option>';
                $result = $this->org_preintimation_model->getCourseBySector($sector_code);

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
	
	
	public function excel_download()
	{
        $this->load->library('excel');
		$fileName = 'Assessment-Pre-Intimation-Batch-List-'.date('Yms').'.xls';	// added by waseem on 09-10-2021
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
      	//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		//$objPHPExcel->getSecurity()->setLockWindows(true);
		//$objPHPExcel->getSecurity()->setLockStructure(true);
		//$objPHPExcel->getSecurity()->setWorkbookPassword('b5b1edcb187b3b3bb9e3e2bbca5421ed');
		
		$objPHPExcel->getProperties()->setCreator("Council")
									 ->setTitle("Assessment Pre-Intimation Batch List")
									 ->setSubject("Assessment Pre-Intimation Batch List")
									 ->setDescription("Assessment Pre-Intimation Batch List")
									 ->setKeywords("Council")
									 ->setCategory("Council");
		 $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
                                      ->SetCellValue('B1', 'Sector')
                                      ->SetCellValue('C1', 'Name Of Job Role')
                                      ->SetCellValue('D1', 'Job Role Code')
                                      ->SetCellValue('E1', 'TC District')							 
                                      ->SetCellValue('F1', 'Batch Start Date')
                                      ->SetCellValue('G1', 'Batch End Date')
                                      ->SetCellValue('H1', 'Tentative Assessment Date');
                                      
         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25); 
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
         $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		 
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
						'vertical'	 => PHPExcel_Style_Alignment::VERTICAL_CENTER,
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
						'vertical'	 => PHPExcel_Style_Alignment::VERTICAL_CENTER,
					),
					'fill' => array(
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => array('rgb' => 'FFF0F5')
					)
				
			);
        /*=============================== Excel style array ends ===============================*/
         $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);   
        $row = 2;
		
        $excel_data  = $this->org_preintimation_model->searchPreintimation($searchArray=NULL);
        //print_r($excel_data);die;                           	
        foreach($excel_data as $batch)
        {
			
			
        	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $row -1);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $batch['sector_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $batch['course_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $batch['course_code']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, $batch['tc_district_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, date('d-m-Y', strtotime($batch['batch_start_date'])));
        	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, date('d-m-Y', strtotime($batch['batch_end_date'])));
        	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, date('d-m-Y', strtotime($batch['batch_tentative_assessment_date'])));
        	
        	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->getAlignment()->setWrapText(true); 
       
            $row++;
        }	
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);	
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':H'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArrayFooter);	
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Report Generated On: '.date('dS M Y, h:i:s A'));
		 //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	// added by waseem on 09-10-2021
        //$objWriter->save($fileName);
		 header('Content-Type: application/vnd.ms-excel'); //mime type
		 header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
		 header('Cache-Control: max-age=0'); //no cach

		  //force user to download the Excel file without writing it to server's HD
         $objWriter->save('php://output'); 


		
		
	}
}
