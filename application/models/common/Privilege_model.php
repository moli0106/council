<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Privilege_model extends CI_Model {

	public function stake_privilege() {
		//return $login_id . $password;
		$this->load->driver('cache', array('adapter' => 'file'));
		
		$privilege_for =$this->session->userdata('stake_id_fk');
		
		if(!$privilege_data = $this->cache->get('elearning/privilege/privilege_'.$privilege_for.'.json')){
			$query = $this->db->select('shm.stake_id_pk,shm.stake_details, shp.elearning_privilege_id_pk, shp.parent_stake_holder_privilege_id, shp.privilege_page,shp.stake_holders_privilege_details,shp.icon,shp.menu_status')
				->from('elearning_stake_holder_master AS shm')
				->join('elearning_admin_privilege_map AS apm', 'shm.stake_id_pk = apm.stake_id_fk', 'right')
				->join('elearning_stake_holder_privilege AS shp', 'apm.elearning_privilege_id_fk = shp.elearning_privilege_id_pk', 'left')
				->where(
					array(
						'shm.stake_id_pk' => $privilege_for,
						'apm.active_status' => 1,
						'apm.active_status' => 1,
						'shp.active_status' => 1,
						//'shp.show_menu_payment' => 1
					)
				)
				->order_by('sort_order asc')
				->get();
			$privilege_data = $query->result_array();
			$this->cache->save('elearning/privilege/privilege_'.$privilege_for.'.json',$privilege_data, $this->config->item('privilege_store_time'));
		}
		return $privilege_data;
	}
}
