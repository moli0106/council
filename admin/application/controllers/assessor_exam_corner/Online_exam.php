<?php
defined('BASEPATH') or exit('No direct script access allowed');
error_reporting(0);

class Online_exam extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(28);

        $this->load->model('assessor_exam_corner/online_exam_model');
        $this->load->helper('code');
        $this->load->helper('security');
        //$this->output->enable_profiler(TRUE);

        $this->css_head = array(
            // 1 => $this->config->item('theme_uri') . 'assessor_exam_corner/online_exam.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'assessor_exam_corner/online_exam_form_entry_validation.js',
            3 => $this->config->item('theme_uri') . 'assessor_exam_corner/online_exam.js',
        );
    }


    public function index()
    {
        $assessor_id = $this->session->userdata('stake_details_id_fk');
        $data = array(
            'examDetails' => $this->online_exam_model->getAssessorExamDetails($assessor_id),
        );
        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'assessor_exam_corner/batch_list_view', $data);
    }

    public function instructions($batch_id_hash = NULL)
    {
        if ($batch_id_hash) {
            $assessor_id = $this->session->userdata('stake_details_id_fk');
            $examDetails = $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id);
            if (!empty($examDetails)) {
                $data = array('examDetails' => $examDetails[0]);
                // parent::pre($data);
                $this->load->view($this->config->item('theme') . 'assessor_exam_corner/instructions_view', $data);
            } else {
                redirect('admin/assessor_exam_corner/online_exam');
            }
        } else {
            redirect('admin/assessor_exam_corner/online_exam');
        }
    }

    public function updateAssessorStartExam()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $assessor_id   = $this->session->userdata('stake_details_id_fk');
            $batch_id_hash = $this->input->get('batch_id_hash');

            if (!empty($batch_id_hash)) {
                $condition = array(
                    "assessor_id_fk" => $assessor_id,
                    'MD5(CAST(batch_ems_id_fk AS character varying)) =' => $batch_id_hash,
                );
                $updateArray = array(
                    'exam_status'     => 1,
                    'exam_start_time' => date('H:i:s')
                );

                $checkData = $this->online_exam_model->getBatchAssessorMap($condition);
                if (!empty($checkData) && $checkData[0]['exam_start_time'] == NULL) {

                    $result = $this->online_exam_model->updateBatchAssessorMap($condition, $updateArray);

                    if ($result) {
                        echo json_encode('done');
                    }
                } else {
                    echo json_encode('done');
                }
            }
        }
    }


    public function testScreen($batch_id_hash = NULL)
    {
        $this->css_head[] = $this->config->item('theme_uri') . 'assessor_exam_corner/online_exam.css';

        if ($batch_id_hash) {

            $assessor_id = $this->session->userdata('stake_details_id_fk');
            $examDetails = $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id);

            if (!empty($examDetails) && !empty($examDetails[0]['exam_start_time']) && $examDetails[0]['exam_status'] != 2) {

                $exam_end_time = date('M d, y H:i:s', strtotime($examDetails[0]['exam_start_time']) + (90 * 60));

                $batch_questions = $this->online_exam_model->get_batch_questions($batch_id_hash);
                $qusetion_id     = explode(',', $batch_questions[0]['question_id_fk']);
                $question_no     = 1;

                $questionDetails = $this->online_exam_model->getQuestionForExan($qusetion_id[$question_no - 1]);
                $answerDetails   = $this->online_exam_model->getUserAnsByQuestionId($qusetion_id[$question_no - 1], $examDetails[0]['batch_ems_id_pk'], $assessor_id);

                if (!empty($answerDetails)) {
                    $user_answer = $answerDetails[0]['user_answer'];
                } else {
                    $user_answer = NULL;
                }

                $pagination = array();
                $count = 0;

                foreach ($qusetion_id as $key => $value) {
                    $ansData = $this->online_exam_model->getUserAnsByQuestionId($value, $examDetails[0]['batch_ems_id_pk'], $assessor_id);

                    if (!empty($ansData)) {
                        $pagination[$count] = $ansData[0]['mark_for_review'];
                    } else {
                        $pagination[$count] = NULL;
                    }

                    ++$count;
                }

                $data = array(
                    'batch_id_hash'   => $batch_id_hash,
                    'question_no'     => $question_no,
                    'row'             => $questionDetails[0],
                    'user_answer'     => $user_answer,
                    'pagination'      => $pagination,
                    'exam_end_time'   => $exam_end_time,
                );

                // parent::pre($pagination);

                $this->load->view($this->config->item('theme') . 'assessor_exam_corner/exam_screen_view', $data);
            } else {
                redirect('admin/assessor_exam_corner/online_exam');
            }
        } else {
            redirect('admin/assessor_exam_corner/online_exam');
        }
    }

    public function nextQuestion()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $question_no        = $this->input->get('question_no');
            $batch_id_hash      = $this->input->get('batch_id_hash');
            $answer             = $this->input->get('answer');
            $next_question      = $this->input->get('next_question');
            $mark_for_review    = $this->input->get('mark_for_review');

            $next_question = (int)$next_question;

            if ($batch_id_hash != NULL && $question_no != NULL) {

                $assessor_id = $this->session->userdata('stake_details_id_fk');
                $examDetails = $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id);

                $batch_questions = $this->online_exam_model->get_batch_questions($batch_id_hash);
                $qusetion_id     = explode(',', $batch_questions[0]['question_id_fk']);

                if ($answer != NULL) {

                    $question_details = $this->online_exam_model->getQuestionForExan($qusetion_id[$question_no - 1])[0];

                    $answer_array = array(
                        'batch_ems_id_fk'    => $batch_questions[0]['batch_id_fk'],
                        'assessor_id_fk'     => $this->session->userdata('stake_details_id_fk'),
                        'question_id_fk'     => $question_details['question_id_fk'],
                        'eng_question_id_fk' => $question_details['eng_question_id_pk'],
                        'user_answer'        => $answer,
                        'right_answer'       => $question_details['right_answer'],
                        'result_status'      => ($question_details['right_answer'] == $answer) ? 1 : 0,
                        'active_status'      => 1,
                        'entry_ip'           => $this->input->ip_address(),
                    );

                    if ($mark_for_review == 1) {

                        $answer_array['mark_for_review'] = 1;

                        if (count($qusetion_id) == $question_no) {

                            $next_question = 0;
                        } else {

                            $next_question = $question_no + 1;
                        }
                    }

                    $this->online_exam_model->insertOrUpdateAnswerSheet($answer_array);
                }elseif ($mark_for_review == 1) {

                    $question_details = $this->online_exam_model->getQuestionForExan($qusetion_id[$question_no - 1])[0];

                    $answer_array = array(
                        'batch_ems_id_fk'    => $batch_questions[0]['batch_id_fk'],
                        'assessor_id_fk'     => $this->session->userdata('stake_details_id_fk'),
                        'question_id_fk'     => $question_details['question_id_fk'],
                        'eng_question_id_fk' => $question_details['eng_question_id_pk'],
                        'user_answer'        => NULL,
                        'right_answer'       => $question_details['right_answer'],
                        'result_status'      => NULL,
                        'active_status'      => 1,
                        'mark_for_review'    => 1,
                        'entry_ip'           => $this->input->ip_address(),
                    );

                    $this->online_exam_model->insertOrUpdateAnswerSheet($answer_array);

                    if (count($qusetion_id) == $question_no) {

                        $next_question = 0;
                    } else {

                        $next_question = $question_no + 1;
                    }
                }

                if ($next_question == 0) {
                    $condition = array(
                        'batch_ems_id_fk' => $batch_questions[0]['batch_id_fk'],
                        'assessor_id_fk'  => $this->session->userdata('stake_details_id_fk')
                    );
                    $result = $this->online_exam_model->updateBatchAssessorMap($condition, array('exam_status' => 2));

                    if ($result) {

                        $this->finalSubmitResult($batch_id_hash);

                        $response = array(
                            'html_view' => NULL,
                            'my_url'    => base_url('admin/assessor_exam_corner/online_exam/viewResult/' . $batch_id_hash),
                        );
                        echo json_encode($response);
                    }
                } else {

                    $next_question = $next_question - 1;
                    if ($next_question >= 0) {

                        $row  = $this->online_exam_model->getQuestionForExan($qusetion_id[$next_question]);
                        $answerDetails   = $this->online_exam_model->getUserAnsByQuestionId($qusetion_id[$next_question], $examDetails[0]['batch_ems_id_pk'], $assessor_id);

                        if (!empty($answerDetails)) {
                            $user_answer = $answerDetails[0]['user_answer'];
                        } else {
                            $user_answer = NULL;
                        }

                        $pagination = array();
                        $count = 0;

                        foreach ($qusetion_id as $key => $value) {
                            $ansData = $this->online_exam_model->getUserAnsByQuestionId($value, $examDetails[0]['batch_ems_id_pk'], $assessor_id);

                            if (!empty($ansData)) {
                                $pagination[$count] = $ansData[0]['mark_for_review'];
                            } else {
                                $pagination[$count] = NULL;
                            }

                            ++$count;
                        }

                        $data = array(
                            'batch_id_hash'   => $batch_id_hash,
                            'question_no'     => $next_question + 1,
                            'row'             => $row[0],
                            'pagination'      => $pagination,
                            'user_answer'     => $user_answer,
                        );

                        // parent::pre($answerDetails);
                        $html_view = $this->load->view($this->config->item('theme') . 'assessor_exam_corner/ajax_exam_screen_view', $data, TRUE);

                        $response = array(
                            'html_view' => $html_view,
                        );
                        echo json_encode($response);
                    }
                }
            }
        }
    }

    public function examTimeUp()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $assessor_id   = $this->session->userdata('stake_details_id_fk');
            $batch_id_hash = $this->input->get('batch_id_hash');

            if (!empty($batch_id_hash)) {
                $condition = array(
                    "assessor_id_fk" => $assessor_id,
                    'MD5(CAST(batch_ems_id_fk AS character varying)) =' => $batch_id_hash,
                );
                $updateArray = array(
                    'exam_status'     => 2,
                );
                $result = $this->online_exam_model->updateBatchAssessorMap($condition, $updateArray);

                if ($result) {

                    $this->finalSubmitResult($batch_id_hash);

                    echo json_encode(base_url('admin/assessor_exam_corner/online_exam/viewResult/' . $batch_id_hash));
                }
            }
        }
    }

    function finalSubmitResult($batch_id_hash = NULL)
    {
        $assessor_id = $this->session->userdata('stake_details_id_fk');

        $examDetails  = $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id)[0];
        $questionList = $this->online_exam_model->get_batch_questions($batch_id_hash)[0];
        $answerList   = $this->online_exam_model->getAssessorAnswerSheet($batch_id_hash, $assessor_id);

        $correctAnswer  = $wrongAnswer = $question_attempt = 0;
        $answerArrayQID = array();
        $answerOptions  = array();

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
        //$percent        = ($marks_secured / $total_question) * 100;
		$percent        = ($marks_secured / ($total_question * $marks_for_each)) * 100;

        if ($percent > 90 and $percent <= 100) {
            $grade = 'Ex';
        } else  if ($percent > 80 and $percent <= 90) {
            $grade = 'A+';
        } else  if ($percent > 70 and $percent <= 80) {
            $grade = 'A';
        } else  if ($percent > 60 and $percent <= 70) {
            $grade = 'B+';
        } else  if ($percent > 50 and $percent <= 60) {
            $grade = 'B';
        } else  if ($percent > 40 and $percent <= 50) {
            $grade = 'C+';
        } else  if ($percent > 30 and $percent <= 40) {
            $grade = 'C';
        } else {
            $grade = 'D';
        }

        $exam_response_marked = array();

        foreach ($question_list as $key => $value) {
            if (in_array($value, $answerArrayQID)) {

                $optionKey = array_search($value, $answerArrayQID);
                $exam_response_marked[] = $answerOptions[$optionKey];
            } else {
                $exam_response_marked[] = 0;
            }
        }


        $exam_data = array(
            "assessor_id_fk"       => $assessor_id,
            "login_id"             => $this->session->userdata('login_id'),
            "batch_type_id_fk"     => $examDetails['batch_type'],
            "batch_id_fk"          => $examDetails['batch_ems_id_pk'],
            "marks"                => $marks_secured,
            "total_question"       => $total_question,
            "grade"                => $grade,
            "exam_taken_date"      => 'now()',
            "exam_taken_by_ip"     => $_SERVER['REMOTE_ADDR'],
            "question_attempt"     => $question_attempt,
            "correct_answer"       => $correctAnswer,
            "exam_questions"       => $questionList['question_id_fk'],
            "exam_response_marked" => implode(',', $exam_response_marked),
			"active_status"			=> 1,
			"percentage"           => number_format((float)$percent, 2, '.', ''),
        );

        $status = $this->online_exam_model->result_submit($exam_data);
    }

    public function viewResult($batch_id_hash = NULL)
    {
        if (!empty($batch_id_hash)) {

            $assessor_id = $this->session->userdata('stake_details_id_fk');

            $data = array(
                'batch_questions' => $this->online_exam_model->get_batch_questions($batch_id_hash)[0],
                'examDetails'     => $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id)[0],
                'resultDetails'   => $this->online_exam_model->getAssessorResult($batch_id_hash, $assessor_id)[0],
            );

            // parent::pre($data);

            $this->load->view($this->config->item('theme') . 'assessor_exam_corner/assessor_result_view', $data);
        } else {
            redirect('admin/assessor_exam_corner/online_exam');
        }
    }

    public function testScreen_OLD($batch_id_hash = NULL)
    {
        if ($batch_id_hash) {
            $assessor_id = $this->session->userdata('stake_details_id_fk');
            $examDetails = $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id);
            if (!empty($examDetails)) {
                $batch_questions = $this->online_exam_model->get_batch_questions($batch_id_hash);
                $qusetion_id     = explode(',', $batch_questions[0]['question_id_fk']);

                $row = $this->online_exam_model->fetchQuestions($qusetion_id);
                $data['row'] = $this->online_exam_model->fetchQuestions($qusetion_id);

                $question_count = 20;

                $data = array(
                    'examDetails'     => $examDetails,
                    'batch_questions' => $batch_questions,
                    'row'             => $row,
                    'random_keys'     => array_rand($row, $question_count),
                    'no_of_rows'      => count($row),
                    'pattern_key'     => $data['random_keys'],
                );
                shuffle($data['random_keys']);

                // parent::pre($data);

                // $this->load->view($this->config->item('theme') . 'assessor_exam_corner/test_screen_view', $data);
                $this->load->view($this->config->item('theme') . 'assessor_exam_corner/demo_screen_view', $data);
            } else {
                redirect('admin/assessor_exam_corner/online_exam');
            }
        } else {
            redirect('admin/assessor_exam_corner/online_exam');
        }
    }

    public function endTest()
    {
        if (isset($_POST['btn_end_test']) or isset($_POST['total_question'])) {
            $assessor_id    = $this->session->userdata('stake_details_id_fk');
            $batch_id_hash  = $this->input->post('batch_ems_id_pk');

            $data = array(
                'examDetails' => $this->online_exam_model->getAssessorBatchDetails($batch_id_hash, $assessor_id),
            );

            $batch_id_fk      = $data['examDetails'][0]['batch_ems_id_pk'];
            $batch_type_id_fk = $data['examDetails'][0]['batch_type'];

            $exam_ques_no   = $this->session->userdata('question_set');
            $total_question = $this->input->post('total_question');

            $this->session->unset_userdata('question_set'); // unsetting question_set session variable.

            $value = substr($_POST['response_marked'], 1, (strrpos($_POST['response_marked'], ']', 0) - 1));


            $list_1 = str_replace('option_1', "A", $value);
            $list_2 = str_replace('option_2', "B", $list_1);
            $list_3 = str_replace('option_3', "C", $list_2);
            $list   = str_replace('option_4', "D", $list_3);
            $list   = str_replace('"', "", $list);

            $exam_response_marked = explode(',', $list);
            $exam_response_marked = array_slice($exam_response_marked, 1);

            $row_result = $this->online_exam_model->fetchAnswers($exam_ques_no);

            $question_attempt = 0;
            $correct_answer   = 0;

            for ($i = 0; $i < count($row_result); $i++) {
                if (in_array($row_result[$i]['question_id_pk'], $exam_ques_no)) {
                    $key = array_search($row_result[$i]['question_id_pk'], $exam_ques_no);

                    if ($exam_response_marked[$key] != "0") {
                        $question_attempt++;
                        if ($exam_response_marked[$key] == $row_result[$i]['right_answer']) {
                            $correct_answer++;
                        }
                    }
                }
            }

            // print $correct_answer."<br>".$question_attempt;

            //print_r($exam_ques_no);
            //print_r($row_result);


            // print "</pre>";
            //  die;


            $marks_for_each = 2;
            $marks_secured = $marks_for_each * $correct_answer;

            /*
                                calculating grade...
                        */


            $percent = ($marks_secured / $total_question) * 100;
            $grade = '';

            if ($percent > 90 and $percent <= 100) {
                $grade = 'Ex';
            } else  if ($percent > 80 and $percent <= 90) {
                $grade = 'A+';
            } else  if ($percent > 70 and $percent <= 80) {
                $grade = 'A';
            } else  if ($percent > 60 and $percent <= 70) {
                $grade = 'B+';
            } else  if ($percent > 50 and $percent <= 60) {
                $grade = 'B';
            } else  if ($percent > 40 and $percent <= 50) {
                $grade = 'C+';
            } else  if ($percent > 30 and $percent <= 40) {
                $grade = 'C';
            } else {
                $grade = 'D';
            }


            // imploding  back

            $exam_ques_no  = implode(",", $exam_ques_no);
            $exam_response_marked = implode(",", $exam_response_marked);

            $exam_data = array(
                "assessor_id_fk" => $this->session->userdata('stake_details_id_fk'),
                "login_id" => $this->session->userdata('login_id'),
                "batch_type_id_fk" => $batch_type_id_fk,
                "batch_id_fk" => $batch_id_fk,

                "marks" => $marks_secured,
                "total_question" => $total_question,
                "grade" => $grade,
                "exam_taken_date" => 'now()',
                "exam_taken_by_ip" => $_SERVER['REMOTE_ADDR'],
                "question_attempt" => $question_attempt,
                "correct_answer" => $correct_answer,
                "exam_questions" => $exam_ques_no,
                "exam_response_marked" => $exam_response_marked
            );


            //print_r($exam_data); die;

            // save records into the table...

            $status = $this->online_exam_model->result_submit($exam_data);

            if ($status == TRUE) {
                $data['status']                                 = 1;
                $data['total_question']                         = $total_question;
                $data['question_attempt']                         = $question_attempt;
                $data['correct_answer']                         = $correct_answer;
                $data['marks']                                         = $marks_secured;
                $data['exam_question_no']                         = $exam_ques_no;

                $condition = array(
                    "assessor_id_fk" => $assessor_id,
                    'MD5(CAST(batch_ems_id_fk AS character varying)) =' => $batch_id_hash,
                );
                $this->online_exam_model->updateBatchAssessorMap($condition, array('exam_status' => 2));
            } else if ($status == FALSE) {
                $data['status'] = 0;
            }

            $this->load->view($this->config->item('theme') . 'assessor_exam_corner/submit_result_view', $data);
        } else {
            redirect('admin/assessor_exam_corner/online_exam');
            //print_r($_POST);  
        }
    }

    public function correct_ans($status = NULL)
    {


        if (isset($_POST['btn_view_correct_answer'])) {

            if (isset($_POST['hidden_info'])) {
                $information = explode(":", $_POST['hidden_info']);

                if ($information[6] != 0) {
                    $exam_question_no   = explode(",", $information[6]);
                } else if ($information[6] == 0) {
                    print "<pre style='font-size: 15px; color: red;'>Some information missing</pre>";

                    exit(1);
                }

                $degree_code        = $information[0];
                $course_code        = $information[1];
                $semester_code      = $information[2];
                $subject_code       = $information[3];
                $module_code        = $information[4];
                $level_code         = $information[5];

                $data['exam_date']  = $information[7];
            } else {
                $degree_code        = $this->input->post('degree_code');
                $course_code        = $this->input->post('course_code');
                $subject_code       = $this->input->post('subject_code');
                $level_code         = $this->input->post('level_code');
                $semester_code      = $this->input->post('semester_code');
                $module_code        = $this->input->post('module_code');
                $exam_question_no   = explode(",", $this->input->post('exam_question_no'));
            }
            $status = "view_correct_response";

            $data['correct_answers'] = $this->Online_exam_model->fetchQuestions($degree_code, $course_code, $subject_code, $level_code, $semester_code, $module_code, $exam_question_no, $status);

            $data['degree_code']    = $degree_code;
            $data['course_code']    = $course_code;
            $data['subject_code']   = $subject_code;
            $data['level_code']     = $level_code;
            $data['semester_code']  = $semester_code;
            $data['module_code']    = $module_code;
        } else {
            print "<pre>Something went wrong ! Please try again !</pre>";
            exit(1);
        }

        $this->load->view($this->config->item('theme') . 'online_exam_corner/correct_response_view', $data);
    }

    public function get_course($degree_code = NULL)
    {
        if (is_numeric($degree_code)) {
            $data['courses'] = $this->Add_subject_model->get_course_query($degree_code);
            $this->load->view($this->config->item('theme') . 'ajax_view/course_ajax_view', $data);
        } else { ?>
            <script>
                alert("Something Went Wrong...Please Provide Valid Course");
            </script>
        <?php }
    }


    public function get_semester($course_code)
    {
        if (is_numeric($course_code)) {
            $data['semester'] = $this->Online_exam_model->get_semester_query($course_code);
            $this->load->view($this->config->item('theme') . 'ajax_view/semester_exam_ajax_view', $data);
        } else { ?>
            <script>
                alert("Something Went Wrong...Please Provide Valid Course");
            </script>
        <?php }
    }



    public function get_subject($semester_id)
    {
        if (is_numeric($semester_id)) {
            $data['subjects'] = $this->Online_exam_model->get_subject_query($semester_id);
            $this->load->view($this->config->item('theme') . 'ajax_view/subject_ajax_view', $data);
        } else { ?>
            <script>
                alert("Something Went Wrong...Please Provide Valid Course");
            </script>
        <?php }
    }


    public function get_module($subject_code)
    {
        if (is_numeric($subject_code)) {
            $data['modules'] = $this->Online_exam_model->get_module_query($subject_code);
            $this->load->view($this->config->item('theme') . 'ajax_view/module_exam_ajax_view', $data);
        } else { ?>
            <script>
                alert("Something Went Wrong...Please Provide Valid Course");
            </script>
        <?php }
    }

    public function get_level($module_code)
    {
        if (is_numeric($module_code)) {
            $data['levels'] = $this->Online_exam_model->get_level_query($module_code);
            $this->load->view($this->config->item('theme') . 'ajax_view/level_ajax_view', $data);
        } else { ?>
            <script>
                alert("Something Went Wrong...Please Provide Valid Course");
            </script>
<?php }
    }
}
