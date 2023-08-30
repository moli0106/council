<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empanelled_assessor_report extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(58);
        $this->load->model('mis/empanelled_assessor_report_model');
        //$this->output->enable_profiler();
    }

    public function index($offset = 0)
    {
        $data['offset']     = $offset;
        $data['page_links'] = '';
        $data['courseList'] = array();
        $data['sectorList'] = $this->empanelled_assessor_report_model->getSectorList();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $search   = $this->input->post('search');
            $download = $this->input->post('download');

            $sector_id      = $this->input->post('sector_id');
            $course_id      = $this->input->post('course_id');
			$pan_no         = $this->input->post('pan_no');

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'sector_id',
                    'label' => 'Sector ID',
                    'rules' => 'trim|numeric'
                ),
                array(
                    'field' => 'course_id',
                    'label' => 'Course ID ',
                    'rules' => 'trim|numeric'
                ),
                array(
                    'field' => 'pan_no',
                    'label' => 'pan ',
                    'rules' => 'trim'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == TRUE) {

                $searchArray = array(
                    'sector_id'  => $sector_id,
                    'course_id'  => $course_id,
					'pan'  => $pan_no,
                );

                if ($this->input->post('empanelled') == 1)
                    $searchArray['empanelled'] = 1;
                elseif ($this->input->post('empanelled') == 0 && $this->input->post('empanelled') != NULL)
                    $searchArray['empanelled'] = 2;

                if (!empty($sector_id)) {
                    $data['courseList'] = $this->empanelled_assessor_report_model->getCourseListBySectorId($sector_id);
                }

                if (isset($search) && ($search == md5(100))) {

                    $data['empanelledAssessorList'] = $this->empanelled_assessor_report_model->getEmpanelledAssessorReport(NULL, NULL, $searchArray);
					
                //} elseif (isset($download) && ($download == md5(200))) {

                   // $this->download($searchArray);
                } else {

                    redirect('admin/mis/empanelled_assessor_report', 'refresh');
                }
            }
        } else {
            $this->load->library('pagination');

            $config['base_url']         = 'mis/empanelled_assessor_report/index/';
            $config['total_rows']       = $this->empanelled_assessor_report_model->getCountData()[0]['count'];
            $config['per_page']         = 20;
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
            $data['page_links'] = $this->pagination->create_links();

            $data['empanelledAssessorList'] = $this->empanelled_assessor_report_model->getEmpanelledAssessorReport($config['per_page'], $offset);
        }
        // parent::pre($data['empanelledAssessorList']);
        $this->load->view($this->config->item('theme') . 'mis/empanelled_assessor_report_view', $data);
    }

    

    public function download_report($searchArray = NULL)
    {
        $this->load->library('excel');

        $fileName    = 'Empanelled Assessor Report [' . date('Yms') . '].xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Name of Approved Assessor')
            ->SetCellValue('C1', 'PAN')
            ->SetCellValue('D1', 'Sector')
            ->SetCellValue('E1', 'Job Roles')
            ->SetCellValue('F1', 'Whether Platform Training Completed (Yes/No)')
            ->SetCellValue('G1', 'Whether Domain Training Completed (Yes/No)')
            ->SetCellValue('H1', 'Whether Empanelled (Yes/No)');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(40);

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

        $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
        $row = 2;

        $excel_data = $this->empanelled_assessor_report_model->getEmpanelledAssessorReport(NULL, NULL, NULL);
        foreach ($excel_data as $assessor) {

            $platform = $domain = $empanelled = 'No';

            if($assessor['empanelled_id_pk']){
                $platform = $domain = $empanelled = 'Yes';
            }

            if($assessor['platform_training']){
                $platform = 'Yes';
            }
            
            if($assessor['domain_training']){
                $domain = 'Yes';
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $assessor['assessor_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $assessor['pan']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $assessor['sector_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $assessor['course_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $platform);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $domain);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $empanelled);

            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleCellArray);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->getAlignment()->setWrapText(true);
            $row++;
        }

        $objPHPExcel->getActiveSheet()->getRowDimension($row)->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->mergeCells('A' . $row . ':H' . $row);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $row . ':H' . $row)->applyFromArray($styleArrayFooter);
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, 'Report Generated On: ' . date('dS M Y, h:i:s A'));

        //$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');

        $objWriter->save('php://output');

        return true;
    }

	
	public function getCourse()
    {
        $sector_id = $this->input->get('sector_id');
        if (!empty($sector_id)) {

            $options = '<option value="" hidden="true">Select Job Roles</option>';
            $courseList = $this->empanelled_assessor_report_model->getCourseListBySectorId($sector_id);
            if (!empty($courseList)) {
                foreach ($courseList as $key => $value) {

                    $options .= '<option value="' . $value['course_id_pk'] . '">' . $value['course_name'] . '</option>';
                }
            } else {
                $options .= '<option value="" disabled="true">No Data Found</option>';
            }
            echo json_encode($options);
        }
    }
}
