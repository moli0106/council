<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_preintimation_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertData($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    public function getData($table, $condition)
    {
        $query = $this->db->get_where($table, $condition);
        $row   = $query->num_rows();

        return $query->result_array();
    }
}

/* End of file Assessment_preintimation_model.php */
