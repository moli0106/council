<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_reg extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
        $this->load->model('vtc_student/student_reg_model');

        $this->load->model('affiliation/details_model');
        $this->load->model('vtc_student/student_model');
        $this->load->model('organization/std_reg_model');
        $this->load->model('organization/tc_reg_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css'
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'organization/student_reg.js',
            3 => $this->config->item('theme_uri').'jQuery.print.min.js',
			4 => $this->config->item('theme_uri') . 'organization/common.js',
			5 => $this->config->item('theme_uri') . 'organization/doc_upload.js'
        );
    }

    public function index($offset = 0){

        $data['offset']         = $offset;

        $data['stake_id_fk'] = $this->session->userdata('stake_id_fk');
        $data['stake_details_id_fk'] = $this->session->userdata('stake_details_id_fk');

        if($data['stake_id_fk'] == 36){
            $data['tc_details'] = $this->std_reg_model->getOrgIdFromTCID($data['stake_details_id_fk']);
            $OrgId = $data['tc_details']['organization_id_fk'];
            $total_row = $this->std_reg_model->get_student_countByID($data['tc_details']['tc_id_pk'],'tc')[0]['count'];
            $students_data = $this->std_reg_model->get_all_student($data['tc_details']['tc_id_pk'],'tc');
        }else{
            $OrgId = $data['stake_details_id_fk'];
            $total_row = $this->std_reg_model->get_student_countById($OrgId,'org')[0]['count'];
            $students_data = $this->std_reg_model->get_all_student($OrgId,'org');
        }

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');

        $config['base_url']         = 'organization/Student_reg/index/';
        $data["total_rows"] = $config['total_rows']       = $total_row;
        $config['per_page']         = 52;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open']    = '<li class="">';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '<i class="fa fa-backward"></i>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fa fa-forward"></i>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $data['page_links']     = $this->pagination->create_links();



        $data['student_data_list'] = $students_data;


        $this->load->view($this->config->item('theme') . 'organization/student/student_list_view',$data);
    }

    public function add(){

        
        $data['stake_id_fk'] = $this->session->userdata('stake_id_fk');
        $data['stake_details_id_fk'] = $this->session->userdata('stake_details_id_fk');

        $data['salutations'] =  $this->student_reg_model->getSalutation();
        $data['genders'] =  $this->student_reg_model->getGender();
        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['casteList']  = $this->student_reg_model->get_caste();
        $data['religion']  = $this->student_reg_model->get_religion();
        $data['stateList']  = $this->student_reg_model->getAllState();
        $data['sectorList']  = $this->student_model->getSectorList();
        $data['tc_course'] = $this->tc_reg_model->getTcAllCourseList($data['stake_details_id_fk']);
        
        if($data['stake_id_fk'] == 36){
            $data['tc_details'] = $this->std_reg_model->getOrgIdFromTCID($data['stake_details_id_fk']);
            $OrgId = $data['tc_details']['organization_id_fk'];
        }else{
            $OrgId = $data['stake_details_id_fk'];
        }
        $data['organization_details'] = $this->std_reg_model->getOrganization_detailsById($OrgId);
        //echo "<pre>";print_r($data['tc_details']);exit;
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

           
            //echo $this->input->post('stdSector');exit;
            $data['form_data']['state'] = $this->input->post('state');
            $data['form_data']['district'] = $this->input->post('district');
            $data['form_data']['municipality_id_fk'] = $this->input->post('municipality');

            $data['form_data']['sub_division_id_fk'] = $this->input->post('subDivision');

            $data['form_data']['pinNo'] = $this->input->post('pinNo');
            $data['form_data']['address'] = $this->input->post('address');

            if (!empty($data['form_data']['state'])) {
                $data['district'] = $this->student_reg_model->getDistrictByStateId($data['form_data']['state']);
            }

            if (!empty($data['form_data']['sub_division_id_fk'])) {
                $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($data['form_data']['sub_division_id_fk']);
            }

            if(!empty($data['form_data']['district'])){

                if ($data['form_data']['district'] == 16) {

                    $kolkataArray = array(
                        0 => 682, // KOLKATA NORTH 
                        1 => 683, // KOLKATA SOUTH
                        2 => 16, // KOLKATA
                    );
        
                    $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district']);
                    $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
                } elseif (($data['form_data']['district'] == 682) || ($data['form_data']['district'] == 683)) {
        
                    $kolkataArray = array(
                        0 => $data['form_data']['district'], // SOUTH / NORTH KOLKATA
                        1 => 16, // KOLKATA
                    );
        
                    $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
                    $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
                } else {
        
                    $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district']);
                    $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($data['form_data']['district']);
                }
            }

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            
            $config = array(
               

                array('field' => 'salutation','label' => 'Salutation','rules' => 'trim|required'),

                array('field' => 'fname','label' => 'First Name','rules' => 'trim|required'),

                array('field' => 'lname','label' => 'Last Name','rules' => 'trim|required'),

                array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required'),

                array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required'),

                array('field' => 'guardian_name','label' => 'Guardian Name','rules' => 'trim|required'),

                array('field' => 'aadhar_no','label' => 'Aadhar Number','rules' => 'trim|required|exact_length[12]|numeric|is_unique[council_organization_student_details.aadhar_no]'),


                array('field' => 'mob_no','label' => 'Mobile Number','rules' => 'trim|required|exact_length[10]|numeric'),

                array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required'),

                array('field' => 'address','label' => 'Address','rules' => 'trim|required'),

                array('field' => 'district','label' => 'District','rules' => 'trim|required'),

                array('field' => 'pinCode','label' => 'Pin Code','rules' => 'trim|required'),

                array('field' => 'dob','label' => 'Date of Birth','rules' => 'trim|required'),

                array('field' => 'gender','label' => 'Gender','rules' => 'trim|required'),

                array('field' => 'state','label' => 'State','rules' => 'trim|required'),
                array('field' => 'reg_no','label' => 'Registration No','rules' => 'trim|required'),
                array('field' => 'stdCourse','label' => 'Course','rules' => 'trim|required')
            
            );

            if($this->input->post('state') == 19){
				
				$config[] = array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required');
                $config[] = array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required');
			}

            // $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');
                
            // $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
            
            // $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|100|required]');


            // $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation['.$this->input->post('std_image').'|std_image|100]');
            $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|required|callback_file_validation['.$this->input->post('std_signature').'|std_signature|50|data:image/jpeg;base64]');
            $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|required|callback_file_validation['.$this->input->post('aadhar_doc').'|aadhar_doc|200|data:application/pdf;base64]');
           
            $this->form_validation->set_rules('std_image', 'Student Image', 'trim|required|callback_file_validation['.$this->input->post('std_image').'|std_image|100|data:image/jpeg;base64]');

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'organization/student/student_add_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {

                $tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");
                $get_sector = $this->std_reg_model->getSectorByCourse_id($this->input->post('stdCourse'));
                $data_array = array(
                    'salutation_id_fk' => $this->input->post('salutation'),
                    'first_name' =>     strtoupper($this->input->post('fname')),
                    'middle_name' =>    ($this->input->post('mname') == NULL) ? NULL : strtoupper($this->input->post('mname')),
                    'last_name' =>      strtoupper($this->input->post('lname')),
                    'father_name' =>        strtoupper($this->input->post('father_name')),
                    'mother_name' =>        strtoupper($this->input->post('mother_name')),
                    'guardian_name'     =>      strtoupper ($this->input->post('guardian_name')),
                    'aadhar_no' =>          $this->input->post('aadhar_no'),
                    'mob_no'  =>        $this->input->post('mob_no'),
                    'email_id'  =>      $this->input->post('email_id'),
                    'district_id_fk'=>  $this->input->post('district'),
                    'state_id_fk'=>     $this->input->post('state'),
                    'sub_division_id_fk'=>($this->input->post('subDivision') == NULL) ? NULL : $this->input->post('subDivision'),
                    'municipality'=>        ($this->input->post('municipality') == NULL) ? NULL : $this->input->post('municipality'),
                    'gender_id_fk' =>   $this->input->post('gender'),
                    'street_vill_town' => $this->input->post('address'),
                    'post_office' => $this->input->post('po'),
                    'police_station' =>$this->input->post('police_station'),
                    'pin_code'=>$this->input->post('pinCode'),
                    'dob' => $date,
                    'created_date' => 'now()',
                    'created_by'=>$data['stake_details_id_fk'],
                    'tc_id_fk' => $this->input->post('tc_id_fk'),
                    'organization_id_fk' => $OrgId,
                    'course_id_fk' => $this->input->post('stdCourse'),
                    //'sector_id_fk' => $this->input->post('stdSector'),
                    'sector_id_fk' => $get_sector['sector_id_fk'],
                    'course_duration' =>($this->input->post('courseDuration')== NULL) ? NULL :$this->input->post('courseDuration'),
                    'image'             => base64_encode(file_get_contents($_FILES["std_image"]['tmp_name'])),
                    'signature'             => base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name'])),
                    'aadhar_doc'             => base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name'])),
                    'active_status' => 1,
                    'vertical_code' =>$data['organization_details']['vertical_code'],
                    'assessment_scheme_id_fk' =>$data['organization_details']['assessment_scheme_id_fk'],
                    'registration_number' =>$this->input->post('reg_no'),
                    'caste_id_fk' =>($this->input->post('caste_id')== NULL) ? NULL :$this->input->post('caste_id'),
                    'religion_id_fk' =>($this->input->post('religion_id')== NULL) ? NULL :$this->input->post('religion_id')

                );

                $status = $this->std_reg_model->insert_data('council_organization_student_details',$data_array);
                if(!empty($status)){
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Successfully student added');
                    
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Unable to add student');
                }

                redirect('/admin/organization/student_reg');

            }

        }else{

            $this->load->view($this->config->item('theme') . 'organization/student/student_add_view',$data);
        }
    }

    public function file_validation($id=null,$file_name = NULL){
        $file_array = explode("|", $file_name);
       // print_r($file_array);exit;
        if ($file_array[3] == "data:application/pdf;base64") {
            $ext = "PDF";
        } elseif ($file_array[1] == "data:image/jpeg;base64") {
            $ext = "JPEG";
        }
        
        $decode_data=hex2bin($file_array[0]);
        //print_r($decode_data);die;
        $decodedPdf = explode(',', $decode_data);
        $file=str_replace($decodedPdf[0],"",$decode_data);
        $file_size=strlen(base64_decode($file));
        if(round($file_size/1024) >= $file_array[2]){
        $this->form_validation->set_message('file_validation', 'Maximum Size '.$file_array[2].' KB for {field}');
        return FALSE;
        }else{
            if($decodedPdf[0]!=$file_array[3]){
                $this->form_validation->set_message('file_validation', "The {field} file type must be $ext ");
                return FALSE;
            }else{ 
                return TRUE;
            }
        }
    }

    public function file_validation_old($fild = NULL, $file_name = NULL)
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

    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->student_reg_model->getDistrictByStateId($state_id);

            if (!empty($district)) {


                echo json_encode($district);
            }
        }
    }

    public function getSubDivision($district_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if ($district_id == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );

                $nodalOfficer     = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($district_id == 682) || ($district_id == 683)) {

                $kolkataArray = array(
                    0 => $district_id, // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $district_id  = 16;

                $nodalOfficer = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $nodalOfficer = $this->details_model->getNodalOfficerByDistrictId($district_id);
            }

            $subDivisionHtml = '<option value="" hidden="true">Select Sub Division</option>';
            $subDivision     = $this->details_model->getSubDivisionByDistrictId($district_id);



            $nodalOfficerHtml = '<option value="" hidden="true">Select Nodal</option>';

            if (!empty($nodalOfficer)) {

                foreach ($nodalOfficer as $key => $value) {
                    $nodalOfficerHtml .= '
                            <option value="' . $value['nodal_officer_id_pk'] . '">
                                ' . $value['nodal_centre_name'] . '
                            </option>
                        ';
                }
            } else {

                $nodalOfficerHtml .= '<option value="" disabled="true">No Data found.</option>';
            }

            $response = array(
                // 'subDivisionHtml'  => $subDivisionHtml,
                'subDivision'  => $subDivision,
                'nodalOfficerHtml' => $nodalOfficerHtml,
            );

            echo json_encode($response);
        }
    }

    public function getMunicipality($sub_division_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select Municipality</option>';
            $municipality = $this->details_model->getMunicipalityByDivisionId($sub_division_id);

            if (!empty($municipality)) {

                echo json_encode($municipality);
            }
        }
    }

    public function getCourseList($stdSector = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($stdSector != NULL) {

            $html = '<option value="" hidden="true">Select Course</option>';
            $courseList = $this->student_model->getCourseList($stdSector);

            if (!empty($courseList)) {
                foreach ($courseList as $key => $value) {
                    $html .= '
                    <option value="' . $value['course_id_pk'] . '">
                    ' . $value['course_name'] . ' [' . $value['course_code'] . ']
                    </option>
                ';
                }
            } else {
                $html .= '<option>No Data Found...</option>';
            }
            echo json_encode($html);
        }
    }

    public function getCourseDuration($stdCourse = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($stdCourse != NULL) {

            $html = '<option value="" hidden="true">Select Course</option>';
            $duration = $this->std_reg_model->getDuration($stdCourse);

            if (!empty($duration)) {
                $course_duration = $duration['duration'];
            } else {
                $course_duration = '';
            }
            echo json_encode($course_duration);
        }
    }

    //add on 04-08-2023
    public function std_details($id_hash = NULL){

        $data['stake_id_fk'] = $this->session->userdata('stake_id_fk');
        $data['stake_details_id_fk'] = $this->session->userdata('stake_details_id_fk');

        $data['salutations'] =  $this->student_reg_model->getSalutation();
        $data['genders'] =  $this->student_reg_model->getGender();
        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['casteList']  = $this->student_reg_model->get_caste();
        $data['religion']  = $this->student_reg_model->get_religion();
        $data['stateList']  = $this->student_reg_model->getAllState();
        $data['sectorList']  = $this->student_model->getSectorList();
        $data['tc_course'] = $this->tc_reg_model->getTcAllCourseList($data['stake_details_id_fk']);
        
        if($data['stake_id_fk'] == 36){
            $data['tc_details'] = $this->std_reg_model->getOrgIdFromTCID($data['stake_details_id_fk']);
            $OrgId = $data['tc_details']['organization_id_fk'];
        }else{
            $OrgId = $data['stake_details_id_fk'];
        }
        $data['organization_details'] = $this->std_reg_model->getOrganization_detailsById($OrgId);

        $std_details = $this->std_reg_model->getStdDetailsByID($id_hash);
        //echo "<pre>";print_r($std_details);die;
        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['form_data']['student_details_id_pk'] = $std_details['student_details_id_pk'];
            $data['form_data']['salutation'] = $std_details['salutation_id_fk'];
            $data['form_data']['fname'] = $std_details['first_name'];
            $data['form_data']['mname'] = $std_details['middle_name'];
            $data['form_data']['lname'] = $std_details['last_name'];
            $data['form_data']['father_name'] = $std_details['father_name'];
            $data['form_data']['mother_name'] = $std_details['mother_name'];
            $data['form_data']['guardian_name'] = $std_details['guardian_name'];

            $data['form_data']['aadhar_no'] = $std_details['aadhar_no'];
            $data['form_data']['mob_no'] = $std_details['mob_no'];
            $data['form_data']['email_id'] = $std_details['email_id'];
            $data['form_data']['dob'] = $std_details['dob'];

            $data['form_data']['gender'] = $std_details['gender_id_fk'];
            $data['form_data']['caste'] = $std_details['caste_id_fk'];
            $data['form_data']['religion_id'] = $std_details['religion_id_fk'];
            $data['form_data']['reg_no'] = $std_details['registration_number'];
            $data['form_data']['street_vill_town'] = $std_details['street_vill_town'];
            $data['form_data']['post_office'] = $std_details['post_office'];
            $data['form_data']['police_station'] = $std_details['police_station'];
            $data['form_data']['pin_code'] = $std_details['pin_code'];
            $data['form_data']['state'] = $std_details['state_id_fk'];
            $data['form_data']['district'] = $std_details['district_id_fk'];
            $data['form_data']['sub_division_id_fk'] = $std_details['sub_division_id_fk'];
            $data['form_data']['municipality_id_fk'] = $std_details['municipality'];
            $data['form_data']['course_id_fk'] = $std_details['course_id_fk'];
            $data['form_data']['course_duration'] = $std_details['course_duration'];

            $data['form_data']['image'] = $std_details['image'];
            $data['form_data']['signature'] = $std_details['signature'];
            $data['form_data']['aadhar_doc'] = $std_details['aadhar_doc'];
        }else{

            $data['form_data']['salutation'] = $this->input->post('salutation');

        }

        if (!empty($data['form_data']['state'])) {
            $data['district'] = $this->student_reg_model->getDistrictByStateId($data['form_data']['state']);
        }

        if (!empty($data['form_data']['sub_division_id_fk'])) {
            $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($data['form_data']['sub_division_id_fk']);
        }

        if(!empty($data['form_data']['district'])){

            if ($data['form_data']['district'] == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );
    
                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district']);
            } elseif (($data['form_data']['district'] == 682) || ($data['form_data']['district'] == 683)) {
    
                $kolkataArray = array(
                    0 => $data['form_data']['district'], // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );
    
                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
            } else {
    
                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district']);
            }
        }
        
        $this->load->view($this->config->item('theme') . 'organization/student/student_details_view',$data);
    }

    public function download_uploaded_doc($mode=NULL , $id_hash = NULL)
    {

        if ($id_hash != NULL) {

        $result = $this->std_reg_model->gaetUploadedDocById($id_hash);
         //print_r($result);die;
            if (!empty($result)) {
                if($mode==1){
                    $uploaded_file     = $result['image'];
                    header("Content-type:image/jpeg");
                }elseif($mode=='2'){
                    $uploaded_file     = $result['signature'];
                    header("Content-type:image/jpeg");
                }elseif($mode=='3'){
                    $uploaded_file     = $result['aadhar_doc'];
                    header("Content-type:application/pdf");
                }
                
                $publication_title = time();

               
                // header("Content-Disposition:attachment;filename=" . $publication_title . ".pdf");

                echo base64_decode($uploaded_file);
            } else {

                redirect('admin/organization/student_reg/std_details/'.$id_hash);
            }
        } else {

            redirect('admin/organization/student_reg/std_details/'.$id_hash);
        }
    }
}