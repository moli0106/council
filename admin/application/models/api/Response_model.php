<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Response_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getUnsuccessfulResponse_OLD()
    {
        $this->db->select('AJD.*, ARMM.council_response_message, ARSM.result_status_name');
        $this->db->from('council_assessment_batch_details AS batch');
        $this->db->join('council_assessment_json_data AS AJD', 'AJD.user_batch_code = batch.user_batch_id', 'left');
        $this->db->join('council_assessment_response_message_master AS ARMM', 'ARMM.council_response_message_id_pk = AJD.council_response_message_id_fk', 'left');
        $this->db->join('council_assessment_result_status_master AS ARSM', 'ARSM.result_status_id_pk = AJD.json_data_type_id_fk', 'left');

        $this->db->where('batch.assessment_scheme_id_fk', 3);
        $this->db->where('AJD.council_response_message_id_fk', 4);
        $this->db->where('AJD.response_status', 0);

        return $this->db->get()->result_array();
    }

    public function getUnsuccessfulResponse()
    {
        $this->db->select('AJD.*, ARMM.council_response_message, ARSM.result_status_name');
        $this->db->from('council_assessment_json_data AS AJD');
        $this->db->join('council_assessment_response_message_master AS ARMM', 'ARMM.council_response_message_id_pk = AJD.council_response_message_id_fk', 'left');
        $this->db->join('council_assessment_result_status_master AS ARSM', 'ARSM.result_status_id_pk = AJD.json_data_type_id_fk', 'left');

        $this->db->where('AJD.response_status', 0);

        return $this->db->get()->result_array();
    }

    public function getResponseDetailsById($id_hash = NULL)
    {

        $this->db->where("MD5(CAST(council_json_data_id_pk as character varying)) =", $id_hash);

        return $this->db->get('council_assessment_json_data')->result_array();
    }

    public function updateAssessmentjsonData($id, $array)
    {
        $this->db->where(
            array(
                'council_json_data_id_pk' => $id
            )
        )
            ->update('council_assessment_json_data', $array);
        return $this->db->affected_rows();
    }
}
