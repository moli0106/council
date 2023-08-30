<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Add_bank_details extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(103);
        $this->load->model('assessor_profile/add_bank_details_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
        $this->css_head = array(
            // 1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'assessor_profile/js/add_bank_details.js',
        );
    }

    public function index($offset = 0)
    {
        $assessor_id = $this->session->userdata('stake_details_id_fk');
        $data['assessor_bank_details'] = $this->add_bank_details_model->getAssessorBankDetails($assessor_id)[0];
        $data['bank_status'] = $data['assessor_bank_details']['bank_ifsc'];

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $insertArray = array(
                $data['assessor_bank_details']['bank_ifsc']                        =    $this->input->post('ifsc_code'),
                $data['assessor_bank_details']['bank_account_holder_name'] =    $this->input->post('ac_holder_name'),
                $data['assessor_bank_details']['bank_account_no']              =    $this->input->post('bank_account_no'),
                $data['assessor_bank_details']['bank_name']                     =    $this->input->post('bank_name'),
                $data['assessor_bank_details']['bank_branch_name']           =    $this->input->post('branch_name'),
            );

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'ifsc_code',
                    'label' => 'Teacher Type',
                    'rules' => 'trim|required|alpha_numeric|exact_length[11]'
                ),
                array(
                    'field' => 'ac_holder_name',
                    'label' => 'Teacher Type',
                    'rules' => 'trim|required|max_length[100]'
                ),
                array(
                    'field' => 'bank_account_no',
                    'label' => 'Teacher Type',
                    'rules' => 'trim|required|numeric|max_length[25]'
                ),
                array(
                    'field' => 'bank_name',
                    'label' => 'Teacher Type',
                    'rules' => 'trim|required|max_length[100]'
                ),
                array(
                    'field' => 'branch_name',
                    'label' => 'Teacher Type',
                    'rules' => 'trim|required|max_length[100]'
                ),
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() != FALSE) {

                $insertArray = array(
                    'bank_ifsc' =>    $this->input->post('ifsc_code'),
                    'bank_account_holder_name' =>    $this->input->post('ac_holder_name'),
                    'bank_account_no' =>    $this->input->post('bank_account_no'),
                    'bank_name' =>    $this->input->post('bank_name'),
                    'bank_branch_name' =>    $this->input->post('branch_name'),
                );

                $bank_details = $this->add_bank_details_model->getBankDetailsByIfscCode(trim($insertArray['bank_ifsc']));
                if (!empty($bank_details)) {

                    $result = $this->add_bank_details_model->addBankDetails($assessor_id, $insertArray);

                    if ($result) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Bank details has been added successfully.!');
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Unable to add bank details, Please try again later.!');
                    }

                    redirect('admin/assessor_profile/add_bank_details', 'refresh');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'IFSC code not found in our database.');

                    redirect('admin/assessor_profile/add_bank_details', 'refresh');
                }
            }
        }

        $this->load->view($this->config->item('theme') . 'assessor_profile/bank_add_view', $data);
    }

    public function getBankDetails($ifscCode = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash = $this->input->get('id_hash');
            $assessor_id = $this->input->get('assessor_id');

            if (($ifscCode != NULL) && (strlen($ifscCode) == 11)) {

                $bank_details = $this->add_bank_details_model->getBankDetailsByIfscCode(trim($ifscCode));
                if (!empty($bank_details)) {
                    echo json_encode($bank_details[0]);
                }
            }
        }
    }
}
