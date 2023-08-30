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

    public function trnsfer_registration(){
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
                    
                )
                // array(
                //     'field' => 'transfer_for',
                //     'label' => 'Transfer For',
                //     'rules' => 'trim|required',
                    
                // )
                // array(
                //     'field' => 'tfw',
                //     'label' => 'TFW',
                //     'rules' => 'trim|required',
                    
                // ),
                // array(
                //     'field' => 'new_password',
                //     'label' => 'New Password',
                //     'rules' => 'required|callback_is_password_strong'
                // ),
                // array(
                //     'field' => 'confirm_password',
                //     'label' => 'Confirm Password',
                //     'rules' => 'matches[new_password]'
                // )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
                
            } else {

               $check_govt_inst = $this->transfer_model->check_govt_inst($this->input->post('std_id'));
                if($check_govt_inst['transfer_status'] != 1){
                    if($check_govt_inst['institute_category_id_fk'] != 4){

                        $mobile_otp = rand(100000, 999999);
                        
                        $data_array = array(
                            'student_id_pk'         => $check_govt_inst['institute_student_details_id_pk'],
                            'spot_id'         => $check_govt_inst['spotcouncil_student_details_id_fk'],
                            'reg_no'           => $this->input->post('reg_no'),
                            'transfer_status'          => 1,
                            //'transfer_for'              => $this->input->post('transfer_for'),
                            'entry_time' => 'now()',
                            'mobile_otp' => $mobile_otp,
                            'mobile_no'  => $this->input->post('mobile'),
                            'student_name' => $this->input->post('std_name')
                        );
                        $this->session->set_userdata('std_data', $data_array);
                        if($data_array){

                            $sms_message = "Your OTP for Online Transfer Application in the Transfer portal of sctvesd.wb.gov.in is" . $mobile_otp;
                            $template_id = 0;
                            $status = $this->sms->send($this->input->post('mobile'), $sms_message, $template_id);

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Successfully enrolled, We have sent you a OTP on your Mobile No. Please verify your Mobile.');
                            redirect('polytechnic/transfer/mobile_verify/'.md5($check_govt_inst['institute_student_details_id_pk']));
        
                        }else{
                            redirect('polytechnic/transfer/trnsfer_registration');
                        }
        
                    }else{
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'You are not Applicable for transfer.');
                        $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
                    }
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'You are already enrolled for transfer , Please Login your credential.');
                    $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
                }

            }
        }else{

            $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/registration_view');
        }
    }

    public function mobile_verify($id_hash = NULL)
    {

        //echo "<pre>";print_r($this->session->userdata('ins_data'));exit;
        if ($id_hash) {
            //echo $id_hash;exit;
            // $insDetails  = $this->affiliation_model->getInsDetailsByIdHash($id_hash);
            // if (empty($insDetails)) {

                //if ($insDetails[0]['mobile_verify_status'] == 0) {
                    $std_data = $this->session->userdata('std_data');
                    //echo "<pre>";print_r($std_data);die;
                    $data['id']     = $id_hash;
                    $data['otp']    = $std_data['mobile_otp'];
                    $data['spot_id']    = $std_data['spot_id'];
                    $data['reg_no']    = $std_data['reg_no'];
                    $data['mobile'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $std_data['mobile_no']);

                    if ($this->input->server('REQUEST_METHOD') == 'POST') {

                        $this->load->library('form_validation');
                        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                        $config = array(
                            array(
                                'field' => 'otp',
                                'label' => 'OTP',
                                'rules' => 'trim|required|exact_length[6]|numeric',
                            )
                        );
                        $this->form_validation->set_rules($config);

                        if ($this->form_validation->run() != FALSE) {

                            $otp = $this->input->post('otp');
                            if ($otp == $data['otp']) {

                                $upd_data = array(
                                    'transfer_status'          => 1,
                                    //'transfer_for'              =>$std_data['transfer_for'],
                                    'transfer_entry_time' => 'now()'
                                );

                                //echo "<pre>";print_r($data_array);exit;
                                
                                $status = $this->transfer_model->updateStdDetails($std_data['student_id_pk'],$upd_data);

                                if ($status) {

                                   
                                    $username = $data['reg_no'];
                                    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                                    $codeAlphabet .= "0123456789";

                                    $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                                    $credentials = array(
                                        'stake_id_fk'          => 29,
                                        'login_id'             => $username,
                                        'login_password'       => hash("sha256", $login_password),
                                        'activation_date'      => 'now()',
                                        'active_status'        => 1,
                                        'entry_time'           => 'now()',
                                        'entry_ip'             => $this->input->ip_address(),
                                        'stake_holder_details' => $std_data['student_name'],
                                        'stake_details_id_fk'  => $std_data['spot_id'],
                                        'base_password'        => $login_password,
                                        'base_login_id'        => $username,
                                        'mobile_no'                 => $std_data['mobile_no']
                                    );
                                    


                                    $insertResult = $this->transfer_model->insertData('council_stake_holder_login', $credentials);
                                    if ($insertResult) {

                                        // ! Send credentials on email
                                        //$this->load->helper('email_helper');

                                        $data = array(
                                            'user_name' => $credentials['base_login_id'],
                                            'password'  => $credentials['base_password'],
                                        );

                                        $sms_message = "Password for Online Transfer Application in the Transfer portal of sctvesd.wb.gov.in is Login ID:".$credentials['base_login_id']." Password:" . $credentials['base_password'];
                                        $template_id = 0;
                                        $status = $this->sms->send($std_data['mobile_no'], $sms_message, $template_id);

                                        if ($status) {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Verified successfully, Login credentials sent to Your Mobile No.');
                                            redirect('admin/login');
                                        } else {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you sms.<br> Username: ' . $data['user_name'] . '<br> Password: ' . $data['password']);
                                            redirect('polytechnic/transfer/transfer_registration');
                                        }

                                        
                                    } else {

                                        $this->session->set_flashdata('status', 'danger');
                                        $this->session->set_flashdata('alert_msg', 'Unable to create credentials, Please contact to council admin.');

                                        redirect('polytechnic/transfer/mobile_verify/' . $id_hash);
                                    }
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('polytechnic/transfer/mobile_verify/' . $id_hash);
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('polytechnic/transfer/mobile_verify/' . $id_hash);
                            }
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'polytechnic_student_transfer/transfer_mobile_verify_view', $data);
                //}
            // } else {
            //     redirect(base_url());
            // }
        } else {
            redirect(base_url());
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