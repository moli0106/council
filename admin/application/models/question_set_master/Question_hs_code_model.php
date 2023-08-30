<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_hs_code_model extends CI_Model {

    public function getAllcourse(){
        $query = $this->db->select("*")
            ->from("council_qbm_course_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->where_in('course_id_pk',array(1,2))
            ->order_by("course_name", "ASC")
            ->get();
        return $query->result_array();
    } 

    public function getDisciplineList($course_code = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_discipline_master as dis_mas")
            ->join("council_qbm_course_discipline_map as dis_map","dis_map.discipline_id_fk = dis_mas.discipline_id_pk")
            ->where(
                array(
                    "dis_mas.active_status"     => 1,
                    "dis_map.course_id_fk"      => $course_code
                )
            )
            ->order_by("dis_mas.discipline_name", "ASC")
            ->get();
        return $query->result_array();
        
    }

    public function get_semester_List($course_code = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_semester_master as sem")
            ->join("council_qbm_course_semester_map as sem_map","sem_map.semester_id_fk = sem.semester_id_pk")
            ->where(
                array(
                    "sem.active_status"     => 1,
                    "sem_map.course_id_fk"      => $course_code
                )
            )
            ->order_by("sem.semester_name", "ASC")
            ->get();
        return $query->result_array();
    }
    public function get_subject_List_old($course_id = NULL,$discipline_id = NULL)
    {
        $query = $this->db->select("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->from("council_qbm_subject_master as subject_mas")
            ->join("council_qbm_subject_semester_group_trade_map as sub_map","sub_map.subject_id_fk = subject_mas.subject_id_pk")
            ->where(
                array(
                    "subject_mas.active_status" => 1,
                    "sub_map.course_id_fk"      => $course_id,
                    "sub_map.discipline_id_fk"  => $discipline_id,
                )
            )
            ->group_by("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->order_by("subject_mas.subject_name", "ASC")
            ->get();
        return $query->result_array();
    }






    public function getAll_subject()
    {
        $query = $this->db->select("*")
            ->from("council_qbm_subject_master as subject")
            ->where(
                array(
                    "active_status"     => 1,
                )
            )
            
            ->order_by("subject_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getAllsubCategory(){
        $query = $this->db->select("*")
            ->from("council_qbm_subject_category_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("subject_category_name", "ASC")
            ->get();
        return $query->result_array();
    }
    
    public function get_question_code_count(){
        $query = $this->db->select("count(question_code_id_pk)")
            ->from("council_qbm_question_code_master")
            ->get();
        return $query->result_array();
    }


    public function getAll_question_code($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("course.course_name,que_code.question_code_id_pk,que_code.question_code,subject.subject_name,subject.subject_code,subject.subject_id_pk")
            ->from("council_qbm_question_code_master as que_code")
            ->join("council_qbm_course_master as course","course.course_id_pk = que_code.course_id_fk")
            //->join("council_qbm_discipline_master as discipline","discipline.discipline_id_pk = que_code.discipline_id_fk")
            //->join("council_qbm_semester_master as semester","semester.semester_id_pk = que_code.sam_year_id_fk")
            ->join("council_qbm_subject_master as subject","subject.subject_id_pk = que_code.subject_id_fk")
            ->where(
                array(
                    "que_code.active_status"     => 1
                )
            )
            ->where_in('que_code.course_id_fk',array(1,2))
            ->limit($limit, $offset)
            ->order_by("question_code_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function insert_question_code_data($array)
    {
        $this->db->insert('council_qbm_question_code_master', $array);

        return $this->db->insert_id();
    }
    
    public function get_same_subject_data_hsvoc($course_id,$subject_id){
        $query = $this->db->select("count(map.question_code_id_pk)")
            ->from("council_qbm_question_code_master as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.course_id_fk" => $course_id,
                    //"map.discipline_id_fk" => $discipline_id,
                    "map.subject_id_fk" => $subject_id,
                   
                )
            )
            ->get();
        return $query->result_array();

    } 
    public function get_same_question_code_data_hsvoc($question_code){
        $query = $this->db->select("count(map.question_code_id_pk)")
            ->from("council_qbm_question_code_master as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.question_code" => $question_code,
                    
                   
                )
            )
            ->get();
        return $query->result_array();

    } 
   public function get_subject_List($course_id = NULL, $subject_ids = NULL)
    {
		
        $query = $this->db->select("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->from("council_qbm_subject_master as subject_mas")
            ->join("council_qbm_subject_semester_group_trade_map as sub_map","sub_map.subject_id_fk = subject_mas.subject_id_pk")
            ->where(
                array(
                    "subject_mas.active_status"     => 1,
                    "sub_map.course_id_fk"      => $course_id
                )
            );
			if($subject_ids!=NULL){
			$query = $query->where_not_in('subject_mas.subject_id_pk',$subject_ids);
			}
            $query=$query->group_by("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code");
            $query=$query->order_by("subject_mas.subject_name", "ASC");
            $query=$query->get();
        return $query->result_array();
    }

    public function get_hs_question_code_details($id_hash){
        $query = $this->db->select("*")
            ->from("council_qbm_question_code_master as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "MD5(CAST(map.question_code_id_pk AS character varying)) ="    => $id_hash
                   
                )
            )
            ->get();
        return $query->result_array();

    } 

    public function updateQuestionCodeData($question_code_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(question_code_id_pk as character varying)) =", $question_code_id);
        $this->db->update('council_qbm_question_code_master', $updateArray);
        return $this->db->affected_rows();
    }


}

?>