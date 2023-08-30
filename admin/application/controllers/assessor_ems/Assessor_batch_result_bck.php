<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_batch_result extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(30);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('assessor_ems/assessor_batch_result_model');
        $this->load->helper('email');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css",
            2 => $this->config->item('theme_uri').'assets/css/datepicker.css',
            3 => $this->config->item('theme_uri').'assets/css/timepicker.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'assets/js/datepicker.js',
            4 => $this->config->item('theme_uri').'assets/js/timepicker.js',
            5 => $this->config->item('theme_uri').'assessor_ems/assessor_batch_result.js', 
        );

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'assessor_ems/assessor_batch_result/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->assessor_batch_result_model->getBatchCount()[0]['count'];	
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
		
        $data['page_links']  = $this->pagination->create_links();
        $data['BatchList'] = $this->assessor_batch_result_model->getAllBatch($config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'assessor_ems/assessor_result/assessor_batch_list_view', $data);
    }


    // View Batch details
    public function details( $id_hash = NULL )
    {
        $data = array(
            'batchDetails' => $this->assessor_batch_result_model->getBatchDetails($id_hash),
            'assessorList' => $this->assessor_batch_result_model->getBatchAssessorList($id_hash)
        );

         //echo'<pre>';print_r($data['assessorList']);
        
        $this->load->view($this->config->item('theme').'assessor_ems/assessor_result/assessor_batch_details_view', $data);
    }

 //Get Result
 public function getResult()
 {
     $assessor_id = $this->input->get('assessor_id');
     $batch_id = $this->input->get('batch_id');

     if($assessor_id && $batch_id)
     {
         $rawHtml     = '';
         $results = $this->assessor_batch_result_model->getAssessorResult($assessor_id,$batch_id);
         //print_r($results);

         if(count($results))
         {
             
             foreach ($results as $key => $result) 
             {
                 $rawHtml .= '
                     <tr>
                         <td>'.$result['total_question'].'</td>
                         <td>'.$result['question_attempt'].'</td>
                         <td>'.$result['correct_answer'].'</td>
                         <td>'.$result['marks'].'</td>
                     </tr>
                 ';
             }
         } else {
             $rawHtml .= '<tr><td colspan="3" align="center">No data found...</td></tr>';
         }

         echo json_encode($rawHtml);
     }
 }   

  
 //Assessor result Approve
 public function approve_assessor_result($assessor_id_hash = NULL,$batch_id_hash=NULL){

    $data['assessor_id_hash'] = $assessor_id_hash;
    $data['batch_id_hash'] = $batch_id_hash;
    //print_r($data['assessor']);
    if($this->input->method(TRUE) == "POST"){

        $assessor_id_hash= $this->input->post("assessor_id_hash");
        $batch_id_hash= $this->input->post("batch_id_hash");

        $batch_result_details = $this->assessor_batch_result_model->get_assessor_batch_result_details($assessor_id_hash,$batch_id_hash);

        //print_r($batch_result_details);

        $data['assessor'] = $this->assessor_batch_result_model->assessor_details($assessor_id_hash);
        $assessor_id = $data['assessor'][0]['assessor_registration_details_pk'];
        // $data['jobroles'] = $this->assessor_list_model->get_jobroles_apply_for_accept_reject($assessor_id_hash);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('assessor_id_hash', 'assessor', 'required|exact_length[32]');
        $this->form_validation->set_rules('batch_id_hash', 'batch', 'required|exact_length[32]');

        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {
            //$this->output->enable_profiler();
            $array = array(
                "exam_pass_fail_status"               => 1,
                "result_approve_reject_by_login_id"   => $this->session->userdata('stake_holder_login_id_pk'),
                "result_approve_reject_time"          => "now()",
                "result_approve_reject_ip"            => $this->input->ip_address()
            );
            //print_r($data['assessor']);
            $update_approve_status=$this->assessor_batch_result_model->approve_reject_result($array, $assessor_id_hash,$batch_id_hash);

            if($update_approve_status){
                if($batch_result_details[0]['batch_type']==1){
                    $batch_type=2;
                    $batch_details = $this->assessor_batch_result_model->get_batch_details($assessor_id_hash,$batch_type);
                    //print_r($batch_details);
                    if(!empty($batch_details)){
                        //echo 'insert';
                        $assessor_empanelled_array=array(
                            "assessor_id_fk"        =>$assessor_id,
                            "batch_id_fk"           =>1,
                            "sector_id_fk"          =>$batch_result_details[0]['sector_id'],
                            "course_id_fk"          =>$batch_result_details[0]['course_id'],
                            "empanelment_validity"  =>date('Y-m-d', strtotime('+2 years')),
                            "active_status"         =>1,
                            "entry_time"            =>'now()',
                            "entry_ip"              =>$this->input->ip_address(),
                            "entry_by"              =>$this->session->userdata('stake_holder_login_id_pk')
                        );
                        $insert_assessor_empanelled=$this->assessor_batch_result_model->insert_assessor_empanelled($assessor_empanelled_array);
                        $data['success']  = "success";
                        
                    }else{
                        //echo 'not insert';
                        $data['success']  = "success";
                    }
                }else{
                    $batch_type=1;
                    $batch_details = $this->assessor_batch_result_model->get_batch_details_domain($assessor_id_hash,$batch_type);
                    //print_r($batch_details);
                    if(!empty($batch_details)){
                        foreach ($batch_details as $key => $batch) {
                            //echo 'insert waseem';
                            $check_empanelled_data=$this->assessor_batch_result_model->get_empanelled_data($assessor_id,$batch['sector_id'],$batch['course_id']);
                            if($check_empanelled_data[0]['count_empanelled_course']==0){
                                $assessor_empanelled_array=array(
                                    "assessor_id_fk"        =>$assessor_id,
                                    "batch_id_fk"           =>1,
                                    "sector_id_fk"          =>$batch['sector_id'],
                                    "course_id_fk"          =>$batch['course_id'],
                                    "empanelment_validity"  =>date('Y-m-d', strtotime('+2 years')),
                                    "active_status"         =>1,
                                    "entry_time"            =>'now()',
                                    "entry_ip"              =>$this->input->ip_address(),
                                    "entry_by"              =>$this->session->userdata('stake_holder_login_id_pk')
                                );
                                $insert_assessor_empanelled=$this->assessor_batch_result_model->insert_assessor_empanelled($assessor_empanelled_array);
                                $data['success']  = "success";
                            }else{
                                //echo 'not insert waseem123';
                                $data['success']  = "success";
                            }
                        }
                    }else{
                        //echo 'not insert waseem123';
                        $data['success']  = "success";
                    }
                }
                //$email_subject = "Acceptance of application for Registration as Assessor/Expert/ Training of Trainers under WBSCTVESD";

                //$email_message = $this->load->view($this->config->item('theme').'council/assessor_approve_email_template_view',$data,TRUE);
                
                //send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);
                
                // $sms_message ="Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD is accepted. Please check your mail regularly for further details.";
                // $template_id=1107161201158836463;
                // $this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);
                //$data['success']  = "success";
            } else {
                $data['danger']  = "danger";

            }

        }
    }
    $this->load->view($this->config->item('theme').'assessor_ems/assessor_result/approve_assessor_result_ajax_view',$data);
 }


 //Reject result Approve
 public function reject_assessor_result($assessor_id_hash = NULL,$batch_id_hash=NULL){

    $data['assessor_id_hash'] = $assessor_id_hash;
    $data['batch_id_hash'] = $batch_id_hash;
    //print_r($data['assessor']);
    if($this->input->method(TRUE) == "POST"){

        $assessor_id_hash= $this->input->post("assessor_id_hash");
        $batch_id_hash= $this->input->post("batch_id_hash");
        $data['assessor_id_hash']= $this->input->post("assessor_id_hash");
        $data['batch_id_hash']= $this->input->post("batch_id_hash");

        $batch_result_details = $this->assessor_batch_result_model->get_assessor_batch_result_details($assessor_id_hash,$batch_id_hash);

        //print_r($batch_result_details);

        $data['assessor'] = $this->assessor_batch_result_model->assessor_details($assessor_id_hash);
        $assessor_id = $data['assessor'][0]['assessor_registration_details_pk'];
        // $data['jobroles'] = $this->assessor_list_model->get_jobroles_apply_for_accept_reject($assessor_id_hash);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('assessor_id_hash', 'assessor', 'required|exact_length[32]');
        $this->form_validation->set_rules('batch_id_hash', 'batch', 'required|exact_length[32]');
        $this->form_validation->set_rules('reject_reason', '<b>Reason</b>', 'required');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');

        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {
            //$this->output->enable_profiler();
            $array = array(
                "exam_pass_fail_status"               => 2,
                "result_approve_reject_by_login_id"   => $this->session->userdata('stake_holder_login_id_pk'),
                "result_approve_reject_time"          => "now()",
                "result_approve_reject_ip"            => $this->input->ip_address(),
                "result_reject_reason"                => $this->input->post("reject_reason"),
            );
            //print_r($data['assessor']);
            $update_approve_status=$this->assessor_batch_result_model->approve_reject_result($array, $assessor_id_hash,$batch_id_hash);

            if($update_approve_status){
                $data['success']  = "success";
                        
                //$email_subject = "Acceptance of application for Registration as Assessor/Expert/ Training of Trainers under WBSCTVESD";

                //$email_message = $this->load->view($this->config->item('theme').'council/assessor_approve_email_template_view',$data,TRUE);
                
                //send_email($data["assessor"][0]['email_id'],$email_message,$email_subject);
                
                // $sms_message ="Application for registration as Assessor/ Expert / Training of Trainers under WBSCTVESD is accepted. Please check your mail regularly for further details.";
                // $template_id=1107161201158836463;
                // $this->sms->send($data["assessor"][0]['mobile_no'],$sms_message,$template_id);
                //$data['success']  = "success";
            } else {
                $data['danger']  = "danger";

            }

        }
    }
    $this->load->view($this->config->item('theme').'assessor_ems/assessor_result/reject_assessor_result_ajax_view',$data);
 }

    
    
}

/* End of file Assessor_batch.php */
?>