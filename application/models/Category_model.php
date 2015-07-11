<?php
	
class Category_model extends CI_Model {
	
	/**
		CONSTRUCT
	**/
	public function __construct()	{
		$this->load->database();  // Load the database class
	}
	
	
	/**
		get_categories - Get all categories from the database
	
			Returns array of all categories as objects 
	**/
	public function get_categories() {
		$query = $this->db->query("SELECT * FROM categories");
		
		return $query->result();
	}
	
	
}
	
?>