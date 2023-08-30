<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_creator_moderator_jexpo extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(41);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/Question_creator_moderator_jexpo_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'master/question_creator_moderator_jexpo.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'master/question_creator_moderator_jexpo/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->Question_creator_moderator_jexpo_model->get_creator_moderatorCount()[0]['count'];	
		$config['per_page']         = 10;
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
        $data['trainerList'] = $this->Question_creator_moderator_jexpo_model->getAll_question_creator_moderator($config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'master/question_creator_moderator_jexpo/question_creator_moderator_list_view', $data);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            'exam_type_list' => $this->Question_creator_moderator_jexpo_model->getAllExamType()
        );

        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'f_name',
                    'label' => 'First Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'l_name',
                    'label' => 'Last Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'email',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email|is_unique[council_question_creator_moderator_jexpo_details.email_id]'
                ),
                array(
                    'field' => 'mobile',
                    'label' => 'Mobile Number',
                    'rules' => 'trim|required|max_length[10]|min_length[10]|regex_match[/^[0-9]{10}$/]|is_unique[council_question_creator_moderator_jexpo_details.mobile_no]'
                ),
                array(
                    'field' => 'designation',
                    'label' => 'Designation',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'creator_moderator_type',
                    'label' => 'Question Creator/Moderator',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'exam_type',
                    'label' => 'exam type',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'subject_id',
                    'label' => 'subject',
                    'rules' => 'trim|required|numeric'
                ),
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {
                if(set_value('exam_type') != NULL){
					
                    $data['subjects'] = $this->Question_creator_moderator_jexpo_model->get_subject_query(set_value('exam_type'));
                }
                $this->load->view($this->config->item('theme').'master/question_creator_moderator_jexpo/question_creator_moderator_add_view', $data);
            
		    } else {
                //$sector_code=$this->Question_creator_moderator_jexpo_model->get_sector_code($this->input->post('sector_id'))[0];
                    $post_data = array(
                        'fname'                     => $this->input->post('f_name'),
                        'mname'                     => $this->input->post('m_name'),
                        'lname'                     => $this->input->post('l_name'),
                        'email_id'                  => $this->input->post('email'),
                        'mobile_no'                 => $this->input->post('mobile'),
                        'designation'               => $this->input->post('designation'),
                        'creator_moderator_type'    => $this->input->post('creator_moderator_type'),
                        'exam_type_id_fk'           => $this->input->post('exam_type'),
                        'subject_id_fk'             => $this->input->post('subject_id'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                        'active_status'             => 1
                    );

                    $last_id = $this->Question_creator_moderator_jexpo_model->insert_question_creator_moderator($post_data);
                    
                    if($last_id)
                    {
                        // Create Master Trainer Credentials
                        if($this->input->post('creator_moderator_type')==10){
                            $qcmt='JVQC';
                            $qcm='JVP';
                            
                        }else{
                            $qcmt='JVQM';
                            $qcm='JVM';
                        }

                       // $creator_moderator_code= $sector_code['sector_code'].$qcm.sprintf("%05d", $last_id);

                        $login_id = substr(ucfirst($this->input->post('f_name')), 0, 1);
                        $login_id.= substr(ucfirst($this->input->post('l_name')), 0, 1).$qcmt;
                        $login_id.= sprintf("%05d", $last_id);

                        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
                        $codeAlphabet.= "0123456789";
                        
                        $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                        $qcmt_Credentials = array(
                            'stake_id_fk'          => $this->input->post('creator_moderator_type'),
                            'login_id'             => $login_id,
                            'login_password'       => hash("sha256", $login_password),
                            'activation_date'      => 'now()',
                            'active_status'        => 1,
                            'entry_time'           => 'now()',
                            'entry_ip'             => $this->input->ip_address(),
                            'stake_holder_details' => $this->input->post('f_name').' '.$this->input->post('m_name').' '.$this->input->post('l_name'),
                            'stake_details_id_fk'  => $last_id,
                            'base_password'        => $login_password,
                            'base_login_id'        => $login_id,
                        );

                        // $update_qcm_code = array(
                        //     'creator_moderator_code'    => $creator_moderator_code
                        // );

                        $insertResult = $this->Question_creator_moderator_jexpo_model->insert_question_creator_moderator_credentials($qcmt_Credentials);
                        //$updateqcm_code_result = $this->Question_creator_moderator_jexpo_model->update_update_qcm_code($last_id, $update_qcm_code);

                        $data = array(
                            'url'  => base_url('admin'),
                            'name' => $qcmt_Credentials['stake_holder_details'],
                            'base_password' => $qcmt_Credentials['base_password'],
                            'base_login_id' => $qcmt_Credentials['base_login_id'],
                        );
                        $this->load->helper('email');
    
                        $email_subject = "Credentials For JEXPO/VOCLET Question Creator/Moderator Account";
                        $email_message = $this->load->view($this->config->item('theme').'master/question_creator_moderator/email_question_creator_moderator_credentials', $data, TRUE);

                        send_email($this->input->post('email'), $email_message, $email_subject);
						
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Question Creator/Moderator added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/master/question_creator_moderator_jexpo');
                
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'master/question_creator_moderator_jexpo/question_creator_moderator_add_view', $data);
        }
    }

    //Update one item
    public function update( $id = NULL )
    {

    }


    //Update status
    public function change_creator_moderator_status($id_hash = NULL)
    {
        $updateArray  = array('active_status' => $this->input->get('updateStatus'));
        $updateResult1 = $this->Question_creator_moderator_jexpo_model->update_creator_moderator($id_hash, $updateArray);
        if($updateResult1)
        {
            $updateArray  = array('active_status' => ($this->input->get('updateStatus') == 2) ? 0 : 1);
            $updateResult2 = $this->Question_creator_moderator_jexpo_model->stakeHolderLogin($id_hash, $updateArray);
            echo json_encode($id_hash);
        }
    }

    public function get_subject($exam_type)
	{
		if(is_numeric($exam_type))
		{
		$data['subjects'] = $this->Question_creator_moderator_jexpo_model->get_subject_query($exam_type);
		$this->load->view($this->config->item('theme').'master/question_creator_moderator_jexpo/subject_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

}
/* End of file master_trainer.php */
?>