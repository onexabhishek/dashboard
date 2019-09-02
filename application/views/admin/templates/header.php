<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>DataTables | Gentelella</title>

<link href="<?php echo base_url(); ?>vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>vendors/nprogress/nprogress.css" rel="stylesheet">

<link href="<?php echo base_url(); ?>vendors/iCheck/skins/flat/green.css" rel="stylesheet">

<?php
if(isset($stylesheets)){
	foreach($stylesheets as $stylesheet){
		echo '<link href="'.base_url($stylesheet).'" rel="stylesheet">';
}
}
?>
<link href="<?php echo base_url(); ?>build/css/custom.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>vendors/jquery/dist/jquery.min.js"></script>
</head>
<body class="nav-md">