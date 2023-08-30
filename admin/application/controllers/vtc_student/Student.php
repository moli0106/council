<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(141);
        $this->load->model('vtc_student/student_model');
        //$this->output->enable_profiler();
		

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/student.js',
        );
    }

    public function index()
    {
		//print ini_get('memory_limit');die;
       $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['studentList'] = $this->student_model->getStudentList($data['school_reg_id_pk']);

        $this->load->view($this->config->item('theme') . 'vtc_student/student/student_list_view', $data);
    }

    public function add()
    {
        $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['school_data'] = $this->student_model->getRegDetails($data['school_reg_id_pk']);

        if (!empty($data['school_data'])) {

            $data['school_data'] = $data['school_data'][0];

            $data['salutationList'] =  $this->student_model->getSalutation();
            $data['genderList'] =  $this->student_model->getGender();
            $data['districtList']  = $this->student_model->getDistrictList();
            $data['classList']  = $this->student_model->getClassList();
            $data['sectorList']  = $this->student_model->getSectorList();

            if ($this->input->server("REQUEST_METHOD") == "POST") {

                $data['form_data']['stdMobile'] = $this->input->post('stdMobile');
                $data['form_data']['stdEmail'] = $this->input->post('stdEmail');
                $data['form_data']['district'] = $this->input->post('district');
                $data['form_data']['municipality'] = $this->input->post('municipality');
                $data['form_data']['pinNo'] = $this->input->post('pinNo');
                $data['form_data']['address'] = $this->input->post('address');

                $data['form_data']['district'] = $this->input->post('district');
                if (!empty($data['form_data']['district'])) {
                    $data['municipality'] = $this->student_model->getMunicipalityByDistrict($data['form_data']['district']);
                }

                $data['form_data']['stdSector'] = $this->input->post('stdSector');
                if (!empty($data['form_data']['stdSector'])) {
                    $data['courseList'] = $this->student_model->getCourseList($data['form_data']['stdSector']);
                }

                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                $config = array(
                    array(
                        'field' => 'salutation',
                        'label' => 'Salutation',
                        'rules' => 'trim|required',
                    ),
                    array(
                        'field' => 'stdFirstName',
                        'label' => 'First Name',
                        'rules' => 'trim|required|alpha|max_length[100]'
                    ),
                    array(
                        'field' => 'stdMidName',
                        'label' => 'Middle Name',
                        'rules' => 'trim|alpha|max_length[100]'
                    ),
                    array(
                        'field' => 'stdLastName',
                        'label' => 'Last Name',
                        'rules' => 'trim|required|alpha|max_length[100]',
                    ),
                    array(
                        'field' => 'stdMotherName',
                        'label' => 'Mother Name',
                        'rules' => 'trim|max_length[200]'
                    ),
                    array(
                        'field' => 'guardianName',
                        'label' => 'Guardian Name',
                        'rules' => 'trim|required|max_length[200]'
                    ),
                    array(
                        'field' => 'gender',
                        'label' => 'Gender',
                        'rules' => 'trim|required|numeric'
                    ),
                    array(
                        'field' => 'dob',
                        'label' => 'DOB',
                        'rules' => 'trim|required',
                    ),
                    array(
                        'field' => 'stdMobile',
                        'label' => 'Mobile',
                        'rules' => 'trim|required|numeric|max_length[12]'
                    ),
                    array(
                        'field' => 'stdEmail',
                        'label' => 'Email',
                        'rules' => 'trim|required|valid_email'
                    ),
                    array(
                        'field' => 'state',
                        'label' => 'State',
                        'rules' => 'trim|required|numeric',
                    ),
                    array(
                        'field' => 'district',
                        'label' => 'District',
                        'rules' => 'trim|required|numeric',
                    ),
                    array(
                        'field' => 'municipality',
                        'label' => 'Municipality',
                        'rules' => 'trim|required|numeric',
                    ),
                    array(
                        'field' => 'pinCode',
                        'label' => 'Pin Code',
                        'rules' => 'trim|exact_length[6]|numeric',
                    ),
                    array(
                        'field' => 'address',
                        'label' => 'Address',
                        'rules' => 'trim|max_length[500]',
                    ),
                    array(
                        'field' => 'assessmentYear',
                        'label' => 'Assessment Year',
                        'rules' => 'trim|required',
                    ),
                    array(
                        'field' => 'regNumber',
                        'label' => 'Registration Number',
                        'rules' => 'trim|required',
                    ),
                    array(
                        'field' => 'class_id',
                        'label' => 'Class',
                        'rules' => 'trim|required|numeric',
                    ),
                    array(
                        'field' => 'stdSector',
                        'label' => 'Sector',
                        'rules' => 'trim|required|numeric',
                    ),
                    array(
                        'field' => 'stdCourse',
                        'label' => 'Course',
                        'rules' => 'trim|required|numeric',
                    ),
                    array(
                        'field' => 'courseDuration',
                        'label' => 'Course Duration',
                        'rules' => 'trim|required',
                    ),
                );
                $this->form_validation->set_rules('student_image', 'Student Image', 'trim|callback_file_validation[student_image|image/jpeg|100|required]');

                $this->form_validation->set_rules($config);
                if ($this->form_validation->run() != FALSE) {

                    $tmp_date = explode('/', $this->input->post('dob'));
                    $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                    $date = date_format($date, "Y-m-d");

                    $insertArray = array(
                        'school_id_fk' => $data['school_data']['school_id_pk'],
                        'udise_code' => $data['school_data']['udise_code'],
                        'class_id_fk' => $this->input->post('class_id'),
                        'assessment_year' => $this->input->post('assessmentYear'),
                        'salutation_id_fk' => $this->input->post('salutation'),
                        'registration_number' => $this->input->post('regNumber'),
                        'first_name' => $this->input->post('stdFirstName'),
                        'middle_name' => ($this->input->post('stdMidName') != NULL) ? $this->input->post('stdMidName') : NULL,
                        'last_name' => $this->input->post('stdLastName'),
                        'mothers_name' => ($this->input->post('stdMotherName') != NULL) ? $this->input->post('stdMotherName') : NULL,
                        'guardian_name' => $this->input->post('guardianName'),
                        'gender_id_fk' => $this->input->post('gender'),
                        'date_of_birth' => $date,
                        'mobile' => $this->input->post('stdMobile'),
                        'email' => $this->input->post('stdEmail'),
                        'state_id_fk' => $this->input->post('state'),
                        'district_id_fk' => $this->input->post('district'),
                        'municipality_id_fk' => $this->input->post('municipality'),
                        'pin' => $this->input->post('pinNo'),
                        'sector_id_fk' => $this->input->post('stdSector'),
                        'course_id_fk' => $this->input->post('stdCourse'),
                        'course_description' => ($this->input->post('courseDesp') != NULL) ? $this->input->post('courseDesp') : NULL,
                        'course_duration' => $this->input->post('courseDuration'),
                        'address' => $this->input->post('address'),
                        'image' => base64_encode(file_get_contents($_FILES["student_image"]['tmp_name'])),
                        'active_status' => 1,
                        'entry_time' => "now()",
                        'entry_ip' => $this->input->ip_address()
                    );

                    $result = $this->student_model->insertStudentData($insertArray);

                    if ($result) {
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Student added successfully.');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');
                    }

                    redirect('admin/vtc_student/student/add');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Waning! please enter all mandatory fields and correct values.');
                }
            } else {

                $data['form_data']['stdMobile'] = $data['school_data']['school_mobile'];
                $data['form_data']['stdEmail'] = $data['school_data']['school_email'];
                $data['form_data']['district'] = $data['school_data']['district_id_fk'];
                $data['form_data']['municipality'] = $data['school_data']['municipality_id_fk'];
                $data['form_data']['pinNo'] = $data['school_data']['pin_code'];
                $data['form_data']['address'] = $data['school_data']['school_address'];

                if (!empty($data['form_data']['district'])) {
                    $data['municipality'] = $this->student_model->getMunicipalityByDistrict($data['form_data']['district']);
                }
            }

            $this->load->view($this->config->item('theme') . 'vtc_student/student/student_add_view', $data);
        }
    }

    public function details($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($id_hash != NULL) {

            $data['studentDetails'] = $this->student_model->getStudentDetails($id_hash);
            if (!empty($data['studentDetails'])) {

                $data['studentDetails'] = $data['studentDetails'][0];

                $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
                $data['school_data'] = $this->student_model->getRegDetails($data['school_reg_id_pk'])[0];

                $data['salutationList'] =  $this->student_model->getSalutation();
                $data['genderList'] =  $this->student_model->getGender();
                $data['districtList']  = $this->student_model->getDistrictList();
                $data['municipality'] = $this->student_model->getMunicipalityByDistrict($data['school_data']['district_id_fk']);
                $data['classList']  = $this->student_model->getClassList();
                $data['sectorList']  = $this->student_model->getSectorList();
                $data['courseList'] = $this->student_model->getCourseList($data['studentDetails']['sector_id_fk']);

                if (empty($data['studentDetails']['district_id_fk'])) {
                    $data['studentDetails']['district_id_fk'] = $data['school_data']['district_id_fk'];
                }
                if (empty($data['studentDetails']['municipality_id_fk'])) {
                    $data['studentDetails']['municipality_id_fk'] = $data['school_data']['municipality_id_fk'];
                }

                $data['start_year'] = date('Y') - 2;
                $data['end_year'] = date('Y') + 3;

                $html_view = $this->load->view($this->config->item('theme') . 'vtc_student/student/ajax/student_details_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }
    }

    public function update()
    {
        if ($this->input->server("REQUEST_METHOD") == "POST") {
			
			$student_id = $this->input->post('student_id');
			$data['studentDetails'] = $this->student_model->getStudentImage($student_id)[0];
			$image_data=$data['studentDetails']['image'];
			
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'stdMotherName',
                    'label' => 'Mother Name',
                    'rules' => 'trim|required|alpha_numeric_spaces|max_length[250]'
                ),
                array(
                    'field' => 'gender',
                    'label' => 'Gender',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'dob',
                    'label' => 'DOB',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'stdMobile',
                    'label' => 'Mobile',
                    'rules' => 'trim|required|numeric|max_length[12]'
                ),
                array(
                    'field' => 'stdEmail',
                    'label' => 'Email',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'state',
                    'label' => 'State',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'district',
                    'label' => 'District',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'municipality',
                    'label' => 'Municipality',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'pinCode',
                    'label' => 'Pin Code',
                    'rules' => 'trim|exact_length[6]|numeric',
                ),
                array(
                    'field' => 'aadhar_no',
                    'label' => 'Aadhar No',
                    'rules' => 'trim|required|exact_length[12]|numeric',
                ),
                array(
                    'field' => 'address',
                    'label' => 'Address',
                    'rules' => 'trim|max_length[500]',
                ),
                array(
                    'field' => 'assessmentYear',
                    'label' => 'Assessment Year',
                    'rules' => 'trim|required',
                ),
                array(
                    'field' => 'class_id',
                    'label' => 'Class',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'stdSector',
                    'label' => 'Sector',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'stdCourse',
                    'label' => 'Course',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'courseDesp',
                    'label' => 'Course Description',
                    'rules' => 'trim',
                ),
            );
			if($image_data == NULL || $image_data == ''){
				$this->form_validation->set_rules('student_image', 'Student Image', 'trim|callback_file_validation[student_image|image/jpeg|100|required]');
			}

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() != FALSE) {

                

                $tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");

                $updateArray = array(
                    'class_id_fk' => $this->input->post('class_id'),
                    'assessment_year' => $this->input->post('assessmentYear'),
                    'mothers_name' => ($this->input->post('stdMotherName') != NULL) ? $this->input->post('stdMotherName') : NULL,
                    'gender_id_fk' => $this->input->post('gender'),
                    'date_of_birth' => $date,
                    'mobile' => $this->input->post('stdMobile'),
                    'email' => $this->input->post('stdEmail'),
                    'state_id_fk' => $this->input->post('state'),
                    'district_id_fk' => $this->input->post('district'),
                    'municipality_id_fk' => $this->input->post('municipality'),
                    'pin' => $this->input->post('pinNo'),
                    'sector_id_fk' => $this->input->post('stdSector'),
                    'course_id_fk' => $this->input->post('stdCourse'),
                    'address' => $this->input->post('address'),
                    'active_status' => 1,
                    'updated_time' => "now()",
                    'updated_ip' => $this->input->ip_address(),
                    'updated_by' => $this->session->userdata('stake_details_id_fk'),
                    'aadhar_no' => $this->input->post('aadhar_no')
                );

                if (!empty($_FILES['student_image']['tmp_name'])) {
                    $updateArray['image'] = base64_encode(file_get_contents($_FILES["student_image"]['tmp_name']));
                }

                $result = $this->student_model->updateStudentData($student_id, $updateArray);
                if ($result) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Student data updated successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update student data, Please try later.');
                }

                redirect('admin/vtc_student/student');
            } else {

                $this->session->set_flashdata('validation_errors_list', validation_errors());

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Waning! Inappropriate Data, Please enter correct value.');
            }

            redirect('admin/vtc_student/student');
        } else {
            redirect('admin/vtc_student/student');
        }
    }

    public function getMunicipalityList($district_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } elseif ($district_id != NULL) {

            $html = '<option value="" hidden="true">Select Block / Municipality / Corporation</option>';
            $municipality = $this->student_model->getMunicipalityByDistrict($district_id);

            if (!empty($municipality)) {
                foreach ($municipality as $key => $value) {
                    $html .= '
                    <option value="' . $value['block_municipality_id_pk'] . '">
                        ' . $value['block_municipality_name'] . '
                    </option>
                ';
                }
            } else {
                $html .= '<option>No Data Found...</option>';
            }
            echo json_encode($html);
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

    public function remove_student($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if (!empty($id_hash)) {

                $delete = $this->student_model->updateStudentData($id_hash, array('active_status' => 0));
                if ($delete) {
                    echo json_encode('done');
                }
            }
        }
    }
}
