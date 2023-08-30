<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Class_room_model extends CI_Model
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

    public function getVTCClassRoomData($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('class_room.*');
        $this->db->from('council_affiliation_vtc_vocational_class_room as class_room');
        $this->db->where('class_room.vtc_id_fk', $vtc_id);
        $this->db->where('class_room.active_status', 1);
        $this->db->where('class_room.academic_year', $academic_year);
        $query = $this->db->get()->row_array();
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
    }
    public function getLabSizeDetails($vtc_id = NULL, $academic_year = NULL){

        $this->db->select('*');
        $this->db->from('council_affiliation_vtc_short_term_lab');
        $this->db->where('vtc_id_fk', $vtc_id);
        $this->db->where('active_status', 1);
        $this->db->where('academic_year', $academic_year);
        $query = $this->db->get()->row_array();
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
    }

    public function insertData($table, $dataArray = NULL){

        $this->db->insert($table, $dataArray);
        return $this->db->insert_id();

    }

    public function insertMultipleData($table, $data_array = NULL,$vtc_id=NULL,$fk_id=NULL)
    {
        $this->db->where(
            array(
                'vtc_id_fk' => $vtc_id,
                'active_status' => 1
            )
        );

        if($table == 'council_affiliation_vtc_short_term_lab_size_map')
        {
            $this->db->where('vtc_short_term_lab_id_fk', $fk_id);
        }
        elseif($table == 'council_affiliation_vtc_vocational_class_room_size_map')
        {
            $this->db->where('vtc_vocational_class_room_id_fk', $fk_id);
        }
         
        $query = $this->db->from($table)->get()->result_array();
        
        if(!empty($query)){

            if($table == 'council_affiliation_vtc_short_term_lab_size_map')
            {
                $this->db->where('vtc_short_term_lab_id_fk', $fk_id);
            }
            elseif($table == 'council_affiliation_vtc_vocational_class_room_size_map')
            {
                $this->db->where('vtc_vocational_class_room_id_fk', $fk_id);
            }

            $this->db->where('vtc_id_fk',$vtc_id);
            $this->db->update($table, array('active_status'=> 0));

           
            
            $this->db->insert_batch($table, $data_array);


        }else{

            $this->db->insert_batch($table, $data_array);
        }

        return true;
    }

    public function getClassRoomAndLabData($vtc_id = NULL, $academic_year){

        $this->db->select('class_room.*,st_lab.vtc_short_term_lab_id_pk');
        $this->db->from('council_affiliation_vtc_vocational_class_room as class_room');
        $this->db->join('council_affiliation_vtc_short_term_lab as st_lab', 'st_lab.vtc_id_fk = class_room.vtc_id_fk', 'LEFT');
        $this->db->where(
            array(
                'class_room.active_status' => 1,
                'class_room.academic_year' => $academic_year,
                'class_room.vtc_id_fk' => $vtc_id,
                'st_lab.active_status' => 1,
                'st_lab.academic_year' => $academic_year,
                'st_lab.vtc_id_fk' => $vtc_id,
            )
        );
        $query = $this->db->get()->row_array();
        return $query;

    }

    public function updateData($table,$updateData,$vtc_id,$academic_year){

        $this->db->where(
            array(
                'vtc_id_fk'=> $vtc_id,
                'academic_year'=>$academic_year,
                'active_status' =>1
            )
        );
        $this->db->update($table, $updateData);
        return $this->db->affected_rows();

    }
    public function updateMapTable($table,$updateData,$id){

        if($table == "council_affiliation_vtc_vocational_class_room_size_map"){

            $this->db->where(
                array(
                    'vtc_vocational_class_room_id_fk'=> $id
                    
                )
            );
        }elseif ($table == "council_affiliation_vtc_short_term_lab_size_map") {
            $this->db->where(
                array(
                    'vtc_short_term_lab_id_fk'=> $id
                    
                )
            );
        }
        $this->db->update($table, $updateData);
        return $this->db->affected_rows();

    }

   
    
}