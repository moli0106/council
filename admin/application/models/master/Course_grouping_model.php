<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_grouping_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllcourse($id = NULL, $courseArray = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_course_master")
            ->where(
                array(
                    'process_status_fk'   => 5,
                    'active_status' => 1
                )
            );

        if ($id != NULL) {
            $query = $query->where('course_id_pk !=', $id);
        }

        if ($courseArray != NULL) {
            $query = $query->where_not_in('course_id_pk', $courseArray);
        }

        $query = $query->order_by('course_name', 'ASC')
            ->get();

        return $query->result_array();
    }

    public function getMappedcourse()
    {
        $query = $this->db->select("map.course_grouping_id_pk, map.course_id_fk, course_map.course_name, course_main.course_name AS course_name_main")
            ->from("council_course_grouping AS map")
            ->join('council_course_master AS course_map', 'course_map.course_id_pk = map.course_grouping_id_fk', 'LEFT')
            ->join('council_course_master AS course_main', 'course_main.course_id_pk = map.course_id_fk', 'LEFT')
            ->where(
                array(
                    'map.active_status'  => 1
                )
            )
            //->order_by('district_name_main')
            ->get();

        return $query->result_array();
    }

    public function getMappedCourseByCourseId($id = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_course_grouping")
            ->where(
                array(
                    'course_id_fk' => $id,
                    'active_status'  => 1
                )
            )
            ->get();

        return $query->result_array();
    }

    /*public function batchInsert($array = NULL)
    {

        $this->db->insert_batch('council_assessment_district_map', $array);

        return true;
    }

    public function checkPriority($district_id_fk = NULL, $priority = NULL)
    {
        $this->db->where('district_id_fk', $district_id_fk);
        $this->db->where('priority', $priority);
        return $this->db->get('council_assessment_district_map')->result_array();
    }*/

    public function insertMapCourse($array = NULL)
    {
        $this->db->insert('council_course_grouping', $array);
        return $this->db->insert_id();
    }
}

/* End of file Map_district_model.php */
