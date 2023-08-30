<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Login extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		//redirect("https://www.pbssd.gov.in/council/admin/maintenance");
	}

	public function index() {
		// echo "hiii";exit;
		if($this->input->method(TRUE) == 'GET'){
			$_SESSION['salt'] = hash('sha256',microtime());
		}
		
		parent::check_public();
		
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
				'field' => 'password',
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
			$_SESSION['salt'] = hash('sha256',microtime());
			$this->load->view($this->config->item('theme') . 'login_view',$data);
		} else {
			$this->load->model('login_model');
			
			$login_result = $this->login_model->check_user($this->input->post('login_id')/*,$this->input->post('password')*/);
			if(hash('sha256',($login_result[0]['login_password'].$_SESSION['salt'])) == $this->input->post('password')){
				$this->session->set_userdata($login_result[0]);
				unset($_SESSION['salt']);
				//$this->output->enable_profiler(TRUE);
				//die;
				redirect('admin/dashboard', 'location');
			} else {
				$_SESSION['salt'] = hash('sha256',microtime());
				$data['error_message'] = '<p class="text-danger text-center">Incorrect login credentials</p>';
				$this->load->view($this->config->item('theme') . 'login_view',$data);
			}
		
		}
	}
	
	//logout
	public function logout(){

		
		
		//Page visit log
		$this->load->model('common/page_visit_model');
		$this->page_visit_model->set();

		// Add by Moli on 06-02-2023
		$stake_id = $this->session->userdata('stake_id_fk');
		// if($stake_id == 29){
		// 	$login_id = $this->session->login_id;
		// 	$this->load->model('login_model');

		// 	$updateArray = array(
					
		// 		'login_password'       => NULL,
		// 		'base_password'        => NULL,
		// 	);
		// 	$status = $this->login_model->updateStdCredentials('council_stake_holder_login',$updateArray,$login_id);
		// }
		
		$this->session->sess_destroy();
		if($stake_id == 29){

			//redirect('admin/student_login', 'location');
			redirect('admin', 'location');
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
	
}
