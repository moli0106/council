<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manage_question extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(22);
		$this->load->model('question/manage_question_model');
		$this->load->model('question/add_question_model');
		$this->load->helper('code');
		$this->load->helper('security');
		//$this->output->enable_profiler(TRUE);
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
		);
		$this->js_foot = array(
			//1 => $this->config->item('theme_uri').'assets/js/jquery-3.3.1.min.js',
			2 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			1 => $this->config->item('theme_uri')."question/manage_question.js",
			3 => $this->config->item('theme_uri').'assets/js/sweetalert.js',
		);
		
	}
	public function index($offset = 0)
	{
		$stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
		$sectors = $this->manage_question_model->get_sectors_query($stake_details_id_fk);
		//print_r($sectors);die;
		foreach($sectors as $key=>$sector){ 
			$sectors_ids[$key] = $sector['sector_id_pk'];
		}
		//print_r($array_o);
		
		$data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'question/manage_question/index/';
            $config['total_rows']       = $this->manage_question_model->question_count($sectors_ids)[0]['count'];	
            $config['per_page']         = 100;
            $config['num_links']        = 2;
            $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
            $config['full_tag_close']   = '</ul>';
            $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
            $config['first_tag_open']   = '<li class="">';
            $config['first_tag_close']  = '</li>';
            $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
            $config['last_tag_open']    = '<li class="">';
            $config['last_tag_close']   = '</li>';
            $config['first_tag_open']   = '<li>';
            $config['first_tag_close']  = '</li>';
            $config['prev_link']        = '<i class="fa fa-backward"></i>';
            $config['prev_tag_open']    = '<li class="prev">';
            $config['prev_tag_close']   = '</li>';
            $config['next_link']        = '<i class="fa fa-forward"></i>';
            $config['next_tag_open']    = '<li>';
            $config['next_tag_close']   = '</li>';
            $config['last_tag_open']    = '<li>';
            $config['last_tag_close']   = '</li>';
            $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
            $config['cur_tag_close']    = '</a></li>';
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            
            
            $this->pagination->initialize($config);
            $data['questions']  	= $this->manage_question_model->get_question($config['per_page'],$offset,$sectors_ids);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim');
			$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/WBSCTVESD certified assessor', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

			if ($this->form_validation->run() == TRUE){
					$data['questions'] 		= $this->assessor_list_model->get_assessor_search($this->input->post('pan_no'),$this->input->post('ssc_wbsctvesd_certified'));
			} 
			else {
				$data['questions'] = array();
			}
		}
			$data['offset']         = $offset;
			//$this->load->view($this->config->item('theme').'finance/trainee_payment_file_list_view',$data);

        //print_r($data['assessors']);
        $this->load->view($this->config->item('theme').'question/question_list_view',$data);
	}




	public function changeQuestion_status()
    {
		$status=$this->input->get('status');
		$id_hash=$this->input->get('id_hash');

        $updateArray  = array(
			'process_status_id_fk' 	=> $status,
			'approve_reject_by' 	=> $this->session->stake_holder_login_id_pk,
			'approve_reject_time' 	=> date('Y-m-d H:i:s'),
			'approve_reject_ip' 	=> $this->input->ip_address()
		);
        $updateResult1 = $this->manage_question_model->updateQuestion_status($id_hash, $updateArray);
		if($updateResult1)
        {
        	echo json_encode($id_hash);
		}
    }



	public function edit($question_id_hash){

		$stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
		$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
		$data['programmes'] = $this->add_question_model->get_programmes_query();
		$data['levels'] = $this->add_question_model->get_levels_query();
		$data['questions_type'] = $this->add_question_model->get_questions_type_query();
		$data['questions_for'] = $this->add_question_model->get_questions_for_query();
		$data['modules'] = $this->add_question_model->get_questions_module_query();
		$data['questions_type_trainee'] = $this->add_question_model->get_questions_type_trainee_query();
		$data['question_option_patterns'] = $this->add_question_model->get_question_pattern_query();

		$data['questions']=$this->manage_question_model->get_question_details($question_id_hash);
		if($data['questions'][0]['sector_id']!=NULL){
			$data['courses'] = $this->add_question_model->get_course_query($data['questions'][0]['sector_id']);
		}
		if($data['questions'][0]['course_id']!=NULL){
			$data['nos_list'] = $this->add_question_model->get_nos_query($data['questions'][0]['course_id']);
		}
		//print_r($data['questions']);
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sector_id', 'Sector Name', 'trim|required');
		$this->form_validation->set_rules('course_id', 'Course Name', 'trim|required');
		$this->form_validation->set_rules('programme_id', 'Programme', 'trim|required');
		$this->form_validation->set_rules('level_id', 'Level', 'trim|required');
		if($this->input->post('question_for_id')==2){
			$this->form_validation->set_rules('module_id', '<b>Module</b>', 'trim|required');
		}
		if($this->input->post('question_for_id')==1){
			$this->form_validation->set_rules('nos_id', '<b>NoS</b>', 'trim|required');
		}
		$this->form_validation->set_rules('question_type_id', 'Question Type', 'trim|required');
		$this->form_validation->set_rules('question_for_id', 'Question for', 'trim|required');
		
		//$this->form_validation->set_rules('question', 'Question', 'trim|required|callback_question_eng_duplicate_check['.$question_id_hash.']');
		$this->form_validation->set_rules('question', 'Question', 'trim|required|callback_question_eng_duplicate_check['.$question_id_hash.','.$this->input->post('question_for_id').']');
		
		if($this->input->post('option_pattern')==1){
			$this->form_validation->set_rules('optionA', '<b>Option A</b>', 'trim|required');
			$this->form_validation->set_rules('optionB', '<b>Option B</b>', 'trim|required');
			$this->form_validation->set_rules('optionC', '<b>Option C</b>', 'trim|required');
			$this->form_validation->set_rules('optionD', '<b>Option D</b>', 'trim|required');
		}
		$this->form_validation->set_rules('correctAns', 'Correct Answer', 'trim|required');
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
			
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			if(set_value('course_id') != NULL){
					
				$data['nos_list'] = $this->add_question_model->get_nos_query(set_value('course_id'));
			}
			$this->load->view($this->config->item('theme').'question/edit_question_view',$data);
			
			
		} else {
		
			$sector_id 			= $this->input->post('sector_id');
			$course_id 			= $this->input->post('course_id');
			$programme_id		= $this->input->post('programme_id');
			$level_id 			= $this->input->post('level_id');
			$question_type_id 	= $this->input->post('question_type_id');
			$question_for_id 	= $this->input->post('question_for_id');
			if($this->input->post('question_for_id')==2){
				$module_id 			= $this->input->post('module_id');
				}else{
					$module_id 			=NULL;
				}
				if($this->input->post('question_for_id')==1){
				$nos_id 			= $this->input->post('nos_id');
				}else{
					$nos_id 			=NULL;
				}
			$question 			= $this->input->post('question');
			$question_pattern 	= $this->input->post('question_pattern');
			$option_pattern 	= $this->input->post('option_pattern');
			if($this->input->post('option_pattern')==1){
				$optionA 			= $this->input->post('optionA');
				$optionB 			= $this->input->post('optionB');
				$optionC 			= $this->input->post('optionC');
				$optionD 			= $this->input->post('optionD');
			}else{
				$optionA 			='';
				$optionB 			='';
				$optionC 			='';
				$optionD 			='';
			}
			$correctAns 		= strtoupper($this->input->post('correctAns'));
			
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
				'sector_id' 			=>$sector_id ,
				'course_id' 			=>$course_id,
				'programme_id' 			=>$programme_id,
				'level_id' 				=>$level_id,
				'question_type_id' 		=>$question_type_id,
				'question_for_id' 		=>$question_for_id,
				'module_id' 			=>$module_id,
				'question_pattern' 		=>$question_pattern,
				'option_pattern' 		=>$option_pattern,
				'nos_id' 				=>$nos_id,
				'active_status' 		=> 1,
				'process_status_id_fk' 	=> 0,
				'update_time' 		=> date('Y-m-d H:i:s'),
				'update_ip' 		=> $this->input->ip_address(),
				'update_by' 		=> $this->session->stake_holder_login_id_pk,
				
			   );
			   $update_question = $this->manage_question_model->question_update_main_qui_bank($question_id_hash,$question_master_data);
			   $question_data=array(
				'question' 				=>$question ,
				'option1' 				=>$optionA ,
				'option2' 				=>$optionB,
				'option3' 				=>$optionC,
				'option4' 				=>$optionD,
				'right_answer' 			=>$correctAns ,
				'update_time' 			=> date('Y-m-d H:i:s'),
				'update_ip' 			=> $this->input->ip_address(),
				'update_by' 			=> $this->session->stake_holder_login_id_pk,
				'active_status' 		=> 1,
				'process_status_id_fk' 	=> 0,
				'question_pic' 			=>$question_pic ,
				'option1_pic' 			=>$optionA_pic ,
				'option2_pic' 			=>$optionB_pic,
				'option3_pic' 			=>$optionC_pic,
				'option4_pic' 			=>$optionD_pic,
				
			   );
	
			   $update_question = $this->manage_question_model->question_update_eng_lang($question_id_hash,$question_data);





		// 	$question_master_data=array(
		// 				'sector_id' 		=>$sector_id ,
		// 				'course_id' 		=>$course_id,
		// 				'programme_id' 		=>$programme_id,
		// 				'level_id' 			=>$level_id,
		// 				'question_type_id' 	=>$question_type_id,
		// 				'question_for_id' 	=>$question_for_id,
		// 				'module_id' 		=>$module_id,
		// 				'question' 			=>$question ,
		// 				'option1' 			=>$optionA ,
		// 				'option2' 			=>$optionB,
		// 				'option3' 			=>$optionC,
		// 				'option4' 			=>$optionD,
		// 				'right_answer' 		=>$correctAns ,
		// 				'update_time' 		=> date('Y-m-d H:i:s'),
		// 				'update_ip' 		=> $this->input->ip_address(),
		// 				'update_by' 		=> $this->session->stake_holder_login_id_pk,
		// 				'active_status' 	=> 1,
		// 				'process_status_id_fk' 	=> 0,
		// 				'question_pic' 			=>$question_pic ,
		// 				'option1_pic' 			=>$optionA_pic ,
		// 				'option2_pic' 			=>$optionB_pic,
		// 				'option3_pic' 			=>$optionC_pic,
		// 				'option4_pic' 			=>$optionD_pic,
		// 				'question_pattern' 		=>$question_pattern,
		// 				'option_pattern' 		=>$option_pattern,
		// 			   );
		
		// $update_question = $this->manage_question_model->question_update($question_id_hash,$data);
		
		if($update_question == TRUE)
		{
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			if(set_value('course_id') != NULL){
					
				$data['nos_list'] = $this->add_question_model->get_nos_query(set_value('course_id'));
			}
			//$data['questions']=$this->manage_question_model->get_question_details($question_id_hash);
			$data['programmes'] = $this->add_question_model->get_programmes_query();
			$data['levels'] = $this->add_question_model->get_levels_query();
			$data['questions_type'] = $this->add_question_model->get_questions_type_query();
			$data['questions_for'] = $this->add_question_model->get_questions_for_query();
			$data['modules'] = $this->add_question_model->get_questions_module_query();
			$data['questions_type_trainee'] = $this->add_question_model->get_questions_type_trainee_query();
			$data['question_option_patterns'] = $this->add_question_model->get_question_pattern_query();
			//$data['status'] = 'success';
			//$data['message'] = "Question Details Successfully Updated ";
			$this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('alert_msg', 'Question Details Successfully Updated ');
			redirect('admin/question/manage_question/edit/'.$question_id_hash,'refresh');

			//$this->load->view($this->config->item('theme').'question/edit_question_view',$data);
		}
		else
		{
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			//$data['status'] = 'denger';
			//$data['message'] = "Something is wrong! Please try again.";
			$this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
			redirect('admin/question/manage_question/edit/'.$question_id_hash,'refresh');
			
		}
		}
		
		}


	public function get_question_type_trainee()
	{
		$data['questions_type'] = $this->add_question_model->get_questions_type_trainee_query();
		$this->load->view($this->config->item('theme').'question/ajax_view/question_type_ajax_view',$data);
		
	}

	public function get_question_type_assessor()
	{
		$data['questions_type'] = $this->add_question_model->get_questions_type_query();
		$this->load->view($this->config->item('theme').'question/ajax_view/question_type_ajax_view',$data);
		
	}

	public function get_course($sector_code)
	{
		if(is_numeric($sector_code))
		{
		$data['courses'] = $this->add_question_model->get_course_query($sector_code);
		$this->load->view($this->config->item('theme').'question/ajax_view/course_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
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



	public function add_bengali_question($question_id_hash){
		
		$data['questions']=$this->manage_question_model->get_question_main_details($question_id_hash);
		$data['question_answer']=$this->manage_question_model->get_question_answer_details($question_id_hash);
		//print_r($data['questions']);
		$question_id_pk=$data['questions'][0]['question_id_pk'];
		$option_pattern=$data['questions'][0]['option_pattern'];
		$question_pattern=$data['questions'][0]['question_pattern'];
		$beng_question_id_pk=$data['questions'][0]['beng_question_id_pk'];
		$question_for_id=$data['questions'][0]['question_for_id'];
		$this->load->library('form_validation');
		
		
		if($beng_question_id_pk!=''){
			$this->form_validation->set_rules('question', 'Question', 'trim|required|callback_question_beng_duplicate_check['.$question_id_hash.','.$question_for_id.']');
		}else{
			//$this->form_validation->set_rules('question', '<b>Question</b>', 'trim|required|is_unique[council_question_bank_bengali_lang.question]');
			$this->form_validation->set_rules('question', '<b>Question</b>', 'trim|required|callback_is_unique_beng_question['.$question_for_id.']');
		}
		
		if($option_pattern==1){
			$this->form_validation->set_rules('optionA', '<b>Option A</b>', 'trim|required');
			$this->form_validation->set_rules('optionB', '<b>Option B</b>', 'trim|required');
			$this->form_validation->set_rules('optionC', '<b>Option C</b>', 'trim|required');
			$this->form_validation->set_rules('optionD', '<b>Option D</b>', 'trim|required');
		}
		$this->form_validation->set_rules('correctAns', 'Correct Answer', 'trim|required');
		
		
		if($question_pattern==2){
			$this->form_validation->set_rules('question_pic', '<b>Pictorial question</b>', 'trim|callback_file_validation[question_pic|image/jpeg|50|required]');
		}
		if($option_pattern==2){
			$this->form_validation->set_rules('optionA_pic', '<b>Pictorial option A</b>', 'trim|callback_file_validation[optionA_pic|image/jpeg|50|required]');
			$this->form_validation->set_rules('optionB_pic', '<b>Pictorial option B</b>', 'trim|callback_file_validation[optionB_pic|image/jpeg|50|required]');
			$this->form_validation->set_rules('optionC_pic', '<b>Pictorial option C</b>', 'trim|callback_file_validation[optionC_pic|image/jpeg|50|required]');
			$this->form_validation->set_rules('optionD_pic', '<b>Pictorial option D</b>', 'trim|callback_file_validation[optionD_pic|image/jpeg|50|required]');
		}

		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->load->view($this->config->item('theme').'question/add_bengali_question_view',$data);
			
			
		} else {
		
			$question 			= $this->input->post('question');
			if($option_pattern==1){
				$optionA 			= $this->input->post('optionA');
				$optionB 			= $this->input->post('optionB');
				$optionC 			= $this->input->post('optionC');
				$optionD 			= $this->input->post('optionD');
			}else{
				$optionA 			='';
				$optionB 			='';
				$optionC 			='';
				$optionD 			='';
			}
			$correctAns 		= $data['question_answer'][0]['right_answer'];
			
			if($question_pattern==2){
				$question_pic  		= base64_encode(file_get_contents($_FILES["question_pic"]['tmp_name']));
			}else{
				$question_pic		='';
			}
			if($option_pattern==2){
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
			
					   $question_data=array(
						'question_id_fk' 		=>$question_id_pk ,
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
					   
			$update_ben_ques_array  = array(
			'bengali_lan_quesstion_status' 	=> 1
		);
		
		//print_r($question_data);die;
		if($beng_question_id_pk==''){
			$ben_question = $this->manage_question_model->question_ben_language_insert($question_data);
			$ben_question_status = $this->manage_question_model->question_benk_master_ben_question_status($update_ben_ques_array,$question_id_pk);
		}else{
			$ben_question = $this->manage_question_model->question_ben_language_update($question_data,$beng_question_id_pk);
		}
		if($ben_question == TRUE)
		{
			$this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('alert_msg', 'Question Details Successfully Inserted ');
			redirect('admin/question/manage_question/add_bengali_question/'.$question_id_hash,'refresh');

			//$this->load->view($this->config->item('theme').'question/edit_question_view',$data);
		}
		else
		{
			$this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
			redirect('admin/question/manage_question/add_bengali_question/'.$question_id_hash,'refresh');
			
		}
		}
		
		}
	

	public function get_nos($course_code)
	{
		if(is_numeric($course_code))
		{
			$data['nos_list'] = $this->add_question_model->get_nos_query($course_code);
			$this->load->view($this->config->item('theme').'question/ajax_view/nos_ajax_view',$data);
		}
		else
		{?>
			<script>alert("Something Went Wrong...Please Provide Valid NoS");</script>
		<?php }
	}


	public function ajax_view_question($id_hash = NULL)
	{
		if($id_hash == NULL || strlen($id_hash) != 32)
		{
			show_404();
		}
		else 
		{
			//$data['application'] = $id_hash;
			//$data['partner'] = $this->application_model->get_application_full_details($id_hash);
			$data['question'] = $this->manage_question_model->get_question_details_by_id($id_hash);
			//print_r($data['questions']);
			$this->load->view($this->config->item('theme').'question/ajax_view/ajax_question_details_view',$data);
		}
	}
	
	
	function question_eng_duplicate_check($question,$str)
	{
		$data = explode(',', $str);

        $question_id_hash  = $data[0];
        $question_for_id = $data[1];

		if($question!=NULL || $question!='')
		{
			$duplicate_question = $this->manage_question_model->get_duplicate_eng_question($question,$question_id_hash,$question_for_id);
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

	
	function question_beng_duplicate_check($question,$str)
	{
		$data = explode(',', $str);

        $question_id_hash  = $data[0];
        $question_for_id = $data[1];

		if($question!=NULL || $question!='')
		{
			$duplicate_question = $this->manage_question_model->get_duplicate_beng_question($question,$question_id_hash,$question_for_id);
		}
		
		if($question==NULL || $question=='')
		{
			$this->form_validation->set_message('question_beng_duplicate_check', 'The {field} field is required');
			return false;
		}
		else if(count($duplicate_question)>0)
		{
			$this->form_validation->set_message('question_beng_duplicate_check', 'The {field} must contain unique question');
			return false;
		}
		else
		{
			return true;
		}
	}

	public function is_unique_beng_question($question,$question_for_id){
		// echo $question;
		// echo $question_for_id;die;
		if(($question!=NULL || $question!='') && ($question_for_id!=NULL || $question_for_id!=''))
		{
			$duplicate_question = $this->manage_question_model->get_unique_beng_question($question,$question_for_id);
			
		}
		//print_r($duplicate_question);die;
		if (empty($duplicate_question)) {
			return true;
		}
		else {
	
			$this->form_validation->set_message('is_unique_beng_question', 'The {field} field must contain a unique value.');
			return false;
		}
	}
	
}

