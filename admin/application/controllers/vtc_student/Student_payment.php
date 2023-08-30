<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_payment extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(140);
        $this->load->model('vtc_student/student_payment_model');

        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/student_payment.js',

            
        );

        //$this->load->library('Sbi_biller_utils/biller_security_util');
    }

    public function index(){

        // $this->session->userdata('client_ip');

        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');

        // add on 14-03-2023
        $data['vtc_details'] = $this->student_payment_model->getVtcDetails($data['vtc_id_fk'], $data['academic_year']);
        //echo "<pre>";print_r($data['vtc_details']);exit;

        if($data['vtc_details']['special_category'] != 1){

            $data['stdByGroup'] = $this->student_payment_model->getStdCountByGroupForSpecialCategory($data['vtc_id_fk'] , $data['academic_year']);
        }else{

            $data['stdByGroup'] = $this->student_payment_model->getStdCountByGroup($data['vtc_id_fk'] , $data['academic_year']);
        }

        //echo "<pre>";print_r($data['stdByGroup']);exit;
        $this->load->view($this->config->item('theme') . 'vtc_student/student/student_payment_view', $data);
    }


    public function groupWiseStdRequest($group_id = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if($group_id != NULL){
                $std_no = $this->input->get('std_no');

                $vtc_id_fk =  $this->session->userdata('stake_details_id_fk');
                $academic_year = $this->config->item('current_academic_year'); 

                $rquest_array = array(
                    'vtc_id_fk' =>      $vtc_id_fk,
                    'academic_year'     => $academic_year,
                    'group_id_fk'       => $group_id,
                    'no_of_student'     => $std_no,
                    'approve_status'    => 0,
                    'requested_time'    => 'now()',
                    'requested_ip'      => $this->input->ip_address()
                );
                echo "<pre>";print_r($rquest_array);exit;
                // $request_id = $this->student_payment_model->insertData('council_vtc_requested_student_details', $rquest_array);
                // echo $request_id;
            }

        }
    }

    public function groupWiseStdPayment($group_id = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($group_id !=NULL){
                $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
                $data['academic_year'] = $this->config->item('current_academic_year');

                $getStudent = $this->student_payment_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);

                //Insert Payment Details
                $payment_details = array(
                    'created_date' => 'mow()',
                    'payment_for' =>  'vtc student'
                );
                //$payment_details_id = $this->student_payment_model->insertData('council_payment_details', $payment_details);


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
                    'academic_year'     => $data['academic_year']
                );

                // update Student Table
                $update_std_data = array(
                    'payment_status' => 'yes',
                    'payment_date'   => 'now()'
                );
                
                
            }
        }

    }

    public function generateStdRegNo($group_id = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($group_id !=NULL){
                $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
                $data['academic_year'] = $this->config->item('current_academic_year');

                $getStudent = $this->student_payment_model->getStudentListByGroupId($group_id, $data['vtc_id_fk'] , $data['academic_year']);
                if(!empty($getStudent)){
                    // echo "<pre>";print_r($getStudent);exit;

                    foreach ($getStudent as $key => $value) {
                        if($value['class_id_fk'] == 4){
                            
                        }

                    }
                }
            }
        }
    }


    public function temp_pay (){
        // new billerSecurityUtil();
        // $this->biller_security_util->getPrivatePublicKey();

        // echo $_SERVER['DOCUMENT_ROOT'];exit;

        

        //Decrypt AES key
        $access_token = 'DTOA+A2XMIGaASElwG6Vxi0kfa6S0RF68PlKAzpcqFRf4TsXf+BJS/B7uNO4gT6DV3XhmH00+0qB66sC4nqjOF9waoEI4QdW0cYq16rJAjKwqUvGfARDFssl+71rVRuJbjGZBNOjwvZiMuAI/autJmF7vgkZIQvhGiOWQkPIlufxmk7eaWImAfJjLG7E6Jm2TCEuzkQaFoDBGgZByzRdQY8MpN1X5W3lGG/RFEFU4gwNBkYAGpgATSn4S0dRSwktPW+CaXpvq6SZD3NirUYgP8KqXbotK55zJsiX3A31EUwi8/O4pkp2EY6D+5BHGStRLoAtC14ca4OWkZAGDYgU/g==';

        $aes_key = $this->biller_security_util->decryptMessage($access_token);

         $request_json = '{
            "rrn":"OU0120221109053011913cfdd1c6d941089",
            "cipherText":"C11DBDDE343F94D2921B4052E5D5BCFFD806D4AD3915BC46B7B478681D02DDBD4D2E6A794A2150ADCA81B4372DF4E0D920430FA919C7344C5B3707C86BC5260916D4B307D2DB894C751B5A939DC4EBC05F31D304A0AA3491F0CA0C0DB1BA343F1F3A3E35895827EB165C6E02324EE24F3435772B2ECC4F25A9FCE2624DA198DE23DD8DFA99B9FC06CF39B7229B78F00356B80013CDB0223AADA555B74041665B2E18AD74EC616488823A73A03A833415D2C7BA040E6838931E479AD37B725B3F0B212F79A006B17E63219E1C23834773D111DCF2E9F9C1BC165657D00D1E3E337763819316EF7326ECB4C26FB110343BC71C3961168BA5FB079B785B946B31287630C38F18C1D95E985C099B298F74AE0BF79E0C6B272EC67631D3860B7D9914AB4CF2A4540BA72587A32EB3E4FBD43543BDB63C976727947A2094BA6FF3E7AB2DEBE0F7883C5654565A8025C5D072B56ED02F90E72DD978897F332C85B64D47DA0DE1C9250F8EDEBE3CBD8A4A903515A2C76E4FB889EDD33ED2FDB9BF54A688722A289A16A7DEEB487F3AD1D35E791A92BD2B882C80C5F53F8E0681E6031C6F711C2653F8EC422DA5497162C54729BC15574B3E29486960CBD0F391E242",
            "digitalSig":"X2/OW52ydGH29+HIxEPkvBxFrftzdFVczu7qhLDQQoBU5KEsri/1Ioe2He0DWJ9Y9oKMX0bJzezX4q20PrFK04q8CuncAfO+rZ08R4sZHCapihjUQq7fCmqWwRQ42GPeRoLYPxAU+73zk5hAqCLSmHf/Cn/2IENtS+YREJT4cjwyptzmiHumwV5REERkombakQG2p4GfUo/PWmWFce8pDSr/zcdbPb9VwxJ8UK4Z4BIgTemuvBFjQ3/RCUox+PjHQuxN4l2KJGK4ZRorLyM2X59T/6hVn6JpPSkebmk8XGbMnEXDEVgDUcoEM8zLsXNud6YBpLSnlNDCDlQrgEHBbw==",
            "timeStamp":"2022-11-09T17:30:11+05:30"}';

        // $request_json = '{"TransactionId": 11,"StudentName":"SUBHA SDSFSDF hjgjhfg DAS","FatherName":"TAPAS DAS","GuardianName":"TAPAS DAS","StuGuardianRelationshipCode":"1","NationalityCode":"1","AadhaarNumber":"800788333281","StuMobile":"9062123500","StuEmail":null,"StuContactAddress":"","StuContactHabitation":"KANCHIARA","StuContactStateCode":"19","StuContactDistrict":"1911","StuContactBlock":"191101","StuContactPin":"743711","SocialCategoryCode":"1","ReligionCode":"0","CwsnYesNoCode":null,"StuDob":"2006-07-18","GenderCode":"1","YearOfPassing":"2021","ClassXMarks":"201","LastAcademicExamPassed":"10"}';
            $data =json_decode($request_json,true);
            $decrypt_cipher_text = $this->biller_security_util->decryptAesGcm($data['cipherText'],$aes_key);

            echo "<pre>";print_r($decrypt_cipher_text);exit;
       
    }


    public function proceed_to_pay(){
       //echo "<pre>";print_r($_POST);
       $group_id = $_POST['group_id'];
       $data['total_std'] = $_POST['std_no'];
       $data['group_details'] = $this->student_payment_model->getGroupDetailsById($group_id);
        //    echo "<pre>";print_r($data['group_details']);
        if(!empty($data['group_details'])){

            $this->load->view($this->config->item('theme') . 'vtc_student/student/payment_proceed_view', $data);
        }else{
            redirect('admin/vtc_student/student_payment');

        }
    }

    public function group_wise_student_list($group_id){
       
        $data['offset']=0;
        $data['vtc_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->student_payment_model->getVtcDetails($data['vtc_id_fk'], $data['academic_year']);
        //echo "<pre>";print_r($data['vtcDetails']);exit;
        $data['std_list'] = $this->student_payment_model->get_std_listByGroup($data['vtc_id_fk'],$group_id);
        $data['group'] = $this->student_payment_model->get_group_details($group_id);
        //echo "<pre>";print_r($data['std_list']);exit;
        if(!empty($data)){
            $this->load->view($this->config->item('theme') . 'vtc_student/student/group_wise_student_view', $data);
        }
    }


    

    
}