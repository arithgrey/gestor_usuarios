<?php 
include "conexion.php";
class general_model_chile{	

	function get_plano_cargo(){

		$query_get = "SELECT * FROM  
					 intranet.plano_CAC 
					 WHERE 
					 pais = '".$param["ubicacion"]."' ";		

		/*Validación por zona horaria*/ 		
		$hoy = getdate(); 
		$hora  =  $hoy["hours"]; 

		$tramo_where="DATE_ADD(CURDATE(), INTERVAL 0 DAY)"; 
		if ($hora > 16 ){

			$tramo_where="DATE_ADD(CURDATE(), INTERVAL -1 DAY)"; 			
		}

		$data["pasillos"] =  $this->query_db($query_get);
		return $data;	
	}
	/**/
	function query_db($dinamic_query){
		$r = mysql_query($dinamic_query)or(die(mysql_error()));	
		return $r;
	}



}
?>





