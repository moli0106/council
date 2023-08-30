<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('send_email')) {
	function send_email($email_id = NULL, $email_message = NULL, $email_subject = NULL)
	{
		if ($email_id != NULL || $email_message != NULL) {
			$mail_to = $email_id;
			$subject = $email_subject;
			$message = $email_message;

			$CI = &get_instance();
			$CI->load->library('email');
			$config['protocol']  = 'smtp';
			$config['smtp_host'] = 'smtp.wbsdc.in';
			$config['smtp_port'] = 25;
			//$config['smtp_user'] = 'support.tetsd-wb@gov.in';
			//$config['smtp_pass'] = 'Tetsd@123';
			$config['mailtype']  = 'html';
			$config['newline'] = "\r\n";
			$config['crlf'] = "\r\n";
			$CI->email->initialize($config);
			$CI->email->from('noreply-sctvesd@wbsdc.in', 'WBSCTVESD Portal');
			$CI->email->to($mail_to);
			$CI->email->subject($subject);
			$CI->email->message($message);

			if ($CI->email->send()) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}
}
