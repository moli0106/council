<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empanelled_assessor_list extends NIC_Controller 
{
	function __construct()
	{
		parent::__construct();
        parent::check_privilege(31);
        $this->load->model('council/empanelled_assessor_list_model');

        $this->load->helper('email');
        $this->load->library('sms');
        //$this->output->enable_profiler();
    }

    public function index($offset = 0){

		
		 $this->css_head = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/css/select2.min.css',
			
		);
		$this->js_foot = array(
			1 => $this->config->item('theme_uri').'bower_components/select2/dist/js/select2.full.min.js',
            2 => $this->config->item('theme_uri')."council/empanelled_assessor_list.js",
            3 => $this->config->item('theme_uri').'jQuery.print.min.js', // added parag 12-01-2021
		);
		
        $data['page_links'] = NULL;
        $this->load->library('pagination');
            if($this->input->method(TRUE) != 'POST'){
            $config['base_url']         = 'council/empanelled_assessor_list/index/';
            $config['total_rows']       = $this->empanelled_assessor_list_model->assessor_count()[0]['count'];	
            $config['per_page']         = 25;
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
            $data['assessors']  	= $this->empanelled_assessor_list_model->get_assessor($config['per_page'],$offset);
            $data['page_links']     = $this->pagination->create_links();
           // $data['offset'] = $offset;
        } else {
				
			$this->load->library('form_validation');
			$this->form_validation->set_rules('pan_no', 'PAN No.', 'trim');
			//$this->form_validation->set_rules('ssc_wbsctvesd_certified', 'SSC/ WBSCTVESD certified assessor', 'trim|numeric');
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>'); 

			if ($this->form_validation->run() == TRUE){
					$data['assessors'] 		= $this->empanelled_assessor_list_model->get_assessor_search($this->input->post('pan_no'));
			} 
			else {
				$data['assessors'] = array();
			}
		}
			$data['offset']         = $offset;
		
        $this->load->view($this->config->item('theme').'council/empanelled_assessor_list_view',$data);
    }




     //Get Job Role and Sector
    public function getSectorJobRole()
    {
        $rowId = $this->input->get('rowId');

        if($rowId)
        {
            $rawHtml     = '';
            $results = $this->empanelled_assessor_list_model->getSectorJobRole($rowId);

            if(count($results))
            {
                $count = 0;
                foreach ($results as $key => $result) 
                {
                    $rawHtml .= '
                        <tr>
                            <td>'.++$count.'</td>
                            <td>'.$result['sector_name'].'</td>
                            <td>'.$result['course_name'].'</td>
                        </tr>
                    ';
                }
            } else {
                $rawHtml .= '<tr><td colspan="3" align="center">No data found...</td></tr>';
            }

            echo json_encode($rawHtml);
        }
    }

     
}