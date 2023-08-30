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

    public function getStdDetails($std_id = NULL){

        $this->db->select('student_details.*,vtc_master.vtc_name,vtc_master.vtc_code');
        $this->db->from('council_institute_student_details as student_details');
        $this->db->join('council_affiliation_vtc_master as vtc_master','vtc_master.vtc_id_pk = student_details.institute_id_fk');
        $this->db->where('student_details.spotcouncil_student_details_id_fk',$std_id);
        $query = $this->db->get()->row_array();
        if(!empty($query)){

            return $query;
        }else{
            $query = array();
        }
    }

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

        return $this->db->affected_rows();
    }

	public function updateStdQualifiDetails($id = NULL, $updateArray = NULL)
    {
        $this->db->where('institute_student_details_id_pk', $id);
        $this->db->update('council_institute_student_details', $updateArray);

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

}
?>