<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_type_mark extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(88);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('qbm_master/question_type_mark_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0)
    {
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'question_type',
                    'label' => 'Question Type',
                    'rules' => 'trim|required|max_length[100]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'question_mark',
                    'label' => 'Question Mark',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'hs_voc_xi',
                    'label' => 'HS-VOC (XI)',
                    'rules' => 'trim|numeric'
                ),
                array(
                    'field' => 'hs_voc_xii',
                    'label' => 'HS-VOC (XII)',
                    'rules' => 'trim|numeric'
                ),
                array(
                    'field' => 'polytechnic',
                    'label' => 'Polytechnic',
                    'rules' => 'trim|numeric'
                ),
                array(
                    'field' => 'pharmacy',
                    'label' => 'Pharmacy',
                    'rules' => 'trim|numeric'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {

                $post_data = array(
                    'question_type_name'  => $this->input->post('question_type'),
                    'question_mark'         => $this->input->post('question_mark'),
                    'hs_voc_xi'                => ($this->input->post('hs_voc_xi') == NULL) ? NULL : $this->input->post('hs_voc_xi'),
                    'hs_voc_xii'               => ($this->input->post('hs_voc_xii') == NULL) ? NULL : $this->input->post('hs_voc_xii'),
                    'polytechnic'            => ($this->input->post('polytechnic') == NULL) ? NULL : $this->input->post('polytechnic'),
                    'pharmacy'             => ($this->input->post('pharmacy') == NULL) ? NULL : $this->input->post('pharmacy'),
                    'entry_ip'                  => $this->input->ip_address(),
                    'inserted_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                => 'now()',
                    'active_status'             => 1
                );

                $last_id = $this->question_type_mark_model->insertQuestionCategory($post_data);

                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Question Category/Type & Mark added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect('admin/qbm_master/question_type_mark');
            }
        }

        $data['offset'] = $offset;
        $this->load->library('pagination');

        $config['base_url']         = 'qbm_master/question_type_mark/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->question_type_mark_model->getQuestionCategoryCount()[0]['count'];
        $config['per_page']         = 25;
        $config['num_links']        = 2;
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

        $data['page_links']  = $this->pagination->create_links();
        $data['questionCategory'] = $this->question_type_mark_model->getAllQuestionCategory($config['per_page'], $offset);

        $this->load->view($this->config->item('theme') . 'qbm_master/question_category/question_type_mark_list_view', $data);
    }

    public function update($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $result = $this->question_type_mark_model->getQuestionCategoryById($id_hash);
            if (!empty($result)) {

                if ($this->input->server("REQUEST_METHOD") == 'POST') {

                    $data['form_data']['question_type_mark_id_pk']    = set_value('question_type_mark_id_pk');
                    $data['form_data']['question_type_name']    = set_value('question_type_name');
                    $data['form_data']['question_mark']          = set_value('question_mark');
                    $data['form_data']['hs_voc_xi']                 = set_value('hs_voc_xi');
                    $data['form_data']['hs_voc_xii']                 = set_value('hs_voc_xii');
                    $data['form_data']['polytechnic']              = set_value('polytechnic');
                    $data['form_data']['pharmacy']              = set_value('pharmacy');

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'question_type',
                            'label' => 'Question Type',
                            'rules' => 'trim|required|max_length[100]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                            'errors' => array(
                                'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                            )
                        ),
                        array(
                            'field' => 'question_mark',
                            'label' => 'Question Mark',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'hs_voc_xi',
                            'label' => 'HS-VOC (XI)',
                            'rules' => 'trim|numeric'
                        ),
                        array(
                            'field' => 'hs_voc_xii',
                            'label' => 'HS-VOC (XII)',
                            'rules' => 'trim|numeric'
                        ),
                        array(
                            'field' => 'polytechnic',
                            'label' => 'Polytechnic',
                            'rules' => 'trim|numeric'
                        ),
                        array(
                            'field' => 'pharmacy',
                            'label' => 'Pharmacy',
                            'rules' => 'trim|numeric'
                        ),
                    );
                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() != FALSE) {

                        $post_data = array(
                            'question_type_name'  => $this->input->post('question_type'),
                            'question_mark'         => $this->input->post('question_mark'),
                            'hs_voc_xi'                => ($this->input->post('hs_voc_xi') == NULL) ? NULL : $this->input->post('hs_voc_xi'),
                            'hs_voc_xii'               => ($this->input->post('hs_voc_xii') == NULL) ? NULL : $this->input->post('hs_voc_xii'),
                            'polytechnic'            => ($this->input->post('polytechnic') == NULL) ? NULL : $this->input->post('polytechnic'),
                            'pharmacy'             => ($this->input->post('pharmacy') == NULL) ? NULL : $this->input->post('pharmacy'),
                        );

                        $last_id = $this->question_type_mark_model->updateQuestionCategory($post_data, $this->input->post('question_type_mark_id_pk'));

                        if ($last_id) {

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Question Category/Type & Mark updated successfully.');
                        } else {
                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                        }

                        redirect('admin/qbm_master/question_type_mark');
                    }
                } else {

                    $data['form_data']['question_type_mark_id_pk']    = md5($result[0]['question_type_mark_id_pk']);
                    $data['form_data']['question_type_name']    = $result[0]['question_type_name'];
                    $data['form_data']['question_mark']          = $result[0]['question_mark'];
                    $data['form_data']['hs_voc_xi']                  = $result[0]['hs_voc_xi'];
                    $data['form_data']['hs_voc_xii']                 = $result[0]['hs_voc_xii'];
                    $data['form_data']['polytechnic']              = $result[0]['polytechnic'];
                    $data['form_data']['pharmacy']               = $result[0]['pharmacy'];
                }

                $this->load->view($this->config->item('theme') . 'qbm_master/question_category/question_type_mark_update_view', $data);
            } else {
                redirect(base_url('admin/qbm_master/question_type_mark'));
            }
        } else {
            redirect(base_url('admin/qbm_master/question_type_mark'));
        }
    }
}


/* End of file master_trainer.php */
