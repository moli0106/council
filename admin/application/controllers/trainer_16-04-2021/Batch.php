<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(25);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('trainer/batch_model');
        $this->load->model('question/add_question_model');

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            5 => $this->config->item('theme_uri').'trainer/batch.js', 
        );

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $trainer_id = $this->session->userdata('stake_details_id_fk');

        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'trainer/batch/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->batch_model->getBatchCount($trainer_id)[0]['count'];	
		$config['per_page']         = 10;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin">';
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
		
        $data['page_links'] = $this->pagination->create_links();
        $data['batchList']  = $this->batch_model->getAllBatch($trainer_id, $config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'trainer/batch_list_view', $data);
    }

    public function assessor_list($batch_id = NULL)
    {
        $this->load->helper('form');

        $data['assessorList'] = $this->batch_model->getBatchAssessorList($batch_id);
        $data['batchDetails'] = $this->batch_model->getBatchDetails($batch_id);

        $this->load->view($this->config->item('theme').'trainer/assessor_list_view', $data);
    }

    public function eligibleForAssessment()
    {
        if($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $map_id   = $this->input->post("map_id");
            $batch_id = $this->input->post("batch_id");

            if(isset($map_id)) {

                $notEligible = $this->batch_model->getAssessorIdInBatch($batch_id, $map_id);
                if(count($notEligible)) {

                    $notEligibleMapId = array();
                    foreach ($notEligible as $key => $value) 
                    {
                        $notEligibleMapId[] = $value['batch_assessor_map_id_pk'];
                    }

                    $updateArray = array('eligibility' => 0);
                    $this->batch_model->updateAssessorEligibility($batch_id, $notEligibleMapId, $updateArray);    
                }

                $updateArray = array('eligibility' => 1);
                $result      = $this->batch_model->updateAssessorEligibility($batch_id, $map_id, $updateArray);
                
                if($result) 
                {
                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Eligible Assessor added.');

                    redirect('admin/trainer/batch/assessor_list/'.md5($batch_id),'refresh');

                } 
                else 
                {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/trainer/batch/assessor_list/'.md5($batch_id),'refresh');
                }
                
            } else {
                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Please select Assessor from the list.');

                redirect('admin/trainer/batch/assessor_list/'.md5($batch_id),'refresh');
            }

        } else {
            redirect('admin/trainer/batch','refresh');
        }

    }

    public function assign_question($id_hash = NULL)
    {
        $data = array(
            'programmes'             => $this->add_question_model->get_programmes_query(),
            'levels'                 => $this->add_question_model->get_levels_query(),
            'questions_type'         => $this->add_question_model->get_questions_type_query(),
            'questions_for'          => $this->add_question_model->get_questions_for_query(),
            'modules'                => $this->add_question_model->get_questions_module_query(),
            'questions_type_trainee' => $this->add_question_model->get_questions_type_trainee_query(),
        );

        $this->load->view($this->config->item('theme').'trainer/batch_wise_question_assign', $data);
    }

    public function add_question()
    {
        if($this->input->server("REQUEST_METHO") == "POST")
        {
            echo'<pre>';print_r($_POST);exit();
        }
        else
        {
            echo'GET METHOD';
        }
    }

}
?>