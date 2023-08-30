<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Holiday_calendar_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllHoliday()
    {
        $query = $this->db->where(
            array(
                'active_status'  => 1
            )
        )
            ->get('council_holiday_calendar');

        return $query->result_array();
    }

    public function createHoliday($array = NULL)
    {
        $this->db->insert('council_holiday_calendar', $array);

        return $this->db->insert_id();
    }
}

/* End of file Map_district_model.php */
