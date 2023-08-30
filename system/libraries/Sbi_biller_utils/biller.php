<?php
include('Crypt/RSA.php');
include('Crypt/AES.php');
include('Crypt/Random.php');


$biller_private_key=file_get_contents('./biller/biller_private_key.text');
 $biller_public_key=file_get_contents('./biller/biller_public_key.text');

 $bou_public_key=file_get_contents('./bou/bou_public_key.text');
 $bou_private_key=file_get_contents('./bou/bou_private_key.text');

$bou_enc_aes_key=file_get_contents('./bou/bou_enc_aes_key.text');
$aes_decripted_key="c4d9042169af81c27641a78644a31a29";

//print(hex2bin($aes_decripted_key));

$bou_cipher_text=file_get_contents('./bou/bou_cipher_text.text');
$encryptedResponseMsg=file_get_contents('./bou/encryptedResponseMsg.text');
$biller_cipher_text=file_get_contents('./biller/biller_cipher_text.text');

$bou_digitalSignature=file_get_contents('./bou/bou_digitalSignature.text');


$rsa = new Crypt_RSA();
$rsa->loadKey($biller_private_key);
$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_OAEP);
$rsa->setHash('sha256');
$ciphertextkey = $rsa->decrypt(base64_decode($bou_enc_aes_key));

function aes_gcm_decrypt($content, $secret) {
    $cipher = 'aes-128-gcm';
   // $ciphertextwithiv = bin2hex(($content));
    $iv = (substr($secret,0,12));
    //print($iv);
    $tag = substr($content , -32);
    $ciphertext = substr($content, 0,strlen($content)-32);
    $skey = hex2bin($secret);

    return openssl_decrypt(hex2bin($ciphertext), $cipher, $skey, OPENSSL_RAW_DATA, hex2bin($iv), hex2bin($tag));
}


function aes_gcm_encrypt($data, $secret) {
  $cipher = 'aes-128-gcm';
  $string =  $data;
  $skey = hex2bin($secret);
  $iv = hex2bin(substr($secret,0,12));
  //print(strlen($iv));
  $tag = NULL;
  $content = openssl_encrypt($string, $cipher, $skey, OPENSSL_RAW_DATA, $iv, $tag);

  $str = bin2hex($content) . bin2hex($tag);
  
 print strlen(bin2hex($tag));
  
  return (($str));
}



$string = str_replace(array("\n", "\r"," "), '', $bou_cipher_text);
//print is_hex($bou_cipher_text);



print $Decript_text=aes_gcm_decrypt(($string),$ciphertextkey);

$rnn="OU0120221109053011913cfdd1c6d941089";
$timeStamp="2022-11-09T17:30:11+05:30";
$signature_text=$rnn.$timeStamp.$string;

$rsa = new Crypt_RSA();
$rsa->setHash('sha256');
$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
$rsa->loadKey($bou_public_key);
//$rsa->verify
//$x509 = new X509();
//$privatekey = file_get_contents(storage_path('app/private.pem'));
//$rsa->loadKey($privatekey);
//$signed = $rsa->sign($data);

//$publickey =  $bou_public_key;
//$x509->loadX509($bou_public_key);
//$rsa = $x509->getPublicKey();
//print($bou_digitalSignature=str_replace(array("\n", "\r"," "), '', $bou_digitalSignature));

print $rsa->verify($signature_text, base64_decode($bou_digitalSignature)) ? 'verified' : 'unverified';




$rsa = new Crypt_RSA();
$rsa->setPassword('nic@123');
$rsa->setHash('sha256');
$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
extract($rsa->createKey());
print $privatekey; 

print $publickey; 
die;


?>
