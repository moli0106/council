<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration extends NIC_Controller
{
    function __construct()
    {

        parent::__construct();
        
        $this->title = 'Councils ' . $this->title;
        $this->load->model("online_counselling/registration_model");
        //$this->load->model('admin/affiliation/details_model');
        

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'councils/css/datepicker.css',
            2  => $this->config->item('theme_uri') . 'councils/css/select2.min.css',
            //3  => $this->config->item('theme_uri').'plugins/select2/css/select2-bootstrap.css',
        );

        $this->js_foot = array(
            1  => $this->config->item('theme_uri') . 'councils/js/datepicker.js',
            2  => $this->config->item('theme_uri') . 'councils/js/custom/online_counselling.js',
            3  => $this->config->item('theme_uri') . 'councils/js/select2.full.min.js',
           
        );
        $this->load->helper('email');
        $this->load->library('sms');
    }

    public function index(){

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $course = $this->input->post('courses');
            $config = array(
                array(
                    'field' => 'courses',
                    'label' => 'counselling For',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'index_number',
                    'label' => 'Index Number',
                    'rules' => 'trim|required|numeric'
                )
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
				
                $this->load->view($this->config->item('theme') . 'online_counselling/registration_form');
            } else {
                $index_number = $this->input->post('index_number');
                $courses = $this->input->post('courses');
                $check_index_number = $this->registration_model->check_index_number($index_number,$courses);
                //echo "<pre>";print_r($check_index_number);exit;
                if($check_index_number){
                    if($check_index_number['apply_for_counselling'] == 1){

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Alredy Registered , Please login with their index number.');
                        $this->load->view($this->config->item('theme') . 'online_counselling/registration_form');

                    }else{
                        if ($check_index_number['counselling_mobile_verify_status'] == 0) {
                            $mobile_otp = rand(100000, 999999);

                            $updateArray = array(
                                'counselling_otp'          => $mobile_otp
                            );
                            $status = $this->registration_model->updateStdDetails($check_index_number['student_details_id_pk'], $updateArray);

                            if ($status) {

                                $sms_message = "You have applied for registration in Polytechnics under WBSCT&VE&SD. Your OTP is " . $mobile_otp;
                                $template_id = 0; //1707167567490402333B
                                $this->sms->send($check_index_number['mobile_number'], $sms_message, $template_id);

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Please Verify Mobile No.');

                                redirect('online_counselling/registration/mobile_verify/' . md5($check_index_number['student_details_id_pk']));
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something Went Wrong, please try again later.');

                                redirect('vtc/student_reg');
                            }

                        }

                    }



                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'oops! Index number is not exist , Please Check.');
                    $this->load->view($this->config->item('theme') . 'online_counselling/registration_form');
                }
                



            }


        }else{

            $this->load->view($this->config->item('theme') . 'online_counselling/registration_form');
        }

    }

    public function mobile_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
            $student_details_id_pk = $stdDetails['student_details_id_pk'];

            //echo "<pre>";print_r($stdDetails);exit;
            if (!empty($stdDetails)) {

                if ($stdDetails['counselling_mobile_verify_status'] == 0 ) {
                    
                    $data['id']     = $id_hash;
                    $data['otp']    = $stdDetails['counselling_otp'];
                    $data['mobile'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $stdDetails['mobile_number']);

                    if ($this->input->server('REQUEST_METHOD') == 'POST') {
                        // echo "if";exit;
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
                                
                               
                                $stake_id_fk = 29;
                                    

                                $updateArray = array(
                                    'counselling_mobile_verify_status' => 1,
                                    'apply_for_counselling'=>1
                                );
                                $status = $this->registration_model->updateStdDetails($student_details_id_pk, $updateArray);

                                if ($status) {

                                   
                                    $username  = $stdDetails['index_number'];
                                    $login_password     = $otp;
                                    $stdCredentials = array(
                                        'stake_id_fk'          => $stake_id_fk,
                                        'login_id'             => $username,
                                        'login_password'       => hash("sha256", $login_password),
                                        'activation_date'      => 'now()',
                                        'active_status'        => 1,
                                        'entry_time'           => 'now()',
                                        'entry_ip'             => $this->input->ip_address(),
                                        'stake_holder_details' => ($stdDetails['candidate_name'] !='') ? $stdDetails['candidate_name'] : 'Student Admin' ,
                                        'stake_details_id_fk'  => (int)$student_details_id_pk,
                                        'base_password'        => $login_password,
                                        'base_login_id'        => $username,
                                        'mobile_no'             => $stdDetails['mobile_number']
                                    );
                                    
									//echo "<pre>";print_r($stdCredentials);exit;

                                    $insertResult = $this->registration_model->insertStdCredentials($stdCredentials);

                                    if ($insertResult) {
                                        //echo $stdCredentials['login_id'];exit;

                                        $this->session->set_flashdata('std_login_id', $stdCredentials['login_id']);
                                        //$this->session->set_userdata('std_login_psw', $stdCredentials['base_password']);
                                        // echo $this->session->userdata('std_login_id');exit;
                                         redirect('admin/student_login/index/'.$stdCredentials['login_id'].'/'.$stdCredentials['base_password'], 'location');

                                    } else {

                                        $this->session->set_flashdata('status', 'danger');
                                        $this->session->set_flashdata('alert_msg', 'Unable to create credentials, Please contact to council admin.');

                                        redirect('online_counselling/registration');
                                    }

                                    
                                    
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('online_counselling/registration');
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('online_counselling/registration/mobile_verify/' . $id_hash);
                            }
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'online_counselling/std_mobile_verify_view', $data);
                } else {
                    // echo 'else';exit;
                    
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

            $stdDetails  = $this->registration_model->getStdDetailsByIdHash($id_hash);
           
            if (!empty($stdDetails)) {

                $mobile_otp = rand(100000, 999999);

                $updateArray = array(
                    'final_mobile_otp'          => $mobile_otp
                );
                $status = $this->registration_model->updateStdDetails($stdDetails['student_details_id_pk'], $updateArray);

                if ($status) {

                    $sms_message = "You have applied for registration in Polytechnics under WBSCT&VE&SD. Your OTP is " . $mobile_otp;
                    $template_id = 0; //1707167567490402333B
                    $this->sms->send($stdDetails['mobile_number'], $sms_message, $template_id);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'OTP has been sent to Student Mobile.');

                    redirect('online_counselling/registration/mobile_verify/' . md5($stdDetails['student_details_id_pk']));

                    
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! We are unable to send otp.');

                    redirect('online_counselling/registration/mobile_verify/' . md5($stdDetails['student_details_id_pk']));
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