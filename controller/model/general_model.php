<?php 
include "conexion.php";
class general_model{	

	function get_plano($param){
						
		$query_get = "SELECT * FROM  
					 intranet.plano_CAC 
					 WHERE 
					 pais = '".$param["ubicacion"]."' ";		
		
		/*Validación por zona horaria*/ 
		$hoy = getdate(); 
		$hora  =  $hoy["hours"]; 

		$tramo_where="DATE_ADD(CURDATE(), INTERVAL 0 DAY)"; 
		if ($hora > 16 ) {
			$tramo_where="DATE_ADD(CURDATE(), INTERVAL -1 DAY)"; 			
		}


		/*Query que me da las posiciones por país*/


		$query_get_posiciones ='SELECT * FROM intranet.posiciones_CAC p  
LEFT OUTER JOIN bd_knc.log_acceso l ON p.pc_ip = l.ip 
AND l.fecha = DATE_ADD(CURDATE(), INTERVAL 0 DAY)
		AND l.hora
		IN (
		SELECT MAX(hora) 
		FROM bd_knc.log_acceso
		WHERE DATE(fecha) = '. $tramo_where  .'
		GROUP BY ip)
		LEFT OUTER JOIN 
		bd_knc.usuarios u ON l.usr = u.id
		LEFT OUTER JOIN 
		intranet.asignacion_ID a ON u.usuario = a.usr		
		WHERE ubicacion="'.$param["ubicacion"] .'" ';
		
		$data["pasillos"] =  $this->query_db($query_get);
		$data["posiciones"] =  $this->query_db($query_get_posiciones);
		return $data;
	}
	/**/
	function posicion_e($prm){


		$where =  $this->condiciones_where($prm); 
			$query_get = "select 
						  p.* 
						  from 
						  intranet.posiciones_CAC p  
						  where  ". $where ." limit 1";
					  
		return $this->query_db($query_get);
	}

	/**/
	function actualiza_data_posicion($param){

		$where = $this->condiciones_where($param); 
		$data_log =  array();
		$query_update ="UPDATE  intranet.posiciones_CAC  SET
								pc_ip  = '". $param["ip"] ."' ,   								
						   		voz_extension = '". $param["ext"] ."'  , 
						   		modelo_telefono = '". $param["modelo_telefono"] ."'   , 
						   		srv_aes = '".$param["srv_aes"] ."'  
						    	where   ". $where ." "; 

		$r =  $this->query_db($query_update);									

		
		if ($r == true){							
					$data_log["nom_user"] = $param["usr"];  
					$data_log["tipo"] =  "UPDATE";
					$data_log["accion"] = $param["ip"] . ";" .  $param["ext"] .";".$param["modelo_telefono"] .";". $param["ubicacion"]; 
					$this->record_log($data_log); 
					return  "Puesto actualizado .!";		
			}					
		
		return $r;		
	}
	/**/
	function condiciones_where($param){


		$where = ''; 

		switch ($param["ubicacion"]) {
			case 'MEXICO':		  
					
				$where = "puesto = '". $param["posicion"]  ."' 						  
						  and  ubicacion ='MEXICO' 
						  and edificio = 'SAN PEDRO DE LOS PINOS' 
						  and  planta = '1'
						  and sala='1' ";	  
				break;
			case 'PERU':
				
				$where = "puesto = '". $param["posicion"]  ."' 						  
						  and  ubicacion ='". $param["ubicacion"]."' 
						  and edificio = 'MALL' 
						  and  planta = '1'
						  and sala='1' ";
				break;
			
			case 'PERU_1':
					$where = "puesto = '". $param["posicion"]  ."' 						  
						  and  ubicacion ='PERU' 
						  and edificio = 'CARGO' 
						  and  planta = '2'
						  and sala='1' ";

				break;
			case 'PERU_2':
					$where = "puesto = '". $param["posicion"]  ."' 						  
								  and  ubicacion ='PERU' 
								  and edificio = 'CARGO' 
								  and  planta = '2'
								  and sala='2' ";
			
				break;

			default:
				
				break;
		}
		return $where;

	}
	/**/
	function condicion_insert($param){

		$insert = " , ubicacion , edificio ,  planta , sala ";
		$insert_values = "";
		$data["inserts"] =  $insert;
		switch ($param["ubicacion"]) {
			case 'MEXICO':
				$insert_values= ', "MEXICO" , "SAN PEDRO DE LOS PINOS" , "1" , "1" '; 
				break;
			case 'PERU':
				$insert_values= ', "PERU" , "MALL" , "1" , "1" '; 				
				break;

			case 'PERU_1':
				$insert_values= ', "PERU" , "CARGO" , "2" , "1" '; 						
				break;
			case 'PERU_2':
				
				$insert_values= ', "PERU" , "CARGO" , "2" , "2" '; 	


				break;

			default:
				
				break;
		}

		$data["inserts_values"] =  $insert_values;
		return $data;

	}

