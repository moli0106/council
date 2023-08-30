<?php
defined('BASEPATH') or exit('No direct script access allowed');

class School extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(106);
        $this->load->model('cssvse/school_model');
        // $this->output->enable_profiler();

        ini_set('MAX_EXECUTION_TIME', '-1');

        $this->css_head = array();
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'cssvse/school.js',
        );
    }

    public function profile($offset = 0)
    {
        $school_reg_id = $this->session->userdata('stake_details_id_fk');
        $data['schoolData'] = $this->school_model->checkSchoolRegistratedDataByIdHash(md5($school_reg_id))[0];
        $data['districtList'] = $this->school_model->getDistrictList();
        $data['municipality'] = $this->school_model->getMunicipalityByDistrict($data['schoolData']['district_id_fk']);

        // parent::pre($data);

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $district = $this->input->post('district');
            if (!empty($district)) {
                $data['municipality'] = $this->school_model->getMunicipalityByDistrict($district);
            }

            $data['schoolData']['school_mobile'] = $this->input->post('schoolMobileNo');
            $data['schoolData']['hoi_name'] = $this->input->post('hoiName');
            $data['schoolData']['hoi_email'] = $this->input->post('hoiEmail');
            $data['schoolData']['district_id_fk'] = $district;
            $data['schoolData']['municipality_id_fk'] = $this->input->post('municipality');
            $data['schoolData']['pin_code'] = $this->input->post('pinCode');
            $data['schoolData']['school_address'] = $this->input->post('address');

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'udiseCode',
                    'label' => 'UDISE Code',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'schoolName',
                    'label' => 'School Name',
                    'rules' => 'trim|required|max_length[250]'
                ),
                array(
                    'field' => 'schoolMobileNo',
                    'label' => 'School Mobile No.',
                    'rules' => 'trim|required|exact_length[10]|numeric',
                ),
                array(
                    'field' => 'schoolEmail',
                    'label' => 'School Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'hoiName',
                    'label' => 'HOI Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'hoiMobileNo',
                    'label' => 'HOI Mobile',
                    'rules' => 'trim|required|exact_length[10]|numeric',
                ),
                array(
                    'field' => 'hoiEmail',
                    'label' => 'HOI Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'state',
                    'label' => 'State',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'district',
                    'label' => 'District',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'municipality',
                    'label' => 'Municipality',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'pinCode',
                    'label' => 'Pin Code',
                    'rules' => 'trim|required|exact_length[6]|numeric',
                ),
                array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'trim|required|max_length[500]',
                )
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() != FALSE) {

                $school_data = array(
                    'school_mobile' => $this->input->post('schoolMobileNo'),
                    'hoi_name' => $this->input->post('hoiName'),
                    'hoi_email' => $this->input->post('hoiEmail'),
                    'state_id_fk' => $this->input->post('state'),
                    'district_id_fk' => $district,
                    'municipality_id_fk' => $this->input->post('municipality'),
                    'pin_code' => $this->input->post('pinCode'),
                    'school_address' => $this->input->post('address'),
                    'updated_time' => "now()",
                    'updated_ip' => $this->input->ip_address(),
                    'updated_by' => $this->session->userdata('stake_details_id_fk'),
                );
                // parent::pre($school_data);
                $status = $this->school_model->updateSchoolRegDetails($school_data['updated_by'], $school_data);

                if ($status) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Information has been successfully updated.');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update information, Please try again later.');
                }

                redirect('admin/cssvse/school/profile');
            }
        }
        $this->load->view($this->config->item('theme') . 'cssvse/school/profile_view', $data);
    }

    public function getMunicipality()
    {
        echo json_encode('hello');
    }

    public function testRecord()
    {
        $this->db->select('id_pk, registration_number, date_of_birth, tt, sd, ed');
        $this->db->from('council_cssvse_student_master_tmp_data');
        $this->db->order_by('id_pk');

        $this->db->limit(60000, 50000);
        $tmpData = $this->db->get()->result_array();


        $count = 0;
        foreach ($tmpData as $key => $value) {

            $updateArray = array(
                'date_of_birth' => $value['date_of_birth'],
                'batch_start_date' => $value['sd'],
                'batch_end_date' => $value['ed'],
                'batch_tentative_date' => $value['tt'],
            );

            $this->db->where('registration_number', $value['registration_number']);
            $this->db->update('council_cssvse_student_master', $updateArray);

            if ($this->db->affected_rows()) {
                ++$count;
            }
        }
        echo  $count;
    }
}
