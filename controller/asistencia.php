<?php
	require "model/conexion72.php";
	$db_konecta = new  db_konecta();	
	$sql = "drop table if exists campania_mexico.tmp_hagent;"; 
	$db_konecta->query_db_local($sql);	
	$sql =  "CREATE TABLE campania_mexico.tmp_hagent AS 
						SELECT 
                        row_date , logid ,  i_stafftime
                        FROM PBX_mx.hagent  
                        WHERE skill
                        IN (
                        '3000' , '3001', '3002' , '3005' 
                        )
                        AND  month(row_date) = month(CURRENT_DATE())
                        AND year(row_date ) =  year(CURRENT_DATE() )"; 


	$db_konecta->query_db_local($sql);	

	$sql = "drop table if exists campania_mexico.tmp_tiempos;"; 
	$db_konecta->query_db_local($sql);	
	$sql =  "CREATE TABLE campania_mexico.tmp_tiempos  AS 
		SELECT 
		row_date , 
		logid , (sum(i_stafftime)/3600 ) as i_stafftime  
		FROM  campania_mexico.tmp_hagent
		group by  row_date , logid
		ORDER BY   logid DESC 
		"; 

	$db_konecta->query_db_local($sql);		

	$sql_dias_mes =  "SELECT * FROM  campania_mexico.tmp_tiempos 
	group by row_date"; 
	$r =  $db_konecta->query_db_local($sql_dias_mes);		
	$data_dias  = array();
	while( $row =  mysql_fetch_array($r) ) {
		$data_dias[] =  $row;
	}

	$tmp_dias  = array();

	$tb_header ="<tr>"; 
	$tb_header .= $db_konecta->td("#"); 
	$tb_header .= $db_konecta->td("horas laborables"); 
	$tb_header .= $db_konecta->td("Usuario movistar "); 
	$tb_header .= $db_konecta->td("Nombre "); 
	$tb_header .= $db_konecta->td("Apellido "); 
	$tb_header .= $db_konecta->td("Estado "); 
	$tb_header .= $db_konecta->td("Jefe directo "); 
	$tb_header .= $db_konecta->td("País"); 
	$tb_header .= $db_konecta->td("Login"); 

	for ($a=0; $a < count($data_dias); $a++) { 		
		$tb_header .= $db_konecta->td($data_dias[$a]["row_date"]); 		
		$tmp_dias[$a]= $data_dias[$a]["row_date"];
	}
	$tb_header .="</tr>"; 



	$usuarios = ""; 
	$sql="SELECT u.username_usuario , u.nombre  , u.apellidos_usuario ,  u.estado , u.jefeActual ,  u.ubicacion , u.locacion , u.login  FROM intranet.usuario u WHERE cargo in('3' , '9' , '10') and estado=1 and  u.login is not null  order by ubicacion, jefeActual   desc;";
	$r =  $db_konecta->query_db_local($sql);
	$data_usuarios  = array();
	while( $row =  mysql_fetch_array($r) ) {
		$data_usuarios[] =  $row;
	}
	
	$a= 1; 			
	foreach ($data_usuarios as $row) {
		$login =  $row["login"]; 
		$usuarios .=  "<tr>";	
			$usuarios .= $db_konecta->td($a);
			$usuarios .= $db_konecta->td("-"); 
			$usuarios .=  $db_konecta->td($row["username_usuario"]);
			$usuarios .=  $db_konecta->td($row["nombre"]);
			$usuarios .=  $db_konecta->td($row["apellidos_usuario"]);
			$usuarios .=  $db_konecta->td($row["estado"]);
			$usuarios .=  $db_konecta->td($row["jefeActual"]);
			$usuarios .=  $db_konecta->td($row["locacion"]);
			$usuarios .=  $db_konecta->td($login );		


			$usuarios .= datos_telefonia($login  , $tmp_dias );

			$a++;
		$usuarios .=  "</tr>";	
	}
	




function datos_telefonia($login ,  $tmp_dias ){
	$db_konecta = new  db_konecta();	

	$tmp ="";
	for ($a=0; $a <count($tmp_dias); $a++){ 
		
		$sql =  "";
		$sql_dias_mes =  "SELECT i_stafftime  FROM  campania_mexico.tmp_tiempos WHERE  row_date = '". $tmp_dias[$a]  . "'  and  logid = '". $login ."'  group by row_date"; 
		$r =  $db_konecta->query_db_local($sql_dias_mes);

		$tiempos =  mysql_fetch_array($r)["i_stafftime"];
		$icon ="";
		if ($tiempos > 3) {
			$icon ='<i style="color:rgb(101, 154, 168);" class="fa fa-check" aria-hidden="true"></i>';
		}else{
			$icon ="<i style='color:red;' class='fa fa-times' aria-hidden='true'></i>";
		}
		$text ="<span style='font-size:.9em !important;' >". $icon . $tiempos ."</span>"; 


		$tmp .=  $db_konecta->td($text);
	}
	return  $tmp;
}

?>



<div style="overflow:scroll; height:500px;">

	<table style="width:100%;font-size:.8em;" border=1 class='text-center'>
		<?=$tb_header?>
		<?=$usuarios?>
	</table>
</div>
