<?php defined('BASEPATH') or exit('No direct script access allowed');

class Bsk_response extends NIC_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->library(array('form_validation'));

		$this->load->model('bsk/bsk_response_model');
	}

    public function online_application_responsess_post_old(){

        // $success_response = json_encode($_REQUEST);
        $success_response = json_encode($_REQUEST);
        $current_date = date("Y-m-d h:i:sa");
        file_put_contents("bsk_response.txt", $success_response . PHP_EOL . '------->>>>>>>>>>>>Created date is------'.$current_date.'--' . PHP_EOL, FILE_APPEND);
        $arrayData = json_decode($success_response);
        // $decrypt_res = $this->decrypt_data($arrayData['encData']);
        $test = '{"agId": "BSK",
        "encData": "m4p3CxxkyshZk6hQdSi509Uu3Gn8i4MXIz/uqgSl40FfH0Hv7M/ThZj3YnAiVLdmuQ4DdGEPVLYtOihNsC2c58hyH7khCvbArmCd1cLR0jiFHMFKnbdu95heTGpNgIcZX3sldrbXwueNLIfR4Uu5I6BfKrWgWK8+YPA5soZhT00="}';
       
       
        $arr = json_decode($test,true);
        
        $decrypt_rest = $this->decrypt_data($arr['encData']);
       
        $data='{"userid":"8527419636","ticketno":"30221202153322882","citizenmobile":"8963258963","citizenname":"Anupam Ghosh"}';
            

        $decryptedData_arr = json_decode($data,true);
       
        $user_id = $decryptedData_arr['userid'];
        $applicant_name = $decryptedData_arr['citizenname'];
        $applicant_mobile_no = $decryptedData_arr['citizenmobile'];
        $ticket_no = $decryptedData_arr['ticketno'];
    
        // $data['api_arr'] = $api_arr;

        $insert_data = array(
            'ticketno' => $ticket_no,
            'userid' => $user_id,
            'citizenmobile' => $applicant_mobile_no,
            'decrypt_enc_data' => $data,
            'received_json' => $test,
            'citizenname'  => $applicant_name
        );
        
        $this->bsk_response_model->insert_data('council_bsk_api_json_data',$insert_data);
        
        
       
        //echo "<pre>";print_r($decryptedData_arr);exit;

        redirect(base_url().'online_application_various_courses/registration/index/'.$ticket_no,'location');
        
       
       
    }

    public function online_application_response_post(){
		//echo "hii";exit;
		//echo "<pre>";print_r($_REQUEST);die;
        // $success_response = json_encode($_REQUEST);
        $success_response = json_encode($_REQUEST);
        $current_date = date("Y-m-d h:i:sa");
        file_put_contents("bsk_response.txt", $success_response . PHP_EOL . '------->>>>>>>>>>>>Created date is------'.$current_date.'--' . PHP_EOL, FILE_APPEND);
        $arrayData = json_decode($success_response);
        
       
        //$arr = json_decode($test,true);
        
        $decrypt_rest = $this->decrypt_data($arrayData->encData);
       //echo "<pre>";print_r($decrypt_rest);die;
        //$data='{"userid":"8527419636","ticketno":"30221202153322882","citizenmobile":"8963258963","citizenname":"Anupam Ghosh"}';
            

        $decryptedData_arr = json_decode($decrypt_rest,true);
       
        $user_id = $decryptedData_arr['userid'];
        $applicant_name = $decryptedData_arr['citizenname'];
        $applicant_mobile_no = $decryptedData_arr['citizenmobile'];
        $ticket_no = $decryptedData_arr['ticketno'];
    
        // $data['api_arr'] = $api_arr;

        $insert_data = array(
            'ticketno' => $ticket_no,
            'userid' => $user_id,
            'citizenmobile' => $applicant_mobile_no,
            'decrypt_enc_data' => $data,
            'received_json' => $test,
            'citizenname'  => $applicant_name
        );
        
        $this->bsk_response_model->insert_data('council_bsk_api_json_data',$insert_data);
        
        
       
        //echo "<pre>";print_r($decryptedData_arr);exit;

        redirect(base_url().'online_application_various_courses/registration/index/'.$ticket_no,'location');
        
       
       
    }

    function decrypt_data($encryptedData)
	{
		// $encdata = $_POST['encData'];
		// $encdata =$encryptedData;
		// $decryptionKey = "IP16TDW0L5AQB41V6S6J8QLTPLRXBV2W";
    	// $initializationVector = "V0ZMZO6WZ45KY2PL";
 		// $options = 0;
 	    // $decryptedData = openssl_decrypt($encdata, 'aes-256-cbc', $decryptionKey, $options, $initializationVector);
        // // $new = str_replace( array('"', '{', '}'), ' ', $decryptedData);
        
        // return $new;


        $decryptionKey = 'IP16TDW0L5AQB41V6S6J8QLTPLRXBV2W';
        $initializationVector = "V0ZMZO6WZ45KY2PL";
        $algo='aes-256-cbc';
        $options = 0;
       
        //$encryptedData = base64_decode($encryptedData);
            
        $plaintext = openssl_decrypt(
            $encryptedData,
            $algo,
            $decryptionKey,
            $options,
            $initializationVector
        );
        return $plaintext;  
        
 		
	}

   

    public function send_all_bsk_data_post(){
        //echo "hi";
        $passcode = $_POST['passcode'];
        $form_string_date =$_POST['fromdate'];
        $to_string_date =$_POST['todate'];
        $limit = $_POST['limit'];
        $offset = $_POST['offset'];

        $form_date = date_format(date_create(substr($form_string_date,0,4).'-'.substr($form_string_date,4,2).'-'.substr($form_string_date,6,2)), "Y-m-d");
        $to_date = date_format(date_create(substr($to_string_date,0,4).'-'.substr($to_string_date,4,2).'-'.substr($to_string_date,6,2)), "Y-m-d");

        // echo substr($date,0,4);
        // echo "-".substr($date,4,2);
        // echo "-".substr($date,6,2);

        if($form_date !='' && $to_date!=''){
            $alldata = $this->bsk_response_model->get_all_bsk_data($form_date, $to_date,$limit,$offset);
            if(!empty($alldata)){

               $response_data =  $this->createResponseArray($alldata);
                //    echo "<pre>";print_r(json_encode($response_data));
              echo  $res_enc_data = $this->encrypt_data(json_encode($response_data));

              $decrypt_res = $this->decrypt_data($res_enc_data);
              echo "<pre>";print_r(($decrypt_res));
            }
            
        }
    }

    function encrypt_data($data){
		
		//$data='{"userid":"8527419636","ticketno":"20221202153322882","citizenmobile":"9963258963","citizenname":"Anupam Ghosh"}';
		$encryptionKey = "IP16TDW0L5AQB41V6S6J8QLTPLRXBV2W"; 
		$initializationVector = "V0ZMZO6WZ45KY2PL";
		$options = 0;
		$encryptedData = openssl_encrypt($data, 'aes-256-cbc', $encryptionKey, $options, 
		$initializationVector);
		return $encryptedData;
		 
		// echo $data;
	}

    
    public function createResponseArray($alldata_array){
        // echo "<pre>";print_r($alldata);
        if(!empty($alldata_array)){

            $final_arr = [];
            foreach ($alldata_array as $key => $value) {
                $data=array(
                    "ticketno" =>$value['bsk_ticket_no'],
                    "userid" => $value['bsk_userid'],
                    "citizenmobile" => $value['mobile_number'],
                    "appno" => $value['application_form_no'],
                    "appsubtime" => $value['entry_time'],
                    "deptpayrefno"=> $value['sbiepay_ref_id'],
                    "transno"=> $value['transaction_id'],
                    "bankrefno"=> $value['bank_reference_number'],
                    "paidamt"=> $value['posting_amount'],
                    "applicationstatus" =>1,
                    "statuscode" => 200
                );
                array_push($final_arr,$data);
            }
            return $final_arr;
        }
    }
	
}