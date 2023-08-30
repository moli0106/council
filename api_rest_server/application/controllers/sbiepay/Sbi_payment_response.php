<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sbi_payment_response extends NIC_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->library(array('form_validation', 'sbiepay_response_library','sms'));

		$this->load->model('sbiepay/sbi_payment_model');
        $this->load->library('sms');
	}

    public function success_response_post(){
       
        $success_response = json_encode($_REQUEST);
        $current_date = date("Y-m-d h:i:sa");
       file_put_contents("sbi_success_response.txt", $success_response . PHP_EOL . '------->>>>>>>>>>>>Created date is------'.$current_date.'--' . PHP_EOL, FILE_APPEND);

        $arrayData = json_decode($success_response);
        // echo "<pre>";print_r($arrayData);
        
       $decrypt_res = $this->createResponseLogData($arrayData->encData);
       
       //For Double Verification
       //$this->doubleVerification($decrypt_res['merchant_order_no'],$decrypt_res['sbiePayRefID'],$decrypt_res['amount'],$decrypt_res['merchantID']);
        // echo "<pre>";print_r($decrypt_res);exit;
        $upd_array=array(
        
            'response_details'      => $decrypt_res['decrypted_text'],
            'response_time'         => $decrypt_res['response_time'],
            'sbiepay_ref_id'        => $decrypt_res['sbiePayRefID'],
            'bank_reference_number'     => $decrypt_res['bank_reference_number'],
            'response_description'      => $decrypt_res['status_description']
        );

        if($decrypt_res['res_status'] == 'SUCCESS'){
            $upd_array['response_status'] = 1;
        }
        if($decrypt_res['res_status'] == 'PENDING'){
            $upd_array['response_status'] = 2;
        }
       //Update Transaction Log Table And Payment Details Table
        $this->sbi_payment_model->update_data('council_sbi_payment_transanction_log_details',$upd_array,$decrypt_res['merchant_order_no']);

        // Update respective Table with payment Details Id and Response Status
        $this->sbiepay_response_library->updateResponsestatusRespectiveTable($decrypt_res['merchant_order_no']);

        $transactionDetails = $this->sbi_payment_model->getTransactionDetailsByMarchandOrderNo($decrypt_res['merchant_order_no']);
		// $get_mobile_no = $this->sbi_payment_model->getMobileNo($transactionDetails['stake_details_id_fk'],$transactionDetails['stake_id_fk']);
		// //echo "<pre>";print_r($get_mobile_no);exit;
		// $sms_message = "You have made payment of Rs. ".$transactionDetails['posting_amount']." (Poly/VOC) with WBSCT&VE&SD for the session 2022-23 ";
		// //$template_id = 1707167542331449910;
		// $template_id = 0;
		// $this->sms->send($get_mobile_no['mobile_number'], $sms_message, $template_id);

        $status = 1;
        if($transactionDetails['payment_type_id_fk'] == 3){

            redirect(base_url().'sbiepay/proceed_to_pay/index/'.$decrypt_res['merchant_order_no'],'location');
        }else{
            redirect(base_url().'admin/sbiepay/proceed_to_pay/index/'.$decrypt_res['merchant_order_no'],'location');

        }
        //$this->load->view(base_url() . 'admin/application/views/themes/adminlte/sbiepay/payment_proceed_view');

    }

    function doubleVerification_get($merchant_order_no,$amount,$merchantid)
    {
        //$this->sbiDoubleVerification();
        // $merchant_order_no="O004"; // merchant order no
        // $merchantid="1000112";  //merchant id
        // $amount=1;
        $url="https://test.sbiepay.sbi/payagg/statusQuery/getStatusQuery"; // double verification url
        $queryRequest="|".$merchantid."|". $merchant_order_no."|". $amount;
        $queryRequest33=http_build_query(array('queryRequest' => $queryRequest,"aggregatorId"=>"SBIEPAY","merchantId"=>$merchantid));
        //echo "$url,$queryRequest33";exit;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSLVERSION, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $queryRequest33);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        $response = curl_exec ($ch);
        if (curl_errno($ch)) {
        echo $error_msg = curl_error($ch);
        }
        curl_close ($ch);
        // echo $response;

        $current_date = date("Y-m-d h:i:sa");
        file_put_contents("sbi_double_verification_response.txt", $response . PHP_EOL . '------->>>>>>>>>>>>Created date is------'.$current_date.'--' . PHP_EOL, FILE_APPEND);
 
    }

    public function failure_response_post(){

        $current_date = date("Y-m-d h:i:sa");
        $failure_response = json_encode($_REQUEST);;
        file_put_contents("sbi_failure_response.txt", $failure_response . PHP_EOL . '------->>>>>>>>>>>>Created date is------'.$current_date.'--' . PHP_EOL, FILE_APPEND);

        //$encData='5aNGio4B/hZXYu68RS5a4sQBSPBCF32kOmfTQ2zgAWeZj2mqOjIGyvZYau1upDyRtjq29AO6Ok12V/ijZdj6nhLbeL4A7eF/OdAMNy//VhU7nCwnOXUZ9lx5KwGqTmEPUuX8XUQ4knuQSK0rLfUdLefl30dP/ZRfnyZJPejgW0iMJUJ5dBZEP+7oEQYD/xAevBO+oHWfp/4JlPYvm7deQAbxhsWy3YYGda1K/7UA/1BEpVIy6HG3ikb2tCLCQoU2';
        $arrayData = json_decode($failure_response);
       $decrypt_res = $this->createResponseLogData($arrayData->encData);
       
        //    echo "<pre>";print_r($decrypt_res);exit;
       $upd_array=array(
        'response_status'       => 0,
        'response_details'      => $decrypt_res['decrypted_text'],
        'response_time'         => $decrypt_res['response_time'],
        'sbiepay_ref_id'        => $decrypt_res['sbiePayRefID'],
        'bank_reference_number'     => $decrypt_res['bank_reference_number']
       );
       $this->sbi_payment_model->update_data('council_sbi_payment_transanction_log_details',$upd_array,$decrypt_res['merchant_order_no']);
       $status = 2;
       redirect(base_url().'admin/sbiepay/proceed_to_pay/index/'.$upd_array['response_status'],'location');

     
    }

    public function decryptEncData($cipherText)
    {
        
        $key = 'A7C9F96EEE0602A61F184F4F1B92F0566B9E61D98059729EAD3229F882E81C3A';
        $algo='aes-128-cbc';

        $iv=substr($key, 0, 16);
        // echo $iv;
        $cipherText = base64_decode($cipherText);
            
        $plaintext = openssl_decrypt(
            $cipherText,
            $algo,
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );
        return $plaintext;   

    }  

    public function createResponseLogData($encData){

        $decrypted_text = $this->decryptEncData($encData);
        // $decrypted_text = 'CH8809800|4430840943731|SUCCESS|100|INR|CC|ABC^DEF^ERD|Payment Success|NA|G1312423|2018-06-24 16:30:24|IN|10000032018062412345|1000003|10.00^1.80|||||||||';
        $decrypt_array = explode("|",$decrypted_text);
        //    echo "<pre>";print_r($decrypt_array);exit;

       $decrypt_res = array(
        'decrypted_text'       => $decrypted_text,
        'merchant_order_no'  =>$decrypt_array[0],
        'sbiePayRefID'      => $decrypt_array[1],
        'res_status'      => $decrypt_array[2],
        'amount'           => $decrypt_array[3],
        'status_description'      => $decrypt_array[7],
        'bank_reference_number' => $decrypt_array[9],
        'response_time'         => $decrypt_array[10],
        'merchantID'         => $decrypt_array[13]
       );
       
       return $decrypt_res;

    }

    public function push_response_post(){

        $push_response = json_encode($_REQUEST);
        $current_date = date("Y-m-d h:i:sa");
       file_put_contents("sbi_push_response.txt", $push_response . PHP_EOL . '------->>>>>>>>>>>>Created date is------'.$current_date.'--' . PHP_EOL, FILE_APPEND);

       $arrayData = json_decode($push_response);
        // echo "<pre>";print_r($arrayData);
       $decrypt_res = $this->createResponseLogData($arrayData->pushRespData);
       
       // echo "<pre>";print_r($decrypt_res);exit;
        $upd_array=array(
        
            'response_details'      => $decrypt_res['decrypted_text'],
            'response_time'         => $decrypt_res['response_time'],
            'sbiepay_ref_id'        => $decrypt_res['sbiePayRefID'],
            'bank_reference_number'     => $decrypt_res['bank_reference_number'],
            'response_description'      => $decrypt_res['status_description']
        );

        if($decrypt_res['res_status'] == 'SUCCESS'){
            $upd_array['response_status'] = 1;
        }
        if($decrypt_res['res_status'] == 'PENDING'){
            $upd_array['response_status'] = 2;
        }
        if($decrypt_res['res_status'] == 'FAIL'){
            $upd_array['response_status'] = 0;
        }
       
       $this->sbi_payment_model->update_data('council_sbi_payment_transanction_log_details',$upd_array,$decrypt_res['merchant_order_no']);
        if($decrypt_res['res_status'] == 'SUCCESS'){
            // Update respective Table with payment Details Id and Response Status
            $this->sbiepay_response_library->updateResponsestatusRespectiveTable($decrypt_res['merchant_order_no']);
        }
       //$status = 1;
       redirect(base_url().'admin/sbiepay/proceed_to_pay/'.$upd_array['response_status'],'location');

    }


    

    
}