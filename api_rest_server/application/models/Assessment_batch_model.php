<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Assessment_batch_model extends CI_Model
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

    public function insertBatchData($table, $data)
    {
        $this->db->insert_batch($table, $data);

        return true;
    }

    public function getData($table, $condition)
    {
        $query = $this->db->get_where($table, $condition);
        $row   = $query->num_rows();

        return $query->result_array();
    }

    public function UpdateTpData($tp_id, $updateArray)
    {

        $this->db->where('assessment_tp_id_pk', $tp_id);

        if ($this->db->update('council_assessment_tp_institute_details', $updateArray)) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateTcData($tc_id, $updateArray)
    {

        $this->db->where('assessment_tc_id_pk', $tc_id);

        if ($this->db->update('council_assessment_tc_details', $updateArray)) {
            return true;
        } else {
            return false;
        }
    }

    public function UpdateTraineeData($trainee_id, $updateArray)
    {

        $this->db->where('assessment_trainee_id_pk', $trainee_id);

        if ($this->db->update('council_assessment_trainee_details', $updateArray)) {
            return true;
        } else {
            return false;
        }
    }

    public function successResponseDetails($batch_id)
    {

        $batch_details = $this->db->select("
            batch_details.vertical_code,
            batch_details.assessment_scheme_id_fk,
            batch_details.user_batch_id,
            batch_details.assessment_batch_id_pk,
            batch_details.process_id_fk,
            batch_details.entry_time,
            batch_details.course_name,
            batch_details.course_code,
            batch_details.sector_code,
            batch_details.sector_name,

            vertical_master.vertical_name,

            scheme_master.assessment_scheme_name,

            process.process_name,

            tc_details.council_tc_name,
            tc_details.council_tc_code,
            tc_details.user_tc_name,
            tc_details.user_tc_code,
            
            tp_details.council_tp_name,
            tp_details.council_tp_code,
            tp_details.user_tp_institute_name,
            tp_details.user_tp_institute_id,
        ")

            ->from("council_assessment_batch_details as batch_details")
            ->join("wbtetsd_vertical_master AS vertical_master", "vertical_master.vertical_code = batch_details.vertical_code", "LEFT")
            ->join("council_assessment_scheme_master AS scheme_master", "scheme_master.assessment_scheme_id_pk = batch_details.assessment_scheme_id_fk", "LEFT")
            ->join("council_assessment_tc_details AS tc_details", "tc_details.assessment_tc_id_pk = batch_details.assessment_tc_id_fk", "LEFT")
            ->join("council_assessment_tp_institute_details AS tp_details", "tp_details.assessment_tp_id_pk = tc_details.assessment_tp_id_fk", "LEFT")
            ->join("council_process_master AS process", "process.process_id_pk = batch_details.process_id_fk", "LEFT")
            ->where(
                array(
                    "assessment_batch_id_pk" => $batch_id
                )
            )
            ->get();

        $batch_details = $batch_details->result_array();

        $tranee_details = $this->db->select("user_trainee_id, council_trainee_code, trainee_full_name")
            ->where("assessment_batch_id_fk", $batch_id)
            ->get("council_assessment_trainee_details");

        $tranee_details = $tranee_details->result_array();

        return array(
            "batch_details"  => $batch_details[0],
            "tranee_details" => $tranee_details
        );
    }

    public function getBatchDetails($userBatchId = NULL, $councilBatchId = NULL)
    {
        $this->db->where('assessment_batch_id_pk', $councilBatchId);
        $this->db->where('user_batch_id', $userBatchId);
        return $this->db->get('council_assessment_batch_details')->result_array();
    }

    public function updateTraineeImageData($whereCondition = NULL, $insertImage = NULL)
    {
        $this->db->where('assessment_batch_id_fk', $whereCondition['assessment_batch_id_fk']);
        $this->db->where('user_trainee_id', $whereCondition['user_trainee_id']);

        if ($this->db->update('council_assessment_trainee_details', $insertImage)) {

            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	 public function updateTraineeDetails($whereCondition = NULL, $insertTraineeDetails = NULL)
    {
        $this->db->where('assessment_batch_id_fk', $whereCondition['assessment_batch_id_fk']);
        $this->db->where('user_trainee_id', $whereCondition['user_trainee_id']);

        if ($this->db->update('council_assessment_trainee_details', $insertTraineeDetails)) {

            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/* End of file Assessment_batch_model.php */
