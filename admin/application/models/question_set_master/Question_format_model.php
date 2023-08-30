<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_format_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_question_format_main_count()
    {
        $query = $this->db->select("count(question_format_main_id_pk)")
            ->from("council_qbm_question_format_main")
            ->where_in('course_id_fk',array(3,4))
            ->get();
        return $query->result_array();
    }

    public function getAll_question_format_main($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("que_format_main.question_format_main_id_pk,que_format_main.month_year,course.course_name,discipline.discipline_name,discipline.discipline_code,semester.semester_name,subject.subject_name,subject.subject_code,que_code.question_code,que_format_main.question_set_status")
            ->from("council_qbm_question_format_main as que_format_main")
            ->join("council_qbm_course_master as course", "course.course_id_pk = que_format_main.course_id_fk")
            ->join("council_qbm_discipline_master as discipline", "discipline.discipline_id_pk = que_format_main.discipline_id_fk")
            ->join("council_qbm_semester_master as semester", "semester.semester_id_pk = que_format_main.sem_year_id_fk")
            ->join("council_qbm_subject_master as subject", "subject.subject_id_pk = que_format_main.subject_id_fk")
            ->join("council_qbm_question_code_master as que_code", "que_code.question_code_id_pk = que_format_main.question_code_id_fk")
            ->where_in('que_format_main.course_id_fk',array(3,4))
            ->limit($limit, $offset)
            ->order_by("question_code_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getCourseList()
    {
        $this->db->where('active_status', 1);
        $this->db->where_in('course_id_pk',array(3,4));
        return $this->db->get('council_qbm_course_master')->result_array();
    }

    public function getTimeAllowed()
    {
        $this->db->where('active_status', 1);
        return $this->db->get('council_qbm_time_allowed')->result_array();
    }

    public function getFullMarks()
    {
        $this->db->where('active_status', 1);
        return $this->db->get('council_qbm_full_marks')->result_array();
    }

    public function getQuestionCategoryTypeMarks()
    {
        $this->db->order_by("question_type_name");
        // $this->db->order_by("question_type_mark_id_pk");
        return $this->db->get("council_qbm_question_type_mark_master")->result_array();
    }

    public function getQuestionToBeAttampt()
    {
        $this->db->where('active_status', 1);
        $this->db->order_by('no_of_question_attamp');
        return $this->db->get('council_qbm_no_of_question_to_be_attampt')->result_array();
    }

    public function getQuestionToBeSet()
    {
        $this->db->where('active_status', 1);
        return $this->db->get('council_qbm_no_of_question_to_be_set')->result_array();
    }

    public function getQuestionToBeAnswrerd()
    {
        $this->db->where('active_status', 1);
        return $this->db->get('council_qbm_no_of_question_to_be_answrerd')->result_array();
    }

    public function getMarksOfEachQuestion()
    {
        $this->db->where('active_status', 1);
        return $this->db->get('council_qbm_marks_of_each_question')->result_array();
    }

    public function getSemesterList($course_id = NULL)
    {
        $this->db->select('semester.semester_id_pk, semester.semester_name');
        $this->db->from('council_qbm_course_semester_map AS CSM');

        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = CSM.semester_id_fk', 'left');

        $this->db->where('CSM.course_id_fk', $course_id);
        $this->db->where('semester.active_status', 1);

        $this->db->group_by('semester.semester_id_pk, semester.semester_name');
        $this->db->order_by('semester.semester_name');

        return $this->db->get()->result_array();
    }

    public function getDisciplineList($course_id = NULL)
    {
        $this->db->select('discipline.discipline_id_pk, discipline.discipline_name, discipline.discipline_code');
        $this->db->from('council_qbm_course_discipline_map AS CDM');

        $this->db->join('council_qbm_discipline_master AS discipline', 'discipline.discipline_id_pk = CDM.discipline_id_fk', 'left');

        $this->db->where('CDM.course_id_fk', $course_id);
        $this->db->where('discipline.active_status', 1);

        $this->db->group_by('discipline.discipline_id_pk, discipline.discipline_name, discipline.discipline_code');
        $this->db->order_by('discipline.discipline_name');

        return $this->db->get()->result_array();
    }

    public function getQuestionCodeList($course_id = NULL, $semester_id = NULL, $discipline_id = NULL)
    {
        $this->db->select('QCM.question_code_id_pk, QCM.question_code, subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_question_code_master AS QCM');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QCM.subject_id_fk', 'left');

        $this->db->where('QCM.course_id_fk', $course_id);
        $this->db->where('QCM.sam_year_id_fk', $semester_id);
        $this->db->where('QCM.discipline_id_fk', $discipline_id);

        return $this->db->get()->result_array();
    }

    public function getQuestionCodeDetails($question_code_id = NULL)
    {
        $this->db->select('QCM.question_code_id_pk, QCM.question_code, subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_question_code_master AS QCM');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QCM.subject_id_fk', 'left');

        $this->db->where('QCM.question_code_id_pk', $question_code_id);

        return $this->db->get()->result_array();
    }

    public function insertQuestionFormatMain($questionFormatMainArray = NULL)
    {
        $this->db->insert('council_qbm_question_format_main', $questionFormatMainArray);

        return $this->db->insert_id();
    }

    public function insertQuestionFormatMap($questionFormatMapArray = NULL)
    {
        $this->db->insert('council_qbm_question_format_map', $questionFormatMapArray);

        return $this->db->insert_id();
    }

    public function getQuestionTypeMarksList($question_code_id = NULL)
    {
        $this->db->select('qtmm.question_type_mark_id_pk, qtmm.question_type_name, qtmm.question_mark');
        $this->db->from('council_qbm_question_code_master AS qcm');
        $this->db->join('council_qbm_subject_question_type_mark_map sqtmm', 'sqtmm.subject_id_fk = qcm.subject_id_fk', 'left');
        $this->db->join('council_qbm_question_type_mark_master qtmm', 'qtmm.question_type_mark_id_pk = sqtmm.question_type_mark_id_fk', 'left');
        $this->db->where('qcm.question_code_id_pk', $question_code_id);
        $this->db->where('qtmm.active_status', 1);
        $this->db->order_by('qtmm.question_mark');

        return $this->db->get()->result_array();
    }

    public function getAll_question_format_main_by_id($question_format_main_id_hash = NULL)
    {
        $query = $this->db->select("que_format_main.question_format_main_id_pk,que_format_main.month_year,course.course_name,discipline.discipline_name,discipline.discipline_code,semester.semester_name,subject.subject_name,subject.subject_code,que_code.question_code,time_allowed.time_allowed,full_mark.full_marks")
            ->from("council_qbm_question_format_main as que_format_main")
            ->join("council_qbm_course_master as course", "course.course_id_pk = que_format_main.course_id_fk")
            ->join("council_qbm_discipline_master as discipline", "discipline.discipline_id_pk = que_format_main.discipline_id_fk")
            ->join("council_qbm_semester_master as semester", "semester.semester_id_pk = que_format_main.sem_year_id_fk")
            ->join("council_qbm_subject_master as subject", "subject.subject_id_pk = que_format_main.subject_id_fk")
            ->join("council_qbm_question_code_master as que_code", "que_code.question_code_id_pk = que_format_main.question_code_id_fk")
            ->join("council_qbm_time_allowed as time_allowed", "time_allowed.time_allowed_id_pk = que_format_main.time_allowed_id_fk")
            ->join("council_qbm_full_marks as full_mark", "full_mark.full_marks_id_pk = que_format_main.full_marks_id_fk")
            ->where(
                array(
                    "que_format_main.active_status" => 1,
                    "MD5(CAST(que_format_main.question_format_main_id_pk AS character varying)) ="    => $question_format_main_id_hash
                )
            )
            ->order_by("question_code_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function get_all_question_category_type($question_format_main_id_hash = NULL)
    {
        $query = $this->db->select("que_format_main.question_format_main_id_pk,que_format_map.question_format_map_id_pk,que_format_map.question_heading,que_type_mark_master.question_type_name,que_type_mark_master.question_mark,attampt.no_of_question_attamp,que_be_set.no_of_question_to_be_set,marks_each_question.marks_of_each_question, que_format_map.question_set_status")
            ->from("council_qbm_question_format_main as que_format_main")
            ->join("council_qbm_question_format_map as que_format_map", "que_format_main.question_format_main_id_pk = que_format_map.question_format_main_id_fk")
            ->join("council_qbm_question_type_mark_master as que_type_mark_master", "que_type_mark_master.question_type_mark_id_pk = que_format_map.question_type_mark_id_fk")
            ->join("council_qbm_no_of_question_to_be_attampt as attampt", "attampt.question_attampt_id_pk = que_format_map.question_attampt_id_fk")
            ->join("council_qbm_no_of_question_to_be_set as que_be_set", "que_be_set.no_of_question_set_id_pk = que_format_map.no_of_question_set_id_fk")
            ->join("council_qbm_marks_of_each_question as marks_each_question", "marks_each_question.marks_of_each_question_id_pk = que_format_map.marks_of_each_question_id_fk")

            ->where(
                array(
                    "que_format_main.active_status" => 1,
                    "que_format_map.active_status" => 1,
                    "MD5(CAST(que_format_map.question_format_main_id_fk AS character varying)) ="    => $question_format_main_id_hash
                )
            )
            ->order_by("que_format_map.question_format_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getQuestionFormatMapDetails($question_format_main_id_hash = NULL)
    {
        $query = $this->db->select("que_format_main.question_format_main_id_pk,que_format_map.question_format_map_id_pk,que_format_map.question_heading,que_type_mark_master.question_type_name,que_type_mark_master.question_mark,attampt.no_of_question_attamp,que_be_set.no_of_question_to_be_set,marks_each_question.marks_of_each_question, que_format_set_map.question_id_fk")
            ->from("council_qbm_question_format_main as que_format_main")
            ->join("council_qbm_question_format_map as que_format_map", "que_format_main.question_format_main_id_pk = que_format_map.question_format_main_id_fk")
            ->join("council_qbm_question_format_set_map as que_format_set_map", "que_format_set_map.question_format_map_id_fk = que_format_map.question_format_map_id_pk")
            ->join("council_qbm_question_type_mark_master as que_type_mark_master", "que_type_mark_master.question_type_mark_id_pk = que_format_map.question_type_mark_id_fk")
            ->join("council_qbm_no_of_question_to_be_attampt as attampt", "attampt.question_attampt_id_pk = que_format_map.question_attampt_id_fk")
            ->join("council_qbm_no_of_question_to_be_set as que_be_set", "que_be_set.no_of_question_set_id_pk = que_format_map.no_of_question_set_id_fk")
            ->join("council_qbm_marks_of_each_question as marks_each_question", "marks_each_question.marks_of_each_question_id_pk = que_format_map.marks_of_each_question_id_fk")

            ->where(
                array(
                    "que_format_main.active_status" => 1,
                    "que_format_map.active_status" => 1,
                    "MD5(CAST(que_format_map.question_format_main_id_fk AS character varying)) ="    => $question_format_main_id_hash
                )
            )
            ->order_by("que_format_map.question_format_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getQuestionFormatMainDetails($question_format_main_id_hash = NULL)
    {
        $query = $this->db->select("que_format_main.question_format_main_id_pk,que_format_main.month_year,course.course_name,discipline.discipline_name,discipline.discipline_code,semester.semester_name,subject.subject_name,subject.subject_code,que_code.question_code,time_allowed.time_allowed,full_mark.full_marks")
            ->from("council_qbm_question_format_main as que_format_main")
            ->join("council_qbm_course_master as course", "course.course_id_pk = que_format_main.course_id_fk")
            ->join("council_qbm_discipline_master as discipline", "discipline.discipline_id_pk = que_format_main.discipline_id_fk")
            ->join("council_qbm_semester_master as semester", "semester.semester_id_pk = que_format_main.sem_year_id_fk")
            ->join("council_qbm_subject_master as subject", "subject.subject_id_pk = que_format_main.subject_id_fk")
            ->join("council_qbm_question_code_master as que_code", "que_code.question_code_id_pk = que_format_main.question_code_id_fk")
            ->join("council_qbm_time_allowed as time_allowed", "time_allowed.time_allowed_id_pk = que_format_main.time_allowed_id_fk")
            ->join("council_qbm_full_marks as full_mark", "full_mark.full_marks_id_pk = que_format_main.full_marks_id_fk")
            ->where(
                array(
                    "que_format_main.active_status" => 1,
                    "MD5(CAST(que_format_main.question_format_main_id_pk AS character varying)) ="    => $question_format_main_id_hash
                )
            )
            ->order_by("question_code_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    // 11022022 START

    public function getQuestionListForPdf($questionIds = NULL)
    {
        $this->db->select('
            QB.question_id_pk,
            QBEL.question AS eng_lang_question, 
            QBEL.question_pic AS eng_lang_pics,
            QBOL.question AS other_lang_question, 
            QBOL.question_pic AS other_lang_pics
        ');
        $this->db->from('council_qbm_question_bank AS QB');
        $this->db->join('council_qbm_question_bank_english_lang AS QBEL', 'QBEL.question_id_fk = QB.question_id_pk', 'left');
        $this->db->join('council_qbm_question_bank_other_lang AS QBOL', 'QBOL.eng_question_id_fk = QBEL.eng_question_id_pk', 'left');

        $this->db->where_in('QB.question_id_pk', $questionIds);
        $this->db->where('QB.total_no_of_question', 1);
        $query1 = $this->db->get()->result_array();
        
        $this->db->select('
            QB.question_id_pk,
            QBEL.question AS eng_lang_question, 
            QBEL.question_pic AS eng_lang_pics,
            QBOL.question AS other_lang_question, 
            QBOL.question_pic AS other_lang_pics
        ');
        $this->db->from('council_qbm_question_bank AS QB');
        $this->db->join('council_qbm_question_bank_english_lang AS QBEL', 'QBEL.question_id_fk = QB.question_id_pk', 'left');
        $this->db->join('council_qbm_question_bank_other_lang AS QBOL', 'QBOL.eng_question_id_fk = QBEL.eng_question_id_pk', 'left');

        $this->db->where_in('QB.question_id_pk', $questionIds);
        $this->db->where('QB.total_no_of_question >', 1);
        $query2 = $this->db->get()->result_array();

        if(!empty($query2)){
            array_push($query1, $query2);
        }

        return $query1;

    }

    // 11022022 END

    public function get_all_question_category_type_details($map_id_hash = NULL)
    {
        $query = $this->db->select("que_format_main.question_format_main_id_pk,que_format_map.question_format_map_id_pk,que_format_map.question_heading,
        que_type_mark_master.question_type_mark_id_pk,que_type_mark_master.question_type_name,que_type_mark_master.question_mark,
        attampt.no_of_question_attamp,
        que_be_set.no_of_question_to_be_set,
        marks_each_question.marks_of_each_question,
        que_format_main.month_year,
        course.course_name,course.course_id_pk,
        discipline.discipline_name,discipline.discipline_code,discipline.discipline_id_pk,
        semester.semester_name,semester.semester_id_pk,
        subject.subject_name,subject.subject_code,subject.subject_id_pk,
        que_code.question_code,
        time_allowed.time_allowed,
        full_mark.full_marks")
            ->from("council_qbm_question_format_main as que_format_main")
            ->join("council_qbm_question_format_map as que_format_map", "que_format_main.question_format_main_id_pk = que_format_map.question_format_main_id_fk")

            ->join("council_qbm_course_master as course", "course.course_id_pk = que_format_main.course_id_fk")
            ->join("council_qbm_discipline_master as discipline", "discipline.discipline_id_pk = que_format_main.discipline_id_fk")
            ->join("council_qbm_semester_master as semester", "semester.semester_id_pk = que_format_main.sem_year_id_fk")
            ->join("council_qbm_subject_master as subject", "subject.subject_id_pk = que_format_main.subject_id_fk")
            ->join("council_qbm_question_code_master as que_code", "que_code.question_code_id_pk = que_format_main.question_code_id_fk")
            ->join("council_qbm_time_allowed as time_allowed", "time_allowed.time_allowed_id_pk = que_format_main.time_allowed_id_fk")
            ->join("council_qbm_full_marks as full_mark", "full_mark.full_marks_id_pk = que_format_main.full_marks_id_fk")

            ->join("council_qbm_question_type_mark_master as que_type_mark_master", "que_type_mark_master.question_type_mark_id_pk = que_format_map.question_type_mark_id_fk")
            ->join("council_qbm_no_of_question_to_be_attampt as attampt", "attampt.question_attampt_id_pk = que_format_map.question_attampt_id_fk")
            ->join("council_qbm_no_of_question_to_be_set as que_be_set", "que_be_set.no_of_question_set_id_pk = que_format_map.no_of_question_set_id_fk")
            ->join("council_qbm_marks_of_each_question as marks_each_question", "marks_each_question.marks_of_each_question_id_pk = que_format_map.marks_of_each_question_id_fk")

            ->where(
                array(
                    "que_format_main.active_status" => 1,
                    "que_format_map.active_status" => 1,
                    "MD5(CAST(que_format_map.question_format_map_id_pk AS character varying)) ="    => $map_id_hash
                )
            )
            ->order_by("que_format_map.question_format_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getQuestionList($myArray, $no_of_question_to_be_set)
    {
        $query = $this->db->select("question_id_pk")
            ->where($myArray)
            ->limit($no_of_question_to_be_set, 0)
            ->order_by('question_id_pk', 'RANDOM')
            ->get('council_qbm_question_bank');
        return $query->result_array();
    }

    public function insertQuestionList($insertArray)
    {
        $this->db->insert('council_qbm_question_format_set_map', $insertArray);

        return $this->db->insert_id();
    }

    public function update_question_status_details($update_array_que, $questions)
    {


        $this->db->where_in('question_id_pk', $questions)
            ->update('council_qbm_question_bank', $update_array_que);

        return $this->db->affected_rows();
    }

    public function update_question_format_map_status_details($update_array_que_map, $question_format_map_id)
    {


        $this->db->where('question_format_map_id_pk', $question_format_map_id)
            ->update('council_qbm_question_format_map', $update_array_que_map);

        return $this->db->affected_rows();
    }

    public function update_question_format_main_status_details($update_array, $question_format_main_id_pk)
    {
        $this->db->where('question_format_main_id_pk', $question_format_main_id_pk)
            ->update('council_qbm_question_format_main', $update_array);

        return $this->db->affected_rows();
    }
}
