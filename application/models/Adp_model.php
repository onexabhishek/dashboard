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
}
