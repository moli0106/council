<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_payment_model extends CI_Model
{

    public function getStdCountByGroupForSpecialCategory($vtc_id_fk = NULL , $academic_year = NULL){
        $this->db->select('group_map.group_id_fk , group_master.group_name , group_master.group_code');
        $this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk');
        $this->db->where('group_map.vtc_id_fk' , $vtc_id_fk);
        $this->db->where('group_map.academic_year' , $academic_year);
        $this->db->where('group_map.active_status' , 1);
        $query = $this->db->get()->result_array();

        if(!empty($query)){
            
            foreach ($query as $key => $value) {
                $group_id = $value['group_id_fk'];

                

                $this->db->select('
                    COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) payment_count,
                    COUNT ( CASE WHEN "A".payment_status = '."'No'".'  and "A".approve_reject_status =1 THEN 1 ELSE NULL END ) new_addmition,
                    CASE	
                    WHEN COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) = 0 
                    AND COUNT ( CASE WHEN "A".payment_status = '."'No'".' and "A".approve_reject_status =1 THEN 1 ELSE NULL END ) >= 1 THEN
                    '."'enable'".' 
                    WHEN COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) >= 1 
                    AND COUNT ( CASE WHEN "A".payment_status = '."'No'".' and "A".approve_reject_status =1 THEN 1 ELSE NULL END ) > 0 THEN
                    '."'enable'".' ELSE '."'disable'".' 
                    END AS pay_button ,


                    COUNT ( CASE WHEN "A".eligible_for_exam = 1 THEN 1 ELSE NULL END ) eligible_count,
                ');
                $this->db->from('council_vtc_student_master AS A');
                $this->db->where('A.institute_id_fk',$vtc_id_fk);
                $this->db->where('A.year_of_registration',$academic_year);
                $this->db->where('A.course_id_fk',(int)$group_id);
                
                $student = $this->db->get()->row_array();
                //echo $this->db->last_query();exit;
                // echo "<pre>";print_r($student);exit;
                if(!empty($student)){
                    $query[$key]['payment_count'] = $student['payment_count'];
                    $query[$key]['new_addmition'] = $student['new_addmition'];
                    $query[$key]['pay_button'] = $student['pay_button'];

                    $query[$key]['eligible_count'] = $student['eligible_count'];
                }else{
                    $query[$key]['Payment_count'] = 0;
                    $query[$key]['Payment_count'] = 0;
                    $query[$key]['pay_button'] = '';


                    $query[$key]['eligible_count'] = '';
                }

                $approve_std = $this->db->select('SUM(no_of_student) as approve_student')
                ->from('council_vtc_requested_student_details AS request_std')
                ->where('request_std.approve_status',1)
                ->where('request_std.vtc_id_fk',$vtc_id_fk)
                ->where('request_std.academic_year',$academic_year)
                ->where('request_std.group_id_fk',(int)$group_id)->get()->row_array();
                
                if(!empty($approve_std['approve_student'])){

                    $query[$key]['approved_student'] = $approve_std['approve_student'];
                }else{
                    $query[$key]['approved_student'] = 0;
                }

            }
            //echo "<pre>";print_r($query);
            return $query;
        }else{
            return array();
        }


    }

    public function getStdCountByGroup($vtc_id_fk = NULL , $academic_year = NULL){
        
        $this->db->select('group_map.group_id_fk , group_master.group_name , group_master.group_code');
        $this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk');
        $this->db->where('group_map.vtc_id_fk' , $vtc_id_fk);
        $this->db->where('group_map.academic_year' , $academic_year);
        $this->db->where('group_map.active_status' , 1);
        $query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
        if(!empty($query)){
            
            foreach ($query as $key => $value) {
                $group_id = $value['group_id_fk'];

                

                $this->db->select('
                    COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) payment_count,
                    COUNT ( CASE WHEN "A".payment_status = '."'No'".'  and "A".approve_reject_status =1 THEN 1 ELSE NULL END ) new_addmition,
                    CASE	
                    WHEN COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) = 0 
                    AND COUNT ( CASE WHEN "A".payment_status = '."'No'".' and "A".approve_reject_status =1 THEN 1 ELSE NULL END ) >= 15 THEN
                    '."'enable'".' 
                    WHEN COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) >= 15 
                    AND COUNT ( CASE WHEN "A".payment_status = '."'No'".' and "A".approve_reject_status =1 THEN 1 ELSE NULL END ) > 0 THEN
                    '."'enable'".' ELSE '."'disable'".' 
                    END AS pay_button ,

                    COUNT ( CASE WHEN "A".eligible_for_exam = 1 THEN 1 ELSE NULL END ) eligible_count
                ');
                $this->db->from('council_vtc_student_master AS A');
                $this->db->where('A.institute_id_fk',$vtc_id_fk);
                $this->db->where('A.year_of_registration',$academic_year);
                $this->db->where('A.course_id_fk',(int)$group_id);
                
                $student = $this->db->get()->row_array();
                //echo $this->db->last_query();exit;
                // echo "<pre>";print_r($student);exit;
                if(!empty($student)){
                    $query[$key]['payment_count'] = $student['payment_count'];
                    $query[$key]['new_addmition'] = $student['new_addmition'];
                    $query[$key]['pay_button'] = $student['pay_button'];

                    $query[$key]['eligible_count'] = $student['eligible_count']; //11-04-2023
                }else{
                    $query[$key]['Payment_count'] = 0;
                    $query[$key]['Payment_count'] = 0;
                    $query[$key]['pay_button'] = 0;

                    $query[$key]['eligible_count'] = 0; //11-04-2023
                }

                $approve_std = $this->db->select('SUM(no_of_student) as approve_student')
                ->from('council_vtc_requested_student_details AS request_std')
                ->where('request_std.approve_status',1)
                ->where('request_std.vtc_id_fk',$vtc_id_fk)
                ->where('request_std.academic_year',$academic_year)
                ->where('request_std.group_id_fk',(int)$group_id)->get()->row_array();
                
                if(!empty($approve_std['approve_student'])){

                    $query[$key]['approved_student'] = $approve_std['approve_student'];
                }else{
                    $query[$key]['approved_student'] = 0;
                }

            }
            //echo "<pre>";print_r($query);
            return $query;
        }else{
            return array();
        }
    }




    public function getStdCountByGroupss($vtc_id_fk = NULL , $academic_year = NULL){

        $this->db->select('b.group_id_pk ,b.group_name,b.group_code,A.course_id_fk ,
            COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) Payment_count,
            COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) new_addmition,
            CASE	
            WHEN COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) = 0 
            AND COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) >= 15 THEN
            '."'enable'".' 
            WHEN COUNT ( CASE WHEN "A".payment_status = '."'Yes'".' THEN 1 ELSE NULL END ) >= 15 
            AND COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) > 0 THEN
            '."'enable'".' ELSE '."'disable'".' 
            END AS pay_button 
        ');
        $this->db->from('council_vtc_student_master AS A');
        $this->db->join('council_affiliation_group_master AS b', 'b.group_id_pk = A.course_id_fk', 'LEFT');
        $this->db->where('A.institute_id_fk',$vtc_id_fk);
        $this->db->where('A.year_of_registration',$academic_year);
        $this->db->group_by('b.group_id_pk');
        $this->db->group_by('b.group_name,A.course_id_fk,b.group_code');
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }

    public function getStudentListByGroupId($group_id , $vtc_id_fk = NULL, $academic_year = NULL){

        $this->db->select('
            student.student_id_pk,
            student.class_id_fk,
            std_academic.old_reg_no,
            std_academic.old_reg_year
        ');
        $this->db->from('council_vtc_student_master AS student');
        $this->db->join('council_vtc_student_last_examination as std_academic', 'std_academic.student_id_fk = student.student_id_pk');
        
        $this->db->where('student.institute_id_fk', $vtc_id_fk);
        $this->db->where('student.active_status', 1);
        $this->db->where('student.year_of_registration', $academic_year);
        $this->db->where('student.course_id_fk', $group_id);
        $this->db->where('student.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        $query = $this->db->get()->result_array();
        
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
        
    }

    public function insertData($table,$insert_array = NULL)
    {
        $this->db->insert($table, $insert_array);

        return $this->db->insert_id();
    }

    public function getGroupDetailsById($group_id =NULL){
       return $this->db->where('group_id_pk',$group_id)->get('council_affiliation_group_master')->row_array();
    }

    // Added by moli on 14-03-2023
    public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.*')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where('cavm.vtc_id_pk', $vtc_id)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);

        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    //10-04-2023

    public function get_std_listByGroup($vtc_id_fk,$group_id){
		$this->db->select('std.student_id_pk,
		std.course_id_fk,
		std.first_name,
		std.middle_name,
		std.last_name,
		cagm.group_code,
		std.registration_number,
        std.aadhar_no,

		std.approve_reject_status');
		$this->db->from('council_vtc_student_master as std');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = std.course_id_fk','LEFT');
		$this->db->where('std.added_by', 1);
		$this->db->where('std.active_status', 1);
		$this->db->where('std.year_of_registration', '2022-23');
		//$this->db->where('std.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
		//$this->db->where('std.payment_status', 'Yes');
		
		$this->db->where('std.institute_id_fk', $vtc_id_fk);
		$this->db->where('std.course_id_fk', $group_id);
		return $query =$this->db->get()->result_array();
		//echo "<pre>";print_r($query);exit;
	}

    public function get_group_details($group_id){
		$this->db->select('group_name,group_code')
		->from('council_affiliation_group_master')
		->where('group_id_pk',$group_id);
		$query = $this->db->get()->row_array();
		return $query;
	}

}