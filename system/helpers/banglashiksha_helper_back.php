<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	// echo "hii";exit;

	if (!function_exists('gettingStudentDetailsByBanglaShikshaCode')) {
		
		function gettingStudentDetailsByBanglaShikshaCode($std_code){
			// echo $std_code;exit;
			if($std_code != NULL){
			
				$curl = curl_init();

				$header = array(
					'x-api-key: WEewewTJHFDMFBDJFNJDFHjh269sm',
					'Authorization: Basic dmNfYWRtaW46dmMxMjM0NQ==',
					'Content-Type: application/x-www-form-urlencoded' 
				);
				$std_code = '06604719002823';
				
				curl_setopt_array($curl, array(
				  CURLOPT_URL => 'https://banglarshiksha.gov.in/api_bs/getStudent',
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => '',
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => 'POST',
				  CURLOPT_POSTFIELDS => 'StudentCode='.$std_code.'&Src=VTC',
				  CURLOPT_HTTPHEADER => $header,
				));
				
				$response = curl_exec($curl);
				// echo"<pre>"; print_r($response); die;
				curl_close($curl);
				$data_res = json_decode($response, true);

				if(!empty($data_res)){

					return $data_res['student_details'];
				}else{
					return array();
				}
				// echo"<pre>"; print_r($data_res['student_details']); die;
			}
		}
	}

	// Get District ID
	if(!function_exists('gettingDistrictId')){
		function gettingDistrictId($district_code){
			//echo $district_code;exit;
			
			if($district_code != NULL){

				$CI =& get_instance();

				$CI->load->model('common/banglashiksha_api_model');
				$district = $CI->banglashiksha_api_model->getDistrictIdByCode($district_code);
				// echo "<pre>";print_r($district);exit;s
				if(!empty($district)){
					return $district['district_id_pk'];
				}else{
					return '';
				}
			}
		}
	}

	//----------- Get Block ID ---------------//

	if(!function_exists('gettingBlockId')){
		function gettingBlockId($block_code){
			
			if($block_code != NULL){

				$CI =& get_instance();

				$CI->load->model('common/banglashiksha_api_model');
				$data = $CI->banglashiksha_api_model->getBlockIdByCode($block_code);
				
				if(!empty($data)){
					return $data;
				}else{
					return '';
				}
			}
		}
	}

	// ----------- Get Caste ID -------------//
	
	if(!function_exists('gettingCasteId')){
		function gettingCasteId($caste_code){
			
			if($caste_code != NULL){

				$CI =& get_instance();

				$CI->load->model('common/banglashiksha_api_model');
				$caste = $CI->banglashiksha_api_model->getCasteIdByCode($caste_code);
				
				if(!empty($caste)){
					return $caste['caste_id_pk'];
				}else{
					return '';
				}
			}
		}
	}

	if(!function_exists('gettingReligionId')){
		function gettingReligionId($religion_code){

			if($religion_code != NULL){

				$CI =& get_instance();

				$CI->load->model('common/banglashiksha_api_model');
				$religion = $CI->banglashiksha_api_model->getReligionIdByCode($religion_code);
				
				if(!empty($religion)){
					return $religion['religion_id_pk'];
				}else{
					return '';
				}
			}
		}
	}

	if(!function_exists('gettingGender')){
		function gettingGender($gender_code){

			if($gender_code != NULL){

				$CI =& get_instance();

				$CI->load->model('common/banglashiksha_api_model');
				$gender = $CI->banglashiksha_api_model->getGenderIdByCode($gender_code);
				
				if(!empty($gender)){
					return $gender['gender_id_pk'];
				}else{
					return '';
				}
			}
		}
	}

	


?>