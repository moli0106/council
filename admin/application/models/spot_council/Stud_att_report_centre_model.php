<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stud_att_report_centre_model extends CI_Model
{

    public function get_centre()
    {
        $query = $this->db->select('centre_id_pk,centre_name,centre_code,centre_status')
        ->from("council_jexpo_online_exam_centre_master")
        ->where("centre_status", 1)
        ->get();
       return $query->result_array();
    }

    public function get_course()
    {
        $query = $this->db->select("exam_type_id_pk,exam_type_name,name_for_std_reg")
            ->from("council_exam_type_master")
            ->where(
                array(
                    "active_status"     => 1,
                    //"online_app_status" => 1
                )
            )
            ->order_by("exam_type_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    // public function get_attandance_pdf_data($centre_id_fk = NULL, $exam_type_id_fk = NULL)
    // {
    //      $this->db->select('student_details_id_pk')
    //     ->from("council_polytechnic_spotcouncil_student_details")
    //     ->where("exam_centre_id_fk", $centre_id_fk)
    //     ->where("seating_done_status", 1)
    //     ->where("exam_type_id_fk", $exam_type_id_fk);
    //     $query3 = $this->db->get()->result_array();
    //     if(empty($query3)){
    //         return false;
    //     }
    //     else
    //     {

    //         $stu_id_array = array();
    //         foreach ($query3 as $row){
            
    //         array_push($stu_id_array,$row['student_details_id_pk']);
    //         }
    //         return $stu_id_array;
    //     }

    // }


    public function getStudattaDetails($exam_type_id_fk = NULL,$centre_id_fk = NULL)
    {
        // echo '<pre>'; print_r($student_data_array); die;
        $query = $this->db->select('stud.student_details_id_pk,stud.application_form_no,stud.index_number,stud.candidate_name,stud.picture,stud.sign,centre.centre_name,centre.centre_code,stud.exam_type_id_fk,exam_type.exam_type_name')
        ->from("council_polytechnic_spotcouncil_student_details as stud")
        ->join("council_jexpo_online_exam_centre_master as centre","centre.centre_id_pk = stud.exam_centre_id_fk","LEFT")
        ->join("council_exam_type_master as exam_type","exam_type.exam_type_id_pk = stud.exam_type_id_fk","LEFT")
        ->where("stud.seating_done_status", 1)
        ->where("stud.exam_centre_id_fk",$centre_id_fk)
        ->where("stud.exam_type_id_fk",$exam_type_id_fk)
        ->where("stud.picture!=",null)
        ->where("stud.sign!=",null)
        ->order_by("stud.student_details_id_pk", "asc")
        ->get();
       return $query->result_array();
    }

    public function getStudattaDetailspdf3($exam_type_id_fk = NULL,$centre_id_fk = NULL)
    {
        // echo '<pre>'; print_r($student_data_array); die;
        $query = $this->db->select('stud.index_number,centre.centre_name,centre.centre_code,stud.exam_type_id_fk,exam_type.exam_type_name')
        ->from("council_polytechnic_spotcouncil_student_details as stud")
        ->join("council_jexpo_online_exam_centre_master as centre","centre.centre_id_pk = stud.exam_centre_id_fk","LEFT")
        ->join("council_exam_type_master as exam_type","exam_type.exam_type_id_pk = stud.exam_type_id_fk","LEFT")
        ->where("stud.seating_done_status", 1)
        ->where("stud.exam_centre_id_fk",$centre_id_fk)
        ->where("stud.exam_type_id_fk",$exam_type_id_fk)
        ->order_by("stud.student_details_id_pk", "asc")
        ->get();
       return $query->result_array();
    }


    public function get_centreajax($exam_type_id_fk = NULL)
    {
        $query = $this->db->select('centre_id_pk,centre_name')
        ->from("council_jexpo_online_exam_centre_master")
        ->where("exam_type_id_fk", $exam_type_id_fk)
        ->where("centre_status", 1)
        ->order_by("centre_name", "asc")
        ->get();
        // echo $this->db->last_query(); die;
       return $query->result_array();

    }


    public function get_centreajax1($etype_id = NULL)
    {
        $query = $this->db->select('centre_id_pk,centre_name')
        ->from("council_jexpo_online_exam_centre_master")
        ->where("exam_type_id_fk", $etype_id)
        ->where("centre_status", 1)
        ->order_by("centre_name", "asc")
        ->get();
        // echo $this->db->last_query(); die;
       return $query->result_array();

    }

    public function get_centreajax2($etype_id_fk = NULL)
    {
        $query = $this->db->select('centre_id_pk,centre_name')
        ->from("council_jexpo_online_exam_centre_master")
        ->where("exam_type_id_fk", $etype_id_fk)
        ->where("centre_status", 1)
        ->order_by("centre_name", "asc")
        ->get();
        // echo $this->db->last_query(); die;
       return $query->result_array();

    }


}