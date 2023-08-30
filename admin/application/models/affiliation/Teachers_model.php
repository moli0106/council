<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teachers_model extends CI_Model
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

    public function getVtcTeacherList($vtc_id = NULL, $academic_year = NULL)
    {
        // $this->db->select('teacher.*, course.group_name, course.group_code, designation.designation_name');
        $this->db->select('teacher.*,  designation.designation_name');
        $this->db->from('council_affiliation_vtc_teachers AS teacher');
        // $this->db->join('council_affiliation_course_master AS course', 'course.course_id_pk = teacher.course_id_fk', 'left');
        $this->db->join('council_affiliation_designation_master AS designation', 'designation.designation_id_pk = teacher.designation_id_fk', 'left');
        $this->db->where('teacher.vtc_id_fk', $vtc_id);
        $this->db->where('teacher.academic_year', $academic_year);
        $this->db->where('teacher.active_status', 1);

        // Modify By Moli On 20-06-2022
        
        $query =  $this->db->get()->result_array();

        if(!empty($query)){

            foreach ($query as $key => $value) {
                $teacher_id_pk = $value['teacher_id_pk'];
                $teacher_type = $value['teacher_type'];

                if($teacher_type == 1){

                    $this->db->select('teacher_subject_map.*, subject_master.subject_name,subject_master.subject_code');
                    $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
                    $this->db->join('council_affiliation_subject_master as subject_master', 'teacher_subject_map.subject_group_id_fk = subject_master.subject_name_id_pk');
                    $this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
                    $this->db->where('teacher_subject_map.active_status', 1);
                    $techerSubject =  $this->db->get()->result_array();

                    $query[$key]['assignedSubject'] = $techerSubject;

                }elseif ($teacher_type == 3) {
                    
                    $this->db->select('teacher_subject_map.*, group_master.group_name,group_master.group_code');
                    $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
                    $this->db->join('council_affiliation_group_master as group_master', 'teacher_subject_map.subject_group_id_fk = group_master.group_id_pk');
                    $this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
                    $this->db->where('teacher_subject_map.active_status', 1);
                    $techerGroup =  $this->db->get()->result_array();

                    $query[$key]['assignedGroup'] = $techerGroup;
                }
                
            }

            return $query;

        }else{
            return $query= array();
        }
    }

    public function checkVtcExist($vtc_id_fk = NULL)
    {
        $this->db->where("MD5(CAST(vtc_id_pk as character varying)) =", $vtc_id_fk);

        $query = $this->db->get('council_affiliation_vtc_master')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getDesignationList()
    {
        $this->db->where('active_status', 1);

        // $this->db->order_by('designation_name');

        return $this->db->get('council_affiliation_designation_master')->result_array();
    }

    public function getEngagementList()
    {
        $this->db->where('active_status', 1);

        // $this->db->order_by('engagement_name');

        return $this->db->get('council_affiliation_engagement_master')->result_array();
    }

    public function getQualificationList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('qualification_name');

        return $this->db->get('council_affiliation_qualification_master')->result_array();
    }

    public function insertTeacherData($array = NULL)
    {
        $this->db->insert('council_affiliation_vtc_teachers', $array);

        return $this->db->insert_id();
    }

    public function getVtcCourseForTeacher($id_hash = NULL, $academic_year = NULL)
    {
        $this->db->where("MD5(CAST(vtc_id_fk as character varying)) =", $id_hash);
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
        $this->db->where_in('course_id_pk', $ids);

        return $this->db->get('council_affiliation_course_master')->result_array();
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

    public function checkVtcPanNo($vtc_id_pk = NULL, $pan_no = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('pan_no', $pan_no);
        $this->db->where('active_status', 1);

        return $this->db->get('council_affiliation_vtc_teachers')->result_array();
    }

    public function getTeacherDetails($teacher_id = NULL)
    {
        $this->db->select('
            teacher.teacher_id_pk, 
            teacher.vtc_id_fk, 
            teacher.vtc_details_id_fk, 
            teacher.academic_year, 
            teacher.teacher_type, 
            teacher.course_id_fk, 
            teacher.course_name, 
            teacher.attached_subjects, 
            teacher.teacher_name, 
            teacher.designation_id_fk, 
            teacher.other_designation, 
            teacher.engagement_id_fk, 
            teacher.qualification_id_fk, 
            teacher.other_qualification, 
            teacher.qualification_subjects, 
            teacher.mobile_no, 
            teacher.email_id, 
            teacher.qualification_certificate, 
            teacher.pan_no_image, 
            teacher.aadhar_no_image, 
            teacher.pan_no, 
            teacher.aadhar_no, 
            teacher.other_engagement,
            teacher.employee_id,

            teacher.date_of_birth,
            teacher.photo,
            teacher.whats_app_mob_no,

            course.group_name,
            course.group_code,

            designation.designation_name,
            
            engagement.engagement_name,
            
            qualification.qualification_name
        ');
        $this->db->from('council_affiliation_vtc_teachers AS teacher');
        $this->db->join('council_affiliation_course_master AS course', 'course.course_id_pk = teacher.course_id_fk', 'left');
        $this->db->join('council_affiliation_designation_master AS designation', 'designation.designation_id_pk = teacher.designation_id_fk', 'left');
        $this->db->join('council_affiliation_engagement_master AS engagement', 'engagement.engagement_id_pk = teacher.engagement_id_fk', 'left');
        $this->db->join('council_affiliation_qualification_master AS qualification', 'qualification.qualification_id_pk = teacher.qualification_id_fk', 'left');

        $this->db->where("MD5(CAST(teacher.teacher_id_pk as character varying)) =", $teacher_id);
        $this->db->where('teacher.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function updateTeacherData($teacher_id_pk = NULL, $array = NULL)
    {
        $this->db->where('teacher_id_pk', $teacher_id_pk);

        $this->db->update('council_affiliation_vtc_teachers', $array);

        return $this->db->affected_rows();
    }

    public function getSubjectByVTCId($vtc_id = NULL, $academic_year){

        $this->db->select('
            DISTINCT(subject_map.subject_name_id_fk), 
            subject_master.subject_name, 
            subject_master.subject_code
        ');
        $this->db->from('council_affiliation_vtc_course_subject_selection as vtc_course_subject');
        $this->db->join('council_affiliation_vtc_course_selection_subject_map as subject_map', 'subject_map.course_subject_id_fk = vtc_course_subject.course_subject_id_pk');
        $this->db->join('council_affiliation_subject_master as subject_master', 'subject_map.subject_name_id_fk = subject_master.subject_name_id_pk');
        $this->db->where('vtc_course_subject.vtc_id_fk', $vtc_id);
        $this->db->where('vtc_course_subject.academic_year', $academic_year);
        $this->db->where('vtc_course_subject.active_status', 1);
        $this->db->where('subject_map.active_status', 1);
        // $this->db->group_by('subject_map.subject_name_id_fk');
         return  $this->db->get()->result_array();
        //  echo $this->db->last_query();exit;

    }

    public function checkTeacherExist($subjectIdArr, $vtc_id , $academic_year){

        $this->db->select('
            vtc_teacher.teacher_id_pk, 
            vtc_teacher.vtc_id_fk, 
            vtc_teacher.academic_year, 
            vtc_teacher.active_status as teacher_active_status, 
            teacher_subject_map.*,
        ');
        $this->db->from('council_affiliation_vtc_teachers as vtc_teacher');
        $this->db->join('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map', 'teacher_subject_map.teacher_id_fk = vtc_teacher.teacher_id_pk');
        $this->db->where('vtc_teacher.vtc_id_fk', $vtc_id);
        $this->db->where('vtc_teacher.academic_year', $academic_year);
        $this->db->where('vtc_teacher.active_status', 1);
        $this->db->where('teacher_subject_map.active_status', 1);
        $this->db->where_in('teacher_subject_map.subject_group_id_fk', $subjectIdArr);
        // $this->db->where('teacher_subject_map.subject_group_id_fk', $subjectIdArr);
        return  $this->db->get()->result_array();


    }

    public function insertBatchData($table, $data)
    {
        $this->db->insert_batch($table, $data);

        return true;
    }

    public function getAssignedSubjectGroupByTeacherId($teacher_id_hash = NULL, $teacher_type = NULL){

        if($teacher_type == 1){

            $this->db->select('teacher_subject_map.*, subject_master.subject_name,subject_master.subject_code');
            $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
            $this->db->join('council_affiliation_subject_master as subject_master', 'teacher_subject_map.subject_group_id_fk = subject_master.subject_name_id_pk');
       
        }elseif ($teacher_type == 3) {

            $this->db->select('teacher_subject_map.*, group_master.group_name,group_master.group_code');
            $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
            $this->db->join('council_affiliation_group_master as group_master', 'teacher_subject_map.subject_group_id_fk = group_master.group_id_pk');
       
        }else{
            
            $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
        }
        $this->db->where("MD5(CAST(teacher_subject_map.teacher_id_fk as character varying)) =", $teacher_id_hash);
        $this->db->where('teacher_subject_map.active_status', 1);
        return $this->db->get()->result_array();

    }

    public function updateTeacherSubjectMap($table , $data, $teacher_id_hash){

        $this->db->where('teacher_id_fk', $teacher_id_hash);
        $this->db->update($table , $data);
        return $this->db->affected_rows();

    }

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

    public function checkHsHsSubjectForEleven($vtc_id_fk = NULL, $academic_year = NULL, $group_id){

        $matchingArray = array();
        foreach ($group_id as $key => $group) {
            
        
            $query = $this->db->select('DISTINCT(course_master.subject_category_id_fk)')
            ->from('council_affiliation_course_master as course_master')
            ->where("course_master.active_status", 1)
            ->where("course_master.course_name_id_fk", 1)
            ->where("course_master.class_name", 1)
            ->where("course_master.course_id_pk", $group)
            ->where("course_master.subject_category_id_fk !=", NULL)
            ->get()->result_array();

            $totalCategory = array();
            $insertCategoryArray = array();

            if(!empty($query)){
                foreach ($query as $key => $value) {
                    array_push($totalCategory, $value['subject_category_id_fk']);
                }
            }
            $query1 = $this->db->select('DISTINCT(subject_category_id_fk)')
            ->from('council_affiliation_vtc_course_subject_selection')
            ->where("active_status", 1)
            // ->where("course_name_id_fk", 1)
            ->where("class_name", 1)
            ->where("vtc_id_fk", $vtc_id_fk)
            ->where("academic_year", $academic_year)
            ->where("group_id_fk", $group)
            ->get()->result_array();

            if(!empty($query1)){
                foreach ($query1 as $key => $value) {
                    array_push($insertCategoryArray, $value['subject_category_id_fk']);
                }
            }

            $result=array_diff($totalCategory,$insertCategoryArray);
        
            // echo "<pre>";print_r($result);exit;
            if(count($result) == 0){
                array_push($matchingArray, 'match') ;
            }else{
                array_push($matchingArray, 'not match') ;
            }

            // echo $this->db->last_query();
            // echo "<pre>";print_r($query1);exit;
        }
        if (in_array("not match", $matchingArray))
        {
            return 'not match';
        }
        else
        {
            return 'match';
        }
    }

    public function checkHsHsSubjectForTwelve($vtc_id_fk = NULL, $academic_year = NULL, $group_id){

        $matchingArray = array();
        foreach ($group_id as $key => $group) {
        
            $query = $this->db->select('DISTINCT(course_master.subject_category_id_fk)')
            ->from('council_affiliation_course_master as course_master')
            ->where("course_master.active_status", 1)
            ->where("course_master.course_name_id_fk", 1)
            ->where("course_master.class_name", 2)
            ->where("course_master.course_id_pk", $group)
            ->where("course_master.subject_category_id_fk !=", NULL)
            ->get()->result_array();

            $totalCategory = array();
            $insertCategoryArray = array();

            if(!empty($query)){
                foreach ($query as $key => $value) {
                    array_push($totalCategory, $value['subject_category_id_fk']);
                }
            }
            $query1 = $this->db->select('DISTINCT(subject_category_id_fk)')
            ->from('council_affiliation_vtc_course_subject_selection')
            ->where("active_status", 1)
            // ->where("course_name_id_fk", 1)
            ->where("class_name", 2)
            ->where("vtc_id_fk", $vtc_id_fk)
            ->where("academic_year", $academic_year)
            ->where("group_id_fk", $group)
            ->get()->result_array();

            if(!empty($query1)){
                foreach ($query1 as $key => $value) {
                    array_push($insertCategoryArray, $value['subject_category_id_fk']);
                }
            }

            $result=array_diff($totalCategory,$insertCategoryArray);
        
            // echo "<pre>";print_r($result);exit;
            // if(count($result) == 0){
            //     return 'match';
            // }else{
            //     return 'not match';
            // }

            if(count($result) == 0){
                array_push($matchingArray, 'match') ;
            }else{
                array_push($matchingArray, 'not match') ;
            }

            // echo $this->db->last_query();
            // echo "<pre>";print_r($query1);exit;
        }
        if (in_array("not match", $matchingArray))
        {
            return 'not match';
        }
        else
        {
            return 'match';
        }
        
    }

    public function getGrouptByVTCId($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('DISTINCT(group_map.group_id_fk),group_master.group_id_pk,group_master.group_name, group_master.group_code');
        $this->db->from('council_affiliation_vtc_course_selection as course_selection');

        $this->db->join('council_affiliation_vtc_course_selection_group_map as group_map', 'group_map.vtc_course_id_fk = course_selection.vtc_course_id_pk','LEFT');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk','LEFT');
        $this->db->where('course_selection.vtc_id_fk', $vtc_id);
        $this->db->where('course_selection.academic_year', $academic_year);
        $this->db->where('course_selection.active_status', 1);
        $this->db->where('course_selection.course_name_id_fk', 4);
        // $this->db->order_by('group_master.group_name');

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query;
        } else {
            return array();
        }
    }

    // 22-07-2022

    public function getAllTeacherDetailsById($teacher_id = NULL){
    
        $current_year = $this->config->item('current_academic_year');
        $this->db->select('*');
        $this->db->from('council_affiliation_vtc_teachers');
        $this->db->where('teacher_id_pk', $teacher_id);
        $data =  $this->db->get()->result_array();

        foreach ($data as $key => $subArr) { 
            unset($data[$key]['teacher_id_pk']); 
            // unset($data[$key]['academic_year']);
            $data[$key]['academic_year'] = $current_year;     
            $data[$key]['parent_id'] = $teacher_id;     
            $data[$key]['entry_time'] = 'now()';     
            $data[$key]['entry_ip'] = $this->input->ip_address();     
        }
        return $data[0];
    }

    public function getTeacherSubjectMapData($teacher_id = NULL){

        $this->db->select('*');
        $this->db->from('council_affiliation_vtc_teacher_subject_group_map');
        $this->db->where('teacher_id_fk', $teacher_id);
        $this->db->where('active_status', 1);
        $data =  $this->db->get()->result_array();
        return $data;
    }

    public function insertMapData($data,$last_id){

        $current_year = $this->config->item('current_academic_year');
        foreach ($data as $key => $subArr) { 
            
            unset($data[$key]['teacher_subject_map_id_pk']);
            $data[$key]['academic_year'] = $current_year;     
            $data[$key]['teacher_id_fk'] = $last_id;     
        }
        $this->db->insert_batch('council_affiliation_vtc_teacher_subject_group_map', $data);

        return true;

    }

    public function removeTeacherData($teacher_id_pk = NULL, $array = NULL)
    {
        $this->db->where('teacher_id_pk', $teacher_id_pk);

        $this->db->update('council_affiliation_vtc_teachers', $array);

        // Delete Teacher Mapping

        $this->db->where('teacher_id_fk', $teacher_id_pk);

        $this->db->update('council_affiliation_vtc_teacher_subject_group_map', $array);

        // Delete Teacher Mapping

        return $this->db->affected_rows();
    }
}
