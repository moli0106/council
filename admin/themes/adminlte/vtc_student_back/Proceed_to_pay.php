<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proceed_to_pay extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(140);
        $this->load->model('sbiepay/proceed_to_pay_model');

       
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            //2 => $this->config->item('theme_uri') . 'sbiepay/payment.js',

            
        );

        
    }

    public function index(){
        // echo "hhiii";exit;

        $data['stake_details_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $vtc_std_reg_group_id = $_POST['group_id'];
        $this->session->set_userdata('vtc_std_reg_group_id', $vtc_std_reg_group_id);
        $data['total_std'] = $_POST['std_no'];
        $data['payment_type'] = $_POST['payment_type'];
        

        //Calculate posting Amount For VTC Std Reg
        if($data['payment_type'] == 1){

            $data['details'] = $this->calculate_posting_amount($vtc_std_reg_group_id);
            // echo "<pre>";print_r($data['details']);exit;
            $data['transaction_id'] = $this->genarateTransactionId($data['payment_type']);
        }
        
        $this->load->config('wbsctvesd_api_config');
        $url = $this->config->item('sbi_e_pay')['request_url'];
        $success_url = $this->config->item('sbi_e_pay')['success_url'];
        $failure_url = $this->config->item('sbi_e_pay')['failure_url'];
        $merchantId =  $this->config->item('sbi_e_pay')['merchantId'];

        $post_data = array(
            //'posting_amount' => $data['details']['total_amount'],
			'posting_amount' => 1,
            'success_url'   => $success_url,
            'failure_url'   =>  $failure_url,
            'merchantId'    => $merchantId,
            'merchant_order_no' => $data['transaction_id']
        );
        
       
        // echo "<pre>";print_r($post_data);

        $this->load->library('curl');
        $curl_response = $this->curl->curl_make_post_request($url, $post_data);
        //echo "<pre>";print_r($curl_response);exit;
        $data_response = json_decode($curl_response, true);
        $data['transaction_data'] = $data_response['decrypted_EncryptTrans'];
        $data['encryptTrans'] = $data_response['encryptTrans'];
        $data['merchantId'] = $merchantId;
        //echo "<pre>";print_r($data);exit;

        if(!empty($data['details'])){

            $this->load->view($this->config->item('theme') . 'sbiepay/payment_proceed_view', $data);
        }else{

            redirect('admin/');

        }
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
                'stake_details_id_fk' => $stake_details_id_fk,
                'stake_id_fk'       => $stake_id_fk,
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
                'payment_type_id_fk'    => $_POST['payment_type']
            );

            $payment_details_id = $this->proceed_to_pay_model->insert_data('council_payment_details',$payment_details);

            if($_POST['payment_type'] == 1){ //VTC Student Registration

                $group_id = $_SESSION['vtc_std_reg_group_id'];
                
                $this->insert_vtc_std_rg_lot($payment_details_id, $_POST['transaction_id'], $group_id,$transaction_log_id);
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

        $getStudent = $this->proceed_to_pay_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);
        // echo "<pre>";print_r($getStudent);exit;

        if($group_details['course_name_id_fk'] == 2){
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
	
	public function confirm_payment(){
		//echo "hii";exit;
		
		$EncryptTrans = $_POST['EncryptTrans'];
		$merchIdVal = $_POST['merchIdVal'];
		$postfields = http_build_query(array('EncryptTrans'=>$EncryptTrans,'merchIdVal'=>$merchIdVal));
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, 'https://test.sbiepay.sbi/secure/AggregatorHostedListener');
		//curl_setopt($ch, CURLOPT_URL, 'https://test.sbiepay.sbi/payagg/statusQuery/getStatusQuery');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_POST, 1);
		// Edit: prior variable $postFields should be $postfields;
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // On dev server only!
		print $result = curl_exec($ch);
		
		
		//echo "kkkkkkkkkkkkkkkkk================";
		 $httpcode = curl_getinfo($ch);
		 
		// header()
	//	print_r($httpcode["redirect_url"]);
		
	//print	"<script>window.open('".$httpcode["redirect_url"]."', '_blank');</script>";
		//file
		
	}
}