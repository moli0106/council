<?php
defined('BASEPATH') or exit('No direct script access allowed');

class std_registration extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(160);
        $this->load->model('student_profile/std_registration_model');
        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
            2 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri') . "student_profile/student_reg.js",
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            4 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
        );
    }
    public function index()
    {
        //echo "hii";

        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['app_data']    = $this->std_registration_model->getStdDetails($data['std_id']);
        $data['active_class'] = 'ins_details';
        //    echo "<pre>";print_r($data['app_data']);exit;
        $this->load->view($this->config->item('theme') . 'student_profile/institute_details_view', $data);
    }

    public function basic_details()
    {
        // echo "hii";exit;

        $data['salutations'] =  $this->std_registration_model->get_salutation();
        $data['genders'] =  $this->std_registration_model->get_gender();
        //$data['districtList']  = $this->affiliation_model->getDistrictList();
        $data['casteList']  = $this->std_registration_model->get_caste();
        $data['religion']  = $this->std_registration_model->get_religion();
        $data['nationality']  = $this->std_registration_model->get_nationality();
        $data['stateList']  = $this->std_registration_model->getAllState();


        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['active_class'] = 'basic_details';
        $data['app_data']    = $this->std_registration_model->getStdDetails($data['std_id']);

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $formData['state_id_fk']  = set_value('state');
            $formData['district_id_fk']  = set_value('district');
            $formData['sub_division_id_fk']  = set_value('subDivision');
            $formData['municipality_id_fk']  = set_value('municipality');
            $formData['caste_id_fk']  = set_value('caste_id');
            // $formData['gender_id_fk']  = set_value('gender');
            // $formData['marital_status']  = set_value('municipality');
            $formData['phy_challenged']  = set_value('phy_challenged');
            $formData['citizenship']  = set_value('citizenship');
        } else {
            $formData['state_id_fk']  = $data['app_data']['state_id_fk'];
            $formData['district_id_fk']  = $data['app_data']['district_id_fk'];
            $formData['sub_division_id_fk']  = $data['app_data']['sub_div_id_fk'];
            $formData['municipality_id_fk']  = $data['app_data']['municipality_id_fk'];
            // echo '<pre>'; print_r($formData); die;
            $formData['caste_id']  = $data['app_data']['caste_id_fk'];
            // $formData['gender']  = $data['app_data']['caste_id_fk'];
            $formData['phy_challenged']  = $data['app_data']['handicapped'];
            $formData['citizenship']  = $data['app_data']['nationality_id_fk'];
        }
        if (!empty($formData['state_id_fk'])) {
            $data['district'] = $this->std_registration_model->getDistrictByStateId($formData['state_id_fk']);
        }

        if (!empty($formData['district_id_fk'])) {
            $data['sub_division'] = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
        }

        if (!empty($formData['sub_division_id_fk'])) {
            $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($formData['sub_division_id_fk']);
        }

        if (!empty($formData['district_id_fk'])) {
            if ($formData['district_id_fk'] == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($formData['district_id_fk'] == 682) || ($formData['district_id_fk'] == 683)) {

                $kolkataArray = array(
                    0 => $formData['district_id_fk'], // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($formData['district_id_fk']);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($formData['district_id_fk']);
            }
        }
        $data['formData'] = $formData;

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array('field' => 'fname', 'label' => 'First Name', 'rules' => 'trim|required',),

                array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required',),

                // array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                // array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                array('field' => 'guardian_name', 'label' => 'Guardian Name', 'rules' => 'trim|required',),

                array('field' => 'guardian_relation', 'label' => 'Relationship with Guardian', 'rules' => 'trim|required',),

                array('field' => 'aadhar_no', 'label' => 'Aadhar Number', 'rules' => 'trim|required'),

                array('field' => 'email_id', 'label' => 'Email ID', 'rules' => 'trim|required',),

                array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required',),

                array('field' => 'district', 'label' => 'District', 'rules' => 'trim|required',),


                array('field' => 'pinCode', 'label' => 'Pin Code', 'rules' => 'trim|required',),

                array('field' => 'caste_id', 'label' => 'Caste', 'rules' => 'trim|required',),

                array('field' => 'phy_challenged', 'label' => 'Physically Challenged', 'rules' => 'trim|required',),

                array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required',),

                // array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required',),

                array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),

                array('field' => 'citizenship', 'label' => 'Citizenship', 'rules' => 'trim|required'),

                array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),
                array('field' => 'kanyashree_no', 'label' => 'Kanyashree Enrollment No', 'rules' => 'trim|required'),


            );
            if ($this->input->post('state') == 19) {
                $config[] = array('field' => 'subDivision', 'label' => 'Sub Division', 'rules' => 'trim|required');
                $config[] = array('field' => 'municipality', 'label' => 'Municipality', 'rules' => 'trim|required');
            }
            if ($this->input->post('caste_id') != 1) {

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');
            }
            if ($this->input->post('phy_challenged') == 1) {
                if ($data['app_data']['phy_challenged_doc'] == '') {

                    $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');
                } else {
                    $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|]');
                }
            }

            if ($this->input->post('citizenship') != 1) {

                $this->form_validation->set_rules('citizenship_doc', 'Citizenship Document', 'trim|callback_file_validation[citizenship_doc|application/pdf|200|required]');
            }
            if ($data['app_data']['aadhar_doc'] == '') {

                $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
            } else {
                $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|]');
            }

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {

                $basic_details = array(

                    "first_name" => $this->input->post("fname"),
                    "middle_name" => $this->input->post("mname"),
                    "last_name" => $this->input->post("lname"),
                    "father_name" => $this->input->post("father_name"),
                    "mothers_name" => $this->input->post("mother_name"),
                    "guardian_name" => $this->input->post("guardian_name"),
                    "guardian_relationship" => $this->input->post("guardian_relation"),
                    "nationality_id_fk" => $this->input->post("citizenship"),
                    "citizenship_approval_doc"     => base64_encode(file_get_contents($_FILES["citizenship_doc"]['tmp_name'])),
                    "email" => $this->input->post("email_id"),
                    "address" => $this->input->post("address"),
                    "address_2" => $this->input->post("address_2"),
                    "address_3" => $this->input->post("address_3"),
                    "state_id_fk" => $this->input->post("state"),
                    "district_id_fk" => $this->input->post("district"),
                    "sub_div_id_fk" => ($this->input->post("subDivision") != NULL) ? $this->input->post("subDivision") : NULL,
                    "municipality_id_fk" => $this->input->post("municipality"),
                    "pincode" => $this->input->post("pinCode"),
                    "caste_id_fk" => $this->input->post("caste_id"),
                    "caste_doc"     => base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name'])),
                    "religion_id_fk" => $this->input->post("religion_id"),
                    "handicapped" => $this->input->post("phy_challenged"),
                    "phy_challenged_doc"     => base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name'])),
                    "date_of_birth" => $this->input->post("dob"),
                    "aadhar_doc"     => base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name'])),
                    "gender_id_fk" => $this->input->post("gender"),
                    "marital_status" => $this->input->post("marital_status"),
                    "kanyashree_no" => $this->input->post("kanyashree_no"),
                    "basic_d_save_status" => 1,


                    "entry_time" => "now()",
                    "entry_ip" => $this->input->ip_address()

                );

                // echo '<pre>';
                // print_r($basic_details);
                // die;

                $status = $this->std_registration_model->updateStdDetails($data['app_data']['institute_student_details_id_pk'], $basic_details);
                // echo $status;die;

                if ($status == 1) {

                    // echo "true"; die;

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Your data successfully save.');
                    // redirect('online_application_various_courses/registration','refresh');


                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'have an error.');
                }
            }
        }
        // echo "<pre>";print_r($data);exit;
        $this->load->view($this->config->item('theme') . 'student_profile/student_basic_details_view', $data);
    }

    public function photo_signature()
    {
        // echo "<pre>";
        // print_r($_FILES);
        // die;

        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['active_class'] = 'photoSign';
        $data['app_data']    = $this->std_registration_model->getStdDetails($data['std_id']);
        // echo "<pre>";print_r($data['std_details']);exit;

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $config = array(
            array('field' => 'sign', 'label' => 'Signature', 'rules' => 'trim|callback_file_validation[sign|image/jpeg|200|required]'),
            array('field' => 'photo', 'label' => 'Photo', 'rules' => 'trim|callback_file_validation[sign|image/jpeg|200|required]'),
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE) {
            $this->load->view($this->config->item('theme') . 'student_profile/photo_signature_view', $data);
        } else {
           
            $photo_sign = array(
                "picture"     => base64_encode(file_get_contents($_FILES["photo"]['tmp_name'])),
                "sign"     => base64_encode(file_get_contents($_FILES["sign"]['tmp_name'])),
                "photo_sign_save_status" => 1,
            );
            $photo_sign_status = $this->std_registration_model->updatePhotosign($data['app_data']['institute_student_details_id_pk'], $photo_sign);


            if ($photo_sign_status == 1) {

                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Your photo sign successfully save.');
                // redirect('online_application_various_courses/registration','refresh');


            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'have an error.');
            }

            $this->load->view($this->config->item('theme') . 'student_profile/photo_signature_view', $data);
        }
    }
    public function edu_qualification()
    {
        //echo "hii";

        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['active_class'] = 'education';
        $data['app_data']    = $this->std_registration_model->getStdDetails($data['std_id']);
        // echo "<pre>";print_r($data['app_data'] );exit;

        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array('field' => 'fullmark', 'label' => 'Full Marks', 'rules' => 'trim|required',),

                array('field' => 'marks_obtain', 'label' => 'Marks Obtained', 'rules' => 'trim|required',),
                array('field' => 'percentage', 'label' => 'Percentage', 'rules' => 'trim|required',),
                array('field' => 'c_g_p_a', 'label' => 'CGPA', 'rules' => 'trim|required',),
                array('field' => 'p_o_m1', 'label' => 'Percentage of Marks Subject 1', 'rules' => 'trim|required',),
                array('field' => 'p_o_m2', 'label' => 'Percentage of Marks Subject 2', 'rules' => 'trim|required',),
                array('field' => 'p_o_m3', 'label' => 'Percentage of Marks Subject 3', 'rules' => 'trim|required',),
                array('field' => 'institute_name', 'label' => 'Institute Name', 'rules' => 'trim|required',),
                array('field' => 'passing_year', 'label' => 'Passing Year', 'rules' => 'trim|required',),
            );

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {


                $edu_qualification = array(

                    "fullmarks" => $this->input->post("fullmark"),
                    "marks_obtain" => $this->input->post("marks_obtain"),
                    "percentage" => $this->input->post("percentage"),
                    "cgpa" => $this->input->post("c_g_p_a"),
                    "thirdyr_or_physics_or_math_result" => $this->input->post("p_o_m1"),
                    "secondyear_or_chemistry_or_physicalscience_or_science_result" => $this->input->post("p_o_m2"),
                    "firstyear_or_hs_english_or_lifescience_result" => $this->input->post("p_o_m3"),
                    "institute_name" => $this->input->post("institute_name"),
                    "year_of_passing" => $this->input->post("passing_year"),
                    "qualification_d_save_status" => 1,

                );
                // echo '<pre>'; print_r($edu_qualification); die;

                $qua_status = $this->std_registration_model->updateStdQualifiDetails($data['app_data']['institute_student_details_id_pk'], $edu_qualification);

                if ($qua_status == 1) {


                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Your Qualification data save successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'have an error.');
                }
            }
        }

        $this->load->view($this->config->item('theme') . 'student_profile/edu_qualification_view', $data);
    }


    public function final_submit()
    {
      
        $data['std_id']         = $this->session->userdata('stake_details_id_fk');
        $data['active_class'] = 'final_submit';
        $this->title = "Final Submit";
        $data['app_data']    = $this->std_registration_model->getStdDetails($data['std_id']);
        //echo "<pre>";print_r($data);exit;

        

        $this->load->view($this->config->item('theme') . 'student_profile/final_submit_view', $data);
        
    }

    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->std_registration_model->getDistrictByStateId($state_id);

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
        }
    }

    public function download_citizenship_doc($id = NULL){

        //echo $id; die;
		$file_content = $this->std_registration_model->get_student_citizen_file_content($id);
		// echo '<pre>';print_r($file_content); die;
        if(count($file_content)){

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=Citizenship-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['citizenship_approval_doc']);
		} else {
			show_404();
		}
	}

}
