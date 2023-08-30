<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Affiliation_admin extends NIC_Controller
{
	function __construct()
	{
		
		parent::__construct();
        parent::check_privilege(195);
		$this->load->model("polytechnic_affiliation/affiliation_admin_model"); 
        $this->load->model("polytechnic_affiliation/poly_affiliation_model"); 

        $this->css_head = array(
            
            1 => $this->config->item('theme_uri') . 'assets/css/tables/datatables/dataTables.bootstrap.css'
        );

		$this->js_foot = array(
            1  => $this->config->item('theme_uri').'state/address.js',
            2  => $this->config->item('theme_uri').'polytechnic_affiliation/affiliation_admin.js',
            3 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/jquery.dataTables.min.js',
            4 => $this->config->item('theme_uri') . 'assets/js/tables/datatables/dataTables.bootstrap.js'
        );
        
    }

    public function index($offset = 0)
    {
        
        $data['offset'] = $offset;
        $data['yearlist']  = $this->affiliation_admin_model->getAcademicYearList();
        $selected_year = $this->input->post('academic_year');
        if($selected_year == ''){
            $data['academic_year']  = '2023-24';
        }else{
            $data['academic_year']  =$selected_year;
        }

        $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/admin/affiliation_list_view', $data);
    }


    public function get_list()
    {
        error_reporting(0);
        $columns = array(
            1 => 'sl_no',
            2 => 'vtc_code',
            3 => 'vtc_name',
            4 => 'application_number',
            5 => 'academic_year',
            6 => 'affiliated',
            7 => 'active',
            8 => 'action'
        );
        
        $stake_id_fk = $this->session->userdata('stake_id_fk');
        $academic_year  = $this->config->item('current_academic_year');
        $selected_year = $this->input->GET('selected_year');
        // $selected_year = '2022-23';

        $limit = $this->input->GET('length');
        $start = $this->input->GET('start');

        $orderColumn = $columns[$this->input->GET('order')[0]['column']];
        $orderType = $this->input->GET('order')[0]['dir'];
        
        $search = $this->input->GET('search')['value'];
        
      
        if (!empty($search)) {
            $data['affiliation_List']     = $this->affiliation_admin_model->getAffiliationListBySearch($search,$selected_year);

            $listCount = count($this->affiliation_admin_model->getAffiliationListBySearch($search,$selected_year));
        } else {
            $data['affiliation_List']     = $this->affiliation_admin_model->getAffiliationList($limit, $start, $orderColumn, $orderType,$selected_year);

            $listCount = $this->affiliation_admin_model->getAffiliationListCount($selected_year)[0]['count'];
        }

        // $listCount = count($data['affiliation_List']);
    
        //echo "<pre>";print_r($data['affiliation_List']);exit;

        $i = $start + 1;
        $x = 1;
        foreach ($data['affiliation_List'] as $data) {

            if ($data['final_submit_status'] == 1){

                

                $affiliated_status = '<small class="label label-success">Yes</small>';

                $options2 = '<a class="btn btn-success btn-xm" target="_blank" title = download href="polytechnic_affiliation/affiliation_admin/download_form/'. md5($data['basic_affiliation_id_pk']) .'" ><i class="fa fa-download" aria-hidden="true"></i></a>';

            }else{
                $affiliated_status = '<small class="label label-danger">No</small>';
                $options2 = '';
            }

            
            
                                    
                

            $options1 = '<a class="btn btn-info btn-xm" title = Details href="polytechnic_affiliation/affiliation_admin/details/'. md5($data['basic_affiliation_id_pk']) .'" ><i class="fa fa-folder-open-o" aria-hidden="true"></i></a>';

            
            

            
            $nestedData['sl_no'] = $i;
            $nestedData['vtc_code'] = $data['institute_code'];
            $nestedData['vtc_name'] = substr($data['institute_name'], 0, 30);
            
            $nestedData['application_number'] = $data['application_number'];
            $nestedData['academic_year'] = $data['affiliation_year'];
            $nestedData['affiliated'] = $affiliated_status;
            
            $nestedData['action'] = $options1 .' '.$options2;

            $info[] = $nestedData;
            $i++;
            $x++;
        }

        
        if ($listCount > 0) {
            $output = array(
                "draw" => intval($this->input->post('draw')),
                // "recordsTotal" => $this->vtc_model->getVtcListCount($selected_year)[0]['count'],
                // "recordsFiltered" => $this->vtc_model->getVtcListCount($selected_year)[0]['count'],

                "recordsTotal" => $listCount,
                "recordsFiltered" => $listCount,
                "data" => $info
            );
        } 
        else {
            $output = array(
                // "draw" => 1,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        }
        

        echo json_encode($output);


    }

    public function details($basic_affiliation_id_hash = NULL)
    {
        if (!empty($basic_affiliation_id_hash)) {

            $data['basicDetails'] = $this->affiliation_admin_model->gaetINSAffiliationDetailsById($basic_affiliation_id_hash);
            if (!empty($data['basicDetails'])) {
                $data['affiliation_data'] = $data['basicDetails'];
                $data['teacher_data'] = $this->poly_affiliation_model->getTeachersById($basic_affiliation_id_hash);
                $data['intake_data'] = $this->poly_affiliation_model->getIntakeById($basic_affiliation_id_hash);
                // echo "<pre>";print($data['intake_data']);exit;

                $data['fetch_room'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_class_room_intake as c1',['c1.basic_affiliation_id_fk'=>$data['basicDetails']['basic_affiliation_id_pk']]);

                $data['fetch_lab'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_lab_details as c1',['c1.basic_affiliation_id_fk'=>$data['basicDetails']['basic_affiliation_id_pk']]);

                $data['fetch_library'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_library_details as c1',['c1.basic_affiliation_id_fk'=>$data['basicDetails']['basic_affiliation_id_pk']]);
        

                $data['mandory_data'] = $this->poly_affiliation_model->mandory_master();

                $data['fetch_mandory_data'] = $this->poly_affiliation_model->fetch_mandory_data($data['affiliation_data']['basic_affiliation_id_pk']);
                $data['payment_status'] = $this->poly_affiliation_model->getPaymentStatus($basic_affiliation_id_hash);
                $data['fetch_fees_data'] = $this->poly_affiliation_model->fetch_poly_fees_data($data['affiliation_data']['basic_affiliation_id_pk'],$data['affiliation_data']['affiliation_type_id_fk']);
                
                if($data['affiliation_data']['institute_category_id_fk'] == 4){
                    $affiliation_fees = 30000;
                    if(count($data['intake_data']) > 4){
                        $increse_course_no =  count($data['intake_data']) - 4;
                        $increse_course_amnt = 7500 * $increse_course_no;
                    }else{
                        $increse_course_amnt = 0;
                    }
                    //echo $increse_course_amnt;die;
                    $i = 0;
                    $blank_array=array();
                    foreach ($data['intake_data'] as $key => $value) {
                        if($value['intake_no'] > 60){
                            $increase_value = $value['intake_no'] - 60;
                            array_push($blank_array,$value['remarks']);
                            
                            $increase_intake_no = floor($increase_value / 60);
                            $i = $i+$increase_intake_no;
        
                            //echo "<br>";
                        }
                    }
                    //echo "<pre>";print_r($blank_array);die;
                    //echo $i;die;
                    if($i == 0){
                        $increase_intake_amount = 0;
                        $description = '';
                    }else{
                        $increase_intake_amount = 7500 * $i;
                        $description = implode(' / ', $blank_array);
                    }
        
        
        
                    $data['payment'] = array(
                        'application_fees' => 1000,
                        'inspection_fees'  => 10000,
                        'affiliation_fees' => $affiliation_fees,
                        'increse_course_amnt' => $increse_course_amnt,
                        'increase_intake_amount' => $increase_intake_amount,
                        'new_or_renewal'        => ($data['affiliation_data']['new_or_renewal'] == 2)? 'Renewal of' : '',
                        'total_fees'            =>  1000 + 10000 + $affiliation_fees + $increse_course_amnt + $increase_intake_amount ,
                        'description'           => $description
            
                    );
                    //echo "<pre>";print_r($data['payment']);exit;
                }else{
                    $data['payment'] = array();
                }

                $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/admin/ins_details/ins_details_view', $data);
            } else {
                redirect('admin/affiliation/vtc');
            }
        } else {
            redirect('admin/polytechnic_affiliation/affiliation_admin');
        }
    }

    public function download_form($id_hash=NULL){
        $this->load->library('m_pdf');
        $data['ins_details_id'] = $this->session->userdata('stake_details_id_fk');
        $data['ins_details'] = $this->poly_affiliation_model->getInstituteDetailsById($data['ins_details_id']);
        $data['id_hash'] = $id_hash;
        //$data['stateList']  = $this->poly_affiliation_model->getAllState();
        $data['affiliation_year'] = '2023-24';
        $data['affiliation_data'] = $this->poly_affiliation_model->gaetINSAffiliationDetailsById($id_hash);
        //echo "<pre>";print_r($data['affiliation_data']);exit;
        if($data['affiliation_data']['intake_submited_status'] ==1){
            $data['active_class1'] = 'intakeStaff';
        }else{
            $data['active_class1'] = '';
        }
        if($data['affiliation_data']['basic_details_submited_status'] == 1){
            $data['active_class'] = 'basicDetails';
        }else{
            $data['active_class'] = '';
        }
        if($data['affiliation_data']['infrastructure_fees_submited_status'] == 1){
            $data['active_class2'] = 'infra_fees';
        }else{
            $data['active_class2'] = '';
        }
        if($data['affiliation_data']['doc_uploaded_status'] == 1){
            $data['active_class3'] = 'doc_upload';
        }else{
            $data['active_class3'] = '';
        }
         
        $data['teacher_data'] = $this->poly_affiliation_model->getTeachersById($id_hash);
        $data['intake_data'] = $this->poly_affiliation_model->getIntakeById($id_hash);
        //echo "<pre>";print_r(($data['intake_data']));exit;
        $data['fetch_room'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_class_room_intake as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk']]);

        $data['fetch_lab'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_lab_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk']]);

        $data['fetch_library'] = $this->poly_affiliation_model->fetch_all_data('council_polytechnic_affiliation_library_details as c1',['c1.basic_affiliation_id_fk'=>$data['affiliation_data']['basic_affiliation_id_pk']]);
        $data['mandory_data'] = $this->poly_affiliation_model->mandory_master();

        $data['fetch_mandory_data'] = $this->poly_affiliation_model->fetch_mandory_data($data['affiliation_data']['basic_affiliation_id_pk']);

        $data['payment_status'] = $this->poly_affiliation_model->getPaymentStatus($id_hash);

        $data['fetch_fees_data'] = $this->poly_affiliation_model->fetch_poly_fees_data($data['affiliation_data']['basic_affiliation_id_pk'],$data['affiliation_data']['affiliation_type_id_fk']);
         
        // Payment 
        if($data['affiliation_data']['institute_category_id_fk'] == 4){
            $affiliation_fees = 30000;
            if(count($data['intake_data']) > 4){
                $increse_course_no =  count($data['intake_data']) - 4;
                $increse_course_amnt = 7500 * $increse_course_no;
            }else{
                $increse_course_amnt = 0;
            }
            //echo $increse_course_amnt;die;
            $i = 0;
            $blank_array=array();
            foreach ($data['intake_data'] as $key => $value) {
                if($value['intake_no'] > 60){
                    $increase_value = $value['intake_no'] - 60;
                    array_push($blank_array,$value['remarks']);
                    
                    $increase_intake_no = floor($increase_value / 60);
                    $i = $i+$increase_intake_no;

                    //echo "<br>";
                }
            }
            //echo "<pre>";print_r($blank_array);die;
            //echo $i;die;
            if($i == 0){
                $increase_intake_amount = 0;
                $description = '';
            }else{
                $increase_intake_amount = 7500 * $i;
                $description = implode(' / ', $blank_array);
            }



            $data['payment'] = array(
                'application_fees' => 1000,
                'inspection_fees'  => 10000,
                'affiliation_fees' => $affiliation_fees,
                'increse_course_amnt' => $increse_course_amnt,
                'increase_intake_amount' => $increase_intake_amount,
                'new_or_renewal'        => ($data['affiliation_data']['new_or_renewal'] == 2)? 'Renewal of' : '',
                'total_fees'            =>  1000 + 10000 + $affiliation_fees + $increse_course_amnt + $increase_intake_amount ,
                'description'           => $description
    
            );
            //echo "<pre>";print_r($data['payment']);exit;
        }else{
            $data['payment'] = array();
        }
        // echo "<pre>";
        // print_r($data);
        $this->m_pdf->pdf->AddPage('P');
        $this->m_pdf->pdf->SetWatermarkImage( $_SERVER['DOCUMENT_ROOT'] . '/' .'admin/themes/adminlte/assets/image/certificate/logo.png', 0.1,[100, 100]); 
        $this->m_pdf->pdf->showWatermarkImage = true;
        //$this->load->view($this->config->item('theme') . 'polytechnic_affiliation/affiliation_doc_upload'); 
        $html   = $this->load->view($this->config->item('theme') . 'polytechnic_affiliation/application_form',$data,true);
        $this->m_pdf->pdf->WriteHTML($html);

        $this->m_pdf->pdf->Output($pdfFilePath, 'I');
    }


}