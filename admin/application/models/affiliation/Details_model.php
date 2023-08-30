<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Details_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcType()
    {
        return $this->db->where('active_status', 1)->order_by('vtc_type_name')
            ->get('council_affiliation_vtc_type_master')->result_array();
    }

    public function getMediumOfInstruction()
    {
        return $this->db->where('active_status', 1)->order_by('medium_of_instruction')
            ->get('council_affiliation_medium_of_instruction_master')->result_array();
    }

    public function getDistrictList()
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', 19)->order_by('district_name')
            ->get('council_district_master')->result_array();
    }

    public function getNodalOfficerByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('nodal_centre_name')
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getNodalOfficerByWhereInDistrictId($kolkataArray = NULL)
    {
        return $this->db->where('active_status', 1)->where_in('district_id_fk', $kolkataArray)->order_by('nodal_centre_name')
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getSubDivisionByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('subdiv_name')
            ->get('council_subdiv_master')->result_array();
    }

    public function getMunicipalityByDivisionId($sub_division_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('subdiv_id_fk', $sub_division_id)->order_by('block_municipality_name')
            ->get('council_block_municipality_master')->result_array();
    }

    public function getVtcList()
    {
        return $this->db->limit(10, 0)->get('council_affiliation_vtc_master')->result_array();
    }

    public function getHsVocCourseList($courseNotIn = NULL)
    {
        $this->db->where("course_name_id_fk", 1);
        $this->db->where("active_status", 1);

        if (!empty($courseNotIn)) {
            $this->db->where_not_in('streem_name_id_fk', $courseNotIn);
        }

        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getNqrCourseList()
    {
        $this->db->where("course_name_id_fk", 2);
        $this->db->where("active_status", 1);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getNsqfCourseList()
    {
        $this->db->where("course_name_id_fk", 3);
        $this->db->where("active_status", 1);
        $this->db->order_by("group_name");
        return $this->db->get('council_affiliation_course_master')->result_array();
    }

    public function getCourseMasterById($id = NULL)
    {
        $this->db->where("course_id_pk", $id);
        $query = $this->db->get('council_affiliation_course_master')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function insertVtcDetails($array)
    {
        $this->db->insert('council_affiliation_vtc_details', $array);

        return $this->db->insert_id();
    }

    public function insertCourseSelectionData($array)
    {
        $this->db->insert_batch('council_affiliation_vtc_courses', $array);

        return $this->db->insert_id();
    }

    public function getVtcDetails($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->select('cavd.*, cavm.*')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
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

    public function getVtcCourses($vtc_id_fk = NULL)
    {
        $this->db->where("MD5(CAST(vtc_id_fk as character varying)) =", $vtc_id_fk);

        return $this->db->get('council_affiliation_vtc_courses')->result_array();
    }

    public function updateVtcDetails($vtc_details_id, $updateArray)
    {
        $this->db->where("MD5(CAST(vtc_details_id_pk as character varying)) =", $vtc_details_id);

        $this->db->update('council_affiliation_vtc_details', $updateArray);

        return $this->db->affected_rows();
    }

    public function getDesignationList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('designation_name');

        return $this->db->get('council_affiliation_designation_master')->result_array();
    }

    public function getAttachedList()
    {
        $this->db->where('active_status', 1);

        // $this->db->order_by('attached_name');

        return $this->db->get('council_affiliation_attached_master')->result_array();
    }

    public function getEngagementList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('engagement_name');

        return $this->db->get('council_affiliation_engagement_master')->result_array();
    }

    public function getQualificationList()
    {
        $this->db->where('active_status', 1);

        $this->db->order_by('qualification_name');

        return $this->db->get('council_affiliation_qualification_master')->result_array();
    }

    public function getVtcCourseByCourseName($tType = NULL, $id_hash = NULL)
    {
        $this->db->select('vtc_courses.vtc_course_id_pk, course_master.group_name, course_master.group_code');
        $this->db->from('council_affiliation_vtc_courses AS vtc_courses');
        $this->db->join('council_affiliation_course_master AS course_master', 'course_master.course_id_pk = vtc_courses.course_id_fk', 'left');
        $this->db->where("MD5(CAST(vtc_courses.vtc_id_fk as character varying)) =", $id_hash);
        $this->db->where('vtc_courses.active_status', 1);

        if ($tType == 1) {

            $this->db->where('vtc_courses.course_name_id_fk', 1);
        } elseif ($tType == 2) {

            $this->db->group_start();
            $this->db->where('vtc_courses.course_name_id_fk', 2);
            $this->db->or_where('vtc_courses.course_name_id_fk', 3);
            $this->db->group_end();
        } elseif ($tType == 3) {

            $this->db->where('vtc_courses.course_name_id_fk', 4);
        }

        $this->db->order_by('course_master.group_name');

        return $this->db->get()->result_array();
    }

    public function insertTeacherData($array = NULL)
    {
        $this->db->insert('council_affiliation_vtc_teachers', $array);

        return $this->db->insert_id();
    }

    public function getVtcTeacherList($vtc_id = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('active_status', 1);
        return $this->db->get('council_affiliation_vtc_teachers')->result_array();

        // this->db->get('council_affiliation_vtc_teachers', limit, offset);
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

    public function getGroupName_old($grCodeArray)
    {
        $query = $this->db->select('DISTINCT(course.group_name)')
            ->from('council_affiliation_course_master AS course')
            ->where_in('course_id_pk', $grCodeArray)
            ->where('active_status', 1)->get()->result_array();

        return $query;
    }
    public function getGroupName($grCodeArray)
    {
        $query = $this->db->select('DISTINCT(group_name)')
            ->from('council_affiliation_group_master')
            ->where_in('group_id_pk', $grCodeArray)
            ->where('active_status', 1)->get()->result_array();

        return $query;
    }

    // Added by Moli on 20-07-2022

    public function getVTCDetailsById($vtc_details_id){

        $this->db->where('vtc_details_id_pk', $vtc_details_id);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_details')->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }
    // Added by Moli on 20-07-2022

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

    public function getHoiDesignationList()
    {
        return $this->db->where('active_status', 1)->order_by('designation_name')
            ->get('council_affiliation_hoi_designation_master')->result_array();
    }
    public function getDesignationNameById($designation_id)
    {
        return $this->db->where('active_status', 1)->where('hoi_designation_id_pk',$designation_id)
            ->get('council_affiliation_hoi_designation_master')->row_array();
    }

    public function getInstituteCategory()
    {
        return $this->db->where('active_status', 1)->order_by('category_name')
            ->get('council_affiliation_institute_category_master')->result_array();
    }

    public function getDisabilityList()
    {
        return $this->db->where('active_status', 1)->order_by('disability_name')
            ->get('council_disability_master')->result_array();
    }
    public function getdisadvantageGroupList()
    {
        return $this->db->where('active_status', 1)->order_by('disadvantage_group_name')
            ->get('council_disadvantage_group_master')->result_array();
    }

    
}

/* End of file Map_district_model.php */
