<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification_domain_map extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(10);
        $this->load->model('master/qualification_domain_map_model');
        //$this->output->enable_profiler();
        $this->css_head = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        );
        $this->js_foot = array(
            1 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri')."master/qualification_domain_map.js",
        );
		
    } 
    public function index($offset = 0){
        $data['offset']         = $offset;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
		
		$config['base_url']         = 'master/qualification_domain_map/index/';
		$data["total_rows"] = $config['total_rows']       = $this->qualification_domain_map_model->get_qualification_domain_map_count()[0]['count'];	
		$config['per_page']         = 50;
        $config['num_links']        = 2;
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
		
        $data['page_links']     = $this->pagination->create_links();
       
		
		//print_r($data['sector']);
		//echo $data['page_links'];
        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $this->form_validation->set_rules('qualification', '<b>qualification</b>', 'trim|required|integer');
        $this->form_validation->set_rules('domain', '<b>domain</b>', 'trim|required|integer|callback_same_quali_domain_check');

        //print_r($data['sectors']);
        $data['domains'] = $this->qualification_domain_map_model->get_domain();
        
        $data['qualifications'] = $this->qualification_domain_map_model->get_qualification();

        if ($this->form_validation->run() == FALSE) {
            $data['qualification_domain_map']  	= $this->qualification_domain_map_model->get_qualification_domain_map($config['per_page'],$offset);
            $this->load->view($this->config->item('theme').'master/qualification_domain_map_view',$data);
        }  else {
            
            $map_array = array(
                "qualification_id_fk" => $this->input->post("qualification"),  
                "domain_id_fk" => $this->input->post("domain"),
                'entry_time' => 'now()',
                'entry_ip' => $this->input->ip_address(),
                'entry_by' => $this->session->userdata('stake_holder_login_id_pk'),
                'active_status' => 1    
            );
        
           if($this->qualification_domain_map_model->insert($map_array)){
                $data['status'] = 'success';
                $data['message'] = "Qualification domain map has been successfully inserted";
                $data['qualification_domain_map']  	= $this->qualification_domain_map_model->get_qualification_domain_map($config['per_page'],$offset);
                
           } else {
                $data['status'] = 'warning';
                $data['message'] = "Something went wrong. Please try after sometime.";
                $data['qualification_domain_map']  	= $this->qualification_domain_map_model->get_qualification_domain_map($config['per_page'],$offset);
           }
           $this->load->view($this->config->item('theme').'master/qualification_domain_map_view',$data);
        }  
    }

    public function same_quali_domain_check(){
        $quali = $this->input->post('qualification');
        $domain = $this->input->post('domain');
		if($quali!='' and $domain!=''){
        $data_count=$this->qualification_domain_map_model->get_same_quali_domain_data($quali,$domain)[0]['count'];
        //print_r($data_count);die;
		if($data_count == 0){
            return TRUE;
        } else {
            $this->form_validation->set_message('same_quali_domain_check', 'The {field} is already mapping with Qualification ');
            return FALSE;
        }
	}
		
	}

    public function view_course_details($course_id_hash = NULL){
        $data['course'] = $this->qualification_domain_map_model->get_single_course($course_id_hash)[0];
        $this->load->view($this->config->item('theme').'master/new_course_details_view',$data);
    }

    public function delete_qualification_domain_map_details($council_qualification_domain_hash = NULL,$action = NULL){
        $data['council_qualification_domain_hash'] = $council_qualification_domain_hash;
        $data['council_qualification_domain'] = array();

        //$data['course'] = $this->qualification_domain_map_model->get_single_course($course_id_hash);
        if($action == "delete"){
            $this->qualification_domain_map_model->delete_qualification_domain_map($council_qualification_domain_hash);
        } else {
            $data['council_qualification_domain'] = $this->qualification_domain_map_model->get_single_qualification_domain_map($council_qualification_domain_hash);
        }
        
        $this->load->view($this->config->item('theme').'master/delete_qualification_domain_map_view',$data);
    }

    public function ajax_get_domain($qualification_id = NULL){
        $data['domains'] = $this->qualification_domain_map_model->get_domain_by_quali($qualification_id);

        //print_r($data['domains']);
        //$this->output->enable_profiler();

        echo '<option value="">-- Select Domain --</option>';
        foreach($data['domains'] as $k){ ?>
            <option value="<?php echo $k['domain_id_pk'] ?>"><?php echo $k['domain_name'] ?></option>
        <?php }
        //$data['domains'];
    }







    public function edit_course($course_id_hash = NULL){
        $data['course_id_hash'] = $course_id_hash;
        $data['sectors'] = $this->new_domain_model->get_all_course();
        $data['categories'] = $this->new_domain_model->get_course_category();
        $data['project_types'] = $this->new_domain_model->get_course_project_type();
        
        if($this->input->method(TRUE) == "GET"){
            $data['course'] = $this->new_domain_model->get_single_course($course_id_hash)[0];
            print_r( $data['course']);
        } else if($this->input->method(TRUE) == "POST"){
            $data['course'] = array(
                "course_id"     => set_value("course_id"),
                "course_id_hash"     => md5(set_value("course_id")),
                "course_name"   => set_value("course_name"),
                "course_code"   => set_value("course_code"),
                "course_description"   => set_value("course_desc"),
                "sector_id_fk"     => set_value("sector_id"),
                "trainer_eligibility_criteria"          => set_value("trainer_eligibility_criteria"),
                "minimum_educationl_qualification"      => set_value("minimum_educationl_qualification"),
                "domain_specific_working_experience"    => set_value("domain_specific_working_experience"),
                "assessment_experience"                 =>set_value("assessment_experience"),
                "course_category_id_fk"   => set_value("course_category"),
                "project_type_id_fk"      => set_value("project_type"),
            );
        }
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $this->form_validation->set_rules('course_name', '<b>course name</b>', 'trim|required|max_length[100]|is_unique[council_sector_master.sector_name]');
        $this->form_validation->set_rules('course_code', '<b>course code</b>', 'trim|required|max_length[20]|is_unique[council_course_master.course_code]');
        $this->form_validation->set_rules('course_desc', '<b>course description</b>', 'trim|required|max_length[1000]');
        $this->form_validation->set_rules('sector_id', '<b>sector</b>', 'trim|required|numeric');
        $this->form_validation->set_rules('trainer_eligibility_criteria', '<b>trainer eligibility criteria</b>', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('minimum_educationl_qualification', '<b>minimum educationl qualification</b>', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('domain_specific_working_experience', '<b>domain specific working experience</b>', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('assessment_experience', '<b>assessment experience</b>', 'trim|required|max_length[255]');
        $this->form_validation->set_rules('course_category', '<b>course category</b>', 'trim|required|numeric');
        $this->form_validation->set_rules('project_type', '<b>project type</b>', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            
           
            $this->load->view($this->config->item('theme').'master/ajax_course_edit_view',$data);
        }  else {
            
           $insert_array = array(
               'table_name' => 'council_course_master',
               'data'       => array(
                   'course_name' => $this->input->post('course_name'),
                   'course_code' => $this->input->post('course_code'),
                   'course_description' => $this->input->post('course_description'),
                   'sector_id_fk' => $this->input->post('sector_id'),
                   'trainer_eligibility_criteria' => $this->input->post('trainer_eligibility_criteria'),
                   'minimum_educationl_qualification' => $this->input->post('minimum_educationl_qualification'),
                   'domain_specific_working_experience' => $this->input->post('domain_specific_working_experience'),
                   'assessment_experience' => $this->input->post('assessment_experience'),
                   'course_category_id_fk' => $this->input->post('course_category'),
                   'project_type_id_fk' => $this->input->post('project_type'),
                   'entry_time' => 'now()',
                   'entry_ip' => $this->input->ip_address(),
                   'process_status_fk' => 5,
                   'active_status' => 1
                )
           );
        }
    }

    // domain experience map with course
    public function map_domain_qualification($course_id_hash = NULL){

        //$this->output->enable_profiler();

        
        $data['qualifications'] = $this->new_domain_model->get_qualification();
        $data['domains'] = $this->new_domain_model->get_domain();
        
        //echo "<pre>";
        //print_r($data['domain_experiences']);
        //echo "</pre>";
        $data['course_id_hash'] = $course_id_hash;
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('qualification', '<b>qualification</b>', 'trim|required|integer');
        $this->form_validation->set_rules('domain', '<b>domain</b>', 'trim|required|integer');
        $this->form_validation->set_rules('domain_exp', '<b>domain experience</b>', 'trim|required|integer');
        
        if ($this->form_validation->run() == TRUE) {
            $map_array = array(
                "qualification_id_fk" => $this->input->post("qualification"),
                "domain_specific_working_experience" => $this->input->post("domain_exp"),
                "active_status" =>  1,
                "course_id_fk" => $this->input->post("course_id"),        
                "domain_id_fk" => $this->input->post("domain")
            );
            
            if($this->new_domain_model->set_domain_map($map_array)){
                $data["success"] = "success";
                $data["message"] = "Domain qualification mapped successfully";
            } else {
                $data["success"] = "danger";
                $data["message"] = "Something went wrong. Please try again";
            }
        } 
        
        $data['domain_experiences'] = $this->new_domain_model->get_domain_qualification($course_id_hash);
        $this->load->view($this->config->item('theme').'master/domain_experience_map_view',$data);

    }
}