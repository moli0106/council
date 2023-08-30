<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_grouping extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(65);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/course_grouping_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "assets/css/dataTables.bootstrap.min.css",
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/jquery.dataTables.min.js',
            2 => $this->config->item('theme_uri') . 'assets/js/dataTables.bootstrap.min.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            4 => $this->config->item('theme_uri') . 'master/course_grouping.js',
        );
    }

    // List all your items
    public function index($offset = 0)
    {
        $data['offset']               = $offset;
        $data['course_list']        = $this->course_grouping_model->getAllcourse();
        $data['mapped_course_list'] = $this->course_grouping_model->getMappedcourse();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $config = array(
            array(
                'field' => 'course_id',
                'label' => 'course',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'course_map_id',
                'label' => 'Mapped Course ',
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
            $this->load->view($this->config->item('theme') . 'master/course_grouping/course_grouping_view', $data);
        } else {

            //$result = $this->course_grouping_model->checkPriority($this->input->post('district_id'), $this->input->post('priority'));

            //if (empty($result)) {

                $insert_array = array(
                    'course_id_fk'     => $this->input->post('course_id'),
                    'course_grouping_id_fk' => $this->input->post('course_map_id'),
                    //'priority'           => $this->input->post('priority'),
                    'active_status'      => 1,
                    'entry_by_id_fk'     => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_ip'           => $this->input->ip_address()
                );

                $result = $this->course_grouping_model->insertMapCourse($insert_array);

                if ($result) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Map Course is added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                }
            /*} else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Priority for the district is all ready exist.');
            }*/

            redirect('admin/master/course_grouping', 'refresh');
        }
    }

    public function get_course($id = NULL)
    {
        $mapped_district = $this->course_grouping_model->getMappedCourseByCourseId($id);

        $mapped_array = $new_course = array();
        $html = '<option value="" hidden="true">Select course</option>';

        if (!empty($mapped_district)) {
            foreach ($mapped_district as $key => $course) {
                array_push($mapped_array, $course['course_grouping_id_fk']);
            }

            $new_course = $this->course_grouping_model->getAllcourse($id, $mapped_array);
        } else {
            $new_course = $this->course_grouping_model->getAllcourse($id);
        }

        if (!empty($new_course)) {
            foreach ($new_course as $key => $course) {
                $html .= '<option value="' . $course['course_id_pk'] . '">' . $course['course_name'] . '</option>';
            }

            echo json_encode($html);
        }
    }
}

/* End of file Map_district.php */
