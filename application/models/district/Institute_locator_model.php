<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Institute_locator_model extends CI_Model {
	
	public function get_dist_data($id= NULL){
        $query = $this->db->select("*")
            ->from("council_vocational_training_centres_new")
            ->where(
                array(
                    "district_id_fk" => $id
                )
            )
            ->order_by("institute_name","asc")
        ->get();
        return $query->result_array();
    }
	
	public function get_dist($state_id = 19){
		$query = $this->db->select("*")
			->from("council_district_master")
			->where("state_id_fk",$state_id)
			//->where("active_status",1)
			->order_by("district_name","ASC")
		->get();
        return $query->result_array();
	}
}
