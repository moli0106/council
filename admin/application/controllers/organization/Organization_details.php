<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Organization_details extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
       
        $this->load->model('organization/std_reg_model');
        $this->load->model('affiliation/details_model');
        $this->load->model('vtc_student/student_reg_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            0 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            1 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            2 => $this->config->item('theme_uri') . 'organization/student_reg.js',
            3 => $this->config->item('theme_uri') . 'organization/common.js',
        );
    }

    public function index(){
        $data['id'] = $this->session->userdata('stake_details_id_fk');
        $data['org_details'] = $this->std_reg_model->getOrganization_detailsById($data['id']);

        $data['districtList']  = $this->student_reg_model->getDistrictList();
        $data['stateList']  = $this->student_reg_model->getAllState();
        //echo "<pre>";print_r($data['org_details']);exit;

        if ($this->input->server('REQUEST_METHOD') == 'GET') {

            $data['form_data']['oath_name'] = $data['org_details']['othorization_person'];
            $data['form_data']['house_no'] = $data['org_details']['house_no'];
            $data['form_data']['street_vill_town'] = $data['org_details']['street_vill_town'];
            $data['form_data']['post_office'] = $data['org_details']['post_office'];
            $data['form_data']['police_station'] = $data['org_details']['police_station'];
            $data['form_data']['mobile'] = $data['org_details']['mobile_no'];
            $data['form_data']['landline_no'] = $data['org_details']['landline_no'];
            $data['form_data']['fax_no'] = $data['org_details']['fax_no'];
            $data['form_data']['email'] = $data['org_details']['email'];
            $data['form_data']['pin_code'] = $data['org_details']['pin_code'];
            $data['form_data']['web_url'] = $data['org_details']['web_url'];
            $data['form_data']['latitude'] = $data['org_details']['latitude'];
            $data['form_data']['longititude'] = $data['org_details']['longititude'];
            $data['form_data']['spoc_name'] = $data['org_details']['spoc_name'];
            $data['form_data']['spoc_mobile'] = $data['org_details']['spoc_mobile'];
            $data['form_data']['spoc_email'] = $data['org_details']['spoc_email'];

            $data['form_data']['state'] = $data['org_details']['state_id_fk'];
            $data['form_data']['district'] = $data['org_details']['district_id_fk'];
            $data['form_data']['municipality_id_fk'] = $data['org_details']['municipality'];

            $data['form_data']['sub_division_id_fk'] = $data['org_details']['sub_division_id_fk'];
        }else{

            $data['form_data']['oath_name'] = $this->input->post('oth_person');
            $data['form_data']['house_no'] = $this->input->post('house_no');
            $data['form_data']['street_vill_town'] = $this->input->post('street_vill_town');
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


        if ($this->input->server('REQUEST_METHOD') == 'POST') {
           
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

            $config = array(
                array('field' => 'oth_person','label' => 'Othorize Person','rules' => 'trim|required'),
                array('field' => 'house_no','label' => 'House/Premise No','rules' => 'trim|required'),
                array('field' => 'street_vill_town','label' => 'Street/Village/Town','rules' => 'trim|required'),
                array('field' => 'po','label' => 'Post Office','rules' => 'trim|required'),
                array('field' => 'police_station','label' => 'Police Station','rules' => 'trim|required'),
                array('field' => 'state','label' => 'State','rules' => 'trim|required'),
                array('field' => 'district','label' => 'District','rules' => 'trim|required'),

                array('field' => 'mobile','label' => 'Mobile Number','rules' => 'trim|required|exact_length[10]|numeric'),

                array('field' => 'email_id','label' => 'Email ID','rules' => 'trim|required'),

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

                $this->load->view($this->config->item('theme') . 'organization/basic_details/organization_detail_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {

               
                $year = date("Y"); 
                $insert_array = array(
                    
                    'othorization_person' => $this->input->post('oth_person'),
                    'house_no' => $this->input->post('house_no'),
                    'street_vill_town' => $this->input->post('street_vill_town'),
                    'post_office' =>$this->input->post('po'),
                    'police_station' =>$this->input->post('police_station'),
                    'state_id_fk' =>$this->input->post('state'),
                    'district_id_fk' =>$this->input->post('district'),
                    'sub_division_id_fk' =>($this->input->post('subDivision') == NULL) ? NULL : $this->input->post('subDivision'),
                    'municipality' =>($this->input->post('municipality') == NULL) ? NULL : $this->input->post('municipality'),
                    'mobile_no' =>$this->input->post('mobile'),
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
                    'tp_code'   =>$year.'_'.$data['org_details']['vertical_code'],
                    'updated_time' => 'now()'
                );

                $status = $this->std_reg_model->update_data('council_organization_details',$insert_array,$data['id']);
                if($status){
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Details Successfully updated.');

                       

                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'unable to updated Please try again later ');
                
                }
                redirect('admin/organization/organization_details');

            }
        }else{

        $this->load->view($this->config->item('theme') . 'organization/basic_details/organization_detail_view',$data);
        }

    }
}