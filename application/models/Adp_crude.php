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
			$response = $this->db->insert($table,$array);
			$this->session->set_flashdata('alert',['type'=>'success','msg'=>$array['slug'].' Category added successfully','last_action_id'=>$this->db->insert_id()]);
			return $response;
		}
		
	}
	public function getRows($table,$clause=FALSE){
		if(isset($clause['select'])){
			$this->db->select(implode(",",$clause['select']));
		}

		if(isset($clause['where'])){
			$query = $this->db->get_where($table,$clause['where']);
		}else{
			$query = $this->db->get($table);
		}
		return $query->result_array();
	}
}

?>