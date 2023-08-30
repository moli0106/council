<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Change_password_model extends CI_Model {

    public function change_password($data){

		$this->db->where('stake_holder_login_id_pk', $this->session->userdata('stake_holder_login_id_pk'));
        $this->db->update('council_stake_holder_login', $data);
        
        return $this->db->affected_rows();
    }

    public function vefify_assessor_user($array){
          
        $query = $this->db->select('cshl.stake_holder_login_id_pk AS id, cshl.login_id, cshl.stake_holder_details AS name')
        ->from('council_stake_holder_login AS cshl')
        ->join('council_assessor_registration_details AS card', 'card.assessor_registration_details_pk = cshl.stake_details_id_fk', 'left')
        ->where(
            array(
                'card.email_id' => $array['email_id'],
                'cshl.login_id' => $array['login_id']
            )
        )
        ->get();

        return $query->result_array();

    }

    public function get_stake_holder_master(){

        $query = $this->db->select('stake_id_pk, stake_details')
        ->order_by('stake_details', 'asc')
        ->from('council_stake_holder_master')
        ->get();

        return $query->result_array();
    }

    public function update_password_link_status($id){

        $this->db->set('password_reset_link_status', 1);
        $this->db->where('stake_holder_login_id_pk', $id);

        $this->db->update('council_stake_holder_login');

        return $this->db->affected_rows();
    }

    public function get_assessor_by_login_id_pk($id_hash){

        $query = $this->db->select('stake_holder_login_id_pk, password_reset_link_status')
		->where(
                array(
                    "MD5(CAST(stake_holder_login_id_pk AS character varying)) =" => $id_hash 
                )
            )
        ->from('council_stake_holder_login')
        ->get();

        return $query->result_array();
    }
    
    public function reset_password_with_status($array){

        $this->db->set('base_password', $array['new_password']);
        $this->db->set('login_password', $array['new_password_hash']);
        $this->db->set('password_reset_link_status', 0);

		$this->db->where('stake_holder_login_id_pk', $array['stake_holder_id']);
        $this->db->update('council_stake_holder_login');
        
        return $this->db->affected_rows();
    }

    public function getLoginDetails(){

        $query = $this->db->select('stake_holder_login_id_pk, stake_id_fk, admin_level_id_fk, login_id, activation_date, active_status, entry_time, update_time, entry_ip, stake_holder_details, stake_details_id_fk, update_ip, login_password')
        ->where(
            array(
                'stake_id_fk'               => $this->session->userdata('stake_id_fk'),
                'stake_details_id_fk'       => $this->session->userdata('stake_details_id_fk'),
                'stake_holder_login_id_pk'  => $this->session->userdata('stake_holder_login_id_pk'),
            )
        )
        ->from('council_stake_holder_login')
        ->get();

        return $query->result_array();
    }

    public function insertLoginLogDetails($insert_array)
	{
		$this->db->insert('council_stake_holder_login_password_change_log', $insert_array);
		return true;
	}
}

?>
