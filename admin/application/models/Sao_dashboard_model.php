<?php
defined('BASEPATH') OR exit('No direct script access allowed' );

class Sao_dashboard_model extends CI_Model {

	public function getTotalCourseCount()
	{
		$query = $this->db->select("count(course_id_pk)")
            ->from("council_course_master")
            ->where(
                array(
                    'active_status' => 1,
                )
            )
            ->get();
        return $query->row();
	}
	
    public function getTotalSectorCount()
	{
		$query = $this->db->select("count(sector_id_pk)")
            ->from("council_sector_master")
            ->where(
                array(
                    'active_status' => 1,
                )
            )
            ->get();
        return $query->row();
	}

    public function getAssessorPreRegistrationCount()
	{
		$query = $this->db->select("count(assessor_registration_details_pk)")
            ->from("council_assessor_registration_details")
            ->where('final_flag !=', TRUE)
            ->get();
        return $query->row();
	}

    public function getAssessorFinalApplicationCount()
	{
		$query = $this->db->select("count(assessor_registration_details_pk)")
            ->from("council_assessor_registration_details")
            ->where('final_flag', TRUE)
            ->get();
        return $query->row();
	}

    public function getAssessorAprovedApplicationCount()
	{
		$query = $this->db->select("count(assessor_registration_details_pk)")
            ->from("council_assessor_registration_details")
            ->where('process_status_id_fk', 5)
            ->get();
        return $query->row();
	}

    public function getAssessorRejectedApplicationCount()
	{
		$query = $this->db->select("count(assessor_registration_details_pk)")
            ->from("council_assessor_registration_details")
            ->where('process_status_id_fk', 6)
            ->get();
        return $query->row();
	}
}
