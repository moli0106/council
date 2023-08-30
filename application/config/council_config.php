<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Theme location
|--------------------------------------------------------------------------
|
*/
$config['theme'] = 'themes/council_theme/';
$config['theme_uri'] = 'themes/council_theme/';

/*
 |--------------------------------------------------------------------------
 | Default website title
 |--------------------------------------------------------------------------
 |
 */

$config['title'] = 'West Bengal State Council of Technical and Vocational Education Division and Skill Development'; 

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

$config['privilege_store_time'] = 60*60*24;
$config['dashboard_time'] = 60*60;

// Added by Moli
$config['previous_academic_year'] =  date('Y', strtotime(date('Y') . "- 1 year")) . '-' . date('y');

$month = date('m');

if($month >= '07'){

    $config['current_academic_year'] = date('Y') . '-' . date('y', strtotime(date('Y') . "+ 1 year"));
}else{
    $config['current_academic_year'] = $config['previous_academic_year'];
}