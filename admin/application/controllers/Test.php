<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends NIC_Controller {
    public function index(){
        $query = $this->db->select("assessor_registration_details_pk,
        final_flag,
        process_status_id_fk")
            ->from("council_assessor_registration_details")
        ->get();

        // echo "<pre>";
        // print_r($query->result_array());
        // echo "</pre>";

        $assessor_registration_details_fk = NULL;
        $approve_status = NULL;
        foreach($query->result_array() as $k){

            if($k['process_status_id_fk'] == 4){
                $approve_status = 0;

            } elseif($k['process_status_id_fk'] == 5) {
                $approve_status = 1;
            } elseif($k['process_status_id_fk'] == 6) {
                $approve_status = 1;
            } else {
                $approve_status = 0;
            }
            if($k["process_status_id_fk"] != NULL){
                $process_status_id_fk = $k["process_status_id_fk"];
            } else {
                $process_status_id_fk = "NULL";
            }
            if($k['final_flag'] == 't'){
                $final_submission_status = 1;
            } else {
                $final_submission_status = "NULL";
            }
    
         $assessor_registration_details_fk = $k['assessor_registration_details_pk'];
           //$assessor_registration_details_fk = $k['assessor_registration_details_fk'];
        echo "INSERT INTO council_assessor_registration_application_nubmer (assessor_registration_details_fk,assessor_registration_application_no,approve_status,active_status,process_status_id_fk,final_submission_status) VALUES (".$assessor_registration_details_fk.",1,".$approve_status.",1,".$process_status_id_fk.",".$final_submission_status.");<br>";
        }
    }
}