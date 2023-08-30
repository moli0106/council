<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_infrastructure_mis extends NIC_Controller
{
	public function __construct()
	{
		parent::__construct();
		// parent::check_privilege(149);
		$this->load->model('mis/vtc_mis_model');
		// $this->output->enable_profiler(TRUE);

		ini_set('memory_limit', '512M');
		ini_set('max_execution_time', 0);
	}

    public function index(){
        $data['nodallist'] = $this->vtc_mis_model->nodallistd();
		$data['yearlist']  = $this->vtc_mis_model->getAcademicYearList();
        $this->load->view($this->config->item('theme') . 'mis/vtc_mis/vtc_infrastructure_details_mis_view', $data);
    }

    public function download_vtc_infrastructure_details(){

        $this->load->library('excel');

		$academic_year = $this->uri->segment(4);
		$nodal_name = $this->uri->segment(5);

		$fileName = 'VTC_infrastucture_details_' . date('Yms') . '-' . time() . '.xls';

        if($academic_year == '2021-22'){

			$results   = array();
		}else{
			//$results   = $this->vtc_mis_model->getNewVtcTeacherList($academic_year,$teacher_type);

			$results   = $this->vtc_mis_model->getVtcInfrastructureDetailsByNodal($academic_year,$nodal_name); //getting HS-Voc Home Sc teachers
			echo "<pre>";print_r($results);exit;
		}
    }
}