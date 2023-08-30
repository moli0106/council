<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institute_list_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getInstituteListBySearch($limit = NULL, $offset = NULL, $orderColumn, $orderType, $search)
    {
        $this->db->select('cavm.*,caicm.category_name')
            ->from('council_affiliation_vtc_master AS cavm')
             ->join('council_affiliation_institute_category_master AS caicm', 'caicm.institute_category_id_pk = cavm.institute_category_id_fk', 'left')
            ->where('cavm.vtc_active_status', 1)
            //->where('cavm.vtc_type', 3)
            ->where_in('vtc_type',['3','4','5'] )
            ->where('cavm.vtc_code',$search)
            ->order_by('cavm.vtc_code')
            ->limit($limit, $offset);
            

        return $this->db->get()->result_array();
    }


    public function getInstituteListCountBySearch($search)
    {
            $this->db->select('cavm.*')
            ->from('council_affiliation_vtc_master AS cavm')
            // ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = cavd.vtc_id_fk', 'left')
            ->where('cavm.vtc_active_status', 1)
            ->where('cavm.vtc_code',$search)
            //->where('cavm.vtc_type', 3)
            ->where_in('vtc_type',['3','4','5'] )
            ->order_by('cavm.vtc_code');
           

        return $this->db->get()->result_array();
    }


    public function getInstituteList($limit = NULL, $offset = NULL, $orderColumn, $orderType)
    {
        $this->db->select('cavm.*,caicm.category_name')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_institute_category_master AS caicm', 'caicm.institute_category_id_pk = cavm.institute_category_id_fk', 'left')
            ->where('cavm.vtc_active_status', 1)
           // ->where('cavm.vtc_type', 3)
            ->where_in('vtc_type',['3','4','5'] )
            ->order_by('cavm.vtc_code')
            ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }


    public function getInstituteListCount()
    {
        return $this->db->select("count(vtc_id_pk)")
            ->from("council_affiliation_vtc_master")
            ->where('vtc_active_status', 1)
           // ->where('vtc_type', 3)
            ->where_in('vtc_type',['3','4','5'] )
           
            ->get()->result_array();
    }


    // public function getStudentCount($institute_id_fk = null)
    // {
    //     return $this->db->select("count(institute_student_details_id_pk)")
    //     ->from("council_institute_student_details")
    //     ->where('active_status', 1)
    //     ->where('institute_id_fk', $institute_id_fk)
    //     ->where('final_save_status',1)
    //     ->get()->row_array();
    // }

    public function getStudentCount($institute_id_fk = null)
    {
        return $this->db->select("count(DISTINCT aadhar_no)")
        ->from("council_institute_student_details")
        ->where('active_status', 1)
        ->where('institute_id_fk', $institute_id_fk)
        ->where('final_save_status',1)
        ->get()->row_array();
    }

      public function getStudentListUnderinstitute($id_hash = Null)
        {
               // echo $id_hash ; die;

            return $this->db->select('isd.*,cavm.vtc_name,cavm.vtc_code,cetm.name_for_std_reg,cqdm.discipline_name,
                ciscn.reg_certificate_number')
            ->from("council_institute_student_details as isd")
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = isd.institute_id_fk', 'left')
            ->join('council_exam_type_master AS cetm', 'cetm.exam_type_id_pk = isd.exam_type_id_fk', 'left')
            ->join('council_qbm_discipline_master AS cqdm', 'cqdm.discipline_id_pk = isd.course_id_fk', 'left')
            ->join('council_institute_student_card_number_map AS ciscn', 'ciscn.institute_student_details_id_fk = isd.institute_student_details_id_pk', 'left')

            ->where('MD5(CAST(isd.institute_id_fk AS character varying)) =', $id_hash)
            ->where('isd.final_save_status',1)
            ->get()->result_array();
        }

        // public function student_own_data($stu_id_hash = null)
        // {
        //     return $this->db->select('isd.*')
        //     ->from("council_institute_student_details as isd")
        //     // ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = isd.institute_id_fk', 'left')
        //     ->where('MD5(CAST(isd.institute_student_details_id_pk AS character varying)) =', $stu_id_hash)
           
        //     ->get()->row_array();
        // }

        public function student_own_data($stu_id_hash = null)
        {
            $this->db->select('student_details.*,vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,
            discipline_master.discipline_code');
            $this->db->from('council_institute_student_details as student_details');
            $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
            $this->db->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = student_details.course_id_fk');
            // $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
            $this->db->where('md5(CAST(student_details.institute_student_details_id_pk as character varying)) =',$stu_id_hash);
            $query = $this->db->get()->row_array();
            if(!empty($query)){

            return $query;
            }else{
            $query = array();
            }

        }


        // update of student 20-02-23 start //

        public function getStdDetails($std_id_hash = NULL){

            // echo $std_id_hash ; die;

            $this->db->select('student_details.*,vtc_master.vtc_name,vtc_master.vtc_code,discipline_master.discipline_name,
                discipline_master.discipline_code');
            $this->db->from('council_institute_student_details as student_details');
            $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
            $this->db->join('council_qbm_discipline_master as discipline_master','discipline_master.discipline_id_pk = student_details.course_id_fk');
            // $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
            $this->db->where('md5(CAST(student_details.spotcouncil_student_details_id_fk as character varying)) =',$std_id_hash);
            $query = $this->db->get()->row_array();
            if(!empty($query)){
    
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

// added by 21-02-2023 
        // public function getfinalsubmitStudentCount()
        // {
        //     return $this->db->select("count(institute_student_details_id_pk)")
        //     ->from("council_institute_student_details")
        //     ->where('active_status', 1)
        //     // ->where('institute_id_fk', $institute_id_fk)
        //     ->where('final_save_status',1)
        //     ->get()->row_array();
        //     // echo $this->db->last_query();
        // }

        public function getfinalsubmitStudentCount()
        {
            return $this->db->select("count(distinct aadhar_no),")
            ->from("council_institute_student_details")
            ->where('active_status', 1)
            // ->where('institute_id_fk', $institute_id_fk)
            ->where('final_save_status',1)
            ->get()->row_array();
            // echo $this->db->last_query();
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

       public function updateLoginDetails($inst_stud_id_pk = null, $updateArray1 = NULL)
       {
        $this->db->where('stake_details_id_fk', $inst_stud_id_pk);
        $this->db->where('stake_id_fk', 29);
        // $this->db->where('institute_id_fk', $institute_id_fk);
        $this->db->update('council_stake_holder_login', $updateArray1);
		  // echo $this->db->last_query();exit; 
        return $this->db->affected_rows();
       }

       public function getInstituteDetails($vtc_name = NULL)
    {
		
		$query = $this->db->query("SELECT cavm.*,ins_cat.category_name
			FROM council_affiliation_vtc_master AS cavm
			LEFT JOIN council_affiliation_institute_category_master AS ins_cat ON ins_cat.institute_category_id_pk = cavm.institute_category_id_fk
			WHERE cavm.vtc_name iLIKE '%".$vtc_name."%'
			AND cavm.vtc_active_status = 1 AND cavm.vtc_type = 3");
		return $query->result_array();
			
    }

    public function getInsDetails($vtc_code = NULL)
    {
        $this->db->select('cavm.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->where('cavm.vtc_code', $vtc_code)
            ->where('cavm.vtc_active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }


    public function updateSpotDetails($inst_stud_id_pk = null, $updateArray1 = NULL)
    {
     $this->db->where('student_details_id_pk', $inst_stud_id_pk);
     // $this->db->where('institute_id_fk', $institute_id_fk);
     $this->db->update('council_polytechnic_spotcouncil_student_details', $updateArray1);
      // echo $this->db->last_query();exit; 
     return $this->db->affected_rows();
    }


    public function getStudentDetailsById($id_hash = NULL)
    {
        $this->db->select('student.*');
        $this->db->from('council_institute_student_details AS student');
        $this->db->where("MD5(CAST(student.institute_student_details_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }

    public function updateStudentData($student_id = NULL, $updateArray = NULL)
    {
        $this->db->where("MD5(CAST(institute_student_details_id_pk as character varying)) =", $student_id);
        $this->db->update('council_institute_student_details', $updateArray);
        // echo $this->db->last_query();
        return $this->db->affected_rows();
    }
	
	public function updateCouncil_activeDeactive_status($id_hash, $updateArray)
	{
		//echo $id_hash;exit;
		$this->db->where(
			array(
				'MD5(CAST(institute_student_details_id_pk AS character varying)) =' => $id_hash
			)
		)
		->update('council_institute_student_details',$updateArray);
		// echo $this->db->last_query(); die;	
		return $this->db->affected_rows();

    }

/// ADDED BY AVIJHIT ON 20-03-2023
     public function getStudentListByInsId_OLD($ins_id_fk){
        $this->db->select('istd.institute_student_details_id_pk,istd.spotcouncil_student_details_id_fk,istd.registration_year,istd.exam_type_id_fk,istd.institute_id_fk,cqdm.discipline_name');
        $this->db->from('council_institute_student_details as istd')
                 ->group_start()
                  ->where('istd.council_approvedreject_status =',1)
                  ->or_Where('istd.council_approvedreject_status',NULL);
                  $this->db->group_end();
        $this->db->where(array(
            'istd.final_save_status' => 1,
            'istd.approve_reject_status'=>1,
            'istd.reg_certificate_status =' => NULL,
            'istd.institute_id_fk =' => $ins_id_fk,
        ));
        
        
        $this->db->join('council_qbm_discipline_master AS cqdm', 'cqdm.discipline_id_pk = istd.course_id_fk', 'left')
        ->order_by("cqdm.discipline_name", "ASC");
          // $this->db->get();
          // echo $this->db->last_query(); die;
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }


public function insert_certificate_no($table,$insert_array){
        $this->db->insert($table,$insert_array);
        return $this->db->insert_id();
    }

  public function update_student_details($std_id=NULL,$upd_arr){

        $this->db->where('institute_student_details_id_pk', $std_id);
        $this->db->update('council_institute_student_details', $upd_arr);
        return $this->db->affected_rows();
    }

  public function get_last_certificate_no_OLD($chaking_data = NULL)
    {
        return $query = $this->db->select('max(reg_certificate_number) as code')
            ->from('council_institute_student_card_number_map')
            ->like('reg_certificate_number', ($chaking_data))
            ->get()
            ->result_array();
    }

//22-03-2023
        public function getStudentListByInsId($ins_id_fk){
        $this->db->select('istd.institute_student_details_id_pk,istd.spotcouncil_student_details_id_fk,istd.registration_year,istd.exam_type_id_fk,istd.institute_id_fk,cqdm.discipline_name');
        $this->db->from('council_institute_student_details as istd')
                 ->group_start()
                  ->where('istd.council_approvedreject_status =',1)
                  ->or_Where('istd.council_approvedreject_status',NULL);
                  $this->db->group_end();
        $this->db->where(array(
            'istd.final_save_status' => 1,
            'istd.approve_reject_status'=>1,
            'istd.reg_certificate_status =' => NULL,
            'istd.institute_id_fk =' => $ins_id_fk,
            'istd.exam_type_id_fk =' => 1,
            'istd.course_id_fk !=' => 45
        ));
        
        
        $this->db->join('council_qbm_discipline_master AS cqdm', 'cqdm.discipline_id_pk = istd.course_id_fk', 'left')
        ->order_by("cqdm.discipline_name", "ASC");
          // $this->db->get();
          // echo $this->db->last_query(); die;
        $query = $this->db->get()->result_array();
        
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }

//22-03-2023
        public function get_2nd_yr_StudentListByInsId($ins_id_fk){
        $this->db->select('istd.institute_student_details_id_pk,istd.spotcouncil_student_details_id_fk,istd.registration_year,istd.exam_type_id_fk,istd.institute_id_fk,cqdm.discipline_name');
        $this->db->from('council_institute_student_details as istd')
                 ->group_start()
                  ->where('istd.council_approvedreject_status =',1)
                  ->or_Where('istd.council_approvedreject_status',NULL);
                  $this->db->group_end();
        $this->db->where(array(
            'istd.final_save_status' => 1,
            'istd.approve_reject_status'=>1,
            'istd.reg_certificate_status =' => NULL,
            'istd.institute_id_fk =' => $ins_id_fk,
            'istd.exam_type_id_fk =' => 2,
            'istd.course_id_fk !=' => 45
        ));
        
        
        $this->db->join('council_qbm_discipline_master AS cqdm', 'cqdm.discipline_id_pk = istd.course_id_fk', 'left')
        ->order_by("cqdm.discipline_name", "ASC");
          // $this->db->get();
          // echo $this->db->last_query(); die;
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }
    public function get_last_certificate_no($chaking_data = NULL)
    {
        return $query = $this->db->select('max(reg_certificate_number) as code')
            ->from('council_institute_student_card_number_map')
            ->like('reg_certificate_number', ($chaking_data))
            ->get()
            ->result_array();
    }


    // END

    //added by moli on 23-05-23
    public function getStudentById($id_hash = NULL)
    {
		//$this->db->select('student.*');
		$this->db->select('student.institute_student_details_id_pk,student.first_name,student.middle_name, student.last_name,student.institute_id_fk');
        $this->db->from('council_institute_student_details AS student');
        $this->db->where("MD5(CAST(student.institute_student_details_id_pk as character varying)) =", $id_hash);

        return $this->db->get()->row_array();
    }

    
}
