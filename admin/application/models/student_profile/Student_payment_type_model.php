<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_payment_type_model extends CI_Model
{

    public function getPaymentType_old($stake_id_fk ,$std_id){
        $this->db->select('payment_type_id_pk,type_name,short_description,fee_amount');
        $this->db->from('council_payment_type_master');
        $this->db->where(array(
            'stake_id_fk'   => $stake_id_fk,
            'active_status' => 1
        ));
        $query = $this->db->get()->result_array();
        //echo "<pre>";print_r($query);exit;

        if(!empty($query)){
            

            foreach($query as $key=>$val){
                $payment_type_id = $val['payment_type_id_pk'];
                $query1 = $this->db->select('*')
                            ->from('council_institute_student_payment_map')
                            ->where('spotcouncil_student_details_id_fk', $std_id)
                            ->where('payment_type_id_fk', $payment_type_id)
                            ->get()->row_array();
                if(!empty($query1)){
                    $query[$key]['payment_status'] = 'Done';
                    $query[$key]['transaction_id'] = $query1['transaction_id'];
                }else{
                    $query[$key]['payment_status'] = 'Not Done';
                }
            }
            return $query;
        }else{
            return array();
        }
    }
	
	public function getPaymentType($stake_id_fk ,$std_id){
        $this->db->select('payment_type_id_pk,type_name,short_description,fee_amount');
        $this->db->from('council_payment_type_master');
        $this->db->where(array(
            'stake_id_fk'   => $stake_id_fk,
            'active_status' => 1
        ));
        $query = $this->db->get()->result_array();
        //echo "<pre>";print_r($query);exit;

        if(!empty($query)){
            

            foreach($query as $key=>$val){
                $payment_type_id = $val['payment_type_id_pk'];
                $query1 = $this->db->select('*')
                            ->from('council_institute_student_payment_map')
                            ->where('spotcouncil_student_details_id_fk', $std_id)
                            ->where('payment_type_id_fk', $payment_type_id)
                            ->get()->row_array();
                if(!empty($query1)){
                    $query[$key]['payment_status'] = 'Completed';
                    $query[$key]['transaction_id'] = $query1['transaction_id'];
                }else{
                    $query[$key]['payment_status'] = 'Pending';
                }
				
				// || Added by moli on 25-03-2023 ||
                //check eligibility
                $eligible = $this->db->select('eligible_for_exam')->from('council_institute_student_details')
                ->where(array('spotcouncil_student_details_id_fk'=>$std_id,'final_save_status' => 1,'approve_reject_status' => 1,'eligible_for_exam'=>1))->get()->row_array();
				//echo $this->db->last_query();exit;
                if(!empty($eligible)){
                    $query[$key]['eligible_status'] = $eligible['eligible_for_exam'];
                }else{
                    $query[$key]['eligible_status'] = '';
                }
            }
            return $query;
        }else{
            return array();
        }
    }
}
?>