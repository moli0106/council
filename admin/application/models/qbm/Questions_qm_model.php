<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Questions_qm_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCourseDetails($course_id_hash = NULL)
    {
        $this->db->where('active_status', 1);
        $this->db->where('MD5(CAST(course_id_pk AS character varying)) =', $course_id_hash);

        return $this->db->get('council_qbm_course_master')->result_array();
    }

    public function getCourseList($stake_details_id_fk = NULL)
    {
        $this->db->select('course_id_pk, course_name');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');
        $this->db->join('council_qbm_course_master AS CM', 'CM.course_id_pk = QCMSM.course_id_fk', 'left');
        $this->db->where('CM.active_status', 1);
        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
		$this->db->group_by('course_id_pk, course_name');
        return $this->db->get()->result_array();
    }

    public function getSemesterDetails($semester_id_hash = NULL)
    {
        $this->db->where('active_status', 1);
        $this->db->where('MD5(CAST(semester_id_pk AS character varying)) =', $semester_id_hash);

        return $this->db->get('council_qbm_semester_master')->result_array();
    }

    public function getCreatorSubjectList($stake_details_id_fk = NULL)
    {
        $this->db->select('QCMSM.creator_moderator_subject_map_id_pk, subject.subject_id_pk, subject.subject_name, subject.subject_code, course.course_name');

        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QCMSM.subject_id_fk', 'left');
        $this->db->join('council_qbm_course_master AS course', 'course.course_id_pk = QCMSM.course_id_fk', 'left');

        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
        $this->db->where('subject.active_status', 1);

        $this->db->order_by('subject.subject_name');

        return $this->db->get()->result_array();
    }

    public function getSubjectByCourseAndSem($courseDetails = NULL, $semesterDetails = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code, course.course_name, semester.semester_name, discipline.discipline_name, discipline.discipline_code, groupTrade.group_trade_name, groupTrade.group_trade_code, subjectCategory.subject_category_name');
        $this->db->from('council_qbm_subject_semester_group_trade_map AS SSGTM');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = SSGTM.subject_id_fk', 'left');
        $this->db->join('council_qbm_course_master AS course', 'course.course_id_pk = SSGTM.course_id_fk', 'left');
        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = SSGTM.sam_year_id_fk', 'left');
        $this->db->join('council_qbm_discipline_master AS discipline', 'discipline.discipline_id_pk = SSGTM.discipline_id_fk', 'left');
        $this->db->join('council_qbm_group_trade_master AS groupTrade', 'groupTrade.group_trade_id_pk = SSGTM.group_trade_id_fk', 'left');
        $this->db->join('council_qbm_subject_category_master AS subjectCategory', 'subjectCategory.subject_category_id_pk = SSGTM.sub_cat_id_fk', 'left');

        $this->db->where('SSGTM.course_id_fk', $courseDetails);
        $this->db->where('SSGTM.sam_year_id_fk', $semesterDetails);
        $this->db->where('subject.active_status', 1);

        // $this->db->group_by('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->order_by('subject.subject_name');

        return $this->db->get()->result_array();
    }

    public function getCourseListWithSemester($stake_details_id_fk = NULL)
    {
        $this->db->select('CM.course_id_pk, CM.course_name, SM.semester_id_pk, SM.semester_name');

        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_course_master AS CM', 'CM.course_id_pk = QCMSM.course_id_fk', 'left');
        $this->db->join('council_qbm_course_semester_map AS CMM', 'CMM.course_id_fk = CM.course_id_pk', 'left');
        $this->db->join('council_qbm_semester_master AS SM', 'SM.semester_id_pk = CMM.semester_id_fk', 'left');

        $this->db->where('CM.active_status', 1);
        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);

        $this->db->group_by('CM.course_id_pk, CM.course_name, SM.semester_id_pk, SM.semester_name');
        $this->db->order_by('CM.course_name', 'SM.semester_name');

        return $this->db->get()->result_array();
    }

    public function getSemesterList($stake_details_id_fk = NULL, $course_id = NULL)
    {
        $this->db->select('semester.semester_id_pk, semester.semester_name');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_course_semester_map AS CSM', 'CSM.course_id_fk = QCMSM.course_id_fk', 'left');
        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = CSM.semester_id_fk', 'left');

        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
        $this->db->where('CSM.course_id_fk', $course_id);
        $this->db->where('semester.active_status', 1);

        $this->db->group_by('semester.semester_id_pk, semester.semester_name');
        $this->db->order_by('semester.semester_name');

        return $this->db->get()->result_array();
    }

    public function getSemesterListBySubjectId($subject_id_hash = NULL)
    {
        $this->db->select('semester.semester_id_pk, semester.semester_name');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_course_semester_map AS CSM', 'CSM.course_id_fk = QCMSM.course_id_fk', 'left');
        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = CSM.semester_id_fk', 'left');

        $this->db->where('MD5(CAST("QCMSM"."subject_id_fk" as character varying)) =', $subject_id_hash);
        $this->db->where('semester.active_status', 1);

        $this->db->group_by('semester.semester_id_pk, semester.semester_name');
        $this->db->order_by('semester.semester_name');

        return $this->db->get()->result_array();
    }

    public function getDisciplineList($stake_details_id_fk = NULL, $course_id = NULL)
    {
        $this->db->select('discipline.discipline_id_pk, discipline.discipline_name, discipline.discipline_code');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_discipline_master AS discipline', 'discipline.discipline_id_pk = QCMSM.discipline_id_fk', 'left');
        $this->db->join('council_qbm_course_discipline_map AS CDM', 'CDM.discipline_id_fk = QCMSM.discipline_id_fk', 'left');

        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
        $this->db->where('CDM.course_id_fk', $course_id);
        $this->db->where('discipline.active_status', 1);

        $this->db->group_by('discipline.discipline_id_pk, discipline.discipline_name, discipline.discipline_code');
        $this->db->order_by('discipline.discipline_name');

        return $this->db->get()->result_array();
    }

    public function getSubjectListByCourseId($stake_details_id_fk = NULL, $course_id = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_subject_semester_group_trade_map AS SSGTM', 'SSGTM.subject_id_fk = QCMSM.subject_id_fk', 'left');
        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QCMSM.subject_id_fk', 'left');

        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
        $this->db->where('QCMSM.course_id_fk', $course_id);

        $this->db->where('subject.active_status', 1);

        $this->db->group_by('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->order_by('subject.subject_name');

        return $this->db->get()->result_array();
    }

    public function getSubjectList($course_id = NULL, $stake_details_id_fk = NULL, $discipline_id = NULL, $sam_year_id = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_subject_semester_group_trade_map AS SSGTM', 'SSGTM.subject_id_fk = QCMSM.subject_id_fk', 'left');
        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QCMSM.subject_id_fk', 'left');

        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
        $this->db->where('QCMSM.discipline_id_fk', $discipline_id);

        if (($course_id != 1) && ($course_id != 2)) {
            $this->db->where('SSGTM.sam_year_id_fk', $sam_year_id);
        }

        $this->db->where('subject.active_status', 1);

        $this->db->group_by('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->order_by('subject.subject_name');

        return $this->db->get()->result_array();
    }

    public function getGroupTradeList($stake_details_id_fk = NULL, $discipline_id = NULL)
    {
        $this->db->select('groupTrade.group_trade_id_pk, groupTrade.group_trade_name, groupTrade.group_trade_code');
        $this->db->from('council_qbm_question_creator_moderator_subject_map AS QCMSM');

        $this->db->join('council_qbm_discipline_group_trade_map AS DGTM', 'DGTM.discipline_id_fk = QCMSM.discipline_id_fk', 'left');
        $this->db->join('council_qbm_group_trade_master AS groupTrade', 'groupTrade.group_trade_id_pk = DGTM.group_trade_id_fk', 'left');

        $this->db->where('QCMSM.creator_moderator_id_fk', $stake_details_id_fk);
        $this->db->where('QCMSM.discipline_id_fk', $discipline_id);
        $this->db->where('groupTrade.active_status', 1);

        $this->db->group_by('groupTrade.group_trade_id_pk, groupTrade.group_trade_name, groupTrade.group_trade_code');
        $this->db->order_by('groupTrade.group_trade_name');

        return $this->db->get()->result_array();
    }

    public function getSubjectGroupCategory()
    {
        $this->db->select('SCM.subject_category_id_pk, SCM.subject_category_name');
        $this->db->from('council_qbm_subject_category_master AS SCM');

        $this->db->where('SCM.active_status', 1);

        $this->db->order_by('SCM.subject_category_name');

        return $this->db->get()->result_array();
    }

    public function getSubjectBySubjectGroupTrade($group_trade_id = NULL, $subject_group_id = NULL)
    {
        $this->db->select('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->from('council_qbm_subject_semester_group_trade_map AS SSGTM');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = SSGTM.subject_id_fk', 'left');

        $this->db->where('SSGTM.group_trade_id_fk', $group_trade_id);
        $this->db->where('SSGTM.sub_cat_id_fk', $subject_group_id);
        $this->db->where('subject.active_status', 1);

        $this->db->group_by('subject.subject_id_pk, subject.subject_name, subject.subject_code');
        $this->db->order_by('subject.subject_name');

        return $this->db->get()->result_array();
    }

    public function getTopicChapterList($subject_id = NULL, $sam_year_id = NULL)
    {
        $this->db->select('topic.subject_topics_map_id_pk, topic.topics_chapter_name');
        $this->db->from('council_qbm_subject_topics_map AS topic');

        $this->db->where('topic.subject_id_fk', $subject_id);

        if ($sam_year_id != NULL) {

            $this->db->where('topic.semester_id_fk', $sam_year_id);
        }

        $this->db->order_by('topic.topics_chapter_name');

        return $this->db->get()->result_array();
    }

    public function getSubjectQuestionTypeMark($subject_id = NULL,$sem_year_id = NULL)
    {
        $this->db->select('QTMM.question_type_mark_id_pk, QTMM.question_type_name, QTMM.question_mark');
        $this->db->from('council_qbm_subject_question_type_mark_map AS SQTMM');

        $this->db->join('council_qbm_question_type_mark_master AS QTMM', 'QTMM.question_type_mark_id_pk = SQTMM.question_type_mark_id_fk', 'left');

        $this->db->where('SQTMM.subject_id_fk', $subject_id);
		$this->db->where('SQTMM.sem_year_id_fk', $sem_year_id);

        $this->db->order_by('QTMM.question_type_name');

        return $this->db->get()->result_array();
    }

    public function insert_question_bank($question_bank_array = NULL)
    {
        $this->db->insert('council_qbm_question_bank', $question_bank_array);

        return $this->db->insert_id();
    }

    public function insert_batch_eng_question($eng_question_array = NULL)
    {
        $this->db->insert_batch('council_qbm_question_bank_english_lang', $eng_question_array);

        return TRUE;
    }

    public function insert_batch_other_question($other_question_array = NULL)
    {
        $this->db->insert_batch('council_qbm_question_bank_other_lang', $other_question_array);

        return TRUE;
    }

    public function updateQuestionBank($question_id_pk = NULL, $update_array = NULL)
    {
        $this->db->where('question_id_pk', $question_id_pk);
        $this->db->update('council_qbm_question_bank', $update_array);

        return $this->db->affected_rows();
    }

    //Added by Waseem

    public function updateEngQuestionBank($id_hash = NULL, $update_array = NULL)
    {
        
        $this->db->where('MD5(CAST("eng_question_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_qbm_question_bank_english_lang', $update_array);

        return $this->db->affected_rows();
    }

    public function getEngQuestionDetails($id_hash = NULL)
    {
        $this->db->select('QBEL.eng_question_id_pk, QBEL.question, QBEL.question_clue, QBEL.question_pic,QBEL.answer_pic, QBEL.per_question_marks, QB.question_id_pk');

        $this->db->from('council_qbm_question_bank_english_lang AS QBEL');
        $this->db->join('council_qbm_question_bank AS QB', 'QB.question_id_pk = QBEL.question_id_fk', 'left');

        $this->db->where('MD5(CAST("QBEL"."eng_question_id_pk" as character varying)) =', $id_hash);
        $this->db->where('QB.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getOtherQuestionDetails($id_hash = NULL)
    {
        $this->db->select('QBOL.other_question_id_pk, QBOL.question, QBOL.question_clue, QBOL.question_pic,QBOL.answer_pic, QBOL.per_question_marks, QB.question_id_pk');

        $this->db->from('council_qbm_question_bank_other_lang AS QBOL');
        $this->db->join('council_qbm_question_bank AS QB', 'QB.question_id_pk = QBOL.question_id_fk', 'left');

        $this->db->where('MD5(CAST("QBOL"."other_question_id_pk" as character varying)) =', $id_hash);
        $this->db->where('QB.active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getSubjectQuestionList($stake_details_id_fk = NULL, $subject_id_hash = NULL)    //Added by Waseem for QM
    {
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $this->db->select('QB.question_id_pk, QB.total_no_of_question, subject.subject_id_pk, subject.subject_name, subject.subject_code, topic.topics_chapter_name, QMM.question_type_name, QMM.question_mark, semester.semester_name,QB.other_lan_quesstion_status');

        $this->db->from('council_qbm_question_bank AS QB');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QB.subject_id', 'left');
        $this->db->join('council_qbm_subject_topics_map AS topic', 'topic.subject_topics_map_id_pk = QB.topic_chapter_id', 'left');
        $this->db->join('council_qbm_question_type_mark_master AS QMM', 'QMM.question_type_mark_id_pk = QB.question_type_mark_id', 'left');
        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = QB.sam_year_id', 'left');
		//$this->db->join('council_qbm_subject_semester_group_trade_map AS SSGTM', 'SSGTM.subject_id_fk = QB.subject_id', 'left');    //Added by Waseem on 08-02-2022

        $this->db->where('MD5(CAST("QB"."subject_id" as character varying)) =', $subject_id_hash);
        if($stake_id_fk==19){
            $this->db->where('QB.entry_by', $stake_details_id_fk);
            $this->db->where('QB.process_status_id_fk', 1);
        }else{
            $this->db->where('QB.process_status_id_fk', 16);
        }
        
        $this->db->where('QB.active_status', 1);

        $this->db->order_by('QB.entry_time', 'desc');

        return $this->db->get()->result_array();
    }

    public function getSubjectQuestionListBySem($stake_details_id_fk = NULL, $subject_id_hash = NULL, $semester_id = NULL)  //Added by Waseem for QM
    {
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $this->db->select('QB.question_id_pk, QB.total_no_of_question, subject.subject_id_pk, subject.subject_name, subject.subject_code, topic.topics_chapter_name, QMM.question_type_mark_id_pk, QMM.question_type_name, QMM.question_mark, semester.semester_name,QB.other_lan_quesstion_status');

        $this->db->from('council_qbm_question_bank AS QB');

        $this->db->join('council_qbm_subject_master AS subject', 'subject.subject_id_pk = QB.subject_id', 'left');
        $this->db->join('council_qbm_subject_topics_map AS topic', 'topic.subject_topics_map_id_pk = QB.topic_chapter_id', 'left');
        $this->db->join('council_qbm_question_type_mark_master AS QMM', 'QMM.question_type_mark_id_pk = QB.question_type_mark_id', 'left');
        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = QB.sam_year_id', 'left');
		//$this->db->join('council_qbm_subject_semester_group_trade_map AS SSGTM', 'SSGTM.subject_id_fk = QB.subject_id', 'left');    //Added by Waseem on 08-02-2022

        $this->db->where('MD5(CAST("QB"."subject_id" as character varying)) =', $subject_id_hash);
        if($stake_id_fk==19){
            $this->db->where('QB.entry_by', $stake_details_id_fk);
            $this->db->where('QB.process_status_id_fk', 1);
        }else{
            $this->db->where('QB.process_status_id_fk', 16);
        }

        if ($semester_id != 'All') {
            $this->db->where('QB.sam_year_id', $semester_id);
        }

        $this->db->where('QB.active_status', 1);

        $this->db->order_by('QB.entry_time', 'desc');

        return $this->db->get()->result_array();
    }

    public function forwardQuestionSet($stake_details_id_fk = NULL, $subject_id_hash = NULL, $semester_id = NULL)   //Added by Waseem for QM
    {
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $this->db->where('MD5(CAST(subject_id as character varying)) =', $subject_id_hash);
        $this->db->where('sam_year_id', $semester_id);

        if($stake_id_fk==19){
            $this->db->where('entry_by', $stake_details_id_fk);
            $this->db->where('process_status_id_fk', 1);
        }else{
            $this->db->where('process_status_id_fk', 16);
        }

        $this->db->update('council_qbm_question_bank', array('process_status_id_fk' => 5));
        return $this->db->affected_rows();
    }

    public function getSubjectQuestionListCount($stake_details_id_fk = NULL, $subject_id_hash = NULL)   //Added by Waseem for QM
    {
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $this->db->select('count(question_id_pk)');
        $this->db->from('council_qbm_question_bank');

        $this->db->where('MD5(CAST("subject_id" as character varying)) =', $subject_id_hash);
        if($stake_id_fk==19){
            $this->db->where('entry_by', $stake_details_id_fk);
            $this->db->where('process_status_id_fk', 1);
        }else{
            $this->db->where('process_status_id_fk', 16);
        }
        $this->db->where('active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getEngQuestionList($id_hash = NULL)
    {
        $this->db->select('QBEL.eng_question_id_pk, QBEL.question, QBEL.question_clue, QBEL.question_pic, QBEL.per_question_marks, QB.question_id_pk, QB.subject_id,QBEL.q_type,QCM.question_category_name,QCM.question_category_id_pk');

        $this->db->from('council_qbm_question_bank_english_lang AS QBEL');
        $this->db->join('council_qbm_question_bank AS QB', 'QB.question_id_pk = QBEL.question_id_fk', 'left');
        $this->db->join('council_qbm_question_category_master AS QCM', 'QCM.question_category_id_pk = QBEL.q_type', 'left');

        $this->db->where('MD5(CAST("QB"."question_id_pk" as character varying)) =', $id_hash);
        $this->db->where('QB.active_status', 1);
        $this->db->order_by('QBEL.eng_question_id_pk');

        return $this->db->get()->result_array();
    }

    public function getOtherQuestionList($id_hash = NULL)
    {
        $this->db->select('QBOL.other_question_id_pk, QBOL.question, QBOL.question_clue, QBOL.question_pic, QBOL.per_question_marks, QB.question_id_pk');

        $this->db->from('council_qbm_question_bank_other_lang AS QBOL');
        $this->db->join('council_qbm_question_bank AS QB', 'QB.question_id_pk = QBOL.question_id_fk', 'left');

        $this->db->where('MD5(CAST("QB"."question_id_pk" as character varying)) =', $id_hash);
        $this->db->where('QB.active_status', 1);
        $this->db->order_by('QBOL.eng_question_id_fk');

        return $this->db->get()->result_array();
    }

    public function removeQuestionBank($id_hash = NULL, $array = NULL)
    {
        $this->db->where('MD5(CAST("question_id_pk" as character varying)) =', $id_hash);

        $this->db->update('council_qbm_question_bank', $array);

        return $this->db->affected_rows();
    }

    public function getSubjectQuestionCategoryList($subject_id_hash = NULL)
    {
        $this->db->select('QTMM.question_type_mark_id_pk, QTMM.question_type_name, QTMM.question_mark, SQTMM.min_no_of_question,semester.semester_name');
        $this->db->from('council_qbm_subject_question_type_mark_map AS SQTMM');

        $this->db->join('council_qbm_question_type_mark_master AS QTMM', 'QTMM.question_type_mark_id_pk = SQTMM.question_type_mark_id_fk', 'left');
		$this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = SQTMM.sem_year_id_fk', 'left'); //Added by Waseem on 07-02-2022

        $this->db->where('MD5(CAST("SQTMM"."subject_id_fk" as character varying)) =', $subject_id_hash);
        $this->db->where('SQTMM.active_status', 1);
        $this->db->where('QTMM.active_status', 1);
		$this->db->order_by('semester.semester_id_pk');

        return $this->db->get()->result_array();
    }
	
	public function getSubjectQuestionCategoryList_by_sem($subject_id_hash = NULL,$semester_id = NULL)
    {
        $this->db->select('QTMM.question_type_mark_id_pk, QTMM.question_type_name, QTMM.question_mark, SQTMM.min_no_of_question,semester.semester_name');
        $this->db->from('council_qbm_subject_question_type_mark_map AS SQTMM');

        $this->db->join('council_qbm_question_type_mark_master AS QTMM', 'QTMM.question_type_mark_id_pk = SQTMM.question_type_mark_id_fk', 'left');

        $this->db->join('council_qbm_semester_master AS semester', 'semester.semester_id_pk = SQTMM.sem_year_id_fk', 'left'); //Added by Waseem on 07-02-2022

        $this->db->where('MD5(CAST("SQTMM"."subject_id_fk" as character varying)) =', $subject_id_hash);
        $this->db->where('SQTMM.sem_year_id_fk', $semester_id);
        $this->db->where('SQTMM.active_status', 1);
        $this->db->where('QTMM.active_status', 1);
        $this->db->order_by('semester.semester_id_pk');

        return $this->db->get()->result_array();
    }


    public function getQuestionCategory()
    {
        $this->db->select('*');
        $this->db->from('council_qbm_question_category_master AS QCM');

        $this->db->where('QCM.active_status', 1);

        $this->db->order_by('QCM.question_category_name');

        return $this->db->get()->result_array();
    }

    public function update_other_question($id_hash = NULL, $update_array = NULL)
    {
        $this->db->where('MD5(CAST("other_question_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_qbm_question_bank_other_lang', $update_array);

        return $this->db->affected_rows();
    }

    public function insert_other_question($other_question_array = NULL)
    {
        $this->db->insert('council_qbm_question_bank_other_lang', $other_question_array);
        return $this->db->insert_id();
    }
	
	// Added by Moli

    public function updateEngQuestionImage($id_hash = NULL, $update_array = NULL)
    {
        
        $this->db->where('MD5(CAST("eng_question_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_qbm_question_bank_english_lang', $update_array);

        return $this->db->affected_rows();
    }

    public function updateOtherQuestionImage($id_hash = NULL, $update_array = NULL)
    {
        $this->db->where('MD5(CAST("other_question_id_pk" as character varying)) =', $id_hash);
        $this->db->update('council_qbm_question_bank_other_lang', $update_array);

        return $this->db->affected_rows();
    }
}
