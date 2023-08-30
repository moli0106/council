<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sbi_payment_model extends CI_Model
{


    public function update_data($table,$upd_array,$merchant_order_no){

        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update($table,$upd_array);

        // Update Payment Details Table
        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update('council_payment_details',array('response_status' => $upd_array['response_status']));

        return $this->db->affected_rows();

    }

    public function getTransactionDetailsByMarchandOrderNo($merchant_order_no){
        $this->db->select('log_details.*,payment_details.payment_details_id_pk');
        $this->db->from('council_sbi_payment_transanction_log_details as log_details');
        $this->db->join('council_payment_details as payment_details', 'log_details.transaction_id = payment_details.transaction_id');
        $this->db->where('log_details.transaction_id',$merchant_order_no);
        $query = $this->db->get()->row_array();
        if(!empty($query)){
            return $query;
        }else{
            return $query = array();
        }

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

    public function updatePaymentResponse($updArray,$stdId,$payment_type){

        //if($payment_type == 1){

            $this->db->where_in('student_id_pk', $stdId);
            $this->db->update('council_vtc_student_master',$updArray);
            return $this->db->affected_rows();

        //}
        
    }

    public function insertPaymentResponse($table,$insert_data){

        $this->db->insert($table,$insert_data);
        return $this->db->insert_id();

    }

    public function updateVTCLotTable($merchant_order_no){

        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update('council_vtc_student_payment_lot',array('response_status' => 1));

        return $this->db->affected_rows();
    }

    // add on 07-02-2023
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

    public function check_transaction_id($table,$merchant_order_no){
        $this->db->select('transaction_id');
        $this->db->from($table);
        $this->db->where('transaction_id',$merchant_order_no);
        $query= $this->db->get()->row_array();
        if(!empty($query)){
            return $query;
        }else {
            return array();
        }

    }

    //Added by moli on 22-05-2023
    public function  updateVTCAffiliationTable($merchant_order_no){

        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update('council_vtc_affiliation_payment',array('response_status' => 1));

        return $this->db->affected_rows();
    }

    //Added by moli on 23-06-2023
    public function  updateDetailsTable($merchant_order_no){

        $this->db->where('transaction_id', $merchant_order_no);
        $this->db->update('council_vtc_affiliation_payment',array('response_status' => 1));

        return $this->db->affected_rows();
    }
}