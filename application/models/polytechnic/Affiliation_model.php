<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_model extends CI_Model
{

    public function getVtcDetailsByCode($vtcCode = NULL)
    {
        return $this->db->where('vtc_code', $vtcCode)->get('council_affiliation_vtc_master')->result_array();
    }

    public function insert_data($table,$data_array){
        $this->db->insert($table, $data_array);

        return $this->db->insert_id();
    }

    public function getInsDetailsByIdHash($id_hash)
    {
        $this->db->select('ins.*')
            ->from('council_polytechnic_institute_details AS ins')
            ->where("MD5(CAST(ins.vtc_id_fk as character varying)) =", $id_hash);
        return $this->db->get()->result_array();
    }


}
?>