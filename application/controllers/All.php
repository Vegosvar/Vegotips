<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All extends CI_Controller {
	
	/**
		index - /all/ controller
	
			Loads /all/index view.
	**/
	public function index() { // Index controller.
		$this->load->model('meal_model'); // Load Meal_model
		$meals = $this->meal_model->get_all_meals(1); // Get all meals

		$data = array('meals' => $meals);
		
		$this->load->view('all/index', $data); // Display list page.
	}
	
}
