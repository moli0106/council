<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tc_reg extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('organization/tc_reg_model');

        $this->load->helper('email');
        $this->load->library('sms');

        // $this->output->enable_profiler(TRUE);
    }

    public function email_verify($id_hash = NULL)
    {
        //echo $id_hash;print_r($id_hash);exit;
        if ($id_hash) {

            $tcDetails  = $this->tc_reg_model->getTcDetailsByIdHash($id_hash);
           // echo "<pre>";print_r($tcDetails);exit;
            if (!empty($tcDetails)) {
                if ($tcDetails[0]['tc_email_verify_status'] == 0 || $tcDetails[0]['organization_mobile_verify_status'] == 0) {        // Added by Waseem on 08-11-2021
                    
                   
                    $mobile_otp = rand(100000, 999999);

                    $updateArray = array(
                        'organization_mobile_otp'          => $mobile_otp
                        //'tc_email_verify_status' => 1,
                    );
                    $status = $this->tc_reg_model->updateTcDetails($tcDetails[0]['tc_id_pk'], $updateArray);

                    if ($status) {

                        $sms_message = "Your mobile verification code for registration in VTC affiliation portal is " . $mobile_otp;
                        $template_id = 0;
                        $this->sms->send($tcDetails[0]['organization_mobile'], $sms_message, $template_id);

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Email verified successfully.');

                        redirect('organization/tc_reg/mobile_verify/' . $id_hash);
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your email at this time, please try again later.');

                        redirect('organization/tc_reg/email_verify/' . $id_hash);
                    }
                   
                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function mobile_verify($id_hash = NULL)
    {
        //echo $id_hash;exit;
        if ($id_hash) {

            $tcDetails  = $this->tc_reg_model->getTcDetailsByIdHash($id_hash);
            if (!empty($tcDetails)) {

                if ($tcDetails[0]['organization_mobile_verify_status'] == 0) {

                    $data['id']     = $id_hash;
                    $data['otp']    = $tcDetails[0]['organization_mobile_otp'];
                    $data['mobile'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $tcDetails[0]['organization_mobile']);

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

                                $updateArray = array(
                                    'organization_mobile_verify_status' => 1,
                                    'tc_email_verify_status' => 1,
                                    'active_status'               => 1,
                                );
                                $status = $this->tc_reg_model->updateTcDetails($tcDetails[0]['tc_id_pk'], $updateArray);

                                if ($status) {

                                    $username = $tcDetails[0]['email'];
                                    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                                    $codeAlphabet .= "0123456789";

                                    $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                                    $tcCredentials = array(
                                        'stake_id_fk'          => 36,
                                        'login_id'             => $username,
                                        'login_password'       => hash("sha256", $login_password),
                                        'activation_date'      => 'now()',
                                        'active_status'        => 1,
                                        'entry_time'           => 'now()',
                                        'entry_ip'             => $this->input->ip_address(),
                                        'stake_holder_details' => $tcDetails[0]['tc_name'],
                                        'stake_details_id_fk'  => $tcDetails[0]['tc_id_pk'],
                                        'base_password'        => $login_password,
                                        'base_login_id'        => $username  
                                    );
                                    


                                    $insertResult = $this->tc_reg_model->insertTcCredentials($tcCredentials);
                                    if ($insertResult) {

                                        // ! Send credentials on email
                                        //$this->load->helper('email_helper');

                                        $data = array(
                                            'user_name' => $tcCredentials['base_login_id'],
                                            'password'  => $tcCredentials['base_password'],
                                        );

                                        $email_subject = "TC/Institute Login Credentials";
                                        $email_message = $this->load->view($this->config->item('theme') . 'organization/tc_reg/email_template_id_password_view', $data, TRUE);
                                        $status1 = send_email($tcDetails[0]['email'], $email_message, $email_subject);

                                        if ($status1) {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Verified successfully, Login credentials sent to TC email.');
                                        } else {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Username: ' . $data['user_name'] . '<br> Password: ' . $data['password']);
                                        }

                                        redirect('/admin');
                                    } else {

                                        $this->session->set_flashdata('status', 'danger');
                                        $this->session->set_flashdata('alert_msg', 'Unable to create credentials, Please contact to council admin.');

                                        redirect('organization/tc_reg/mobile_verify/' . $id_hash);
                                    }
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('organization/tc_reg/mobile_verify/' . $id_hash);
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('organization/tc_reg/mobile_verify/' . $id_hash);
                            }
                        }
                    }else{

                        $this->load->view($this->config->item('theme') . 'organization/tc_reg/tc_mobile_verify_view', $data);
                    }

                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function resend_otp($id_hash = NULL)
    {
        if ($id_hash) {

            $tcDetails  = $this->tc_reg_model->getTcDetailsByIdHash($id_hash);
            if (!empty($tcDetails)) {

                $mobile_otp = rand(100000, 999999);

                $updateArray = array(
                    'hoi_mobile_otp'          => $mobile_otp,
                    'tc_email_verify_status' => 1,
                );
                $status = $this->tc_reg_model->updateTcDetails($tcDetails[0]['tc_id_pk'], $updateArray);

                if ($status) {

                    $sms_message = "Your mobile verification code for registration in VTC affiliation portal is " . $mobile_otp;
                    $template_id = 0;
                    $this->sms->send($tcDetails[0]['organization_mobile'], $sms_message, $template_id);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'OTP has been sent to Organization Mobile.');

                    redirect('organization/tc_reg/mobile_verify/' . $id_hash);
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! We are unable to send otp.');

                    redirect('organization/tc_reg/email_verify/' . $id_hash);
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }
}
?>