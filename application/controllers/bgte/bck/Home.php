<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('welcome_model');
        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['data'] = '';
        $this->load->view('themes/bgte_theme/home-view', $data);
    }
}
