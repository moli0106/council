<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_list_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getInsStudentList($limit = NULL, $offset = NULL){

        $query = $this->db->select("stud.institute_student_details_id_pk,
        stud.first_name,
        stud.middle_name,
        stud.last_name,
        stud.guardian_name,
        course.course_name,
        gender.gender_description,
        nationality.nationality_name,
        stud.kanyashree,
        stud.kanyashree_no,
        caste.caste_name,stud.handicapped,stud.date_of_birth,
        stud.aadhar_no,qualification.qualification_name,
        stud.fullmarks,stud.marks_obtain,stud.percentage,
        stud.cgpa,stud.thirdyr_or_physics_or_math_result,
        stud.secondyear_or_chemistry_or_physicalscience_or_science_result,stud.firstyear_or_hs_english_or_lifescience_result,
        stud.year_of_passing,stud.address,stud.pin,state.state_name,
        police.police_station_name,district.district_name,
        subdiv.subdiv_name,stud.mobile,stud.email,
        stud.application_form_no,religion.religion_name,stud.last_reg_no,stud.image,stud.std_signature,stud.approve_reject_status")
            ->from("council_institute_student_details as stud")
             ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
            ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

            ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

            ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

            ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

            ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
        
            ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

            ->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")

            ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

            ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")

            ->where(
                array(
                    "stud.active_status" => 1
                )
            )
            ->limit($limit, $offset)
            
            ->get();
        return $query->result_array();
    }

    public function get_student_count()
    {
        $query = $this->db->select("count(institute_student_details_id_pk)")
            ->from("council_institute_student_details")
            ->get();
        return $query->result_array();
    }

    public function getStudentDetailsById($id_hash = NULL)
    {
        $this->db->select('student.*');
        $this->db->from('council_institute_student_details AS student');
        $this->db->where("MD5(CAST(student.institute_student_details_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }

    public function updateStudentData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(institute_student_details_id_pk as character varying)) =", $student_id);
        $this->db->update('council_institute_student_details', $updateArray);
        return $this->db->affected_rows();
    }
}
?>