<?php
	
class Meal_model extends CI_Model {
	
	/**
		CONSTRUCT
	**/
	public function __construct()	{
		$this->load->database();  // Load the database class
	}
	
	
	/**
		get_meal - Get one approved row/meal from the database
	
			Returns array of meal data of approved meal with $id if $id is supplied. 
			Returns random approved meal if no $id is supplied.
	**/
	public function get_meal($id = false) {
		if($id != false) { // $id has been set
			$sql = "SELECT * FROM meals WHERE meals_approved = ? AND meals_id = ? LIMIT 1"; // Get all data of a approved meal of given $id
			$query = $this->db->query($sql, array(1, $id));
			return $query->row_array();
	 	}
		else { // $id has not been set
			$query = $this->db->query("SELECT * FROM meals WHERE meals_approved = 1 ORDER BY RAND() LIMIT 1"); // Select a random row
			
			return $query->row_array();
		}
	}
	
	/**
		get_total_meals - Number of approved meals in the database
	
			Returns an integer with the total number of approved meals in the database
	**/
	public function get_total_meals() { // Get the total number
		$count = $this->db->query("SELECT COUNT(*) as c FROM meals WHERE meals_approved = 1")->result_array();
		return $count[0]['c']; // Return as integer
	}
	
	
}
	
?>