<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index($id=false) { // Index controller. Loads any necessary information for the load of the index view.
		
		if (!is_numeric($id)) { // $id is expecte(d to be integer, but is allowed to be empty (false)
			$id = false; // Exit with error code 400 Bad Request
		}
		
		$data = array(); // $data will be passed to the main/index view
		
		$this->load->model('meal_model'); // Load Meal_model
		$data['meal'] = $this->meal_model->get_meal($id); // Get random meal. 
		
		// Calculate the percentage
		if($data['meal']['meals_up'] == 0 && $data['meal']['meals_views'] == 0) { // Stop division by 0 later on, 'meals_up' is number of clicks and 'meals_views' is number of views.
			$data['meal']['percentage'] = 0; 
		} else {
			$data['meal']['percentage'] = round( ($data['meal']['meals_up'] / ($data['meal']['meals_views'] + $data['meal']['meals_up'])) * 100 ); // Divide number of clicks with number of views and clicks. TODO: Discuss whether this is the best approach. 
		}
		 
		$this->load->model('category_model'); // Load Category_model
		$categories = $this->category_model->get_categories(); // Get all cetegories
		shuffle($categories); // Shuffle the returned rows
		$data['categories'] = $categories;
		
		$this->load->view('main/index', $data); // Pass $data to the view main/index
	}


	/**
			WILL BE REMOVED
	**/
	public function getmeal() {
		if($this->load->database() == false) {
			echo ("database:error");
		} else {
			$db = $this->db->query("SELECT * FROM meals WHERE meals_approved = 1 ORDER BY RAND() LIMIT 1")->result_array();
			$count = $this->db->query("SELECT COUNT(*) as c FROM meals")->result_array();

			// Räkna ut procenten
			if($db[0]['meals_up'] == 0 && $db[0]['meals_views'] == 0) {
				$percentage = 0; 
			} else {
				$percentage = round( ($db[0]['meals_up'] / ($db[0]['meals_views'] + $db[0]['meals_up'])) * 100 ); 
			}

			// Generera fil från databasen
			$output = array('meal_name' => $db[0]['meals_name'],
							'meal_count' => $db[0]['meals_id'],
							'meal_up' => $db[0]['meals_up'],
							'meal_percentage' => $percentage,
							'meal_link' => $db[0]['meals_link'],
							'meal_id' => $db[0]['meals_id'],
							'meal_owner' => $db[0]['meals_owner'],
							'meal_ownerlink' => $db[0]['meals_ownerlink']);
			echo json_encode($output);
		}
	}
	/**
			WILL BE REMOVED
	**/
	public function add_view() {
		if(isset($_GET['id'])) {
			if(!($this->load->database() == false)) {
				$id = $_GET['id'];
				$cookie_name = 'view-'.$id;
				if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == 1) {
					// Ignore counting!
					echo ("0");
				} else {
					// Valid request, time to add 1
					setcookie($cookie_name, '1', time()+3600/2);
					$this->db->where('meals_id', $id);
					$this->db->set('meals_views', 'meals_views +1', FALSE);
					$this->db->update('meals');
					echo ("1");
				}
			}
		} else {
			echo ("error");
		}
	}
	/**
			WILL BE REMOVED
	**/
	public function add_up() {
		if(isset($_GET['id'])) {
			if(!($this->load->database() == false)) {
				$id = $_GET['id'];
				$cookie_name = 'up-'.$id;
				if(isset($_COOKIE[$cookie_name]) && $_COOKIE[$cookie_name] == 1) {
					// Ignore counting!
					echo ("0");
				} else {
					// Valid request, time to add 1
					setcookie($cookie_name, '1', time()+3600/2);
					$this->db->where('meals_id', $id);
					$this->db->set('meals_up', 'meals_up +1', FALSE);
					$this->db->update('meals');
					echo ("1");
				}
			}
		} else {
			echo ("error");
		}
	}

}
