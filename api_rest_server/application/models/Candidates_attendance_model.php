<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Candidates_attendance_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function insertAttendance($data)
    {
        if ($this->db->insert('council_assessment_trainee_attendance', $data)) {
            return $this->db->insert_id();
        } else {
            return False;
        }
    }

    public function updateAttendance($id, $data)
    {

        $this->db->where('attendance_id_pk', $id);

        $this->db->update('council_assessment_trainee_attendance', $data);

        return $this->db->affected_rows();
    }

    public function updateBatchDetails($id, $data)
    {

        $this->db->where('assessment_batch_id_pk', $id);

        $this->db->update('council_assessment_batch_details', $data);

        return $this->db->affected_rows();
    }

    public function getBatchDetails($user_batch_id)
    {
        $query = $this->db->get_where('council_assessment_batch_details', array('user_batch_id' => $user_batch_id));

        return $query->result_array();
    }

    public function getTraineeDetails($batch_id_fk, $user_trainee_id)
    {
        $this->db->where(
            array(
                'assessment_batch_id_fk' => $batch_id_fk,
                'user_trainee_id'        => $user_trainee_id
            )
        );

        $query = $this->db->get('council_assessment_trainee_details');

        return $query->result_array();
    }

    public function getTraineeAttendance($batch_id_fk, $trainee_id_fk)
    {
        $this->db->where(
            array(
                'assessment_batch_id_fk' => $batch_id_fk,
                'trainee_id_fk'          => $trainee_id_fk
            )
        );

        $query = $this->db->get('council_assessment_trainee_attendance');

        return $query->result_array();
    }
}

/* End of file Candidates_attendance_model.php */