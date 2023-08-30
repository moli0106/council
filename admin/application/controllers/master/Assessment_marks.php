<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_marks extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(37);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('master/assessment_marks_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "assets/css/dataTables.bootstrap.css",
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'assets/js/jquery.dataTables.min.js',
            3 => $this->config->item('theme_uri') . 'assets/js/dataTables.bootstrap.min.js',
            4 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            5 => $this->config->item('theme_uri') . 'master/assessment_marks.js',
        );
    }

    public function index()
    {
        $data['form_course_list'] = array();
        $data['course_list']  = $this->assessment_marks_model->getAllMarksGroupByCourse();
        $data['sector_list']  = $this->assessment_marks_model->getAllSector();
        // parent::pre($data);

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $sector_id = $this->input->post('sector_id');
            $course_id = $this->input->post('course_id');

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'sector_id',
                    'label' => 'Sector',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'course_id',
                    'label' => 'Course',
                    'rules' => 'trim|required|numeric'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                if ($sector_id != '') {
                    $data['form_course_list'] = $this->assessment_marks_model->getCourseBySectorId($sector_id);
                }
                $this->load->view($this->config->item('theme') . 'master/assessment_marks/assessment_marks_list_view', $data);
            } else {

                $data = array(
                    'course_details'  => $this->assessment_marks_model->getSectorJobRoleDetails($course_id)[0],
                    'nos_details'     => $this->assessment_marks_model->getMarksByCourseId($course_id),
                    'nos_type_list'   => $this->assessment_marks_model->getAllNosType(),
                );
                // parent::pre($data);

                $data['form_input']['total_marks'] = $data['course_details']['total_marks'];
                $data['form_input']['pass_marks']  = $data['course_details']['total_pass_marks'];
                $data['form_input']['pass_in_nos'] = $data['course_details']['pass_in_every_nos'];

                $this->load->view($this->config->item('theme') . 'master/assessment_marks/add_course_nos_view', $data);
            }
        } else {

            $this->load->view($this->config->item('theme') . 'master/assessment_marks/assessment_marks_list_view', $data);
        }
    }

    public function add_nos_marks()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $sector_id = $this->input->post('sector_id_fk');
            $course_id = $this->input->post('course_id_fk');

            if (!empty($sector_id) && !empty($course_id)) {

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                $config = array(
                    array(
                        'field' => 'sector_id_fk',
                        'label' => 'Sector',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'course_id_fk',
                        'label' => 'Course',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'nos_name',
                        'label' => 'NoS Name',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'nos_code',
                        'label' => 'NoS Code',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'nos_type',
                        'label' => 'NoS Type',
                        'rules' => 'trim|required'
                    ),
                    array(
                        'field' => 'nos_theory_marks',
                        'label' => 'NoS Theory Marks',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'nos_practical_marks',
                        'label' => 'NoS Practical Marks',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'pass_marks_for_job_role',
                        'label' => 'Pass Marks for Job Role',
                        'rules' => 'trim|required|numeric|less_than_equal_to[' . $this->input->post('total_marks_for_job_role') . ']'
                    ),
                    array(
                        'field' => 'nos_wise_no_of_theory_question',
                        'label' => 'Number of Theory Question',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'no_of_marks_each_question_carries',
                        'label' => 'Marks Each Question Carries',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'pass_in_every_nos',
                        'label' => 'Pass Every NoS',
                        'rules' => 'trim|required'
                    )
                );
                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE) {

                    $data = array(
                        'course_details'  => $this->assessment_marks_model->getSectorJobRoleDetails($course_id)[0],
                        'nos_details'     => $this->assessment_marks_model->getMarksByCourseId($course_id),
                        'nos_type_list'   => $this->assessment_marks_model->getAllNosType(),
                    );
                    // parent::pre($_POST);

                    $data['form_input']['total_marks'] = set_value('total_marks_for_job_role');
                    $data['form_input']['pass_marks']  = set_value('pass_marks_for_job_role');
                    $data['form_input']['pass_in_nos'] = set_value('pass_in_every_nos');

                    $this->load->view($this->config->item('theme') . 'master/assessment_marks/add_course_nos_view', $data);
                } else {
                    $nos_viva_marks  = $this->input->post('nos_viva_marks');
                    $viva_pass_marks = $this->input->post('viva_pass_marks');

                    if ($nos_viva_marks == 0 || $nos_viva_marks == NULL) {
                        $nos_viva_marks = NULL;
                        $viva_pass_marks = NULL;
                    } elseif ($viva_pass_marks == 0 || $viva_pass_marks == NULL) {
                        $viva_pass_marks = NULL;
                    }

                    $insert_nos_array = array(
                        'sector_id_fk'          => $this->input->post('sector_id_fk'),
                        'course_id_fk'          => $this->input->post('course_id_fk'),
                        'nos_name'            => $this->input->post('nos_name'),
                        'nos_code'             => $this->input->post('nos_code'),
                        'nos_type'             => $this->input->post('nos_type'),
                        'nos_theory_marks'     => $this->input->post('nos_theory_marks'),
                        'nos_practical_marks'  => $this->input->post('nos_practical_marks'),
                        'nos_viva_marks'       => $nos_viva_marks,
                        'theory_pass_marks'    => ($this->input->post('theory_pass_marks') == NULL) ? NULL : $this->input->post('theory_pass_marks'),
                        'practical_pass_marks' => ($this->input->post('practical_pass_marks') == NULL) ? NULL : $this->input->post('practical_pass_marks'),
                        'viva_pass_marks'      => $viva_pass_marks,
                        'pass_marks_for_each_nos' => ($this->input->post('pass_marks_for_each_nos') == NULL) ? NULL : $this->input->post('pass_marks_for_each_nos'),
                        'nos_wise_no_of_theory_question'    => $this->input->post('nos_wise_no_of_theory_question'),
                        'no_of_marks_each_question_carries' => $this->input->post('no_of_marks_each_question_carries'),
                        'entry_by_id_fk'       => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_ip'             => $this->input->ip_address(),
                        'active_status'        => 1
                    );

                    $nos_total_marks = ($this->input->post('nos_total_marks') == NULL) ? 0 : $this->input->post('nos_total_marks');

                    $total_marks = ($nos_total_marks + $insert_nos_array['nos_theory_marks'] + $insert_nos_array['nos_practical_marks'] + $insert_nos_array['nos_viva_marks']);

                    $insert_pass_marks_array = array(
                        'sector_id_fk'      => $this->input->post('sector_id_fk'),
                        'course_id_fk'      => $this->input->post('course_id_fk'),
                        'total_marks'       => $total_marks,
                        'total_pass_marks'  => $this->input->post('pass_marks_for_job_role'),
                        'pass_in_every_nos' => $this->input->post('pass_in_every_nos'),
                        'entry_by_id_fk'    => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_ip'          => $this->input->ip_address(),
                        'active_status'     => 1,
                    );

                    $result = $this->assessment_marks_model->insertNosMarks($insert_nos_array, $insert_pass_marks_array);

                    if ($result) {
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Marks for assessment is added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    }

                    redirect('admin/master/assessment_marks', 'refresh');
                }
            } else {

                redirect('admin/master/assessment_marks', 'refresh');
            }
        } else {

            redirect('admin/master/assessment_marks', 'refresh');
        }
    }

    public function add_assessment_marks()
    {
        $data['course_list'] = array();
        $data['sector_list'] = $this->assessment_marks_model->getAllSector();

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $config = array(
            array(
                'field' => 'sector_id',
                'label' => 'Sector',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'course_id',
                'label' => 'Course',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'nos_name',
                'label' => 'NoS Name',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nos_code',
                'label' => 'NoS Code',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nos_type',
                'label' => 'NoS Type',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'nos_theory_marks',
                'label' => 'NoS Theory Marks',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'nos_practical_marks',
                'label' => 'NoS Practical Marks',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'theory_pass_marks',
                'label' => 'Theory Pass Marks',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'practical_pass_marks',
                'label' => 'Practical Pass Marks',
                'rules' => 'trim|required|numeric'
            ),

            array(
                'field' => 'pass_marks_for_job_role',
                'label' => 'Pass Marks for Job Role',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'nos_wise_no_of_theory_question',
                'label' => 'Number of Theory Question',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'no_of_marks_each_question_carries',
                'label' => 'Marks Each Question Carries',
                'rules' => 'trim|required|numeric'
            ),
            array(
                'field' => 'pass_in_every_nos',
                'label' => 'Pass Every NoS',
                'rules' => 'trim|required'
            )
        );
        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE) {

            $sector_id = $this->input->post('sector_id');
            if ($sector_id != '') {
                $data['course_list'] = $this->assessment_marks_model->getCourseBySectorId($sector_id);
            }
            $this->load->view($this->config->item('theme') . 'master/assessment_marks/add_assessment_marks_view', $data);
        } else {
            $insert_array    = array(
                'sector_id_fk'         => $this->input->post('sector_id'),
                'course_id_fk'         => $this->input->post('course_id'),
                'nos_name'             => $this->input->post('nos_name'),
                'nos_code'             => $this->input->post('nos_code'),
                'nos_type'             => $this->input->post('nos_type'),
                'nos_theory_marks'     => $this->input->post('nos_theory_marks'),
                'nos_practical_marks'  => $this->input->post('nos_practical_marks'),
                'nos_viva_marks'       => ($this->input->post('nos_viva_marks') == NULL) ? NULL : $this->input->post('nos_viva_marks'),
                'theory_pass_marks'    => $this->input->post('theory_pass_marks'),
                'practical_pass_marks' => $this->input->post('practical_pass_marks'),
                'viva_pass_marks'      => ($this->input->post('viva_pass_marks') == NULL) ? NULL : $this->input->post('viva_pass_marks'),
                'pass_marks_for_each_nos' => ($this->input->post('pass_marks_for_each_nos') == NULL) ? NULL : $this->input->post('pass_marks_for_each_nos'),
                'pass_marks_for_job_role' => $this->input->post('pass_marks_for_job_role'),
                'nos_wise_no_of_theory_question'    => $this->input->post('nos_wise_no_of_theory_question'),
                'no_of_marks_each_question_carries' => $this->input->post('no_of_marks_each_question_carries'),
                'pass_in_every_nos'    => $this->input->post('pass_in_every_nos'),
                'entry_by_id_fk'       => $this->session->userdata('stake_holder_login_id_pk'),
                'entry_ip'             => $this->input->ip_address(),
                'active_status'        => 1
            );

            $result = $this->assessment_marks_model->marksInsert($insert_array);

            if ($result) {
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Marks for assessment is added successfully.');
            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
            }

            redirect('admin/master/assessment_marks', 'refresh');
        }
    }

    public function nos_details($course_id = NULL)
    {
        $data = array(
            'course_details'  => $this->assessment_marks_model->getSectorJobRoleDetailsHash($course_id)[0],
            'nos_details'     => $this->assessment_marks_model->getMarksByCourseIdHash($course_id),
        );
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'master/assessment_marks/nos_details_view', $data);
    }

    public function get_courses($sector_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($sector_id != '') {

                $html        = '<option value="" hidden="true">Select Job Role</option>';
                $course_list = $this->assessment_marks_model->getCourseBySectorId($sector_id);

                if (!empty($course_list)) {
                    foreach ($course_list as $key => $course) {

                        $html .= '<option value="' . $course['course_id_pk'] . '">' . $course['course_name'] . ' [' . $course['course_code'] . ']</option>';
                    }
                } else {

                    $html .= '<option value="" disabled="true">No Data Found...</option>';
                }

                echo json_encode($html);
            }
        }
    }

    public function remove_nos()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $idHash           = $this->input->get('idHash');
            $coursePassMarks  = $this->input->get('coursePassMarks');
            $courseTotalMarks = $this->input->get('courseTotalMarks');

            if (!empty($idHash) && !empty($coursePassMarks) && (!empty($courseTotalMarks) || $courseTotalMarks == 0)) {

                $nosDetails = $this->assessment_marks_model->getNosDetailsByIdHash($idHash);
                if (!empty($nosDetails)) {

                    $this->assessment_marks_model->updateNosMarksByidHash($idHash, array('active_status' => 0));

                    if ($courseTotalMarks == 0) {

                        $this->assessment_marks_model->deleteCoursePassMarks($nosDetails[0]['course_id_fk']);
                        $updateArray['idHash'] = $idHash;
                    } else {

                        $updateArray = array(
                            'total_marks'      => $courseTotalMarks,
                            'total_pass_marks' => $coursePassMarks
                        );

                        $this->assessment_marks_model->updateCoursePassMarks($nosDetails[0]['course_id_fk'], $updateArray);

                        $updateArray['idHash'] = $idHash;
                    }
                    echo json_encode($updateArray);
                }
            }
        }
    }

    public function getNosDetailsToUpdate($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if (!empty($id_hash)) {

                $data = array(
                    'nos_details'   => $this->assessment_marks_model->getNosDetailsToUpdate($id_hash)[0],
                    'nos_type_list' => $this->assessment_marks_model->getAllNosType(),
                );

                $theory    = $data['nos_details']['nos_theory_marks'];
                $practical = $data['nos_details']['nos_practical_marks'];
                $viva      = ($data['nos_details']['nos_viva_marks']) ? $data['nos_details']['nos_viva_marks'] : 0;

                $data['nos_details']['tmp_total_marks'] = $data['nos_details']['total_marks'] - ($theory + $practical + $viva);

                // parent::pre($data);

                $html_view = $this->load->view($this->config->item('theme') . 'master/assessment_marks/update_nos_details_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    public function update_nos_marks()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $nos_details = array(
                'course_marks_id_pk'   => set_value('course_marks_row'),
                'course_id_fk'         => set_value('course'),
                'tmp_total_marks'      => set_value('tmp_marks'),
                'nos_type'             => set_value('nos_type'),
                'nos_name'             => set_value('nos_name'),
                'nos_code'             => set_value('nos_code'),
                'nos_theory_marks'     => set_value('nos_theory_marks'),
                'nos_practical_marks'  => set_value('nos_practical_marks'),
                'nos_viva_marks'       => set_value('nos_viva_marks'),
                'theory_pass_marks'    => set_value('theory_pass_marks'),
                'practical_pass_marks' => set_value('practical_pass_marks'),
                'viva_pass_marks'      => set_value('viva_pass_marks'),
                'nos_wise_no_of_theory_question'    => set_value('nos_wise_no_of_theory_question'),
                'no_of_marks_each_question_carries' => set_value('no_of_marks_each_question_carries'),
                'pass_marks_for_each_nos'           => set_value('pass_marks_for_each_nos'),
                'total_marks'          => set_value('total_marks_for_job_role'),
                'total_pass_marks'     => set_value('pass_marks_for_job_role'),
                'pass_in_every_nos'    => set_value('pass_in_every_nos'),
            );

            $nos_type_list = $this->assessment_marks_model->getAllNosType();

            $data = array(
                'nos_details'   => $nos_details,
                'nos_type_list' => $nos_type_list,
            );

            $config = array(
                array(
                    'field' => 'nos_name',
                    'label' => 'NoS Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'nos_code',
                    'label' => 'NoS Code',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'nos_type',
                    'label' => 'NoS Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'nos_theory_marks',
                    'label' => 'NoS Theory Marks',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'nos_practical_marks',
                    'label' => 'NoS Practical Marks',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'pass_marks_for_job_role',
                    'label' => 'Pass Marks for Job Role',
                    'rules' => 'trim|required|numeric|less_than_equal_to[' . $this->input->post('total_marks_for_job_role') . ']'
                ),
                array(
                    'field' => 'nos_wise_no_of_theory_question',
                    'label' => 'Number of Theory Question',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'no_of_marks_each_question_carries',
                    'label' => 'Marks Each Question Carries',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'pass_in_every_nos',
                    'label' => 'Pass Every NoS',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $html_view = $this->load->view($this->config->item('theme') . 'master/assessment_marks/update_nos_details_view', $data, TRUE);

                $response  = array(
                    'html_view'  => $html_view,
                    'res_status' => 0
                );

                echo json_encode($response);
            } else {

                if ($nos_details['nos_theory_marks'] < ($nos_details['nos_wise_no_of_theory_question'] * $nos_details['no_of_marks_each_question_carries'])) {

                    $data['mismatched_marks'] = 1;
                    $html_view = $this->load->view($this->config->item('theme') . 'master/assessment_marks/update_nos_details_view', $data, TRUE);

                    $response  = array(
                        'html_view'  => $html_view,
                        'res_status' => 0
                    );

                    echo json_encode($response);

                    exit();
                } else {

                    $nos_viva_marks  = $this->input->post('nos_viva_marks');
                    $viva_pass_marks = $this->input->post('viva_pass_marks');

                    if ($nos_viva_marks == 0 || $nos_viva_marks == NULL) {
                        $nos_viva_marks = NULL;
                        $viva_pass_marks = NULL;
                    } elseif ($viva_pass_marks == 0 || $viva_pass_marks == NULL) {
                        $viva_pass_marks = NULL;
                    }

                    $update_nos_array = array(
                        'nos_name'             => $this->input->post('nos_name'),
                        'nos_code'             => $this->input->post('nos_code'),
                        'nos_type'             => $this->input->post('nos_type'),
                        'nos_theory_marks'     => $this->input->post('nos_theory_marks'),
                        'nos_practical_marks'  => $this->input->post('nos_practical_marks'),
                        'nos_viva_marks'       => $nos_viva_marks,
                        'theory_pass_marks'    => ($this->input->post('theory_pass_marks') == NULL) ? NULL : $this->input->post('theory_pass_marks'),
                        'practical_pass_marks' => ($this->input->post('practical_pass_marks') == NULL) ? NULL : $this->input->post('practical_pass_marks'),
                        'viva_pass_marks'      => $viva_pass_marks,
                        'pass_marks_for_each_nos' => ($this->input->post('pass_marks_for_each_nos') == NULL) ? NULL : $this->input->post('pass_marks_for_each_nos'),
                        'nos_wise_no_of_theory_question'    => $this->input->post('nos_wise_no_of_theory_question'),
                        'no_of_marks_each_question_carries' => $this->input->post('no_of_marks_each_question_carries'),
                    );

                    $result = $this->assessment_marks_model->updateNosMarks($nos_details['course_marks_id_pk'], $update_nos_array);

                    if ($result) {

                        $update_pass_marks_array = array(
                            'total_marks'       => $this->input->post('total_marks_for_job_role'),
                            'total_pass_marks'  => $this->input->post('pass_marks_for_job_role'),
                            'pass_in_every_nos' => $this->input->post('pass_in_every_nos'),
                        );
                        $result = $this->assessment_marks_model->updateCoursePassMarks($nos_details['course_id_fk'], $update_pass_marks_array);

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'NoS successfully updated.');

                        $response  = array('res_status' => 1);
                        echo json_encode($response);
                    }
                }
            }
        }
    }
}

/* End of file Map_district.php */