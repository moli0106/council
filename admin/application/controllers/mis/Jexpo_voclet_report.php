<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jexpo_voclet_report extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(57);
        $this->load->model('mis/jexpo_voclet_report_model');
        // $this->output->enable_profiler(TRUE);
    }

    public function index($offset = 0)
    {
        $searchArray = array();
        $stake_id_fk = $this->session->userdata('stake_id_fk');

        if (($stake_id_fk == 10) || ($stake_id_fk == 11)) {

            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
            $questionCreatorData = $this->jexpo_voclet_report_model->getQuestionCreatorData($stake_details_id_fk)[0];

            $searchArray = array(
                'exam_type' => $questionCreatorData['exam_type_id_fk'],
                'subject'   => $questionCreatorData['subject_id_fk'],
            );
        }

        $data['offset']     = $offset;
        $data['page_links'] = '';


        $data['subjectList']       = array();
        $data['examTypelList']     = $this->jexpo_voclet_report_model->getExamTypelList();
        $data['questionLevelList'] = $this->jexpo_voclet_report_model->getQuestionLevelList();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $search   = $this->input->post('search');
            $download = $this->input->post('download');

            $exam_type      = $this->input->post('exam_type');
            $subject        = $this->input->post('subject');
            $question_level = $this->input->post('question_level');

            if (!empty($exam_type)) {
                $data['subjectList'] = $this->jexpo_voclet_report_model->getsubjectListByExamType($exam_type);
            }

            $searchArray = array(
                'exam_type' => $this->input->post('exam_type'),
                'subject'   => $this->input->post('subject'),
                'level'     => $this->input->post('question_level'),
            );

            if (isset($search) && ($search == md5(100))) {

                $data['jexpoVocletReport'] = $this->jexpo_voclet_report_model->getJexpoVocletReport(NULL, NULL, $searchArray);
            } elseif (isset($download) && ($download == md5(200))) {

                $this->download($searchArray);
            } else {

                redirect('admin/mis/jexpo_voclet_report', 'refresh');
            }
        } else {
            $this->load->library('pagination');

            $config['base_url']         = 'mis/jexpo_voclet_report/index/';
            $config['total_rows']       = $this->jexpo_voclet_report_model->getCountData()[0]['count'];
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

            $data['jexpoVocletReport'] = $this->jexpo_voclet_report_model->getJexpoVocletReport($config['per_page'], $offset, $searchArray);
        }

        // parent::pre($data['jexpoVocletReport']);
        $this->load->view($this->config->item('theme') . 'mis/jexpo_voclet_report_view', $data);
    }

    public function download($searchArray = NULL)
    {
        $this->load->library('excel');

        $stake_id_fk = $this->session->userdata('stake_id_fk');
        if (($stake_id_fk == 10) || ($stake_id_fk == 11)) {

            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
            $questionCreatorData = $this->jexpo_voclet_report_model->getQuestionCreatorData($stake_details_id_fk)[0];

            $searchArray = array(
                'exam_type' => $questionCreatorData['exam_type_id_fk'],
                'subject'   => $questionCreatorData['subject_id_fk'],
            );
        }

        $fileName    = 'Jexpo Voclet Report [' . date('Yms') . '].xls';
        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Sl No')
            ->SetCellValue('B1', 'Exam Type')
            ->SetCellValue('C1', 'Subject')
            ->SetCellValue('D1', 'Question Level')
            ->SetCellValue('E1', 'Name of Paper Setter')
            ->SetCellValue('F1', 'No. of Questions Entered')
            ->SetCellValue('G1', 'Name of Moderator')
            ->SetCellValue('H1', 'No. of Questions Moderated');

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
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

        $jexpoVocletData = $this->jexpo_voclet_report_model->getJexpoVocletReport(NULL, NULL, $searchArray);
        foreach ($jexpoVocletData as $jexpoVoclet) {

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $row, $row - 1);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $row, $jexpoVoclet['exam_type_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $row, $jexpoVoclet['subject_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $row, $jexpoVoclet['level_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $row, $jexpoVoclet['creator_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $row, $jexpoVoclet['total_question']);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $row, $jexpoVoclet['moderator_name']);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $row, $jexpoVoclet['questions_moderated']);

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

    public function getSubject()
    {
        $exam_type = $this->input->get('exam_type');
        if (!empty($exam_type)) {

            $options = '<option value="" hidden="true">Select Subject</option>';
            $subjectList = $this->jexpo_voclet_report_model->getsubjectListByExamType($exam_type);
            if (!empty($subjectList)) {
                foreach ($subjectList as $key => $value) {

                    $options .= '<option value="' . $value['subject_id_pk'] . '">' . $value['subject_name'] . '</option>';
                }
            } else {
                $options .= '<option value="" disabled="true">No Data Found</option>';
            }
            echo json_encode($options);
        }
    }
}
