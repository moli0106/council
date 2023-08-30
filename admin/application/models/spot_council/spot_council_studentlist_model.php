<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spot_council_studentlist_model extends CI_Model
{

    public function get_student_list_map_count()
    {
        $query = $this->db->select("count(student_details_id_pk)")
            ->from("council_polytechnic_spotcouncil_student_details")
            ->get();
        return $query->result_array();
    }

    public function get_student_data_list ($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,course.course_name,gender.gender_description,nationality.nationality_name,stud.kanyashree,stud.kanyashree_unique_id,caste.caste_name,stud.handicapped,stud.date_of_birth,stud.aadhar_no,qualification.qualification_name,stud.fullmarks,stud.marks_obtain,stud.percentage,stud.cgpa,stud.thirdyr_or_physics_or_math_result,stud.secondyear_or_chemistry_or_physicalscience_or_science_result,stud.firstyear_or_hs_english_or_lifescience_result,stud.institute_name,stud.year_of_passing,stud.address,stud.pincode,state.state_name,police.police_station_name,district.district_name,subdiv.subdiv_name,stud.mobile_number,stud.email,stud.application_form_no,religion.religion_name,stud.last_reg_no,stud.picture,stud.sign")
            ->from("council_polytechnic_spotcouncil_student_details as stud")
             ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
            ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

            ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

            ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

            ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

            ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
        //
            ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

            ->join("council_district_master as district", " district.district_id_pk = stud.religion_id_fk", "LEFT")

            ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

            ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")

            ->where(
                array(
                    "stud.active_status" => 1
                )
            )
            ->limit($limit, $offset)
            ->order_by('stud.general_rank', 'asc')
            ->get();
        return $query->result_array();
    }

    public function get_student_preview_data_list($student_details_id_pk = Null)
    {
       
        $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,course.course_name,gender.gender_description,nationality.nationality_name,stud.kanyashree,stud.kanyashree_unique_id,caste.caste_name,stud.handicapped,stud.date_of_birth,stud.aadhar_no,qualification.qualification_name,stud.fullmarks,stud.marks_obtain,stud.percentage,stud.cgpa,stud.thirdyr_or_physics_or_math_result,stud.secondyear_or_chemistry_or_physicalscience_or_science_result,stud.firstyear_or_hs_english_or_lifescience_result,stud.institute_name,stud.year_of_passing,stud.address,stud.pincode,state.state_name,district.district_name,subdiv.subdiv_name,police.police_station_name,stud.mobile_number,stud.email,stud.application_form_no,religion.religion_name,stud.last_reg_no,stud.picture,stud.sign")
            ->from("council_polytechnic_spotcouncil_student_details as stud")
             ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
            ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

            ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

            ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

            ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

            ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
       
            ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

            ->join("council_district_master as district", " district.district_id_pk = stud.religion_id_fk", "LEFT")

            ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

            ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")

            ->where(
                array(
                    "stud.active_status" => 1,
                    'MD5(CAST(student_details_id_pk AS character varying)) =' =>$student_details_id_pk
                )
            )
            ->get();
        return $query->result_array();

    }

    // sudeshna 10-12-22 start
public function get_studentpdf_data_list ($limit = NULL, $offset = NULL)
{   
    $this->db->order_by("general_rank", "asc");
    $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,course.course_name,gender.gender_description,nationality.nationality_name,stud.kanyashree,stud.kanyashree_unique_id,caste.caste_name,stud.handicapped,stud.date_of_birth,stud.aadhar_no,qualification.qualification_name,stud.fullmarks,stud.marks_obtain,stud.percentage,stud.cgpa,stud.thirdyr_or_physics_or_math_result,stud.secondyear_or_chemistry_or_physicalscience_or_science_result,stud.firstyear_or_hs_english_or_lifescience_result,stud.institute_name,stud.year_of_passing,stud.address,stud.pincode,state.state_name,police.police_station_name,district.district_name,subdiv.subdiv_name,stud.mobile_number,stud.email,stud.application_form_no,religion.religion_name,stud.last_reg_no,stud.picture,stud.sign,stud.general_rank,stud.sc_rank,stud.st_rank,stud.pc_rank")
        ->from("council_polytechnic_spotcouncil_student_details as stud")
         ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
        ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

        ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

        ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

        ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

        ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
    //
        ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

        ->join("council_district_master as district", " district.district_id_pk = stud.religion_id_fk", "LEFT")

        ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

        ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")

        ->where(
            array(
                "stud.active_status" => 1
            )
        )
        ->limit($limit, $offset)
        ->order_by('stud.student_details_id_pk', 'DESC')
        ->get();
    return $query->result_array();
}


// end

public function get_district_data()
{ 
    $query = $this->db->select("district.district_id_pk,district.district_name")
    ->from("council_district_master as district")
    ->where("district.state_id_fk",19)
    ->order_by("district.district_name", "asc")
    ->get();
    return $query->result_array();
    
       
}

public function get_centre_list($zone,$course = NULL)
{
    $query = $this->db->select("centre.centre_id_pk")
            ->from("council_jexpo_online_exam_centre_master as centre")
            ->where("centre.district_id_fk",$zone)
            ->where("centre.exam_type_id_fk",$course)
            ->where("centre.available_seat!=",0)
            ->order_by("centre.centre_id_pk", "asc")
            ->get();
             return $query->result_array();

}

public function get_student_id_list($zone = Null, $alloted_seat = NULL,$course = NULL)
{
    // echo $alloted_seat; die;
             $this->db->select("stud.student_details_id_pk")
            ->from("council_polytechnic_spotcouncil_student_details as stud")
            ->where("stud.pref_zone1",$zone)
            ->where("stud.seating_done_status",NULL)
            ->where("stud.exam_type_id_fk",$course)
            ->order_by("stud.student_details_id_pk", "asc")
            ->limit($alloted_seat);
            $query21 = $this->db->get()->result_array();

            if(empty($query21)){
                return array();
            }
            else
            {

                $stu_id_array = array();
                foreach ($query21 as $row){
                
                array_push($stu_id_array,$row['student_details_id_pk']);
                }
                return $stu_id_array;

                

            }
            
             

}

public function get_centre_details($centre_id_pk = NULL,$course = NULL)
{
    $query = $this->db->select("centre.centre_id_pk,centre.centre_code,centre.no_of_alloted_seat")
            ->from("council_jexpo_online_exam_centre_master as centre")
            ->where("centre.centre_id_pk",$centre_id_pk)
            ->where("centre.exam_type_id_fk",$course)
             ->order_by("centre.centre_id_pk", "asc")
            ->get();
            return  $query->result_array();
              //echo $this->db->last_query(); die;

}

public function update_allocat_seat($zone_wise_student_count_list = NULL,$update_array = NULL)
{
    $this->db->where_in('student_details_id_pk',$zone_wise_student_count_list)
    ->update('council_polytechnic_spotcouncil_student_details',$update_array);
     return $this->db->affected_rows();
      // echo $this->db->last_query(); die;


}

public function update_available_seat($available_seat = NULL, $centre_id_pk =NULL)
{
    //echo $available_seat; die;

    $this->db->where('centre_id_pk',$centre_id_pk)
    ->set('available_seat', $available_seat)
    ->update('council_jexpo_online_exam_centre_master');
     return $this->db->affected_rows();
     // echo $this->db->last_query(); die;

}

    public function get_course()
    {
        $query = $this->db->select("course.exam_type_id_pk,course.exam_type_name,course.name_for_std_reg")
            ->from("council_exam_type_master as course")
            ->where(
                array(
                    "course.active_status" => 1
                )
            )
            ->order_by('course.exam_type_name')
            ->get();
        return $query->result_array();
    }


   

}