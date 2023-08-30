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
		$sectors_id=$sectors[0]['sector_id_pk'];
		$data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'question/manage_question/index/';
            $config['total_rows']       = $this->manage_question_model->question_count($sectors_id)[0]['count'];	
            $config['per_page']         = 25;
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
            $data['questions']  	= $this->manage_question_model->get_question($config['per_page'],$offset,$sectors_id);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim');
			$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/ WBSCTVESD certified assessor', 'trim|numeric');
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

		$data['questions']=$this->manage_question_model->get_question_details($question_id_hash);
		if($data['questions'][0]['sector_id']!=NULL){
			$data['courses'] = $this->add_question_model->get_course_query($data['questions'][0]['sector_id']);
		}
		//print_r($data['questions']);
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
			$this->load->view($this->config->item('theme').'question/edit_question_view',$data);
			
			
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
						'update_time' 		=> date('Y-m-d H:i:s'),
						'update_ip' 		=> $this->input->ip_address(),
						'update_by' 		=> $this->session->stake_holder_login_id_pk,
						'active_status' 	=> 1,
						'process_status_id_fk' 	=> 0,
					   );
		
		$update_question = $this->manage_question_model->question_update($question_id_hash,$data);
		
		if($update_question == TRUE)
		{
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			//$data['questions']=$this->manage_question_model->get_question_details($question_id_hash);
			$data['programmes'] = $this->add_question_model->get_programmes_query();
			$data['levels'] = $this->add_question_model->get_levels_query();
			$data['questions_type'] = $this->add_question_model->get_questions_type_query();
			$data['questions_for'] = $this->add_question_model->get_questions_for_query();
			$data['modules'] = $this->add_question_model->get_questions_module_query();
			$data['questions_type_trainee'] = $this->add_question_model->get_questions_type_trainee_query();
			$data['status'] = 'success';
			$data['message'] = "Question Details Successfully Updated ";
			$this->load->view($this->config->item('theme').'question/edit_question_view',$data);
		}
		else
		{
			$data['sectors'] = $this->add_question_model->get_sectors_query($stake_details_id_fk);
			if(set_value('sector_id') != NULL){
					
				$data['courses'] = $this->add_question_model->get_course_query(set_value('sector_id'));
			}
			$data['status'] = 'denger';
			$data['message'] = "Something is wrong! Please try again.";
			$this->load->view($this->config->item('theme').'question/edit_question_view', $data);
			
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

}
