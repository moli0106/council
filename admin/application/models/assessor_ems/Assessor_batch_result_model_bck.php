<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessor_batch_result_model extends CI_Model {

    public function getBatchCount(){
        $query = $this->db->select("count(batch_ems_id_pk)")
            ->from("council_batch_ems")
            ->where(
                array(
                    "end_date <="          => date("Y-m-d"),
					
                )
            )
            ->get();
        return $query->result_array();
    }


    public function getAllBatch($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("cbe.*, sector.sector_name, course.course_name, trainer.f_name, trainer.l_name")
            ->from("council_batch_ems AS cbe")
            ->join("council_sector_master as sector", "cbe.sector_id = sector.sector_id_pk", "left")
            ->join("council_course_master as course", "cbe.course_id = course.course_id_pk", "left")
            ->join("council_master_trainer as trainer", "cbe.trainer_id = trainer.master_trainer_id_pk", "left")
            ->where(
                array(
                    "cbe.end_date <="          => date("Y-m-d"),
					
                )
            )
            ->limit($limit, $offset)
            // ->order_by("cbe.entry_time", "ASC")
            ->get();
        return $query->result_array();
    }

    public function getBatchAssessorList($id_hash)
    {
        $query = $this->db->select("assessor.fname, assessor.lname, assessor.mobile_no, assessor.email_id,cbam.exam_status,cbam.assessor_id_fk,cbam.exam_pass_fail_status,cbam.batch_ems_id_fk")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_assessor_registration_details as assessor", "assessor.assessor_registration_details_pk = cbam.assessor_id_fk", "left")
            ->where(
                array(
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $id_hash,
                    //"exam_status"   =>2
                )
            )
            ->get();
        return $query->result_array();
    }
    
    public function getBatchDetails($id_hash)
    {
        $query = $this->db->select("cbems.*, sector.sector_name, course.course_name,trainer.f_name,trainer.l_name")
            ->from("council_batch_ems as cbems")
            ->join("council_sector_master as sector", "sector.sector_id_pk = cbems.sector_id", "left")
            ->join("council_course_master as course", "course.course_id_pk = cbems.course_id", "left")
			 ->join("council_master_trainer as trainer", "trainer.master_trainer_id_pk = cbems.trainer_id", "left")
            ->where(
                array(
                    "MD5(CAST(cbems.batch_ems_id_pk as character varying)) =" => $id_hash
                )
            )
            ->get();
        return $query->result_array();
    }


    public function getAssessorResult($assessor_id,$batch_id)
    {
        $query = $this->db->select("*")
            ->from("council_assessor_exam_result_details as result")
            ->where(
                array(
                    "MD5(CAST(result.batch_id_fk as character varying)) =" => $batch_id,
                    "MD5(CAST(result.assessor_id_fk as character varying)) =" => $assessor_id,
                    "active_status" =>1
                )
            )
            ->get();
        return $query->result_array();
    }


    public function assessor_details($assessor_id_hash)
    {
        $query = $this->db->select("assessor.assessor_registration_details_pk,assessor.fname, assessor.lname, assessor.mobile_no, assessor.email_id")
            ->from("council_assessor_registration_details as assessor")
            ->where(
                array(
                    "MD5(CAST(assessor.assessor_registration_details_pk as character varying)) =" => $assessor_id_hash,
                )
            )
            ->get();
        return $query->result_array();
    }

    public function approve_reject_result($array = NULL, $assessor_id_hash = NULL,$batch_id_hash = NULL){
        $this->db->where('md5(cast(assessor_id_fk as character varying)) =', $assessor_id_hash);
        $this->db->where('md5(cast(batch_ems_id_fk as character varying)) =', $batch_id_hash);
        return $this->db->update('council_batch_assessor_map', $array);
    }


    public function get_assessor_batch_result_details( $assessor_id_hash = NULL, $batch_id_hash=NULL)
    {
        $query = $this->db->select("cbam.*,cbems.batch_type,cbems.sector_id,cbems.course_id")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_batch_ems as cbems","cbam.batch_ems_id_fk = cbems.batch_ems_id_pk", "left")
            ->where(
                array(
                    "MD5(CAST(cbam.assessor_id_fk as character varying)) =" => $assessor_id_hash,
                    "MD5(CAST(cbam.batch_ems_id_fk as character varying)) =" => $batch_id_hash,
                )
            )
            ->where_in("cbam.exam_pass_fail_status",array(0,1))
            ->get();
        return $query->result_array();
        
    }
    public function get_batch_details( $assessor_id_hash = NULL, $batch_type=NULL)
    {
        $query = $this->db->select("cbam.*,cbems.batch_type,cbems.sector_id,cbems.course_id")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_batch_ems as cbems","cbam.batch_ems_id_fk = cbems.batch_ems_id_pk", "left")
            ->where(
                array(
                    "MD5(CAST(cbam.assessor_id_fk as character varying)) =" => $assessor_id_hash,
                    "cbems.batch_type" => $batch_type,
                    "cbam.exam_pass_fail_status"=> 1
                )
            )
            //->where_in("cbam.exam_pass_fail_status",array(0,1))
            ->get();
        return $query->result_array();
        
    }


    public function get_batch_details_domain( $assessor_id_hash = NULL, $batch_type=NULL)
    {
        $query = $this->db->select("cbam.*,cbems.batch_type,cbems.sector_id,cbems.course_id")
            ->from("council_batch_assessor_map as cbam")
            ->join("council_batch_ems as cbems","cbam.batch_ems_id_fk = cbems.batch_ems_id_pk", "left")
            ->join("council_assessor_empanelled_map as caem", "caem.assessor_id_fk = cbam.assessor_id_fk","left")
            ->where(
                array(
                    "MD5(CAST(cbam.assessor_id_fk as character varying)) =" => $assessor_id_hash,
                    "cbems.batch_type" => $batch_type,
                    "cbam.exam_pass_fail_status"=> 1
                )
            )
            //->group_start()
            //->where("caem.course_id_fk !=","cbems.course_id")
            //->where("caem.course_id_fk",NULL)
            //->group_end()
            ->get();
        return $query->result_array();
        
    }

    public function get_empanelled_data( $assessor_id = NULL, $sector_id = NULL, $course_id = NULL)
    {
        $query = $this->db->select("count(cbam.empanelled_id_pk) as count_empanelled_course")
            ->from("council_assessor_empanelled_map as cbam")
            ->where(
                array(
                    "cbam.assessor_id_fk"   => $assessor_id,
                    "cbam.sector_id_fk"     => $sector_id,
                    "cbam.course_id_fk"     => $course_id,
                    "cbam.active_status"    => 1
                )
            )
            ->get();
        return $query->result_array();
        
    }

    public function insert_assessor_empanelled($assessor_empanelled_array)
    {
        $this->db->insert('council_assessor_empanelled_map', $assessor_empanelled_array);

        return $this->db->insert_id();
    }

    

}
/* End of file Assessor_batch_result_model.php */
?>