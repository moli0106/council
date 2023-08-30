<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_profile extends NIC_Controller
{
    public function __construct(){
        parent::__construct();
        parent::check_privilege(160);
      $this->load->model('seat_filling/Std_profile_model');
    }

    public function index($std_id_hash = null){
         $data['district']=$this->Std_profile_model->district_fetch();
         $data['castes'] =  $this->Std_profile_model->get_caste();
        //  $data['data'] = $this->Std_profile_model->fetch_student($this->session->userdata('stake_details_id_fk'));
        
        $std_data = $this->Std_profile_model->fetch_student($this->session->userdata('stake_details_id_fk'));
        $data['std_data'] =$std_data;
        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            //     echo "<pre>"; 
            // print_r($data['data']);die;
            // echo "<pre>"; 
            // print_r($_POST);die;
    
            $data['formData']['ews'] = set_value('ews');
            $data['formdata']['mobile']= set_value('mobile');
            $data['formdata']['land_loser']= set_value('lnd_lser');
            $data['formdata']['gender_id_pk'] = set_value('gender');
            $data['formdata']['applied_under_tfw'] = set_value('tfw');
            $data['formdata']['handicapped'] =  set_value('handicapped');
            $data['formdata']['wards_of_exserviceman'] =  set_value('ex_service');
            $data['formdata']['caste_id_fk'] = set_value('category');
            $data['formdata']['kanyashree'] =  set_value('kanyashree_status');
            $data['formdata']['caste_issue_in'] =  set_value('caste_issue_in');
            $data['formdata']['guardian_name'] =  set_value('guardian_name');
            $data['formdata']['school_district'] = set_value('school_district');

        }else{
            $data['formdata']['ews'] = $std_data[0]['ews'];
            $data['formdata']['mobile'] = $std_data[0]['mobile_number'];
            $data['formdata']['land_loser'] = $std_data[0]['land_loser'];
            $data['formdata']['gender_id_pk'] = $std_data[0]['gender_id_fk'];
            $data['formdata']['applied_under_tfw'] = $std_data[0]['applied_under_tfw'];
            $data['formdata']['handicapped'] = $std_data[0]['handicapped'];
            $data['formdata']['wards_of_exserviceman'] = $std_data[0]['wards_of_exserviceman'];
            $data['formdata']['caste_id_fk'] = $std_data[0]['caste_id_fk'];
            $data['formdata']['kanyashree'] = $std_data[0]['kanyashree'];
            $data['formdata']['caste_issue_in'] = $std_data[0]['caste_issue_in'];
            $data['formdata']['guardian_name'] = $std_data[0]['guardian_name'];
            $data['formdata']['school_district'] = $std_data[0]['school_district'];

        }
        // echo "<pre>"; 
        // print_r($data['std_data']);die;

        
        if($data['std_data'][0]['counselling_updated_status'] !=1){
            $this->load->view($this->config->item('theme') . 'student_profile/std_profile_view',$data);
        }else{
            redirect('admin/student_profile/std_profile/view_details');
        }
        
       
    }

    public function update_details($std_id_hash){
        // echo "<pre>"; 
        // print_r($_POST);

        $data['district']=$this->Std_profile_model->district_fetch();
        $data['castes'] =  $this->Std_profile_model->get_caste();
        $std_data = $this->Std_profile_model->fetch_student($this->session->userdata('stake_details_id_fk'));
        $data['std_data'] =$std_data;
        if ($this->input->server("REQUEST_METHOD") == 'POST') {
            //     echo "<pre>"; 
            // print_r($data['std_data']);die;
            // echo "<pre>"; 
            // print_r($_POST);die;
    
            $data['formData']['ews'] = set_value('ews');
            $data['formdata']['mobile']= set_value('mobile');
            $data['formdata']['land_loser']= set_value('lnd_lser');
            $data['formdata']['gender_id_pk'] = set_value('gender');
            $data['formdata']['applied_under_tfw'] = set_value('tfw');
            $data['formdata']['handicapped'] =  set_value('handicapped');
            $data['formdata']['wards_of_exserviceman'] =  set_value('ex_service');
            $data['formdata']['caste_id_fk'] = set_value('category');
            $data['formdata']['kanyashree'] =  set_value('kanyashree_status');
            $data['formdata']['caste_issue_in'] =  set_value('caste_issue_in');
            $data['formdata']['guardian_name'] =  set_value('guardian_name');
            $data['formdata']['school_district'] = set_value('school_district');

        }else{
            $data['formdata']['ews'] = $std_data[0]['ews'];
            $data['formdata']['mobile'] = $std_data[0]['mobile_number'];
            $data['formdata']['land_loser'] = $std_data[0]['land_loser'];
            $data['formdata']['gender_id_pk'] = $std_data[0]['gender_id_fk'];
            $data['formdata']['applied_under_tfw'] = $std_data[0]['applied_under_tfw'];
            $data['formdata']['handicapped'] = $std_data[0]['handicapped'];
            $data['formdata']['wards_of_exserviceman'] = $std_data[0]['wards_of_exserviceman'];
            $data['formdata']['caste_id_fk'] = $std_data[0]['caste_id_fk'];
            $data['formdata']['kanyashree'] = $std_data[0]['kanyashree'];
            $data['formdata']['caste_issue_in'] = $std_data[0]['caste_issue_in'];
            $data['formdata']['guardian_name'] = $std_data[0]['guardian_name'];
            $data['formdata']['school_district'] = $std_data[0]['school_district'];

        }

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

           
            
            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $config = array(
                array(
                    'field' => 'ews',
                    'label' => 'EWS',
                    'rules' => 'trim|required',
                    
                ),
                array('field' => 'mobile','label' => 'Mobile Number','rules' => 'trim|required'),

                array('field' => 'lnd_lser','label' => 'Land Loser','rules' => 'trim|required'),
                array('field' => 'gender','label' => 'TFW','rules' => 'trim|required'),
                array('field' => 'tfw','label' => 'Land Loser','rules' => 'trim|required'),
                array('field' => 'handicapped','label' => 'Physically Challenged','rules' => 'trim|required'),

                array('field' => 'ex_service','label' => 'Ward of Ex-serviceman','rules' => 'trim|required'),
                array('field' => 'kanyashree_status','label' => 'Physically Challenged','rules' => 'trim|required'),
                array('field' => 'caste_issue_in','label' => 'Kanyashree Status','rules' => 'trim|required'),
                array('field' => 'guardian_name','label' => 'Guardian Name','rules' => 'trim|required'),
                array('field' => 'school_district','label' => 'Kanyashree Status','rules' => 'trim|required')
            );
            $this->form_validation->set_rules($config);
            if ($this->form_validation->run() == FALSE) {
                //  echo "hii";die;
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'oops! something went wrong , Validation Error.');
                $this->load->view($this->config->item('theme') . 'student_profile/std_profile_view',$data);
            } else{
                
                $upd_data = array(
                    'guardian_name' => $this->input->post('guardian_name'),
                    'mobile_number' => $this->input->post('mobile'),
                    'ews' => $this->input->post('ews'),
                    'land_looser' => $this->input->post('lnd_lser'),
                    'gender_id_fk' => $this->input->post('gender'),
                    'applied_under_tfw' => $this->input->post('tfw'),
                    'handicapped' => $this->input->post('handicapped'),
                    'wards_of_exserviceman' => $this->input->post('ex_service'),
                    'school_district' => $this->input->post('school_district'),
                    'caste_issue_state_in' => $this->input->post('caste_issue_in'),
                    'kanyashree' => $this->input->post('kanyashree_status'),
                    'counselling_updated_status' => 1
                    
                );
                //echo $data['std_data']['student_details_id_pk'];exit;
                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction
                $status = $this->Std_profile_model->update_details($upd_data,$data['std_data'][0]['student_details_id_pk']);
                if($status){
                    $this->Std_profile_model->update_login_details(array('mobile_no'=>$upd_data['mobile_number']),$data['std_data'][0]['index_number']);
                     // ! Check All Query For Trainee
                     if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to update, Please try after sometime.');
                        $this->load->view($this->config->item('theme') . 'student_profile/std_profile_view',$data);
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Successfully updated.');
                        redirect('admin/student_profile/std_profile/view_details');
                    }
                }
            }

        }else{

            $this->load->view($this->config->item('theme') . 'student_profile/std_profile_view',$data);
        }

    }

    public function view_details(){
        $std_id = $this->session->userdata('stake_details_id_fk');
        $data['std_data'] = $this->Std_profile_model->fetch_student($std_id)[0];
        //echo "<pre>";print_r($std_data);exit;
        $this->load->view($this->config->item('theme') . 'student_profile/Student_council_main_page',$data);
    }
} 