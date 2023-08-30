<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Zone_wise_student_count_model extends CI_Model
{

    public function getdistrictList()
    { 

        $this->db->select('cdm.district_id_pk,cdm.district_name')
            ->from('council_district_master AS cdm')
            ->where('cdm.active_status', 1)
            ->where('cdm.state_id_fk', 19)
            ->order_by('cdm.district_name');

           return  $this->db->get()->result_array();
            // echo $this->db->last_query();
    }

    public function get_prefzone_student_data()
    {
            $sql = "WITH table1 as (
                SELECT 
                dist.district_name,dist.district_id_pk,
                COUNT(stud.student_details_id_pk) as count1
                    
                FROM
                    council_district_master AS dist
                    LEFT JOIN council_polytechnic_spotcouncil_student_details AS stud ON dist.district_id_pk = stud.pref_zone1
                        
                    --WHERE dist.state_id_fk =19
                    GROUP BY
                   dist.district_id_pk,dist.district_name
                ORDER BY
                    dist.district_id_pk ASC),
                
                
                table2 as (
                SELECT 
                dist.district_name,dist.district_id_pk,
                COUNT(stud.student_details_id_pk) as count2
                    
                FROM
                    council_district_master AS dist
                    LEFT JOIN council_polytechnic_spotcouncil_student_details AS stud ON dist.district_id_pk = stud.pref_zone2
                        
                    -- WHERE dist.state_id_fk =19
                    GROUP BY
                   dist.district_id_pk,dist.district_name
                ORDER BY
                    dist.district_id_pk ASC)
                    select table1.district_name,table1.district_id_pk,table1.count1,table2.count2 from table1 left join table2 on table1.district_id_pk = table2.district_id_pk";
                  $query = $this->db->query($sql);
                    return $query->result_array();
    }

    // public function get_prefzone2_student_data()
    // {
    //     $query = $this->db->select("dist.district_name,count(student_details_id_pk)")
    //     ->from('council_district_master AS dist')
    //     ->where('dist.state_id_fk',19)
    //     ->join("council_polytechnic_spotcouncil_student_details AS stud","stud.pref_zone2 = dist.district_id_pk","left")
    //     ->group_by('dist.district_name')
    //     ->order_by('dist.district_name')
    //     ->get();
    //      $query->result_array();

    //      echo $this->db->last_query();die;

    //  }

}

   
