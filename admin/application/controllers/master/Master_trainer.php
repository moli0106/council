<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master_trainer extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(2);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/master_trainer_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'master/master_trainer.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'master/master_trainer/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->master_trainer_model->getTrainerCount()[0]['count'];	
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
        $data['trainerList'] = $this->master_trainer_model->getAllTrainer($config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'master/trainer/master_trainer_list_view', $data);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            'sector_list' => $this->master_trainer_model->getAllSector()
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
                    'rules' => 'trim|required|valid_email|is_unique[council_master_trainer.email]'
                ),
                array(
                    'field' => 'mobile',
                    'label' => 'Mobile Number',
                    'rules' => 'trim|required|max_length[10]|min_length[10]|regex_match[/^[0-9]{10}$/]|is_unique[council_master_trainer.mobile]'
                ),
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'master/trainer/master_trainer_add_view', $data);
            
		    } else {

                $courseIds = $this->input->post('course_id');
                $sectorIds = $this->input->post('sector_id');

                $courseArr = array_values($courseIds);
                $sectorArr = array_values($sectorIds);
                
                if (in_array(null, $courseArr) || in_array('', $courseArr) || in_array('', $sectorArr) || in_array('', $sectorArr))
                {
                    $this->session->set_flashdata('f_name', $this->input->post('f_name'));
                    $this->session->set_flashdata('m_name', $this->input->post('m_name'));
                    $this->session->set_flashdata('l_name', $this->input->post('l_name'));
                    $this->session->set_flashdata('email', $this->input->post('email'));
                    $this->session->set_flashdata('mobile', $this->input->post('mobile'));
                    $this->session->set_flashdata('sector_id', $this->input->post('sector_id'));

                    $data['status']  = 'danger';
                    $data['message'] = 'The Sector / Job Role field is required.';

                    $this->load->view($this->config->item('theme').'master/trainer/master_trainer_add_view', $data);
                }
                else
                {
                    $post_data = array(
                        'f_name'         => $this->input->post('f_name'),
                        'm_name'         => $this->input->post('m_name'),
                        'l_name'         => $this->input->post('l_name'),
                        'email'          => $this->input->post('email'),
                        'mobile'         => $this->input->post('mobile'),
                        'sector_id_fk'   => NULL,
                        'entry_ip'       => $this->input->ip_address(),
                        'inserted_by'    => $this->session->userdata('stake_id_fk'),
                        'entry_time'     => 'now()',
                        'active_status'  => 0,
                        'email_verified' => 0,
                        'mobile_verified'=> 0,
                    );

                    $last_id = $this->master_trainer_model->insertMasterTrainer($post_data);
                    if($last_id)
                    {
                        $mapArray = array();
                        foreach ($courseIds as $key => $courseId) 
                        {
                            $mapArray[] = array(
                                'master_trainer_id_fk' => $last_id,
                                'course_id_fk'         => $courseId,
                                'sector_id_fk'         => $sectorIds[$key],
								'entry_ip'                  => $this->input->ip_address(),
								'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
								'entry_time'                => 'now()'
                            );
                        }
                        $this->master_trainer_model->mapTrainerCourse($mapArray);

                        // Send verify link on email
                        $data = array(
                            'name' => $post_data['f_name'].' '.$post_data['m_name'].' '.$post_data['l_name'],
                            'url'  => base_url('admin/master/verify_trainer/email/'.md5($last_id)),
                        );

                        $this->load->helper('email');

                        $email_subject = "Verify Your Email For Council Master Trainer";
                        $email_message = $this->load->view($this->config->item('theme').'master/trainer/email_verify_template', $data, TRUE);
                        
                        send_email($this->input->post('email'), $email_message, $email_subject);

                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Master Trainer added successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/master/master_trainer');
                }
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'master/trainer/master_trainer_add_view', $data);
        }
    }

    //Get Job Role from Sector
    public function getJobRole()
    {
        $sector_id = $this->input->get('sector_id');

        if($sector_id)
        {
            $rawHtml     = '<option value="" hidden="true">Select Job Role</option>';
            $jobRoleList = $this->master_trainer_model->getJobRole($sector_id);

            if(count($jobRoleList))
            {
                foreach ($jobRoleList as $key => $jobRole) 
                {
                    $rawHtml .= '<option value="'.$jobRole['course_id_pk'].'">'.$jobRole['course_name'].' ('.$jobRole['course_code'].')</option>';
                }
            } else {
                $rawHtml .= '<option value="" disabled="true">No Data Found...</option>';
            }

            echo json_encode($rawHtml);
        }
    }
    
    //Get Job Role and Sector
    public function getSectorJobRole()
    {
        $rowId = $this->input->get('rowId');

        if($rowId)
        {
            $rawHtml     = '';
            $results = $this->master_trainer_model->getSectorJobRole($rowId);

            if(count($results))
            {
                $count = 0;
                foreach ($results as $key => $result) 
                {
                    $rawHtml .= '
                        <tr>
                            <td>'.++$count.'</td>
                            <td>'.$result['sector_name'].'</td>
                            <td>'.$result['course_name'].'</td>
                        </tr>
                    ';
                }
            } else {
                $rawHtml .= '<tr><td colspan="3" align="center">No data found...</td></tr>';
            }

            echo json_encode($rawHtml);
        }
    }

    //Update status
    public function changeTrainerStatus($id_hash = NULL)
    {
        $updateArray  = array('active_status' => $this->input->get('updateStatus'));
        $updateResult1 = $this->master_trainer_model->updateTrainer($id_hash, $updateArray);
        if($updateResult1)
        {
            $updateArray  = array('active_status' => ($this->input->get('updateStatus') == 2) ? 0 : 1);
            $updateResult2 = $this->master_trainer_model->stakeHolderLogin($id_hash, $updateArray);
            echo json_encode($id_hash);
        }
    }
	
	//Update one item
    public function update($id_hash = NULL)
    {
        if (!empty($id_hash)) {
            $data['masterTrainer'] = $this->master_trainer_model->getMasterTrainer($id_hash)[0];

            if (!empty($data['masterTrainer'])) {
                $data['sectorJobRole'] = $this->master_trainer_model->getSectorJobRole($id_hash);
                $data['sector_list']   = $this->master_trainer_model->getAllSector();
                $data['jobRoleList']   = array();

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $sector_id = $this->input->post('sector_id');
                    if (!empty($sector_id)) {
                        $data['jobRoleList'] = $this->master_trainer_model->getJobRole($sector_id);
                    }

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'sector_id',
                            'label' => 'Sector',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'course_id',
                            'label' => 'Job Role',
                            'rules' => 'trim|required|numeric'
                        )
                    );
                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == TRUE) {
                        $result = $this->master_trainer_model->verifyJobRole($this->input->post('sector_id'), $this->input->post('course_id'));

                        if (!empty($result)) {
                            $dataArray = array(
                                'master_trainer_id_fk' => $data['masterTrainer']['master_trainer_id_pk'],
                                'sector_id_fk'         => $this->input->post('sector_id'),
                                'course_id_fk'         => $this->input->post('course_id'),
								'entry_ip'                  => $this->input->ip_address(),
								'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
								'entry_time'                => 'now()',
                            );

                            $status = $this->master_trainer_model->insertSectorJobRole($dataArray);
                            if ($status) {

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Sector & Job Role added successfully.');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                            }

                            redirect('admin/master/master_trainer/update/' . md5($data['masterTrainer']['master_trainer_id_pk']));
                        } else {
                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');

                            redirect('admin/master/master_trainer/update/' . md5($data['masterTrainer']['master_trainer_id_pk']));
                        }
                    }
                }
                // parent::pre($data);
                $this->load->view($this->config->item('theme') . 'master/trainer/master_trainer_update_view', $data);
            } else {
                redirect('admin/master/master_trainer');
            }
        } else {
            redirect('admin/master/master_trainer');
        }
    }

    //Update status
    public function changeJobRoleStatus($id_hash = NULL)
    {
        $updateArray  = array('active_status' => ($this->input->get('updateStatus') == 2) ? 0 : 1);
        $status = $this->master_trainer_model->updateJobRole($id_hash, $updateArray);
        if ($status) {
            echo json_encode($id_hash);
        }
    }
	
	
	//Get Job Role from Sector for update trainer
    public function getJobRoleToUpdate()
    {
        $id_hash   = $this->input->get('id_hash');
        $sector_id = $this->input->get('sector_id');

        if (!empty($id_hash)) {
            $masterTrainer = $this->master_trainer_model->getMasterTrainer($id_hash)[0];

            if (!empty($masterTrainer)) {

                if (($sector_id != NULL) && (is_numeric($sector_id)) && ($sector_id > 0) && (!is_float($sector_id))) {

                    $sectorJobRole      = $this->master_trainer_model->getSectorJobRole(md5($masterTrainer['master_trainer_id_pk']));
                    $trainer_course_ids = array_column($sectorJobRole, 'course_id_pk');

                    $rawHtml     = '<option value="" hidden="true">Select Job Role</option>';
                    $jobRoleList = $this->master_trainer_model->getAllSectorNotIn($sector_id, $trainer_course_ids);

                    if (count($jobRoleList)) {
                        foreach ($jobRoleList as $key => $jobRole) {
                            $rawHtml .= '<option value="' . $jobRole['course_id_pk'] . '">' . $jobRole['course_name'] . ' (' . $jobRole['course_code'] . ')</option>';
                        }
                    } else {
                        $rawHtml .= '<option value="" disabled="true">No Data Found...</option>';
                    }

                    echo json_encode($rawHtml);
                }
            }
        }
    }

}
/* End of file master_trainer.php */
?>