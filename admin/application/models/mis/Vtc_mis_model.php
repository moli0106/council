<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc_mis_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcHSSubjectDetails_old($academic_year = NULL){

        $this->db->select('
            vtc_master.vtc_id_pk,
            vtc_master.vtc_code,
            vtc_master.vtc_name,

            vtc_details.vtc_details_id_pk,
            vtc_details.vtc_email,
            vtc_details.hoi_name,
            vtc_details.hoi_email,
            vtc_details.hoi_mobile_no,
            vtc_subject.* ,
            group_master.group_name, 
            group_master.group_code,
            subject_category_master.subject_category_name 
            
            ')
        ->from('council_affiliation_vtc_master as vtc_master')
        ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_vtc_course_subject_selection as vtc_subject', 'vtc_subject.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_group_master as group_master', 'vtc_subject.group_id_fk = group_master.group_id_pk', 'left')
        ->join('council_qbm_subject_category_master as subject_category_master', 'vtc_subject.subject_category_id_fk = subject_category_master.subject_category_id_pk', 'left')
        ->where(
            array(
                'vtc_master.vtc_affiliated_status' => 1,
                'vtc_master.vtc_active_status' => 1,

                'vtc_details.active_status' => 1,
                // 'vtc_details.final_submit_status' => 1,
                'vtc_details.academic_year' => $academic_year,
                'vtc_subject.class_name' => 2,
                
            )
        )
        ->group_start()
        ->where('vtc_subject.subject_category_id_fk',3)
        ->or_where('vtc_subject.subject_category_id_fk',2)
        ->group_end()
        ->order_by('vtc_master.vtc_code');

        $query = $this->db->get()->result_array();
        echo $this->db->last_query();exit;
        if(!empty($query)){
            
            foreach ($query as $key => $value) {
                
                $course_subject_id_pk = $value['course_subject_id_pk'];
                $subjects = $this->db->select('subject_map.*, subject_master.subject_name')
                ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                ->join('council_affiliation_subject_master as subject_master', 'subject_map.subject_name_id_fk = subject_master.subject_name_id_pk', 'left')
                ->where(
                    array(
                        'subject_map.course_subject_id_fk'  => $course_subject_id_pk,
                        //'subject_map.active_status'         => 1
                    )
                )->get()->result_array();
                $query[$key]['subjects'] = $subjects;
            }
            
            // echo "<pre>";print_r($vocational_sub);exit;
        }
        // echo $this->db->last_query();exit;
        return $query;
            
    }

    public function getVtcDetails($academic_year = NULL)
    {
        $this->db->select('
			cavm.vtc_code,
			cavm.vtc_name,
			cavd.vtc_email,
			cavd.hoi_mobile_no,
			cavd.hoi_name,
			cavd.hoi_email,
			cavd.vtc_email,
			cavd.police_station,
            cavtm.vtc_type_name, 
            camoim.medium_of_instruction, 
            district.district_name, 
            subdiv.subdiv_name,
            municipality.block_municipality_name,
            cnom.nodal_centre_name,
			cavd.hs_equivalent,
			cavd.hs_science,
			cavd.hs_biology,
			cavd.final_submit_status,
			cavd.second_final_submit_status
            ')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->join('council_affiliation_vtc_type_master AS cavtm', 'cavtm.vtc_type_id_pk = cavd.vtc_type_id_fk', 'left')
            ->join('council_affiliation_medium_of_instruction_master AS camoim', 'camoim.medium_of_instruction_id_pk = cavd.medium_id_fk', 'left')
            ->join('council_district_master AS district', 'district.district_id_pk = cavd.district_id_fk', 'left')
            ->join('council_subdiv_master AS subdiv', 'subdiv.subdiv_id_pk = cavd.sub_division_id_fk', 'left')
            ->join('council_block_municipality_master AS municipality', 'municipality.block_municipality_id_pk = cavd.municipality_id_fk', 'left')
            ->join('council_nodal_officer_master AS cnom', 'cnom.nodal_officer_id_pk = cavd.nodal_id_fk', 'left')
            ->where(
                array(
                    // 'cavm.vtc_affiliated_status' => 1,
                    // 'cavm.vtc_active_status' => 1,
                    'cavd.active_status' => 1,
                    'cavd.final_submit_status' => 1,
                    'cavd.academic_year' => $academic_year
                )
            )
            ->order_by('cavm.vtc_code');

        return $query = $this->db->get()->result_array();
    }


    public function getVtcAllNewCourseList($academic_year = NULL){

        $this->db->select('
            vtc_master.vtc_id_pk,
            vtc_master.vtc_code,
            vtc_master.vtc_name,

            vtc_details.vtc_details_id_pk,
            vtc_details.vtc_email,
            vtc_details.hoi_name,
            vtc_details.hoi_email,
            vtc_details.hoi_mobile_no,

            vtc_course.*,
            course_name.course_name, 
            group_master.group_name, 
            group_master.group_code, 
            discipline_master.discipline_name,

            district_master.district_name,
           
        ');
        $this->db->from('council_affiliation_vtc_master as vtc_master');
        $this->db->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left');
        $this->db->join('council_affiliation_vtc_course_selection as vtc_course', 'vtc_course.vtc_id_fk = vtc_details.vtc_id_fk AND vtc_course.academic_year = vtc_details.academic_year', 'left');

        // $this->db->from('council_affiliation_vtc_course_selection as vtc_course');
        $this->db->join('council_affiliation_course_name_master as course_name', 'course_name.course_name_id_pk = vtc_course.course_name_id_fk','LEFT');
        $this->db->join('council_affiliation_discipline_master as discipline_master', 'discipline_master.discipline_id_pk = vtc_course.discipline_id_fk','LEFT');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = vtc_course.group_id_fk','LEFT');
        $this->db->join('council_district_master as district_master', 'vtc_details.district_id_fk = district_master.district_id_pk', 'left');
        
        // $this->db->where('vtc_course.academic_year', $academic_year);
        // $this->db->where('vtc_course.active_status', 1);
        $this->db->where(
            array(
                'vtc_master.vtc_affiliated_status' => 1,
                'vtc_master.vtc_active_status' => 1,

                'vtc_details.active_status' => 1,
                'vtc_details.final_submit_status' => 1,
                'vtc_details.academic_year' => $academic_year,

                'vtc_course.active_status' => 1,
                'vtc_course.academic_year' => $academic_year,
            )
        );
        $this->db->order_by('vtc_master.vtc_code');
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


    public function getVtcCourseList($academic_year = NULL)
    {
        $this->db->select('
            vtc_master.vtc_id_pk,
            vtc_master.vtc_code,
            vtc_master.vtc_name,

            vtc_details.vtc_details_id_pk,
            vtc_details.vtc_email,
            vtc_details.hoi_name,
            vtc_details.hoi_email,
            vtc_details.hoi_mobile_no,
            
            vtc_course.hs_voc_course_name_id_fk,
            vtc_course.hs_voc_discipline,
            vtc_course.hs_voc_courses,
            vtc_course.stc_course_name_id_fk,
            vtc_course.stc_discipline,
            vtc_course.stc_course,

            district_master.district_name,
        ')

            ->from('council_affiliation_vtc_master as vtc_master')
            ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
            ->join('council_affiliation_vtc_courses as vtc_course', 'vtc_course.vtc_details_id_fk = vtc_details.vtc_details_id_pk AND vtc_course.academic_year = vtc_details.academic_year', 'left')

            ->join('council_district_master as district_master', 'vtc_details.district_id_fk = district_master.district_id_pk', 'left')

            ->where(
                array(
                    'vtc_master.vtc_affiliated_status' => 1,
                    'vtc_master.vtc_active_status' => 1,

                    'vtc_details.active_status' => 1,
                    'vtc_details.final_submit_status' => 1,
                    'vtc_details.academic_year' => $academic_year,

                    'vtc_course.active_status' => 1,
                    'vtc_course.academic_year' => $academic_year,
                )
            )
            ->order_by('vtc_master.vtc_code');

        return $query = $this->db->get()->result_array();
    }

    public function getVtcCourseDetails($course_ids = NULL)
    {
        $this->db->select('
            DISTINCT(course_master.course_id_pk),
            course_master.group_name, 
            course_master.group_code,

            course_name_master.course_name,

            streem_name_master.streem_name,

            discipline_master.discipline_name,
        ');
        $this->db->from('council_affiliation_course_master AS course_master');

        $this->db->join('council_affiliation_course_name_master AS course_name_master', 'course_name_master.course_name_id_pk = course_master.course_name_id_fk', 'left');
        $this->db->join('council_affiliation_streem_name_master AS streem_name_master', 'streem_name_master.streem_name_id_pk = course_master.streem_name_id_fk', 'left');
        $this->db->join('council_affiliation_discipline_master AS discipline_master', 'discipline_master.discipline_id_pk = course_master.discipline_id_fk', 'left');

        $this->db->where('course_master.active_status', 1);
        $this->db->where_in('course_master.course_id_pk', $course_ids);

        return $this->db->get()->result_array();
    }

    public function getVtcStudentCount($whereCondition = NULL)
    {
        return $this->db->where($whereCondition)->get('council_affiliation_vtc_student_count_details')->result_array();
    }

    public function getVtcteacherList($academic_year, $teacher_type)
    {
        $this->db->select('vtc_master.vtc_code,vtc_master.vtc_name,teacher.teacher_name,teacher.mobile_no,teacher.email_id,teacher.teacher_type,course.group_name,
		course.group_code,teacher.course_name,teacher.attached_subjects,desig.designation_name,teacher.other_designation,teacher.other_qualification,qualification.qualification_name,teacher.qualification_subjects,teacher.employee_id,district_master.district_name')

            ->from('council_affiliation_vtc_master as vtc_master')
            ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
            ->join('council_affiliation_vtc_teachers as teacher', 'teacher.vtc_details_id_fk = vtc_details.vtc_details_id_pk', 'left')
            ->join('council_affiliation_course_master as course', 'course.course_id_pk =  teacher.course_id_fk', 'left')
            ->join('council_affiliation_designation_master as desig', 'desig.designation_id_pk = teacher.designation_id_fk', 'left')
            ->join('council_affiliation_qualification_master as qualification', 'qualification.qualification_id_pk = teacher.qualification_id_fk', 'left')

            ->join('council_district_master as district_master', 'vtc_details.district_id_fk = district_master.district_id_pk', 'left')

            ->where(
                array(
                    'vtc_master.vtc_affiliated_status' => 1,
                    'vtc_details.active_status' => 1,
                    'vtc_details.active_status' => 1,
                    'vtc_details.final_submit_status' => 1,
                    'teacher.active_status' => 1,
                    'teacher.academic_year' => $academic_year,
                    'teacher.teacher_type' => $teacher_type,

                )
            )
            // ->limit(10, 10)

            ->order_by('vtc_master.vtc_code');

        $query = $this->db->get()->result_array();
        
        $tempArray = array_map("unserialize", array_unique(array_map("serialize", $query)));
        $finalArray= [];
        foreach($tempArray as $row){
            $finalArray[] = $row;
        }
        return $finalArray;
    }

    public function getAcademicYearList(){
        $this->db->from('council_affiliation_academic_year_master')->where('active_status', 1);
        return $this->db->get()->result_array();
    }

    public function getNewVtcTeacherList($academic_year = NULL, $teacher_type)
    {
        $vtc_code = ['59','60','99','112','1009','1032','1064','1105','1202','1222','1328','1344','1527','1542','1550','1554','1624','1774','1807','2011','2055','2066','2068','2507','2517','2536','2538','2583','2587','2612','3003','3006','3008','3022','3023','3031','3068','3117','3180','3184','3185','3263','3339','3347','3422','3504','3506','3507','3508','3512','3525','3534','3593','3609','3671','3808','4006','4013','4018','4051','4081','4089','4102','5004','5010','5019','5025','5029','5045','5048','5052','5054','5093','5504','5516','6002','6021','6061','6140','6168','6333','6751','6758','6769','6772','6790','6798','6900','8308','8321','8559','8817','8870','9252','9751','6763','6785','6796','7754','7828','62','1007','1021','1025','1040','1055','1061','1001','1002','1008','1012','1019','1021','1068','1085','1089','1117','1123','1137'];
        $this->db->select('teacher.teacher_name,
        teacher.mobile_no, 
        teacher.email_id, 
        teacher.pan_no, 
        teacher.employee_id, 
        teacher.other_qualification,
        qualification.qualification_name, 
        vtc_details.hoi_mobile_no,
        designation.designation_name, vtc_master.vtc_code,vtc_master.vtc_name,district_master.district_name');
        // $this->db->from('council_affiliation_vtc_teachers AS teacher');
        $this->db->from('council_affiliation_vtc_master as vtc_master')
        ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_vtc_teachers as teacher', 'teacher.vtc_id_fk = vtc_details.vtc_id_fk', 'left');
        $this->db->join('council_affiliation_designation_master AS designation', 'designation.designation_id_pk = teacher.designation_id_fk', 'left');

        $this->db->join('council_affiliation_qualification_master as qualification', 'qualification.qualification_id_pk = teacher.qualification_id_fk', 'left');
        $this->db->join('council_district_master as district_master', 'vtc_details.district_id_fk = district_master.district_id_pk', 'left');
        
        // $this->db->where('teacher.academic_year', $academic_year);
        // $this->db->where('teacher.active_status', 1);
        // $this->db->where('teacher.teacher_type' , $teacher_type);

        $this->db->where_in('vtc_master.vtc_code',$vtc_code);

        $this->db->where(
            array(
                'vtc_master.vtc_affiliated_status' => 1,
                'vtc_details.active_status' => 1,
                'vtc_details.academic_year' => $academic_year,
                'vtc_details.final_submit_status' => 1,
                'teacher.active_status' => 1,
                'teacher.academic_year' => $academic_year,
                'teacher.teacher_type' => (int)$teacher_type,

            )
        );

        // Modify By Moli On 20-06-2022
        
        $query =  $this->db->get()->result_array();
        // echo $this->db->last_query();exit;

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
                    $query[$key]['assignedGroup'] = array();

                }elseif ($teacher_type == 3) {
                    
                    $this->db->select('teacher_subject_map.*, group_master.group_name,group_master.group_code');
                    $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
                    $this->db->join('council_affiliation_group_master as group_master', 'teacher_subject_map.subject_group_id_fk = group_master.group_id_pk');
                    $this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
                    $this->db->where('teacher_subject_map.active_status', 1);
                    $techerGroup =  $this->db->get()->result_array();

                    $query[$key]['assignedSubject'] = array();
                    $query[$key]['assignedGroup'] = $techerGroup;
                }
                
            }

            return $query;

        }else{
            return $query= array();
        }
    }

    public function getVtcHSSubjectCountDetails($academic_year = NULL){

        $this->db->select('
            distinct(vtc_subject.group_id_fk),
            vtc_master.vtc_id_pk,
            vtc_master.vtc_code,
            vtc_master.vtc_name,

            vtc_details.vtc_details_id_pk,
            vtc_details.vtc_email,
            vtc_details.hoi_name,
            vtc_details.hoi_email,
            vtc_details.hoi_mobile_no,
            group_master.group_name, 
            group_master.group_code, 
            
            ')
        ->from('council_affiliation_vtc_master as vtc_master')
        ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_vtc_course_subject_selection as vtc_subject', 'vtc_subject.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_group_master as group_master', 'vtc_subject.group_id_fk = group_master.group_id_pk', 'left')
        ->where(
            array(
                'vtc_master.vtc_affiliated_status' => 1,
                'vtc_master.vtc_active_status' => 1,

                'vtc_details.active_status' => 1,
                // 'vtc_details.final_submit_status' => 1,
                'vtc_details.academic_year' => $academic_year,
                'vtc_subject.class_name' => 2,
                
            )
        )
        
        ->order_by('vtc_master.vtc_code');

        $query = $this->db->get()->result_array();
        // echo $this->db->last_query();exit;
        if(!empty($query)){
            
            foreach ($query as $key => $value) {
                
                $group_id = $value['group_id_fk'];
                $vtc_id_pk = $value['vtc_id_pk'];

                $vocational_subject = $this->db->select('*')
                ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                ->where("course_subject_id_fk IN(select course_subject_id_pk from council_affiliation_vtc_course_subject_selection where subject_category_id_fk = 2 and class_name = 2 and active_status = 1 and group_id_fk = ".$group_id." and vtc_id_fk = ".$vtc_id_pk." and academic_year = '".$academic_year."')")
                ->where('active_status', 1)
                ->get()->result_array();


                $academic_electrive_subject = $this->db->select('subject_map.*')
                ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                ->where("course_subject_id_fk IN(select course_subject_id_pk from council_affiliation_vtc_course_subject_selection where subject_category_id_fk = 3 and class_name = 2 and active_status = 1 and group_id_fk = ".$group_id." and vtc_id_fk = ".$vtc_id_pk." and academic_year = '".$academic_year."')")
                ->where('subject_map.active_status', 1)
                ->get()->result_array();



                
                $query[$key]['vocational_subject'] = $vocational_subject;
                $query[$key]['academic_elective_subject'] = $academic_electrive_subject;
            }
            
            // echo "<pre>";print_r($vocational_sub);exit;
        }
        // echo $this->db->last_query();exit;
        return $query;
            
    }

    public function getVtcHSSubjectDetails($academic_year = NULL){

        $this->db->select('
            distinct(vtc_subject.group_id_fk),
            vtc_master.vtc_id_pk,
            vtc_master.vtc_code,
            vtc_master.vtc_name,

            vtc_details.vtc_details_id_pk,
            vtc_details.vtc_email,
            vtc_details.hoi_name,
            vtc_details.hoi_email,
            vtc_details.hoi_mobile_no,
            group_master.group_name, 
            group_master.group_code, 
            vtc_subject.class_name,
            vtc_subject.course_subject_id_pk,
            vtc_subject.subject_category_id_fk,
            
            ')
        ->from('council_affiliation_vtc_master as vtc_master')
        ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_vtc_course_subject_selection as vtc_subject', 'vtc_subject.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_group_master as group_master', 'vtc_subject.group_id_fk = group_master.group_id_pk', 'left')
        ->where(
            array(
                'vtc_master.vtc_affiliated_status' => 1,
                'vtc_master.vtc_active_status' => 1,

                'vtc_details.active_status' => 1,
                // 'vtc_details.final_submit_status' => 1,
                'vtc_details.academic_year' => $academic_year,
                // 'vtc_subject.class_name' => 2,
                'vtc_subject.active_status' => 1,
                
            )
        )
        
        ->order_by('vtc_master.vtc_code');

        $query = $this->db->get()->result_array();
        // echo $this->db->last_query();exit;
        if(!empty($query)){
            
            foreach ($query as $key => $value) {

                $academic_electrive = '';
                $common_subject = '';
                $language1_subject = '';
                $language2_subject = '';
                $vocational_sub = '';
                 
                $group_id = $value['group_id_fk'];
                $vtc_id_pk = $value['vtc_id_pk'];
                $course_subject_id_pk = $value['course_subject_id_pk'];
                $subject_category_id_fk = $value['subject_category_id_fk'];

                if($subject_category_id_fk == 2){
                    
                    $vocational_subject = $this->db->select('subject_map.*,subject_master.subject_name,subject_master.subject_code')
                    ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                    ->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk', 'left')
                    ->where('course_subject_id_fk', $course_subject_id_pk)
                    ->where('active_status', 1)
                    ->get()->result_array();

                    if(!empty($vocational_subject)){
                        
                        $vocational_sub = $vocational_subject;
                    }
                    

                }elseif ($subject_category_id_fk == 3) {

                    $academic_electrive_subject = $this->db->select('subject_map.*,subject_master.subject_name,subject_master.subject_code')
                    ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                    ->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk', 'left')

                    ->where('course_subject_id_fk', $course_subject_id_pk)
                    ->where('subject_map.active_status', 1)
                    ->get()->result_array();

                    if(!empty($academic_electrive_subject)){
                    
                        $academic_electrive = $academic_electrive_subject;
                    }
                   
                }elseif ($subject_category_id_fk == 4) {
                    
                    $common = $this->db->select('subject_map.*,subject_master.subject_name,subject_master.subject_code')
                    ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                    ->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk', 'left')
                    ->where('course_subject_id_fk', $course_subject_id_pk)
                    ->where('subject_map.active_status', 1)
                    ->get()->result_array();

                    if(!empty($common)){
                       
                        $common_subject = $common ;
                    }
                }elseif ($subject_category_id_fk == 1) {
                    
                    $language1 = $this->db->select('subject_map.*,subject_master.subject_name,subject_master.subject_code')
                    ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                    ->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk', 'left')
                    ->where('course_subject_id_fk', $course_subject_id_pk)
                    ->where('subject_map.active_status', 1)
                    ->get()->result_array();

                    if(!empty($language1)){
                        // array_push($language1_subject, $language1) ; 
                        $language1_subject = $language1;
                    }
                }elseif ($subject_category_id_fk == 5) {
                    
                    $language2 = $this->db->select('subject_map.*,subject_master.subject_name,subject_master.subject_code')
                    ->from('council_affiliation_vtc_course_selection_subject_map as subject_map')
                    ->join('council_affiliation_subject_master as subject_master', 'subject_master.subject_name_id_pk = subject_map.subject_name_id_fk', 'left')
                    ->where('course_subject_id_fk', $course_subject_id_pk)
                    ->where('subject_map.active_status', 1)
                    ->get()->result_array();

                    if(!empty($language2)){
                        // array_push($language2_subject, $language2) ; 
                        $language2_subject = $language2;
                    }
                }

               
                $query[$key]['vocational_subject'] = $vocational_sub;
                $query[$key]['academic_electrive_subject'] = $academic_electrive;
                $query[$key]['common_subject'] = $common_subject;
                $query[$key]['language1_subject'] = $language1_subject;
                $query[$key]['language2_subject'] = $language2_subject;

              
            }
            
            // echo "<pre>";print_r($vocational_sub);exit;
        }
        // echo $this->db->last_query();exit;
        return $query;
            
    }


    public function getNewVtcHomeScTeacherList($academic_year = NULL, $teacher_type)
    {

        // $group_id_fk = $this->db->select('group_id_fk');
        $query = "select teacher_id_fk from council_affiliation_vtc_teacher_subject_group_map WHERE subject_group_id_fk in
        (SELECT a.subject_name_id_fk from council_affiliation_vtc_course_selection_subject_map as a 
            join council_affiliation_vtc_course_subject_selection as b on a.course_subject_id_fk = b.course_subject_id_pk 
            where b.group_id_fk in 
                (SELECT DISTINCT group_id_fk from council_affiliation_vtc_course_selection_group_map 
                    where vtc_course_id_fk in 
                    (SELECT vtc_course_id_pk from council_affiliation_vtc_course_selection 
                        where academic_year = '".$academic_year."' and course_name_id_fk = 1 and discipline_id_fk = 3
                    ) and active_status = 1 and academic_year='".$academic_year."'
                )
            and a.academic_year = '".$academic_year."' and a.active_status = 1 and b.academic_year = '".$academic_year."' and b.active_status = 1
        ) and academic_year = '".$academic_year."' and active_status = 1";
        $res = $this->db->query($query);
        $arrData = $res->result_array();
        // echo $this->db->last_query();exit;
        // echo $query;exit;
        $teacher_ids = array();
        foreach ($arrData as $key => $value) {
            array_push($teacher_id , $value['teacher_id_fk']);
        }
        
        $this->db->select('teacher.teacher_name,
        teacher.teacher_id_pk,
        teacher.mobile_no, 
        teacher.email_id, 
        teacher.pan_no, 
        teacher.employee_id, 
        teacher.other_qualification,
        qualification.qualification_name, 
        vtc_details.hoi_mobile_no,
        designation.designation_name, vtc_master.vtc_code,vtc_master.vtc_name,district_master.district_name');
        // $this->db->from('council_affiliation_vtc_teachers AS teacher');
        $this->db->from('council_affiliation_vtc_master as vtc_master')
        ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->join('council_affiliation_vtc_teachers as teacher', 'teacher.vtc_id_fk = vtc_details.vtc_id_fk', 'left');
        $this->db->join('council_affiliation_designation_master AS designation', 'designation.designation_id_pk = teacher.designation_id_fk', 'left');

        $this->db->join('council_affiliation_qualification_master as qualification', 'qualification.qualification_id_pk = teacher.qualification_id_fk', 'left');
        $this->db->join('council_district_master as district_master', 'vtc_details.district_id_fk = district_master.district_id_pk', 'left');
        
        // $this->db->where('teacher.academic_year', $academic_year);
        // $this->db->where('teacher.active_status', 1);
        // $this->db->where('teacher.teacher_type' , $teacher_type);

       

        $this->db->where(
            array(
                'vtc_master.vtc_affiliated_status' => 1,
                'vtc_details.active_status' => 1,
                'vtc_details.academic_year' => $academic_year,
                'vtc_details.final_submit_status' => 1,
                'teacher.active_status' => 1,
                'teacher.academic_year' => $academic_year,
                'teacher.teacher_type' => (int)$teacher_type,

            )
        );
        $this->db->where_in('teacher.teacher_id_pk', $teacher_ids);

        // Modify By Moli On 20-06-2022
        
        $query =  $this->db->get()->result_array();

        //echo $this->db->last_query();exit;
        

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
                    $query[$key]['assignedGroup'] = array();

                }elseif ($teacher_type == 3) {
                    
                    $this->db->select('teacher_subject_map.*, group_master.group_name,group_master.group_code');
                    $this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
                    $this->db->join('council_affiliation_group_master as group_master', 'teacher_subject_map.subject_group_id_fk = group_master.group_id_pk');
                    $this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
                    $this->db->where('teacher_subject_map.active_status', 1);
                    $techerGroup =  $this->db->get()->result_array();

                    $query[$key]['assignedSubject'] = array();
                    $query[$key]['assignedGroup'] = $techerGroup;
                }
                
            }
            //echo "<pre>";print_r($query);exit;
            return $query;

        }else{
            return $query= array();
        }
    }

    public function nodallistd()
    {
        $query = $this->db->select("nodal_officer_id_pk,nodal_centre_name,nodal_centre_email,nodal_officer_mobile,active_status")
            ->from("council_nodal_officer_master")
            ->where(
                array(
                    "active_status" => 1,

                )
            )
            ->order_by('nodal_centre_name')
            ->get();
        return $query->result_array(); 
    }

    //Modify By Moli on 23-03-2023
	public function getVtcInfrastructureDetailsByNodal($academic_year = NULL,$nodal_name)
    {
		//echo $nodal_name;exit;
		$vtcCodeArray =array();

        
        $getVTCDetails =  $this->db->select('vtc_master.vtc_code')

        ->from('council_affiliation_vtc_master as vtc_master')
        ->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left')
        ->where('vtc_details.nodal_id_fk',$nodal_name)
        //->where('vtc_details.academic_year',$academic_year)
        ->where('vtc_details.academic_year','2022-23')
        // ->group_start()
        // ->where('vtc_master.vtc_type',1)
        // ->or_where('vtc_master.vtc_type',2)
        // ->group_end()

        ->get()->result_array();
        //echo $this->db->last_query();exit;
        //echo "<pre>";print_r($getVTCDetails);exit;

        if(!empty($getVTCDetails)){

            foreach($getVTCDetails as $val){
                $vtc_code = $val['vtc_code'];
                array_push($vtcCodeArray,$vtc_code);
            }
        }
		//echo "<pre>";print_r($vtcCodeArray);exit;
		if(!empty($vtcCodeArray)){
			
			
			$this->db->select('
			
			vtc_master.vtc_code,
			vtc_master.vtc_name,
			
			vtc_details.hoi_mobile_no,
            vtc_details.vtc_email,
			district_master.district_name
			');
			// $this->db->from('council_affiliation_vtc_teachers AS teacher');
			$this->db->from('council_affiliation_vtc_master as vtc_master')
			->join('council_affiliation_vtc_details as vtc_details', 'vtc_details.vtc_id_fk = vtc_master.vtc_id_pk', 'left');
			$this->db->join('council_district_master as district_master', 'vtc_details.district_id_fk = district_master.district_id_pk', 'left');
			
			// $this->db->where('teacher.academic_year', $academic_year);
			// $this->db->where('teacher.active_status', 1);
			// $this->db->where('teacher.teacher_type' , $teacher_type);

			$this->db->where_in('vtc_master.vtc_code',$vtcCodeArray);

			$this->db->where(
				array(
					'vtc_master.vtc_affiliated_status' => 1,
					'vtc_details.active_status' => 1,
					'vtc_details.academic_year' => $academic_year,
					'vtc_details.final_submit_status' => 1
					
					//'teacher.teacher_type' => (int)$teacher_type,

				)
			);
			$this->db->order_by('vtc_master.vtc_code');

			// Modify By Moli On 20-06-2022
			
			$query =  $this->db->get()->result_array();
			//echo $this->db->last_query();exit;

			if(!empty($query)){

				// foreach ($query as $key => $value) {
				// 	$teacher_id_pk = $value['teacher_id_pk'];
				// 	$teacher_type = $value['teacher_type'];
				// 	$engagement_id_fk = $value['engagement_id_fk'];
				// 	if($teacher_type == 1){

				// 		$this->db->select('teacher_subject_map.*, subject_master.subject_name,subject_master.subject_code');
				// 		$this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
				// 		$this->db->join('council_affiliation_subject_master as subject_master', 'teacher_subject_map.subject_group_id_fk = subject_master.subject_name_id_pk');
				// 		$this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
				// 		$this->db->where('teacher_subject_map.active_status', 1);
				// 		$techerSubject =  $this->db->get()->result_array();

				// 		$query[$key]['assignedSubject'] = $techerSubject;
				// 		$query[$key]['assignedGroup'] = array();

				// 	}elseif ($teacher_type == 3) {
						
				// 		$this->db->select('teacher_subject_map.*, group_master.group_name,group_master.group_code');
				// 		$this->db->from('council_affiliation_vtc_teacher_subject_group_map as teacher_subject_map');
				// 		$this->db->join('council_affiliation_group_master as group_master', 'teacher_subject_map.subject_group_id_fk = group_master.group_id_pk');
				// 		$this->db->where('teacher_subject_map.teacher_id_fk', $teacher_id_pk);
				// 		$this->db->where('teacher_subject_map.active_status', 1);
				// 		$techerGroup =  $this->db->get()->result_array();

				// 		$query[$key]['assignedGroup'] = $techerGroup;
				// 		$query[$key]['assignedSubject'] = array();
				// 	}
					
				// 	if($engagement_id_fk != ''){
				// 		$eng_name= $this->db->select('engagement_name')->from('council_affiliation_engagement_master')->where('engagement_id_pk',$engagement_id_fk)->get()->row_array();
				// 		$query[$key]['engagement_name'] = $eng_name['engagement_name'];
				// 	}else{
				// 		$query[$key]['engagement_name'] = $value['other_engagement'];
				// 	}
					
				// }

				return $query;

			}else{
				return $query= array();
			}
		}else{
			
            return array();
        }
    }
}
