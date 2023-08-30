<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_question_jexpo_voclet extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(42);
		$this->load->model('question/add_question_jexpo_model');
		$this->load->helper('code');
		//$this->load->helper('security');
		//$this->load->library('encryption');
		//$this->output->enable_profiler();
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
		);
		$this->js_foot = array(
			//1 => $this->config->item('theme_uri').'assets/js/jquery-3.3.1.min.js',
			2 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			1 => $this->config->item('theme_uri')."question/add_question_jexpo_voclet.js",
		);
	}
	public function index()
	{
		// Use OpenSSl Encryption method
		// $ciphering = "AES-128-CTR"; // Store the cipher method
		// $options = 0;
		// $encryption_iv = '3465567883013921'; // Non-NULL Initialization Vector for encryption
		// $encryption_key = "W@#a*ydf&trfg"; // Store the encryption key

		$stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
		$data['exam_type_list'] = $this->add_question_jexpo_model->getAllExamType($stake_details_id_fk);
		$data['levels'] = $this->add_question_jexpo_model->get_levels_query();
		$data['question_option_patterns'] = $this->add_question_jexpo_model->get_question_pattern_query();
		//$data[]=array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('exam_type', '<b>Exam Type</b>', 'trim|required');
		$this->form_validation->set_rules('subject_id', '<b>Subject</b>', 'trim|required');
		$this->form_validation->set_rules('level_id', '<b>Level</b>', 'trim|required');
		$this->form_validation->set_rules('question', '<b>Question</b>', 'trim|required|callback_question_eng_duplicate_check');
		if($this->input->post('option_pattern')==1){
			$this->form_validation->set_rules('optionA', '<b>Option A</b>', 'trim|required');
			$this->form_validation->set_rules('optionB', '<b>Option B</b>', 'trim|required');
			$this->form_validation->set_rules('optionC', '<b>Option C</b>', 'trim|required');
			$this->form_validation->set_rules('optionD', '<b>Option D</b>', 'trim|required');
		}
		$this->form_validation->set_rules('correctAns', '<b>Correct Answer</b>', 'trim|required');
		$this->form_validation->set_rules('question_pattern', '<b>question pattern</b>', 'trim|required');
		$this->form_validation->set_rules('option_pattern', '<b>option pattern</b>', 'trim|required');
		
		if($this->input->post('question_pattern')==2){
			$this->form_validation->set_rules('question_pic', '<b>Pictorial question</b>', 'trim|callback_file_validation[question_pic|image/jpeg|50|required]');
		}
		if($this->input->post('option_pattern')==2){
			$this->form_validation->set_rules('optionA_pic', '<b>Pictorial option A</b>', 'trim|callback_file_validation[optionA_pic|image/jpeg|50|required]');
			$this->form_validation->set_rules('optionB_pic', '<b>Pictorial option B</b>', 'trim|callback_file_validation[optionB_pic|image/jpeg|50|required]');
			$this->form_validation->set_rules('optionC_pic', '<b>Pictorial option C</b>', 'trim|callback_file_validation[optionC_pic|image/jpeg|50|required]');
			$this->form_validation->set_rules('optionD_pic', '<b>Pictorial option D</b>', 'trim|callback_file_validation[optionD_pic|image/jpeg|50|required]');
		}

		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
		if ($this->form_validation->run() == FALSE) {
			$data['exam_type_list'] = $this->add_question_jexpo_model->getAllExamType($stake_details_id_fk);
			if(set_value('exam_type') != NULL){
					
				//$data['courses'] = $this->add_question_jexpo_model->get_course_query(set_value('sector_id'));
				$data['subjects'] = $this->add_question_jexpo_model->get_subject_query(set_value('exam_type'),$stake_details_id_fk);
			}
			$this->load->view($this->config->item('theme').'question/add_question_jexpo_view',$data);
		} else {
		
		$exam_type 			= $this->input->post('exam_type');
		$subject_id 		= $this->input->post('subject_id');
		$level_id 			= $this->input->post('level_id');
		$question 			= openssl_encrypt($this->input->post('question'), $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
		

		$question_pattern 	= $this->input->post('question_pattern');
		$option_pattern 	= $this->input->post('option_pattern');
		if($this->input->post('option_pattern')==1){
			$optionA 			= openssl_encrypt($this->input->post('optionA'), $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
			$optionB 			= openssl_encrypt($this->input->post('optionB'), $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
			$optionC 			= openssl_encrypt($this->input->post('optionC'), $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
			$optionD 			= openssl_encrypt($this->input->post('optionD'), $this->config->item('ciphering'), $this->config->item('encryption_key'), $this->config->item('options'), $this->config->item('encryption_iv'));
		}else{
			$optionA 			='';
			$optionB 			='';
			$optionC 			='';
			$optionD 			='';
		}

		$correctAns 		= $this->input->post('correctAns');

		if($this->input->post('question_pattern')==2){
			$question_pic  		= base64_encode(file_get_contents($_FILES["question_pic"]['tmp_name']));
		}else{
			$question_pic		='';
		}
		if($this->input->post('option_pattern')==2){
			$optionA_pic  		= base64_encode(file_get_contents($_FILES["optionA_pic"]['tmp_name']));
			$optionB_pic  		= base64_encode(file_get_contents($_FILES["optionB_pic"]['tmp_name']));
			$optionC_pic  		= base64_encode(file_get_contents($_FILES["optionC_pic"]['tmp_name']));
			$optionD_pic  		= base64_encode(file_get_contents($_FILES["optionD_pic"]['tmp_name']));
		}else{
			$optionA_pic		= '';
			$optionB_pic		= '';
			$optionC_pic		= '';
			$optionD_pic		= '';
		}	
		
		$question_master_data=array(
			'exam_type_id_fk' 		=> $exam_type,
			'subject_id_fk' 		=> $subject_id,
			'level_id' 				=> $level_id,
			'question_pattern' 		=> $question_pattern,
			'option_pattern' 		=> $option_pattern,
			'active_status' 		=> 1,
			'process_status_id_fk' 	=> 0,
			'entry_time' 			=> date('Y-m-d H:i:s'),
			'entry_ip' 				=> $this->input->ip_address(),
			'entry_by' 				=> $this->session->stake_holder_login_id_pk,
			
		   );
		   $insert_id = $this->add_question_jexpo_model->question_submit($question_master_data);
		   $question_data=array(
			'question_id_fk' 		=>$insert_id ,
			'question' 				=>$question ,
			'option1' 				=>$optionA ,
			'option2' 				=>$optionB,
			'option3' 				=>$optionC,
			'option4' 				=>$optionD,
			'right_answer' 			=>$correctAns ,
			'entry_time' 			=> date('Y-m-d H:i:s'),
			'entry_ip' 				=> $this->input->ip_address(),
			'entry_by' 				=> $this->session->stake_holder_login_id_pk,
			'active_status' 		=> 1,
			'process_status_id_fk' 	=> 0,
			'question_pic' 			=>$question_pic ,
			'option1_pic' 			=>$optionA_pic ,
			'option2_pic' 			=>$optionB_pic,
			'option3_pic' 			=>$optionC_pic,
			'option4_pic' 			=>$optionD_pic,
			
		   );

	$insert_question = $this->add_question_jexpo_model->question_language_submit($question_data);
		
		if($insert_question == TRUE)
		{
			$data['exam_type_list'] = $this->add_question_jexpo_model->getAllExamType($stake_details_id_fk);
			if(set_value('exam_type') != NULL){	
				//$data['courses'] = $this->add_question_jexpo_model->get_course_query(set_value('sector_id'));
				$data['subjects'] = $this->add_question_jexpo_model->get_subject_query(set_value('exam_type'),$stake_details_id_fk);
			}
			//$data['programmes'] = $this->add_question_jexpo_model->get_programmes_query();
			$data['levels'] = $this->add_question_jexpo_model->get_levels_query();
			// $data['questions_type'] = $this->add_question_jexpo_model->get_questions_type_query();
			// $data['questions_for'] = $this->add_question_jexpo_model->get_questions_for_query();
			// $data['modules'] = $this->add_question_jexpo_model->get_questions_module_query();
			// $data['questions_type_trainee'] = $this->add_question_jexpo_model->get_questions_type_trainee_query();
			$data['question_option_patterns'] = $this->add_question_jexpo_model->get_question_pattern_query();
			$data['status'] = 'success';
			$data['message'] = "Question Details Successfully Uploaded ";
			$this->load->view($this->config->item('theme').'question/add_question_jexpo_view',$data);
		}
		else
		{
			$data['exam_type_list'] = $this->add_question_jexpo_model->getAllExamType($stake_details_id_fk);
			if(set_value('exam_type') != NULL){
					
				//$data['courses'] = $this->add_question_jexpo_model->get_course_query(set_value('sector_id'));
				$data['subjects'] = $this->add_question_jexpo_model->get_subject_query(set_value('exam_type'),$stake_details_id_fk);
			}
			$data['status'] = 'denger';
			$data['message'] = "Something is wrong! Please try again.";
			$this->load->view($this->config->item('theme').'question/add_question_jexpo_view',$data);
			
		}
		}
		
	}

	
	public function get_subject($exam_type)
	{
		$stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
		if(is_numeric($exam_type))
		{
		$data['subjects'] = $this->add_question_jexpo_model->get_subject_query($exam_type,$stake_details_id_fk);
		$this->load->view($this->config->item('theme').'question/ajax_view/subject_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

	public function get_question_type_trainee()
	{
		$data['questions_type'] = $this->add_question_jexpo_model->get_questions_type_trainee_query();
		$this->load->view($this->config->item('theme').'question/ajax_view/question_type_ajax_view',$data);
		
	}

	public function get_question_type_assessor()
	{
		$data['questions_type'] = $this->add_question_jexpo_model->get_questions_type_query();
		$this->load->view($this->config->item('theme').'question/ajax_view/question_type_ajax_view',$data);
		
	}
	
	
	//file validation
    public function file_validation($fild = NULL, $file_name = NULL){

        $file_array = explode("|",$file_name);
		//print_r($file_array);
        if($file_array[1] == "application/pdf"){
            $ext = "PDF";
        } elseif($file_array[1] == "image/jpeg"){
            $ext = "JPG";
        }
        if($file_array[3] == "required"){
            $file_data = $_FILES[$file_array[0]];
            if($file_data['name'] != NULL){
                if($file_data['type'] == $file_array[1]){ // mime
                    if($file_data['size'] <= $file_array[2]*1000){ // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is '.$file_array[2].' KB  for {field}');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be '. $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if($file_data['name'] != NULL){
                if($file_data['type'] == $file_array[1]){ // mime
                    if($file_data['size'] <= $file_array[2]*1000){ // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is '.$file_array[2].' KB  for {field}');
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be '.$ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
	}


	function question_eng_duplicate_check($question)
	{
		if($question!=NULL || $question!='')
		{
			$duplicate_question = $this->add_question_jexpo_model->get_duplicate_eng_question($question);
		}
		
		if($question==NULL || $question=='')
		{
			$this->form_validation->set_message('question_eng_duplicate_check', 'The {field} field is required');
			return false;
		}
		else if(count($duplicate_question)>0)
		{
			$this->form_validation->set_message('question_eng_duplicate_check', 'The {field} must contain unique question');
			return false;
		}
		else
		{
			return true;
		}
	}

	
}
