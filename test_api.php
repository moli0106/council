<?php
$requestedData = array(
    'user_name'   => "Birendra Singh",
    'user_mobile' => "8093855687",
    'user_email'  => "birendra.singh.5070276@gmail.com",
);

$curl = curl_init('https://164.100.228.244/api_server/council_assessment/Batch_assessment_response_PBSSD/test_add_user');
$data = http_build_query($requestedData);

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type:application/x-www-form-urlencoded',
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);


$result     = curl_exec($curl);
$curl_info  = curl_getinfo($curl);
$curl_error = curl_error($curl);

curl_close($curl);

echo '<pre><h2>' . $curl_error . '</h2>';
echo json_encode(array('result' => json_decode($result), 'curl_info' => $curl_info, 'curl_error' => $curl_error));
