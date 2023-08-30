<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poly_affiliation_model extends CI_Model
{
	public function getAllState(){
		$this->db->select('*');
		$this->db->from('council_state_master');
		$this->db->where('active_status',1);
		$this->db->where('state_id_pk',19);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

	public function getDistrictByStateId($state_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', $state_id)->order_by('district_name')->get('council_district_master')->result_array();
    }

    public function getSubDivisionByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('subdiv_name')
            ->get('council_subdiv_master')->result_array();
            // echo $this->db->last_query();exit;
    }

    public function getNodalOfficerByDistrictId($district_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district_id)->order_by('nodal_centre_name')
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getNodalOfficerByWhereInDistrictId($kolkataArray = NULL)
    {
        return $this->db->where('active_status', 1)->where_in('district_id_fk', $kolkataArray)->order_by('nodal_centre_name')
            ->get('council_nodal_officer_master')->result_array();
    }

    public function getMunicipalityByDivisionId($sub_division_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('subdiv_id_fk', $sub_division_id)->order_by('block_municipality_name')
            ->get('council_block_municipality_master')->result_array();
    }

    public function getInstituteDetailsById($ins_id){
        $this->db->select('*');
        $this->db->from('council_polytechnic_institute_details');
        $this->db->where('vtc_id_fk',$ins_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function getAffiliationType(){
        $this->db->select('*');
        $this->db->from('council_polytechnic_affiliation_type_master');
        $this->db->where('active_status',1);
        $this->db->order_by('affiliation_type');
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function insert_data($table,$data_array){
        $this->db->insert($table,$data_array);
        return $this->db->insert_id();
        //echo $this->db->last_query();exit;


    }

    public function getAffiliationTypeByID($affi_id){
        $this->db->select('affiliation_code');
        $this->db->from('council_polytechnic_affiliation_type_master');
        $this->db->where('active_status',1);
        $this->db->where('affiliation_type_id_pk',$affi_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
    public function update_data($table,$id = NULL, $updateArray = NULL)
    {
        $this->db->where('basic_affiliation_id_pk', $id);
        $this->db->update('council_polytechnic_institute_basic_affiliation_details', $updateArray);

        return $this->db->affected_rows();
    }

    public function checkAffiliation($affiliation_type,$affiliation_year,$ins_id){

        $this->db->select('affiliation_type_id_fk');
        $this->db->from('council_polytechnic_institute_basic_affiliation_details');
        $this->db->where('active_status',1);
        $this->db->where('affiliation_type_id_fk',$affiliation_type);
        $this->db->where('affiliation_year',$affiliation_year);
        $this->db->where('vtc_id_fk',$ins_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function gaetINSAffiliationDetailsById_old($id_hash){

        $this->db->select('afiiliation.*,affiliation_type.affiliation_type,category.category_name');
        $this->db->from('council_polytechnic_institute_basic_affiliation_details as afiiliation');
        $this->db->join('council_polytechnic_affiliation_type_master as affiliation_type','affiliation_type.affiliation_type_id_pk = afiiliation.affiliation_type_id_fk');
        $this->db->join('council_affiliation_institute_category_master as category' , 'category.institute_category_id_pk = afiiliation.institute_category_id_fk');
        $this->db->where('afiiliation.active_status',1);
        $this->db->where("MD5(CAST(afiiliation.basic_affiliation_id_pk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
	
	public function gaetINSAffiliationDetailsById($id_hash){

        $this->db->select('afiiliation.*,affiliation_type.affiliation_type,category.category_name,state.state_name,district.district_name,subdiv.subdiv_name');
        $this->db->from('council_polytechnic_institute_basic_affiliation_details as afiiliation');
        $this->db->join('council_polytechnic_affiliation_type_master as affiliation_type','affiliation_type.affiliation_type_id_pk = afiiliation.affiliation_type_id_fk','LEFT');
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

    public function getTeacherCountByBasicId($basic_id){
        $this->db->select('count(teacher_id_pk)');
        $this->db->from('council_polytechnic_institute_teacher_details');
        $this->db->where('basic_affiliation_id_fk',$basic_id);
		$this->db->where('active_status',1);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
    public function getIntakeCountByBasicId($basic_id){
        $this->db->select('count(intake_details_id_pk)');
        $this->db->from('council_polytechnic_institute_intake_details');
        $this->db->where('basic_affiliation_id_fk',$basic_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
    public function checkBasicDetails($basic_id){
        $this->db->select('basic_details_submited_status');
        $this->db->from('council_polytechnic_institute_basic_affiliation_details');
        $this->db->where('basic_affiliation_id_pk',$basic_id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
    public function getBranchNameByAffiliationId($affiliation_id,$affiliation_year){
        //check which discpipline exist
        $this->db->select('discipline_id_fk');
        $this->db->from('council_polytechnic_institute_intake_details');
        $this->db->where('affiliation_type_id_fk',$affiliation_id);
        $this->db->where('affiliation_year',$affiliation_year);
        $discipline = $this->db->get()->result_array();
        $disciplineArray = array();
        if(!empty($discipline)){
            foreach ($discipline as $key => $value) {
                array_push($disciplineArray, $value['discipline_id_fk']);
            }
        }

        $this->db->select('*');
        $this->db->from('council_polytechnic_affiliation_discipline_map');
        $this->db->where('affiliation_type_id_fk',$affiliation_id);
        if(!empty($disciplineArray)){
            $this->db->where_not_in('discipline_id_fk', $disciplineArray);
        }
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
	
	
    public function getBranchName($affiliation_id){
   
        $this->db->select('*');
        $this->db->from('council_polytechnic_affiliation_discipline_map');
        $this->db->where('affiliation_type_id_fk',$affiliation_id);
        
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
    public function getTeachersById($id_hash){
   
        $this->db->select('teacher.*,discipline.discipline_name');
        $this->db->from('council_polytechnic_institute_teacher_details as teacher');
        $this->db->join('council_qbm_discipline_master as discipline', 'discipline.discipline_id_pk = teacher.discipline_id_fk');
        $this->db->where('teacher.active_status',1);
        $this->db->where("MD5(CAST(teacher.basic_affiliation_id_fk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
    public function getIntakeById($id_hash){
   
        $this->db->select('intake.*,discipline.discipline_name');
        $this->db->from('council_polytechnic_institute_intake_details as intake');
        $this->db->join('council_qbm_discipline_master as discipline', 'discipline.discipline_id_pk = intake.discipline_id_fk');
        $this->db->where('intake.active_status',1);
        $this->db->where("MD5(CAST(intake.basic_affiliation_id_fk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    // ADDED by AMIT on 10-07-2023
    public function getDepartment($affiliation_type_id_fk){
        $this->db->distinct();
        $this->db->select('c2.discipline_id_pk,c2.discipline_name');
        $this->db->from('council_institute_qbm_discipline_map as c1');
        $this->db->join('council_qbm_discipline_master as c2','c1.discipline_id_fk=c2.discipline_id_pk','INNER JOIN');
        $this->db->where('c1.exam_type_id_fk',$affiliation_type_id_fk);
        return $this->db->get()->result_array();
    }

    public function fetch_data($table,$arr){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($arr);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }


    public function fetch_all_data($table,$arr){
        $this->db->select('c1.*,c2.discipline_name');
        $this->db->from($table);
        $this->db->join('council_qbm_discipline_master as c2','c1.discipline_id_fk=c2.discipline_id_pk','INNER JOIN');
        $this->db->where($arr);
		//$this->db->where('active_status',1);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }


    public function delete_function($table,$arr){
        //print_r($arr);die;
        $this->db->where($arr);
       // return $this->db->delete($table);
       $this->db->update($table, array('active_status' => 0));

       return $this->db->affected_rows();
    }
	
	public function delete_details($table,$arr){
        //print_r($arr);die;
        $this->db->where($arr);
       return $this->db->delete($table);
       
    }

    public function mandory_master(){
        $this->db->select('*');
        $this->db->from("council_polytechnic_affiliation_mandatory_requirements_master");
        $this->db->where('active_status',1);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function fetch_mandory_data($id){
        $this->db->select('c1.availability,c1.size,c2.facilities_name,c1.fc_id_fk');
        $this->db->from("council_polytechnic_affiliation_mandatory_requirements as c1");
         $this->db->join("council_polytechnic_affiliation_mandatory_requirements_master as c2","c1.fc_id_fk=c2.fc_id_pk","INNER JOIN");
        $this->db->where('c1.basic_affiliation_id_fk',$id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }


    public function check_validation($id){
      return $this->db->query("SELECT COUNT
        ( DISTINCT c1.basic_affiliation_id_fk ) AS room_intake,
        COUNT ( DISTINCT c2.basic_affiliation_id_fk ) AS lab_intake,
        COUNT ( DISTINCT c3.basic_affiliation_id_fk ) AS library_intake 
        FROM
        council_polytechnic_affiliation_class_room_intake AS c1
        INNER JOIN council_polytechnic_affiliation_lab_details AS c2 ON c1.basic_affiliation_id_fk = c2.basic_affiliation_id_fk
        INNER JOIN council_polytechnic_affiliation_library_details AS c3 ON c2.basic_affiliation_id_fk = c3.basic_affiliation_id_fk
        WHERE c1.active_status=1 and c2.active_status=1 and c3.active_status=1 and c1.basic_affiliation_id_fk=$id AND c2.basic_affiliation_id_fk=$id AND c3.basic_affiliation_id_fk=$id")->result_array();
    }

    public function check_validation_new($id){
		
    return $this->db->query("SELECT COUNT
        ( DISTINCT c1.basic_affiliation_id_fk ) AS room_intake,
        COUNT ( DISTINCT c2.basic_affiliation_id_fk ) AS lab_intake,
        COUNT ( DISTINCT c3.basic_affiliation_id_fk ) AS library_intake,
        COUNT ( DISTINCT c4.basic_affiliation_id_fk ) AS fees_intake  
        FROM
        council_affiliation_class_room_intake AS c1
        INNER JOIN council_affiliation_lab_details AS c2 ON c1.basic_affiliation_id_fk = c2.basic_affiliation_id_fk
        INNER JOIN council_affiliation_library_details AS c3 ON c2.basic_affiliation_id_fk = c3.basic_affiliation_id_fk
        INNER JOIN council_polytechnic_affiliation_fees_structure AS c4 ON c3.basic_affiliation_id_fk = c4.basic_affiliation_id_fk
        WHERE c1.active_status=1 and c2.active_status=1 and c3.active_status=1 and c1.basic_affiliation_id_fk=$id AND c2.basic_affiliation_id_fk=$id AND c3.basic_affiliation_id_fk=$id AND c4.basic_affiliation_id_fk=$id")->result_array();
    }

    public function insert_data_batch($table,$data_array){

        $query = $this->db->insert_batch($table,$data_array);
        return $query;  

    }

    public function getAffiliationList($id){
       
        $this->db->select('
        basic_details.basic_affiliation_id_pk,
        basic_details.affiliation_year,
        basic_details.affiliation_submit_status,
        basic_details.basic_details_submited_status,
        basic_details.infrastructure_fees_submited_status,
        basic_details.doc_uploaded_status,
        basic_details.intake_submited_status,
        basic_details.affiliation_type_id_fk,
        basic_details.application_number,
		basic_details.final_submit_status,
		basic_details.institute_category_id_fk,
        type.affiliation_type
        ');
        $this->db->from('council_polytechnic_institute_basic_affiliation_details as basic_details');
        $this->db->join('council_polytechnic_affiliation_type_master as type', 'basic_details.affiliation_type_id_fk = type.affiliation_type_id_pk');
        $this->db->where('basic_details.active_status',1);
		$this->db->where('basic_details.vtc_id_fk',$id);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
	
	public function getPaymentStatus_old($id_hash){

        $this->db->select('payment.response_status,payment.transaction_id');
        $this->db->from('council_polytechnic_affiliation_payment as payment');
        $this->db->where("MD5(CAST(payment.basic_affiliation_id_fk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
	public function getPaymentStatus($id_hash){

        $this->db->select('payment.response_status,payment.transaction_id,payment.posting_amount,payment.sending_time');
        $this->db->from('council_polytechnic_affiliation_payment as payment');
        $this->db->where('payment.response_status',1);
        $this->db->where("MD5(CAST(payment.basic_affiliation_id_fk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }
	
	public function fetch_poly_fees_data($id,$affiliation_type){
        $this->db->select('*');
        $this->db->from("council_polytechnic_affiliation_fees_structure as c1");
        $this->db->where('c1.basic_affiliation_id_fk',$id);
        $this->db->where('c1.affiliation_type_id_fk',$affiliation_type);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
	
	public function get_transaction_history($institute_id_fk,$id_hash){
		
		$this->db->select('transaction_id,posting_amount,sending_time');
        $this->db->from("council_polytechnic_affiliation_payment");
		$this->db->where('institute_id_fk',$institute_id_fk);
		$this->db->where("MD5(CAST(basic_affiliation_id_fk as character varying)) =", $id_hash);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
	}

 


}