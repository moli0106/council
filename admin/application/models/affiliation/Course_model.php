<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_model extends CI_Model
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

    public function getCourseNameList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("course_name");
        return $this->db->get('council_affiliation_course_name_master')->result_array();
    }

    public function getDisciplineList()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("discipline_name");
        return $this->db->get('council_affiliation_discipline_master')->result_array();
    }

    public function getDisciplineListByCourseName($course_name_id){
        $this->db->select('DISTINCT(course_master.discipline_id_fk), discipline_master.*');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = course_master.discipline_id_fk');
        if($course_name_id == 4){

            $this->db->where('course_master.course_name_id_fk !=',4 );
            $this->db->where('course_master.course_name_id_fk !=',1 );
        }else{
            $this->db->where('course_master.course_name_id_fk',$course_name_id );
        }
        $this->db->where('course_master.active_status',1 );
        $this->db->order_by("discipline_master.discipline_name");
        return $this->db->get()->result_array();
    }

    public function getCourseListByNameDiscipline($courseName = NULL, $discipline = NULL,$vtc_id, $academic_year)
    {
        
        $this->db->select('DISTINCT(course_master.course_id_pk),course_master.discipline_id_fk,course_master.course_name_id_fk, group_master.group_id_pk,group_master.group_name,group_master.group_code');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = course_master.course_id_pk','LEFT');
        $this->db->where("course_master.course_name_id_fk", $courseName);
        $this->db->where("course_master.active_status", 1);
        $this->db->where('course_master.discipline_id_fk', $discipline);

        $this->db->where('course_master.course_id_pk NOT IN(SELECT group_id_fk FROM council_affiliation_vtc_course_selection_group_map WHERE active_status=1 and academic_year = '."'$academic_year'".' and vtc_id_fk='.$vtc_id.')');

        $this->db->order_by("group_master.group_name");
        return $this->db->get()->result_array();

        //  echo $this->db->last_query();exit;
    }

    public function getCourseListById($courseIds = NULL)
    {
        $this->db->select('DISTINCT(course_id_pk),group_name,group_code');
        $this->db->where("active_status", 1);
        $this->db->where_in('course_id_pk', $courseIds);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function insertVtcCourseData_old($array)
    {
        $this->db->insert('council_affiliation_vtc_courses', $array);

        return $this->db->insert_id();
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

    public function resetCourseTeacherStudent($vtc_id_pk = NULL, $vtc_details_id_pk = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('vtc_details_id_fk', $vtc_details_id_pk);
        $this->db->update('council_affiliation_vtc_student_count_details', array('active_status' => 0));

        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('vtc_details_id_fk', $vtc_details_id_pk);
        $this->db->update('council_affiliation_vtc_teachers', array('active_status' => 0));

        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('vtc_details_id_fk', $vtc_details_id_pk);
        $this->db->update('council_affiliation_vtc_courses', array('active_status' => 0));
    }


    // Added by Moli on 13-06-2022 For New Modification

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

    public function insertVtcCourseData($array)
    {
        $this->db->insert('council_affiliation_vtc_course_selection', $array);

        return $this->db->insert_id();
    }

    public function getCourseDetailsById($vtc_course_id_hash){

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
        $this->db->where("MD5(CAST(vtc_course.vtc_course_id_pk as character varying)) =", $vtc_course_id_hash);
        $this->db->where('vtc_course.active_status', 1);
        $query = $this->db->get()->row_array();
        if(!empty($query)){

            $vtc_course_id_pk = $query['vtc_course_id_pk'];

            if($vtc_course_id_pk !=''){

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

                    $query['group'] = $group;
                }else{
                    $query['group'] = '';
                }
            }
            return $query;

        }else{
            return $query = array();
        }

    }

    public function getSubjectNameByVTCId($vtc_course_id_hash){
        $this->db->select('
            vtc_course.vtc_course_id_pk,    
            subject_map.subject_name_id_fk,
            subject_master.subject_name,
            subject_master.subject_code
        ');
        $this->db->from('council_affiliation_vtc_course_selection as vtc_course');
        $this->db->join('council_affiliation_vtc_course_selection_subject_map as subject_map', 'subject_map.vtc_course_id_fk = vtc_course.vtc_course_id_pk');
        $this->db->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk');
        $this->db->where("MD5(CAST(vtc_course.vtc_course_id_pk as character varying)) =", $vtc_course_id_hash);
        $this->db->where('vtc_course.active_status', 1);
        $this->db->where('subject_map.active_status', 1);
        return $this->db->get()->result_array();

    }

    public function updateVtcCourseData($array = NULL,$vtc_course_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(vtc_course_id_pk as character varying)) =", $vtc_course_id_hash);

        $this->db->update('council_affiliation_vtc_course_selection', $array);

        return $this->db->affected_rows();
    }

    

    public function getsubCategory($course_name_id, $class_name, $discipline, $group){

        $this->db->select('DISTINCT(course_master.subject_category_id_fk), subject_category_master.subject_category_id_pk,subject_category_master.subject_category_name');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_qbm_subject_category_master as subject_category_master', 'subject_category_master.subject_category_id_pk = course_master.subject_category_id_fk');
        $this->db->where("course_master.course_name_id_fk", $course_name_id);
        $this->db->where("course_master.active_status", 1);
        $this->db->where('course_master.discipline_id_fk', $discipline);
        $this->db->where('course_master.course_id_pk', $group);

        if($course_name_id == 1){

            $this->db->where('course_master.class_name', $class_name);
        }
        $this->db->order_by("subject_category_master.subject_category_name");
        return $this->db->get()->result_array();
    }
   

    public function getSubjectList($course_name_id, $class_name, $discipline, $group, $sub_cat_id){

        $this->db->select('course_master.*, subject_master.subject_name_id_pk,subject_master.subject_name, subject_master.subject_code');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = course_master.subject_name_id_fk');
        $this->db->where("course_master.course_name_id_fk", $course_name_id);
        $this->db->where("course_master.active_status", 1);
        $this->db->where('course_master.discipline_id_fk', $discipline);
        $this->db->where('course_master.course_id_pk', $group);
        $this->db->where('course_master.subject_category_id_fk', $sub_cat_id);

        // if($course_name_id == 1){

        //     $this->db->where('course_master.class_name', $class_name);
        // }
        $this->db->order_by("subject_master.subject_name");
        return $this->db->get()->result_array();
        // echo $this->db->last_query();exit;
    }

    public function insertBatchData($table, $data)
    {
        $this->db->insert_batch($table, $data);

        return true;
    }

    public function deleteCourseSubjectByCourseId($vtc_course_id_hash = NULL){

        $this->db->where("MD5(CAST(vtc_course_id_fk as character varying)) =", $vtc_course_id_hash);
        $this->db->where('active_status',1);
        $this->db->update('council_affiliation_vtc_course_selection_subject_map', array('active_status' => 0));
        return $this->db->affected_rows();
    }

    public function getDisciplineListByCourseAndStreemId($course_name_id, $hs_science, $hs_biology, $hs_comerce){

        $this->db->select('DISTINCT(course_master.discipline_id_fk), discipline_master.*');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = course_master.discipline_id_fk','LEFT');
        // $this->db->join('council_affiliation_discipline_streem_mapping as discipline_streem_map', 'discipline_streem_map.discipline_id_fk = course_master.discipline_id_fk','LEFT');
        $this->db->where('course_master.course_name_id_fk',$course_name_id );
        $this->db->where('course_master.active_status',1 );

        // Streem Validation
        // if($hs_science !='' && $hs_biology !='' && $hs_comerce !=''){
        //     $this->db->group_start();
        //     if($hs_science ==1){
        //         $this->db->where('discipline_streem_map.streem_name_id_fk', 3) ;
        //     }
        //     if($hs_biology ==1){
        //         $this->db->or_where('discipline_streem_map.streem_name_id_fk', 2) ;
        //     }
        //     if($hs_comerce ==1){
        //         $this->db->or_where('discipline_streem_map.streem_name_id_fk', 1) ;
        //     }
        //     $this->db->group_end();
        //     if($hs_science == 0 && $hs_biology == 0 && $hs_comerce == 0){
        //         $this->db->where('discipline_streem_map.streem_name_id_fk', 4) ;
        //     }
        // }
        
        // Streem Validation
        $this->db->order_by("discipline_master.discipline_name");
        return $this->db->get()->result_array();
        //  echo $this->db->last_query();exit;

    }

    public function getCourseListByNameDisciplineAndStreem($courseName = NULL, $discipline = NULL, $hs_science, $hs_biology, $hs_comerce,$vtc_id_fk, $academic_year)
    {
        $this->db->select('DISTINCT(course_master.course_id_pk),course_master.discipline_id_fk,course_master.course_name_id_fk, group_master.group_id_pk,group_master.group_name,group_master.group_code');
        $this->db->from('council_affiliation_course_master as course_master');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = course_master.course_id_pk','LEFT');
        $this->db->where("course_master.course_name_id_fk", $courseName);
        $this->db->where("course_master.active_status", 1);
        $this->db->where('course_master.discipline_id_fk', $discipline);

        // if($hs_science !='' && $hs_biology !='' && $hs_comerce !=''){
        //     $this->db->group_start();
        //     if($hs_science ==1){
        //         $this->db->where('course_master.streem_name_id_fk', 3) ;
        //     }
        //     if($hs_biology ==1){
        //         $this->db->or_where('course_master.streem_name_id_fk', 2) ;
        //     }
        //     if($hs_comerce ==1){
        //         $this->db->or_where('course_master.streem_name_id_fk', 1) ;
        //     }
        //     $this->db->group_end();
        //     if($hs_science == 0 && $hs_biology == 0 && $hs_comerce == 0){
        //         $this->db->where('course_master.streem_name_id_fk', 4) ;
        //     }
        // }
        $this->db->where('course_master.course_id_pk NOT IN(SELECT group_id_fk FROM council_affiliation_vtc_course_selection_group_map WHERE active_status=1 and academic_year = '."'$academic_year'".' and vtc_id_fk='.$vtc_id_fk.')');

        $this->db->order_by("group_master.group_name");
        return $this->db->get()->result_array();

        //  echo $this->db->last_query();exit;
    }

    public function getAllSubjectCategory()
    {
        $this->db->where("active_status", 1);
        $this->db->order_by("subject_category_name");
        return $this->db->get('council_qbm_subject_category_master')->result_array();
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

    public function getSubjectByGroupId($group_id_fk, $vtc_id_fk, $academic_year){

        // $this->db->select('DISTINCT(subject_name_id_fk)');
        $this->db->select('subject_map.subject_name_id_fk, vtc_course_subject.course_subject_id_pk');
        $this->db->from('council_affiliation_vtc_course_subject_selection as vtc_course_subject');
        $this->db->join('council_affiliation_vtc_course_selection_subject_map as subject_map', 'subject_map.course_subject_id_fk = vtc_course_subject.course_subject_id_pk','left');
        $this->db->where_in('vtc_course_subject.group_id_fk', $group_id_fk);
        $this->db->where('vtc_course_subject.vtc_id_fk', $vtc_id_fk);
        $this->db->where('vtc_course_subject.academic_year', $academic_year);
        $query = $this->db->get()->result_array();
        // echo $this->db->last_query();exit;
       
        if(!empty($query)){
            // $subjectName = array();
            // foreach ($query as $key => $value) {
            //     array_push($subjectName, $value['subject_name_id_fk']);
            // }
            // return $subjectName;
            return $query;
        }else{
            return array();
        }
    }

    public function updateSubjectByGroupId($group_id_fk = NULL, $array = NULL)
    {
        $this->db->where_in("group_id_fk", $group_id_fk);

        $this->db->update('council_affiliation_vtc_course_subject_selection', $array);

        return $this->db->affected_rows();
    }

    public function updateSubjectMap($course_subject_id = NULL, $array = NULL)
    {
        $this->db->where_in("course_subject_id_fk", $course_subject_id);

        $this->db->update('council_affiliation_vtc_course_selection_subject_map', $array);

        return $this->db->affected_rows();
    }

    public function deleteTeacherForSubject($getSubject, $array = NULL)
    {
        $this->db->where_in("subject_name_id_fk", $getSubject);

        $this->db->update('council_affiliation_vtc_teacher_subject_map', $array);

        return $this->db->affected_rows();
    }

    public function updateVtcCourseGroupMapData($array = NULL,$vtc_course_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(vtc_course_id_fk as character varying)) =", $vtc_course_id_hash);

        $this->db->update('council_affiliation_vtc_course_selection_group_map', $array);

        return $this->db->affected_rows();
    }

    public function getGroupIdByVTCId($vtc_id, $academic_year, $course_name_id){

        $this->db->select('
            group_map.group_id_fk
            
        ');
        $this->db->from('council_affiliation_vtc_course_selection as course_selection');
        $this->db->join('council_affiliation_vtc_course_selection_group_map as group_map', 'course_selection.vtc_course_id_pk = group_map.vtc_course_id_fk','LEFT');
        $this->db->where('course_selection.vtc_id_fk', $vtc_id);
        $this->db->where('course_selection.academic_year', $academic_year);
        $this->db->where('course_selection.active_status', 1);
        $this->db->where('group_map.active_status', 1);

        if($course_name_id == 1){
            $this->db->where('course_selection.course_name_id_fk', 1);
        }else{
            $this->db->where('course_selection.course_name_id_fk !=', 1);
        }
        $group = $this->db->get()->result_array();
        return $group;
    }

    public function getTeacher($group_id_fk, $vtc_id_fk, $academic_year, $teacher_type){

        $this->db->select('subject_group_id_fk');
        $this->db->from('council_affiliation_vtc_teachers as teacher');
        $this->db->join('council_affiliation_vtc_teacher_subject_group_map as subject_group_map', 'subject_group_map.teacher_id_fk = teacher.teacher_id_pk');
        $this->db->where_in('subject_group_map.subject_group_id_fk', $group_id_fk);
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

    // 12-07-2022

    public function resetCourseGroup($vtc_id_pk, $academic_year){

        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_course_selection_group_map', array('active_status' => 0));


        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_course_selection', array('active_status' => 0));

         
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

    public function resetTeacherSubjectMap($vtc_id_pk, $academic_year){
        
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_teacher_subject_group_map', array('active_status' => 0));
        
        return $this->db->affected_rows();
    }

    public function resetStudent($vtc_id_pk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_student_count_details', array('active_status' => 0));

        return $this->db->affected_rows();
    }

    public function resetLaboratoryAndAgriDetails($vtc_id_pk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_agri_discipline', array('active_status' => 0));

        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_other_common_laboratory', array('active_status' => 0));

        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('academic_year', $academic_year);
        $this->db->update('council_affiliation_vtc_vocational_paper_laboratory', array('active_status' => 0));

        return $this->db->affected_rows();
    }

}

/* End of file Map_district_model.php */
