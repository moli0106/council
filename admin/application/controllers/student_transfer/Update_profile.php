<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_profile extends NIC_Controller
{
    function __construct()
    {

        parent::__construct();
        parent::check_privilege(160);
        $this->load->model('student_transfer/choice_filling_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
          1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
          2 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        ); 
        $this->js_foot = array(
          1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
          2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
          
          3 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
          4 => $this->config->item('theme_uri').'jQuery.print.min.js'
        );

    }

    public function index(){

        $data['student_id'] = $this->session->userdata('stake_details_id_fk');
        $data['trasfer_details'] = $this->choice_filling_model->get_transfer_status($data['student_id']);
        $data['board_name'] = $this->choice_filling_model->getAllBoardName();
        $data['student_id_pk'] = md5($data['trasfer_details']['institute_student_details_id_pk']);
       
        //echo "<pre>";print_r($data['institute']);die;

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
			$formData['tfw']  = set_value('tfw');
			$formData['board_id']  = set_value('board_id');
			$formData['passing_year']  = set_value('passing_year');
			$formData['full_marks']  = set_value('fullmark');
			$formData['marks_obtain']  = set_value('marks_obtain');
			$formData['percentage']  = set_value('percentage');
			
		}else{
			$formData['tfw'] = $data['trasfer_details']['tfw'];
			$formData['board_id'] = $data['trasfer_details']['madhyamik_board_id_pk'];
			$formData['full_marks'] = $data['trasfer_details']['madhyamik_full_marks'];
			$formData['marks_obtain'] = $data['trasfer_details']['madhyamik_marks_obtain'];
			$formData['percentage'] = $data['trasfer_details']['madhyamik_percentage'];
			$formData['passing_year'] = $data['trasfer_details']['madhyamik_passing_year'];
			
		}
		$data['formData'] = $formData;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
           
            if($this->input->post('std_id') !=''){
               
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
                $config = array(

                    array('field' => 'tfw', 'label' => 'TFW', 'rules' => 'trim|required'),
                    array('field' => 'fullmark', 'label' => 'Full Marks', 'rules' => 'trim|required'),
    
                    array('field' => 'marks_obtain', 'label' => 'Marks Obtained', 'rules' => 'trim|required'),
                    array('field' => 'percentage', 'label' => 'Percentage', 'rules' => 'trim|required'),
                    array('field' => 'passing_year', 'label' => 'Passing Year', 'rules' => 'trim|required'),
                    array('field' => 'board_id', 'label' => 'Board Name', 'rules' => 'trim|required')
                );
                $this->form_validation->set_rules('tfw_doc', 'TFW Doc', 'trim|callback_file_validation[tfw_doc|application/pdf|200|required]');

                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() == FALSE) {
                    //echo "hi";exit;
                    //$this->load->view($this->config->item('theme') . 'student_transfer/upd_profile_view', $data);
                    
                } else {
                    
                    $edu_qualification = array(
                        "tfw"       => $this->input->post("tfw"),
                        "tfw_doc" => base64_encode(file_get_contents($_FILES["tfw_doc"]['tmp_name'])),
                        "madhyamik_full_marks" => $this->input->post("fullmark"),
                        "madhyamik_marks_obtain" => $this->input->post("marks_obtain"),
                        "madhyamik_percentage" => $this->input->post("percentage"),
                        "madhyamik_passing_year" => $this->input->post("passing_year"),
                        "update_transfer_profile" => 1,
                        "madhyamik_board_id_pk" => $this->input->post("board_id")
    
                    );

                    //echo "<pre>";print_r($edu_qualification);exit;

                    $qua_status = $this->choice_filling_model->updateStdQualifiDetails($this->input->post('std_id'), $edu_qualification);

                    if ($qua_status) {


                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Your Qualification data update successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'have an error.');
                    }
                    
                }
            }
        }

        $this->load->view($this->config->item('theme') . 'student_transfer/upd_profile_view', $data);
    }

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