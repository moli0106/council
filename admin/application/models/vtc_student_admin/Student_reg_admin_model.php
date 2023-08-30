<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_reg_admin_model extends CI_Model
{
    public function getAcademicYearList(){
        $this->db->from('council_affiliation_academic_year_master')->where('active_status', 1);
        return $this->db->get()->result_array();
    }

    public function getAllData_old($limit = NULL, $offset = NULL){
		//echo "hii";exit;
        $this->db->select('
                    A.institute_id_fk,
					cavm.vtc_code,
					cavm.vtc_name,
					A.course_id_fk,
					cagm.group_code,
					sbi.posting_amount,
					COUNT ( "A".student_id_pk ) total_student,
					COUNT ( CASE WHEN "A".kanyashree_no IS NOT NULL THEN 1 ELSE NULL END ) having_kanyashree,
					COUNT ( CASE WHEN "A".kanyashree_no IS NULL THEN 1 ELSE NULL END ) not_having_kanyashree,
					COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) new_addmition
                     
                ');
        $this->db->from('council_vtc_student_master as A');
        $this->db->join('council_affiliation_vtc_master as cavm', 'cavm.vtc_id_pk = A.institute_id_fk','LEFT');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = A.course_id_fk','LEFT');
		$this->db->join('council_sbi_payment_transanction_log_details as sbi', 'sbi.stake_details_id_fk = A.institute_id_fk AND sbi.stake_id_fk = 15  and sbi.payment_type_id_fk = 1 and sbi.response_status = 1','LEFT');
        
        $this->db->where('A.added_by', 1);
        $this->db->where('A.active_status', 1);
        $this->db->where('A.year_of_registration', '2022-23');
        $this->db->where('A.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        //$this->db->group_by(array('A.institute_id_fk', 'A.course_id_fk', 'cavm.vtc_code', 'cavm.vtc_name','cagm.group_code','sbi.posting_amount'));
		$this->db->group_by('A.institute_id_fk');
		$this->db->group_by('A.course_id_fk');
		$this->db->group_by('cavm.vtc_code');
		$this->db->group_by('cavm.vtc_name');
		$this->db->group_by('cagm.group_code');
		$this->db->group_by('sbi.posting_amount');
		$this->db->order_by('cavm.vtc_code','asc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
	
	
    public function getAllData($limit = NULL, $offset = NULL){
		//echo "hii";exit;
		
		$vtc_type = ['1','2'];
        $this->db->select('
                    A.institute_id_fk,
					cavm.vtc_code,
					cavm.vtc_name,
					A.course_id_fk,
					cagm.group_code,
					
					COUNT ( "A".student_id_pk ) total_student,
					COUNT ( CASE WHEN "A".kanyashree_no IS NOT NULL THEN 1 ELSE NULL END ) having_kanyashree,
					COUNT ( CASE WHEN "A".kanyashree_no IS NULL THEN 1 ELSE NULL END ) not_having_kanyashree,
					COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) new_addmition
                     
                ');
        $this->db->from('council_vtc_student_master as A');
        $this->db->join('council_affiliation_vtc_master as cavm', 'cavm.vtc_id_pk = A.institute_id_fk','LEFT');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = A.course_id_fk','LEFT');
		//$this->db->join('council_sbi_payment_transanction_log_details as sbi', 'sbi.stake_details_id_fk = A.institute_id_fk AND sbi.stake_id_fk = 15  and sbi.payment_type_id_fk = 1 and sbi.response_status = 1','LEFT');
        //$this->db->join('council_vtc_student_payment_lot as lot', 'lot.group_id_fk = A.course_id_fk','LEFT');
        $this->db->where('A.added_by', 1);
        $this->db->where('A.active_status', 1);
        $this->db->where('A.year_of_registration', '2022-23');
        $this->db->where('A.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        //$this->db->group_by(array('A.institute_id_fk', 'A.course_id_fk', 'cavm.vtc_code', 'cavm.vtc_name','cagm.group_code','sbi.posting_amount'));
		
		
		$this->db->where_in('cavm.vtc_type', $vtc_type);
		//$this->db->where('cavm.vtc_type', 1);
		
		
		$this->db->group_by('A.institute_id_fk');
		$this->db->group_by('A.course_id_fk');
		$this->db->group_by('cavm.vtc_code');
		$this->db->group_by('cavm.vtc_name');
		$this->db->group_by('cagm.group_code');
		//$this->db->group_by('lot.transanction_log_id_fk');
		$this->db->order_by('cavm.vtc_code','asc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($query)){
			
			foreach($query as $key =>$value){
				$institute_id_fk = $value['institute_id_fk'];
				$course_id_fk = $value['course_id_fk'];
				$amount = $this->db->select('lot.transanction_log_id_fk,sbi.posting_amount')
				->from('council_vtc_student_payment_lot as lot')
				->join('council_sbi_payment_transanction_log_details as sbi', 'sbi.transaction_log_id_pk = lot.transanction_log_id_fk')
				->where('lot.group_id_fk',$course_id_fk)
				->where(array(
					'lot.vtc_id_fk' =>$institute_id_fk,
					'lot.response_status' =>1,
					'sbi.payment_type_id_fk' =>1,
					'sbi.stake_setails_id_fk' => $institute_id_fk,
					'sbi.stake_id_fk' =>15
				))
				->get()->row_array();
				$query[$key]['posting_amount'] = $amount['posting_amount'];
			}
            return $query;
        }else{
            return array();
        }
    }
	
	public function getAllDataCount(){
		//echo "hii";exit;
		
		$vtc_type = ['1','2'];
		
		
        $this->db->select('
                    A.institute_id_fk,
					cavm.vtc_code,
					cavm.vtc_name,
					A.course_id_fk,
					cagm.group_code,
					
					COUNT ( "A".student_id_pk ) total_student,
					COUNT ( CASE WHEN "A".kanyashree_no IS NOT NULL THEN 1 ELSE NULL END ) having_kanyashree,
					COUNT ( CASE WHEN "A".kanyashree_no IS NULL THEN 1 ELSE NULL END ) not_having_kanyashree,
					COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) new_addmition
                     
                ');
        $this->db->from('council_vtc_student_master as A');
        $this->db->join('council_affiliation_vtc_master as cavm', 'cavm.vtc_id_pk = A.institute_id_fk','LEFT');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = A.course_id_fk','LEFT');
		//$this->db->join('council_sbi_payment_transanction_log_details as sbi', 'sbi.stake_details_id_fk = A.institute_id_fk AND sbi.stake_id_fk = 15  and sbi.payment_type_id_fk = 1 and sbi.response_status = 1','LEFT');
        
        $this->db->where('A.added_by', 1);
        $this->db->where('A.active_status', 1);
        $this->db->where('A.year_of_registration', '2022-23');
        $this->db->where('A.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        //$this->db->group_by(array('A.institute_id_fk', 'A.course_id_fk', 'cavm.vtc_code', 'cavm.vtc_name','cagm.group_code','sbi.posting_amount'));
		
		$this->db->where_in('cavm.vtc_type', $vtc_type);
		
		$this->db->group_by('A.institute_id_fk');
		$this->db->group_by('A.course_id_fk');
		$this->db->group_by('cavm.vtc_code');
		$this->db->group_by('cavm.vtc_name');
		$this->db->group_by('cagm.group_code');
		//$this->db->group_by('sbi.posting_amount');
		$this->db->order_by('cavm.vtc_code','asc');
		
		$query = $this->db->get()->result_array(); 
        //echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }
	
	public function getAllDataBySearch($vtc_code){
		
		$this->db->select('
                    A.institute_id_fk,
					cavm.vtc_code,
					cavm.vtc_name,
					A.course_id_fk,
					cagm.group_code,
					
					COUNT ( "A".student_id_pk ) total_student,
					COUNT ( CASE WHEN "A".kanyashree_no IS NOT NULL THEN 1 ELSE NULL END ) having_kanyashree,
					COUNT ( CASE WHEN "A".kanyashree_no IS NULL THEN 1 ELSE NULL END ) not_having_kanyashree,
					COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) new_addmition
                     
                ');
        $this->db->from('council_vtc_student_master as A');
        $this->db->join('council_affiliation_vtc_master as cavm', 'cavm.vtc_id_pk = A.institute_id_fk','LEFT');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = A.course_id_fk','LEFT');
		
        $this->db->where('A.added_by', 1);
        $this->db->where('A.active_status', 1);
        $this->db->where('A.year_of_registration', '2022-23');
        $this->db->where('A.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
        $this->db->where('A.institute_code', $vtc_code);
		
		$this->db->group_by('A.institute_id_fk');
		$this->db->group_by('A.course_id_fk');
		$this->db->group_by('cavm.vtc_code');
		$this->db->group_by('cavm.vtc_name');
		$this->db->group_by('cagm.group_code');
		$this->db->order_by('cavm.vtc_code','asc');
		$this->db->limit($limit, $offset);
		$query = $this->db->get()->result_array();
        //echo $this->db->last_query();exit;
        if(!empty($query)){
			
			foreach($query as $key =>$value){
				$institute_id_fk = $value['institute_id_fk'];
				$course_id_fk = $value['course_id_fk'];
				$amount = $this->db->select('lot.transanction_log_id_fk,sbi.posting_amount')
				->from('council_vtc_student_payment_lot as lot')
				->join('council_sbi_payment_transanction_log_details as sbi', 'sbi.transaction_log_id_pk = lot.transanction_log_id_fk')
				->where('lot.group_id_fk',$course_id_fk)
				->where(array(
					'lot.vtc_id_fk' =>$institute_id_fk,
					'lot.response_status' =>1
				))
				->get()->row_array();
				$query[$key]['posting_amount'] = $amount['posting_amount'];
			}
            return $query;
        }else{
            return array();
        }
		
	}

	public function getVtcDetails($vtc_id = NULL, $academic_year = NULL)
    {
        $this->db->select('cavm.*, cavd.vtc_id_fk,cavd.academic_year')
            ->from('council_affiliation_vtc_master AS cavm')
            ->join('council_affiliation_vtc_details AS cavd', 'cavd.vtc_id_fk = cavm.vtc_id_pk', 'left')
            ->where("MD5(CAST(cavm.vtc_id_pk as character varying)) =", $vtc_id)
            ->where('cavd.academic_year', $academic_year)
            ->where('cavd.active_status', 1);
        $query = $this->db->get()->result_array();

        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }


	public function getAllDataByVTCID($vtc_id_fk, $academic_year){
		$this->db->select('group_map.group_id_fk , group_master.group_name , group_master.group_code');
        $this->db->from('council_affiliation_vtc_course_selection_group_map as group_map');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = group_map.group_id_fk');
        $this->db->where('group_map.vtc_id_fk' , $vtc_id_fk);
        $this->db->where('group_map.academic_year' , $academic_year);
        $this->db->where('group_map.active_status' , 1);
        $query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
		//echo "<pre>";print_r($query);exit;
		if(!empty($query)){
            
            foreach ($query as $key => $value) {
                $group_id = $value['group_id_fk'];

				$this->db->select('
					A.institute_id_fk,
					
					A.course_id_fk,
					cagm.group_code,
					COUNT ( "A".student_id_pk ) total_student,
					COUNT ( CASE WHEN "A".kanyashree_no IS NOT NULL THEN 1 ELSE NULL END ) having_kanyashree,
					COUNT ( CASE WHEN "A".kanyashree_no IS NULL THEN 1 ELSE NULL END ) not_having_kanyashree,
					COUNT ( CASE WHEN "A".payment_status = '."'No'".' THEN 1 ELSE NULL END ) new_addmition
					
				');
				$this->db->from('council_vtc_student_master as A');
				$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = A.course_id_fk','LEFT');
				$this->db->where('A.added_by', 1);
				$this->db->where('A.active_status', 1);
				$this->db->where('A.year_of_registration', '2022-23');
				//$this->db->where('A.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
				//$this->db->group_by(array('A.institute_id_fk', 'A.course_id_fk', 'cavm.vtc_code', 'cavm.vtc_name','cagm.group_code','sbi.posting_amount'));
				
				
				
				$this->db->where('A.institute_id_fk', $vtc_id_fk);
				$this->db->where('A.course_id_fk', $group_id);
				$this->db->group_by('A.institute_id_fk');
				$this->db->group_by('A.course_id_fk');
				$this->db->group_by('cagm.group_code');
				
				$std_val = $this->db->get()->row_array();
				//echo "<pre>";print_r($query1);exit;

				if(!empty($std_val)){
					$query[$key]['total_student'] = $std_val['total_student'];
					$query[$key]['having_kanyashree'] = $std_val['having_kanyashree'];
					$query[$key]['not_having_kanyashree'] = $std_val['not_having_kanyashree'];
					$query[$key]['new_addmition'] = $std_val['new_addmition'];
					$query[$key]['course_id_fk'] = $std_val['course_id_fk'];
				}else{
					
					$query[$key]['total_student'] = 0;
					$query[$key]['having_kanyashree'] = 0;
					$query[$key]['not_having_kanyashree'] = 0;
					$query[$key]['new_addmition'] = 0;
					$query[$key]['course_id_fk'] = 0;
				}

				//posting Amount

				
				$amount = $this->db->select('lot.transanction_log_id_fk,sbi.posting_amount')
				->from('council_vtc_student_payment_lot as lot')
				->join('council_sbi_payment_transanction_log_details as sbi', 'sbi.transaction_log_id_pk = lot.transanction_log_id_fk')
				->where('lot.group_id_fk',$group_id)
				->where(array(
					'lot.vtc_id_fk' =>$vtc_id_fk,
					//'lot.response_status' =>1,
					'sbi.payment_type_id_fk' =>1,
					'sbi.stake_details_id_fk' => $vtc_id_fk,
					'sbi.stake_id_fk' =>15,
					'sbi.response_status'=>1
				))
				->get()->row_array();
				//echo $this->db->last_query();exit;
				
				$query[$key]['posting_amount'] = $amount['posting_amount'];
				

			}
			//echo "<pre>";print_r($query);exit;
			return $query;
		}else{
			return array();
		}
		
	}

	public function get_std_listByGroup($vtc_id_pk_hash,$group_id){
		$this->db->select('std.student_id_pk,
		std.course_id_fk,
		std.first_name,
		std.middle_name,
		std.last_name,
		cagm.group_code,
		std.registration_number,

		std.approve_reject_status');
		$this->db->from('council_vtc_student_master as std');
		$this->db->join('council_affiliation_group_master as cagm', 'cagm.group_id_pk = std.course_id_fk','LEFT');
		$this->db->where('std.added_by', 1);
		$this->db->where('std.active_status', 1);
		$this->db->where('std.year_of_registration', '2022-23');
		//$this->db->where('A.approve_reject_status', 1); // approve_reject_status == 1 For Approve and approve_reject_status == 0 for Reject
		//$this->db->group_by(array('A.institute_id_fk', 'A.course_id_fk', 'cavm.vtc_code', 'cavm.vtc_name','cagm.group_code','sbi.posting_amount'));
		
		
		
		$this->db->where("MD5(CAST(std.institute_id_fk as character varying)) =", $vtc_id_pk_hash);
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

	public function getStudentListByVTCGroup($institute_id_fk,$course_id){

		$this->db->select('student_id_pk,class_id_fk,registration_number,reg_status,year_of_registration');
        $this->db->from('council_vtc_student_master');
        $this->db->where('institute_id_fk', $institute_id_fk);
        $this->db->where('course_id_fk', $course_id);
        $this->db->where(array(
            'added_by' => 1,
            //'approve_reject_status'=>1,
            //'payment_status' =>'Yes',
            'reg_status =' => NULL
        ));
        $query = $this->db->get()->result_array();
		//echo $this->db->last_query();exit;
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
	}

	public function get_last_certificate_no($chaking_data = NULL)
    {
        return $query = $this->db->select('max(registration_number) as code')
            ->from('council_vtc_student_master')
            ->like('registration_number', ($chaking_data))
            ->get()
            ->result_array();
    }

	public function update_certificate_no($id = NULL, $updateArray = NULL)
    {
        $this->db->where('student_id_pk', $id);

        $this->db->update('council_vtc_student_master', $updateArray);
        // echo $this->db->last_query();exit;

        return $this->db->affected_rows();
    }

	public function update_Batch_declaration_master($institute_id_fk,$course_id,$academic_year){

		$this->db->where('vtc_id_fk', $institute_id_fk);
		$this->db->where('group_id_fk', $course_id);
		$this->db->where('academic_year', $academic_year);

        $this->db->update('council_vtc_batch_declaretion_master', array('reg_certificate_status'=>1));
        // echo $this->db->last_query();exit;

        return $this->db->affected_rows();
	}

	
}