<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Inline Images with CodeIgniter
 *
 *
 * @package		CodeIgniter
 * @category	Library
 * @author		Parag Dhali
 * @link		https://pbssd.gov.in/
*/

class Sms  {
	
	function send($mobile_no = NULL,$message = NULL, $template_id = NULL) {	
		$mbl_no = $mobile_no;
		$purpose_code=1;
		$mob='91'.trim($mbl_no);
		$tst=$message;
		$uid="utkarshwb.sms";
		$pass="Uk@Br4$6E";
		$send="PABSSD"; // 6 characters long SENDERID
		$dest=urlencode($mob);
		$msg=urlencode($tst);
		$entity_id = '1101608640000040099';
		$url="https://smsgw.sms.gov.in/failsafe/HttpLink?";
		//$data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send&dlt_template_id=$template_id";
		
		$data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send&dlt_entity_id=$entity_id&dlt_template_id=$template_id";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_REFERER, "https://www.pbssd.gov.in/index.php");
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HEADER, "1105161192445619827");
		curl_setopt($ch, CURLOPT_POST, 2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($ch, CURLOPT_CAINFO,'/etc/pki/tls/certs/ca-bundle.crt');
		$curl_output =curl_exec($ch);
		if ($err = curl_error($ch)) {
			return $err;
        } else {
			return TRUE;
		}
		
	}
	
	function sendotp($mobile_no = NULL,$message = NULL, $template_id = NULL){
		$mbl_no = $mobile_no;
		$purpose_code=1;
		$mob='91'.trim($mbl_no);
		$tst=$message;
		$uid="utkarshwb.otp";
		$pass="Yk!Br4%246p";
		$send="PABSSD"; // 6 characters long SENDERID
		$dest=urlencode($mob);
		$msg=urlencode($tst);
		$entity_id = '1101608640000040099';
		$url="https://smsgw.sms.gov.in/failsafe/HttpLink?";
		//$data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send&dlt_template_id=$template_id";
		
		$data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send&dlt_entity_id=$entity_id&dlt_template_id=$template_id";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_REFERER, "https://www.pbssd.gov.in/index.php");
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HEADER, "1105161192445619827");
		curl_setopt($ch, CURLOPT_POST, 2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($ch, CURLOPT_CAINFO,'/etc/pki/tls/certs/ca-bundle.crt');
		$curl_output =curl_exec($ch);
		if ($err = curl_error($ch)) {
			return $err;
        } else {
			return TRUE;
		}
	}
	function send_uc($mobile_no = NULL,$message = NULL, $template_id = NULL) {	
		$mbl_no = $mobile_no;
		$purpose_code=1;
		$mob='91'.trim($mbl_no);
		$tst=$message;
		$uid="utkarshwb.sms";
		$pass="Uk@Br4$6E";
		$send="PABSSD"; // 6 characters long SENDERID
		$dest=urlencode($mob);
		$msg=urlencode($tst);
		$url="https://smsgw.sms.gov.in/failsafe/HttpLink?";
		$data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send&dlt_template_id=$template_id&msgType=UC";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_REFERER, "https://www.pbssd.gov.in/index.php");
		//curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_HEADER, "1105161192445619827");
		curl_setopt($ch, CURLOPT_POST, 2);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
		curl_setopt($ch, CURLOPT_CAINFO,'/etc/pki/tls/certs/ca-bundle.crt');
		$curl_output =curl_exec($ch);
		if ($err = curl_error($ch)) {
			return $err;
        } else {
			return TRUE;
		}
		
	}
}
	