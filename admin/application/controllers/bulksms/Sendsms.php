<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendsms extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(16);
        // $this->output->enable_profiler();
    } 

    public function index(){

        $this->load->helper('form');

        if($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'template_id',
                    'label' => 'Template ID',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'sms_content',
                    'label' => 'Approved SMS Content ',
                    'rules' => 'required'
                ),
                array(
                    'field' => 'mobile_num',
                    'label' => 'Mobile Numbers',
                    'rules' => 'required'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'bulksms/sendsms', array());
                
            } else {

                $this->load->library('sms');

                $template_id = $this->input->post('template_id');
                $sms_content = $this->input->post('sms_content');
                $mobile_num  = explode(',', $this->input->post('mobile_num'));

                $this->session->set_flashdata('template_id', $template_id);
                $this->session->set_flashdata('sms_content', $sms_content);

                $success_res   = 0;
                $err_mobile_no = array();
                $mobileregex   = "/^[6-9][0-9]{9}$/";

                if(count($mobile_num) <= 50) {

                    foreach ($mobile_num as $key => $mobile) {  

                        if(preg_match($mobileregex, $mobile) === 1) {
                            
                            $response = $this->sms->send($mobile, $sms_content, $template_id);

                            if($response === TRUE) {
                                $success_res   = 1;
                            } else {
                                $err_mobile_no[] = $mobile;
                            }
                        } else {
                            $err_mobile_no[] = $mobile;
                        }
                    }

                    if(count($err_mobile_no)) {
                        if(count($mobile_num) == count($err_mobile_no)) {
                            $this->session->set_flashdata('status','danger');
                            $this->session->set_flashdata('alert_msg','Unable to send sms for these number [ '.implode(',', $err_mobile_no).' ].');
                        } else {
                            $this->session->set_flashdata('status','success');
                            $this->session->set_flashdata('alert_msg','SMS sent successfuly. For these number [ '.implode(',', $err_mobile_no).' ] unable to send sms.');
                        }
                    } else {
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','SMS sent successfuly.');
                    }
                    redirect('admin/bulksms/sendsms');
                } else {
                    $this->session->set_flashdata('status','danger');
                    $this->session->set_flashdata('alert_msg','Mobile number should not more than 50.');

                    $this->session->set_flashdata('mobile_num', implode(',', $mobile_num));
                    redirect('admin/bulksms/sendsms');
                }
            }
        }
        else
        {
            $this->load->view($this->config->item('theme').'bulksms/sendsms', array());

        }

    }

}
