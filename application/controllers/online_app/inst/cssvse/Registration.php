<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('online_app/inst/cssvse/cssvse_model');

        $this->load->helper('email');
        $this->load->library('sms');

        $this->theme_css = array();

        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['districtList']  = $this->cssvse_model->getDistrictList();

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'udiseCode',
                    'label' => 'UDISE Code',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'schoolName',
                    'label' => 'School Name',
                    'rules' => 'trim|required|max_length[250]'
                ),
                array(
                    'field' => 'schoolMobileNo',
                    'label' => 'School Mobile No.',
                    // 'rules' => 'trim|required|exact_length[10]|numeric',
                    'rules' => 'trim|required|min_length[10]|max_length[11]|numeric',
                ),
                array(
                    'field' => 'schoolEmail',
                    'label' => 'School Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'hoiName',
                    'label' => 'HOI Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'hoiMobileNo',
                    'label' => 'HOI Mobile',
                    'rules' => 'trim|required|exact_length[10]|numeric',
                ),
                array(
                    'field' => 'hoiEmail',
                    'label' => 'HOI Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'state',
                    'label' => 'State',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'district',
                    'label' => 'District',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'municipality',
                    'label' => 'Municipality',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'pinCode',
                    'label' => 'Pin Code',
                    'rules' => 'trim|required|exact_length[6]|numeric',
                ),
                array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'trim|required|max_length[500]',
                )
            );

            $district = $this->input->post('district');
            if (!empty($district)) {

                $data['municipality'] = $this->cssvse_model->getMunicipalityByDistrict($district);
            }

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() != FALSE) {

                $school_data = array(
                    'udise_code' => $this->input->post('udiseCode'),
                    'school_name' => $this->input->post('schoolName'),
                    'school_mobile' => $this->input->post('schoolMobileNo'),
                    'school_email' => $this->input->post('schoolEmail'),
                    'hoi_name' => $this->input->post('hoiName'),
                    'hoi_mobile' => $this->input->post('hoiMobileNo'),
                    'hoi_email' => $this->input->post('hoiEmail'),
                    'state_id_fk' => $this->input->post('state'),
                    'district_id_fk' => $district,
                    'municipality_id_fk' => $this->input->post('municipality'),
                    'pin_code' => $this->input->post('pinCode'),
                    'school_address' => $this->input->post('address'),
                    'entry_ip' => $this->input->ip_address(),
                );

                $schoolDetails_1 = $this->cssvse_model->getSchoolDetailsByUdiseCode($school_data['udise_code']);
                if (!empty($schoolDetails_1)) {

                    $schoolDetails_1 = $schoolDetails_1[0];
                    $school_data['school_master_id_fk'] = $schoolDetails_1['school_id_pk'];

                    $schoolDetails_2 = $this->cssvse_model->checkSchoolRegistratedData($school_data['udise_code']);
                    if (empty($schoolDetails_2)) {

                        $cssvse_last_id = $this->cssvse_model->insertCssvseDetails($school_data);
                        if ($cssvse_last_id) {

                            $data = array(
                                'url' => base_url('online_app/inst/cssvse/registration/email_verify/' . md5($cssvse_last_id))
                            );

                            $email_subject = "Email Verification";
                            $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/cssvse/email_template_email_verification_view', $data, TRUE);
                            $status = send_email($this->input->post('schoolEmail'), $email_message, $email_subject);

                            if ($status) {

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Successfully registered, We have sent you a verification link on your school email. Please verify your email.');
                            } else {

                                $url = '<a href="' . $data['url'] . '" target="_blank">Click Here</a>';

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Please click this link to verify ' . $url);
                            }

                            redirect('online_app/inst/cssvse/registration');
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to register, Please try again later.');

                            redirect('online_app/inst/cssvse/registration');
                        }
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'You are already registered, Please login to your portal.');

                        redirect('online_app/inst/cssvse/registration');
                    }
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! UDISE Code not found.');

                    redirect('online_app/inst/cssvse/registration');
                }
            }
        }
        $this->load->view($this->config->item('theme') . 'online_app/inst/cssvse/registration_view', $data);
    }

    public function email_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $schoolDetails  = $this->cssvse_model->checkSchoolRegistratedDataByIdHash($id_hash);
            if (!empty($schoolDetails)) {

                $schoolDetails = $schoolDetails[0];
                if ($schoolDetails['school_email_verify_status'] == 0 || $schoolDetails['hoi_mobile_verify_status'] == 0) {

                    $mobile_otp = rand(100000, 999999);
                    $updateArray = array(
                        'hoi_mobile_otp'          => $mobile_otp,
                        'school_email_verify_status' => 1,
                    );

                    $status = $this->cssvse_model->updateSchoolRegDetails($schoolDetails['school_reg_id_pk'], $updateArray);
                    if ($status) {

                        $sms_message = "Your mobile verification code for registration in CSS VSE Examination 2022 is " . $mobile_otp;
                        // $template_id = '1707164509772742145';
                        $template_id = 0;
                        $this->sms->send($schoolDetails['hoi_mobile'], $sms_message, $template_id);

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Email verified successfully.');

                        redirect('online_app/inst/cssvse/registration/mobile_verify/' . $id_hash);
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your email at this time, please try again later.');

                        redirect('online_app/inst/cssvse/registration');
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
        if ($id_hash) {

            $schoolDetails  = $this->cssvse_model->checkSchoolRegistratedDataByIdHash($id_hash);
            if (!empty($schoolDetails)) {

                $schoolDetails = $schoolDetails[0];
                if ($schoolDetails['hoi_mobile_verify_status'] == 0) {

                    $data['id']     = $id_hash;
                    $data['otp']    = $schoolDetails['hoi_mobile_otp'];
                    $data['mobile'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $schoolDetails['hoi_mobile']);

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
                                    'hoi_mobile_verify_status' => 1,
                                    'active_status'               => 1,
                                );
                                $status = $this->cssvse_model->updateSchoolRegDetails($schoolDetails['school_reg_id_pk'], $updateArray);

                                if ($status) {

                                    // ! Create School Credentials
                                    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                                    $codeAlphabet .= "0123456789";

                                    $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                                    $schoolCredentials = array(
                                        'stake_id_fk'          => 22,
                                        'login_id'             => $schoolDetails['udise_code'],
                                        'login_password'       => hash("sha256", $login_password),
                                        'activation_date'      => 'now()',
                                        'active_status'        => 1,
                                        'entry_time'           => 'now()',
                                        'entry_ip'             => $this->input->ip_address(),
                                        'stake_holder_details' => $schoolDetails['school_name'],
                                        'stake_details_id_fk'  => $schoolDetails['school_reg_id_pk'],
                                        'base_password'        => $login_password,
                                        'base_login_id'        => $schoolDetails['udise_code'],
                                    );

                                    $insertResult = $this->cssvse_model->insertSchoolCredentials($schoolCredentials);
                                    if ($insertResult) {

                                        // ! Send credentials on email
                                        $data = array(
                                            'user_name' => $schoolCredentials['base_login_id'],
                                            'password'  => $schoolCredentials['base_password'],
                                        );

                                        $email_subject = "School Login Credentials";
                                        $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/cssvse/email_template_id_password_view', $data, TRUE);
                                        $status = send_email($schoolDetails['school_email'], $email_message, $email_subject);

                                        if ($status) {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Verified successfully, Login credentials sent to school email.');
                                        } else {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Username: ' . $data['user_name'] . '<br> Password: ' . $data['password']);
                                        }

                                        redirect('online_app/inst/cssvse/registration');
                                    } else {

                                        $this->session->set_flashdata('status', 'danger');
                                        $this->session->set_flashdata('alert_msg', 'Unable to create credentials, Please contact to council admin.');

                                        redirect('online_app/inst/cssvse/registration');
                                    }
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('online_app/inst/cssvse/registration');
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('online_app/inst/cssvse/registration/mobile_verify/' . $id_hash);
                            }
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'online_app/inst/cssvse/school_mobile_verify_view', $data);
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

            $schoolDetails  = $this->cssvse_model->checkSchoolRegistratedDataByIdHash($id_hash);
            if (!empty($schoolDetails)) {

                $schoolDetails = $schoolDetails[0];

                $mobile_otp = rand(100000, 999999);
                $updateArray = array(
                    'hoi_mobile_otp'          => $mobile_otp,
                );

                $status = $this->cssvse_model->updateSchoolRegDetails($schoolDetails['school_reg_id_pk'], $updateArray);
                if ($status) {

                    $sms_message = "Your mobile verification code for registration in CSS VSE Examination 2022 is " . $mobile_otp;
                    // $template_id = '1707164509772742145';
                    $template_id = 0;
                    $this->sms->send($schoolDetails['hoi_mobile'], $sms_message, $template_id);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'OTP has been sent to HOI Mobile.');

                    redirect('online_app/inst/cssvse/registration/mobile_verify/' . $id_hash);
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! We are unable to send otp, Please verify your email again.');

                    redirect('online_app/inst/cssvse/registration');
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function getMunicipality($district = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html = '<option value="" hidden="true">Select Block / Municipality</option>';
            $municipality = $this->cssvse_model->getMunicipalityByDistrict($district);

            if (!empty($municipality)) {

                foreach ($municipality as $key => $value) {
                    $html .= '
                            <option value="' . $value['block_municipality_id_pk'] . '">
                                ' . $value['block_municipality_name'] . '
                            </option>
                        ';
                }
                echo json_encode($html);
            } else {

                $html .= '<option value="" disabled="true">No Data found.</option>';
                echo json_encode($html);
            }
        }
    }

    public function getSchoolDetails($udiseCode = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // ! Get School Details by UDISE Code
            $schoolDetails = $this->cssvse_model->getSchoolDetailsByUdiseCode($udiseCode);
            if (!empty($schoolDetails)) {

                $schoolDetails = $schoolDetails[0];

                $schoolData = array(
                    'school_name' => $schoolDetails['school_name'],
                    'school_mobile' => $schoolDetails['school_mobile'],
                    'school_email' => $schoolDetails['school_email'],
                    'hoi_name' => $schoolDetails['hoi_name'],
                    'hoi_mobile' => $schoolDetails['hoi_mobile'],
                    'hoi_email' => $schoolDetails['hoi_email'],
                    'school_address' => $schoolDetails['school_address'],
                    'pin_code' => $schoolDetails['pin_code'],
                );

                // ! Prepare State Data
                $schoolData['state_list'] = '<option value="19" selected>West Bengal</option>';

                // ! Get All District List
                $district_html = '<option value="" hidden="true">Select District</option>';
                $districtList  = $this->cssvse_model->getDistrictList();

                foreach ($districtList as $key => $value) {
                    if ($schoolDetails['district_id_fk'] == $value['district_id_pk']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $district_html .= '<option value="' . $value['district_id_pk'] . '" ' . $selected . '>' . $value['district_name'] . '</option>';
                }
                $schoolData['district_list'] = $district_html;

                // ! Get All Municipality List
                $block_html = '<option value="" hidden="true">Select Block / Municipality</option>';
                $municipality = $this->cssvse_model->getMunicipalityByDistrict($schoolDetails['district_id_fk']);

                foreach ($municipality as $key => $value) {
                    if ($schoolDetails['municipality_id_fk'] == $value['block_municipality_id_pk']) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $block_html .= '<option value="' . $value['block_municipality_id_pk'] . '" ' . $selected . '>' . $value['block_municipality_name'] . '</option>';
                }
                $schoolData['block_list'] = $block_html;

                echo json_encode($schoolData);
            }
        }
    }
}
