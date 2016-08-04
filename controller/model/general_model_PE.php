<?php 
include "conexion.php";
class general_model_PE{	

	/**/
	function get_plano_s_2(){
		$query_get ="SELECT p.*  FROM  intranet.plano_CAC p  WHERE pais = 'PERU' and  
		edificio='CARGO' and planta='2' and sala='2' order by p.pasillo asc"; 			
		$data["pasillos"] =  $this->query_db($query_get);	
		/*Validación por zona horaria*/ 
		$hoy = getdate(); 
		$hora  =  $hoy["hours"]; 

		$tramo_where="DATE_ADD(CURDATE(), INTERVAL 0 DAY)"; 
		if ($hora > 16 ) {
			$tramo_where="DATE_ADD(CURDATE(), INTERVAL -1 DAY)"; 			
		}


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
		WHERE ubicacion="PERU" and edificio = "CARGO" and planta="2" and sala="2"  ';

		$data["posiciones"] =  $this->query_db($query_get_posiciones);

		return $data;	
	
	}

	/**/
	function get_plano_s_1(){
		$query_get ="SELECT p.*  FROM  intranet.plano_CAC p  WHERE pais = 'PERU' and  
		edificio='CARGO' and planta='2' and sala='1' order by p.pasillo asc"; 			
		$data["pasillos"] =  $this->query_db($query_get);	
		/*Validación por zona horaria*/ 
		$hoy = getdate(); 
		$hora  =  $hoy["hours"]; 

		$tramo_where="DATE_ADD(CURDATE(), INTERVAL 0 DAY)"; 
		if ($hora > 16 ) {
			$tramo_where="DATE_ADD(CURDATE(), INTERVAL -1 DAY)"; 			
		}


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
		WHERE ubicacion="PERU" and edificio = "CARGO" and planta="2" and sala="1"  ';

		$data["posiciones"] =  $this->query_db($query_get_posiciones);





		return $data;	
	
	}
	/**/
	function get_plano($param){		
		
		$query_get ="SELECT p.* ,  (pos_fin - pos_ini )total  FROM  intranet.plano_CAC p  WHERE pais = 'PERU' and edificio = 'MALL'  and planta='1' and sala='1'  "; 			
		$data["pasillos"] =  $this->query_db($query_get);	


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
		WHERE ubicacion="PERU" and edificio = "MALL" and planta="1" and sala="1"  ';

		$data["posiciones"] =  $this->query_db($query_get_posiciones);
		return $data;	
		

	}
	/**/
	function query_db($dinamic_query){
		$r = mysql_query($dinamic_query)or(die(mysql_error()));	
		return $r;
	}



}
?>





