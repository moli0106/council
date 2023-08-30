<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("bgte/home_model");
        //$this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $data['product_list'] = $this->home_model->getExhibitionProductList();
        //print_r($data['product_list']);die;
        $this->load->view('themes/bgte_theme/home-view', $data);
    }

    public function details($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $data["product_details"] = $this->home_model->getProductDetails($id_hash);
            if (!empty($data["product_details"])) {
                $this->load->view('themes/bgte_theme/product-details-view', $data);
            } else {
                redirect(base_url('bgte/home'), 'refresh');
            }
        } else {
            redirect(base_url('bgte/home'), 'refresh');
        }
    }
}
