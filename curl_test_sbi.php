<?php
/*
	Sample SBI EPay 
*/
//echo "<b><center>Payment Model</center></b><br/><br/>";
//include('CryptAES.php');
include('Crypt/AES128_php.php');

$requestParameter = 'WKCId1OTmEgIYlw5i74Bnyiz4OFMNMXvsIRR9XL0x1M7hbHYkhac1y7EEglVJmrM';
$key = 'sW5BiBbVGdzXIpODTJxhwg==';

$aes = new AESEncDec();
$DecryptMarchantKey = $aes->decrypt($requestParameter,$key); 
echo $DecryptMarchantKey;

// Decrypt Merchant Key : W5BiBbVGdzXIpODT

?>





