<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_discipline_streem_map extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(120);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('master/affiliation_discipline_streem_map_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'master/affiliation_course.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0){

        $data['offset'] = $offset;
        $data['streemNameList'] = $this->affiliation_discipline_streem_map_model->getStreemNameList();
        $data['disciplineList'] = $this->affiliation_discipline_streem_map_model->getDisciplineList();
        $data['mapList'] = $this->affiliation_discipline_streem_map_model->getAllMapList();

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'discipline_id',
                    'label' => 'Discipline Name',
                    'rules' => 'trim|required'
                    
                ),
                array(
                    'field' => 'streem_name_id[]',
                    'label' => 'Streem Name',
                    'rules' => 'trim|required'
                    
                )
                
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'master/affiliation_discipline/discipline_streem_map_view',$data);
            } else {

                $streem_id = $this->input->post('streem_name_id');
                if(count($streem_id) > 0){
                    
                    $insertArray = array();
                    foreach ($streem_id as $key => $value) {
                        $data = array(

                            'discipline_id_fk' => $this->input->post('discipline_id'),
                            'streem_name_id_fk' => $value,
                            'entry_ip'                  => $this->input->ip_address(),
                            'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                            'entry_time'                => 'now()',
                        );
                        array_push($insertArray,$data);
                    }
                    $result = $this->affiliation_discipline_streem_map_model->insertBatchData('council_affiliation_discipline_streem_mapping',$insertArray);
                    if($result){
                       

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully mapped Discipline with Streem.');
                    }else{
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to mapped Discipline with Streem, Please try after sometime.');
                    }
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to mapped Discipline with Streem, Please try after sometime.');
                }
                redirect(base_url('admin/master/affiliation_discipline_streem_map'));

            }


        }else{

            $this->load->view($this->config->item('theme') . 'master/affiliation_discipline/discipline_streem_map_view',$data);
        }
    }
}