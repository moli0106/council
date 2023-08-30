<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_model extends CI_Model
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

    public function getHsGroupTrade($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('DISTINCT(group_map.group_id_fk),group_master.group_id_pk,group_master.group_name');
        $this->db->from('council_affiliation_vtc_course_selection as course_selection');

        $this->db->join('council_affiliation_vtc_course_selection_group_map as group_map', 'group_map.vtc_course_id_fk = course_selection.vtc_course_id_pk','LEFT');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk','LEFT');
        $this->db->where('course_selection.vtc_id_fk', $vtc_id);
        $this->db->where('course_selection.academic_year', $academic_year);
        $this->db->where('course_selection.active_status', 1);
        $this->db->where('course_selection.course_name_id_fk', 1);
        $this->db->order_by('group_master.group_name');

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query;
        } else {
            return array();
        }
    }

    public function getsubCategoryByClassName($class_name_id){

        $this->db->select('DISTINCT(course_master.subject_category_id_fk), subject_category_master.subject_category_id_pk,subject_category_master.subject_category_name');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_qbm_subject_category_master as subject_category_master', 'subject_category_master.subject_category_id_pk = course_master.subject_category_id_fk');
        $this->db->where("course_master.active_status", 1);

        $this->db->where('course_master.class_name', $class_name_id);
        $this->db->order_by("subject_category_master.subject_category_name");
        return $this->db->get()->result_array();
    }

    public function getSubjectList($class_name, $group, $sub_cat_id,$vtc_id_fk,$academic_year){

        $subject = $this->db->select('subject_name_id_fk')
        ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
        ->join('council_affiliation_vtc_course_subject_selection as course_subject_selection', 'subject_map.course_subject_id_fk = course_subject_selection.course_subject_id_pk')
        ->where('course_subject_selection.vtc_id_fk', $vtc_id_fk)
        ->where('course_subject_selection.academic_year', $academic_year)
        ->where('course_subject_selection.group_id_fk', $group)
        ->where('subject_map.active_status', 1)
        ->get()->result_array();
        // echo $this->db->last_query();exit;
        $subjectArray = array();
        if(!empty($subject)){
            foreach ($subject as $key => $value) {
                array_push($subjectArray, $value['subject_name_id_fk']);
            }
        }
        // echo "<pre>";print_r($subjectArray);exit;
        
        
        
        $this->db->select('course_master.*, subject_master.subject_name_id_pk,subject_master.subject_name, subject_master.subject_code');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = course_master.subject_name_id_fk');
        $this->db->where("course_master.course_name_id_fk", 1);
        $this->db->where("course_master.active_status", 1);
        $this->db->where('course_master.course_id_pk', $group);
        $this->db->where('course_master.subject_category_id_fk', $sub_cat_id);

        $this->db->where('course_master.class_name', $class_name);
        // $this->db->where('subject_master.subject_name_id_pk NOT IN(SELECT subject_name_id_fk FROM council_affiliation_vtc_course_selection_subject_map WHERE active_status=1 and academic_year = '."'$academic_year'".' and vtc_id_fk='.$vtc_id_fk.')');
        if(!empty($subjectArray)){
            $this->db->where_not_in('subject_master.subject_name_id_pk', $subjectArray);
        }

        $this->db->order_by("subject_master.subject_name");
        return $this->db->get()->result_array();
        // echo $this->db->last_query();exit;
    }

    public function insertVtcSubjectData($array)
    {
        $this->db->insert('council_affiliation_vtc_course_subject_selection', $array);

        return $this->db->insert_id();
    }

    public function insertBatchData($table, $data)
    {
        $this->db->insert_batch($table, $data);

        return true;
    }

    public function getVtcAllSubjectList($vtc_id_fk = NULL, $academic_year = NULL){

        $this->db->select('
            vtc_course_subject.*, 
            group_master.group_name, 
            group_master.group_code,
            category_master.subject_category_name
        ');
        $this->db->from('council_affiliation_vtc_course_subject_selection as vtc_course_subject');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = vtc_course_subject.group_id_fk','LEFT');
        $this->db->join('council_qbm_subject_category_master as category_master', 'category_master.subject_category_id_pk = vtc_course_subject.subject_category_id_fk','LEFT');
        $this->db->where('vtc_course_subject.vtc_id_fk', $vtc_id_fk);
        $this->db->where('vtc_course_subject.academic_year', $academic_year);
        $this->db->where('vtc_course_subject.active_status', 1);
        $this->db->order_by('course_subject_id_pk', 'DESC');
        $query = $this->db->get()->result_array();
        //  echo $this->db->last_query();exit;

        if(!empty($query)){

            foreach ($query as $key => $value) {
               $course_subject_id_pk = $value['course_subject_id_pk'];

               $this->db->select('
                    subject_map.subject_name_id_fk,
                    subject_master.subject_name,
                    subject_master.subject_code
                ');
                $this->db->from('council_affiliation_vtc_course_selection_subject_map as subject_map');
                $this->db->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk');
                $this->db->where('subject_map.course_subject_id_fk', $course_subject_id_pk);
                $this->db->where('subject_map.active_status', 1);
                $subject = $this->db->get()->result_array();

                $query[$key]['subject'] = $subject;

               
            }
            return $query;
        }else{

            return $query = array();
        }
    }

    public function getSubjectFromMap($id_hash = NULL){

       $query = $this->db->select('*')
        ->from('council_affiliation_vtc_course_selection_subject_map')
        ->where('active_status', 1)
        ->where("MD5(CAST(course_subject_id_fk as character varying)) =", $id_hash)
        ->get()->result_array();

        if(!empty($query)){
            $subjectName = array();
            foreach ($query as $key => $value) {
                array_push($subjectName, $value['subject_name_id_fk']);
            }
            return $subjectName;
        }else{
            return array();
        }
    }

    public function getSubjectDetails($id_hash = NULL){

        $query = $this->db->select('*')
        ->from('council_affiliation_vtc_course_subject_selection')
        ->where('active_status', 1)
        ->where("MD5(CAST(course_subject_id_pk as character varying)) =", $id_hash)
        ->get()->row_array();

        if(!empty($query)){
            
            return $query;
        }else{
            return array();
        }
    }

    public function getTeacher($subjectNameId, $vtc_id_fk, $academic_year, $teacher_type){

        $this->db->select('subject_group_map.subject_group_id_fk');
        $this->db->from('council_affiliation_vtc_teachers as teacher');
        $this->db->join('council_affiliation_vtc_teacher_subject_group_map as subject_group_map', 'subject_group_map.teacher_id_fk = teacher.teacher_id_pk');
        $this->db->where_in('subject_group_map.subject_group_id_fk', $subjectNameId);
        $this->db->where('teacher.vtc_id_fk', $vtc_id_fk);
        $this->db->where('teacher.academic_year', $academic_year);
        $this->db->where('subject_group_map.teacher_type', $teacher_type);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
           
            return $query;
        }else{
            return array();
        }
    }

    public function updateSubjectSelection($course_subject_id = NULL,$array = NULL)
    {
        $this->db->where("MD5(CAST(course_subject_id_pk as character varying)) =", $course_subject_id);

        $this->db->update('council_affiliation_vtc_course_subject_selection', $array);

        return $this->db->affected_rows();
    }

    public function updateSubjectMap($course_subject_id = NULL,$array = NULL)
    {
        $this->db->where("MD5(CAST(course_subject_id_fk as character varying)) =", $course_subject_id);

        $this->db->update('council_affiliation_vtc_course_selection_subject_map', $array);

        return $this->db->affected_rows();
    }

    public function resetTeacherSubjectMap($vtc_id_pk, $academic_year){
        
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('teacher_type', 1);
        $this->db->update('council_affiliation_vtc_teacher_subject_group_map', array('active_status' => 0));
        
        return $this->db->affected_rows();
    }

    public function resetSubject($vtc_id_pk, $academic_year){
        
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_course_selection_subject_map', array('active_status' => 0));


        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_course_subject_selection', array('active_status' => 0));

         
        return $this->db->affected_rows();
    }

    // 18-07-2022
    public function getAllSubjectAndCategory($class_name, $group){

        $this->db->select('course_master.*, subject_master.subject_name_id_pk,subject_master.subject_name, subject_master.subject_code,subject_category_master.subject_category_id_pk,subject_category_master.subject_category_name');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = course_master.subject_name_id_fk');
        $this->db->join('council_qbm_subject_category_master as subject_category_master', 'subject_category_master.subject_category_id_pk = course_master.subject_category_id_fk');

        $this->db->where("course_master.course_name_id_fk", 1);
        $this->db->where("course_master.active_status", 1);
        $this->db->where('course_master.course_id_pk', $group);
        $this->db->where('course_master.active_status', 1);

        $this->db->where('course_master.class_name', $class_name);
        $this->db->order_by("subject_master.subject_name");
        $query = $this->db->get()->result_array();

        $group = array();

        foreach ( $query as $value ) {
            $group[$value['subject_category_name']]['category_id'] = $value['subject_category_id_pk'];
            $group[$value['subject_category_name']]['subject_name'][] = $value;
        }
        return $group;
        // echo $this->db->last_query();exit;
    }
}