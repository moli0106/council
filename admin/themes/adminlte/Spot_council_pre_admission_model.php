<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spot_council_pre_admission_model extends CI_Model
{



    public function get_pre_admission_student_count()
    {
        $query = $this->db->select("count(student_details_id_pk)")
            ->from("council_polytechnic_spotcouncil_student_details")
            ->get();
        return $query->result_array();
    }

    public function get_application_wise_student($application_form_no)
    {

        $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,stud.caste_id_fk,stud.general_rank,stud.sc_rank,stud.st_rank,stud.pc_rank,stud.obc_a,stud.obc_b,stud.application_form_no,stud.course_id_fk,stud.registration_year")
            ->from("council_polytechnic_spotcouncil_student_details as stud")

            ->where(
                array(
                    "stud.active_status"        => '1',
                    "stud.application_form_no"        => $application_form_no,

                )
            )
            ->get();
        return $query->row_array();
    }


    public function insertData($insert_array = NULL)
    {

        return $this->db->insert($insert_array['table_name'], $insert_array['data']);
    }

    public function update_data($table_name,$update_array = Null,$std_id){
        // echo '<pre>'; print_r($update_array); die;
        $this->db->where('student_details_id_pk',(int)$std_id);
        $this->db->update($table_name, $update_array);
    //    echo  $this->db->last_query(); die;
        return $this->db->affected_rows();

    }

    public function get_pre_admission_data($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("admission.application_form_no")
        ->from("council_polytechnic_spotcouncil_pre_admission_details as admission")
        
        ->where(
            array(
                "admission.active_status"        => '1',
                
            )
        )
        ->limit($limit, $offset)
        ->get();
    return $query->result_array();
 
    }

    /*
    public function get_marit_list($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,district.district_name,stud.district_id_fk,stud.date_of_birth,stud.fullmarks,stud.marks_obtain,caste.caste_name,stud.caste_id_fk,stud.general_rank,stud.sc_rank,stud.st_rank,stud.pc_rank")
        ->from("council_polytechnic_spotcouncil_student_details as stud")
        ->join("council_district_master as district", "district.district_id_pk = stud.district_id_fk", "LEFT")
        ->join("council_caste_master as caste", "caste.caste_id_pk = stud.caste_id_fk", "LEFT")
        ->where(
            array(
                "stud.active_status"        => '1',
                // "MD5(CAST(college_id_fk as character varying)) =" => $college_id_hash,
                // "caste_id_fk"          => $caste_id_fk,
                // "discipline_id_fk"     => $discipline_id_fk,
            )
        )
        ->limit($limit, $offset)
        ->get();
    return $query->result_array();
    } */
}
