<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Students_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_id_pk', $vtc_id)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getVtcCourseList($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_courses')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getCourseWhereIdIn($ids = NULL)
    {
        $this->db->select('DISTINCT(course_id_pk),group_name,group_code');
        $this->db->where("active_status", 1);
        $this->db->where_in('course_id_pk', $ids);

        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getStudentCountDetails($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_vtc_student_count_details')->result_array();
    }

    public function insertBatchStudentDetails($array = NULL)
    {
        $this->db->insert_batch('council_affiliation_vtc_student_count_details', $array);

        return TRUE;
    }

    public function updateStudentDetails($array = NULL)
    {
        $this->db->select('*');

        $this->db->where('vtc_id_fk', $array['vtc_id_fk']);
        $this->db->where('vtc_details_id_fk', $array['vtc_details_id_fk']);
        $this->db->where('academic_year', $array['academic_year']);
        $this->db->where('course_id_fk', $array['course_id_fk']);

       $query =  $this->db->get('council_affiliation_vtc_student_count_details')->result_array();

        if(!empty($query)){

            $this->db->where('vtc_id_fk', $array['vtc_id_fk']);
            $this->db->where('vtc_details_id_fk', $array['vtc_details_id_fk']);
            $this->db->where('academic_year', $array['academic_year']);
            $this->db->where('course_id_fk', $array['course_id_fk']);

           $this->db->update('council_affiliation_vtc_student_count_details', array('enrolled_student' => $array['enrolled_student']));
        }else{
            $this->db->insert('council_affiliation_vtc_student_count_details', $array); 
        }

        // echo $this->db->last_query();exit;
    }

    
    //13-07-2022
    public function getVtcAllCourseList($vtc_id_fk = NULL, $academic_year = NULL){

        $this->db->select('
            vtc_course.*,
            course_name.course_name, 
            group_master.group_name, 
            group_master.group_code, 
            discipline_master.discipline_name,
           
        ');
        $this->db->from('council_affiliation_vtc_course_selection as vtc_course');
        $this->db->join('council_affiliation_course_name_master as course_name', 'course_name.course_name_id_pk = vtc_course.course_name_id_fk','LEFT');
        $this->db->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = vtc_course.discipline_id_fk','LEFT');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = vtc_course.group_id_fk','LEFT');
        //$this->db->join('council_qbm_subject_category_master as category_master', 'category_master.subject_category_id_pk = vtc_course.subject_category_id_fk');
        $this->db->where('vtc_course.vtc_id_fk', $vtc_id_fk);
        $this->db->where('vtc_course.academic_year', $academic_year);
        $this->db->where('vtc_course.active_status', 1);
        $this->db->order_by('vtc_course_id_pk', 'DESC');
        $query = $this->db->get()->result_array();
        //  echo $this->db->last_query();exit;

        if(!empty($query)){

            foreach ($query as $key => $value) {
               $vtc_course_id_pk = $value['vtc_course_id_pk'];

               $this->db->select('
                    group_map.group_id_fk,
                    group_master.group_name,
                    group_master.group_code
                ');
                $this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
                $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk','LEFT');
                $this->db->where('group_map.vtc_course_id_fk', $vtc_course_id_pk);
                $this->db->where('group_map.active_status', 1);
                $group = $this->db->get()->result_array();

                if(!empty($group)){

                    $query[$key]['group'] = $group;
                }else{
                    $query[$key]['group'] = '';
                }
                
            }
            return $query;
        }else{

            return $query = array();
        }
    }

    public function updateStudentCountStatus($vtc_id, $academic_year)
    {
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('academic_year', $academic_year);

        $this->db->update('council_affiliation_vtc_student_count_details', array('active_status' => 2));
        return $this->db->affected_rows();
    }

    public function getStudentCountDetails_old($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        // $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_vtc_student_count_details')->result_array();
    }
}
