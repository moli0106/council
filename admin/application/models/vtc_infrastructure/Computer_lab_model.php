<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Computer_lab_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_id_pk', $vtc_id)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getComputerLabDetails($vtc_id = NULL, $academic_year){
        $this->db->select('*')
            ->from('council_affiliation_vtc_computer_lab')
            ->where(
                array(
                    'active_status'     =>1,
                    'vtc_id_fk'         =>$vtc_id,
                    'academic_year'     =>$academic_year
                )
            );
        $query = $this->db->get()->row_array();

        if (!empty($query)) {
            return $query;
        } else {
            return array();
        }     
    }

    public function insertData($postData){
        $this->db->insert('council_affiliation_vtc_computer_lab', $postData);
        return $this->db->insert_id();
    }

    public function updateData($updateArray,$lab_id_hash){
       
        $this->db->where(
            array(
               'vtc_computer_lab_id_pk' => $lab_id_hash
            )
        )
            ->update('council_affiliation_vtc_computer_lab', $updateArray);
        return $this->db->affected_rows();
    }
}