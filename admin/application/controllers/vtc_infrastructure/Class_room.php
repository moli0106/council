<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Class_room extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(123);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('vtc_infrastructure/class_room_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'vtc_infrastructure/class_room.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index(){

       
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->class_room_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

        if(!empty($data['vtcDetails'])){

            $data['classRoomData'] = $this->class_room_model->getVTCClassRoomData($data['vtc_id'],$data['academic_year']);
            $data['labSizeData'] = $this->class_room_model->getLabSizeDetails($data['vtc_id'],$data['academic_year']);

        }
        // echo "<pre>";print_r($data);exit;
        $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/class_room_add_view', $data);
    }
    public function add(){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('current_academic_year');
        $data['vtcDetails']     = $this->class_room_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

        if(!empty($data['vtcDetails'])){

            $classRoomData = $this->class_room_model->getVTCClassRoomData($data['vtc_id'],  $data['academic_year']);
            if(!empty($classRoomData)){

                $data['classRoomData'] = $classRoomData;
            }else{

                $data['classRoomData'] = array();
            }

            $data['labSizeData'] = $this->class_room_model->getLabSizeDetails($data['vtc_id'],  $data['academic_year']);

        }

        if($this->input->server('REQUEST_METHOD') == 'POST'){

           

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
               
                array(
                    'field' => 'no_of_room',
                    'label' => 'No of room',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'no_of_lab',
                    'label' => 'No of lab',
                    'rules' => 'trim|required|integer'
                ),
            );
            if($this->input->post('no_of_room')!=0){
                $config[] = array(
                    'field' => 'class_room_size[]',
                    'label' => 'Class room size',
                    'rules' => 'trim|required'
                );
            }

            if($this->input->post('no_of_lab')!=0){
                $config[] = array(
                    'field' => 'lab_size[]',
                    'label' => 'Lab size',
                    'rules' => 'trim|required'
                );
            }
            $this->form_validation->set_rules($config);
            if($this->form_validation->run() == FALSE){
                $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/class_room_add_view', $data);
            }else{

                $checkDataByVTCId = $this->class_room_model->getClassRoomAndLabData($data['vtcDetails']['vtc_id_pk'],$data['vtcDetails']['academic_year']);
                
                // echo "<pre>";print_r($checkDataByVTCId);exit;
                if(!empty($checkDataByVTCId)){

                    $class_room_id = $checkDataByVTCId['vtc_vocational_class_room_id_pk'];
                    $lab_id = $checkDataByVTCId['vtc_short_term_lab_id_pk'];

                    $updateData = $this->updateClassRoomDetails($data['vtcDetails']['vtc_id_pk'],$data['vtcDetails']['vtc_details_id_pk'],$data['vtcDetails']['academic_year'],$_POST,$class_room_id,$lab_id);
                
                    // redirect(base_url('admin/vtc_infrastructure/class_room'));
                    $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/class_room_add_view', $data);

                }else{

              
                    // no of class room Data Array
                    $no_of_room = $this->input->post('no_of_room');
                    $classRoomData=array(
                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'             => $data['vtcDetails']['academic_year'],
                        'no_of_room'                => $no_of_room,
                        'entry_ip'                  => $this->input->ip_address(),
                        'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                    );

                    // Data Array of short Term Lab
                    $stLabData= array(
                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                        'academic_year'             => $data['vtcDetails']['academic_year'],
                        'no_of_lab'                => $this->input->post('no_of_lab'),
                        'entry_ip'                  => $this->input->ip_address(),
                        'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'                => 'now()',
                    );

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction

                    //Insert No of Class Room
                    $classRoomId = $this->class_room_model->insertData('council_affiliation_vtc_vocational_class_room',$classRoomData);

                    // echo $classRoomId;exit;
                    //Insert Class Room Size Data
                    if(array_key_exists("class_room_size", $_POST)){
                        if($classRoomId){
                            $roomSize = $this->input->post('class_room_size');
    
                            if(count($roomSize) > 0){
    
                                $roomSizeArray = array();
    
                                foreach ($roomSize as $key => $value) {
                                    $mapData1 = array(
                                        'vtc_vocational_class_room_id_fk' => $classRoomId,
                                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                                        'room_size'                 => $value,
                                    );
                                    array_push($roomSizeArray, $mapData1);
                                }
                                
                                $this->class_room_model->insertMultipleData('council_affiliation_vtc_vocational_class_room_size_map',$roomSizeArray,$data['vtcDetails']['vtc_id_pk'], $classRoomId);
                                
                            }
                        }
                    }
                    

                    //Insert No of Short Term Lab
                    $LabId = $this->class_room_model->insertData('council_affiliation_vtc_short_term_lab',$stLabData);

                    //Insert Short Term Lab Size Data
                    if(array_key_exists("lab_size", $_POST)){
                        
                        if($LabId){
                            $labSize = $this->input->post('lab_size');
    
                            if(count($labSize) > 0){
    
                                $labSizeArray = array();
    
                                foreach ($labSize as $key => $value) {
                                    $mapData2 = array(
                                        'vtc_short_term_lab_id_fk' => $LabId,
                                        'lab_size'                 => $value,
                                        'vtc_id_fk'                 => $data['vtcDetails']['vtc_id_pk'],
                                        'vtc_details_id_fk'         => $data['vtcDetails']['vtc_details_id_pk'],
                                    );
                                    array_push($labSizeArray, $mapData2);
                                }
                                $this->class_room_model->insertMultipleData('council_affiliation_vtc_short_term_lab_size_map',$labSizeArray,$data['vtcDetails']['vtc_id_pk'], $LabId);
    
                            }
                        }
    
                    }
                    
                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add class room details, Please try after sometime.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Class room details has been added successfully.');
                    }

                    // redirect(base_url('admin/vtc_infrastructure/class_room'));
                    $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/class_room_add_view', $data);
                
                }


            }
        }else{

            // $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/class_room_add_view', $data);
            redirect(base_url('admin/vtc_infrastructure/class_room'));
        }
    }

    public function updateClassRoomDetails($vtc_id, $vtc_details_id, $academic_year, $postData=NULL, $class_room_id=NULL,$lab_id=NULL){
        
        // no of class room Data Array

        $classRoomData=array(
            'no_of_room'                => $postData['no_of_room'],
            'update_ip'                  => $this->input->ip_address(),
            'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
            'update_time'                => 'now()',
        );

        // Data Array of short Term Lab
        $stLabData= array(
            'no_of_lab'                => $this->input->post('no_of_lab'),
            'update_ip'                  => $this->input->ip_address(),
            'update_by'               => $this->session->userdata('stake_holder_login_id_pk'),
            'update_time'                => 'now()',
        );

        // ! Starting Transaction
        // $this->db->trans_start(); # Starting Transaction

        //Insert No of Class Room
        $classRoomRow = $this->class_room_model->updateData('council_affiliation_vtc_vocational_class_room',$classRoomData,$vtc_id,$academic_year);

        
        //Insert Class Room Size Data
        if(array_key_exists("class_room_size" , $postData)){
            if($classRoomRow){
                $roomSize = $postData['class_room_size'];
    
                if(count($roomSize) > 0){
    
                    $roomSizeArray = array();
    
                    foreach ($roomSize as $key => $value) {
                        $mapData1 = array(
                            'vtc_vocational_class_room_id_fk' => $class_room_id,
                            'vtc_id_fk'                 => $vtc_id,
                            'vtc_details_id_fk'         => $vtc_details_id,
                            'room_size'                 => $value,
                        );
                        array_push($roomSizeArray, $mapData1);
                    }
                    $this->class_room_model->insertMultipleData('council_affiliation_vtc_vocational_class_room_size_map',$roomSizeArray,$vtc_id, $class_room_id);
    
                }
            }
        }else{
            $this->class_room_model->updateMapTable('council_affiliation_vtc_vocational_class_room_size_map',array('active_status'=>0),$class_room_id);

        }
        

        //Insert No of Short Term Lab
        $labRow = $this->class_room_model->updateData('council_affiliation_vtc_short_term_lab',$stLabData,$vtc_id,$academic_year);
      
        //Insert Short Term Lab Size Data
        if(array_key_exists("lab_size", $postData)){
            if($labRow){
                $labSize = $this->input->post('lab_size');
    
                if(count($labSize) > 0){
    
                    $labSizeArray = array();
    
                    foreach ($labSize as $key => $value) {
                        $mapData2 = array(
                            'vtc_short_term_lab_id_fk' => $lab_id,
                            'vtc_id_fk'                 => $vtc_id,
                            'vtc_details_id_fk'         => $vtc_details_id,
                            'lab_size'                 => $value,
                        );
                        array_push($labSizeArray, $mapData2);
                    }
                    // echo "<pre>";print_r($labSizeArray);exit;
                    $this->class_room_model->insertMultipleData('council_affiliation_vtc_short_term_lab_size_map',$labSizeArray,$vtc_id,$lab_id);
    
                }
            }
        }else{
            $this->class_room_model->updateMapTable('council_affiliation_vtc_short_term_lab_size_map',array('active_status'=>0),$lab_id);

        }
        

        // ! Check All Query For Trainee
        if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();

            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('alert_msg', 'Oops! Unable to update class room details, Please try after sometime.');
        } else {
            # Everything is Perfect. Committing data to the database.
            $this->db->trans_commit();

            $this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('alert_msg', 'Class room details has been updated successfully.');
        }
        return true;

    }

    public function getRoomDetailsBlock($no_of_room = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $htmlData = '';

            if (($no_of_room != NULL) && ($no_of_room != '') && ($no_of_room > 0)) {


                $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
                $data['academic_year']  = $this->config->item('current_academic_year');
                $vtcDetails     = $this->class_room_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

                if(!empty($vtcDetails)){

                    $data['classRoomData'] = $this->class_room_model->getVTCClassRoomData($data['vtc_id'],$data['academic_year']);

                }
                // echo "<pre>";print_r($data['classRoomData']['room_size'][0]);exit;

                
                $data['no_of_room'] = $no_of_room;

                $htmlData = $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/ajax_view/room_details_block_view', $data, TRUE);
                echo json_encode($htmlData);
            } else {
                echo json_encode($htmlData);
            }
        }
    }
    public function getLabSizeBlock($no_of_lab = NULL)
    {
    //    echo $no_of_lab;
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $htmlData = '';

            if (($no_of_lab != NULL) && ($no_of_lab != '') && ($no_of_lab > 0)) {

                $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
                $data['academic_year']  = $this->config->item('current_academic_year');
                $vtcDetails     = $this->class_room_model->getVtcDetails($data['vtc_id'],$data['academic_year']);

                if(!empty($vtcDetails)){

                    $data['labSizeData'] = $this->class_room_model->getLabSizeDetails($data['vtc_id'],$data['academic_year']);
                }
                $data['no_of_lab'] = $no_of_lab;

            //    echo "<pre>";print_r($data) ;

                $htmlData = $this->load->view($this->config->item('theme') . 'vtc_infrastructure/class_room/ajax_view/lab_size_block_view', $data, TRUE);
                echo json_encode($htmlData);
            } else {
                echo json_encode($htmlData);
            }
        }
    }
}