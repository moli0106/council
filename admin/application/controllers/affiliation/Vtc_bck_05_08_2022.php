<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vtc extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(66);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('affiliation/vtc_model');
        $this->load->model('vtc_infrastructure/final_submit_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . "bower_components/select2/dist/css/select2.min.css",
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'affiliation/vtc.js',
            2 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            3 => $this->config->item('theme_uri') . "bower_components/select2/dist/js/select2.full.min.js",
        );
        $this->load->helper('email');
        $this->load->library('sms');
    }

    public function index($offset = 0)
    {
        $data['offset'] = $offset;

        $this->load->library('pagination');

        $config['base_url']         = 'affiliation/vtc/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->vtc_model->getVtcListCount()[0]['count'];
        $config['per_page']         = 100;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="">';
        $config['first_tag_close']  = '</li>';
        $config['last_link']        = '<i class="fa fa-fast-forward"></i>';
        $config['last_tag_open']    = '<li class="">';
        $config['last_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '<i class="fa fa-backward"></i>';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '<i class="fa fa-forward"></i>';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="javascript:void(0)">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';

        $this->pagination->initialize($config);

        $data['page_links']  = $this->pagination->create_links();
        $data['vtcList']     = $this->vtc_model->getVtcList($config['per_page'], $offset);

        // $data['vtcList'] = $this->vtc_model->getVtcList();

        // echo "<pre>";print_r($data['vtcList']);exit;

        $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_list_view', $data);
    }

    public function details($vtc_details_id_pk = NULL)
    {
        if (!empty($vtc_details_id_pk)) {

            $data['vtcDetails'] = $this->vtc_model->getVtcDetails($vtc_details_id_pk);
            if (!empty($data['vtcDetails'])) {

                $data['nearest_vtc'] = $this->vtc_model->getNearestVtc($data['vtcDetails']['vtc_details_id_pk']);

                // $data['vtcCourseList']  = $this->vtc_model->getVtcCourseList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                // if (!empty($data['vtcCourseList'])) {

                //     if (!empty($data['vtcCourseList']['hs_voc_discipline'])) {

                //         $data['vtcCourseList']['hs_voc_discipline'] = explode(',', $data['vtcCourseList']['hs_voc_discipline']);
                //         $data['vtcCourseList']['hs_voc_courses']    = explode(',', $data['vtcCourseList']['hs_voc_courses']);

                //         $data['hsDiscipline']  = $this->vtc_model->getDisciplineById($data['vtcCourseList']['hs_voc_discipline']);
                //         $data['hsCourseList']  = $this->vtc_model->getCourseListById($data['vtcCourseList']['hs_voc_courses']);
                //     }

                //     if (!empty($data['vtcCourseList']['stc_discipline'])) {
                //         $data['vtcCourseList']['stc_discipline']    = explode(',', $data['vtcCourseList']['stc_discipline']);
                //         $data['vtcCourseList']['stc_course']        = explode(',', $data['vtcCourseList']['stc_course']);


                //         $data['stcDiscipline'] = $this->vtc_model->getDisciplineById($data['vtcCourseList']['stc_discipline']);
                //         $data['stcCourseList'] = $this->vtc_model->getCourseListById($data['vtcCourseList']['stc_course']);
                //     }
                // }

                // Added by moli on 20-06-2022
                $data['academic_year'] = $data['vtcDetails']['academic_year'];

                $data['vtcCourseList']  = $this->vtc_model->getVtcAllCourseList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                // echo "<pre>";print_r($data['vtcCourseList']);exit;

                $data['teacherList'] = $this->vtc_model->getVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                $data['studentCountDetails'] = $this->vtc_model->getStudentCountDetails($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);


                // Added by Moli For 2nd phase
                $data['paperLabData'] = $this->final_submit_model->getVTCPaperLabData($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);

                $data['commonLabData'] = $this->final_submit_model->getAllCommonLabData($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
    
                $data['classRoomData'] = $this->final_submit_model->getVTCClassRoomData($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                $data['labSizeData'] = $this->final_submit_model->getLabSizeDetails($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
    
                $data['otherData'] = $this->final_submit_model->getOtherInfarstructureDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
    
                $data['computerLabData'] = $this->final_submit_model->getComputerLabDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
                

                $data['agriDisciplineExist'] = $this->final_submit_model->getVtcDiscipline($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                if($data['agriDisciplineExist'] == 'yes'){
        
                    $data['agriData'] = $this->final_submit_model->getAgriDisciplineDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
        
                }
                $data['offset']=0;

                // Added by Moli For 2nd phase

                // parent::pre($data['teacherList']);

                // echo "<pre>";print_r($data);exit;

                // $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details_view', $data);

                $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details/vtc_details_view', $data);
            } else {
                redirect('admin/affiliation/vtc');
            }
        } else {
            redirect('admin/affiliation/vtc');
        }
    }

    public function vtcEmailUpdate()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'vtc_email',
                    'label' => 'Email Id',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'hoi_email',
                    'label' => 'Email Id',
                    'rules' => 'trim|required|valid_email'
                ),
                array(
                    'field' => 'vtc_details_id_hash',
                    'label' => 'Email Id',
                    'rules' => 'trim|required'
                )
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() != FALSE) {

                $vtc_details_id_hash = $this->input->post('vtc_details_id_hash');

                $vtc_data = $this->vtc_model->getVtcDetails($vtc_details_id_hash);
                if (!empty($vtc_data)) {

                    $updateArray = array(
                        'vtc_email' => $this->input->post('vtc_email'),
                        'hoi_email' => $this->input->post('hoi_email'),
                    );

                    $result = $this->vtc_model->updateVtcData($updateArray, $vtc_details_id_hash);

                    if ($result) {

                        // ! Create VTC Password
                        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
                        $codeAlphabet .= "0123456789";

                        $login_password     = substr(str_shuffle($codeAlphabet), 0, 8);

                        $vtcLoginDetails = array(
                            'stake_id_fk'          => 15,
                            'stake_details_id_fk'  => $vtc_data['vtc_id_fk'],
                        );
                        $vtcLoginUpdate = array(
                            'base_password'        => $login_password,
                            'login_password'       => hash("sha256", $login_password),
                        );

                        $login_status = $this->vtc_model->updateVtcLoginData($vtcLoginDetails, $vtcLoginUpdate);
                        if ($login_status) {

                            // ! Send credentials on email
                            $this->load->helper('email');

                            $data = array(
                                'password'  => $login_password,
                            );

                            $email_subject = "VTC Login Credentials";
                            $email_message = $this->load->view($this->config->item('theme') . 'affiliation/admin/email_template_id_password_view', $data, TRUE);
                            $status = send_email($updateArray['vtc_email'], $email_message, $email_subject);

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'VTC data has been updated successfully.');
                        } else {

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'VTC data has been updated successfully. But curently we are not able to send login credentials on this email.');
                        }
                    } else {

                        $this->session->set_flashdata('status', 'danger');
                        $this->session->set_flashdata('alert_msg', 'Oops! Unable to update data at this moment.');
                    }

                    redirect('admin/affiliation/vtc');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Unable to update data at this moment.');

                    redirect(base_url('admin/affiliation/vtc'));
                }
            } else {

                $this->session->set_flashdata('status', 'danger');
                $this->session->set_flashdata('alert_msg', 'Please enter proper data.');

                redirect(base_url('admin/affiliation/vtc'));
            }
        } else {

            redirect(base_url('admin/affiliation/vtc'));
        }
    }

    public function teachers($teacher_id = NULL)
    {
        $data['teacher'] = $this->vtc_model->getTeacherDetails($teacher_id);
        $data['GroupSubject'] = $this->vtc_model->getAssignedSubjectGroupByTeacherId($teacher_id,  $data['teacher']['teacher_type']);

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'affiliation/admin/teachers_detail_view', $data);
    }

    public function resetVtcData()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $id_hash = $this->input->get('id_hash');
            $action  = $this->input->get('action');

            if (!empty($id_hash) && !empty($action)) {
                if ($action == 1 || $action == 2) {

                    $vtcDetails = $this->vtc_model->getVtcDetails($id_hash);
                    if (!empty($vtcDetails)) {

                        $this->vtc_model->resetCourseTeacherStudent($vtcDetails['vtc_id_pk'], $vtcDetails['vtc_details_id_pk']);
                        echo json_encode('Done');

                        // echo json_encode([$vtcDetails['vtc_id_pk'], $vtcDetails['vtc_details_id_pk']]);
                    }
                }
            }
        }
    }

    public function unblockingVtcData()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            $id_hash = $this->input->get('id_hash');
            $action  = $this->input->get('action');

            if (!empty($id_hash) && !empty($action)) {
                if ($action == 1 || $action == 2) {

                    $vtcDetails = $this->vtc_model->getVtcDetails($id_hash);
                    if (!empty($vtcDetails)) {

                        $this->vtc_model->unblockingVtcData($vtcDetails['vtc_id_pk'], $vtcDetails['vtc_details_id_pk']);
                        echo json_encode('Done');

                        // echo json_encode([$vtcDetails['vtc_id_pk'], $vtcDetails['vtc_details_id_pk']]);
                    }
                }
            }
        }
    }

    public function testVtcCourseChecking()
    {
        $SQL = "SELECT 
                CAVD.vtc_details_id_pk, CAVD.vtc_id_fk, CAVC.vtc_course_id_pk, CAVC.vtc_id_fk AS vtc_id_fk_course, CAVC.vtc_details_id_fk, CAVC.academic_year 
            FROM council_affiliation_vtc_details AS CAVD 
            LEFT JOIN council_affiliation_vtc_courses AS CAVC ON CAVC.vtc_id_fk = CAVD.vtc_id_fk 
            WHERE 
                CAVD.active_status = 1 AND 
                CAVD.vtc_id_fk IN(
			        SELECT 
				        CAVC.vtc_id_fk
			        FROM council_affiliation_vtc_courses AS CAVC
			        LEFT JOIN council_affiliation_vtc_details AS CAVD ON CAVD.vtc_details_id_pk = CAVC.vtc_details_id_fk
			        WHERE CAVD.active_status = 0
	            )
            ORDER BY CAVC.vtc_details_id_fk
        ";

        $query = $this->db->query($SQL);
        $data = $query->result_array();

        echo count($data) . '<br>';

        foreach ($data as $key => $value) {

            echo $mySQL = "UPDATE council_affiliation_vtc_courses SET vtc_details_id_fk = " . $value['vtc_details_id_pk'] . " WHERE vtc_course_id_pk = " . $value['vtc_course_id_pk'] . ";";

            echo '<br>';
        }
    }
	
	
	//Added by Waseem on 25-03-2022
	public function password_mail($qcmid=NULL)
	{
        
		$vtc_details = $this->vtc_model->get_vtc_email($qcmid)[0];
        
        $vtc_details_id_pk=$vtc_details['vtc_id_fk'];
        $vtc_email_id=$vtc_details['vtc_email'];
		$login_dtls = $this->vtc_model->get_vtc_login_dtls($vtc_details_id_pk);
    
		
		$userid   = $login_dtls[0]['base_login_id']; 
		$password = $login_dtls[0]['base_password'];
		$stake_holder_details = $login_dtls[0]['stake_holder_details'];
        $data = array(
            'url'  => base_url('admin'),
            'name' => $stake_holder_details,
            'base_password' => $password,
            'base_login_id' => $userid,
        );
		
		$this->load->helper('email');
        $email_subject = "Credentials For VTC Account";
        $email_message = $this->load->view($this->config->item('theme').'affiliation/admin/email_vtc_credentials', $data, TRUE);
		$send=0;
		if($vtc_email_id!='')
		{
			$send=1;
			$email_status=send_email($vtc_email_id, $email_message, $email_subject);
		}
		
		if($send==0)
		{
			echo '{"status":"No mail id provided"}';
		}
		else
		{
			if($email_status==TRUE)
			{
				echo '{"status":"true"}';
			}
			else
			{
				echo '{"status":"Cannot send mail"}';
			}
		}
	}

    // Added by Moli
    public function cmnLabDetails($id_hash = NULL){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['academic_year']  = $this->config->item('academic_year');

        // get subject name
        
        $data['cmnLabData'] = $this->vtc_model->getCommonLabDetailsById($id_hash);

        // echo "<pre>";print_r($data['cmnLabData']);exit;

        $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details/common_lab_details_view', $data);

    }

    public function paperLabdetails($paper_lab_id_hash = NULL){

        $data['vtc_id']         = $this->session->userdata('stake_details_id_fk');
        $data['paperLabData'] = $this->vtc_model->getPaperLabDetails($paper_lab_id_hash);
        // echo "<pre>";print_r($data['paperLabData']);exit;
        $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details/paper_lab_details_view', $data);
    }

    public function showCmnLabDoc($id_hash = NULL){
        
        if (!empty($id_hash)) {

            $cmnLabData = $this->vtc_model->getCommonLabDetailsById($id_hash);
            if (!empty($cmnLabData)) {

                $equipment_doc = $cmnLabData['equipment_doc'];

                $file_name = 'PDF-' . date('Ymd') . '-' . date('his') . '.pdf';

                // Header content type
                header("Content-type: application/pdf");

                header("Content-Disposition:inline;filename=" . $file_name);

                // header('Content-Transfer-Encoding: binary');
  
                // header('Accept-Ranges: bytes');

                echo base64_decode($equipment_doc);
            }
        } else {
            redirect('admin/affiliation/vtc/cmnLabDetails/'.$id_hash);
        }
    }

    public function showPaperLabDoc($id_hash = NULL){
        
        if (!empty($id_hash)) {

            $paperLabData = $this->vtc_model->getPaperLabDetails($id_hash);
            if (!empty($paperLabData)) {

                $equipment_doc = $paperLabData['equipment_doc'];

                $file_name = 'PDF-' . date('Ymd') . '-' . date('his') . '.pdf';

                // Header content type
                header("Content-type: application/pdf");

                header("Content-Disposition:inline;filename=" . $file_name);

                // header('Content-Transfer-Encoding: binary');
  
                // header('Accept-Ranges: bytes');

                echo base64_decode($equipment_doc);
            }
        } else {
            redirect('admin/affiliation/vtc/paperLabdetails/'.$id_hash);
        }
    }

    // Added by Moli on 27-05-2022

    public function showApproveRejectModal($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['vtcDetails'] = $this->vtc_model->getVtcDetails($id_hash);

                // echo "<pre>";print_r($data['vtcDetails']);

                $html_view = $this->load->view($this->config->item('theme') . 'affiliation/admin/ajax/vtc_approve_reject_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }
    

    public function updateVtcApproveRejectStatus(){
        

        if ($this->input->server('REQUEST_METHOD') == "POST") {
            // if (!$this->input->is_ajax_request()) {
            //             exit('No direct script access allowed');
            //         } else {

           
            
            $status = $this->input->post('status');
            $remarks = $this->input->post('remarks');
            $vtc_details_id_hash = $this->input->post('vtc_details_id_hash');
            $data['vtc_data'] = $this->vtc_model->getVtcDetails($vtc_details_id_hash);

            if($status == 0){
                $updArray = array(
                    'approve_reject_status'  => 0,
                    'vtc_rejection_note'     => $remarks,
                    'approve_reject_time'   => 'now()',
                    'approve_reject_ip'     => $this->input->ip_address(),
                    'approve_reject_by'     => $this->session->userdata('stake_holder_login_id_pk'),
                );

                // echo "<pre>";print_r($data['vtc_data']);exit;

                $rejectStatus = $this->vtc_model->updateVtcData($updArray,$vtc_details_id_hash);

                // if ($rejectStatus) {
                //     echo json_encode('done');
                // }

                // $email_subject = "VTC has been rejected";
                // $email_message = $this->load->view($this->config->item('theme') . 'affiliation/admin/email_template_reject_vtc_view', $data, TRUE);

				// send_email($data["vtc_data"]['vtc_email'],$email_message,$email_subject);
				
                // $sms_message ="Your VTC has been rejected on  ". $updArray['approve_reject_time'];
				// $template_id=0;
				// $this->sms->send($data["vtc_data"]['hoi_mobile_no'],$sms_message,$template_id);

                if ($rejectStatus) {

                    $updateVtc = $this->vtc_model->updateVtcData(array('final_submit_status'=>0,'second_final_submit_status'=>0),$vtc_details_id_hash);

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'VTC successfully rejected.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/affiliation/vtc'));

            }elseif ($status == 1) {

                $updArray = array(
                    'approve_reject_status'  => 1,
                    'vtc_approve_note'     => $remarks,
                    'approve_reject_time'   => 'now()',
                    'approve_reject_ip'     => $this->input->ip_address(),
                    'approve_reject_by'     => $this->session->userdata('stake_holder_login_id_pk'),
                );

                // echo "<pre>";print_r($updArray);exit;

                $rejectStatus = $this->vtc_model->updateVtcData($updArray,$vtc_details_id_hash);

                // if ($rejectStatus) {
                //     echo json_encode('done');
                // }

                if ($rejectStatus) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'VTC successfully approved.');
                } else {
                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                }

                redirect(base_url('admin/affiliation/vtc'));
            }
        }
    }

    public function getRejectNote($id_hash = NULL){

        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {
            if ($id_hash != NULL) {
                $data['vtcDetails'] = $this->vtc_model->getVtcDetails($id_hash);

                // echo "<pre>";print_r($data['vtcDetails']);

                $html_view = $this->load->view($this->config->item('theme') . 'affiliation/admin/ajax/vtc_rejected_note_view', $data, TRUE);

                echo json_encode($html_view);
            }
        }
    }

    // Added by Moli on 27-05-2022

    // Added by Moli on 30-05-2022

    public function download_vtc_pdf($vtc_details_id_pk = NULL){

        if (!empty($vtc_details_id_pk)) {

            $data['vtcDetails'] = $this->vtc_model->getVtcDetails($vtc_details_id_pk);
            if (!empty($data['vtcDetails'])) {

                $data['nearest_vtc'] = $this->vtc_model->getNearestVtc($data['vtcDetails']['vtc_details_id_pk']);

                // $data['vtcCourseList']  = $this->vtc_model->getVtcCourseList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                $data['vtcCourseList']  = $this->vtc_model->getVtcAllCourseList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                // echo "<pre>";print_r($data['vtcCourseList']);exit;

                

                $data['teacherList'] = $this->vtc_model->getVtcTeacherList($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);

                

                

                $data['studentCountDetails'] = $this->vtc_model->getStudentCountDetails($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);


                // Added by Moli For 2nd phase
                $data['paperLabData'] = $this->final_submit_model->getVTCPaperLabData($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);

                $data['commonLabData'] = $this->final_submit_model->getAllCommonLabData($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
    
                $data['classRoomData'] = $this->final_submit_model->getVTCClassRoomData($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                $data['labSizeData'] = $this->final_submit_model->getLabSizeDetails($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
    
                $data['otherData'] = $this->final_submit_model->getOtherInfarstructureDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
    
                $data['computerLabData'] = $this->final_submit_model->getComputerLabDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
                

                $data['agriDisciplineExist'] = $this->final_submit_model->getVtcDiscipline($data['vtcDetails']['vtc_id_fk'], $data['vtcDetails']['academic_year']);
                if($data['agriDisciplineExist'] == 'yes'){
        
                    $data['agriData'] = $this->final_submit_model->getAgriDisciplineDetails($data['vtcDetails']['vtc_id_fk'],$data['vtcDetails']['academic_year']);
        
                }
                $data['offset']=0;

                // Added by Moli For 2nd phase

                // parent::pre($data['teacherList']);

                // $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details_view', $data);

                $html = $this->load->view($this->config->item('theme') . 'affiliation/admin/vtc_details/vtc_pdf_view', $data,true);

                $pdfFilePath = 'VTC-Details-' . date('dmY') . ".pdf";
        
                $this->load->library('m_pdf');
                $this->m_pdf->pdf->SetAuthor('West Bengal State Council of Technical & Vocational Education & Skill Development.');
                $this->m_pdf->pdf->SetWatermarkText('WBSCTVESD', 0.05);
                $this->m_pdf->pdf->showWatermarkText = true;
    
                $this->m_pdf->pdf->WriteHTML($html);
    
                //download it.
                $this->m_pdf->pdf->Output($pdfFilePath, "I");
                // $this->m_pdf->pdf->Output($pdfFilePath, "D");
            } else {
                redirect('admin/affiliation/vtc');
            }
        } else {
            redirect('admin/affiliation/vtc');
        }
    }
    // Added by Moli on 30-05-2022


    
}
