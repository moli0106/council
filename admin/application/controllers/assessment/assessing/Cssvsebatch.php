<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cssvsebatch extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(116);
        // $this->output->enable_profiler(TRUE);

        $this->load->model('assessment/assessing_cssvsebatch_model');
        // $this->load->helper('email');

        $this->css_head = array(
            0 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );

        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'assessment/assessing_cssvse_batch.js',
        );
    }

    // ! List all assessment list
    public function index_OLD($offset = 0)
    {
        $data['offset']       = $offset;
        $data['page_links']  = NULL;

        $this->load->library('pagination');

        $config['base_url']         = 'assessment/assessing/cssvsebatch/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->assessing_cssvsebatch_model->getCssvseBatchCount()[0]['count'];
        $config['per_page']         = 20;
        $config['num_links']        = 9;
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

        $data['page_links']  = $this->pagination->create_links();
        $data['batch_list']  = $this->assessing_cssvsebatch_model->getAllCssvseBatch($config['per_page'], $offset);

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'assessment/assessing/cssvse/cssvsebatch_list_view', $data);
    }

    public function index($offset = 0)
    {
        $data['offset']       = $offset;
        $data['page_links']  = NULL;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $searchArray['batch_code'] = $this->input->post('search_batch_code');

            if (!empty($searchArray['batch_code'])) {

                $data['batch_list']  = $this->assessing_cssvsebatch_model->searchTraineeBatch($searchArray);
            } else {
                redirect('admin/assessment/assessing/cssvsebatch');
            }
        } else {

            $this->load->library('pagination');

            $config['base_url']         = 'assessment/assessing/cssvsebatch/index/';
            $data["total_rows"]         = $config['total_rows'] = $this->assessing_cssvsebatch_model->getCssvseBatchCount()[0]['count'];
            $config['per_page']         = 20;
            $config['num_links']        = 9;
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

            $data['page_links']  = $this->pagination->create_links();
            $data['batch_list']  = $this->assessing_cssvsebatch_model->getAllCssvseBatch($config['per_page'], $offset);
        }
        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'assessment/assessing/cssvse/cssvsebatch_list_view', $data);
    }

    public function details($batch_id_hash = 0)
    {
        if (!empty($batch_id_hash)) {

            $result = $this->assessing_cssvsebatch_model->getCssvseTraineeBatchDetails($batch_id_hash);

            $data = array(
                'batch_details'    => $result['batch_details'],
                'assessor_details' => $result['assessor_details'],
                'tranee_details'   => $result['tranee_details']
            );

            $this->load->view($this->config->item('theme') . 'assessment/assessing/cssvse/batch_details_view', $data);
        } else {
            redirect('admin/assessment/assessing/cssvsebatch');
        }
    }

    public function add_student($batch_id_hash = 0)
    {
        $data['batch_id_hash'] = $batch_id_hash;
        if (!empty($batch_id_hash)) {

            $data['batch_details'] =  $this->assessing_cssvsebatch_model->getBasicBatchDetails($batch_id_hash);
            if (!empty($data['batch_details'])) {

                $batch_code_array = explode('/', $data['batch_details']['user_batch_id']);
                $data['udise_code'] = $batch_code_array[0];

                $data['school_data'] = $this->assessing_cssvsebatch_model->getCssvseSchoolDetails($data['udise_code']);
                if (!empty($data['school_data'])) {

                    $data['salutationList'] =  $this->assessing_cssvsebatch_model->getSalutation();
                    $data['genderList'] =  $this->assessing_cssvsebatch_model->getGender();
                    $data['districtList']  = $this->assessing_cssvsebatch_model->getDistrictList();
                    $data['classList']  = $this->assessing_cssvsebatch_model->getClassList();

                    if ($this->input->server("REQUEST_METHOD") == "POST") {

                        $data['form_data']['stdMobile'] = $this->input->post('stdMobile');
                        $data['form_data']['stdEmail'] = $this->input->post('stdEmail');
                        $data['form_data']['district'] = $this->input->post('district');
                        $data['form_data']['municipality'] = $this->input->post('municipality');
                        $data['form_data']['pinNo'] = $this->input->post('pinNo');
                        $data['form_data']['address'] = $this->input->post('address');

                        $data['form_data']['sector_name'] = $data['batch_details']['sector_name'] . ' [' . $data['batch_details']['sector_code'] . ']';
                        $data['form_data']['course_name'] = $data['batch_details']['course_name'] . ' [' . $data['batch_details']['course_code'] . ']';

                        if (!empty($data['form_data']['district'])) {
                            $data['municipality'] = $this->assessing_cssvsebatch_model->getMunicipalityByDistrict($data['form_data']['district']);
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
                                'rules' => 'trim|required|max_length[100]'
                                // 'rules' => 'trim|required|alpha|max_length[100]'
                            ),
                            array(
                                'field' => 'stdMidName',
                                'label' => 'Middle Name',
                                'rules' => 'trim|max_length[100]'
                                // 'rules' => 'trim|alpha|max_length[100]'
                            ),
                            array(
                                'field' => 'stdLastName',
                                'label' => 'Last Name',
                                'rules' => 'trim|required|max_length[100]',
                                // 'rules' => 'trim|required|alpha|max_length[100]',
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
                                'field' => 'internal_marks',
                                'label' => 'Internal Marks',
                                'rules' => 'trim|required|numeric|less_than_equal_to[20]',
                            ),
                            array(
                                'field' => 'stdSector',
                                'label' => 'Sector',
                                'rules' => 'trim|required',
                            ),
                            array(
                                'field' => 'stdCourse',
                                'label' => 'Course',
                                'rules' => 'trim|required',
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

                            $cssvse_school_batch_details =  $this->assessing_cssvsebatch_model->getCssvseSchoolBatch($data['batch_details']['user_batch_id']);
                            $municipality_details =  $this->assessing_cssvsebatch_model->getMunicipalityDetails($this->input->post('municipality'));


                            // ! Starting Transaction
                            $this->db->trans_start(); # Starting Transaction

                            $studentMasterArray = array(
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
                                'sector_id_fk' => $data['batch_details']['sector_id_pk'],
                                'course_id_fk' => $data['batch_details']['course_id_pk'],
                                'course_description' => ($this->input->post('courseDesp') != NULL) ? $this->input->post('courseDesp') : NULL,
                                'course_duration' => $this->input->post('courseDuration'),
                                'address' => $this->input->post('address'),
                                'image' => base64_encode(file_get_contents($_FILES["student_image"]['tmp_name'])),
                                'active_status' => 1,
                                'entry_time' => "now()",
                                'entry_ip' => $this->input->ip_address(),
                                'batch_assigned_status' => 1,
                                'added_by_assessing_body' => 1,
                            );

                            $student_id_pk = $this->assessing_cssvsebatch_model->insertStudentInCssvseStudentMaster($studentMasterArray);
                            if ($student_id_pk) {

                                $cssvseBatchStudentMapArray = array(
                                    'school_id_fk' => $data['school_data']['school_id_pk'],
                                    'school_reg_id_fk' => $data['school_data']['school_reg_id_pk'],
                                    'udise_code' => $data['school_data']['udise_code'],
                                    'batch_id_fk' => $cssvse_school_batch_details['batch_id_pk'],
                                    'user_batch_id' => $cssvse_school_batch_details['user_batch_id'],
                                    'student_id_fk' => $student_id_pk,
                                    'active_status' => 1,
                                    'entry_time' => 'now()',
                                    'entry_ip' => $this->input->ip_address(),
                                );
                                $this->assessing_cssvsebatch_model->insertBatchStudentMap($cssvseBatchStudentMapArray);

                                $internalMarksArray = array(
                                    'school_id_fk' => $data['school_data']['school_id_pk'],
                                    'school_reg_id_fk'     => $data['school_data']['school_reg_id_pk'],
                                    'udise_code'          => $data['school_data']['udise_code'],
                                    'batch_id_fk'           => $cssvse_school_batch_details['batch_id_pk'],
                                    'user_batch_id'        => $cssvse_school_batch_details['user_batch_id'],
                                    'student_id_fk'             => $student_id_pk,
                                    'internal_marks'            => $this->input->post('internal_marks'),
                                    'active_status'          => 1,
                                    'entry_ip'               => $this->input->ip_address()
                                );
                                $this->assessing_cssvsebatch_model->insertStudentInternalMarks($internalMarksArray);


                                $gender = '';
                                $trainee_full_name = $this->input->post('stdFirstName') . ' ' . $this->input->post('stdMidName') . ' ' . $this->input->post('stdLastName');

                                switch ($this->input->post('gender')) {
                                    case 1:
                                        $gender = 'Male';
                                        break;

                                    case 2:
                                        $gender = 'Female';
                                        break;

                                    case 3:
                                        $gender = 'Other';
                                        break;

                                    default:
                                        $gender = NULL;
                                        break;
                                }

                                $assessmentCandidateDetails = array(
                                    "assessment_batch_id_fk"       => $data['batch_details']['assessment_batch_id_pk'],
                                    "user_trainee_id"              => $this->input->post('regNumber'),
                                    "user_trainee_registration_no" => $this->input->post('regNumber'),
                                    "trainee_full_name"            => $trainee_full_name,
                                    "trainee_guardian_name"        => $this->input->post('guardianName'),
                                    "trainee_gender"               => $gender,
                                    "trainee_dob"                  => $this->date_format_us($this->input->post('dob')),
                                    "attendance_percentage"        => 0,
                                    "trainee_mobile_no"            => $this->input->post('stdMobile'),
                                    "trainee_address"              => $this->input->post('address'),
                                    "trainee_pincode"              => $this->input->post('pinNo'),
                                    "trainee_state_lgd"            => $municipality_details[0]['state_id_pk'],
                                    "trainee_state_name"           => $municipality_details[0]['state_name'],
                                    "trainee_district_lgd"         => $municipality_details[0]['district_lgd_code'],
                                    "trainee_district_name"        => $municipality_details[0]['district_name'],
                                    "trainee_block_municipality_lgd"  => $municipality_details[0]['municipality_lgd_code'],
                                    "trainee_block_municipality_name" => $municipality_details[0]['block_municipality_name'],
                                    "entry_ip"                     => $this->input->ip_address(),
                                    "active_status"                => 1,
                                    "process_id_fk"                => 1,
                                    "trainee_image"     => base64_encode(file_get_contents($_FILES["student_image"]['tmp_name'])),
                                );
                                $trainee_id = $this->assessing_cssvsebatch_model->insertAssessmentCandidate($assessmentCandidateDetails);

                                $this->assessing_cssvsebatch_model->updateAssessmentCandidateData($trainee_id, array('council_trainee_code' => 'TR_' . sprintf("%010d", $trainee_id)));

                                // ! Check All Query For Trainee
                                if ($this->db->trans_status() === FALSE) {
                                    # Something went wrong.
                                    $this->db->trans_rollback();

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');
                                } else {
                                    # Everything is Perfect. Committing data to the database.
                                    $this->db->trans_commit();

                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'Student added successfully.');
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');
                            }

                            redirect("admin/assessment/assessing/cssvsebatch/add_student/" . $data['batch_details']['batch_id_hash']);
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
                        $data['form_data']['sector_name'] = $data['batch_details']['sector_name'] . ' [' . $data['batch_details']['sector_code'] . ']';
                        $data['form_data']['course_name'] = $data['batch_details']['course_name'] . ' [' . $data['batch_details']['course_code'] . ']';

                        if (!empty($data['form_data']['district'])) {
                            $data['municipality'] = $this->assessing_cssvsebatch_model->getMunicipalityByDistrict($data['form_data']['district']);
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'assessment/assessing/cssvse/add_student_view', $data);
                } else {
                    redirect('admin/assessment/assessing/cssvsebatch');
                }
            } else {
                redirect('admin/assessment/assessing/cssvsebatch');
            }
        } else {
            redirect('admin/assessment/assessing/cssvsebatch');
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

    public function date_format_us($date_uk = NULL)
    {
        $date_array = explode("/", $date_uk);
        return $date_array[2] . '/' . $date_array[1] . '/' . $date_array[0];
    }
}
