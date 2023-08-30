<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_subject_details_mis extends NIC_Controller
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
		$this->load->view($this->config->item('theme') . 'mis/vtc_mis/vtc_subject_mis_view', $data);
		
	}

    public function download_subject_details($academic_year = NULL)
	{
		$academic_year = $this->uri->segment(4);

		$this->load->library('excel');

		$fileName = 'VTC_details_' . date('Yms') . '-' . time() . '.xls';
		$results   = $this->vtc_mis_model->getVtcHSSubjectDetails($academic_year);

		// echo "<pre>";print_r($results);die;

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);

        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(25);

		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(25);
		

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VTC code');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'VTC name');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'HOI Mobile no');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Group Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Group Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'class');

		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'language1_1');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'language1_2');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'language1_3');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'language1_4');

        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'academic elective 1');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'academic elective2');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'academic elective3');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'academic elective4');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'academic elective5');

        $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'vocational1');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'vocational2');
		$objPHPExcel->getActiveSheet()->SetCellValue('S1', 'vocational3');
		$objPHPExcel->getActiveSheet()->SetCellValue('T1', 'vocational4');

        $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'common1');
		$objPHPExcel->getActiveSheet()->SetCellValue('V1', 'common2');
		$objPHPExcel->getActiveSheet()->SetCellValue('W1', 'common3');
		$objPHPExcel->getActiveSheet()->SetCellValue('X1', 'common4');
		$objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'common4');
		$objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'common4');

		// $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'language1_4');
		


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

		$objPHPExcel->getActiveSheet()->getStyle('A1:Z1')->applyFromArray($styleArray);

		$rowCount = 2;
		foreach ($results as $result) {

			
			

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $result['vtc_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $result['vtc_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $result['hoi_mobile_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $result['group_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $result['group_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $result['class_name']);

			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $result['language1_subject'][0]['subject_name'].'['.$result['language1_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $result['language1_subject'][1]['subject_name'].'['.$result['language1_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $result['language1_subject'][2]['subject_name'].'['.$result['language1_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $result['language1_subject'][3]['subject_name'].'['.$result['language1_subject'][0]['subject_code'].']');

            $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $result['academic_electrive_subject'][0]['subject_name'].'['.$result['academic_electrive_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $result['academic_electrive_subject'][1]['subject_name'].'['.$result['academic_electrive_subject'][1]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $result['academic_electrive_subject'][2]['subject_name'].'['.$result['academic_electrive_subject'][2]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $result['academic_electrive_subject'][3]['subject_name'].'['.$result['academic_electrive_subject'][3]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $result['academic_electrive_subject'][4]['subject_name'].'['.$result['academic_electrive_subject'][4]['subject_code'].']');

            $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $result['vocational_subject'][0]['subject_name'].'['.$result['vocational_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $result['vocational_subject'][1]['subject_name'].'['.$result['vocational_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $result['vocational_subject'][2]['subject_name'].'['.$result['vocational_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $result['vocational_subject'][3]['subject_name'].'['.$result['vocational_subject'][0]['subject_code'].']');

            $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $result['common_subject'][0]['subject_name'].'['.$result['common_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $result['common_subject'][1]['subject_name'].'['.$result['common_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $result['common_subject'][2]['subject_name'].'['.$result['common_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('X' . $rowCount, $result['common_subject'][3]['subject_name'].'['.$result['common_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('Y' . $rowCount, $result['common_subject'][3]['subject_name'].'['.$result['common_subject'][0]['subject_code'].']');
			$objPHPExcel->getActiveSheet()->SetCellValue('Z' . $rowCount, $result['common_subject'][3]['subject_name'].'['.$result['common_subject'][0]['subject_code'].']');


			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':Z' . $rowCount)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':Z' . $rowCount)->getAlignment()->setWrapText(true);
			$rowCount++;
		}

		$objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':Z' . $rowCount);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':Z' . $rowCount)->applyFromArray($styleArrayFooter);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));


		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $fileName);
		header('Cache-Control: max-age=0');

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		redirect('admin/mis/vtc_subject_details_mis');

		
	}
}