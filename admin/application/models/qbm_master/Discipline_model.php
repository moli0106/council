<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discipline_model extends CI_Model {

    public function get_disciplineCount(){
        $query = $this->db->select("count(discipline_id_pk)")
            ->from("council_qbm_discipline_master")
            ->get();
        return $query->result_array();
    }


    public function getAll_discipline($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_discipline_master as disciplne")
            //->join("council_qbm_course_master as course","course.course_id_pk = disciplne.course_id_fk")
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
        $this->db->insert('council_qbm_discipline_master', $array);

        return $this->db->insert_id();
    }

    public function get_course_discipline_map($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("cdm.course_discipline_map_id_pk,course.course_name,discipline.discipline_name,discipline.discipline_code")
            ->from("council_qbm_course_discipline_map as cdm")
            ->join("council_qbm_course_master as course","course.course_id_pk = cdm.course_id_fk")
            ->join("council_qbm_discipline_master as discipline","discipline.discipline_id_pk = cdm.discipline_id_fk")
            ->limit($limit, $offset)
            ->order_by("cdm.course_discipline_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function get_same_course_discipline_data($course_id,$discipline_id){
        $query = $this->db->select("count(map.course_discipline_map_id_pk)")
            ->from("council_qbm_course_discipline_map as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.course_id_fk" => $course_id,
                    "map.discipline_id_fk" => $discipline_id,
                   
                )
            )
            ->get();
        return $query->result_array();

    }

    public function map_course_discipline($mapArray)
    {
        return $this->db->insert('council_qbm_course_discipline_map', $mapArray); 
    }

    
   


}
/* End of file Master_trainer_model.php */
?>