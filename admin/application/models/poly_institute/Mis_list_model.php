<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mis_list_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }


    public function getStudentListAllinstitute()
        {

            return $this->db->select('isd.*,cavm.vtc_name,cavm.vtc_code,cetm.name_for_std_reg,cqdm.discipline_name,cqdm.discipline_code,ciscn.reg_certificate_number,religion.religion_name,nationality.nationality_name,caste.caste_name,gender.gender_description,state.state_name,district.district_name,board_master.board_name')
            ->from("council_institute_student_details as isd")
            ->join('council_affiliation_vtc_master AS cavm', 'cavm.vtc_id_pk = isd.institute_id_fk', 'left')
            ->join('council_exam_type_master AS cetm', 'cetm.exam_type_id_pk = isd.exam_type_id_fk', 'left')
            ->join('council_qbm_discipline_master AS cqdm', 'cqdm.discipline_id_pk = isd.course_id_fk', 'left')
            ->join('council_institute_student_card_number_map AS ciscn', 'ciscn.institute_student_details_id_fk = isd.institute_student_details_id_pk', 'left')
            ->join('council_religion_master AS religion', 'religion.religion_id_pk = isd.religion_id_fk', 'left')
            ->join('council_nationality_master AS nationality', 'nationality.nationality_id_pk = isd.nationality_id_fk', 'left')
            ->join('council_caste_master AS caste', 'caste.caste_id_pk = isd.caste_id_fk', 'left')
            ->join('council_gender_master AS gender', 'gender.gender_id_pk = isd.gender_id_fk', 'left')
            ->join('council_state_master AS state', 'state.state_id_pk = isd.state_id_fk', 'left')
            ->join('council_district_master AS district', 'district.district_id_pk = isd.district_id_fk', 'left')
             ->join('council_board_master AS board_master', 'board_master.board_id_pk = isd.board_id_pk', 'left')
            ->where('isd.final_save_status',1)
            ->where('isd.active_status',1)
            // ->where('isd.approve_reject_status',1)
            // ->where('isd.approve_reject_status',1)
            ->get()->result_array();
        }

}