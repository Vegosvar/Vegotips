<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {


	/**
		_api_error - Throws json serialized error and exits [PRIVATE]
	
			Defaults to "0 Unknown Error"
	**/
	private function _api_error($code = "0", $description = "Unknown error") {
		$data['output'] = array("error" => array("code" => $code, "title" => $description));
		
		$this->load->view('errors/json/error', $data); // Pass $data to the json error view
	}
	
	
	/**
		index - /api/ controller
	
			Loads /api/index view.
	**/
	public function index() { // Index controller.
		$this->load->model('category_model'); // Load Category_model
		$categories = $this->category_model->get_categories(); // Get all cetegories
		shuffle($categories); // Shuffle the returned rows
		$data = array('categories' => $categories);
		
		$this->load->view('api/index', $data); // Display api info page. No data will be passed.
	}

	/**
		getmeal - /api/getmeal controller
			
			Accepts numeric meal $id as input, passing meal data to the view. defaults to false if no $id is given
			Loads /api/json view.
	**/
	public function getmeal($id = false) {
		
		if (!is_numeric($id) && $id != false) { // $id is expecte(d to be integer, but is allowed to be empty (false)
			$this->_api_error(400, "Bad request"); // Exit with error code 400 Bad Request
		} else { // Supplied $id is of acceptable format
			$this->load->model('meal_model'); // Load Meal_model
			$meal = $this->meal_model->get_meal($id); // Get meal. 
			
			if ($meal != false) {
				// Calculate the percentage
				if($meal['meals_views'] == 0) { // Stop division by 0 later on, 'meals_up' is number of clicks and 'meals_views' is number of views.
					$percentage = 0; 
				} else {
					$percentage = round( ($meal['meals_up'] / $meal['meals_views']) * 100 ); 
				}
						
				$data = array( // Initialize $data array
					"data" => array(
						"type" => "meal",
						'id' => $meal['meals_id'],
						'name' => $meal['meals_name'],
						'clicks' => $meal['meals_up'],
						'views' => $meal['meals_views'],
						'percentage' => $percentage,
						'link' => $meal['meals_link'],
						'owner' => $meal['meals_owner'],
						'ownerlink' => $meal['meals_ownerlink']
					),
					"meta" => array("total" => $this->meal_model->get_total_meals())
				); 
			
			
				$this->load->view('api/json', array("output" => $data)); // Pass $data to the view main/index
			}
			else {
				$this->_api_error(404, "Not Found"); // Exit with error code 404 Not Found
			}
		}
	}
	
	
	/**
		click - /api/click controller
			
			Accepts numeric meal $id as input, passing meal data to the view. defaults to false if no $id is given
			Loads /api/json view.
	**/
	public function click($id) {
		$this->load->model('meal_model'); // Load Meal_model
		
		if (!is_numeric($id)) { // Not numeric
			$this->_api_error(400, "Bad Request"); // Exit with error code 400 Bad Request
		}
		if(isset($_COOKIE['meal_clicks'])) { // Check if cookie is set
			$cookie_data = json_decode($_COOKIE['meal_clicks'], true); // Decode the cookie string into an array
			
			if (!in_array($id,$cookie_data)) { // Meal id is not in cookie array, proceed to bump clicks
				
				$this->meal_model->update_click($id); // Bump clicks
				
				$cookie_data[] = $id; // Add $id to cookie array
				setcookie('meal_clicks', json_encode($cookie_data), time()+1800); // Set the cookie again, 30MIN expiry time
		
				$this->_api_error(200, "OK"); // Exit with error code 200 OK
				
			}
			else {
				// User has already viewed this meal.
				$this->_api_error(403, "Forbidden"); // Exit with error code 403 Forbidden
			}
		} else { // No cookie has been set
			
			$this->meal_model->update_click($id); // Bump clicks
			
			$cookie_data = array($id); // Add $id to cookie array
			setcookie('meal_clicks', json_encode($cookie_data), time()+1800); // Set the cookie for the first time, 30MIN expiry time
	
			$this->_api_error(200, "OK"); // Exit with error code 200 OK
		}
	}
	
	
	/**
		submit - /api/submit controller
			
			Takes a series of inputs
			Loads /api/json view.
			
			// TODO: More input sanitation. Too much trust is put in the data. Does category exist? Is it numeric? 
	**/
	public function submit() { 
		$this->load->model('meal_model'); // Load Meal_model
		
		if($_POST['name'] == "" || $_POST['link'] == "" || $_POST['category'] == "" || !(isset($_POST['category']))) {
			$this->_api_error(406, "Not Acceptable"); // Exit with error code
		} else {
			
			if($this->meal_model->insert_meal($_POST['name'], $_POST['link'], $_POST['category'])) {
				$this->_api_error(200, "OK"); // Exit with error code
			} else {
				$this->_api_error(); // Exit with error code
			}
			
		}
	}
	
	
}
