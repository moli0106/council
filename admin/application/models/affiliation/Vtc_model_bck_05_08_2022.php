<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcListCount()
    {
        return $this->db->select("count(vtc_details_id_pk)")
            ->from("council_affiliation_vtc_details")
            ->where('active_status', 1)
            ->where('final_submit_status', 1)
            ->get()->result_array();
    }

    public function getVtcList($limit = NULL, $offset = NULL)
    {
        $this->db->select('cavd.*, cavm.*')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->where('cavd.active_status', 1)
            ->where('cavd.final_submit_status', 1)
            // ->order_by('cavm.vtc_name')
            ->order_by('cavm.vtc_code')
            ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function getVtcDetails($vtc_details_id_pk = NULL)
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
            ->where("MD5(CAST(cavd.vtc_details_id_pk as character varying)) =", $vtc_details_id_pk);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getCourseListById($courseIds = NULL)
    {
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
        $this->db->select('teacher.*, course.group_name, course.group_code, designation.designation_name');
        $this->db->from('council_affiliation_vtc_teachers AS teacher');
        $this->db->join('council_affiliation_course_master AS course', 'course.course_id_pk = teacher.course_id_fk', 'left');
        $this->db->join('council_affiliation_designation_master AS designation', 'designation.designation_id_pk = teacher.designation_id_fk', 'left');
        $this->db->where('teacher.vtc_id_fk', $vtc_id);
        $this->db->where('teacher.academic_year', $academic_year);
        $this->db->where('teacher.active_status', 1);

        // Modify By Moli

        $query =  $this->db->get()->result_array();

        if(!empty($query)){

            foreach ($query as $key => $value) {
                $teacher_id_pk = $value['teacher_id_pk'];

                $this->db->select('teacher_subject_map.*, subject_master.subject_name,subject_master.subject_code');
                $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
                $this->db->join('council_affiliation_subject_master as subject_master', 'teacher_subject_map.subject_group_id_fk = subject_master.subject_name_id_pk');
                $this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
                $this->db->where('teacher_subject_map.active_status', 1);
                $techerSubject =  $this->db->get()->result_array();

                $query[$key]['assignedSubject'] = $techerSubject;
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

            teacher.whats_app_mob_no,
            teacher.date_of_birth,

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

        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('vtc_details_id_pk', $vtc_details_id_pk);
        $this->db->update('council_affiliation_vtc_details', array('final_submit_status' => 0));
    }

    public function unblockingVtcData($vtc_id_pk = NULL, $vtc_details_id_pk = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('vtc_details_id_pk', $vtc_details_id_pk);
        $this->db->update('council_affiliation_vtc_details', array('final_submit_status' => 0));
    }

    public function updateVtcData($updateArray = NULL, $vtc_details_id_hash = NULL)
    {
        $this->db->where("MD5(CAST(vtc_details_id_pk as character varying)) =", $vtc_details_id_hash);

        $this->db->update('council_affiliation_vtc_details', $updateArray);

        return $this->db->affected_rows();
    }

    public function updateVtcLoginData($vtcLoginDetails = NULL, $vtcLoginUpdate = NULL)
    {
        $this->db->where($vtcLoginDetails);

        $this->db->update('council_stake_holder_login', $vtcLoginUpdate);

        return $this->db->affected_rows();
    }

    public function getNearestVtc($vtc_details_id)
    {

        $this->db->select('nearest_vtc.*,cavm.vtc_name')
            ->from('council_affiliation_nearby_vtc AS nearest_vtc')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = nearest_vtc.near_by_vtc_id_fk', 'left')
            ->where('vtc_id_fk', $vtc_details_id)
            ->where('active_status', 1);

        $query = $this->db->get()->result_array();

        foreach ($query as $key => $value) {

            $hs_group_code_name = '';
            $viii_nqr_group_name = '';
            $viii_others_group_name = '';

            if ($value['hs_voc_group_code'] != '') {

                $hs_voc_group_code = explode(",", $value['hs_voc_group_code']);
                $hs_group_code_name =  $this->getGroupName($hs_voc_group_code);
            }

            if ($value['viii_nqr_group_code'] != '') {

                $viii_nqr_group_code = explode(",", $value['viii_nqr_group_code']);
                $viii_nqr_group_name =  $this->getGroupName($viii_nqr_group_code);
            }


            if ($value['viii_others_group_code'] != '') {

                $viii_others_group_code = explode(",", $value['viii_others_group_code']);
                $viii_others_group_name =  $this->getGroupName($viii_others_group_code);
            }

            $query[$key]['hs_group_code_name'] = $hs_group_code_name;

            $query[$key]['viii_nqr_group_name'] = $viii_nqr_group_name;

            $query[$key]['viii_others_group_name'] = $viii_others_group_name;
        }
        // echo "<pre>";print_r($query);exit;

        return $query;
    }

    public function getGroupName($grCodeArray)
    {
        $query = $this->db->select('course.group_name')
            ->from('council_affiliation_course_master AS course')
            ->where_in('course_id_pk', $grCodeArray)
            ->where('active_status', 1)->get()->result_array();

        return $query;
    }
	
	//Added by Waseem on 25-03-2022
	
	function get_vtc_login_dtls($vtc_details_id_pk = NULL)
	{
		$query = $this->db->select('base_login_id,base_password,stake_holder_details')
			->from('council_stake_holder_login')
			->where(
				array(
					'stake_details_id_fk' 	=> $vtc_details_id_pk,
					'stake_id_fk'			=> 15
				)
			)->get();
		return $query->result_array();
	}	
	
	function get_vtc_email($id_hash = NULL)
	{
		$query = $this->db->select('vtc_details_id_pk,vtc_id_fk,vtc_email,hoi_mobile_no')
			->from('council_affiliation_vtc_details as vtc')
			->where(
                array(
                    "MD5(CAST(vtc.vtc_details_id_pk as character varying)) =" => $id_hash,
					'vtc.active_status'			=> 1,
					'vtc.final_submit_status'	=> 1
					
                )
            )
            ->get();
		return $query->result_array();
	}

    // Added by Moli on 23-05-2022
    

    public function getCommonLabDetailsById($lab_id_hash = NULL){

        $query = $this->db->select('cmn_lab.*, item_master.item_name, discipline.discipline_name')
        ->from('council_affiliation_vtc_other_common_laboratory as cmn_lab')
        ->join('council_affiliation_infrastructure_item_master as item_master', 'cmn_lab.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk','left')
        ->join('council_affiliation_discipline_master as discipline', 'cmn_lab.discipline_id_fk = discipline.discipline_id_pk','left')
        ->where('cmn_lab.active_status',1)
        ->where('MD5(CAST(cmn_lab.vtc_other_common_lab_id_pk as character varying)) =' , $lab_id_hash)
        ->get();
        return $query->row_array();
    }

    public function getPaperLabDetails($id_hash = NULL){

        $this->db->select('paper_lab.*,course_master.group_name, item_master.item_name');
        $this->db->from('council_affiliation_vtc_vocational_paper_laboratory as paper_lab');
        $this->db->join('council_affiliation_infrastructure_item_master as item_master', 'paper_lab.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk','left');
        $this->db->join('council_affiliation_course_master as course_master', 'course_master.course_id_pk = paper_lab.group_id_fk');
        $this->db->where("MD5(CAST(paper_lab.vtc_vocational_paper_lab_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getVtcAllCourseList($vtc_id_fk = NULL, $academic_year = NULL){

        $this->db->select('
            vtc_course.*,
            course_name.course_name, 
            group_master.group_name,
            group_master.group_code, 
            discipline_master.discipline_name,
            category_master.subject_category_name
        ');
        $this->db->from('council_affiliation_vtc_course_selection as vtc_course');
        $this->db->join('council_affiliation_course_name_master as course_name', 'course_name.course_name_id_pk = vtc_course.course_name_id_fk');
        $this->db->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = vtc_course.discipline_id_fk');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = vtc_course.group_id_fk');
        $this->db->join('council_qbm_subject_category_master as category_master', 'category_master.subject_category_id_pk = vtc_course.subject_category_id_fk');
        $this->db->where('vtc_course.vtc_id_fk', $vtc_id_fk);
        $this->db->where('vtc_course.academic_year', $academic_year);
        $this->db->where('vtc_course.active_status', 1);
        $query = $this->db->get()->result_array();
        //  echo $this->db->last_query();exit;

        if(!empty($query)){

            foreach ($query as $key => $value) {
               $vtc_course_id_pk = $value['vtc_course_id_pk'];

               $this->db->select('
                    subject_map.subject_name_id_fk,
                    subject_master.subject_name,
                    subject_master.subject_code
                ');
                $this->db->from('council_affiliation_vtc_course_selection_subject_map as subject_map');
                $this->db->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk');
                $this->db->where('subject_map.vtc_course_id_fk', $vtc_course_id_pk);
                $this->db->where('subject_map.active_status', 1);
                $subject = $this->db->get()->result_array();

                $query[$key]['subject'] = $subject;
            }
            return $query;
        }else{

            return $query = array();
        }

        // echo "<pre>";print_r($query);exit;
    }

    public function getAssignedSubjectGroupByTeacherId($teacher_id_hash = NULL, $teacher_type = NULL){

        if($teacher_type == 1){

            $this->db->select('teacher_subject_map.*, subject_master.subject_name,subject_master.subject_code');
            $this->db->join('council_affiliation_subject_master as subject_master', 'teacher_subject_map.subject_group_id_fk = subject_master.subject_name_id_pk');
       
        }elseif ($teacher_type == 3) {

            $this->db->select('teacher_subject_map.*, group_master.group_name,group_master.group_code');
            $this->db->join('council_affiliation_group_master as group_master', 'teacher_subject_map.subject_group_id_fk = group_master.group_id_pk');
       
        }
            
        $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
        $this->db->where("MD5(CAST(teacher_subject_map.teacher_id_fk as character varying)) =", $teacher_id_hash);
        $this->db->where('teacher_subject_map.active_status', 1);
        return $this->db->get()->result_array();

    }

    
}
