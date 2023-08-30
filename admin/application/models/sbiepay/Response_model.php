<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Response_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllTransactionId($start_date = NULL,$end_date = NULL,$payment_type_id_fk=NULL){
        $this->db->select('transaction_id,stake_details_id_fk,stake_id_fk,payment_type_id_fk')
        ->from('council_sbi_payment_transanction_log_details');
        $this->db->where('sending_time >=', $start_date);
        $this->db->where('sending_time <=', $end_date);
        $this->db->where('payment_type_id_fk', $payment_type_id_fk);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function update_data($table,$upd_array,$merchant_order_no){

        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update($table,$upd_array);

        // Update Payment Details Table
        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update('council_payment_details',array('response_status' => $upd_array['response_status'],'from_status_query' =>1,'response_description'=>$upd_array['response_description']));

        return $this->db->affected_rows();

    }


    /////////////17-04-2023
    public function getAllVTCBlankTransactionId($payment_type_id_fk){
        $this->db->select('transaction_id,vtc_id_fk,student_id_fk,payment_type_id_fk,group_id_fk')
        ->from('council_vtc_student_payment_lot');
        //$this->db->where('payment_type_id_fk', $payment_type_id_fk);
        //$this->db->where('response_status is null');
        $this->db->limit(3);
        $query = $this->db->get()->result_array();
       //echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function get_std_count($student_id_fk){
        $ids=explode(',', $student_id_fk);
        $this->db->select('
            COUNT ( CASE WHEN "student".kanyashree_no is null THEN 1 ELSE NULL END ) non_kon_count,
            COUNT ( CASE WHEN "student".kanyashree_no is not null THEN 1 ELSE NULL END ) kon_count
            
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->where_in('student.student_id_pk',$ids);
        $query = $this->db->get()->row_array();
       //echo $this->db->last_query();exit;
         if(!empty($query)){
             return $query;
         }else{
             return array();
         }
    }

    public function getVtcDetails($vtc_id_fk){
        $this->db->select('cavd.institute_category_id_fk, cavm.vtc_type')
            ->from('council_affiliation_vtc_details AS cavd')
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->where('cavd.vtc_id_fk', $vtc_id_fk)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();
        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getVTCGroupDetailsById($group_id){
        $this->db->select('group_master.*,course_master.course_name_id_fk');
        $this->db->from('council_affiliation_group_master as group_master');
        $this->db->join('council_affiliation_course_master as course_master', 'course_master.course_id_pk = group_master.group_id_pk');
        $this->db->where('group_id_pk',$group_id);
       $query =  $this->db->get()->row_array();
       return $query;

    }

    public function getLotStudentIdByTransactionId($merchant_order_no){
        $this->db->select('student_id_fk,payment_details_id_fk');
        $this->db->from('council_vtc_student_payment_lot');
        $this->db->where('transaction_id',$merchant_order_no);
        $query = $this->db->get()->row_array();
        if(!empty($query)){
            return $query;
        }else{
            return $query = array();
        }
    }

    public function updateVTCLotTable($merchant_order_no){

        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update('council_vtc_student_payment_lot',array('response_status' => 1));

        return $this->db->affected_rows();
    }

    public function updatePaymentResponse($updArray,$stdId,$payment_type){

        //if($payment_type == 1){

            $this->db->where_in('student_id_pk', $stdId);
            $this->db->update('council_vtc_student_master',$updArray);
            return $this->db->affected_rows();

        //}
        
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

    public function getAllPolyAffiliationBlankTransactionId($payment_type_id_fk = null){ //add by Moli on 25-07-2023

        $this->db->select('transaction_id,institute_id_fk,basic_affiliation_id_fk,posting_amount')
        ->from('council_polytechnic_affiliation_payment');
        $this->db->where('payment_type_id_fk', $payment_type_id_fk);
        $this->db->where('response_status is null');
        $this->db->limit(3);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function getBasicAffiliationIdByTransactionId($merchant_order_no){

        $this->db->select('basic_affiliation_id_fk')
        ->from('council_polytechnic_affiliation_payment');
        $this->db->where('transaction_id', $merchant_order_no);
        
        $query = $this->db->get()->result_array();
       //echo $this->db->last_query();exit;s
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function updateBasicDetails($upd_array, $basic_id){

        $this->db->where('basic_affiliation_id_pk', $basic_id);
        $this->db->update('council_polytechnic_institute_basic_affiliation_details',$upd_array);
        return $this->db->affected_rows();
    }

   
}