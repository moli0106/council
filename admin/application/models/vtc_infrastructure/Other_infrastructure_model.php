<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Other_infrastructure_model extends CI_Model
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

    public function getOtherInfarstructureDetails($vtc_id = NULL,$academic_year){

        $this->db->select('other_infrastructure.*')
            ->from('council_affiliation_vtc_other_infrastructure_details as other_infrastructure')
            // ->join('council_affiliation_connection_type_master as connection_type', 'connection_type.connection_type_id_pk = other_infrastructure.connection_type_id_fk')
            ->where('other_infrastructure.vtc_id_fk', $vtc_id)
            ->where('other_infrastructure.academic_year', $academic_year)
            ->where('other_infrastructure.active_status', 1);
       $query = $this->db->get()->result_array();
        foreach ($query as $key => $value) {
            $connection_type_id = $value['connection_type_id_fk'];
            if($connection_type_id!=''){

                $type_name = $this->db->where('active_status', 1)
                            ->where('connection_type_id_pk', $connection_type_id)
                           ->get('council_affiliation_connection_type_master')->row_array();
                $connection_type_name = $type_name['connection_type_name'];
            }else{
                $connection_type_name = '';
            }
            $query[$key]['connection_type_name'] = $connection_type_name;
        }

       if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function insertData($post_data){
        $this->db->insert('council_affiliation_vtc_other_infrastructure_details', $post_data);

        return $this->db->insert_id();
    }

    public function updateData($updateArray,$id){
       
        $this->db->where(
            array(
               'vtc_other_infrastructure_details_id_pk' => $id
            )
        )
            ->update('council_affiliation_vtc_other_infrastructure_details', $updateArray);
        return $this->db->affected_rows();
    }
}