<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stt_laboratory extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(116);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/stt_laboratory_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/infrastructure.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index(){

       
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        // $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->stt_laboratory_model->getVtcDetails($data['vtc_id']);

        if(!empty($data['vtcDetails'])){

            $data['sttLabData'] = array();
        }
        
        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/stt_lab_list_view', $data);
    }
    public function add(){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        // $data['academic_year']  = $this->config->item('academic_year');
        $data['vtcDetails']     = $this->stt_laboratory_model->getVtcDetails($data['vtc_id']);
        $data['vtcCourseList'] = $this->stt_laboratory_model->getVtcCourseList($data['vtc_id']);

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(

                array(
                    'field' => 'course_id',
                    'label' => 'course',
                    'rules' => 'trim|required|numeric'
                ),

                // array(
                //     'field' => 'item_id',
                //     'label' => 'Infrastructure Item',
                //     'rules' => 'trim|required|numeric'
                // ),
                array(
                    'field' => 'aplicable_no',
                    'label' => 'Aplicable No',
                    'rules' => 'trim|required|numeric'
                ),

                array(
                    'field' => 'equipment',
                    'label' => 'Equipment availability',
                    'rules' => 'trim|required|numeric'
                ),

               
            );

            if($this->input->post('aplicable_no') == 1){
                $config[] = array(
                    'field' => 'lab_size',
                    'label' => 'Lab size',
                    'rules' => 'trim|required'
                );
            }

            if($this->input->post('equipment') == 1){
                $config[] = array(
                    'field' => 'sufficient_availability',
                    'label' => 'sufficient availability',
                    'rules' => 'trim|required'
                );
            }

            $this->form_validation->set_rules('equipment_doc', 'Equipment Doc', 'trim|callback_file_validation[equipment_doc|application/pdf|200|required]');

            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/stt_lab_add_view', $data);
            }else{
                echo "hii";exit;
            }


        }else{

            $this->load->view($this->config->item('theme') . 'vtc_infrastructure/stt_lab_add_view', $data);
        }
    }

    // ! File Validation 

    public function file_validation($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);

        if ($file_array[1] == "application/pdf") {
            $ext = "PDF";
        } elseif ($file_array[1] == "image/jpeg") {
            $ext = "JPG";
        }
        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            }
        }
    }
}