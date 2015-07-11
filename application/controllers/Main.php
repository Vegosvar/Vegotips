<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() {
		$pr['categories'] = $this->getCategories();
		$this->load->view('main/index', $pr);
	}

	private function getCategories() {
		$this->load->database();
		$query = $this->db->query("SELECT * FROM categories");
		return $query->result();
	}

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
							'meal_count_off' => $count[0]['c'],
							'meal_up' => $db[0]['meals_up'],
							'meal_percentage' => $percentage,
							'meal_link' => $db[0]['meals_link'],
							'meal_id' => $db[0]['meals_id'],
							'meal_owner' => $db[0]['meals_owner'],
							'meal_ownerlink' => $db[0]['meals_ownerlink']);
			echo json_encode($output);
		}
	}

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
