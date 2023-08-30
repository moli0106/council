<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Exam_result_list_model extends CI_Model
{

    
    	public function get_result_list() 
        {
            $query = $this->db->select("exam.marks as marks_secured
            ,to_char(exam.exam_taken_date,'DD.mm.YYYY') as exam_taken_date
            ,exam.exam_questions as exam_questions
            ,degree.degree_name as degree_name
            ,degree.code as degree_code
            ,course.course_name as course_name
            ,course.code as course_code
            ,semester.semester_name as semester_name
            ,semester.code as semester_code
            ,subject.subject_name as subject_name
            ,subject.code as subject_code
            ,module.module_name as module_name
            ,module.code as module_code
            ,level.level_name as level_name
            ,level.code as level_code")
            ->from('elearning_exam_details AS exam')
            ->join('elearning_degree_code_master AS degree','degree.code = exam.degree_code')
            ->join('elearning_course_code_master AS course','course.code = exam.course_code')
            ->join('elearning_semester_code_master AS semester','semester.code = exam.semester_code')
            ->join('elearning_module_code_master AS module','module.code = exam.module_code')                    
            ->join('elearning_subject_code_master AS subject','subject.code = exam.subject_code')
            ->join('elearning_level_code_master AS level','level.code = exam.level_code')
            ->where(
                array(
                    'exam.login_id'    => $this->session->login_id,
                ))
            ->order_by('exam.exam_taken_date','ASC')
            ->get();
            
           // print $this->db->last_query(); die;
            return $query->result_array();
            
        }
        
        /*
	public function get_result_list($limit = NULL, $offset = 0) {
		$query = $this->db->select("
				exam.marks,
				exam.exam_taken_date,
				degree.degree_name,
				course.course_name,
				subject.subject_name,
				level.level_name
				")
            ->from('elearning_exam_details AS exam')
            ->join('elearning_degree_code_master AS degree','degree.code = exam.degree_code')
            ->join('elearning_course_code_master AS course','course.code = exam.course_code')
            ->join('elearning_subject_code_master AS subject','subject.code = exam.subject_code')
            ->join('elearning_level_code_master AS level','level.code = exam.level_code')
            ->where(
                array(
                    'exam.login_id'    => $this->session->login_id,
                    //'tpso.status'           => 1
                )
            )
            ->order_by('exam.exam_taken_date','ASC')
            ->limit($limit,$offset)
            ->get();
        return $query->result_array();
	}*/
	

	public function get_result_list_count() {
        $query = $this->db->select("count(code)")
            ->from('elearning_exam_details AS exam')
            ->where(
                array(
                    'exam.login_id'    => $this->session->login_id,
                    //'tpso.status'           => 1
                )
            )
            ->get();
        return $query->result_array();
    }
		
}
