<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Inline Images with CodeIgniter
 *
 *
 * @package		CodeIgniter
 * @category	Library
 * @author		Parag Dhali
 * @link		https://sctvesd.wb.gov.in/
 */

class Sms
{

	function send($mobile_no = NULL, $message = NULL, $template_id = NULL)
	{
		$mobile      	= urlencode($mobile_no);
		$msg         	= urlencode($message);
		$template_id 	= urlencode($template_id);
		$ukey			= 'xa1a8ogxRdKjGM62zMO3yti3P';	//ukey assigned to account xa1a8ogxRdKjGM62zMO3yti3P
		$senderid		= 'TVESD';		//Source address of the msg
		$language		= 0;	//0-For English,2-For Multilingual
		$credittype		= 7;	//1-Promo,2-Trans,7-Testing

		$url = "http://125.16.147.178/VoicenSMS/webresources/CreateSMSCampaignGet?ukey=$ukey&msisdn=$mobile&language=$language&credittype=$credittype&senderid=$senderid&templateid=$template_id&message=$msg&filetype=2";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CAINFO, '/etc/pki/tls/certs/ca-bundle.crt');
		$curl_output = curl_exec($ch);

		if ($err = curl_error($ch)) {
			return FALSE;
			//echo 'f';
			//print_r($err);
		} else {
			return TRUE;
			//echo 't';
			//print_r($curl_output);
		}
	}
}
