<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semester_model extends CI_Model {

    public function get_semesterCount(){
        $query = $this->db->select("count(course_semester_map_id_pk)")
            ->from("council_qbm_course_semester_map")
            ->get();
        return $query->result_array();
    }


    public function getAll_semester($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_course_semester_map as sem")
            ->join("council_qbm_course_master as course","course.course_id_pk = sem.course_id_fk")
            ->join("council_qbm_semester_master as semester","semester.semester_id_pk = sem.semester_id_fk")
            ->limit($limit, $offset)
            ->order_by("course_semester_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    


}

?>