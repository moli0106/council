<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| WBSCTVESD Council Assessment API URL Link for Batch Assignment
|--------------------------------------------------------------------------
*/
$config['assessor_assign_url'] = array(
    'PBSSD'  => 'https://164.100.228.244/api_server/council_assessment/batch_assessment_response_PBSSD/assessment_response_data',
    'CSSVSE'  => 'http://172.20.140.171/api_rest_server/cssvse/assessment/batch_response',
);


$config['CSSVSE_ASSESSMENT'] = array(
    'batch_push'  => 'http://172.20.140.171/api_rest_server/assessment_batch/create_assessment_batch',
    'trainee_image'  => 'http://172.20.140.171/api_rest_server/assessment_batch/trainee_document',
);

$config['sbi_e_pay'] = array(
    'request_url' => 'http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_request/paymentTransaction',
    'success_url' => 'http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_response/success_response',
    'failure_url' => 'http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_response/failure_response',
    'merchantId'   => 1000112
);
