<?php
class Adp_crude extends CI_Model{
	public function insertRows($table,$array){
		$this->db->insert($table,$array);
	}
}