<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_registration_model extends CI_Model
{

    public function get_salutation(){
		$query = $this->db->select("*")
			->from("council_salutation_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}
	
	public function get_gender(){
		$query = $this->db->select("*")
			->from("council_gender_master")
			//->where("active_status",1)
			->get();
		return $query->result_array();
	}

    public function get_caste(){
		$query = $this->db->select("*")
			->from("council_caste_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

    public function get_religion(){
		$query = $this->db->select("*")
			->from("council_religion_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

    public function get_nationality(){
		$this->db->select('*');
		$this->db->from('council_nationality_master');
		$this->db->where('active_status',1);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}

    public function getStdDetails($std_id_hash = NULL ,  $stake_id_fk = null){

        $this->db->select('student_details.*,vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,
			discipline_master.discipline_code');
        $this->db->from('council_institute_student_details as student_details');
        $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
		$this->db->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = student_details.course_id_fk');
        // $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);

		if($stake_id_fk == 29){

			$this->db->where('md5(CAST(student_details.spotcouncil_student_details_id_fk as character varying)) =',$std_id_hash);
		}else{
			$this->db->where('md5(CAST(student_details.institute_student_details_id_pk as character varying)) =',$std_id_hash);
		}
		$this->db->where('student_details.active_status',1);
        $query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }
    }
    // public function getStdDetails($std_id_hash = NULL){

	// 	$this->db->select('student_details.*,
	// 	vtc_master.vtc_name,
	// 	vtc_master.vtc_code,
	// 	gender_master.gender_description,
	// 	nationality_master.nationality_name,
	// 	caste_master.caste_name,
	// 	state_master.state_name,
	// 	district_master.district_name,
	// 	subdiv_master.subdiv_name,
	// 	municipality_master.block_municipality_name,
	// 	religion_master,religion_name,
	// 	discipline_master.discipline_name,
	// 	discipline_master.discipline_code');
    //     $this->db->from('council_institute_student_details as student_details');
    //     $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
	// 	$this->db->join('council_nationality_master as nationality_master','nationality_master.nationality_id_pk = student_details.nationality_id_fk');

	// 	$this->db->join('council_gender_master as gender_master','gender_master.gender_id_pk = student_details.gender_id_fk');

	// 	$this->db->join('council_caste_master as caste_master','caste_master.caste_id_pk = student_details.caste_id_fk');

	// 	$this->db->join('council_state_master as state_master','state_master.state_id_pk = student_details.state_id_fk');

	// 	$this->db->join('council_district_master as district_master','district_master.district_id_pk = student_details.district_id_fk');

	// 	$this->db->join('council_subdiv_master as subdiv_master','subdiv_master.subdiv_id_pk = student_details.sub_div_id_fk');

	// 	$this->db->join('council_block_municipality_master as municipality_master','municipality_master.block_municipality_id_pk = student_details.municipality_id_fk');

	// 	$this->db->join('council_religion_master as religion_master','religion_master.religion_id_pk = student_details.religion_id_fk');

	// 	$this->db->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = student_details.course_id_fk');
		

    //     // $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
	// 	$this->db->where('md5(CAST(student_details.spotcouncil_student_details_id_fk as character varying)) =',$std_id_hash);
    //     $query = $this->db->get()->row_array();
    //     if(!empty($query)){

    //         return $query;
    //     }else{
    //         $query = array();
    //     }
    // }

	public function getDistrictByStateId($state_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', $state_id)->order_by('district_name')->get('council_district_master')->result_array();
    }

	public function getAllState(){
		$this->db->select('*');
		$this->db->from('council_state_master');
		$this->db->where('active_status',1);
		$query = $this->db->get()->result_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
	}


	public function updateStdDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $id);
        $this->db->update('council_institute_student_details', $updateArray);
		//echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
    }

	public function updateStdQualifiDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $id);
        $this->db->update('council_institute_student_details', $updateArray);
		//echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
    }
	
	public function updatePhotosign($id = NULL, $updateArray = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $id);
        $this->db->update('council_institute_student_details', $updateArray);

        return $this->db->affected_rows();
    }

	public function get_student_citizen_file_content($std_id){
		$this->db->select("citizenship_approval_doc");
		$this->db->from("council_institute_student_details");
		$this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $std_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}

	public function get_student_caste_file_content($std_id){
		$this->db->select("caste_doc");
		$this->db->from("council_institute_student_details");
		$this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $std_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}


	public function get_student_handicap_file_content($std_id){
		$this->db->select("phy_challenged_doc");
		$this->db->from("council_institute_student_details");
		$this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $std_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	
	}

	

	public function getStdPreviewDetails($std_id_hash = NULL){

        $this->db->select('student_details.*,vtc_master.vtc_name,vtc_master.vtc_code,
		gender_master.gender_description,nationality_master.nationality_name,
		caste_master.caste_name,state_master.state_name,district_master.district_name,
		religion_master.religion_name,discipline_master.discipline_name,discipline_master.discipline_code,board_master.board_name,exam_type.exam_type_name,exam_type.name_for_std_reg');
        $this->db->from('council_institute_student_details as student_details');
        $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
		$this->db->join('council_nationality_master as nationality_master','nationality_master.nationality_id_pk = student_details.nationality_id_fk');

		$this->db->join('council_gender_master as gender_master','gender_master.gender_id_pk = student_details.gender_id_fk');

		$this->db->join('council_caste_master as caste_master','caste_master.caste_id_pk = student_details.caste_id_fk');

		$this->db->join('council_state_master as state_master','state_master.state_id_pk = student_details.state_id_fk');

		$this->db->join('council_district_master as district_master','district_master.district_id_pk = student_details.district_id_fk');

		//$this->db->join('council_subdiv_master as subdiv_master','subdiv_master.subdiv_id_pk = student_details.sub_div_id_fk');

		//$this->db->join('council_block_municipality_master as municipality_master','municipality_master.block_municipality_id_pk = student_details.municipality_id_fk');

		$this->db->join('council_religion_master as religion_master','religion_master.religion_id_pk = student_details.religion_id_fk');

		$this->db->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = student_details.course_id_fk');
		
		$this->db->join('council_board_master as board_master','board_master.board_id_pk = student_details.board_id_pk');
		
		$this->db->join('council_exam_type_master as exam_type','exam_type.exam_type_id_pk = student_details.exam_type_id_fk');

        // $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
		$this->db->where('md5(CAST(student_details.spotcouncil_student_details_id_fk as character varying)) =',$std_id_hash);
		$this->db->where('student_details.active_status',1);
        $query = $this->db->get()->row_array();
		
		//echo $this->db->last_query();exit;
        if(!empty($query)){
			$sub_div_id_fk = $query['sub_div_id_fk'];
			$municipality_id_fk = $query['municipality_id_fk'];
			if($sub_div_id_fk !=''){
				$sub_div_name = $this->db->select('subdiv_name')->from('council_subdiv_master')->where('subdiv_id_pk',$sub_div_id_fk)->get()->row_array();
				$query['subdiv_name'] = $sub_div_name['subdiv_name'];
			}else{
				$query['subdiv_name'] = '';
			}
			
			if($municipality_id_fk !=''){
				$municipality_name = $this->db->select('block_municipality_name')->from('council_block_municipality_master')->where('block_municipality_id_pk',$municipality_id_fk)->get()->row_array();
				$query['block_municipality_name'] = $municipality_name['block_municipality_name'];
			}else{
				$query['block_municipality_name'] = '';
			}

            return $query;
        }else{
            $query = array();
        }
    }
	
	public function getAllExamType(){
        $query = $this->db->select("*")
            ->from("council_exam_type_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("exam_type_name", "ASC")
            ->get();
        return $query->result_array();
    } 
	public function getAllBoardName(){
        $query = $this->db->select("*")
            ->from("council_board_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("board_name", "ASC")
            ->get();
        return $query->result_array();
    }
	
	public function getPaymentDetailsByStdId($std_id){

		$this->db->select('transaction_id')
		->from('council_institute_student_payment_map')
		->where('spotcouncil_student_details_id_fk', $std_id)
		->where('payment_type_id_fk',2);
		$query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }

	}
	
	public function get_student_aadhaar_file_content($std_id){
		$this->db->select("aadhar_doc");
		$this->db->from("council_institute_student_details");
		$this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $std_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	//Add by Moli on 11-02=2023
	public function insertData($table,$std_data = NULL)
    {
        $this->db->insert($table, $std_data);
		// echo $this->db->last_query();exit;

        return $this->db->insert_id();
    }

	public function update_json_table_data($last_id = NULL, $updateArray = NULL)
    {
        $this->db->where('banglashiksha_api_json_data_id_pk', $last_id);
        $this->db->update('council_banglashiksha_api_json_data', $updateArray);
        return $this->db->affected_rows();
    }
	
	//Added By Abhijit on 21-02-2023
	
	public function getCourse_details($institute_id_fk,$exam_type_id)
	{
	
		$query = $this->db->select("discipline.discipline_id_fk,discipline_master.discipline_name,discipline_master.discipline_id_pk")
		   ->from("council_institute_qbm_discipline_map as discipline")
		   ->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = discipline.discipline_id_fk')
		   ->where(
			array(
				"discipline.active_status"  =>1,
				"discipline.institute_id_fk" =>$institute_id_fk,
				"discipline.exam_type_id_fk" =>$exam_type_id
			)
		   )
		   ->get();
		   return $query->result_array();
	}

	public function updateInstituteDetails($inst_stud_id = NULL, $course_id_fk = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $inst_stud_id);
        $this->db->update('council_institute_student_details', $course_id_fk);
		//echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
    }

	public function getCourseByCode($vtc_code = NULL,$exam_type_id= null){

		$this->db->select('qbm_disciplne.discipline_id_pk,qbm_disciplne.discipline_name,qbm_disciplne.discipline_code');
		$this->db->from('council_institute_qbm_discipline_map as ins_dis_map');
		$this->db->join('council_qbm_discipline_master as qbm_disciplne', 'ins_dis_map.discipline_id_fk = qbm_disciplne.discipline_id_pk');
		 $this->db->join('council_affiliation_vtc_master as vtc_master', 'ins_dis_map.institute_id_fk = vtc_master.vtc_id_pk');
		$this->db->where('vtc_master.vtc_code',$vtc_code);
		
		if($exam_type_id== 1 ||$exam_type_id== 2 ){
			$this->db->where('ins_dis_map.exam_type_id_fk',1);
		}else{
			$this->db->where('ins_dis_map.exam_type_id_fk',$exam_type_id);
		}
		
		$this->db->where('ins_dis_map.active_status',1);
		$query = $this->db->get()->result_array();
		 //echo $this->db->last_query();exit;
		return $query;

	}
	
	public function insertStdCredentials($vtcCredentials = NULL)
    {
        $this->db->insert('council_stake_holder_login', $vtcCredentials);

        return $this->db->insert_id();
    }


	//date 23-04-2023

	public function check_enrance($exam_type_id){

		$result = $this->db->select('enrance_exam')->from('council_exam_type_master')->where('exam_type_id_pk',$exam_type_id)->get();
		$query = $result->result_array();
		if(!empty($query)){
			return $query[0]['enrance_exam'];
		}else{
			return array();
		}

	}

	public function getEligibilityCriteria($exam_type_id){

		$query = $this->db->select('*')->from('council_non_entrance_eligibility_criteria_master')->get()->result_array();
		
		if (!empty($query)){

			$criteria_id_arr = array();
			foreach ($query as $key => $value) {

				$exam_id_arr = explode(',',$value['exam_type_id_fk']);
				//echo "<pre>";print_r($exam_id_arr );exit;
				if (in_array($exam_type_id, $exam_id_arr))
				{
				  array_push($criteria_id_arr,$value['eligibility_criteria_id_pk']);
				}
			}
			//echo "<pre>";print_r($criteria_id_arr);exit;
			if(!empty($criteria_id_arr)){
				$result = $this->db->select('*')->from('council_non_entrance_eligibility_criteria_master')
				->where_in('eligibility_criteria_id_pk',$criteria_id_arr)
				->get()->result_array();
				return $result;
			}else{
				return array();
			}
		}else{
			return array();
		}
	}


	public function get_student_marksheet_file_content($std_id){
		$this->db->select("marksheet_doc");
		$this->db->from("council_institute_student_details");
		$this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $std_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	




}
?>