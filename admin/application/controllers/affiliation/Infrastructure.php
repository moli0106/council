<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Infrastructure extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(71);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/infrastructure_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/vtc.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index()
    {
        $data = array();
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/infrastructure_view', $data);
    }
}
