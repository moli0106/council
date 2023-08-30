<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institute_list extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        //parent::check_privilege(164);
        parent::check_privilege();
        //$this->output->enable_profiler(TRUE);
        $this->load->model('institute_student/student_list_model');
        $this->load->model('affiliation/details_model');
        $this->load->model('poly_institute/institute_list_model');


        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',

           
            3 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            4 => $this->config->item('theme_uri') . 'council/css/autocomplete-jquery-ui.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'poly_institute/institute_list.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",

            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
            
            6 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            7  => $this->config->item('theme_uri') . 'council/js/autocomplete-jquery-ui.min.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
    }

    public function index($offset = 0)
    {

        $data['offset'] = $offset;

        $data['getfinalsubmitStudentCount'] = $this->institute_list_model->getfinalsubmitStudentCount();
        // echo '<pre>'; print_r($data['getfinalsubmitStudentCount']); die;
        $this->load->view($this->config->item('theme') . 'poly_institute/institute_list_view', $data);
    }


    public function get_institute_list()
    {
        //  error_reporting(0);
        /*$columns = array(
            1 => 'sl_no',
            2 => 'institute_code',
            3 => 'institute_name',
            4 => 'institute_category',
            5 => 'available_student',
            6 => 'action'

        ); */
        $columns = array(
            1 => 'sl_no',
            2 => 'institute_code',
            3 => 'institute_type',
            4 => 'institute_name',
            5 => 'institute_category',
            6 => 'available_student',
            7 => 'action'

        );


        $limit = $this->input->GET('length');
        $start = $this->input->GET('start');

        $orderColumn = $columns[$this->input->GET('order')[0]['column']];
        $orderType = $this->input->GET('order')[0]['dir'];

        $search = $this->input->GET('search')['value'];


        if (!empty($search)) {

            $data['instituteList']     = $this->institute_list_model->getInstituteListBySearch($limit, $start, $orderColumn, $orderType, $search);



            $listCount = count($this->institute_list_model->getInstituteListCountBySearch($search));
        } else {

            $data['instituteList']     = $this->institute_list_model->getInstituteList($limit, $start, $orderColumn, $orderType);
            // echo '<pre>'; print_r($data['instituteList'] ); 

            $listCount = $this->institute_list_model->getInstituteListCount()[0]['count'];

            // echo '<pre>'; print_r($listCount); 
        }

        $i = $start + 1;
        $x = 1;
        foreach ($data['instituteList'] as $data) {


            $institute_id_fk = $data['vtc_id_pk'];

            $student_count = $this->institute_list_model->getStudentCount($institute_id_fk);
            // echo '<pre>'; print_r($student_count); die;
            //echo $student_count['count'];
            $options1 = '<a class="btn btn-info btn-xm" title = Details href="poly_institute/institute_list/details/' . md5($data['vtc_id_pk']) . '" ><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>';
        // added by avijit -03-03
            if($data['vtc_type'] ==3){
                $inst_type = 'ET';
            }else if($data['vtc_type'] ==4){
                $inst_type = 'P';
            }else{
                $inst_type = 'P & ET';
            }
        ///
            $nestedData['sl_no'] = $i;
            $nestedData['institute_code'] = $data['vtc_code'];
            $nestedData['institute_type'] = $inst_type;
            $nestedData['institute_name'] = substr($data['vtc_name'], 0, 30);

            $nestedData['institute_category'] = $data['category_name'];
            $nestedData['available_student'] = $student_count['count'];
            $nestedData['action'] = $options1;

            $info[] = $nestedData;
            $i++;
            $x++;
        }

        // die;


        if ($listCount > 0) {
            $output = array(
                "draw" => intval($this->input->post('draw')),
                // "recordsTotal" => $this->vtc_model->getVtcListCount($selected_year)[0]['count'],
                // "recordsFiltered" => $this->vtc_model->getVtcListCount($selected_year)[0]['count'],

                "recordsTotal" => $listCount,
                "recordsFiltered" => $listCount,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }


        echo json_encode($output);
    }


    public function details($id_hash = Null)
    {

        $data['studentUnderInstitute'] = $this->institute_list_model->getStudentListUnderinstitute($id_hash);

        // echo '<pre>'; print_r($data['studentUnderInstitute']); die;

        $data['institute_name'] = $data['studentUnderInstitute'][0]['vtc_name'];
        // echo '<pre>'; print_r($institute_name); die;
        $data['institute_code'] = $data['studentUnderInstitute'][0]['vtc_code'];

        $data['institute_id_fk'] = $data['studentUnderInstitute'][0]['institute_id_fk'];

        $this->load->view($this->config->item('theme') . 'poly_institute/institute_student_details/institute_details_view', $data);
    }

    public function student_own_details($stu_id_hash = Null)
    {



        $data['exam_type'] = $this->student_list_model->getAllExamType();
        $data['nationality']  = $this->student_list_model->get_nationality();
        $data['salutations'] =  $this->student_list_model->get_salutation();
        $data['genders'] =  $this->student_list_model->get_gender();
        $data['casteList']  = $this->student_list_model->get_caste();
        $data['religion']  = $this->student_list_model->get_religion();
        $data['stateList']  = $this->student_list_model->getAllState();
        $data['board_name']  = $this->student_list_model->getAllBoard();

        // echo $stu_id_hash; die;
        $data['app_data'] = $this->institute_list_model->student_own_data($stu_id_hash);
        //  echo '<pre>'; print_r($data['app_data']); die;

        if ($this->input->server("REQUEST_METHOD") == 'POST') {

            $formData['ins_code'] = set_value('vtcCode');
            $formData['exam_type_id'] = set_value('exam_type_id');
            $formData['course_id'] = set_value('course_id');
            $formData['state_id_fk']  = set_value('state');
            $formData['district_id_fk']  = set_value('district');
            $formData['sub_division_id_fk']  = set_value('subDivision');
            $formData['municipality_id_fk']  = set_value('municipality');
            $formData['caste_id']  = set_value('caste_id');

            $formData['phy_challenged']  = set_value('phy_challenged');
            $formData['citizenship']  = set_value('citizenship');

            $formData['gender']  = set_value('gender');
            $formData['marital_status']  = set_value('marital_status');
            $formData['board_id']  = set_value('board_id');
        } else {

            $formData['ins_code'] = $data['app_data']['vtc_code'];
            $formData['exam_type_id'] = $data['app_data']['exam_type_id_fk'];
            $formData['course_id'] = $data['app_data']['course_id_fk'];

            $formData['state_id_fk']  = $data['app_data']['state_id_fk'];
            $formData['district_id_fk']  = $data['app_data']['district_id_fk'];
            $formData['sub_division_id_fk']  = $data['app_data']['sub_div_id_fk'];
            $formData['municipality_id_fk']  = $data['app_data']['municipality_id_fk'];

            $formData['caste_id']  = $data['app_data']['caste_id_fk'];
            // $formData['gender']  = $data['app_data']['caste_id_fk'];
            $formData['phy_challenged']  = $data['app_data']['handicapped'];
            $formData['citizenship']  = $data['app_data']['nationality_id_fk'];

            $formData['gender']  = $data['app_data']['gender_id_fk'];
            $formData['marital_status']  = $data['app_data']['marital_status'];
            $formData['board_id'] = $data['app_data']['board_id_pk'];
        }

        if ($formData['ins_code'] != '' && $formData['exam_type_id'] != '') {

            $data['course'] = $this->student_list_model->getCourseByCode($formData['ins_code'], $formData['exam_type_id']);
        }

        if (!empty($formData['state_id_fk'])) {
            $data['district'] = $this->student_list_model->getDistrictByStateId($formData['state_id_fk']);
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
            //echo "<pre>";print_r($_FILES);exit;
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(

                array('field' => 'exam_type_id', 'label' => 'Application Name', 'rules' => 'trim|required'),

                array('field' => 'fname', 'label' => 'First Name', 'rules' => 'trim|required'),

                array('field' => 'lname', 'label' => 'Last Name', 'rules' => 'trim|required'),

                // array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                // array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                array('field' => 'guardian_name', 'label' => 'Guardian Name', 'rules' => 'trim|required'),

                array('field' => 'guardian_relation', 'label' => 'Relationship with Guardian', 'rules' => 'trim|required'),

                array('field' => 'aadhar_no', 'label' => 'Aadhar Number', 'rules' => 'trim|required|exact_length[12]|numeric'),

                array('field' => 'mob_no', 'label' => 'Mobile Number', 'rules' => 'trim|required|exact_length[10]|numeric'),

                array('field' => 'email_id', 'label' => 'Email ID', 'rules' => 'trim|required'),

                array('field' => 'address', 'label' => 'Address', 'rules' => 'trim|required'),

                array('field' => 'district', 'label' => 'District', 'rules' => 'trim|required'),


                array('field' => 'pinCode', 'label' => 'Pin Code', 'rules' => 'trim|required|exact_length[6]|numeric'),

                array('field' => 'caste_id', 'label' => 'Caste', 'rules' => 'trim|required'),

                array('field' => 'phy_challenged', 'label' => 'Physically Challenged', 'rules' => 'trim|required'),

                array('field' => 'dob', 'label' => 'Date of Birth', 'rules' => 'trim|required'),

                // array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                array('field' => 'gender', 'label' => 'Gender', 'rules' => 'trim|required'),

                array('field' => 'marital_status', 'label' => 'Marital Status', 'rules' => 'trim|required'),

                array('field' => 'citizenship', 'label' => 'Citizenship', 'rules' => 'trim|required'),

                array('field' => 'state', 'label' => 'State', 'rules' => 'trim|required'),

                array('field' => 'fullmark', 'label' => 'Full Marks', 'rules' => 'trim|required'),

                array('field' => 'marks_obtain', 'label' => 'Marks Obtained', 'rules' => 'trim|required'),
                array('field' => 'percentage', 'label' => 'Percentage', 'rules' => 'trim|required'),
                array('field' => 'institute_name', 'label' => 'Institute Name', 'rules' => 'trim|required'),
                array('field' => 'passing_year', 'label' => 'Passing Year', 'rules' => 'trim|required'),
                array('field' => 'board_id', 'label' => 'Board Name', 'rules' => 'trim|required')
                // array('field' => 'kanyashree_no', 'label' => 'Kanyashree Enrollment No', 'rules' => 'trim|required'),


            );
            if ($this->input->post('state') == 19) {
                $config[] = array('field' => 'subDivision', 'label' => 'Sub Division', 'rules' => 'trim|required');
                $config[] = array('field' => 'municipality', 'label' => 'Municipality', 'rules' => 'trim|required');
            }

            if ($this->input->post('gender') == 2 && $this->input->post('marital_status') == 2) {
                $config[] = array('field' => 'kanyashree_no', 'label' => 'Kanyashree Enrollment No', 'rules' => 'trim');
            }
            if ($this->input->post('caste_id') != 1) {

                if ($data['app_data']['caste_doc'] == '') {

                    $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|]');
                } else {

                    $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|]');
                }
            }



            if ($this->input->post('phy_challenged') == 1) {
                if ($data['app_data']['phy_challenged_doc'] == '') {

                    $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');
                } else {
                    $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|]');
                }
            }

            if ($this->input->post('citizenship') != 1) {

                if ($data['app_data']['citizenship_approval_doc'] == '') {
                    $this->form_validation->set_rules('citizenship_doc', 'Citizenship Document', 'trim|callback_file_validation[citizenship_doc|application/pdf|200|required]');
                } else {
                    $this->form_validation->set_rules('citizenship_doc', 'Citizenship Document', 'trim|callback_file_validation[citizenship_doc|application/pdf|200|]');
                }
            }
            if ($data['app_data']['aadhar_doc'] == '') {

                $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
            } else {
                $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|]');
            }

            // for aadhar_no and mobile no unique validation //


            // photo sign validation //




            if ($data['app_data']['picture'] == '') {

                $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100|required]');
            } else {
                $this->form_validation->set_rules('photo', 'Photo', 'trim|callback_file_validation[photo|image/jpeg|100|]');
            }

            if ($data['app_data']['sign'] == '') {

                $this->form_validation->set_rules('sign', 'Signature', 'trim|callback_file_validation[sign|image/jpeg|100|required]');
            } else {
                $this->form_validation->set_rules('sign', 'Signature', 'trim|callback_file_validation[sign|image/jpeg|100|]');
            }

            // end code//

            if ($formData['exam_type_id'] == 3) {

                $config[] = array('field' => 'phy_marks', 'label' => 'Marks Physics', 'rules' => 'trim|required');
                $config[] = array('field' => 'chem_marks', 'label' => 'Marks of Chemistry', 'rules' => 'trim|required');
                $config[] = array('field' => 'math_bio_marks', 'label' => 'Marks of  Life Science or Biology /Mathematics', 'rules' => 'trim|required');
            }

            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == TRUE) {
                $data['validate_error'] = 0;

                $vtc_code = $_POST['vtcCode'];
                $vtc_details = $this->institute_list_model->getInsDetails($vtc_code);

                if ($this->input->post("citizenship") == 2) {
                    if ($_FILES["citizenship_doc"]['tmp_name'] != '') {
                        $citizenship_doc = base64_encode(file_get_contents($_FILES["citizenship_doc"]['tmp_name']));
                    } else {
                        $citizenship_doc = $data['app_data']['citizenship_approval_doc'];
                    }
                } else {
                    $citizenship_doc = '';
                }

                if ($this->input->post("caste_id") != 1) {


                    if ($_FILES["caste_doc"]['tmp_name'] != '') {
                        $caste_doc = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                    } else {
                        $caste_doc = $data['app_data']['caste_doc'];
                    }
                } else {
                    $caste_doc = '';
                }

                if ($this->input->post("phy_challenged") == 1) {
                    if ($_FILES["phy_challenged_doc"]['tmp_name'] != '') {
                        $phy_challenged_doc = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                    } else {
                        $phy_challenged_doc = $data['app_data']['phy_challenged_doc'];
                    }
                } else {
                    $phy_challenged_doc = '';
                }

                if ($_FILES["aadhar_doc"]['tmp_name'] != '') {
                    $aadhar_doc = base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name']));
                } else {
                    $aadhar_doc = $data['app_data']['aadhar_doc'];
                }


                if ($_FILES["photo"]['tmp_name'] != '') {
                    $picture = base64_encode(file_get_contents($_FILES["photo"]['tmp_name']));
                } else {
                    $picture = $data['app_data']['picture'];
                }

                if ($_FILES["sign"]['tmp_name'] != '') {
                    $sign = base64_encode(file_get_contents($_FILES["sign"]['tmp_name']));
                } else {
                    $sign = $data['app_data']['sign'];
                }


                if ($data['app_data']['exam_type_id_fk'] == 3) {
                    $edu_qualification['phy_marks'] = $this->input->post("phy_marks");
                    $edu_qualification['chem_marks'] = $this->input->post("chem_marks");
                    $edu_qualification['math_bio_marks'] = $this->input->post("math_bio_marks");
                }

                $qua_status = $this->institute_list_model->updateStdQualifiDetails($data['app_data']['institute_student_details_id_pk'], $edu_qualification);

                $tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[0] . '-' . $tmp_date[1]);
                $date = date_format($date, "Y-m-d");


                $basic_details = array(

                    "institute_id_fk" => $vtc_details['vtc_id_pk'],
                    "course_id_fk" => $this->input->post("course_id"),
                    "exam_type_id_fk" => $this->input->post("exam_type_id"),
                    'institute_category'  => $this->input->post("ins_category"),

                    "first_name" => $this->input->post("fname"),
                    "middle_name" => $this->input->post("mname"),
                    "last_name" => $this->input->post("lname"),
                    "father_name" => $this->input->post("father_name"),
                    "mothers_name" => $this->input->post("mother_name"),
                    "guardian_name" => $this->input->post("guardian_name"),
                    "guardian_relationship" => $this->input->post("guardian_relation"),
                    "nationality_id_fk" => $this->input->post("citizenship"),
                    "citizenship_approval_doc"     => $citizenship_doc,
                    "email" => $this->input->post("email_id"),
                    "address" => $this->input->post("address"),
                    "address_2" => $this->input->post("address_2"),
                    "address_3" => $this->input->post("address_3"),
                    "state_id_fk" => $this->input->post("state"),
                    "district_id_fk" => $this->input->post("district"),
                    "sub_div_id_fk" => ($this->input->post("subDivision") != NULL) ? $this->input->post("subDivision") : NULL,
                    "municipality_id_fk" => ($this->input->post("municipality") != NULL) ? $this->input->post("municipality") : NULL,
                    "pincode" => $this->input->post("pinCode"),
                    "caste_id_fk" => $this->input->post("caste_id"),
                    "caste_doc"     => $caste_doc,
                    "religion_id_fk" => $this->input->post("religion_id"),
                    "handicapped" => $this->input->post("phy_challenged"),
                    "phy_challenged_doc"     => $phy_challenged_doc,
                    "date_of_birth" => $date,
                    "aadhar_doc"     => $aadhar_doc,
                    "gender_id_fk" => $this->input->post("gender"),
                    "marital_status" => $this->input->post("marital_status"),
                    "kanyashree_no" => ($this->input->post("kanyashree_no") == NULL) ? NULL : $this->input->post("kanyashree_no"),
                    "basic_d_save_status" => 1,

                    "picture"     => $picture,
                    "sign"     => $sign,
                    "photo_sign_save_status" => 1,

                    "fullmarks" => $this->input->post("fullmark"),
                    "marks_obtain" => $this->input->post("marks_obtain"),
                    "percentage" => $this->input->post("percentage"),
                    "cgpa" => ($this->input->post("c_g_p_a") == Null) ? NULL : $this->input->post("c_g_p_a"),

                    "institute_name" => $this->input->post("institute_name"),
                    "year_of_passing" => $this->input->post("passing_year"),
                    "qualification_d_save_status" => 1,
                    "board_id_pk" => $this->input->post("board_id"),

                    "bangla_shiksha_reg_number" => $this->input->post("bengShikshaRegNo"),
                    "aadhar_no" => $this->input->post("aadhar_no"),
                    "mobile_number" => $this->input->post("mob_no"),
                    "email" => $this->input->post("email_id"),
                    "phy_marks" =>($this->input->post("phy_marks")==Null)? NULL:$this->input->post("phy_marks"),
                    "chem_marks" => ($this->input->post("chem_marks")==Null)? NULL:$this->input->post("chem_marks"),
                    "math_bio_marks" => ($this->input->post("math_bio_marks")== Null)?NULL:$this->input->post("math_bio_marks"),


                    "updated_time" => "now()",
                    "updated_ip" => $this->input->ip_address(),
                    "updated_by" => $this->session->userdata('stake_details_id_fk')

                );

                $login_update_array = array(

                    "login_id" => $this->input->post("aadhar_no"),
                    "base_login_id" => $this->input->post("aadhar_no"),
                    "mobile_no" => $this->input->post("mob_no"),
                    "stake_holder_details" => $this->input->post("fname") . ' ' . $this->input->post("mname") . ' ' . $this->input->post("lname"),
                    "update_time" => "now()",
                    "update_ip" => $this->input->ip_address(),
                    // "updated_by" => $this->session->userdata('stake_details_id_fk')

                );


                $spot_council_data = array(

                    'college_id_fk'       => $vtc_details['vtc_id_pk'],
                    'aadhar_no'             => $this->input->post("aadhar_no"),
                    'mobile_number'             => $this->input->post("mob_no"),
                    "course_id_fk" => $this->input->post("course_id"),
                    "exam_type_id_fk" => $this->input->post("exam_type_id"),
                    'institute_category'  => $this->input->post("ins_category")
                );
                // echo "<pre>";print_r($login_update_array); die;
                $s = $data['app_data']['institute_student_details_id_pk'];
                $spot_id_fk = $data['app_data']['spotcouncil_student_details_id_fk'];
                //  echo '<pre>'; print_r($spot_id_fk); die;
                //    $t=$this->session->userdata('stake_details_id_fk');
                //    echo '<pre>'; print_r($t); die;

                $this->db->trans_start(); # Starting Transaction

                $status = $this->institute_list_model->updateStdDetails($s, $basic_details);

                // echo $status;die;

                if ($status) {

                    $login_update = $this->institute_list_model->updateLoginDetails($spot_id_fk, $login_update_array);

                    $spotcouncil_update = $this->institute_list_model->updateSpotDetails($spot_id_fk, $spot_council_data);
                    $data['validate_error'] = 1;
                    // echo "true"; die;

                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to update data at this time, Please try later.');
                        //redirect("online_application_various_courses/registration/std_info/".md5($final_data['student_details_id_pk']));
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();


                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Your data successfully updated.');
                         //redirect('admin/poly_institute/institute_list/student_own_details/'.md5($s),'refresh');
						 redirect('admin/poly_institute/institute_list/details/'.md5($data['app_data']['institute_id_fk']),'refresh');
                    }
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'have an error.');
                }
            } else {
                $data['validate_error'] = 1;
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }
        }

        $this->load->view($this->config->item('theme') . 'poly_institute/institute_student_details/student_details_view', $data);
    }

    // added by abhijit 07-03-2023

    public function getCourseByInsCode($vtc_code = null, $exam_type_id = null)
    {
        // echo $this->input->is_ajax_request(); die;
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $vtc_code = $this->input->get('vtc_code');
            $exam_type_id = $this->input->get('exam_type_id');

            $course = $this->student_list_model->getCourseByCode($vtc_code, $exam_type_id);
            // echo "<pre>";print_r($course);exit;

            if (!empty($course)) {


                echo json_encode($course);
            }
        }
    }

    public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->student_list_model->getDistrictByStateId($state_id);

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

    public function getBanglashikhshaStudentDetails($std_code = NULL)
    {

        $this->load->helper('banglashiksha');
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if (!empty($std_code)) {

                // $std_code = '06604719002823';
                // $student_data = gettingStudentDetailsByBanglaShikshaCode($std_code);
                // echo "<pre>";print_r($student_data);exit;

                $insertData = array(
                    'student_code' => $std_code,
                    'entry_time'  => 'now()'

                );

                $insert_id = $this->student_list_model->insertData('council_banglashiksha_api_json_data', $insertData);

                $post_data = array(
                    'std_code' => $std_code
                );
                //$url = 'http://localhost/council_live/api_rest_server/vtc_student/banglashiksha/gettingStudentDetailsByBanglaShikshaCode';
                $url = 'http://172.20.140.171/api_rest_server/vtc_student/banglashiksha/gettingStudentDetailsByBanglaShikshaCode';
                $this->load->library('curl');
                $curl_response = $this->curl->curl_make_post_request($url, $post_data);
                $data_response = json_decode($curl_response, true);
                $student_data = $data_response['student_details'];
                //echo "<pre>";print_r($student_data);exit;
                if (!empty($student_data)) {

                    $district_id = gettingDistrictId($student_data['StuContactDistrict']);
                    $block_details  = gettingBlockId($student_data['StuContactBlock']);
                    // echo "<pre>";print_r($block_details);exit;
                    $block_id = $block_details['block_municipality_id_pk'];
                    $subdiv_id   = $block_details['subdiv_id_fk'];
                    $caste_id  = gettingCasteId($student_data['SocialCategoryCode']);
                    $religion_id = gettingReligionId($student_data['ReligionCode']);
                    $gender = gettingGender($student_data['GenderCode']);
                    $phy_challenged = ($student_data['CwsnYesNoCode'] != NULL) ? $student_data['CwsnYesNoCode'] : NULL;
                    //echo $student_data['StudentName'];exit;
                    $name = explode(' ', $student_data['StudentName']);
                    // echo"<pre>";print_r($name);exit;
                    $first_name = explode(' ', trim($student_data['StudentName']))[0];
                    $last_name = array_pop($name);


                    $update_data = array(
                        'transaction_id' => $student_data['TransactionId'],
                        'json_data'     => json_encode($data_response)
                    );
                    $this->student_list_model->update_json_table_data($insert_id, $update_data);

                    $res = array(
                        'fullname' => $student_data['StudentName'],
                        // 'first_name'   =>  $first_name,
                        // 'last_name'   =>  $last_name,
                        'guardianName'  => $student_data['GuardianName'],
                        'fatherName'    => $student_data['FatherName'],
                        'aadhaarNumber' => $student_data['AadhaarNumber'],
                        'stuMobile' => $student_data['StuMobile'],
                        'nationality' => $student_data['NationalityCode'],
                        'state'   => $student_data['StuContactStateCode'],
                        'district' => $district_id,
                        'subdivision' => $subdiv_id,
                        'block'       => $block_id,
                        'stuContactPin' => $student_data['StuContactPin'],
                        'caste'         => $caste_id,
                        'religion'      => $religion_id,
                        'gender'        => $gender,
                        // 'phy_challenged' => $phy_challenged,
                        'date_of_birth'    => date('d-m-Y', strtotime($student_data['StuDob']))
                    );
                    echo json_encode($res);
                }
            }
        }
    }


    public function download_citizenship_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_citizen_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=Citizenship-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['citizenship_approval_doc']);
        } else {
            show_404();
        }
    }

    public function download_caste_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_caste_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=Caste-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['caste_doc']);
        } else {
            show_404();
        }
    }

    public function download_handicap_doc($id = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_handicap_file_content($id);
        // echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=handicap-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['phy_challenged_doc']);
        } else {
            show_404();
        }
    }


    public function download_aadhaar_doc($id_hash = NULL)
    {

        //echo $id; die;
        $file_content = $this->student_list_model->get_student_aadhaar_file_content($id_hash);
        //echo '<pre>';print_r($file_content); die;
        if (count($file_content)) {

            header("Content-type:application/pdf");
            header("Content-Disposition:attachment;filename=aadhaar-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
            echo base64_decode($file_content[0]['aadhar_doc']);
        } else {
            show_404();
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


    public function getVtcDetailsByName()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $vtc_name = $this->input->get('vtc_name');



            $vtcDetails = $this->institute_list_model->getInstituteDetails($vtc_name);

            // $vtc_details = $this->student_reg_model->getInstituteDetails();

            $cart = array();
            foreach ($vtcDetails as $key => $val) {
                // $data['id'] =$val['subject_code'];
                // $data['value'] =$val['subject_name'];
                // array_push($cart , $data);
                //array_push($cart , $val['vtc_name'].','.$val['vtc_code']);
                array_push($cart, $val['vtc_name'] . ',' . $val['vtc_code'] . ',' . $val['category_name']);
            }

            echo json_encode($cart);
        }
    }



    public function showreApproved($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['stu_data'] = $this->institute_list_model->getStudentDetailsById($id_hash);

                 // echo "<pre>";print_r($data['student_data']);

                $html_view = $this->load->view($this->config->item('theme') . 'poly_institute/ajax/reapproved_status_ajax_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    public function updateStudentApproveRejectStatus(){
        
       // echo 'hi'; die;
        if ($this->input->server('REQUEST_METHOD') == "POST") {
           
            
            $status = $this->input->post('status');
            $remarks = $this->input->post('remarks');
            $std_id_hash = $this->input->post('std_id_hash'); 
            $data['student_data'] = $this->institute_list_model->getStudentDetailsById($std_id_hash);
            // echo '<pre>'; print_r($data['student_data']); die;
            // if($status == 0){
            //     $updArray = array(
            //         'approve_reject_status'  => 1,
            //         // 'reject_note'     => $remarks,
            //         //'approve_reject_time'   => 'now()',
            //     );

            //     // echo "<pre>";print_r($updArray);exit;

            //     $rejectStatus = $this->institute_list_model->updateStudentData($std_id_hash,$updArray);

                

            //     if ($rejectStatus) {

                    

            //         $this->session->set_flashdata('status', 'success');
            //         $this->session->set_flashdata('alert_msg', 'Student successfully rejected.');
            //     } else {
            //         $this->session->set_flashdata('status', 'danger');
            //         $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
            //     }

            //     redirect(base_url('poly_institute/institute_list/details/'.$std_id_hash));

           if ($status == 1) {

                $updArray = array(
                    'approve_reject_status'  => 2,
                    'approve_reject_time'   => 'now()',
                );

                // echo "<pre>";print_r($updArray);exit;

                $approveStatus = $this->institute_list_model->updateStudentData($std_id_hash,$updArray);

                

                if ($approveStatus) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Council admin successfully Reapproved.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/poly_institute/institute_list/details/'.md5($data['student_data']['institute_id_fk'])));

            }
        }
    }


    public function getRejectNote($id_hash = NULL){

        // if (!$this->input->is_ajax_request()) {
        //     exit('No direct script access allowed');
        // } else {
            if ($id_hash != NULL) {
                $data['stu_data'] = $this->institute_list_model->getStudentDetailsById($id_hash);

                // echo "<pre>";print_r($data['student_data']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'poly_institute/ajax/student_reject_note_ajax_view', $data, TRUE);

                echo json_encode($html_view);
            }
        // }
    }
	
	// added by abhijit 16-03-23

    public function changeActiveDeactiveStatus($id_hash = NULL)
    {
        //echo $id_hash; exit;
		//echo $this->input->get('updateStatus');exit;
        $updateArray  = array('council_approvedreject_status' => $this->input->get('updateStatus'));
        $updateResult1 = $this->institute_list_model->updateCouncil_activeDeactive_status($id_hash, $updateArray);
        if($updateResult1)
        {
            $updateArray  = array('council_approvedreject_status' => ($this->input->get('updateStatus') == 1) ? 0 : 1);
            // $updateResult2 = $this->master_trainer_model->stakeHolderLogin($id_hash, $updateArray);
            echo json_encode('done');
        }
    }

    // ADDED BY AVIJHIT ON 20-03-2023
     // added by moli di 14-03-23

    public function genarate_student_reg_certificate_old_22(){
        

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // echo 'test'; die;
           
           $institute_id_fk = $this->input->get('institute_id_fk');
            if ($institute_id_fk != NULL) {

                $student_list = $this->institute_list_model->getStudentListByInsId($institute_id_fk);
                // echo '<pre>';print_r($student_list);exit;
                if($student_list){
                    foreach ($student_list as $key => $value) {
                        $certificate_no = $this->generate_certificate_no($value['exam_type_id_fk'], $value['registration_year']);
                        //echo $certificate_no['certificateCode'];exit;
                        if (($certificate_no['certificateCode'] != '')) {
                            // ! Starting Transaction
                            $this->db->trans_start(); # Starting Transaction
                            $insert_array = array(
                                'institute_student_details_id_fk'  => $value['institute_student_details_id_pk'],
                                'spotcouncil_student_details_id_fk' => $value['spotcouncil_student_details_id_fk'],
                                'registration_year'                 => $value['registration_year'],
                                'reg_certificate_number'            => $certificate_no['certificateCode'],
                                'reg_certificate_genarated_time'    => 'now()',
                                'reg_certificate_genarated_by'      => $this->session->userdata('stake_details_id_fk'),
                                'active_status'                     =>1,
                                'institute_id_fk'                    => $value['institute_id_fk']
                            );
                            $last_id= $this->institute_list_model->insert_certificate_no('council_institute_student_card_number_map', $insert_array);
                            if($last_id){
                                $this->institute_list_model->update_student_details($value['institute_student_details_id_pk'], array('reg_certificate_status' =>1));
                                if ($this->db->trans_status() === FALSE) {
    
                                    $this->db->trans_rollback(); # Something went wrong.
    
    
                                } else {
        
                                    $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.
    
                                    
                                }
        
                            }
                        }
                    }
                    $ajaxResponse = array(
                        'ok'  => 1,
                        'msg' => 'Success! Certificate number genarated successfully.'
                    );
                }else{
                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found..',
                    );
                }
                
            }else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }
            echo json_encode($ajaxResponse);
        }


    }

 public function generate_certificate_no_old($exam_type_id_fk,$registration_year){

        // $state_code = "WB";
        if($exam_type_id_fk == 3){
            $start_code = "PHARM";
        }elseif ($exam_type_id_fk == 1 || $exam_type_id_fk == 2) {
            $start_code = "D";
        }elseif ($exam_type_id_fk == 4){

            $start_code = "PD";
        }

        // $exam_year = date('Y');
        $reg_year = str_replace('-', '', substr($registration_year,0));

        $chaking_data = ($start_code . $reg_year);
        $check_exist_code = $this->institute_list_model->get_last_certificate_no($chaking_data)[0];

        if ($check_exist_code['code'] == "") {
            $number = "00001";
        } else {

            $code = $check_exist_code['code'];
            $cd = (int)str_pad(substr($code, -5), strlen($code));

            $cd = $cd + 1;
            $number = $cd;
            $no_of_digit = 5;
            $length = strlen((string)$number);

            for ($i = $length; $i < $no_of_digit; $i++) {
                $number = '0' . $number;
            }
            $number;
        }

        $certificateCode = $start_code . $reg_year . $number;

        return array(
            
            'certificateCode' => $certificateCode
        );
    }


    public function genarate_student_reg_certificate(){
        

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // echo 'test'; die;
           
           $institute_id_fk = $this->input->get('institute_id_fk');
            if ($institute_id_fk != NULL) {

                $student_list = $this->institute_list_model->getStudentListByInsId($institute_id_fk);
                // echo '<pre>';print_r($student_list);exit;
                if($student_list){
                    foreach ($student_list as $key => $value) {
                        $certificate_no = $this->generate_certificate_no($value['exam_type_id_fk'], $value['registration_year']);
                        //echo $certificate_no['certificateCode'];exit;
                        if (($certificate_no['certificateCode'] != '')) {
                            // ! Starting Transaction
                            $this->db->trans_start(); # Starting Transaction
                            $insert_array = array(
                                'institute_student_details_id_fk'  => $value['institute_student_details_id_pk'],
                                'spotcouncil_student_details_id_fk' => $value['spotcouncil_student_details_id_fk'],
                                'registration_year'                 => $value['registration_year'],
                                'reg_certificate_number'            => $certificate_no['certificateCode'],
                                'reg_certificate_genarated_time'    => 'now()',
                                'reg_certificate_genarated_by'      => $this->session->userdata('stake_details_id_fk'),
                                'active_status'                     =>1,
                                'institute_id_fk'                    => $value['institute_id_fk']
                            );
                            $last_id= $this->institute_list_model->insert_certificate_no('council_institute_student_card_number_map', $insert_array);
                            if($last_id){
                                $this->institute_list_model->update_student_details($value['institute_student_details_id_pk'], array('reg_certificate_status' =>1));
                                if ($this->db->trans_status() === FALSE) {
    
                                    $this->db->trans_rollback(); # Something went wrong.
    
    
                                } else {
        
                                    $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.
    
                                    
                                }
        
                            }
                        }
                    }
                    $ajaxResponse = array(
                        'ok'  => 1,
                        'msg' => 'Success! Certificate number genarated successfully.'
                    );
                }else{
                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found..',
                    );
                }
                
            }else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }
            echo json_encode($ajaxResponse);
        }


    }


