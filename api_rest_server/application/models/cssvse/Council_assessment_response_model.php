<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Council_assessment_response_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_council_response_type($response_code = NULL)
    {
        $query = $this->db->select('council_response_message_id_pk, council_response_code, council_response_message')
            ->from('council_assessment_response_message_master')
            ->where(
                array(
                    'council_response_code'             => $response_code,
                    'active_status'                        => 1
                )
            )->get();
        return $query->result_array();
    }

    public function set_council_assessment_json_data($set_data = array())
    {
        if ($set_data != NULL) {
            $this->db->insert('council_cssvse_assessment_json_data', $set_data);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function get_previous_received_response($batch_code = NULL)
    {
        $query = $this->db->select('council_ass_batch_response_id_pk, user_batch_code')
            ->from('council_cssvse_assessment_batch_response')
            ->where(
                array(
                    'user_batch_code'                         => $batch_code,
                    'active_status'                            => 1
                )
            )->get();
        return $query->num_rows();
    }

    public function update_batch_response($batch_code = NULL, $update_array = NULL)
    {
        $this->db->where(
            array(
                'user_batch_code'            => $batch_code,
                'active_status'                => 1
            )
        );
        $this->db->update('council_cssvse_assessment_batch_response', $update_array);
        return $this->db->affected_rows();
    }

    public function set_council_assessment_batch_response($set_data = array())
    {
        if ($set_data != NULL) {
            $this->db->insert('council_cssvse_assessment_batch_response', $set_data);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function set_council_assessment_trainee_response($set_data = array())
    {
        if ($set_data != NULL) {
            $this->db->insert('council_cssvse_assessment_trainee_response', $set_data);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update_cssvse_batch_details($batch_code = NULL, $set_data = NULL)
    {
        $this->db->where(
            array(
                'user_batch_id'            => $batch_code,
                'active_status'             => 1
            )
        );
        $this->db->update('council_cssvse_batch_details', $set_data);
        return $this->db->affected_rows();
    }

    public function update_assessor_inactive($batch_code = NULL, $update_array = NULL)
    {
        $this->db->where(
            array(
                'user_batch_code'            => $batch_code,
                'active_status'                => 1
            )
        );
        $this->db->update('council_cssvse_assessment_assigned_assessor', $update_array);
        return $this->db->affected_rows();
    }

    public function set_council_assessor_assigned_response($set_data = array())
    {
        if ($set_data != NULL) {
            $this->db->insert('council_cssvse_assessment_assigned_assessor', $set_data);
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function get_already_received_response($batch_code = NULL, $flag_type = NULL)
    {
        $condition = array();
        if ($flag_type == 1)  // Batch Created
        {
            $condition = array(
                'user_batch_code'                         => $batch_code,
                'active_status'                            => 1,
                'flag_batch_created_ssc_assigned'        => NULL
            );
        } else if ($flag_type == 2) // Batch error
        {
            $condition = array(
                'user_batch_code'                         => $batch_code,
                'active_status'                            => 1,
                'flag_error_in_batch'                    => NULL
            );
        } else if ($flag_type == 3) // Assessor Assigned Response
        {
            $condition = array(
                'user_batch_code'                         => $batch_code,
                'active_status'                            => 1,
                'flag_assessor_assigned'                => NULL
            );
        } else if ($flag_type == 4) // Assessor Approved / Inability Response
        {
            $condition = array(
                'user_batch_code'                         => $batch_code,
                'active_status'                            => 1,
                'flag_assessor_accepted_inability'        => NULL
            );
        } else if ($flag_type == 5) // Assessment Completed Response
        {
            $condition = array(
                'user_batch_code'                         => $batch_code,
                'active_status'                            => 1,
                'flag_assessment_completed'                => 1
            );
        }
        $query = $this->db->select('council_ass_batch_response_id_pk, user_batch_code')
            ->from('council_cssvse_assessment_batch_response')
            ->where(
                $condition
            )
            ->get();
        return $query->num_rows();
    }
}
