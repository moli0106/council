<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TC_details extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
       
        $this->load->model('organization/std_reg_model');
        $this->load->model('organization/tc_reg_model');
        $this->load->model('vtc_student/student_reg_model');
        $this->load->model('affiliation/details_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'organization/student_reg.js',
        );
    }

    public function index(){
        $data['tc_id'] = $this->session->userdata('stake_details_id_fk');
       
        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['stateList']  = $this->student_reg_model->getAllState();

        $data['tc_detail'] = $this->tc_reg_model->getTCDetailById(md5($data['tc_id']));
        $org_details = $this->tc_reg_model->getOrganizationDetails($data['tc_detail']['organization_id_fk']);

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
}