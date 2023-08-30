<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_role extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege();
		$this->load->model('master/new_course_model');
		// $this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$this->load->library('excel');
		
		$fileName = 'JobRole-'.date('Yms').'-'.time().'.xls';  
        $results   = $this->new_course_model->misJobRoleReport();
		
		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		$objPHPExcel->getSecurity()->setLockWindows(true);
		$objPHPExcel->getSecurity()->setLockStructure(true);
		$objPHPExcel->getSecurity()->setWorkbookPassword('b5b1edcb187b3b3bb9e3e2bbca5421ed');
		
		$objPHPExcel->getProperties()->setCreator("COUNCIL")
			->setTitle("Job Role")
			->setSubject("Job Role")
			->setDescription("Job Role")
			->setKeywords("COUNCIL")
			->setCategory("COUNCIL");

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);					 	
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);

		$objPHPExcel->setActiveSheetIndex(0);
		
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Job Role');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Course Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Sector');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Minimum Qualification');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Domain Experience Required');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Domain Name');


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
			  
  $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);	
		
		$rowCount = 2;
		foreach ($results as $result) 
		{
			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $result['course_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $result['course_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $result['sector_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $result['minimum_educationl_qualification']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $result['domain_specific_working_experience']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $result['domain_name']);
			$rowCount++;
		}

		/* Create Folder If Not Exist */
		// $upload_path = "assets/excel/";
		// if(!is_dir($upload_path)) 
		// {
		// 	mkdir($upload_path, 0777, true);
		// }

		// $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		// $objWriter->save($upload_path.$fileName);
		
		// header("Content-Type: application/vnd.ms-excel");
		// redirect('admin/'.$upload_path.$fileName);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename='.$fileName);
		header('Cache-Control: max-age=0');
		
		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
		
	}

}
