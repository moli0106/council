<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_admin_model extends CI_Model
{

    public function getAcademicYearList(){
        $this->db->from('council_affiliation_academic_year_master')->where('active_status', 1);
        return $this->db->get()->result_array();
    }
    public function getAffiliationList($limit = NULL, $offset = NULL, $orderColumn, $orderType, $selected_year){


        $this->db->select('affiliation_details.basic_affiliation_id_pk,
        affiliation_details.affiliation_year,
        affiliation_details.affiliation_submit_status,
        affiliation_details.institute_code,
        affiliation_details.institute_name,
        affiliation_details.application_number,
        affiliation_details.final_submit_status,

        type.affiliation_type')
        ->from('council_polytechnic_institute_basic_affiliation_details AS affiliation_details')
        ->join('council_polytechnic_affiliation_type_master AS type', 'type.affiliation_type_id_pk = affiliation_details.affiliation_type_id_fk', 'left')
        ->where('affiliation_details.active_status', 1)
        //->where('cavd.final_submit_status', 1)
        ->where('affiliation_details.affiliation_year', $selected_year)
        // ->order_by('cavm.vtc_name')
        ->order_by('affiliation_details.institute_code')
        ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function getAffiliationListCount($selected_year)
    {
        return $this->db->select("count(basic_affiliation_id_pk)")
            ->from("council_polytechnic_institute_basic_affiliation_details")
            ->where('active_status', 1)
            //->where('final_submit_status', 1)
            ->where('affiliation_year', $selected_year)
            ->get()->result_array();
    }

    public function getAffiliationListBySearch($search, $selected_year)
    {
        $this->db->select('affiliation_details.basic_affiliation_id_pk,
            affiliation_details.affiliation_year,
            affiliation_details.affiliation_submit_status,
            affiliation_details.institute_code,
            affiliation_details.institute_name,
            affiliation_details.application_number,
            affiliation_details.final_submit_status,

            type.affiliation_type')
        ->from('council_polytechnic_institute_basic_affiliation_details AS affiliation_details')
        ->join('council_polytechnic_affiliation_type_master AS type', 'type.affiliation_type_id_pk = affiliation_details.affiliation_type_id_fk', 'left')
        ->where('affiliation_details.active_status', 1)
        //->where('cavd.final_submit_status', 1)
        // ->where("cavd.vtc_email LIKE '%$search%'")
        // ->like('cavd.vtc_email', $search, 'both')
        ->where('affiliation_details.institute_code',$search)
        ->where('affiliation_details.affiliation_year', $selected_year)
        // ->order_by('cavm.vtc_name')
        ->order_by('affiliation_details.institute_code')
        ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function gaetINSAffiliationDetailsById($id_hash){

        $this->db->select('afiiliation.*,
        affiliation_type.affiliation_type,
        category.category_name,
        state.state_name,
        district.district_name,
        subdiv.subdiv_name,
        ins_details.institute_email');
        $this->db->from('council_polytechnic_institute_basic_affiliation_details as afiiliation');
        $this->db->join('council_polytechnic_affiliation_type_master as affiliation_type','affiliation_type.affiliation_type_id_pk = afiiliation.affiliation_type_id_fk','LEFT');
        $this->db->join('council_polytechnic_institute_details as ins_details' , 'ins_details.vtc_id_fk = afiiliation.vtc_id_fk','LEFT');
        $this->db->join('council_state_master as state' , 'afiiliation.state_id_fk = state.state_id_pk','LEFT');
        $this->db->join('council_district_master as district' , 'afiiliation.district_id_fk = district.district_id_pk','LEFT');
        $this->db->join('council_subdiv_master as subdiv' , 'afiiliation.sub_divission_id_fk = subdiv.subdiv_id_pk','LEFT');
        $this->db->join('council_affiliation_institute_category_master as category' , 'category.institute_category_id_pk = afiiliation.institute_category_id_fk','LEFT');
        $this->db->where('afiiliation.active_status',1);
        $this->db->where("MD5(CAST(afiiliation.basic_affiliation_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    

}