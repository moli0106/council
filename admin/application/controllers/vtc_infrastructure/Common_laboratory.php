<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Common_laboratory extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/common_laboratory_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/common_lab.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    // public function index($offset = 0){

    //     $data['offset'] = $offset;
    //     $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
    //     // $data['academic_year']  = $this->config->item('academic_year');
    //     $data['vtcDetails']     = $this->common_laboratory_model->getVtcDetails($data['vtc_id']);

    //     if(!empty($data['vtcDetails'])){

    //         $data['commonLabData'] = $this->common_laboratory_model->getAllCommonLabData($data['vtc_id']);
    //     }
    //     $this->load->view($this->config->item('theme') . 'vtc_infrastructure/common_laboratory/common_lab_list_view', $data);
    // }
    
    public function index($offset = 0){

        $data['offset'] = $offset;
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->common_laboratory_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

        $data['vtcCourseList'] = $this->common_laboratory_model->getVtcGroupList($data['vtc_id'],$data['vtcDetails']['academic_year']);

        $data['vtcHSCourseList'] = $this->common_laboratory_model->checkVtcHSCourseExist($data['vtc_id'], $data['vtcDetails']['academic_year']);

        if(!empty($data['vtcDetails'])){

            $data['commonLabData'] = $this->common_laboratory_model->getAllCommonLabData($data['vtc_id'],$data['academic_year']);
        }

        // get subject name
        $data['vtcDisciplineList'] = $this->common_laboratory_model->getVtcDisciplineList($data['vtc_id'],$data['academic_year']);

        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array(
                    'field' => 'course_name_id',
                    'label' => 'Course name',
                    'rules' => 'trim|required|numeric'
                ),

                array(
                    'field' => 'discipline_id',
                    'label' => 'Subject name',
                    'rules' => 'trim|required|numeric'
                ),

                array(
                    'field' => 'item_id',
                    'label' => 'Infrastructure Item',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'aplicable_no',
                    'label' => 'Aplicable Number',
                    'rules' => 'trim|required|numeric'
                ),
                // array(
                //     'field' => 'no_of_units',
                //     'label' => 'No of units',
                //     'rules' => 'trim|required|numeric'
                // ),
                // array(
                //     'field' => 'min_no_of_units',
                //     'label' => 'Min no of units',
                //     'rules' => 'trim|required|numeric'
                // ),
            );

            if($this->input->post('aplicable_no') == 1){
                $config[] = array(
                    'field' => 'experimental_setup',
                    'label' => 'Experimental Setup',
                    'rules' => 'trim|required'
                );
                $this->form_validation->set_rules('equipment_doc', 'Equipment Doc', 'trim|callback_file_validation[equipment_doc|application/pdf|200|required]');
            }

            $course_name_id = $this->input->post('course_name_id');

            if($course_name_id !=''){

                $data['discipline'] = $this->common_laboratory_model->getDisciplineName($course_name_id,$data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
            }


            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/common_laboratory/common_lab_add_view', $data);
            }else{
                
                $post_data = array(
                    'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'             => $data['vtcDetails']['academic_year'],
                    'course_name_id_fk'              => $this->input->post('course_name_id'),
                    'discipline_id_fk'              => $this->input->post('discipline_id'),
                    'infrastructure_item_id_fk'              => $this->input->post('item_id'),
                    'applicable_present'              => $this->input->post('aplicable_no'),
                    'experimental_setup'              => $this->input->post('experimental_setup'),
                    'entry_ip'                  => $this->input->ip_address(),
                    'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                );
                if (!empty($_FILES['equipment_doc']['tmp_name'])) {

                    $post_data['equipment_doc'] = base64_encode(file_get_contents($_FILES["equipment_doc"]['tmp_name']));
                } else {
                    $post_data['equipment_doc'] = NULL;
                }

                // echo "<pre>";print_r($post_data);exit;

                $last_id = $this->common_laboratory_model->insertCommonLabData($post_data);
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Other Common Laboratory added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/vtc_infrastructure/common_laboratory'));
            }

        }else{
            
            $this->load->view($this->config->item('theme') . 'vtc_infrastructure/common_laboratory/common_lab_add_view', $data);
        }
    }

    public function details($id_hash = NULL){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->common_laboratory_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

        // get subject name
        //$data['vtcDisciplineList'] = $this->common_laboratory_model->getVtcDisciplineList($data['vtc_id'],$data['academic_year']);
        $data['cmnLabData'] = $this->common_laboratory_model->getCommonLabDetailsById($id_hash);

        // echo "<pre>";print_r($data['cmnLabData']);exit;

        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/common_laboratory/common_lab_details_view', $data);

    }

    public function update(){

        if($this->input->server('REQUEST_METHOD') == 'POST'){
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array(
                    'field' => 'discipline_id',
                    'label' => 'Subject name',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'item_id',
                    'label' => 'Infrastructure Item',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'aplicable_no',
                    'label' => 'Aplicable Number',
                    'rules' => 'trim|required|numeric'
                ),
                
            );

            if($this->input->post('aplicable_no') == 1){
                $config[] = array(
                    'field' => 'experimental_setup',
                    'label' => 'Experimental Setup',
                    'rules' => 'trim|required'
                );
                // $this->form_validation->set_rules('equipment_doc', 'Equipment Doc', 'trim|callback_file_validation[equipment_doc|application/pdf|200]');
            }


            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){

                // echo validation_errors();
                $this->session->set_flashdata('validation_errors_list', validation_errors());

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Waning! Inappropriate Data, Please enter correct value.');
            }else{

                $id_hash = $this->input->post('cmn_id_hash');
                
                $post_data = array(
                    
                    'discipline_id_fk'              => $this->input->post('discipline_id'),
                    'infrastructure_item_id_fk'              => $this->input->post('item_id'),
                    'applicable_present'              => $this->input->post('aplicable_no'),
                    'experimental_setup'              => $this->input->post('experimental_setup'),
                    'update_ip'                  => $this->input->ip_address(),
                    'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'update_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                );
                if (!empty($_FILES['equipment_doc']['tmp_name'])) {

                    $post_data['equipment_doc'] = base64_encode(file_get_contents($_FILES["equipment_doc"]['tmp_name']));
                } 

                // echo "<pre>";print_r($post_data);exit;

                $last_id = $this->common_laboratory_model->updateCommonLabData($post_data, $id_hash);
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Other Common Laboratory updated successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

            }
            redirect(base_url('admin/vtc_infrastructure/common_laboratory'));

        }else{
            
            redirect(base_url('admin/vtc_infrastructure/common_laboratory'));
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

    public function getInfrastructureItem($discipline_id = NULL){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{
            if(!empty($discipline_id)){

                $cmnLabId = $this->input->get('cmnLabId');
                $course_name_id = $this->input->get('course_name_id');
                $vtc_id         = $this->session->userdata('stake_details_id_fk');

                if($cmnLabId != ''){
                    $data['cmnLabData'] = $this->common_laboratory_model->getCommonLabDetailsById($cmnLabId);
                }else{
                    $data['cmnLabData'] = array();
                }

                $data['item'] = $this->common_laboratory_model->getInfrastructureItem($discipline_id,$course_name_id, $vtc_id);
                
                
                // echo "<pre>"; print_r($data);exit;
    
                if (!empty($data['item'])) {

                    $html = $this->load->view($this->config->item('theme') . 'vtc_infrastructure/common_laboratory/ajax_view/infrastructure_item_view', $data, TRUE);

                } else {
                    $html = '<option value="" hidden="true">-- Select Infrastructure Item --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
                
            }
        }
    }

    public function showEquipmentDoc($id_hash = NULL){
        
        if (!empty($id_hash)) {

            $cmnLabData = $this->common_laboratory_model->getCommonLabDetailsById($id_hash);
            if (!empty($cmnLabData)) {

                $equipment_doc = $cmnLabData['equipment_doc'];

                $file_name = 'PDF-' . date('Ymd') . '-' . date('his') . '.pdf';

                // Header content type
                header("Content-type: application/pdf");

                header("Content-Disposition:inline;filename=" . $file_name);

                // header('Content-Transfer-Encoding: binary');
  
                // header('Accept-Ranges: bytes');

                echo base64_decode($equipment_doc);
            }
        } else {
            redirect('admin/vtc_infrastructure/common_laboratory/'.$id_hash);
        }
    }

    public function getDisciplineName($course_name_id = NULL){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{
            if(!empty($course_name_id)){

                $cmnLabId = $this->input->get('cmnLabId');

                $vtc_id         = $this->session->userdata('stake_details_id_fk');
                $academic_year  = $this->config->item('current_academic_year');
                $vtcDetails     = $this->common_laboratory_model->getVtcDetails($vtc_id,$academic_year);

                if($cmnLabId != ''){
                    $data['cmnLabData'] = $this->common_laboratory_model->getCommonLabDetailsById($cmnLabId);
                }else{
                    $data['cmnLabData'] = array();
                }

                $data['discipline'] = $this->common_laboratory_model->getDisciplineName($course_name_id,$vtcDetails['vtc_id_fk'],$vtcDetails['academic_year']);
                
                
                // echo "<pre>"; print_r($data);exit;
    
                if (!empty($data['discipline'])) {

                    $html = $this->load->view($this->config->item('theme') . 'vtc_infrastructure/common_laboratory/ajax_view/discipline_name_view', $data, TRUE);

                } else {
                    $html = '<option value="" hidden="true">-- Select Subject Name --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
                
            }
        }
    }
}