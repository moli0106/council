<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pre_admission extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(153);
        $this->load->model('spot_council/spot_council_pre_admission_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            // 2 => $this->config->item('theme_uri') . "spot_council/vacent_college_list.js",
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
        );
    }
    public function index($offset = 0)
    {


        $data['offset']         = $offset;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $config['base_url']         = 'spot_council/student_marit_list/index/';
        $data["total_rows"] = $config['total_rows']       = $this->spot_council_pre_admission_model->get_pre_admission_student_count()[0]['count'];
        $config['per_page']         = 50;
        $config['num_links']        = 2;
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

        $data['page_links']     = $this->pagination->create_links();

        $this->db->trans_start();

        $data['pre_admission_data']      = $this->spot_council_pre_admission_model->get_pre_admission_data($config['per_page'], $offset);

        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $this->form_validation->set_rules('application_form_no', '<b>Application Form No</b>', 'trim|required|max_length[100]|is_unique[council_polytechnic_spotcouncil_pre_admission_details.application_form_no]');

        //print_r($data['sectors']);


        if ($this->form_validation->run() == FALSE) {
            $data['pre_admission_details']      = $this->spot_council_pre_admission_model->get_pre_admission_data($config['per_page'], $offset);

            $this->load->view($this->config->item('theme') . 'spot_council/pre_admission_list_view', $data);
        } else {

            $application_form_no = $this->input->post('application_form_no');

            $student_data = $this->spot_council_pre_admission_model->get_application_wise_student($application_form_no);

            if (empty($student_data)) {
                $data['status'] = 'warning';
                $data['message'] = "Please input a valid Application form No.";
                $data['pre_admission_details'] = $this->spot_council_pre_admission_model->get_pre_admission_data($config['per_page'], $offset);
            } else {

                // echo '<pre>'; print_r($student_data);die;

                $insert_array = array(
                    'table_name' => 'council_polytechnic_spotcouncil_pre_admission_details',
                    'data'       => array(
                        'application_form_no' => $student_data['application_form_no'],
                        'student_id_fk' => $student_data['student_details_id_pk'],
                        'course_id_fk_admission' => $student_data['course_id_fk'],
                        'registration_year' => $student_data['registration_year'],
                        'general_rank' => $student_data['general_rank'],
                        'sc_rank' => $student_data['sc_rank'],
                        'st_rank' => $student_data['st_rank'],
                        'pc_rank' => $student_data['pc_rank'],
                        'obc_a_rank' => $student_data['obc_a'],
                        'obc_b_rank' => $student_data['obc_b'],
                        // 'booking_status' => 1,
                        'entry_time' => 'now()',
                        'entry_ip' => $this->input->ip_address(),
                        'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
                        'active_status' => 1
                    )
                );
                $insert_status = $this->spot_council_pre_admission_model->insertData($insert_array);
                if ($insert_status) {

                    $update_status = $this->spot_council_pre_admission_model->update_data('council_polytechnic_spotcouncil_student_details', array('pre_admission_status' => 1), $student_data['student_details_id_pk']);

                    if ($this->db->trans_status() === FALSE) {

                        $this->db->trans_rollback(); # Something went wrong.

                        $data['status'] = 'warning';
                        $data['message'] = "Something went wrong. Please try after sometime.";
                        $data['pre_admission_details'] = $this->spot_council_pre_admission_model->get_pre_admission_data($config['per_page'], $offset);
                    } else {
                        $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

                        $data['status'] = 'success';
                        $data['message'] = "Application Form Number has been successfully inserted";
                        $data['pre_admission_details'] = $this->spot_council_pre_admission_model->get_pre_admission_data($config['per_page'], $offset);
                    }
                } else {
                    $data['status'] = 'warning';
                    $data['message'] = "Something went wrong. Please try after sometime.";
                    $data['pre_admission_details'] = $this->spot_council_pre_admission_model->get_pre_admission_data($config['per_page'], $offset);
                }
            }

                $this->load->view($this->config->item('theme') . 'spot_council/pre_admission_list_view', $data);
            
        }
    }
}
