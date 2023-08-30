<?php
//  $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://www.pbssd.gov.in/api_server/council_assessment/batch_assessment_response_PBSSD/assessment_response_data',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => array('enc_data' => 'NgfYeYxS2xIm2c6AvDQ/s5BZczDo7dJCv91oN+3w03ggjPa2U1Ljz345Ebu0A94px/SyDWytWFU+4DQ8MvVAkVgAvxxBeb9+Ty8gZleojVMfEZ8kkS947O+N8jD7qZ+dAkvXlOOvauHBYRzUJw5mp/5xpfLpQywLVfhcsGKpGv4='),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;

$json='{
    "verticalId": "PBSSD",
    "responseMsg": {
        "type": "SUCCESSS",
        "code": "SM7",
        "msgDetails": "Certificate Generated"
    },
    "data": {
        "verticalName": "Paschim Banga Society for Skill Development (PBSSD)",
        "assessmentSchemeName": "Utkarsh Bangla - Short Term Training (STT)",
        "assessmentSchemeId": "1",
        "councilBatchDetails": {
            "userBatchId": "PJ-4\/14299\/2022\/DAK\/BWS\/Q0101-SE\/000001",
            "councilBatchId": "18224",
            "councilBatchStatus": "Certificate Generated",
            "candidates": [
                {
                    "traineeId": "WB23DA038741",
                    "councilTraineeId": "TR_0000438435",
                    "traineeName": "SAGORI NANDI",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/072a2906b7c01d3790899c84a69a243b\/2671a578e12332c10952ccea2148befd",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038894",
                    "councilTraineeId": "TR_0000438432",
                    "traineeName": "PRIYANKA RAY",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/6fc1d91bf3279bd83510525c4a5022cb\/8b3b7fed0d02c588ba634406577618d9",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038566",
                    "councilTraineeId": "TR_0000438417",
                    "traineeName": "BRISHTI SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/e29d5ccdc5b54a7c7964b1219e7c275f\/1f735977fffc80fbd0a73fe72ef3a936",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038564",
                    "councilTraineeId": "TR_0000438431",
                    "traineeName": "PAYEL SAHA",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/218dfc785ce5a3a1da00f1d479321939\/d59370a948c0dadbe43944e3f005fcb8",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038899",
                    "councilTraineeId": "TR_0000438418",
                    "traineeName": "BULBULI SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/81f5ebaeea959090f6abfccf552bf664\/f3afa820a7f59d3bb1130554f748f4a1",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038581",
                    "councilTraineeId": "TR_0000438420",
                    "traineeName": "DRAPADI SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/10311a73163b86c7ad1d8bfed4674d25\/11bce9d70260f2c5f88ca0d76ce40321",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA039044",
                    "councilTraineeId": "TR_0000438425",
                    "traineeName": "KAKALI BISWAS SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/1eb69a862d8a9eb3227e8a25756d8c90\/285f12c12e72472ee7edb46ac2416c68",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038900",
                    "councilTraineeId": "TR_0000438426",
                    "traineeName": "LATA ROY",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/6caf269c7e5c23c815ce2a302b6be8d3\/fd0be414f8c1e0b3c759a80fc9c759bd",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA039017",
                    "councilTraineeId": "TR_0000438427",
                    "traineeName": "LATIKA ROY",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/e579fbb4b1635628b88c9a821a8095d2\/4550a26563e10c9c255ddb2692b792ef",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038571",
                    "councilTraineeId": "TR_0000438429",
                    "traineeName": "LIPI SAHA SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/838d3a8196061ec6747b30617f46f93a\/da97140e29c2e0148cf3058fd0c05796",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA039018",
                    "councilTraineeId": "TR_0000438430",
                    "traineeName": "MANMOHINI SARKAR SAHA",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/114fb00dcf610a8b1069232e9b061961\/0f1928ae155330b61568705012523a3e",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038895",
                    "councilTraineeId": "TR_0000438424",
                    "traineeName": "JHUNU SIKDAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/3c7f68fb0865f16b2e116821735b93ec\/01bd243ef9bb52f382cfe1dd922fe24d",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038735",
                    "councilTraineeId": "TR_0000438428",
                    "traineeName": "LAXMI BHUIMALI",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/329082af0c57070771fa11e43461ad81\/f894bd6faafc85bb71d4695ef0bb1be6",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038525",
                    "councilTraineeId": "TR_0000438415",
                    "traineeName": "BABITA SHIL",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/7be6bf94e3e3b459198c6a4814872e30\/194d4271cc1d61ffa66d96aed47fee94",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038746",
                    "councilTraineeId": "TR_0000438419",
                    "traineeName": "DEBOKI DAS",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/372f177e0911a9c03956ffaeb3291b20\/44bbb03e4ab558b7a899efff5e31c5c6",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038744",
                    "councilTraineeId": "TR_0000438421",
                    "traineeName": "FARIDA PARVIN",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/f83fad535a4fef953fc7702200f35555\/9baf94c811d3c79f84b3f0082ef10b0e",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038583",
                    "councilTraineeId": "TR_0000438422",
                    "traineeName": "ITI PAUL",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/400dc8c208687f21dfd292ce1da79bdb\/a78b291973e1d30065a39091f2fd07fd",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038890",
                    "councilTraineeId": "TR_0000438443",
                    "traineeName": "YASMIN KHATUN",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/9e4467449d17a9a587eae77440b67c07\/653ddc6375b55a24fc2afd00cacf79bf",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA036785",
                    "councilTraineeId": "TR_0000438442",
                    "traineeName": "TUMPA ROY",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/21edb0ba5590d6e873389be2c0b22dba\/9aeac87e097baaeb74e901e43be88850",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038749",
                    "councilTraineeId": "TR_0000438441",
                    "traineeName": "TULI MONDAL",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/372cddf10fde05f830ae09bb5d6137af\/bc42b2323d1b8780fa7a2a2f64dfe463",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038576",
                    "councilTraineeId": "TR_0000438440",
                    "traineeName": "TITHI PAUL",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/6465c1e3b2f9143ba819589f2b925318\/d5ad60c3ce01e23796b1f2a6da4ce23a",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038517",
                    "councilTraineeId": "TR_0000438434",
                    "traineeName": "RAHITA SAHA",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/8f2d686fd8c925fe56162b188cbd4a80\/7b679f446b9daf7101e93bdd10b653b2",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038578",
                    "councilTraineeId": "TR_0000438439",
                    "traineeName": "SUMITRA HALDAR SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/156b7a283669fc3a4bd7fe8a105e478b\/5d0ae382c910c7a5b652ea29e0a92622",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038897",
                    "councilTraineeId": "TR_0000438438",
                    "traineeName": "SHEULI DAS",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/42e3c6b52ea1d1aae22511fc8e468cfa\/b876abf63d207b4897951d99df9ecf1b",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038902",
                    "councilTraineeId": "TR_0000438437",
                    "traineeName": "SANTOSHI ROY KUMAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/d8ab02a8871f8580e48def2c558a5bc1\/a296c53ac2bb1860a8979895e3629317",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA039042",
                    "councilTraineeId": "TR_0000438416",
                    "traineeName": "BITHHIKA SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/da79bba363e6aed5d3a98dbff56fbf77\/ab024f17819eb69e253d86b16b3b4e09",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038573",
                    "councilTraineeId": "TR_0000438423",
                    "traineeName": "JHUMKI SARKAR",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/9e9b807422afd02b2f973c2a05eed0ae\/086050064ffa691481389145da0f5c35",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                },
                {
                    "traineeId": "WB23DA038889",
                    "councilTraineeId": "TR_0000438433",
                    "traineeName": "PUJA BISWAS",
                    "certificateLocation": "https:\/\/sctvesd.wb.gov.in\/admin\/assessment\/download\/certificate\/4f5f428c320725da8dccd7dd2fcf98d7\/ca140fe97fd9e7e8f9d7e57a9c15d8be\/8491de8dae05219f335f8f0e73a13be0",
                    "certificateKey": null,
                    "certificateGeneratedDate": "10-07-2023 13:31:40"
                }
            ]
        }
    }
}
';

//$requestedData=json_decode($json,true);

$requestedData = array(
    'user_name'   => "Birendra Singh",
    'user_mobile' => "8093855687",
    'user_email'  => "atreyee.sanyal18@gmail.com",
);


$curl = curl_init('https://164.100.228.244/api_server/council_assessment/batch_assessment_response_PBSSD/assessment_response_data');
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
print_r($result);

//echo json_encode(array('result' => json_decode($result), 'curl_info' => $curl_info, 'curl_error' => $curl_error));
//$decode_result=json_decode($result,true);
//print_r($decode_result['responseMsg']['code']);

