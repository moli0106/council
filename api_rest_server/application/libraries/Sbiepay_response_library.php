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
    }

    public function updateResponsestatusRespectiveTable($merchant_order_no){
        // echo $merchant_order_no;exit;
        if($merchant_order_no !=''){

            $transactionDetails = $this->CI->sbi_payment_model->getTransactionDetailsByMarchandOrderNo($merchant_order_no);
            if($transactionDetails['payment_type_id_fk'] == 1 || $transactionDetails['payment_type_id_fk'] == 5){ //vtcstudentReg

                $this->updateVTCStudentTable($merchant_order_no,$transactionDetails['payment_type_id_fk']);
                

            }elseif ($transactionDetails['payment_type_id_fk'] == 2 || $transactionDetails['payment_type_id_fk'] == 3 || $transactionDetails['payment_type_id_fk'] == 6 ) { // Modify Moli
                
                $this->insertStudentPaymentMap($merchant_order_no, $transactionDetails['payment_type_id_fk'] , $transactionDetails['payment_details_id_pk'],$transactionDetails['stake_details_id_fk'] );
            }elseif ($transactionDetails['payment_type_id_fk'] == 7) { //added by moli on 22-05-2023
                $this->updateVTCAffiliationTable($merchant_order_no,$transactionDetails['payment_type_id_fk'],$transactionDetails['stake_details_id_fk']);
            }elseif ($transactionDetails['payment_type_id_fk'] == 8) { 

                $this->insertCounsellingStudentPayment($merchant_order_no, $transactionDetails['payment_type_id_fk'] , $transactionDetails['payment_details_id_pk'],$transactionDetails['stake_details_id_fk'] );

            }
           
        }
        return true;
    }

    //added by moli on 22-05-2023
    public function updateVTCAffiliationTable($merchant_order_no,$payment_type_id_fk,$stake_details_id_fk){
        $this->CI->sbi_payment_model->updateVTCAffiliationTable($merchant_order_no);
        $updArray = array(
            'affiliated_payment_status' => 'Yes',
            'payment_date'    => 'now()'
        );
        $this->CI->sbi_payment_model->updateDetailsTable('council_affiliation_vtc_details',$updArray,$stake_details_id_fk);
    }

    public function updateVTCStudentTable($merchant_order_no,$payment_type_id_fk){
        $getStudent = $this->CI->sbi_payment_model->getLotStudentIdByTransactionId($merchant_order_no);
        $this->CI->sbi_payment_model->updateVTCLotTable($merchant_order_no);
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
                    $updArray['eligible_for_exam'] = 1;
                }
                $status=$this->CI->sbi_payment_model->updatePaymentResponse($updArray,$stdId,$payment_type);
                // lot table update
            }
        }
        return true;
    }

    public function insertStudentPaymentMap($merchant_order_no ,$payment_type_id_fk, $payment_details_id_pk , $stake_details_id_fk){

        $check_transaction_id = $this->CI->sbi_payment_model->check_transaction_id('council_institute_student_payment_map',$merchant_order_no);
        if(empty($check_transaction_id)){

            $insert_data = array(
                'spotcouncil_student_details_id_fk' =>$stake_details_id_fk,
                'transaction_id'                    => $merchant_order_no,
                'payment_details_id_fk'             => $payment_details_id_pk,
                'payment_type_id_fk'                => $payment_type_id_fk,
                'payment_date'                      => 'now()',
            );
            $status=$this->CI->sbi_payment_model->insertPaymentResponse('council_institute_student_payment_map',$insert_data);
        }
        return true;
    }

    public function insertCounsellingStudentPayment($merchant_order_no ,$payment_type_id_fk, $payment_details_id_pk , $stake_details_id_fk){

        $check_transaction_id = $this->CI->sbi_payment_model->check_transaction_id('council_polytechnic_counselling_student_payment_map',$merchant_order_no);
        if(empty($check_transaction_id)){

            $insert_data = array(
                'spotcouncil_student_details_id_fk' =>$stake_details_id_fk,
                'transaction_id'                    => $merchant_order_no,
                'payment_details_id_fk'             => $payment_details_id_pk,
                'payment_type_id_fk'                => $payment_type_id_fk,
                'payment_date'                      => 'now()',
            );
            $status=$this->CI->sbi_payment_model->insertPaymentResponse('council_polytechnic_counselling_student_payment_map',$insert_data);
            $updArray = array(
                'counselling_payment_status' => 1
            );
            $this->CI->sbi_payment_model->updateDetailsTable('council_polytechnic_counselling_student_data',$updArray,$stake_details_id_fk);
        }
        return true;
    }
}