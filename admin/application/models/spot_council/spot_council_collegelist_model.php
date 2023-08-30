<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spot_council_collegelist_model extends CI_Model
{

    public function get_discipline()
    {
        $query = $this->db->select("discipline.discipline_id_pk,discipline.discipline_name")
            ->from("council_polytechnic_spotcouncil_discipline_master as discipline")
            ->where(
                array(
                    "discipline.active_status" => 1
                )
            )
            ->order_by('discipline.discipline_name')
            ->get();
        return $query->result_array();
    }

    public function get_castes()
    {
        $query = $this->db->select("caste.caste_id_pk,caste.caste_name")
            ->from("council_caste_master as caste")
            ->where(
                array(
                    "caste.active_status" => 1,

                )
            )
            ->order_by('caste.caste_name')
            ->get();
        return $query->result_array();
    }

    public function get_college()
    {
        $query = $this->db->select("college.college_id_pk,college.college_name")
        ->from("council_polytechnic_spotcouncil_college_master as college")
        ->where(
            array(
                "college.active_status" => 1,

            )
        )
        ->order_by('college.college_name')
        ->get();
    return $query->result_array(); 
    }

    public function get_college_list_map_count()
    {
        $query = $this->db->select("DISTINCT(college_id_fk)")
            ->from("council_polytechnic_spotcouncil_college_map_details")
            ->get();
        return $query->result_array();
    }


   /* public function get_vacent_college_list($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("map.college_map_id_pk,college.college_id_pk,college.college_name,college.total_vacent_place,college.college_code,college.college_type,college.district_id_fk,map.no_vacent_place,discipline.discipline_name,caste.caste_name")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")
            ->join("council_polytechnic_spotcouncil_discipline_master as discipline", " discipline.discipline_id_pk = map.discipline_id_fk", "LEFT")
            ->join("council_caste_master as caste", " caste.caste_id_pk = map.caste_id_fk", "LEFT")
            ->join("council_polytechnic_spotcouncil_college_master as college", " college.college_id_pk = map.college_id_fk", "LEFT")
            ->where(
                array(
                    "map.active_status" => 1
                )
            )
            ->limit($limit, $offset)
            ->order_by('map.college_map_id_pk', 'DESC')
            ->get();
            // echo $this->db->last_query(); die;
        return $query->result_array();
    } */

    public function search_vacent_college_list($discipline = NULL, $college = NULL)
    {
        $query = $this->db->select("college.college_name,college.college_code,college.college_type,college.total_vacent_place,map.college_id_fk,map.discipline_id_fk,discipline.discipline_name,district.district_name")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")
        ->join("council_polytechnic_spotcouncil_discipline_master as discipline", " discipline.discipline_id_pk = map.discipline_id_fk", "LEFT")
        ->join("council_polytechnic_spotcouncil_college_master as college", "college.college_id_pk = map.college_id_fk", "LEFT")
        ->join("council_district_master as district", "district.district_id_pk = college.district_id_fk", "LEFT")
        ->group_by("college.college_name,discipline.discipline_name,map.college_id_fk,map.discipline_id_fk,college.college_code,college.college_type,college.total_vacent_place,district.district_name");

        if ($discipline != '' && $college != '') {
            $query = $query->where(
                array(
                    "map.active_status"         => 1,
                    "map.discipline_id_fk"       => (int)$discipline,
                    "map.college_id_fk" => (int)$college,
                )
            );
        } elseif ($discipline == '' && $college != '') {
            $query = $query->where(
                array(
                    "map.active_status"         => 1,
                    "map.college_id_fk"       => (int)$college,
                )
            );
        } elseif ($discipline != '' && $college == '') {
            $query = $query->where(
                array(
                    "map.active_status"         => 1,
                    "map.discipline_id_fk" => (int)$discipline,
                )
            );
        }else{
    
            $query = $query->where(
            array(
                "map.active_status"     => '1',
                
            )
            );
        }


        $query = $query->get()->result_array();
    // echo "<pre>";print_r($query);exit;
    foreach($query as $key=>$val)
    {
        $dis_id = $val['discipline_id_fk'];
        $clg_id = $val['college_id_fk'];
        

        $gen_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")

        ->where(
            array(
                "map.active_status"     => 1,
                "map.discipline_id_fk"     =>$dis_id,
                "map.college_id_fk"     => $clg_id,
                "map.caste_id_fk"     => 1,

                
            )
            )
            ->get()->row_array();

            $sc_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")

        ->where(
            array(
                "map.active_status"     => 1,
                "map.discipline_id_fk"     =>$dis_id,
                "map.college_id_fk"     => $clg_id,
                "map.caste_id_fk"     => 2,

                
            )
            )
            ->get()->row_array();

            $st_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")

        ->where(
            array(
                "map.active_status"     => 1,
                "map.discipline_id_fk"     =>$dis_id,
                "map.college_id_fk"     => $clg_id,
                "map.caste_id_fk"     => 3,

                
            )
            )
            ->get()->row_array();

            $obc_a_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")

        ->where(
            array(
                "map.active_status"     => 1,
                "map.discipline_id_fk"     =>$dis_id,
                "map.college_id_fk"     => $clg_id,
                "map.caste_id_fk"     => 4,

                
            )
            )
            ->get()->row_array();

            $obc_b_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")

        ->where(
            array(
                "map.active_status"     => 1,
                "map.discipline_id_fk"     =>$dis_id,
                "map.college_id_fk"     => $clg_id,
                "map.caste_id_fk"     => 5,

                
            )
            )
            ->get()->row_array();

            $pc_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
        ->from("council_polytechnic_spotcouncil_college_map_details as map")

        ->where(
            array(
                "map.active_status"     => 1,
                "map.discipline_id_fk"     =>$dis_id,
                "map.college_id_fk"     => $clg_id,
                "map.caste_id_fk"     => 6,

                
            )
            )
            ->get()->row_array();

            $query[$key]['gen_count'] =(($gen_count['no_vacent_place']!=0)? $gen_count['no_vacent_place'] : 0);
            $query[$key]['sc_count'] =(($sc_count['no_vacent_place']!=0) ? $sc_count['no_vacent_place'] : 0);

            $query[$key]['st_count'] =(($st_count['no_vacent_place']!=0) ? $st_count['no_vacent_place'] : 0);

            $query[$key]['obc_a_count'] =(($obc_a_count['no_vacent_place']!=0) ? $obc_a_count['no_vacent_place'] : 0);

            $query[$key]['obc_b_count'] =(($obc_b_count['no_vacent_place']!=0) ? $obc_b_count['no_vacent_place'] : 0);

            $query[$key]['pc_count'] =(($pc_count['no_vacent_place']) ? $pc_count['no_vacent_place'] : 0);
        
    }

     //echo '<pre>'; print_r($query);die;
        return $query;
   
    }


    public function get_student_details($limit = NULL, $offset = NULL)
    {

        $query = $this->db->select("std.student_details_id_pk,std.enrolment_number,std.index_number,std.candidate_name,std.date_of_birth,std.guardian_name,std.mobile_number,caste.caste_name,std.physically_challenged,std.land_looser,std.applied_under_tfw,std.wards_of_exserviceman,std.district_from_where_passed_madhyamik_or_equivakent_examination")
            ->from("council_polytechnic_spotcouncil_student_details as std")
            ->join("council_caste_master as caste", " caste.caste_id_pk = std.caste_id_fk", "LEFT")
            ->where(
                array(
                    "std.active_status" => 1,

                )
            )
            ->limit($limit, $offset)
            ->order_by('std.enrolment_number')
            ->get();
        return $query->result_array();
    }

    public function search_student_records($application_id)
    {
        $query = $this->db->select("std.student_details_id_pk,std.application_form_no,std.candidate_name,std.date_of_birth,std.guardian_name,std.mobile_number,caste.caste_name,std.handicapped,std.picture,std.sign,std.application_form_no")
            ->from("council_polytechnic_spotcouncil_student_details as std")
            ->join("council_caste_master as caste", " caste.caste_id_pk = std.caste_id_fk", "LEFT")
            ->where(
                array(
                    "std.application_form_no" => $application_id,
                    "std.pre_admission_status" => 1,
                )
            )
            ->get();
            // echo $this->db->last_query(); die;
        return $query->row_array();
    }

    public function generatePdf($std_id_hash = NULL)
    {
     
        return $this->db->select('std.student_details_id_pk,std.enrolment_number,std.application_form_no,std.candidate_name,std.date_of_birth,std.guardian_name,std.mobile_number,std.caste_id_fk,caste.caste_name,std.handicapped,std.land_looser,std.applied_under_tfw,std.wards_of_exserviceman,std.district_from_where_passed_madhyamik_or_equivakent_examination,std.picture,sign,std.final_allotment_letter_no,std.entry_time,std.active_status,std.general_rank,std.sc_rank,std.st_rank,std.pc_rank,std.institute_name,std.course_id_fk,course.course_name,std.college_id_fk,student_college_map.student_college_mapid_pk')
            ->from('council_polytechnic_spotcouncil_student_details as std')
            ->join("council_caste_master as caste", " caste.caste_id_pk = std.caste_id_fk", "LEFT")
            ->join("council_spot_course_master as course", " course.course_id_pk = std.course_id_fk", "LEFT")
            ->join("council_polytechnic_spotcouncil_student_college_map as student_college_map", " student_college_map.student_details_id_fk = std.student_details_id_pk", "LEFT")
            ->where('std.active_status', 1)
            ->where('MD5(CAST(student_details_id_pk as character varying)) =', $std_id_hash)
            ->get()->result_array();
    }

    public function get_collge_details($college_id_hash,$college_map_id)
    {
        // echo $caste_id; die;

        $query = $this->db->select("map.no_vacent_place,map.college_id_fk,map.caste_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.college_map_id_pk" => (int)$college_map_id,
                    "MD5(CAST(map.college_id_fk as character varying)) =" => $college_id_hash
                )
            )
            ->get()->row_array();
        //    echo $this->db->last_query(); die;
        //    echo '<pre>';
        //    print_r($query);
        //    die;
        return $query;
    }

    public function insert_college_student_map($college_student_map = null)
    {

        $this->db->insert('council_polytechnic_spotcouncil_student_college_map', $college_student_map);

        return $this->db->insert_id();
    }

    public function update_no_vacent_data($update_no_vacent_place, $college_map_id)
    {

        // print_r($college_map_id);die;
        $this->db->where('college_map_id_pk',$college_map_id)
            ->set('no_vacent_place', $update_no_vacent_place)
            ->update('council_polytechnic_spotcouncil_college_map_details');
        return $this->db->affected_rows();
        // $this->db->last_query() ; die;
    }

    public function update_preadmission_booking_status($student_id_hash = null)
    {
        $this->db->where(
            array(
                'md5(cast(student_id_fk as character varying))=' => $student_id_hash,
                
            )
        )
            ->set('booking_status', 1)
            ->update('council_polytechnic_spotcouncil_pre_admission_details');
        return $this->db->affected_rows(); 
    }

    public function get_booking_details($student_id_hash)
    {
        // echo $student_id_hash; die;
        $query = $this->db->select("student_details_id_fk,active_status")
            ->from("council_polytechnic_spotcouncil_student_college_map")
            ->where(
                array(
                    "active_status"     => '1',
                    "MD5(CAST(student_details_id_fk as character varying)) =" => $student_id_hash
                )
            )
            ->get();
        return $query->row_array();
    }

    public function get_collegearray_list($limit = NULL , $offset = NUll)
    {
        $query = $this->db->select("college.college_name,college.college_code,college.college_type,college.total_vacent_place,map.college_id_fk,map.discipline_id_fk,discipline.discipline_name,district.district_name")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")
            ->join("council_polytechnic_spotcouncil_discipline_master as discipline", " discipline.discipline_id_pk = map.discipline_id_fk", "LEFT")
            ->join("council_polytechnic_spotcouncil_college_master as college", "college.college_id_pk = map.college_id_fk", "LEFT")
            ->join("council_district_master as district", "district.district_id_pk = college.district_id_fk", "LEFT")
            ->group_by("college.college_name,discipline.discipline_name,map.college_id_fk,map.discipline_id_fk,college.college_code,college.college_type,college.total_vacent_place,district.district_name")
            ->order_by("college.college_name")
            ->where(
                array(
                    "map.active_status"     => '1',
                    
                )
            ) 
            ->limit($limit, $offset)
            ->get();
        $college_listarray = $query->result_array();
        // echo "<pre>";print_r($college_listarray);exit;
        foreach($college_listarray as $key=>$val)
        {
            $dis_id = $val['discipline_id_fk'];
            $clg_id = $val['college_id_fk'];
            

            $gen_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")

            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.discipline_id_fk"     =>$dis_id,
                    "map.college_id_fk"     => $clg_id,
                    "map.caste_id_fk"     => 1,

                    
                )
                )
                ->get()->row_array();

                $sc_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")

            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.discipline_id_fk"     =>$dis_id,
                    "map.college_id_fk"     => $clg_id,
                    "map.caste_id_fk"     => 2,

                    
                )
                )
                ->get()->row_array();

                $st_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")

            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.discipline_id_fk"     =>$dis_id,
                    "map.college_id_fk"     => $clg_id,
                    "map.caste_id_fk"     => 3,

                    
                )
                )
                ->get()->row_array();

                $obc_a_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")

            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.discipline_id_fk"     =>$dis_id,
                    "map.college_id_fk"     => $clg_id,
                    "map.caste_id_fk"     => 4,

                    
                )
                )
                ->get()->row_array();

                $obc_b_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")

            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.discipline_id_fk"     =>$dis_id,
                    "map.college_id_fk"     => $clg_id,
                    "map.caste_id_fk"     => 5,

                    
                )
                )
                ->get()->row_array();

                $pc_count = $this->db->select("map.no_vacent_place,map.college_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")

            ->where(
                array(
                    "map.active_status"     => 1,
                    "map.discipline_id_fk"     =>$dis_id,
                    "map.college_id_fk"     => $clg_id,
                    "map.caste_id_fk"     => 6,

                    
                )
                )
                ->get()->row_array();

                $college_listarray[$key]['gen_count'] =(($gen_count['no_vacent_place'] !=0)? $gen_count['no_vacent_place'] : 0);
                $college_listarray[$key]['sc_count'] =(($sc_count['no_vacent_place'] !=0)? $sc_count['no_vacent_place'] : 0);

                $college_listarray[$key]['st_count'] =(($st_count['no_vacent_place'] !=0)? $st_count['no_vacent_place'] : 0);

                $college_listarray[$key]['obc_a_count'] =(($obc_a_count['no_vacent_place']!=0)? $obc_a_count['no_vacent_place'] : 0);

                $college_listarray[$key]['obc_b_count'] =(($obc_b_count['no_vacent_place']!=0) ? $obc_b_count['no_vacent_place'] : 0);

                $college_listarray[$key]['pc_count'] =(($pc_count['no_vacent_place']!=0) ? $pc_count['no_vacent_place'] : 0);
            
        }

        //  echo '<pre>'; print_r($college_listarray);die;
        return $college_listarray;
        
        

    }

    public function college_map_details($college_id_hash,$caste_id_fk, $discipline_id_fk)
    {
        $query = $this->db->select("college_map.college_map_id_pk ,college_master.college_name, college_master.college_code")
        ->from("council_polytechnic_spotcouncil_college_map_details as college_map")
        ->join("council_polytechnic_spotcouncil_college_master as college_master" , "college_master.college_id_pk = college_map.college_id_fk")
        ->where(
            array(
                "college_map.active_status"        => '1',
                "MD5(CAST(college_map.college_id_fk as character varying)) =" => $college_id_hash,
                "college_map.caste_id_fk"          => $caste_id_fk,
                "college_map.discipline_id_fk"     => $discipline_id_fk,
            )
        )
        ->get();
    return $query->row_array();
    // echo $this->db->last_query(); die;
    }


    public function get_pc_rank_array()
    {
        $query = $this->db->select("pre_admission_id_pk,pc_rank")
        ->from("council_polytechnic_spotcouncil_pre_admission_details")
        ->where(
            array(
                "booking_status" => 0,
                "active_status" => 1,
            )
        )
        // ech $this->db->last_query(); die;
        ->get()->result_array();
        $pcRankArray =array();
        if(!empty($query)){

            foreach($query as $val){
                $pc_rank = $val['pc_rank'];
                array_push($pcRankArray,$pc_rank);
            }
        }
        return $pcRankArray;
    }


    public function get_general_rank_array()
    {
        $query = $this->db->select("pre_admission_id_pk,general_rank")
        ->from("council_polytechnic_spotcouncil_pre_admission_details")
        ->where(
            array(
                "booking_status" => 0,
                "active_status" => 1,
            )
        )
        // ech $this->db->last_query(); die;
        ->get()->result_array();
        $generalRankArray =array();
        if(!empty($query)){

            foreach($query as $val){
                $general_rank = $val['general_rank'];
                array_push($generalRankArray,$general_rank);
            }
        }
        return $generalRankArray;
    }

    public function get_sc_rank_array()
    {
        $query = $this->db->select("pre_admission_id_pk,sc_rank")
        ->from("council_polytechnic_spotcouncil_pre_admission_details")
        ->where(
            array(
                "booking_status" => 0,
                "active_status" => 1,
            )
        )
        // ->get();
        // echo $this->db->last_query(); die;
        ->get()->result_array();
        $scRankArray =array();
        if(!empty($query)){

            foreach($query as $val){
                $sc_rank = $val['sc_rank'];
                array_push($scRankArray,$sc_rank);
            }
        }
        return $scRankArray;
    }

    public function get_st_rank_array()
    {
        $query = $this->db->select("pre_admission_id_pk,st_rank")
        ->from("council_polytechnic_spotcouncil_pre_admission_details")
        ->where(
            array(
                "booking_status" => 0,
                "active_status" => 1,
            )
        )
        // ->get();
        // echo $this->db->last_query(); die;
        ->get()->result_array();
        $stRankArray =array();
        if(!empty($query)){

            foreach($query as $val){
                $st_rank = $val['st_rank'];
                array_push($stRankArray,$st_rank);
            }
        }
        return $stRankArray;
    }

    public function get_collge_pCVacancy($college_id_hash,$clg_discipline_id_fk)
    {
        // echo $caste_id; die;

        $query = $this->db->select("map.no_vacent_place,map.college_id_fk,map.caste_id_fk,map.discipline_id_fk")
            ->from("council_polytechnic_spotcouncil_college_map_details as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.discipline_id_fk" => (int)$clg_discipline_id_fk,
                    "MD5(CAST(map.college_id_fk as character varying)) =" => $college_id_hash
                )
            )
            ->get()->row_array();
        
        return $query;
    }

    // sudeshna //

    // public function generatePdf($std_id_hash = NULL)
    // {
     
    //     return $this->db->select('std.student_details_id_pk,std.enrolment_number,std.application_form_no,std.candidate_name,std.date_of_birth,std.guardian_name,std.mobile_number,std.caste_id_fk,caste.caste_name,std.handicapped,std.land_looser,std.applied_under_tfw,std.wards_of_exserviceman,std.district_from_where_passed_madhyamik_or_equivakent_examination,std.picture,sign,std.final_allotment_letter_no,std.entry_time,std.active_status,std.general_rank,std.sc_rank,std.st_rank,std.pc_rank,std.institute_name,std.course_id_fk,course.course_name,std.college_id_fk,student_college_map.student_college_mapid_pk')
    //         ->from('council_polytechnic_spotcouncil_student_details as std')
    //         ->join("council_caste_master as caste", " caste.caste_id_pk = std.caste_id_fk", "LEFT")
    //         ->join("council_spot_course_master as course", " course.course_id_pk = std.course_id_fk", "LEFT")
    //         ->join("council_polytechnic_spotcouncil_student_college_map as student_college_map", " student_college_map.student_details_id_fk = std.student_details_id_pk", "LEFT")
    //         ->where('std.active_status', 1)
    //         ->where('MD5(CAST(student_details_id_pk as character varying)) =', $std_id_hash)
    //         ->get()->result_array();
    // }

    // end sudeshna

  
}

       

