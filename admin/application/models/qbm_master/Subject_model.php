<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subject_model extends CI_Model {

    public function get_subjectCount(){
        $query = $this->db->select("count(subject_id_pk)")
            ->from("council_qbm_subject_master")
            ->get();
        return $query->result_array();
    }


    public function getAll_subject($limit = NULL, $offset = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_subject_master as subject")
            //->join("council_qbm_subject_semester_group_trade_map as subject_map","subject_map.subject_id_fk = subject.subject_id_pk","LEFT")
            ->limit($limit, $offset)
            ->order_by("subject_id_pk", "ASC")
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
            ->order_by("course_name", "ASC")
            ->get();
        return $query->result_array();
    } 

    public function getAllsubCategory(){
        $query = $this->db->select("*")
            ->from("council_qbm_subject_category_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->order_by("subject_category_name", "ASC")
            ->get();
        return $query->result_array();
    } 
    
   

    public function insert_subject_data($array)
    {
        $this->db->insert('council_qbm_subject_master', $array);

        return $this->db->insert_id();
    }



    public function getDisciplineList($course_code = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_discipline_master as dis_mas")
            ->join("council_qbm_course_discipline_map as dis_map","dis_map.discipline_id_fk = dis_mas.discipline_id_pk")
            ->where(
                array(
                    "dis_mas.active_status"     => 1,
                    "dis_map.course_id_fk"      => $course_code
                )
            )
            ->order_by("dis_mas.discipline_name", "ASC")
            ->get();
        return $query->result_array();
        
    }
    public function get_group_trade_List($course_id = NULL,$discipline_code = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_group_trade_master as group_mas")
            ->join("council_qbm_discipline_group_trade_map as dis_group_map","dis_group_map.group_trade_id_fk = group_mas.group_trade_id_pk")
            ->where(
                array(
                    "group_mas.active_status"           => 1,
                    "dis_group_map.discipline_id_fk"    => $discipline_code,
                    "dis_group_map.course_id_fk"        => $course_id
                )
            )
            ->order_by("group_mas.group_trade_name", "ASC")
            ->get();
        return $query->result_array();
    }
    public function get_semester_List($course_code = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_semester_master as sem")
            ->join("council_qbm_course_semester_map as sem_map","sem_map.semester_id_fk = sem.semester_id_pk")
            ->where(
                array(
                    "sem.active_status"     => 1,
                    "sem_map.course_id_fk"      => $course_code
                )
            )
            ->order_by("sem.semester_name", "ASC")
            ->get();
        return $query->result_array();
    }


    public function get_subject_details_by_id($subject_id_hash = NULL)
    {
        $query = $this->db->select("*")
            ->from("council_qbm_subject_master as subject_master")
            ->join("council_qbm_subject_semester_group_trade_map as subject_map","subject_master.subject_id_pk = subject_map.subject_id_fk","LEFT")
            ->where(
                    array(
                        "MD5(CAST(subject_master.subject_id_pk as character varying)) =" => $subject_id_hash
                    )
                )
            ->order_by("subject_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function get_hsvoc_semester()
    {
        $query = $this->db->select("*")
            ->from("council_qbm_semester_master")
            ->where(
                array(
                    "active_status"     => 1
                )
            )
            ->where_in("semester_id_pk", [1,2])
            ->order_by("semester_name", "ASC")
            ->get();
        return $query->result_array();
    }

    public function set_subject_topics_map($map_array = NULL){
        return $this->db->insert('council_qbm_subject_topics_map', $map_array);
    }


    public function get_subject_topics_chapter_by_id($subject_id_hash = NULL)
    {
        $query = $this->db->select("subject.*,topics.*,semester.*")
            ->from("council_qbm_subject_topics_map as topics")
            ->join("council_qbm_subject_master as subject","subject.subject_id_pk = topics.subject_id_fk","LEFT")
            ->join("council_qbm_semester_master as semester","semester.semester_id_pk = topics.semester_id_fk","LEFT")
            // ->join("council_qbm_semester_master as semester1","semester1.semester_id_pk = subject.sam_year_id_fk","LEFT")
            ->where(
                    array(
                        "MD5(CAST(subject.subject_id_pk as character varying)) =" => $subject_id_hash
                    )
                )
            ->order_by("subject_topics_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }


    public function get_all_subject_map_details()
    {
        $query = $this->db->select("subject_map.*,subject_master.subject_name,subject_master.subject_code,subject_master.subject_id_pk,course.course_name,disciplne.discipline_name,disciplne,discipline_code,group_trade.group_trade_name,group_trade.group_trade_code,sub_cat.subject_category_name,semester.semester_name")
            ->from("council_qbm_subject_semester_group_trade_map as subject_map")
            ->join("council_qbm_subject_master as subject_master","subject_master.subject_id_pk = subject_map.subject_id_fk","LEFT")
            ->join("council_qbm_course_master as course","course.course_id_pk = subject_map.course_id_fk","LEFT")
            ->join("council_qbm_discipline_master as disciplne","disciplne.discipline_id_pk = subject_map.discipline_id_fk","LEFT")
            ->join("council_qbm_group_trade_master as group_trade","group_trade.group_trade_id_pk = subject_map.group_trade_id_fk","LEFT")
            ->join("council_qbm_subject_category_master as sub_cat","sub_cat.subject_category_id_pk = subject_map.sub_cat_id_fk","LEFT")
            ->join("council_qbm_semester_master as semester","semester.semester_id_pk = subject_map.sam_year_id_fk","LEFT")
            ->where(
                array(
                    "subject_map.active_status"     => 1
                )
            )
            ->order_by("subject_sem_group_trade_map_id_pk", "ASC")
            ->get();
        return $query->result_array();
    }

    public function insert_subject_map_data($array)
    {
        $this->db->insert('council_qbm_subject_semester_group_trade_map', $array);

        return $this->db->insert_id();
    }

    public function get_same_subject_data_poly($course_id,$discipline_id,$sam_year_id,$subject_id){
        $query = $this->db->select("count(map.subject_sem_group_trade_map_id_pk)")
            ->from("council_qbm_subject_semester_group_trade_map as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.course_id_fk" => $course_id,
                    "map.discipline_id_fk" => $discipline_id,
                    "map.sam_year_id_fk" => $sam_year_id,
					"map.subject_id_fk"		=> $subject_id
                   
                )
            )
            ->get();
        return $query->result_array();

    }

    public function get_same_subject_data_hsvoc($course_id,$discipline_id,$group_trade_id,$subject_id){
        $query = $this->db->select("count(map.subject_sem_group_trade_map_id_pk)")
            ->from("council_qbm_subject_semester_group_trade_map as map")
            ->where(
                array(
                    "map.active_status" => 1,
                    "map.course_id_fk" => $course_id,
                    "map.discipline_id_fk" => $discipline_id,
                    "map.group_trade_id_fk" => $group_trade_id,
					"map.subject_id_fk"		=> $subject_id
                   
                )
            )
            ->get();
        return $query->result_array();

    }






    
    


}
/* End of file Master_trainer_model.php */
?>