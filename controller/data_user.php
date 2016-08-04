<?php
	require "model/conexion72.php";
	$db_konecta = new  db_konecta();

	/*sacamos data usuario */
	$user_busqueda = $_GET["q"];
	$activo =  $_GET["activo"];
	$login =  $_GET["login_b"];
	/**/
	$sql_extra = "";
	if ($_GET["pais"] !=  "TODOS" ){		
		$sql_extra =  " and locacion = '".$_GET["pais"] ."' ";
	}
	$d_table =  "usuario";	
	$d_extra =  ""; 
	if ($activo ==  0 ){
		$d_table =  "usuario_hist";	
		$d_extra =  " and u.login is not null ";
	}
	
	/*Consultamos en local */
	$query_get = "SELECT 
				c.nombre  as nombre_cargo , 
				u.* 
				FROM  intranet.".$d_table."  u  
				inner join intranet.cargo_alta  c  on  
				u.cargo =  c.id 
				WHERE  
				username_usuario like  '%". $user_busqueda  ."%'   " . $sql_extra . "  
				and u.estado = '".$activo ."'  
				and  cargo='".$_GET["cargo"]."' ". $sql_extra_login  ." 
				".$d_extra."
				ORDER BY  locacion "; 	




	$result_user =    $db_konecta->query_db_local($query_get);	
	

	$data_complete  = array();
	while( $row =  mysql_fetch_array($result_user) ) {
		$data_complete[] =  $row;
	}



	$height =""; 
	if (count($data_complete) > 15 ) {
		$height ="style='overflow-x: scroll;  height: 400px;' " ; 
	}

	function valida_null($val , $estado ){

		if ($estado ==  0 ) {
			return "-";
		}else{
			return $val;
		}
	}

?>
<br>


#Usuarios encontrados  <?=count($data_complete) ?> 

<div <?=$height;?> >

<center><a href='javascript:void(0)'  class='botonExcel' style='color:#000000; font-family:verdana;'>EXPORTAR</a></center>
<div  class='grid' id='grid' >
<table  border="1" style="font-size:.8em; text-align:center; padding:10px;"   cellspacing='10'>
	<tr style='background:rgb(8, 41, 57); color:white; padding:10px;'>					
				<td>Modificar</td>		
				
				<td>Modificar estado</td>
				<td>Usuario</td>
				<td>Login</td>
				<td>Skill </td>
				<td>Nombre</td>		
				<td>Apellidos</td>				
				<td>Estado</td>
				<td>Locacion</td>	
				<td>telefonoMovil</td>										
				<td>UltimaSession</td>
				
				
				<td>Servicio</td>
				<td>Cargo</td>
				<td>Jefe Actual</td>
				
				<td>Motivo baja</td>
				<td>Comentario baja</td>
				<td>Fecha baja</td>
				<td>Estatus formacion</td>
				<td>Status promovido</td>
				<td>Turno</td>
				<td>Hora inicio labor</td>
				<td>Hora fin labor</td>
				<td>Usuario  Creación </td>
				<td>Usuario Actualizacion </td>
				<td>ultimaActualizacion_usuario</td>
	</tr>
	<?php
		
		foreach ($data_complete as $row) {

			$nombre = $row["nombre"];
			


			$estado =  $row["estado"];

			if ($estado == 1 ){
				$estado = "Activo"; 				
			}else{
				$estado = "Baja"; 				
			}
			$locacion =  $row["locacion"];
			$login =  $row["login"];
			$username_usuario =  $row["username_usuario"];

			$ultimaSession =  $row["ultimaSession"];
			//$distribuidor =  $row["distribuidor"];
			
			$servicio =  $row["servicio"];
			$cargo =  $row["nombre_cargo"];
			$telefonoMovil =  $row["telefonoMovil"];
			$jefeActual =  $row["jefeActual"];
			
			$motivo_baja =  $row["motivo_baja"];
			$comentario_baja =  $row["comentario_baja"];
			$fecha_baja =  $row["fecha_baja"];
			$estatus_formacion =  $row["estatus_formacion"];
			$status_promovido =  $row["status_promovido"];
			$turno =  $row["turno"];
			$hora_inicio_labor =  $row["hora_inicio_labor"];
			$hora_fin_labor =  $row["hora_fin_labor"];
			$skill =  $row["skill"];
			$usuarioCreacion =  $row["usuarioCreacion"];
			$usuarioActualizacion =  $row["usuarioCreacion"];
			$ultimaActualizacion_usuario =  $row["ultimaActualizacion_usuario"];
			$apellidos = $row["apellidos_usuario"];
			echo "<tr style='font-size:.8em; text-align:center; padding:10px;' > ";
				

				$f =  "onclick=delete_user();"; 
				echo $db_konecta->td("<a class='alta_mod' id='".$username_usuario."'  >Modificar</a>");		


				if ($estado  ==  "Activo") {
					echo $db_konecta->td("<a class='baja_user' id='".$username_usuario."'>Dar baja </a>"   );	
				}else{
					echo $db_konecta->td(" " );
				}
				
				echo  $db_konecta->td($username_usuario);	
				echo  $db_konecta->td($login);
				echo  $db_konecta->td($skill);
				echo  $db_konecta->td($nombre);
				echo  $db_konecta->td($apellidos);
				

				
				echo  $db_konecta->td($estado);
				echo  $db_konecta->td($locacion);
				echo  $db_konecta->td(valida_null($telefonoMovil  , $activo ) );
				
				

				echo  $db_konecta->td($ultimaSession);
				//echo  $db_konecta->td($distribuidor);
				
				echo  $db_konecta->td($servicio);
				echo  $db_konecta->td($cargo);
				echo  $db_konecta->td(valida_null($jefeActual , $activo ));
				
				echo  $db_konecta->td($motivo_baja);
				echo  $db_konecta->td($comentario_baja);
				echo  $db_konecta->td($fecha_baja);
				echo  $db_konecta->td($estatus_formacion);
				echo  $db_konecta->td($status_promovido);
				echo  $db_konecta->td($turno);
				echo  $db_konecta->td($hora_inicio_labor);
				echo  $db_konecta->td($hora_fin_labor);


				
				echo  $db_konecta->td($usuarioCreacion);
				echo  $db_konecta->td($usuarioActualizacion);
				echo  $db_konecta->td($ultimaActualizacion_usuario);
				
				



			echo "</tr>";



		}

	?>
	</table>

</table>
</div>
</div>

<script type="text/javascript">
		$(".botonExcel").click(function(event) {   
			 $("#datos_a_enviar").val($("<div>").append($("#grid").eq(0).clone()).html());   
			 $("#frmExcel").submit();   
		});
</script>

	<form name='frmExcel' id='frmExcel' method="post"  action="excel.php">
		  <div style='display:none;'><input type="text" id="datos_a_enviar" name="datos_a_enviar" /> </div>
	</form>	

