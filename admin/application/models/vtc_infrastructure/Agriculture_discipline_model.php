<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agriculture_discipline_model extends CI_Model
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

    public function getVtcDiscipline($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_course_selection')->result_array();
        // echo "<pre>";print_r($query);exit;

        if(!empty($query)){

            // $hs_voc_discipline= explode(",",$query[0]['hs_voc_discipline']);
        

            // $stc_discipline= explode(",",$query[0]['stc_discipline']);

            // $disciplineArray = array_unique(array_merge($hs_voc_discipline,$stc_discipline));

            $disciplineArray = array();
            foreach ($query as $key => $value) {
                array_push($disciplineArray, $value['discipline_id_fk']);
            }

            // ! get Agriculture Discipline is exist or not

            
            if( in_array( "2" ,$disciplineArray ) )
            {
                $agriculture = 'yes';
            }else{
                $agriculture = 'no';
            }

            return $agriculture;
            
        }else{
            return $agriculture ='';
        }

        
    }

    public function getAgriDisciplineDetails($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('*')
            ->from('council_affiliation_vtc_agri_discipline')
            ->where(
                array(
                    'active_status' => 1,
                    'vtc_id_fk'     => $vtc_id,
                    'academic_year' => $academic_year
                )
            );
        
        $query = $this->db->get()->result_array();
        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
        
    }

    public function insertData($dataArray){

        $this->db->insert('council_affiliation_vtc_agri_discipline', $dataArray);

       
        return $this->db->insert_id();
    }

    public function updateData($updateArray = NULL,$id_hash = NULL)
    {
        $this->db->where("MD5(CAST(vtc_agri_discipline_id_pk as character varying)) =", $id_hash);
        $this->db->update('council_affiliation_vtc_agri_discipline', $updateArray);
        return $this->db->affected_rows();
    }
}