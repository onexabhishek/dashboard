<?php
class Adp_model extends CI_Model{
	public	function getDatas($folder,$action){
	  // $folder = $_POST['folder'];
		// echo realpath($folder);
		// die;
	   $datas = glob($folder.'/*', GLOB_BRACE);
	   // $realpath = realpath($folder);
	  // $datas = array_diff(scandir($folder), array('.', '..'));
	   // var_dump($datas);
	    $data_obj = [];
	   $i=1;
	   if($action == 'get'){
	   	foreach ($datas as $data) {
	     if(is_dir($data) ){
	      $data_obj[$i] = array('path'=>$data,'name'=>basename($data),'type'=>'folder');
	     }else{
	      $data_obj[$i] = array('name'=>basename($data),'path'=>$data,'type'=>'file','mime_type'=>mime_content_type($data),'formate'=>pathinfo($data, PATHINFO_EXTENSION));
	     }
	     $i++;
	     
	   }
	}
	//    elseif($action == 'get_all_files'){
	//    	// $data_obj[0] = $folder;
	//    foreach ($datas as $data) {
	//      if(is_dir($data) ){
	//      	$data_obj[$i] = $data;
	//      $this->getDatas($data,'get_all_files'); 
	//      }
	//      if(is_file($data)){
	//       $data_obj[$i] = array('name'=>basename($data),'path'=>$data,'type'=>'file','mime_type'=>mime_content_type($data),'formate'=>pathinfo($data, PATHINFO_EXTENSION));
	//      }
	//      $i++;
	// }
	//   }
	   
	 return json_encode($data_obj);
	}
	public function load_plugin($plugin=FALSE,$type=FALSE){
		$plugin_db = file_get_contents('./db.json');
		// $this->load->helper('file');
		if($plugin){
			if(gettype($plugin) == 'string'){
			
			return json_decode(json_decode(json_decode($plugin_db)->checked)->$plugin)->$type;
		}else{
			$row_data = [];
			$flat_files = [];
			foreach ($plugin as $single_plugin) {
				 $row_data []= explode(',',json_decode(json_decode(json_decode($plugin_db)->checked)->$single_plugin)->$type);
			}
			$recursive_array = new RecursiveIteratorIterator(new RecursiveArrayIterator($row_data));
			foreach ($recursive_array as $flat_data) {
				$flat_files [] = $flat_data;
			}
			return $flat_files;
		}
			
		}else{
			echo $plugin_db;
		}
		

    
	}
}
