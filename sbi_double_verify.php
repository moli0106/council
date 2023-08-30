<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

//$this->sbiDoubleVerification();
$merchant_order_no="CH8809800"; // merchant order no
$merchantid="1000112";  //merchant id
$amount = 100;
$url="https://test.sbiepay.sbi/payagg/statusQuery/getStatusQuery"; // double verification url
$queryRequest="|".$merchantid."|".$merchant_order_no."|". $amount;
$queryRequest33=http_build_query(array('queryRequest' => $queryRequest,"aggregatorId"=>"SBIEPAY","merchantId"=>$merchantid));
//echo "$url,$queryRequest33";exit;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_SSLVERSION, true);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch,CURLOPT_POSTFIELDS, $queryRequest33);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
$response = curl_exec ($ch);
if (curl_errno($ch)) {
echo $error_msg = curl_error($ch);
}
curl_close ($ch);
echo $response;

?>