<?php
include './function.php';
if(isset($_POST['submit'])){
   insert('adp_user',$_POST);
}
if(isset($_POST['user'])){
   $datas = getrows('adp_user',['select'=>'username','where'=>['username'=>$_POST['user']]]);
   if(count($datas) > 1){

      echo 'exists';

   }
  
}
?>