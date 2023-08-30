<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nodal extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(60);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/nodal_model');

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'master/nodal_officer.js',
        );
    }

    public function index($offset = 0)
    {
        $data['offset'] = $offset;

        $this->load->library('pagination');

        $config['base_url']         = 'master/nodal/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->nodal_model->getNodalOfficerCount()[0]['count'];
        $config['per_page']         = 30;
        $config['num_links']        = 3;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open']    = '<li class="">';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '<i class="fa fa-backward"></i>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fa fa-forward"></i>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';


        $this->pagination->initialize($config);

        $data['page_links']  = $this->pagination->create_links();
        $data['NodalOfficerList']  = $this->nodal_model->getNodalOfficerList($config['per_page'], $offset);

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'master/nodal/nodal_officer_list_view', $data);
    }

    public function add()
    {
        $data['districtList'] = $this->nodal_model->getdistrictList();

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'nodal_officer_mobile',
                    'label' => 'Nodal Officer Mobile',
                    'rules' => 'trim|required|exact_length[10]|numeric',
                ),
                array(
                    'field' => 'nodal_centre_email',
                    'label' => 'Nodal Centre Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'nodal_centre_name',
                    'label' => 'Nodal Centre Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'district_id',
                    'label' => 'District',
                    'rules' => 'trim|required|numeric'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'master/nodal/nodal_officer_add_view', $data);
            } else {

                $insertArray = array(
                    'district_id_fk'       => $this->input->post('district_id'),
                    'nodal_centre_name'    => $this->input->post('nodal_centre_name'),
                    'nodal_centre_email'   => $this->input->post('nodal_centre_email'),
                    'nodal_officer_mobile' => $this->input->post('nodal_officer_mobile'),
                    'entry_ip'             => $this->input->ip_address(),
                    'entry_by_login_id'    => $this->session->userdata('stake_holder_login_id_pk')
                );
                // parent::pre($insertArray);

                $result = $this->nodal_model->insertNodalOfficer($insertArray);

                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Nodal Officer added successfully.');

                    redirect('admin/master/nodal');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/master/nodal/add');
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'master/nodal/nodal_officer_add_view', $data);
        }
    }

    public function removeNodalOfficer($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if (!empty($id_hash)) {

                $nodalOfficer = $this->nodal_model->getNodalOfficerByIdHash($id_hash);
                if (!empty($nodalOfficer)) {

                    $status = $this->nodal_model->updateNodalOfficer($id_hash, array('active_status' => 0));

                    if ($status) {
                        echo json_encode('success');
                    }
                }
            }
        }
    }

    public function update($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $nodalOfficer = $this->nodal_model->getNodalOfficerByIdHash($id_hash);
            if (!empty($nodalOfficer)) {

                $data['nodalOfficer']   = $nodalOfficer[0];
                $data['districtList'] = $this->nodal_model->getdistrictList();

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $data['formData'] = array(
                        'district_id'          => set_value('district_id'),
                        'nodal_centre_name'    => set_value('nodal_centre_name'),
                        'nodal_centre_email'   => set_value('nodal_centre_email'),
                        'nodal_officer_mobile' => set_value('nodal_officer_mobile'),
                    );
                } else {
                    $data['formData'] = array(
                        'district_id'          => $data['nodalOfficer']['district_id_fk'],
                        'nodal_centre_name'    => $data['nodalOfficer']['nodal_centre_name'],
                        'nodal_centre_email'   => $data['nodalOfficer']['nodal_centre_email'],
                        'nodal_officer_mobile' => $data['nodalOfficer']['nodal_officer_mobile'],
                    );
                }

                // parent::pre($data);

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'nodal_officer_mobile',
                            'label' => 'Nodal Officer Mobile',
                            'rules' => 'trim|required|exact_length[10]|numeric',
                        ),
                        array(
                            'field' => 'nodal_centre_email',
                            'label' => 'Nodal Centre Email',
                            'rules' => 'trim|required|max_length[250]|valid_email'
                        ),
                        array(
                            'field' => 'nodal_centre_name',
                            'label' => 'Nodal Centre Name',
                            'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                            'errors' => array(
                                'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                            )
                        ),
                        array(
                            'field' => 'district_id',
                            'label' => 'District',
                            'rules' => 'trim|required|numeric'
                        )
                    );

                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view($this->config->item('theme') . 'master/nodal/nodal_officer_update_view', $data);
                    } else {

                        $updateArray = array(
                            'district_id_fk'       => $this->input->post('district_id'),
                            'nodal_centre_name'    => $this->input->post('nodal_centre_name'),
                            'nodal_centre_email'   => $this->input->post('nodal_centre_email'),
                            'nodal_officer_mobile' => $this->input->post('nodal_officer_mobile'),
                            'entry_ip'             => $this->input->ip_address(),
                            'entry_by_login_id'    => $this->session->userdata('stake_holder_login_id_pk')
                        );
                        // parent::pre($updateArray);

                        $result = $this->nodal_model->updateNodalOfficer($id_hash, $updateArray);

                        if ($result) {

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Nodal Officer updated successfully.');

                            redirect('admin/master/nodal');
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                            redirect('admin/master/nodal');
                        }
                    }
                } else {

                    $this->load->view($this->config->item('theme') . 'master/nodal/nodal_officer_update_view', $data);
                }
            } else {
                redirect('admin/master/nodal');
            }
        } else {
            redirect('admin/master/nodal');
        }
    }
}
