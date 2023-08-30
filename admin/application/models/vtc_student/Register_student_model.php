<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register_student_model extends CI_Model
{

    public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_id_pk', $vtc_id)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }


    public function getGroupByVTCId($vtc_id_fk = NULL , $academic_year = NULL){
        $this->db->select('group_map.group_id_fk , group_master.group_name , group_master.group_code');
        $this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk');
        $this->db->where('group_map.vtc_id_fk' , $vtc_id_fk);
        $this->db->where('group_map.academic_year' , $academic_year);
        $this->db->where('group_map.active_status' , 1);
        $query = $this->db->get()->result_array();

        if(!empty($query)){
            
            
            //echo "<pre>";print_r($query);
            return $query;
        }else{
            return array();
        }


    }

    public function get_std_listByGroup($vtc_id_fk,$group_id,$batch=NULL){
		$this->db->select('std.student_id_pk,
		std.course_id_fk,
		std.first_name,
		std.middle_name,
		std.last_name,
		cagm.group_code,
		std.registration_number,
        std.aadhar_no,
        std.eligible_for_exam,

		std.approve_reject_status');
		$this->db->from('council_vtc_student_master as std');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = std.course_id_fk','LEFT');
		$this->db->where('std.added_by', 1);
		$this->db->where('std.active_status', 1);
		$this->db->where('std.year_of_registration', '2022-23');
		//$this->db->where('std.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
		//$this->db->where('std.registration_number is not');
		
		$this->db->where('std.institute_id_fk', $vtc_id_fk);
		$this->db->where('std.course_id_fk', $group_id);
        if($batch == 1){
            $this->db->where('std.batch_phase', 1);
            $this->db->or_where('std.batch_phase =', null);
        }else{
            $this->db->where('std.batch_phase', $batch);
        }
		return $query =$this->db->get()->result_array();
		//echo "<pre>";print_r($query);exit;
	}

    public function get_group_details($group_id){
		$this->db->select('group_name,group_code')
		->from('council_affiliation_group_master')
		->where('group_id_pk',$group_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

}