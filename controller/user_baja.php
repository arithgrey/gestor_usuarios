<?php
	
	require "model/conexion72.php";
	$db_konecta		 =  new  db_konecta();
	//user_modifica : user_modifica , usuario : 
	$user_modifica =  $_GET["user_modifica"]; 
	$usuario =  $_GET["usuario"];
	

	/*Primero lo damos de baja en intanet.usuario */
	$sql_baja_user =  "UPDATE IGNORE bd_knc.usuarios  SET 
			activo = '0' , 
			fecha_baja = current_date() ,     
			activo_ktv = '0'  
			WHERE usuario =  '". $usuario ."' limit 1"; 		
	
	$db_response_user =  $db_konecta ->query_db_ext($sql_baja_user); 		
	

	/*Ahora en intranet.asignacion_id*/
	$sql_baja_asignacion =  "UPDATE IGNORE 
							 intranet.asignacion_ID SET activo = 0  , 
							 fecha_baja =  current_date()  
							 WHERE  usr = '".$usuario ."' LIMIT 1 ";
	$db_response_user_asignacion  =  $db_konecta ->query_db_ext($sql_baja_asignacion); 		



	/*Guardamos en historico */

	$sql =  "INSERT INTO  intranet.usuario_hist SELECT * FROM  intranet.usuario WHERE  username_usuario = '". $usuario  ."'  limit 1 "; 	
	$db_response_intranet  =  $db_konecta ->query_db_local($sql); 					
	
	
	$sql_intranet = "UPDATE IGNORE intranet.usuario 
						SET estado = '0' , 
						login ='0',  
						usuarioActualizacion = '". $user_modifica ."'  , 
						fecha_baja = current_date()-1  
						WHERE username_usuario = '". $usuario  ."'  limit 1 "; 

	$db_response_intranet  =  $db_konecta ->query_db_local($sql_intranet); 				
	echo "El usuario " .$usuario . "se ha dado de baja correctamente .! "; 
	

?>