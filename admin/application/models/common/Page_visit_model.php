<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_visit_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
	}
	
	function set(){
		//$this->output->enable_profiler(TRUE);
		$this->load->helper('date');
		$this->load->library('user_agent');

		if($this->db->table_exists('council_page_visit_log_'.date('Y')) == FALSE){
			$this->load->dbforge();
			
			$fields = array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11, 
					'unsigned' => TRUE,
					'auto_increment' => TRUE
					),
				'date_time' => array(
					'type' => 'timestamp without time zone',
					'null' => TRUE
					),
				'login_id' => array(
					'type' =>'VARCHAR',
					'constraint' => '50',
					'null' => TRUE
					),
				'stake_holder_login_id_fk' => array(
					'type' => 'INT',
					'constraint' => 11, 
					'unsigned' => TRUE
					),
				'ip' => array(
					'type' => 'VARCHAR',
					'constraint' => '16',
					'null' => TRUE
					),
				'user_agent' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE
					),
				'platform' => array(
					'type' => 'VARCHAR',
					'constraint' => '50',
					'null' => TRUE
					),
				'browser' => array(
					'type' => 'VARCHAR',
					'constraint' => '20',
					'null' => TRUE
					),
				'browser_version' => array(
					'type' => 'VARCHAR',
					'constraint' => '20',
					'null' => TRUE
					),
				'page_name' => array(
 					'type' => 'TEXT',
					//'constraint' => '255',
					'null' => TRUE
					),
				'referrer' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE
					),
				'method' => array(
					'type' => 'VARCHAR',
					'constraint' => '10',
					'null' => TRUE
					),
                );

			
			$this->dbforge->add_field($fields);
			$this->dbforge->add_key('id', TRUE);
			$this->dbforge->create_table('council_page_visit_log_'.date('Y'));
		}
		
		$data = array(
			'date_time' 				=> date('Y-m-d H:i:s'),
			'login_id' 					=> $this->session->login_id,
			'stake_holder_login_id_fk'	=> $this->session->stake_holder_login_id_pk,
			'ip' 						=> $this->input->ip_address(),
			'user_agent' 				=> $this->agent->agent_string(),
			'platform' 					=> $this->agent->platform(),
			'browser' 					=> $this->agent->browser(),
			'browser_version' 			=> $this->agent->version(),
			'page_name' 				=> uri_string(),
			'referrer'					=> $this->agent->referrer(),
			'method'					=> $this->input->method(TRUE)
			);

		$this->db->insert('council_page_visit_log_'.date('Y'), $data);

	}
}
