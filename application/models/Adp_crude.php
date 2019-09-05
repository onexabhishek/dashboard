<?php
class Adp_crude extends CI_Model{
	public function is_unique($table,$column,$row){
		$query = $this->db->get_where($table,[$column=>$row]);
		if(!($query->num_rows() > 0)){
			return true;
		}
	}
	public function insertRows($table,$array){
		if(!$this->is_unique($table,'name',$array['name'])){
			$this->session->set_flashdata('alert',['type'=>'danger','msg'=>$array['name'].' Category Name already exists']);
			return false;
		}elseif(!$this->is_unique($table,'slug',$array['slug'])){
			$this->session->set_flashdata('alert',['type'=>'danger','msg'=>$array['slug'].' Category Slug already exists']);
			return false;
		}else{
			echo $this->db->insert($table,$array);
		}
		
	}
}

?>