<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfer extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('polytechnic/transfer_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri').'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
            3  => $this->config->item('theme_uri').'councils/css/autocomplete-jquery-ui.css',
        );
		
		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'councils/js/datepicker.js',
            //2  => $this->config->item('theme_uri').'councils/js/custom/polytechnic/affiliation.js',
            2  => $this->config->item('theme_uri').'councils/js/select2.full.min.js',
            3  => $this->config->item('theme_uri').'councils/js/autocomplete-jquery-ui.min.js',
        );

        $this->load->helper('email');
        $this->load->library('sms');

        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/transfer_view');
    }

    public function trnsfer_registration_wait(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $config = array(
                array(
                    'field' => 'reg_no',
                    'label' => 'Registration Number',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'std_name',
                    'label' => 'Student Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'mobile',
                    'label' => 'Mobile No',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'transfer_for',
                    'label' => 'Transfer For',
                    'rules' => 'trim|required',
                    
                ),
                array(
                    'field' => 'tfw',
                    'label' => 'TFW',
                    'rules' => 'trim|required',
                    
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

                $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
                
            } else {

               $check_govt_inst = $this->transfer_model->check_govt_inst($this->input->post('std_id'));

                if($check_govt_inst['institute_category_id_fk'] != 4){
                   
                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction
                    $insert_log_array = array(
                        
                        'stake_id_fk' 			   => 29,
                        'active_status' 		   => 1,
                        'entry_time'			   => 'now()',
                        'entry_ip'				   => $this->input->ip_address(),
                        'stake_holder_details' 	   => $this->input->post('std_name'),
                        'stake_details_id_fk'	   => $this->input->post('spot_id'),
                        'login_id'	                 => $this->input->post('reg_no'),
                        'base_login_id'	   => $this->input->post('reg_no'),
                        'base_password'             => $this->input->post('new_password'),
                        'login_password'            => hash('sha256',($this->input->post('new_password'))),
                        'mobile_no'                 => $this->input->post('mobile')

                    );

                    $login_id = $this->transfer_model->insertData('council_stake_holder_login', $insert_log_array);
                    if($login_id){
                        $updateArray = array(
                            'transfer_status'          => 1,
                            'transfer_for'              => $this->input->post('transfer_for'),
                            'tfw'                       => $this->input->post('tfw')
                        );
                        $status = $this->transfer_model->updateStdDetails($this->input->post('std_id'), $updateArray);

                        // ! Check All Query For Trainee
                        if ($this->db->trans_status() === FALSE) { 
                            # Something went wrong.
                            $this->db->trans_rollback();

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to create login credential at this time, Please try later.');
                            $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
                        } else {
                            # Everything is Perfect. Committing data to the database.
                            $this->db->trans_commit();

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Login details has been added successfully.');
                            redirect('/admin');
                        }
                    }
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'You are not Applicable for transfer.');
                    $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
                }

            }
        }else{

            $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
        }
    }

    public function getStudentName($reg_no){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // $registration_for = $this->input->get('registration_for');

           //$check_reg_no = $this->transfer_model->checkregNo($reg_no);

            $stdDetails = $this->transfer_model->getStudentDetailsByRegNo($reg_no);
            if (!empty($stdDetails)) {

                $output = array(
                    'name' => $stdDetails['first_name'] .' '. $stdDetails['middle_name'] . ' '. $stdDetails['last_name'],
                    'mobile' => $stdDetails['mobile_number'],
                    'institute_student_details_id_pk' => $stdDetails['institute_student_details_id_pk'],
                    'spotcouncil_student_details_id_fk' => $stdDetails['spotcouncil_student_details_id_fk'],
                    'dob'       => date('d/m/Y',strtotime($stdDetails['date_of_birth']))

                );
                $ajaxResponse = array(
                    'ok'     => 1,
                    'data'   => $output,
                    'msg'    => '',
                );
            }else{
                $ajaxResponse = array(
                    'ok'     => 2,
                    'data'  => array(),
                    'msg'    => 'Oops! Data not found..',
                );
            }
            echo json_encode($ajaxResponse);
            

            
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