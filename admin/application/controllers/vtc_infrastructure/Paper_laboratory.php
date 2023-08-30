<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paper_laboratory extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/paper_laboratory_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/infrastructure.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    // public function index($offset = 0){

    //     $data['offset'] = $offset;
    //     $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
    //     $data['academic_year']  = $this->config->item('academic_year');
    //     $data['vtcDetails']     = $this->paper_laboratory_model->getVtcDetails($data['vtc_id'], $data['academic_year']);

    //     if (!empty($data['vtcDetails'])) {

    //         $data['paperLabData'] = $this->paper_laboratory_model->getVTCPaperLabData($data['vtc_id']);
    //         // echo "<pre>";print_r($data['paperLabData']);exit;
    //     }
    //     $this->load->view($this->config->item('theme') . 'vtc_infrastructure/paper_laboratory/paper_lab_list_view', $data);
    // }

    public function index($offset = 0){

        $data['offset'] = $offset;

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->paper_laboratory_model->getVtcDetails($data['vtc_id'],$data['academic_year']);
        // $data['vtcCourseList'] = $this->paper_laboratory_model->getVtcCourseList($data['vtc_id']);
        $data['vtcCourseList'] = $this->paper_laboratory_model->getVtcGroupList($data['vtc_id'],$data['vtcDetails']['academic_year']);
        // echo "<pre>";print_r($data['vtcCourseList']);exit;

        if (!empty($data['vtcDetails'])) {

            $data['paperLabData'] = $this->paper_laboratory_model->getVTCPaperLabData($data['vtc_id']);
            // echo "<pre>";print_r($data['paperLabData']);exit;
        }

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array(
                    'field' => 'course_id',
                    'label' => 'course',
                    'rules' => 'trim|required|numeric'
                ),

                array(
                    'field' => 'item_id',
                    'label' => 'Infrastructure Item',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'aplicable_no',
                    'label' => 'Aplicable No',
                    'rules' => 'trim|required|numeric'
                ),

                // array(
                //     'field' => 'equipment',
                //     'label' => 'Equipment availability',
                //     'rules' => 'trim|required|numeric'
                // ),

               
            );

            if($this->input->post('aplicable_no') == 1){

                // $config[] = array(
                //     'field' => 'lab_size',
                //     'label' => 'Lab size',
                //     'rules' => 'trim|required'
                // );

                $config[] = array(
                    'field' => 'experimental_setup',
                    'label' => 'Experimental Set-Ups',
                    'rules' => 'trim|required'
                );
                $this->form_validation->set_rules('equipment_doc', 'Equipment Doc', 'trim|callback_file_validation[equipment_doc|application/pdf|200|required]');

            }

            // if($this->input->post('equipment') == 1){
            //     $config[] = array(
            //         'field' => 'sufficient_availability',
            //         'label' => 'sufficient availability',
            //         'rules' => 'trim|required'
            //     );
            // }


            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/paper_laboratory/paper_lab_add_view', $data);
            }else{
                
                $post_data = array(
                    'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                    'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                    'academic_year'             => $data['vtcDetails']['academic_year'],
                    'group_id_fk'              => $this->input->post('course_id'),
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

                $last_id = $this->paper_laboratory_model->insertPaperLabData($post_data);
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Vocational Paper Laboratory added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/vtc_infrastructure/paper_laboratory'));
            }

        }else{

            $this->load->view($this->config->item('theme') . 'vtc_infrastructure/paper_laboratory/paper_lab_add_view', $data);
        }
        
    }

    // ! get Details
    public function details($paper_lab_id_hash = NULL){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['paperLabData'] = $this->paper_laboratory_model->getPaperLabDetails($paper_lab_id_hash);
        // $data['vtcCourseList'] = $this->paper_laboratory_model->getVtcCourseList($data['vtc_id']);
        // echo "<pre>";print_r($data['paperLabData']);exit;
        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/paper_laboratory/paper_lab_details_view', $data);
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

    public function getInfrastructureItemList($course_id = NULL){
        
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{
            if(!empty($course_id)){

                $paper_lab_id_hash = $this->input->get('paper_lab_id');
                $vtc_id         = $this->session->userdata('stake_details_id_fk');

                if($paper_lab_id_hash !=''){
                    $data['paperLabData'] = $this->paper_laboratory_model->getPaperLabDetails($paper_lab_id_hash);
                }else{
                    $data['paperLabData']=array();
                }

                
                $data['item'] = $this->paper_laboratory_model->getInfrastructureItem($course_id, $vtc_id);
                
                // echo "<pre>"; print_r($data);exit;

                
    
                if (!empty($data['item'])) {
                    $html = $this->load->view($this->config->item('theme') . 'vtc_infrastructure/paper_laboratory/ajax_view/infrastructure_item_view', $data, TRUE);
                } else {
                    $html = '<option value="" hidden="true">-- Select Infrastructure Item --</option>';
                    $html .= '<option>No Data Found...</option>';
                }
                echo json_encode($html);
                
            }
        }
    }

    public function update(){

        if($this->input->server('REQUEST_METHOD') == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                // array(
                //     'field' => 'course_id',
                //     'label' => 'course',
                //     'rules' => 'trim|required|numeric'
                // ),

                array(
                    'field' => 'item_id',
                    'label' => 'Infrastructure Item',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'aplicable_no',
                    'label' => 'Aplicable No',
                    'rules' => 'trim|required|numeric'
                ),
            );

            if($this->input->post('aplicable_no') == 1){

               

                $config[] = array(
                    'field' => 'experimental_setup',
                    'label' => 'Experimental Set-Ups',
                    'rules' => 'trim|required'
                );
                $this->form_validation->set_rules('equipment_doc', 'Equipment Doc', 'trim|callback_file_validation[equipment_doc|application/pdf|200]');

            }

            


            $this->form_validation->set_rules($config);

            if($this->form_validation->run() == FALSE){
                // echo validation_errors();
                $this->session->set_flashdata('validation_errors_list', validation_errors());

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Waning! Inappropriate Data, Please enter correct value.');
            }else{

                $paper_lab_id_hash = $this->input->post('paper_lab_id');
                
                $update_data = array(
                    
                    // 'course_id_fk'              => $this->input->post('course_id'),
                    'infrastructure_item_id_fk'              => $this->input->post('item_id'),
                    'applicable_present'              => $this->input->post('aplicable_no'),
                    'experimental_setup'              => $this->input->post('experimental_setup'),
                    'update_ip'                  => $this->input->ip_address(),
                    'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'update_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                );
                if (!empty($_FILES['equipment_doc']['tmp_name'])) {

                    $update_data['equipment_doc'] = base64_encode(file_get_contents($_FILES["equipment_doc"]['tmp_name']));
                } 

                // echo "<pre>";print_r($update_data);exit;

                $updateData = $this->paper_laboratory_model->updatePaperLabData($update_data, $paper_lab_id_hash);
                if ($updateData) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Vocational Paper Laboratory updated successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

            }
            redirect(base_url('admin/vtc_infrastructure/paper_laboratory'));

        }else{

            redirect(base_url('admin/vtc_infrastructure/paper_laboratory'));
        }
    }

    public function showEquipmentDoc($id_hash = NULL){
        
        if (!empty($id_hash)) {

            $paperLabData = $this->paper_laboratory_model->getPaperLabDetails($id_hash);
            if (!empty($paperLabData)) {

                $equipment_doc = $paperLabData['equipment_doc'];

                $file_name = 'PDF-' . date('Ymd') . '-' . date('his') . '.pdf';

                // Header content type
                header("Content-type: application/pdf");

                header("Content-Disposition:inline;filename=" . $file_name);

                // header('Content-Transfer-Encoding: binary');
  
                // header('Accept-Ranges: bytes');

                echo base64_decode($equipment_doc);
            }
        } else {
            redirect('admin/vtc_infrastructure/paper_laboratory/'.$id_hash);
        }
    }
}