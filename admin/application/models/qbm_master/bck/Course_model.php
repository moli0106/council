<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {

    public function get_courseCount(){
        $query = $this->db->select("count(course_id_pk)")
            ->from("council_qbm_course_master")
            ->get();
        return $query->result_array();
    }

    public function getAll_course($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_course_master")
            ->limit($limit, $offset)
            ->order_by("course_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    


}

?>