// Added by Abhijit 22-03-23 //

    public function genarate_student_2nd_yr_reg_certificate(){
        

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            // echo 'test'; die;
           
           $institute_id_fk = $this->input->get('institute_id_fk');
            if ($institute_id_fk != NULL) {

               
                $student_list = $this->institute_list_model->get_2nd_yr_StudentListByInsId($institute_id_fk);
                // echo '<pre>';print_r($student_list);exit;
                if($student_list){
                    foreach ($student_list as $key => $value) {
                        $certificate_no = $this->generate_certificate_no($value['exam_type_id_fk'], $value['registration_year']);
                        //echo $certificate_no['certificateCode'];exit;
                        if (($certificate_no['certificateCode'] != '')) {
                            // ! Starting Transaction
                            $this->db->trans_start(); # Starting Transaction
                            $insert_array = array(
                                'institute_student_details_id_fk'  => $value['institute_student_details_id_pk'],
                                'spotcouncil_student_details_id_fk' => $value['spotcouncil_student_details_id_fk'],
                                'registration_year'                 => $value['registration_year'],
                                'reg_certificate_number'            => $certificate_no['certificateCode'],
                                'reg_certificate_genarated_time'    => 'now()',
                                'reg_certificate_genarated_by'      => $this->session->userdata('stake_details_id_fk'),
                                'active_status'                     =>1,
                                'institute_id_fk'                    => $value['institute_id_fk']
                            );
                            $last_id= $this->institute_list_model->insert_certificate_no('council_institute_student_card_number_map', $insert_array);
                            if($last_id){
                                $this->institute_list_model->update_student_details($value['institute_student_details_id_pk'], array('reg_certificate_status' =>1));
                                if ($this->db->trans_status() === FALSE) {
    
                                    $this->db->trans_rollback(); # Something went wrong.
    
    
                                } else {
        
                                    $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.
    
                                    
                                }
        
                            }
                        }
                    }
                    $ajaxResponse = array(
                        'ok'  => 1,
                        'msg' => 'Success! Certificate number genarated successfully.'
                    );
                }else{
                    $ajaxResponse = array(
                        'ok'     => 2,
                        'msg'    => 'Oops! Data not found..',
                    );
                }
                
            }else {

                $ajaxResponse = array(
                    'ok'     => 0,
                    'msg'    => 'Oops! Something went wrong.',
                );
            }
            echo json_encode($ajaxResponse);
        }


    }

    // end//
