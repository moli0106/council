<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Change_password extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(12);
        $this->load->model('password/Change_password_model');
        // $this->output->enable_profiler();
    } 

    public function index(){

        $this->load->helper('form');
        $this->load->library('form_validation');
		
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $config = array(
			array(
				'field' => 'old_password',
				'label' => 'Old Password',
				'rules' => 'callback_check_old_password'
			),
			array(
				'field' => 'new_password',
				'label' => 'New Password',
                'rules' => 'required|callback_is_password_strong'
			),
			array(
				'field' => 'confirm_password',
				'label' => 'Confirm Password',
				'rules' => 'matches[new_password]'
			)
		);
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == FALSE) {

            $this->load->view($this->config->item('theme').'password/change_password_view', array());
            
		} else {

            $update_array = array(
                "base_password"  => $this->input->post('new_password'),
                "login_password" => hash('sha256',($this->input->post('new_password'))),
                "update_time"    => date('Y-m-d h:i:s'),
                "password_reset_link_status" => 0
            );

            $result = $this->Change_password_model->change_password($update_array);

            if($result){

                $login_details = $this->Change_password_model->getLoginDetails();

                $insert_log_array = array(
                    'stake_holder_login_id_pk' => $login_details[0]['stake_holder_login_id_pk'],
                    'stake_id_fk' 			   => $login_details[0]['stake_id_fk'],
                    'admin_level_id_fk'		   => $login_details[0]['admin_level_id_fk'],
                    'activation_date'		   => $login_details[0]['activation_date'],
                    'active_status' 		   => $login_details[0]['active_status'],
                    'entry_time'			   => $login_details[0]['entry_time'],
                    'update_time' 			   => $login_details[0]['update_time'],
                    'entry_ip'				   => $login_details[0]['entry_ip'],
                    'stake_holder_details' 	   => $login_details[0]['stake_holder_details'],
                    'stake_details_id_fk'	   => $login_details[0]['stake_details_id_fk'],
                    'update_ip' 			   => $login_details[0]['update_ip'],
                    'login_password'		   => $login_details[0]['login_password'],
                    'browser_details'		   => $this->input->user_agent()
                );
                $this->Change_password_model->insertLoginLogDetails($insert_log_array);

                $this->session->set_userdata('login_password', $update_array['new_password_hash']);
                
                $this->session->set_flashdata('status','success');
                $this->session->set_flashdata('alert_msg','Password updated successfully.');

                redirect(base_url().'admin/password/change_password');
            } else {
                
                $this->session->set_flashdata('status','error');
                $this->session->set_flashdata('alert_msg','Unable to update password.'); 

                redirect(base_url().'admin/password/change_password');
            }
		}

    }

    public function check_old_password($password = '')
    {
        $password = trim($password);
        
        if (empty($password))
        {
            $this->form_validation->set_message('check_old_password', 'The {field} field is required.');
            return FALSE;
        }

        $result = $this->Change_password_model->getLoginDetails();

        if($result[0]['login_password'] != hash('sha256',($password)))
        {
            $this->form_validation->set_message('check_old_password', 'The {field} did not matched.');
            return FALSE;
        }
        return TRUE;
    }

    public function is_password_strong($password = '')
    {
        $password        = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number    = '/[0-9]/';
        $regex_special   = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        
        if (empty($password))
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 8)
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field must be at least 5 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 15)
        {
            $this->form_validation->set_message('is_password_strong', 'The {field} field cannot exceed 32 characters in length.');
            return FALSE;
        }
        return TRUE;
    }

}
