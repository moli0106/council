<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Std_seat_filling extends NIC_Controller
{
	function __construct()
    {
		
        parent::__construct();
        parent::check_privilege(160);
        $this->load->model('student_profile/std_registration_model');
        $this->load->model('seat_filling/std_seat_filling_model');
        $this->load->model('affiliation/details_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
          1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
          2 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css',
          3 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        ); 
        $this->js_foot = array(
          1 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
          2 => $this->config->item('theme_uri') . "student_profile/seat_filling.js",
          3 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
          4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
          5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
          6 => $this->config->item('theme_uri') . 'bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
          7 => $this->config->item('theme_uri').'jQuery.print.min.js'
          //8 => $this->config->item('theme_uri') . "student_profile/student_reg.js",
        );
    }

	public function index(){
    $data['student_id'] = $this->session->userdata('stake_details_id_fk');
    $data['save_status']= $this->std_seat_filling_model->get_seat_details($data['student_id']);
    $fetch_institute=$this->std_seat_filling_model->fetch_institute();
    //print_r($fetch_institute);die;
    $data['institute'] = $fetch_institute;
		$this->load->view($this->config->item('theme') . 'seat_filling/seat_filling', $data);
	}

	public function institute_fetch(){
    $student_id = $this->session->userdata('stake_details_id_fk');
	  $fetch_data=$this->std_seat_filling_model->fetch_data($student_id);
    if($fetch_data){
        echo json_encode(["status"=>"success",'data'=>$fetch_data]);
    }
	}

	
	public function save_filling_data(){
      // echo "<pre>";
      //   print_r($_POST);
      //   die();

      $student_id = $this->session->userdata('stake_details_id_fk');
      $stdDetails = $this->std_seat_filling_model->getDetailsByid($student_id);
      $arr=[];
      $j=0;
      $p=1;
      //$gen_rank=100;
      if($this->input->post('save') == 'Save'){
        $final_submit = 0;
      }else{
        $final_submit = 1;
      }
      if($this->input->post("priority")!=''){
        foreach($this->input->post("priority") as $k => $v){
          $arr[$j]['priority']=$p++;
          $arr[$j]['institute_name']=$this->input->post("institute")[$k];
          $arr[$j]['course_name']=$this->input->post("course")[$k];
          $arr[$j]['type']=$this->input->post("type")[$k];
          $arr[$j]['institute_id']=$this->input->post("institute_id")[$k];
          $arr[$j]['created_at']=date('Y-m-d');
          $arr[$j]['gen_rank']=$stdDetails['general_rank'];
          $arr[$j]['sc_rank']=$stdDetails['sc_rank'];
          $arr[$j]['st_rank']=$stdDetails['st_rank'];
          $arr[$j]['pc_rank']=$stdDetails['pc_rank'];
          $arr[$j]['obc_a_rank']=$stdDetails['obc_a'];
          $arr[$j]['obc_b_rank']=$stdDetails['obc_b'];
          $arr[$j]['caste_id_fk']=$stdDetails['caste_id_fk'];
          $arr[$j]['student_id']=$student_id;
          $arr[$j]['final_submit'] = $final_submit;
          $j++;

        } 
        $delete_data=$this->std_seat_filling_model->delete_data($student_id);
        $store_data=$this->std_seat_filling_model->insertData($arr);
        if($delete_data){
          if($store_data){

            $this->session->set_flashdata('status', 'success');
            $this->session->set_flashdata('message', 'Your data successfully saved.');
            redirect('admin/seat_filling/std_seat_filling');

          }else{
            $this->session->set_flashdata('status', 'danger');
            $this->session->set_flashdata('message', 'Your data not saved.');
            redirect('admin/seat_filling/std_seat_filling');
          }
        }
      }else{
        $this->session->set_flashdata('status', 'danger');
        $this->session->set_flashdata('message', 'Please Select atleast one institute.');
        redirect('admin/seat_filling/std_seat_filling');
      }
  }

  public function print_choice_data(){
    $student_id = $this->session->userdata('stake_details_id_fk');
    $data['all_data'] = $this->std_seat_filling_model->std_choice_data($student_id);

    //echo "<pre>";print_r($data['all_data']);exit;

    $this->load->view($this->config->item('theme') . 'seat_filling/student_seat_filling_list', $data);
  }

}