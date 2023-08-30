<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institute_list extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(164);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('poly_institute/institute_list_model');


        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",

            2 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'poly_institute/institute_list.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",

            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            5 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js',
        );
        $this->load->helper('email');
        $this->load->library('sms');
    }

    public function index($offset = 0)
    {

        $data['offset'] = $offset;
        //ADDED BY AVIJIT 20-02-2023
        $data['getfinalsubmitStudentCount'] = $this->institute_list_model->getfinalsubmitStudentCount();


        $this->load->view($this->config->item('theme') . 'poly_institute/institute_list_view', $data);
    }


    public function get_institute_list()
    {
       //  error_reporting(0);
        $columns = array(
            1 => 'sl_no',
            2 => 'institute_code',
            3 => 'institute_name',
            4 => 'institute_category',
            5 => 'available_student',
            6 => 'action'
            
        );

        $limit = $this->input->GET('length');
        $start = $this->input->GET('start');

        $orderColumn = $columns[$this->input->GET('order')[0]['column']];
        $orderType = $this->input->GET('order')[0]['dir'];

        $search = $this->input->GET('search')['value'];


        if (!empty($search)) {

            $data['instituteList']     = $this->institute_list_model->getInstituteListBySearch($limit, $start, $orderColumn, $orderType, $search);
            
        

            $listCount = count($this->institute_list_model->getInstituteListCountBySearch($search));
        } else {

            $data['instituteList']     = $this->institute_list_model->getInstituteList($limit, $start, $orderColumn, $orderType);
            
            
           $listCount = $this->institute_list_model->getInstituteListCount()[0]['count'];

            // echo '<pre>'; print_r($listCount); die;
        }

        $i = $start + 1;
        $x = 1;
        foreach ($data['instituteList'] as $data) {


           $institute_id_fk= $data['vtc_id_pk']; 

           $student_count = $this->institute_list_model->getStudentCount($institute_id_fk);
            // echo '<pre>'; print_r($student_count); die;
            //echo $student_count['count'];
            $options1 = '<a class="btn btn-info btn-xm" title = Details href="poly_institute/institute_list/details/'. md5($data['vtc_id_pk']) .'" ><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>';

            $nestedData['sl_no'] = $i;
            $nestedData['institute_code'] = $data['vtc_code'];
            $nestedData['institute_name'] = substr($data['vtc_name'], 0, 30);

            $nestedData['institute_category'] = $data['category_name'];
            $nestedData['available_student'] = $student_count['count'];
            $nestedData['action'] = $options1;
           
            $info[] = $nestedData;
            $i++;
            $x++;
        }

       // die;


        if ($listCount > 0) {
            $output = array(
                "draw" => intval($this->input->post('draw')),
                // "recordsTotal" => $this->vtc_model->getVtcListCount($selected_year)[0]['count'],
                // "recordsFiltered" => $this->vtc_model->getVtcListCount($selected_year)[0]['count'],

                "recordsTotal" => $listCount,
                "recordsFiltered" => $listCount,
                "data" => $info
            );
        } else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }


        echo json_encode($output);
    }


    public function details($id_hash = Null)
    {
       // echo "$id_hash"; die;

        $data['studentUnderInstitute'] = $this->institute_list_model->getStudentListUnderinstitute($id_hash);
       
          //  echo '<pre>'; print_r($data['studentUnderInstitute']); die;

          $data['institute_name'] = $data['studentUnderInstitute'][0]['vtc_name'];
         // echo '<pre>'; print_r($institute_name); die;
          $data['institute_code'] = $data['studentUnderInstitute'][0]['vtc_code'];
       
        $this->load->view($this->config->item('theme') . 'poly_institute/institute_student_details/institute_details_view',$data);
    }

    // public function student_own_details($stu_id_hash = Null)
    // {
    //     // echo $stu_id_hash; die;
    //     $data['student_own_details'] = $this->institute_list_model->student_own_data($stu_id_hash);
    //     // echo '<pre>'; print_r($data['student_own_details']); die;
    //     $this->load->view($this->config->item('theme') . 'poly_institute/institute_student_details/student_details_view'); 
    // }
}
