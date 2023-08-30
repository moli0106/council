<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map_district extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(35);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/map_district_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "assets/css/dataTables.bootstrap.min.css",
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/jquery.dataTables.min.js',
            2 => $this->config->item('theme_uri') . 'assets/js/dataTables.bootstrap.min.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            4 => $this->config->item('theme_uri') . 'master/map_district.js',
        );
    }

    // List all your items
    public function index($offset = 0)
    {
        $data['offset']               = $offset;
        $data['district_list']        = $this->map_district_model->getAllDistrict();
        $data['mapped_district_list'] = $this->map_district_model->getMappedDistrict();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $config = array(
            array(
                'field' => 'district_id',
                'label' => 'District',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'district_map_id',
                'label' => 'Mapped District ',
                'rules' => 'trim|required|numeric'
            ),
            /*array(
                'field' => 'priority',
                'label' => 'Priority ',
                'rules' => 'trim|required|numeric'
            )*/
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('theme') . 'master/map_district/map_district_view', $data);
        } else {

            //$result = $this->map_district_model->checkPriority($this->input->post('district_id'), $this->input->post('priority'));

            //if (empty($result)) {

                $insert_array = array(
                    'district_id_fk'     => $this->input->post('district_id'),
                    'district_map_id_fk' => $this->input->post('district_map_id'),
                    //'priority'           => $this->input->post('priority'),
                    'active_status'      => 1,
                    'entry_by_id_fk'     => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_ip'           => $this->input->ip_address()
                );

                $result = $this->map_district_model->insertMapDistrict($insert_array);

                if ($result) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Map District for assessment is added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                }
            /*} else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Priority for the district is all ready exist.');
            }*/

            redirect('admin/master/map_district', 'refresh');
        }
    }

    public function get_district($id = NULL)
    {
        $mapped_district = $this->map_district_model->getMappedDistrictByDistrictId($id);

        $mapped_array = $new_district = array();
        $html = '<option value="" hidden="true">Select district</option>';

        if (!empty($mapped_district)) {
            foreach ($mapped_district as $key => $district) {
                array_push($mapped_array, $district['district_map_id_fk']);
            }

            $new_district = $this->map_district_model->getAllDistrict($id, $mapped_array);
        } else {
            $new_district = $this->map_district_model->getAllDistrict($id);
        }

        if (!empty($new_district)) {
            foreach ($new_district as $key => $district) {
                $html .= '<option value="' . $district['district_id_pk'] . '">' . $district['district_name'] . '</option>';
            }

            echo json_encode($html);
        }
    }
}

/* End of file Map_district.php */
