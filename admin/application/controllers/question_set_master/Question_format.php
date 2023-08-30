<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_format extends NIC_Controller
{
    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(101);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('question_set_master/question_format_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'bower_components/select2/dist/css/select2.min.css',
            2 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/css/datepicker.css',
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'bower_components/select2/dist/js/select2.full.min.js',
            3 => $this->config->item('theme_uri') . 'bower_components/js-datepicker/js/datepicker.js',
            4 => $this->config->item('theme_uri') . 'question_set_master/question_format.js',
        );
    }

    public function index($offset = 0)
    {
        $data['offset'] = $offset;
        $this->load->library('pagination');

        $config['base_url']         = 'question_set_master/question_format/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->question_format_model->get_question_format_main_count()[0]['count'];
        $config['per_page']         = 25;
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
        $data['question_set_list'] = $this->question_format_model->getAll_question_format_main($config['per_page'], $offset);

        $this->load->view($this->config->item('theme') . 'question_set_master/question_format/question_format_list_view', $data);
    }

    public function add()
    {
        $data['courseList'] = $this->question_format_model->getCourseList();
        $data['timeAllowedList'] = $this->question_format_model->getTimeAllowed();
        $data['fullMarksList'] = $this->question_format_model->getFullMarks();

        $data['questionToBeAttamptList'] = $this->question_format_model->getQuestionToBeAttampt();
        $data['questionToBeSetList'] = $this->question_format_model->getQuestionToBeSet();
        $data['marksOfEachQuestionList'] = $this->question_format_model->getMarksOfEachQuestion();

        if ($this->input->server("REQUEST_METHOD") == "POST") {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

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
                    'field' => 'discipline_id',
                    'label' => 'Discipline',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'question_code_id',
                    'label' => 'Question Code',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'subject_name',
                    'label' => 'Subject Name',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'month_and_year',
                    'label' => 'Month & Year',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'time_allowed_id',
                    'label' => 'Time Allowed',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'full_marks_id',
                    'label' => 'Full Marks',
                    'rules' => 'trim|required|numeric'
                ),
            );
            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {

                $course_id = $this->input->post('course_id');
                $sam_year_id = $this->input->post('sam_year_id');
                $discipline_id = $this->input->post('discipline_id');
                $question_code_id = $this->input->post('question_code_id');

                if (!empty($course_id)) {
                    $data['semesterList'] = $this->question_format_model->getSemesterList($course_id);
                    $data['DisciplinetList'] = $this->question_format_model->getDisciplineList($course_id);
                }

                if (!empty($course_id) && !empty($sam_year_id) && !empty($discipline_id)) {
                    $data['questionCodeList'] = $this->question_format_model->getQuestionCodeList($course_id, $sam_year_id, $discipline_id);
                }

                if (!empty($question_code_id)) {

                    $getQuestionCodeDetails = $this->question_format_model->getQuestionCodeDetails($question_code_id)[0];
                    $data['questionTypeMarkList'] = $this->question_format_model->getQuestionTypeMarksList($question_code_id);

                    $data['subject_name'] = $getQuestionCodeDetails['subject_name'] . ' [' . $getQuestionCodeDetails['subject_code'] . ']';
                }

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Please enter all mandatory fields.');

                $this->load->view($this->config->item('theme') . 'question_set_master/question_format/question_format_add_view', $data);
            } else {

                $getQuestionCodeDetails = $questionFormatMainId = $this->question_format_model->getQuestionCodeDetails($this->input->post('question_code_id'));
                if (!empty($getQuestionCodeDetails)) {
                    $subject_id_fk = $getQuestionCodeDetails[0]['subject_id_pk'];
                } else {
                    $subject_id_fk = $getQuestionCodeDetails[0]['subject_id_pk'];
                }

                $questionFormatMainArray = array(
                    'course_id_fk' => $this->input->post('course_id'),
                    'sem_year_id_fk' => $this->input->post('sam_year_id'),
                    'discipline_id_fk' => $this->input->post('discipline_id'),
                    'question_code_id_fk' => $this->input->post('question_code_id'),
                    'subject_id_fk' => $subject_id_fk,
                    'month_year' => $this->input->post('month_and_year'),
                    'time_allowed_id_fk' => $this->input->post('time_allowed_id'),
                    'full_marks_id_fk' => $this->input->post('full_marks_id'),
                    'active_status' => 1,
                    'entry_ip' => $this->input->ip_address(),
                    'inserted_by' => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time' => 'now()',
                );

                if (in_array(null, $questionFormatMainArray, true)) {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Please enter all mandatory fields.');

                    redirect(base_url('admin/question_set_master/question_format/add'));
                } else {

                    // ! Starting Transaction
                    $this->db->trans_start(); # Starting Transaction

                    $questionFormatMainId = $this->question_format_model->insertQuestionFormatMain($questionFormatMainArray);
                    if ($questionFormatMainId) {

                        $questionFormatMapArray = array();
                        $questions_title_heading = $this->input->post('questions_title_heading');

                        foreach ($questions_title_heading as $key => $value) {

                            $questionFormatMapArray = array(
                                'question_format_main_id_fk' => $questionFormatMainId,
                                'question_heading' => $this->input->post('questions_title_heading')[$key],
                                'question_type_mark_id_fk' => $this->input->post('question_type_marks')[$key],
                                'question_attampt_id_fk' => $this->input->post('question_attampt_id')[$key],
                                'no_of_question_set_id_fk' => $this->input->post('no_of_question_set_id')[$key],
                                'marks_of_each_question_id_fk' => $this->input->post('marks_of_each_question_id')[$key],
                                'active_status' => 1,
                                'entry_ip' => $this->input->ip_address(),
                                'inserted_by' => $this->session->userdata('stake_holder_login_id_pk'),
                                'entry_time' => 'now()',
                            );

                            $questionFormatMapId = $this->question_format_model->insertQuestionFormatMap($questionFormatMapArray);
                        }

                        // ! Check All Query For Trainee
                        if ($this->db->trans_status() === FALSE) {
                            $this->db->trans_rollback();

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question format, Please try after sometime.');
                        } else {

                            $this->db->trans_commit();

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Question format has been added successfully.');
                        }

                        redirect(base_url('admin/question_set_master/question_format'));
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to add question format, Please try after sometime.');

                        $this->db->trans_rollback();

                        redirect(base_url('admin/question_set_master/question_format/add'));
                        exit();
                    }
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'question_set_master/question_format/question_format_add_view', $data);
        }
    }

    public function getQuestionTypeMarks()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $question_code_id = $this->input->get('question_code_id');
            if ((!empty($question_code_id))) {

                $getQuestionTypeMarksList = $this->question_format_model->getQuestionTypeMarksList($question_code_id);
                $question_type_marks_html_view = '<option value="">Select Question Category/Type</option>';

                if (!empty($getQuestionTypeMarksList)) {
                    foreach ($getQuestionTypeMarksList as $key => $value) {

                        $question_type_marks_html_view .= '
							<option value="' . $value['question_type_mark_id_pk'] . '">
								' . $value['question_type_name'] . ' [' . $value['question_mark'] . ']
							</option>
						';
                    }
                } else {
                    $question_type_marks_html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($question_type_marks_html_view);
            }
        }
    }

    public function getQuestionCode()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            $course_id = $this->input->get('course_id');
            $sam_year_id = $this->input->get('sam_year_id');
            $discipline_id = $this->input->get('discipline_id');

            if ((!empty($course_id)) && (!empty($sam_year_id)) && (!empty($discipline_id))) {

                $questionCodeList = $this->question_format_model->getQuestionCodeList($course_id, $sam_year_id, $discipline_id);
                $question_code_html_view = '<option value="">Select Question Code</option>';

                if (!empty($questionCodeList)) {
                    foreach ($questionCodeList as $key => $value) {

                        $question_code_html_view .= '
							<option value="' . $value['question_code_id_pk'] . '" data-subName="' . $value['subject_name'] . ' [' . $value['subject_code'] . ']">
								' . $value['question_code'] . '
							</option>
						';
                    }
                } else {
                    $question_code_html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode($question_code_html_view);
            }
        }
    }

    public function getSemesterAndDiscipline($course_id = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $course_id = $this->input->get('course_id');
            if (!empty($course_id)) {

                $semester_list = $this->question_format_model->getSemesterList($course_id);
                $discipline_list = $this->question_format_model->getDisciplineList($course_id);

                $semester_html_view = '<option value="">Select Semester/Year</option>';
                $discipline_html_view = '<option value="">Select discipline</option>';

                if (!empty($semester_list) && !empty($discipline_list)) {
                    foreach ($semester_list as $key => $value) {

                        $semester_html_view .= '
							<option value="' . $value['semester_id_pk'] . '">
								' . $value['semester_name'] . '
							</option>
						';
                    }

                    foreach ($discipline_list as $key => $value) {

                        $discipline_html_view .= '
                            <option value="' . $value['discipline_id_pk'] . '">
                                ' . $value['discipline_name'] . ' [' . $value['discipline_code'] . ']
                            </option>
						';
                    }
                } else {
                    $semester_html_view .= '<option value="" disabled="true">No data found...</option>';
                    $discipline_html_view .= '<option value="" disabled="true">No data found...</option>';
                }

                echo json_encode(array(
                    'semester_html_view' => $semester_html_view,
                    'discipline_html_view' => $discipline_html_view,
                ));
            }
        }
    }

    public function details($question_format_main_id_hash)
    {
        $data['question_set'] = $this->question_format_model->getAll_question_format_main_by_id($question_format_main_id_hash)[0];
        $data['question_category_list'] = $this->question_format_model->get_all_question_category_type($question_format_main_id_hash);

        $this->load->view($this->config->item('theme') . 'question_set_master/question_format/question_category_type_list_view', $data);
    }

    public function add_question_old($map_id_hash)
    {
        $questionDetails = $this->question_format_model->get_all_question_category_type_details($map_id_hash);

        $dataArray = array(
            'course_id'                 => $questionDetails[0]['course_id_pk'],
            'sam_year_id'               => $questionDetails[0]['semester_id_pk'],
            //'discipline_id'             => $questionDetails[0]['discipline_id_pk'],
            'subject_id'                => $questionDetails[0]['subject_id_pk'],
            'question_type_mark_id'     => $questionDetails[0]['question_type_mark_id_pk'],
            'active_status'             => 1,
            'process_status_id_fk'      => 5,

        );
        //parent::pre($questionDetails);
        $no_of_question_to_be_set = $questionDetails[0]['no_of_question_to_be_set'];
        $QuestionList  = $this->question_format_model->getQuestionList($dataArray, $no_of_question_to_be_set);

        if ($QuestionList) {
            
            if (count($QuestionList) == $no_of_question_to_be_set) {
                $questions  = implode(',', array_column($QuestionList, 'question_id_pk'));
                $insertArray = array(

                    'question_format_main_id_fk'    => $questionDetails[0]['question_format_main_id_pk'],
                    'question_format_map_id_fk'     => $questionDetails[0]['question_format_map_id_pk'],
                    'question_id_fk'                => $questions,
                    'active_status'                 => 1,
                    'entry_ip'                      => $this->input->ip_address(),
                    'inserted_by'                   => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                    => "now()",
                );

                $insertedId = $this->question_format_model->insertQuestionList($insertArray);
                $update_array_que = array(
                    'process_status_id_fk' => 17,
                    'question_set_time' => 'now()',
                    'question_set_ip' => $this->input->ip_address(),
                    'question_set_by' => $this->session->userdata('stake_holder_login_id_pk')

                );
                $update_array_que_map = array(
                    'question_set_status' => 1
                );

                if ($insertedId) {
                    $this->question_format_model->update_question_status_details($update_array_que, explode(',', $questions));
                    $this->question_format_model->update_question_format_map_status_details($update_array_que_map, $questionDetails[0]['question_format_map_id_pk']);

                    echo json_encode(1);
                }
            } else {
                echo json_encode(2);
            }
        } else {
            echo json_encode(0);
        }
    }

    public function add_question($map_id_hash)
    {
        $questionDetails = $this->question_format_model->get_all_question_category_type_details($map_id_hash);

        $dataArray = array(
            'course_id'                 => $questionDetails[0]['course_id_pk'],
            'sam_year_id'               => $questionDetails[0]['semester_id_pk'],
            'subject_id'                => $questionDetails[0]['subject_id_pk'],
            'question_type_mark_id'     => $questionDetails[0]['question_type_mark_id_pk'],
            'active_status'             => 1,
            'process_status_id_fk'      => 5,
        );

        $no_of_question_to_be_set = $questionDetails[0]['no_of_question_to_be_set'];
        $question_format_map_id_pk = $questionDetails[0]['question_format_map_id_pk'];
        $question_format_main_id_pk = $questionDetails[0]['question_format_main_id_pk'];

        $QuestionList  = $this->question_format_model->getQuestionList($dataArray, $no_of_question_to_be_set);

        if (!empty($QuestionList)) {
            if (count($QuestionList) == $no_of_question_to_be_set) {

                $questions  = implode(',', array_column($QuestionList, 'question_id_pk'));
                $insertArray = array(
                    'question_format_main_id_fk'    => $questionDetails[0]['question_format_main_id_pk'],
                    'question_format_map_id_fk'     => $questionDetails[0]['question_format_map_id_pk'],
                    'question_id_fk'                => $questions,
                    'active_status'                 => 1,
                    'entry_ip'                      => $this->input->ip_address(),
                    'inserted_by'                   => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'                    => "now()",
                );

                // ! Starting Transaction
                $this->db->trans_start(); # Starting Transaction

                $insertedId = $this->question_format_model->insertQuestionList($insertArray);

                $update_array_que = array(
                    'process_status_id_fk' => 17,
                    'question_set_time' => 'now()',
                    'question_set_ip' => $this->input->ip_address(),
                    'question_set_by' => $this->session->userdata('stake_holder_login_id_pk')

                );

                if ($insertedId) {

                    $this->question_format_model->update_question_status_details($update_array_que, explode(',', $questions));
                    $this->question_format_model->update_question_format_map_status_details(array('question_set_status' => 1), $question_format_map_id_pk);

                    $question_set_status = 1;
                    $question_category_list = $this->question_format_model->get_all_question_category_type(md5($question_format_main_id_pk));

                    foreach ($question_category_list as $key => $value) {
                        if ($value['question_set_status'] == 0) {
                            $question_set_status = 0;
                            break;
                        }
                    }

                    if ($question_set_status == 1) {
                        $this->question_format_model->update_question_format_main_status_details(array('question_set_status' => 1), $question_format_main_id_pk);
                    }

                    // ! Check All Query For Trainee
                    if ($this->db->trans_status() === FALSE) {

                        $this->db->trans_rollback();
                        echo json_encode(0);
                    } else {

                        $this->db->trans_commit();
                        echo json_encode(1);
                    }
                }
            } else {
                echo json_encode(2);
            }
        } else {
            echo json_encode(0);
        }
    }

    public function downloadQuestion($question_format_main_id_hash = NULL)
    {
        $data['question_set'] = $this->question_format_model->getQuestionFormatMainDetails($question_format_main_id_hash)[0];
        $data['question_category_list'] = $this->question_format_model->getQuestionFormatMapDetails($question_format_main_id_hash);

        foreach ($data['question_category_list'] as $key => $value) {
            $data['question_category_list'][$key]['question_list'] = $this->question_format_model->getQuestionListForPdf(explode(',', $value['question_id_fk']));
        }

        $month_year = explode('/', $data['question_set']['month_year']);
        $data['question_set']['full_month_year'] = date('F Y', strtotime($month_year[1] . $month_year[0] . '01'));

        // parent::pre($data);

        // $this->load->view($this->config->item('theme') . 'question_set_master/question_format/download_question_format_view.php', $data);

        $html = $this->load->view($this->config->item('theme') . 'question_set_master/question_format/download_question_format_view.php', $data, true);

        $pdfFilePath = $data['question_set']['question_code'] . '-' . date('dmY') . ".pdf";

        $this->load->library('m_pdf');
        $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
        $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
        $this->m_pdf->pdf->showWatermarkText = true;
        
        $this->m_pdf->pdf->setFooter('Page No.: {PAGENO}');
        $this->m_pdf->pdf->defaultfooterline = 0;

        $this->m_pdf->pdf->WriteHTML($html);

        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
        // $this->m_pdf->pdf->Output($pdfFilePath, "D");
    }
}
