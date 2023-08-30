<?php defined('BASEPATH') or exit('No direct script access allowed');

class Check extends NIC_Controller
{

	function __construct()
	  {
	    
	    parent::__construct();
	    $this->load->model("Test_model");

	  }
	 
	 public function index(){
	 	$full_data=$this->Test_model->fetch_data();
	 	
	 	if($full_data){
	 		$arr=array();
	 		foreach($full_data as $row){
	 			
	 			$arr=$this->Test_model->check_payment($row['vtc_id_fk'],$row['group_id_fk']);
	 			$this->Test_model->update_batch($row['student_payment_lot_id_pk'],$arr);

                
	 		}
	 		echo "<pre>";
	 		print_r($arr);
	 	}
	 }

}