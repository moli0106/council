<?php
$requestedData = array(
    "karmadisha" => array(
        array(
            "engagementid" => rand(1000000000, 9999999999),
            "firstname" => "Birendra",
            "middlename" => "Singh",
            "lastname" => "Rajput",
            "qualification" => "22",
            "pincode" => rand(100000, 999999),
            "district" => "11",
            "dob" => "2000-04-13",
            "gender" => "1",
            "mailid" => "mail2mr.biren@gmail.com",
            "mobilenumber" => "8093855687",
            "hollandcode" => "BSR"
        )
    )
);

// $curl = curl_init('https://164.100.228.244/api_server/council_assessment/Batch_assessment_response_PBSSD/test_add_user');
$curl = curl_init('https://164.100.228.244/api_server/kd/trainee/result');
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
