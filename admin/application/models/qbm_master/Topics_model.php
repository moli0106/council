<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topics_model extends CI_Model {

    public function get_subjectCount(){
        $query = $this->db->select("count(subject_id_pk)")
            ->from("council_qbm_subject_master")
            ->get();
        return $query->result_array();
    }


    public function getAll_subject($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_subject_master as subject")
            ->join("council_qbm_subject_group_master as sub_group","sub_group.subject_group_id_pk = subject.sub_group_id_fk","LEFT")
            ->limit($limit, $offset)
            ->order_by("subject_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getAllcourse(){
        $query = $this->db->select("*")
            ->from("council_qbm_course_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("course_name", "ASC")
            ->get();
        return $query->result_array();
    } 

    public function getAllsubGroup(){
        $query = $this->db->select("*")
            ->from("council_qbm_subject_group_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("subject_group_name", "ASC")
            ->get();
        return $query->result_array();
    } 
    
   

    public function insert_subject_data($array)
    {
        $this->db->insert('council_qbm_subject_master', $array);

        return $this->db->insert_id();
    }



    public function getDisciplineList($course_code = NULL)
    {
        $this->db->where("active_status", 1);
        $this->db->where("course_id_fk", $course_code);
        $this->db->order_by("discipline_name");
        return $this->db->get('council_qbm_disciplne_master')->result_array();
    }
    public function get_group_trade_List($discipline_code = NULL)
    {
        $this->db->where("active_status", 1);
        $this->db->where("discipline_id_fk", $discipline_code);
        $this->db->order_by("group_trade_name");
        return $this->db->get('council_qbm_group_trade_master')->result_array();
    }
    public function get_semester_List($course_code = NULL)
    {
        $this->db->where("active_status", 1);
        $this->db->where("course_id_fk", $course_code);
        $this->db->order_by("semester_name");
        return $this->db->get('council_qbm_semester_master')->result_array();
    }
    
    
}
/* End of file Master_trainer_model.php */
?>