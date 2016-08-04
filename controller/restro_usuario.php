<?php

	require "model/conexion72.php";
	$db_konecta = new  db_konecta();
	/*Primero en asignaciones externo */
	$cargo =  $_POST["cargo"];
	$pais  =  $_POST["pais"];
	$login  =  $_POST["login"];
	$user =  $_POST["user"];
	$nombre =  $_POST["nombre"];
	$user_creacion =  $_POST["user_creacion"];
	$RFC =  $_POST["rfc"]; 
	$celular =  $_POST["celular"];
	$apellido_paterno =  $_POST["apellido_paterno"];
	$apellido_materno =  $_POST["apellido_materno"];
	$apellidos  =  $apellido_paterno  . " " . $apellido_materno; 
	/*insertamos en externo 1815059 *** ********* ***/
	$skill ="3000";
	if ($cargo == "Back Office" ) {
		$skill ="3002";
	}else if($cargo == "Validacion"){
		$skill ="3001";
	}else{
		$skill ="3000";
	}

	/*   e  */
	$usuario_intranet = 0;
	if ($cargo == "Agente"  ||  $cargo == "Validacion" ||  $cargo =="Back Offic"){
		

					$sql_ext = "UPDATE  
								intranet.asignacion_ID
								SET 		  
								activo  = '0' , 
								fecha_baja = current_date() -1  
								where usr = '".$user ."';";
					
					$p_1_a=  $db_konecta->query_db_ext($sql_ext); 			

					
					$sql_ext = "INSERT IGNORE  INTO  
								intranet.asignacion_ID(nif ,
											  nom ,  
											  usr ,  
											  login ,  
											  skill , 
											  activo , 
											  fecha_alta )
								VALUES ( 
										'".$RFC."'   , 
										'".$nombre."' , 
										'".$user."' , 
										$login , 
										$skill , 
										1 , 
										current_date() 
									);";

					$p_2_a=  $db_konecta->query_db_ext($sql_ext); 	
					/*VALIDAMOS ANTES DE INSERAR EL USUARIO PARA ASIGNAR EL TIPO */
					$perfil_212 =  1;
					if ( $cargo ==  "Agente") {
						$perfil_212 =  3;
					}else{
						$perfil_212 =  1;
					}


					$sql_usuarios = "INSERT IGNORE  INTO bd_knc.usuarios(
										nombre , 
										usuario ,  
										responsable , 
										pass , 
										activo , 
										fecha_alta , 						
										perfil , 
										activo_ktv , 
										kapd_Movistar_Mexico_Portabilidad, 
										id_centro )
									
									VALUES(
											'". $nombre ."', 
											'".$user ."', 
											'1', 
											'". md5("123456")."' , 
											'1',
											CURRENT_DATE(), 
											$perfil_212,
											'1' , 
											$perfil_212 , 
											'10'
										);"; 

					$p_2_a=  $db_konecta->query_db_ext($sql_usuarios); 	

		}else{
			$login ="";
		}

	$d_cargo =  1; 
	switch ($cargo) {
		case 'Agente':
			$d_cargo =  3; 
			break;
		case 'Supervisor':
			$d_cargo =  1; 
			break;
		
		case 'Coordinador':
			$d_cargo =  2; 
			break;
		
		case 'Gerente':
			$d_cargo =  5; 
			break;
		
		case 'Director':
			$d_cargo =  6; 
			break;
		
		case 'WFM':
			
			break;
		case 'Validacion':
			$d_cargo =  9; 
			break;		

		case 'Back Office':
			$d_cargo =  10; 
			break;
		
		case 'Formador':
			$d_cargo = 11; 
			break;			
		default:
			$d_cargo =  3; 
			break;
	}


	$sql_get  =  "SELECT * FROM intranet.usuario WHERE username_usuario = '".$user."' limit 1  "; 	
	$user_e  =  $db_konecta->query_db_local($sql_get); 
	
	/**/
	$data_complete  = array();
	while( $row =  mysql_fetch_array($user_e) ) {
		$data_complete[] =  $row;
	}
	
	
	if (count($data_complete) > 0 ){
			/*Actualizamos  */
				$sql_update = "UPDATE intranet.usuario set  
				nombre = '".$nombre."' ,  
				dni='". $RFC ."' ,
				cargo = '". $d_cargo ."' ,
				locacion  = '". $pais."' , 				
				login =  '". $login ."', 
				usuarioActualizacion = '". $user_creacion  ."' , 
				ultimaActualizacion_usuario	 = now() , 
				clave_usuario =  '". md5(123456) ."', 
				skill = '". $skill  ."'

				WHERE username_usuario = '". $user ."' ";
				echo   $db_konecta->query_db_local($sql_update); 


				$usuario_intranet =  $data_complete["id"];
	}else{
				$query= "INSERT IGNORE  INTO intranet.usuario(
								dni , 
								nombre , 
								apellidos_usuario , 
								username_usuario ,  
								login ,
								fechaCreacion_usuario ,
								usuarioCreacion ,
								ultimaActualizacion_usuario ,
								usuarioActualizacion ,
								clave_usuario ,
								idGrupo , 
								estado ,
								cargo ,					
								centro , 
								skill , 
								telefonoMovil ,
								locacion
								
								) 
							VALUES(
								'". $RFC ."' ,
								'". $nombre ."', 
								'". $apellidos  ."',
								'". $user ."',
								'". $login  ."' , 
								NOW() ,
								'". $user_creacion  ."',
								NOW() ,
								'".$user_creacion ."' ,
								'". md5(123456) ."' ,
								'108' ,
								'1', 
								$d_cargo ,					
								'". $pais ."' , 
								$skill , 
								'". $celular ."',
								'". $pais ."'
								

								 )";
					
					echo   $db_konecta->query_db_local($query); 
					$usuario_intranet  = mysql_insert_id(); 	
	}





	
	//echo $usuario_intranet . "okokoko ";


	
	/*Damos permisos en intranet */	
	$query_insert =  "insert into intranet.accesos(
						  id_menu , 
						  usuarioActualizacion,
						  fechaActualizacion, 
						  id_user ) 
						  VALUES(
						  		3315 ,
						  		'". $user_creacion ."' ,
						  		now() , 
						  		$usuario_intranet
						  		)"; 
	

	
	$p_2_a=  $db_konecta->query_db_local($query_insert); 	

		$dinamic_menu = 0; 
		if ($cargo ==  "Agente") {

			$dinamic_menu = "3316";

		}else if($cargo ==  "Validacion"){

			$dinamic_menu = "3318";

		}else if($cargo ==  "Back Office"){

			$dinamic_menu = "3317";

		}else if ($cargo ==  "Supervisor") {

			$dinamic_menu ="3319";

		}else if($cargo == "Calidad"){

			$dinamic_menu = "3320";

		}else if ($cargo ==  "Desarrollador") {

			$dinamic_menu ="3321";

		}else if ($cargo ==  "Gerente" ){

			$dinamic_menu ="3322";	

		}else if ($cargo ==  "WFM" ){

			$dinamic_menu ="3323";	

		}


		$query_insert =  "insert into intranet.accesos(
						  id_menu , 
						  usuarioActualizacion,
						  fechaActualizacion, 
						  id_user ) 
						  VALUES(
						  		$dinamic_menu ,
						  		'". $user_creacion ."' ,
						  		now() , 
						  		$usuario_intranet
						  		)"; 
	
		$db_konecta->query_db_local($query_insert); 	


		$query_insert =  "insert into intranet.accesos(
								id_menu , 
								usuarioActualizacion,
								fechaActualizacion, 
								id_user )
								SELECT id_menu , '". $user_creacion ."' ,  now() ,   $usuario_intranet
								FROM  
								intranet.menu where idPadre = '".$dinamic_menu."' "; 
														
							
		$p_2_a=  $db_konecta->query_db_local($query_insert); 								

	echo  "Usuario registrado .!";
?>
