<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_list_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getInsStudentList($limit = NULL, $offset = NULL, $vtc_id = NULL, $academic_year = NULL){
		
		$query = $this->db->select("		 
			DISTINCT on (stud.aadhar_no)
			stud.aadhar_no,
			stud.institute_student_details_id_pk,
			stud.first_name,
			stud.middle_name,
			stud.last_name,
			stud.institute_id_fk,
			stud.guardian_name,
			course.course_name,
			gender.gender_description,
			nationality.nationality_name,
			stud.kanyashree,
			stud.kanyashree_no,
			stud.handicapped,
			stud.date_of_birth,
			stud.fullmarks,
			stud.marks_obtain,
			stud.percentage,
			
			stud.address,
			stud.pincode,
			
			stud.mobile_number,
			stud.email,
			stud.application_form_no,
			stud.last_reg_no,
			
			stud.approve_reject_status,
			vtc_master.vtc_name,
			vtc_master.vtc_code,
			discipline_master.discipline_name,
			discipline_master.discipline_code,
			stud.admission_type,
			stud.exam_type_id_fk,
			examtype_master.name_for_std_reg,
			stud.council_approvedreject_status,
            stud.eligible_for_exam,
			ciscn.reg_certificate_number
		")
		->from("council_institute_student_details as stud")
		->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
		->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

		->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

		//->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

		//->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

		//->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")

		//->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

		//->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")

		//->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

		//->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")

		->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = stud.institute_id_fk')

		->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = stud.course_id_fk')

		->join('council_exam_type_master as examtype_master','examtype_master.exam_type_id_pk = stud.exam_type_id_fk')
		->join('council_institute_student_card_number_map AS ciscn', 'ciscn.institute_student_details_id_fk = stud.institute_student_details_id_pk', 'left')
		->where(
		   array(
			   "stud.active_status" => 1,
			   "stud.institute_id_fk"   => $vtc_id,
			   "stud.registration_year" =>$academic_year,
			  // "stud.final_save_status" =>1,
		   )
		)
		->limit($limit, $offset)

		->get();


       // $query = $this->db->select("stud.institute_student_details_id_pk,
       // stud.first_name,
       // stud.middle_name,
       // stud.last_name,
       // stud.institute_id_fk,
       // stud.guardian_name,
       // course.course_name,
       // gender.gender_description,
       // nationality.nationality_name,
       // stud.kanyashree,
       // stud.kanyashree_no,
       // caste.caste_name,stud.handicapped,stud.date_of_birth,
       // stud.aadhar_no,qualification.qualification_name,
       // stud.fullmarks,stud.marks_obtain,stud.percentage,
       // stud.cgpa,stud.thirdyr_or_physics_or_math_result,
       // stud.secondyear_or_chemistry_or_physicalscience_or_science_result,
       // stud.firstyear_or_hs_english_or_lifescience_result,
       
       // stud.address,
       // stud.pincode,
       // state.state_name,
       // police.police_station_name,
       // district.district_name,
       // subdiv.subdiv_name,
       // stud.mobile_number,
       // stud.email,
       // stud.application_form_no,religion.religion_name,stud.last_reg_no,
       // stud.picture,
       // stud.sign,
       // stud.approve_reject_status,
       // vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,discipline_master.discipline_code,stud.admission_type,stud.exam_type_id_fk,examtype_master.name_for_std_reg")
           // ->from("council_institute_student_details as stud")
           // ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
           // ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

           // ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

           // ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

           // ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

           // ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
       
           // ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

           // ->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")

           // ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

           // ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")
           
           // ->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = stud.institute_id_fk')
           
           // ->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = stud.course_id_fk')

           // ->join('council_exam_type_master as examtype_master','examtype_master.exam_type_id_pk = stud.exam_type_id_fk')
           // ->where(
               // array(
                   // "stud.active_status" => 1,
                   // "stud.institute_id_fk"   => $vtc_id,
                   // "stud.registration_year" =>$academic_year,
                   // "stud.final_save_status" =>1,

               // )
           // )
           // ->limit($limit, $offset)
           
           // ->get();
		   //echo $this->db->last_query();exit;
       return $query->result_array();
       // echo $this->db->last_query();exit;
   }

    public function get_student_count($vtc_id,$academic_year)
    {
        $query = $this->db->select("count(institute_student_details_id_pk)")
            ->from("council_institute_student_details")
			->where(
               array(
                   "active_status" => 1,
                   "institute_id_fk"   => $vtc_id,
                   "registration_year" =>$academic_year,
                   "final_save_status" =>1,

               )
           )
            ->get();
        return $query->result_array();
    }

    public function getStudentDetailsById($id_hash = NULL)
    {
		//$this->db->select('student.*');
		$this->db->select('student.institute_student_details_id_pk,student.first_name,student.middle_name, student.last_name');
        $this->db->from('council_institute_student_details AS student');
        $this->db->where("MD5(CAST(student.institute_student_details_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }

    public function updateStudentData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(institute_student_details_id_pk as character varying)) =", $student_id);
        $this->db->update('council_institute_student_details', $updateArray);
        return $this->db->affected_rows();
    }

    public function studentviewByIns($institute_id_fk = null,$insStud_id_pk = Null)
    {

        $this->db->select('student_details.*,board.board_name,board.board_id_pk,vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,discipline_master.discipline_code,nationality_master.nationality_name');
        $this->db->from('council_institute_student_details as student_details');

        $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
        
         $this->db->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = student_details.course_id_fk');

         $this->db->join('council_nationality_master as nationality_master','nationality_master.nationality_id_pk = student_details.nationality_id_fk');


        $this->db->join('council_board_master as board','board.board_id_pk = student_details.board_id_pk');

        $this->db->where('md5(CAST(student_details.institute_id_fk as character varying)) =',$institute_id_fk);
       
        
        $this->db->where('md5(CAST(student_details.institute_student_details_id_pk as character varying)) =',$insStud_id_pk);

       // echo $this->db->last_query();
        return $query = $this->db->get()->row_array();
        //echo $this->db->last_query();
        

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

    public function getAllBoard(){
		$this->db->select('*');
		$this->db->from('council_board_master');
		$this->db->where('active_status',1);
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

    public function get_student_aadhaar_file_content($std_id){
		$this->db->select("aadhar_doc");
		$this->db->from("council_institute_student_details");
		$this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $std_id);
		//$this->db->where("assessor_registration_details_pk",$doc_id_pk);
		//$this->db->limit($limit,$offset);
		$query = $this->db->get();
		return $query->result_array(); 
	}


   //  added by abhijit on 25-03-2023

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



    public function updateStdDetails($inst_stud_id_pk = null, $updateArray1 = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $inst_stud_id_pk);
        // $this->db->where('institute_id_fk', $institute_id_fk);
        $this->db->update('council_institute_student_details', $updateArray1);
		 // echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
    }

    public function updateStdQualifiDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $id);
        $this->db->update('council_institute_student_details', $updateArray);

        return $this->db->affected_rows();
    }

