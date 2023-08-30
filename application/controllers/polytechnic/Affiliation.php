<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('polytechnic/affiliation_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri').'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri').'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
            3  => $this->config->item('theme_uri').'councils/css/autocomplete-jquery-ui.css',
        );
		
		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'councils/js/datepicker.js',
            2  => $this->config->item('theme_uri').'councils/js/custom/polytechnic/affiliation.js',
            3  => $this->config->item('theme_uri').'councils/js/select2.full.min.js',
            4  => $this->config->item('theme_uri').'councils/js/autocomplete-jquery-ui.min.js',
        );

        $this->load->helper('email');
        $this->load->library('sms');

        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $this->load->view($this->config->item('theme') . 'polytechnic/affiliation_view');
    }

    public function registration(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $config = array(
                array(
                    'field' => 'ins_code',
                    'label' => 'Institute Code',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'ins_name',
                    'label' => 'Institute Name',
                    'rules' => 'trim|required|max_length[250]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'ins_email',
                    'label' => 'Institute Email',
                    'rules' => 'trim|required',
                    
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'polytechnic/registration_view');
                
            } else {

                $vtcDetails = $this->affiliation_model->getVtcDetailsByCode($this->input->post('ins_code'));
                $mobile_otp = rand(100000, 999999);
                
                $data_array=array(
                    'vtc_id_fk'     => $vtcDetails[0]['vtc_id_pk'],
                    'institute_code' => $this->input->post('ins_code'),
                    'institute_name' => $this->input->post('ins_name'),
                    'institute_email' => $this->input->post('ins_email'),
                    'entry_time' => 'now()',
                    'mobile_otp' => $mobile_otp
                );
                $this->session->set_userdata('ins_data', $data_array);
                // $ins_id = $this->affiliation_model->insert_data('council_polytechnic_institute_details',$data_array);


                if($data_array){
                    $data = array(
                        'otp' => $mobile_otp
                    );

                    $email_subject = "Email Verification";
                    // if($this->input->post('registration_for') == 1){
                        $email_message = $this->load->view($this->config->item('theme') . 'polytechnic/email_template_email_verification_view', $data, TRUE);
                    // }else{
                    //     $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/ins_email_template_email_verification_view', $data, TRUE);

                    // }
                    $status = send_email($this->input->post('ins_email'), $email_message, $email_subject);
                    if ($status) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, We have sent you a OTP on your Institute email. Please verify your email.');
                        redirect('polytechnic/affiliation/mobile_verify/'.md5($vtcDetails[0]['vtc_id_pk']));
                    } else {
                        $data['url'] = 'http://localhost/council_live/polytechnic/affiliation/mobile_verify/'.md5($vtcDetails[0]['vtc_id_pk']);

                        $url = '<a href="' . $data['url'] . '" target="_blank">Click Here</a>';

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Please ' . $url);
                        redirect('polytechnic/affiliation/registration');
                    }

                }else{
                    redirect('polytechnic/affiliation/registration');
                }


            }

        }else{

            $this->load->view($this->config->item('theme') . 'polytechnic/registration_view');
        }
    }

    public function mobile_verify($id_hash = NULL)
    {

        //echo "<pre>";print_r($this->session->userdata('ins_data'));exit;
        if ($id_hash) {
            //echo $id_hash;exit;
            $insDetails  = $this->affiliation_model->getInsDetailsByIdHash($id_hash);
            if (empty($insDetails)) {

                //if ($insDetails[0]['mobile_verify_status'] == 0) {
                    $ins_data = $this->session->userdata('ins_data');
                    $data['id']     = $id_hash;
                    $data['otp']    = $ins_data['mobile_otp'];
                    $data['email'] = $ins_data['institute_email'];

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

                                $data_array=array(
                                    'vtc_id_fk'     => $ins_data['vtc_id_fk'],
                                    'institute_code' => $ins_data['institute_code'],
                                    'institute_name' => $ins_data['institute_name'],
                                    'institute_email' => $ins_data['institute_email'],
                                    'entry_time' => 'now()',
                                    'active_status' => 1,
                                    'mobile_verify_status' =>1
                                );

                                //echo "<pre>";print_r($data_array);exit;
                                
                                $ins_id = $this->affiliation_model->insert_data('council_polytechnic_institute_details',$data_array);

                                if ($ins_id) {

                                    $academic_year =  date('y') . '' . date('y', strtotime(date('Y') . "+ 1 year"));
                                    // Create Institute Credentials
                                    // $username = $ins_data['institute_email'];
                                    $username = 'INS'.$academic_year.$ins_data['institute_code'];
                                    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                                    $codeAlphabet .= "0123456789";

                                    $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                                    $credentials = array(
                                        'stake_id_fk'          => 30,
                                        'login_id'             => $username,
                                        'login_password'       => hash("sha256", $login_password),
                                        'activation_date'      => 'now()',
                                        'active_status'        => 1,
                                        'entry_time'           => 'now()',
                                        'entry_ip'             => $this->input->ip_address(),
                                        'stake_holder_details' => $ins_data['institute_name'],
                                        'stake_details_id_fk'  => $ins_data['vtc_id_fk'],
                                        'base_password'        => $login_password,
                                        'base_login_id'        => $username,
                                    );
                                    


                                    $insertResult = $this->affiliation_model->insert_data('council_stake_holder_login',$credentials);
                                    if ($insertResult) {

                                        // ! Send credentials on email
                                        //$this->load->helper('email_helper');

                                        $data = array(
                                            'user_name' => $credentials['base_login_id'],
                                            'password'  => $credentials['base_password'],
                                        );

                                        $email_subject = "Institute Login Credentials";
										//echo "<pre>";print_r($ins_data);die;
                                        $email_message = $this->load->view($this->config->item('theme') . 'polytechnic/email_template_id_password_view', $data, TRUE);
                                        $status = send_email($ins_data['institute_email'], $email_message, $email_subject);

                                        if ($status) {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Verified successfully, Login credentials sent to Institute email.');
                                        } else {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Username: ' . $data['user_name'] . '<br> Password: ' . $data['password']);
                                        }

                                        redirect('admin/login');
                                    } else {

                                        $this->session->set_flashdata('status', 'danger');
                                        $this->session->set_flashdata('alert_msg', 'Unable to create credentials, Please contact to council admin.');

                                        redirect('polytechnic/mobile_verify/' . $id_hash);
                                    }
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('polytechnic/mobile_verify/' . $id_hash);
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('polytechnic/mobile_verify/' . $id_hash);
                            }
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'polytechnic/affiliation_mobile_verify_view', $data);
                //}
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function getINSName($vtcCode = NULL) 
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // $registration_for = $this->input->get('registration_for');

           

            $vtcDetails = $this->affiliation_model->getVtcDetailsByCode($vtcCode);
            if (!empty($vtcDetails)) {

                if ($vtcDetails[0]['vtc_affiliated_status'] == 1) {

                    echo json_encode($vtcDetails[0]['vtc_name']);
                } else {

                    echo json_encode('');
                }
            }
            

            
        }
    }
}
?>