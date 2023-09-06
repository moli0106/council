<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Choice_filling_model extends CI_Model
{

    public function get_transfer_status($student_id){

        $this->db->select('institute_student_details_id_pk,
        tfw,
        tfw_doc,
        update_transfer_profile,
        spotcouncil_student_details_id_fk,
        transfer_for,
        transfer_status,
        institute_id_fk,
        course_id_fk,
        district_id_fk,
        madhyamik_board_id_pk,
        madhyamik_passing_year,
        madhyamik_full_marks,
        madhyamik_marks_obtain,
        madhyamik_percentage,
        gender_id_fk');
        $this->db->from('council_institute_student_details');
        $this->db-> where('spotcouncil_student_details_id_fk', $student_id);
        $this->db->where('transfer_status',1);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
        
    }

    public function getInstituteForChoiceFilling($institute_id,$course_id,$district_id_fk,$gender_id_fk){
        $this->db->select('intake.*,vtc.vtc_id_pk,vtc.vtc_name,vtc.vtc_code,discipline.discipline_name,category.category_name');
        $this->db->from('council_institute_intake_for_transfer as intake');
        $this->db->join('council_affiliation_vtc_master as vtc', 'vtc.vtc_id_pk = intake.institute_id_fk','LEFT');
        $this->db->join('council_qbm_discipline_master as discipline', 'discipline.discipline_id_pk = intake.discipline_id_fk','LEFT');
		$this->db->join('council_affiliation_institute_category_master as category','category.institute_category_id_pk=intake.institute_category_id_fk','LEFT');

        $this->db->where('available_intake >', 0);
      

        //$this->db->where('intake.institute_id_fk !=',$institute_id);
        //$this->db-> where('intake.discipline_id_fk !=', $course_id);
        $this->db-> where('intake.district_id_fk', $district_id_fk);
        if($gender_id_fk ==1){ //For Male
            $this->db->where('intake.institute_id_fk !=',4116);
        }elseif($gender_id_fk ==2){ //For Female
            $this->db->where('intake.institute_id_fk !=',4084);
        }
        
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();die;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
    
    public function getDetailsByid($student_id){
		$this->db->select('
        std.institute_student_details_id_pk,
        std.spotcouncil_student_details_id_fk,
        std.institute_id_fk,
        std.course_id_fk,
        std.gender_id_fk,
        reg_card.reg_certificate_number,
        std.date_of_birth,
        std.madhyamik_full_marks,
        std.madhyamik_marks_obtain,
        std.madhyamik_percentage,
        rank.jexpo_rank,
        rank.gpa,
        rank.percentage,
        std.caste_id_fk,
        std.tfw,
        std.transfer_for,
        std.handicapped,
        std.district_id_fk');
		$this->db->from('council_institute_student_card_number_map as reg_card');
        $this->db->join('council_institute_student_details as std', 'reg_card.institute_student_details_id_fk = std.institute_student_details_id_pk');
        $this->db->join('council_institute_student_marks_jexpo_rank_for_transfer as rank', 'reg_card.reg_certificate_number = rank.reg_certificate_number');
		$this->db->where('reg_card.spotcouncil_student_details_id_fk', $student_id);
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query[0];
		}else{
			return array();
		}

	}

    public function delete_data($id){
		$this->db->where('spotcouncil_student_details_id_fk', $id);
		$query=$this->db->delete('council_institute_course_student_transfer');
		return $query;
	}

    public function insertData($arr)
	{

		$query=$this->db->insert_batch('council_institute_course_student_transfer',$arr);
        //echo $this->db->last_query();die;
		return $query;	
	}

    public function fetch_data($student_id){
		$this->db->where('spotcouncil_student_details_id_fk',$student_id);
		$this->db->order_by('priority', 'asc');
        $query = $this->db->get('council_institute_course_student_transfer')->result_array();
		//$query=$this->db->select('*')->get('council_jexpo_seat_booking')->order_by('priority','asc')->result_array();
		return $query;
	}

    public function get_seat_details($student_id){

		$this->db->select('final_submit');
		$this->db->from('council_institute_course_student_transfer');
		$this->db->where('spotcouncil_student_details_id_fk', $student_id);
		$query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		if(!empty($query)){

			return $query[0];
		}else{
			return array();
		}
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


    public function updateStdQualifiDetails($id_hash,$upd_data){
        $this->db->where('md5(CAST(institute_student_details_id_pk as character varying)) =', $id_hash);
        $this->db->update('council_institute_student_details', $upd_data);
        return $this->db->affected_rows();
    }


    public function getAllchoiceData($arr,$order_by){
        $this->db->select('*');
        $this->db->from('council_institute_course_student_transfer');
        $this->db->where('percentage !=', 0);
        $this->db->where($arr);
        $this->db->where('final_allotement', null);
        $this->db->order_by('priority','Aesc');
       
        
        $this->db->order_by($order_by,'desc');
        

        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();die;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function check_home_dist($ins_id,$std_dist){
        $this->db->select('district_id_fk');
        $this->db->from('council_institute_intake_for_transfer');
        $this->db->where('institute_id_fk',$ins_id);
        $query = $this->db->get()->result_array();
        //echo $this->db->last_query();die;
        if(!empty($query)){
            $ins_dist = $query[0]['district_id_fk'];
            if($ins_dist == $std_dist){
                $home_dist = 1;
            }else{
                $home_dist = 0;
            }
        }else{
            $home_dist = 0;
        }
        return $home_dist;
    }

    public function get_available_intake($ins_id,$discipline_id){

        $query = $this->db->query('select institute_id_fk,discipline_id_fk,available_intake,available_intake-(
            select count(DISTINCT aa.institute_student_details_id_fk) 
            from council_institute_course_student_transfer aa where aa.institute_id = bb.institute_id_fk and aa.discipline_id_fk   = bb.discipline_id_fk and aa.final_allotement=1) 
            as available_seat from council_institute_intake_for_transfer bb where bb.institute_id_fk = '.$ins_id.' and bb.discipline_id_fk='.$discipline_id.'')->result_array();;
        
        if(!empty($query)){
            return $query[0];
        }else{
            return array();
        }
    }

    public function upd_data($table,$std_id,$transfer_id_pk,$upd_arr){
       // echo "<pre>";print_r($condition);die;
        $this->db->where('transfer_id_pk',$transfer_id_pk);
        $this->db->where('institute_student_details_id_fk',$std_id);
        $this->db->update($table,$upd_arr);
        //$this->db->last_query();exit;

        return $this->db->affected_rows();


    }

    public function upd_data1($table,$std_id,$transfer_id_pk,$upd_arr){
        // echo "<pre>";print_r($condition);die;
         $this->db->where('transfer_id_pk!=',$transfer_id_pk);
         $this->db->where('institute_student_details_id_fk',$std_id);
         $this->db->update($table,$upd_arr);
         //$this->db->last_query();exit;
 
         return $this->db->affected_rows();
 
 
     }




}