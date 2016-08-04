<?php
	include "controller/model/general_model.php"; 
	session_start(); 
	$mod =  new general_model();
	$pram  = array();
	$pram["nom_user"] = $_SESSION['user']; 
	$param["tipo"] =  "OUT";	
	$param["accion"] =  "Salió del sessión";
	$mod->record_log($param);
	session_destroy();
	header("location:index.php");
?>