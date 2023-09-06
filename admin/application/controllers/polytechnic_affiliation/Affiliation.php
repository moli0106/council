<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation extends NIC_Controller
{
	function __construct()
	{
		
		parent::__construct();
        parent::check_privilege(195);
		$this->load->model("polytechnic_affiliation/poly_affiliation_model");  
		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'state/address.js',
            2  => $this->config->item('theme_uri').'polytechnic_affiliation/affiliation.js',
            3  => $this->config->item('theme_uri').'polytechnic_affiliation/doc_upload.js' 
        );
        
    }

    public function index(){ 
        
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
       
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        //echo "<pre>";print_r($data['ins_details']);die;
        $data['affiliation_year'] = '2023-24';
        
        $data['affiliation_type'] = $this->poly_affiliation_model->getAffiliationType();
        $data['affiliation_data'] = $this->poly_affiliation_model->getAffiliationList($data['ins_details_id']);
        
        if($this->input->server("REQUEST_METHOD") == 'POST'){
           
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
				array(
                    'field' => 'new_renewal',
                    'label' => 'Affiliation New or Renewal',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'affiliation_year',
                    'label' => 'Academic Session',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'affiliation_type',
                    'label' => 'Affiliation Type',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_home', $data);
            } else {

                $check_affiliation_type = $this->poly_affiliation_model->checkAffiliation($this->input->post('affiliation_type'),$data['affiliation_year'],$data['ins_details_id']);
                if(empty($check_affiliation_type)){

                    
                    $data_array = array(
                        'affiliation_year' => $data['affiliation_year'],
                        'affiliation_type_id_fk'  => $this->input->post('affiliation_type'),
                        'affiliation_submit_status' => 1,
                        'affiliation_submited_date' => 'now()',
                        'institute_details_id_fk' => $data['ins_details']['institute_details_id_pk'],
                        'vtc_id_fk' =>  $data['ins_details']['vtc_id_fk'],
                        'institute_code' =>$data['ins_details']['institute_code'],
                        'institute_name' => $data['ins_details']['institute_name'],
						'new_or_renewal' => $this->input->post('new_renewal')
                    );

                    echo "<pre>";print_r($data_array);die;

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction
                
                    $affiliation_id = $this->poly_affiliation_model->insert_data('council_polytechnic_institute_basic_affiliation_details',$data_array);
                    if($affiliation_id){
                        $code = $this->poly_affiliation_model->getAffiliationTypeByID($this->input->post('affiliation_type'));
                        $application_number = $code['affiliation_code'] .'/'.$data['affiliation_year'] .'/'.$affiliation_id;
                        //update
                        $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$affiliation_id,array('application_number' =>$application_number));
                        
                        // ! Check All Query For Trainee
                        if ($this->db->trans_status() === FALSE) {
                            # Something went wrong.
                            $this->db->trans_rollback();

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to submit at this time, Please try again later.');
                            $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_home', $data);
                        } else {
                            # Everything is Perfect. Committing data to the database.
                            $this->db->trans_commit();

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Successfully submitted');
                            redirect('/admin/polytechnic_affiliation/affiliation/basic_details/'.md5($affiliation_id));
                        }
                        
                    
                    }else{
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to submit at this time, please try again later.');
                        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_home', $data);
                    }
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Affiliation Type already exist');
                    $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_home', $data);
                }

            }

        }else{

            $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_home', $data);
        }
	}

	public function basic_details($id_hash){

        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        $data['id_hash'] = $id_hash;
		$data['stateList']  = $this->poly_affiliation_model->getAllState();
        $data['affiliation_year'] = '2023-24';
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
		//echo "<pre>";print_r($data['affiliation_data']);exit;
        $affiliation_id = $data['affiliation_data']['basic_affiliation_id_pk'];

        // $check_techer = $this->poly_affiliation_model->getTeacherCountByBasicId($data['affiliation_data']['basic_affiliation_id_pk']);
        // $check_intake = $this->poly_affiliation_model->getIntakeCountByBasicId($data['affiliation_data']['basic_affiliation_id_pk']);
        // $checkBasicDetails = $this->poly_affiliation_model->checkBasicDetails($data['affiliation_data']['basic_affiliation_id_pk']);
       
        if($data['affiliation_data']['intake_submited_status'] ==1){
            $data['active_class1'] = 'intakeStaff';
        }else{
            $data['active_class1'] = '';
        }
        if($data['affiliation_data']['basic_details_submited_status'] == 1){
            $data['active_class'] = 'basicDetails';
        }else{
            $data['active_class'] = '';
        }
        if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
            $data['active_class2'] = 'infra_fees';
        }else{
            $data['active_class2'] = '';
        }
        if($data['affiliation_data']['doc_uploaded_status'] == 1){
            $data['active_class3'] = 'doc_upload';
        }else{
            $data['active_class3'] = '';
        }

        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $formData['mobile_1'] = $this->input->post('mobile_1');
            $formData['mobile_2'] = $this->input->post('mobile_2');
            $formData['fax'] = $this->input->post('fax');
            $formData['web_url'] = $this->input->post('web_url');
            $formData['ins_type'] = $this->input->post('ins_type');
            $formData['address'] = $this->input->post('address');
            $formData['state_id_fk'] = $this->input->post('state');

            $formData['district_id_fk'] = $this->input->post('district');
            $formData['sub_division_id_fk'] = $this->input->post('subDivision');
            $formData['pin_code'] = $this->input->post('pin_code');
            $formData['rail_station'] = $this->input->post('rail_station');
            $formData['station_distance'] = $this->input->post('station_distance');
            $formData['police_station'] = $this->input->post('police_station');
            $formData['station_distance'] = $this->input->post('station_distance');
            $formData['ps_phone'] = $this->input->post('ps_phone');
            $formData['principal_name'] = $this->input->post('principal_name');
            $formData['principal_mobile'] = $this->input->post('principal_mobile');
			
			$formData['principal_age'] = $this->input->post('principal_age');
            $formData['qualification'] = $this->input->post('qualification');
            $formData['year_of_exp'] = $this->input->post('year_of_exp');
            $formData['join_date'] = $this->input->post('join_date');
        }else{
            $formData['mobile_1'] = $data['affiliation_data']['mobile_no_1'];
            $formData['mobile_2'] = $data['affiliation_data']['mobile_no_2'];
            $formData['fax'] = $data['affiliation_data']['fax_no'];
            $formData['web_url'] = $data['affiliation_data']['web_url'];
            $formData['ins_type'] = $data['affiliation_data']['institute_category_id_fk'];
            $formData['address'] = $data['affiliation_data']['address'];
            $formData['state_id_fk'] = $data['affiliation_data']['state_id_fk'];

            $formData['district_id_fk'] = $data['affiliation_data']['district_id_fk'];
            $formData['sub_division_id_fk'] = $data['affiliation_data']['sub_divission_id_fk'];
            $formData['pin_code'] = $data['affiliation_data']['pin_code'];
            $formData['rail_station'] = $data['affiliation_data']['near_rail_station'];
            $formData['station_distance'] = $data['affiliation_data']['distance_rail_station'];
            $formData['police_station'] = $data['affiliation_data']['police_station'];
            $formData['ps_phone'] = $data['affiliation_data']['ps_phone_no'];
            $formData['principal_name'] = $data['affiliation_data']['principal_name'];
            $formData['principal_mobile'] = $data['affiliation_data']['principal_mobile_no'];
			
			$formData['principal_age'] = $data['affiliation_data']['principal_age'];
            $formData['qualification'] = $data['affiliation_data']['principal_qualification'];
            $formData['year_of_exp'] = $data['affiliation_data']['year_of_exp'];
            $formData['join_date'] = $data['affiliation_data']['principal_join_date'];
        }

        if ($formData['state_id_fk']!='') {
            $data['district'] = $this->poly_affiliation_model->getDistrictByStateId($formData['state_id_fk']);
        }
		
		if ($formData['district_id_fk']!='') {
            if ($formData['district_id_fk'] == 16) {

                $kolkataArray = array(
                    0 => 682, // KOLKATA NORTH 
                    1 => 683, // KOLKATA SOUTH
                    2 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->poly_affiliation_model->getSubDivisionByDistrictId($formData['district_id_fk']);
            } elseif (($formData['district_id_fk'] == 682) || ($formData['district_id_fk'] == 683)) {

                $kolkataArray = array(
                    0 => $formData['district_id_fk'], // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $data['subDivision']  = $this->poly_affiliation_model->getSubDivisionByDistrictId(16);
            } else {

                $data['subDivision']  = $this->poly_affiliation_model->getSubDivisionByDistrictId($formData['district_id_fk']);
            }
        }

        if($this->input->server("REQUEST_METHOD") == 'POST'){

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'mobile_1',
                    'label' => 'Primary Contact Number ',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'ins_type',
                    'label' => 'Institute Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'state',
                    'label' => 'state',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'district',
                    'label' => 'District',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'subDivision',
                    'label' => 'Sub Division',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'pin_code',
                    'label' => 'PIN Code',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'rail_station',
                    'label' => 'Railway Station',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'station_distance',
                    'label' => 'Distance of Nearest Railway Station',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'police_station',
                    'label' => 'Police Station',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'ps_phone',
                    'label' => 'Phone Number of Police Station',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'principal_name',
                    'label' => 'Principal Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'principal_mobile',
                    'label' => 'Principal Mobile',
                    'rules' => 'trim|required'
                ),
				
				array(
                    'field' => 'principal_age',
                    'label' => 'Principal Age',
                    'rules' => 'trim|required'
                ),

                array(
                    'field' => 'qualification',
                    'label' => 'Principal Qualification',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'year_of_exp',
                    'label' => 'Year of experience',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'join_date',
                    'label' => 'Date of Joining',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{
                $tmp_date = explode('-', $this->input->post('join_date'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
                $date = date_format($date, "Y-m-d");

                $upd_data = array(
                    'mobile_no_1' => $this->input->post('mobile_1'),
                    'mobile_no_2'=> ($this->input->post('mobile_2') == '') ? NULL : $this->input->post('mobile_2'),
                    'fax_no'=> ($this->input->post('fax') == '') ? NULL : $this->input->post('fax'),
                    'web_url'=> ($this->input->post('web_url') == '') ? NULL : $this->input->post('web_url') ,
                    'institute_category_id_fk' => $this->input->post('ins_type'),
                    'address' => $this->input->post('address'),
                    'state_id_fk'=> $this->input->post('state') ,
                    'district_id_fk'=> $this->input->post('district'),
                    'sub_divission_id_fk'=> $this->input->post('subDivision'),
                    'pin_code' => $this->input->post('pin_code'),
                    'near_rail_station' => $this->input->post('rail_station'),
                    'distance_rail_station' => $this->input->post('station_distance'),
                    'police_station'   => $this->input->post('police_station'),
                    'ps_phone_no'  => $this->input->post('ps_phone'),
                    'principal_name' => $this->input->post('principal_name'),
                    'principal_mobile_no'   => $this->input->post('principal_mobile'),
                    'basic_details_submited_status' => 1,
					
					'principal_age'         => $this->input->post('principal_age'),
                    'principal_qualification'         => $this->input->post('qualification'),
                    'year_of_exp'         => $this->input->post('year_of_exp'),
                    'principal_join_date'         => $date
                );

                $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$affiliation_id,$upd_data);

                if($status){
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Basic Details Successfully Submitted');
                    redirect('/admin/polytechnic_affiliation/affiliation/intake_details/'.md5($affiliation_id));
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Unable to upadate at this time ,please try again later');
                    //redirect('/admin/polytechnic_affiliation/affiliation/basic_details/'.md5($affiliation_id));
                }

            }

        }
        $data['formData'] = $formData;
		$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
	}

    public function intake_details($id_hash){
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        $data['affiliation_year'] = '2023-24';
        //$data['branch'] = $this->poly_affiliation_model->getBranchNameByAffiliationId($data['affiliation_data']['affiliation_type_id_fk'],$data['affiliation_year']);
		$data['branch'] = $this->poly_affiliation_model->getBranchName($data['affiliation_data']['affiliation_type_id_fk']);
        $data['teacher_branch'] = $this->poly_affiliation_model->getBranchName($data['affiliation_data']['affiliation_type_id_fk']);

        $check_techer = $this->poly_affiliation_model->getTeacherCountByBasicId($data['affiliation_data']['basic_affiliation_id_pk']);
        $check_intake = $this->poly_affiliation_model->getIntakeCountByBasicId($data['affiliation_data']['basic_affiliation_id_pk']);
        // $checkBasicDetails = $this->poly_affiliation_model->checkBasicDetails($data['affiliation_data']['basic_affiliation_id_pk']);
        $data['teacher_data'] = $this->poly_affiliation_model->getTeachersById($id_hash);
        $data['intake_data'] = $this->poly_affiliation_model->getIntakeById($id_hash);
        //echo "<pre>";print_r($data['intake_data']);die;
		//echo "<pre>";print_r($data['affiliation_data']);die;
        if($data['affiliation_data']['intake_submited_status'] ==1){
            $data['active_class1'] = 'intakeStaff';
        }else{
            $data['active_class1'] = '';
        }
        if($data['affiliation_data']['basic_details_submited_status'] == 1){
            $data['active_class'] = 'basicDetails';
        }else{
            $data['active_class'] = '';
        }
        if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
            $data['active_class2'] = 'infra_fees';
        }else{
            $data['active_class2'] = '';
        }
        if($data['affiliation_data']['doc_uploaded_status'] == 1){
            $data['active_class3'] = 'doc_upload';
        }else{
            $data['active_class3'] = '';
        }
        //echo "<pre>";print_r($data);die;
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $basic_id =$this->input->post('basic_id');
            
            if($check_techer['count'] == 0 || $check_intake['count'] == 0){
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Please add Intake and Staff Data.'); 
            }else{
                $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$basic_id,array('intake_submited_status' =>1));
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Successfully Submited.'); 
                redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.md5($basic_id));
            }
        }

        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_intake', $data);
    }

    public function add_academic_details(){
        //echo "hii1111111";die;

        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $id_hash = md5($this->input->post('basic_id'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'branch',
                    'label' => 'Branch',
                    'rules' => 'trim|required'
                ),
                  // array(
                //     'field' => 'shift',
                //     'label' => 'Shift',
                //     'rules' => 'trim|required'
                // ),
                array(
                    'field' => 'intake_no',
                    'label' => 'Approved Intake',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'remarks',
                    'label' => 'Remarks',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{

                $data_array = array(
                    'affiliation_year' => $data['affiliation_year'],
                    'affiliation_type_id_fk'  => $this->input->post('affiliation_type_id'),
                    'basic_affiliation_id_fk'  => $this->input->post('basic_id'),
                    'institute_details_id_fk' => $data['ins_details']['institute_details_id_pk'],
                    'vtc_id_fk' =>  $this->input->post('ins_id'),
                    //'shift' =>  $this->input->post('shift'),
                    'intake_no' =>  $this->input->post('intake_no'),
                    'faculty' =>  $this->input->post('faculty'),
                    'remarks' =>  $this->input->post('remarks'),
                    'entry_time'=> 'now()',
                    'entry_ip' => $this->input->ip_address(),
                    'discipline_id_fk' =>$this->input->post('branch'),
					'active_status'     =>1
                );
                
               
                $status = $this->poly_affiliation_model->insert_data('council_polytechnic_institute_intake_details',$data_array);

               
                if ($status) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Successfully submitted');
                    
                    
                } else {
                    
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to submit at this time, Please try again later.');
                }
                

            }
            redirect('/admin/polytechnic_affiliation/affiliation/intake_details/'.$id_hash);
        }
        
    }
    public function add_teacher_details(){
        //echo "hii";die;
        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            //echo "<pre>";print_r($_POST);die;
            $id_hash = md5($this->input->post('basic_id'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'branch',
                    'label' => 'Branch',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'teacher_name',
                    'label' => 'Teacher Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'qualification',
                    'label' => 'Highest Qualification',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'engagement_type',
                    'label' => 'Faculty Type',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'year_exp',
                    'label' => 'Years of Experience',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'join_date',
                    'label' => 'Date of Joining',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'salary',
                    'label' => 'Monthly Salary',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'teacher_name',
                    'label' => 'Teacher Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'teacher_mobile',
                    'label' => 'Mobile No',
                    'rules' => 'trim|required|exact_length[10]'
                )
            );

            if($this->input->post('engagement_type') == 'Other'){
                $config[] = array(
                    'field' => 'other_faculty',
                    'label' => 'Other Faculty Type',
                    'rules' => 'trim|required'
                );
            }
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{

                $tmp_date = explode('-', $this->input->post('join_date'));
                $date = date_create($tmp_date[2] . '-' . $tmp_date[1] . '-' . $tmp_date[0]);
				$date = date_format($date, "Y-m-d");

                $data_array = array(
                    'affiliation_year' => $data['affiliation_year'],
                    'affiliation_type_id_fk'  => $this->input->post('affiliation_type_id'),
                    'basic_affiliation_id_fk'  => $this->input->post('basic_id'),
                    'institute_details_id_fk' => $data['ins_details']['institute_details_id_pk'],
                    'vtc_id_fk' =>  $this->input->post('ins_id'),
                    'teacher_name' =>  $this->input->post('teacher_name'),
                    'teacher_mobile' =>  $this->input->post('teacher_mobile'),

                    'qualification' => $this->input->post('qualification'),
                    'engagement_type' => $this->input->post('engagement_type'),
                    'year_exp' => $this->input->post('year_exp'),
                    'join_date' => $date,
                    'salary' => $this->input->post('salary'),
                    'discipline_id_fk' => $this->input->post('branch'),

                    'entry_time'=> 'now()',
                    'entry_ip' => $this->input->ip_address(),
					'active_status'     =>1,
                    'other_faculty' => ($this->input->post('other_faculty') == '') ? '' : $this->input->post('other_faculty')
                );
				//echo "<pre>";print_r($data_array);die;
               
                $status = $this->poly_affiliation_model->insert_data('council_polytechnic_institute_teacher_details',$data_array);

               
                if ($status) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Successfully submitted');
                    
                    
                } else {
                    
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to submit at this time, Please try again later.');
                }
                

            }
            redirect('/admin/polytechnic_affiliation/affiliation/intake_details/'.$id_hash);
        }
        
    }


  


	public function getDistrict($state_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $html        = '<option value="" hidden="true">Select District</option>';
            $district = $this->poly_affiliation_model->getDistrictByStateId($state_id);

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

             $nodalOfficer     = $this->poly_affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($district_id == 682) || ($district_id == 683)) {

                $kolkataArray = array(
                    0 => $district_id, // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $district_id  = 16;

                $nodalOfficer = $this->poly_affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $nodalOfficer = $this->poly_affiliation_model->getNodalOfficerByDistrictId($district_id);
            }

            $subDivisionHtml = '<option value="" hidden="true">Select Sub Division</option>';
            $subDivision     = $this->poly_affiliation_model->getSubDivisionByDistrictId($district_id);

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

    public function affiliation_preview($id_hash){

        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        $data['id_hash'] = $id_hash;
		//$data['stateList']  = $this->poly_affiliation_model->getAllState();
        $data['affiliation_year'] = '2023-24';
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
		
		 if($data['affiliation_data']['intake_submited_status'] ==1){
            $data['active_class1'] = 'intakeStaff';
        }else{
            $data['active_class1'] = '';
        }
        if($data['affiliation_data']['basic_details_submited_status'] == 1){
            $data['active_class'] = 'basicDetails';
        }else{
            $data['active_class'] = '';
        }
        if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
            $data['active_class2'] = 'infra_fees';
        }else{
            $data['active_class2'] = '';
        }
        if($data['affiliation_data']['doc_uploaded_status'] == 1){
            $data['active_class3'] = 'doc_upload';
        }else{
            $data['active_class3'] = '';
        }
		
        $data['teacher_data'] = $this->poly_affiliation_model->getTeachersById($id_hash);
        $data['intake_data'] = $this->poly_affiliation_model->getIntakeById($id_hash);
        //echo "<pre>";print_r(($data['intake_data']));exit;
        $data['fetch_room'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_class_room_intake as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

        $data['fetch_lab'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_lab_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

        $data['fetch_library'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_library_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);
        $data['mandory_data'] = $this->poly_affiliation_model->mandory_master();

        $data['fetch_mandory_data'] = $this->poly_affiliation_model->fetch_mandory_data($data['affiliation_data']['basic_affiliation_id_pk']);

        $data['fetch_fees_data'] = $this->poly_affiliation_model->fetch_poly_fees_data($data['affiliation_data']['basic_affiliation_id_pk'],$data['affiliation_data']['affiliation_type_id_fk']);
        
		$data['payment_status'] = $this->poly_affiliation_model->getPaymentStatus($id_hash);
        // Payment 
        if($data['affiliation_data']['institute_category_id_fk'] == 4){
            $affiliation_fees = 30000;
            if(count($data['intake_data']) > 4){
                 $increse_course_no =  count($data['intake_data']) - 4;
                $increse_course_amnt = 7500 * $increse_course_no;
            }else{
                $increse_course_amnt = 0;
            }
            //echo $increse_course_amnt;die;
            $i = 0;
			$blank_array=array();
            foreach ($data['intake_data'] as $key => $value) {
                if($value['intake_no'] > 60){
					$increase_value = $value['intake_no'] - 60;
					array_push($blank_array,$value['remarks']);
                    
                    $increase_intake_no = floor($increase_value / 60);
                    $i = $i+$increase_intake_no;

                    //echo "<br>";
                }
            }
			//echo "<pre>";print_r($blank_array);die;
            //echo $i;die;
            if($i == 0){
                $increase_intake_amount = 0;
            }else{
                $increase_intake_amount = 7500 * $i;
				$description = implode(' / ', $blank_array);
            }



            $data['payment'] = array(
                'application_fees' => 1000,
                'inspection_fees'  => 10000,
                'affiliation_fees' => $affiliation_fees,
                'increse_course_amnt' => $increse_course_amnt,
                'increase_intake_amount' => $increase_intake_amount,
                'new_or_renewal'        => ($data['affiliation_data']['new_or_renewal'] == 2)? 'Renewal of' : '',
                'total_fees'            =>  1000 + 10000 + $affiliation_fees + $increse_course_amnt + $increase_intake_amount ,
				'description'           => $description
    
            );
            //echo "<pre>";print_r($data['payment']);exit;
        }else{
            $data['payment'] = array();
        }

        // echo "<pre>";print_r($data);exit;
        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_form_preview', $data);
    }
	
	public function final_submit(){
        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $affiliation_id = $this->input->post('basic_id');
            $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$affiliation_id,array('final_submit_status' => 1));
            if($status){
                $this->session->set_flashdata('status', 'success');
                $this->session->set_flashdata('alert_msg', 'Successfully Submited');
                redirect('admin/polytechnic_affiliation/affiliation');
            }else{
                $this->session->set_flashdata('status', 'danger'); 
                $this->session->set_flashdata('alert_msg', 'Unable to upadate at this time ,please try again later');
                redirect('/admin/polytechnic_affiliation/affiliation/affiliation_preview/'.md5($affiliation_id));
            } 
        }
    }
	
	public function submit_information($id_hash=NULL){
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        if($data['affiliation_data']){
            $affiliation_id = $data['affiliation_data']['basic_affiliation_id_pk'];
            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $arr=[
                    'additional_info'=>$this->input->post('additional_info')
                    
                ]; 

                //print_r($arr);exit;
                $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$affiliation_id,$arr);
                
                if($status){
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Successfully submitted');
                    redirect('admin/polytechnic_affiliation/affiliation/affiliation_preview/'.$id_hash);
                }else{
                    $this->session->set_flashdata('status', 'danger'); 
                    $this->session->set_flashdata('alert_msg', 'Unable to upadate at this time ,please try again later');
                    redirect('/admin/polytechnic_affiliation/affiliation/documents_upload/'.md5($affiliation_id));
                }  

            }
        }else{
            redirect('admin/polytechnic_affiliation/affiliation');  
        }
    }

    // added By Amit on 10-07-2023


    public function infrastructure_fees($id_hash){
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        if($data['affiliation_data']){

            if($data['affiliation_data']['intake_submited_status'] ==1){
                $data['active_class1'] = 'intakeStaff';
            }else{
                $data['active_class1'] = '';
            }
            if($data['affiliation_data']['basic_details_submited_status'] == 1){
                $data['active_class'] = 'basicDetails';
            }else{
                $data['active_class'] = '';
            }
            if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
                $data['active_class2'] = 'infra_fees';
            }else{
                $data['active_class2'] = '';
            }
            if($data['affiliation_data']['doc_uploaded_status'] == 1){
                $data['active_class3'] = 'doc_upload';
            }else{
                $data['active_class3'] = '';
            }

            $data['department'] = $this->poly_affiliation_model->getBranchName($data['affiliation_data']['affiliation_type_id_fk']);
            // echo "<pre>";print_r($data['department']);die;
            $data['fetch_room'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_class_room_intake as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

            $data['fetch_lab'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_lab_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

            $data['fetch_library'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_library_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

            $data['mandory_data'] = $this->poly_affiliation_model->mandory_master();

            $data['fetch_mandory_data'] = $this->poly_affiliation_model->fetch_mandory_data($data['affiliation_data']['basic_affiliation_id_pk']);
			$data['fetch_fees_data'] = $this->poly_affiliation_model->fetch_poly_fees_data($data['affiliation_data']['basic_affiliation_id_pk'],$data['affiliation_data']['affiliation_type_id_fk']);

            $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_fees', $data);
        }else{
            redirect('admin/polytechnic_affiliation/affiliation');
        }
    }

    public function documents_upload_old($id_hash=NULL){
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        if($data['affiliation_data']){

            if($data['affiliation_data']['intake_submited_status'] ==1){
                $data['active_class1'] = 'intakeStaff';
            }else{
                $data['active_class1'] = '';
            }
            if($data['affiliation_data']['basic_details_submited_status'] == 1){
                $data['active_class'] = 'basicDetails';
            }else{
                $data['active_class'] = '';
            }
            if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
                $data['active_class2'] = 'infra_fees';
            }else{
                $data['active_class2'] = '';
            }
            if($data['affiliation_data']['doc_uploaded_status'] == 1){
                $data['active_class3'] = 'doc_upload';
            }else{
                $data['active_class3'] = '';
            }
            $affiliation_id = $data['affiliation_data']['basic_affiliation_id_pk'];

            if ($this->input->server("REQUEST_METHOD") == "POST") {
                $this->load->library('form_validation');
                $this->form_validation->set_error_delimiters('<div class="text-white">', '</div>');
                $this->form_validation->set_rules('file1', 'AICTE Approval Letter', 'trim|callback_file_validation[file1|application/pdf|1024|required]');
                $this->form_validation->set_rules('file2', 'Affiliation Letter', 'trim|callback_file_validation[file2|application/pdf|512|required]');
                if ($this->form_validation->run() != FALSE) {
                    $arr=[
                        'aicte_approval_file'=>base64_encode(file_get_contents($_FILES["file1"]['tmp_name'])),
                        'wbsct_affiliation_file'=>base64_encode(file_get_contents($_FILES["file2"]['tmp_name'])),
                        'doc_uploaded_status' => 1
                        ]; 
                    $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$affiliation_id,$arr);

                    

                    if($status){
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Documents Successfully Uploaded');
                        redirect('admin/polytechnic_affiliation/affiliation/documents_upload/'.$id_hash);
                    }else{
                        $this->session->set_flashdata('status', 'danger'); 
                        $this->session->set_flashdata('alert_msg', 'Unable to upadate at this time ,please try again later');
                        //redirect('/admin/polytechnic_affiliation/affiliation/basic_details/'.md5($affiliation_id));
                    }  

                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', validation_errors());
                    redirect('admin/polytechnic_affiliation/affiliation/documents_upload/'.$id_hash);
                }
            }
        }else{
        redirect('admin/polytechnic_affiliation/affiliation');  
        }

       $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_doc_upload', $data); 
    }

    public function documents_upload($id_hash=NULL){
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        if($data['affiliation_data']){
        $affiliation_id = $data['affiliation_data']['basic_affiliation_id_pk'];
		
		if($data['affiliation_data']['intake_submited_status'] ==1){
			$data['active_class1'] = 'intakeStaff';
		}else{
			$data['active_class1'] = '';
		}
		if($data['affiliation_data']['basic_details_submited_status'] == 1){
			$data['active_class'] = 'basicDetails';
		}else{
			$data['active_class'] = '';
		}
		if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
			$data['active_class2'] = 'infra_fees';
		}else{
			$data['active_class2'] = '';
		}
		if($data['affiliation_data']['doc_uploaded_status'] == 1){
			$data['active_class3'] = 'doc_upload';
		}else{
			$data['active_class3'] = '';
		}
		//echo "<pre>";print_r($data);die;
        if ($this->input->server("REQUEST_METHOD") == "POST") {
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-white">', '</div>');
            $this->form_validation->set_rules('file1', 'AICTE Approval Letter', 'trim|callback_file_validation['.$this->input->post('file1').'|file1|1024]');
            

            //Added by Moli on 26-07-2023
			if($data['affiliation_data']['institute_category_id_fk'] == 4){
                $this->form_validation->set_rules('file2', 'Affiliation Letter', 'trim|callback_file_validation['.$this->input->post('file2').'|file2|512]');
                $this->form_validation->set_rules('file3', 'Land Document', 'trim|callback_file_validation['.$this->input->post('file3').'|file3|200]');
                $this->form_validation->set_rules('campus_area' , 'Area of Campus', 'trim|required');
            }

            if ($this->form_validation->run() != FALSE) {
                $decode_aicte_data=hex2bin($this->input->post('file1'));
                $aicte_file=str_replace("data:application/pdf;base64,","",$decode_aicte_data); //For Technical Education (AICTE)

                if($this->input->post('file2') !=''){
                    $decode_affiliation_data=hex2bin($this->input->post('file2'));
                    $affiliation_file=str_replace("data:application/pdf;base64,","",$decode_affiliation_data); //For Affiliation Letter
                }else{
                    $affiliation_file= NULL; 
                }

                //Added by on 26-07-2023
				if($this->input->post('file3') !=''){

                    $decode_land_doc_data=hex2bin($this->input->post('file3'));
                    $land_file=str_replace("data:application/pdf;base64,","",$decode_land_doc_data); //For Affiliation Letter 
                }else{
                    $land_file= NULL; 
                }
                $arr=[
                    'aicte_approval_file'=>$aicte_file,
                    'wbsct_affiliation_file'=>$affiliation_file,
                    'doc_uploaded_status' => 1,

                    'land_doc_file' => $land_file,
                    'campus_area' => ($this->input->post('campus_area') == '') ? NULL : $this->input->post('campus_area')
                    ]; 

                    //print_r($arr);exit;
                $status = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$affiliation_id,$arr);

                 

                if($status){
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Documents Successfully Uploaded');
                    redirect('admin/polytechnic_affiliation/affiliation/documents_upload/'.$id_hash);
                }else{
                    $this->session->set_flashdata('status', 'danger'); 
                    $this->session->set_flashdata('alert_msg', 'Unable to upadate at this time ,please try again later');
                    //redirect('/admin/polytechnic_affiliation/affiliation/basic_details/'.md5($affiliation_id));
                }  

            }else{
                 $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', validation_errors());
                redirect('admin/polytechnic_affiliation/affiliation/documents_upload/'.$id_hash);
            }
        }
        }else{
            redirect('admin/polytechnic_affiliation/affiliation');  
        }

        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_doc_upload', $data); 
    }


    public function add_fees_structure(){
                
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById(md5($this->input->post('basic_id')));
         $af_type=$data['affiliation_data']['affiliation_type_id_fk'];
         $id_hash = md5($this->input->post('basic_id'));
        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $this->load->library('form_validation'); 
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            if($af_type==1){
               $config = array(
                array(
                    'field' => 'semester[]',
                    'label' => 'Mandatory Requirements',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'dip_s1[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'dip_s2[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dip_s2[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dip_s3[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dip_s4[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dip_s5[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dip_s6[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                )
            ); 
            }elseif($af_type==2){
                $config = array(
                array(
                    'field' => 'semester[]',
                    'label' => 'Mandatory Requirements',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => '1_year[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => '2_year[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                )
            );
            }elseif($af_type==3){
                 $config = array(
                array(
                    'field' => 'semester[]',
                    'label' => 'Mandatory Requirements',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'dvoc_s1[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'dvoc_s2[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dvoc_s2[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dvoc_s3[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dvoc_s4[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dvoc_s5[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),array(
                    'field' => 'dvoc_s6[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                )
            ); 
            }elseif($af_type==4){
              $config = array(
                array(
                    'field' => 'semester[]',
                    'label' => 'Mandatory Requirements',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'part_1[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'part_2[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                )
            );  
            }elseif($af_type==5){
                $config = array(
                array(
                    'field' => 'semester[]',
                    'label' => 'Mandatory Requirements',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'm_sem[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'j_sem[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'v_sem[]',
                    'label' => 'Fees',
                    'rules' => 'trim|required|integer'
                )
            );  
            }
            
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status_v4', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{
                $data_array=[];
                $j=0;
                
                if($this->input->post("semester")!=''){
                foreach($this->input->post('semester') as $k => $v){
                    $data_array[$j]['affiliation_type_id_fk']  = $data['affiliation_data']['affiliation_type_id_fk'];
                    $data_array[$j]['basic_affiliation_id_fk']  = $this->input->post('basic_id');
                    $data_array[$j]['institute_details_id_fk'] = $data['affiliation_data']['institute_details_id_fk'];
                    $data_array[$j]['vtc_id_fk'] =  $data['affiliation_data']['vtc_id_fk'];
                    $data_array[$j]['semester'] =  $this->input->post('semester')[$k];
                    if($af_type==1){
                    $data_array[$j]['dip_s1'] =  $this->input->post('dip_s1')[$k];
                    $data_array[$j]['dip_s2'] =  $this->input->post('dip_s2')[$k];
                    $data_array[$j]['dip_s3'] =  $this->input->post('dip_s3')[$k];
                    $data_array[$j]['dip_s4'] =  $this->input->post('dip_s4')[$k];
                    $data_array[$j]['dip_s5'] =  $this->input->post('dip_s5')[$k];
                    $data_array[$j]['dip_s6'] =  $this->input->post('dip_s6')[$k];   
                    }elseif($af_type==2){
                    $data_array[$j]['first_year'] =  $this->input->post('1_year')[$k];
                    $data_array[$j]['second_year'] =  $this->input->post('2_year')[$k];
                    }elseif($af_type==3){
                    $data_array[$j]['dvoc_s1'] =  $this->input->post('dvoc_s1')[$k];
                    $data_array[$j]['dvoc_s2'] =  $this->input->post('dvoc_s2')[$k];
                    $data_array[$j]['dvoc_s3'] =  $this->input->post('dvoc_s3')[$k];
                    $data_array[$j]['dvoc_s4'] =  $this->input->post('dvoc_s4')[$k];
                    $data_array[$j]['dvoc_s5'] =  $this->input->post('dvoc_s5')[$k];
                    $data_array[$j]['dvoc_s6'] =  $this->input->post('dvoc_s6')[$k];
                    }elseif($af_type==4){
                    $data_array[$j]['part_1'] =  $this->input->post('part_1')[$k];
                    $data_array[$j]['part_2'] =  $this->input->post('part_2')[$k];   
                    }elseif($af_type==5){
                    $data_array[$j]['m_sem'] = $this->input->post('m_sem')[$k];
                    $data_array[$j]['j_sem'] =  $this->input->post('j_sem')[$k];
                    $data_array[$j]['v_sem'] =  $this->input->post('v_sem')[$k];
                    }
                    $data_array[$j]['created_at'] = 'now()';
                    $j++;
                    
                }
            }
			//echo "<pre>";print_r($data_array);die;


                $check_data=$this->poly_affiliation_model->fetch_data('council_polytechnic_affiliation_fees_structure',
                    ['affiliation_type_id_fk'=>$data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'=>$this->input->post('basic_id'),
                    'institute_details_id_fk'=>$data['ins_details']['institute_details_id_pk']
                    ]);

                 if($check_data == true){
                    $delete=$this->poly_affiliation_model->delete_details('council_polytechnic_affiliation_fees_structure',['basic_affiliation_id_fk'=>$this->input->post('basic_id')]);

                    $status = $this->poly_affiliation_model->insert_data_batch('council_polytechnic_affiliation_fees_structure',$data_array);
                 }else{
                    $status = $this->poly_affiliation_model->insert_data_batch('council_polytechnic_affiliation_fees_structure',$data_array);
                 }
                

                if ($status) {
                    $this->session->set_flashdata('status_v4', 'success');
                    $this->session->set_flashdata('alert_msg', 'Fees Successfully Added');
                    
                    
                } else {
                    
                    $this->session->set_flashdata('status_v4', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Data Not Insert');
                }

            }
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }


    }

    public function add_class_details(){

        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById(md5($this->input->post('basic_id')));
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $id_hash = md5($this->input->post('basic_id'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'department',
                    'label' => 'Department',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'room',
                    'label' => 'Room',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'seat',
                    'label' => 'Seat',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'size',
                    'label' => 'Size',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{

                $data_array = array(
                    'affiliation_type_id_fk'  => $data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'  => $this->input->post('basic_id'),
                    'institute_details_id_fk' => $data['ins_details']['institute_details_id_pk'],
                    'vtc_id_fk' =>  $data['affiliation_data']['vtc_id_fk'],
                    'discipline_id_fk' =>  $this->input->post('department'),
                    'total_rooms' =>  $this->input->post('room'),
                    'seat' =>  $this->input->post('seat'),
                    'size' =>  $this->input->post('size'),
                    'remarks' =>  $this->input->post('remarks'),
                    'created_at'=> 'now()'
                );


                $check_data=$this->poly_affiliation_model->fetch_data('council_polytechnic_affiliation_class_room_intake', 
                    ['affiliation_type_id_fk'=>$data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'=>$this->input->post('basic_id'),
                    'institute_details_id_fk'=>$data['ins_details']['institute_details_id_pk'],
                    'discipline_id_fk'=>$this->input->post('department'),'active_status'=>1
                    ]);
               
                if($check_data == false){
                $status = $this->poly_affiliation_model->insert_data('council_polytechnic_affiliation_class_room_intake',$data_array);
                }else{
                   $this->session->set_flashdata('status', 'danger');
                   $this->session->set_flashdata('alert_msg', 'Department Class Room already Added ');
                }
               
                if ($status) {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Class Room Successfully Added');
                    
                    
                } else {
                    
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Department Class Room already Added.');
                }
                

            }
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }
        
    }


    //Add Lab Part

    public function add_lab_details(){
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById(md5($this->input->post('basic_id')));
        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $id_hash = md5($this->input->post('basic_id'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'department',
                    'label' => 'Department',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'avail_lab',
                    'label' => 'Available Lab',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'exp_setup',
                    'label' => 'Expermental Set-up',
                    'rules' => 'trim|required|integer'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status_v2', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{

                $data_array = array(
                    'affiliation_type_id_fk'  => $data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'  => $this->input->post('basic_id'),
                    'institute_details_id_fk' => $data['ins_details']['institute_details_id_pk'],
                    'vtc_id_fk' =>  $data['affiliation_data']['vtc_id_fk'],
                    'discipline_id_fk' =>  $this->input->post('department'),
                    'available_lab' =>  $this->input->post('avail_lab'),
                    'exp_setup' =>  $this->input->post('exp_setup'),
                    'remarks' =>  $this->input->post('remarks'),
                    'created_at'=> 'now()',
                    'affiliation_year' =>$data['affiliation_year']
                );


                $check_data=$this->poly_affiliation_model->fetch_data('council_polytechnic_affiliation_lab_details',
                    ['affiliation_type_id_fk'=>$data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'=>$this->input->post('basic_id'),
                    'institute_details_id_fk'=>$data['ins_details']['institute_details_id_pk'],
                    'discipline_id_fk'=>$this->input->post('department'),'active_status'=>1
                    ]);
               
                if($check_data == false){
                $status = $this->poly_affiliation_model->insert_data('council_polytechnic_affiliation_lab_details',$data_array);
                }else{
                   $this->session->set_flashdata('status_v2', 'danger');
                   $this->session->set_flashdata('alert_msg', 'Department Lab already Added ');
                }
               
                if ($status) {
                    $this->session->set_flashdata('status_v2', 'success');
                    $this->session->set_flashdata('alert_msg', 'Lab Successfully Added');
                    
                    
                } else {
                    
                    $this->session->set_flashdata('status_v2', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Department Lab already Added.');
                }
                

            }
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }
        
    }


    //add_library_details

    public function add_library_details(){

        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById(md5($this->input->post('basic_id')));
        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $id_hash = md5($this->input->post('basic_id'));
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'department',
                    'label' => 'Department',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'books_avail',
                    'label' => 'Available Books',
                    'rules' => 'trim|required|integer'
                ),
                array(
                    'field' => 'books_issue',
                    'label' => 'Books Issued',
                    'rules' => 'trim|required|integer'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status_v3', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{

                $data_array = array(
                    'affiliation_type_id_fk'  => $data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'  => $this->input->post('basic_id'),
                    'institute_details_id_fk' => $data['ins_details']['institute_details_id_pk'],
                    'vtc_id_fk' =>  $data['affiliation_data']['vtc_id_fk'],
                    'discipline_id_fk' =>  $this->input->post('department'),
                    'books_available' =>  $this->input->post('books_avail'),
                    'books_issue' =>  $this->input->post('books_issue'),
                    'remarks' =>  $this->input->post('remarks'),
                    'created_at'=> 'now()',
                    'affiliation_year' =>$data['affiliation_year']
                );


                $check_data=$this->poly_affiliation_model->fetch_data('council_polytechnic_affiliation_library_details',
                    ['affiliation_type_id_fk'=>$data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'=>$this->input->post('basic_id'),
                    'institute_details_id_fk'=>$data['ins_details']['institute_details_id_pk'],
                    'discipline_id_fk'=>$this->input->post('department'),'active_status'=>1
                    ]);
               
                if($check_data == false){
                $status = $this->poly_affiliation_model->insert_data('council_polytechnic_affiliation_library_details',$data_array);
                }else{
                   $this->session->set_flashdata('status_v3', 'danger');
                   $this->session->set_flashdata('alert_msg', 'Department Library already Added ');
                }
               
                if ($status) {
                    $this->session->set_flashdata('status_v3', 'success');
                    $this->session->set_flashdata('alert_msg', 'Library Successfully Added');
                    
                    
                } else {
                    
                    $this->session->set_flashdata('status_v3', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Department Library already Added.');
                }
                

            }
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }

    }

    public function add_mand_details(){

       $check_validation=$this->poly_affiliation_model->check_validation($this->input->post('basic_id')); 
       $id_hash = md5($this->input->post('basic_id'));
       if($check_validation[0]['room_intake']==1 && $check_validation[0]['lab_intake']==1 && $check_validation[0]['library_intake']==1 ){
       
       $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById(md5($this->input->post('basic_id')));
        $data['affiliation_year'] = '2023-24';
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        if($this->input->server("REQUEST_METHOD") == 'POST'){
            $this->load->library('form_validation'); 
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');
            $config = array(
                array(
                    'field' => 'mand_req[]',
                    'label' => 'Mandatory Requirements',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'req_status[]',
                    'label' => 'Request Status',
                    'rules' => 'trim|required'
                )
            );
            $this->form_validation->set_rules($config);
            
            if ($this->form_validation->run() == FALSE) {
                //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_view', $data);
                $this->session->set_flashdata('status_v4', 'danger');
                $this->session->set_flashdata('alert_msg', 'Validation error.');
            }else{
                $data_array=[];
                $j=0;
                if($this->input->post("mand_req")!=''){
                    foreach($this->input->post('mand_req') as $k => $v){

                        $data_array[$j]['affiliation_type_id_fk']  = $data['affiliation_data']['affiliation_type_id_fk'];
                        $data_array[$j]['basic_affiliation_id_fk']  = $this->input->post('basic_id');
                        $data_array[$j]['institute_details_id_fk'] = $data['ins_details']['institute_details_id_pk'];
                        $data_array[$j]['vtc_id_fk'] =  $data['affiliation_data']['vtc_id_fk'];
                        $data_array[$j]['fc_id_fk'] =  $this->input->post('mand_req')[$k];
                        $data_array[$j]['availability'] = $this->input->post('req_status')[$k];
                        $data_array[$j]['size'] =  $this->input->post('req_details')[$k];
                        $data_array[$j]['created_at'] = 'now()';
                        $data_array[$j]['affiliation_year'] = $data['affiliation_year'];
                        $j++;
                        
                    }
                }
				//echo "<pre>";print_r($data_array);die;

                $check_data=$this->poly_affiliation_model->fetch_data('council_polytechnic_affiliation_mandatory_requirements',
                    ['affiliation_type_id_fk'=>$data['affiliation_data']['affiliation_type_id_fk'],
                    'basic_affiliation_id_fk'=>$this->input->post('basic_id'),
                    'institute_details_id_fk'=>$data['ins_details']['institute_details_id_pk']
                    ]);

                 if($check_data == true){
                     $delete=$this->poly_affiliation_model->delete_details('council_polytechnic_affiliation_mandatory_requirements',['basic_affiliation_id_fk'=>$this->input->post('basic_id')]);

                     $status = $this->poly_affiliation_model->insert_data_batch('council_polytechnic_affiliation_mandatory_requirements',$data_array);
                 }else{
                     $status = $this->poly_affiliation_model->insert_data_batch('council_polytechnic_affiliation_mandatory_requirements',$data_array);

                     //update basic Details
                     $status1 = $this->poly_affiliation_model->update_data('council_polytechnic_institute_basic_affiliation_details',$this->input->post('basic_id'),array('infrastructure_fees_submited_status'=>1));

                 }
                

                if ($status) {
                    $this->session->set_flashdata('status_v4', 'success');
                    $this->session->set_flashdata('alert_msg', 'Mandatory Requirements Successfully Added');
                    redirect('/admin/polytechnic_affiliation/affiliation/documents_upload/'.$id_hash);
                    
                } else {
                    
                    $this->session->set_flashdata('status_v4', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Data Not Insert');
                }

            }
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }
    }else{
        $this->session->set_flashdata('status_v4', 'danger');
        $this->session->set_flashdata('alert_msg', 'Please add Class Rooms, Laboratories and Library Details');
        redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
    }

    }



    //Delete Part

    public function delete($part,$id_hash,$id){
        //echo $part." ".$id." ".$id_hash;die;
        if($part==1){
            $delete=$this->poly_affiliation_model->delete_function("council_polytechnic_affiliation_class_room_intake",["md5(class_details_id_pk::TEXT)"=>$id]);
            $status="status";
        }elseif($part==2){
            $delete=$this->poly_affiliation_model->delete_function("council_polytechnic_affiliation_lab_details",["md5(lab_details_id_pk::TEXT)"=>$id]);
            $status="status_v2";
        }elseif($part==3){
            $delete=$this->poly_affiliation_model->delete_function("council_polytechnic_affiliation_library_details",["md5(library_id_details_pk::TEXT)"=>$id]);
            $status="status_v3";
        }
        if($delete){
            $this->session->set_flashdata($status, 'success');
            $this->session->set_flashdata('alert_msg', 'Data remove Successfully');
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }else{
            $this->session->set_flashdata($status, 'danger');
            $this->session->set_flashdata('alert_msg', 'Data can not remove');
            redirect('/admin/polytechnic_affiliation/affiliation/infrastructure_fees/'.$id_hash);
        }
       

    }
	
	public function delete_staff_intake($part,$id_hash,$id){
        //echo $part." ".$id." ".$id_hash;die;
        if ($part==4) {
            $delete=$this->poly_affiliation_model->delete_function("council_polytechnic_institute_intake_details",["md5(intake_details_id_pk::TEXT)"=>$id]);
            $status="status_v4";
        }elseif ($part==5) {
            $delete=$this->poly_affiliation_model->delete_function("council_polytechnic_institute_teacher_details",["md5(teacher_id_pk::TEXT)"=>$id]);
            $status="status_v4";
        }
        if($delete){
            $this->session->set_flashdata($status, 'success');
            $this->session->set_flashdata('alert_msg', 'Data remove Successfully');
            redirect('/admin/polytechnic_affiliation/affiliation/intake_details/'.$id_hash);
        }else{
            $this->session->set_flashdata($status, 'danger');
            $this->session->set_flashdata('alert_msg', 'Data can not remove');
            redirect('/admin/polytechnic_affiliation/affiliation/intake_details/'.$id_hash);
        }
       

    }

    // ! File validation function
    public function file_validation_old($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);

        
        if ($file_array[1] == "application/pdf") {
            $ext = "PDF";
        }
        else{
            $ext="PDF";
        }

    
        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == "application/pdf") {
                
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
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
    }

    public function file_validation($id=null,$file_name = NULL){
        $file_array = explode("|", $file_name);
        //print_r($file_array[2]);exit;
        $decode_data=hex2bin($file_array[0]);
        $file=str_replace("data:application/pdf;base64,","",$decode_data);
        $decodedPdf = explode(',', $decode_data);
        $file_size=strlen(base64_decode($file));
        if(round($file_size/1024) >= $file_array[2]){
        $this->form_validation->set_message('file_validation', 'Maximum Size '.$file_array[2].' KB for {field}');
        return FALSE;
        }else{
            if($decodedPdf[0]!='data:application/pdf;base64'){
                $this->form_validation->set_message('file_validation', 'The {field} file type must be PDF');
                return FALSE;
            }else{ 
                return TRUE;
            }
        }
    }



    public function download_uploaded_pdf($mode=NULL , $id_hash = NULL)
    {

        if ($id_hash != NULL) {

            $result = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        // print_r($result);die;
            if (!empty($result)) {
                if($mode==1){
                    $uploaded_file     = $result['aicte_approval_file'];
                }elseif($mode=='2'){
                    $uploaded_file     = $result['wbsct_affiliation_file'];
                }elseif($mode=='3'){
                    $uploaded_file     = $result['land_doc_file'];
                }
                
                $publication_title = time();

                header("Content-type:application/pdf");
            // header("Content-Disposition:attachment;filename=" . $publication_title . ".pdf");

                echo base64_decode($uploaded_file);
            } else {

                redirect('admin/syllabus/upload_syllabus');
            }
        } else {

            redirect('admin/syllabus/upload_syllabus');
        }
    }

    //add by moli on 21-07-2023
    public function view_all_details($id_hash = NULL){

        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        $data['id_hash'] = $id_hash;
        $data['affiliation_year'] = '2023-24';
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/application_view', $data);
    }

    public function download_form($id_hash=NULL){
        $this->load->library('m_pdf');
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        $data['id_hash'] = $id_hash;
        //$data['stateList']  = $this->poly_affiliation_model->getAllState();
        $data['affiliation_year'] = '2023-24';
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        //echo "<pre>";print_r($data['affiliation_data']);exit;
        if($data['affiliation_data']['intake_submited_status'] ==1){
            $data['active_class1'] = 'intakeStaff';
        }else{
            $data['active_class1'] = '';
        }
        if($data['affiliation_data']['basic_details_submited_status'] == 1){
            $data['active_class'] = 'basicDetails';
        }else{
            $data['active_class'] = '';
        }
        if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
            $data['active_class2'] = 'infra_fees';
        }else{
            $data['active_class2'] = '';
        }
        if($data['affiliation_data']['doc_uploaded_status'] == 1){
            $data['active_class3'] = 'doc_upload';
        }else{
            $data['active_class3'] = '';
        }
         
        $data['teacher_data'] = $this->poly_affiliation_model->getTeachersById($id_hash);
        $data['intake_data'] = $this->poly_affiliation_model->getIntakeById($id_hash);
        //echo "<pre>";print_r(($data['intake_data']));exit;
        $data['fetch_room'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_class_room_intake as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

        $data['fetch_lab'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_lab_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);

        $data['fetch_library'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_library_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk'],'c1.active_status'=>1]);
        $data['mandory_data'] = $this->poly_affiliation_model->mandory_master();

        $data['fetch_mandory_data'] = $this->poly_affiliation_model->fetch_mandory_data($data['affiliation_data']['basic_affiliation_id_pk']);

        $data['payment_status'] = $this->poly_affiliation_model->getPaymentStatus($id_hash);

        $data['fetch_fees_data'] = $this->poly_affiliation_model->fetch_poly_fees_data($data['affiliation_data']['basic_affiliation_id_pk'],$data['affiliation_data']['affiliation_type_id_fk']);
         
        // Payment 
        if($data['affiliation_data']['institute_category_id_fk'] == 4){
            $affiliation_fees = 30000;
            if(count($data['intake_data']) > 4){
                $increse_course_no =  count($data['intake_data']) - 4;
                $increse_course_amnt = 7500 * $increse_course_no;
            }else{
                $increse_course_amnt = 0;
            }
            //echo $increse_course_amnt;die;
            $i = 0;
            $blank_array=array();
            foreach ($data['intake_data'] as $key => $value) {
                if($value['intake_no'] > 60){
                    $increase_value = $value['intake_no'] - 60;
                    array_push($blank_array,$value['remarks']);
                    
                    $increase_intake_no = floor($increase_value / 60);
                    $i = $i+$increase_intake_no;

                    //echo "<br>";
                }
            }
            //echo "<pre>";print_r($blank_array);die;
            //echo $i;die;
            if($i == 0){
                $increase_intake_amount = 0;
                $description = '';
            }else{
                $increase_intake_amount = 7500 * $i;
                $description = implode(' / ', $blank_array);
            }



            $data['payment'] = array(
                'application_fees' => 1000,
                'inspection_fees'  => 10000,
                'affiliation_fees' => $affiliation_fees,
                'increse_course_amnt' => $increse_course_amnt,
                'increase_intake_amount' => $increase_intake_amount,
                'new_or_renewal'        => ($data['affiliation_data']['new_or_renewal'] == 2)? 'Renewal of' : '',
                'total_fees'            =>  1000 + 10000 + $affiliation_fees + $increse_course_amnt + $increase_intake_amount ,
                'description'           => $description
    
            );
            //echo "<pre>";print_r($data['payment']);exit;
        }else{
            $data['payment'] = array();
        }
        // echo "<pre>";
        // print_r($data);die;
        
        $this->m_pdf->pdf->AddPage('P');
        $this->m_pdf->pdf->SetWatermarkImage( $_SERVER['DOCUMENT_ROOT'] . '/' .'admin/themes/adminlte/assets/image/certificate/logo.png', 0.1,[100, 100]); 
        $this->m_pdf->pdf->showWatermarkImage = true;
        //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_doc_upload'); 
        $html   = $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/application_form',$data,true);
        $this->m_pdf->pdf->WriteHTML($html);

        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
    }

    public function view_transaction($basic_id_hash){
        $data['institute_id_fk'] =  $this->session->userdata('stake_details_id_fk');
        
        
        $data['txnData']=$this->poly_affiliation_model->get_transaction_history($data['institute_id_fk'],$basic_id_hash);
        //print_r($data);exit;
        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/trans_view_list', $data);
    }
 
 

}