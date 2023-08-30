<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agriculture_discipline extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/agriculture_discipline_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/agriculture_discipline.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset =0){

        $data['offset'] = $offset;
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->agriculture_discipline_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['agriDisciplineExist'] = $this->agriculture_discipline_model->getVtcDiscipline($data['vtc_id'], $data['academic_year']);

        if(!empty($data['vtcDetails'])){

            // $data['agriData']= array();

            $data['agriData'] = $this->agriculture_discipline_model->getAgriDisciplineDetails($data['vtc_id'],$data['vtcDetails']['academic_year']);
            // echo "<pre>";print_r($data['agriData']);exit;
        }
        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/agriculture_discipline/agriculture_discipline_add_view', $data);
    }

    public function add(){

        
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->agriculture_discipline_model->getVtcDetails($data['vtc_id'], $data['academic_year']);
        $data['agriDisciplineExist'] = $this->agriculture_discipline_model->getVtcDiscipline($data['vtc_id'], $data['academic_year']);

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(

                array(
                    'field' => 'pond','label' => 'Pond','rules' => 'trim|required'
                ),
                array(
                    'field' => 'poultry_shed','label' => 'Poultry Shed/Farm','rules' => 'trim|required'
                ),

                array(
                    'field' => 'animal_shed','label' => 'Animal Shed','rules' => 'trim|required'
                ),
                array(
                    'field' => 'cattle_shed','label' => 'Cattle Shed','rules' => 'trim|required'
                ),
                array(
                    'field' => 'goat_shed',
                    'label' => 'Goat Shed',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'compost_pit',
                    'label' => 'Compost Pit',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'land','label' => 'Land','rules' => 'trim|required'
                ),
            );
            if($this->input->post('pond') == 1){

                $config[] = array(
                    'field' => 'fish_cultivation','label' => 'Fish Cultivation','rules' => 'trim|required'
                );
            }
            if($this->input->post('poultry_shed') == 1){

                $config[] = array(
                    'field' => 'poultry_live','label' => 'Live units of poultry Shed','rules' => 'trim|required'
                );
            }
            if($this->input->post('animal_shed') == 1){
                $config[] = array(
                    'field' => 'animal_live','label' => 'Live units of animal Shed','rules' => 'trim|required'
                );
            }

            if($this->input->post('cattle_shed') == 1){
                $config[] = array(
                    'field' => 'cattle_live','label' => 'Live units of cattle shed','rules' => 'trim|required'
                );
            }

            if($this->input->post('goat_shed') == 1){
                $config[] = array(
                    'field' => 'goat_live','label' => 'Live units of goat shed','rules' => 'trim|required'
                );
            }

            if($this->input->post('compost_pit') == 1){
                $config[] = array(
                    'field' => 'no_of_pit','label' => 'No Of Pits','rules' => 'trim|required'
                );
                $no_of_pit = $this->input->post('no_of_pit');
            }else{
                $no_of_pit = NULL;
            }

            if($this->input->post('land') == 1){
                $config[] = array(
                    'field' => 'agri_land','label' => 'Agriculture Land','rules' => 'trim|required'
                );
                $config[] = array(
                    'field' => 'land_size','label' => 'Land Size','rules' => 'trim|required'
                );
                $land_size = $this->input->post('land_size');
            }else{
                $land_size = NULL;
            }

            


            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){

                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/agriculture_discipline/agriculture_discipline_add_view', $data);
                // redirect(base_url('admin/vtc_infrastructure/agriculture_discipline'));

            }else{

                $agri_discipline_id_hash = $this->input->post('agri_discipline_id');

                if($agri_discipline_id_hash !=''){

                    $updateArray = array(
                        
                        'pond'                      => $this->input->post('pond'),
                        'fish_cultivation'          => $this->input->post('fish_cultivation'),
    
                        'poultry_shed'              => $this->input->post('poultry_shed'),
                        'poultry_live'              => $this->input->post('poultry_live'),
    
                        'animal_shed'              => $this->input->post('animal_shed'),
                        'animal_live'              => $this->input->post('animal_live'),
                        
                        'cattle_shed'              => $this->input->post('cattle_shed'),
                        'cattle_live'              => $this->input->post('cattle_live'),
    
                        'goat_shed'              => $this->input->post('goat_shed'),
                        'goat_live'              => $this->input->post('goat_live'),
    
                        'compost_pit'              => $this->input->post('compost_pit'),
                        'no_of_pit'              => $no_of_pit,
    
                        'land'              => $this->input->post('land'),
                        'agri_land'              => $this->input->post('agri_land'),
                        'land_size'              => $land_size,
    
                        'update_ip'                  => $this->input->ip_address(),
                        'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'update_time'                => 'now()',
                    );
    
                    // echo "<pre>";print_r($updateArray);exit;
    
                    $updateRow = $this->agriculture_discipline_model->updateData($updateArray,$agri_discipline_id_hash);
                    if ($updateRow) {
    
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Agriculture Discipline Details updated successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }

                }else{

                    $postDataArray = array(
                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'             => $data['vtcDetails']['academic_year'],
    
                        'pond'                      => $this->input->post('pond'),
                        'fish_cultivation'          => $this->input->post('fish_cultivation'),
    
                        'poultry_shed'              => $this->input->post('poultry_shed'),
                        'poultry_live'              => $this->input->post('poultry_live'),
    
                        'animal_shed'              => $this->input->post('animal_shed'),
                        'animal_live'              => $this->input->post('animal_live'),
                        
                        'cattle_shed'              => $this->input->post('cattle_shed'),
                        'cattle_live'              => $this->input->post('cattle_live'),
    
                        'goat_shed'              => $this->input->post('goat_shed'),
                        'goat_live'              => $this->input->post('goat_live'),
    
                        'compost_pit'              => $this->input->post('compost_pit'),
                        'no_of_pit'              => $no_of_pit,
    
                        'land'              => $this->input->post('land'),
                        'agri_land'              => $this->input->post('agri_land'),
                        'land_size'              => $land_size,
    
                        'entry_ip'                  => $this->input->ip_address(),
                        'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                    );
    
                    // echo "<pre>";print_r($postDataArray);exit;
    
                    $last_id = $this->agriculture_discipline_model->insertData($postDataArray);
                    if ($last_id) {
    
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Agriculture Discipline Details added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                    }
                }

                redirect(base_url('admin/vtc_infrastructure/agriculture_discipline'));
            }

        }else{
            redirect(base_url('admin/vtc_infrastructure/agriculture_discipline'));
        }

    }

}