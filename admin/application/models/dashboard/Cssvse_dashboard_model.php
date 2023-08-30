<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cssvse_dashboard_model extends CI_Model
{

    public function countStudentList($school_reg_id = NULL)
    {
        return $this->db->select("COUNT(student.student_id_pk)")->from("council_cssvse_student_master AS student")
            ->join("council_cssvse_school_registration AS school_reg", "school_reg.udise_code = student.udise_code", "left")
            ->where("school_reg.school_reg_id_pk", $school_reg_id)
            ->where("school_reg.active_status", 1)
            ->get()->result_array();
    }

    public function countBatchList($school_reg_id = NULL)
    {
        return $this->db->select("COUNT(batch.batch_id_pk)")->from("council_cssvse_batch_details AS batch")
            ->where("batch.school_reg_id_fk", $school_reg_id)
            ->get()->result_array();
    }
}
