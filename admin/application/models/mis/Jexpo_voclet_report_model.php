<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jexpo_voclet_report_model extends CI_Model
{
    public function getExamTypelList()
    {
        return $this->db->where('active_status', 1)->order_by('exam_type_name')->get('council_exam_type_master')->result_array();
    }

    public function getSubjectList()
    {
        return $this->db->where('active_status', 1)->order_by('subject_name')->get('council_exam_type_subject_mapping')->result_array();
    }

    public function getsubjectListByExamType($exam_type = NULL)
    {
        return $this->db->where('active_status', 1)->where('exam_type_id_fk', $exam_type)->order_by('subject_name')->get('council_exam_type_subject_mapping')->result_array();
    }

    public function getQuestionLevelList()
    {
        return $this->db->where('active_status', 1)->order_by('level_name')->get('council_question_level_master_for_jexpo')->result_array();
    }

    public function getQuestionCreatorData($stake_details_id_fk = NULL)
    {
        return $this->db->where('creator_moderator_id_pk', $stake_details_id_fk)->get('council_question_creator_moderator_jexpo_details')->result_array();
    }

    public function getCountData()
    {
        return $this->db->select("count(question.question_id_pk)")
            ->from('council_question_bank_jexpo_voclet AS question')

            ->join('council_exam_type_master AS exam', 'exam.exam_type_id_pk = question.exam_type_id_fk', "LEFT")
            ->join('council_exam_type_subject_mapping AS subject', 'subject.subject_id_pk = question.subject_id_fk', "LEFT")

            ->where(array(
                'exam.active_status'    => 1,
                'subject.active_status' => 1
            ))->get()->result_array();
    }

    public function getJexpoVocletReport($limit = NULL, $offset = NULL, $searchArray = NULL)
    {
        $query = $this->db->select("
            exam.exam_type_name,
            subject.subject_name,
            level.level_name,
            qc.fname||' '||qc.mname||' '||qc.lname AS creator_name,
            qm.fname||' '||qm.mname||' '||qm.lname AS moderator_name,
            count(question.question_id_pk) AS total_question,
            count(CASE WHEN question.process_status_id_fk = 5 OR question.process_status_id_fk = 6 THEN 1 END) as questions_moderated
            ")
            ->from('council_question_bank_jexpo_voclet AS question')

            ->join('council_exam_type_master AS exam', 'exam.exam_type_id_pk = question.exam_type_id_fk', "LEFT")
            ->join('council_exam_type_subject_mapping AS subject', 'subject.subject_id_pk = question.subject_id_fk', "LEFT")
            ->join('council_question_level_master_for_jexpo AS level', 'level.level_id_pk = question.level_id', "LEFT")

            ->join('council_stake_holder_login AS login_qc', 'login_qc.stake_holder_login_id_pk = question.entry_by', "LEFT")
            ->join('council_question_creator_moderator_jexpo_details AS qc', 'qc.creator_moderator_id_pk = login_qc.stake_details_id_fk', "LEFT")

            ->join('council_stake_holder_login AS login_qm', 'login_qm.stake_holder_login_id_pk = question.approve_reject_by', "LEFT")
            ->join('council_question_creator_moderator_jexpo_details AS qm', 'qm.creator_moderator_id_pk = login_qm.stake_details_id_fk', "LEFT")

            ->where(array(
                'exam.active_status'    => 1,
                'subject.active_status' => 1
            ));

        if ($searchArray != NULL) {

            if (isset($searchArray['exam_type']) && !empty($searchArray['exam_type'])) {
                $query = $query->where('exam.exam_type_id_pk', $searchArray['exam_type']);
            }

            if (isset($searchArray['subject']) && !empty($searchArray['subject'])) {
                $query = $query->where('subject.subject_id_pk', $searchArray['subject']);
            }

            if (isset($searchArray['level']) && !empty($searchArray['level'])) {
                $query = $query->where('level.level_id_pk', $searchArray['level']);
            }
        }

        $query = $query->group_by('exam.exam_type_name, subject.subject_name, level.level_name, creator_name, moderator_name')
            ->order_by('exam.exam_type_name')->limit($limit, $offset)->get()->result_array();

        return $query;
    }
}
