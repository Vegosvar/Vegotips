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
		_api_log - New log entry [PRIVATE]
	
			Needs $action, $data, $success
	**/
	private function _api_log($action, $data, $success) {
		$this->load->model('api_model'); // Load Api_model
		
		$this->api_model->api_log($action, $data, $success); // New log entry	
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
			
			$this->_api_log('getmeal', $id, false); // Log failed attempt
			
			$this->_api_error(400, "Bad request"); // Exit with error code 400 Bad Request
			
		} else { // Supplied $id is of acceptable format
			$this->load->model('meal_model'); // Load Meal_model
			$meal = $this->meal_model->get_meal($id); // Get meal. 
			
			if ($meal != false) { // There is a meal with this id
				// Calculate the percentage
				if($meal['meals_views'] == 0) { // Stop division by 0 later on, 'meals_up' is number of clicks and 'meals_views' is number of views.
					$percentage = 100; 
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
			
				$this->_api_log('getmeal', $meal['meals_id'], true); // Log successful attempt
			
				$this->load->view('api/json', array("output" => $data)); // Pass $data to the view main/index
			}
			else { // No meal found
				
				$this->_api_log('getmeal', $id, false); // Log failed attempt
				
				$this->_api_error(404, "Not Found"); // Exit with error code 404 Not Found
			}
		}
	}
	
	
	/**
		click - /api/click controller
			
			Accepts numeric meal $id as input, passing meal data to the view. defaults to false if no $id is given
			Loads /api/json view.
	**/
	public function click($id = null) {
		$this->load->model('meal_model'); // Load Meal_model
		
		if (!is_numeric($id)) { // Not numeric
			$this->_api_log('click', $id, false); // Log failed attempt
			
			$this->_api_error(400, "Bad Request"); // Exit with error code 400 Bad Request
		}
		if(isset($_COOKIE['meal_clicks'])) { // Check if cookie is set
			$cookie_data = json_decode($_COOKIE['meal_clicks'], true); // Decode the cookie string into an array
			
			if (!in_array($id,$cookie_data)) { // Meal id is not in cookie array, proceed to bump clicks
				$this->meal_model->update_click($id); // Bump clicks
				
				$cookie_data[] = $id; // Add $id to cookie array
				setcookie('meal_clicks', json_encode($cookie_data), time()+1800); // Set the cookie again, 30MIN expiry time
		
				$this->_api_log('click', $id, true); // Log successful attempt
				
				$this->_api_error(200, "OK"); // Exit with error code 200 OK
			}
			else {
				// User has already viewed this meal.
				$this->_api_log('click', $id, false); // Log failed attempt
				
				$this->_api_error(403, "Forbidden"); // Exit with error code 403 Forbidden
			}
		} else { // No cookie has been set
			
			$this->meal_model->update_click($id); // Bump clicks
			
			$cookie_data = array($id); // Add $id to cookie array
			setcookie('meal_clicks', json_encode($cookie_data), time()+1800); // Set the cookie for the first time, 30MIN expiry time
	
			$this->_api_log('click', $id, true); // Log successful attempt
	
			$this->_api_error(200, "OK"); // Exit with error code 200 OK
		}
	}
	
	
	/**
		submit - /api/submit controller
			
			Takes a series of inputs
			Loads /api/json view.
			
			// TODO: More input sanitation. Too much trust is put in the data. Does category exist? Is it numeric? Perhaps make use of CI's form validation module
	**/
	public function submit() { 
		$this->load->model('meal_model'); // Load Meal_model
		
		//if($_POST['name'] == "" || $_POST['link'] == "" || $_POST['category'] == "" || !(isset($_POST['category']))) {
		
		if(!(isset($_POST['name'])) || !(isset($_POST['link'])) || !(isset($_POST['category']))) {
			$this->_api_log('submit', null, false); // Log failed attempt
			
			$this->_api_error(406, "Not Acceptable"); // Exit with error code
		} else { // None of the fields are empty
			if($_POST['name'] == "" || $_POST['link'] == "") {
				$this->_api_log('submit', null, false);

				$this->_api_error(406, "Not Acceptable");
			} else {
				if(filter_var($_POST['link'], FILTER_VALIDATE_URL) == false) {
					$this->_api_log('submit', null, false);

					$this->_api_error(406, "Not Acceptable");
				} else {
					if($this->meal_model->insert_meal($_POST['name'], $_POST['link'], $_POST['category'])) {
						$this->_api_log('submit', $_POST['name'], true); // Log successful attempt
				
						$this->_api_error(200, "OK"); // Exit with error code
					} else {
						$this->_api_log('click', null, false); // Log failed attempt
				
						$this->_api_error(); // Exit with error code
					}
				}
			}
		}
	}
	
	
	/**
		getcategories - /api/getcategories controller
			
			Outputs list of categories
			Loads /api/json view.
	**/
	public function getcategories() { 
		$this->load->model('category_model'); // Load Category model
		
		$data = array( // Initialize $data array
			"data" => array(),
			"meta" => array("total" => $this->category_model->get_total_categories())
		);
		
		foreach ($this->category_model->get_categories_array() as $category) {
			$data['data'][] = array("type" => "category",
				"id" => $category['categories_id'],
				"name" => $category['categories_name']);
		}
		
		$this->_api_log('getcategories', null, true); // Log successful attempt
		
		$this->load->view('api/json', array("output" => $data)); // Pass $data to the view main/index
	}
}
