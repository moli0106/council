<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_hs_question_model extends CI_Model {

    public function get_hs_question_paperCount(){
        $query = $this->db->select("count(hs_question_id_pk)")
            ->from("council_qbm_uploaded_hs_question_paper")
			->where(
				array(
                "active_status" => 1
				)
			)
            ->get();
        return $query->result_array();
    }

    public function get_vtc_wise_hs_question_paperCount(){
        $query = $this->db->select("count(hs_question_id_pk)")
            ->from("council_qbm_uploaded_hs_question_paper as hs_question")
            ->join("council_qbm_uploaded_hs_question_vtc_map as vtc_question_map","hs_question.hs_question_id_pk = vtc_question_map.hs_question_id_fk")
            
			->where(
				array(
                "hs_question.active_status" => 1,
                "vtc_question_map.active_status" => 1,
                "vtc_question_map.vtc_id_fk" => $this->session->userdata('stake_details_id_fk'),

				)
			)
            ->get();
        return $query->result_array();
    }

    public function getAll_hs_question_paper($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("hs_question.*,course.course_name,subject.subject_name,subject.subject_code,aca_year.academic_year")
            ->from("council_qbm_uploaded_hs_question_paper as hs_question")
			->join("council_qbm_course_master as course", "hs_question.course_id_fk = course.course_id_pk")
            ->join("council_qbm_subject_master as subject", "hs_question.subject_id_fk = subject.subject_id_pk")
            ->join("council_qbm_academic_year_master as aca_year", "aca_year.academic_year_id_pk = hs_question.academic_year_id_fk")
			->where(
				array(
                "hs_question.active_status" => 1
				)
			)
            ->limit($limit, $offset)
            ->order_by("hs_question.hs_question_id_pk", "DESC")
            ->get();
        return $query->result_array();
    }

    public function get_vtc_wise_All_hs_question_paper($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("hs_question.*,course.course_name,subject.subject_name,subject.subject_code,aca_year.academic_year")
            ->from("council_qbm_uploaded_hs_question_paper as hs_question")
			->join("council_qbm_uploaded_hs_question_vtc_map as vtc_question_map","hs_question.hs_question_id_pk = vtc_question_map.hs_question_id_fk")
			->join("council_qbm_course_master as course", "hs_question.course_id_fk = course.course_id_pk")
            ->join("council_qbm_subject_master as subject", "hs_question.subject_id_fk = subject.subject_id_pk")
            ->join("council_qbm_academic_year_master as aca_year", "aca_year.academic_year_id_pk = hs_question.academic_year_id_fk")
			->where(
				array(
                "hs_question.active_status" => 1,
                "vtc_question_map.active_status" => 1,
                "vtc_question_map.vtc_id_fk" => $this->session->userdata('stake_details_id_fk'),
				)
			)
            ->limit($limit, $offset)
            ->order_by("hs_question.hs_question_id_pk", "DESC")
            ->get();
        return $query->result_array();
    }
    public function getAllcourse(){
        $query = $this->db->select("*")
            ->from("council_qbm_course_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
			->where_in('course_id_pk',array(1,2))
            ->order_by("course_name", "ASC")
            ->get();
        return $query->result_array();
    } 
    public function getAcademicYear(){
        $query = $this->db->select("*")
            ->from("council_qbm_academic_year_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->get();
        return $query->result_array();
    } 



  
    public function get_subject_List($course_id = NULL)
    {
        $query = $this->db->select("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->from("council_qbm_subject_master as subject_mas")
            ->join("council_qbm_subject_semester_group_trade_map as sub_map","sub_map.subject_id_fk = subject_mas.subject_id_pk")
            ->where(
                array(
                    "subject_mas.active_status"     => 1,
                    "sub_map.course_id_fk"      => $course_id
                )
            )
            ->group_by("subject_mas.subject_id_pk,subject_mas.subject_name,subject_mas.subject_code")
            ->order_by("subject_mas.subject_name", "ASC")
            ->get();
        return $query->result_array();
    }
	
    public function insert_hs_question_paper($array)
    {
        $this->db->insert('council_qbm_uploaded_hs_question_paper', $array);

        return $this->db->insert_id();
    }
	
	
	public function getQuestionPaperFile($id_hash = NULL)
    {
        $query = $this->db->select("hs_question.hs_question_id_pk,hs_question.uploaded_question")
            ->from("council_qbm_uploaded_hs_question_paper as hs_question")
			
            ->where(
				array(
                "hs_question.active_status" => 1,
                "MD5(CAST(hs_question.hs_question_id_pk as character varying)) =" => $id_hash
				)
			)
            ->get();
        return $query->result_array();
    }

    public function get_hs_question_details($id_hash = NULL)
    {
        $query = $this->db->select("hs_question.*,course.course_name,subject.subject_name,subject.subject_code")
            ->from("council_qbm_uploaded_hs_question_paper as hs_question")
            ->join("council_qbm_course_master as course", "hs_question.course_id_fk = course.course_id_pk")
            ->join("council_qbm_subject_master as subject", "hs_question.subject_id_fk = subject.subject_id_pk")
			->where(
				array(
                "hs_question.active_status" => 1,
                "MD5(CAST(hs_question.hs_question_id_pk as character varying)) =" => $id_hash
				)
			)
			
            ->get();
        return $query->result_array();
    }

    public function getAllVtc($vtc_ids = NULL)
    {
        $query = $this->db->select("vtc.vtc_details_id_pk,vtc.vtc_id_fk,vtc_code,vtc_name")
            ->from("council_affiliation_vtc_details as vtc")
            ->join("council_affiliation_vtc_master as vtc_master", "vtc_master.vtc_id_pk = vtc.vtc_id_fk")
			->where(
				array(
                "vtc.active_status" => 1,
                "vtc_master.vtc_affiliated_status" => 1,
                "vtc_master.vtc_active_status" => 1,
                
				)
            );
            if($vtc_ids!=NULL){
                $query = $query->where_not_in('vtc.vtc_id_fk',$vtc_ids);
            }
            $query = $query->order_by('vtc_code');
            $query = $query->get();
        return $query->result_array();
    }

    public function get_vtc_question_map_details($id_hash = NULL)
    {
        $query = $this->db->select("vtc_question_map.hs_question_vtc_map_id_pk,vtc_question_map.vtc_id_fk,vtc_master.vtc_code,vtc_master.vtc_name")
            ->from("council_qbm_uploaded_hs_question_vtc_map as vtc_question_map")
            ->join("council_qbm_uploaded_hs_question_paper as hs_question", "hs_question.hs_question_id_pk = vtc_question_map.hs_question_id_fk")
            ->join("council_affiliation_vtc_master as vtc_master", "vtc_master.vtc_id_pk = vtc_question_map.vtc_id_fk")
			->where(
				array(
                "vtc_master.vtc_affiliated_status" => 1,
                "vtc_master.vtc_active_status" => 1,
                "vtc_question_map.active_status" =>1,
                "MD5(CAST(hs_question.hs_question_id_pk as character varying)) =" => $id_hash
				)
			)
			->order_by('vtc_code')
            ->get();
        return $query->result_array();
    }

    public function map_hs_question_paper_vtc($mapArray)
    {
        return $this->db->insert_batch('council_qbm_uploaded_hs_question_vtc_map', $mapArray); 
     }

   


}
/* End of file Master_trainer_model.php */
?>