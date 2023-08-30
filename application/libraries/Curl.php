<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Curl
{
	public function __construct()
	{
		$this->obj = &get_instance();
	}

	public function curl_make_post_request($url = NULL, $post_data = NULL)
	{
		if ($url != NULL && $post_data != NULL) {

			// $curl = curl_init($url);
			$curl = curl_init();
			$data = http_build_query($post_data);

			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_SSL_VERIFYPEER => false
			));

			/* curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'Content-Type:application/x-www-form-urlencoded',
			));

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  */

			$result    = curl_exec($curl);
			$curl_info = curl_getinfo($curl);

			if ($curl_info['http_code'] == 200) {

				return $result;
			} else {

				return false;
			}

			curl_close($curl);
		} else {

			return false;
		}
	}
}
