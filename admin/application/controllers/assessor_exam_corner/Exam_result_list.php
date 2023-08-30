<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exam_result_list extends NIC_Controller
{
	public function __construct()
	{
		parent::__construct();
		parent::check_privilege(25);
		/*
			loading model
		*/
		$this->load->model("common/Master_model");
		$this->load->model("online_exam_corner/exam_result_list_model");
		//$this->output->enable_profiler(TRUE);
    }
    
    /*  
        Test screen module...
    */ 
	


	public function index() {
		
            
            $data['page_links'] = NULL;
		//print_r($data['processess']);
		//print_r($_POST);
		//$this->output->enable_profiler();
   
                /*
		$this->load->library('pagination');
		
                $config['base_url']         = 'finance/trainee_payment_file_list/index';
                $config['total_rows']       = $this->exam_result_list_model->get_result_list_count()[0]['count'];
                $config['per_page']         = 40;
                $config['num_links']        = 3;
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
                $data['result_list'] 		= $this->exam_result_list_model->get_result_list($config['per_page'],$offset);
                $data['page_links']     = $this->pagination->create_links();
                
                //$data['offset']         = $offset;
                // echo '<pre>';
                // print_r($data['centers']);
                // echo '</pre>';
                // } else {

                // 	$this->load->library('form_validation');
                // 	$this->form_validation->set_rules('sanction_ordeer_no', 'Sanction ordeer No.', 'trim|integer');
                // 	$this->form_validation->set_rules('xml_filename', 'XML File Name', 'trim|alpha_numeric');
                // 	$this->form_validation->set_rules('generate_date', 'Sanction Order Number Generate Date', 'trim|callback_check_date');
                // 	$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

                // 	if ($this->form_validation->run() == TRUE){
                // 			$data['centers'] 		= $this->trainee_payment_file_list_model->search_get_trainee_payment_file_list_district_wise($this->input->post('sanction_ordeer_no'),$this->input->post('xml_filename'),$this->input->post('generate_date'));
                // 	} 
                // 	else {
                // 		$data['centers'] = array();
                // 	}
                // }
              //  $data['offset']         = $offset;
                 * 
                 */

                $data['result_list'] 		= $this->exam_result_list_model->get_result_list();
                
               /* print"<pre>";
                    print_r($data['result_list']);
                print"</pre>"; */
                
                $this->load->view($this->config->item('theme').'online_exam_corner/exam_result_list_view.php', $data);
	}
}
