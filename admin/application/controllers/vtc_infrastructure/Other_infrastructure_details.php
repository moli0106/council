<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Other_infrastructure_details extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/other_infrastructure_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/other_infrastructure.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset =0){

       $data['offset'] = $offset;
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->other_infrastructure_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        if(!empty($data['vtcDetails'])){

            $data['otherData'] = $this->other_infrastructure_model->getOtherInfarstructureDetails($data['vtc_id'],$data['vtcDetails']['academic_year']);
            // echo "<pre>";print_r($data['otherData']);exit;
        }
        // $this->load->view($this->config->item('theme') . 'vtc_infrastructure/other_infrastructure_list_view', $data);
        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/other_infrastructure_add_view', $data);
    }
    public function add(){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->other_infrastructure_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(

                array(
                    'field' => 'electricity_available',
                    'label' => 'Electricity Available',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'internet_connect',
                    'label' => 'Internet Connection',
                    'rules' => 'trim|required|numeric'
                ),
            );
            if($this->input->post('electricity_available') == 1){
                $config[] = array(
                    'field' => 'phase3_supply',
                    'label' => '3 phase supply',
                    'rules' => 'trim|required'
                );
            }
            if($this->input->post('internet_connect') == 1){
                $config[] = array(
                    'field' => 'connection_type',
                    'label' => 'Connection Type',
                    'rules' => 'trim|required'
                );
                $connection_type = $this->input->post('connection_type');
            }else{
                $connection_type = NULL;
            }

            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/other_infrastructure_add_view', $data);
            }else{

                if($this->input->post('other_details_id') != ''){

                    $id = $this->input->post('other_details_id');

                    $updateArray = array(
                        'available_electricity'              => $this->input->post('electricity_available'),
                        'phase3_supply'              => $this->input->post('phase3_supply'),
                        'internet_connect'              => $this->input->post('internet_connect'),
                        'connection_type_id_fk'              => $connection_type,
                        'update_ip'                  => $this->input->ip_address(),
                        'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'update_time'                => 'now()',
                    );
                    // echo "<pre>";print_r($updateArray);exit;
                    $updateRow = $this->other_infrastructure_model->updateData($updateArray,$id);
                    if ($updateRow) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Other Details updated successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }


                }else{

                    $post_data = array(
                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'             => $data['vtcDetails']['academic_year'],
                        'available_electricity'              => $this->input->post('electricity_available'),
                        'phase3_supply'              => $this->input->post('phase3_supply'),
                        'internet_connect'              => $this->input->post('internet_connect'),
                        'connection_type_id_fk'              => $connection_type,
                        'entry_ip'                  => $this->input->ip_address(),
                        'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                    );
                   
    
                    // echo "<pre>";print_r($post_data);exit;
    
                    $last_id = $this->other_infrastructure_model->insertData($post_data);
                    if ($last_id) {
    
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Other Infrastructure Details added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }
                }
                

                redirect(base_url('admin/vtc_infrastructure/other_infrastructure_details'));
            }

        }else{

            $this->load->view($this->config->item('theme') . 'vtc_infrastructure/other_infrastructure_add_view', $data);
        }
    }
}