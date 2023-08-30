<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_test extends CI_Controller {
	public function index(){

        

        $this->load->library('email');
        $config['protocol']  = 'smtp';
        $config['smtp_host'] = 'smtp.wbsdc.in';
        $config['smtp_port'] = 25;
        //$config['smtp_user'] = 'support.tetsd-wb@wbsdc.in';
        //$config['smtp_pass'] = 'Tetsd@123';
        $config['mailtype']  = 'html';
		$config['newline'] = "\r\n";
		$config['crlf'] = "\r\n";		
        $this->email->initialize($config);	
        $this->email->from('noreply-sctvesd@wbsdc.in', 'WBSCTVESD Portal');
        //$this->email->to('parwaz.waseem@gmail.com');
		//$this->email->cc('sarmin.nasrat09@gmail.com');
        $this->email->to('parwaz.waseem@gmail.com');		
        $this->email->subject('Test Email');
        $this->email->message('Test Email');

        $this->email->send();
		
		//$this->email->send(FALSE);

		// Will only print the email headers, excluding the message subject and body
		//$this->email->print_debugger(array('headers'));
    }

}