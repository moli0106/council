<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Test_pdf extends NIC_Controller {

    public function __construct(){
		parent::__construct();
		//$this->output->enable_profiler(TRUE);
		//redirect("https://www.pbssd.gov.in/council/admin/maintenance");
		$this->load->model("login_model");
		$this->load->library('sms');
	}

    public function index(){

        $html = $this->load->view($this->config->item('theme') . 'test_pdf/admit_3.html', true);
       // $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
        $pdfFilePath = 'VTC-Details-' . date('dmY') . ".pdf";
 
        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
        $this->m_pdf->pdf->showWatermarkText = true;

       
 
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
    }

}
?>