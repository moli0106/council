<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('online_app/inst/vtc/affiliation_model');

        $this->load->helper('email');
        $this->load->library('sms');

        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/affiliation_view');
    }

    public function registration()
    {
        $data['vtcTypeList']   = $this->affiliation_model->getVtcType();
        $data['mediumList']    = $this->affiliation_model->getMediumOfInstruction();
        $data['districtList']  = $this->affiliation_model->getDistrictList();

        $data['hoi_designation']  = $this->affiliation_model->getHoiDesignationList();//Added by Moli on 20-07-2022
        $data['institute_category']  = $this->affiliation_model->getInstituteCategory();//Added by Moli on 29-07-2022
        $data['disabilityList']  = $this->affiliation_model->getDisabilityList();//Added by Moli on 05-12-2022
        $data['disadvantageGroupList']  = $this->affiliation_model->getdisadvantageGroupList();//Added by Moli on 05-12-2022

        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // echo "hiii";exit;
            //echo $data['registration_for'] = $this->input->post('registration_for');exit;

            /* echo '<pre>';
            print_r($this->input->post());
            exit(); */

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array(
                    'field' => 'vtc_type',
                    'label' => 'Institute Type',
                    'rules' => 'trim|required|exact_length[1]|numeric',
                ),
                array(
                    'field' => 'vtcName',
                    'label' => 'Institute Name',
                    // 'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'rules' => 'trim|required|max_length[250]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'vtcEmail',
                    'label' => 'Institute Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'hoiName',
                    'label' => 'HOI Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'hoiDesignation',
                    'label' => 'HOI Designation',
                    // 'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'rules' => 'trim|required',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'hoiEmail',
                    'label' => 'HOI Email',
                    'rules' => 'trim|required|max_length[250]|valid_email'
                ),
                array(
                    'field' => 'hoiMobileNo',
                    'label' => 'HOI Mobile',
                    'rules' => 'trim|required|exact_length[10]|numeric',
                ),
                array(
                    'field' => 'address',
                    'label' => 'Address',
                    // 'rules' => 'trim|required|max_length[500]|regex_match[/^[a-zA-Z0-9\r\n-&_,.()\/ ]+$/]',
                    'rules' => 'trim|required|max_length[500]',
                    /* 'rules' => 'trim|required|max_length[500]|regex_match[/^[a-zA-Z0-9\r\n-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    ) */
                ),
                array(
                    'field' => 'district',
                    'label' => 'District',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'subDivision',
                    'label' => 'Sub Division',
                    'rules' => 'trim|required|numeric',
                ),
                array(
                    'field' => 'municipality',
                    'label' => 'Municipality',
                    'rules' => 'trim|numeric',
                ),
                array(
                    'field' => 'policeStation',
                    'label' => 'Police Station',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'pinCode',
                    'label' => 'Pin Code',
                    'rules' => 'trim|required|exact_length[6]|numeric',
                ),
                // array(
                //     'field' => 'nodal_id_fk',
                //     'label' => 'Nodal',
                //     'rules' => 'trim|required|numeric',
                // ),
               

                //Add on 05-12-2022
                array(
                    'field' => 'spl_category',
                    'label' => 'Special Category',
                    'rules' => 'trim|required'
                ),
            );
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

                $this->form_validation->set_rules('spl_category_doc', 'Special Category Doc', 'trim|callback_file_validation[spl_category_doc|application/pdf|200|required]');

            }

            

            if ($this->input->post('vtc_type') == 2) {
                $config[] = array(
                    'field' => 'vtcCode',
                    'label' => 'Institute Code',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                );
            } elseif ($this->input->post('vtc_type') == 1) {

                $this->form_validation->set_rules('managingCommitteeResolution', 'Managing Committee Resolution', 'trim|callback_file_validation[managingCommitteeResolution|application/pdf|100|required]');
            }

            if ($this->input->post('vtc_type_id') == 'Other') {
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
                    'field' => 'vtc_type_id',
                    'label' => 'Institute Type',
                    'rules' => 'trim|required|numeric'
                );
            }

            if ($this->input->post('medium_of_instruction') == 'Other') {
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
                    'field' => 'medium_of_instruction',
                    'label' => 'Medium Of Nstruction',
                    'rules' => 'trim|required|numeric'
                );
            }
            if($this->input->post('registration_for') == 1){   //Added by Moli on 14-01-2023

                // added by moli on 22-09-2022
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
                // added by moli on 22-09-2022


                $config[] =array(
                    'field' => 'changeInNameAddress',
                    'label' => 'Change in Name Address',
                    'rules' => 'trim|required|exact_length[1]|numeric'
                );
                $config[] = array(
                    'field' => 'schoolHaveHigherSecondaryEquivalent',
                    'label' => 'Higher Secondary Equivalent',
                    'rules' => 'trim|required|exact_length[1]|numeric'
                );
                $config[] = array(
                    'field' => 'nearbyExistingVtc',
                    'label' => 'Near by Existing VTC',
                    'rules' => 'trim|required|exact_length[1]|numeric'
                );
                $config[] = array(
                    'field' => 'inst_category',
                    'label' => 'Institute Category',
                    'rules' => 'trim|required'
                );
                if ($this->input->post('nearbyExistingVtc') == 1) {
                    $config[] = array(
                        'field' => 'numberOfExistingVtc',
                        'label' => 'Number Of Existing VTC',
                        'rules' => 'trim|required|numeric'
                    );
                }

                if ($this->input->post('changeInNameAddress') == 1) {
                    $config[] = array(
                        'field' => 'approvalFromCouncil',
                        'label' => 'Approval From Council',
                        'rules' => 'trim|required|numeric'
                    );
                }

                if ($this->input->post('schoolHaveHigherSecondaryEquivalent') == 1) {
                    $config[] = array(
                        'field' => 'schoolHaveHigherSecondaryScience',
                        'label' => 'Higher Secondary Science',
                        'rules' => 'trim|required|exact_length[1]|numeric'
                    );

                    $config[] = array(
                        'field' => 'schoolTeachBiology',
                        'label' => 'School Teach Biology',
                        'rules' => 'trim|required|exact_length[1]|numeric'
                    );

                    $config[] = array(
                        'field' => 'schoolTeachCommerce',
                        'label' => 'School Teach Commerce',
                        'rules' => 'trim|required|exact_length[1]|numeric'
                    );
                }

                if ($this->input->post('changeInNameAddress') == 1) {
                    if ($this->input->post('approvalFromCouncil') == 1) {
    
                        $this->form_validation->set_rules('councilApprovalLetter', 'Council Approval Letter', 'trim|callback_file_validation[councilApprovalLetter|application/pdf|100|required]');
                    } elseif ($this->input->post('approvalFromCouncil') == 0) {
    
                        $this->form_validation->set_rules('documentRegardingChangeOfName', 'Document Regarding Change Of Name', 'trim|callback_file_validation[documentRegardingChangeOfName|application/pdf|100|required]');
                    }
                }
            }else{
                $nodal_id = NULL;
            }

            if($this->input->post('registration_for') == 2){
                $config[] = array(
                    'field' => 'aishe_code',
                    'label' => 'AISHE',
                    'rules' => 'trim|required|numeric'
                );       
            }

            $this->form_validation->set_rules($config);

           

            // Added by Moli

            $this->form_validation->set_rules('category_doc', 'Category Document', 'trim|callback_file_validation[category_doc|application/pdf|200|required]');


            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/affiliation_reg_view', $data);
                // $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/institute_reg_view', $data);
                
            } else {

                if (($this->input->post('vtc_type') == 1) || ($this->input->post('vtc_type') == 2)) {

                    // Added by Moli on 20-07-2022
                    $designation_id = $this->input->post('hoiDesignation');
                    $designationName = $this->affiliation_model->getDesignationNameById($designation_id);

                    $vtcDetailsArray = array(
                        'vtc_email'              => $this->input->post('vtcEmail'),
                        'hoi_name'               => $this->input->post('hoiName'),
                        // 'hoi_designation'        => $this->input->post('hoiDesignation'),
                        'hoi_designation'        => $designationName['designation_name'], // Added by Moli on 20-07-2022
                        'hoi_email'              => $this->input->post('hoiEmail'),
                        'hoi_mobile_no'          => $this->input->post('hoiMobileNo'),
                        'vtc_type_id_fk'         => ($this->input->post('vtc_type_id') == 'Other') ? NULL : $this->input->post('vtc_type_id'),
                        'other_type'             => ($this->input->post('other_type') == NULL) ? NULL : $this->input->post('other_type'),
                        'medium_id_fk'           => ($this->input->post('medium_of_instruction') == 'Other') ? NULL : $this->input->post('medium_of_instruction'),
                        'other_medium'           => ($this->input->post('other_medium') == NULL) ? NULL : $this->input->post('other_medium'),
                        'vtc_address'            => $this->input->post('address'),
                        'district_id_fk'         => $this->input->post('district'),
                        'sub_division_id_fk'     => $this->input->post('subDivision'),
                        'municipality_id_fk'     => $this->input->post('municipality') == NULL ? NULL : $this->input->post('municipality'),    // Added by waseem on 08-11-2021
                        'panchayat'              => ($this->input->post('panchayat') == NULL) ? NULL : $this->input->post('panchayat'),
                        'police_station'         => $this->input->post('policeStation'),
                        'pin_code'               => $this->input->post('pinCode'),
                        'phone_no'               => ($this->input->post('phoneNo') == NULL) ? NULL : $this->input->post('phoneNo'),
                        // 'nodal_id_fk'            => $this->input->post('nodal_id_fk'),
                        'nodal_id_fk'            => $nodal_id ,
                        'change_in_name_address' => ($this->input->post('changeInNameAddress') == NULL) ? NULL : $this->input->post('changeInNameAddress'), //moli 2023
                        'approval_from_council'  => ($this->input->post('approvalFromCouncil') == NULL) ? NULL : $this->input->post('approvalFromCouncil'),
                        'hs_equivalent'          => ($this->input->post('schoolHaveHigherSecondaryEquivalent') == NULL) ? NULL : $this->input->post('schoolHaveHigherSecondaryEquivalent'),
                        'near_by_existing_vtc'   => ($this->input->post('nearbyExistingVtc')== NULL) ? NULL : $this->input->post('nearbyExistingVtc'),
                        'number_of_existing_vtc' => ($this->input->post('numberOfExistingVtc') == NULL) ? NULL : $this->input->post('numberOfExistingVtc'),
                    
                        'hoi_designation_id_fk'        => $this->input->post('hoiDesignation'), // Added by Moli on 20-07-2022
                        'institute_category_id_fk'        => $this->input->post('inst_category'), // Added by Moli
                        'institute_category_doc'         =>  base64_encode(file_get_contents($_FILES["category_doc"]['tmp_name'])),// Added by Moli


                        'special_category'              => $spl_category,
                        'disability_id_fk'              => ($this->input->post('disability') == NULL) ? NULL : $this->input->post('disability'),
                        'disadvantage_group_id_fk'              => ($this->input->post('disadvantage_group') == NULL) ? NULL : $this->input->post('disadvantage_group'),
                        'special_category_doc'              => ($this->input->post('spl_category_doc') == '') ? '' : base64_encode(file_get_contents($_FILES["spl_category_doc"]['tmp_name'])),
                    );


                    // Modify By Moli on 13-01-2023
                    if($this->input->post('registration_for') == 1){

                    

                        if ($this->input->post('schoolHaveHigherSecondaryEquivalent') == 1) {

                            $vtcDetailsArray['hs_science']  = ($this->input->post('schoolHaveHigherSecondaryScience') == NULL) ? NULL : $this->input->post('schoolHaveHigherSecondaryScience');
                            $vtcDetailsArray['hs_biology']  = ($this->input->post('schoolTeachBiology') == NULL) ? NULL : $this->input->post('schoolTeachBiology');
                            $vtcDetailsArray['hs_commerce'] = ($this->input->post('schoolTeachCommerce') == NULL) ? NULL : $this->input->post('schoolTeachCommerce');
                        } else {

                            $vtcDetailsArray['hs_science']  = NULL;
                            $vtcDetailsArray['hs_biology']  = NULL;
                            $vtcDetailsArray['hs_commerce'] = NULL;
                        }

                        if ($this->input->post('changeInNameAddress') == 1) {
                            if ($this->input->post('approvalFromCouncil') == 1) {

                                $vtcDetailsArray['doc_council_approval_letter'] = base64_encode(file_get_contents($_FILES["councilApprovalLetter"]['tmp_name']));
                            } elseif ($this->input->post('approvalFromCouncil') == 0) {

                                $vtcDetailsArray['doc_regarding_change_of_name'] = base64_encode(file_get_contents($_FILES["documentRegardingChangeOfName"]['tmp_name']));
                            }
                        }

                        if ($this->input->post('vtc_type') == 1) {

                            $vtcDetailsArray['doc_managing_committee_resolution'] = base64_encode(file_get_contents($_FILES["managingCommitteeResolution"]['tmp_name']));
                        }
                    }
                    

                    $vtcMasterId = NULL;

                    if ($this->input->post('vtc_type') == 1) {

                        $checkVtcName = $this->affiliation_model->checkVtcName($this->input->post('vtcName'));
                        if (empty($checkVtcName)) {

                            $vtcMasterArray = array(
                                'vtc_name' => $this->input->post('vtcName'),
                            );

                            $vtcMasterId = $this->affiliation_model->insertVtcMasterDetails($vtcMasterArray);
                            if (!$vtcMasterId) {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                                redirect('online_app/inst/vtc/affiliation/registration');
                            }
                        } else {

                            $this->session->set_flashdata('status', 'warning');
                            $this->session->set_flashdata('alert_msg', 'Oops! Institute name all ready exist.');

                            redirect('online_app/inst/vtc/affiliation/registration');
                        }
                    } else {

                        
                        $vtcMasterDetails = $this->affiliation_model->getVtcDetailsByCode($this->input->post('vtcCode'));


                        if (!empty($vtcMasterDetails)) {

                            $vtcMasterId = $vtcMasterDetails[0]['vtc_id_pk'];

                        } 
                        else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                            redirect('online_app/inst/vtc/affiliation/registration');
                        }
                    }

                    if ($vtcMasterId != NULL) {

                        if($this->input->post('registration_for') == 2){
                            $updateVTCMaster = array(
                                'udise_code_status' => 1,
                                'udise_code'    => $this->input->post('aishe_code')
                            );
                            $this->affiliation_model->updateVTCMaster($vtcMasterId,$updateVTCMaster);
                        }
                       

                        // $academic_year =  date('Y') . '-' . date('y', strtotime(date('Y') . "+ 1 year"));
                        $academic_year = $this->config->item('current_academic_year');
                        
                        
                        $status = $this->affiliation_model->checkVtcByAcademicYear($vtcMasterId, $academic_year);
                        
                        if (!empty($status)) {

                            $this->session->set_flashdata('status', 'warning');
                            $this->session->set_flashdata('alert_msg', 'Oops! You are all ready applyed for this academic year, Please login to your account.');

                            redirect('online_app/inst/vtc/affiliation/registration');
                        } else {

                            $vtcDetailsArray['vtc_id_fk']     = $vtcMasterId;
                            $vtcDetailsArray['academic_year'] = $academic_year;
                            $vtcDetailsArray['entry_ip']      = $this->input->ip_address();

                            $registration_for = $this->input->post('registration_for');
                            $vtcDetailsId = $this->affiliation_model->insertVtcDetails($vtcDetailsArray);

                            if ($vtcDetailsId) {


                                $numberOfExistingVtc = $this->input->post('numberOfExistingVtc');
                                if (($numberOfExistingVtc != NULL) && ($numberOfExistingVtc > 0)) {

                                    $nearByVtcArray = array();

                                    for ($i = 0; $i < $numberOfExistingVtc; $i++) {

                                        if (!empty($this->input->post('hsVocCoursesGroupCode')[$i])) {
                                            $hsVocCoursesGroupCode = implode(',', $this->input->post('hsVocCoursesGroupCode')[$i]);
                                        } else {
                                            $hsVocCoursesGroupCode = NULL;
                                        }

                                        if (!empty($this->input->post('viiiNqrCoursesGroupCode')[$i])) {
                                            $viiiNqrCoursesGroupCode = implode(',', $this->input->post('viiiNqrCoursesGroupCode')[$i]);
                                        } else {
                                            $viiiNqrCoursesGroupCode = NULL;
                                        }

                                        if (!empty($this->input->post('viiiOthersCoursesGroupCode')[$i])) {
                                            $viiiOthersCoursesGroupCode = implode(',', $this->input->post('viiiOthersCoursesGroupCode')[$i]);
                                        } else {
                                            $viiiOthersCoursesGroupCode = NULL;
                                        }

                                        if (!empty($this->input->post('hsVocCourses')[$i])) {
                                            $hsVocCourses = $this->input->post('hsVocCourses')[$i];
                                        } else {
                                            $hsVocCourses = NULL;
                                        }

                                        if (!empty($this->input->post('viiiNqrCourses')[$i])) {
                                            $viiiNqrCourses = $this->input->post('viiiNqrCourses')[$i];
                                        } else {
                                            $viiiNqrCourses = NULL;
                                        }

                                        if (!empty($this->input->post('viiiOthersCourses')[$i])) {
                                            $viiiOthersCourses = $this->input->post('viiiOthersCourses')[$i];
                                        } else {
                                            $viiiOthersCourses = NULL;
                                        }

                                        $nearByVtcArray[] = array(
                                            'vtc_id_fk'              => $vtcDetailsId,
                                            'near_by_vtc_id_fk'      => $this->input->post('nearbyExistingActiveVtc')[$i],
                                            'vtc_distance'           => $this->input->post('distancebyExistingActiveVtc')[$i],
                                            'hs_voc_courses'         => $hsVocCourses,
                                            'viii_nqr_courses'       => $viiiNqrCourses,
                                            'viii_others_courses'    => $viiiOthersCourses,
                                            'hs_voc_group_code'      => $hsVocCoursesGroupCode,
                                            'viii_nqr_group_code'    => $viiiNqrCoursesGroupCode,
                                            'viii_others_group_code' => $viiiOthersCoursesGroupCode,
                                        );
                                    }

                                    $this->affiliation_model->batchInsertNearByVtc($nearByVtcArray);
                                }

                                /* $verifyData = $this->affiliation_model->checkVerifiedAcademicYear($vtcMasterId, $academic_year);
                                if (!empty($verifyData)) {

                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'You have successfully registered, please login to your account.');
                                } else { */

                                $data = array(
                                    'url' => base_url('online_app/inst/vtc/affiliation/email_verify/' . md5($vtcDetailsId))
                                );

                                $email_subject = "Email Verification";
                                // if($this->input->post('registration_for') == 1){
                                    $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/email_template_email_verification_view', $data, TRUE);
                                // }else{
                                //     $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/ins_email_template_email_verification_view', $data, TRUE);

                                // }
                                $status = send_email($this->input->post('vtcEmail'), $email_message, $email_subject);

                                if ($status) {

                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'Successfully registered, We have sent you a verification link on your VTC email. Please verify your email.');
                                } else {

                                    $url = '<a href="' . $data['url'] . '" target="_blank">Click Here</a>';

                                    $this->session->set_flashdata('status', 'success');
                                    $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Please ' . $url);
                                }
                                // }
                                redirect('online_app/inst/vtc/affiliation/registration');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                                redirect('online_app/inst/vtc/affiliation/registration');
                            }
                        }
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                        redirect('online_app/inst/vtc/affiliation/registration');
                    }
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('online_app/inst/vtc/affiliation/registration');
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/affiliation_reg_view', $data);
            // $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/institute_reg_view', $data);
        }
    }

    public function email_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $vtcDetails  = $this->affiliation_model->getVtcDetailsByIdHash($id_hash);
           // echo "<pre>";print_r($vtcDetails);exit;
            if (!empty($vtcDetails)) {
                if ($vtcDetails[0]['vtc_email_verify_status'] == 0 || $vtcDetails[0]['hoi_mobile_no_verify_status'] == 0) {        // Added by Waseem on 08-11-2021
                    
                    $result = $this->affiliation_model->checkVtcAcademicYearActive($vtcDetails[0]['vtc_id_fk'], $vtcDetails[0]['academic_year']);
                    //echo "<pre>";print_r($result);exit;
                    if (empty($result)) {

                        $mobile_otp = rand(100000, 999999);

                        $updateArray = array(
                            'hoi_mobile_otp'          => $mobile_otp,
                            'vtc_email_verify_status' => 1,
                        );
                        $status = $this->affiliation_model->updateVtcDetails($vtcDetails[0]['vtc_details_id_pk'], $updateArray);

                        if ($status) {

                            $sms_message = "Your mobile verification code for registration in VTC affiliation portal is " . $mobile_otp;
                            $template_id = 0;
                            $this->sms->send($vtcDetails[0]['hoi_mobile_no'], $sms_message, $template_id);

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Email verified successfully.');

                            redirect('online_app/inst/vtc/affiliation/mobile_verify/' . $id_hash);
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your email at this time, please try again later.');

                            redirect('online_app/inst/vtc/affiliation');
                        }
                    } else {
                        redirect(base_url());
                    }
                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function mobile_verify($id_hash = NULL)
    {
        if ($id_hash) {

            $vtcDetails  = $this->affiliation_model->getVtcDetailsByIdHash($id_hash);
            if (!empty($vtcDetails)) {

                if ($vtcDetails[0]['hoi_mobile_no_verify_status'] == 0) {

                    $data['id']     = $id_hash;
                    $data['otp']    = $vtcDetails[0]['hoi_mobile_otp'];
                    $data['mobile'] = preg_replace('~[+\d-](?=[\d-]{4})~', '*', $vtcDetails[0]['hoi_mobile_no']);

                    if ($this->input->server('REQUEST_METHOD') == 'POST') {

                        $this->load->library('form_validation');
                        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                        $config = array(
                            array(
                                'field' => 'otp',
                                'label' => 'OTP',
                                'rules' => 'trim|required|exact_length[6]|numeric',
                            )
                        );
                        $this->form_validation->set_rules($config);

                        if ($this->form_validation->run() != FALSE) {

                            $otp = $this->input->post('otp');
                            if ($otp == $data['otp']) {

                                $updateArray = array(
                                    'hoi_mobile_no_verify_status' => 1,
                                    'active_status'               => 1,
                                );
                                $status = $this->affiliation_model->updateVtcDetails($vtcDetails[0]['vtc_details_id_pk'], $updateArray);

                                if ($status) {

                                    $academic_year =  date('y') . '' . date('y', strtotime(date('Y') . "+ 1 year"));
                                    // Create VTC Credentials
                                    if($vtcDetails[0]['vtc_type'] == 1 || $vtcDetails[0]['vtc_type'] == 2){

                                        $vtc_username  = sprintf("%07d", $vtcDetails[0]['vtc_code']);
                                        $vtc_username  = 'VTC' . $academic_year . $vtc_username;

                                    }else{ //create poly ins credentials by Moli
                                        $vtc_username  = sprintf("%07s", $vtcDetails[0]['vtc_code']);
                                        $vtc_username  = 'INS' . $academic_year . $vtc_username;
                                    }
                                    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                                    $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                                    $codeAlphabet .= "0123456789";

                                    $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                                    $vtcCredentials = array(
                                        //'stake_id_fk'          => 15,
                                        'login_id'             => $vtc_username,
                                        'login_password'       => hash("sha256", $login_password),
                                        'activation_date'      => 'now()',
                                        'active_status'        => 1,
                                        'entry_time'           => 'now()',
                                        'entry_ip'             => $this->input->ip_address(),
                                        'stake_holder_details' => $vtcDetails[0]['vtc_name'],
                                        'stake_details_id_fk'  => $vtcDetails[0]['vtc_id_fk'],
                                        'base_password'        => $login_password,
                                        'base_login_id'        => $vtc_username,
                                    );
                                    if($vtcDetails[0]['vtc_type'] == 1 || $vtcDetails[0]['vtc_type'] == 2){
                                        $vtcCredentials['stake_id_fk'] = 15;
                                    }else{
                                        $vtcCredentials['stake_id_fk'] = 28;
                                    }


                                    $insertResult = $this->affiliation_model->insertVtcCredentials($vtcCredentials);
                                    if ($insertResult) {

                                        // ! Send credentials on email
                                        //$this->load->helper('email_helper');

                                        $data = array(
                                            'user_name' => $vtcCredentials['base_login_id'],
                                            'password'  => $vtcCredentials['base_password'],
                                        );

                                        $email_subject = "VTC Login Credentials";
                                        $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/email_template_id_password_view', $data, TRUE);
                                        $status = send_email($vtcDetails[0]['vtc_email'], $email_message, $email_subject);

                                        if ($status) {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Verified successfully, Login credentials sent to VTC email.');
                                        } else {

                                            $this->session->set_flashdata('status', 'success');
                                            $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Username: ' . $data['user_name'] . '<br> Password: ' . $data['password']);
                                        }

                                        redirect('online_app/inst/vtc/affiliation');
                                    } else {

                                        $this->session->set_flashdata('status', 'danger');
                                        $this->session->set_flashdata('alert_msg', 'Unable to create credentials, Please contact to council admin.');

                                        redirect('online_app/inst/vtc/affiliation');
                                    }
                                } else {

                                    $this->session->set_flashdata('status', 'danger');
                                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to verify your mobile at this time, please try again later.');

                                    redirect('online_app/inst/vtc/affiliation');
                                }
                            } else {
                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! OTP did not matched.');

                                redirect('online_app/inst/vtc/affiliation/mobile_verify/' . $id_hash);
                            }
                        }
                    }

                    $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/affiliation_mobile_verify_view', $data);
                } else {
                    redirect(base_url());
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    public function resend_otp($id_hash = NULL)
    {
        if ($id_hash) {

            $vtcDetails  = $this->affiliation_model->getVtcDetailsByIdHash($id_hash);
            if (!empty($vtcDetails)) {

                $mobile_otp = rand(100000, 999999);

                $updateArray = array(
                    'hoi_mobile_otp'          => $mobile_otp,
                    'vtc_email_verify_status' => 1,
                );
                $status = $this->affiliation_model->updateVtcDetails($vtcDetails[0]['vtc_details_id_pk'], $updateArray);

                if ($status) {

                    $sms_message = "Your mobile verification code for registration in VTC affiliation portal is " . $mobile_otp;
                    $template_id = 0;
                    $this->sms->send($vtcDetails[0]['hoi_mobile_no'], $sms_message, $template_id);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'OTP has been sent to HOI Mobile.');

                    redirect('online_app/inst/vtc/affiliation/mobile_verify/' . $id_hash);
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! We are unable to send otp.');

                    redirect('online_app/inst/vtc/affiliation');
                }
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
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

                $nodalOfficer     = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } elseif (($district_id == 682) || ($district_id == 683)) {

                $kolkataArray = array(
                    0 => $district_id, // SOUTH / NORTH KOLKATA
                    1 => 16, // KOLKATA
                );

                $district_id  = 16;

                $nodalOfficer = $this->affiliation_model->getNodalOfficerByWhereInDistrictId($kolkataArray);
            } else {

                $nodalOfficer = $this->affiliation_model->getNodalOfficerByDistrictId($district_id);
            }

            $subDivisionHtml = '<option value="" hidden="true">Select Sub Division</option>';
            $subDivision     = $this->affiliation_model->getSubDivisionByDistrictId($district_id);

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
            $municipality = $this->affiliation_model->getMunicipalityByDivisionId($sub_division_id);

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

    public function getVtcName($vtcCode = NULL) //Modify Moli On 13-01-2023
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $registration_for = $this->input->get('registration_for');

           

            $vtcDetails = $this->affiliation_model->getVtcDetailsByCode($vtcCode);
            if (!empty($vtcDetails)) {

                if ($vtcDetails[0]['vtc_affiliated_status'] == 1) {

                    echo json_encode($vtcDetails[0]['vtc_name']);
                } else {

                    echo json_encode('');
                }
            }
            

            
        }
    }

    public function getVtcName_back($vtcCode = NULL) //Modify Moli On 13-01-2023
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $registration_for = $this->input->get('registration_for');

            if($registration_for == 1){

                $vtcDetails = $this->affiliation_model->getVtcDetailsByCode($vtcCode);
                if (!empty($vtcDetails)) {

                    if ($vtcDetails[0]['vtc_affiliated_status'] == 1) {

                        echo json_encode($vtcDetails[0]['vtc_name']);
                    } else {

                        echo json_encode('');
                    }
                }
            }else{
                $instituteDetails = $this->affiliation_model->getInstituteDetailsByCode($vtcCode);

                if (!empty($instituteDetails)) {

                    echo json_encode($instituteDetails[0]['college_name']);
                }else {

                    echo json_encode('');
                }
            }

            
        }
    }

    public function getExistingVtcBlock($numberOfVtc = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $htmlData = '';

            if (($numberOfVtc != NULL) && ($numberOfVtc != '') && ($numberOfVtc > 0)) {

                $data = array(
                    'numberOfVtc'   => $numberOfVtc,
                    'vtcMasterList' => $this->affiliation_model->getVtcMasterList()
                );

                $htmlData = $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/existing_vtc_block_view', $data, TRUE);
                echo json_encode($htmlData);
            } else {
                echo json_encode($htmlData);
            }
        }
    }

    public function getVtcGroupTradeCode($vtcCourse = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if (($vtcCourse != NULL) && ($vtcCourse != '')) {
                if (($vtcCourse == 1) || ($vtcCourse == 2) || ($vtcCourse == 4)) {

                    $htmlData  = '';
                    $groupList = $this->affiliation_model->getVtcGroupTradeCode($vtcCourse);

                    if (!empty($groupList)) {

                        foreach ($groupList as $key => $group) {
                            $htmlData .= '
                                    <option value="' . $group['course_id_pk'] . '">
                                        ' . $group['group_name'] . ' (' . $group['group_code'] . ')
                                    </option>
                                ';
                        }
                    } else {

                        $htmlData = '<option value="" disabled="true">No Data found.</option>';
                    }
                } else {

                    $htmlData = '<option value="" disabled="true">No Data found.</option>';
                }
            } else {

                $htmlData = '<option value="" disabled="true">No Data found.</option>';
            }

            echo json_encode($htmlData);
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

    public function test_email()
    {
        $vtcDetailsId = 55;

        $this->load->helper('email_helper');

        $data = array(
            'url' => base_url('online_app/inst/vtc/affiliation/email_verify/' . md5($vtcDetailsId))
        );

        $email_subject = "Email Verification";
        $email_message = $this->load->view($this->config->item('theme') . 'online_app/inst/vtc/email_template_email_verification_view', $data, TRUE);
        $status = send_email("birendra.singh.5070276@gmail.com", $email_message, $email_subject);

        var_dump($status);

        echo md5(4129);
        $url = 'https://sctvesd.wb.gov.in/online_app/inst/vtc/affiliation/email_verify/7a6a6127ff85640ec69691fb0f7cb1a2';
    }

    public function test_sms()
    {
        $sms_message = "Your mobile verification code for registration in VTC affiliation portal is " . rand(1000, 9999);
        $template_id = 0;
        // $mobile = 8093855687;
        $mobile = 8910898906;
        $status = $this->sms->send($mobile, $sms_message, $template_id);

        var_dump($status);
    }
}
