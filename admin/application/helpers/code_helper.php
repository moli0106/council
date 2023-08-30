<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



function get_degree_name($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('degree_name');
    $ci->db->where('code', $code);
    $row = $ci->db->get('elearning_degree_code_master')->row();
    $description = $row->degree_name;
    return $description;
}         
 function get_course_name($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('course_name');
    $ci->db->where('code', $code);
    $row = $ci->db->get('elearning_course_code_master')->row();
    $description = $row->course_name;
    return $description;
} 

function get_semester_name($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('semester_name');
    $ci->db->where('code', $code);
    $row = $ci->db->get('elearning_semester_code_master')->row();
    $description = $row->semester_name;
    return $description;
}

 function get_subject_name($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('subject_name');
    $ci->db->where('code', $code);
    $row = $ci->db->get('elearning_subject_code_master')->row();
    $description = $row->subject_name;
    return $description;
}

 function get_module_name($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('module_name');
    $ci->db->where('code', $code);
    $row = $ci->db->get('elearning_module_code_master')->row();
    $description = $row->module_name;
    return $description;
}

 function get_level_name($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('level_name');
    $ci->db->where('code', $code);
    $row = $ci->db->get('elearning_level_code_master')->row();
    $description = $row->level_name;
    return $description;
}


 function fetch_right_answer($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('right_answer');
    $ci->db->where('question_no', $code);
    $row = $ci->db->get('elearning_question_bank')->row();
    $description = $row->right_answer;
    return $description;
}

function get_avg_rating($code){
    $ci=& get_instance();
    $ci->load->database();
    $ci->db->select('avg(content_rating) as avg_rating');
    $ci->db->where('reading_materials_id_fk', $code);
    $row = $ci->db->get('elearning_reading_materials_feedback_rating')->row();
    $description = $row->avg_rating;
    return $description;
}
