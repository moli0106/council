<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Details extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(70);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/details_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/vtc.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",

            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
        );
    }

    public function index()
    {
        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');

        // $data['academic_year']  = $this->config->item('academic_year');

        $data['academic_year']  = $this->config->item('previous_academic_year'); // Previous Year

        // Added By Moli For Academic Year
        $data['current_academic_year'] = $this->config->item('current_academic_year'); // Current Year

        if(!empty($data['current_academic_year'])){
            
            $data['current_data'] = $this->details_model->getVtcDetails(md5($data['vtc_id']), $data['current_academic_year']);
        }
        // echo "<pre>";print_r($current_data);exit;

        $previous_data = $this->details_model->getVtcDetails(md5($data['vtc_id']), $data['academic_year']);

        $data['hoi_designation']  = $this->details_model->getHoiDesignationList();//Added by Moli on 28-07-2022
        $data['institute_category']  = $this->details_model->getInstituteCategory();//Added by Moli on 29-07-2022

        $data['disabilityList']  = $this->details_model->getDisabilityList();//Added by Moli on 05-12-2022
        $data['disadvantageGroupList']  = $this->details_model->getdisadvantageGroupList();//Added by Moli on 05-12-2022

        if(!empty($data['current_data'])){

            $vtcDetails = $data['current_data'];

        }else{
            $vtcDetails = $previous_data;
        }
        // echo "<pre>";print_r($vtcDetails);exit;

        // Added By Moli For Academic Year
         
        if(!empty($data['current_academic_year'])){

            $data['vtcCourseList'] = $this->details_model->getVtcAllCourseList($data['vtc_id'], $data['current_academic_year']);
        }else{

            $data['vtcCourseList'] = $this->details_model->getVtcCourseList($data['vtc_id'], $data['academic_year']);

        }

        

        $data['final_submit_status']   = $vtcDetails['final_submit_status'];

        $data['vtcTypeList']   = $this->details_model->getVtcType();
        $data['mediumList']    = $this->details_model->getMediumOfInstruction();
        $data['districtList']  = $this->details_model->getDistrictList();
        $data['municipality'] = $this->details_model->getMunicipalityByDivisionId($vtcDetails['sub_division_id_fk']);

        $data['nearest_vtc'] = $this->details_model->getNearestVtc($vtcDetails['vtc_details_id_pk']);

        $data['institute_category_doc'] = $vtcDetails['institute_category_doc'];

        if ($this->input->server("REQUEST_METHOD") == 'POST') {

            // echo "<pre>";print_r($_FILES);exit;


            $formData['vtc_code']        = set_value('vtc_code');
            $formData['vtc_name']        = set_value('vtc_name');
            $formData['vtc_email']       = set_value('vtc_email');
            $formData['hoi_name']        = set_value('hoi_name');
            $formData['hoi_designation'] = set_value('hoi_designation');
            $formData['hoi_email']       = set_value('hoi_email');
            $formData['hoi_mobile_no']   = set_value('hoi_mobile_no');
            $formData['vtc_type_id_fk']  = set_value('vtc_type_id_fk');
            $formData['other_type']      = set_value('other_type');
            $formData['medium_id_fk']    = set_value('medium_id_fk');
            $formData['other_medium']    = set_value('other_medium');
            $formData['vtc_address']     = set_value('vtc_address');
            $formData['district_id_fk']  = set_value('district_id_fk');
            $formData['sub_division_id_fk']  = set_value('sub_division_id_fk');
            $formData['municipality_id_fk']  = set_value('municipality_id_fk');
            $formData['panchayat']       = set_value('panchayat');
            $formData['police_station']  = set_value('police_station');
            $formData['pin_code']        = set_value('pin_code');
            $formData['phone_no']        = set_value('phone_no');
            $formData['nodal_id_fk']        = set_value('nodal_id_fk');
            $formData['hs_equivalent']   = set_value('hs_equivalent');
            $formData['hs_science']      = set_value('hs_science');
            $formData['hs_biology']      = set_value('hs_biology');
            $formData['hs_commerce']     = set_value('hs_commerce');

            $formData['vtc_details_id']     = set_value('vtc_details_id');

            $formData['inst_category']     = set_value('inst_category');

            $formData['special_category']     = set_value('spl_category');

            $formData['disability_id']     = set_value('disability');

            $formData['disadvantage_group']     = set_value('disadvantage_group');
        } else {

            $formData['vtc_code']        = $vtcDetails['vtc_code'];
            $formData['vtc_name']        = $vtcDetails['vtc_name'];
            $formData['vtc_email']       = $vtcDetails['vtc_email'];
            $formData['hoi_name']        = $vtcDetails['hoi_name'];
            // $formData['hoi_designation'] = $vtcDetails['hoi_designation'];
            $formData['hoi_designation'] = $vtcDetails['hoi_designation_id_fk'];
            $formData['hoi_email']       = $vtcDetails['hoi_email'];
            $formData['hoi_mobile_no']   = $vtcDetails['hoi_mobile_no'];
            $formData['vtc_type_id_fk']  = $vtcDetails['vtc_type_id_fk'];
            $formData['other_type']      = $vtcDetails['other_type'];
            $formData['medium_id_fk']    = $vtcDetails['medium_id_fk'];
            $formData['other_medium']    = $vtcDetails['other_medium'];
            $formData['vtc_address']     = $vtcDetails['vtc_address'];
            $formData['district_id_fk']  = $vtcDetails['district_id_fk'];
            $formData['sub_division_id_fk']  = $vtcDetails['sub_division_id_fk'];
            $formData['municipality_id_fk']  = $vtcDetails['municipality_id_fk'];
            $formData['panchayat']       = $vtcDetails['panchayat'];
            $formData['police_station']  = $vtcDetails['police_station'];
            $formData['pin_code']        = $vtcDetails['pin_code'];
            $formData['phone_no']        = $vtcDetails['phone_no'];
            $formData['nodal_id_fk']        = $vtcDetails['nodal_id_fk'];
            $formData['hs_equivalent']   = $vtcDetails['hs_equivalent'];
            $formData['hs_science']      = $vtcDetails['hs_science'];
            $formData['hs_biology']      = $vtcDetails['hs_biology'];
            $formData['hs_commerce']     = $vtcDetails['hs_commerce'];

            $formData['vtc_details_id']     = $vtcDetails['vtc_details_id_pk'];

            $formData['inst_category']      = $vtcDetails['institute_category_id_fk'];

            $formData['special_category']      = $vtcDetails['special_category'];
            $formData['disability_id']      = $vtcDetails['disability_id_fk'];
            $formData['disadvantage_group']      = $vtcDetails['disadvantage_group_id_fk'];
        }
        // echo "<pre>";print_r($formData);exit;

        $vtcDetails['district_id_fk'] = $formData['district_id_fk'];

        if ($vtcDetails['district_id_fk'] == 16) {

            $kolkataArray = array(
                0 => 682, // KOLKATA NORTH 
                1 => 683, // KOLKATA SOUTH
                2 => 16, // KOLKATA
            );

            $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($vtcDetails['district_id_fk']);
            $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
        } elseif (($vtcDetails['district_id_fk'] == 682) || ($vtcDetails['district_id_fk'] == 683)) {

            $kolkataArray = array(
                0 => $vtcDetails['district_id_fk'], // SOUTH / NORTH KOLKATA
                1 => 16, // KOLKATA
            );

            $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId(16);
            $data['nodalOfficer'] = $this->details_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
        } else {

            $data['subDivision']  = $this->details_model->getSubDivisionByDistrictId($vtcDetails['district_id_fk']);
            $data['nodalOfficer'] = $this->details_model->getNodalOfficerByDistrictId($vtcDetails['district_id_fk']);
        }
        // parent::pre($data);

        $data['formData'] = $formData;

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

           

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                /* array(
                    'field' => 'vtc_email',
                    'label' => 'VTC Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ), */
                array(
                    'field' => 'hoi_name',
                    'label' => 'HOI Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'hoi_designation',
                    'label' => 'HOI Designation',
                    // 'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'rules' => 'trim|required',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'hoi_email',
                    'label' => 'HOI Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                /* array(
                    'field' => 'hoi_mobile_no',
                    'label' => 'HOI Mobile',
                    'rules' => 'trim|required|exact_length[10]|numeric',
                ), */
                array(
                    'field' => 'vtc_address',
                    'label' => 'Address',
                    //'rules' => 'trim|required|max_length[500]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'rules' => 'trim|required|max_length[500]|regex_match[/^[a-zA-Z0-9\r\n-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'district_id_fk',
                    'label' => 'District',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'sub_division_id_fk',
                    'label' => 'Sub Division',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'municipality_id_fk',
                    'label' => 'Municipality',
                    'rules' => 'trim|numeric',
                ),
                array(
                    'field' => 'police_station',
                    'label' => 'Police Station',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'pin_code',
                    'label' => 'Pin Code',
                    'rules' => 'trim|required|exact_length[6]|numeric',
                ),
                // array(
                //     'field' => 'nodal_id_fk',
                //     'label' => 'Nodal',
                //     'rules' => 'trim|required|numeric',
                // ),

                array(
                    'field' => 'inst_category',
                    'label' => 'Institute Category',
                    'rules' => 'trim|required',
                    
                ),

                //Add on 05-12-2022
                array(
                    'field' => 'spl_category',
                    'label' => 'Special Category',
                    'rules' => 'trim|required'
                ),
            );
            //Add on 05-12-2022
            $spl_category = $this->input->post('spl_category');

            if($spl_category != '' && $spl_category == 2){
                $config[] = array(
                    'field' => 'disability',
                    'label' => 'Disability',
                    'rules' => 'trim|required'
                );
            }elseif ($spl_category != '' && $spl_category == 3) {
                $config[] = array(
                    'field' => 'disadvantage_group',
                    'label' => 'Disadvantage Group',
                    'rules' => 'trim|required'
                );
            }

            if($spl_category != '' && $spl_category != 1){
                if($vtcDetails['special_category_doc'] == ''){

                    $this->form_validation->set_rules('spl_category_doc', 'Special Category Doc', 'trim|callback_file_validation[spl_category_doc|application/pdf|200|required]');
                }else{
                    $this->form_validation->set_rules('spl_category_doc', 'Special Category Doc', 'trim|callback_file_validation[spl_category_doc|application/pdf|200|]');

                }


            }
            //Add on 05-12-2022

            if($this->input->post('inst_category') == 4){
                
                $config[] = array(
                    'field' => 'private_nodal_id',
                    'label' => 'Nodal',
                    'rules' => 'trim|required|numeric',
                );

                $nodal_id = $this->input->post('private_nodal_id');
            }else{
                $config[] = array(
                    'field' => 'nodal_id_fk',
                    'label' => 'Nodal',
                    'rules' => 'trim|required|numeric',
                );
                $nodal_id = $this->input->post('nodal_id_fk');
            }

            if ($this->input->post('vtc_type_id_fk') == 'Other') {
                $config[] = array(
                    'field' => 'other_type',
                    'label' => 'Type',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                );
            } else {
                $config[] = array(
                    'field' => 'vtc_type_id_fk',
                    'label' => 'VTC Type',
                    'rules' => 'trim|required|numeric'
                );
            }

            if (empty($data['vtcCourseList'])) {
                $config[] = array(
                    'field' => 'hs_equivalent',
                    'label' => 'Higher Secondary or equivalent',
                    'rules' => 'trim|required|numeric'
                );

                if ($this->input->post('hs_equivalent') == 1) {
                    $config[] = array(
                        'field' => 'hs_science',
                        'label' => 'Higher Secondary Science (Mathematics)',
                        'rules' => 'trim|required|numeric'
                    );

                    $config[] = array(
                        'field' => 'hs_biology',
                        'label' => 'Higher Secondary Science (Biology)',
                        'rules' => 'trim|required|numeric'
                    );

                    $config[] = array(
                        'field' => 'hs_commerce',
                        'label' => 'Higher Secondary Commerce',
                        'rules' => 'trim|required|numeric'
                    );
                }
            }

            if ($this->input->post('medium_id_fk') == 'Other') {
                $config[] = array(
                    'field' => 'other_medium',
                    'label' => 'Medium',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                );
            } else {
                $config[] = array(
                    'field' => 'medium_id_fk',
                    'label' => 'Medium Of Nstruction',
                    'rules' => 'trim|required|numeric'
                );
            }

            // Added by Moli
            
            $this->form_validation->set_rules($config);

            if($vtcDetails['institute_category_doc'] == ''){

                $this->form_validation->set_rules('category_doc', 'Category Document', 'trim|callback_file_validation[category_doc|application/pdf|200|required]');
            }else{

                $this->form_validation->set_rules('category_doc', 'Category Document', 'trim|callback_file_validation[category_doc|application/pdf|200|]');
            }


            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'affiliation/details_view', $data);
            } else {

                // Added by Moli on 28-07-2022
                $designation_id = $this->input->post('hoi_designation');
                $designationName = $this->details_model->getDesignationNameById($designation_id);


                $insertArray = array(
                    'vtc_email'        => $this->input->post('vtc_email'),
                    'hoi_name'         => $this->input->post('hoi_name'),
                    // 'hoi_designation'  => $this->input->post('hoi_designation'),
                    'hoi_designation'        => $designationName['designation_name'], // Added by Moli
                    'hoi_email'        => $this->input->post('hoi_email'),
                    'hoi_mobile_no'    => $this->input->post('hoi_mobile_no'),
                    'vtc_type_id_fk'   => ($this->input->post('vtc_type_id_fk') == 'Other') ? NULL : $this->input->post('vtc_type_id_fk'),
                    'other_type'       => ($this->input->post('other_type') == NULL) ? NULL : $this->input->post('other_type'),
                    'medium_id_fk'     => ($this->input->post('medium_id_fk') == 'Other') ? NULL : $this->input->post('medium_id_fk'),
                    'other_medium'     => ($this->input->post('other_medium') == NULL) ? NULL : $this->input->post('other_medium'),
                    'vtc_address'      => $this->input->post('vtc_address'),
                    'district_id_fk'         => $this->input->post('district_id_fk'),
                    'sub_division_id_fk'     => $this->input->post('sub_division_id_fk'),
                    'municipality_id_fk'     => $this->input->post('municipality_id_fk') == NULL ? NULL : $this->input->post('municipality_id_fk'),
                    'panchayat'              => $this->input->post('panchayat'),
                    'police_station'         => $this->input->post('police_station'),
                    'pin_code'               => $this->input->post('pin_code'),
                    'phone_no'               => $this->input->post('phone_no'),
                    // 'nodal_id_fk'            => $this->input->post('nodal_id_fk'),
                    'nodal_id_fk'            => $nodal_id,
                    'entry_ip'       => $this->input->ip_address(),

                    'hoi_designation_id_fk'        => $this->input->post('hoi_designation'), // Added by Moli

                    'institute_category_id_fk'        => $this->input->post('inst_category'), // Added by Moli

                    // s'institute_category_doc'         =>  ($this->input->post('category_doc') == NULL) ? '' : base64_encode(file_get_contents($_FILES["category_doc"]['tmp_name'])),// Added by Moli

                    'special_category'              => $spl_category,
                    'disability_id_fk'              => ($this->input->post('disability') == NULL) ? NULL : $this->input->post('disability'),
                    'disadvantage_group_id_fk'              => ($this->input->post('disadvantage_group') == NULL) ? NULL : $this->input->post('disadvantage_group'),
                    'special_category_doc'              => ($this->input->post('spl_category_doc') == '') ? '' : base64_encode(file_get_contents($_FILES["spl_category_doc"]['tmp_name'])),
                );
                if(!empty($_FILES["category_doc"]['tmp_name'])){
                    $insertArray['institute_category_doc'] = base64_encode(file_get_contents($_FILES["category_doc"]['tmp_name']));
                }

                if (empty($data['vtcCourseList'])) {

                    $insertArray['hs_equivalent']  = $this->input->post('hs_equivalent');
                    $insertArray['hs_science']     = ($this->input->post('hs_equivalent') == 1) ? $this->input->post('hs_science') : NULL;
                    $insertArray['hs_biology']     = ($this->input->post('hs_equivalent') == 1) ? $this->input->post('hs_biology') : NULL;
                    $insertArray['hs_commerce']    = ($this->input->post('hs_equivalent') == 1) ? $this->input->post('hs_commerce') : NULL;
                }

                // parent::pre([$_POST, $insertArray]);
                if(!empty($data['current_academic_year'])){

                    if(empty($data['current_data'])){

                        $insertArray['academic_year'] = $data['current_academic_year'];
                        $insertArray['vtc_email_verify_status'] = $previous_data['vtc_email_verify_status'];
                        $insertArray['hoi_mobile_no_verify_status'] = $previous_data['hoi_mobile_no_verify_status'];
                        $insertArray['hoi_mobile_otp'] = $previous_data['hoi_mobile_otp'];
                        $insertArray['vtc_id_fk'] = $previous_data['vtc_id_fk'];
                        $insertArray['entry_time'] = 'now()';
                        $insertArray['entry_ip'] = $this->input->ip_address();
                        // $insertArray['final_submit_status'] = 0;
                        $insertArray['near_by_existing_vtc'] = $previous_data['near_by_existing_vtc'];
                        $insertArray['number_of_existing_vtc'] = $previous_data['number_of_existing_vtc'];
                        
                        // echo "<pre>";print_r($insertArray);exit;
                        $result = $this->details_model->insertVtcDetails($insertArray);
                    }else{
                        $result = $this->details_model->updateVtcDetails(md5($vtcDetails['vtc_details_id_pk']), $insertArray);
                    }

                    
                }else{

                    $result = $this->details_model->updateVtcDetails(md5($vtcDetails['vtc_details_id_pk']), $insertArray);
                }


                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Details has been successfully updated.');

                    redirect('admin/affiliation/details');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/affiliation/details');
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'affiliation/details_view', $data);
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

    //Added by Moli on 20-07-2022
    
    public function open_modal_for_mob_no($id = NULL){
       
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if($id != ''){

                $data['vtc_details'] = $this->details_model->getVTCDetailsById($id);

                $html_view = $this->load->view($this->config->item('theme') . 'affiliation/ajax_view/basic_details/mobile_no_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }
    }

    public function change_mob_no(){

        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            $mob_no = $this->input->post('hoi_mobile_no');
            $vtc_details_id = $this->input->post('vtc_details_id');

            if($vtc_details_id !=''){

                $data['vtc_details'] = $this->details_model->getVTCDetailsById($vtc_details_id);

                if($data['vtc_details']['hoi_mobile_no'] == $mob_no){
                    $return = array(
                        'msg' => 'Change is not Possible ! Mobile no is same as old No. '
                    );
                    echo json_encode($return); 
                }else{

                }
            }
        }
    }



    //Added by Moli on 20-07-2022 

    public function sendOtpForHoiMobileNoVerification()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $otp = rand(100000, 999999);
            $vtc_email = $this->input->get('vtc_email');
            $hoi_mobile_no = $this->input->get('hoi_mobile_no');

            if (preg_match('/^[0-9]{10}+$/', $hoi_mobile_no)) {

                // ! Send OTP on VTC email
                $this->load->helper('email');

                $data = array('otp'  => $otp);

                $email_subject = "Email Verification For Change HOI Mobile Number";
                $email_message = "
                    Dear Sir/Madam,<br
                    <u><strong>" . $otp . "</strong></u> is the otp for update HOI mobile number.
                ";
                $email_status = 1;
                // send_email($vtc_email, $email_message, $email_subject);

                if ($email_status) {

                    $this->session->set_userdata('otpVerificationForHoiMobileNo', $otp);
                    $this->session->set_userdata('newHoiMobileNo', $hoi_mobile_no);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'We have sent you OTP on VTC email. Please, verify your email.');

                    echo json_encode(base_url('admin/affiliation/details/otpVerificationForHoiMobileNo'));
                }
            } else {

                echo json_encode('invalid_movile_no');
            }
        }
    }

    public function otpVerificationForHoiMobileNo()
    {
        $data['otp'] = $this->session->userdata('otpVerificationForHoiMobileNo');
        $data['newHoiMobileNo'] = $this->session->userdata('newHoiMobileNo');

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'otp',
                    'label' => 'OTP',
                    'rules' => 'trim|required|numeric|max_length[6]'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {

                $user_otp = $this->input->post('otp');
                if ($data['otp'] == $user_otp) {

                    $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
                    $data['academic_year']  = $this->config->item('current_academic_year');

                    $vtcDetails = $this->details_model->getVtcDetails(md5($data['vtc_id']), $data['academic_year']);

                    $updateArray = array(
                        'hoi_mobile_no' => $data['newHoiMobileNo'],
                        'access_to_update_hoi_mobile_no' => 1
                    );

                    $result = $this->details_model->updateVtcDetails(md5($vtcDetails['vtc_details_id_pk']), $updateArray);

                    if ($result) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'HOI mobile number has been successfully updated.');
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to update HOI mobile number, Please try after sometime.');
                    }

                    redirect(base_url('admin/affiliation/details'));
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! OTP didn\'t match, Please enter valid OTP.');
                }
            }
        }

        $this->load->view($this->config->item('theme') . 'affiliation/email_template/vtc_email_verify', $data);
    }

    // Added by Moli on 22-09-2022

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

    public function showCategoryDoc($id = NULL)
    {
        if ($id == NULL) {
            redirect('admin/affiliation/details');
        } else {

            $result = $this->details_model->getVTCDetailsById($id);
            if (!empty($result)) {

                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename=Qualification-Certificate-" . date('ymd') . "-" . date('His') . ".pdf");
                echo base64_decode($result['institute_category_doc']);
            } else {
                redirect('admin/affiliation/details');
            }
        }
    }

}
