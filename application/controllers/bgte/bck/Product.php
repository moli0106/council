<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        //$this->load->model('welcome_model');
        //$this->output->enable_profiler(TRUE);
    }

    public function details()
    {
        $data['data'] = '';
        $this->load->view('themes/bgte_theme/product-details-view', $data);
    }
}
