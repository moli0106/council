<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessor_result extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(55);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('assessor_ems/assessor_result_model');
        $this->load->helper('email');

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'assessor_ems/assessor_result.js',
        );
    }

    // List all your items
    public function index($offset = 0)
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');

        /* $config['base_url']         = 'assessor_ems/assessor_result/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->assessor_result_model->getAssessorCount();
        $config['per_page']         = 20;
        $config['num_links']        = 10;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin">';
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

        $data['page_links']  = $this->pagination->create_links();*/
        $data['assessor_list'] = $this->assessor_result_model->getAssessorList();

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/assessor_list_view', $data);
    }

    public function assign_assessor_empanelled()
    {

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $map_id = $this->input->get('map_id');
            $dates  = $this->input->get('dataDate');

            if ($map_id != NULL && $dates != NULL) {

                $dateArray = explode(',', $dates);
                if ((count($dateArray) == 2) && ($dateArray[0] != NULL) && ($dateArray[1] != NULL)) {

                    $date1 = date('Y-m-d', strtotime($dateArray[0]));
                    $date2 = date('Y-m-d', strtotime($dateArray[1]));

                    $data = $this->assessor_result_model->getAssessorBatchMapDetails($map_id);

                    if (!empty($data)) {

                        if ($date1 > $date2) {
                            $data['batch_exam_date'] = date("Y-m-d", strtotime($date1 . " + 1 days"));
                        } else {
                            $data['batch_exam_date'] = date("Y-m-d", strtotime($date2 . " + 1 days"));
                        }

                        $validity_year = $this->config->item('empanelled_assessor_validity');
                        //$empanelment_validity = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data['batch_exam_date'] . " + 1 days")) . " + $validity_year year"));
                        $empanelment_validity = date("Y-m-d", strtotime($data['batch_exam_date'] . " + $validity_year year"));

                        $insertData = array(
                            'assessor_id_fk'       => $data['assessor_id_fk'],
                            'batch_id_fk'          => $data['batch_ems_id_pk'],
                            'sector_id_fk'         => $data['sector_id'],
                            'course_id_fk'         => $data['course_id'],
                            'empanelment_validity' => $empanelment_validity,
                            'active_status'        => 1,
                            'entry_time'           => "now()",
                            'entry_ip'             => $this->input->ip_address(),
                            'entry_by'             => $this->session->userdata('stake_holder_login_id_pk'),
                            'course_grouping_status' => 0,
                        );

                        $result = $this->assessor_result_model->assign_assessor_empanelled($insertData);
                        if ($result) {

                            // ! Empanelle Assessor For Course Grouping

                            $data['empanelment_validity']     = $empanelment_validity;
                            $empanelledCourseGrouping         = $this->empanelledCourseGrouping($data);
                            $data['empanelledCourseGrouping'] = $empanelledCourseGrouping;

                            // ! END

                            $this->load->helper('email');
                            $email_subject = "Council Empanelled Assessor Details";
                            $email_message = $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_empanelled_assessor', $data, TRUE);
                            $status = send_email($data['email_id'], $email_message, $email_subject);

                            if ($status) {
                                $this->assessor_result_model->upddateEmailStatus($result);
                            }

                            echo json_encode('success');
                        }
                    }
                }
            }
        }
    }

    public function empanelledCourseGrouping($data = NULL)
    {
        $empanelledCourseGrouping = array();

        if ((count($data) > 0) && ($data != NULL)) {

            $result = $this->assessor_result_model->getCourseGrouping($data['course_id']);
            if ((count($result) > 0) && !empty($result)) {

                foreach ($result as $key => $value) {

                    $status = $this->assessor_result_model->checkEmpanelledAssessor($data['assessor_id_fk'], $data['course_grouping_id_fk']);
                    if ((count($status) == 0) && empty($status)) {

                        $insertData = array(
                            'assessor_id_fk'         => $data['assessor_id_fk'],
                            'batch_id_fk'            => $data['batch_ems_id_pk'],
                            'sector_id_fk'           => $value['sector_id_fk'],
                            'course_id_fk'           => $value['course_grouping_id_fk'],
                            'empanelment_validity'   => $data['empanelment_validity'],
                            'active_status'          => 1,
                            'entry_time'             => "now()",
                            'entry_ip'               => $this->input->ip_address(),
                            'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                            'send_email_status'      => 1,
                            'send_email_date'        => "now()",
                            'course_grouping_status' => 1,
                        );

                        $result = $this->assessor_result_model->assign_assessor_empanelled($insertData);
                        if ($result) {

                            $empanelledCourseGrouping[] = array(
                                'course_name' => $value['course_name'],
                                'course_code' => $value['course_code'],
                            );
                        }
                    }
                }
            }
        }

        return $empanelledCourseGrouping;
    }

    public function assign_assessor_empanelled_old()
    {

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $map_id   = $this->input->get('map_id');
            if ($map_id != NULL) {

                $data = $this->assessor_result_model->getAssessorBatchMapDetails($map_id);
                if (!empty($data)) {

                    $validity_year = $this->config->item('empanelled_assessor_validity');

                    $empanelment_validity = date("Y-m-d", strtotime(date("Y-m-d", strtotime($data['batch_exam_date'] . " + 1 days")) . " + $validity_year year"));

                    $insertData = array(
                        'assessor_id_fk'       => $data['assessor_id_fk'],
                        'batch_id_fk'          => $data['batch_ems_id_pk'],
                        'sector_id_fk'         => $data['sector_id'],
                        'course_id_fk'         => $data['course_id'],
                        'empanelment_validity' => $empanelment_validity,
                        'active_status'        => 1,
                        'entry_time'           => "now()",
                        'entry_ip'             => $this->input->ip_address(),
                        'entry_by'             => $this->session->userdata('stake_holder_login_id_pk'),
                    );

                    parent::pre($insertData);

                    $result = $this->assessor_result_model->assign_assessor_empanelled($insertData);
                    if ($result) {
                        // $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_empanelled_assessor', $data);

                        /* $this->load->helper('email');
                        $email_subject = "Council Empanelled Assessor Details.";
                        $email_message = $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_empanelled_assessor', $data, TRUE);
                        send_email($this->input->post('email'), $email_message, $email_subject); */
                        $this->load->helper('email');
                        $email_subject = "Council Empanelled Assessor Details.";
                        $email_message = $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_empanelled_assessor', $data, TRUE);
                        $status = send_email($data['email_id'], $email_message, $email_subject);

                        if ($status) {

                            $this->assessor_result_model->upddateEmailStatus($data['assessor_id_fk']);
                        }

                        // echo json_encode('success');
                        echo json_encode('success');
                    }
                }
            }
        }
    }

    public function send_empanelled_email()
    {
        $this->load->helper('email');

        $data = $this->assessor_result_model->getOldEmpanelledAssessorList();
        // parent::pre([count($data), $data]);

        foreach ($data as $key => $value) {

            // $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_old_empanelled_assessor', $data);

            $email_subject = "Council Empanelled Assessor Details.";
            // $email_message = $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_empanelled_assessor', $data, TRUE);
            $email_message = $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_result/email_template_old_empanelled_assessor', $value, TRUE);
            $status = send_email($value['email_id'], $email_message, $email_subject);

            if ($status) {

                $this->assessor_result_model->upddateEmailStatus($value['empanelled_id_pk']);
            } else {
                echo '<pre>';
                print_r($value);
                echo '<pre>';
            }
        }
    }
}

/* End of file Assessor_batch.php */
