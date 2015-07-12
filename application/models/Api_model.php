<?php
	
class Api_model extends CI_Model {
	
	/**
		CONSTRUCT
	**/
	public function __construct()	{
		$this->load->database();  // Load the database class
	}
	
	
	/**
		api_log - Inputs a row into the log table
	
			Requires $action and $input, $action being an identifier for the type of action logged, and $input being an array with data to store.
	**/
	public function api_log($action,$input,$success) {
		
		$data = array('action' => $action,
				  'data' => $input,
				  'success' => $success,
				  'ip' => $this->input->ip_address());
		$this->db->insert('api_log', $data);
		
	}
	
}
	
?>