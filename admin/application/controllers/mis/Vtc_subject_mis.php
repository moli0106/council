<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_subject_mis extends NIC_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(149);
		$this->load->model('mis/vtc_mis_model');
		// $this->output->enable_profiler(TRUE);

		ini_set('memory_limit', '512M');
		ini_set('max_execution_time', 0);
	}

    public function index(){

		
		$data['yearlist']  = $this->vtc_mis_model->getAcademicYearList();
		$this->load->view($this->config->item('theme') . 'mis/vtc_mis/vtc_subject_details_view', $data);
		
	}

    public function download_subject_details($academic_year = NULL)
	{
		$academic_year = $this->uri->segment(4);

		$this->load->library('excel');

		$fileName = 'VTC_details_' . date('Yms') . '-' . time() . '.xls';
		$results   = $this->vtc_mis_model->getVtcHSSubjectCountDetails($academic_year);

		// echo "<pre>";print_r($results);die;

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
		

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VTC code');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'VTC name');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'HOI Mobile no');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Group Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Group Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'No of Vocational Paper in Class 12');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'No of Academic elective in class 12');
		


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

		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);

		$rowCount = 2;
		foreach ($results as $result) {

			$vocational_subject_count = count($result['vocational_subject']);
			$academic_elective_count = count($result['academic_elective_subject']);
			

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $result['vtc_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $result['vtc_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $result['hoi_mobile_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $result['group_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $result['group_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $vocational_subject_count);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $academic_elective_count);

			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':H' . $rowCount)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':H' . $rowCount)->getAlignment()->setWrapText(true);
			$rowCount++;
		}

		$objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':H' . $rowCount);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':H' . $rowCount)->applyFromArray($styleArrayFooter);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));


		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $fileName);
		header('Cache-Control: max-age=0');

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		redirect('admin/mis/vtc_subject_mis');

		
	}
}