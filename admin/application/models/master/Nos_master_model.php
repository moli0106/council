<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nos_master_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getNosList()
    {
        return $this->db->where('active_status', 1)
            ->order_by('nos_name')
            ->get('council_nos_master')->result_array();
    }

    public function nosInsert($array = NULL)
    {
        $this->db->insert('council_nos_master', $array);

        return $this->db->insert_id();
    }

    public function deleteNosType($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(nos_id_pk as character varying)) =", $id_hash);
        $this->db->delete('council_nos_master');
    }

    public function updateNosType($id_hash = NULL, $updateArray)
    {
        $this->db->where("MD5(CAST(nos_id_pk as character varying)) =", $id_hash);
        $this->db->update('council_nos_master', $updateArray);

        return true;
    }
}
