<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_list extends NIC_Controller 
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(61);
		$this->load->model('mis/question_list_model');
		//$this->load->model('question/add_question_model');
		$this->load->helper('code');
		$this->load->helper('security');
		//$this->output->enable_profiler(TRUE);
		$this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
		);
		$this->js_foot = array(
			//1 => $this->config->item('theme_uri').'assets/js/jquery-3.3.1.min.js',
			2 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
			1 => $this->config->item('theme_uri')."mis/question_list.js",
			3 => $this->config->item('theme_uri').'assets/js/sweetalert.js',
		);
		
	}
	public function index($offset = 0)
	{
		//$stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
		//$sectors = $this->question_list_model->get_sectors_query($stake_details_id_fk);
		//print_r($sectors);die;
		//foreach($sectors as $key=>$sector){ 
			//$sectors_ids[$key] = $sector['sector_id_pk'];
		//}
		//print_r($array_o);
		$data['sectors'] = $this->question_list_model->get_all_sector();
		$data['programmes'] = $this->question_list_model->get_programmes_query();
		$data['questions_type'] = $this->question_list_model->get_questions_type_query();
		$data['questions_for'] = $this->question_list_model->get_questions_for_query();
		$data['questions_type_trainee'] = $this->question_list_model->get_questions_type_trainee_query();
		
		$data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'mis/Question_list/index/';
            $config['total_rows']       = $this->question_list_model->question_count()[0]['count'];	
            $config['per_page']         = 25;
            $config['num_links']        = 4;
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
            $data['questions']  	= $this->question_list_model->get_question($config['per_page'],$offset);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('sector_id', 'sector', 'trim|numeric');
			$this->form_validation->set_rules('course_id', 'course', 'trim|numeric');
			$this->form_validation->set_rules('programme_id', 'programme', 'trim|numeric');
			$this->form_validation->set_rules('question_for_id', 'question for', 'trim|numeric');
			$this->form_validation->set_rules('question_type_id', 'question_type', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

			if ($this->form_validation->run() == TRUE){
					$sector_id = $this->input->post('sector_id');
					$course_id = $this->input->post('course_id');
					$programme_id = $this->input->post('programme_id');
					$question_for_id = $this->input->post('question_for_id');
					$question_type_id = $this->input->post('question_type_id');
					$data['questions'] 		= $this->question_list_model->get_question_search($sector_id,$course_id,$programme_id,$question_for_id,$question_type_id);
			} 
			else {
				$data['questions'] = array();
			}
		}
			$data['offset']         = $offset;
			//$this->load->view($this->config->item('theme').'finance/trainee_payment_file_list_view',$data);

        //print_r($data['assessors']);
        $this->load->view($this->config->item('theme').'mis/question_list_view',$data);
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
			$data['question'] = $this->question_list_model->get_question_details_by_id($id_hash);
			//print_r($data['questions']);
			$this->load->view($this->config->item('theme').'mis/ajax/ajax_question_details_view',$data);
		}
	}


	
	public function get_course($sector_code)
	{
		if(is_numeric($sector_code))
		{
		$data['courses'] = $this->question_list_model->get_course_query($sector_code);
		$this->load->view($this->config->item('theme').'mis/ajax/course_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

	public function get_question_type_trainee()
	{
		$data['questions_type'] = $this->question_list_model->get_questions_type_trainee_query();
		$this->load->view($this->config->item('theme').'mis/ajax/question_type_ajax_view',$data);
		
	}

	public function get_question_type_assessor()
	{
		$data['questions_type'] = $this->question_list_model->get_questions_type_query();
		$this->load->view($this->config->item('theme').'mis/ajax/question_type_ajax_view',$data);
		
	}
	
}

