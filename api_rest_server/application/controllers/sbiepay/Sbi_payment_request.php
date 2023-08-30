<?php defined('BASEPATH') or exit('No direct script access allowed');

class Sbi_payment_request extends NIC_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->library(array('form_validation'));

		$this->load->model('sbiepay/sbi_payment_model');
	}
	public function paymentTransaction_post(){

		
		$merchantId = $_POST['merchantId'];

		$operating_mod = 'DOM';

		$merchant_country = 'IN';

		$merchant_currency = 'INR';

		$posting_amount = $_POST['posting_amount'];
		 //$posting_amount = 1;

		$other_details = $_POST['other_details'];

		$success_url = $_POST['success_url'];

		$failure_url = $_POST['failure_url'];

		$aggregator_id = 'SBIEPAY';

		// $merchant_order_no = 'asdf1234789';
		$merchant_order_no = $_POST['merchant_order_no'];

		$merchant_customer_id = 2;

		$pay_mode = 'NB';

		$access_medium = 'ONLINE';

		$transaction_source = 'ONLINE';


		$decrypted_EncryptTrans = $merchantId.'|'.$operating_mod.'|'.$merchant_country.'|'.$merchant_currency.'|'.$posting_amount.'|'.$other_details.'|'.$success_url.'|'.$failure_url.'|'.$aggregator_id.'|'.$merchant_order_no.'|'.$merchant_customer_id.'|'.$pay_mode.'|'.$access_medium.'|'.$transaction_source;

		$encryptTrans = $this->encrypt($decrypted_EncryptTrans);
		$dcrypt = $this->decrypt($encryptTrans);
		
		
		$data_res = array(
			'decrypted_EncryptTrans' => $decrypted_EncryptTrans,
			'encryptTrans'			=>  $encryptTrans
		);
		// echo "<pre>";print_r($data_res);exit;

		$this->response($data_res, REST_Controller::HTTP_OK);

	}

	public  function encrypt($data)
	{
		

		$key = 'A7C9F96EEE0602A61F184F4F1B92F0566B9E61D98059729EAD3229F882E81C3A';
			$algo='aes-128-cbc';
		
		$iv=substr($key, 0, 16);
			//echo $iv;
		$cipherText = openssl_encrypt(
				$data,
				$algo,
				$key,
				OPENSSL_RAW_DATA,
				$iv
			);
			$cipherText = base64_encode($cipherText);
			//echo $cipherText;exit;
	
		return $cipherText;
	
	
	}


public function decrypt($cipherText)
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
}