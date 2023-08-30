<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_creator_moderator extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(87);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('qbm_master/question_creator_moderator_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'qbm_master/question_creator_moderator.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'qbm_master/question_creator_moderator/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->question_creator_moderator_model->get_creator_moderatorCount()[0]['count'];	
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
        $data['trainerList'] = $this->question_creator_moderator_model->getAll_question_creator_moderator($config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'qbm_master/question_creator_moderator/question_creator_moderator_list_view', $data);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            //'sector_list' => $this->question_creator_moderator_model->getAllSector(),
            'course_list' => $this->question_creator_moderator_model->getAllcourse(),
            //'sub_group_list' => $this->question_creator_moderator_model->getAllsubGroup()
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
                    'rules' => 'trim|required|valid_email|is_unique[council_qbm_question_creator_moderator_details.email_id]'
                ),
                array(
                    'field' => 'mobile',
                    'label' => 'Mobile Number',
                    'rules' => 'trim|required|max_length[10]|min_length[10]|regex_match[/^[0-9]{10}$/]|is_unique[council_qbm_question_creator_moderator_details.mobile_no]'
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
                    'field' => 'course_id',
                    'label' => 'course',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'discipline_id',
                    'label' => 'discipline',
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

                $this->load->view($this->config->item('theme').'qbm_master/question_creator_moderator/question_creator_moderator_add_view', $data);
            
		    } else {
				
				
                    $post_data = array(
                        'fname'                     => $this->input->post('f_name'),
                        'mname'                     => $this->input->post('m_name'),
                        'lname'                     => $this->input->post('l_name'),
                        'email_id'                  => $this->input->post('email'),
                        'mobile_no'                 => $this->input->post('mobile'),
                        'designation'               => $this->input->post('designation'),
                        'creator_moderator_type'    => $this->input->post('creator_moderator_type'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                        'active_status'             => 1
                    );

                    $last_id = $this->question_creator_moderator_model->insert_question_creator_moderator($post_data);
					
                    if($last_id)
                    {
                        $mapArray = array(
                            'creator_moderator_id_fk'   => $last_id,
                            'course_id_fk'              => $this->input->post('course_id'),
                            'discipline_id_fk'          => $this->input->post('discipline_id'),
                            'subject_id_fk'             => $this->input->post('subject_id'),
                            'insert_ip'                 => $this->input->ip_address(),
                            'insert_by'                 => $this->session->userdata('stake_holder_login_id_pk'),
                            'insert_time'               => 'now()'
                        );
                        $this->question_creator_moderator_model->map_question_creator_moderator_subject($mapArray);
						
                        // Create Credentials
                        if($this->input->post('course_id') == 1 || $this->input->post('course_id') == 2){
                            $course = 'HS';
                        }else if($this->input->post('course_id') == 3){
                            $course = 'PO';
                        }else{
                            $course = 'PH';
                        }
                        if($this->input->post('creator_moderator_type')==19){
                            $qcmt='QC';
                        }else{
                            $qcmt='QM';
                        }
                        
                        $last_login_id = sprintf("%06d", $last_id);
                        $login_id = $course.$qcmt.$last_login_id;

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
						
						$update_qcm_code = array(
                            'creator_moderator_code'    => $login_id
                        );

                        $insertResult = $this->question_creator_moderator_model->insert_question_creator_moderator_credentials($qcmt_Credentials);
						$updateqcm_code_result = $this->question_creator_moderator_model->update_update_qcm_code($last_id, $update_qcm_code);
						
                        $data = array(
                            'url'  => base_url('admin'),
                            'name' => $qcmt_Credentials['stake_holder_details'],
                            'base_password' => $qcmt_Credentials['base_password'],
                            'base_login_id' => $qcmt_Credentials['base_login_id'],
                        );
                        $this->load->helper('email');
    
                        $email_subject = "Credentials For Council Question Creator/Moderator Account";
                        $email_message = $this->load->view($this->config->item('theme').'qbm_master/question_creator_moderator/email_question_creator_moderator_credentials', $data, TRUE);

                        //send_email($this->input->post('email'), $email_message, $email_subject);
						
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Question Creator/Moderator added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/qbm_master/question_creator_moderator');
                
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'qbm_master/question_creator_moderator/question_creator_moderator_add_view', $data);
        }
    }


    public function get_discipline($course_code)
	{
		if(is_numeric($course_code))
		{
		$data['disciplineList'] = $this->question_creator_moderator_model->getDisciplineList($course_code);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/discipline_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

    
    public function get_subject($discipline_id)
	{
		if(is_numeric($discipline_id))
		{
		$data['subjectList'] = $this->question_creator_moderator_model->get_subject_List($discipline_id);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/subject_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}
	
	public function add_more_subject($id_hash = NULL)
    {
        if (!empty($id_hash)) {
            $data['qcm_details'] = $this->question_creator_moderator_model->get_question_cm_details($id_hash)[0];

            if (!empty($data['qcm_details'])) {
                $data['qcm_subject'] =  $this->question_creator_moderator_model->get_qcm_subject_details($id_hash);
                
                $data['course_list'] = $this->question_creator_moderator_model->getAllcourse();

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'course_id',
                            'label' => 'Course',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'discipline_id',
                            'label' => 'Discipline',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'subject_id',
                            'label' => 'Subject',
                            'rules' => 'trim|required|numeric'
                        ),
                    );
                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == TRUE) {
                        $result = $this->question_creator_moderator_model->verify_qcm_subject($data['qcm_details']['creator_moderator_id_pk'],$this->input->post('subject_id'))[0];

                        //print_r($result);
                        //echo $result['count'];die;
                        if ($result['count']==0) {
                            $dataArray = array(
                                'creator_moderator_id_fk'   => $data['qcm_details']['creator_moderator_id_pk'],
                                'course_id_fk'              => $this->input->post('course_id'),
                                'discipline_id_fk'          => $this->input->post('discipline_id'),
                                'subject_id_fk'             => $this->input->post('subject_id'),
                                'insert_ip'                 => $this->input->ip_address(),
								'insert_by'                 => $this->session->userdata('stake_holder_login_id_pk'),
								'insert_time'               => 'now()',
								'active_status'             => 1
                                
                            );

                            $status = $this->question_creator_moderator_model->insertSubject($dataArray);
                            if ($status) {

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Subject added successfully.');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                            }

                            redirect('admin/qbm_master/question_creator_moderator/add_more_subject/' . md5($data['qcm_details']['creator_moderator_id_pk']));
                        } else {
                            $this->session->set_flashdata('status', 'warning');
                            $this->session->set_flashdata('alert_msg', 'Oops! This Subject Already exists ');

                            redirect('admin/qbm_master/question_creator_moderator/add_more_subject/' . md5($data['qcm_details']['creator_moderator_id_pk']));
                        }
                    }
                }
                $this->load->view($this->config->item('theme') . 'qbm_master/question_creator_moderator/question_creator_moderator_update_view', $data);
            } else {
                redirect('admin/qbm_master/question_creator_moderator');
            }
        } else {
            redirect('admin/qbm_master/question_creator_moderator');
        }
    }
	
	
	
	
	
	






















    //Update status
    public function change_creator_moderator_status($id_hash = NULL)
    {
        $results = $this->question_creator_moderator_model->get_question_cm_details($id_hash);
        $stake_id_fk=$results[0]['creator_moderator_type'];
        $updateArray  = array('active_status' => $this->input->get('updateStatus'));
        $updateResult1 = $this->question_creator_moderator_model->update_creator_moderator($id_hash, $updateArray);
        if($updateResult1)
        {
            $updateArray  = array('active_status' => ($this->input->get('updateStatus') == 2) ? 0 : 1);
            $updateResult2 = $this->question_creator_moderator_model->stakeHolderLogin($id_hash, $updateArray,$stake_id_fk);
            echo json_encode($id_hash);
        }
    }

    //Get Job Role and Sector
    public function getSector()
    {
        $rowId = $this->input->get('rowId');

        if($rowId)
        {
            $rawHtml     = '';
            $results = $this->question_creator_moderator_model->getSector($rowId);

            if(count($results))
            {
                $count = 0;
                foreach ($results as $key => $result) 
                {
                    $rawHtml .= '
                        <tr>
                            <td>'.++$count.'</td>
                            <td>'.$result['sector_name'].'</td>
                        </tr>
                    ';
                }
            } else {
                $rawHtml .= '<tr><td colspan="3" align="center">No data found...</td></tr>';
            }

            echo json_encode($rawHtml);
        }
    }




    //Update one item
    public function update_sector($id_hash = NULL)
    {
        if (!empty($id_hash)) {
            $data['qcm_details'] = $this->question_creator_moderator_model->get_question_cm_details($id_hash)[0];

            if (!empty($data['qcm_details'])) {
                $data['sectors'] =  $this->question_creator_moderator_model->getSector($id_hash);
                ;
                $data['sector_list']   = $this->question_creator_moderator_model->getAllSector();

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $sector_id = $this->input->post('sector_id');

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'sector_id',
                            'label' => 'Sector',
                            'rules' => 'trim|required|numeric'
                        ),
                    );
                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == TRUE) {
                        $result = $this->question_creator_moderator_model->verify_qcm_sector($data['qcm_details']['creator_moderator_id_pk'],$this->input->post('sector_id'))[0];

                        //print_r($result);
                        //echo $result['count'];die;
                        if ($result['count']==0) {
                            $dataArray = array(
                                'creator_moderator_id_fk' => $data['qcm_details']['creator_moderator_id_pk'],
                                'sector_id_fk'         => $this->input->post('sector_id'),
                                'insert_ip'            => $this->input->ip_address(),
								'insert_by'            => $this->session->userdata('stake_holder_login_id_pk'),
								'insert_time'          => 'now()',
								'active_status'        => 1
                                
                            );

                            $status = $this->question_creator_moderator_model->insertSectorJobRole($dataArray);
                            if ($status) {

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Sector & Job Role added successfully.');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                            }

                            redirect('admin/master/question_creator_moderator/update_sector/' . md5($data['qcm_details']['creator_moderator_id_pk']));
                        } else {
                            $this->session->set_flashdata('status', 'warning');
                            $this->session->set_flashdata('alert_msg', 'Oops! This Sector Already exists ');

                            redirect('admin/master/question_creator_moderator/update_sector/' . md5($data['qcm_details']['creator_moderator_id_pk']));
                        }
                    }
                }
                $this->load->view($this->config->item('theme') . 'master/question_creator_moderator/question_creator_moderator_update_view', $data);
            } else {
                redirect('admin/master/question_creator_moderator');
            }
        } else {
            redirect('admin/master/question_creator_moderator');
        }
    }

    //Update status
    public function changeJobRoleStatus($id_hash = NULL)
    {
        $updateArray  = array('active_status' => ($this->input->get('updateStatus') == 2) ? 0 : 1);
        $status = $this->question_creator_moderator_model->updateJobRole($id_hash, $updateArray);
        if ($status) {
            echo json_encode($id_hash);
        }
    }

}


/* End of file master_trainer.php */
?>