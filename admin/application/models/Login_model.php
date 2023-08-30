<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Login_model extends CI_Model {

	public function check_user($login_id=NULL) {
		//return $login_id . $password;
		$query = $this->db->select('shl.stake_id_fk, shl.stake_holder_login_id_pk, shl.login_id, shl.active_status, shm.stake_details, shl.stake_holder_details,shl.stake_details_id_fk,shl.login_password')
			->from('council_stake_holder_login AS shl')
			->join('council_stake_holder_master AS shm', 'shl.stake_id_fk = shm.stake_id_pk', 'left')
			//->group_start()
			->where(
				array(
					'shl.login_id' => $login_id,
					'shl.active_status' => 1,
					'shm.active_status' => 1
				)
			
			)
			//->group_end()
			//->where_in('shl.stake_id_fk', array(1,2,3))
			->get();
		return $query->result_array();
	}
	
	public function getDetailsByAdharNum($aadhar_no = NULL)
    {
		// $this->db->select('student_details.*,college_map.course_id_fk,college_map.institute_id_fk,college_map.institue_reg_id_fk')
		$this->db->select('student_details.*')
            ->from('council_polytechnic_spotcouncil_student_details AS student_details')
			// ->join('council_polytechnic_spotcouncil_student_college_map as college_map', 'student_details.student_details_id_pk = college_map.student_details_id_fk')
            ->where('student_details.aadhar_no', $aadhar_no);
			$query = $this->db->get()->row_array();

			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
    }

	// Add by Moli
	public function updateStdCredentials($table,$updateArray,$std_aadhar_no){
		$this->db->where('base_login_id', $std_aadhar_no);
        $this->db->update($table, $updateArray);
        return $this->db->affected_rows();
	}
	
	public function get_mobile_no($std_aadhar_no){
		
		$this->db->select('mobile_no')
		->from('council_stake_holder_login')
		->where('base_login_id',$std_aadhar_no)
		->group_start()
		->where('stake_id_fk',29)
		->or_where('stake_id_fk', 31)
    	->group_end(); //this will end grouping
		$query = $this->db->get()->row_array();

			if (!empty($query)) {
				return $query;
			} else {
				return array();
			}
	}
}
