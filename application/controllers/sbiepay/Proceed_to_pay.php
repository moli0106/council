<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proceed_to_pay extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        
        $this->title = 'Councils ' . $this->title;
        $this->load->model('sbiepay/proceed_to_pay_model');

       
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'councils/css/datepicker.css',
        );
        $this->js_foot = array(
            //0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1  => $this->config->item('theme_uri') . 'councils/js/datepicker.js',
            //2 => $this->config->item('theme_uri') . 'sbiepay/payment.js',

            
        );
        $this->load->library('sms');
        
    }

    // public function index(){
    //     // echo $this->config->item('theme');exit;
    //     $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view');
    // }

    public function index($merchant_order_no = NULL){
        //echo "hhiii";exit;
        //echo "<pre>";print_r($_POST);exit;
        
        $data['payment_type'] = $_POST['payment_type'];
       

        // ******** after getting SBI response , this response showing user end ***********
        if($merchant_order_no !=''){
            $getTransactionDetails = $this->proceed_to_pay_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
            if($getTransactionDetails['response_status'] == 1){
                $data['res_status'] = 1;

                // Get Mobile No
                $get_mobile_no = $this->proceed_to_pay_model->getMobileNo($getTransactionDetails['stake_details_id_fk']);
                $sms_message = "You have made payment of Rs. ".$getTransactionDetails['posting_amount']." (Poly/VOC) with WBSCT&VE&SD for the session 2022-23 ";
                //$template_id = 1707167542331449910;
                $template_id = 0;
                $this->sms->send($get_mobile_no['mobile_number'], $sms_message, $template_id);
                
            }elseif($getTransactionDetails['response_status'] == 0){
                $data['res_status'] = 0;
            }
            $data['posting_amount'] = $getTransactionDetails['posting_amount'];
            $data['sbiepay_ref_id'] = $getTransactionDetails['sbiepay_ref_id'];
            $data['transaction_id'] = $getTransactionDetails['transaction_id'];


            
        }else{
            $data['res_status'] = '';
        }

        //$data['res_status'] = $status; // 1 For Success and 2 For Failure
        if($data['res_status'] == ''){

            // *** Payment Type
            //      *1 for VTC Student Registration Fee , *2 For Institute Student Registration Fee
            // ***
            
            if($data['payment_type'] == 3){

                $data['pay_for'] ='Jexpo/Voclet Online Exam Fee';

                
               
                $data['total_std'] = 0;
                

                
                $data['details']['stake_details_id_fk'] = $_POST['stake_details_id_fk'];
                
                $data['other_details'] = 'JexpoOnlineExamFee';

                $stdDetails  = $this->registration_model->getStdDetailsByIdHash(md5($_POST['stake_details_id_fk']));
                if($stdDetails['kanyashree_unique_id'] ==''){
                    $data['details']['total_amount'] = 450;
                }else{
                    $data['details']['total_amount'] = 250;
                }
            }
            $data['transaction_id'] = $this->generateMerchantOrderNo();
            
            $this->load->config('wbsctvesd_api_config');
            $url = $this->config->item('sbi_e_pay')['request_url'];
            $success_url = $this->config->item('sbi_e_pay')['success_url'];
            $failure_url = $this->config->item('sbi_e_pay')['failure_url'];
            $merchantId =  $this->config->item('sbi_e_pay')['merchantId'];

            $post_data = array(
                'posting_amount' => $data['details']['total_amount'],
                //'posting_amount' => 1,
                'success_url'   => $success_url,
                'failure_url'   =>  $failure_url,
                'merchantId'    => $merchantId,
                'merchant_order_no' => $data['transaction_id'],
                'other_details' => $data['other_details'],
            );
            
       
            // echo "<pre>";print_r($post_data);

            $this->load->library('curl');
            $curl_response = $this->curl->curl_make_post_request($url, $post_data);
            // echo "<pre>";print_r($curl_response);exit;
            $data_response = json_decode($curl_response, true);
            // echo "<pre>";print_r($data_response);exit;
            $data['transaction_data'] = $data_response['decrypted_EncryptTrans'];
            $data['encryptTrans'] = $data_response['encryptTrans'];
            $data['merchantId'] = $merchantId;
            // echo "<pre>";print_r($data);exit;

            if(!empty($data['details'])){

                $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view', $data);
            }else{

                redirect('/');

            }
        }else{
            $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view', $data);
            
        }
    }

    public function generateMerchantOrderNo(){
        $orderid = '';
        for ($i=0; $i<10; $i++)
        {
                $d=rand(1,30)%2;
                $d=$d ? chr(rand(65,90)) : chr(rand(48,57));
                $orderid=$orderid.$d;
        }
        return $orderid;
    }

    public function sending_transaction_log(){
        // echo "hii";exit;
        // echo "<pre>";print_r($_POST);exit;
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $stake_details_id_fk =  $this->session->userdata('stake_details_id_fk');
            $stake_id_fk =  $this->session->userdata('stake_id_fk');

            

            //Insert Transanction Log Table
            $transaction_log_array= array(
                'stake_details_id_fk' => $_POST['stake_details_id_fk'],
                'stake_id_fk'       => NULL,
                'sending_transaction'  => $_POST['transaction_data'],
                'sending_time'          => 'now()',
                'sending_ip'            => $this->input->ip_address(),
                'payment_type_id_fk'    => $_POST['payment_type'],
                'transaction_id'    => $_POST['transaction_id']
            );
            // echo "<pre>";print_r($data_array);exit;
            $transaction_log_id = $this->proceed_to_pay_model->insert_data('council_sbi_payment_transanction_log_details',$transaction_log_array);

            
            //Insert Payment Details Table
            $payment_details = array(
                'transaction_log_id_fk' => $transaction_log_id,
                'transaction_id'    => $_POST['transaction_id'],
                'payment_type_id_fk'    => $_POST['payment_type'],
                'stake_details_id_fk' => $stake_details_id_fk,
                'stake_id_fk'       => $stake_id_fk
            );

            $payment_details_id = $this->proceed_to_pay_model->insert_data('council_payment_details',$payment_details);

            if($_POST['payment_type'] == 1){ //VTC Student Registration

                $group_id = $_SESSION['vtc_std_reg_group_id'];
                
                $this->insert_vtc_std_rg_lot($payment_details_id, $_POST['transaction_id'], $group_id,$transaction_log_id);
            }elseif ($_POST['payment_type'] == 2) { // Institute Student Registration
                
            }

            echo json_encode('done');
        }
        
    }


    public function insert_vtc_std_rg_lot($payment_details_id, $transaction_id, $group_id, $transaction_log_id){
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');

        $getStudent = $this->proceed_to_pay_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);
        $std_id = array();
        if(!empty($getStudent)){
            
            foreach ($getStudent as $key => $value) {
                array_push($std_id, $value['student_id_pk']);
            }
        }
        // echo "<pre>";print_r($std_id);
        // echo implode(",",$std_id);
        // exit;

        //Insert Lot Table
        $paymentLotData = array(
            'payment_details_id_fk' => $payment_details_id,
            'group_id_fk'       =>  $group_id,
            'student_id_fk'     => implode(",",$std_id),
            'vtc_id_fk'         => $data['vtc_id_fk'],
            'academic_year'     => $data['academic_year'],
            'transanction_log_id_fk'        => $transaction_log_id,
            'transaction_id'                => $transaction_id
        );
       return $this->proceed_to_pay_model->insert_data('council_vtc_student_payment_lot',$paymentLotData);

    }

    public function calculate_posting_amount($group_id){
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        $group_details = $this->proceed_to_pay_model->getVTCGroupDetailsById($group_id);
        // echo "<pre>";print_r($group_details);exit;
        $getStudent = $this->proceed_to_pay_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);
        // echo "<pre>";print_r($getStudent);exit;

        if($group_details['course_name_id_fk'] == 1){
            $amount_per_std = 100;
            $total_amount = count($getStudent) * $amount_per_std;
        }else{
            $amount_per_std = 60;
            $total_amount = count($getStudent) * $amount_per_std;
        }
        $data_array = array(
            'group_details'     =>$group_details,
            'total_amount'      =>$total_amount,
            'total_std'         => count($getStudent),
            'amount_per_std'    => $amount_per_std
        );
        return $data_array;
    }

    public function genarateTransactionId($payment_type)
    {
        $start_code = 'VTC';

        $current_year = date('Y');

        $chaking_data = ($start_code .''. $current_year);
        $check_exist_code = $this->proceed_to_pay_model->get_last_transaction_id($chaking_data,$payment_type)[0];
        // echo "<pre>";print_r($check_exist_code);exit;
        if ($check_exist_code['code'] == "") {
            $number = "00001";
        } else {

            $code = $check_exist_code['code'];
            $cd = (int)str_pad(substr($code, -5), strlen($code));

            $cd = $cd + 1;
            
            $number = $cd;
            
            $no_of_digit = 5;
            $length = strlen((string)$number);
            for ($i = $length; $i < $no_of_digit; $i++) {
                $number = '0' . $number;
            }
            $number;
           
        }
        // echo $number;exit;

        $transaction_id = $start_code .''. $current_year . '' . $number;

        

        return $transaction_id;
    }

    public function download_payment_receipt($transaction_id){

        if($transaction_id !=''){
            $data['transactionDetails'] = $this->proceed_to_pay_model->getTransactionDetailsByMarchandOrderNo($transaction_id);
            // echo "<pre>";print_r($data['transactionDetails']);exit;
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
            redirect('admin/sbiepay/proceed_to_pay');
        }
    }
}