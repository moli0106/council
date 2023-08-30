<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_batch extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(30);
        // $this->output->enable_profiler(TRUE);
        $this->load->model('assessor_ems/assessor_batch_model');

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
            5 => $this->config->item('theme_uri').'assessor_ems/assessor_batch.js', 
        );

    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'assessor_ems/assessor_batch/index/';
		$data["total_rows"]         = $config['total_rows'] = $this->assessor_batch_model->getBatchCount()[0]['count'];	
		$config['per_page']         = 20;
        $config['num_links']        = 3;
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
        $data['BatchList'] = $this->assessor_batch_model->getAllBatch($config['per_page'], $offset);

        $this->load->view($this->config->item('theme').'assessor_ems/assessor_batch_list_view', $data);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            'sector_list' => $this->assessor_batch_model->getAllSector(),
            'batch_type'  => $this->assessor_batch_model->getBatchType(),
            'assessment_mode'  => $this->assessor_batch_model->getAssessmentMode(),
            'venue_list'  => $this->assessor_batch_model->getVenue(),
        );
        
        $this->load->view($this->config->item('theme').'assessor_ems/assessor_batch_add_view', $data);
    }

    //Create Batch
    public function createBatch()
    {
        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $data     = $assessor_ids = array();
            $response = array(
                'csrf_token' => $this->security->get_csrf_hash(),
                'redirect'   => 0
            );

            // Get data from ajax request
            $postData = explode('&', $this->input->post('form_data'));
            
            // Create post data in a proper format
            foreach ($postData as $key => $value) {
                $tmp = explode('=', $value);
                if($tmp[0] == "assessor_id[]"){
                    $assessor_ids[] = $tmp[1]; 
                } else {
                    $tmp[1] = ($tmp[1] == '') ? NULL : $tmp[1];
                    $data[$tmp[0]] = $tmp[1];
                }
            }unset($data['csrf_council']);

            // Convert start & end date in database formate
            $start_date = explode('/', $data['start_date']);
            $end_date = explode('/', $data['end_date']);
            
            $data['start_date'] = date_format(date_create($start_date[2].'-'.$start_date[1].'-'.$start_date[0]), "Y-m-d");
            $data['end_date']   = date_format(date_create($end_date[2].'-'.$end_date[1].'-'.$end_date[0]), "Y-m-d");
            
            // Get necessary data
            $data['entry_time'] = "now()";
            $data['entry_ip']   = $this->input->ip_address();
            $data['created_by'] = $this->session->userdata('stake_holder_login_id_pk');
            //$data['active_status'] = 1;


            // Insert batch data in database
            $last_id = $this->assessor_batch_model->createBatch($data);

            // Create Batch id
            //$batch_id = $data['batch_type'].'-'.date('Ymd').'-'.sprintf("%07d", $last_id);
            
            if($last_id)
            {
				// Create Batch id
                $batch_id = '';
                if($data['batch_type'] == 1) 
                {
                    $sectorDetails = $this->assessor_batch_model->getSectorDetails($data['sector_id']);
                    $batch_id      = 'D'.$sectorDetails[0]['sector_code'].sprintf("%06d", $last_id);
                } 
                else 
                {
                    $batch_id      = 'P'.sprintf("%09d", $last_id);
                }
                // $batch_id = $data['batch_type'].'-'.date('Ymd').'-'.sprintf("%07d", $last_id);
				
                $this->assessor_batch_model->updateBatch($last_id, array('batch_id' => $batch_id));

                $venueDetails = $this->assessor_batch_model->getVenue($data['venue']);


                // Create data for send mail to trainer
                $trainerDetails = $this->assessor_batch_model->getTrainerDetails($data['trainer_id']);
                $emailDataTrainer = array(
                    'name'               => $trainerDetails[0]['f_name'].' ' .$trainerDetails[0]['l_name'],
                    'batchType'          => $data['batch_type'],
                    'startDate'          => date("d-m-Y",strtotime($data['start_date'])),
                    'endDate'            => date("d-m-Y",strtotime($data['end_date'])),
                    'assessorList'       => $this->assessor_batch_model->getAssessorWhereIn($assessor_ids),
                    'assessmentMode'     => $data['assment_mode'],
                    'venue'              => $venueDetails[0]['institute_name'],
                );
                if($data['batch_type'] == 1) {
                    $courseDetails = $this->assessor_batch_model->getCourseDetails($data['course_id']);
                    $emailDataTrainer['jobRole']  = $courseDetails[0]['course_name'];
    
                } else {
                    $emailDataTrainer['jobRole']  = '';
                }

                // Send email
                $this->load->helper('email');

                $email_subject = "TOA Batch";
                $email_message = $this->load->view($this->config->item('theme').'assessor_ems/email_template_for_trainer', $emailDataTrainer, TRUE);
                
                send_email($trainerDetails[0]['email'], $email_message, $email_subject);

                // Insert assessor in batch
                foreach ($assessor_ids as $key => $value) 
                {
                    $batchMapArray = array(
                        'batch_ems_id_fk' => $last_id,
                        'assessor_id_fk'  => $value,
                        'trainer_id'      => $data['trainer_id']
                    );

                    $result = $this->assessor_batch_model->addAssessorInBatch($batchMapArray);
                    if($result)
                    {
                        $assessorData = $this->assessor_batch_model->getAssessorDetails($value);
                        $emailDataAssessor = array(
                            'name'               => $assessorData[0]['fname'].' '.$assessorData[0]['lname'],
                            'batchType'          => $emailDataTrainer['batchType'],
                            'jobRole'            => $emailDataTrainer['jobRole'],
                            'startDate'          => $emailDataTrainer['startDate'],
                            'endDate'            => $emailDataTrainer['endDate'],
                            'trainerName'        => $emailDataTrainer['name'],
                            'trainerEmail'       => $trainerDetails[0]['email'],
                            'trainerMobile'      => $trainerDetails[0]['mobile'],
                            'assessmentMode'     => $data['assment_mode'],
                            'venue'              => $emailDataTrainer['venue'],
                        );
                        // Send email
                        $email_message = $this->load->view($this->config->item('theme').'assessor_ems/email_template_for_assessor', $emailDataAssessor, TRUE);
                        
                        send_email($assessorData[0]['email_id'], $email_message, $email_subject);

                    }

                }

                $this->session->set_flashdata('status','success');
                $this->session->set_flashdata('alert_msg','Batch created successfully.');
            }
            else{
                $this->session->set_flashdata('status','success');
                $this->session->set_flashdata('alert_msg','Batch created successfully.');
            }
            
            $response['redirect'] = base_url('admin/assessor_ems/assessor_batch');

            echo json_encode($response);
        }
        else
        {
            echo json_encode('The requested method is not allowed.');
        }
    }

    // View Batch details
    public function details_old( $id_hash = NULL )
    {
        $data = array(
            'batchDetails' => $this->assessor_batch_model->getBatchDetails($id_hash),
            'assessorList' => $this->assessor_batch_model->getBatchAssessorList($id_hash)
        );

        // echo'<pre>';print_r($data);exit();
        
        $this->load->view($this->config->item('theme').'assessor_ems/assessor_batch_details_view', $data);
    }
	
	
	
	// View Batch details
    public function details($id_hash = NULL)
    {
        $AbnormallyExistList = $this->assessor_batch_model->getAbnormallyExistAssessorList($id_hash);
        if (!empty($AbnormallyExistList)) {
            $this->finalSubmitResult($AbnormallyExistList);
        }

        $data = array(
            'batchDetails' => $this->assessor_batch_model->getBatchDetails($id_hash),
            'assessorList' => $this->assessor_batch_model->getBatchAssessorList($id_hash)
        );
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'assessor_ems/assessor_batch_details_view', $data);
    }

    private function finalSubmitResult($AbnormallyExistList = NULL)
    {
        foreach ($AbnormallyExistList as $key => $value) {

            $assessor_id     = $value['assessor_id_fk'];
            $batch_type      = $value['batch_type'];
            $batch_ems_id_fk = $value['batch_ems_id_fk'];
            $exam_start_time = $value['exam_start_time'];
            $batch_exam_date = $value['batch_exam_date'];

            $assessor_exam_duration = $this->config->item('assessor_exam_duration');
			//$assessor_exam_duration = 3;

            $exam_date  = explode('-', $batch_exam_date);
            $end_time   = explode(':', date('H:i:s', strtotime($exam_start_time) + (60 * 60 * $assessor_exam_duration)));

            $assessor_exam_end_date_time   = date("Y-m-d H:i:s", mktime($end_time[0], $end_time[1], $end_time[2], $exam_date[1], $exam_date[2], $exam_date[0]));

            if (strtotime(date('Y-m-d H:i:s')) > strtotime($assessor_exam_end_date_time)) {

				$questionList = $this->assessor_batch_model->get_batch_questions(md5($value['batch_ems_id_fk']))[0];
				$answerList   = $this->assessor_batch_model->getAssessorAnswerSheet(md5($value['batch_ems_id_fk']), $assessor_id);

				$correctAnswer  = $wrongAnswer = $question_attempt = 0;
				$answerArrayQID = $answerOptions  = array();

				foreach ($answerList as $key => $value) {
					if ($value['result_status'] == 1) {

						++$correctAnswer;
						++$question_attempt;
					} elseif ($value['result_status'] == 0 && $value['result_status'] != NULL) {

						++$wrongAnswer;
						++$question_attempt;
					}

					$answerArrayQID[] = $value['question_id_fk'];
					$answerOptions[]  = $value['user_answer'];
				}

				$marks_for_each = 2;
				$grade  = '';

				$question_list  = explode(',', $questionList['question_id_fk']);
				$total_question = count($question_list);
				$marks_secured  = $marks_for_each * $correctAnswer;
				$percent        = ($marks_secured / ($total_question * $marks_for_each)) * 100;

				$exam_response_marked = array();

				foreach ($question_list as $key => $value) {
					if (in_array($value, $answerArrayQID)) {

						$optionKey = array_search($value, $answerArrayQID);
						$exam_response_marked[] = $answerOptions[$optionKey];
					} else {
						$exam_response_marked[] = 0;
					}
				}
				$login_details = $this->assessor_batch_model->getAssessorLoginDetails($assessor_id);
				$exam_data = array(
					"assessor_id_fk"       => $assessor_id,
					"login_id"             => $login_details[0]['login_id'],
					"batch_type_id_fk"     => $batch_type,
					"batch_id_fk"          => $batch_ems_id_fk,
					"marks"                => $marks_secured,
					"total_question"       => $total_question,
					"exam_taken_date"      => 'now()',
					"exam_taken_by_ip"     => $_SERVER['REMOTE_ADDR'],
					"question_attempt"     => $question_attempt,
					"correct_answer"       => $correctAnswer,
					"exam_questions"       => $questionList['question_id_fk'],
					"exam_response_marked" => implode(',', $exam_response_marked),
					"percentage"           => number_format((float)$percent, 2, '.', ''),
					"active_status"        => 1
				);

				$status = $this->assessor_batch_model->result_submit($exam_data);
			}
        }
    }

    //Get Job Role from Sector
    public function getJobRole()
    {
        $sector_id = $this->input->get('sector_id');

        if($sector_id)
        {
            $rawHtml     = '<option value="" hidden="true">Select Job Role</option>';
            $jobRoleList = $this->assessor_batch_model->getJobRole($sector_id);

            if(count($jobRoleList))
            {
                foreach ($jobRoleList as $key => $jobRole) 
                {
                    $rawHtml .= '<option value="'.$jobRole['course_id_pk'].'">'.$jobRole['course_name'].' ('.$jobRole['course_code'].')</option>';
                }
            } else {
                $rawHtml .= '<option value="" disabled="true">No Data Found...</option>';
            }

            echo json_encode($rawHtml);
        }
    }
    
    //Get Trainer List from Sector & Job Role
    public function getTrainerByJobRole()
    {
        $sector_id   = $this->input->get('sector_id');
        $job_role_id = $this->input->get('job_role_id');

        $rawHtml     = '<option value="" hidden="true">Select Master Trainer</option>';
        $trainerList = $this->assessor_batch_model->getTrainerByJobRole($sector_id, $job_role_id);
        
        if(count($trainerList))
        {
            foreach ($trainerList as $key => $trainer) 
            {
                $rawHtml .= '<option value="'.$trainer['master_trainer_id_pk'].'">'.$trainer['f_name'].' '.$trainer['l_name'].' ('.$trainer['email'].')</option>';
            }
        } else {
            $rawHtml .= '<option value="" disabled="true">No Data Found...</option>';
        }
        
        echo json_encode($rawHtml);
        
    }

    
    public function getAssessorByJobRole()
    {
        $rawHtml      = '';
        $job_role_id  = $this->input->get("job_role_id"); 
        $assessorList = $this->assessor_batch_model->getAssessorByJobRole($job_role_id);
		$countData = 'Select Assessor From the List<span class="text-warning">( Total Assessor : '.count($assessorList).' )</span><br><span id="y"></span>';
        if(count($assessorList))
        {
            foreach ($assessorList as $key => $assessor) 
            {
                $rawHtml .= '
                    <tr>
                        <td>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input check_count" name="assessor_id[]" onclick="updateCount()" value="'.$assessor['assessor_registration_details_pk'].'">
                                <label class="custom-control-label" for="customCheck1"></label>
                            </div>
                        </td>
                        <td>'.$assessor['fname'].'</td>
                        <td>'.$assessor['lname'].'</td>
						<td>'.$assessor['pan'].'</td>
                        <td>'.$assessor['mobile_no'].'</td>
                        <td>'.$assessor['email_id'].'</td>
						<td>'.$assessor['sector_name'].'</td>
                    </tr>
                ';
            }
        } else {
            $rawHtml .= '<tr class="text-danger"><td align="center" colspan="5">Assessor not found...</td></tr>';
        }

        $response = array(
            'countData' => $countData, 
            'rawHtml'   => $rawHtml
        );

        echo json_encode($response);
    }
    
    public function getBatchAssessorList()
    {
        $rawHtml = '';
        $rowId   = $this->input->get("rowId"); 
        
        $assessorList = $this->assessor_batch_model->getBatchAssessorList($rowId);

        if(count($assessorList))
        {
            $count = 0;
            foreach ($assessorList as $key => $assessor) 
            {
                $rawHtml .= '
                    <tr>
                        <td>'.++$count.'</td>
                        <td>'.$assessor['fname'].' '.$assessor['lname'].'</td>
                        <td>'.$assessor['mobile_no'].'</td>
                        <td>'.$assessor['email_id'].'</td>
                    </tr>
                ';
            }
        } else {
            $rawHtml .= '<tr class="text-danger"><td align="center" colspan="4">Assessor not found...</td></tr>';
        }

        echo json_encode($rawHtml);
    }
	
	
	//set_exam_date_time

	public function ajax_set_exam_date_time($batch_id_hash = NULL)
		{
			$this->load->helper('string');
			if($batch_id_hash == NULL || strlen($batch_id_hash) != 32)
			{
				echo '<div class="alert alert-danger">Something went wrong. Please try again</div>';
			} 
			else 
			{
				
				$data['batch_details'] = $this->assessor_batch_model->getBatchDetails($batch_id_hash);
				if(count($data['batch_details']) > 0)
				{
					$this->load->view($this->config->item('theme').'assessor_ems/ajax_exam_date_time_set_view',$data);
				}
				else
				{
					echo '<div class="alert alert-warning">Input modified forcefully. Please try again</div>';
				}
			}
		}



		public function confirm_set_exam_time()
		{
			//print_r($_POST);die;
			$batch_id_hash = $this->input->post('batch_id_hash');
			$data['batch_id_hash'] = $batch_id_hash;
			$data['batch_details'] = $this->assessor_batch_model->getBatchDetails($batch_id_hash);

			$this->load->library('form_validation');
            $this->form_validation->set_rules('batch_id_hash', 'batch', 'required|exact_length[32]');
            $this->form_validation->set_rules('exam_start_date', 'Exam start date', 'required');
            $this->form_validation->set_rules('exam_start_time', 'Exam start time', 'required');
            $this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
			//$this->form_validation->set_rules($config);
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view($this->config->item('theme').'assessor_ems/ajax_exam_date_time_set_view',$data);
			}
			else
			{
				
				$data['exam_start_date'] = $this->input->post("exam_start_date");
                $data['exam_start_time'] = $this->input->post("exam_start_time");
                //$this->output->enable_profiler();
                $exam_start_date_array = explode('/', $data['exam_start_date']);

                $exam_start_date = date_format(date_create($exam_start_date_array[2] . '-' . $exam_start_date_array[1] . '-' . $exam_start_date_array[0]), "Y-m-d");
                $array_main_table = array(
                    "batch_exam_date"                => $exam_start_date,
                    "batch_exam_time"                => $this->input->post("exam_start_time"),
                    "exam_date_time_status"          => 1
                );

                $update_status = $this->assessor_batch_model->update_exam_date_time($array_main_table, $batch_id_hash);
					if($update_status)
					{
						$data['code'] = 1;
						$data['msg'] = "Exam Date & Time successfully Updated";
					}
					else
					{
						$data['code'] = 0;
						$data['msg'] = "Exam Date & Time successfully Updated failed";
					}
					$this->load->view($this->config->item('theme').'assessor_ems/ajax_exam_date_time_set_view',$data);
				
			}
			
		}
    
}

/* End of file Assessor_batch.php */
?>