<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Final_Submit_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

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

    public function getVTCPaperLabData($vtc_id = NULL, $academic_year = NULL){
        $this->db->select('paper_lab.*,group_master.group_name,item_master.item_name');
        $this->db->from('council_affiliation_vtc_vocational_paper_laboratory as paper_lab');
        $this->db->join('council_affiliation_group_master as group_master', 'group_master.group_id_pk = paper_lab.group_id_fk');
        $this->db->join('council_affiliation_infrastructure_item_master as item_master', 'item_master.infrastructure_item_id_pk = paper_lab.infrastructure_item_id_fk');
        $this->db->where('paper_lab.vtc_id_fk', $vtc_id);
        $this->db->where('paper_lab.academic_year', $academic_year);
        $this->db->where('paper_lab.active_status', 1);
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }

    }

    public function getAllCommonLabData($vtc_id = NULL, $academic_year = NULL){

        $query = $this->db->select('cmn_lab.*, item_master.item_name, discipline.discipline_name')
                ->from('council_affiliation_vtc_other_common_laboratory as cmn_lab')
                ->join('council_affiliation_infrastructure_item_master as item_master', 'cmn_lab.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk','left')
                ->join('council_affiliation_discipline_master as discipline', 'cmn_lab.discipline_id_fk = discipline.discipline_id_pk','left')
                ->where('cmn_lab.active_status',1)
                ->where('cmn_lab.vtc_id_fk' , $vtc_id)
                ->where('cmn_lab.academic_year' , $academic_year)
                ->get()->result_array();

        if(!empty($query)){
            return $query;
        }else{
            return array();
        }
    }

    public function getVTCClassRoomData($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('class_room.*');
        $this->db->from('council_affiliation_vtc_vocational_class_room as class_room');
        $this->db->where('class_room.vtc_id_fk', $vtc_id);
        $this->db->where('class_room.academic_year', $academic_year);
        $this->db->where('class_room.active_status', 1);
        $query = $this->db->get()->row_array();

        if(!empty($query)){

            $class_room_id = $query['vtc_vocational_class_room_id_pk'];
    
            $allRoomSize = $this->db->where(array('active_status' => 1,'vtc_id_fk' => $vtc_id,'vtc_vocational_class_room_id_fk'=>$class_room_id))
                                    ->from('council_affiliation_vtc_vocational_class_room_size_map')->get()->result_array();
            if(!empty($allRoomSize)){
                $room_size=array();
                foreach ($allRoomSize as $key => $value) {
                    array_push($room_size, $value['room_size']);
                }
                $query['room_size'] = $room_size;
            }
            
            // echo "<pre>";print_r($query);exit;
            return $query;
        }else {
            return array();
        }
    }
    public function getLabSizeDetails($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('*');
        $this->db->from('council_affiliation_vtc_short_term_lab');
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);
        $query = $this->db->get()->row_array();

        if(!empty($query)){

            $lab_id = $query['vtc_short_term_lab_id_pk'];
    
            $allLabSize = $this->db->where(array('active_status' => 1,'vtc_id_fk' => $vtc_id,'vtc_short_term_lab_id_fk'=>$lab_id))
                                    ->from('council_affiliation_vtc_short_term_lab_size_map')->get()->result_array();
            if(!empty($allLabSize)){
                $lab_size=array();
                foreach ($allLabSize as $key => $value) {
                    array_push($lab_size, $value['lab_size']);
                }
                $query['lab_size'] = $lab_size;
            }
            
            // echo "<pre>";print_r($query);exit;
            return $query;
        }else {
            return array();
        }
    }

    public function getOtherInfarstructureDetails($vtc_id = NULL,$academic_year){

        $this->db->select('other_infrastructure.*')
            ->from('council_affiliation_vtc_other_infrastructure_details as other_infrastructure')
            // ->join('council_affiliation_connection_type_master as connection_type', 'connection_type.connection_type_id_pk = other_infrastructure.connection_type_id_fk')
            ->where('other_infrastructure.vtc_id_fk', $vtc_id)
            ->where('other_infrastructure.academic_year', $academic_year)
            ->where('other_infrastructure.active_status', 1);
       $query = $this->db->get()->result_array();
        foreach ($query as $key => $value) {
            $connection_type_id = $value['connection_type_id_fk'];
            if($connection_type_id!=''){

                $type_name = $this->db->where('active_status', 1)
                            ->where('connection_type_id_pk', $connection_type_id)
                           ->get('council_affiliation_connection_type_master')->row_array();
                $connection_type_name = $type_name['connection_type_name'];
            }else{
                $connection_type_name = '';
            }
            $query[$key]['connection_type_name'] = $connection_type_name;
        }

       if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
    }

    public function getComputerLabDetails($vtc_id = NULL, $academic_year){
        $this->db->select('*')
            ->from('council_affiliation_vtc_computer_lab')
            ->where(
                array(
                    'active_status'     =>1,
                    'vtc_id_fk'         =>$vtc_id,
                    'academic_year'     =>$academic_year
                )
            );
        $query = $this->db->get()->row_array();

        if (!empty($query)) {
            return $query;
        } else {
            return array();
        }     
    }

    public function getVtcDiscipline($vtc_id_fk = NULL, $academic_year = NULL)
    {
        $this->db->where('vtc_id_fk', $vtc_id_fk);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_course_selection')->result_array();
        // echo "<pre>";print_r($query);exit;

        if(!empty($query)){

           
            $disciplineArray = array();
            foreach ($query as $key => $value) {
                array_push($disciplineArray, $value['discipline_id_fk']);
            }

            // ! get Agriculture Discipline is exist or not

            
            if( in_array( "2" ,$disciplineArray ) )
            {
                $agriculture = 'yes';
            }else{
                $agriculture = 'no';
            }

            return $agriculture;
            
        }else{
            return $agriculture ='';
        }

        
    }

    public function getAgriDisciplineDetails($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('*')
            ->from('council_affiliation_vtc_agri_discipline')
            ->where(
                array(
                    'active_status' => 1,
                    'vtc_id_fk'     => $vtc_id,
                    'academic_year' => $academic_year
                )
            );
        
        $query = $this->db->get()->result_array();
        if (!empty($query)) {
            return $query[0];
        } else {
            return array();
        }
        
    }

    public function submit_final_data($vtc_details_id, $updateArray)
    {
        $this->db->where("MD5(CAST(vtc_details_id_pk as character varying)) =", $vtc_details_id);

        $this->db->update('council_affiliation_vtc_details', $updateArray);

        return $this->db->affected_rows();
    }

    public function checkPaperLabDataCount_old($vtc_id = NULL, $academic_year = NULL){

        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $query = $this->db->get('council_affiliation_vtc_courses')->result_array();


        $hs_voc_courses= explode(",",$query[0]['hs_voc_courses']);
        

        $stc_course= explode(",",$query[0]['stc_course']);

        $courseArray = array_merge($hs_voc_courses,$stc_course);

        $labCourse = array();
        $getCourseId = $this->db->select('group_id_fk')
            ->where(array(
                'academic_year' => $academic_year,
                'vtc_id_fk' => $vtc_id,
                'active_status' => 1,
            ))
            ->group_by('group_id_fk')
            ->get('council_affiliation_vtc_vocational_paper_laboratory')->result_array();

        foreach ($getCourseId as $key => $value) {
            array_push($labCourse, $value['group_id_fk']);
        }
        $result=array_diff($courseArray,$labCourse);

        // echo "<pre>";print_r($result);exit;
        if(count($result) == 0){
            return 'match';
        }else{
            return 'not match';
        }
    }

    public function checkHsDiscipline_old($vtc_id = NULL, $academic_year = NULL){

        
        $this->db->select('hs_voc_discipline');
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('academic_year', $academic_year);
        $this->db->where('active_status', 1);

        $hs_query = $this->db->get('council_affiliation_vtc_courses')->result_array();
        // echo "<pre>";print_r($hs_query);exit;
        if(!empty($hs_query)){

            $hsDisciplineArray = explode(",",$hs_query[0]['hs_voc_discipline']);

            $getDisciplineId = $this->db->select('discipline_id_fk')
            ->where(array(
                'academic_year' => $academic_year,
                'vtc_id_fk' => $vtc_id,
                'active_status' => 1,
                'course_name_id_fk' => 1,
            ))
            ->group_by('discipline_id_fk')
            ->get('council_affiliation_vtc_other_common_laboratory')->result_array();

            $cmnLabdiscipline = array();

            foreach ($getDisciplineId as $key => $value) {
                array_push($cmnLabdiscipline, $value['discipline_id_fk']);
            }
            $result=array_diff($hsDisciplineArray,$cmnLabdiscipline);
    
            // echo "<pre>";print_r($result);exit;
            if(count($result) == 0){
                return 'match';
            }else{
                return 'not match';
            }

        }
    }

    public function checkStcDiscipline($vtc_id = NULL, $academic_year = NULL){

        
        $infrastructure_item = $this->db->select('count(DISTINCT(item_course_map.infrastructure_item_id_fk)) as item_count')
        ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
        ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
        ->where('item_course_map.active_status', 1)
        ->where('item_master.category_name', 2)
        ->where('item_course_map.discipline_id_fk IN(SELECT DISTINCT discipline_id_fk FROM council_affiliation_vtc_course_selection as course_selection WHERE course_selection.vtc_id_fk = '.$vtc_id.' AND course_selection.academic_year = '."'$academic_year'".' AND course_selection.active_status = 1 AND course_selection.course_name_id_fk = 4)')
       
        ->get()->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($infrastructure_item);exit;

        $insert_item = $this->db->select('infrastructure_item_id_fk')
        ->from('council_affiliation_vtc_other_common_laboratory')
        ->where('discipline_id_fk IN(SELECT DISTINCT discipline_id_fk FROM council_affiliation_vtc_course_selection as course_selection WHERE course_selection.vtc_id_fk = '.$vtc_id.' AND course_selection.academic_year = '."'$academic_year'".' AND course_selection.active_status = 1 AND course_selection.course_name_id_fk = 4)')
        ->where('vtc_id_fk',$vtc_id)
        ->where('academic_year',$academic_year)
        ->where('active_status',1)
        ->get()->result_array();

    
        if($infrastructure_item[0]['item_count'] == count($insert_item)){
            return 'match';
        }else{
            return 'not match';
        }
    }

    public function checkPaperLabDataCount($vtc_id = NULL, $academic_year = NULL){
        // $query = $this->db->select('item_course_map.infrastructure_item_id_fk, item_master.item_name,item_course_map.course_id_fk')

        $infrastructure_item = $this->db->select('count(DISTINCT(item_course_map.infrastructure_item_id_fk)) as item_count')
        ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
        ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
        ->where('item_course_map.active_status', 1)
        ->where('item_master.category_name', 1)
        ->where('item_course_map.course_id_fk IN(SELECT group_map.group_id_fk FROM council_affiliation_vtc_course_selection_group_map as group_map join council_affiliation_vtc_course_selection as course_selection on course_selection.vtc_course_id_pk = group_map.vtc_course_id_fk  WHERE course_selection.vtc_id_fk = '.$vtc_id.' AND course_selection.academic_year = '."'$academic_year'".' AND course_selection.active_status = 1)')
       
        ->get()->result_array();
        // echo $this->db->last_query();

        $insert_item = $this->db->select('infrastructure_item_id_fk')
        ->from('council_affiliation_vtc_vocational_paper_laboratory')
        ->where('group_id_fk IN(SELECT group_map.group_id_fk FROM council_affiliation_vtc_course_selection_group_map as group_map join council_affiliation_vtc_course_selection as course_selection on course_selection.vtc_course_id_pk = group_map.vtc_course_id_fk  WHERE course_selection.vtc_id_fk = '.$vtc_id.' AND course_selection.academic_year = '."'$academic_year'".' AND course_selection.active_status = 1)')
        ->where('vtc_id_fk',$vtc_id)
        ->where('academic_year',$academic_year)
        ->where('active_status',1)
        ->get()->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($infrastructure_item[0]['item_count']);exit;
        
        if($infrastructure_item[0]['item_count'] == count($insert_item)){
            return 'match';
        }else{
            return 'not match';
        }
    }

    public function checkHsDiscipline($vtc_id = NULL, $academic_year = NULL){

        
        $infrastructure_item = $this->db->select('count(DISTINCT(item_course_map.infrastructure_item_id_fk)) as item_count')
        ->from('council_affiliation_infrastructure_item_course_map as item_course_map')
        ->join('council_affiliation_infrastructure_item_master as item_master', 'item_course_map.infrastructure_item_id_fk = item_master.infrastructure_item_id_pk', 'LEFT')
        ->where('item_course_map.active_status', 1)
        ->where('item_master.category_name', 2)
        ->where('item_course_map.discipline_id_fk IN(SELECT DISTINCT discipline_id_fk FROM council_affiliation_vtc_course_selection as course_selection WHERE course_selection.vtc_id_fk = '.$vtc_id.' AND course_selection.academic_year = '."'$academic_year'".' AND course_selection.active_status = 1 AND course_selection.course_name_id_fk = 1)')
       
        ->get()->result_array();

        // echo $this->db->last_query();
        // echo "<pre>";print_r($infrastructure_item);exit;

        $insert_item = $this->db->select('infrastructure_item_id_fk')
        ->from('council_affiliation_vtc_other_common_laboratory')
        ->where('discipline_id_fk IN(SELECT DISTINCT discipline_id_fk FROM council_affiliation_vtc_course_selection as course_selection WHERE course_selection.vtc_id_fk = '.$vtc_id.' AND course_selection.academic_year = '."'$academic_year'".' AND course_selection.active_status = 1 AND course_selection.course_name_id_fk = 1)')
        ->where('vtc_id_fk',$vtc_id)
        ->where('academic_year',$academic_year)
        ->where('active_status',1)
        ->get()->result_array();

    
        if($infrastructure_item[0]['item_count'] == count($insert_item)){
            return 'match';
        }else{
            return 'not match';
        }
    }

    public function checkVtcHSCourseExist($vtc_id = NULL, $academic_year = NULL){
        $this->db->select('*');
        $this->db->from('council_affiliation_vtc_course_selection');
        $this->db->where(
            array(
                'vtc_id_fk' => $vtc_id,
                'active_status'=>1,
                'academic_year' => $academic_year,
                'course_name_id_fk'=> 1
            )
        );
        $query = $this->db->get()->result_array();
        if(!empty($query)){
            return $query;
        }else{
            return array();
        }

    }


}