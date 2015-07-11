<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Submit extends CI_Controller {

	public function index() {
		echo ("All pages needs index...");
	}

	public function tip() {
		$this->load->database();
		if($_POST['name'] == "" || $_POST['link'] == "" || !(isset($_POST['category']))) {
			echo ("0");
		} else {
			$data = array('meals_name' => mysql_real_escape_string(htmlspecialchars_encode($_POST['name'])),
					  'meals_link' => $_POST['link'],
					  'meals_category' => $_POST['category']);
			$this->db->insert('meals', $data);
			echo ("1");
		}
	}
}
