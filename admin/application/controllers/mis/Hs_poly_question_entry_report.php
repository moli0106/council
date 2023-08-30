<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hs_poly_question_entry_report extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(102);
        $this->load->model('mis/hs_poly_question_entry_report_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
    }

    public function index($offset = 0){

		
		 $this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            2 => $this->config->item('theme_uri')."mis/question_bank_report.js",
            3 => $this->config->item('theme_uri').'jQuery.print.min.js', // added parag 12-01-2021
		);
		/*$data['sectors'] = $this->hs_poly_question_entry_report_model->get_all_sector();
		$data['programmes'] = $this->hs_poly_question_entry_report_model->get_programmes_query();
		$data['questions_type'] = $this->hs_poly_question_entry_report_model->get_questions_type_query();
		$data['questions_for'] = $this->hs_poly_question_entry_report_model->get_questions_for_query();
		$data['questions_type_trainee'] = $this->hs_poly_question_entry_report_model->get_questions_type_trainee_query();*/
        $data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'mis/hs_poly_question_entry_report/index/';
            $config['total_rows']       = $this->hs_poly_question_entry_report_model->question_bank_report_count()[0]['count'];	
            $config['per_page']         = 50;
            $config['num_links']        = 2;
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
            $data['question_bank']  	= $this->hs_poly_question_entry_report_model->get_question_bank_report($config['per_page'],$offset);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('sector_id', 'sector.', 'trim');
			//$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/ WBSCTVESD certified assessor', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
			
			if ($this->form_validation->run() == TRUE){
					$data['question_bank'] 		= $this->hs_poly_question_entry_report_model->question_bank_report_search($this->input->post('sector_id'),$this->input->post('course_id'),$this->input->post('programme_id'),$this->input->post('question_for_id'),$this->input->post('question_type_id'));
			} 
			else {
				$data['question_bank'] = array();
			}
		}
		if(set_value('sector_id') != NULL){
					
			$data['courses'] = $this->hs_poly_question_entry_report_model->get_course_query(set_value('sector_id'));
		}
			$data['offset']         = $offset;
		
        $this->load->view($this->config->item('theme').'mis/hs_poly_question_entry_report_view',$data);
    }

	public function get_course($sector_code)
	{
		if(is_numeric($sector_code))
		{
		$data['courses'] = $this->hs_poly_question_entry_report_model->get_course_query($sector_code);
		$this->load->view($this->config->item('theme').'mis/ajax/course_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

	public function get_question_type_trainee()
	{
		$data['questions_type'] = $this->hs_poly_question_entry_report_model->get_questions_type_trainee_query();
		$this->load->view($this->config->item('theme').'mis/ajax/question_type_ajax_view',$data);
		
	}

	public function get_question_type_assessor()
	{
		$data['questions_type'] = $this->hs_poly_question_entry_report_model->get_questions_type_query();
		$this->load->view($this->config->item('theme').'mis/ajax/question_type_ajax_view',$data);
		
	}


    public function excel_download()
	{
        $this->load->library('excel');
		$fileName = 'HS_Poly_Question_Bank_report_'.date('Yms').'.xls';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
      	//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		//$objPHPExcel->getSecurity()->setLockWindows(true);
		//$objPHPExcel->getSecurity()->setLockStructure(true);
		//$objPHPExcel->getSecurity()->setWorkbookPassword('b5b1edcb187b3b3bb9e3e2bbca5421ed');
		
		$objPHPExcel->getProperties()->setCreator("Council")
									 ->setTitle("Question Bank Report")
									 ->setSubject("Question Bank Report")
									 ->setDescription("Question Bank Report")
									 ->setKeywords("Council")
									 ->setCategory("Council");
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
                                      ->SetCellValue('B1', 'Course')
                                      ->SetCellValue('C1', 'Semester')
                                      ->SetCellValue('D1', 'Discipline')
                                      ->SetCellValue('E1', 'Group/Trade Name (Code)')							 
                                      ->SetCellValue('F1', 'Subject Category')							 							 
                                      ->SetCellValue('G1', 'Subject Name')
									  ->SetCellValue('H1', 'Subject Code')
                                      ->SetCellValue('I1', 'Question Creator name')
									  ->SetCellValue('J1', 'Question Creator ID')
                                      ->SetCellValue('K1', 'Email id')
                                      ->SetCellValue('L1', 'Mobile no')
                                      ->SetCellValue('M1', 'No of New question')
                                      ->SetCellValue('N1', 'Question submitted')
									  ->SetCellValue('O1', 'Question approved');
         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40); 
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
         $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
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
         $objPHPExcel->getActiveSheet()->getStyle('A1:O1')->applyFromArray($styleArray);   
        $row = 2;
        
		$excel_data  	= $this->hs_poly_question_entry_report_model->get_question_bank_report($limit = NULL, $offset = NULL);
        //$excel_data =  $this->tc_details_report_model->get_all_tc_by_tp_export($tp_id_hash);                           	
        foreach($excel_data as $qb_report)
        {
			
			
        	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $row -1);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $qb_report['course_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $qb_report['semester_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $qb_report['discipline_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, $qb_report['group_trade_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $qb_report['subject_category_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $qb_report['subject_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $qb_report['subject_code']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, $qb_report['qc_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $qb_report['creator_moderator_code']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $qb_report['email_id']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, $qb_report['mobile_no']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, $qb_report['new_question']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('N'.$row, $qb_report['question_set_submitted']);
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$row, $qb_report['question_set_approved']);
        	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':O'.$row)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':O'.$row)->getAlignment()->setWrapText(true); 
            $row++;
        }	
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);	
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':O'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':O'.$row)->applyFromArray($styleArrayFooter);	
		$objPHPExcel->getActiveSheet()->setCellValue('A'.$row, 'Report Generated On: '.date('dS M Y, h:i:s A'));
		//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        //$objWriter->save($fileName);
		 header('Content-Type: application/vnd.ms-excel'); //mime type
		 header('Content-Disposition: attachment;filename="'.$fileName.'"'); //tell browser what's the file name
		 header('Cache-Control: max-age=0'); //no cach

		  //force user to download the Excel file without writing it to server's HD
         $objWriter->save('php://output'); 
	
		
	}

     
}