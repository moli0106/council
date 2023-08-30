<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nodal_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getNodalOfficerCount()
    {
        return $this->db->select("count(nodal_officer_id_pk)")
            ->where('active_status', 1)
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getNodalOfficerList($limit = NULL, $offset = NULL)
    {
        $this->db->select('nodal.*, district.district_name');
        $this->db->from('council_nodal_officer_master AS nodal');
        $this->db->join('council_district_master AS district', 'district.district_id_pk = nodal.district_id_fk', 'LEFT');
        $this->db->where("nodal.active_status", 1);
        $this->db->order_by("district.district_name");
        $this->db->order_by("nodal.nodal_centre_name");
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function getdistrictList()
    {
        $this->db->where("state_id_fk", 19);
        $this->db->where("active_status", 1);
        $this->db->order_by("district_name");
        return $this->db->get('council_district_master')->result_array();
    }

    public function insertNodalOfficer($array)
    {
        $this->db->insert('council_nodal_officer_master', $array);

        return $this->db->insert_id();
    }

    public function getNodalOfficerByIdHash($id_hash = NULL)
    {
        $this->db->where("MD5(CAST(nodal_officer_id_pk as character varying)) =", $id_hash);
        return $this->db->get('council_nodal_officer_master')->result_array();
    }

    public function updateNodalOfficer($id_hash = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(nodal_officer_id_pk as character varying)) =", $id_hash);

        $this->db->update('council_nodal_officer_master', $updateArray);

        return $this->db->affected_rows();
    }
}

/* End of file Map_district_model.php */
