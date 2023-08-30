<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_list_iti extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(47);
        $this->load->model('council/assessor_list_iti_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
    }

    public function index($offset = 0){

		
		 $this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css'
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            //2 => $this->config->item('theme_uri')."council/empanelled_assessor_list.js",
            3 => $this->config->item('theme_uri').'jQuery.print.min.js', // added parag 12-01-2021
		);
		//$data['working_master'] = $this->assessor_list_iti_model->get_all_working_master();
		
        // $data['page_links'] = NULL;
        // $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
        //     $config['base_url']         = 'council/assessor_list_iti/index/';
        //     $config['total_rows']       = $this->assessor_list_iti_model->assessor_count()[0]['count'];	
        //     $config['per_page']         = 25;
        //     $config['num_links']        = 2;
        //     $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        //     $config['full_tag_close']   = '</ul>';
        //     $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        //     $config['first_tag_open']   = '<li class="">';
        //     $config['first_tag_close']  = '</li>';
        //     $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        //     $config['last_tag_open']    = '<li class="">';
        //     $config['last_tag_close']   = '</li>';
        //     $config['first_tag_open']   = '<li>';
        //     $config['first_tag_close']  = '</li>';
        //     $config['prev_link']        = '<i class="fa fa-backward"></i>';
        //     $config['prev_tag_open']    = '<li class="prev">';
        //     $config['prev_tag_close']   = '</li>';
        //     $config['next_link']        = '<i class="fa fa-forward"></i>';
        //     $config['next_tag_open']    = '<li>';
        //     $config['next_tag_close']   = '</li>';
        //     $config['last_tag_open']    = '<li>';
        //     $config['last_tag_close']   = '</li>';
        //     $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        //     $config['cur_tag_close']    = '</a></li>';
        //     $config['num_tag_open']     = '<li>';
        //     $config['num_tag_close']    = '</li>';
            
            
        //     $this->pagination->initialize($config);
            $data['assessors']  	= $this->assessor_list_iti_model->get_assessor();
            //$data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim');
			//$this->form_validation->set_rules('working_id', 'working', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

			if ($this->form_validation->run() == TRUE){
					$data['assessors'] 		= $this->assessor_list_iti_model->get_assessor_search($this->input->post('pan_no'),$this->input->post('working_id'));
			} 
			else {
				$data['assessors'] = array();
			}
		}
			$data['offset']         = $offset;
		
        $this->load->view($this->config->item('theme').'council/assessor_list_iti_view',$data);
    }




     //Get Job Role and Sector
    public function getSectorJobRole()
    {
        $rowId = $this->input->get('rowId');

        if($rowId)
        {
            $rawHtml     = '';
            $results = $this->empanelled_assessor_list_model->getSectorJobRole($rowId);

            if(count($results))
            {
                $count = 0;
                foreach ($results as $key => $result) 
                {
                    $rawHtml .= '
                        <tr>
                            <td>'.++$count.'</td>
                            <td>'.$result['sector_name'].'</td>
                            <td>'.$result['course_name'].'</td>
                        </tr>
                    ';
                }
            } else {
                $rawHtml .= '<tr><td colspan="3" align="center">No data found...</td></tr>';
            }

            echo json_encode($rawHtml);
        }
    }


    public function excel_download()
	{
        $this->load->library('excel');
		$fileName = 'Assessor_list_work_experience_wise_'.date('Yms').'.xls';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
      	//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		//$objPHPExcel->getSecurity()->setLockWindows(true);
		//$objPHPExcel->getSecurity()->setLockStructure(true);
		//$objPHPExcel->getSecurity()->setWorkbookPassword('b5b1edcb187b3b3bb9e3e2bbca5421ed');
		
		$objPHPExcel->getProperties()->setCreator("Council")
									 ->setTitle("Assessor List")
									 ->setSubject("Assessor List")
									 ->setDescription("Assessor List")
									 ->setKeywords("Council")
									 ->setCategory("Council");
		 $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
                                      ->SetCellValue('B1', 'Assessor Name')
                                      ->SetCellValue('C1', 'PAN')
                                      ->SetCellValue('D1', 'Mobile no')
                                      ->SetCellValue('E1', 'Organisation name')							 
                                      ->SetCellValue('F1', 'Area of work')	;						 							 
                                      
         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
         
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
         $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArray);   
        $row = 2;
        
		$excel_data  	= $this->assessor_list_iti_model->get_assessor();
        //$excel_data =  $this->tc_details_report_model->get_all_tc_by_tp_export($tp_id_hash);                           	
        foreach($excel_data as $assessor)
        {
        	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $row -1);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $assessor['assessor_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $assessor['pan']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $assessor['mobile_no']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, $assessor['organisation_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $assessor['area_of_work']);
        	
        	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->getAlignment()->setWrapText(true); 
            $row++;
        }	
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);	
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':F'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':F'.$row)->applyFromArray($styleArrayFooter);	
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