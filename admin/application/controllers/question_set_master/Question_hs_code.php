<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_hs_code extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(112);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('question_set_master/question_hs_code_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'question_set_master/question_hs_code.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data = array(
            'course_list' => $this->question_hs_code_model->getAllcourse()
        );

        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'question_set_master/question_hs_code/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->question_hs_code_model->get_question_code_count()[0]['count'];	
		$config['per_page']         = 25;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin">';
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
		
        $data['page_links']  = $this->pagination->create_links();
        $data['question_code_list'] = $this->question_hs_code_model->getAll_question_code($config['per_page'], $offset);
        //$data['disciplineList'] = array();

            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required'
                ),
                
                array(
                    'field' => 'subject_id',
                    'label' => 'Subject',
                    'rules' => 'trim|required|callback_same_subject_check_hsvoc'
                ),
                array(
                    'field' => 'question_code',
                    'label' => 'question code',
                    'rules' => 'trim|required|callback_same_question_code_check_hsvoc'
                )
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {

                
                if(set_value('course_id') != NULL){

					$data['subjectList'] = $this->question_hs_code_model->get_subject_List(set_value('course_id'));
                    
                }
                
                $this->load->view($this->config->item('theme').'question_set_master/question_hs_code_list_view', $data);
            
		    } else {
				
                    $post_data = array(
                        'course_id_fk'      => $this->input->post('course_id'),
                        //'discipline_id_fk'  => $this->input->post('discipline_id'),
                        //'sam_year_id_fk'    => $this->input->post('sam_year_id'),
                        'subject_id_fk'     => $this->input->post('subject_id'),
                        'question_code'     => $this->input->post('question_code'),
                        'inserted_by'       => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'        => 'now()',
                        'active_status'     => 1
                    );

                    $last_id = $this->question_hs_code_model->insert_question_code_data($post_data);
					
                    if($last_id)
                    {
						
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Question Code added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/question_set_master/question_hs_code');
                    //$this->load->view($this->config->item('theme').'qbm_master/discipline_list_view', $data);
            }
        
        
    }

    public function get_discipline($course_code)
	{
		if(is_numeric($course_code))
		{
		$data['disciplineList'] = $this->question_hs_code_model->getDisciplineList($course_code);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/discipline_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

    /*public function get_semester($course_code)
	{
		if(is_numeric($course_code))
		{
		$data['semesterList'] = $this->question_hs_code_model->get_semester_List($course_code);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/semester_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}*/
    /*public function get_subject_old($course_id)
	{
		if(is_numeric($course_id))
		{
		$data['subjectList'] = $this->question_hs_code_model->get_subject_List($course_id,$discipline_id);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/subject_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}*/
	
	public function get_subject($course_id)
	{
		if(is_numeric($course_id))
		{
			$data['question_code_list'] = $this->question_hs_code_model->getAll_question_code();
			$subject_ids = array_column($data['question_code_list'], 'subject_id_pk');
			//print_r($subject_ids);
			
			$data['subjectList'] = $this->question_hs_code_model->get_subject_List($course_id, $subject_ids);
			$this->load->view($this->config->item('theme').'qbm_master/ajax_view/subject_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}

    public function same_subject_check_hsvoc(){
        $course_id = $this->input->post('course_id');
        //$discipline_id = $this->input->post('discipline_id');
        $subject_id = $this->input->post('subject_id');
        
		if($course_id!='' and $subject_id!=''){
        $data_count=$this->question_hs_code_model->get_same_subject_data_hsvoc($course_id,$subject_id)[0]['count'];
        //print_r($data_count);die;
		if($data_count == 0){
                return TRUE;
            } else {
                $this->form_validation->set_message('same_subject_check_hsvoc', 'The {field} is already mapping with Question Code ');
                return FALSE;
            }
	    }
		
	}

    public function same_question_code_check_hsvoc(){
        //$course_id = $this->input->post('course_id');
        //$subject_id = $this->input->post('subject_id');
        $question_code = $this->input->post('question_code');
        
		if($question_code!=''){
        $data_count=$this->question_hs_code_model->get_same_question_code_data_hsvoc($question_code)[0]['count'];
        //print_r($data_count);die;
		if($data_count == 0){
                return TRUE;
            } else {
                $this->form_validation->set_message('same_subject_check_hsvoc', 'The {field} must be Unique ');
                return FALSE;
            }
	    }
		
	}

    public function remove_question_code($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if (!empty($id_hash)) {
                $nosDetails = $this->question_hs_code_model->updateQuestionCodeData($id_hash, array('active_status' => 0));

                echo json_encode($id_hash);
            }
        }
    }





    /*public function get_subject_update($course_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($course_id != NULL) {

            $html = '<option value="" hidden="true">Select Subject</option>';
            //$municipality = $this->student_model->getMunicipalityByDistrict($course_id);
            $data['question_code_list'] = $this->question_hs_code_model->getAll_question_code();
			$subject_ids = array_column($data['question_code_list'], 'subject_id_pk');
			//print_r($subject_ids);
			
			$subjectList = $this->question_hs_code_model->get_subject_List($course_id, $subject_ids);

            if (!empty($subjectList)) {
                foreach ($subjectList as $key => $value) {
                    $html .= '
                    <option value="' . $value['subject_id_pk'] . '">
                        ' . $value['subject_name'] .' [' . $value['subject_code'] .']
                    </option>
                ';
                }
            } else {
                $html .= '<option>No Data Found...</option>';
            }
            echo json_encode($html);
        }
    }


    
    public function get_hs_question_code_details($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($id_hash != NULL) {

            $data['hs_question_code'] = $this->question_hs_code_model->get_hs_question_code_details($id_hash)[0];
            //print_r($data['hs_question_code']);die;
            if (!empty($data['hs_question_code'])) {
                
                $data['course_list']  = $this->question_hs_code_model->getAllcourse();
                $data['subjectList'] = $this->question_hs_code_model->get_subject_List($data['hs_question_code']['course_id_fk']);

                $html_view = $this->load->view($this->config->item('theme') . 'question_set_master/question_hs_format/question_code_details_ajax_view', $data, TRUE);
                //$this->load->view($this->config->item('theme').'question_set_master/question_hs_format/question_hs_code_list_view', $data);
                echo json_encode($html_view);
            }
        }
    }


    public function update()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $question_code_id = $this->input->post('question_code_id');
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'course_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required'
                ),
                
                array(
                    'field' => 'subject_id',
                    'label' => 'Subject',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'question_code',
                    'label' => 'question code',
                    'rules' => 'trim|required|is_unique[council_qbm_question_code_master.question_code]'
                )
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() != FALSE) {

                $updateArray = array(
                    'subject_id_fk' => $this->input->post('subject_id'),
                    'course_id_fk'  => $this->input->post('course_id'),
                    'question_code' => $this->input->post('question_code'),
                    'updated_time'  => "now()",
                    'updated_ip'    => $this->input->ip_address(),
                    'updated_by'    => $this->session->userdata('stake_holder_login_id_pk')
                    
                );

                $result = $this->question_hs_code_model->updateQuestionCodeData($question_code_id,$updateArray);
                if ($result) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Question Code updated successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update Question Code, Please try later.');
                }

                redirect('admin/question_set_master/question_hs_code');
            } else {

                $this->session->set_flashdata('validation_errors_list', validation_errors());
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Waning! Inappropriate Data, Please enter correct value.');
            }

            redirect('admin/question_set_master/question_hs_code');
        } else {
            redirect('admin/question_set_master/question_hs_code');
        }
    }*/

    

    

    

}



?>