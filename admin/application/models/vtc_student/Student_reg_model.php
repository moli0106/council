<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_reg_model extends CI_Model
{

    public function getStudentList($school_reg_id_pk = NULL)
    {
        $this->db->select('
            student.student_id_pk,
            student.institute_code,
            student.institute_id_fk,
            student.registration_number,
            student.first_name,
            student.middle_name,
            student.last_name,
            student.mobile,
            student.image,
			student.roll_number
        ');
        $this->db->from('council_vtc_student_master AS student');
        
        $this->db->where('student.institute_id_fk', $school_reg_id_pk);
        $this->db->where('student.active_status', 1);
        $this->db->order_by('first_name');

        return $this->db->get()->result_array();
    }

    public function getSalutation()
    {
        return $this->db->get("council_salutation_master")->result_array();
    }

    public function getGender()
    {
        return $this->db->get("council_gender_master")->result_array();
    }

    public function getDistrictList()
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', 19)->order_by('district_name')->get('council_district_master')->result_array();
    }

    public function getClassList()
    {
        return $this->db->get('council_cssvse_class_master')->result_array();
    }

    public function getSectorList()
    {
        return $this->db->where('active_status', 1)->order_by('sector_name')->get('council_sector_master')->result_array();
    }

    public function getMunicipalityByDistrict($district = NULL)
    {
        return $this->db->where('active_status', 1)->where('district_id_fk', $district)->order_by('block_municipality_name')->get('council_block_municipality_master')->result_array();
    }

    public function getCourseList($sector_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('sector_id_fk', $sector_id)->order_by('course_name')->get('council_course_master')->result_array();
    }

    public function getRegDetails($school_reg_id_pk = NULL)
    {
        $this->db->select('school_master.vtc_id_pk, school_reg.*');
        $this->db->from('council_affiliation_vtc_details AS school_reg');

        $this->db->join('council_affiliation_vtc_master AS school_master', 'school_master.vtc_id_pk = school_reg.vtc_id_fk', 'left');

        $this->db->where('school_master.vtc_id_pk', $school_reg_id_pk);
        $this->db->where('active_status', 1);

        return $this->db->get()->result_array();
    }

    public function getStudentDetails($id_hash = NULL)
    {
        $this->db->select('student.*, class.class_name');
        $this->db->from('council_vtc_student_master AS student');

        $this->db->join('council_cssvse_class_master AS class', 'class.class_id_pk = student.class_id_fk', 'left');

        $this->db->where("MD5(CAST(student.student_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->result_array();
    }

    public function insertStudentData($insertArray = NULL)
    {
        $this->db->insert('council_vtc_student_master', $insertArray);

        return $this->db->insert_id();
    }

    public function updateStudentData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(student_id_pk as character varying)) =", $student_id);
        $this->db->update('council_vtc_student_master', $updateArray);
        return $this->db->affected_rows();
    }

    // ------------ Added By Moli -------------------//

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

    public function get_last_exam(){
		$query = $this->db->select("*")
			->from("council_last_academic_exam_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_batch_duration(){
		$query = $this->db->select("*")
			->from("council_vtc_batch_duration_master")
			->where("active_status",1)
			->get();
		return $query->result_array();
	}

	public function get_duplicate_aadhar($aadhar_no = NULL){

		$this->db->select('*');
		// $this->db->from('council_vtc_student_master');
		$this->db->where(array(
			'aadhar_no' => $aadhar_no,
			'active_status' => 1
		));
		return $this->db->get('council_vtc_student_master')->result_array();
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

    public function getGroupByVTCCode($course_name_id = NULL,$vtc_code = NULL, $academic_year = NULL){

		$this->db->select('course_selection.vtc_course_id_pk');
		$this->db->from('council_affiliation_vtc_master as vtc_master');
		$this->db->join('council_affiliation_vtc_course_selection as course_selection','course_selection.vtc_id_fk = vtc_master.vtc_id_pk');
		$this->db->where('vtc_master.vtc_code', $vtc_code);
		$this->db->where('course_selection.course_name_id_fk', $course_name_id);
		$this->db->where('course_selection.active_status', 1);
		$this->db->where('course_selection.academic_year', $academic_year);
		$query = $this->db->get()->result_array();
       // echo $this->db->last_query();exit;
		if(!empty($query)){

			$vtc_course_id = array();
			foreach($query as $val){
				array_push($vtc_course_id, $val['vtc_course_id_pk']);
			}

			$this->db->select('group_map.group_id_fk,group_master.group_id_pk, group_master.group_name, group_master.group_code');
			$this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
			$this->db->join('council_affiliation_group_master as group_master','group_map.group_id_fk = group_master.group_id_pk');
			$this->db->where_in('group_map.vtc_course_id_fk', $vtc_course_id);
			$this->db->where('group_map.active_status', 1);
			$this->db->where('group_map.academic_year', $academic_year);
			$group = $this->db->get()->result_array();

			if(!empty($group)){

				return $group;
			}else{
				return array();
			}
		}else{
			return array();
		}

	}

    public function getAcademicYearList(){
        $this->db->from('council_affiliation_academic_year_master')->where('active_status', 1);
        return $this->db->get()->result_array();
    }

    public function getStudentListByVTCId($limit, $offset, $orderColumn, $orderType,$selected_year,$vtc_id_pk,$batch_no){

        $this->db->select('
            student.student_id_pk,
            student.eligible_for_exam,

            student.first_name,
            student.middle_name,
            student.last_name,
            student.father_name,
            student.email,
            student.year_of_registration,
            student.date_of_birth,
            course_name_master.course_name,
            group_master.group_name,
            group_master.group_code
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_affiliation_course_name_master as course_name_master', 'course_name_master.course_name_id_pk = student.class_id_fk');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = student.course_id_fk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_pk);
        $this->db->where('student.active_status', 1);
		$this->db->where('student.added_by', 1);
        $this->db->where('student.year_of_registration', $selected_year);
        if($batch_no !='' && $batch_no != 1){

            $this->db->where('student.batch_phase', $batch_no);
        }
        // elseif ($batch_no !='' && $batch_no = 1) {
        //     $this->db->where('student.batch_phase is', null);
        // }
        $this->db->order_by('student.student_id_pk');
        $this->db->limit($limit, $offset);

        //echo $this->db->last_query();exit;
        return $this->db->get()->result_array();

    }

    public function getStudentListBySearch($limit = NULL, $offset = NULL, $orderColumn, $orderType, $search, $selected_year,$vtc_id_pk,$batch_no)
    {
        $this->db->select('
            student.student_id_pk,
            student.eligible_for_exam,

            student.first_name,
            student.middle_name,
            student.last_name,
            student.father_name,
            student.email,
            student.year_of_registration,
            student.date_of_birth,
            course_name_master.course_name,group_master.group_name,group_master.group_code
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_affiliation_course_name_master as course_name_master', 'course_name_master.course_name_id_pk = student.class_id_fk');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = student.course_id_fk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_pk);
        $this->db->where('student.active_status', 1);
		$this->db->where('student.added_by', 1);
        $this->db->where('student.year_of_registration', $selected_year);
        $this->db->where('student.batch_phase', $batch_no);
            // ->where("cavd.vtc_email LIKE '%$search%'")
            // ->like('cavd.vtc_email', $search, 'both')
        $this->db->where('group_master.group_code',$search)
            // ->order_by('cavm.vtc_name')
            ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }

    public function getStudentListCount($selected_year)
    {
        return $this->db->select("count(student_id_pk)")
            ->from("council_vtc_student_master")
            ->where('active_status', 1)
            ->where('year_of_registration', $selected_year)
            ->get()->result_array();
    }

    public function getStudentDetailsById($id_hash = NULL)
    {
        $this->db->select('student.*,student_last_exam.*');
        $this->db->from('council_vtc_student_master AS student');

        $this->db->join('council_vtc_student_last_examination AS student_last_exam', 'student_last_exam.student_id_fk = student.student_id_pk', 'left');

        $this->db->where("MD5(CAST(student.student_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }
    

    public function insertData($table,$std_data = NULL)
    {
        $this->db->insert($table, $std_data);
        

        return $this->db->insert_id();
    }

    public function updateStudentAcademicData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(student_id_fk as character varying)) =", $student_id);
        $this->db->update('council_vtc_student_last_examination', $updateArray);
        return $this->db->affected_rows();
    }
    public function getGroupDetails($group_id = NULL){
		$this->db->select('*')
		->from('council_affiliation_group_master')
		->where('group_id_pk', $group_id);
		$query = $this->db->get()->row_array();

		if (!empty($query)) {
			return $query;
		} else {
			return array();
		}
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
    public function getAllboard(){
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

    public function getDistrictByStateId($state_id = NULL)
    {
        return $this->db->where('active_status', 1)->where('state_id_fk', $state_id)->order_by('district_name')->get('council_district_master')->result_array();
    }

    public function getNewStudentListCount($selected_year,$vtc_id)
    {
        return $this->db->select("count(student_id_pk)")
            ->from("council_vtc_student_master")
            ->where('active_status', 1)
			->where('added_by', 1)
            ->where('year_of_registration', $selected_year)
			->where('institute_id_fk', $vtc_id)
            ->get()->result_array();
    }
	
	public function update_json_table_data($last_id = NULL, $updateArray = NULL)
    {
        $this->db->where('banglashiksha_api_json_data_id_pk', $last_id);
        $this->db->update('council_banglashiksha_api_json_data', $updateArray);
        return $this->db->affected_rows();
    }
	
	 public function getGuardianRelation()
    {
        return $this->db->where('active_status', 1)->order_by('relationship_name')->get('council_guardian_relationship_master')->result_array();
    }

    //added on 15-03-2023
    public function getStudentPreviewDetailsById($id_hash = NULL)
    {
        $caste = 'cast(student.caste as int)';
        $guardian_relationship = 'cast(student.guardian_relationship as int)';
        $religion_id = 'cast(student.religion as int)';

        $this->db->select('
        student.first_name,
        student.middle_name,
        student.last_name,
        student.image,
        student.std_signature,
        student.physically_challenged,

        student.marital_status,
        student.aadhar_no,
        student.date_of_birth,
        student.class_id_fk,
        student.father_name,

        student.mothers_name,
        student.guardian_name,

        student.mobile,
        student.email,

        student.address,
        student.address_2,
        student.address_3,
        student.pin,


        student_last_exam.last_academic_exam_id_fk,
        student_last_exam.council_register,
        student_last_exam.old_reg_no,
        student_last_exam.old_reg_year,

        gender.gender_description,
        
		state_master.state_name,
        caste_master.caste_name,
		district_master.district_name,
		subdiv_master.subdiv_name,
		municipality_master.block_municipality_name,
        nationality_master.nationality_name,
        group_master.group_name,
        group_master.group_code,
        guardian_relationship.relationship_name,
        religion_master.religion_name,
        last_exam_master.exam_name
		');
        $this->db->from('council_vtc_student_master AS student');

        $this->db->join('council_vtc_student_last_examination AS student_last_exam', 'student_last_exam.student_id_fk = student.student_id_pk', 'left');
        $this->db->join('council_gender_master as gender', 'gender.gender_id_pk = student.gender_id_fk', 'left');

        $this->db->join('council_caste_master as caste_master','caste_master.caste_id_pk = '.$caste);

		$this->db->join('council_state_master as state_master','state_master.state_id_pk = student.state_id_fk');

		$this->db->join('council_district_master as district_master','district_master.district_id_pk = student.district_id_fk');

		$this->db->join('council_subdiv_master as subdiv_master','subdiv_master.subdiv_id_pk = student.subdiv_id_fk');

		$this->db->join('council_block_municipality_master as municipality_master','municipality_master.block_municipality_id_pk = student.municipality_id_fk');

		$this->db->join('council_religion_master as religion_master','religion_master.religion_id_pk ='.$religion_id);
        $this->db->join('council_nationality_master as nationality_master','nationality_master.nationality_id_pk = student.nationality_id_fk');
        $this->db->join('council_affiliation_group_master as group_master','group_master.group_id_pk = student.course_id_fk');
        
        $this->db->join('council_guardian_relationship_master as guardian_relationship','guardian_relationship.guardian_relationship_id_pk = '.$guardian_relationship);
        $this->db->join('council_last_academic_exam_master as last_exam_master','last_exam_master.last_academic_exam_id_pk = student_last_exam.last_academic_exam_id_fk');


        $this->db->where("MD5(CAST(student.student_id_pk as character varying)) =", $id_hash);
        return  $this->db->get()->row_array();
       // echo $this->db->last_query();exit;
        
    }

    public function getAllStudentByVTCId($vtc_id, $academic_year){
		$caste = 'cast(student.caste as int)';
        $guardian_relationship = 'cast(student.guardian_relationship as int)';
        $religion_id = 'cast(student.religion as int)';

        $this->db->select('
        student.first_name,
        student.middle_name,
        student.last_name,

        student.father_name,
        student.mothers_name,
        student.date_of_birth,
        student.image,
        student.std_signature,
        
        group_master.group_name,
        group_master.group_code
       
        
		');
        $this->db->from('council_vtc_student_master AS student');

        //$this->db->join('council_vtc_student_last_examination AS student_last_exam', 'student_last_exam.student_id_fk = student.student_id_pk', 'left');
        //$this->db->join('council_gender_master as gender', 'gender.gender_id_pk = student.gender_id_fk', 'left');

        //$this->db->join('council_caste_master as caste_master','caste_master.caste_id_pk = '.$caste);

		//$this->db->join('council_state_master as state_master','state_master.state_id_pk = student.state_id_fk');

		//$this->db->join('council_district_master as district_master','district_master.district_id_pk = student.district_id_fk');

		//$this->db->join('council_subdiv_master as subdiv_master','subdiv_master.subdiv_id_pk = student.subdiv_id_fk');

		//$this->db->join('council_block_municipality_master as municipality_master','municipality_master.block_municipality_id_pk = student.municipality_id_fk');

		//$this->db->join('council_religion_master as religion_master','religion_master.religion_id_pk ='.$religion_id);
        //$this->db->join('council_nationality_master as nationality_master','nationality_master.nationality_id_pk = student.nationality_id_fk');
        $this->db->join('council_affiliation_group_master as group_master','group_master.group_id_pk = student.course_id_fk');
        
        //$this->db->join('council_guardian_relationship_master as guardian_relationship','guardian_relationship.guardian_relationship_id_pk = '.$guardian_relationship);
        //$this->db->join('council_last_academic_exam_master as last_exam_master','last_exam_master.last_academic_exam_id_pk = student_last_exam.last_academic_exam_id_fk');


        $this->db->where('student.institute_id_fk', $vtc_id);
        $this->db->where('student.year_of_registration', $academic_year);
        //$this->db->where('student.payment_status', 'Yes');
        $this->db->order_by('student.course_id_fk');
        $query =   $this->db->get()->result_array();

        if(!empty($query)){
            foreach ($query as $key => $value) {
                $picture = $this->db_image($value['image']);
                $query[$key]['image1'] = $picture;
                $sign = $this->db_image($value['std_signature']);
                $query[$key]['std_signature1'] = $sign;
            }
            return $query;
        }else{
            return array();
        }
       // echo $this->db->last_query();exit;
	}

    function db_image($picture = NULL)
	{

		$data = base64_decode($picture);



		$im = imagecreatefromstring($data);
		if ($im !== false) {

		ob_start();
		imagejpeg($im);
		$bhh=ob_get_contents();
		ob_end_clean();
		// header('Content-Type: image/jpeg');
		// imagepng($im);
		imagedestroy($im);
		$data = base64_encode ( $bhh); 
		return $data ; 
		}
		else {
		return  'An error occurred.';
		}

	}



    //Added by moli on 11-04-2023 

    public function updateStdEligibility($ids = NULL, $updateArray = NULL)
    {
        $this->db->where_in('student_id_pk', $ids);
        $this->db->update('council_vtc_student_master', $updateArray);

        return $this->db->affected_rows();
    }

    //Added by on 05-05-2023 For Batch Declaration
    public function get_batch_details($vtc_id_pk=null,$academic_year = null){
        $this->db->select('
        batch.batch_declare_id_pk,
        batch.batch_start_date,
        batch.batch_end_date,
        batch.academic_year,
        batch.batch_no,
        group.group_name,
        group.group_code,
        batch.class_id_fk,
        batch.group_id_fk');
        $this->db->from('council_vtc_batch_declaretion_master as batch');
        $this->db->join('council_affiliation_group_master as group', 'batch.group_id_fk = group.group_id_pk');
        $this->db->where('batch.vtc_id_fk',$vtc_id_pk);
        $this->db->where('batch.academic_year',$academic_year);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function checkVTCBatch($school_reg_id_pk,$academic_year,$group_id){

        $this->db->select('batch_declare_id_pk,group_id_fk,batch_no,batch_create_status,reg_certificate_status');
        $this->db->from('council_vtc_batch_declaretion_master');
        $this->db->where(array(
            'vtc_id_fk' => $school_reg_id_pk,
            'academic_year' => $academic_year,
            'group_id_fk' => $group_id,
            'active_status' => 1
        ));
        $this->db->order_by('batch_declare_id_pk','DESC');
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
       
    }

    public function insert_batch($insertArray){
        $this->db->insert('council_vtc_batch_declaretion_master', $insertArray);
    
        return $this->db->insert_id();
    }

    public function getBatchDeclaredGroup($course_name_id,$vtc_code, $academic_year){

        $this->db->select('batch_master.group_id_fk,group_master.group_id_pk, group_master.group_name, group_master.group_code');
			$this->db->from('council_vtc_batch_declaretion_master as batch_master');
			$this->db->join('council_affiliation_group_master as group_master','batch_master.group_id_fk = group_master.group_id_pk');
			$this->db->where('batch_master.class_id_fk', $course_name_id);
			$this->db->where('batch_master.active_status', 1);
			$this->db->where('batch_master.academic_year', $academic_year);
            $this->db->where('batch_master.vtc_code', $vtc_code);
            $this->db->where('batch_master.reg_certificate_status', 0);
			$group = $this->db->get()->result_array();

			if(!empty($group)){

				return $group;
			}else{
				return array();
			}
    }

    public function getBatchNoByGroupId($group_id=NULL,$vtc_id_pk = NULL,$academic_year){

        $this->db->select('batch_no');
        $this->db->from('council_vtc_batch_declaretion_master');
        $this->db->where('group_id_fk', $group_id);
        $this->db->where('active_status', 1);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('vtc_id_fk', $vtc_id_pk);
        $this->db->where('reg_certificate_status', 0);
        $group = $this->db->get()->result_array();

        if(!empty($group)){

            return $group[0];
        }else{
            return array();
        }
    }

    //Add Moli on 17-05-2023
    public function checkRegNoExist($group_id){
        $this->db->select('registration_number');
        $this->db->from('council_vtc_student_master');
        $this->db->where('course_id_fk', $group_id);
        $this->db->where('active_status', 1);
        $this->db->where('added_by', 1);
        $this->db->where('reg_status', 1);
        $reg_no = $this->db->get()->result_array();

        if(!empty($reg_no)){

            return $reg_no;
        }else{
            return array();
        }
    }

    //Added by moli on 31-05-023
    public function checkStudentByGroupId($school_reg_id_pk,$academic_year,$group_id){

        $this->db->select('student_id_pk');
        $this->db->from('council_vtc_student_master');
        $this->db->where('course_id_fk', $group_id);
        $this->db->where('active_status', 1);
        $this->db->where('added_by', 1);
        $this->db->where('institute_id_fk', $school_reg_id_pk);
        $this->db->limit(1);
        $query = $this->db->get()->result_array();

        if(!empty($query)){

            return $query;
        }else{
            return array();
        }
    }
}
