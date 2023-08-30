<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bsk_response_model extends CI_Model
{
    public function insert_data($table,$data_array){

        $this->db->insert($table , $data_array);
        return $this->db->insert_id();
    }

    public function get_all_bsk_data($form_date, $to_date,$limit=null,$offset=null){
        $this->db->select("student_details_id_pk,bsk_ticket_no,bsk_userid,mobile_number,application_form_no, replace(date(entry_time)::text,'-','') as entry_time");
        $this->db->from("council_polytechnic_spotcouncil_student_details");
        $this->db->where("entry_time >=", $form_date);
        $this->db->where("entry_time <=", $to_date);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        
        if(!empty($query)){

            foreach($query as $key=>$val){
                $student_details_id_pk = $val['student_details_id_pk'];
                $this->db->select("transaction_id,posting_amount,bank_reference_number,sbiepay_ref_id");
                $this->db->from("council_institute_student_payment_map");
                $this->db->where("spotcouncil_student_details_id_fk",$student_details_id_pk);
                $query2 = $this->db->get()->row_array();

                $query[$key]['transaction_id'] = $query2['transaction_id'];
                $query[$key]['posting_amount'] = $query2['posting_amount'];
                $query[$key]['bank_reference_number'] = $query2['bank_reference_number'];
                $query[$key]['sbiepay_ref_id'] = $query2['sbiepay_ref_id'];

            }
            //echo "<pre>";print_r($query);exit;
            return $query;
        }else{
            return array();
        }
        
    }


}