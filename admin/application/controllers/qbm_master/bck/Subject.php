<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(85);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('qbm_master/subject_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'qbm_master/subject.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'qbm_master/subject/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->subject_model->get_subjectCount()[0]['count'];	
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
        $data['subjectList'] = $this->subject_model->getAll_subject($config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'qbm_master/subject_list_view', $data);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            'course_list' => $this->subject_model->getAllcourse(),
            'sub_group_list' => $this->subject_model->getAllsubGroup()
        );

        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('course_id', '<b>Course Name</b>', 'trim|required');
            $this->form_validation->set_rules('discipline_id', '<b>Discipline</b>', 'trim|required');
            $this->form_validation->set_rules('subject_name', '<b>Subject Name</b>', 'trim|required');
            $this->form_validation->set_rules('subject_code', '<b>Subject Code</b>', 'trim|required');

            if($this->input->post('course_id')==1 || $this->input->post('course_id')==2){
                $this->form_validation->set_rules('group_trade_id', '<b>Group/Trade</b>', 'trim|required');
                $this->form_validation->set_rules('sub_group_id', '<b>Subject Group</b>', 'trim|required');
            }else{
                $this->form_validation->set_rules('sam_year_id', '<b>Semester/Year</b>', 'trim|required');
            }

            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
	
		    if ($this->form_validation->run() == FALSE) {
                if(set_value('course_id') != NULL){
                    $data['disciplineList'] = $this->subject_model->getDisciplineList(set_value('course_id'));
                    $data['semesterList'] = $this->subject_model->get_semester_List(set_value('course_id'));
                }
                if(set_value('discipline_id') != NULL){
                    $data['group_tradeList'] = $this->subject_model->get_group_trade_List(set_value('discipline_id'));
                }
                $this->load->view($this->config->item('theme').'qbm_master/subject_add_view', $data);
            
		    } else {
                $course_id 			= $this->input->post('course_id');
                $discipline_id 			= $this->input->post('discipline_id');
                $subject_name		= $this->input->post('subject_name');
                $subject_code 			= $this->input->post('subject_code');
        
                if($this->input->post('course_id')==1 || $this->input->post('course_id')==2){
                    $group_trade_id 		= $this->input->post('group_trade_id');
                    $sub_group_id 			= $this->input->post('sub_group_id');
                }else{
                    $group_trade_id 		= NULL;
                    $sub_group_id 			= NULL;
                }

                if($this->input->post('course_id')==3 || $this->input->post('course_id')==4){
                    $sam_year_id 			= $this->input->post('sam_year_id');
                }else{
                    $sam_year_id 		= NULL;
                }
				
                    $post_data = array(
                        'subject_name'           => $subject_name,
                        'subject_code'           => $subject_code,
                        'course_id_fk'           => $course_id,
                        'discipline_id_fk'       => $discipline_id,
                        'group_trade_id_fk'      => $group_trade_id,
                        'sub_group_id_fk'        => $sub_group_id, 
                        'sam_year_id_fk'         => $sam_year_id, 

                        'entry_ip'               => $this->input->ip_address(),
                        'inserted_by'            => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'             => 'now()',
                        'active_status'          => 1
                    );

                    $last_id = $this->subject_model->insert_subject_data($post_data);
					
                    if($last_id)
                    {
						
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Subject added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/qbm_master/subject');
                
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'qbm_master/subject_add_view', $data);
        }
    }


    public function get_discipline($course_code)
	{
		if(is_numeric($course_code))
		{
		$data['disciplineList'] = $this->subject_model->getDisciplineList($course_code);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/discipline_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

    
    public function get_group_trade($discipline_id)
	{
		if(is_numeric($discipline_id))
		{
		$data['group_tradeList'] = $this->subject_model->get_group_trade_List($discipline_id);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/group_trade_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}
    public function get_semester($course_code)
	{
		if(is_numeric($course_code))
		{
		$data['semesterList'] = $this->subject_model->get_semester_List($course_code);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/semester_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}


    public function add_topics($subject_id_hash = NULL){
        $data['subject_id_hash'] = $subject_id_hash;
        //echo $subject_id_hash;die;

        //$this->output->enable_profiler();
        $data['subject'] = $this->subject_model->get_subject_details_by_id($subject_id_hash)[0];
        $data['semesters'] = $this->subject_model->get_hsvoc_semester($data['subject']['course_id_fk']);
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('topics', '<b>Topics/Chapter</b>', 'trim|required');

        if($data['subject']['course_id_fk']==1 || $data['subject']['course_id_fk']==2){
            $this->form_validation->set_rules('sam_year_id', '<b>Semester/Year</b>', 'trim|required|integer');
        }
        
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
        
        if ($this->form_validation->run() == TRUE) {
            $map_array = array(
                "topics_chapter_name" => $this->input->post("topics"),
                "subject_id_fk" => $this->input->post("subject_id"),
                "semester_id_fk" => $this->input->post("sam_year_id")==NULL?NULL:$this->input->post('sam_year_id'),
                "active_status" =>  1
            );
            
            if($this->subject_model->set_subject_topics_map($map_array)){
                $data["success"] = "success";
                $data["message"] = "Topics/Chapter mapped successfully";
            } else {
                $data["success"] = "danger";
                $data["message"] = "Something went wrong. Please try again";
            }
        } 
        
        //$data['domain_experiences'] = $this->subject_model->get_subject_topics_chapter_details($subject_id_hash);
        $data['topics_chapter_list'] = $this->subject_model->get_subject_topics_chapter_by_id($subject_id_hash);
        $this->load->view($this->config->item('theme').'qbm_master/subject_topics_map_view',$data);

    }

    

}


/* End of file subject.php */
?>