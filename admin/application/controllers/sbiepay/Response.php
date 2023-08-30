<?php
defined('BASEPATH') or exit('No direct script access allowed');


	

class Response extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('sbiepay/response_model');
		
		

        $this->css_head = array();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'assets/css/datepicker.css'
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . 'assets/js/datepicker.js'
            
        );
    }

    public function index($offset = 0)
    {
        
        $this->load->view($this->config->item('theme') . 'sbiepay/response/get_manual_response_view', $data);
    }

    public function updatestdPaymentResponse(){

        $start_date_array = explode('/', $this->input->post('from_date'));
        $end_date_array = explode('/', $this->input->post('to_date'));
        $payment_type_id_fk = $this->input->post('payment_type_id_fk');
        
        $start_date = date_format(date_create($start_date_array[2].'-'.$start_date_array[1].'-'.$start_date_array[0]), "Y-m-d");
        $end_date   = date_format(date_create($end_date_array[2].'-'.$end_date_array[1].'-'.$end_date_array[0]), "Y-m-d");
        if (!empty($start_date) && !empty($end_date) && !empty($payment_type_id_fk)) {
			$csrf_token = $this->security->get_csrf_hash();
            $transaction_id = $this->response_model->getAllTransactionId($start_date,$end_date,$payment_type_id_fk);
            $empty_array = array();
            foreach ($transaction_id as $key => $value) {

                $details =$this->response_model->getInsStdDetails($value['stake_details_id_fk'],$value['payment_type_id_fk']);

                if($details['exam_type_id_fk'] == 7){

                    if($details['kanyashree_no'] == ''){ //on 06-02-2023
                        $total_amount = 300;
                    }else{
                        $total_amount = 150;
                    }
                }else{
                    
                    if($details['kanyashree_no'] == ''){ //on 06-02-2023
                        $total_amount = 200;
                    }else{
                        $total_amount = 100;
                    }
                }

                $data = array(
                    'transaction_id' => $value['transaction_id'],
                    'amount'  => $total_amount
                );


               
                array_push($empty_array,$data);
            }
            $output = array(
                'merchant_id' => $empty_array,
				'csrf_token'=>$csrf_token
            );
           echo json_encode($output);

        }
    }
	
	public function upd_merchant_no(){
		//$data['token'] = $this->security->get_csrf_hash(); 
		//echo "hii";
		//echo $this->input->post('moli_merchant_id');
		
		//echo "<pre>";print_r($_POST['transaction_id']);die;
		$transaction_id_array = $_POST['transaction_id'];
		foreach($transaction_id_array as $key=>$val){
			$response = $val;
			$decrypt_array = explode("|",$response);
			$upd_array = array(
				'response_details'       => $response, //decrypted_text
				
				'sbiepay_ref_id'      => ($decrypt_array[1]==NA)? NULL :$decrypt_array[1],  //sbiePayRefID
				
				
				'response_description'      => $decrypt_array[8], //status_description
				'bank_reference_number' => $decrypt_array[10],   //bank_reference_number
				'response_time'         => ($decrypt_array[11] == NA) ? NULL :$decrypt_array[11] ,  //response_time
				'from_status_query' 	=> 1,
				'from_status_query_date' => 'now()'
			);
		 
			$res_status     = $decrypt_array[2];    //res_status
			$merchant_order_no  =$decrypt_array[6];  //merchant_order_no
			$merchantID         = $decrypt_array[0];      //merchantID
			
			//if($decrypt_array[7]!= 200){
				//$upd_array['posting_amount']          = 200 ;  //amount
			//}else{
				//$upd_array['posting_amount'] = ($decrypt_array[7] == NA) ? NULL :$decrypt_array[7];
			//}
			
			if($decrypt_array[7]!= NA){
				$upd_array['posting_amount']          = $decrypt_array[7] ;  //amount
			}
			if($res_status == 'SUCCESS'){
				$upd_array['response_status'] = 1;
			}
			if($res_status == 'PENDING'){
				$upd_array['response_status'] = 2;
			}
			if($res_status == 'FAIL'){
				$upd_array['response_status'] = 0;
			}
			
			$this->response_model->update_data('council_sbi_payment_transanction_log_details',$upd_array,$merchant_order_no);
			$transactionDetails = $this->response_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
			if($res_status == 'SUCCESS'){
				$insert_data = array(
					'spotcouncil_student_details_id_fk' =>$transactionDetails['stake_details_id_fk'],
					'transaction_id'                    => $merchant_order_no,
					'payment_details_id_fk'             => $transactionDetails['payment_details_id_pk'],
					'payment_type_id_fk'                => $transactionDetails['payment_type_id_fk'], 
					'payment_date'                      => 'now()',
					'from_status_query' 	=> 1
					//'from_status_query_date' => 'now()'
				);
				$status=$this->response_model->insertPaymentResponse('council_institute_student_payment_map',$insert_data);
			}
		}
		echo json_encode('done');
	}


    //17-04-2023
    public function vtc(){
        $this->load->view($this->config->item('theme') . 'sbiepay/response/get_manual_vtc_response_view', $data);
    }

    public function vtcBlankResponse(){
        $payment_type_id_fk = $this->input->post('payment_type_id_fk');

        if (!empty($payment_type_id_fk)) {
			$csrf_token = $this->security->get_csrf_hash();
            $transaction_id = $this->response_model->getAllVTCBlankTransactionId($payment_type_id_fk);
           
            $empty_array = array();
            foreach ($transaction_id as $key => $value) {
                $vtc_details=$this->response_model->getVtcDetails($value['vtc_id_fk']);
                $getStudent = $this->response_model->get_std_count($value['student_id_fk']);

                $group_details = $this->response_model->getVTCGroupDetailsById($value['group_id_fk']);


                if($payment_type_id_fk == 1){

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

                }else{

                    $std_ids = explode(',', $value['student_id_fk']);

                    if($vtc_details['vtc_type'] == 1){
			
                        if($group_details['course_name_id_fk'] == 1){
                            $amount_per_std = 100;
                            //$total_amount = count($std_ids) * $amount_per_std;
                            $total_amount = 1;
                        }else{
                            
                            
                            $amount_per_std = 110;
                            
                            $total_amount = (count($std_ids) *$amount_per_std );
                            //$total_amount = 1;
                        }
                    }elseif ($vtc_details['vtc_type'] == 2) {
                        
                        if($group_details['course_name_id_fk'] == 1){
                            $amount_per_std = 200;
                            //$total_amount = count($std_ids) * $amount_per_std;
                            $total_amount = 1;
                        }else{
                            
                            $amount_per_std = 250;
                            
                            $total_amount = (count($std_ids) *$amount_per_std );
                            //$total_amount = 1;
                        }
                    }
                }

                $data = array(
                    'transaction_id' => $value['transaction_id'],
                    'amount'  => $total_amount
                );


               
                array_push($empty_array,$data);
            }
            $output = array(
                'merchant_id' => $empty_array,
				'csrf_token'=>$csrf_token
            );
           echo json_encode($output);

        }
    }

    public function upd_vtc_merchant_no(){
		//$data['token'] = $this->security->get_csrf_hash(); 
		//echo "hii";
		//echo $this->input->post('moli_merchant_id');
		
		//echo "<pre>";print_r($_POST['transaction_id']);die;
		$transaction_id_array = $_POST['transaction_id'];
		foreach($transaction_id_array as $key=>$val){
			$response = $val;
			$decrypt_array = explode("|",$response);
			$upd_array = array(
				'response_details'       => $response, //decrypted_text
				
				'sbiepay_ref_id'      => ($decrypt_array[1]== 'NA')? NULL :$decrypt_array[1],  //sbiePayRefID
				
				
				'response_description'      => $decrypt_array[8], //status_description
				'bank_reference_number' => $decrypt_array[10],   //bank_reference_number
				'response_time'         => ($decrypt_array[11] == 'NA') ? NULL :$decrypt_array[11] ,  //response_time
				'from_status_query' 	=> 1,
				'from_status_query_date' => 'now()'
			);
		 
			$res_status     = $decrypt_array[2];    //res_status
			$merchant_order_no  =$decrypt_array[6];  //merchant_order_no
			$merchantID         = $decrypt_array[0];      //merchantID
			
			//if($decrypt_array[7]!= 200){
				//$upd_array['posting_amount']          = 200 ;  //amount
			//}else{
				//$upd_array['posting_amount'] = ($decrypt_array[7] == NA) ? NULL :$decrypt_array[7];
			//}
			
			if($decrypt_array[7]!= 'NA'){
				$upd_array['posting_amount']          = $decrypt_array[7] ;  //amount
			}
			if($res_status == 'SUCCESS'){
				$upd_array['response_status'] = 1;
			}
			if($res_status == 'PENDING'){
				$upd_array['response_status'] = 2;
			}
			if($res_status == 'FAIL'){
				$upd_array['response_status'] = 0;
			}
			
			$this->response_model->update_data('council_sbi_payment_transanction_log_details',$upd_array,$merchant_order_no);
			$transactionDetails = $this->response_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
			if($res_status == 'SUCCESS'){

                $getStudent = $this->response_model->getLotStudentIdByTransactionId($merchant_order_no);
                $this->response_model->updateVTCLotTable($merchant_order_no);
                if(!empty($getStudent)){
                    if($getStudent['student_id_fk']!=''){
                        $stdId = explode(',', $getStudent['student_id_fk']);
                        $payment_type = 1;
                        $updArray = array(
                            //'payment_status' => 'Yes',
                            'payment_date'    => 'now()',
                            'payment_details_id_fk' => $getStudent['payment_details_id_fk']
                        );
        
                        //Modify on 11-04-2023
                        if($payment_type_id_fk == 1){
                            $updArray['payment_status'] = 'Yes';
                        }elseif ($payment_type_id_fk == 5) {
                            $updArray['exam_fee_status'] = 1;
                        }
                        $status=$this->CI->sbi_payment_model->updatePaymentResponse($updArray,$stdId,$payment_type);
                        // lot table update
                    }
                }
				
			}
		}
		echo json_encode('done');
	}


    public function polyAffiliation(){
        $this->load->view($this->config->item('theme') . 'sbiepay/response/get_manual_poly_response_view', $data);
    }

    public function polyAffiliationBlankResponse(){
       $payment_type_id_fk = $this->input->post('payment_type_id_fk');

        if (!empty($payment_type_id_fk)) {
			$csrf_token = $this->security->get_csrf_hash();
            $transaction_id = $this->response_model->getAllPolyAffiliationBlankTransactionId($payment_type_id_fk);
            //echo "<pre>";print_r($transaction_id);die;
            $empty_array = array();
            foreach ($transaction_id as $key => $value) {

                $data = array(
                    'transaction_id' => $value['transaction_id'],
                    'amount'  => $value['posting_amount']
                );


               
                array_push($empty_array,$data);

            }
            $output = array(
                'merchant_id' => $empty_array,
				'csrf_token'=>$csrf_token
            );
           echo json_encode($output);
        }
    }

    public function  upd_poly_merchant_no(){

        //echo "<pre>";print_r($_POST['transaction_id']);die;
		$transaction_id_array = $_POST['transaction_id'];
		foreach($transaction_id_array as $key=>$val){
			$response = $val;
			$decrypt_array = explode("|",$response);
			$upd_array = array(
				'response_details'       => $response, //decrypted_text
				
				'sbiepay_ref_id'      => ($decrypt_array[1]== 'NA')? NULL :$decrypt_array[1],  //sbiePayRefID
				
				
				'response_description'      => $decrypt_array[8], //status_description
				'bank_reference_number' => $decrypt_array[10],   //bank_reference_number
				'response_time'         => ($decrypt_array[11] == 'NA') ? NULL :$decrypt_array[11] ,  //response_time
				'from_status_query' 	=> 1,
				'from_status_query_date' => 'now()'
			);
		 
			$res_status     = $decrypt_array[2];    //res_status
			$merchant_order_no  =$decrypt_array[6];  //merchant_order_no
			$merchantID         = $decrypt_array[0];      //merchantID
			
			//if($decrypt_array[7]!= 200){
				//$upd_array['posting_amount']          = 200 ;  //amount
			//}else{
				//$upd_array['posting_amount'] = ($decrypt_array[7] == NA) ? NULL :$decrypt_array[7];
			//}
			
			if($decrypt_array[7]!= 'NA'){
				$upd_array['posting_amount']          = $decrypt_array[7] ;  //amount
			}
			if($res_status == 'SUCCESS'){
				$upd_array['response_status'] = 1;
			}
			if($res_status == 'PENDING'){
				$upd_array['response_status'] = 2;
			}
			if($res_status == 'FAIL'){
				$upd_array['response_status'] = 0;
			}

            $upd_array1 = array(
                'response_status' => 1,
                'from_status_query' => 1,
                'from_status_query_date' => 'now()',
                'response_description'      => $decrypt_array[8],
                'sbiepay_ref_id'      => ($decrypt_array[1]== 'NA')? NULL :$decrypt_array[1],  //sbiePayRefID
                'bank_reference_number' => $decrypt_array[10]  //bank_reference_number

            );
			
			$this->response_model->update_data('council_sbi_payment_transanction_log_details',$upd_array,$merchant_order_no);
            $this->response_model->update_data('council_polytechnic_affiliation_payment',$upd_array1,$merchant_order_no);
			//$transactionDetails = $this->response_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
			if($res_status == 'SUCCESS'){

                $basic_id = $this->response_model->getBasicAffiliationIdByTransactionId($merchant_order_no);
                
                if(!empty($basic_id)){
                    $status=$this->response_model->updateBasicDetails(array('payment_status' => 1,'final_submit_status' =>1),$basic_id['basic_affiliation_id_fk']);
                }
				
			}
		}
		echo json_encode('done');
    }

}