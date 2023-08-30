<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfer_model extends CI_Model
{
    public function getStudentDetailsByRegNo($reg_no){

        $this->db->select('card_number.reg_certificate_number,student.institute_student_details_id_pk,
        student.spotcouncil_student_details_id_fk,
        student.first_name,
        student.middle_name,
        student.last_name,
        student.mobile_number,
        student.date_of_birth');
        $this->db->from('council_institute_student_card_number_map as card_number');
        $this->db->join('council_institute_student_details as student','student.institute_student_details_id_pk = card_number.institute_student_details_id_fk');
        $this->db->where('card_number.reg_certificate_number',$reg_no);
        $query = $this->db->get()->result_array();
        // echo $this->db->last_query();die;
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function check_govt_inst($std_id){
        $this->db->select('student.institute_student_details_id_pk,
        student.spotcouncil_student_details_id_fk,
        vtc.institute_category_id_fk');
        $this->db->from('council_institute_student_details as student');
        $this->db->join('council_affiliation_vtc_master as vtc','student.institute_id_fk = vtc.vtc_id_pk');
        $this->db->where('student.institute_student_details_id_pk',$std_id);
        $query = $this->db->get()->result_array();
        // echo $this->db->last_query();die;
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function insertData($table,$data_array = NULL)
    {
        $this->db->insert($table, $data_array);
		// echo $this->db->last_query();exit;

        return $this->db->insert_id();
    }

    public function updateStdDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $id);
        $this->db->update('council_institute_student_details', $updateArray);
        return $this->db->affected_rows();
    }

}