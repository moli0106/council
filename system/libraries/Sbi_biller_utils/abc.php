<?php


defined('BASEPATH') OR exit('No direct script access allowed');



	// include_once('Crypt/RSA.php');
	// include_once('Crypt/AES.php');
	// include_once('Crypt/Random.php');
	//print (__DIR__);
// 	$biller_private_key=file_get_contents(__DIR__.'\biller\biller_private_key.text');
// 	$biller_public_key=file_get_contents(__DIR__.'/biller/biller_public_key.text');
// //C:\xampp\htdocs\council_live\system\libraries\Sbi_biller_utils
// 	$bou_public_key=file_get_contents(__DIR__.'/bou/bou_public_key.text');
// 	$bou_private_key=file_get_contents(__DIR__.'/bou/bou_private_key.text');
	
class CI_Abc {
	
	
	//include('Crypt/RSA.php');
	//include('Crypt/AES.php');
	//include('Crypt/Random.php');
	
	 
	
	
	/* 
		************* Genarate Private And Public Key  ***************
	
	*/
	
	public function getPrivatePublicKey(){
		echo 123;die;
		
		$password = 'nic@123';
		
		$rsa = new Crypt_RSA();
		$rsa->setPassword($password);
		$rsa->setHash('sha256');
		$rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
		$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
		extract($rsa->createKey());
		
		file_put_contents("biller_private_key.pem",$privatekey);
		file_put_contents("biller_public_key.pem",$publickey);
		
		print $privatekey; 

		print $publickey; 
		
	}
	
	/* **********
	
		/////////  getting Signature Text   /////////////
		
		$rnn="OU0120221109053011913cfdd1c6d941089";
		$timeStamp="2022-11-09T17:30:11+05:30";
		$signature_text=$rnn.$timeStamp.$bou_cipher_text;
		
	**********/
	
	function verifyDigitalSignature($bou_public_key , $bou_digitalSignature , $signature_text){
		
		$rsa = new Crypt_RSA();
		$rsa->setHash('sha256');
		$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
		$rsa->loadKey($bou_public_key);
		
		return $rsa->verify($signature_text, base64_decode($bou_digitalSignature)) ? 'verified' : 'unverified';
	}
	
	/*
		*** generate 
		Digital Signature 
		using biller Private Key *********
	
	*/
	function generateDigitalSignature($biller_private_key, $signature_text){
		
		$rsa = new Crypt_RSA();
		$rsa->setHash('sha256');
		$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
		$rsa->loadKey($biller_private_key);
		
		return $signed = $rsa->sign($signature_text);
	}
	
	
	
	/*
		************
		********
			Decrtypt Access Token 
			Using Biller Private Key
		********
		**************
	
	*/
	
	function decryptMessage($biller_private_key , $bou_enc_aes_key){
		
		$rsa = new Crypt_RSA();
		$rsa->loadKey($biller_private_key);
		$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_OAEP);
		$rsa->setHash('sha256');
		$ciphertextkey = $rsa->decrypt(base64_decode($bou_enc_aes_key));
	}
	
	/*
		Decrtypt Cipher Text
	*/
	function decryptAesGcm($encrypted_cipher_text, $string_aes_key){
		
		
		$cipher = 'aes-128-gcm';
	   // $ciphertextwithiv = bin2hex(($encrypted_cipher_text));
		$iv = (substr($string_aes_key,0,12));
		//print($iv);
		$tag = substr($encrypted_cipher_text , -32);
		$ciphertext = substr($encrypted_cipher_text, 0,strlen($encrypted_cipher_text)-32);
		$skey = hex2bin($string_aes_key);

		return openssl_decrypt(hex2bin($ciphertext), $cipher, $skey, OPENSSL_RAW_DATA, hex2bin($iv), hex2bin($tag));
		
	}
	
	/*
		Encrypt Cipher Text
	*/
	function encryptAesGcm($string_aes_key, $plainText){
		
		
		$cipher = 'aes-128-gcm';
	  //$string =  $plainText;
	  $skey = hex2bin($string_aes_key);
	  $iv = hex2bin(substr($string_aes_key,0,12));
	  //print(strlen($iv));
	  $tag = NULL;
	  $content = openssl_encrypt($plainText, $cipher, $skey, OPENSSL_RAW_DATA, $iv, $tag);

	  $str = bin2hex($content) . bin2hex($tag);
	  
	 print strlen(bin2hex($tag));
	  
	  return (($str));
	}
	
}

?>