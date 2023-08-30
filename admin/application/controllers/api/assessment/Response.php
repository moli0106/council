<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Response extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('api/response_model');

        $this->css_head = array();

        $this->js_foot = array(
            1 => $this->config->item('theme_uri') . 'assets/js/sweetalert.js',
            2 => $this->config->item('theme_uri') . 'assessment/api_response.js',
        );
    }

    // ! List all assessment list
    public function index($offset = 0)
    {
        $data['errorResponse'] = $this->response_model->getUnsuccessfulResponse();
        // parent::pre($data);
        $this->load->view($this->config->item('theme') . 'api/response/error_response_view', $data);
    }

    public function sendResponse($id_hash = 0)
    {
        $response_details = $this->response_model->getResponseDetailsById($id_hash)[0];
        // echo "<pre>";print_r($response_details);
        $json_data_id = $response_details['council_json_data_id_pk'];
        $json_response_data = json_decode($response_details['council_assessment_json_file']);

        $vertical_code = $json_response_data->verticalId;

        $this->load->config('wbsctvesd_api_config');
        $url = $this->config->item('assessor_assign_url')[$vertical_code];


        $this->load->library('curl');
        $curl_response = $this->curl->curl_make_post_request($url, $json_response_data);

        if ($curl_response) {

            $this->response_model->updateAssessmentjsonData($json_data_id, array('response_status' => 1));
            echo json_encode('done');
        }

    }
}
