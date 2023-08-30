<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends NIC_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('notices_and_circulars_model');
		$this->load->model('welcome_model');
		//$this->output->enable_profiler(TRUE);
	}

	public function index()
	{
		$data['notice'] = $this->notices_and_circulars_model->get_publication(6, 0);
		//$data['product_list'] = $this->welcome_model->getExhibitionProductList();

		$this->load->view($this->config->item('theme') . 'welcome_view', $data);
		//$this->load->view($this->config->item('theme') . 'maintaince_view');
	}

	public function download($id_hash = NULL)
	{
		if ($id_hash != NULL) {

			$result = $this->notices_and_circulars_model->get_publication_details($id_hash);
			if (!empty($result)) {

				$result = $result[0];

				$uploaded_file     = $result['uploaded_file'];
				$publication_title = time();

				header("Content-type:application/pdf");
				header("Content-Disposition:attachment;filename=" . $publication_title . ".pdf");

				echo base64_decode($uploaded_file);
			} else {

				redirect(base_url());
			}
		} else {

			redirect(base_url());
		}
	}
}
