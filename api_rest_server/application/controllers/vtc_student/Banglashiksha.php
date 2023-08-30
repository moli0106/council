<?php defined('BASEPATH') or exit('No direct script access allowed');

class Banglashiksha extends NIC_Controller
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		$this->load->library(array('form_validation'));

		$this->load->model('vtc_student/banglashiksha_model');
	}

    public function gettingStudentDetailsByBanglaShikshaCode_post(){
        // echo "hii";exit;
        // echo "<pre>";print_r($_POST);
        $std_code = $_POST['std_code'];
        if($std_code != NULL){
        
            $curl = curl_init();

            $header = array(
                'x-api-key: WEewewTJHFDMFBDJFNJDFHjh269sm',
                'Authorization: Basic dmNfYWRtaW46dmMxMjM0NQ==',
                'Content-Type: application/x-www-form-urlencoded' 
            );
            // $std_code = '06604719002823';
            
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
            // echo"<pressssssss>"; print_r($response); die;
            curl_close($curl);

            $test_res = '{"success":"success","student_details":{"TransactionId": 11,"StudentName":"SUBHA SDSFSDF hjgjhfg DAS","FatherName":"TAPAS DAS","GuardianName":"TAPAS DAS","StuGuardianRelationshipCode":"1","NationalityCode":"1","AadhaarNumber":"800788333281","StuMobile":"9062123500","StuEmail":null,"StuContactAddress":"","StuContactHabitation":"KANCHIARA","StuContactStateCode":"19","StuContactDistrict":"1911","StuContactBlock":"191101","StuContactPin":"743711","SocialCategoryCode":"1","ReligionCode":"0","CwsnYesNoCode":null,"StuDob":"2006-07-18","GenderCode":"1","YearOfPassing":"2021","ClassXMarks":"201","LastAcademicExamPassed":"10"}}';
            $data_res = json_decode($response, true);
            // $data_res = json_decode($test_res, true);
            
            if(!empty($data_res['student_details'])){

                $transactionId = $data_res['student_details']['TransactionId'];
                $validation_result = $this->check_validation($data_res['student_details']);
                // echo"<pre>"; print_r($validation_result); die;
                if(empty($validation_result)){

                    // ***-------- Send Acknowledge Response In Bangla Shiksha Portal ---------***//
                    $wsStatus = 'success';
                    $this->sendAcknowledgeResponse_post($transactionId ,$wsStatus);

                    // $this->response($data_res['student_details'], REST_Controller::HTTP_OK);
                    $this->response($data_res, REST_Controller::HTTP_OK);

                    

                }else{

                    // ***-------- Send Acknowledge Response In Bangla Shiksha Portal ---------***//
                    $wsStatus = 'failure';
                    $this->sendAcknowledgeResponse_post($transactionId ,$wsStatus);
                }
            }else{

                // ***-------- Send Acknowledge Response In Bangla Shiksha Portal ---------***//
                $wsStatus = 'failure';
                $this->sendAcknowledgeResponse_post($transactionId ,$wsStatus);
            }
        }
    }


    // *** -------- Validation Check ----------- *** //

    public function check_validation($requestData){

        // echo"<pressssssss>"; print_r($requestData); die;

        // Create an array to store validation errors.
		$emptyArray = array();

		// Set delimiters to validation errors.
		$this->form_validation->set_error_delimiters('', '|');

        // Set post data for validation
		$this->form_validation->set_data($requestData);

        $config = array(
            array(
                'field' => 'TransactionId',
                'label' => 'Transaction Id',
                'rules' => 'trim|required',
                
            ),
            array(
                'field' => 'StudentName',
                'label' => 'Student Name',
                'rules' => 'trim|required',
                
            ),
            array(
                'field' => 'FatherName',
                'label' => 'Father Name',
                'rules' => 'trim|required',
                
            ),
            array(
                'field' => 'StuContactStateCode',
                'label' => 'State',
                'rules' => 'trim|required',
                
            ),
            array(
                'field' => 'StuContactDistrict',
                'label' => 'District',
                'rules' => 'trim|required',
                
            ),
            // array(
            //     'field' => 'StuPhotos',
            //     'label' => 'Image',
            //     'rules' => 'trim|required',
                
            // ),
            array(
                'field' => 'SocialCategoryCode',
                'label' => 'Social Category',
                'rules' => 'trim|required',
                
            ),
            array(
                'field' => 'StuDob',
                'label' => 'Date of birth',
                'rules' => 'trim|required',
                
            ),
            array(
                'field' => 'GenderCode',
                'label' => 'Gender',
                'rules' => 'trim|required',
                
            ),
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

            $emptyArrayTmp = explode('|', validation_errors());
			array_pop($emptyArrayTmp);

			foreach ($emptyArrayTmp as $key => $value) {
				array_push($emptyArray, array('reason' => $value));
			}
            
            return $emptyArray;
        }else{
            return $emptyArray;
        }
    }

    
    // ***---------Success / Failure -----*** //
    // ***-------- Send Acknowledge Response In Bangla Shiksha Portal ---------***//

    public function sendAcknowledgeResponse_post($transactionId ,$wsStatus){
        
        // echo $transactionId;exit;
        if($transactionId !=''){

            $curl = curl_init();

            $header = array(
                'x-api-key: WEewewTJHFDMFBDJFNJDFHjh269sm',
                'Authorization: Basic dmNfYWRtaW46dmMxMjM0NQ==',
                'Content-Type: application/x-www-form-urlencoded' 
            );
            // $std_code = '06604719002823';
            
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://banglarshiksha.gov.in/api_bs/resAcknowledge',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => 'TransactionId='.$transactionId.'&wsStatus='.$wsStatus,
              CURLOPT_HTTPHEADER => $header,
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            return true;
        }

    }

}