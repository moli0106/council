<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration_model extends CI_Model
{


	public function get_last_application_no_test($chaking_data = NULL)
    {
        return 
		$query = $this->db->select('max(application_form_no) as code')
            ->from('council_polytechnic_spotcouncil_student_details_draft')
            ->like('application_form_no', ($chaking_data))
            ->get()
            ->result_array();
			//echo $this->db->last_query();exit;
    }

	public Function get_duplicate(){
		//echo "test";exit;
		$this->db->select('student_details_id_pk,application_form_no,exam_type_id_fk')
		->from('council_polytechnic_spotcouncil_student_details')
		->where('duplicate_flag',1)
		->where("active_status", 1)->where('exam_type_id_fk',1);
		$this->db->order_by("application_form_no")->limit(30);
		$query=$this->db->get()->result_array();
		//echo "<pre>";print_r($query);exit;
		return $query;
	}
	
	public function updateStdEligibility($ids = NULL, $updateArray = NULL)
    {
        $this->db->where('student_details_id_pk', $ids);
        $this->db->update('council_polytechnic_spotcouncil_student_details', $updateArray);
		//echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
	
	public function updateStdDraft($ids = NULL, $updateArray = NULL)
    {
        $this->db->where('student_details_id_fk', $ids);
        $this->db->update('council_polytechnic_spotcouncil_student_details_draft', $updateArray);
		//echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
	




	
}


