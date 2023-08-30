<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends NIC_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege();
		$this->load->model('Dashboard_model');
		// $this->output->enable_profiler(TRUE);

		if ($this->session->userdata('stake_id_fk') == 2) {
			$this->load->model('Sao_dashboard_model');

			$this->css_head = array(
				1 => $this->config->item('theme_uri') . 'dashboard/css/easy-responsive-tabs.css',
				2 => $this->config->item('theme_uri') . 'dashboard/css/owl.carousel.css',

			);
			$this->js_foot = array(
				1 => $this->config->item('theme_uri') . 'dashboard/js/easy-responsive-tabs.js',
				2 => $this->config->item('theme_uri') . 'dashboard/js/owl.carousel.js',
				9 => $this->config->item('theme_uri') . 'dashboard/js/sao_dashboard.js',
			);
		}

		if ($this->session->userdata('stake_id_fk') == 15) {
			$this->load->model('affiliation/vtc_model');
			$this->js_foot = array(

				0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
			);
		}

		if($this->session->userdata('stake_id_fk') == 29){
			$this->load->model('seat_filling/std_seat_filling_model');
		}
	}

	public function index()
	{
		// echo "hii";exit;
		$stake_id = $this->session->userdata('stake_id_fk');

		if ($stake_id == 2) {
			$data['stake_name']    = "SAO WBSCTETSD";

			$data['assessor'] = array(
				'pre_registration'     => $this->Sao_dashboard_model->getAssessorPreRegistrationCount()->count,
				'final_application'    => $this->Sao_dashboard_model->getAssessorFinalApplicationCount()->count,
				'aproved_application'  => $this->Sao_dashboard_model->getAssessorAprovedApplicationCount()->count,
				'rejected_application' => $this->Sao_dashboard_model->getAssessorRejectedApplicationCount()->count,
			);

			$data['sector_course'] = array(
				'sector_count' => $this->Sao_dashboard_model->getTotalSectorCount()->count,
				'course_count' => $this->Sao_dashboard_model->getTotalCourseCount()->count,
			);
		} elseif ($stake_id == 3) {
			$data['stake_name'] 		= "Assessor";
		} elseif ($stake_id == 4) {
			$data['stake_name'] 		= "Admin Lavel 2";
		} elseif ($stake_id == 5) {
			$data['stake_name'] 		= "Admin Lavel 1";
		} elseif ($stake_id == 12) {
			$data['stake_name'] 		= "Admin Assessing Body";
		} elseif ($stake_id == 13) {
			$data['stake_name'] 		= "Admin Awarding Body";
		} elseif ($stake_id == 15) {
			$data['stake_name'] 		= "VTC / STTC Affiliation";
			$data['vtcUdiseCode'] = $this->vtc_model->getUdiseCodeStatus($this->session->userdata('stake_details_id_fk'));
			// echo "<pre>";print_r($data['vtcUdiseCode']);exit;
		} elseif ($stake_id == 22) {

			$data['stake_name'] 		= "CSS VSE School";
			$this->load->model('dashboard/cssvse_dashboard_model');

			$data['studentCount'] = $this->cssvse_dashboard_model->countStudentList($this->session->userdata('stake_details_id_fk'))[0];
			$data['batchCount'] = $this->cssvse_dashboard_model->countBatchList($this->session->userdata('stake_details_id_fk'))[0];
		}
		// elseif ($stake_id == 29) { //added by moli on 29-06-2023
		// 	$data['std_status'] = $this->std_seat_filling_model->getStdStatus($this->session->userdata('stake_details_id_fk'));
		// }
		if($stake_id == 29){
			if($data['std_status']['counselling_updated_status'] !=1){

				redirect('admin/student_profile/std_profile');
			}else{
				redirect('admin/student_profile/std_profile/view_details');

			}
		}
		else{

			$this->load->view($this->config->item('theme') . 'council_dashboard_view', $data);
		}
	}

	public function updateVTCUdiseCode(){
		// echo "<pre>";print_r($_POST);exit;
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$vtc_id_pk = $this->input->post('vtc_id_pk');
			$have_udise = $this->input->post('have_udise');
			$udise_code = $this->input->post('udise_code');

			$updArray = array(
				'udise_code_status'  => $have_udise,
				'udise_code'     => ($udise_code == '')? NULL : $udise_code,
			);
			$result = $this->vtc_model->updateVTCUdiseCode($vtc_id_pk,$updArray);
			if($result){
				redirect(base_url('admin/dashboard'));
			}
		}
	}
}
