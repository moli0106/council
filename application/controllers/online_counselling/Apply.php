<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apply extends NIC_Controller
{
    function __construct()
    {
		parent::__construct();
		
		
	}
	
	public function index()
    {
		$this->load->view($this->config->item('theme') . 'online_counselling/apply_view');
	}
}