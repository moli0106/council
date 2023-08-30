<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_trade_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getGroupTradeMasterCount()
    {
        return $this->db->select("count(group_trade_id_pk)")
            ->from("council_qbm_group_trade_master")
            ->where('active_status', 1)
            ->get()->result_array();
    }
    

    public function getGroupTradeList($limit = NULL, $offset = NULL)
    {
        $this->db->select('group_trade.group_trade_id_pk,group_trade.group_trade_name, group_trade.group_trade_code,course.course_name, disciplne.discipline_name');
        $this->db->from('council_qbm_group_trade_master AS group_trade');
        $this->db->join('council_qbm_course_master AS course', 'course.course_id_pk = group_trade.course_id_fk', 'LEFT');
        $this->db->join('council_qbm_disciplne_master AS disciplne', 'disciplne.discipline_id_pk = group_trade.discipline_id_fk', 'LEFT');
        $this->db->where("group_trade.active_status", 1);
        $this->db->order_by("group_trade.group_trade_name");
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function getCourseNameList()
    {
        $this->db->where("active_status", 1);
		$this->db->where_in("course_id_pk", array(1,2));
        $this->db->order_by("course_name");
        return $this->db->get('council_qbm_course_master')->result_array();
    }

    public function getDisciplineList($course_code = NULL)
    {
        $this->db->where("active_status", 1);
        $this->db->where("course_id_fk", $course_code);
        $this->db->order_by("discipline_name");
        return $this->db->get('council_qbm_disciplne_master')->result_array();
    }

    public function insertGroupTradeMaster($array)
    {
        $this->db->insert('council_qbm_group_trade_master', $array);

        return $this->db->insert_id();
    }







}

/* End of file Map_district_model.php */
