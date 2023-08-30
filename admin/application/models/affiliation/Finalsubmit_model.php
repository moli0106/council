<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finalsubmit_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcDetails($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->select('
            cavd.*, 
            cavm.*, 
            cavtm.vtc_type_name, 
            camoim.medium_of_instruction, 
            district.district_name, 
            subdiv.subdiv_name,
            municipality.block_municipality_name,
            cnom.nodal_centre_name,
            ')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->join('council_affiliation_vtc_type_master AS cavtm', 'cavtm.vtc_type_id_pk = cavd.vtc_type_id_fk', 'left')
            ->join('council_affiliation_medium_of_instruction_master AS camoim', 'camoim.medium_of_instruction_id_pk = cavd.medium_id_fk', 'left')
            ->join('council_district_master AS district', 'district.district_id_pk = cavd.district_id_fk', 'left')
            ->join('council_subdiv_master AS subdiv', 'subdiv.subdiv_id_pk = cavd.sub_division_id_fk', 'left')
            ->join('council_block_municipality_master AS municipality', 'municipality.block_municipality_id_pk = cavd.municipality_id_fk', 'left')
            ->join('council_nodal_officer_master AS cnom', 'cnom.nodal_officer_id_pk = cavd.nodal_id_fk', 'left')
            ->where("MD5(CAST(cavd.vtc_id_fk as character varying)) =", $vtc_id_fk)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getCourseListById($courseIds = NULL)
    {
        $this->db->select('DISTINCT(course_id_pk),group_name,group_code');
        $this->db->where("active_status", 1);
        $this->db->where_in('course_id_pk', $courseIds);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getDisciplineById($disciplineIds = NULL)
    {
        $this->db->where("active_status", 1);
        $this->db->where_in('discipline_id_pk', $disciplineIds);
        $this->db->order_by("discipline_name");
        return $this->db->get('council_affiliation_discipline_master')->result_array();
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

    public function getVtcTeacherList($vtc_id = NULL, $academic_year = NULL)
    {
        // $this->db->select('teacher.*, course.group_name, course.group_code, designation.designation_name');
        $this->db->select('teacher.*,designation.designation_name');
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

    public function getStudentCountDetails($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->select('DISTINCT(course_id_pk),CACM.group_name, CACM.group_code, CAVSCD.selected_year, CAVSCD.enrolled_student');
        // $this->db->from('council_affiliation_vtc_student_count_details AS CAVSCD');
        $this->db->from('council_affiliation_course_master AS CACM');
        $this->db->join('council_affiliation_vtc_student_count_details AS CAVSCD', 'CACM.course_id_pk = CAVSCD.course_id_fk','right');
        // $this->db->join('council_affiliation_course_master AS CACM', 'CACM.course_id_pk = CAVSCD.course_id_fk', 'left');
        $this->db->where('CAVSCD.vtc_id_fk', $vtc_id_fk);
        $this->db->where('CAVSCD.academic_year', $academic_year);
        $this->db->where('CAVSCD.active_status', 1);
        $this->db->order_by('CACM.group_name');

        return $this->db->get()->result_array();
    }

    public function submit_final_data($vtc_details_id, $updateArray)
    {
        $this->db->where("MD5(CAST(vtc_details_id_pk as character varying)) =", $vtc_details_id);

        $this->db->update('council_affiliation_vtc_details', $updateArray);

        return $this->db->affected_rows();
    }

    // Added By Moli on 20-06-2022

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

    public function getTotalMappingTeacherId($vtc_id = NULL, $academic_year = NULL){
        $this->db->select('DISTINCT(teacher_id_fk)');
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);
        $this->db->from('council_affiliation_vtc_teacher_subject_group_map');
        return $this->db->get()->result_array();

    }
}
