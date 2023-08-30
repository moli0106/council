<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_type_mark extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(88);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('qbm_master/question_type_mark_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri') . "qbm_master/question_type_marks.js",
        );
    }

    public function index($offset = 0)
    {
        $data['offset'] = 0;
        $data['courseList'] = $this->question_type_mark_model->getCourseList();
        $data['questionCategoryCount'] = $this->question_type_mark_model->getQuestionCategoryCount()[0];
        $data['questionCategory'] = $this->question_type_mark_model->getAllQuestionCategory(100, $offset);
        $data['subjectMapCategoryList'] = $this->question_type_mark_model->getAllSubjectMapWithQuestionCategory(1000, $offset);

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $submitQuestionCategory = $this->input->post('submitQuestionCategory');
            $mapCategoryWithSubject = $this->input->post('mapCategoryWithSubject');

            if ($submitQuestionCategory == 1) {

                $config = array(
                    array(
                        'field' => 'question_type',
                        'label' => 'Question Type',
                        'rules' => 'trim|required|max_length[200]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),
                    array(
                        'field' => 'question_mark',
                        'label' => 'Question Mark',
                        'rules' => 'trim|required|numeric'
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'qbm_master/question_category/question_type_mark_list_view', $data);
                } else {

                    $post_data = array(
                        'question_type_name'  => $this->input->post('question_type'),
                        'question_mark'         => $this->input->post('question_mark'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                    );

                    $last_id = $this->question_type_mark_model->insertQuestionCategory($post_data);
                    if ($last_id) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Question Category/Type & Mark added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                    redirect(base_url('admin/qbm_master/question_type_mark'));
                }
            } elseif ($mapCategoryWithSubject == 2) {

                $config = array(
                    array(
                        'field' => 'course_id',
                        'label' => 'Course',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'sem_year_id',
                        'label' => 'Semester/Year',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'subject_id',
                        'label' => 'Subject',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'min_no_of_question',
                        'label' => 'Min. No. of Question',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'questionCategory',
                        'label' => 'Category/Type',
                        'rules' => 'trim|required|numeric'
                    ),
                );

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'qbm_master/question_category/question_type_mark_list_view', $data);
                } else {

                    $post_data = array(
                        'course_id_fk'            => $this->input->post('course_id'),
                        'sem_year_id_fk'         => $this->input->post('sem_year_id'),
                        'discipline_id_fk'       => NULL,
                        'group_trade_id_fk'             => NULL,
                        'subject_id_fk'         => $this->input->post('subject_id'),
                        'min_no_of_question'         => $this->input->post('min_no_of_question'),
                        'question_type_mark_id_fk'            => $this->input->post('questionCategory'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                    );

                    $last_id = $this->question_type_mark_model->insertSubjectMapWithQuestionCategory($post_data);
                    if ($last_id) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Subject successfully map with Question Category/Type.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                    redirect(base_url('admin/qbm_master/question_type_mark'));
                }
            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                redirect(base_url('admin/qbm_master/question_type_mark'));
            }
        } else {

            $this->load->view($this->config->item('theme') . 'qbm_master/question_category/question_type_mark_list_view', $data);
        }
    }

    public function getSemesterAndSubjectList($course_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_id = $this->input->get('course_id');
            if (!empty($course_id)) {

                $semester_list = $this->question_type_mark_model->getSemesterList($course_id);
                $subject_list = $this->question_type_mark_model->getSubjectByCourseId($course_id);

                $semester_html_view = '<option value="" hidden="true">Select Semester/Year</option>';
                $subject_html_view = '<option value="" hidden="true">Select Subject</option>';

                if (!empty($semester_list) && !empty($subject_list)) {
                    foreach ($semester_list as $key => $value) {

                        $semester_html_view .= '
							<option value="' . $value['semester_id_pk'] . '">
								' . $value['semester_name'] . '
							</option>
						';
                    }

                    foreach ($subject_list as $key => $value) {

                        $subject_html_view .= '
                            <option value="' . $value['subject_id_pk'] . '">
                                ' . $value['subject_name'] . ' [' . $value['subject_code'] . ']
                            </option>
						';
                    }
                } else {

                    $semester_html_view .= '<option value="" disabled="true">No data found...</option>';
                    $subject_html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode(array(
                    'semester_html_view' => $semester_html_view,
                    'subject_html_view' => $subject_html_view,
                ));
            }
        }
    }

    public function getSubjectByDiscipline()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $discipline_id = $this->input->get('discipline_id');
            if (!empty($discipline_id)) {

                $subject_list = $this->question_type_mark_model->getSubjectByDiscipline($discipline_id);

                $html_view = '<option value="">-- Select Subject --</option>';

                if (!empty($subject_list)) {
                    foreach ($subject_list as $key => $value) {

                        $html_view .= '
                        <option value="' . $value['subject_id_pk'] . '">
                            ' . $value['subject_name'] . ' [' . $value['subject_code'] . ']
                        </option>
                    ';
                    }
                } else {
                    $html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($html_view);
            }
        }
    }

    public function getGroupTrade()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $discipline_id = $this->input->get('discipline_id');
            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

            if (!empty($discipline_id)) {
                $group_trade_list = $this->question_type_mark_model->getGroupTrade($discipline_id);

                $html_view = '<option value="">-- Select Group/Trade --</option>';

                if (!empty($group_trade_list)) {
                    foreach ($group_trade_list as $key => $value) {

                        $html_view .= '
							<option value="' . $value['group_trade_id_pk'] . '">
								' . $value['group_trade_name'] . ' [' . $value['group_trade_code'] . ']
							</option>
						';
                    }
                } else {
                    $html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($html_view);
            }
        }
    }

    public function getSubjectByGroupTrade()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $group_trade_id = $this->input->get('group_trade_id');
            if (!empty($group_trade_id)) {

                $subject_list = $this->question_type_mark_model->getSubjectByGroupTrade($group_trade_id);

                $html_view = '<option value="">-- Select Subject --</option>';

                if (!empty($subject_list)) {
                    foreach ($subject_list as $key => $value) {

                        $html_view .= '
                        <option value="' . $value['subject_id_pk'] . '">
                            ' . $value['subject_name'] . ' [' . $value['subject_code'] . ']
                        </option>
                    ';
                    }
                } else {
                    $html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($html_view);
            }
        }
    }

    public function update($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $result = $this->question_type_mark_model->getQuestionCategoryById($id_hash);
            if (!empty($result)) {

                if ($this->input->server("REQUEST_METHOD") == 'POST') {

                    $data['form_data']['question_type_mark_id_pk']    = set_value('question_type_mark_id_pk');
                    $data['form_data']['question_type_name']    = set_value('question_type_name');
                    $data['form_data']['question_mark']          = set_value('question_mark');
                    $data['form_data']['hs_voc_xi']                 = set_value('hs_voc_xi');
                    $data['form_data']['hs_voc_xii']                 = set_value('hs_voc_xii');
                    $data['form_data']['polytechnic']              = set_value('polytechnic');
                    $data['form_data']['pharmacy']              = set_value('pharmacy');

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'question_type',
                            'label' => 'Question Type',
                            'rules' => 'trim|required|max_length[100]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                            'errors' => array(
                                'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                            )
                        ),
                        array(
                            'field' => 'question_mark',
                            'label' => 'Question Mark',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'hs_voc_xi',
                            'label' => 'HS-VOC (XI)',
                            'rules' => 'trim|numeric'
                        ),
                        array(
                            'field' => 'hs_voc_xii',
                            'label' => 'HS-VOC (XII)',
                            'rules' => 'trim|numeric'
                        ),
                        array(
                            'field' => 'polytechnic',
                            'label' => 'Polytechnic',
                            'rules' => 'trim|numeric'
                        ),
                        array(
                            'field' => 'pharmacy',
                            'label' => 'Pharmacy',
                            'rules' => 'trim|numeric'
                        ),
                    );
                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() != FALSE) {

                        $post_data = array(
                            'question_type_name'  => $this->input->post('question_type'),
                            'question_mark'         => $this->input->post('question_mark'),
                            'hs_voc_xi'                => ($this->input->post('hs_voc_xi') == NULL) ? NULL : $this->input->post('hs_voc_xi'),
                            'hs_voc_xii'               => ($this->input->post('hs_voc_xii') == NULL) ? NULL : $this->input->post('hs_voc_xii'),
                            'polytechnic'            => ($this->input->post('polytechnic') == NULL) ? NULL : $this->input->post('polytechnic'),
                            'pharmacy'             => ($this->input->post('pharmacy') == NULL) ? NULL : $this->input->post('pharmacy'),
                        );

                        $last_id = $this->question_type_mark_model->updateQuestionCategory($post_data, $this->input->post('question_type_mark_id_pk'));

                        if ($last_id) {

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Question Category/Type & Mark updated successfully.');
                        } else {
                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                        }

                        redirect('admin/qbm_master/question_type_mark');
                    }
                } else {

                    $data['form_data']['question_type_mark_id_pk']    = md5($result[0]['question_type_mark_id_pk']);
                    $data['form_data']['question_type_name']    = $result[0]['question_type_name'];
                    $data['form_data']['question_mark']          = $result[0]['question_mark'];
                    $data['form_data']['hs_voc_xi']                  = $result[0]['hs_voc_xi'];
                    $data['form_data']['hs_voc_xii']                 = $result[0]['hs_voc_xii'];
                    $data['form_data']['polytechnic']              = $result[0]['polytechnic'];
                    $data['form_data']['pharmacy']               = $result[0]['pharmacy'];
                }

                $this->load->view($this->config->item('theme') . 'qbm_master/question_category/question_type_mark_update_view', $data);
            } else {
                redirect(base_url('admin/qbm_master/question_type_mark'));
            }
        } else {
            redirect(base_url('admin/qbm_master/question_type_mark'));
        }
    }
	
	public function excel_download()
	{
        $this->load->library('excel');
		$fileName = 'Subject_map_with_Type_Marks_report_'.date('Yms').'.xls';
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
                                      ->SetCellValue('C1', 'Subjest Name')
                                      ->SetCellValue('D1', 'Subjest Code')
                                      ->SetCellValue('E1', 'Semester')							 
                                      ->SetCellValue('F1', 'Question Category/Type')							 							 
                                      ->SetCellValue('G1', 'Mark')
                                      ->SetCellValue('H1', 'Min. No. of Question');
                                   
         $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
         $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
         $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(40);
         $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15); 
         $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
         $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
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
        
		
		$excel_data = $this->question_type_mark_model->getAllSubjectMapWithQuestionCategory($limit = NULL, $offset = NULL);
        //$excel_data =  $this->tc_details_report_model->get_all_tc_by_tp_export($tp_id_hash);                           	
        foreach($excel_data as $question_type_mark)
        {
			
			
        	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$row, $row -1);
        	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$row, $question_type_mark['course_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('C'.$row, $question_type_mark['subject_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('D'.$row, $question_type_mark['subject_code']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('E'.$row, $question_type_mark['semester_name']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('F'.$row, $question_type_mark['question_type_name']);
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$row, $question_type_mark['question_mark']);
        	$objPHPExcel->getActiveSheet()->SetCellValue('H'.$row, $question_type_mark['min_no_of_question']);
        	
        	$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleCellArray);
			$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->getAlignment()->setWrapText(true); 
            $row++;
        }	
        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);	
		$objPHPExcel->getActiveSheet()->mergeCells('A'.$row.':H'.$row);
		$objPHPExcel->getActiveSheet()->getStyle('A'.$row.':H'.$row)->applyFromArray($styleArrayFooter);	
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
