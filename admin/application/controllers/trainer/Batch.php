 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Batch extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(25);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('trainer/batch_model');
		$this->load->helper('email');

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

        foreach ($data['assessorList'] as $key => $value) {

            $data['con_eval_marks'][$value['assessor_id_fk']]  = $value['con_eval_marks'];
            $data['trainee_attends'][$value['assessor_id_fk']] = $value['trainee_attends'];
        }

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'trainer/assessor_list_view', $data);
    }

    public function eligibleForAssessment_old()
    {
        if($this->input->server('REQUEST_METHOD') == 'POST')
        {
            $map_id   = $this->input->post("map_id");
            $batch_id = $this->input->post("batch_id");

            if(isset($map_id) && !empty($map_id)) {

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
	
	public function eligibleForAssessment()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            if (isset($_POST['UpdateEvaluationMarks']) && !empty($_POST['UpdateEvaluationMarks'])) {

                $batch_id_hash = $this->input->post('batch_id_hash');
                if (!empty($batch_id_hash)) {

                    $data['assessorList'] = $this->batch_model->getBatchAssessorList($batch_id_hash);
                    $data['batchDetails'] = $this->batch_model->getBatchDetails($batch_id_hash);

                    if (!empty($data['batchDetails'])) {

                        foreach ($data['assessorList'] as $key => $value) {

                            $data['con_eval_marks'][$value['assessor_id_fk']]  = set_value('con_eval_marks[' . $value['assessor_id_fk'] . ']');
                            $data['trainee_attends'][$value['assessor_id_fk']] = set_value('trainee_attends[' . $value['assessor_id_fk'] . ']');
                        }

                        $this->load->library('form_validation');
                        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

                        $con_eval_marks  = $this->input->post('con_eval_marks');
                        $trainee_attends = $this->input->post('trainee_attends');

                        if (($con_eval_marks != '' && count($con_eval_marks) > 0) && ($trainee_attends != '' && count($trainee_attends) > 0)) {

                            foreach ($con_eval_marks as $key => $value) {

                                $config = array(
                                    array(
                                        'field'     => 'con_eval_marks[' . $key . ']',
                                        'label'     => '<b>Continuous Evaluation Marks</b>',
                                        'rules'     => 'trim|required|numeric|less_than_equal_to[50]|regex_match[/^\d*\.?\d*$/]',
                                    ),
                                    array(
                                        'field'     => 'trainee_attends[' . $key . ']',
                                        'label'     => '<b>No. Days Trainee Attends</b>',
                                        'rules'     => 'trim|required|numeric|regex_match[/^\d*\.?\d*$/]',
                                    )
                                );

                                $this->form_validation->set_rules($config);
                            }

                            if ($this->form_validation->run() == FALSE) {

                                $this->load->view($this->config->item('theme') . 'trainer/assessor_list_view', $data);
                            } else {

                                foreach ($con_eval_marks as $key => $value) {

                                    $updateArray = array(
                                        'con_eval_marks'  => $value,
                                        'trainee_attends' => $trainee_attends[$key],
                                        'assessor_id_fk'  => $key
                                    );

                                    $assessor_id_fk = $key;

                                    $this->batch_model->update_con_eval_marks_and_trainee_attends($batch_id_hash, $assessor_id_fk, $updateArray);
                                }
                                $this->batch_model->update_eval_marks_status($batch_id_hash, array('eval_marks_status' => 1));

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'Data updated successfully.');

                                redirect('admin/trainer/batch/assessor_list/' . $batch_id_hash, 'refresh');
                            }
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Data not found.');

                            redirect('admin/trainer/batch/assessor_list/' . $batch_id_hash, 'refresh');
                        }
                    } else {
                        redirect('admin/trainer/batch', 'refresh');
                    }
                } else {
                    redirect('admin/trainer/batch', 'refresh');
                }
            } else {

                $map_id   = $this->input->post("map_id");
                $batch_id_hash = $this->input->post("batch_id_hash");

                if (isset($map_id) && !empty($map_id)) {

                    $notEligible = $this->batch_model->getAssessorIdInBatch($batch_id_hash, $map_id);
                    if (count($notEligible)) {

                        $notEligibleMapId = array();
                        foreach ($notEligible as $key => $value) {
                            $notEligibleMapId[] = $value['batch_assessor_map_id_pk'];
                        }

                        $updateArray = array('eligibility' => 0);
                        $this->batch_model->updateAssessorEligibility($batch_id_hash, $notEligibleMapId, $updateArray);
                    }

                    $updateArray = array('eligibility' => 1);
                    $result      = $this->batch_model->updateAssessorEligibility($batch_id_hash, $map_id, $updateArray);

                    if ($result) {
                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Eligible Assessor added.');

                        redirect('admin/trainer/batch/assessor_list/' . $batch_id_hash, 'refresh');
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                        redirect('admin/trainer/batch/assessor_list/' . $batch_id_hash, 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Please select Assessor from the list.');

                    redirect('admin/trainer/batch/assessor_list/' . $batch_id_hash, 'refresh');
                }
            }
        } else {
            redirect('admin/trainer/batch', 'refresh');
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
	
	
	public function add_question_old()
    {
        // Get required data
        $id_hash      = $this->uri->segment(4);
        $batchDetails = $this->batch_model->getBatchDetails($id_hash);
        //print_r($batchDetails);
        // Create logic for question module
        $dataArray = array(
            'question_type_id'     	=> $batchDetails[0]['batch_type'], // 1 = Domain, 2 = Platform
            'question_for_id'      	=> 2, // 1 = Trainee, 2 = Assessor
            'active_status'        	=> 1,
            'process_status_id_fk' 	=> 5,
			'question_pattern'		=> 1,	// Added by Waseem on 09-11-2021
        );
        if($batchDetails[0]['batch_type'] == 1)
        {
            $dataArray['course_id'] = $batchDetails[0]['course_id'];
            $dataArray['sector_id'] = $batchDetails[0]['sector_id'];
        }

        // Get question module
        $moduleList  = $this->batch_model->getQuestionModule($dataArray);
        $numOfModule = count($moduleList);
		
        if($numOfModule)
        {
            // Assign mandatory data
            $numOfQuestion = 50; $basicLavel = 80; $advanceLavel = 20; $flagBasicQuestion = $flagAdvanceQuestion = 0;

            // Number of question (quotient) in a module
            $quotient  = intval($numOfQuestion / $numOfModule);
            $remainder = intval($numOfQuestion % $numOfModule);

            // Number of basic & advance question in a module
            $numOfBasicQuestion   = round( ($quotient * $basicLavel) / 100 );
            $numOfAdvanceQuestion = round( ($quotient * $advanceLavel) / 100 );
            
			echo $totalNumberOfBasicQuestion   = $numOfModule * $numOfBasicQuestion;
            echo $totalNumberOfAdvanceQuestion = $numOfModule * $numOfAdvanceQuestion;
			die;
            $basicQuestion = $advanceQuestion = array();
            // Get question from each module
            foreach ($moduleList as $key1 => $module) 
            {
                $dataArray['module_id'] = $module['module_id'];

                // Get basic question from the module
                $dataArray['level_id']  = 1;
                $basicQuestionList  = $this->batch_model->getQuestionList($dataArray);
                $countBasicQuestion[] = count($basicQuestionList);
                // Get advance question from the module
                $dataArray['level_id']  = 2;
                $advanceQuestionList  = $this->batch_model->getQuestionList($dataArray);
                $countAdvanceQuestion[] = count($advanceQuestionList);

                // Basic question logic
                shuffle($basicQuestionList);
                $totalBasicQuestion = ($flagBasicQuestion + $numOfBasicQuestion);
                if($countBasicQuestion >= $totalBasicQuestion)
                {
                    $flagBasicQuestion = 0;
                    $basicQuestionList = array_slice($basicQuestionList, 0, $totalBasicQuestion);
                }
                else{
                    $flagBasicQuestion = abs($countBasicQuestion - $totalBasicQuestion);
                }

                // Advance question logic
                shuffle($advanceQuestionList);
                $totalAdvanceQuestion = ($flagAdvanceQuestion + $numOfAdvanceQuestion);
                if($countAdvanceQuestion >= $totalAdvanceQuestion)
                {
                    $flagAdvanceQuestion = 0;
                    $advanceQuestionList = array_slice($advanceQuestionList, 0, $totalAdvanceQuestion);
                }
                else
                {
                    $flagAdvanceQuestion = abs($countAdvanceQuestion - $totalAdvanceQuestion);
                }

				$basicQuestionList = array_filter($basicQuestionList);
				$advanceQuestionList = array_filter($advanceQuestionList);
				
				if(!empty($basicQuestionList))
					$basicQuestion[]   = implode(',', array_column($basicQuestionList, 'question_id_pk'));
				if(!empty($advanceQuestionList))
					$advanceQuestion[] = implode(',', array_column($advanceQuestionList, 'question_id_pk'));
            }
			
            $finalQuestionList  = implode(',', $basicQuestion).','.implode(',', $advanceQuestion);
            $finalQuestionArray = explode(',', $finalQuestionList);
			//print_r($finalQuestionArray);die;
            if($remainder > 0)
            {
                // Get basic question from all module
                $dataArray['level_id']  = 1;
                $randomQuestion  = $this->batch_model->getRandomQuestionList($dataArray, $finalQuestionArray);

                shuffle($randomQuestion);
                $randomQuestion = array_slice($randomQuestion, 0, $remainder);
                $finalQuestionList .= ','.implode(',', array_column($randomQuestion, 'question_id_pk'));
				$finalQuestionArray = explode(',', $finalQuestionList);
            }
			//print_r($finalQuestionArray);die;
            if(count($finalQuestionArray) == $numOfQuestion)
            {
                $insertArray = array(
                    'active_status'  => 1,
                    'entry_time'     => "now()",
                    'question_id_fk' => $finalQuestionList,
                    'entry_ip'       => $this->input->ip_address(),
                    'batch_id_fk'    => $batchDetails[0]['batch_ems_id_pk'],
                    'entry_by'       => $this->session->userdata('stake_holder_login_id_pk')
                );

                $insertedId = $this->batch_model->insertQuestionList($insertArray);

                if($insertedId)
                {
                    echo json_encode(1);
                }
            }
            else
            {
                echo json_encode(2);
            }
        }
        else
        {
            echo json_encode(0);
        }
    }
	
	
	
	
	public function add_question()
    {
        // Get required data
        $id_hash      = $this->uri->segment(4);
        $batchDetails = $this->batch_model->getBatchDetails($id_hash);
        //print_r($batchDetails);
        // Create logic for question module
        $dataArray = array(
            'question_type_id'     => $batchDetails[0]['batch_type'], // 1 = Domain, 2 = Platform
            'question_for_id'      => 2, // 1 = Trainee, 2 = Assessor
            'active_status'        => 1,
            'process_status_id_fk' => 5,
			'question_pattern'		=> 1,
        );
        if($batchDetails[0]['batch_type'] == 1)
        {
            $dataArray['course_id'] = $batchDetails[0]['course_id'];
            $dataArray['sector_id'] = $batchDetails[0]['sector_id'];
        }

        // Get question module
        $moduleList  = $this->batch_model->getQuestionModule($dataArray);
        $numOfModule = count($moduleList);
		
        if($numOfModule)
        {
            // Assign mandatory data
            $numOfQuestion = 50; $basicLavel = 80; $advanceLavel = 20; $flagBasicQuestion = $flagAdvanceQuestion = 0;

            // Number of question (quotient) in a module
            $quotient  = intval($numOfQuestion / $numOfModule);
            $remainder = intval($numOfQuestion % $numOfModule);

            // Number of basic & advance question in a module
            $numOfBasicQuestion   = round( ($quotient * $basicLavel) / 100 );
            $numOfAdvanceQuestion = round( ($quotient * $advanceLavel) / 100 );

            $totalNumberOfBasicQuestion   = $numOfModule * $numOfBasicQuestion;
            $totalNumberOfAdvanceQuestion = $numOfModule * $numOfAdvanceQuestion;
            
            $basicQuestion = $storedBasicQuestion = $advanceQuestion = $storedAdvanceQuestion = array();
            // Get question from each module
            foreach ($moduleList as $key1 => $module) 
            {
                $dataArray['module_id'] = $module['module_id'];

                // Get basic question from the module
                $dataArray['level_id']  = 1;
                $basicQuestionList  = $this->batch_model->getQuestionList($dataArray);
                $countBasicQuestion[] = count($basicQuestionList);
                // Get advance question from the module
                $dataArray['level_id']  = 2;
                $advanceQuestionList  = $this->batch_model->getQuestionList($dataArray);
                $countAdvanceQuestion[] = count($advanceQuestionList);

                // Basic question logic
                shuffle($basicQuestionList);
                $totalBasicQuestion = ($flagBasicQuestion + $numOfBasicQuestion);
                if($countBasicQuestion >= $totalBasicQuestion)
                {
                    $flagBasicQuestion = 0;
                    $tmpQuestionList   = $basicQuestionList;
                    $basicQuestionList = array_slice($basicQuestionList, 0, $totalBasicQuestion);
                    
					$tmpList = array_slice($tmpQuestionList, $totalBasicQuestion);
                    if(!empty($tmpList)){
                        $storedBasicQuestion = array_merge($storedBasicQuestion, $tmpList);
                    }
                }
                else{
                    $flagBasicQuestion = abs($countBasicQuestion - $totalBasicQuestion);
                }

                // Advance question logic
                shuffle($advanceQuestionList);
                $totalAdvanceQuestion = ($flagAdvanceQuestion + $numOfAdvanceQuestion);
                if($countAdvanceQuestion >= $totalAdvanceQuestion)
                {
                    $flagAdvanceQuestion = 0;
                    $tmpQuestionList   = $advanceQuestionList;
                    $advanceQuestionList = array_slice($advanceQuestionList, 0, $totalAdvanceQuestion);

                    $tmpList = array_slice($tmpQuestionList, $totalAdvanceQuestion);
                    if(!empty($tmpList)){
                        $storedAdvanceQuestion = array_merge($storedAdvanceQuestion, $tmpList);
                    }
                }
                else
                {
                    $flagAdvanceQuestion = abs($countAdvanceQuestion - $totalAdvanceQuestion);
                }

				$basicQuestionList = array_filter($basicQuestionList);
				$advanceQuestionList = array_filter($advanceQuestionList);
				
				if(!empty($basicQuestionList))
					$basicQuestion[]   = implode(',', array_column($basicQuestionList, 'question_id_pk'));
				if(!empty($advanceQuestionList))
					$advanceQuestion[] = implode(',', array_column($advanceQuestionList, 'question_id_pk'));
            }
			
			$basicQuestion   = explode(',', implode(',', $basicQuestion));
            $advanceQuestion = explode(',', implode(',', $advanceQuestion));
			
			//print_r([$remainder, count($basicQuestion), $totalNumberOfBasicQuestion, $basicQuestion, count($advanceQuestion), $totalNumberOfAdvanceQuestion, $advanceQuestion]);die;
			//print_r([$storedBasicQuestion, $storedAdvanceQuestion]);
			

            if(count($basicQuestion) != $totalNumberOfBasicQuestion){

                shuffle($storedBasicQuestion);
                $remainCount = $totalNumberOfBasicQuestion - count($basicQuestion);

                $tmpArratList = array_slice($storedBasicQuestion, 0, $remainCount);
				
				$tmpArratList = implode(',', array_column($tmpArratList, 'question_id_pk'));

                $basicQuestion = array(implode(',', $basicQuestion), $tmpArratList);
				
            }
			
			//print_r([$basicQuestion, $totalNumberOfBasicQuestion]);die;
			

            if(count($advanceQuestion) != $totalNumberOfAdvanceQuestion){
                
                shuffle($storedAdvanceQuestion);
                $remainCount = $totalNumberOfAdvanceQuestion - count($advanceQuestion);

                $tmpArratList = array_slice($storedAdvanceQuestion, 0, $remainCount);
				
				$tmpArratList = implode(',', array_column($tmpArratList, 'question_id_pk'));

                $advanceQuestion = array(implode(',', $advanceQuestion), $tmpArratList);
				
            }

			
			//print_r([$advanceQuestion, $totalNumberOfAdvanceQuestion]);die;
			
			
			//print_r([$basicQuestion, $advanceQuestion]);die;
			
            $finalQuestionList  = implode(',', $basicQuestion).','.implode(',', $advanceQuestion);
            $finalQuestionArray = explode(',', $finalQuestionList);
			
			//print_r($finalQuestionArray);die;
            
			if($remainder > 0)
            {
                // Get basic question from all module
                $dataArray['level_id']  = 1;
				unset($dataArray['module_id']);
				
                $randomQuestion  = $this->batch_model->getRandomQuestionList($dataArray, $finalQuestionArray);

                shuffle($randomQuestion);
                $randomQuestion = array_slice($randomQuestion, 0, $remainder);
                $finalQuestionList .= ','.implode(',', array_column($randomQuestion, 'question_id_pk'));
				$finalQuestionArray = explode(',', $finalQuestionList);
            }
			
			//print_r([count($finalQuestionArray), $finalQuestionArray]);die;
            if(count($finalQuestionArray) == $numOfQuestion)
            {
                $insertArray = array(
                    'active_status'  => 1,
                    'entry_time'     => "now()",
                    'question_id_fk' => $finalQuestionList,
                    'entry_ip'       => $this->input->ip_address(),
                    'batch_id_fk'    => $batchDetails[0]['batch_ems_id_pk'],
                    'entry_by'       => $this->session->userdata('stake_holder_login_id_pk')
                );

                $insertedId = $this->batch_model->insertQuestionList($insertArray);
				//$insertedId = 1;

                if($insertedId)
                {
                    echo json_encode(1);
                }
            }
            else
            {
                echo json_encode(2);
            }
        }
        else
        {
            echo json_encode(0);
        }
    }
	
	
	
	//send_training_link
     public function send_training_link($batch_id_hash = NULL){
        $data['batch_id_hash'] = $batch_id_hash;

        if($this->input->method(TRUE) == "POST"){
        $batch_id_hash= $this->input->post("batch_id_hash");
        $assessor_details = $this->batch_model->batch_wise_assessor_details($batch_id_hash);
        //$data['assessor']=$assessor_details;

        //echo "<pre>";print_r($assessor_details);
        $this->load->library('form_validation');
        $this->form_validation->set_rules('batch_id_hash', 'batch', 'required|exact_length[32]');
        $this->form_validation->set_rules('training_link', 'Online Training Link', 'required|max_length[200]');
        $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
        if ($this->form_validation->run() == FALSE) {
            //echo "Something went wrong!";

        } else  {
            $data['training_link']=$this->input->post("training_link");
            //$this->output->enable_profiler();

            $array_main_table = array(
                "training_link"                => $this->input->post("training_link")
            );
            
            $update_status=$this->batch_model->update_training_link($array_main_table, $batch_id_hash);
           // $update_status=1;
            if($update_status){
                foreach ($assessor_details as $assessor)
                {
                    //echo "<pre>";print_r($assessor['email_id']);
                    $data['assessor_name']=$assessor['fname'].' '.$assessor['lname'];
                    $email_subject = "Online Training Link for TOA";
                    $email_message = $this->load->view($this->config->item('theme').'trainer/assessor_training_link_email_template_view',$data,TRUE);
                    $cc_mail_list = array();
                    send_email($assessor['email_id'],$email_message,$email_subject,$cc_mail_list);
                    $data['success']  = "success";
                }
            } else {
                 $data['danger']  = "danger";

            }
        }

        }
        $this->load->view($this->config->item('theme').'trainer/link_send_view',$data);
    }
}
?>