	/**/
	function inserta_posicion($param){
		$data_log =  array();

		$insert_param = $this->condicion_insert($param);
		$inserts = $insert_param["inserts"];
		$inserts_values  =  $insert_param["inserts_values"];

		$query_insert =  "INSERT INTO intranet.posiciones_CAC( 
					 	puesto , 
					 	pc_ip , 
					 	voz_extension ,  					 	  	
					 	modelo_telefono , 
					 	srv_aes 
					 	". $inserts ."
					 	 )
					 	VALUES('". $param["posicion"]  ."'  , 
					 	'". $param["ip"] ."'  , 
					 	'". $param["ext"] ."' , 					 	  
					 	'". $param["modelo_telefono"] ."', 					 	
					 	'".$param["srv_aes"] ."'  
					 	". $inserts_values ."
					 	)"; 
		
				 		
		$r =  $this->query_db($query_insert);

		if ($r ==  true ){			 			
				$data_log["nom_user"] = $param["usr"];  
				$data_log["tipo"] =  "INSERT";
				$data_log["accion"] =$param["ip"] . ";" .  $param["ext"] .";".$param["modelo_telefono"] .";". $param["ubicacion"]; 
				$this->record_log($data_log); 
				return  "Puesto registrado .!";	
		}
		return $r;		
	}
	/**/









	/******/
	function udpate_data_posicion_e($param){					
		/**/		
		//		
			
		$antes_update =  $this->valida_existencia_puesto($param);			
		
		if ($antes_update["existencia"] == 1 ) {
			return $antes_update["registrados"];
		}else{
			/**/
			$existencia_puesto =  $this->existencia_puesto($param);	

			if ($existencia_puesto > 0 ) {
				$this->actualiza_data_posicion($param); 
			}else{
				$this->inserta_posicion($param);
			}
			/**/
		}

	}

	/**/



	function condiciones_where_existencia($param){


		$where = ''; 

		switch ($param["ubicacion"]) {
			case 'MEXICO':
				$where = " and ubicacion ='". $param["ubicacion"]."'  and edificio = 'SAN PEDRO DE LOS PINOS'  and planta = '1' and sala='1' and  ";
				break;
			case 'PERU':
				
				$where = " and ubicacion ='". $param["ubicacion"]."'  and edificio = 'MALL'  and planta = '1' and sala='1' and  ";
				break;

			case 'PERU_1':
				$where = " and ubicacion ='PERU'  and edificio = 'CARGO'  and planta = '2' and sala='1' and  ";		
				break;
			case 'PERU_2':
				$where = " and ubicacion ='PERU'  and edificio = 'CARGO'  and planta = '2' and sala='2' and  ";		
				break;

			default:
				
				break;
		}
		return $where;

	}


	/**/
	function valida_existencia_puesto($param){	

		$where = $this->condiciones_where_existencia($param); 	
		$query_get = "SELECT * FROM intranet.posiciones_CAC WHERE  puesto !=". $param["posicion"] ."  ".$where."    ( voz_extension = '".$param["ext"] ."' OR pc_ip = '".$param["ip"]."' )"; 



		$result  =  $this->query_db($query_get);
		$flag = 0; 
		$registrados = "<table border='1' class='text-center'>"; 
		while( $row =  mysql_fetch_array($result) ) {

			$registrados .= "<tr>"; 

			$registrados .=  "<td>No se han guardado los datos del puesto ya que otra posición los tiene registrados, posición: </td>";
			$registrados .= "<td class='tb-puesto-ex'style='background:#5BC0DE;' >" . $row["puesto"] ."</td>";
			

			if ($row["voz_extension"] ==  $param["ext"] ) {
				$flag ++; 
				$registrados .= "<td class='tb-puesto-ex red'  >" . $row["voz_extension"] ."</td>";	
			}else{
				$registrados .= "<td class='tb-puesto-ex'>" . $row["voz_extension"] ."</td>";
			}
			
			if ($row["pc_ip"] == $param["ip"] ) {
				$flag ++; 
				$registrados .= "<td class='tb-puesto-ex red' >" . $param["ip"] ."</td>";	
			}else{
				$registrados .= "<td class='tb-puesto-ex' >" .$param["ip"] ."</td>";
			}

			$registrados .= "<td class='tb-puesto-ex'>" . $row["modelo_telefono"] ."</td>";
			$registrados .= "<td class='tb-puesto-ex' >" . $row["ubicacion"] ."</td>";
			$registrados .= "<td class='tb-puesto-ex'  >" . $row["srv_aes"] ."</td>";						
			$registrados .= "</tr>"; 
			
		}
		$registrados .= "</table>"; 

		$data =  array();
		if ($flag > 0 ) {
			$data["existencia"] =  1; 
			$data["registrados"] =  $registrados;
		}else{
			$data["existencia"] = 0; 			
		}	
		return $data; 
	}		
	/**/
	function existencia_puesto($param){	

		$query_get =  "select 
					   count(*) 
					   existe  
					   from intranet.posiciones_CAC  
					   where 
					   puesto = '". $param["posicion"]  ."'  
					   AND  
					   ubicacion ='". $param["ubicacion"]."'";
		$r_exist =  $this->query_db($query_get);
		$e = mysql_fetch_array($r_exist)["existe"];  
		/**/
		return $e;
	}		
	/**/
	function query_db($dinamic_query){
		$user = "user_script_kapd";
		$pw   = "bpKchrvXUMKzGcJh";
		$db = "intranet";

		$cn=mysql_connect("172.15.9.212",$user,$pw) or mysql_error();
		mysql_select_db($db,$cn);
		mysql_query("SET NAMES 'utf8'");

		$r = mysql_query($dinamic_query)or(die(mysql_error()));	
		return $r;
	}
	/**/
	function query_db_local($dinamic_query){
		
		$user = "tmp_developer";
		$pw   = "G4YummqPxZnJhMeR";
		$db = "intranet";	

		$cn=mysql_connect("172.72.80.72",$user,$pw) or mysql_error();
		mysql_select_db($db,$cn);
		mysql_query("SET NAMES 'utf8'");
		
		$r = mysql_query($dinamic_query)or(die(mysql_error()));	
		return $r;
	}	

	function elimina_posicion($param){
			
		$data_log =  array();			
		$data_log["nom_user"]  =  $_SESSION['user']; 
		$data_log["tipo"]  =  'DELETE'; 
		$data_log["accion"]  = $param["posicion"] .";". $param["ubicacion"];   
		$this->record_log($data_log); 	
		
		$where =  $this->condiciones_where($param); 			
		
		$query_delete ="DELETE FROM intranet.posiciones_CAC 
						WHERE   ". $where ." "; 
	

		$db_response =  $this->query_db($query_delete);
		return $db_response;

	}
	/**/	
	function valida_user($param){		

		$query_get ="SELECT count(0)e FROM  kapd.kapd_user WHERE nom_user  = '".$param["username"] ."' and pass = '".md5($param["password"])."' and activo='1' limit 1"; 
		$r=  $this->query_db_local($query_get); 
		$user_e =mysql_fetch_array($r)["e"];  
		if ($user_e >  0  ) {

			$query_get ="SELECT nom_user , nombre  , apellido  FROM  kapd.kapd_user WHERE nom_user  = '".$param["username"] ."' and pass = '".md5($param["password"])."' and activo='1'  limit 1"; 
			$r=  $this->query_db_local($query_get); 
			$user =mysql_fetch_array($r); 			
			session_start();
			$_SESSION['in_session']  =  1;
			$_SESSION['user']  =  $user["nom_user"];
			$_SESSION['nombre']  =  $user["nombre"];
			$_SESSION['apellido']  =  $user["apellido"];



			$data_log =  array();
			$data_log = $user;
					
			$data_log['tipo']  =  "IN";			
			$data_log['accion']  =  "Acceso al sistema";


			mysql_close($cn);			
			$this->record_log($data_log); 

		}
		return $user_e;			
	}
	/**/
	function record_log($param){		
		$query_insert ="insert into kapd.log_control_users 
		(usr ,
		fecha,
		hora,
		ip ,
		tipo,
		accion)
		values(
		'".$param["nom_user"] ."' ,
		CURRENT_DATE() , 
		curTime(), 
		'".$_SERVER['REMOTE_ADDR']."' ,
		'".$param["tipo"] ."' , 
		'".$param["accion"] ."' )"; 	

	
		$r=  $this->query_db_local($query_insert);
	}

	/**/
	function update_pass($param){		
		/**/
		
		session_start();
		$response =""; 
		$antigua  =  $param["passwordold"];
		$query_get = "SELECT COUNT(*)existe FROM kapd.kapd_user WHERE nom_user = '".$_SESSION["user"]."' AND pass= '". md5($antigua)."' "; 		
		$r_exist =  $this->query_db_local($query_get);
		$e = mysql_fetch_array($r_exist)["existe"];  
		

		if ($param["passwordn"] ==  $param["passwordold"]  ){
				return "La contraseña que quieres actualizar es la misma que la anterior";		
		}elseif ($param["passwordn"] !=  $param["passwordconfirm"]) {
				return "Las contraseñas no corresponden";		
		}else{
				if ($e >0 ){											
					$query_update = "UPDATE kapd.kapd_user SET  pass = '". md5($param["passwordn"]) ."'   WHERE nom_user = '".$_SESSION["user"]."' AND pass= '". md5($antigua)."' ";	
				 	$this->query_db_local($query_update);
				 	return "Password actualizada .! ";
				 }else{
				 	return "Datos incorrectos.!";
				 }
		}
		/**/


	/**/
	}
	/**/
	function get_resumen_ubicacion($param){

	$query_get ="select sum(case when  pc_ip is null then 1 else 0 end )sin_ip ,
	   sum(case when  voz_extension is null then 1 else 0 end )sin_ext , 
	   sum(case when  modelo_telefono is null then 1 else 0 end )sin_modelo,
	   sum(case when  srv_aes is null then 1 else 0 end )sin_srv_aes 
	   from intranet.posiciones_CAC
	   where ubicacion = '".$param["ubicacion"]."' ";
	   return  $this->query_db($query_get);
	}
	/**/
}
?>




