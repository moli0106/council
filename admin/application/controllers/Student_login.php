<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Student_login extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		//redirect("https://www.pbssd.gov.in/council/admin/maintenance");
		$this->load->model("login_model");
		$this->load->library('sms');
	}
	
	public function index_maintanance(){
		$data['data'] ='';
		$this->load->view($this->config->item('theme').'maintaince_view',$data);
	}

	public function index($login_id =NULL, $base_password = NULL) {
		
		// echo "hiii";
        // echo($login_id);exit;
		if($this->input->method(TRUE) == 'GET'){
			$_SESSION['salt'] = hash('sha256',microtime());
		}
		
		parent::check_public();

		// var_dump($_SESSION);
		$data['stdLoginId']         = $login_id;
		$data['stdLoginpsw']         = $base_password;
		
		
		//captcha
		$this->load->helper('captcha');
		$vals = array(
	        //'word'          => 'AbCd',
	        'img_path'      => './captcha/',
	        'img_url'       => 'captcha/',
	        //'font_path'     => './captcha4.ttf',
	        'img_width'     => '120',
	        'img_height'    => 38,
	        'expiration'    => 7200,
	        'word_length'   => 5,
	        'font_size'     => 16,
	        //'img_id'        => 'Imageid',
	        //'pool'          => '23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPRSTUVWXYZ',
	        'pool'          => '23456789abcdefghjkmnpqrstuvwxyz',
	
	        // White background and border, black text and red grid
	        'colors'        => array(
	                'background' => array(255, 255, 255),
	                'border' => array(200, 200, 200),
	                'text' => array(100, 100, 100),
	                'grid' => array(200, 200, 200)
	        )
		);
		$data['cap'] = create_captcha($vals);

		//validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$config = array(
			array(
				'field' => 'login_id',
				'label' => 'Username',
				'rules' => 'trim|required|max_length[50]'
			),
			array(
				'field' => 'psw',
				'label' => 'Password',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'captcha',
				'label' => 'Captcha',
				'rules' => 'required|callback_username_check['.$this->input->post('security_code').']'
			)
		);
	
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == FALSE) {
			//echo "hii";exit;
			$_SESSION['salt'] = hash('sha256',microtime());
			$this->load->view($this->config->item('theme') . 'student_login_view',$data);
		} else {
			//echo "else";exit;
			$this->load->model('login_model');
			
			$login_result = $this->login_model->check_user($this->input->post('login_id')/*,$this->input->post('password')*/);
			
			if(hash('sha256',($login_result[0]['login_password'].$_SESSION['salt'])) == $this->input->post('psw')){
				
				$this->session->set_userdata($login_result[0]);
				unset($_SESSION['salt']);
				//$this->output->enable_profiler(TRUE);
				//die;
				
				redirect('admin/dashboard', 'location');
			} else {
				
				$_SESSION['salt'] = hash('sha256',microtime());
				$data['error_message'] = '<p class="text-danger text-center">Incorrect login credentials</p>';
				$this->load->view($this->config->item('theme') . 'student_login_view',$data);
			}
		
		}
		
		//$this->load->view($this->config->item('theme') . 'student_login_view',$data);
		
	}
	
	//logout
	public function logout(){
		
		
		//Page visit log
		$this->load->model('common/page_visit_model');
		$this->page_visit_model->set();

		// Add by Moli on 06-02-2023
		$stake_id = $this->session->userdata('stake_id_fk');
		if($stake_id == 29){
			$login_id = $this->session->login_id;
			$this->load->model('login_model');

			$updateArray = array(
					
				'login_password'       => NULL,
				'base_password'        => NULL,
			);
			$status = $this->login_model->updateStdCredentials('council_stake_holder_login',$updateArray,$login_id);
		}
		
		$this->session->sess_destroy();
		if($stake_id == 29){

			redirect('admin/student_login', 'location');
		}else{

			redirect('admin', 'location');
		}
	}
	
	//custom validation for captcha
	public function username_check($captcha,$security_code){
		if($captcha != ""){
			if(hash('sha256',strtoupper($captcha).$this->config->item('encryption_key')) == $security_code){
				 return TRUE;
			} else {
				$this->form_validation->set_message('username_check', 'The {field} is incorrect');
	            return FALSE;
			}
		}
	}

	function load_captcha()
	{
		$this->load->helper('captcha');
		$vals = array(
			//'word'          => 'AbCd',
			'img_path'      => './captcha/',
			'img_url'       => 'captcha/',
			'font_path'     => './captcha4.ttf',
			'img_width'     => '120',
			'img_height'    => 38,
			'expiration'    => 7200,
			'word_length'   => 5,
			'font_size'     => 16,
			//'img_id'        => 'Imageid',
			//'pool'          => '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ',
			'pool'          => '123456789abcdefghjkmnpqrstuvwxyz',
	
			// White background and border, black text and red grid
			'colors'        => array(
					'background' => array(255, 255, 255),
					'border' => array(200, 200, 200),
					'text' => array(100, 100, 100),
					'grid' => array(200, 200, 200)
			)
		);
		$cap = create_captcha($vals);
		$captcha_word = hash('sha256',strtoupper($cap['word']).$this->config->item('encryption_key'));
		$captcha = array('image'=>$cap['image'],'word'=>$captcha_word);
		echo json_encode($captcha);

	}
	public function getDetailsByAdharNum($adharNum = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
			//$studentDetailsData = $this->login_model->getDetailsByAdharNum($adharNum);
			$studentDetailsData = $this->login_model->get_mobile_no($adharNum);
			//echo "<pre>";print_r($studentDetailsData);exit;
		
			if (!empty($studentDetailsData)) {

				$response_data = array(

				//'mobile_number' => $studentDetailsData['mobile_number'],
				'mobile_number' => $studentDetailsData['mobile_no'],

				);
				echo json_encode($response_data);
			}
            
            
        }
    }

	public function setOneTimePassword(){
		
		if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            
			$std_aadhar_no = $this->input->get('std_aadhar_no');
			$mob_no = $this->input->get('mob_no');

			if (!empty($std_aadhar_no) && !empty($mob_no)) {

				$mobile_otp = rand(100000, 999999);

                $get_mobile_no = $this->login_model->get_mobile_no($std_aadhar_no);
					//echo $get_mobile_no['mobile_no'];exit;
				$updateArray = array(
					
					'login_password'       => hash("sha256", $mobile_otp),
					'activation_date'      => 'now()',
					'active_status'        => 1,
					'entry_time'           => 'now()',
					'entry_ip'             => $this->input->ip_address(),
					'base_password'        => $mobile_otp,
				);
				$status = $this->login_model->updateStdCredentials('council_stake_holder_login',$updateArray,$std_aadhar_no);
				
				$sms_message = "You have applied for registration in Polytechnics under WBSCT&VE&SD. Your OTP is " . $mobile_otp;
				$template_id = 0; //1707167567490402333
				$this->sms->send($get_mobile_no['mobile_no'], $sms_message, $template_id);
				echo json_encode('done');
			}
            
            
        }
	}

	
}
