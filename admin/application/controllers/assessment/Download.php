<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('assessment/awarding_batch_model');
    }

    // ! Download Marksheet 
    public function marksheet()
    {
        $batch_code_hash        = $this->uri->segment(4);
        $trainee_code_hash      = $this->uri->segment(5);
        $certificate_code_hash  = $this->uri->segment(6);

        if (!empty($batch_code_hash) && !empty($trainee_code_hash) && !empty($certificate_code_hash)) {

            $traineeDetails    = $this->awarding_batch_model->downloadCertificateData($batch_code_hash, $trainee_code_hash, $certificate_code_hash);
            if (!empty($traineeDetails)) {

                $data['traineeDetails'] = $traineeDetails[0];
                $data['traineeNosDetails'] = $this->awarding_batch_model->getTraineeNosDetails($data['traineeDetails']['assessment_trainee_id_pk']);

                $data['qr_text'] = str_replace(' ', '-', $data['traineeDetails']['trainee_full_name']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_no']);

                // $data['qr_text'] = str_replace(' ', '_', $data['traineeDetails']['trainee_full_name']) . '_' . $data['traineeDetails']['user_trainee_registration_no'];

                $data['traineeQrCode'] = $this->qrcode($data['qr_text']);

                $remain_nos = 0;
                $total_nos  = count($data['traineeNosDetails']);

                if ($total_nos <= 10) {

                    $remain_nos = (10 - $total_nos);
                    $data['total_page'] = 1;
                } else {

                    $remain_nos = (26 - $total_nos);
                    $data['total_page'] = 2;
                }

                $data['traineeNosDetailsCopy'] = $data['traineeNosDetails'];

                if ($remain_nos != 0) {
                    for ($i = 0; $i < $remain_nos; $i++) {

                        $data['traineeNosDetails'][count($data['traineeNosDetails'])] = array(
                            'nos_code'            => '&nbsp;',
                            'nos_name'            => '&nbsp;',
                            'nos_type'            => '&nbsp;',
                            'nos_theory_marks'    => '&nbsp;',
                            'total_marks'         => '&nbsp;',
                        );
                    }
                }

                // parent::pre($data);
                //$this->load->view($this->config->item('theme') . 'assessment/awarding/marksheet/marksheet_for_pbssd_course', $data);

                $html   = $this->load->view($this->config->item('theme') . 'assessment/awarding/marksheet/marksheet_for_pbssd_course', $data, true);
                $pdfFilePath = 'Marksheet-' . date('dmY') . ".pdf";

                $this->load->library('m_pdf');
                $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
                $this->m_pdf->pdf->showWatermarkText = true;

                $this->m_pdf->pdf->WriteHTML(utf8_encode($html));

                // $this->m_pdf->pdf->Output($pdfFilePath, 'I');
                $this->m_pdf->pdf->Output($pdfFilePath, "D");
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function certificate()
    {
        $batch_code_hash        = $this->uri->segment(4);
        $trainee_code_hash      = $this->uri->segment(5);
        $certificate_code_hash  = $this->uri->segment(6);

        if (!empty($batch_code_hash) && !empty($trainee_code_hash) && !empty($certificate_code_hash)) {

            $traineeDetails    = $this->awarding_batch_model->downloadCertificateData($batch_code_hash, $trainee_code_hash, $certificate_code_hash);
            if (!empty($traineeDetails)) {

                $data['traineeDetails'] = $traineeDetails[0];
                $data['traineeNosDetails'] = $this->awarding_batch_model->getTraineeNosDetails($data['traineeDetails']['assessment_trainee_id_pk']);

                $total_marks = $total_marks_obtained = 0;
                foreach ($data['traineeNosDetails'] as $key => $value) {

                    $total_marks_obtained += $value['total_marks'];
                    $total_marks += ($value['nos_theory_marks'] + $value['nos_practical_marks'] + $value['nos_viva_marks']);
                }

                $data['trainee_percentage'] = round((($total_marks_obtained * 100) / $total_marks), 2);
                $data['qr_text'] = str_replace(' ', '-', $data['traineeDetails']['trainee_full_name']) . '_' . str_replace('/', '-', $data['traineeDetails']['certificate_no']);
                $data['traineeQrCode'] = $this->qrcode($data['qr_text']);
                // echo '<pre>';
                // print_r($data['trainee_percentage']);
                // exit();
                //$this->load->view($this->config->item('theme') . 'assessment/awarding/certificate/certificate_for_pbssd_short_term_course', $data);

                $html   = $this->load->view($this->config->item('theme') . 'assessment/awarding/certificate/certificate_for_pbssd_short_term_course', $data, true);
                $pdfFilePath = 'Certificate-' . $data['traineeDetails']['user_trainee_registration_no'] . '-' . date('dmY') . ".pdf";

                $this->load->library('m_pdf');
                $this->m_pdf->pdf->AddPage('L');
                $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
                $this->m_pdf->pdf->showWatermarkText = true;

                $this->m_pdf->pdf->WriteHTML($html);

                // $this->m_pdf->pdf->Output($pdfFilePath, 'I');
                $this->m_pdf->pdf->Output($pdfFilePath, "D");
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    // ! Generate QR Code of Trainee Information 
    public function qrcode($qrCodeData = NULL)
    {
        $this->load->library('ciqrcode');

        $traineeData  = explode('_', $qrCodeData);
        $traineeRegNo = end($traineeData);

        $params['level']    = 'H';
        $params['size']     = 10;
        $params['data']     = $qrCodeData;
        $params['savename'] = FCPATH . 'themes/adminlte/assessment/qr-code/' . $traineeRegNo . '.png';

        $this->ciqrcode->generate($params);

        $path   = $_SERVER['DOCUMENT_ROOT'] . '/admin/themes/adminlte/assessment/qr-code/' . $traineeRegNo . '.png';
        $type   = pathinfo($path, PATHINFO_EXTENSION);
        $data   = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        if (unlink($path)) {
            echo 'File deleted';
        } else {
            echo 'Cannot remove that file';
        }

        return $base64;
    }
}
