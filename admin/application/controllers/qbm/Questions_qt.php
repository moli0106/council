<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Questions_qt extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(104);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('qbm/questions_qt_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/select2/dist/css/select2.min.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . "qbm/question_qt.js",
            2 => $this->config->item('theme_uri') . 'bower_components/select2/dist/js/select2.full.min.js',
            3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
        );
    }

    public function index($offset = 0)
    {
        $data['subject_id_hash'] = $this->input->get('sub');
        if (!empty($data['subject_id_hash'])) {

            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
            
            $data['semesterList'] = $this->questions_qt_model->getSemesterListBySubjectId($data['subject_id_hash']);
          
            $data['questionListCount'] = $this->questions_qt_model->getSubjectQuestionListCount($stake_details_id_fk, $data['subject_id_hash'])[0]['count'];
            $data['questionList'] = $this->questions_qt_model->getSubjectQuestionList($stake_details_id_fk, $data['subject_id_hash']);


            $data['questionCategoryList'] = $this->questions_qt_model->getSubjectQuestionCategoryList($data['subject_id_hash']);

            $this->load->view($this->config->item('theme') . 'qbm/question_translator/question_list_view', $data);
        } else {
            redirect(base_url('admin/qbm/questions_qt/subjects'));
        }
    }

    public function getQuestionListBySemSubj()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $semester_id = $this->input->get('semester_id');
            $subject_id_hash = $this->input->get('subject_id');

            $forwardQuestionBtnStatus = $this->input->get('forwardQuestionBtnStatus');

            if (!empty($subject_id_hash) && !empty($semester_id)) {

                if (isset($forwardQuestionBtnStatus) && ($forwardQuestionBtnStatus == 1)) {
                    $this->forwardQuestionSet($semester_id, $subject_id_hash);
                }

                $count = 0;
                $forwardQuestionStatus = 1;
                $htmlView_questionList = $htmlView_questionCategoryList = $forwardQuestionBtn = '';

                $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

                $questionList = $this->questions_qt_model->getSubjectQuestionListBySem($stake_details_id_fk, $subject_id_hash, $semester_id);
                //$questionCategoryList = $this->questions_qt_model->getSubjectQuestionCategoryList($subject_id_hash);
				$questionCategoryList = $this->questions_qt_model->getSubjectQuestionCategoryList_by_sem($subject_id_hash,$semester_id);   // Added by Waseem on 07-02-2022

                $allCategoryList = array_fill_keys(array_keys(array_flip(array_column($questionCategoryList, 'question_type_mark_id_pk'))), 0);

                if (!empty($questionList)) {
                    foreach ($questionList as $key => $question) {

                        if ($semester_id != 'All') {
                            $allCategoryList[$question['question_type_mark_id_pk']] += 1;
                        }
                        if($question['other_lan_quesstion_status']==1){
                            $muli_button='<button class="btn btn-info btn-xs btn-flat add-multi-lang-question" data-toggle="modal" data-target="#modal-question-details">Multi Lang.</button>';
                            $approve_btn='<button class="btn btn-success btn-xs btn-flat approve-question">Approved</button>';
                        }else{
                            $muli_button='<button class="btn btn-warning btn-xs btn-flat add-multi-lang-question" data-toggle="modal" data-target="#modal-question-details">Multi Lang.</button>';
                            $approve_btn='';
                        }

                        $htmlView_questionList .= '
                            <tr id="' . md5($question['question_id_pk']) . '">
                                <td>' . ++$count . '.</td>
                                <td>' . $question['semester_name'] . '</td>
                                <td>' . $question['subject_name'] . ' [' . $question['subject_code'] . ']</td>
                                <td>' . $question['topics_chapter_name'] . '</td>
                                <td>' . $question['question_type_name'] . ' [' . $question['question_mark'] . ']</td>
                                <td style="width: 13%;">
                                    <button class="btn bg-navy btn-xs btn-flat view-question-details" data-toggle="modal" data-target="#modal-question-details">Details/Edit</button>
                                    ' . $muli_button . '
                                    '.$approve_btn.'
                                </td>
                            </tr>
                        ';
                    }
                } else {
                    $htmlView_questionList = '<tr><td colspan="11" align="center" class="text-danger">No Data Found...</td></tr>';
                }

                foreach ($questionCategoryList as $key => $value) {

                    if ($semester_id != 'All') {
                        $enteredQuestion = $allCategoryList[$value['question_type_mark_id_pk']] ;

                        if ($value['min_no_of_question'] > $enteredQuestion) {
                            $forwardQuestionStatus = 0;
                        }
                    } else {
                        $enteredQuestion = '';
                        $forwardQuestionStatus = 0;
                    }

                    $htmlView_questionCategoryList .= '
                        <div class="col-md-6">
                            <ul class="nav nav-pills nav-stacked">
                                <li>
                                    <a href="javascript:void(0)">
                                        <i class="fa fa-circle-o text-red"></i>
                                        ' . $value['question_type_name'] . ' <b>['.$value['semester_name']. ']</b>
                                        <span class="pull-right">' . $enteredQuestion .'/'. $value['min_no_of_question'] . '</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    ';
                }

                //if ($forwardQuestionStatus == 1) {
                    $forwardQuestionBtn = '
                        <button class="btn btn-sm btn-block btn-flat bg-maroon" id="forwardQuestionBtn">
                            <i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; Approve All Questions
                        </button>
                    ';
               // }

                echo json_encode(array(
                    'questionList' => $htmlView_questionList,
                    //'forwardQuestionBtn' => $forwardQuestionBtn,
                    'questionCategoryList' => $htmlView_questionCategoryList,
                ));
            }
        }
    }

    public function forwardQuestionSet($semester_id = NULL, $subject_id_hash = NULL)
    {
        $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

        $this->questions_qt_model->forwardQuestionSet($stake_details_id_fk, $subject_id_hash, $semester_id);

        return TRUE;
    }

    public function question_details($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if (!empty($id_hash)) {

                $data['question_details'] = $this->questions_qt_model->getEngQuestionList($id_hash);
                $data['question_category'] = $this->questions_qt_model->getQuestionCategory();
                if (!empty($data['question_details'])) {

                    $html_view = $this->load->view($this->config->item('theme') . 'qbm/question_translator/ajax/question_details_view', $data, TRUE);

                    echo json_encode($html_view);
                }
            }
        }
    }

    


    public function addMultiLangQuestion($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            if ($this->input->server('REQUEST_METHOD') == 'POST') {

                $question_details = $this->questions_qt_model->getEngQuestionList($id_hash);
                $other_question_details = $this->questions_qt_model->getOtherQuestionList($id_hash);

                $data['eng_question'] = $this->input->post('eng_question');
                $data['other_question'] = $this->input->post('other_question');
                $data['question'] = $this->input->post('question');
                $data['question_clue'] = $this->input->post('question_clue');
                $data['per_question_marks'] = $this->input->post('per_question_marks');
                $data['q_type'] = $this->input->post('q_type');

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                foreach ($data['question'] as $key => $question) {

                    $question_pic = NULL;
                    $file_validation_err = 0;
                    $max_size = 502400; // 100KB Size

                    if ($_FILES['question_pic']['name'][$key] != '') {

                        $file_name = $_FILES['question_pic']['name'][$key];
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                        if ($_FILES['question_pic']['size'][$key] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                            $file_validation_err = 1;
                            $data['file_error'] = "Max 100 kb and image format should be JPG/JPEG";
                        } else {
                            $question_pic = base64_encode(file_get_contents($_FILES["question_pic"]['tmp_name'][$key]));
                        }
                    }
					 if ($_FILES['answer_pic']['name'][$key] != '') {

                        $file_name = $_FILES['answer_pic']['name'][$key];
                        $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                        if ($_FILES['answer_pic']['size'][$key] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                            $file_validation_err = 1;
                            $data['file_error'] = "Max 100 kb and JPG/JPEG";
                        } else {
                            $answer_pic = base64_encode(file_get_contents($_FILES["answer_pic"]['tmp_name'][$key]));
                        }
                    }


                    if ($file_validation_err == 0) {
                        if (!empty($question) && !empty($data['question_clue'][$key])) {

                            $other_question_array = array(
                                'question_id_fk' => $question_details[0]['question_id_pk'],
                                'question' => $question,
                                'question_clue' => $data['question_clue'][$key],
                                'question_pic' => $question_pic,
								'answer_pic' => $answer_pic,
                                'per_question_marks' => $data['per_question_marks'][$key],
                                'eng_question_id_fk' => $data['eng_question'][$key],
                                'q_type'             => $data['q_type'][$key],
                            );

                            if (!empty($other_question_details)) {

                                $other_question_array['updated_time'] = "now()";
                                $other_question_array['updated_ip'] = $this->input->ip_address();
                                $other_question_array['updated_by'] = $this->session->userdata('stake_details_id_fk');

                                $this->questions_qt_model->update_other_question($data['other_question'][$key], $other_question_array);
                            } else {

                                $other_question_array['entry_time'] = "now()";
                                $other_question_array['entry_ip'] = $this->input->ip_address();
                                $other_question_array['entry_by'] = $this->session->userdata('stake_details_id_fk');

                                $this->questions_qt_model->insert_other_question($other_question_array);
                            }
                        } else {
                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question, Please try after sometime.');

                            $this->db->trans_rollback();

                            redirect(base_url('admin/qbm/questions_qt?sub=' . md5($question_details[0]['subject_id'])));
                            exit();
                        }
                    } else {
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', $data['file_error']);

                        redirect(base_url('admin/qbm/questions_qt?sub=' . md5($question_details[0]['subject_id'])));
                    }
                }

                $this->questions_qt_model->updateQuestionBank($question_details[0]['question_id_pk'], array("other_lan_quesstion_status" => 1));

                // ! Check All Query For Trainee
                if ($this->db->trans_status() === FALSE) {
                    # Something went wrong.
                    $this->db->trans_rollback();

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question, Please try after sometime.');
                } else {
                    # Everything is Perfect. Committing data to the database.
                    $this->db->trans_commit();

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Question has been added successfully.');
                }

                redirect(base_url('admin/qbm/questions_qt?sub=' . md5($question_details[0]['subject_id'])));
            } else {
                exit('No direct script access allowed');
            }
        } else {
            if (!empty($id_hash)) {

                $data['question_details'] = $this->questions_qt_model->getEngQuestionList($id_hash);
                $data['other_question_details'] = $this->questions_qt_model->getOtherQuestionList($id_hash);

                if (!empty($data['question_details'])) {

                    $data['question_category'] = $this->questions_qt_model->getQuestionCategory();

                    $html_view = $this->load->view($this->config->item('theme') . 'qbm/question_translator/ajax/question_add_multi_lang_view', $data, TRUE);

                    echo json_encode($html_view);
                }
            }
        }
    }



    public function updateEngQuestion($id_hash = NULL)
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $question_details = $this->questions_qt_model->getEngQuestionList($id_hash);

            $data['question'] = $this->input->post('question');
            $data['question_clue'] = $this->input->post('question_clue');
            $data['per_question_marks'] = $this->input->post('per_question_marks');
            $data['q_type'] = $this->input->post('q_type');
            $data['eng_question_id'] = $this->input->post('eng_question_id');

            foreach ($data['question'] as $key => $question) {

                $question_pic = NULL;
                $file_validation_err = 0;
                $max_size = 502400; // 100KB Size

                if ($_FILES['question_pic']['name'][$key] != '') {

                    $file_name = $_FILES['question_pic']['name'][$key];
                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                    if ($_FILES['question_pic']['size'][$key] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                        $file_validation_err = 1;
                        $data['file_error'] = "Max 100 kb and JPG/JPEG";
                    } else {
                        $question_pic = base64_encode(file_get_contents($_FILES["question_pic"]['tmp_name'][$key]));
                    }
                }
				if ($_FILES['answer_pic']['name'][$key] != '') {

                    $file_name = $_FILES['answer_pic']['name'][$key];
                    $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                    if ($_FILES['answer_pic']['size'][$key] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                        $file_validation_err = 1;
                        $data['file_error'] = "Max 100 kb and JPG/JPEG";
                    } else {
                        $answer_pic = base64_encode(file_get_contents($_FILES["answer_pic"]['tmp_name'][$key]));
                    }
                }

                if ($file_validation_err == 0) {
                    if (!empty($question) && !empty($data['question_clue'][$key])) {

                        $eng_question_id_hash = $data['eng_question_id'][$key];

                        $updateArray = array(
                            'question'           => $question,
                            'question_clue'      => $data['question_clue'][$key],
                            'per_question_marks' => $data['per_question_marks'][$key],
                            'q_type'             => $data['q_type'][$key],
                            'updated_time'       => "now()",
                            'updated_by'         => $this->session->userdata('stake_details_id_fk'),
                            'updated_ip'         => $this->input->ip_address(),
                        );

                        if ($_FILES['question_pic']['name'][$key] != '') {
                            $updateArray['question_pic'] = $question_pic;
                        }
						 if ($_FILES['answer_pic']['name'][$key] != '') {
                            $updateArray['answer_pic'] = $answer_pic;
                        }
                    } else {
                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question, Please try after sometime.');

                        redirect(base_url('admin/qbm/questions_qt?sub=' . md5($question_details[0]['subject_id'])));
                        exit();
                    }
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Please provide valid file(JPG/JPEG) within mentioned size');

                    redirect(base_url('admin/qbm/questions_qt?sub=' . md5($question_details[0]['subject_id'])));
                    exit();
                }

                $this->questions_qt_model->updateEngQuestionBank($eng_question_id_hash, $updateArray);
            }

            $this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('alert_msg', 'Question has been Updated successfully.');

            redirect(base_url('admin/qbm/questions_qt?sub=' . md5($question_details[0]['subject_id'])));
        } else {
            redirect(base_url('admin/qbm/questions_qt'));
        }
    }

    public function eng_question_image($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $eng_question_details = $this->questions_qt_model->getEngQuestionDetails($id_hash);
            if (!empty($eng_question_details)) {

                $question_pic = $eng_question_details[0]['question_pic'];

                $img_name = 'IMG-' . date('Ymd') . '-' . date('his') . '.JPG';

                header("Content-type:image/jpeg");

                header("Content-Disposition:attachment;filename=" . $img_name);

                echo base64_decode($question_pic);
            }
        } else {
            redirect('admin/qbm_question/manage_question');
        }
    }

    public function other_question_image($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $eng_question_details = $this->questions_qt_model->getOtherQuestionDetails($id_hash);
            if (!empty($eng_question_details)) {

                $question_pic = $eng_question_details[0]['question_pic'];

                $img_name = 'IMG-' . date('Ymd') . '-' . date('his') . '.JPG';

                header("Content-type:image/jpeg");

                header("Content-Disposition:attachment;filename=" . $img_name);

                echo base64_decode($question_pic);
            }
        } else {
            redirect('admin/qbm_question/manage_question');
        }
    }

    public function remove_question($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if (!empty($id_hash)) {

                $question_details = $this->questions_qt_model->getEngQuestionList($id_hash);
                if (!empty($question_details)) {

                    $update_status = $this->questions_qt_model->removeQuestionBank($id_hash, array('process_status_id_fk' => 6));
                    if ($update_status) {

                        // $this->manage_question_model->removeEngQuestionList($id_hash, array('active_status' => 0));

                        echo json_encode($question_details);
                    }
                }
            }
        }
    }

    public function courses()
    {
        $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
        $data['courseList'] = $this->questions_qt_model->getCourseListWithSemester($stake_details_id_fk);

        $this->load->view($this->config->item('theme') . 'qbm/question_translator/course_list_view', $data);
    }

    public function subjects()
    {
        $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

        $data['subjectList'] = $this->questions_qt_model->getCreatorSubjectList($stake_details_id_fk);

        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'qbm/question_translator/subject_list_view', $data);
    }

    public function add()
    {
        $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
        $data['courseList'] = $this->questions_qt_model->getCourseList($stake_details_id_fk);

        $this->load->view($this->config->item('theme') . 'qbm/question_translator/question_add_view', $data);
    }

    public function create()
    {
        $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
        $data['courseList'] = $this->questions_qt_model->getCourseList($stake_details_id_fk);

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            // ! Create GET data for store value in url
            $crk = $this->input->post('course_id');
            $syrk = $this->input->post('sam_year_id');
            $srk = $this->input->post('subject_id');
            $strk = $this->input->post('subject_topics_id');
            $qtmrk = $this->input->post('question_type_marks');

            $url_data = "crk=$crk&syrk=$syrk&srk=$srk&strk=$strk&qtmrk=$qtmrk";

            $data['q_type'] = $this->input->post('q_type');
            $data['question'] = $this->input->post('question');
            $data['question_clue'] = $this->input->post('question_clue');
            $data['per_question_marks'] = $this->input->post('per_question_marks');

            $config = array(
                array(
                    'field' => 'course_id',
                    'label' => 'Course',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'sam_year_id',
                    'label' => 'Semester/Year',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'subject_id',
                    'label' => 'Subject',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'subject_topics_id',
                    'label' => 'Subject Topic/Chapter',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'question_type_marks',
                    'label' => 'Question Category/Type',
                    'rules' => 'trim|required|numeric'
                )
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question, Please try after sometime.');
                // parent::pre(validation_errors());
                redirect(base_url('admin/qbm/questions/add?' . $url_data));
            } else {

                $question_bank_array = array(
                    'course_id' => $this->input->post('course_id'),
                    'sam_year_id' => $this->input->post('sam_year_id'),
                    'discipline_id' => NULL,
                    'group_trade_id' => NULL,
                    'subject_group_id' => NULL,
                    'subject_id' => $this->input->post('subject_id'),
                    'topic_chapter_id' => $this->input->post('subject_topics_id'),
                    'question_type_mark_id' => $this->input->post('question_type_marks'),
                    'total_no_of_question' => count($this->input->post('question')),
                    'entry_time' => "now()",
                    'entry_ip' => $this->input->ip_address(),
                    'entry_by' => $this->session->userdata('stake_details_id_fk'),
                );

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $question_id = $this->questions_qt_model->insert_question_bank($question_bank_array);
                if ($question_id) {

                    foreach ($data['question'] as $key => $question) {

                        $question_pic = NULL;
                        $file_validation_err = 0;
                        $max_size = 502400; // 100KB Size

                        if ($_FILES['question_pic']['name'][$key] != '') {

                            $file_name = $_FILES['question_pic']['name'][$key];
                            $extension = pathinfo($file_name, PATHINFO_EXTENSION);

                            if ($_FILES['question_pic']['size'][$key] > $max_size || (strtoupper($extension) != "JPG" && strtoupper($extension) != "JPEG")) {
                                $file_validation_err = 1;
                                $data['file_error'] = "Max 100 kb and image format should be JPG/JPEG";
                            } else {
                                $question_pic = base64_encode(file_get_contents($_FILES["question_pic"]['tmp_name'][$key]));
                            }
                        }

                        if ($file_validation_err == 0) {

                            if (!empty($_FILES['question_pic']['tmp_name'][$key])) {
                                $question_pic = base64_encode(file_get_contents($_FILES["question_pic"]['tmp_name'][$key]));
                            }

                            $eng_question_array = array(
                                'question_id_fk' => $question_id,
                                'question' => $question,
                                'question_clue' => $data['question_clue'][$key],
                                'question_pic' => $question_pic,
                                'question_pic' => $question_pic,
                                'per_question_marks' => $data['per_question_marks'][$key],
                                'q_type' => $data['q_type'][$key],
                                'entry_time' => "now()",
                                'entry_ip' => $this->input->ip_address(),
                                'entry_by' => $this->session->userdata('stake_details_id_fk'),
                            );

                            $this->questions_qt_model->insert_eng_question($eng_question_array);
                        } else {
                            $this->db->trans_rollback();

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', $data['file_error']);

                            redirect(base_url('admin/qbm/questions/add?' . $url_data));
                        }
                    }

                    // ! Completing transaction
                    $this->db->trans_complete(); # Completing transaction

                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {
                        # Something went wrong.
                        $this->db->trans_rollback();

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question, Please try after sometime.');
                    } else {
                        # Everything is Perfect. Committing data to the database.
                        $this->db->trans_commit();

                        $this->session->set_flashdata('status', 'success');
                        $this->session->set_flashdata('alert_msg', 'Question has been added successfully.');
                    }
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question, Please try after sometime.');
                }

                redirect(base_url('admin/qbm/questions/add?' . $url_data));
            }
        } else {
            redirect(base_url('admin/qbm/questions/add'));
        }
    }



    public function get_semester_subject_list()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_id = $this->input->get('course_id');
            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

            if (!empty($course_id)) {

                $semester_list = $this->questions_qt_model->getSemesterList($stake_details_id_fk, $course_id);
                $subject_list = $this->questions_qt_model->getSubjectListByCourseId($stake_details_id_fk, $course_id);

                $semester_html_view = '<option value="">-- Select Semester/Year --</option>';
                $subject_html_view = '<option value="">-- Select Subject --</option>';

                if (!empty($semester_list) && !empty($subject_list)) {
                    foreach ($semester_list as $key => $value) {

                        $semester_html_view .= '
							<option value="' . $value['semester_id_pk'] . '">
								' . $value['semester_name'] . '
							</option>
						';
                    }

                    foreach ($subject_list as $key => $value) {

                        $subject_html_view .= '
                            <option value="' . $value['subject_id_pk'] . '">
                                ' . $value['subject_name'] . ' [' . $value['subject_code'] . ']
                            </option>
						';
                    }
                } else {
                    $semester_html_view .= '<option value="" disabled="true">No data found...</option>';
                    $subject_html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode(array(
                    'semester_html_view' => $semester_html_view,
                    'subject_html_view' => $subject_html_view,
                ));
            }
        }
    }

    public function get_disciplines()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_id = $this->input->get('course_id');
            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

            if (!empty($course_id)) {

                $discipline_list = $this->questions_qt_model->getDisciplineList($stake_details_id_fk, $course_id);
                $semester_list = $this->questions_qt_model->getSemesterList($stake_details_id_fk, $course_id);

                $discipline_html_view = '<option value="">-- Select Discipline --</option>';
                $semester_html_view = '<option value="">-- Select Semester/Year --</option>';

                if (!empty($discipline_list) && !empty($semester_list)) {
                    foreach ($discipline_list as $key => $value) {

                        $discipline_html_view .= '
							<option value="' . $value['discipline_id_pk'] . '">
								' . $value['discipline_name'] . ' [' . $value['discipline_code'] . ']
							</option>
						';
                    }

                    foreach ($semester_list as $key => $value) {

                        $semester_html_view .= '
							<option value="' . $value['semester_id_pk'] . '">
								' . $value['semester_name'] . '
							</option>
						';
                    }
                } else {
                    $discipline_html_view .= '<option value="" disabled="true">No data found...</option>';
                    $semester_html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode(array(
                    'discipline_html_view' => $discipline_html_view,
                    'semester_html_view' => $semester_html_view,
                ));
            }
        }
    }

    public function get_subject()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_id = $this->input->get('course_id');
            $discipline_id = $this->input->get('discipline_id');
            $sam_year_id = $this->input->get('sam_year_id');
            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

            if (!empty($discipline_id) && !empty($sam_year_id)) {
                $subject_list = $this->questions_qt_model->getSubjectList($course_id, $stake_details_id_fk, $discipline_id, $sam_year_id);

                $html_view = '<option value="">-- Select Subject --</option>';

                if (!empty($subject_list)) {
                    foreach ($subject_list as $key => $value) {

                        $html_view .= '
                        <option value="' . $value['subject_id_pk'] . '">
                            ' . $value['subject_name'] . ' [' . $value['subject_code'] . ']
                        </option>
                    ';
                    }
                } else {
                    $html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($html_view);
            }
        }
    }

    public function get_group_trade()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $discipline_id = $this->input->get('discipline_id');
            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

            if (!empty($discipline_id)) {
                $group_trade_list = $this->questions_qt_model->getGroupTradeList($stake_details_id_fk, $discipline_id);

                $html_view = '<option value="">-- Select Group/Trade --</option>';

                if (!empty($group_trade_list)) {
                    foreach ($group_trade_list as $key => $value) {

                        $html_view .= '
							<option value="' . $value['group_trade_id_pk'] . '">
								' . $value['group_trade_name'] . ' [' . $value['group_trade_code'] . ']
							</option>
						';
                    }
                } else {
                    $html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($html_view);
            }
        }
    }

    public function get_subject_group_category()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $subject_group_list = $this->questions_qt_model->getSubjectGroupCategory();
            $html_view = '<option value="">-- Select Group/Category --</option>';

            if (!empty($subject_group_list)) {
                foreach ($subject_group_list as $key => $value) {

                    $html_view .= '
							<option value="' . $value['subject_category_id_pk'] . '">
								' . $value['subject_category_name'] . ' 
							</option>
						';
                }
            } else {
                $html_view .= '<option value="" disabled="true">No data found...</option>';
            }

            echo json_encode($html_view);
        }
    }

    public function get_subject_by_subject_group_trade()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $group_trade_id = $this->input->get('group_trade_id');
            $subject_group_id = $this->input->get('subject_group_id');

            if (!empty($group_trade_id) && !empty($subject_group_id)) {
                $subject_list = $this->questions_qt_model->getSubjectBySubjectGroupTrade($group_trade_id, $subject_group_id);

                $html_view = '<option value="">-- Select Subject --</option>';

                if (!empty($subject_list)) {
                    foreach ($subject_list as $key => $value) {

                        $html_view .= '
                        <option value="' . $value['subject_id_pk'] . '">
                            ' . $value['subject_name'] . ' [' . $value['subject_code'] . ']
                        </option>
                    ';
                    }
                } else {
                    $html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($html_view);
            }
        }
    }

    public function get_topic_chapter()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $subject_id = $this->input->get('subject_id');
            $sam_year_id = $this->input->get('sam_year_id');
            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');

            if (!empty($subject_id)) {
                $topic_list = $this->questions_qt_model->getTopicChapterList($subject_id, $sam_year_id);
                $subjectQuestionTypeMark = $this->questions_qt_model->getSubjectQuestionTypeMark($subject_id,$sam_year_id);

                $html_view_topic = '<option value="">-- Select Topic/Chapter --</option>';
                $html_view_QuestionTypeMark = '<option value="">-- Select Question Category/Type --</option>';

                if (!empty($topic_list)) {
                    foreach ($topic_list as $key => $value) {

                        $html_view_topic .= '
                        <option value="' . $value['subject_topics_map_id_pk'] . '">
                            ' . $value['topics_chapter_name'] . '
                        </option>
                    ';
                    }
                } else {
                    $html_view_topic .= '<option value="" disabled="true">No data found...</option>';
                }

                if (!empty($subjectQuestionTypeMark)) {
                    foreach ($subjectQuestionTypeMark as $key => $value) {

                        $html_view_QuestionTypeMark .= '
                        <option value="' . $value['question_type_mark_id_pk'] . '" data-marks="' . $value['question_mark'] . '">
                            ' . $value['question_type_name'] . '
                            [' . $value['question_mark'] . ']
                        </option>
                    ';
                    }
                } else {
                    $html_view_QuestionTypeMark .= '<option value="" disabled="true">No data found...</option>';
                }

                $response = array(
                    'html_view_topic' => $html_view_topic,
                    'html_view_QuestionTypeMark' => $html_view_QuestionTypeMark,
                );
                echo json_encode($response);
            }
        }
    }


    //Added by on 15-02-2022

	public function download_hs_question_file_old(){
        $data['subject_id_hash'] = $this->input->get('sub');
        if (!empty($data['subject_id_hash'])) {

            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
            $data['semesterList'] = $this->questions_qt_model->getSemesterListBySubjectId($data['subject_id_hash']);
            
			$data['subject_name'] = $this->questions_qt_model->getSubjectName($data['subject_id_hash'])[0];
            $data['questionListCount'] = $this->questions_qt_model->getSubjectQuestionListCount($stake_details_id_fk, $data['subject_id_hash'])[0]['count'];
            $data['questionList'] = $this->questions_qt_model->getSubjectQuestionList($stake_details_id_fk, $data['subject_id_hash']);
            $data['questionCategoryList'] = $this->questions_qt_model->getSubjectQuestionCategoryList($data['subject_id_hash']);
			$data['subject_cat_id'] = $this->questions_qt_model->getSubjectCategory($data['subject_id_hash'])[0];

            
            foreach ($data['questionList'] as $key => $value) {
                $question_id_pk = md5($value['question_id_pk']);
                $question_details = $this->questions_qt_model->getEngQuestionList($question_id_pk);
                $data['questionList'][$key]['question_details'] = $question_details;
            }
            // echo "<pre>";print_r($data);exit;
            $html   = $this->load->view($this->config->item('theme') . 'qbm/question_translator/question_pdf_for_hs', $data, true);
            $pdfFilePath = 'HS-Question-' . date('dmY') . ".pdf";

            $this->load->library('m_pdf');
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->showWatermarkText = true;
            $this->m_pdf->pdf->AddPage('L');
            $this->m_pdf->pdf->WriteHTML(utf8_encode($html));

            $this->m_pdf->pdf->Output($pdfFilePath, 'I');
            //$this->m_pdf->pdf->Output($pdfFilePath, "D");
            // $this->m_pdf->pdf->Output();
        }
         
    }
	
	/*public function download_hs_question_file(){
        $data['subject_id_hash'] = $this->input->get('sub');
        if (!empty($data['subject_id_hash'])) {

            $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
            $stake_id_fk = $this->session->userdata('stake_id_fk');
            $data['semesterList'] = $this->questions_qt_model->getSemesterListBySubjectId($data['subject_id_hash']);
            
            $data['subject_name'] = $this->questions_qt_model->getSubjectName($data['subject_id_hash'])[0];
            $data['questionListCount'] = $this->questions_qt_model->getSubjectQuestionListCount($stake_details_id_fk, $data['subject_id_hash'])[0]['count'];
            $data['questionList'] = $this->questions_qt_model->getSubjectQuestionList($stake_details_id_fk, $data['subject_id_hash']);
            $data['questionCategoryList'] = $this->questions_qt_model->getSubjectQuestionCategoryList($data['subject_id_hash']);
            $data['subject_cat_id'] = $this->questions_qt_model->getSubjectCategory($data['subject_id_hash'])[0];

            
            foreach ($data['questionList'] as $key => $value) {
                $question_id_pk = md5($value['question_id_pk']);
                $question_details = $this->questions_qt_model->getEngBengQuestionList($question_id_pk);
                $data['questionList'][$key]['question_details'] = $question_details;
            }
            
            // echo "<pre>";print_r($download_log_data);exit;
            $html   = $this->load->view($this->config->item('theme') . 'qbm/question_translator/question_pdf_for_hs', $data, true);
            $pdfFilePath = 'HS-Question-' . date('dmY') . ".pdf";

            $this->load->library('m_pdf');
            $this->m_pdf->pdf->Mpdf([
                'default_font' => 'nikosh'
            ]);
            $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
            $this->m_pdf->pdf->showWatermarkText = true;
			$this->m_pdf->pdf->AddPage('L');

            $this->m_pdf->pdf->WriteHTML($html,'UTF-16');

            //$this->m_pdf->pdf->Output($pdfFilePath, 'I');
            $this->m_pdf->pdf->Output($pdfFilePath, "D");
            // $this->m_pdf->pdf->Output();

            // Insert Data into log table
            $download_log_data=array(
                'subject_id_fk'         		=> $data['subject_name']['subject_id_pk'],
                'download_ip'               	=> $this->input->ip_address(),
                'download_time'         		=>date('Y-m-d H:i:s'),
                'downloaded_by_stake_id'        =>$stake_id_fk,
                'downloaded_by_stake_details_id'=> $this->session->userdata('stake_holder_login_id_pk')
            );
            $this->questions_qt_model->insert_download_log_data($download_log_data);
           
        }
         
    }*/


	public function download_question_pdf_file(){

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $semester_id = $this->input->post('qb_list_semester_id');
            $subject_id_hash = $this->input->post('subject_id_hash');
            if (!empty($subject_id_hash) && !empty($semester_id)) {

                $stake_details_id_fk = $this->session->userdata('stake_details_id_fk');
                $stake_id_fk = $this->session->userdata('stake_id_fk');

                $data['semester_details'] = $this->questions_qt_model->getSemesterDetails(md5($semester_id))[0];
                $data['subject_name'] = $this->questions_qt_model->getSubjectName($subject_id_hash)[0];
                $data['questionList'] = $this->questions_qt_model->getSubjectQuestionListBySem($stake_details_id_fk, $subject_id_hash, $semester_id);
                $data['questionCategoryList'] = $this->questions_qt_model->getSubjectQuestionCategoryList_by_sem($subject_id_hash,$semester_id);

                if(!empty($data['questionList'])){

                    foreach ($data['questionList'] as $key => $value) {
                        $question_id_pk = md5($value['question_id_pk']);
                        $question_details = $this->questions_qt_model->getEngBengQuestionList($question_id_pk);
                        $data['questionList'][$key]['question_details'] = $question_details;
                    }
                    
                    // echo "<pre>";print_r( $data['questionList']);exit;
                    $html   = $this->load->view($this->config->item('theme') . 'qbm/question_translator/question_pdf_for_hs', $data, true);
                    $pdfFilePath = 'HS-Question-' . date('dmY') . ".pdf";
        
                    $this->load->library('m_pdf');
                    $this->m_pdf->pdf->Mpdf([
                        'default_font' => 'FreeSerif'
                    ]);
                    $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
                    $this->m_pdf->pdf->showWatermarkText = true;
                    $this->m_pdf->pdf->AddPage('L');
        
                    $this->m_pdf->pdf->WriteHTML($html,'UTF-16');
        
                    // $this->m_pdf->pdf->Output($pdfFilePath, 'I');
                    $this->m_pdf->pdf->Output($pdfFilePath, "D");
                    // $this->m_pdf->pdf->Output();
        
                    // Insert Data into log table
                    $download_log_data=array(
                        'subject_id_fk'                 => $data['subject_name']['subject_id_pk'],
						'sem_id_fk'                 	=> $semester_id,
                        'download_ip'                   => $this->input->ip_address(),
                        'download_time'                 =>date('Y-m-d H:i:s'),
                        'downloaded_by_stake_id'        =>$stake_id_fk,
                        'downloaded_by_stake_details_id'=> $this->session->userdata('stake_holder_login_id_pk')
                    );
                    $this->questions_qt_model->insert_download_log_data($download_log_data);
                }else{
                        
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Questions are not available');

                    redirect(base_url('admin/qbm/questions_qt/subjects'), 'refresh');
                    exit();
                }
            }

        }
    }


   public function approve_question($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if (!empty($id_hash)) {

                $question_details = $this->questions_qt_model->getEngQuestionList($id_hash);
                if (!empty($question_details)) {

                    $update_status = $this->questions_qt_model->ApproveQuestionBank($id_hash, array('process_status_id_fk' => 18));
                    if ($update_status) {

                        // $this->manage_question_model->removeEngQuestionList($id_hash, array('active_status' => 0));

                        echo json_encode($question_details);
                    }
                }
            }
        }
    }
	
	public function getSemesterList($sub_id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else{
            if(!empty($sub_id_hash)){
                $data['semesterList'] = $this->questions_qt_model->getSemesterListBySubjectId($sub_id_hash);
                $data['subject_name'] = $this->questions_qt_model->getSubjectName($sub_id_hash)[0];
                if (!empty($data['semesterList'])) {

                    $html_view = $this->load->view($this->config->item('theme') . 'qbm/question_translator/ajax/pdf_download_view', $data,TRUE);

                    echo json_encode($html_view);
                }
            }
        }
        

    }
	


	public function eng_question_clue_image($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $eng_question_details = $this->questions_qt_model->getEngQuestionDetails($id_hash);
            if (!empty($eng_question_details)) {

                $answer_pic = $eng_question_details[0]['answer_pic'];

                $img_name = 'IMG-' . date('Ymd') . '-' . date('his') . '.JPG';

                header("Content-type:image/jpeg");

                header("Content-Disposition:attachment;filename=" . $img_name);

                echo base64_decode($answer_pic);
            }
        } else {
            redirect('admin/qbm_question/manage_question');
        }
    }

    public function other_question_clue_image($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $eng_question_details = $this->questions_qt_model->getOtherQuestionDetails($id_hash);
            if (!empty($eng_question_details)) {

                $answer_pic = $eng_question_details[0]['answer_pic'];

                $img_name = 'IMG-' . date('Ymd') . '-' . date('his') . '.JPG';

                header("Content-type:image/jpeg");

                header("Content-Disposition:attachment;filename=" . $img_name);

                echo base64_decode($answer_pic);
            }
        } else {
            redirect('admin/qbm_question/manage_question');
        }
    }
    
    public function eng_question_image_transfer($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $eng_question_details = $this->questions_qt_model->getEngQuestionDetails($id_hash);
            // echo "<pre>";print_r($question_details);die;
            if (!empty($eng_question_details)) {

                $question_pic = $eng_question_details[0]['question_pic'];
                if($question_pic !=''){

                    $updateArray = array(
                        'answer_pic'           => $question_pic,
                        'question_pic'           => Null,
                        
                    );
                    $this->questions_qt_model->updateEngQuestionImage(md5($eng_question_details[0]['eng_question_id_pk']), $updateArray);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Image has been transfered successfully.');
                    redirect(base_url('admin/qbm/questions_qt?sub=' . md5($eng_question_details[0]['subject_id'])));
                    exit();

                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Question Image is not available.');

                    redirect(base_url('admin/qbm/questions_qt?sub=' . md5($eng_question_details[0]['subject_id'])));
                    exit();
                }
                
            }
        } else {
            redirect('admin/qbm_question/manage_question');
        }
    }

    public function other_question_image_transfer($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $eng_question_details = $this->questions_qt_model->getOtherQuestionDetails($id_hash);
            //echo "<pre>";print_r($eng_question_details);die;
            if (!empty($eng_question_details)) {

                $question_pic = $eng_question_details[0]['question_pic'];
                if($question_pic !=''){

                    $updateArray = array(
                        'answer_pic'           => $question_pic,
                        'question_pic'           => Null,
                        
                    );
                    $this->questions_qt_model->updateotherQuestionImage(md5($eng_question_details[0]['other_question_id_pk']), $updateArray);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Image has been transfered successfully.');
                    redirect(base_url('admin/qbm/questions_qt?sub=' . md5($eng_question_details[0]['subject_id'])));
                    exit();

                }else{
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Question Image is not available.');

                    redirect(base_url('admin/qbm/questions_qt?sub=' . md5($eng_question_details[0]['subject_id'])));
                    exit();
                }
                
            }
        } else {
            redirect('admin/qbm_question/manage_question');
        }
    }



    
}
