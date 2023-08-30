<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nos_master extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(40);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/nos_master_model');

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'assets/js/jquery.dataTables.min.js',
            3 => $this->config->item('theme_uri') . 'assets/js/dataTables.bootstrap.min.js',
            4 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            5 => $this->config->item('theme_uri') . 'master/assessment_marks.js',
        );
    }

    // ! List all assigned batch list
    public function index()
    {
        $data['nosList'] = $this->nos_master_model->getNosList();

        // parent::pre($data);

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field'     => 'nos_type',
                    'label'     => '<b>NoS Type</b>',
                    'rules'     => 'trim|required',
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'master/nos_master/nos_master_view', $data);
            } else {

                $insertArray = array(
                    'nos_name'             => $this->input->post("nos_type"),
                    'active_status'        => 1,
                    'entry_by_login_id_fk' => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_ip'             => $this->input->ip_address(),
                );

                $result = $this->nos_master_model->nosInsert($insertArray);

                if ($result) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'NoS added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                }

                redirect('admin/master/nos_master', 'refresh');
            }
        } else {

            $this->load->view($this->config->item('theme') . 'master/nos_master/nos_master_view', $data);
        }
    }

    // ! Update NoS Type
    public function update_nos_type()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $id_hash  = $this->input->get('id_hash');
            $nos_type = $this->input->get('nos_type');

            if (!empty($id_hash) && !empty($nos_type)) {

                $this->nos_master_model->updateNosType($id_hash, array('nos_name' => $nos_type));

                echo json_encode($id_hash);
            }
        }
    }

    // ! Delete NoS Type
    public function remove_nos_type($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {


            if (!empty($id_hash)) {

                // $nosDetails = $this->nos_master_model->deleteNosType($id_hash);
                $nosDetails = $this->nos_master_model->updateNosType($id_hash, array('active_status' => 0));

                echo json_encode($id_hash);
            }
        }
    }
}
