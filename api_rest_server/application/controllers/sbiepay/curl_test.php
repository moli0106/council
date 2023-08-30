<?php
/*
	Sample SBI EPay 
*/
//echo "<b><center>Payment Model</center></b><br/><br/>";
//include('CryptAES.php');
include('../Crypt/AES128_php.php');
$orderid = '';
for ($i=0; $i<10; $i++)
{
		$d=rand(1,30)%2;
		$d=$d ? chr(rand(65,90)) : chr(rand(48,57));
		$orderid=$orderid.$d;
}
//encryption key

//$key = "A7C9F96EEE0602A61F184F4F1B92F0566B9E61D98059729EAD3229F882E81C3A";
$key = "A7C9F96EEE0602A61F184F4F1B92F0566B9E61D98059729EAD3229F882E81C3A";

//requestparameter 
$requestParameter  ="1000112|DOM|IN|INR|10|Other|http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_response/success_response|http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_response/failure_response|SBIEPAY|".$orderid."|2|NB|ONLINE|ONLINE";

// $requestParameter  ="1000112|DOM|IN|INR|1|Other|http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_response/success_response|http://localhost/council_live/api_rest_server/sbiepay/sbi_payment_response/failure_response|SBIEPAY|P9AEY4BB2I|2|NB|ONLINE|ONLINE";
//echo '<b>Requestparameter:-</b> '.$requestParameter.'<br/><br/>';
$aes = new AESEncDec();
$EncryptTrans = $aes->encrypt($requestParameter,$key); 
//$aes = new Crypt_AES();
//$secret=base64_decode($key);
//$aes->setKey($secret);




//$EncryptTrans = $aes->encrypt($requestParameter);
echo $orderid;


// echo '<b>Encrypted EncryptTrans:-</b>'.$EncryptTrans.'<br/><br/>';



?>
<!-- <form name="ecom" method="post" action="https://test.sbiepay.sbi/secure/AggregatorHostedListener"> -->
<form name="ecom" method="post" action="http://localhost/council_live/curl_test_sbi.php">
<input type="text" name="EncryptTrans" value="<?php echo $EncryptTrans; ?>">
<input type="text" name="merchIdVal" value ="1000112"/>
<input type="submit" name="submit" value="Submit">
</form>
