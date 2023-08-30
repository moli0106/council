<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discipline extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(83);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('qbm_master/discipline_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            //3 => $this->config->item('theme_uri').'master/question_creator_moderator.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'qbm_master/discipline/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->discipline_model->get_disciplineCount()[0]['count'];	
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
        $data['disciplineList'] = $this->discipline_model->getAll_discipline($config['per_page'], $offset);

            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'discipline_name',
                    'label' => 'discipline Name',
                    'rules' => 'trim|required|is_unique[council_qbm_discipline_master.discipline_name]'
                ),
                array(
                    'field' => 'discipline_code',
                    'label' => 'discipline code',
                    'rules' => 'trim|required|is_unique[council_qbm_discipline_master.discipline_code]'
                )
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'qbm_master/discipline_list_view', $data);
            
		    } else {
				
                    $post_data = array(
                        //'course_id_fk'              => $this->input->post('course_id'),
                        'discipline_name'           => $this->input->post('discipline_name'),
                        'discipline_code'           => $this->input->post('discipline_code'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                        'active_status'             => 1
                    );

                    $last_id = $this->discipline_model->insert_discipline_data($post_data);
					
                    if($last_id)
                    {
						
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Discipline added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/qbm_master/discipline');
                    //$this->load->view($this->config->item('theme').'qbm_master/discipline_list_view', $data);
            }
        
        
    }


    public function discipline_course_map(){
        //$this->output->enable_profiler(TRUE);
        $data = array(
            'course_list' => $this->discipline_model->getAllcourse(),
            'course_discipline_map_list' => $this->discipline_model->get_course_discipline_map(),
            'disciplineList' => $this->discipline_model->getAll_discipline()
        );

       //echo '<pre>'; print_r($data['course_discipline_map_list']); echo '</pre>';
        
        

        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required|numeric'
                ),
                
                array(
                    'field' => 'discipline_id',
                    'label' => 'Discipline',
                    'rules' => 'trim|required|callback_same_course_discipline_check'
                ),
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'qbm_master/discipline_course_map_view', $data);
            
		    } else {
				$discipline_id = $this->input->post('discipline_id');
				$course_id      = $this->input->post('course_id');
				
                    
						
                        $post_data = array(
                                'course_id_fk'      => $course_id,
                                'discipline_id_fk'  => $discipline_id,
								'entry_ip'          => $this->input->ip_address(),
								'inserted_by'       => $this->session->userdata('stake_holder_login_id_pk'),
								'entry_time'        => 'now()'
                            );
                        $this->discipline_model->map_course_discipline($post_data);
						
						
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Course Discipline Mapped successfully.');
                   
                    redirect('admin/qbm_master/discipline/discipline_course_map');
                
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'qbm_master/discipline_course_map_view', $data);
        }
    }

    public function same_course_discipline_check(){
        $course_id = $this->input->post('course_id');
        $discipline_id = $this->input->post('discipline_id');
		if($course_id!='' and $discipline_id!=''){
        $data_count=$this->discipline_model->get_same_course_discipline_data($course_id,$discipline_id)[0]['count'];
        //print_r($data_count);die;
		if($data_count == 0){
            return TRUE;
        } else {
            $this->form_validation->set_message('same_course_discipline_check', 'The {field} is already mapping with Course ');
            return FALSE;
        }
	}
		
	}

    

}


/* End of file master_trainer.php */
?>