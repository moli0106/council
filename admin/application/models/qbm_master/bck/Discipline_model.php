<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discipline_model extends CI_Model {

    public function get_semesterCount(){
        $query = $this->db->select("count(discipline_id_pk)")
            ->from("council_qbm_disciplne_master")
            ->get();
        return $query->result_array();
    }


    public function getAll_semester($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_disciplne_master as disciplne")
            ->join("council_qbm_course_master as course","course.course_id_pk = disciplne.course_id_fk")
            ->limit($limit, $offset)
            ->order_by("discipline_id_pk", "ASC")
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
    
   

    public function insert_discipline_data($array)
    {
        $this->db->insert('council_qbm_disciplne_master', $array);

        return $this->db->insert_id();
    }
    
   


}
/* End of file Master_trainer_model.php */
?>