// added on 27-02-2023
public function get_aadhar_search($aadhar_search = NULL, $vtc_id = NULL, $academic_year = NULL ){

     // echo '<pre>';print_r($aadhar_search) ; die;

       $query = $this->db->select("stud.institute_student_details_id_pk,
       stud.first_name,
       stud.middle_name,
       stud.last_name,
       stud.institute_id_fk,
       stud.guardian_name,
       course.course_name,
       gender.gender_description,
       nationality.nationality_name,
       stud.kanyashree,
       stud.kanyashree_no,
       caste.caste_name,stud.handicapped,stud.date_of_birth,
       stud.aadhar_no,qualification.qualification_name,
       stud.fullmarks,stud.marks_obtain,stud.percentage,
       stud.cgpa,stud.thirdyr_or_physics_or_math_result,
       stud.secondyear_or_chemistry_or_physicalscience_or_science_result,
       stud.firstyear_or_hs_english_or_lifescience_result,
       
       stud.address,
       stud.pincode,
       state.state_name,
       police.police_station_name,
       district.district_name,
       subdiv.subdiv_name,
       stud.mobile_number,
       stud.email,
       stud.application_form_no,religion.religion_name,stud.last_reg_no,
       stud.picture,
       stud.sign,
       stud.approve_reject_status,
	   
	   stud.council_approvedreject_status,
       stud.eligible_for_exam,
       vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,discipline_master.discipline_code,stud.admission_type,stud.exam_type_id_fk,examtype_master.name_for_std_reg,ciscn.reg_certificate_number")
           ->from("council_institute_student_details as stud")
           ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
           ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

           ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

           ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

           ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

           ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
       
           ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

           ->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")

           ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

           ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")
           
           ->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = stud.institute_id_fk')
           
           ->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = stud.course_id_fk')

           ->join('council_exam_type_master as examtype_master','examtype_master.exam_type_id_pk = stud.exam_type_id_fk')
		   ->join('council_institute_student_card_number_map AS ciscn', 'ciscn.institute_student_details_id_fk = stud.institute_student_details_id_pk', 'left')
            ->where("stud.aadhar_no",$aadhar_search)
           ->where(
               array(
                   "stud.active_status" => 1,
                   "stud.institute_id_fk"   => $vtc_id,
                   "stud.registration_year" =>$academic_year,
                   "stud.final_save_status" =>1,

               )
           )
           
          
           // ->limit($limit,$offset)
           ->get();
      
       return $query->result_array();
       // echo $this->db->last_query();exit;
   }
// end //


	public function updateLoginDetails($inst_stud_id_pk = null, $updateArray1 = NULL)
       {
        $this->db->where('stake_details_id_fk', $inst_stud_id_pk);
        $this->db->where('stake_id_fk', 29);
        // $this->db->where('institute_id_fk', $institute_id_fk);
        $this->db->update('council_stake_holder_login', $updateArray1);
		  // echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
       }

	public function updateSpotDetails($inst_stud_id_pk = null, $updateArray1 = NULL)
    {
		$this->db->where('student_details_id_pk', $inst_stud_id_pk);
		// $this->db->where('institute_id_fk', $institute_id_fk);
		$this->db->update('council_polytechnic_spotcouncil_student_details', $updateArray1);
			// echo $this->db->last_query();exit; 
		return $this->db->affected_rows();
    }
	
	
	 //Added by moli on 25-03-2023

    public function updateStdEligibility($ids = NULL, $updateArray = NULL)
    {
        $this->db->where_in('institute_student_details_id_pk', $ids);
        $this->db->update('council_institute_student_details', $updateArray);

        return $this->db->affected_rows();
    }

   /** added by AVIJIT 28-03-2023 */
    public function getInsStudentListforMis($vtc_id = NULL, $academic_year = NULL){

        // echo $vtc_id ; die;

       $query = $this->db->select("stud.institute_student_details_id_pk,
       stud.first_name,
       stud.middle_name,
       stud.last_name,
       stud.institute_id_fk,
       stud.guardian_name,
       course.course_name,
       gender.gender_description,
       nationality.nationality_name,
       stud.kanyashree,
       stud.kanyashree_no,
       caste.caste_name,stud.handicapped,stud.date_of_birth,
       stud.aadhar_no,qualification.qualification_name,
       stud.fullmarks,stud.marks_obtain,stud.percentage,
       stud.cgpa,stud.thirdyr_or_physics_or_math_result,
       stud.secondyear_or_chemistry_or_physicalscience_or_science_result,
       stud.firstyear_or_hs_english_or_lifescience_result,
       
       stud.address,
       stud.pincode,
       state.state_name,
       police.police_station_name,
       district.district_name,
       subdiv.subdiv_name,
       stud.mobile_number,
       stud.email,
       stud.application_form_no,religion.religion_name,stud.last_reg_no,
       stud.picture,
       stud.sign,
       stud.approve_reject_status,
       vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,discipline_master.discipline_code,stud.admission_type,stud.exam_type_id_fk,examtype_master.name_for_std_reg,ciscn.reg_certificate_number")
           ->from("council_institute_student_details as stud")
           ->join("council_spot_course_master as course", " course.course_id_pk = stud.course_id_fk", "LEFT")
           ->join("council_gender_master as gender", " gender.gender_id_pk = stud.gender_id_fk", "LEFT") 

           ->join("council_nationality_master as nationality", " nationality.nationality_id_pk = stud.nationality_id_fk", "LEFT")

           ->join("council_caste_master as caste", " caste.caste_id_pk = stud.caste_id_fk", "LEFT")

           ->join("council_qualification_master as qualification", " qualification.qualification_id_pk = stud.last_qualification_id_fk", "LEFT")

           ->join("council_religion_master as religion", " religion.religion_id_pk = stud.religion_id_fk", "LEFT")
       
           ->join("council_state_master as state", " state.state_id_pk = stud.state_id_fk", "LEFT")

           ->join("council_district_master as district", " district.district_id_pk = stud.district_id_fk", "LEFT")

           ->join("council_subdiv_master as subdiv", " subdiv.subdiv_id_pk = stud.sub_div_id_fk", "LEFT")

           ->join("council_police_station_master as police", " police.police_station_id_pk = stud.police_station_id_fk", "LEFT")
           
           ->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = stud.institute_id_fk')
           
           ->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = stud.course_id_fk')

           ->join('council_exam_type_master as examtype_master','examtype_master.exam_type_id_pk = stud.exam_type_id_fk')
    
    ->join('council_institute_student_card_number_map AS ciscn', 'ciscn.institute_student_details_id_fk = stud.institute_student_details_id_pk', 'left')

           ->where(
               array(
                   "stud.active_status" => 1,
                   "stud.institute_id_fk"   => $vtc_id,
                   "stud.registration_year" =>$academic_year,
                   "stud.final_save_status" =>1,

               )
           )
          ->get();
       return $query->result_array();
       // echo $this->db->last_query();exit;
   }

/******************/



}
?>