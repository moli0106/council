<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_mis extends NIC_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(91);
		$this->load->model('mis/vtc_mis_model');
		// $this->output->enable_profiler(TRUE);

		// ini_set('memory_limit', '512M');
		ini_set('memory_limit', '-1');
		ini_set('max_execution_time', 0);
	}

	public function vtc_details(){

		
		$data['yearlist']  = $this->vtc_mis_model->getAcademicYearList();
		$this->load->view($this->config->item('theme') . 'mis/vtc_mis/vtc_details_view', $data);
		
	}

	public function download_vtc_details($academic_year = NULL)
	{
		$academic_year = $this->uri->segment(4);

		$this->load->library('excel');

		$fileName = 'VTC_details_' . date('Yms') . '-' . time() . '.xls';
		$results   = $this->vtc_mis_model->getVtcDetails($academic_year);

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
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VTC code');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'VTC name');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'VTC District');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'VTC email');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'HOI Mobile no.');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'HOI name');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'HOI email');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Type');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'District');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Sub-Division');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Municipality/Block');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Police Station');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Nodal');
		$objPHPExcel->getActiveSheet()->SetCellValue('O1', 'School with HS or eg in Regular Section (Y/N)');
		$objPHPExcel->getActiveSheet()->SetCellValue('P1', 'School with Mathematics in Regular Section (Y/N)');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'School with Biology in Regular Section (Y/N)');
		$objPHPExcel->getActiveSheet()->SetCellValue('R1', 'PartII Submited');


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

		$objPHPExcel->getActiveSheet()->getStyle('A1:R1')->applyFromArray($styleArray);

		$rowCount = 2;
		foreach ($results as $result) {
			$hs_equivalent = $hs_science = $hs_biology = 'No';

			if ($result['hs_equivalent'] == 1) {
				$hs_equivalent = 'Yes';
			}

			if ($result['hs_science'] == 1) {
				$hs_science = 'Yes';
			}

			if ($result['hs_biology'] == 1) {
				$hs_biology = 'Yes';
			}

			if ($result['second_final_submit_status'] == 1) {
				$second_final_submit_status = 'Yes';
			}else{
				$second_final_submit_status = 'No';
			}

			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $result['vtc_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $result['vtc_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $result['district_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $result['vtc_email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $result['hoi_mobile_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $result['hoi_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $result['hoi_email']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $result['vtc_type_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $result['district_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $result['subdiv_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $result['block_municipality_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $result['police_station']);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $result['nodal_centre_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $hs_equivalent);
			$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $hs_science);
			$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $hs_biology);
			$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $second_final_submit_status);

			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':R' . $rowCount)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':R' . $rowCount)->getAlignment()->setWrapText(true);
			$rowCount++;
		}

		$objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':R' . $rowCount);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':R' . $rowCount)->applyFromArray($styleArrayFooter);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));


		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $fileName);
		header('Cache-Control: max-age=0');

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		redirect('admin/mis/vtc_mis/vtc_details');

		
	}
	public function vtc_course_details(){

		$data['yearlist']  = $this->vtc_mis_model->getAcademicYearList();
		$this->load->view($this->config->item('theme') . 'mis/vtc_mis/vtc_course_details_view', $data);
	}

	public function download_vtc_course_details($academic_year = NULL)
	{
		$this->load->library('excel');

		$academic_year = $this->uri->segment(4);
		$fileName = 'VTC-Course- '.$academic_year.'-' . date('Yms') . '-' . time() . '.xls';
		// $academic_year  = $this->config->item('academic_year');

		
		if($academic_year == '2021-22'){

			$vtcCourseList   = $this->vtc_mis_model->getVtcCourseList($academic_year);
		}else{
			$vtcCourseList   = $this->vtc_mis_model->getVtcAllNewCourseList($academic_year);
		}
		// echo "<pre>";print_r($vtcCourseList);exit;

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);

		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VTC code');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'VTC name');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'VTC District');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'VTC email');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'HOI name');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'HOI Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'HOI Mobile No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Course name');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Discipline');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Group/Trade Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Group/Trade Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Student Admitted');

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

		$objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);

		$rowCount = 2;

		foreach ($vtcCourseList as $key => $result) {
			
			if($academic_year == '2021-22'){
				$vtcCourses = NULL;

				if (!empty($result['hs_voc_courses']) && !empty($result['stc_course'])) {

					$vtcCourses = $result['hs_voc_courses'] . ',' . $result['stc_course'];
				} elseif (!empty($result['hs_voc_courses'])) {

					$vtcCourses = $result['hs_voc_courses'];
				} elseif (!empty($result['stc_course'])) {

					$vtcCourses = $result['stc_course'];
				}

				$vtcCourseDetails   = $this->vtc_mis_model->getVtcCourseDetails(explode(',', $vtcCourses));
			}else{
				$vtcCourseDetails = $result['group'];
			}
			
			foreach ($vtcCourseDetails as $key2 => $course) {

				
				// added by moli
				if(array_key_exists("course_id_pk", $course)){
					$course_id_fk = $course['course_id_pk'];
				}else{
					$course_id_fk = $course['group_id_fk'];
				}

				if($academic_year == '2021-22'){
					$course_name = $course['course_name'];
					$discipline_name = $course['discipline_name'];

					$group_code = $result['group_code'];
				}else{
					$course_name = $result['course_name'];
					$discipline_name = $result['discipline_name'];

					$group_code = $course['group_code'];
				}

				

				$whereCondition = array(
					'vtc_id_fk'          => $result['vtc_id_pk'],
					//'vtc_details_id_fk' => $result['vtc_details_id_pk'],
					'academic_year'  => $academic_year,
					//'selected_year'    => date('Y'),
					'course_id_fk'    => $course_id_fk,
					'active_status'   => 1
				);
				$vtcStudentCount   = $this->vtc_mis_model->getVtcStudentCount($whereCondition);

				// echo "<pre>";print_r($vtcStudentCount);exit;

				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $result['vtc_code']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $result['vtc_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $result['district_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $result['vtc_email']);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $result['hoi_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $result['hoi_email']);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $result['hoi_mobile_no']);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $course_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $discipline_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $course['group_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $course['group_code']);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $vtcStudentCount[0]['enrolled_student']);


				$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':M' . $rowCount)->applyFromArray($styleCellArray);
				$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':M' . $rowCount)->getAlignment()->setWrapText(true);

				$rowCount++;
			}
		}

		$objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':M' . $rowCount);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':M' . $rowCount)->applyFromArray($styleArrayFooter);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));


		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $fileName);
		header('Cache-Control: max-age=0');

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	}

	public function vtc_teacher_details(){

		$data['yearlist']  = $this->vtc_mis_model->getAcademicYearList();
		$this->load->view($this->config->item('theme') . 'mis/vtc_mis/vtc_teacher_details_view', $data);

	}
	public function download_vtc_teacher_details($academic_year = NULL)
	{
		// $vtc_code = ['59','112'];
		// echo "<pre>";print_r($vtc_code);exit;
		$this->load->library('excel');

		$academic_year = $this->uri->segment(4);
		$teacher_type = $this->uri->segment(5);

		$fileName = 'VTC_teachers_details_' . date('Yms') . '-' . time() . '.xls';

		// modified by moli on 29-11-2022


		if($academic_year == '2021-22'){

			$results   = $this->vtc_mis_model->getVtcteacherList($academic_year,$teacher_type);
		}else{
			//$results   = $this->vtc_mis_model->getNewVtcTeacherList($academic_year,$teacher_type);

			$results   = $this->vtc_mis_model->getNewVtcHomeScTeacherList($academic_year,$teacher_type); //getting HS-Voc Home Sc teachers

		}


		// echo'<pre>';print_r($results);die;

		$objPHPExcel = new PHPExcel();

		$objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(45);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(35);
		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);



		$objPHPExcel->setActiveSheetIndex(0);

		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'VTC code');
		$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'VTC name');
		$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'VTC district');
		$objPHPExcel->getActiveSheet()->SetCellValue('E1', 'Group Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Teacher Type');
		$objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Teacher Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Email ID');
		$objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Designation');
		$objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Qualification');
		$objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Group Mapped');
		$objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Subject Mapped');
		$objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Mobile No.');
		$objPHPExcel->getActiveSheet()->SetCellValue('N1', 'iOSMS');




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

		$objPHPExcel->getActiveSheet()->getStyle('A1:N1')->applyFromArray($styleArray);

		$rowCount = 2;
		foreach ($results as $result) {

			if ($result['designation_name'] != '') {
				$designation = $result['designation_name'];
			} else {
				$designation = $result['other_designation'];
			}

			if ($result['group_code'] != '') {
				$group_code = $result['group_code'];
			} else {
				// $group_code = $result['course_name'];
				$group_code = '';
			}

			if ($result['qualification_name'] != '') {
				$qualification_name = $result['qualification_name'];
			} else {
				$qualification_name = $result['other_qualification'];
			}

			if ($result['teacher_type'] == 1) {
				$teacher_type = 'Teachers for Vocational papers of HS-Voc';
			} else if ($result['teacher_type'] == 2) {
				$teacher_type = 'Other Teacher for HS Voc / VIII+ / X+ STC';
			} else {
				$teacher_type = 'Teacher for Trade Subject of VIII+ / X+ STC';
			}

			$assign_group = array();
			$assign_sub = array();
			if(!empty($result['assignedGroup'])){

				foreach ($result['assignedGroup'] as $key => $value) {
					$group_name = $value['group_name'] .'[ '.$value['group_code'] .']';
					array_push($assign_group , $group_name);
				}
			}
			if(!empty($result['assignedSubject'])){

				foreach ($result['assignedSubject'] as $key1 => $value1) {
					$subject_name = $value1['subject_name'] .'[ '.$value1['subject_code'] .']';
					array_push($assign_sub , $subject_name);
				}
			}


			$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $rowCount - 1);
			$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $result['vtc_code']);
			$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $result['vtc_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $result['district_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $group_code);
			$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $teacher_type);
			$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $result['teacher_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $result['email_id']);
			$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $designation);
			$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $qualification_name);
			$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, (count($assign_group)=='')? '' :implode(",",$assign_group));
			$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, (count($assign_sub)=='')? '' :implode(",",$assign_sub));
			$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $result['mobile_no']);
			$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $result['employee_id']);



			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':N' . $rowCount)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':N' . $rowCount)->getAlignment()->setWrapText(true);
			$rowCount++;
		}

		$objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(20);
		$objPHPExcel->getActiveSheet()->mergeCells('A' . $rowCount . ':N' . $rowCount);
		$objPHPExcel->getActiveSheet()->getStyle('A' . $rowCount . ':N' . $rowCount)->applyFromArray($styleArrayFooter);
		$objPHPExcel->getActiveSheet()->setCellValue('A' . $rowCount, 'Report Generated On: ' . date('dS M Y, h:i:s A'));


		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename=' . $fileName);
		header('Cache-Control: max-age=0');

		//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// $objWriter->save('php://output');
		$objWriter->save(__DIR__.'/some_excel_file.xls'); 
		exit;
	}
}
