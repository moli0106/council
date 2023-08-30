<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sbiepay_response_library
{
    /**
     * CI instance
     *
     * @var object
     */
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
		//$this->load->library('sms');
    }

    public function updateResponsestatusRespectiveTable($merchant_order_no){
        // echo $merchant_order_no;exit;
        if($merchant_order_no !=''){

            $transactionDetails = $this->CI->sbi_payment_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
			
			//add on 07-04-2023
			$sbi_ref_id = $transactionDetails['sbiepay_ref_id'];
			$bank_ref_no = $transactionDetails['bank_reference_number'];
			//add on 07-04-2023
			
            if($transactionDetails['payment_type_id_fk'] == 1 || $transactionDetails['payment_type_id_fk'] == 5){

                $this->updateVTCStudentTable($merchant_order_no,$transactionDetails['posting_amount'],$transactionDetails['payment_type_id_fk']);

            }elseif ($transactionDetails['payment_type_id_fk'] == 2 || $transactionDetails['payment_type_id_fk'] == 3 || $transactionDetails['payment_type_id_fk'] == 4 || $transactionDetails['payment_type_id_fk'] == 6) {
                //$transactionDetails = $this->CI->sbi_payment_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
                //$transactionDetails = $this->CI->sbi_payment_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
                $this->insertStudentPaymentMap($merchant_order_no, $transactionDetails['payment_type_id_fk'] , $transactionDetails['payment_details_id_pk'],$transactionDetails['stake_details_id_fk'],$transactionDetails['posting_amount'],$sbi_ref_id,$bank_ref_no );
            }
			
        }
        return true;
    }

    public function updateVTCStudentTable($merchant_order_no,$posting_amount = null , $payment_type_id_fk=null){
        $getStudent = $this->CI->sbi_payment_model->getLotStudentIdByTransactionId($merchant_order_no);
		$this->CI->sbi_payment_model->updateVTCLotTable($merchant_order_no, $posting_amount);
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
                
            }
        }
        return true;
    }

    public function insertStudentPaymentMap_old($merchant_order_no ,$payment_type_id_fk, $payment_details_id_pk , $stake_details_id_fk){
        $insert_data = array(
            'spotcouncil_student_details_id_fk' =>$stake_details_id_fk,
            'transaction_id'                    => $merchant_order_no,
            'payment_details_id_fk'             => $payment_details_id_pk,
            'payment_type_id_fk'                => $payment_type_id_fk,
            'payment_date'                      => 'now()',
        );
        $status=$this->CI->sbi_payment_model->insertPaymentResponse('council_institute_student_payment_map',$insert_data);
        return true;
    }
	
	public function insertStudentPaymentMap($merchant_order_no ,$payment_type_id_fk, $payment_details_id_pk , $stake_details_id_fk, $posting_amount = null,$sbi_ref_id = null,$bank_ref_no = null){

        $check_transaction_id = $this->CI->sbi_payment_model->check_transaction_id($merchant_order_no);
        if(empty($check_transaction_id)){

            $insert_data = array(
                'spotcouncil_student_details_id_fk' =>$stake_details_id_fk,
                'transaction_id'                    => $merchant_order_no,
                'payment_details_id_fk'             => $payment_details_id_pk,
                'payment_type_id_fk'                => $payment_type_id_fk,
                'payment_date'                      => 'now()',
				'posting_amount'					=> $posting_amount,
				
				
				'sbiepay_ref_id'					=> $sbi_ref_id,
				'bank_reference_number'				=> $bank_ref_no
            );
            $status=$this->CI->sbi_payment_model->insertPaymentResponse('council_institute_student_payment_map',$insert_data);
        }
        return true;
    }
}