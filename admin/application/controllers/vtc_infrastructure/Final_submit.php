<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Final_submit extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/final_submit_model');

        // added by moli
        $this->load->model('affiliation/vtc_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/infrastructure.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0){
        
        $data['offset'] = $offset;
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->final_submit_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

        if(!empty($data['vtcDetails'])){

            $data['paperLabData'] = $this->final_submit_model->getVTCPaperLabData($data['vtc_id'], $data['vtcDetails']['academic_year']);

            $data['commonLabData'] = $this->final_submit_model->getAllCommonLabData($data['vtc_id'], $data['vtcDetails']['academic_year']);

            $data['classRoomData'] = $this->final_submit_model->getVTCClassRoomData($data['vtc_id'], $data['vtcDetails']['academic_year']);
            $data['labSizeData'] = $this->final_submit_model->getLabSizeDetails($data['vtc_id'], $data['vtcDetails']['academic_year']);

            $data['otherData'] = $this->final_submit_model->getOtherInfarstructureDetails($data['vtc_id'],$data['vtcDetails']['academic_year']);

            $data['computerLabData'] = $this->final_submit_model->getComputerLabDetails($data['vtc_id'],$data['vtcDetails']['academic_year']);

            
            
        }
        
        $data['checkPaperLabDataCount']= $this->final_submit_model->checkPaperLabDataCount($data['vtc_id'],$data['vtcDetails']['academic_year']);


        $data['vtcHSCourseList'] = $this->final_submit_model->checkVtcHSCourseExist($data['vtc_id'], $data['vtcDetails']['academic_year']);

        if(!empty($data['vtcHSCourseList'])){

            $data['checkCommonLabHsDiscipline']= $this->final_submit_model->checkHsDiscipline($data['vtc_id'],$data['vtcDetails']['academic_year']);
        }else{
            $data['checkCommonLabHsDiscipline'] = 'match';
        }

        
        // $data['checkCommonLabStcDiscipline']= $this->final_submit_model->checkStcDiscipline($data['vtc_id'],$data['vtcDetails']['academic_year']);
        
        // echo "<pre>";print_r($data);exit;

        $data['agriDisciplineExist'] = $this->final_submit_model->getVtcDiscipline($data['vtc_id'], $data['vtcDetails']['academic_year']);
       
        

        if($data['agriDisciplineExist'] == 'yes'){

            $data['agriData'] = $this->final_submit_model->getAgriDisciplineDetails($data['vtc_id'],$data['vtcDetails']['academic_year']);

        }else{
            $data['agriData'] = array();
        }

        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/final_submit/final_submit_view', $data);

    }

    public function second_final_submit()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
            $data['academic_year']  = $this->config->item('current_academic_year');

            $vtcDetails = $this->final_submit_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

            $result = $this->final_submit_model->submit_final_data(md5($vtcDetails['vtc_details_id_pk']), array('second_final_submit_status' => 1));

            if ($result) {

                echo json_encode('submited');
            }
        }
    }

    public function download_vtc_pdf($vtc_details_id_pk = NULL){

        
        if (!empty($vtc_details_id_pk)) {

            $data['vtcDetails'] = $this->vtc_model->getVtcDetails($vtc_details_id_pk);
            if (!empty($data['vtcDetails'])) {

                $data['nearest_vtc'] = $this->vtc_model->getNearestVtc($data['vtcDetails']['vtc_details_id_pk']);

                // $data['vtcCourseList']  = $this->vtc_model->getVtcCourseList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                $data['vtcCourseList']  = $this->vtc_model->getVtcAllCourseList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                // echo "<pre>";print_r($data['vtcCourseList']);exit;

                $data['vtcSubjectList']  = $this->vtc_model->getVtcAllSubjectList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                

                $data['teacherList'] = $this->vtc_model->getNewVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                

                

                $data['studentCountDetails'] = $this->vtc_model->getStudentCountDetails($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);


                // Added by Moli For 2nd phase
                $data['paperLabData'] = $this->final_submit_model->getVTCPaperLabData($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
                
                $data['commonLabData'] = $this->final_submit_model->getAllCommonLabData($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
    
                $data['classRoomData'] = $this->final_submit_model->getVTCClassRoomData($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                $data['labSizeData'] = $this->final_submit_model->getLabSizeDetails($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
    
                $data['otherData'] = $this->final_submit_model->getOtherInfarstructureDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
    
                $data['computerLabData'] = $this->final_submit_model->getComputerLabDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
                

                $data['agriDisciplineExist'] = $this->final_submit_model->getVtcDiscipline($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                if($data['agriDisciplineExist'] == 'yes'){
        
                    $data['agriData'] = $this->final_submit_model->getAgriDisciplineDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
        
                }
                // echo "<pre>";print_r($data['agriData']);exit;
                $data['offset']=0;

                // Added by Moli For 2nd phase

                

                $html = $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details/vtc_pdf_view', $data,true);

                $pdfFilePath = 'VTC-Details-' . date('dmY') . ".pdf";
        
                $this->load->library('m_pdf');
                $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
                $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
                $this->m_pdf->pdf->showWatermarkText = true;
    
                $this->m_pdf->pdf->WriteHTML($html);
    
                //download it.
                $this->m_pdf->pdf->Output($pdfFilePath, "I");
                // $this->m_pdf->pdf->Output($pdfFilePath, "D");
            } else {
                redirect('admin/vtc_infrastructure/final_submit');
            }
        } else {
            redirect('admin/vtc_infrastructure/final_submit');
        }
    }

    
}