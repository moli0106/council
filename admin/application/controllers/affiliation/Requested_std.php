<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Requested_std extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(157);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/requested_std_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/requested_std.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0){

        $data['offset'] = 0;
        $this->load->library('pagination');

        $config['base_url']         = 'affiliatio/requested_std/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->requested_std_model->getRequestedDataCount()[0]['count'];
        $config['per_page']         = 50;
        $config['num_links']        = 9;
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
        $data['requested_list']  = $this->requested_std_model->getAllRequestedData($config['per_page'], $offset);
        $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_request_view', $data);

    }

    public function approveStudentRequest(){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($group_id !=NULL){
                
            }
        }
    }
}