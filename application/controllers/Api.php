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
		$this->load->view('api/index'); // Display api info page. No data will be passed.
	}

	/**
		index - /api/getmeal controller
			
			Accepts numeric meal $id as input, passing meal data to the view. defaults to false if no $id is given
			Loads /api/getmeal view.
	**/
	public function getmeal($id = false) {
		
		if (!is_numeric($id) && $id != false) { // $id is expecte(d to be integer, but is allowed to be empty (false)
			$this->_api_error(400, "Bad request"); // Exit with error code 400 Bad Request
		} else { // Supplied $id is of acceptable format
			$this->load->model('meal_model'); // Load Meal_model

			// Unfinished
			
			$this->load->view('api/getmeal', $data); // Pass $data to the view main/index
		}
	}


}
