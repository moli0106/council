<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proceed_to_pay extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
        $this->load->model('sbiepay/proceed_to_pay_model');

       
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            //2 => $this->config->item('theme_uri') . 'sbiepay/payment.js',

            
        );
		$this->load->library('sms');

        
    }

    // public function index(){
    //     // echo $this->config->item('theme');exit;
    //     $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view');
    // }

    public function index($merchant_order_no = NULL){
         //echo $merchant_order_no;exit;

        $data['stake_details_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['stake_id_fk'] =  $this->session->userdata('stake_id_fk');
        
        $data['payment_type'] = $_POST['payment_type'];
        //$data['res_status'] = $status; // 1 For Success and 2 For Failure
		
		if($merchant_order_no !=''){
            $getTransactionDetails = $this->proceed_to_pay_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
			
			
            if($getTransactionDetails['response_status'] == 1){
                $data['res_status'] = 1;
            }elseif($getTransactionDetails['response_status'] == 0){
                $data['res_status'] = 0;
            }
            $data['posting_amount'] = $getTransactionDetails['posting_amount'];
            $data['sbiepay_ref_id'] = $getTransactionDetails['sbiepay_ref_id'];
            $data['transaction_id'] = $getTransactionDetails['transaction_id'];
        }else{
            $data['res_status'] = '';
        }
        if($data['res_status']== ''){
            
        

			//Calculate posting Amount For VTC Std Reg
			if($data['payment_type'] == 1){

				$data['pay_for'] ='VTC Student Registration';

				$vtc_std_reg_group_id = $_POST['group_id'];
				$this->session->set_userdata('vtc_std_reg_group_id', $vtc_std_reg_group_id);
				$data['total_std'] = $_POST['std_no'];

                $stake_id_fk = 15;
				
				//$vtc_std_reg_group_id = 0;
				

				$data['details'] = $this->calculate_posting_amount($vtc_std_reg_group_id);
				
				$data['other_details'] = 'vtcStudentReg';
			}elseif ($data['payment_type'] == 2 || $data['payment_type'] == 6) { //modify on 23-04-2023

                //||||||||||||||||||||||||***********************************|||||||||||||||||||||||||||||||

				$data['pay_for'] ='Student Registration';
                 
                $data['details'] =$this->proceed_to_pay_model->getInsStdDetails($data['stake_details_id_fk'],$data['payment_type']);

                if($data['details']['exam_type_id_fk'] == 7){

                    if($data['details']['kanyashree_no'] == ''){ //on 06-02-2023
                        $data['details']['total_amount'] = 300;
                    }else{
                        $data['details']['total_amount'] = 150;
                    }
                }else{
                    
                    if($data['details']['kanyashree_no'] == ''){ //on 06-02-2023
                        $data['details']['total_amount'] = 200;
                    }else{
                        $data['details']['total_amount'] = 100;
                    }
                }
               
                $data['other_details'] = 'InsStudentReg';

                $stake_id_fk = $data['stake_id_fk'];


			}elseif ($data['payment_type'] == 4) {  //added on 26-03-2023
				
				$data['details'] =$this->proceed_to_pay_model->getInsStdDetails($data['stake_details_id_fk'],$data['payment_type']);
                $data['pay_for'] ='Examination Fee';
                $data['details']['total_amount'] = 250;
                $data['other_details'] = 'InsStudentExamFee';
				$stake_id_fk = 29;
				
				$vtc_std_reg_group_id = 0;
            }
			
			
			// Added by moli on 11-04-2023
            elseif ($data['payment_type'] == 5) {  

                $data['pay_for'] ='VTC Examination Fee';
                // $data['details']['total_amount'] = 1;
                // $data['other_details'] = 'VTCStudentExamFee';


                $vtc_std_reg_group_id = $_POST['group_id'];
                //$this->session->set_userdata('vtc_std_reg_group_id', $vtc_std_reg_group_id);
                $data['total_std'] = $_POST['eligible_std_no'];
                

                $data['details'] = $this->calculate_vtc_student_exam_fee($vtc_std_reg_group_id);
                
                $data['other_details'] = 'VTCStudentExamFee';
                $stake_id_fk = 15;
            }elseif ($data['payment_type'] == 7) { // Added by moli on 22-05-2023
                $data['pay_for'] ='VTC Affiliation Fee';
                $data['details'] = $this->calculate_vtc_affiliation_fee();
                
                $data['other_details'] = 'VTCAffiliationFee';
                $stake_id_fk = 15;

            }elseif ($data['payment_type'] == 8) { //added by moli on 23-06-2023

                $data['details'] =$this->proceed_to_pay_model->getStdDetails($data['stake_details_id_fk']);
                $data['pay_for'] ='Counselling Fee';
                $data['details']['total_amount'] = 1;
                $data['other_details'] = 'CounsellingFee';
                $stake_id_fk = 29;
                $vtc_std_reg_group_id = 0;
            }
            elseif ($data['payment_type'] == 9) { //Added by Moli on 14-07-2023 For Polytechnic Affiliation Fees

                //$data['details'] =$this->proceed_to_pay_model->getStdDetails($data['stake_details_id_fk']);
                $basic_affiliation_id = $this->input->post('basic_affiliation_id');
                $data['details'] = $this->calculate_polytechnic_affiliation_fee($basic_affiliation_id);
                $data['pay_for'] ='Affiliation Fee';
                //$data['details']['total_amount'] = 1;
                $data['details']['total_amount'] = $data['details']['total_fees'];
                $data['other_details'] = 'PolyAffiliationFee';
                $stake_id_fk = 27;
               
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
		
            //Modify by moli on 26-03-2023
            if ($data['payment_type'] == 4 || $data['payment_type'] == 5 || $data['payment_type'] == 1 || $data['payment_type'] == 6 || $data['payment_type'] == 7 || $data['payment_type'] == 8) {
                $log_data = array(
                    'stake_details_id_fk' => $data['stake_details_id_fk'],
                    'stake_id_fk'       => $stake_id_fk,
                    'sending_transaction'  => $data['transaction_data'],
                    'sending_time'          => 'now()',
                    'sending_ip'            => $this->input->ip_address(),
                    'payment_type_id_fk'    => $data['payment_type'],
                    'transaction_id'    => $data['transaction_id'],
                    
                    'posting_amount'    => $data['details']['total_amount']
                );
                $status = $this->insert_log_data($log_data,$vtc_std_reg_group_id);
                if($status && (!empty($data['details']))){
                    $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view', $data);
                }else{
                    
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'something went wrong please try again letter.');
                    redirect('admin/student_profile/student_payment_type');
                }
            }elseif ($data['payment_type'] == 9) { // Added on 14-07-2023
                $log_data = array(
                    'stake_details_id_fk' => $data['stake_details_id_fk'],
                    'stake_id_fk'       => $stake_id_fk,
                    'sending_transaction'  => $data['transaction_data'],
                    'sending_time'          => 'now()',
                    'sending_ip'            => $this->input->ip_address(),
                    'payment_type_id_fk'    => $data['payment_type'],
                    'transaction_id'    => $data['transaction_id'],
                    
                    'posting_amount'    => $data['details']['total_amount']
                );
                //echo "<pre>";print_r($data['details']);die;
                $status = $this->insert_polytechnic_log_data($log_data,$data['details'],$basic_affiliation_id);
                if($status && (!empty($data['details']))){
                    $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view', $data);
                }else{
                    
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'something went wrong please try again letter.');
                    redirect('admin/student_profile/student_payment_type');
                }
            }
            else{

                if(!empty($data['details'])){

                    $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view', $data);
                }else{

                    redirect('admin/');

                }
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
                'stake_details_id_fk' => ($stake_details_id_fk == NULL) ? NULL :$stake_details_id_fk,
                'stake_id_fk'       => ($stake_id_fk == NULL) ? NULL : $stake_id_fk,
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
                'transaction_log_id_fk' => ($transaction_log_id == NULL) ? NULL : $transaction_log_id,
                'transaction_id'    => $_POST['transaction_id'],
                'payment_type_id_fk'    => $_POST['payment_type'],
                'stake_details_id_fk' => ($stake_details_id_fk == NULL) ? NULL :$stake_details_id_fk,
                'stake_id_fk'       => ($stake_id_fk == NULL) ? NULL : $stake_id_fk
            );

            $payment_details_id = $this->proceed_to_pay_model->insert_data('council_payment_details',$payment_details);

            if($_POST['payment_type'] == 1){ //VTC Student Registration

                $group_id = $_SESSION['vtc_std_reg_group_id'];
				
				$posting_amount = null;
                
                $this->insert_vtc_std_rg_lot($payment_details_id, $_POST['transaction_id'], $group_id,$transaction_log_id,$posting_amount,$payment_details['payment_type_id_fk']);
            }

            echo json_encode('done');
        }
        
    }
	
	
	public function insert_vtc_std_rg_lot($payment_details_id, $transaction_id, $group_id, $transaction_log_id, $posting_amount,$payment_type_id_fk){
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
		 
        $getStudent = $this->proceed_to_pay_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year'],$payment_type_id_fk);
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
            'transaction_id'                => $transaction_id,
            'posting_amount'                => $posting_amount,
            'payment_type_id_fk'            => $payment_type_id_fk
        );
       return $this->proceed_to_pay_model->insert_data('council_vtc_student_payment_lot',$paymentLotData);

    }


    public function insert_vtc_std_rg_lot_old($payment_details_id, $transaction_id, $group_id, $transaction_log_id){
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
	
	
	 // Added by Moli on 11-04-2023

    public function calculate_vtc_student_exam_fee($group_id){
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');

        $vtc_details=$this->proceed_to_pay_model->getVtcDetails(md5($data['vtc_id_fk']), $data['academic_year']);
        //echo "<pre>";print_r($vtc_details);exit;

        $group_details = $this->proceed_to_pay_model->getVTCGroupDetailsById($group_id);
        // echo "<pre>";print_r($group_details);exit;
        $getStudent = $this->proceed_to_pay_model->getEligibleStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);
        // echo "<pre>";print_r($getStudent);exit;
        if($vtc_details['vtc_type'] == 1){
			
			if($group_details['course_name_id_fk'] == 1){
				$amount_per_std = 100;
				//$total_amount = count($getStudent) * $amount_per_std;
				$total_amount = 1;
			}else{
				
				
				$amount_per_std = 110;
				
				$total_amount = (count($getStudent) *$amount_per_std );
				//$total_amount = 1;
			}
		}elseif ($vtc_details['vtc_type'] == 2) {
			
			if($group_details['course_name_id_fk'] == 1){
				$amount_per_std = 200;
				//$total_amount = count($getStudent) * $amount_per_std;
				$total_amount = 1;
			}else{
				
				$amount_per_std = 250;
				
				$total_amount = (count($getStudent) *$amount_per_std );
				//$total_amount = 1;
			}
		}

        //$total_amount = 1;
        
        $data_array = array(
            'group_details'     =>$group_details,
            'total_amount'      =>$total_amount,
            'total_std'         => count($getStudent),
            'amount_per_std'    => $amount_per_std
            //'amount_per_std'    => $total_amount
        );
        return $data_array;
    }

    public function calculate_posting_amount($group_id){
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        $group_details = $this->proceed_to_pay_model->getVTCGroupDetailsById($group_id);
		
		$vtc_details=$this->proceed_to_pay_model->getVtcDetails(md5($data['vtc_id_fk']), $data['academic_year']);
		
        $getStudent = $this->proceed_to_pay_model->getstd_count_by_classid($group_id, $data['vtc_id_fk'] , $data['academic_year'],$group_details['course_name_id_fk']);
        //echo "<pre>";print_r($getStudent);exit;
		
		if(($vtc_details['vtc_type'] == 1) || ($vtc_details['vtc_type'] == 2 && $vtc_details['institute_category_id_fk'] != 4)){
			
			if($group_details['course_name_id_fk'] == 1){
				$amount_per_std = 100;
				//$total_amount = count($getStudent) * $amount_per_std;
				$total_amount = 1;
			}else{
				
				//$std_count = $this->proceed_to_pay_model->getstd_count_by_classid($group_id, $data['vtc_id_fk'] , $data['academic_year'],)
				$non_kon_amount_per_std = 60;
				$kon_amount_per_std = 35;
				$total_amount = ($getStudent['non_kon_count'] *$non_kon_amount_per_std ) +($getStudent['kon_count'] *$kon_amount_per_std );
				//$total_amount = 1;
			}
		}elseif ($vtc_details['vtc_type'] == 2 && $vtc_details['institute_category_id_fk'] == 4) {
			
			if($group_details['course_name_id_fk'] == 1){
				$amount_per_std = 200;
				//$total_amount = count($getStudent) * $amount_per_std;
				$total_amount = 1;
			}else{
				
				//$std_count = $this->proceed_to_pay_model->getstd_count_by_classid($group_id, $data['vtc_id_fk'] , $data['academic_year'],)
				$non_kon_amount_per_std = 200;
				$kon_amount_per_std = 100;
				$total_amount = ($getStudent['non_kon_count'] *$non_kon_amount_per_std ) +($getStudent['kon_count'] *$kon_amount_per_std );
				//$total_amount = 1;
			}
		}
        $data_array = array(
            'group_details'     =>$group_details,
            'total_amount'      =>$total_amount,
            'non_kon_std'         => $getStudent['non_kon_count'],
			'kon_std'         => $getStudent['kon_count'],
            'non_kon_amount_per_std'    => $non_kon_amount_per_std,
			'kon_amount_per_std'		=> $kon_amount_per_std
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
		//echo $transaction_id;exit;
        if($transaction_id !=''){
			//echo "hiikk";exit;
            $data['transactionDetails'] = $this->proceed_to_pay_model->getTransactionDetailsByMarchandOrderNo($transaction_id);
            if(!empty($data['transactionDetails'])){
				
				$data['posting_amount'] = $data['transactionDetails']['posting_amount'];
				$data['sbiepay_ref_id'] = $data['transactionDetails']['sbiepay_ref_id'];
				$data['transaction_id'] = $data['transactionDetails']['transaction_id'];
				
				//Modify by Moli on 27-03-2023
				$payment_type = $data['transactionDetails']['payment_type_id_fk'];
				if($payment_type == 4 || $payment_type == 5){
					$data['pay_for'] = 'Student Exam Fee';
				}else{
					$data['pay_for'] = 'Student Registration Fee';
				}
				//echo "<pre>";print_r($data);exit;
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
	
	//added by moli on 27-03-2023
	public function insert_log_data($log_data,$vtc_std_reg_group_id =null){
		//echo $vtc_std_reg_group_id;exit;
        // ! Starting Transaction
        $this->db->trans_start(); # Starting Transaction
        $transaction_log_id = $this->proceed_to_pay_model->insert_data('council_sbi_payment_transanction_log_details',$log_data);
        if($transaction_log_id){
            //Insert Payment Details Table
            $payment_details = array(
                'transaction_log_id_fk' => $transaction_log_id,
                'transaction_id'    => $log_data['transaction_id'],
                'payment_type_id_fk'    => $log_data['payment_type_id_fk'],
                'stake_details_id_fk' => $log_data['stake_details_id_fk'],
                'stake_id_fk'       => $log_data['stake_id_fk']
            );

            $payment_details_id = $this->proceed_to_pay_model->insert_data('council_payment_details',$payment_details);


			//$group_id = $_SESSION['vtc_std_reg_group_id'];
            if($log_data['payment_type_id_fk'] == 1 || $log_data['payment_type_id_fk'] == 5) {

                $this->insert_vtc_std_rg_lot($payment_details_id, $log_data['transaction_id'], $vtc_std_reg_group_id,$transaction_log_id,$log_data['posting_amount'],$log_data['payment_type_id_fk']);
            }elseif ($log_data['payment_type_id_fk'] == 7) {
                $this->insert_vtc_affiliation_payment($payment_details_id, $log_data['transaction_id'], $transaction_log_id,$log_data['posting_amount'],$log_data['payment_type_id_fk']);

            } elseif ($log_data['payment_type_id_fk'] == 9) {
                $this->insert_polytechnic_affiliation_payment($payment_details_id, $log_data['transaction_id'], $transaction_log_id,$log_data['posting_amount'],$log_data['payment_type_id_fk']);

            }          
            
            
            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback(); # Something went wrong.

                return false;

            } else {

                $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.
               
                return true;

                
            }

        }else{
            return false;
        }
    }
	
    //Added by Moli on 22-05-2023

	public function insert_vtc_affiliation_payment($payment_details_id, $transaction_id, $transaction_log_id, $posting_amount,$payment_type_id_fk){
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        //Insert Lot Table
        $paymentLotData = array(
            'payment_details_id_fk' => $payment_details_id,
            'vtc_id_fk'         => $data['vtc_id_fk'],
            'academic_year'     => $data['academic_year'],
            'transanction_log_id_fk'        => $transaction_log_id,
            'transaction_id'                => $transaction_id,
            'posting_amount'                => $posting_amount,
            'payment_type_id_fk'            => $payment_type_id_fk,
            'sending_time'                  => 'now()'
        );
       return $this->proceed_to_pay_model->insert_data('council_vtc_affiliation_payment',$paymentLotData);

    
    }
    public function calculate_vtc_affiliation_fee(){

        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');

        $vtc_details=$this->proceed_to_pay_model->getVtcDetails(md5($data['vtc_id_fk']), $data['academic_year']);

        //for VTC/STTC Govt.
        if(($vtc_details['vtc_type'] == 1) || ($vtc_details['vtc_type'] == 2 && $vtc_details['institute_category_id_fk'] != 4)){
            $total_amount = 1;

        }elseif ($vtc_details['vtc_type'] == 2 && $vtc_details['institute_category_id_fk'] == 4) { //for STTC Pvt.
            $total_amount = 1;
        }
        $data_array = array(
            'vtc_name'     =>$vtc_details['vtc_name'],
            'vtc_code'     =>$vtc_details['vtc_code'],
            'total_amount'      =>$total_amount
            
        );
        return $data_array;

    }

    public function calculate_polytechnic_affiliation_fee($basic_affiliation_id){
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = '2023-24';
        $data['intake_data'] = $this->proceed_to_pay_model->getIntakeById(md5($basic_affiliation_id));
        //echo "<pre>";print_r($data['intake_data']);die;
        $affiliation_fees = 30000;
        if(count($data['intake_data']) > 4){
                $increse_course_no =  count($data['intake_data']) - 4;
            $increse_course_amnt = 7500 * $increse_course_no;
        }else{
            $increse_course_amnt = 0;
        }
        //echo $increse_course_amnt;die;
        $i = 0;
        foreach ($data['intake_data'] as $key => $value) {
            if($value['intake_no'] > 60){
                
                $increase_intake_no = floor($value['intake_no'] / 60);
                $i = $i+$increase_intake_no;

                //echo "<br>";
            }
        }
        //echo $i;die;
        if($i == 0){
            $increase_intake_amount = 0;
        }else{
            $increase_intake_amount = 7500 * $i;
        }

        

        $data_array= array(
            'application_fees' => 1000,
            'inspection_fees'  => 10000,
            'affiliation_fees' => $affiliation_fees,
            'increse_course_amnt' => $increse_course_amnt,
            'increase_intake_amount' => $increase_intake_amount,
            'new_or_renewal'        => ($data['intake_data'][0]['new_or_renewal'] == 2)? 'Renewal of' : '',
            'newRenewalId'          => $data['intake_data'][0]['new_or_renewal'],
            'total_fees'            =>  1000 + 10000 + $affiliation_fees + $increse_course_amnt + $increase_intake_amount,
            'institute_id_fk'       => $data['intake_data'][0]['vtc_id_fk'],
            'institute_code'        => $data['intake_data'][0]['vtc_code']

        );
        return $data_array;
    }

    public function insert_polytechnic_log_data($log_data,$details_array,$basic_affiliation_id){
		$data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = '2023-24';
        //echo "<pre>";print_r($details_array);die;
        // ! Starting Transaction
        $this->db->trans_start(); # Starting Transaction
        $transaction_log_id = $this->proceed_to_pay_model->insert_data('council_sbi_payment_transanction_log_details',$log_data);
        if($transaction_log_id){
            //Insert Payment Details Table
            $payment_details = array(
                'transaction_log_id_fk' => $transaction_log_id,
                'transaction_id'    => $log_data['transaction_id'],
                'payment_type_id_fk'    => $log_data['payment_type_id_fk'],
                'stake_details_id_fk' => $log_data['stake_details_id_fk'],
                'stake_id_fk'       => $log_data['stake_id_fk']
            );

            $payment_details_id = $this->proceed_to_pay_model->insert_data('council_payment_details',$payment_details);

            $affiliation_data = array(
                'basic_affiliation_id_fk' => $basic_affiliation_id,
                'ins_details_id'        => $data['ins_details_id'],
                'affiliation_year'      => $data['academic_year'],
                'payment_details_id_fk' => $payment_details_id,
                'transanction_log_id_fk'        => $transaction_log_id,
                'transaction_id'                => $log_data['transaction_id'],
                'posting_amount'                => $log_data['posting_amount'],
                'payment_type_id_fk'            => $log_data['payment_type_id_fk'],
                'sending_time'                  => 'now()',
                'institute_id_fk'       => $details_array['institute_id_fk'],
                'institute_code'        => $details_array['institute_code'],

                'application_fees' => $details_array['application_fees'],
                'inspection_fees'  => $details_array['inspection_fees'],
                'affiliation_fees' => $details_array['affiliation_fees'],
                'increse_course_amnt' => $details_array['increse_course_amnt'],
                'increase_intake_amount' => $details_array['increase_intake_amount'],
                'new_or_renewal'        => $details_array['newRenewalId']
            );
            $this->proceed_to_pay_model->insert_data('council_polytechnic_affiliation_payment',$affiliation_data);
            
            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback(); # Something went wrong.

                return false;

            } else {

                $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.
               
                return true;

                
            }

        }else{
            return false;
        }
    }

}