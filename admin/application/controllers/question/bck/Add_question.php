<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_question extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(21);
		$this->load->model('question/add_question_model');
		$this->load->helper('code');
		$this->load->helper('security');
		//$this->output->enable_profiler();
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
		);
		$this->js_foot = array(
			//1 => $this->config->item('theme_uri').'assets/js/jquery-3.3.1.min.js',
			2 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			1 => $this->config->item('theme_uri')."question/add_question.js",
		);
	}
	public function index()
	{
		
		//$stake_id_fk = $this->session->userdata('stake_id_fk');
		$stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
		$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
		$data['programmes'] = $this->add_question_model->get_programmes_query();
		$data['levels'] = $this->add_question_model->get_levels_query();
		$data['questions_type'] = $this->add_question_model->get_questions_type_query();
		$data['questions_for'] = $this->add_question_model->get_questions_for_query();
		$data['modules'] = $this->add_question_model->get_questions_module_query();
		$data['questions_type_trainee'] = $this->add_question_model->get_questions_type_trainee_query();
		//$data[]=array();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sector_id', 'Sector Name', 'trim|required');
		$this->form_validation->set_rules('course_id', 'Course Name', 'trim|required');
		$this->form_validation->set_rules('programme_id', 'Programme', 'trim|required');
		$this->form_validation->set_rules('level_id', 'Level', 'trim|required');
		$this->form_validation->set_rules('module_id', 'Module', 'trim|required');
		$this->form_validation->set_rules('question_type_id', 'Question Type', 'trim|required');
		$this->form_validation->set_rules('question_for_id', 'Question for', 'trim|required');
		$this->form_validation->set_rules('question', 'Question', 'trim|required');
		$this->form_validation->set_rules('optionA', 'Option A', 'trim|required');
		$this->form_validation->set_rules('optionB', 'Option B', 'trim|required');
		$this->form_validation->set_rules('optionC', 'Option C', 'trim|required');
		$this->form_validation->set_rules('optionD', 'Option D', 'trim|required');
		$this->form_validation->set_rules('correctAns', 'Correct Answer', 'trim|required');

		
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 
		if ($this->form_validation->run() == FALSE) {
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			$this->load->view($this->config->item('theme').'question/add_question_view',$data);
		} else {
		
		$sector_id 			= $this->input->post('sector_id');
		$course_id 			= $this->input->post('course_id');
		$programme_id		= $this->input->post('programme_id');
		$level_id 			= $this->input->post('level_id');
		$question_type_id 	= $this->input->post('question_type_id');
		$question_for_id 	= $this->input->post('question_for_id');
		$module_id 			= $this->input->post('module_id');
		$question 			= $this->input->post('question');
		$optionA 			= $this->input->post('optionA');
		$optionB 			= $this->input->post('optionB');
		$optionC 			= $this->input->post('optionC');
		$optionD 			= $this->input->post('optionD');
		$correctAns 		= strtoupper($this->input->post('correctAns'));
		
		if(strlen($optionA)==NULL)
		{
			$optionA='None of these.';
		}
		else if(strlen($optionB)==NULL)
		{
			$optionB='None of these.';
		}
		else if(strlen($optionC)==NULL)
		{
			$optionC='None of these.';
		}
		else if(strlen($optionD)==NULL)
		{
			$optionD='None of these.';
		}
		
		// $data = $this->Add_question_model->get_max_quest_no();
		// if(!empty($data[0]['max_id'])){
		// $id=$data[0]['max_id']+1;
		// }
		// else{
		// $id=1;
		// }
		
		$data=array(
					'sector_id' 		=>$sector_id ,
					'course_id' 		=>$course_id,
					'programme_id' 		=>$programme_id,
					'level_id' 			=>$level_id,
					'question_type_id' 	=>$question_type_id,
					'question_for_id' 	=>$question_for_id,
					'module_id' 		=>$module_id,
					'question' 			=>$question ,
					'option1' 			=>$optionA ,
					'option2' 			=>$optionB,
					'option3' 			=>$optionC,
					'option4' 			=>$optionD,
					'right_answer' 		=>$correctAns ,
					'entry_time' 		=> date('Y-m-d H:i:s'),
					'entry_ip' 			=> $this->input->ip_address(),
					'entry_by' 			=> $this->session->stake_holder_login_id_pk,
					'active_status' 	=> 1,
					'process_status_id_fk' 	=> 0,
		           );
		
		$insert_question = $this->add_question_model->question_submit($data);
		
		if($insert_question == TRUE)
		{
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			$data['programmes'] = $this->add_question_model->get_programmes_query();
			$data['levels'] = $this->add_question_model->get_levels_query();
			$data['questions_type'] = $this->add_question_model->get_questions_type_query();
			$data['questions_for'] = $this->add_question_model->get_questions_for_query();
			$data['modules'] = $this->add_question_model->get_questions_module_query();
			$data['questions_type_trainee'] = $this->add_question_model->get_questions_type_trainee_query();
			$data['status'] = 'success';
			$data['message'] = "Question Details Successfully Uploaded ";
			$this->load->view($this->config->item('theme').'question/add_question_view',$data);
		}
		else
		{
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			$data['status'] = 'denger';
			$data['message'] = "Something is wrong! Please try again.";
			$this->load->view($this->config->item('theme').'question/add_question_view',$data);
			
		}
		}
		
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

	
}
