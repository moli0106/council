<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forgot_password extends NIC_Controller 
{
	function __construct()
	{
        parent::__construct();
        $this->load->model('password/Change_password_model');
        // $this->output->enable_profiler();
    } 

    public function index(){

        $data['stake_holder_master'] = $stake_holder_master = $this->Change_password_model->get_stake_holder_master();

        $this->load->helper('form');
        $this->load->library('form_validation');
		
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $config = array(
			array(
				'field' => 'user_type',
				'label' => 'User Type',
				'rules' => 'trim|required'
            ),
            array(
				'field' => 'login_id',
				'label' => 'Username',
				'rules' => 'trim|required|max_length[100]'
            ),
            array(
				'field' => 'email_id',
				'label' => 'Email Address',
				'rules' => 'trim|required|valid_email'
            )
		);
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == FALSE) {
            
			$this->load->view($this->config->item('theme') . 'password/forgot_password_view', $data);
            
		} else {

            // $user_type = $this->input->post('user_type');

            $condition_array = array(
                'login_id' => $this->input->post('login_id'),
                'email_id' => $this->input->post('email_id')
            );

            $result = array();

            if($this->input->post('user_type') == 3)
            {
                $result = $this->Change_password_model->vefify_assessor_user($condition_array);
            }

            if(count($result)){

                $id = $result[0]['id'];
                $id_hash  = md5($id);
                // $login_id = $result[0]['login_id'];
                $random_id = rand(100, 999);
                
                $data = array(
                    'name'       => $result[0]['name'],
                    'reset_link' => base_url('admin/password/reset_password/'.$random_id.'/'.$id_hash),
                );

                $this->load->helper('email');

                $email_subject = "Council Reset Password Link";
				$email_message = $this->load->view($this->config->item('theme').'password/reset_password_link_email_template', $data, TRUE);

                send_email($this->input->post('email_id'), $email_message, $email_subject);

                $this->Change_password_model->update_password_link_status($id);

                redirect(base_url('admin/password/forgot_password/sent_link'));

            } else {
                $this->session->set_flashdata('alert_msg', 'User not exist in our system.');
                redirect(base_url('admin/password/forgot_password'));
            }
		}

    }

    public function sent_link(){
        
        $data = array(
            'login_id' => '',
            'id_hash'  => '',
        );

        $this->load->view($this->config->item('theme') . 'password/reset_password_view', $data);
    }

}
