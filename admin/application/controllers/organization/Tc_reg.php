<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tc_reg extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
        

        $this->load->model('affiliation/details_model');
        $this->load->model('vtc_student/student_reg_model');
        $this->load->model('organization/tc_reg_model');
        $this->load->model('organization/std_reg_model');
        //$this->output->enable_profiler();
        $this->load->helper('email');
        $this->load->library('sms');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css'
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'organization/common.js',
            3 => $this->config->item('theme_uri').'jQuery.print.min.js',
            4 => $this->config->item('theme_uri') . 'organization/tc_reg.js'
        );
    }

    public function index($offset = 0){
        $data['offset']         = $offset;
        $data['org_id'] = $this->session->userdata('stake_details_id_fk');
        $data['org_details'] = $this->std_reg_model->getOrganization_detailsById($data['org_id']);

        $this->load->library('pagination');

        $config['base_url']         = 'organization/Tc_reg/index/';
        $data["total_rows"] = $config['total_rows']       = $this->tc_reg_model->get_tc_countById($data['org_id'])[0]['count'];
        $config['per_page']         = 10;
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
        $data['tc_list'] = $this->tc_reg_model->getTCListById($data['org_id'],$config['per_page'],$offset);

        $this->load->view($this->config->item('theme') . 'organization/tc/tc_list_view',$data);
    }

    public function add_tc(){
       
        $organization_id = $this->session->userdata('stake_details_id_fk');
        $org_details = $this->tc_reg_model->getOrganizationDetails($organization_id);
        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['stateList']  = $this->student_reg_model->getAllState();
       
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            
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

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array('field' => 'tc_name','label' => 'Training Centre Name','rules' => 'trim|required'),
                array('field' => 'house_no','label' => 'House/Premise No','rules' => 'trim|required'),
                array('field' => 'address','label' => 'Street/Village/Town','rules' => 'trim|required'),
                array('field' => 'po','label' => 'Post Office','rules' => 'trim|required'),
                array('field' => 'police_station','label' => 'Police Station','rules' => 'trim|required'),
                array('field' => 'state','label' => 'State','rules' => 'trim|required'),
                array('field' => 'district','label' => 'District','rules' => 'trim|required'),

                array('field' => 'mobile','label' => 'Mobile Number','rules' => 'trim|required|exact_length[10]|numeric'),

                array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required|is_unique[council_organization_tc_details.email]'),

                array('field' => 'pinCode','label' => 'Pin Code','rules' => 'trim|required'),
                array('field' => 'lat','label' => 'Latitutde','rules' => 'trim|required'),
                array('field' => 'long','label' => 'Longitude','rules' => 'trim|required'),
                array('field' => 'spoc_name','label' => 'SPOC Name','rules' => 'trim|required'),
                array('field' => 'spoc_mobile','label' => 'SPOC Mobile No','rules' => 'trim|required|exact_length[10]|numeric'),
                array('field' => 'spoc_email','label' => 'SPOC Email ID','rules' => 'trim|required')
                
            );
            if($this->input->post('state') == 19){
                $config[] = array('field' => 'subDivision','label' => 'Sub Division','rules' => 'trim|required');

                $config[] = array('field' => 'municipality','label' => 'Municipality','rules' => 'trim|required');
            }

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'organization/tc/tc_add_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {

                $tc_code = $this->genarateTCCode($org_details['tp_code']);
                //echo "<pre>";print_r($tc_code);exit;

                $insert_array = array(
                    'tc_name' =>$this->input->post('tc_name'),
                    'organization_id_fk' => $organization_id,
                    'organization_mobile' => $org_details['mobile_no'],
                    'house_no' => $this->input->post('house_no'),
                    'street_vill_town' => $this->input->post('street_vill_town'),
                    'post_office' =>$this->input->post('po'),
                    'police_station' =>$this->input->post('police_station'),
                    'state_id_fk' =>$this->input->post('state'),
                    'district_id_fk' =>$this->input->post('district'),
                    'sub_division_id_fk' =>($this->input->post('subDivision') == NULL) ? NULL : $this->input->post('subDivision'),
                    'municipality' =>($this->input->post('municipality') == NULL) ? NULL : $this->input->post('municipality'),
                    'mobile' =>$this->input->post('mobile'),
                    'email' =>$this->input->post('email_id'),
                    'pin_code' =>$this->input->post('pinCode'),
                    'latitude' =>$this->input->post('lat'),
                    'longititude' =>$this->input->post('long'),
                    'spoc_name' =>$this->input->post('spoc_name'),
                    'spoc_mobile' =>$this->input->post('spoc_mobile'),
                    'spoc_email' =>$this->input->post('spoc_email'),
                    'fax_no' =>$this->input->post('fax_no'),
                    'web_url' =>$this->input->post('url'),
                    'landline_no' =>$this->input->post('landline_no'),
                    'tc_code'   =>$tc_code['code']
                );

                $tc_id = $this->tc_reg_model->insert_data('council_organization_tc_details',$insert_array);
                if($tc_id){
                    $data = array(
                        'url' => base_url('organization/tc_reg/email_verify/' . md5($tc_id))
                    );

                    $email_subject = "Email Verification";
                    
                    $email_message = $this->load->view($this->config->item('theme') . 'organization/tc/email_template_email_verification_view', $data, TRUE);
                    
                    $status = send_email($this->input->post('email_id'), $email_message, $email_subject);

                    if ($status) {

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, We have sent you a verification link on your TC email. Please verify email.');
                    } else {

                        $url = '<a href="' . $data['url'] . '" target="_blank">Click Here</a>';

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully registered, Currently we are unable to send you email.<br> Please ' . $url);
                    } 

                }
                redirect('admin/organization/tc_reg/add_tc');

            }
        }else{

            $this->load->view($this->config->item('theme').'organization/tc/tc_add_view',$data);
        }

    }

    public function tc_detail($tc_id_hash = NULL){

        $organization_id = $this->session->userdata('stake_details_id_fk');
        $org_details = $this->tc_reg_model->getOrganizationDetails($organization_id);
        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['stateList']  = $this->student_reg_model->getAllState();

        $data['tc_detail'] = $this->tc_reg_model->getTCDetailById($tc_id_hash);

        if ($this->input->server('REQUEST_METHOD') == 'GET') {
            $data['form_data']['tc_name'] = $data['tc_detail']['tc_name'];
            $data['form_data']['house_no'] = $data['tc_detail']['house_no'];
            $data['form_data']['street_vill_town'] = $data['tc_detail']['street_vill_town'];
            $data['form_data']['post_office'] = $data['tc_detail']['post_office'];
            $data['form_data']['police_station'] = $data['tc_detail']['police_station'];
            $data['form_data']['mobile'] = $data['tc_detail']['mobile'];
            $data['form_data']['landline_no'] = $data['tc_detail']['landline_no'];
            $data['form_data']['fax_no'] = $data['tc_detail']['fax_no'];
            $data['form_data']['email'] = $data['tc_detail']['email'];
            $data['form_data']['pin_code'] = $data['tc_detail']['pin_code'];
            $data['form_data']['web_url'] = $data['tc_detail']['web_url'];
            $data['form_data']['latitude'] = $data['tc_detail']['latitude'];
            $data['form_data']['longititude'] = $data['tc_detail']['longititude'];
            $data['form_data']['spoc_name'] = $data['tc_detail']['spoc_name'];
            $data['form_data']['spoc_mobile'] = $data['tc_detail']['spoc_mobile'];
            $data['form_data']['spoc_email'] = $data['tc_detail']['spoc_email'];

            $data['form_data']['state'] = $data['tc_detail']['state_id_fk'];
            $data['form_data']['district'] = $data['tc_detail']['district_id_fk'];
            $data['form_data']['municipality_id_fk'] = $data['tc_detail']['municipality'];

            $data['form_data']['sub_division_id_fk'] = $data['tc_detail']['sub_division_id_fk'];
            
        }else{

            $data['form_data']['tc_name'] = $this->input->post('tc_name');
            $data['form_data']['house_no'] = $this->input->post('house_no');
            $data['form_data']['street_vill_town'] = $$this->input->post('address');
            $data['form_data']['post_office'] = $this->input->post('po');
            $data['form_data']['police_station'] = $this->input->post('police_station');
            $data['form_data']['mobile'] = $this->input->post('mobile');
            $data['form_data']['landline_no'] = $this->input->post('landline_no');
            $data['form_data']['fax_no'] = $this->input->post('fax_no');
            $data['form_data']['email'] = $this->input->post('email_id');
            $data['form_data']['pin_code'] = $this->input->post('pinCode');
            $data['form_data']['web_url'] = $this->input->post('url');
            $data['form_data']['latitude'] = $this->input->post('lat');
            $data['form_data']['longititude'] = $this->input->post('long');
            $data['form_data']['spoc_name'] = $this->input->post('spoc_name');
            $data['form_data']['spoc_mobile'] = $this->input->post('spoc_mobile');
            $data['form_data']['spoc_email'] = $this->input->post('spoc_email');

            $data['form_data']['state'] = $this->input->post('state');
            $data['form_data']['district'] = $this->input->post('district');
            $data['form_data']['municipality_id_fk'] = $this->input->post('municipality');

            $data['form_data']['sub_division_id_fk'] = $this->input->post('subDivision');

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

        



        $this->load->view($this->config->item('theme').'organization/tc/tc_detail_view',$data);
        
        
    }

    public function genarateTCCode($tp_code = NULL){

        $start_code = $tp_code;
        $chaking_data = ($start_code . '_');

        //echo $chaking_data;exit;
        $check_exist_code = $this->tc_reg_model->get_last_certificate_no($chaking_data)[0];

        if ($check_exist_code['code'] == "") {
            $number = "001";
        } else {

            $code = $check_exist_code['code'];
            $cd = (int)str_pad(substr($code, -3), strlen($code));

            $cd = $cd + 1;
            $number = $cd;
            $no_of_digit = 3;
            $length = strlen((string)$number);

            for ($i = $length; $i < $no_of_digit; $i++) {
                $number = '0' . $number;
            }
            $number;
        }

        $tc_code = $chaking_data . $number;

        return array(
            
            'code' => $tp_code
        );
    }

   public function add_self_tc($org_id){
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{
            if ($org_id != NULL) {

                $org_details = $this->std_reg_model->getOrganization_detailsById($org_id);
                if($org_details){
                    $tc_code = $this->genarateTCCode($org_details['tp_code']);
                    $insert_array = array(
                        'tc_name' =>$org_details['organization_name'],
                        'organization_id_fk' => $org_id,
                        'organization_mobile' => $org_details['mobile_no'],
                        'house_no' => $org_details['house_no'],
                        'street_vill_town' => $org_details['street_vill_town'],
                        'post_office' =>$org_details['post_office'],
                        'police_station' =>$org_details['police_station'],
                        'state_id_fk' =>$org_details['state_id_fk'],
                        'district_id_fk' =>$org_details['district_id_fk'],
                        'sub_division_id_fk' =>($org_details['sub_division_id_fk'] == NULL) ? NULL : $org_details['sub_division_id_fk'],
                        'municipality' =>($org_details['municipality'] == NULL) ? NULL : $org_details['municipality'],
                        'mobile' =>$org_details['mobile_no'],
                        'email' =>$org_details['email'],
                        'pin_code' =>$org_details['pin_code'],
                        'latitude' =>$org_details['latitude'],
                        'longititude' =>$org_details['longititude'],
                        'spoc_name' =>$org_details['spoc_name'],
                        'spoc_mobile' =>$org_details['spoc_mobile'],
                        'spoc_email' =>$org_details['spoc_email'],
                        'fax_no' =>$org_details['fax_no'],
                        'web_url' =>$org_details['web_url'],
                        'landline_no' =>$org_details['landline_no'],
                        'tc_code'   =>$tc_code['code']
                    );
                    $this->db->trans_start();
                    $tc_id = $this->tc_reg_model->insert_data('council_organization_tc_details',$insert_array);
                    if($tc_id){

                        $username = $org_details['email'];
                        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                        $codeAlphabet .= "0123456789";

                        $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);
                        $tcCredentials = array(
                            'stake_id_fk'          => 36,
                            'login_id'             => $username,
                            'login_password'       => hash("sha256", $login_password),
                            'activation_date'      => 'now()',
                            'active_status'        => 1,
                            'entry_time'           => 'now()',
                            'entry_ip'             => $this->input->ip_address(),
                            'stake_holder_details' => $org_details['organization_name'],
                            'stake_details_id_fk'  => $tc_id,
                            'base_password'        => $login_password,
                            'base_login_id'        => $username  
                        );
                        


                        $insertResult = $this->tc_reg_model->insert_data('council_stake_holder_login',$tcCredentials);
                        $this->std_reg_model->update_data('council_organization_details',array('self_tc' =>1),$org_id);
                        if ($this->db->trans_status() === FALSE) {
            
                            $this->db->trans_rollback(); # Something went wrong.


                        } else {

                            $this->db->trans_commit(); # Everything is Perfect. Committing data to the database.

                            
                        }

                        $data = array(
                            'user_name' => $tcCredentials['base_login_id'],
                            'password'  => $tcCredentials['base_password'],
                        );

                        $email_subject = "TC/Institute Login Credentials";
                        $email_message = $this->load->view($this->config->item('theme') . 'organization/tc/email_template_id_password_view', $data, TRUE);
                        //$status1 = send_email($org_details['email'], $email_message, $email_subject);
                    }

                    $ajaxResponse = array(
                        'ok'  => 1,
                        'msg' => 'Success! Successfully Submited.'
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
}