<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_reg extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege(140);
        $this->load->model('vtc_student/student_reg_model');

        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'vtc_student/student_reg.js',

            3 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
        );
    }

    public function index()
    {
       $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['studentList'] = $this->student_reg_model->getStudentList($data['school_reg_id_pk']);

        
        $data['academic_year'] = $this->config->item('current_academic_year');
        $data['vtcDetails'] = $this->student_reg_model->getVtcDetails($data['school_reg_id_pk'], $data['academic_year']);

        // echo "<pre>";print_r($data['vtcDetails']);exit;

        $selected_year = $this->input->post('academic_year');
        if($selected_year == ''){
            $data['academic_year']  = $this->config->item('current_academic_year');
        }else{
            $data['academic_year']  =$selected_year;
        }

        $data['yearlist']  = $this->student_reg_model->getAcademicYearList();

        $this->load->view($this->config->item('theme') . 'vtc_student/student/studentReg_list_view', $data);
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

                $delete = $this->student_reg_model->updateStudentData($id_hash, array('active_status' => 0));
                if ($delete) {
                    echo json_encode('done');
                }
            }
        }
    }


    // --------------------------- Added By Moli ------------------------//

    public function get_list()
    {
        error_reporting(0);
        $columns = array(
            1 => 'sl_no',
            2 => 'std_name',
            3 => 'father_name',
            // 4 => 'email',
            // 5 => 'aadhar_no',
            // 6 => 'mobile_no',
            // 7 => 'reg_year',
            // 8 => 'dob',
            9 => 'course_name',
            10 => 'group_name',
            11 => 'group_code',
            12 => 'status'
        );
        
        $vtc_id =  $this->session->userdata('stake_details_id_fk');
        $academic_year  = $this->config->item('current_academic_year');
        $selected_year = $this->input->GET('selected_year');
        // $selected_year = '2022-23';

        $limit = $this->input->GET('length');
        $start = $this->input->GET('start');

        $orderColumn = $columns[$this->input->GET('order')[0]['column']];
        $orderType = $this->input->GET('order')[0]['dir'];
        
        $search = $this->input->GET('search')['value'];
        
      
            if (!empty($search)) {

                $data['studentList']     = $this->student_reg_model->getStudentListBySearch($limit, $start,$orderColumn, $orderType, $search,$selected_year,$vtc_id);
            } else {

                $data['studentList']     = $this->student_reg_model->getStudentListByVTCId($limit, $start, $orderColumn, $orderType,$selected_year,$vtc_id);
            }

            // echo "<pre>";print_r($data['studentList']);exit;

            $listCount = sizeof($data['studentList']);
      
            

            $i = $start + 1;
            $x = 1;
            foreach ($data['studentList'] as $data) {
					

                $options1 = '<a class="btn btn-info btn-xm" title = Details href="vtc_student/student_reg/student_details/'. md5($data['student_id_pk']) .'" ><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>';

                

                

                if($data['approve_reject_status'] == '') {
                    $options2 = '<button class="btn btn-sm btn-warning approve-reject-modal" data-id="'.md5($data['student_id_pk']).'" data-toggle="modal" data-target="#approve-reject-modal" title="Appprove or Reject"><i class="fa fa-level-up" aria-hidden="true"></i>Approve/Reject</button>';
                }elseif($data['approve_reject_status'] == 0) {
                    $options2 = '<button class="btn btn-sm btn-primary modal-reject-note bg-maroon" data-id="'.md5($data['student_id_pk']).'" data-toggle="modal" data-target="#modal-reject-note" title="View Reject Note"><i class="fa fa-eye" aria-hidden="true"></i>Rejected Note</button>';
                }else{
                    $options2 = '';
                }

                // $options2 = '';

                if ($data['approve_reject_status'] == 1){

                    

                    $status = '<small class="label label-success">Approved</small>';

                    // Added By Moli for payment Check Box
                    $check_button = '<input type="checkbox" name="std_id_pk" class="checkStd" value="'.md5($data['student_id_pk']).'">';

                }
                elseif($data['approve_reject_status'] == '0'){

                   
                    $status = '<small class="label label-danger">Rejected</small>';
                    $check_button = '';
                }else{
                    $status = '';
                    $check_button = '';
                }

               
               
                $nestedData['sl_no'] = $check_button.' '.$i;
                $nestedData['std_name'] = $data['first_name'] .' '.$data['middle_name'].' '.$data['last_name'];
                $nestedData['father_name'] = $data['father_name'];
                
                $nestedData['email'] = $data['email'];
                // $nestedData['aadhar_no'] = $data['aadhar_no'];
                // $nestedData['mobile_no'] = $data['mobile'];
                $nestedData['reg_year'] = $data['year_of_registration'];
                $nestedData['dob'] =date("d/m/Y", strtotime($data['date_of_birth']));
                $nestedData['course_name'] = $data['course_name'];
                $nestedData['group_name'] =  $data['group_name'];
                $nestedData['group_code'] =  $data['group_code'];
                $nestedData['status'] =  $status;
                $nestedData['action'] = $options1.' '.$options2;

                $info[] = $nestedData;
                $i++;
                $x++;
            }

        
            if ($listCount > 0) {
            $output = array(
                "draw" => intval($this->input->post('draw')),
                "recordsTotal" => $this->student_reg_model->getStudentListCount($selected_year)[0]['count'],
                "recordsFiltered" => $this->student_reg_model->getStudentListCount($selected_year)[0]['count'],
                "data" => $info
            );
            } 
            else {
                $output = array(
                    // "draw" => 1,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => []
                );
            }
        

        echo json_encode($output);


    }

    public function add_student(){

        $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        $data['school_data'] = $this->student_reg_model->getVtcDetails($data['school_reg_id_pk'], $data['academic_year']);

        if (!empty($data['school_data'])) {

            

            $data['salutations'] =  $this->student_reg_model->getSalutation();
            $data['genders'] =  $this->student_reg_model->getGender();
            $data['districtList']  = $this->student_reg_model->getDistrictList();
            $data['casteList']  = $this->student_reg_model->get_caste();
            $data['religion']  = $this->student_reg_model->get_religion();
            $data['last_exam']  = $this->student_reg_model->get_last_exam();
            $data['batchDurationList']  = $this->student_reg_model->get_batch_duration();
            $data['academic_year']  = $this->config->item('current_academic_year');

            $data['stateList']  = $this->student_reg_model->getAllState();
            $data['nationality']  = $this->student_reg_model->get_nationality();
            $data['boardList']  = $this->student_reg_model->getAllboard();

            // echo "<pre>";print_r($data['batchDurationList']);exit;

            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                // echo "<pre>";print_r($_POST);
                // echo "<pre>";print_r($_FILES);
                // exit;

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

                // Set Group Value
                $course_name_id = $this->input->post('course_name_id');

                $vtc_code = $this->input->post('vtcCode');
                if(!empty($course_name_id)){

                    $data['group'] = $this->student_reg_model->getGroupByVTCCode($course_name_id,$vtc_code, $data['academic_year']);
                }

                $group_id = $this->input->post('group_id');

                if(!empty($group_id)){
                    $data['group_details'] = $this->student_reg_model->getGroupDetails($group_id);
                }
            
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                $config = array(
                    array(
                        'field' => 'vtcCode',
                        'label' => 'VTC Code',
                        'rules' => 'trim|required',
                        
                    ),
                    array('field' => 'vtcName','label' => 'VTC Name','rules' => 'trim|required',),

                    array('field' => 'admissionYear','label' => 'Admission Year','rules' => 'trim|required',),

                    // array('field' => 'salutation','label' => 'Salutation','rules' => 'trim|required',),

                    array('field' => 'fname','label' => 'First Name','rules' => 'trim|required',),

                    array('field' => 'lname','label' => 'Last Name','rules' => 'trim|required',),

                    array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                    array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                    array('field' => 'guardian_name','label' => 'Guardian Name','rules' => 'trim|required',),

                    array('field' => 'guardian_relation','label' => 'Relationship with Guardian','rules' => 'trim|required',),

                    array('field' => 'aadhar_no','label' => 'Aadhar Number','rules' => 'trim|required|callback_is_unique_aadhar_no',),

                    array('field' => 'mob_no','label' => 'Mobile Number','rules' => 'trim|required',),

                    array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required',),

                    array('field' => 'address','label' => 'Address','rules' => 'trim|required',),

                    array('field' => 'district','label' => 'District','rules' => 'trim|required',),

                    array('field' => 'pinCode','label' => 'Pin Code','rules' => 'trim|required',),

                    array('field' => 'caste_id','label' => 'Caste','rules' => 'trim|required',),

                    array('field' => 'phy_challenged','label' => 'Physically Challenged','rules' => 'trim|required',),

                    array('field' => 'dob','label' => 'Date of Birth','rules' => 'trim|required',),

                    array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                    array('field' => 'gender','label' => 'Gender','rules' => 'trim|required',),

                    array('field' => 'marital_status','label' => 'Marital Status','rules' => 'trim|required'),

                    array('field' => 'course_name_id','label' => 'Course Name','rules' => 'trim|required'),

                    array('field' => 'group_id','label' => 'Group/Trade Name','rules' => 'trim|required'),

                    array('field' => 'citizenship','label' => 'Citizenship','rules' => 'trim|required'),

                    array('field' => 'state','label' => 'State','rules' => 'trim|required'),
                
                );

                if($this->input->post('state') == 19){
                    $config[] = array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required');

                    $config[] = array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required');
                }

                $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');
                
                $this->form_validation->set_rules('aadhar_doc', 'Aadhar Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
                
                $this->form_validation->set_rules('std_signature', 'Student Image', 'trim|callback_file_validation[std_signature|image/jpeg|100|required]');

                if($this->input->post('caste_id') != 1){

                    $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');

                }

                // if ($this->input->post('religion_id') == 4){
                //     $config[] = array('field' => 'otherReligionName','label' => 'Other Religion Name','rules' => 'trim|required');
                // }

                if($this->input->post('phy_challenged') == 1){

                    $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');

                }

                if($this->input->post('citizenship') != 1){

                    $this->form_validation->set_rules('approval_doc', 'Approval Document', 'trim|callback_file_validation[approval_doc|application/pdf|200|required]');

                }

                if ($this->input->post('course_name_id') == 4){
                    $config[] = array('field' => 'batch_duration','label' => 'Batch Duration','rules' => 'trim|required');

                    $config[] = array('field' => 'last_exam_id','label' => 'Last Exam','rules' => 'trim|required');
                    $config[] = array('field' => 'haveRegisterNo','label' => 'Question','rules' => 'trim|required');
    
                    $config[] = array('field' => 'old_reg_no','label' => 'Registration Number','rules' => 'trim|required');
                    $config[] = array('field' => 'old_reg_year','label' => 'Registration Year','rules' => 'trim|required');
    
                    $this->form_validation->set_rules('marksheet', 'Mark Sheet', 'trim|callback_file_validation[marksheet|application/pdf|200|required]');
    
                }elseif ($course_name_id == 1) {



                    $config[] = array('field' => 'board_name','label' => 'Board/Council','rules' => 'trim|required');
                    $config[] = array('field' => 'ten_passing_year','label' => 'year of passing','rules' => 'trim|required');
                    $config[] = array('field' => 'school_state','label' => 'State of location of school','rules' => 'trim|required');
    
                    $config[] = array('field' => 'total_marks','label' => 'Total Marks','rules' => 'trim|required');
    
                    $config[] = array('field' => 'aggregate_marks','label' => 'Aggregate Marks','rules' => 'trim|required');
    
                    $config[] = array('field' => 'percentage_marks','label' => 'Percentage','rules' => 'trim|required');
    
                    
                    $config[] = array('field' => 'haveHSRegisterNo','label' => 'Question','rules' => 'trim|required');
                    $config[] = array('field' => 'register_hs_course','label' => 'Question','rules' => 'trim|required');
                    $config[] = array('field' => 'haveSHSPassed','label' => 'passed Higher Secondary','rules' => 'trim|required');
    
                    $config[] = array('field' => 'old_hs_reg_no','label' => 'Registration Number','rules' => 'trim|required');
                    $config[] = array('field' => 'old_hs_reg_year','label' => 'Registration Year','rules' => 'trim|required');
    
                    if($this->input->post('school_state')!= 19){
    
                        $this->form_validation->set_rules('migration_certificate', 'Migration Certificate', 'trim|callback_file_validation[migration_certificate|application/pdf|200|required]');
        
                    }
        
                    if($this->input->post('register_hs_course') == 1){
        
                        $this->form_validation->set_rules('transfer_certificate', 'Transfer Certificate', 'trim|callback_file_validation[transfer_certificate|application/pdf|200|required]');
        
                    }
    
                    $this->form_validation->set_rules('hs_marksheet', 'Mark Sheet', 'trim|callback_file_validation[hs_marksheet|application/pdf|200|required]');
    
                }

                $this->form_validation->set_rules($config);

                if ($this->form_validation->run() == FALSE) {

                    $this->load->view($this->config->item('theme').'vtc_student/student/student_reg_view',$data);
                    // redirect('admin/affiliation/courses/add');
                } else {

                    

                    if($this->input->post('caste_id') != 1){
                        $caste_doc = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                    }else{
                        $caste_doc = '';
                    }

                    if($this->input->post('phy_challenged') == 1){
                        $phy_challenged_doc = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                    }else{
                        $phy_challenged_doc = '';
                    }

                    if($this->input->post('citizenship') != 1){
                        $approval_doc = base64_encode(file_get_contents($_FILES["approval_doc"]['tmp_name']));
                    }else{
                        $approval_doc = '';
                    }

                    $tmp_date = explode('/', $this->input->post('dob'));
                    $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                    $date = date_format($date, "Y-m-d");

                    $std_data = array(

                        'institute_code'        => $this->input->post('vtcCode'),
                        'institute_id_fk'       => $data['school_data']['vtc_id_pk'],
                        'institute_reg_id_fk'   => $data['school_data']['vtc_details_id_pk'],
                        'year_of_registration'      => $this->input->post('admissionYear'),
                        'bangla_shiksha_reg_number' => ($this->input->post('bengShikshaRegNo') != NULL) ? $this->input->post('bengShikshaRegNo') : NULL,
                        'udise_code'                => ($this->input->post('udise_code') != NULL) ? $this->input->post('udise_code') : NULL,
                        
                        'salutation_id_fk'      => ($this->input->post('salutation') != NULL) ? $this->input->post('salutation') : NULL ,
                        'first_name'            => $this->input->post('fname'),
                        'middle_name'           => ($this->input->post('mname') != NULL) ? $this->input->post('mname') : NULL,
                        'last_name'             => $this->input->post('lname'),
                        'father_name'           => ($this->input->post('father_name') != NULL) ? $this->input->post('father_name') : '',
                        'mothers_name'           => ($this->input->post('mother_name') != NULL) ? $this->input->post('mother_name') : '' ,

                        'guardian_name'            => $this->input->post('guardian_name'),
                        'guardian_relationship' =>$this->input->post('guardian_relation'),

                        'aadhar_no'              =>$this->input->post('aadhar_no'), 
                        'mobile'                =>    $this->input->post('mob_no'),
                        'email'                =>    $this->input->post('email_id'),
                        'address'                =>    $this->input->post('address'),

                        'state_id_fk'           =>$this->input->post('state'),
                        'district_id_fk'        => $this->input->post('district'),
                        'municipality_id_fk'    => ($this->input->post('municipality') !=NULL) ? $this->input->post('municipality') : NULL ,
                        'subdiv_id_fk'    => ($this->input->post('subDivision') !=NULL) ? $this->input->post('subDivision') : NULL,

                        'pin'              => $this->input->post('pinCode'),
                        'image'             => base64_encode(file_get_contents($_FILES["std_image"]['tmp_name'])),

                        'caste'             => $this->input->post('caste_id'),
                        'caste_doc'             => $caste_doc,

                        'religion'              => $this->input->post('religion_id'),
                        'other_religion_name'           => ($this->input->post('otherReligionName') != NULL) ? $this->input->post('otherReligionName') : '',
        
                        'physically_challenged'            =>$this->input->post('phy_challenged'),
                        'phy_challenged_doc'             => $phy_challenged_doc,

                        'date_of_birth'                  =>$date,
                        'aadhar_doc'             => base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name'])),

                        'gender_id_fk'            =>$this->input->post('gender'),
                        'marital_status'            =>$this->input->post('marital_status'),
                        'kanyashree_no'            =>($this->input->post('kanyashree_no') !=NULL) ? $this->input->post('kanyashree_no') : NULL,

                        
                        'class_id_fk'           => $this->input->post('course_name_id'),
                        'phase'                     =>($this->input->post('batch_duration') != NULL) ? $this->input->post('batch_duration') : NULL,
                        'course_id_fk'                     =>($this->input->post('group_id') != NULL) ? $this->input->post('group_id') : NULL,
        
                        'entry_time'                => "now()",
                        'entry_ip'                  => $this->input->ip_address(),
                        'date_of_addmission'        => "now()",

                        'std_signature'             => base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name'])),

                        'nationality_id_fk'           => $this->input->post('citizenship'),
                        'citizenship_approval_doc'  => $approval_doc,
                        'address_2'                =>    $this->input->post('address_2'),
                        'address_3'                =>    $this->input->post('address_3'),

                        'admission_year'            => date("Y"),
        
                    );

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction

                    $std_id = $this->student_reg_model->insertData('council_vtc_student_master', $std_data);

                    if ($std_id) {

                        if ($course_name_id == 4){

                            $council_register = $this->input->post('haveRegisterNo');
                            $marksheet  = base64_encode(file_get_contents($_FILES["marksheet"]['tmp_name']));
    
                        }elseif ($course_name_id == 1) {
                            
                            $council_register = $this->input->post('haveHSRegisterNo');
                            $marksheet = base64_encode(file_get_contents($_FILES["hs_marksheet"]['tmp_name']));
                        }
    
                        $academicData = array(
                            'student_id_fk'         => $std_id,
                            'last_academic_exam_id_fk'             => $this->input->post('last_exam_id'),
                            'board_id_fk'                           => ($this->input->post('board_name') == NULL)? NULL : $this->input->post('board_name'),
                            
                            'marksheet'             => $marksheet,
                            
                            'total_marks'                           => ($this->input->post('total_marks') == '') ? NULL : $this->input->post('total_marks'),
                            'aggregate_marks'                       => ($this->input->post('aggregate_marks') == '') ? NULL :$this->input->post('aggregate_marks'),
                            'percentage'                            => ($this->input->post('percentage_marks') == '') ? NULL : $this->input->post('percentage_marks'),
                            
                            'council_register'                      => $council_register,
                            
                            'ten_passing_year'          =>($this->input->post('ten_passing_year') == '') ? '' : $this->input->post('ten_passing_year'),
                            'ten_school_state'          =>($this->input->post('school_state') == '') ? NULL : $this->input->post('school_state'),
                            
                            'register_hs_course'        => ($this->input->post('register_hs_course') == '') ? NULL : $this->input->post('register_hs_course'),
                            'hs_passed'        => ($this->input->post('haveSHSPassed') == '') ? NULL : $this->input->post('haveSHSPassed'),
                        );
                        if($council_register == 1 && $council_register != ''){
    
                            $academicData['old_reg_no'] = $this->input->post('old_reg_no') ? $this->input->post('old_reg_no') : $this->input->post('old_hs_reg_no') ;
                            $academicData['old_reg_year'] = $this->input->post('old_reg_year') ? $this->input->post('old_reg_year') : $this->input->post('old_hs_reg_year');
                        }else{
                            $academicData['old_reg_no'] = '';
                            $academicData['old_reg_year'] = '';
                        }
    
                        // Migration Certificate
                        if(($course_name_id == 1) && ($this->input->post('school_state') != 19)){
                            $academicData['migration_certificate'] = base64_encode(file_get_contents($_FILES["migration_certificate"]['tmp_name']));
                        }else{
                            $academicData['migration_certificate'] = '';
                        }
    
                        //Transfer Certificate
                        if(($course_name_id == 1) && ($this->input->post('register_hs_course') == 1)){
                            $academicData['transfer_certificate'] = base64_encode(file_get_contents($_FILES["transfer_certificate"]['tmp_name']));
                        }else{
                            $academicData['transfer_certificate'] = '';
                        }

                        $result = $this->student_reg_model->insertData('council_vtc_student_last_examination', $academicData);

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
                            $this->session->set_flashdata('alert_msg', 'Student details has been added successfully.');
                        }

                        redirect('admin/vtc_student/student_reg/add_student');

                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add student at this time, Please try later.');

                        redirect('admin/vtc_student/student_reg/add_student');
                    }

                }
            }else{

                
                $data['form_data']['district'] = $data['school_data']['district_id_fk'];
                $data['form_data']['municipality_id_fk'] = $data['school_data']['municipality_id_fk'];
                $data['form_data']['pinNo'] = $data['school_data']['pin_code'];
                $data['form_data']['sub_division_id_fk']  = $data['school_data']['sub_division_id_fk'];

                if (!empty($data['form_data']['sub_division_id_fk'])) {
                    $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($data['form_data']['sub_division_id_fk']);
                }

                if ($data['school_data']['district_id_fk'] == 16) {

                    $kolkataArray = array(
                        0 => 682, // KOLKATA NORTH 
                        1 => 683, // KOLKATA SOUTH
                        2 => 16, // KOLKATA
                    );
        
                    $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['school_data']['district_id_fk']);
                    $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
                } elseif (($data['school_data']['district_id_fk'] == 682) || ($data['school_data']['district_id_fk'] == 683)) {
        
                    $kolkataArray = array(
                        0 => $data['school_data']['district_id_fk'], // SOUTH / NORTH KOLKATA
                        1 => 16, // KOLKATA
                    );
        
                    $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
                    $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
                } else {
        
                    $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['school_data']['district_id_fk']);
                    $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($data['school_data']['district_id_fk']);
                }

                $this->load->view($this->config->item('theme').'vtc_student/student/student_reg_view',$data);
            }
        }

    }

    public function is_unique_aadhar_no($aadhar_no){
        
        if(($aadhar_no!=NULL || $aadhar_no!=''))
		{
			$duplicate_no = $this->student_reg_model->get_duplicate_aadhar($aadhar_no);
			
		}
		
		if (empty($duplicate_no)) {
			return true;
		}
		else {
	
			$this->form_validation->set_message('is_unique_aadhar_no', 'The {field} field must contain a unique value.');
			return false;
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

            if (!empty($subDivision)) {

                foreach ($subDivision as $key => $value) {
                    $subDivisionHtml .= '
                            <option value="' . $value['subdiv_id_pk'] . '">
                                ' . $value['subdiv_name'] . '
                            </option>
                        ';
                }
            } else {

                $subDivisionHtml .= '<option value="" disabled="true">No Data found.</option>';
            }

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
                'subDivisionHtml'  => $subDivisionHtml,
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

                foreach ($municipality as $key => $value) {
                    $html .= '
                            <option value="' . $value['block_municipality_id_pk'] . '">
                                ' . $value['block_municipality_name'] . '
                            </option>
                        ';
                }
                echo json_encode($html);
            } else {

                $html .= '<option value="" disabled="true">No Data found.</option>';
                echo json_encode($html);
            }
        }
    }

    public function getGroupName($course_name_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $vtc_code = $this->input->get('vtc_code');
            $academic_year  = $this->config->item('current_academic_year');

            if($course_name_id !='' && $vtc_code !=''){

                $html        = '<option value="" hidden="true">Select Group/Trade Name</option>';
                $group = $this->student_reg_model->getGroupByVTCCode($course_name_id,$vtc_code, $academic_year);

                if (!empty($group)) {

                    foreach ($group as $key => $value) {
                        $html .= '
                                <option value="' . $value['group_id_pk'] . '">
                                    ' . $value['group_name'] . '
                                </option>
                            ';
                    }
                    echo json_encode($html);
                } else {

                    $html .= '<option value="" disabled="true">No Data found.</option>';
                    echo json_encode($html);
                }
            }

            
        }
    }

    public function student_details($id_hash = NULL){

        $data['school_reg_id_pk'] =  $this->session->userdata('stake_details_id_fk');
        $data['academic_year'] = $this->config->item('current_academic_year');
        $data['school_data'] = $this->student_reg_model->getVtcDetails($data['school_reg_id_pk'], $data['academic_year']);

        $data['salutations'] =  $this->student_reg_model->getSalutation();
        $data['genders'] =  $this->student_reg_model->getGender();
        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['casteList']  = $this->student_reg_model->get_caste();
        $data['religion']  = $this->student_reg_model->get_religion();
        $data['last_exam']  = $this->student_reg_model->get_last_exam();
        $data['batchDurationList']  = $this->student_reg_model->get_batch_duration();

        $data['stateList']  = $this->student_reg_model->getAllState();
        $data['nationality']  = $this->student_reg_model->get_nationality();

        $data['student_data'] = $this->student_reg_model->getStudentDetailsById($id_hash);
        $data['boardList']  = $this->student_reg_model->getAllboard();
        // echo "<pre>";print_r($data['student_data']);exit;

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $data['from_data']['vtc_code'] = $this->input->post('vtcCode');
            // $data['form_data']['vtc_name'] = $this->input->post('stdEmail');
            $data['form_data']['udise_code'] = $this->input->post('udise_code');
            $data['form_data']['bangla_shiksha_reg_number'] = $this->input->post('bengShikshaRegNo');
            // $data['form_data']['salutation_id_fk'] = $this->input->post('salutation');
            $data['form_data']['first_name'] = $this->input->post('fname');
            $data['form_data']['middle_name'] = $this->input->post('mname');
            $data['form_data']['last_name'] = $this->input->post('lname');
            $data['form_data']['father_name'] = $this->input->post('father_name');
            $data['form_data']['mothers_name'] = $this->input->post('mother_name');
            $data['form_data']['guardian_name'] = $this->input->post('guardian_name');
            $data['form_data']['guardian_relationship'] = $this->input->post('guardian_relation');
            $data['form_data']['nationality_id_fk'] = $this->input->post('citizenship');
            $data['form_data']['aadhar_no'] = $this->input->post('aadhar_no');
            $data['form_data']['mobile'] = $this->input->post('mob_no');
            $data['form_data']['email'] = $this->input->post('email_id');
            $data['form_data']['address'] = $this->input->post('address');
            $data['form_data']['district_id_fk'] = $this->input->post('district');
            $data['form_data']['subdiv_id_fk'] = $this->input->post('subDivision');
            $data['form_data']['municipality_id_fk'] = $this->input->post('municipality');
            $data['form_data']['pin'] = $this->input->post('pinCode');
            $data['form_data']['caste'] = $this->input->post('caste_id');
            $data['form_data']['religion'] = $this->input->post('religion_id');
            $data['form_data']['other_religion_name'] = $this->input->post('otherReligionName');
            $data['form_data']['physically_challenged'] = $this->input->post('phy_challenged');
            $data['form_data']['date_of_birth'] = $this->input->post('dob');
            $data['form_data']['gender_id_fk'] = $this->input->post('gender');
            $data['form_data']['marital_status'] = $this->input->post('marital_status');
            $data['form_data']['kanyashree_no'] = $this->input->post('kanyashree_no');
            $data['form_data']['class_id_fk'] = $this->input->post('course_name_id');
            $data['form_data']['course_id_fk'] = $this->input->post('group_id');
            $data['form_data']['phase'] = $this->input->post('batch_duration');
            $data['form_data']['last_academic_exam_id_fk'] = $this->input->post('last_exam_id');
            $data['form_data']['council_register'] = $this->input->post('haveRegisterNo') ? $this->input->post('haveRegisterNo') : $this->input->post('haveHSRegisterNo') ;
            $data['form_data']['old_reg_no'] = $this->input->post('old_reg_no') ? $this->input->post('old_reg_no') : $this->input->post('old_hs_reg_no') ;
            $data['form_data']['old_reg_year'] = $this->input->post('old_reg_year') ? $this->input->post('old_reg_year') : $this->input->post('old_hs_reg_year') ;
            $data['form_data']['ten_passing_year'] = $this->input->post('ten_passing_year');
            $data['form_data']['ten_school_state'] = $this->input->post('ten_school_state');
            $data['form_data']['total_marks'] = $this->input->post('total_marks');
            $data['form_data']['aggregate_marks'] = $this->input->post('aggregate_marks');
            $data['form_data']['percentage'] = $this->input->post('percentage_marks');
            $data['form_data']['register_hs_course'] = $this->input->post('register_hs_course');
            $data['form_data']['hs_passed'] = $this->input->post('haveSHSPassed');
            $data['form_data']['state_id_fk'] = $this->input->post('state');
            $data['form_data']['address_2'] = $this->input->post('address_2');
            $data['form_data']['address_3'] = $this->input->post('address_3');
            $data['form_data']['board_id_fk'] = $this->input->post('board_name');
        }else{

            $data['from_data']['vtc_code'] = $data['student_data']['institute_code'];
            // $data['form_data']['vtc_name'] = $data['student_data']['first_name'];
            $data['form_data']['udise_code'] = $data['student_data']['udise_code'];
            $data['form_data']['bangla_shiksha_reg_number'] = $data['student_data']['bangla_shiksha_reg_number'];
            // $data['form_data']['salutation_id_fk'] = $data['student_data']['salutation_id_fk'];
            $data['form_data']['first_name'] = $data['student_data']['first_name'];
            $data['form_data']['middle_name'] = $data['student_data']['middle_name'];
            $data['form_data']['last_name'] = $data['student_data']['last_name'];
            $data['form_data']['father_name'] = $data['student_data']['father_name'];
            $data['form_data']['mothers_name'] = $data['student_data']['mothers_name'];
            $data['form_data']['guardian_name'] = $data['student_data']['guardian_name'];
            $data['form_data']['guardian_relationship'] = $data['student_data']['guardian_relationship'];
            $data['form_data']['nationality_id_fk'] = $data['student_data']['nationality_id_fk'];
            $data['form_data']['aadhar_no'] = $data['student_data']['aadhar_no'];
            $data['form_data']['mobile'] = $data['student_data']['mobile'];
            $data['form_data']['email'] = $data['student_data']['email'];
            $data['form_data']['address'] = $data['student_data']['address'];
            $data['form_data']['district_id_fk'] = $data['student_data']['district_id_fk'];
            $data['form_data']['subdiv_id_fk'] = $data['student_data']['subdiv_id_fk'];
            $data['form_data']['municipality_id_fk'] = $data['student_data']['municipality_id_fk'];
            $data['form_data']['pin'] = $data['student_data']['pin'];
            $data['form_data']['caste'] = $data['student_data']['caste'];
            $data['form_data']['religion'] = $data['student_data']['religion'];
            $data['form_data']['other_religion_name'] = $data['student_data']['other_religion_name'];
            $data['form_data']['physically_challenged'] = $data['student_data']['physically_challenged'];
            $data['form_data']['date_of_birth'] = $data['student_data']['date_of_birth'];
            $data['form_data']['gender_id_fk'] = $data['student_data']['gender_id_fk'];
            $data['form_data']['marital_status'] = $data['student_data']['marital_status'];
            $data['form_data']['kanyashree_no'] = $data['student_data']['kanyashree_no'];
            $data['form_data']['class_id_fk'] = $data['student_data']['class_id_fk'];
            $data['form_data']['course_id_fk'] = $data['student_data']['course_id_fk'];
            $data['form_data']['phase'] = $data['student_data']['phase'];
            $data['form_data']['last_academic_exam_id_fk'] = $data['student_data']['last_academic_exam_id_fk'];
            $data['form_data']['council_register'] = $data['student_data']['council_register'];
            $data['form_data']['old_reg_no'] = $data['student_data']['old_reg_no'];
            $data['form_data']['old_reg_year'] = $data['student_data']['old_reg_year'];
            $data['form_data']['ten_passing_year'] = $data['student_data']['ten_passing_year'];
            $data['form_data']['ten_school_state'] = $data['student_data']['ten_school_state'];
            $data['form_data']['total_marks'] = $data['student_data']['total_marks'];
            $data['form_data']['aggregate_marks'] = $data['student_data']['aggregate_marks'];
            $data['form_data']['percentage'] = $data['student_data']['percentage'];
            $data['form_data']['register_hs_course'] = $data['student_data']['register_hs_course'];
            $data['form_data']['hs_passed'] = $data['student_data']['hs_passed'];
            $data['form_data']['state_id_fk'] = $data['student_data']['state_id_fk'];
            $data['form_data']['address_2'] = $data['student_data']['address_2'];
            $data['form_data']['address_3'] = $data['student_data']['address_3'];
            $data['form_data']['board_id_fk'] = $data['student_data']['board_id_fk'];
        }

        if (!empty($data['form_data']['subdiv_id_fk'])) {
            $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($data['form_data']['subdiv_id_fk']);
        }

        if(!empty($data['form_data']['district_id_fk'])){

            if ($data['form_data']['district_id_fk'] == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district_id_fk']);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($data['form_data']['district_id_fk'] == 682) || ($data['form_data']['district_id_fk'] == 683)) {

                $kolkataArray = array(
                    0 => $data['form_data']['district_id_fk'], // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($data['form_data']['district_id_fk']);
                $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($data['form_data']['district_id_fk']);
            }
        }

        if (!empty($data['form_data']['class_id_fk'])) {
            $data['group'] = $this->student_reg_model->getGroupByVTCCode($data['form_data']['class_id_fk'],$data['school_data']['vtc_code'], $data['academic_year']);
        }

        $group_id = $this->input->post('group_id');

        if(!empty($data['form_data']['course_id_fk'])){
            $data['group_details'] = $this->student_reg_model->getGroupDetails($data['form_data']['course_id_fk']);
        }else{
            $data['group_details']= array();
        }


        

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'vtcCode',
                    'label' => 'VTC Code',
                    'rules' => 'trim|required',
                    
                ),
                array('field' => 'vtcName','label' => 'VTC Name','rules' => 'trim|required',),

                array('field' => 'admissionYear','label' => 'Admission Year','rules' => 'trim|required',),

                // array('field' => 'salutation','label' => 'Salutation','rules' => 'trim|required',),

                array('field' => 'fname','label' => 'First Name','rules' => 'trim|required',),

                array('field' => 'lname','label' => 'Last Name','rules' => 'trim|required',),

                // array('field' => 'father_name','label' => 'Father Name','rules' => 'trim|required',),

                // array('field' => 'mother_name','label' => 'Mother Name','rules' => 'trim|required',),

                array('field' => 'guardian_name','label' => 'Guardian Name','rules' => 'trim|required',),

                array('field' => 'guardian_relation','label' => 'Relationship with Guardian','rules' => 'trim|required',),

                array('field' => 'aadhar_no','label' => 'Aadhar Number','rules' => 'trim|required',),

                array('field' => 'mob_no','label' => 'Mobile Number','rules' => 'trim|required',),

                array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required',),

                array('field' => 'address','label' => 'Address','rules' => 'trim|required',),

                array('field' => 'district','label' => 'District','rules' => 'trim|required',),

                // array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required',),

                // array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required',),

                array('field' => 'pinCode','label' => 'Pin Code','rules' => 'trim|required',),

                array('field' => 'caste_id','label' => 'Caste','rules' => 'trim|required',),

                array('field' => 'phy_challenged','label' => 'Physically Challenged','rules' => 'trim|required',),

                array('field' => 'dob','label' => 'Date of Birth','rules' => 'trim|required',),

                // array('field' => 'religion_id','label' => 'Religion','rules' => 'trim|required',),

                array('field' => 'gender','label' => 'Gender','rules' => 'trim|required'),

                array('field' => 'marital_status','label' => 'Marital Status','rules' => 'trim|required'),

                array('field' => 'course_name_id','label' => 'Course Name','rules' => 'trim|required'),

                array('field' => 'group_id','label' => 'Group/Trade Name','rules' => 'trim|required',),

                array('field' => 'citizenship','label' => 'Citizenship','rules' => 'trim|required'),
                array('field' => 'state','label' => 'State','rules' => 'trim|required'),

            
            );

            if($this->input->post('state') == 19){
                $config[] = array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required');

                $config[] = array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required');
            }

            if ($data['student_data']['image'] == '') {

                $this->form_validation->set_rules('std_image', 'Student Image', 'trim|callback_file_validation[std_image|image/jpeg|100|required]');

            }

            if ($data['student_data']['std_signature'] == '') {

                $this->form_validation->set_rules('std_signature', 'Student Signature', 'trim|callback_file_validation[std_signature|image/jpeg|100|required]');


            }

            if ($data['student_data']['aadhar_doc'] == '') {

                $this->form_validation->set_rules('aadhar_doc', 'D.O.B Document', 'trim|callback_file_validation[aadhar_doc|application/pdf|200|required]');
            }
           

            if(($this->input->post('caste_id') != 1) && ($data['student_data']['caste_doc'] == '')){

                $this->form_validation->set_rules('caste_doc', 'Caste Document', 'trim|callback_file_validation[caste_doc|application/pdf|200|required]');

            }

            // if ($this->input->post('religion_id') == 4){
            //     $config[] = array('field' => 'otherReligionName','label' => 'Other Religion Name','rules' => 'trim|required');
            // }

            if(($this->input->post('phy_challenged') == 1) && ($data['student_data']['phy_challenged_doc'] == '')){

                $this->form_validation->set_rules('phy_challenged_doc', 'Physically Challenged Doc', 'trim|callback_file_validation[phy_challenged_doc|application/pdf|200|required]');

            }

            if(($this->input->post('citizenship') == 2) && ($data['student_data']['citizenship_approval_doc'] == '')){

                $this->form_validation->set_rules('approval_doc', 'Approval Document', 'trim|callback_file_validation[approval_doc|application/pdf|200|required]');
                
            }else{
                
                $this->form_validation->set_rules('approval_doc', 'Approval Document', 'trim|callback_file_validation[approval_doc|application/pdf|200|]');
            }

            $course_name_id = $data['form_data']['class_id_fk'];

            if ($course_name_id == 4){

                $config[] = array('field' => 'batch_duration','label' => 'Batch Duration','rules' => 'trim|required');
                $config[] = array('field' => 'last_exam_id','label' => 'Last Exam','rules' => 'trim|required');
                $config[] = array('field' => 'haveRegisterNo','label' => 'Question','rules' => 'trim|required');

                if($this->input->post('haveRegisterNo') == 1){

                    $config[] = array('field' => 'old_reg_no','label' => 'Registration Number','rules' => 'trim|required');
                    $config[] = array('field' => 'old_reg_year','label' => 'Registration Year','rules' => 'trim|required');
                }

                if(($data['student_data']['marksheet'] == '')){

                    $this->form_validation->set_rules('marksheet', 'Mark Sheet', 'trim|callback_file_validation[marksheet|application/pdf|200|required]');
                }else{
                    
                    $this->form_validation->set_rules('marksheet', 'Mark Sheet', 'trim|callback_file_validation[marksheet|application/pdf|200|]');
                }

            }elseif ($course_name_id == 1) {



                $config[] = array('field' => 'board_name','label' => 'Board/Council','rules' => 'trim|required');
                $config[] = array('field' => 'ten_passing_year','label' => 'year of passing','rules' => 'trim|required');
                $config[] = array('field' => 'school_state','label' => 'State of location of school','rules' => 'trim|required');

                $config[] = array('field' => 'total_marks','label' => 'Total Marks','rules' => 'trim|required');

                $config[] = array('field' => 'aggregate_marks','label' => 'Aggregate Marks','rules' => 'trim|required');

                $config[] = array('field' => 'percentage_marks','label' => 'Percentage','rules' => 'trim|required');

                
                $config[] = array('field' => 'haveHSRegisterNo','label' => 'Question','rules' => 'trim|required');
                $config[] = array('field' => 'register_hs_course','label' => 'Question','rules' => 'trim|required');
                $config[] = array('field' => 'haveSHSPassed','label' => 'passed Higher Secondary','rules' => 'trim|required');

                $config[] = array('field' => 'old_hs_reg_no','label' => 'Registration Number','rules' => 'trim|required');
                $config[] = array('field' => 'old_hs_reg_year','label' => 'Registration Year','rules' => 'trim|required');

                if(($this->input->post('school_state')!= 19) && ($data['student_data']['migration_certificate'] == '')){

                    $this->form_validation->set_rules('migration_certificate', 'Migration Certificate', 'trim|callback_file_validation[migration_certificate|application/pdf|200|required]');
    
                }
    
                if(($this->input->post('register_hs_course') == 1) && ($data['student_data']['transfer_certificate'] == '')){
    
                    $this->form_validation->set_rules('transfer_certificate', 'Transfer Certificate', 'trim|callback_file_validation[transfer_certificate|application/pdf|200|required]');
    
                }

                if($data['student_data']['marksheet'] == ''){

                    $this->form_validation->set_rules('hs_marksheet', 'Mark Sheet', 'trim|callback_file_validation[hs_marksheet|application/pdf|200|required]');
                }

            }

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'vtc_student/student/student_reg_details_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {

                $tmp_date = explode('/', $this->input->post('dob'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");

                $update_data = array(

                    
                    'bangla_shiksha_reg_number' => ($this->input->post('bengShikshaRegNo') != NULL) ? $this->input->post('bengShikshaRegNo') : NULL,
                    'udise_code'                => ($this->input->post('udise_code') != NULL) ? $this->input->post('udise_code') : NULL,
                    
                    'salutation_id_fk'      => ($this->input->post('salutation') != NULL) ? $this->input->post('salutation') : NULL ,
                    'first_name'            => $this->input->post('fname'),
                    'middle_name'           => ($this->input->post('mname') != NULL) ? $this->input->post('mname') : NULL,
                    'last_name'             => $this->input->post('lname'),
                    'father_name'           => ($this->input->post('father_name') != NULL) ? $this->input->post('father_name') : '',
                    'mothers_name'           => ($this->input->post('mother_name') != NULL) ? $this->input->post('mother_name') : '' ,

                    'guardian_name'            => $this->input->post('guardian_name'),
                    'guardian_relationship' =>$this->input->post('guardian_relation'),

                    'aadhar_no'              =>$this->input->post('aadhar_no'), 
                    'mobile'                =>    $this->input->post('mob_no'),
                    'email'                =>    $this->input->post('email_id'),
                    'address'                =>    $this->input->post('address'),

                    'state_id_fk'           =>$this->input->post('state'),
                    'district_id_fk'        => $this->input->post('district'),
                    'municipality_id_fk'    => ($this->input->post('municipality') !=NULL) ? $this->input->post('municipality') : NULL ,
                    'subdiv_id_fk'    => ($this->input->post('subDivision') !=NULL) ? $this->input->post('subDivision') : NULL,

                    'pin'              => $this->input->post('pinCode'),

                    'caste'             => $this->input->post('caste_id'),

                    'religion'              => ($this->input->post('religion_id') != NULL) ? $this->input->post('religion_id') : NULL,
                    'other_religion_name'           => ($this->input->post('otherReligionName') != NULL) ? $this->input->post('otherReligionName') : '',
    
                    'physically_challenged'            =>$this->input->post('phy_challenged'),
                    'date_of_birth'                  =>$date,

                    'gender_id_fk'            =>$this->input->post('gender'),
                    'marital_status'            =>$this->input->post('marital_status'),
                    'kanyashree_no'            =>($this->input->post('kanyashree_no') !=NULL) ? $this->input->post('kanyashree_no') : NULL,

                    
                    'class_id_fk'           => $this->input->post('course_name_id'),
                    'phase'                     =>($this->input->post('batch_duration') != NULL) ? $this->input->post('batch_duration') : NULL,
                    'course_id_fk'                     =>($this->input->post('group_id') != NULL) ? $this->input->post('group_id') : NULL,
    
                    'updated_time'                => "now()",
                    'updated_ip'                  => $this->input->ip_address(),

                    
                    'nationality_id_fk'           => $this->input->post('citizenship'),
                    'address_2'                =>    $this->input->post('address_2'),
                    'address_3'                =>    $this->input->post('address_3'),
    
                );
                if (!empty($_FILES['std_image']['tmp_name'])) {

                    $update_data['image'] = base64_encode(file_get_contents($_FILES["std_image"]['tmp_name']));
                }
                if (!empty($_FILES['phy_challenged_doc']['tmp_name'])) {

                    $update_data['phy_challenged_doc'] = base64_encode(file_get_contents($_FILES["phy_challenged_doc"]['tmp_name']));
                }
                if (!empty($_FILES['caste_doc']['tmp_name'])) {

                    $update_data['caste_doc'] = base64_encode(file_get_contents($_FILES["caste_doc"]['tmp_name']));
                }
                if (!empty($_FILES['aadhar_doc']['tmp_name'])) {

                    $update_data['aadhar_doc'] = base64_encode(file_get_contents($_FILES["aadhar_doc"]['tmp_name']));
                }
                if (!empty($_FILES['std_signature']['tmp_name'])) {

                    $update_data['std_signature'] = base64_encode(file_get_contents($_FILES["std_signature"]['tmp_name']));
                }

                if($this->input->post('citizenship') != 1){
                    if(!empty($_FILES['approval_doc']['tmp_name'])){

                        $update_data['citizenship_approval_doc'] = base64_encode(file_get_contents($_FILES["approval_doc"]['tmp_name']));
                    }
                }else{
                    $approval_doc = '';
                }

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $result = $this->student_reg_model->updateStudentData($id_hash, $update_data);

                if ($result) {

                    if ($course_name_id == 4){

                        $council_register = $this->input->post('haveRegisterNo');

                    }elseif ($course_name_id == 1) {
                        
                        $council_register = $this->input->post('haveHSRegisterNo');
                       
                    }
                    

                    $academicData = array(
                        
                        'last_academic_exam_id_fk'             => ($this->input->post('last_exam_id') == '') ? NULL : $this->input->post('last_exam_id'),
                        'board_id_fk'                           => ($this->input->post('board_name') == '')? NULL : $this->input->post('board_name'),
                        
                        'total_marks'                           => ($this->input->post('total_marks') == '') ? NULL : $this->input->post('total_marks'),
                        'aggregate_marks'                       => ($this->input->post('aggregate_marks') == '') ? NULL :$this->input->post('aggregate_marks'),
                        'percentage'                            => ($this->input->post('percentage_marks') == '') ? NULL : $this->input->post('percentage_marks'),
                        
                        'council_register'                      => $council_register,
                        
                        'ten_passing_year'          =>($this->input->post('ten_passing_year') == '') ? '' : $this->input->post('ten_passing_year'),
                        'ten_school_state'          =>($this->input->post('school_state') == '') ? NULL : $this->input->post('school_state'),
                        
                        'register_hs_course'        => ($this->input->post('register_hs_course') == '') ? NULL : $this->input->post('register_hs_course'),
                        'hs_passed'        => ($this->input->post('haveSHSPassed') == '') ? NULL : $this->input->post('haveSHSPassed'),
                    );

                    if ($course_name_id == 4){

                        if (!empty($_FILES['marksheet']['tmp_name'])) {

                           
                            $academicData['marksheet'] = base64_encode(file_get_contents($_FILES["marksheet"]['tmp_name']));
                        }

                        

                    }elseif ($course_name_id == 1) {
                        
                        

                        if (!empty($_FILES['hs_marksheet']['tmp_name'])) {

                           
                            $academicData['marksheet'] = base64_encode(file_get_contents($_FILES["hs_marksheet"]['tmp_name']));
                        }
                    }

                    
                    if($council_register == 1 && $council_register != ''){

                        $academicData['old_reg_no'] = $this->input->post('old_reg_no') ? $this->input->post('old_reg_no') : $this->input->post('old_hs_reg_no') ;
                        $academicData['old_reg_year'] = $this->input->post('old_reg_year') ? $this->input->post('old_reg_year') : $this->input->post('old_hs_reg_year');
                    }else{
                        $academicData['old_reg_no'] = '';
                        $academicData['old_reg_year'] = '';
                    }

                    // Migration Certificate
                    if(($course_name_id == 1) && ($this->input->post('school_state') != 19)){

                        if (!empty($_FILES['migration_certificate']['tmp_name'])) {

                           
                            $academicData['migration_certificate'] = base64_encode(file_get_contents($_FILES["migration_certificate"]['tmp_name']));
                        }

                    }else{
                        $academicData['migration_certificate'] = '';
                    }



                    //Transfer Certificate
                    if(($course_name_id == 1) && ($this->input->post('register_hs_course') == 1)){

                        if (!empty($_FILES['transfer_certificate']['tmp_name'])) {

                            $academicData['transfer_certificate'] = base64_encode(file_get_contents($_FILES["transfer_certificate"]['tmp_name']));
                        }
                    }else{
                        $academicData['transfer_certificate'] = '';
                    }

                    // echo "<pre>";print_r($academicData);exit;

                    $result_1 = $this->student_reg_model->updateStudentAcademicData($id_hash, $academicData);

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
                        $this->session->set_flashdata('alert_msg', 'Student details has been updated successfully.');
                    }

                    redirect('admin/vtc_student/student');

                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update student at this time, Please try later.');

                    redirect('admin/vtc_student/student');
                }

            }
        }else{

            $this->load->view($this->config->item('theme').'vtc_student/student/student_reg_details_view',$data);
        }
        
    }

    public function showApproveRejectModal($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_reg_model->getStudentDetailsById($id_hash);

                // echo "<pre>";print_r($data['student_data']);

                $html_view = $this->load->view($this->config->item('theme') . 'vtc_student/student/ajax/student_approve_reject_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }
    

    public function updateStudentApproveRejectStatus(){
        

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            
            
            $status = $this->input->post('status');
            $remarks = $this->input->post('remarks');
            $std_id_hash = $this->input->post('std_id_hash');
            $data['student_data'] = $this->student_reg_model->getStudentDetailsById($std_id_hash);

            if($status == 0){
                $updArray = array(
                    'approve_reject_status'  => 0,
                    'rejection_note'     => $remarks,
                    'approve_reject_time'   => 'now()',
                );

                // echo "<pre>";print_r($data['vtc_data']);exit;

                $rejectStatus = $this->student_reg_model->updateStudentData($std_id_hash,$updArray);

                // if ($rejectStatus) {
                //     echo json_encode('done');
                // }

                // $email_subject = "VTC has been rejected";
                // $email_message = $this->load->view($this->config->item('theme') . 'affiliation/admin/email_template_reject_vtc_view', $data, TRUE);

				// send_email($data["vtc_data"]['vtc_email'],$email_message,$email_subject);
				
                // $sms_message ="Your VTC has been rejected on  ". $updArray['approve_reject_time'];
				// $template_id=0;
				// $this->sms->send($data["vtc_data"]['hoi_mobile_no'],$sms_message,$template_id);

                if ($rejectStatus) {

                    

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Student successfully rejected.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/vtc_student/student_reg'));

            }elseif ($status == 1) {

                $updArray = array(
                    'approve_reject_status'  => 1,
                    // 'vtc_approve_note'     => $remarks,
                    'approve_reject_time'   => 'now()',
                );

                // echo "<pre>";print_r($updArray);exit;

                $approveStatus = $this->student_reg_model->updateStudentData($std_id_hash,$updArray);

                

                if ($approveStatus) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'VTC successfully approved.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/vtc_student/student_reg'));
            }
        }
    }

    public function getRejectNote($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['student_data'] = $this->student_reg_model->getStudentDetailsById($id_hash);

                // echo "<pre>";print_r($data['vtcDetails']);

                $html_view = $this->load->view($this->config->item('theme') . 'vtc_student/student/ajax/student_rejected_note_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // Batch Duration

    public function getDuration($course_name_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $group_id = $this->input->get('group_id');

            if($course_name_id !='' && $group_id !=''){

                $html        = '<option value="" hidden="true">Select Batch Duration</option>';
                $group = $this->student_reg_model->getGroupDetails($group_id);

                if (!empty($group)) {

                    // if($group['duration'] == 6){

                    //     $html .= '
                    //     <option value="2">
                    //         July to December (6 Months)
                    //     </option>
                    //     ';
                    //     $month = date('m');
                    //     if($month <= '06'){

                    //         $html .= '
                    //         <option value="3">
                    //             January to June (6 Months)
                    //         </option>
                    //         ';
                    //     }
                    // }elseif ($group['duration'] == 12) {
                    //     $html .= '
                    //     <option value="1">
                    //         July to June (1 Year)
                    //     </option>
                    //     ';
                    // }

                    
                    $res = array(
                        'duration' => $group['duration']
                    );

                    
                    echo json_encode($res);
                } 
                // else {

                //     $html .= '<option value="" disabled="true">No Data found.</option>';
                //     echo json_encode($html);
                // }
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

                foreach ($district as $key => $value) {
                    $html .= '
                            <option value="' . $value['district_id_pk'] . '">
                                ' . $value['district_name'] . '
                            </option>
                        ';
                }
                echo json_encode($html);
            } else {

                $html .= '<option value="" disabled="true">No Data found.</option>';
                echo json_encode($html);
            }
        }
    }

    public function show_phy_challenged_doc($id_hash = NULL){
        
        if (!empty($id_hash)) {
            $this->showPdfDoc($id_hash , 'phy_challenged_doc');
        }
    }
    public function showCastedoc($id_hash = NULL){
        
        if (!empty($id_hash)) {
            $this->showPdfDoc($id_hash , 'caste_doc');
        }
    }
    public function show_aadhar_doc($id_hash = NULL){
        
        if (!empty($id_hash)) {
            $this->showPdfDoc($id_hash , 'aadhar_doc');
        }
    }
    public function show_marksheet($id_hash = NULL){
        
        if (!empty($id_hash)) {
            $this->showPdfDoc($id_hash , 'marksheet');
        }
    }
    public function show_migration_certificate($id_hash = NULL){
        
        if (!empty($id_hash)) {
            $this->showPdfDoc($id_hash , 'migration_certificate');
        }
    }
    public function show_transfer_certificate($id_hash = NULL){
        
        if (!empty($id_hash)) {
            $this->showPdfDoc($id_hash , 'transfer_certificate');
        }
    }

    public function showPdfDoc($id_hash = NULL , $type = NULL){
        
        if (!empty($id_hash)) {

            $student_data = $this->student_reg_model->getStudentDetailsById($id_hash);
            if (!empty($student_data)) {

                if($type == 'phy_challenged_doc'){

                    $pdf_doc = $student_data['phy_challenged_doc'];
                }elseif ($type == 'caste_doc') {

                    $pdf_doc = $student_data['caste_doc'];

                }elseif ($type == 'aadhar_doc') {
                    $pdf_doc = $student_data['aadhar_doc'];
                }
                elseif ($type == 'marksheet') {
                    $pdf_doc = $student_data['marksheet'];
                }
                elseif ($type == 'migration_certificate') {
                    $pdf_doc = $student_data['migration_certificate'];
                }
                elseif ($type == 'transfer_certificate') {

                    $pdf_doc = $student_data['transfer_certificate'];
                }


                $file_name = 'PDF-' . date('Ymd') . '-' . date('his') . '.pdf';

                // Header content type
                header("Content-type: application/pdf");

                header("Content-Disposition:inline;filename=" . $file_name);

                // header('Content-Transfer-Encoding: binary');
  
                // header('Accept-Ranges: bytes');

                echo base64_decode($pdf_doc);
            }else {
                redirect('admin/vtc_student/student_reg/student_details/'.$id_hash);
            }
        } else {
            redirect('admin/vtc_student/student_reg/student_details/'.$id_hash);
        }
    }

    public function showStudentImage($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $student_data = $this->student_reg_model->getStudentDetailsById($id_hash);
            if (!empty($student_data)) {

                header("Content-type:image/jpeg");
                header("Content-Disposition:attachment;filename=Student-Image-" . date('ymd') . "-" . date('His') . ".jpeg");
                echo base64_decode($student_data['image']);
            } else {
                redirect('admin/vtc_student/student_reg/student_details/'.$id_hash);
            }
        } else {
            redirect('admin/vtc_student/student_reg/student_details/'.$id_hash);

           
        }
    }

    public function show_std_signature($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $student_data = $this->student_reg_model->getStudentDetailsById($id_hash);
            if (!empty($student_data)) {

                header("Content-type:image/jpeg");
                header("Content-Disposition:attachment;filename=Student-signature-" . date('ymd') . "-" . date('His') . ".jpeg");
                echo base64_decode($student_data['std_signature']);
            } else {
                redirect('admin/vtc_student/student_reg/student_details/'.$id_hash);
            }
        } else {
            redirect('admin/vtc_student/student_reg/student_details/'.$id_hash);

           
        }
    }

    public function openPaymentModal()
    {
        $data['stdIdArray'] = $this->input->get('stdIdArray');
        // $data['schoolId'] = $this->input->get('schoolId');
        // echo "<pre>";print_r($array);exit;
        $html_view = $this->load->view($this->config->item('theme') . 'vtc_student/student/ajax/payment_modal_view', $data, TRUE);
        echo json_encode($html_view);
    }

   

    public function test_api(){

        $this->load->helper('banglashiksha');
        $std_code = '06604719002823';
        $student_data = gettingStudentDetailsByBanglaShikshaCode($std_code);
        echo "<pre>";print_r($student_data);exit;
        
    }
}
