<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_trade extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(84);
        //$this->output->enable_profiler(TRUE);
        $this->load->model('qbm_master/group_trade_model');

        $this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
		);
        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            3 => $this->config->item('theme_uri') . 'qbm_master/group_trade.js',
        );
    }

    public function index($offset = 0)
    {
        
        $data['offset'] = $offset;

        $this->load->library('pagination');

        $config['base_url']         = 'qbm_master/group_trade/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->group_trade_model->getGroupTradeMasterCount()[0]['count'];
        $config['per_page']         = 25;
        $config['num_links']        = 3;
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
        $data['groupList']  = $this->group_trade_model->getGroupTradeList($config['per_page'], $offset);

        $this->load->library('form_validation');
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                
                array(
                    'field' => 'group_name',
                    'label' => 'Group/Trade Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]|is_unique[council_qbm_group_trade_master.group_trade_name]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'group_code',
                    'label' => 'Group/Trade Code',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]|is_unique[council_qbm_group_trade_master.group_trade_code]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
               
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                
                $this->load->view($this->config->item('theme') . 'qbm_master/group_trade_list_view', $data);
            } else {

                $insertArray = array(
                    //'course_id_fk'      => $this->input->post('course_id'),
                    //'discipline_id_fk'  => $this->input->post('discipline_id'),
                    'group_trade_name'  => $this->input->post('group_name'),
                    'group_trade_code'  => $this->input->post('group_code'),
                    'entry_ip'          => $this->input->ip_address(),
                    'inserted_by'       => $this->session->userdata('stake_holder_login_id_pk'),
                    'entry_time'        => 'now()'
                );
                // parent::pre($insertArray);

                $result = $this->group_trade_model->insertGroupTradeMaster($insertArray);

                if ($result) {

                    $this->session->set_flashdata('status', 'success');
                    $this->session->set_flashdata('alert_msg', 'Group/Teade Master added successfully.');

                    redirect('admin/qbm_master/group_trade');
                } else {

                    $this->session->set_flashdata('status', 'danger');
                    $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                    redirect('admin/qbm_master/group_trade');
                }
            }
        
    }

    public function course_disc_group_trade_map(){

        $data['courseNameList'] = $this->group_trade_model->getCourseNameList();
        $data['groupList']  = $this->group_trade_model->getGroupTradeList();
        $data['group_dis_map_list']  = $this->group_trade_model->getDiscilineGroupTradeMapList();
        
        
        if($this->input->server('REQUEST_METHOD') == "POST")
        {
            $this->load->library('form_validation');
            
            $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

            $config = array(
                array(
                    'field' => 'course_id',
                    'label' => 'Course Name',
                    'rules' => 'trim|required|numeric'
                ),
                
                array(
                    'field' => 'discipline_id',
                    'label' => 'Discipline',
                    'rules' => 'trim|required'
                ),
                array(
                    'field' => 'group_trade_id',
                    'label' => 'Group/Trade',
                    'rules' => 'trim|required|callback_same_course_discipline_group_trade_check'
                ),
            );
		    $this->form_validation->set_rules($config);
	
		    if ($this->form_validation->run() == FALSE) {

                if(set_value('course_id') != NULL){
                    $data['disciplineList'] = $this->group_trade_model->getDisciplineList(set_value('course_id'));
                }
                $this->load->view($this->config->item('theme').'qbm_master/course_disc_group_trade_map_view', $data);
            
		    } else {
				$discipline_id = $this->input->post('discipline_id');
				$course_id      = $this->input->post('course_id');
				$group_trade_id      = $this->input->post('group_trade_id');
				
                $post_data = array(
                        'course_id_fk'      => $course_id,
                        'discipline_id_fk'  => $discipline_id,
                        'group_trade_id_fk' => $group_trade_id,
                        'entry_ip'          => $this->input->ip_address(),
                        'inserted_by'       => $this->session->userdata('stake_holder_login_id_pk'),
                        'entry_time'        => 'now()'
                    );
                $this->group_trade_model->map_course_discipline_group_trade($post_data);
    
                $this->session->set_flashdata('status','success');
                $this->session->set_flashdata('alert_msg','Discipline Group/Trade Mapped successfully.');
            
            redirect('admin/qbm_master/group_trade/course_disc_group_trade_map');
                
            }
        }
        else
        {
            $this->load->helper('form');
            $this->load->view($this->config->item('theme').'qbm_master/course_disc_group_trade_map_view', $data);
        }
    }

    public function get_discipline($course_code)
	{
		if(is_numeric($course_code))
		{
		$data['disciplineList'] = $this->group_trade_model->getDisciplineList($course_code);
		$this->load->view($this->config->item('theme').'qbm_master/ajax_view/discipline_ajax_view',$data);
		}
		else
		{?>
		<script>alert("Something Went Wrong...Please Provide Valid Course");</script>
		<?php }
	}

    public function same_course_discipline_group_trade_check(){
        $course_id = $this->input->post('course_id');
        $discipline_id = $this->input->post('discipline_id');
        $group_trade_id = $this->input->post('group_trade_id');
		if($course_id!='' and $discipline_id!='' and $group_trade_id!=''){
        $data_count=$this->group_trade_model->get_same_course_discipline_group_trade_data($course_id,$discipline_id,$group_trade_id)[0]['count'];
        //print_r($data_count);die;
		if($data_count == 0){
            return TRUE;
            } else {
                $this->form_validation->set_message('same_course_discipline_group_trade_check', 'The {field} is already mapping with Course and Discipline ');
                return FALSE;
            }
	    }
    }
    


}
