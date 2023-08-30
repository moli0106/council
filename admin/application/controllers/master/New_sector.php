<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class New_sector extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(2);
        $this->load->model('master/new_sector_model');
        // $this->css_head = array(
        //     1 => $this->config->item('theme_uri')."bower_components/select2/dist/css/select2.min.css"
        // );
        $this->js_foot = array(
            //1 => $this->config->item('theme_uri')."bower_components/select2/dist/js/select2.full.min.js",
            2 => $this->config->item('theme_uri')."master/new_sector.js",
        );
		
    } 
    public function index($offset = 0){
        $data['offset']         = $offset;
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('pagination');
		
		$config['base_url']         = 'master/new_sector/index/';
		$config['total_rows']       = $this->new_sector_model->get_sector_count()[0]['count'];	
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

        $this->form_validation->set_rules('sector_name', '<b>sector name</b>', 'trim|required|max_length[100]|is_unique[council_sector_master.sector_name]');
        $this->form_validation->set_rules('sector_code', '<b>sector code</b>', 'trim|required|max_length[20]|is_unique[council_sector_master.sector_code]');
        $this->form_validation->set_rules('sector_desc', '<b>sector description</b>', 'trim|max_length[1000]');

        

        if ($this->form_validation->run() == FALSE) {
            $data['sectors']  	= $this->new_sector_model->get_sector($config['per_page'],$offset);
            $this->load->view($this->config->item('theme').'master/new_sector_view',$data);
        }  else {
            
           $insert_array = array(
               'table_name' => 'council_sector_master',
               'data'       => array(
                   'sector_code' => $this->input->post('sector_code'),
                   'sector_name' => $this->input->post('sector_name'),
                   'sector_description' => $this->input->post('sector_desc'),
                   'entry_time' => 'now()',
                   'entry_ip' => $this->input->ip_address(),
                   'process_status_fk' => 5,
                   'active_status' => 1,
                   'project_type_id_fk' => 2
                )
           );
        
           if($this->new_sector_model->insert($insert_array)){
                $data['status'] = 'success';
                $data['message'] = "New sector has been successfully inserted";
                $data['sectors']  	= $this->new_sector_model->get_sector($config['per_page'],$offset);
                
           } else {
                $data['status'] = 'warning';
                $data['message'] = "Something went wrong. Please try after sometime.";
                $data['sectors']  	= $this->new_sector_model->get_sector($config['per_page'],$offset);
           }
           $this->load->view($this->config->item('theme').'master/new_sector_view',$data);
        }
    }
    public function view_sector_details($sector_id_hash = NULL){
        //echo $sector_id_hash;
        $data['sector'] = $this->new_sector_model->get_sector_details($sector_id_hash)[0];
        //print_r($data['course']);
        $this->load->view($this->config->item('theme').'master/new_sector_details_view',$data);
    }
	
	
	public function edit_sector($sector_id_hash = NULL){
        $data['sector_id_hash'] = $sector_id_hash;
        

        //$this->output->enable_profiler(TRUE);

        if($this->input->method(TRUE) == "GET"){
            $data['sectors'] = $this->new_sector_model->get_sector_details($sector_id_hash)[0];
            
        } else if($this->input->method(TRUE) == "POST"){
            $data['sectors'] = array(
				"sector_id"     => set_value("sector_id_hash"),
                "sector_name"     => set_value("sector_name"),
                "sector_code"     => set_value("sector_code"),
                "sector_description"   => set_value("sector_desc")
            );
        }
        $this->load->library('form_validation');

        $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

        $this->form_validation->set_rules('sector_name', '<b>course name</b>', 'trim|required|max_length[100]|callback_sector_name_check['.$sector_id_hash.']');
        $this->form_validation->set_rules('sector_code', '<b>course code</b>', 'trim|required|max_length[21]|callback_sector_code_check['.$sector_id_hash.']');
        $this->form_validation->set_rules('sector_desc', '<b>course description</b>', 'trim|max_length[1000]');
        


        if ($this->form_validation->run() == FALSE) {
            
           
            $this->load->view($this->config->item('theme').'master/ajax_sector_edit_view',$data);
        }  else {
            
           $update_array = array(
               
                   'sector_name' => $this->input->post('sector_name'),
                   'sector_code' => $this->input->post('sector_code'),
                   'sector_description' => $this->input->post('sector_desc'),
                   'update_time' => 'now()',
                   'update_ip' => $this->input->ip_address(),
                
           );
           $edit_course= $this->new_sector_model->update_course_details($update_array,$sector_id_hash);
           
           if($edit_course!=''){ 
            ?>	
                <div class="alert alert-success">Sector details Updated Successfully.</div>
            <?php
            } else {
            ?>	
				<div class="alert alert-danger">Sector details Updated failed</div>
			<?php
            }

        }
    }
	
	
	function sector_name_check($sector_name,$sector_id_hash)
	{
		$course_id_count = $this->new_sector_model->get_course_name_count($sector_name,$sector_id_hash);
		if($course_id_count ==1 || $course_id_count > 1)
		{
			$this->form_validation->set_message('sector_name_check', 'Sector Name should be unique');
            return false;
		}
		else
		{
			return true;
		}
    }
    
    function sector_code_check($sector_code,$sector_id_hash)
	{
		$course_id_count = $this->new_sector_model->get_course_code_count($sector_code,$sector_id_hash);
		if($course_id_count ==1 || $course_id_count > 1)
		{
			$this->form_validation->set_message('sector_code_check', 'Sector Code should be unique');
            return false;
		}
		else
		{
			return true;
		}
	}
}