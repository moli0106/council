<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Master_model extends CI_Model {
	
	function get_gender(){
		$query = $this->db->select('*')
			->from('elearning_gender_master')
			->get();
		return $query->result_array();
	}
	
	
	/*
		function related to elearning module begins from here...
	*/

	function getDegrees()
	{
		$query = $this->db->select("code
		,degree_name")
		->from("elearning_degree_code_master")
		->get();
		return $query->result();
	}

	function getCourses($degree_id)
	{
		$query = $this->db->select("course_name
		,course_id")
		->from("elearning_course_code_master")
		->where("degree_code",$degree_id)
		->get();
		return $query->result();
	}

	function getSubject($course_id)
	{
		$query = $this->db->select("subject_name
		,subject_id")
		->from("elearning_subject_code_master")
		->where("course_id",$course_id)
		->get();
		return $query->result();
	}

	/*
		function related to elearning module begins from here...
	*/
	
	
	
	function get_geligion(){
		$query = $this->db->select('*')
			->from('pbssd_religion_master')
			->where(
				array('active_status' => 1)
			)
			->get();
		return $query->result_array();
	}
	function get_caste(){
		$query = $this->db->select('*')
			->from('pbssd_caste_master')
			->where(
				array('active_status' => 1)
			)
			->get();
		return $query->result_array();
	}
	function get_maritial_status(){
		$query = $this->db->select('*')
			->from('pbssd_maritial_status_master')
			->where(
				array('active_status' => 1)
			)
			->get();
		return $query->result_array();
	}
	function get_financial_year(){
		$query = $this->db->select('*')
			->from('pbssd_financial_year_master')
			->where(
				array('active_status' => 1)
			)
			->get();
		return $query->result_array();
	}
	function get_state($state=NULL)
	{
		$condition=array();
		if($state!=NULL)
		{
			$condition = array(
								'state_id_pk'	=> $state,
								'active_status' => 1
							);
		}
		else
		{
			$condition = array(
								'active_status' => 1
							);
		}
		$query = $this->db->select('*')
			->from('pbssd_state_master')
			->where(
				$condition
			)
			->order_by('state_name') // Added By Waseem 0n 05-10-2018
			->get();
		return $query->result_array();
	}
	function get_district(){
		$query = $this->db->select('*')
			->from('pbssd_district_master')
			->where(
				array('active_status' => 1)
			)
			->order_by('district_name')
			->get();
		return $query->result_array();
	}
	function get_district_state_wide($state_id_pk = NULL){
		$query = $this->db->select('*')
			->from('pbssd_district_master')
			->where(
				array(
					'active_status' => 1,
					'state_id_fk' => $state_id_pk
				)
			)
			->order_by('district_name')
			->get();
		return $query->result_array();
	}
	
	function get_block_muni($district_id = NULL){
		$query = $this->db->select('*')
			->from('pbssd_block_municipality_master')
			->where(
				array(
				'active_status' => 1,
				'district_id_fk' => $district_id
				)
			)
			->order_by('block_municipality_name')
			->get();
		return $query->result_array();
	}
	function get_subdiv($district_id = NULL){
		$query = $this->db->select('*')
			->from('pbssd_subdiv_master')
			->where(
				array(
				'active_status' => 1,
				'district_id_fk' => $district_id
				)
			)
			->order_by('subdiv_name')
			->get();
		return $query->result_array();
	}
	function get_educational_qual(){
		$query = $this->db->select('*')
			->from('pbssd_educational_quali_master')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_building_type(){
		$query = $this->db->select('*')
			->from('pbssd_building_type')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_project_status(){
		$query = $this->db->select('*')
			->from('pbssd_project_status_master')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_teaching_board_types(){
		$query = $this->db->select('*')
			->from('pbssd_board_type_master')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_sitting_management(){
		$query = $this->db->select('*')
			->from('pbssd_sitting_management_master')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_fire_extinguisher_status(){
		$query = $this->db->select('*')
			->from('pbssd_fire_extinguisher_status')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_educational_quali_status(){
		$query = $this->db->select('*')
			->from('pbssd_educational_quali_status_master')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	
	function get_employment_status(){
		$query = $this->db->select('*')
			->from('pbssd_employment_status_master')
			->where(
				array(
				'active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	
	function get_tc_course($centre_id_pk = NULL){
		$query = $this->db->select('*,cm.course_code as crsecode')
			->from('pbssd_course_master as cm')
			->join('pbssd_training_centre_course_map as tccm','cm.course_id_pk = tccm.course_id_fk')
			->join('pbssd_centre_reg_details as crd','crd.centre_id_pk = tccm.training_centre_id_fk')
			->where(
				array(
				'crd.centre_id_pk' => $centre_id_pk,
				'cm.active_status' => 1
				)
			)
			->get();
		return $query->result_array();
	}
	function get_course_details($course_id_pk = NULL)
	{
		$query = $this->db->select('*')
						  ->from('pbssd_course_master as course')
						  ->join('pbssd_sector_master as sector','course.sector_id_fk=sector.sector_id_pk','left')
						  ->where(
						  		array(
						  			'course.course_id_pk'	=> $course_id_pk,
						  			'course.active_status'	=> 1,
						  			'sector.active_status'  => 1
						  		)
						  )->get();
		return $query->result_array();
	}
	function get_designation()
	{
		$query = $this->db->select('*')
			->from('pbssd_designation_master')
			->where(
				array(
					'active_status' => 1,
				)
			)
			->get();
		return $query->result_array();
	}
	function get_sector()
	{
		$query = $this->db->select('*')
			->from('pbssd_sector_master')
			->where(
				array(
					'active_status' => 1,
				)
			)
			->order_by('sector_name','asc')
			->get();
		return $query->result_array();
	}

	function get_bank_names(){
		$query = $this->db->select('distinct(bank_name)')
			->from('pbssd_bank_master')
			->order_by('bank_name','asc')
			->where(
				array(
					'bank_name !=' => NULL,
					'bank_name !=' => '',
					'branch !=' => '',
				)
			)
			->get();
		return $query->result_array();
	}
	function get_bank_branch_names($bank_name = NULL){
		$parm=urldecode($bank_name);
		$query = $this->db->select('distinct(branch),bank_name,*')
			->from('pbssd_bank_master')
			->order_by('branch','asc')
			->where(
				array(
					'bank_name like' => '%'.$parm.'%',
					'branch !=' => '',
				)
			)
			->get();		
		return $query->result_array();
	}
	
	function get_ifsc($bank_name = NULL, $branch=NULL){
		$parm1=urldecode($bank_name);
		$parm2=urldecode($branch);
		$query = $this->db->select('bank_ifsc')
			->from('pbssd_bank_master')
			->order_by('branch','asc')
			->where(
				array(
					'bank_name like' => '%'.$parm1.'%',
					'branch like' => '%'.$parm2.'%',
				)
			)
		
			->get();
		$store=$query->row_object();
		return $store->bank_ifsc;
	}
	function get_inspectors(){
		$query = $this->db->select('*')
			->from('pbssd_inspector_registration_details')
			->where(
				array(
					'process_status_id_fk'  => 5,
					'active_status'			=> 1
				)	
			)
			->get();
		return $query->result_array();
	}
	function get_training_partner(){
		$query = $this->db->select('*')
			->from('pbssd_training_partner_registration_details')
			->where(
				array(
					'process_status_id_fk'  => 45,
					'active_status'			=> 1
				)	
			)
			->order_by('training_partner_organization_name','asc')
			->get();
		return $query->result_array();
	}
	function get_training_partner_by_id($id=NULL)
	{
		$query = $this->db->select('*')
			->from('pbssd_training_partner_registration_details')
			->where('training_partner_id_pk', $id)
			->order_by('training_partner_organization_name','asc')
			->get();
		return $query->result_array();
	}
	/********************* edited by jit on 06-09-2018 join with district master for TC ENTRY***********************/
	function get_training_center($partner_id=NULL)
	{
		$query = $this->db->select('*,pbssd_district_master.district_name')
			->from('pbssd_centre_reg_details')
			->join('pbssd_district_master','pbssd_centre_reg_details.centre_district_id_fk=pbssd_district_master.district_id_pk','LEFT')
			->where(
				array(
					'training_partner_id_fk =' => base64_decode($partner_id)
				)
			)
			->order_by('centre_name','asc')
			->get();
		return $query->result_array();	
	}
	
	/************** These value is coming from DB of view pbssd_sector_course_tp_tc_map_data ***************/
	function get_maped_sector()
	{
		$query = $this->db->select('sector.sector_id_pk,sector.sector_name')
			->from('pbssd_sector_course_tp_tc_map_data as sector')
			->distinct('sector.sector_id_pk')
			->order_by('sector.sector_name')
			->get();
			//echo $query;die;
		return $query->result_array();
	}
	
	/************** These value is coming from DB of view pbssd_sector_course_tp_tc_map_data ***************/
	function get_maped_course($sector_id = NULL)
	{
		$query = $this->db->select('course.course_code,course.course_name,course.course_id_pk')
			->from('pbssd_sector_course_tp_tc_map_data as course')
			->where(
				array(
				'course.sector_id_pk' => $sector_id
				)
			)
			->distinct('course.course_id_pk')
			->order_by('course.course_name')
			->get();
			//echo $query;die;
		return $query->result_array();
	}
	
	/************** These value is coming from DB of view pbssd_sector_course_tp_tc_map_data ***************/
	function get_maped_tp_list($course_id = NULL)
	{
		$query = $this->db->select('training_partner_organization_name, training_partner_code,training_partner_id_pk')
			->from('pbssd_sector_course_tp_tc_map_data')
			->where(
				array(
				'course_id_pk' => $course_id
				)
			)
			->distinct('training_partner_id_pk')
			->order_by('training_partner_organization_name')
			->get();
		return $query->result_array();
	}
	
	/************** These value is coming from DB of view pbssd_sector_course_tp_tc_map_data ***************/
	function get_maped_tc_list($training_partner_id = NULL)
	{
		$query = $this->db->select('centre_name, centre_code,centre_id_pk')
			->from('pbssd_sector_course_tp_tc_map_data')
			->where(
				array(
				'training_partner_id_pk' => $training_partner_id
				)
			)
			->distinct('centre_id_pk')
			->order_by('centre_name')
			->get();
		return $query->result_array();
	}
	
	// return the status of the Training Centre of having other menu than Profile untill Inspection Done
	function tc_active_inactive_status()
	{
		$query = $this->db->select('process_status_id_fk, active_status')
						->from('pbssd_centre_reg_details')
						->where(
								array(
									'centre_id_pk'		=>  $this->session->userdata('stake_details_id_fk')
								)
							)
						->get();
		$result = $query->result_array();
		if($result[0]['process_status_id_fk']==5)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	function get_council_list(){
		$query = $this->db->select('*')
			->from('pbssd_councils_master')
			->get();
		return $query->result_array();
	}
	function get_batch_time_slot()
	{
		$query=$this->db->select('time_slot.batch_time_slot_id_pk,time_slot.batch_time_slot')
						->from('pbssd_batch_time_slot_master as time_slot')
						->where(
							array(
									'time_slot.active_status' => 1							
								)
							)
							->get();
		return $query->result_array();
	}
	function get_salutation()
	{
		$query = $this->db->select('*')
			->from('pbssd_salutation_master')
			->get();
		return $query->result_array();
	}
	function get_guardian_type()
	{
		$query = $this->db->select('*')
			->from('pbssd_guardian_type_master')
			->get();
		return $query->result_array();
	}
	
	function check_exist_trainee_code($code=NULL) // check trainee code if exists in db for new trainee code
	{
		$query=$this->db->select('trainee_code, trainee_id_pk')
						->from('pbssd_trainee_registration_details')
						->where('trainee_code',$code)
						->get();
		$no_of_rows=$query->num_rows();		
		if($no_of_rows==0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_month_details()
	{
		$query = $this->db->select('*')
			->from('pbssd_month_master')
			->get();
		return $query->result_array();
	}
	
	/* Added By Koustabh 03/09/2018 to get Entity Type By training partner id starts */
	function get_entity_by_training_partner($tp_id)
	{
		$entities = $this->db->select('training_partner.entity_type_id_fk,entity.entity_name')
							 ->from('pbssd_training_partner_registration_details as training_partner')
							 ->join('pbssd_entity_type_master as entity','training_partner.entity_type_id_fk = entity.entity_type_id_pk','left')
							 ->where(
							 	  array(
							 			'training_partner.training_partner_id_pk' => $tp_id
									)
							 )	
							 ->get();
		return $entities->result_array();
	}
	/* Added By Koustabh 03/09/2018 to get Entity Type By training partner id ends */
	
	/* Added By Koustabh 06/09/2018 to get Entity Type starts */
	function get_entity_dtls()
	{
		$query = $this->db->select('*')
			->from('pbssd_entity_type_master')
			->where('active_status',1)
			->order_by('entity_name')
			->get();
		return $query->result_array();
	}
	
	/* Added By Koustabh 06/09/2018 to get Entity Type endss */
	
	/*Added By rakesh 05-09-2018 */
	function get_sector_type()
	{
		$query = $this->db->select('*')
			->from('pbssd_project_type_master')
			->where('active_status', 1)
			->get();
		return $query->result_array();
	}
	function get_process_status_dtls()
	{
		$query = $this->db->select('*')
			->from('pbssd_process_master')
			->where('active_status', 1)
			->order_by('process_name')
			->get();
		return $query->result_array();
	}
	function get_training_type_details()
	{
		$query = $this->db->select('*')
			->from('pbssd_training_type')
			->where('active_status', 1)
			->order_by('training_type_name')
			->get();
		return $query->result_array();
	}
	/*Added By rakesh 05-09-2018 End*/
	
}