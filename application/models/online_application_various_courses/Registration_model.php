<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registration_model extends CI_Model
{

	public Function get_duplicate(){
		$this->db->select('student_details_id_pk,application_form_no')
		->from('council_polytechnic_spotcouncil_student_details')
		->where('duplicate_flag',1)
		->where("active_status", 1);
		$query=$this->db->get()->result_array();
		return $query;
	}

	public function get_gender()
	{
		$query = $this->db->select("*")
			->from("council_gender_master")
			// ->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_nationality()
	{
		$query = $this->db->select("*")
			->from("council_nationality_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_state()
	{
		$query = $this->db->select("*")
			->from("council_state_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_caste()
	{
		$query = $this->db->select("*")
			->from("council_caste_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_qualification()
	{
		$query = $this->db->select("*")
			->from("council_qualification_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_course()
	{
		$query = $this->db->select("*")
			// ->from("council_spot_course_master")
			->from("council_exam_type_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}
	public function get_religion()
	{
		$query = $this->db->select("*")
		->from("council_religion_master")
		->where("active_status", 1)
		->get();
	return $query->result_array();
	}

	public function get_district()
	{
		$query = $this->db->select("*")
			->from("council_district_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	
	public function get_subdivision()
	{
		$query = $this->db->select("*")
			->from("council_subdiv_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
	}

	public function get_police_station()
	{
		$query = $this->db->select("*")
			->from("council_police_station_master")
			->where("active_status", 1)
			->get();
		return $query->result_array();
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
	public function insert_application_details($application_basic =NULL)
	{
		$this->db->insert('council_polytechnic_spotcouncil_student_details', $application_basic);
        return $this->db->insert_id();
	}
	public function getStdDetailsByIdHash_old($id_hash){

		$this->db->select('*');
		$this->db->from('council_polytechnic_spotcouncil_student_details as student');
		$this->db->where("MD5(CAST(student.student_details_id_pk as character varying)) =", $id_hash);
		$query =  $this->db->get()->row_array();
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}
	public function getStdDetailsByIdHash($id_hash){

		$this->db->select('student.*,exam_master.exam_type_name');
		$this->db->from('council_polytechnic_spotcouncil_student_details as student')
			->join("council_exam_type_master as exam_master", "exam_master.exam_type_id_pk = student.exam_type_id_fk", "LEFT"); 
		$this->db->where("MD5(CAST(student.student_details_id_pk as character varying)) =", $id_hash);
		$query =  $this->db->get()->row_array();
		if(!empty($query)){

			return $query;
		}else{
			return array();
		}
	}

	public function updateStdDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('student_details_id_pk', $id);
        $this->db->update('council_polytechnic_spotcouncil_student_details', $updateArray);
		// echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

	public function get_last_application_no($chaking_data = NULL)
    {
        return $query = $this->db->select('max(application_form_no) as code')
            ->from('council_polytechnic_spotcouncil_student_details')
            ->like('application_form_no', ($chaking_data))
            ->get()
            ->result_array();
    }

	public function get_student_preview_data_list($student_details_id_pk = Null)
    { //echo $student_details_id_pk; die;
       
        $query = $this->db->select("stud.student_details_id_pk,stud.candidate_name,stud.guardian_name,
		course.exam_type_name,gender.gender_description,nationality.nationality_name,
		stud.kanyashree,stud.kanyashree_unique_id,caste.caste_name,
		stud.handicapped,stud.date_of_birth,stud.aadhar_no,
		qualification.qualification_name,stud.fullmarks,
		stud.marks_obtain,stud.percentage,stud.cgpa,
		stud.institute_name,stud.year_of_passing,stud.address,stud.pincode,state.state_name,
		district.district_name,subdiv.subdiv_name,stud.mobile_number,
		stud.email,stud.application_form_no,stud.picture, 
		stud.sign,religion.religion_name,stud.last_reg_no,
		stud.thirdyr_or_physics_or_math_result,
		stud.ews,
		stud.applied_under_tfw,
		stud.land_loser,
		stud.wards_of_exserviceman,
		stud.secondyear_or_chemistry_or_physicalscience_or_science_result,
		stud.firstyear_or_hs_english_or_lifescience_result,
		police.police_station_name,qualification.marks_subject1_corr_qualification,qualification.qualification_name,qualification.marks_subject2_corr_qualification,qualification.marks_subject3_corr_qualification,stud.exam_type_id_fk")
            ->from("council_polytechnic_spotcouncil_student_details as stud")
            //  ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
			->join("council_exam_type_master as course", " course.exam_type_id_pk = stud.exam_type_id_fk", "LEFT")
            ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 
            ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")
            ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")
            ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")
            ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
            ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")
            ->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")
            ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")
			->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")
            ->where(
                array(
                    "stud.active_status" => 1,
                    'MD5(CAST(student_details_id_pk AS character varying)) =' =>$student_details_id_pk
                )
            )
            ->get();
        return $query->result_array();  
		//stud.land_loser,stud.applied_under_tfw,stud.wards_of_exserviceman,stud.ews,


    }

    /* added by ATREYEE 03-01-2023 */
    public function get_specific_course_name_atz($course_id = NULL) {
    	$query = $this->db->select("course_name")
			->from("council_spot_course_master")
			->where("course_id_pk", $course_id)
			->where ("active_status",1)
			->get();
			//echo $this->db->last_query();
		 return $query->result_array();
    }
	public function getApplicationNo_old($applicationNo)
	{
		$query = $this->db->select('student_details_id_pk')
		->from("council_polytechnic_spotcouncil_student_details as stud")
		->where(
			array(
				"stud.active_status" => 1,
				"stud.application_form_no"=>$applicationNo
				
			)
		)
		->get();
		//  echo $this->db->last_query();exit;
	    return $query->result_array();

		
	}
	// for inserting details in draft table
	public function insert_std_draft_details($application_basic = null)
	{
		$this->db->insert('council_polytechnic_spotcouncil_student_details_draft', $application_basic);

		 // echo $this->db->last_query();exit;
        return $this->db->insert_id();
		// echo $this->db->last_query();exit;
	}


	public function getdrafteditByIdHash($status = null)
	{


		$query = $this->db->select('draft. *,course.exam_type_name,gender.gender_description,nationality.nationality_name,caste.caste_name,qualification.qualification_name,religion.religion_name,state.state_name,district.district_name,subdiv.subdiv_name,police.police_station_name')
		->from('council_polytechnic_spotcouncil_student_details_draft as draft')
		
		 ->join("council_exam_type_master as course", " course.exam_type_id_pk = draft.exam_type_id_fk", "LEFT")
        ->join("council_gender_master as gender", " gender.gender_id_pk = draft.gender_id_fk", "LEFT") 
         ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = draft.nationality_id_fk", "LEFT")
       ->join("council_caste_master as caste", " caste.caste_id_pk = draft.caste_id_fk", "LEFT")
        ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = draft.last_qualification_id_fk", "LEFT")
         ->join("council_religion_master as religion", " religion.religion_id_pk = draft.religion_id_fk", "LEFT")

        ->join("council_state_master as state", " state.state_id_pk = draft.state_id_fk", "LEFT")
        ->join("council_district_master as district", " district.district_id_pk = draft.district_id_fk", "LEFT")
         ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = draft.sub_div_id_fk", "LEFT")
		 ->join("council_police_station_master as police", " police.police_station_id_pk = draft.police_station_id_fk", "LEFT")
		

		->where(
			array(
				 'MD5(CAST(draft.student_details_id_fk as character varying))=' => $status
				//'draft.student_details_draft_id_pk'=> $status
			)
		)
		// ->limit(1)
		->get();
	   return $query->row_array();
		// echo $this->db->last_query(); die;



	}

	public function getStdDraftDetailsByIdHash($status = null)
	{


		$query = $this->db->select('draft. *,course.exam_type_name,gender.gender_description,nationality.nationality_name,caste.caste_name,qualification.qualification_name,religion.religion_name,state.state_name,district.district_name,subdiv.subdiv_name,police.police_station_name')
		->from('council_polytechnic_spotcouncil_student_details_draft as draft')
		
		 ->join("council_exam_type_master as course", " course.exam_type_id_pk = draft.exam_type_id_fk", "LEFT")
        ->join("council_gender_master as gender", " gender.gender_id_pk = draft.gender_id_fk", "LEFT") 
         ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = draft.nationality_id_fk", "LEFT")
       ->join("council_caste_master as caste", " caste.caste_id_pk = draft.caste_id_fk", "LEFT")
        ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = draft.last_qualification_id_fk", "LEFT")
         ->join("council_religion_master as religion", " religion.religion_id_pk = draft.religion_id_fk", "LEFT")

        ->join("council_state_master as state", " state.state_id_pk = draft.state_id_fk", "LEFT")
        ->join("council_district_master as district", " district.district_id_pk = draft.district_id_fk", "LEFT")
         ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = draft.sub_div_id_fk", "LEFT")
		 ->join("council_police_station_master as police", " police.police_station_id_pk = draft.police_station_id_fk", "LEFT")
		

		->where(
			array(
				 'MD5(CAST(draft.student_details_id_fk as character varying))=' => $status
				//'draft.student_details_draft_id_pk'=> $status
			)
		)
		// ->limit(1)
		->get();
	   return $query->row_array();
		// echo $this->db->last_query(); die;



	}
	public function cleandraft($id){
		$this->db->where(
            array(
  
				'MD5(CAST(student_details_id_fk AS character varying))=' => $id
            )
        );
        $this->db->delete('council_polytechnic_spotcouncil_student_details_draft');
	}
	public function getStdDetailsForFinalSubmit($student_details_id_fk)
	{
		$query =$this->db->select('
			student_details_draft_id_pk,
			student_details_id_fk ,enrolment_number ,candidate_name,date_of_birth ,guardian_name ,mobile_number,category ,land_loser ,applied_under_tfw ,wards_of_exserviceman ,picture,sign, active_status ,college_id_fk,final_allotment_letter_no,entry_time,caste_id_fk,course_id_fk,nationality_id_fk,gender_id_fk,handicapped,aadhar_no,
  last_qualification_id_fk,
  fullmarks,
  marks_obtains,
  percentage,
  cgpa,
  institute_name,
  year_of_passing,
  state_id_fk,
  district_id_fk,
  sub_div_id_fk,
  pincode,
  kanyashree,
  kanyashree_unique_id,
  address ,
  religion_id_fk ,
  entry_ip ,
  email ,
  email_verify_status,
  mobile_no_verify_status,
  mobile_otp ,
  last_reg_no,
  application_form_no ,
  registration_year,
  thirdyr_or_physics_or_math_result ,
  secondyear_or_chemistry_or_physicalscience_or_science_result,
  firstyear_or_hs_english_or_lifescience_result,
  police_station_id_fk ,
  general_rank ,
  sc_rank ,
  st_rank ,
  pc_rank ,
  student_college_mapid_fk ,
  marks_obtain ,
  obc_a ,
  obc_b ,
  pre_admission_status,
  added_by_system ,
  aggregate_marks ,
  udise_code ,
  ews ,
  exam_type_id_fk,
  caste_doc,
  phy_challenged_doc
');

			$this->db->from('council_polytechnic_spotcouncil_student_details_draft as student');
			$this->db->where("MD5(CAST(student.student_details_id_fk as character varying)) =", $student_details_id_fk);
			//$this->db->get();
			// echo $this->db->last_query();exit;
	//    return $query->row_array();
			
	   $data =  $this->db->get()->row_array();
	

	
			 
			// //echo "<pre>";print_r($data);exit;
			$data['student_details_id_pk'] = $data['student_details_id_fk'];
			$data['udise_code'] = ($data['udise_code'] == '') ? NULL : $data['udise_code'];
			 unset($data['student_details_draft_id_pk']);
			 unset($data['student_details_id_fk']);
			 
			if(!empty($data)){
	
					return $data;
				}else{
					return array();
				}   
			
	}
	public function updateStdData($table, $final_data,$student_details_id_fk){
		$this->db->where(
			array(
				'MD5(CAST(student_details_id_pk as character varying))=' => $student_details_id_fk
			)
		)
		->update($table, $final_data);
		
		//echo $this->db->last_query();exit;

		
		
	    return $this->db->affected_rows();
	}
	
	public function update_draft_save_status($student_details_id_fk){
		$this->db->where(
			array(
				'MD5(CAST(student_details_id_fk as character varying))=' => $student_details_id_fk
			)
		)
		->update('council_polytechnic_spotcouncil_student_details_draft', array('final_submit_status'=>1));
		return $this->db->affected_rows();
	}

	public function update_std_draft_details($updateArray = NULL,$id = NULL)
    {
        $this->db->where('student_details_id_fk', (int)$id);
        $this->db->update('council_polytechnic_spotcouncil_student_details_draft', $updateArray);
		// echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }

	public function check_aadharno_course($aadhar_no= null,$course=null)
	{
		$query = $this->db->select('student.aadhar_no,student.exam_type_id_fk')
		    ->from('council_polytechnic_spotcouncil_student_details as student')
			->where(
				array
				(
                    "aadhar_no" =>$aadhar_no,
					"exam_type_id_fk" => (int)$course
				)
				)
				->get();
				
				if($query->num_rows() > 0){

                       return true;
				}else{

					return false;

				}
				

	}
	
	
	//Added by Moli For BSK
	public function getBskData($ticket_no){
		//echo $ticket_no;exit;
		$this->db->select('*');
		$this->db->from('council_bsk_api_json_data');
		$this->db->where('ticketno',$ticket_no);
		$query = $this->db->get()->row_array();
		if(!empty($query)){
			return $query;
		}else{
			return array();
		}
	}

	public function bskStudentResponseData($bsk_ticket_no){
		$query = $this->db->select('student_details_id_pk,bsk_ticket_no,bsk_userid,mobile_number,application_form_no,entry_time')
		->from('council_polytechnic_spotcouncil_student_details')
		->where('bsk_ticket_no',$bsk_ticket_no)->get()->row_array();
		return array(
			"std_details" => $query
		);
	}

	public function updateBSKJsonTable($table, $updateArray = NULL,$bsk_ticket_no = NULL)
    {
        $this->db->where('ticketno', $bsk_ticket_no);
        $this->db->update($table, $updateArray);
		// echo $this->db->last_query();exit;
        return $this->db->affected_rows();
    }
	
	public function getApplicationNo($applicationNo)
	{
		$query = $this->db->select('student_details_id_pk')
		->from("council_polytechnic_spotcouncil_student_details as stud")
		->where(
			array(
				"stud.active_status" => 1,
				"stud.aadhar_no"=>$applicationNo
				
			)
		)
		->get();
		//  echo $this->db->last_query();exit;
	    return $query->result_array();	
	}
	
	public function getPaymentDetailsByStdId($std_id){

		$this->db->select('transaction_id')
		->from('council_institute_student_payment_map')
		->where('spotcouncil_student_details_id_fk', $std_id)
		->where('payment_type_id_fk',3);
		$query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }

	}

	//Abhijit on 20-04-2024

	public function getStudAdmitDetails($student_id_hash = NULL)
	{
		$query = $this->db->select("
		std_details.index_number,
		std_details.exam_type_id_fk,
		std_details.application_form_no,
		std_details.candidate_name,
		std_details.date_of_birth,
		std_details.caste_id_fk,
		caste.caste_name,
		std_details.picture,
		std_details.sign,
		std_details.handicapped,
		std_details.applied_under_tfw,
		std_details.land_loser,
		centre.centre_name,
		centre.centre_address,
		centre.police_station,
		centre.pincode,
		centre.district_id_fk,
		district.district_name")
			->from("council_polytechnic_spotcouncil_student_details as std_details")
			->where('MD5(CAST(student_details_id_pk AS character varying)) =', $student_id_hash)
			->join("council_caste_master as caste", "caste.caste_id_pk= std_details.caste_id_fk", "LEFT")
			->join("council_jexpo_online_exam_centre_master as centre", "centre.centre_id_pk= std_details.exam_centre_id_fk", "LEFT")
			->join("council_district_master as district", "centre.district_id_fk = district.district_id_pk", "LEFT")
			->get();
		// echo $this->db->last_query();die;
		return $query->result_array();
	}



	
}


