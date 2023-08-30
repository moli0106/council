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
            ->where('cavm.vtc_type', 3)
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
            ->where('cavm.vtc_type', 3)
            ->order_by('cavm.vtc_code');
           

        return $this->db->get()->result_array();
    }


    public function getInstituteList($limit = NULL, $offset = NULL, $orderColumn, $orderType)
    {
        $this->db->select('cavm.*,caicm.category_name')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_institute_category_master AS caicm', 'caicm.institute_category_id_pk = cavm.institute_category_id_fk', 'left')
            ->where('cavm.vtc_active_status', 1)
            ->where('cavm.vtc_type', 3)
            ->order_by('cavm.vtc_code')
            ->limit($limit, $offset);

        return $this->db->get()->result_array();
    }


    public function getInstituteListCount()
    {
        return $this->db->select("count(vtc_id_pk)")
            ->from("council_affiliation_vtc_master")
            ->where('vtc_active_status', 1)
            ->where('vtc_type', 3)
           
            ->get()->result_array();
    }


    public function getStudentCount($institute_id_fk = null)
    {
        return $this->db->select("count(institute_student_details_id_pk)")
        ->from("council_institute_student_details")
        ->where('active_status', 1)
        ->where('institute_id_fk', $institute_id_fk)
       ->where('final_save_status',1)
	   //->where('testing_data !=', 1)
       
        ->get()->row_array();
    }

      public function getStudentListUnderinstitute($id_hash = Null)
        {
               // echo $id_hash ; die;

            return $this->db->select('isd.*,cavm.vtc_name,cavm.vtc_code')
            ->from("council_institute_student_details as isd")
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = isd.institute_id_fk', 'left')
            ->where('MD5(CAST(isd.institute_id_fk AS character varying)) =', $id_hash)
            ->where('isd.final_save_status',1)

            ->get()->result_array();
        }

        public function student_own_data($stu_id_hash = null)
        {
            return $this->db->select('isd.*')
            ->from("council_institute_student_details as isd")
            // ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = isd.institute_id_fk', 'left')
            ->where('MD5(CAST(isd.institute_student_details_id_pk AS character varying)) =', $stu_id_hash)
           
            ->get()->row_array();
        }

        // ADDED BY AVIJIT ON 23-02-2023
        public function getfinalsubmitStudentCount()
        {
            // return $this->db->select("count(institute_student_details_id_pk)")
            // ->from("council_institute_student_details")
            // ->where('active_status', 1)
            // // ->where('institute_id_fk', $institute_id_fk)
            // ->where('final_save_status',1)
            // ->get()->row_array();
//             select count(DISTINCT inst_stud.aadhar_no),inst_stud.institute_id_fk,master.vtc_name from council_institute_student_details as inst_stud left join council_affiliation_vtc_master 
// as master  on master.vtc_id_pk = inst_stud.institute_id_fk  where inst_stud.active_status=1 and inst_stud.final_save_status=1 
//   group by inst_stud.institute_id_fk,master.vtc_name

 return $this->db->select("count(DISTINCT inst_stud.aadhar_no),inst_stud.institute_id_fk,master.vtc_name")
             ->from("council_institute_student_details as inst_stud")
             ->join("council_affiliation_vtc_master as master","master.vtc_id_pk = inst_stud.institute_id_fk","LEFT")
             ->where('inst_stud.active_status', 1)
             ->where('inst_stud.final_save_status', 1)
             ->group_by('inst_stud.institute_id_fk,master.vtc_name')
            // ->where('final_save_status',1)
             ->get()->result_array();
             //echo $this->db->last_query(); die;
        }




    
}
