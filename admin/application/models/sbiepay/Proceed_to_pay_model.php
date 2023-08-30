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
            std_academic.old_reg_year,
			student.kanyashree_no
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_vtc_student_last_examination as std_academic', 'std_academic.student_id_fk = student.student_id_pk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_fk);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.year_of_registration', $academic_year);
        $this->db->where('student.course_id_fk', $group_id);
        $this->db->where('student.payment_status', 'No');
        $this->db->where('student.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        $this->db->where('student.added_by', 1);
		$query = $this->db->get()->result_array();
        
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }
	
	public function getstd_count_by_classid($group_id , $vtc_id_fk = NULL, $academic_year = NULL, $class_id_fk = NULL){

        $this->db->select('
                    COUNT ( CASE WHEN "student".kanyashree_no is null THEN 1 ELSE NULL END ) non_kon_count,
                    COUNT ( CASE WHEN "student".kanyashree_no is not null THEN 1 ELSE NULL END ) kon_count
                     
                ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_vtc_student_last_examination as std_academic', 'std_academic.student_id_fk = student.student_id_pk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_fk);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.year_of_registration', $academic_year);
        $this->db->where('student.course_id_fk', $group_id);
        $this->db->where('student.payment_status', 'No');
        $this->db->where('student.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        if($class_id_fk == 1){
			$this->db->where('student.class_id_fk', 1);
		}else{
			$this->db->where('student.class_id_fk', 4);
		}
		
		$query = $this->db->get()->row_array();
        
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
	
	public function getInsStdDetails($std_id = NULL,$payment_type = null){ //modify by moli on 23-04-2023

        $this->db->select('student_details.kanyashree_no,
        student_details.spotcouncil_student_details_id_fk,
        student_details.institute_student_details_id_pk,
        student_details.exam_type_id_fk,
        vtc_master.vtc_name,
        vtc_master.vtc_code');
        $this->db->from('council_institute_student_details as student_details');
        $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');

        if($payment_type == 2 || $payment_type == 4){

            $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
        }else{
            $this->db->where('student_details.institute_student_details_id_pk',$std_id);
        }
        $query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }
    }
	
	
	public function getMobileNo($stake_details_id_fk,$stake_id_fk){
        if($stake_id_fk==15){

            $this->db->select('hoi_mobile_no')
            ->from('council_affiliation_vtc_details')
            ->where('vtc_id_fk',$stake_details_id_fk);
            $query= $this->db->get()->row_array();
            $mobile_number = $query['hoi_mobile_no'];

        }elseif($stake_id_fk==29){

            $this->db->select('mobile_number')
            ->from('council_institute_student_details')
            ->where('spotcouncil_student_details_id_fk',$stake_details_id_fk);
            $query= $this->db->get()->row_array();
            $mobile_number = $query['mobile_number'];
        }
        return $mobile_number;
    }
	
	//Added by 17-03-2023
    public function getVtcDetails($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->select('cavd.institute_category_id_fk, cavm.vtc_type,cavm.vtc_name,cavm.vtc_code')
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

    // Added by 23-06-203
    public function getStdDetails($std_id = NULL,$payment_type = null){ //modify by moli on 23-04-2023

        $this->db->select('student_details.student_details_id_pk,
        student_details.candidate_name,
        student_details.exam_type_id_fk');
        $this->db->from('council_polytechnic_counselling_student_data as student_details');
        $this->db->where('student_details.student_details_id_pk',$std_id);
        $query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }
    }

    //Added by 14-07-2023
    public function getIntakeById($id_hash){
   
        $this->db->select('intake.*,discipline.discipline_name,basic_affiliation.new_or_renewal');
        $this->db->from('council_polytechnic_institute_intake_details as intake');
        $this->db->join('council_qbm_discipline_master as discipline', 'discipline.discipline_id_pk = intake.discipline_id_fk');
        $this->db->join('council_polytechnic_institute_basic_affiliation_details as basic_affiliation', 'basic_affiliation.basic_affiliation_id_pk = intake.basic_affiliation_id_fk');
        $this->db->where('intake.active_status',1);
        $this->db->where("MD5(CAST(intake.basic_affiliation_id_fk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
}