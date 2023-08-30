<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_details extends NIC_Controller
{
    function __construct()
    {
        parent::__construct();
        parent::check_privilege();
       
        $this->load->model('organization/std_reg_model');
        $this->load->model('vtc_student/student_reg_model');
        $this->load->model('vtc_student/student_model');
        $this->load->model('organization/tc_reg_model');

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
        $data['sectorList']  = $this->student_model->getSectorList();
        $data['stake_id_fk'] = $this->session->userdata('stake_id_fk');
        $data['stake_details_id_fk'] = $this->session->userdata('stake_details_id_fk');
        $data['tc_detail'] = $this->tc_reg_model->getTCDetailById(md5($data['stake_details_id_fk']));
        $data['TcCourseList']  = $this->tc_reg_model->getTcAllCourseList($data['stake_details_id_fk']);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            $config = array(
                array('field' => 'stdSector','label' => 'Sector','rules' => 'trim|required'),
                array('field' => 'stdCourse','label' => 'Course','rules' => 'trim|required')
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'organization/tc/courses_view',$data);
                // redirect('admin/affiliation/courses/add');
            } else {
                $data_array = array(
                    'sector_id_fk' => $this->input->post('stdSector'),
                    'course_id_fk' => $this->input->post('stdCourse'),
                    'tc_id_fk' => $data['stake_details_id_fk'],
                    'organization_id_fk' =>$data['tc_detail']['organization_id_fk'],
                    'entry_time' => 'now()'
                );
                $status = $this->tc_reg_model->insert_data('council_organization_tc_course_details',$data_array);
                if(!empty($status)){
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Successfully course added');
                    
                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Unable to add course');
                }

                redirect('/admin/organization/course_details');


            }
        }else{

            $this->load->view($this->config->item('theme') . 'organization/tc/courses_view', $data);
        }
    }
}
?>