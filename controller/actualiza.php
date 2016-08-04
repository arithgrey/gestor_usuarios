<?php 
	
	require "model/conexion72.php";
	$db_konecta = new  db_konecta();
		
	$nombre =  $_POST["nombre"];
	$pais =  $_POST["npais"];
	$telefonoMovil =  $_POST["telefonoMovil"];
	$iduser = $_POST["iduser"];
	$user_mod =  $_POST["user_mod"];	


	/* En intranet */
	$sql =	"UPDATE intranet.usuario 
	SET nombre = '".$nombre."' ,  
	locacion = '". $pais ."' , 
	ubicacion = '". $pais ."'  , 
	telefonoMovil = '". $telefonoMovil."'  , 	
	usuarioActualizacion = '".$user_mod."' ,
	ultimaActualizacion_usuario =  now()
	WHERE   id= '".$iduser ."'  ";		
	echo  $db_konecta->query_db_local($sql); 


?>