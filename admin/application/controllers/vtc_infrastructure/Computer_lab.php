<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Computer_lab extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/computer_lab_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/computer_lab.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset =0){

        $data['offset'] = $offset;
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->computer_lab_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

        if(!empty($data['vtcDetails'])){

            $data['computerLabData'] = $this->computer_lab_model->getComputerLabDetails($data['vtc_id'],$data['vtcDetails']['academic_year']);
            // echo "<pre>";print_r($data['computerLabData']);exit;
        }
        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/computer_lab/computer_lab_add_view', $data);
    }

    public function add(){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->computer_lab_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(

                array(
                    'field' => 'lab_present',
                    'label' => 'Present Computer Lab',
                    'rules' => 'trim|required|numeric'
                ),
                
            );
            if($this->input->post('lab_present') == 1){
                $config[] = array(
                    'field' => 'no_of_computer',
                    'label' => 'No Of Computers',
                    'rules' => 'trim|required'
                );
                $config[] = array(
                    'field' => 'working_computer',
                    'label' => 'No Of Working Computers',
                    'rules' => 'trim|required'
                );
            }

            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/computer_lab/computer_lab_add_view', $data);
            }else{

                $no_of_computer = $this->input->post('no_of_computer');
                $no_of_working_computer = $this->input->post('working_computer');

                if($this->input->post('computer_lab_id') !=''){

                    $lab_id = $this->input->post('computer_lab_id');

                    $updateArray = array(
                        'lab_present'              => $this->input->post('lab_present'),
                        'no_of_computer'              => $no_of_computer?$no_of_computer:NULL,
                        'no_of_working_computer'              => $no_of_working_computer?$no_of_working_computer:NULL,
                        'update_ip'                  => $this->input->ip_address(),
                        'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'update_time'                => 'now()',
                    );
                    
                    $updateRow = $this->computer_lab_model->updateData($updateArray,$lab_id);
                    if ($updateRow) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Computer Lab Details updated successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                }else{

                        
                    $post_data = array(
                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'             => $data['vtcDetails']['academic_year'],
                        'lab_present'              => $this->input->post('lab_present'),
                        'no_of_computer'              => $no_of_computer?$no_of_computer:NULL,
                        'no_of_working_computer'              => $no_of_working_computer?$no_of_working_computer:NULL,
                        'entry_ip'                  => $this->input->ip_address(),
                        'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                    );
                

                    // echo "<pre>";print_r($post_data);exit;

                    $last_id = $this->computer_lab_model->insertData($post_data);
                    if ($last_id) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Computer Lab Details added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }


                }

               
                
                redirect(base_url('admin/vtc_infrastructure/computer_lab'));
            }

        }else{

            $this->load->view($this->config->item('theme') . 'vtc_infrastructure/computer_lab/computer_lab_add_view', $data);
        }
    }
}