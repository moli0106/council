<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_hs_question extends NIC_Controller {

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(114);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('question_set_master/upload_hs_question_model');

        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri').'assets/js/sweetalert.js', 
            2 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            3 => $this->config->item('theme_uri').'question_set_master/upload_hs_question.js', 
        );
    }

    // List all your items
    public function index( $offset = 0 )
    {
        $data = array(
            'course_list' => $this->upload_hs_question_model->getAllcourse(),
        );
        $data['offset'] = $offset;
        $this->load->library('pagination');
        
        $config['base_url']         = 'qbm_master/upload_hs_question/index/';
        if($this->session->userdata('stake_id_fk')==18){
		    $data["total_rows"]         = $config['total_rows'] = $this->upload_hs_question_model->get_hs_question_paperCount()[0]['count'];
        }else{
            $data["total_rows"]         = $config['total_rows'] = $this->upload_hs_question_model->get_vtc_wise_hs_question_paperCount()[0]['count']; 
        }	
		$config['per_page']         = 25;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination pagination-sm no-margin">';
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
        if($this->session->userdata('stake_id_fk')==18){
            $data['questionList'] = $this->upload_hs_question_model->getAll_hs_question_paper($config['per_page'], $offset);
        }else{
            $data['questionList'] = $this->upload_hs_question_model->get_vtc_wise_All_hs_question_paper($config['per_page'], $offset);
        }

        $this->load->view($this->config->item('theme').'question_set_master/upload_hs_question/hs_question_list_view', $data);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            //'sector_list' => $this->upload_hs_question_model->getAllSector(),
            'course_list' => $this->upload_hs_question_model->getAllcourse(),
            'academic_year' => $this->upload_hs_question_model->getAcademicYear()
        );

        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_id',
                    'label' => 'course',
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'subject_id',
                    'label' => 'subject',
                    'rules' => 'trim|required|numeric|is_unique[council_qbm_uploaded_hs_question_paper.subject_id_fk]'
                ),
                array(
                    'field' => 'academic_year',
                    'label' => 'academic year',
                    'rules' => 'trim|required'
                ),
                
            );
		    $this->form_validation->set_rules($config);
			
			$this->form_validation->set_rules('publication_file', 'Publication Upload file', 'trim|callback_file_validation[publication_file|application/pdf|50120|required]');
	
		    if ($this->form_validation->run() == FALSE) {

                $this->load->view($this->config->item('theme').'question_set_master/upload_hs_question/hs_question_upload_view', $data);
            
		    } else {
				
				
                    $post_data = array(
                        
                        'course_id_fk'    	=> $this->input->post('course_id'),
						'subject_id_fk'    	=> $this->input->post('subject_id'),
						'uploaded_question' => base64_encode(file_get_contents($_FILES["publication_file"]['tmp_name'])),
                        'entry_ip'          => $this->input->ip_address(),
                        'entry_by'       	=> $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'        => 'now()',
                        'active_status'     => 1,
                        'academic_year_id_fk'     => $this->input->post('course_id'),
                    );

                    $last_id = $this->upload_hs_question_model->insert_hs_question_paper($post_data);
					
                    if($last_id)
                    {
                        $this->session->set_flashdata('status','success');
                        $this->session->set_flashdata('alert_msg','HS Question Paper Uploaded successfully.');
                    }
                    else
                    {
                        $this->session->set_flashdata('status','danger');
                        $this->session->set_flashdata('alert_msg','Oops! Something went wrong');
                    }
                    
                    redirect('admin/question_set_master/upload_hs_question');
                
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'question_set_master/upload_hs_question/hs_question_upload_view', $data);
        }
    }


    
    public function get_subject($course_id)
	{
		if(is_numeric($course_id))
		{
		$data['subjectList'] = $this->upload_hs_question_model->get_subject_List($course_id);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/subject_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid discipline");</script>
		<?php }
	}
	
	 public function download_uploaded_pdf($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $result = $this->upload_hs_question_model->getQuestionPaperFile($id_hash);
            if (!empty($result)) {

                $result = $result[0];

                $uploaded_file     = $result['uploaded_question'];
                
                $publication_title = time();

                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename=" . $publication_title . ".pdf");

                echo base64_decode($uploaded_file);
            } else {

                redirect('admin/question_set_master/upload_hs_question');
            }
        } else {

            redirect('admin/question_set_master/upload_hs_question');
        }
    }

	// ! File validation function
    public function file_validation($fild = NULL, $file_name = NULL)
    {
        $file_array = explode("|", $file_name);

        if ($file_array[1] == "application/pdf") {
            $ext = "PDF";
        } elseif ($file_array[1] == "image/jpeg") {
            $ext = "JPG";
        }

        if ($file_array[3] == "required") {
            $file_data = $_FILES[$file_array[0]];

            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file is required');
                return FALSE;
            }
        } else {
            $file_data = $_FILES[$file_array[0]];
            if ($file_data['name'] != NULL) {
                if ($file_data['type'] == $file_array[1]) { // mime
                    if ($file_data['size'] <= $file_array[2] * 1024) { // size
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('file_validation', 'The max size is ' . $file_array[2] . ' KB  for {field}');
                        return FALSE;
                    }
                    return TRUE;
                } else {
                    $this->form_validation->set_message('file_validation', 'The {field} file type must be ' . $ext);
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('file_validation', 'The {field} file required');
                return TRUE;
            }
        }
    }

    public function send_question_paper($id_hash = NULL)
    {
        if (!empty($id_hash)) {
            $data['hs_question_details'] = $this->upload_hs_question_model->get_hs_question_details($id_hash)[0];
            $data['vtc_map_details'] = $this->upload_hs_question_model->get_vtc_question_map_details($id_hash);
            $vtc_ids = array_column($data['vtc_map_details'], 'vtc_id_fk');

           //print_r($data['hs_question_details']);die;

            if (!empty($data['hs_question_details'])) {
                
                $data['vtc_list'] = $this->upload_hs_question_model->getAllVtc($vtc_ids,$data['hs_question_details']['subject_id_fk']);
                // print_r($data['vtc_list']);die;

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'vtc_id[]',
                            'label' => 'vtc',
                            'rules' => 'trim|required'
                        ),
                    
                    );
                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == TRUE) {
                        //$result = $this->question_creator_moderator_model->verify_qcm_subject($data['qcm_details']['creator_moderator_id_pk'],$this->input->post('course_id'),$this->input->post('subject_id'))[0];

                        //print_r($result);
                        //echo $result['count'];die;
                        //if ($result['count']==0) {
                        $vtc_Ids = $this->input->post('vtc_id[]');
                        $mapArray = array();
                        foreach ($vtc_Ids as $key => $vtc_Id) 
                        {
                            $mapArray[] = array(
                                'hs_question_id_fk'     => $data['hs_question_details']['hs_question_id_pk'],
                                'vtc_id_fk'             => $vtc_Id,
								'entry_ip'             => $this->input->ip_address(),
								'entry_by'             => $this->session->userdata('stake_holder_login_id_pk'),
								'entry_time'           => 'now()',
								'active_status'         => 1
                            );
                        }
                        $status=$this->upload_hs_question_model->map_hs_question_paper_vtc($mapArray);
                            // $status = $this->question_creator_moderator_model->insertSubject($dataArray);
                            if ($status) {

                                $this->session->set_flashdata('status', 'success');
                                $this->session->set_flashdata('alert_msg', 'HS Question Paper maped successfully.');
                            } else {

                                $this->session->set_flashdata('status', 'danger');
                                $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong');
                            }

                            redirect('admin/question_set_master/upload_hs_question/send_question_paper/' . md5($data['hs_question_details']['hs_question_id_pk']));
                        // } else {
                        //     $this->session->set_flashdata('status', 'warning');
                        //     $this->session->set_flashdata('alert_msg', 'Oops! This Subject Already exists ');

                        //     redirect('admin/question_set_master/upload_hs_question/send_question_paper/' . md5($data['qcm_details']['creator_moderator_id_pk']));
                        // }
                    }
                }
                $this->load->view($this->config->item('theme') . 'question_set_master/upload_hs_question/hs_question_paper_vtc_map_view', $data);
            } else {
                redirect('admin/question_set_master/upload_hs_question');
            }
        } else {
            redirect('admin/question_set_master/upload_hs_question');
        }
    }

















    

}


/* End of file master_trainer.php */
?>