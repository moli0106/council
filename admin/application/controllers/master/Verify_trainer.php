<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify_trainer extends NIC_Controller 
{
	function __construct()
	{
        parent::__construct();
        //$this->output->enable_profiler();
        $this->load->model('master/master_trainer_model');
    } 

    public function email($id_hash = NULL)
    {
        $trainer = $this->master_trainer_model->getTrainerByHashIdEmail($id_hash);
        
        $data['trainer'] = $trainer[0];
        $data['id_hash'] = $id_hash;

        if(empty($trainer))
        {
            $data['status'] = 0;
            $data['msg']    = 'Trainer not found.';
        }
        else
        {
			if($trainer[0]['email_verified'])
			{
				$data['status'] = 0;
				$data['msg']    = 'Trainer is already verified.';
			}
			else
			{
				$updateArray = array(
					'email_verified'  => 1,
					'mobile_verified' => 1,
					'active_status'   => 1, 
				);
				$updateStatus = $this->master_trainer_model->updateTrainer($id_hash, $updateArray);

				if($updateStatus)
				{
					// Create Master Trainer Credentials
					$login_id = substr(ucfirst($data['trainer']['f_name']), 0, 1);
					$login_id.= substr(ucfirst($data['trainer']['l_name']), 0, 1).'T';
					$login_id.= sprintf("%05d", $data['trainer']['master_trainer_id_pk']);

					$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
					$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
					$codeAlphabet.= "0123456789";
					
					$login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
					$trainerCredentials = array(
						'stake_id_fk'          => 8,
						'login_id'             => $login_id,
						'login_password'       => hash("sha256", $login_password),
						'activation_date'      => 'now()',
						'active_status'        => 1,
						'entry_time'           => 'now()',
						'entry_ip'             => $this->input->ip_address(),
						'stake_holder_details' => $data['trainer']['f_name'].' '.$data['trainer']['l_name'],
						'stake_details_id_fk'  => $data['trainer']['master_trainer_id_pk'],
						'base_password'        => $login_password,
						'base_login_id'        => $login_id,
					);

					$insertResult = $this->master_trainer_model->insertTrainerCredentials($trainerCredentials);
					if($insertResult)
					{
						// Send credentials on email
						$data = array(
							'url'  => base_url('admin'),
							'name' => $trainerCredentials['stake_holder_details'],
							'base_password' => $trainerCredentials['base_password'],
							'base_login_id' => $trainerCredentials['base_login_id'],
						);
						$this->load->helper('email');

						$email_subject = "Credentials For Council Master Trainer Account";
						$email_message = $this->load->view($this->config->item('theme').'master/trainer/email_trainer_credentials', $data, TRUE);

						send_email($trainer[0]['email'], $email_message, $email_subject);
						
						$data['status'] = 0;
						$data['msg']    = 'Email verifyed successfully.! We have sent you the credentials on your email, please check your email.';

					}
					else
					{
						$data['status'] = 0;
						$data['msg']    = 'Oops! Unable to verify email, please try again.';
					}
				}
				else
				{
					$data['status'] = 0;
					$data['msg']    = 'Oops! Unable to verify email, please try again.';
				}
            }
        }
        $this->load->view($this->config->item('theme') . 'master/trainer/master_trainer_otp_view', $data);
    }

    public function emailOldFunction($id_hash = NULL)
    {
        $trainer = $this->master_trainer_model->getTrainerByHashIdEmail($id_hash);
        //print_r($trainer);die;      
        $data['trainer'] = $trainer[0];
        $data['id_hash'] = $id_hash;

        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'otp',
                    'label' => 'OTP',
                    'rules' => 'trim|required'
                )
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {
                $data['status'] = 1;

                $this->load->view($this->config->item('theme').'master/trainer/master_trainer_otp_view', $data);
            
		    } else {
                $user_otp = $this->input->post('otp');
                if($user_otp == $trainer[0]['mobile_otp'])
                {
                    $updateStatus = $this->master_trainer_model->updateTrainer($id_hash, array('active_status' => 1, 'mobile_verified' => 1));
                    if($updateStatus)
                    {
                        // Create Master Trainer Credentials
                        $login_id = substr(ucfirst($data['trainer']['f_name']), 0, 1);
                        $login_id.= substr(ucfirst($data['trainer']['l_name']), 0, 1).'T';
                        $login_id.= sprintf("%05d", $data['trainer']['master_trainer_id_pk']);

                        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
                        $codeAlphabet.= "0123456789";
                        
                        $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                        $trainerCredentials = array(
                            'stake_id_fk'          => 8,
                            'login_id'             => $login_id,
                            'login_password'       => hash("sha256", $login_password),
                            'activation_date'      => 'now()',
                            'active_status'        => 1,
                            'entry_time'           => 'now()',
                            'entry_ip'             => $this->input->ip_address(),
                            'stake_holder_details' => $data['trainer']['f_name'].' '.$data['trainer']['l_name'],
                            'stake_details_id_fk'  => $data['trainer']['master_trainer_id_pk'],
                            'base_password'        => $login_password,
                            'base_login_id'        => $login_id,
                        );

                        $insertResult = $this->master_trainer_model->insertTrainerCredentials($trainerCredentials);
                        if($insertResult)
                        {
                            // Send verify link on email
                            $data = array(
                                'url'  => base_url('admin'),
                                'name' => $trainerCredentials['stake_holder_details'],
                                'base_password' => $trainerCredentials['base_password'],
                                'base_login_id' => $trainerCredentials['base_login_id'],
                            );
                            $this->load->helper('email');
        
                            $email_subject = "Credentials For Council Master Trainer Account";
                            $email_message = $this->load->view($this->config->item('theme').'master/trainer/email_trainer_credentials', $data, TRUE);

                            send_email($trainer[0]['email'], $email_message, $email_subject);
                            
                            $data['status'] = 0;
                            $data['msg']    = 'We have sent you the credentials on your email, please check.';
        
                            $this->load->view($this->config->item('theme').'master/trainer/master_trainer_otp_view', $data);
                        }
                        else
                        {
                            $data['status'] = 0;
                            $data['msg']    = 'Verifyed successfully.';
        
                            $this->load->view($this->config->item('theme').'master/trainer/master_trainer_otp_view', $data);
                        }
                    }
                    else
                    {
                        $data['status'] = 1;
                        $this->session->set_flashdata('alert_msg','Oops! SOmething went wrong');

                        $this->load->view($this->config->item('theme').'master/trainer/master_trainer_otp_view', $data);
                    }
                }
                else
                {
                    $data['status'] = 1;
                    $this->session->set_flashdata('alert_msg','Enter valid OTP.');

                    $this->load->view($this->config->item('theme').'master/trainer/master_trainer_otp_view', $data);
                }
            }
        }
        else
        {
            if(empty($trainer))
            {
                $data['status'] = 0;
                $data['msg']    = 'Trainer not found.';
            }
            else
            {
                $updateStatus = $this->master_trainer_model->updateTrainer($id_hash, array('email_verified' => 1));
                if($updateStatus)
                {
                    if($trainer[0]['mobile_verified'])
                    {
                        $data['status'] = 0;
                        $data['msg']    = 'Trainer is already verified.';
                    }
                    else
                    {
                        $mobile_otp = rand(1000, 9999);
                        $this->master_trainer_model->updateTrainer($id_hash, array('mobile_otp' => $mobile_otp));

                        $this->load->library('sms');
                        
                        $mobile      = $trainer[0]['mobile'];
                        $sms_content = "Your mobile verification code for registration as Trainer under WBSCTVESD is ". $mobile_otp;
                        $template_id = 1107161201120409862;

                        $response = $this->sms->sendotp($mobile, $sms_content, $template_id);
                        //$response = TRUE;
                        if($response === TRUE) 
                        {
                            $data['status'] = 1;
                        } 
                        else 
                        {
                            $data['status'] = 0;
                            $data['msg']    = 'Oops! Unable to send OTP, please try again.';
                        }
                    }
                }
                else
                {
                    $data['status'] = 0;
                    $data['msg']    = 'Oops! Unable to verify email, please try again.';
                }
            }
            $this->load->view($this->config->item('theme') . 'master/trainer/master_trainer_otp_view', $data);

        }
    }

}
