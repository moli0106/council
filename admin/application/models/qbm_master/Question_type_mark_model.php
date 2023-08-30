<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_type_mark_model extends CI_Model
{

    public function getQuestionCategoryCount()
    {
        $query = $this->db->select("count(question_type_mark_id_pk)")
            ->from("council_qbm_question_type_mark_master")
            ->where('active_status', 1)
            ->get();
        return $query->result_array();
    }


    public function getAllQuestionCategory($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_question_type_mark_master as qtmm")
            ->where('active_status', 1)
            ->limit($limit, $offset)
            ->order_by("question_mark")
            ->get();
        return $query->result_array();
    }

    public function getAllSubjectMapWithQuestionCategory($limit = NULL, $offset = NULL)
    {
        $this->db->select('SQTMM.subject_question_type_mark_map_id_pk, SQTMM.min_no_of_question, course.course_name, subject.subject_id_pk, subject.subject_name, subject.subject_code, QTMM.question_type_mark_id_pk, QTMM.question_type_name, QTMM.question_mark,sem.semester_name');

        $this->db->from('council_qbm_subject_question_type_mark_map AS SQTMM');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = SQTMM.subject_id_fk ', 'left');
        $this->db->join('council_qbm_course_master AS course', 'course.course_id_pk = SQTMM.course_id_fk ', 'left');
        $this->db->join('council_qbm_question_type_mark_master As QTMM', 'QTMM.question_type_mark_id_pk = SQTMM.question_type_mark_id_fk', 'left');
		$this->db->join('council_qbm_semester_master As sem', 'SQTMM.sem_year_id_fk = sem.semester_id_pk', 'left');

        $this->db->where('SQTMM.active_status', 1);
        $this->db->order_by('subject.subject_name');

        return $this->db->get()->result_array();
    }

    public function insertQuestionCategory($array)
    {
        $this->db->insert('council_qbm_question_type_mark_master', $array);

        return $this->db->insert_id();
    }

    public function insertSubjectMapWithQuestionCategory($array)
    {
        $this->db->insert('council_qbm_subject_question_type_mark_map', $array);

        return $this->db->insert_id();
    }

    public function getCourseList()
    {
        return $this->db->get('council_qbm_course_master')->result_array();
    }

    public function getDisciplineList($course_id = NULL)
    {
        $this->db->select('discipline.discipline_id_pk, discipline.discipline_name, discipline.discipline_code');
        $this->db->from('council_qbm_discipline_master AS discipline');

        $this->db->join('council_qbm_course_discipline_map CDM', 'CDM.discipline_id_fk = discipline.discipline_id_pk', 'left');

        $this->db->where('CDM.course_id_fk', $course_id);
        $this->db->where('discipline.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getSemesterList($course_id = NULL)
    {
        $this->db->select('semester.semester_name, semester.semester_id_pk');
        $this->db->from('council_qbm_semester_master AS semester');

        $this->db->join('council_qbm_course_semester_map CSM', 'CSM.semester_id_fk = semester.semester_id_pk', 'left');

        $this->db->where('CSM.course_id_fk', $course_id);
        $this->db->where('semester.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getSubjectByCourseId($course_id = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_subject_master AS subject');

        $this->db->join('council_qbm_subject_semester_group_trade_map SSGTM', 'SSGTM.subject_id_fk = subject.subject_id_pk', 'left');

        $this->db->where('SSGTM.course_id_fk', $course_id);
        $this->db->where('subject.active_status', 1);

        $this->db->group_by('subject.subject_id_pk, subject.subject_name, subject.subject_code');


        return $this->db->get()->result_array();
    }

    public function getSubjectByDiscipline($discipline_id = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_subject_master AS subject');

        $this->db->join('council_qbm_subject_semester_group_trade_map SSGTM', 'SSGTM.subject_id_fk = subject.subject_id_pk', 'left');

        $this->db->where('SSGTM.discipline_id_fk', $discipline_id);
        $this->db->where('subject.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getGroupTrade($discipline_id = NULL)
    {
        $this->db->select('group_trade.group_trade_id_pk, group_trade.group_trade_name, group_trade.group_trade_code');
        $this->db->from('council_qbm_group_trade_master AS group_trade');

        $this->db->join('council_qbm_discipline_group_trade_map DGTM', 'DGTM.group_trade_id_fk = group_trade.group_trade_id_pk', 'left');

        $this->db->where('DGTM.discipline_id_fk', $discipline_id);
        $this->db->where('group_trade.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getSubjectByGroupTrade($group_trade_id = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_subject_master AS subject');

        $this->db->join('council_qbm_subject_semester_group_trade_map SSGTM', 'SSGTM.subject_id_fk = subject.subject_id_pk', 'left');

        $this->db->where('SSGTM.group_trade_id_fk', $group_trade_id);
        $this->db->where('subject.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function updateQuestionCategory($array = NULL, $id_hash = NULL)
    {
        $this->db->where("MD5(CAST(question_type_mark_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_qbm_question_type_mark_master', $array);

        return $this->db->affected_rows();
    }

    public function getQuestionCategoryById($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(question_type_mark_id_pk as character varying)) =", $id_hash);

        return $this->db->get('council_qbm_question_type_mark_master')->result_array();
    }
}
/* End of file Master_trainer_model.php */
