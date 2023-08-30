<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empanelled_assessor_list extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(31);
        $this->load->model('council/empanelled_assessor_list_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            2 => $this->config->item('theme_uri')."council/empanelled_assessor_list.js",
            3 => $this->config->item('theme_uri').'jQuery.print.min.js', // added parag 12-01-2021
			4 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
		);
    }

    public function index($offset = 0){
		
        $data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'council/empanelled_assessor_list/index/';
            $config['total_rows']       = $this->empanelled_assessor_list_model->assessor_count()[0]['count'];	
            $config['per_page']         = 50;
            $config['num_links']        = 4;
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
            $data['assessors']  	= $this->empanelled_assessor_list_model->get_assessor($config['per_page'],$offset);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim');
			//$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/ WBSCTVESD certified assessor', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

			if ($this->form_validation->run() == TRUE){
					$data['assessors'] 		= $this->empanelled_assessor_list_model->get_assessor_search($this->input->post('pan_no'));
			} 
			else {
				$data['assessors'] = array();
			}
		}
			$data['offset']         = $offset;
		
        $this->load->view($this->config->item('theme').'council/empanelled_assessor_list_view',$data);
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
		$fileName = 'Empanelled_Assessor_'.date('Yms').'.xls';	// added by waseem on 09-10-2021
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
      	//$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
		//$objPHPExcel->getSecurity()->setLockWindows(true);
		//$objPHPExcel->getSecurity()->setLockStructure(true);
		//$objPHPExcel->getSecurity()->setWorkbookPassword('b5b1edcb187b3b3bb9e3e2bbca5421ed');
		
		$objPHPExcel->getProperties()->setCreator("Council")
									 ->setTitle("Approved Assessor List")
									 ->setSubject("Approved Assessor List")
									 ->setDescription("Approved Assessor List")
									 ->setKeywords("Council")
									 ->setCategory("Council");
		 $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
                                      ->SetCellValue('B1', 'Assessor Name')
                                      ->SetCellValue('C1', 'PAN')
                                      ->SetCellValue('D1', 'Mobile no')
                                      ->SetCellValue('E1', 'Email id')							 
                                      ->SetCellValue('F1', 'District(Permanent)')							 							 
                                      ->SetCellValue('G1', 'District(Present)')							 							 
                                      ->SetCellValue('H1', 'Post Office(Present)')							 							 
                                      ->SetCellValue('I1', 'Police Station(Present)')
                                      ->SetCellValue('J1', 'Sector')
                                      ->SetCellValue('K1', 'Course')
									  ->SetCellValue('L1', 'Empanelment validity')
									  ->SetCellValue('M1', 'Empnamelment Status');
         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20); 
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
         $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(25);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(50);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
		 $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(25);
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
         $objPHPExcel->getActiveSheet()->getStyle('A1:M1')->applyFromArray($styleArray);   
        $row = 2;
        
		$excel_data  	= $this->empanelled_assessor_list_model->get_assessor();
        //$excel_data =  $this->tc_details_report_model->get_all_tc_by_tp_export($tp_id_hash);                           	
        foreach($excel_data as $assessor)
        {
			if($assessor['course_grouping_status']==0){$empl_status = 'Originally Empnameled';}else{$empl_status = 'Empaneled according to Group';}
			
        	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $row -1);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $assessor['assessor_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $assessor['pan']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $assessor['mobile_no']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, $assessor['email_id']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $assessor['permanent_district']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $assessor['present_district']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $assessor['post_opffice']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('I'.$row, $assessor['police']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('J'.$row, $assessor['sector_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('K'.$row, $assessor['course_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('L'.$row, date("d/m/Y", strtotime($assessor['empanelment_validity'])));
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$row, $empl_status);
        	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':M'.$row)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':M'.$row)->getAlignment()->setWrapText(true); 
       
            $row++;
        }	
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);	
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':M'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':M'.$row)->applyFromArray($styleArrayFooter);	
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


	public function list_course_map($id_hash = NULL,$emp_course_id)
    {
		
		if (!empty($id_hash)) {

			$data['emp_course']=$this->empanelled_assessor_list_model->getSectorJobRole($id_hash);
			//print_r($data['emp_course']);die;
			$course_ids = array_column($data['emp_course'], "course_id_fk");

			$data['course_map_details']=$this->empanelled_assessor_list_model->get_course_map_details($course_ids,$emp_course_id);
			//print_r($data['course_map_details']);die;
			//$nosDetails = $this->empanelled_assessor_list_model->updateNosType($id_hash, array('active_status' => 0));
			$this->load->view($this->config->item('theme').'council/course_wise_map_course_view',$data);
		}
    }

	public function add_course_group($course_id = NULL,$assessor_id_hash = NULL, $course_emp_id_hash = NULL){
		
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
			if (($course_id != NULL) && ($assessor_id_hash != NULL) && ($course_emp_id_hash != NULL)) {
				$assesserDetails = $this->empanelled_assessor_list_model->getAssesserInformation($assessor_id_hash)[0];
				$courseDetails = $this->empanelled_assessor_list_model->getCourseInformation($course_id)[0];
				$EmpanelmentValidityDetails = $this->empanelled_assessor_list_model->getEmpanelmentValidityInformation($course_emp_id_hash,$assessor_id_hash)[0];
				//print_r($EmpanelmentValidityDetails);die;
					if(!empty($assesserDetails) && !empty($courseDetails)){

					$map_array = array(
						
						'assessor_id_fk'        => $assesserDetails['assessor_registration_details_pk'],
						'batch_id_fk'           => 0,
						'sector_id_fk'          => $courseDetails['sector_id_fk'],
						'course_id_fk'          => $courseDetails['course_id_pk'],
						'empanelment_validity'  => $EmpanelmentValidityDetails['empanelment_validity'],
						'active_status'         => 1,
						'entry_time'           	=> 'now()',
						'entry_by'          	=> $this->session->userdata('stake_holder_login_id_pk'),
						'entry_ip'              => $this->input->ip_address(),
						'course_grouping_status'=> 1,
					);

					$map_id = $this->empanelled_assessor_list_model->createEmpanelledAssessorMap($map_array);
                    if ($map_id) {

                        // Send email to assessor
                        //$assignedAssessorResponse = $this->assessing_batch_model->assignedAssessorResponse($map_id);

                        // $email_data = array(
                        //     'assessor_details' => array(
                        //         'fname' => $assignedAssessorResponse['batch_details']['fname'],
                        //         'lname' => $assignedAssessorResponse['batch_details']['lname']
                        //     ),
                        //     'batch_details' => array(
                        //         'sector_code' => $assignedAssessorResponse['batch_details']['sector_code'],
                        //         'sector_name' => $assignedAssessorResponse['batch_details']['sector_name'],
                        //         'course_code' => $assignedAssessorResponse['batch_details']['course_code'],
                        //         'course_name' => $assignedAssessorResponse['batch_details']['course_name']
                        //     )
                        // );

                        // $email_message = $this->load->view($this->config->item('theme') . 'assessment/assessing/assessor_assign_email_template', $email_data, TRUE);
                        // send_email($assignedAssessorResponse['batch_details']['email_id'], $email_message, "Assessment Batch");

                        echo json_encode('success');
                    }
				}

			}
		}
	}

     
}