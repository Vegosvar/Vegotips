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
	
			Returns object of all categories 
	**/
	public function get_categories() {
		$query = $this->db->query("SELECT * FROM categories");
		
		return $query->result();
	}
	
	
	/**
		get_categories_array - Get all categories from the database
	
			Returns array of all categories 
	**/
	public function get_categories_array() {
		$query = $this->db->query("SELECT * FROM categories");
		
		return $query->result_array();
	}
	
	
	/**
		get_total_categories - Number of categories in the database
	
			Returns an integer with the total number of categories in the database
	**/
	public function get_total_categories() { // Get the total number
		$count = $this->db->query("SELECT COUNT(*) as c FROM categories")->result_array();
		return $count[0]['c']; // Return as integer
	}
	
	
}
	
?>