<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Send_sms extends NIC_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->library('sms');
        
    }

    public function index(){
		
        //$sms_message ="Hello, Your 123456 No. is 1234 and password is 123 - WBSCT&VE&SD";
		//$template_id=0;
		
		$var=456324;
        $sms_message ="Your mobile verification code for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD is ".$var;
		$template_id=0;
		
		//$sms_message ="Login id and password for registration as Assessor/ Expert / Trainer of Trainers under WBSCTVESD sent to your registered mail id. Please login to complete application process.";
		//$template_id=1707163169681877642;
		
		$mobile_no='8910898906';
        $this->sms->send($mobile_no,$sms_message,$template_id);
		
    }

}
