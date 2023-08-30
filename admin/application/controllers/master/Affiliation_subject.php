<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_subject extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(120);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('master/affiliation_subject_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'master/affiliation_course.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
    }

    public function index($offset = 0){

        $data['offset'] = $offset;

        $data['subject'] = $this->affiliation_subject_model->getAllSubjectList();

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            

            $config = array(
                array(
                    'field' => 'subject_name',
                    'label' => 'Subject Name',
                    'rules' => 'trim|required|max_length[200]'
                    
                ),
                array(
                    'field' => 'subject_code',
                    'label' => 'Subject code',
                    // 'rules' => 'trim|required|max_length[200]|is_unique[council_affiliation_subject_master.subject_code]'
                    'rules' => 'trim|required|max_length[200]|callback_subject_code_check'
                    
                )
                
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme') . 'master/affiliation_subject/subject_view',$data);
            } else {

                $post_data = array(
                    'subject_name'  => $this->input->post('subject_name'),
                    'subject_code'  => $this->input->post('subject_code'),
                    'entry_ip'                  => $this->input->ip_address(),
                    'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                => 'now()',                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            
                );

                $last_id = $this->affiliation_subject_model->insertData('council_affiliation_subject_master',$post_data);
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Subject added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/master/affiliation_subject'));
            }


           
        }else{

            $this->load->view($this->config->item('theme') . 'master/affiliation_subject/subject_view',$data);
        }

    }

    public function subject_code_check(){
        $subject_code = $this->input->post('subject_code');

        if($subject_code !=''){

            $code_count = $this->affiliation_subject_model->get_same_subject_code($subject_code);

            if($code_count['count'] == 0){
                return TRUE;
            } else {
                $this->form_validation->set_message('subject_code_check', 'The Subject code field must contain a unique value. ');
                return FALSE;
            }
        }
    }

    public function removeSubject(){

        if(!$this->input->is_ajax_request()){
            exit('No direct script access allowed');
        }else{

            $id_hash = $this->input->get('id_hash');
            if (!empty($id_hash)) {

               
                $this->affiliation_subject_model->updateSubjectData($id_hash, array('active_status' => 0));
                echo json_encode('Done');
            }
        }
    }




    // ************ Developed By Abhijit 03-01-2023// 04-01-2023 ********************//

    public function affiliation_subject_type_details($id_hash = NULL)
    {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{
            if(!empty($id_hash)) {

                $data['subject_type'] = $this->affiliation_subject_model->getSubjectType_deta();
                //  echo "<pre>";print_r($data['subject_type']);exit;
                $data['subject_typeDetails'] = $this->affiliation_subject_model->getSubjectType($id_hash);

                //  echo "<pre>";print_r($data['subject_typeDetails']);exit;

                $html_view = $this->load->view($this->config->item('theme') . 'master/affiliation_subject/ajax_view/subject_type_details_view', $data, TRUE);
                echo json_encode($html_view);
            }
        }
    }


    public function updateSubjectType($subject_id_hash = NUll)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if(!empty($subject_id_hash)) {

                $updateArray = array(
                    'subject_type_id_fk'  => $this->input->post('subjecttype'),
                
                );

                $updateItem = $this->affiliation_subject_model->updatesubjectTypeMaster($subject_id_hash, $updateArray);
                if ($updateItem) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Affiliation Subject Type updated successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/master/affiliation_subject'));

            }

        }
    }

    public function getsublist()
    {
        $sub = $this->input->get('sub');
       
        $subject_list = $this->affiliation_subject_model->getautocomp_subject_data($sub);
        //echo '<pre>';print_r($subject_list); die;
        
        $cart= array();
        foreach ($subject_list as $key => $val){
            
            array_push($cart , $val['subject_name'].','.'('.$val['subject_code'].')');
        }
                    
            echo json_encode($cart);
        
    }

    public function add_full_subject()
    {

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            

            $config = array(
                array(
                    'field' => 'full_sub_name',
                    'label' => 'Full Subject Name',
                    'rules' => 'trim|required|max_length[200]'
                    
                ),
                array(
                    'field' => 'full_sub_code',
                    'label' => 'Full Subject code',
                    'rules' => 'trim|required|max_length[200]|callback_subject_code_check'
                    // 'rules' => 'trim|required'
                    
                ),
                array(
                    'field' => 'subject1',
                    'label' => 'Parent Subject1',
                    'rules' => 'trim|required'
                    
                ),
                array(
                    'field' => 'subject2',
                    'label' => 'Parent Subject2',
                    'rules' => 'trim|required'
                    
                )
                
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                

                $this->load->view($this->config->item('theme') . 'master/affiliation_subject/create_fullsubject_view',$data);
            } else {

                $postsubjectcode_data = array(

                    'par_subject_code1'  => str_replace(array( '(', ')' ), '',$this->input->post('subject1_code')),
                    'par_subject_code2'  => str_replace(array( '(', ')' ), '',$this->input->post('subject2_code'))

                );

                
                $data['get_subject_id'] = $this->affiliation_subject_model->get_subject_id($postsubjectcode_data);
                //  echo '<pre>';print_r($data['get_subject_id']); die;

               
                $sub1 = $data['get_subject_id'];

                $post_data = array(
                    'subject_name'  => $this->input->post('full_sub_name'),
                    'subject_code'  => $this->input->post('full_sub_code'),
                    'parent_subject1'  => $sub1 [0]['subject_name_id_pk'],
                    'parent_subject2'  =>$sub1 [1]['subject_name_id_pk'],
                    'subject_type_id_fk'  => 2,
                    'entry_ip'                  => $this->input->ip_address(),
                    'entry_by'               => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                => 'now()'                                                                                                                                           
                );

              // echo '<pre>';print_r($post_data); 

                $last_id = $this->affiliation_subject_model->insertsdata($post_data);
                // echo '</pre>';print_r($last_id['abc']);die;
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Full Subject added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/master/affiliation_subject'));
            }


           
        }else{

            $this->load->view($this->config->item('theme') . 'master/affiliation_subject/create_fullsubject_view');
         }

    }

    // ************************ End Code *****//



    public function open_full_subject_create_form()
    {
        if(!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }else{

            $html_view = $this->load->view($this->config->item('theme') . 'master/affiliation_subject/ajax_view/create_fullsubject_view', $data, TRUE);
            echo json_encode($html_view);
        }
    }
}
