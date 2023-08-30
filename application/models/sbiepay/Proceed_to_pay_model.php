<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proceed_to_pay_model extends CI_Model
{

    public function getVTCGroupDetailsById($group_id){
        $this->db->select('group_master.*,course_master.course_name_id_fk');
        $this->db->from('council_affiliation_group_master as group_master');
        $this->db->join('council_affiliation_course_master as course_master', 'course_master.course_id_pk = group_master.group_id_pk');
        $this->db->where('group_id_pk',$group_id);
       $query =  $this->db->get()->row_array();
       return $query;

    }
    public function insert_data($table,$data_array){

        $this->db->insert($table,$data_array);
        return $this->db->insert_id();

    }

    public function getStudentListByGroupId($group_id , $vtc_id_fk = NULL, $academic_year = NULL){

        $this->db->select('
            student.student_id_pk,
            student.class_id_fk,
            std_academic.old_reg_no,
            std_academic.old_reg_year
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_vtc_student_last_examination as std_academic', 'std_academic.student_id_fk = student.student_id_pk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_fk);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.year_of_registration', $academic_year);
        $this->db->where('student.course_id_fk', $group_id);
        //$this->db->where('student.payment_status', 'No');
        $this->db->where('student.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        $query = $this->db->get()->result_array();
        
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }

    public function get_last_transaction_id($chaking_data = NULL,$payment_type = NULL)
    {
        return $query = $this->db->select('max(transaction_id) as code')
            ->from('council_sbi_payment_transanction_log_details')
            ->like('transaction_id', ($chaking_data))
            ->where('payment_type_id_fk', $payment_type)
            ->get()
            ->result_array();
    }

    public function getTransactionDetailsByMarchandOrderNo($merchant_order_no){
        $this->db->select('*');
        $this->db->from('council_sbi_payment_transanction_log_details');
        $this->db->where('transaction_id',$merchant_order_no);
        $query = $this->db->get()->row_array();
        if(!empty($query)){
            return $query;
        }else{
            return $query = array();
        }

    }

    public function getInsStdDetails($std_id = NULL){

        $this->db->select('student_details.*,vtc_master.vtc_name,vtc_master.vtc_code');
        $this->db->from('council_institute_student_details as student_details');
        $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
        $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
        $query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }
    }

    // added by Moli on 26-02-2023
    public function getStdDetailsByIdHash($id_hash){

		$this->db->select('student_details_id_pk,kanyashree_unique_id');
		$this->db->from('council_polytechnic_spotcouncil_student_details as student');
		$this->db->where("MD5(CAST(student.student_details_id_pk as character varying)) =", $id_hash);
		$query =  $this->db->get()->row_array();
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}

    public function getMobileNo($std_id = NULL){
        $this->db->select('mobile_number')
        ->from('council_polytechnic_spotcouncil_student_details')
        ->where('student_details_id_pk',$std_id);
        $query= $this->db->get()->row_array();
        $mobile_number = $query['mobile_number'];
        return $mobile_number;
    }
}