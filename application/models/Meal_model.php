<?php
	
class Meal_model extends CI_Model {
	
	/**
		CONSTRUCT
	**/
	public function __construct()	{
		$this->load->database();  // Load the database class
	}
	
	
	/**
		_update_views - Adds 1 to the number of views of a meal row [PRIVATE]
	
			Requires clean $id parameter 
	**/
	private function _update_views($id) {
		
		if(isset($_COOKIE['meal_views'])) { // Check if cookie is set
			$cookie_data = json_decode($_COOKIE['meal_views'], true); // Decode the cookie string into an array
			
			if (!in_array($id,$cookie_data)) { // Meal id is not in cookie array, proceed to bump views
				$this->db->where('meals_id', $id);
				$this->db->set('meals_views', 'meals_views +1', FALSE);
				$this->db->update('meals');
		
				$cookie_data[] = $id; // Add $id to cookie array
				setcookie('meal_views', json_encode($cookie_data), time()+1800); // Set the cookie again, 30MIN expiry time
		
				return true;
			}
			else {
				// User has already viewed this meal.
				return false; // fail silently
			}
		} else { // No cookie has been set
			$this->db->where('meals_id', $id);
			$this->db->set('meals_views', 'meals_views +1', FALSE);
			$this->db->update('meals');
	
			$cookie_data = array($id); // Add $id to cookie array
			setcookie('meal_views', json_encode($cookie_data), time()+1800); // Set the cookie for the first time, 30MIN expiry time
	
			return true;
		}
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
			
			$this->_update_views($id); // Update number of views
			return $query->row_array();
	 	}
		else { // $id has not been set
			$query = $this->db->query("SELECT * FROM meals WHERE meals_approved = 1 ORDER BY RAND() LIMIT 1"); // Select a random row
			if($query->num_rows() == 1) {
				$return = $query->row_array();
				
				$this->_update_views($return['meals_id']); // Update number of views
				return $return; // Return row only if it is the only row.
			} else {
				return false; // Return false if more than 1 or 0 rows are returned.
			}
			
		}
	}
	
	
	/**
		update_click - Bump number of clicks of a meal
	
			Requires clean $id, returns true (--if bump is successful--)
	**/
	public function update_click($id) { // Get the total number
		$this->db->where('meals_id', $id);
		$this->db->set('meals_up', 'meals_up +1', FALSE);
		$this->db->update('meals');
		
		// TODO: Error catching
		
		return true;
	}
	
	
	/**
		insert_meal - Insert a new submission into meals table
	
			Requires name, link and category
	**/
	public function insert_meal($name, $link, $category) {
		$data = array('meals_name' => $name,
				  'meals_link' => $link,
				  'meals_category' => $category);
		$this->db->insert('meals', $data);
		
		// TODO: Error catching
		
		return true;
	}
	
	
	/**
		get_total_meals - Number of approved meals in the database
	
			Returns an integer with the total number of approved meals in the database
	**/
	public function get_total_meals() { // Get the total number
		$count = $this->db->query("SELECT COUNT(*) as c FROM meals WHERE meals_approved = 1")->result_array();
		return $count[0]['c']; // Return as integer
	}
	
	
	/**
		get_all_meals - Number of approved meals in the database
	
			Returns all meals, or all approved/unapproved meals. Accepts null (returns all meals), 1 (returns all accepted meals) or 0 (returns all not yet accepted meals).
	**/
	public function get_all_meals($approved) { // Get the total number
		if ($approved === null) { // Return all meals, regardless of being approved or not.
			$query = $this->db->query("SELECT * FROM meals ORDER BY meals_id ASC"); // Select all rows
		} else {	
			$sql = "SELECT * FROM meals WHERE meals_approved = ? ORDER BY meals_id ASC"; // Get all data of a approved/unapproved meal
			$query = $this->db->query($sql, array($approved));
		}
		
		return $query->result_array(); // Return all data as array
	}
}
	
?>