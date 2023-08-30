<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Choice_filling extends NIC_Controller
{
    function __construct()
    {

        parent::__construct();
        parent::check_privilege(160);
        $this->load->model('student_transfer/choice_filling_model');
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
        );

    }
    public function index(){

        $data['student_id'] = $this->session->userdata('stake_details_id_fk');
        $data['trasfer_details'] = $this->choice_filling_model->get_transfer_status($data['student_id']);
        $data['save_status']= $this->choice_filling_model->get_seat_details($data['student_id']);
        //echo "<pre>";print_r($data['trasfer_details']);die;

        //if($data['trasfer_details']['transfer_status'] == 1){

           $data['institute'] =  $this->choice_filling_model->getInstituteForChoiceFilling($data['trasfer_details']['institute_id_fk'],$data['trasfer_details']['course_id_fk'],$data['trasfer_details']['district_id_fk'],$data['trasfer_details']['gender_id_fk']);
        //}
        //echo "<pre>";print_r($data['institute']);die;

        $this->load->view($this->config->item('theme') . 'student_transfer/choice_filling_view', $data);

    }

    public function save_filling_data(){
      
      $student_id = $this->session->userdata('stake_details_id_fk');
      $stdDetails = $this->choice_filling_model->getDetailsByid($student_id);
      //echo "<pre>";print_r($stdDetails);die;
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

        if(count($this->input->post("priority")) <= 2){

        
          foreach($this->input->post("priority") as $k => $v){

            $home_dist = $this->choice_filling_model->check_home_dist($this->input->post("institute_id")[$k],$stdDetails['district_id_fk']);

            $arr[$j]['priority']=$p++;
            $arr[$j]['institute_name']=$this->input->post("institute")[$k];
            $arr[$j]['course_name']=$this->input->post("course")[$k];
            $arr[$j]['type']=$this->input->post("type")[$k];
            $arr[$j]['institute_id']=$this->input->post("institute_id")[$k];
            $arr[$j]['created_at']=date('Y-m-d');
            $arr[$j]['gen_rank']=$stdDetails['jexpo_rank'];
            $arr[$j]['gpa']=$stdDetails['gpa'];
            $arr[$j]['percentage']=$stdDetails['percentage'];
            $arr[$j]['date_of_birth']=$stdDetails['date_of_birth'];
            $arr[$j]['gender_id_fk']=$stdDetails['gender_id_fk'];
            $arr[$j]['caste_id_fk']=$stdDetails['caste_id_fk'];
            $arr[$j]['tfw']=$stdDetails['tfw'];
            //$arr[$j]['transfer_for']=$stdDetails['transfer_for'];
            $arr[$j]['pwd']=$stdDetails['handicapped'];
            $arr[$j]['madhyamik_full_marks']=$stdDetails['madhyamik_full_marks'];
            $arr[$j]['madhyamik_marks_obtain']=$stdDetails['madhyamik_marks_obtain'];
            $arr[$j]['madhyamik_percentage']=$stdDetails['madhyamik_percentage'];
            $arr[$j]['weightage_marks']=($stdDetails['madhyamik_percentage'] + $stdDetails['percentage']) /2;

            $arr[$j]['spotcouncil_student_details_id_fk']=$student_id;
            $arr[$j]['institute_student_details_id_fk']=$stdDetails['institute_student_details_id_pk'];
            $arr[$j]['final_submit'] = $final_submit;
            $arr[$j]['discipline_id_fk']=$this->input->post("course_id")[$k];
            $arr[$j]['active_status']= 1;
            $arr[$j]['home_dist'] = $home_dist;
            $j++;

          } 

          //echo "<pre>";print_r($arr);die;
          $delete_data=$this->choice_filling_model->delete_data($student_id);
          $store_data=$this->choice_filling_model->insertData($arr);
          if($delete_data){
            if($store_data){

              $this->session->set_flashdata('status', 'success');
              $this->session->set_flashdata('message', 'Your data successfully saved.');
              redirect('admin/student_transfer/choice_filling');

            }else{
              $this->session->set_flashdata('status', 'danger');
              $this->session->set_flashdata('message', 'Your data not saved.');
              redirect('admin/student_transfer/choice_filling');
            }
          }
        }else{
          
          $this->session->set_flashdata('status', 'danger');
          $this->session->set_flashdata('message', 'Please not Select more than two institute.');
          redirect('admin/student_transfer/choice_filling');

        }
      }else{
        $this->session->set_flashdata('status', 'danger');
        $this->session->set_flashdata('message', 'Please Select atleast one institute.');
        redirect('admin/student_transfer/choice_filling');
      }
    }


  public function institute_fetch(){
    $student_id = $this->session->userdata('stake_details_id_fk');
    $fetch_data=$this->choice_filling_model->fetch_data($student_id);
    if($fetch_data){
      echo json_encode(["status"=>"success",'data'=>$fetch_data]);
    }
  }

  public function tfw_allotement(){

    $get_choice_data = $this->choice_filling_model->getAllchoiceData(array('tfw' => 1));
    //echo "<pre>";print_r($get_choice_data);die;
    foreach($get_choice_data as $val){
      $check_intake = $this->choice_filling_model->get_available_intake($val['institute_id'],$val['discipline_id_fk']);
    }

  }
}