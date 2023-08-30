<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Map_district_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllDistrict($id = NULL, $districtArray = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_district_master")
            ->where(
                array(
                    'state_id_fk'   => 19,
                    'active_status' => 1
                )
            );

        if ($id != NULL) {
            $query = $query->where('district_id_pk !=', $id);
        }

        if ($districtArray != NULL) {
            $query = $query->where_not_in('district_id_pk', $districtArray);
        }

        $query = $query->order_by('district_name', 'ASC')
            ->get();

        return $query->result_array();
    }

    public function getMappedDistrict()
    {
        $query = $this->db->select("map.priority, map.district_map_id_pk, map.district_id_fk, district_map.district_name, district_main.district_name AS district_name_main")
            ->from("council_assessment_district_map AS map")
            ->join('council_district_master AS district_map', 'district_map.district_id_pk = map.district_map_id_fk', 'LEFT')
            ->join('council_district_master AS district_main', 'district_main.district_id_pk = map.district_id_fk', 'LEFT')
            ->where(
                array(
                    'map.active_status'  => 1
                )
            )
            ->order_by('district_name_main, priority')
            ->get();

        return $query->result_array();
    }

    public function getMappedDistrictByDistrictId($id = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_assessment_district_map")
            ->where(
                array(
                    'district_id_fk' => $id,
                    'active_status'  => 1
                )
            )
            ->get();

        return $query->result_array();
    }

    public function batchInsert($array = NULL)
    {

        $this->db->insert_batch('council_assessment_district_map', $array);

        return true;
    }

    public function checkPriority($district_id_fk = NULL, $priority = NULL)
    {
        $this->db->where('district_id_fk', $district_id_fk);
        $this->db->where('priority', $priority);
        return $this->db->get('council_assessment_district_map')->result_array();
    }

    public function insertMapDistrict($array = NULL)
    {
        $this->db->insert('council_assessment_district_map', $array);
        return $this->db->insert_id();
    }
}

/* End of file Map_district_model.php */
