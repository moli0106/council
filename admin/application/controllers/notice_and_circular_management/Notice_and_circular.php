<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notice_and_circular extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(77);
        // parent::check_privilege(49);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('notice_and_circular_management/notice_and_circular_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . 'notice_and_circular_management/notice_and_circular.js',
        );
    }

    // ! List all notice and circular list
    public function index($offset = 0)
    {
        $this->title = 'Notice & Circular List';

        $data['offset'] = $offset;
        $this->load->library('pagination');

        $config['base_url']         = 'notice_and_circular_management/notice_and_circular/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->notice_and_circular_model->getPublicationListCount()[0]['count'];
        $config['per_page']         = 20;
        $config['num_links']        = 5;
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

        $data['publicationList'] = $this->notice_and_circular_model->getPublicationList($config['per_page'], $offset);

        $data['page_links']  = $this->pagination->create_links();

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'notice_and_circular_management/notice_and_circular_list_view', $data);
    }

    // ! Add notice and circular
    public function add()
    {
        $this->title = 'Add Notice & Circular';

        $data = array(
            'publicationTypeList' => $this->notice_and_circular_model->getPublicationTypeList()
        );

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $config = array(
                array(
                    'field' => 'publication_type',
                    'label' => 'Publication Type',
                    'rules' => 'required'

                ),
                array(
                    'field' => 'publication_title',
                    'label' => 'Title',
                    // 'rules' => 'trim|required|max_length[100]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'publication_description',
                    'label' => 'Description',
                    // 'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                    'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'document_no',
                    'label' => 'Document No',
                    'rules' => 'trim|max_length[100]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'published_date',
                    'label' => 'Issue/Publishing Date',
                    'rules' => 'trim'
                )
            );
            $this->form_validation->set_rules($config);

            $this->form_validation->set_rules('publication_file', 'Publication Upload file', 'trim|callback_file_validation[publication_file|application/pdf|50120|required]');

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'notice_and_circular_management/notice_and_circular_add_view', $data);
            } else {

                $result = $this->notice_and_circular_model->insertPublications(
                    array(
                        'publication_type_id_fk'   => $this->input->post('publication_type'),
                        'publication_title'        => $this->input->post('publication_title'),
                        'document_no'              => ($this->input->post('document_no') != NULL) ? $this->input->post('document_no') : NULL,
                        'published_date'           => ($this->input->post('published_date') != NULL) ? $this->_us_date_format($this->input->post('published_date')) : NULL,
                        'start_date'               => ($this->input->post('start_date') != NULL) ? $this->_us_date_format($this->input->post('start_date')) : NULL,
                        'end_date'                 => ($this->input->post('end_date') != NULL) ? $this->_us_date_format($this->input->post('end_date')) : NULL,
                        'publication_description'  => $this->input->post('publication_description'),
                        'uploaded_file'            => base64_encode(file_get_contents($_FILES["publication_file"]['tmp_name'])),
                        'active_status'            => 1,
                        'upload_time'              => date('Y-m-d H:i:s'),
                        'entry_ip'                 => $this->input->ip_address(),
                        'entry_by_id'              => $this->session->userdata('stake_holder_login_id_pk')
                    )
                );

                if ($result > 0) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Notice / Circular add successfully.');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                }

                redirect('admin/notice_and_circular_management/notice_and_circular');
            }
        } else {

            $this->load->view($this->config->item('theme') . 'notice_and_circular_management/notice_and_circular_add_view', $data);
        }
    }

    // ! View details of notice and circular 
    public function details($id_hash = NULL)
    {
        $this->title = 'Notice & Circular Details';

        if ($id_hash != NULL) {

            $result = $this->notice_and_circular_model->getPublicationDetails($id_hash);
            // echo "<pre>";print_r($result);exit;
            if (!empty($result)) {

                if ($result[0]['published_date'] != NULL) {

                    $result[0]['published_date'] = date('d/m/Y', strtotime($result[0]['published_date']));
                }

                if ($result[0]['start_date'] != NULL) {

                    $result[0]['start_date'] = date('d/m/Y', strtotime($result[0]['start_date']));
                }

                if ($result[0]['end_date'] != NULL) {

                    $result[0]['end_date'] = date('d/m/Y', strtotime($result[0]['end_date']));
                }

                $data = array(
                    'publicationDetails'  => $result[0],
                    'publicationTypeList' => $this->notice_and_circular_model->getPublicationTypeList()
                );
                // parent::pre($data);

                $this->load->view($this->config->item('theme') . 'notice_and_circular_management/notice_and_circular_details_view', $data);
            } else {

                redirect('admin/notice_and_circular_management/notice_and_circular');
            }
        } else {

            redirect('admin/notice_and_circular_management/notice_and_circular');
        }
    }

    // ! Update notice and circular
    public function update()
    {

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $id_hash = $this->input->post('id_hash');
            if (!empty($id_hash)) {

                $result = $this->notice_and_circular_model->getPublicationDetails($this->input->post('id_hash'));

                $data['publicationTypeList'] = $this->notice_and_circular_model->getPublicationTypeList();

                $data['publicationDetails']  = array(
                    'publication_id_pk'       => $result[0]['publication_id_pk'],
                    'publication_type_id_fk'  => set_value('publication_type'),
                    'publication_title'       => set_value('publication_title'),
                    'document_no'             => set_value('document_no'),
                    'published_date'          => set_value('published_date'),
                    'start_date'              => set_value('start_date'),
                    'end_date'                => set_value('end_date'),
                    'publication_description' => set_value('publication_description'),
                    'approve_status' => set_value('approve_status')
                );

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $config = array(
                    array(
                        'field' => 'publication_type',
                        'label' => 'Publication Type',
                        'rules' => 'required'

                    ),
                    array(
                        'field' => 'publication_title',
                        'label' => 'Title',
                        'rules' => 'trim|required|max_length[100]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),
                    array(
                        'field' => 'publication_description',
                        'label' => 'Description',
                        'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),
                    array(
                        'field' => 'document_no',
                        'label' => 'Document No',
                        'rules' => 'trim|regex_match[/^[a-zA-Z0-9-_,.()\/ ]+$/]',
                        'errors' => array(
                            'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                        )
                    ),
                    array(
                        'field' => 'published_date',
                        'label' => 'Issue/Publishing Date',
                        'rules' => 'trim'
                    )
                );
                $this->form_validation->set_rules($config);

                if (!empty($_FILES['publication_file']['tmp_name'])) {
                    $this->form_validation->set_rules('publication_file', 'Publication Upload file', 'trim|callback_file_validation[publication_file|application/pdf|50120|required]');
                }

                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme') . 'notice_and_circular_management/notice_and_circular_details_view', $data);
                } else {

                    $update_array = array(
                        'publication_type_id_fk'   => $this->input->post('publication_type'),
                        'publication_title'        => $this->input->post('publication_title'),
                        'document_no'              => $this->input->post('document_no'),
                        'published_date'           => $this->_us_date_format($this->input->post('published_date')),
                        'start_date'               => ($this->input->post('start_date') != NULL) ? $this->_us_date_format($this->input->post('start_date')) : NULL,
                        'end_date'                 => ($this->input->post('end_date') != NULL) ? $this->_us_date_format($this->input->post('end_date')) : NULL,
                        'publication_description'  => $this->input->post('publication_description'),
                        'active_status'            => 1,
                        'upload_time'              => date('Y-m-d H:i:s'),
                        'entry_ip'                 => $this->input->ip_address(),
                        'entry_by_id'              => $this->session->userdata('stake_holder_login_id_pk')
                    );

                    if (!empty($_FILES['publication_file']['tmp_name'])) {
                        $update_array['uploaded_file'] = base64_encode(file_get_contents($_FILES["publication_file"]['tmp_name']));
                    }

                    $result = $this->notice_and_circular_model->updatePublication($this->input->post('id_hash'), $update_array);

                    if ($result > 0) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Notice / Circular updated successfully.');
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');
                    }

                    redirect('admin/notice_and_circular_management/notice_and_circular');
                }
            } else {

                redirect('admin/notice_and_circular_management/notice_and_circular');
            }
        } else {

            redirect('admin/notice_and_circular_management/notice_and_circular');
        }
    }

    // ! Change status of notice and circular
    public function change_status()
    {
        if (!$this->input->is_ajax_request()) {

            exit('No direct script access allowed');
        } else {
            $id_hash = $this->input->get('id_hash');
            if (!empty($id_hash)) {

                $result = $this->notice_and_circular_model->getPublicationDetails($this->input->get('id_hash'));

                if ($result[0]['approve_status'] == 1) {

                    $update_array = array('approve_status' => 0);
                } else {

                    $update_array = array('approve_status' => 1);
                }

                $result = $this->notice_and_circular_model->updatePublication($this->input->get('id_hash'), $update_array);

                if ($result > 0) {

                    echo json_encode('done');
                }
            }
        }
    }

    // ! Download uploaded PDF of notice and circular 
    public function download_uploaded_pdf($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $result = $this->notice_and_circular_model->getPublicationDetails($id_hash);
            if (!empty($result)) {

                $result = $result[0];

                $uploaded_file     = $result['uploaded_file'];
                // $publication_title = $result['publication_title'];
                $publication_title = time();

                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename=" . $publication_title . ".pdf");

                echo base64_decode($uploaded_file);
            } else {

                redirect('admin/notice_and_circular_management/notice_and_circular');
            }
        } else {

            redirect('admin/notice_and_circular_management/notice_and_circular');
        }
    }

    // ! File validation function
    public function file_validation($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);

        if ($file_array[1] == "application/pdf") {
            $ext = "PDF";
        } elseif ($file_array[1] == "image/jpeg") {
            $ext = "JPG";
        }

        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];

            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
    }

    private function _us_date_format($uk_date = NULL)
    {
        if ($uk_date != NULL) {
            $date_array = explode('/', $uk_date);
            return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
        } else {
            show_404();
        }
    }
}
