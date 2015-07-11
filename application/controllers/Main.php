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
		if($data['meal']['meals_views'] == 0) { // Stop division by 0 later on, 'meals_up' is number of clicks and 'meals_views' is number of views.
			$data['meal']['percentage'] = 0; 
		} else {
			$data['meal']['percentage'] = round( ($data['meal']['meals_up'] / $data['meal']['meals_views']) * 100 ); // Divide number of clicks with number of views and clicks. TODO: Discuss whether this is the best approach. 
		}
		 
		$this->load->model('category_model'); // Load Category_model
		$categories = $this->category_model->get_categories(); // Get all cetegories
		shuffle($categories); // Shuffle the returned rows
		$data['categories'] = $categories;
		
		$this->load->view('main/index', $data); // Pass $data to the view main/index
	}

}
