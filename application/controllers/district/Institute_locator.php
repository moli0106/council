<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Institute_locator extends NIC_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('district/institute_locator_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function dist($id=NULL){
        //$this->output->enable_profiler();
		$data["dist_names"] = array();
		$data["dists"] = array();
		if($id > 25 || $id <= 0){
            show_404();
        } else {
            $data['dists'] = $this->institute_locator_model->get_dist_data($id);
			$data["dist_names"] =$this->institute_locator_model->get_dist();
            //print_r($data['dist_names']);
            $this->load->view($this->config->item('theme').'district/institute_locator_view',$data);
        }
		
	}
	
}
