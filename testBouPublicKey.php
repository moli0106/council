<?php  

$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);

// Create the private and public key
$res = openssl_pkey_new($config);

// Extract the private key from $res to $privKey
openssl_pkey_export($res, $privKey);
//print $privKey;
file_put_contents("test3_privatekey.pem",$privKey);

// Extract the public key from $res to $pubKey
$pubKey = openssl_pkey_get_details($res);
$pubKey = $pubKey["key"];

print $pubKey ;

file_put_contents("test3_publickey.pem",$pubKey);

$data = 'plaintext data goes here';

// Encrypt the data to $encrypted using the public key
openssl_public_encrypt($data, $encrypted, file_get_contents('test3_publickey.pem'),OPENSSL_PKCS1_PADDING);

// Decrypt the data using the private key and store the results in $decrypted
openssl_private_decrypt($encrypted, $decrypted, file_get_contents('test3_privatekey.pem'),OPENSSL_PKCS1_PADDING);

echo $decrypted;


//openssl_private_decrypt($encrypted, $decrypted, file_get_contents('test3_privatekey.pem'),OPENSSL_PKCS1_PADDING);
?>