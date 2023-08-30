<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bskapidata
{ 
    /**
     * CI instance
     *
     * @var object
     */
    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     ! Send student submit request to client
     *
     * @param string $bsk_ticket_no		  The bsk_ticket_no to get information about student who is entry from BSK portal (Required)
     * 
     * @return array API's request
    */

    public function studentEntryData($bsk_ticket_no){

        if($bsk_ticket_no){

            extract($this->CI->registration_model->bskStudentResponseData($bsk_ticket_no));
            $requestArray = array(
                "userid" => $std_details['bsk_userid'],
                "ticketNo"=> $std_details['bsk_ticket_no'],
                "appNo" => ($std_details['application_form_no'] == '')? '' : $std_details['application_form_no'],
                " appSubTime " => 20220811052025,
                "deptPayRefNo" => "",
                "transNo" => "",
                "bankRefNo" => "",
                "paidAmt" => NULL,
                "applicationstatus"=> 2,
                "statuscode" => "200"
            );
            return $requestArray;
        }else {

            return FALSE;
        }
    }
}