<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_profile_model extends CI_Model
{
	public function fetch_student($id_hash=NULL){

		$this->db->select('
		c1.student_details_id_pk,
		c1.index_number,
		c1.candidate_name,
		c1.mobile_number,
		c1.counselling_updated_status,
		c1.final_allotment,
		c4.gender_id_pk,
		c4.gender_description,
		c1.handicapped,
		c3.caste_id_pk,
		c3.caste_name,
		c2.state_id_pk,
		c2.state_name,
		c1.land_loser,
		c1.applied_under_tfw,
		c1.wards_of_exserviceman,
		c1.kanyashree,
		c1.kanyashree_unique_id,
		c1.ews,
		c1.guardian_name,
		c5.district_id_pk,
		c5.district_name,
		c1.general_rank,
		c1.sc_rank,
		c1.st_rank,
		c1.pc_rank,
		c1.obc_a,
		c1.obc_b');
		$this->db->from('council_polytechnic_counselling_student_data as c1');
		$this->db->join('council_state_master as c2','c2.state_id_pk=c1.state_id_fk','LEFT');
		$this->db->join('council_caste_master as c3','c3.caste_id_pk=c1.caste_id_fk','INNER JOIN');
		$this->db->join('council_gender_master as c4','c4.gender_id_pk=c1.gender_id_fk','INNER JOIN');
		$this->db->join('council_district_master as c5','c5.district_id_pk=c1.district_id_fk','LEFT');
		$this->db->where('c1.student_details_id_pk', $id_hash);
		$query= $this->db->get()->result_array();
		if(!empty($query)){
			return $query;
		}else{
			return array();
		}

	}

	public function district_fetch(){
		$this->db->select('district_id_pk,district_name');
		$this->db->from('council_district_master');
		$this->db->where('active_status',1);
		return $this->db->get()->result_array();
	}
	public function get_caste()
	{
		$query = $this->db->select("*")
			->from("council_caste_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function update_details($upd_data,$id){
		$this->db->where('student_details_id_pk', $id);
        $this->db->update('council_polytechnic_counselling_student_data', $upd_data);
		//echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
	}
	public function update_login_details($upd_data,$index_number){
		$this->db->where('base_login_id', $index_number);
        $this->db->update('council_stake_holder_login', $upd_data);
		//echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
	}
	
}