// ABHIJIT 23-03-2023 

public function generate_certificate_no($exam_type_id_fk,$registration_year){

        // $state_code = "WB";
        if($exam_type_id_fk == 3){
            $start_code = "PHARM";
        }elseif ($exam_type_id_fk == 1 || $exam_type_id_fk == 2) {
            $start_code = "D";
        }elseif ($exam_type_id_fk == 4){

            $start_code = "PD";
        }

        // $exam_year = date('Y');
        $reg_year = str_replace('-', '', substr($registration_year,0));

        $chaking_data = ($start_code . $reg_year);
        $check_exist_code = $this->institute_list_model->get_last_certificate_no($chaking_data)[0];

        if ($check_exist_code['code'] == "") {
            $number = "00001";
        } else {

            $code = $check_exist_code['code'];
            $cd = (int)str_pad(substr($code, -5), strlen($code));

            $cd = $cd + 1;
            $number = $cd;
            $no_of_digit = 5;
            $length = strlen((string)$number);

            for ($i = $length; $i < $no_of_digit; $i++) {
                $number = '0' . $number;
            }
            $number;
        }

        $certificateCode = $start_code . $reg_year . $number;

        return array(
            
            'certificateCode' => $certificateCode
        );
    }

//END

    // Added by moli on 23-05-2023
    public function showCancelRegModal($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->institute_list_model->getStudentById($id_hash);

                // echo "<pre>";print_r($data['student_data']);

                $html_view = $this->load->view($this->config->item('theme') . 'poly_institute/ajax/student_reg_cancel_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }
    public function cancelStudentRegistration(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $remarks = $this->input->post('remarks');
            $std_id_hash = $this->input->post('std_id_hash');

            $data['student_data'] = $this->institute_list_model->getStudentById($std_id_hash);

            //echo $remarks;exit;
            $updArray = array(
                'reg_cancel_status'  => 1,
                'reg_cancel_note'     => $remarks,
                'reg_cancel_time'   => 'now()'
            );

            $cancelStatus = $this->institute_list_model->updateStudentData($std_id_hash,$updArray);

                

            if ($cancelStatus) {

                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Council admin successfully Reapproved.');
            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
            }

            redirect(base_url('admin/poly_institute/institute_list/details/'.md5($data['student_data']['institute_id_fk'])));

        }
    }

 
}
