<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_trade extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        parent::check_privilege(84);
        // $this->output->enable_profiler(TRUE);
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

        // parent::pre($data);

        $this->load->view($this->config->item('theme') . 'qbm_master/group_trade_list_view', $data);
    }

    public function add()
    {
        $data['courseNameList'] = $this->group_trade_model->getCourseNameList();
        //$data['streemNameList'] = $this->group_trade_model->getStreemNameList();
        //$data['disciplineList'] = $this->group_trade_model->getDisciplineList();

        // parent::pre($data);

        if ($this->input->server('REQUEST_METHOD') == 'POST') {

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
                    'rules' => 'trim|required|numeric'
                ),
                array(
                    'field' => 'group_name',
                    'label' => 'Group/Trade Name',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
                array(
                    'field' => 'group_code',
                    'label' => 'Group/Trade Code',
                    'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                    'errors' => array(
                        'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                    )
                ),
               
            );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE) {
                if(set_value('course_id') != NULL){
					
                    $data['disciplineList'] = $this->group_trade_model->getDisciplineList(set_value('course_id'));
                }
                $this->load->view($this->config->item('theme') . 'qbm_master/group_trade_add_view', $data);
            } else {

                $insertArray = array(
                    'course_id_fk'      => $this->input->post('course_id'),
                    'discipline_id_fk'  => $this->input->post('discipline_id'),
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

                    redirect('admin/qbm_master/group_trade/add');
                }
            }
        } else {

            $this->load->view($this->config->item('theme') . 'qbm_master/group_trade_add_view', $data);
        }
    }
	
	
	
	
	
	

    public function removeCourseMaster($id_hash = NULL)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        } else {

            if (!empty($id_hash)) {

                $courseMaster = $this->group_trade_model->getCourseMasterByIdHash($id_hash);
                if (!empty($courseMaster)) {

                    $status = $this->group_trade_model->updateCourseMaster($id_hash, array('active_status' => 0));

                    if ($status) {
                        echo json_encode('success');
                    }
                }
            }
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


    public function update($id_hash = NULL)
    {
        if (!empty($id_hash)) {

            $courseMaster = $this->group_trade_model->getCourseMasterByIdHash($id_hash);
            if (!empty($courseMaster)) {

                $data['courseMaster']   = $courseMaster[0];
                $data['courseNameList'] = $this->group_trade_model->getCourseNameList();
                $data['streemNameList'] = $this->group_trade_model->getStreemNameList();
                $data['disciplineList'] = $this->group_trade_model->getDisciplineList();

                // parent::pre($data);

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $data['formData'] = array(
                        'course_name_id_fk' => set_value('course_name_id'),
                        'streem_name_id_fk' => set_value('streem_name_id'),
                        'group_name'        => set_value('group_name'),
                        'group_code'        => set_value('group_code'),
                        'discipline_id'     => set_value('discipline_id'),
                    );
                } else {
                    $data['formData'] = array(
                        'course_name_id_fk' => $data['courseMaster']['course_name_id_fk'],
                        'streem_name_id_fk' => $data['courseMaster']['streem_name_id_fk'],
                        'group_name'        => $data['courseMaster']['group_name'],
                        'group_code'        => $data['courseMaster']['group_code'],
                        'discipline_id'     => $data['courseMaster']['discipline_id_fk'],
                    );
                }

                if ($this->input->server('REQUEST_METHOD') == 'POST') {

                    $this->load->library('form_validation');
                    $this->form_validation->set_error_delimiters('<div class="text-red">', '</div>');

                    $config = array(
                        array(
                            'field' => 'group_name',
                            'label' => 'Group/Trade Name',
                            'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                            'errors' => array(
                                'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                            )
                        ),
                        array(
                            'field' => 'group_code',
                            'label' => 'Group/Trade Code',
                            'rules' => 'trim|required|max_length[250]|regex_match[/^[a-zA-Z0-9-&_,.()\/ ]+$/]',
                            'errors' => array(
                                'regex_match' => 'Do not Use Special Charecters other than ( -_,.()/ ) these.',
                            )
                        ),
                        array(
                            'field' => 'course_name_id',
                            'label' => 'Course Name',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'streem_name_id',
                            'label' => 'Streem Name',
                            'rules' => 'trim|required|numeric'
                        ),
                        array(
                            'field' => 'discipline_id',
                            'label' => 'Discipline',
                            'rules' => 'trim|required|numeric'
                        )
                    );

                    $this->form_validation->set_rules($config);

                    if ($this->form_validation->run() == FALSE) {

                        $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_update_view', $data);
                    } else {

                        $updateArray = array(
                            'course_name_id_fk' => $this->input->post('course_name_id'),
                            'streem_name_id_fk' => $this->input->post('streem_name_id'),
                            'discipline_id_fk'  => $this->input->post('discipline_id'),
                            'group_name'        => $this->input->post('group_name'),
                            'group_code'        => $this->input->post('group_code'),
                            'entry_ip'          => $this->input->ip_address(),
                            'entry_by_login_id' => $this->session->userdata('stake_holder_login_id_pk')
                        );
                        // parent::pre($updateArray);

                        $result = $this->group_trade_model->updateCourseMaster($id_hash, $updateArray);

                        if ($result) {

                            $this->session->set_flashdata('status', 'success');
                            $this->session->set_flashdata('alert_msg', 'Course Master updated successfully.');

                            redirect('admin/master/affiliation_course');
                        } else {

                            $this->session->set_flashdata('status', 'danger');
                            $this->session->set_flashdata('alert_msg', 'Oops! Something went wrong.');

                            redirect('admin/master/affiliation_course/add');
                        }
                    }
                } else {

                    $this->load->view($this->config->item('theme') . 'master/affiliation_course/course_master_update_view', $data);
                }
            } else {
                redirect('admin/master/affiliation_course');
            }
        } else {
            redirect('admin/master/affiliation_course');
        }
    }
}
