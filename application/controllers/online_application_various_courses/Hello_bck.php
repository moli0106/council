<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hello extends NIC_Controller
{
    function __construct()
    {
		echo "hii";exit;
		parent::__construct();
	}
	 public function index()
    {
		echo "jjjjjjjjj";exit;
	}
}