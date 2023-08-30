<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Preintimation extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(38);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('assessment/preintimation_model');
    }

    // ! List all assessment list
    public function index($offset = 0)
    {
        $data['offset'] = $offset;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['page_links']     = '';
            $data['sector_list']    = $this->preintimation_model->getAllSector();

            $searchArray = array(
                'sector_code'   => $this->input->post('sector_code'),
                'course_code'   => $this->input->post('course_code'),
            );

            $data['preintimation_list']  = $this->preintimation_model->searchPreintimation($searchArray);

            // parent::pre($data);
            $this->load->view($this->config->item('theme') . 'assessment/preintimation_list_view', $data);
        } else {
            $this->load->library('pagination');

            $config['base_url']         = 'assessment/preintimation/index/';
            $data["total_rows"]         = $config['total_rows'] = $this->preintimation_model->getPreintimationCount()[0]['count'];
            $config['per_page']         = 10;
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
            $data['page_links'] = $this->pagination->create_links();

            $data['preintimation_list']  = $this->preintimation_model->getAllPreintimation($config['per_page'], $offset);

            $data['sector_list']    = $this->preintimation_model->getAllSector();

            // parent::pre($data);
            $this->load->view($this->config->item('theme') . 'assessment/preintimation_list_view', $data);
        }
    }

    public function getCourseBySector($sector_code = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $sector_code = $this->input->get('sector_code');

            if ($sector_code != NULL) {

                $html   = '<option value="" hiddden="true">Select Course</option>';
                $result = $this->preintimation_model->getCourseBySector($sector_code);

                if (!empty($result)) {
                    foreach ($result as $key => $course) {

                        $html .= '<option value="' . $course['course_code'] . '">' . $course['course_name'] . ' [' . $course['course_code'] . ']</option>';
                    }
                } else {

                    $html = '<option value="" disabled="true">No course found...</option>';
                }

                echo json_encode($html);
            }
        }
    }
}
