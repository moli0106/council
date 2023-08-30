<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notices_and_circulars extends NIC_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('notices_and_circulars_model');
        //$this->output->enable_profiler(TRUE);

        $this->css_head = array(
            1 => $this->config->item('theme_uri') . 'councils/css/datepicker.css',
        );

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'councils/js/datepicker.js',
        );
    }

    public function index($offset = 0)
    {
        /* $data['offset'] = $offset;
        $this->load->library('pagination');

        $config['base_url']         = 'notices_and_circulars/index/';
        $data["total_rows"]         = $config['total_rows'] = $this->notices_and_circulars_model->getPublicationListCount()[0]['count'];
        $config['per_page']         = 2;
        $config['num_links']        = 2;
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = '<i class="fa fa-fast-backward"></i>';
        $config['first_tag_open']   = '<li class="page-item">';
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

        $data['publication_list'] = $this->notices_and_circulars_model->get_publication($config['per_page'], $offset);
        
        $data['page_links']  = $this->pagination->create_links(); */

        $data['publication_type'] = $this->notices_and_circulars_model->get_publication_type();
        $data['publication_list'] = $this->notices_and_circulars_model->get_publication();

        $this->load->view($this->config->item('theme') . 'notices_and_circulars/notices_and_circulars_list_view', $data);
    }

    public function download($id_hash = NULL)
    {
        if ($id_hash != NULL) {

            $result = $this->notices_and_circulars_model->get_publication_details($id_hash);
            if (!empty($result)) {

                $result = $result[0];

                $uploaded_file     = $result['uploaded_file'];
                $publication_title = time();

                header("Content-type:application/pdf");
                header("Content-Disposition:attachment;filename=" . $publication_title . ".pdf");

                echo base64_decode($uploaded_file);
            } else {

                redirect('notices_and_circulars');
            }
        } else {

            redirect('notices_and_circulars');
        }
    }

    public function search()
    {
        if ($this->input->server('REQUEST_METHOD') == "POST") {

            $publication_type = $this->input->post('publication_type');
            $keywords         = $this->input->post('keywords');
            $published_date   = $this->_us_date_format($this->input->post('published_date'));

            $data['publication_type'] = $this->notices_and_circulars_model->get_publication_type();
            $data['publication_list'] = $this->notices_and_circulars_model->search_publication($publication_type, $keywords, $published_date);

            // print_r($data);

            $this->load->view($this->config->item('theme') . 'notices_and_circulars/notices_and_circulars_list_view', $data);
        } else {

            redirect('notices_and_circulars');
        }
    }

    private function _us_date_format($uk_date = NULL)
    {
        if ($uk_date != NULL) {
            $date_array = explode('/', $uk_date);
            return $date_array[2] . '-' . $date_array[1] . '-' . $date_array[0];
        } else {
            show_404();
        }
    }
}
