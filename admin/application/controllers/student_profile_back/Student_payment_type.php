<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_payment_type extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(160);
        $this->load->model('student_profile/student_payment_type_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
            2 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
             2 => $this->config->item('theme_uri') . "student_profile/student_reg.js",
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            4 => $this->config->item('theme_uri').'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        );
    }
    public function index( $offset =0){
       
        //echo "hii";
        $data['offset'] = $offset;
        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $data['payment_types'] = $this->student_payment_type_model->getPaymentType($stake_id_fk,$data['std_id']);
        // echo "<pre>";print_r($data['payment_types']);exit;
        $this->load->view($this->config->item('theme') . 'student_profile/payment_type/payment_type_view',$data);

    }

    public function download_payment_receipt($transaction_id){
        $this->load->model('sbiepay/proceed_to_pay_model');
        if($transaction_id !=''){
            $data['transactionDetails'] = $this->proceed_to_pay_model->getTransactionDetailsByMarchandOrderNo($transaction_id);
            if(!empty($data['transactionDetails'])){
                $html = $this->load->view($this->config->item('theme') . 'sbiepay/payment_receipt_pdf_view', $data,true);

                $pdfFilePath = 'SBI-payment-' . date('dmY') . ".pdf";
        
                $this->load->library('m_pdf');
                $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
                $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
                $this->m_pdf->pdf->showWatermarkText = true;
    
                $this->m_pdf->pdf->WriteHTML($html);
    
                //download it.
                $this->m_pdf->pdf->Output($pdfFilePath, "I");
                // $this->m_pdf->pdf->Output($pdfFilePath, "D");
            }
        }else{
            redirect('admin/student_profile/student_payment_type');
        }
    }
}
?>