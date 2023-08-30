<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset_password extends NIC_Controller 
{
	function __construct()
	{
        parent::__construct();
        $this->load->model('password/Change_password_model');
        // $this->output->enable_profiler();
    } 

    public function index(){

        $random_id = $this->uri->segment(3);
        $id_hash  = $this->uri->segment(4);
        
        $result = $this->Change_password_model->get_assessor_by_login_id_pk($id_hash);

        if( (count($result) > 0) && ($id_hash == md5($result[0]['stake_holder_login_id_pk']))){
            if($result[0]['password_reset_link_status'] == 1){

                $this->load->helper('form');
                $this->load->library('form_validation');
                
                $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                $config = array(
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

                    $data = array(
                        'login_id' => $random_id,
                        'id_hash'  => $id_hash,
                    );

                    $this->load->view($this->config->item('theme') . 'password/reset_password_view', $data);
                    
                } else {

                    $update_array = array(
                        "new_password"      => $this->input->post('new_password'),
                        "new_password_hash" => hash('sha256',($this->input->post('new_password'))),
                        "stake_holder_id"   => $result[0]['stake_holder_login_id_pk']
                    );
        
                    $update_status = $this->Change_password_model->reset_password_with_status($update_array);

                    if($update_status){

                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','Password updated.'); 
        
                        redirect(base_url('admin'));
                        
                    } else {
                        
                        $this->session->set_flashdata('status','error');
                        $this->session->set_flashdata('alert_msg','Unable to update password.'); 
        
                        redirect(base_url('admin'));
                    }

                }

            } else {
                
                $this->session->set_flashdata('status','error');
                $this->session->set_flashdata('alert_msg','Link has been expired.'); 

                redirect(base_url('admin'));
            }
        } else {
            
            $this->session->set_flashdata('status','error');
            $this->session->set_flashdata('alert_msg','Invalid user.'); 

            redirect(base_url('admin'));
        }

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
