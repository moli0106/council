<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Theme location
|--------------------------------------------------------------------------
|
*/
$config['theme'] = 'themes/adminlte/';
$config['theme_uri'] = 'themes/adminlte/';

/*
 |--------------------------------------------------------------------------
 | Default website title
 |--------------------------------------------------------------------------
 |
 */

$config['title'] = 'Department of Technical Education Training and Skill Development';

/*
 |--------------------------------------------------------------------------
 | Upload locations
 |--------------------------------------------------------------------------
 |
 */

$config['notice'] = 'files/public/notice/';

/*
 |--------------------------------------------------------------------------
 | Cache times
 |--------------------------------------------------------------------------
 |
 */

$config['privilege_store_time'] = 60 * 60 * 24;
$config['dashboard_time'] = 60 * 60;

/*
 |--------------------------------------------------------------------------
 | OpenSSl Encryption method
 |--------------------------------------------------------------------------
 |
 */

$config['ciphering'] = "AES-128-CTR";    // Store the cipher method
$config['options'] = 0;
$config['encryption_iv'] = '3465567883013921';    // Non-NULL Initialization Vector for encryption
$config['encryption_key'] = "W@#a*yDf&t%Lg";    // Store the encryption key

/*
--------------------------------------------------------------------------
                    Default Config Variables
--------------------------------------------------------------------------
*/

$config['empanelled_assessor_validity'] = 2; // ! 2 years validity for empanelled assessor validity
$config['assessor_exam_duration'] = 2; // ! 2 hours for assessor exam duration

$config['assessment_remuneration_rate'] = 150;
$config['assessment_remuneration_max_rate'] = 4000;

// $config['academic_year'] = date('Y') . '-' . date('y', strtotime(date('Y') . "+ 1 year"));
$config['academic_year'] = '2021-22';

$config['previous_academic_year'] =  date('Y', strtotime(date('Y') . "- 1 year")) . '-' . date('y');

$month = date('m');

if($month >= '09'){

    $config['current_academic_year'] = date('Y') . '-' . date('y', strtotime(date('Y') . "+ 1 year"));
}else{
    $config['current_academic_year'] = $config['previous_academic_year'];
}
// echo $month = date('m', strtotime(date('M') . "- 1"));exit;
// echo "<pre>";print_r($config['current_academic_year']);exit;


// Public And Private Key For VTC STUDENT REGISRATION's SBI Payment 




