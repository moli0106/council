<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(177);
        $this->load->model('polytechnic_master/subject_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri')."polytechnic_master/subject.js"
        );
		
    } 

    public function index($offset = 0){

        $data['offset']         = $offset;

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
		
		$config['base_url']         = 'polytechnic_master/subject/index/';
		$data["total_rows"] = $config['total_rows']       = $this->subject_model->get_all_subject_count()[0]['count'];	
		$config['per_page']         = 50;
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
        $data['subject'] = $this->subject_model->get_all_subject($config['per_page'],$offset);

        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $this->form_validation->set_rules('sub_name', '<b>Subject Name</b>', 'trim|required');
            $this->form_validation->set_rules('sub_code', '<b>Subject Code</b>', 'trim|required|callback_subject_code_check');
            if ($this->form_validation->run() == FALSE) {
                
                $this->load->view($this->config->item('theme').'polytechnic_master/subject_view',$data);
            }  else {
                $insert_data = array(
                    'subject_name' => $this->input->post('sub_name'),
                    'subject_code' => $this->input->post('sub_code'),
                    'active_status' => 1,
                    'entry_ip' => $this->input->ip_address(),
                    'entry_time' => 'now()',
                    'inserted_by' => $this->session->userdata('stake_holder_login_id_pk')
                );
                $last_id = $this->subject_model->insertData('council_qbm_subject_master',$insert_data);
                if ($last_id) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Subject added successfully.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }
                //redirect(base_url('admin/polytechnic_master/discipline'));
                $this->load->view($this->config->item('theme').'polytechnic_master/subject_view',$data);
            }
            }else{

            
                $this->load->view($this->config->item('theme').'polytechnic_master/subject_view',$data);
            }


        }
}
?>