<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lek extends CI_Controller {

	public function index($pincode = false) {
		$this->load->database();
		$query = $this->db->query("SELECT * FROM users WHERE pincode = '$pincode'");
		if($query->num_rows() > 0) {
			$db = $query->result_array();
			echo $db[0]['firstname'];
		}
	}
}