<?php 
	session_start();
    if($_SESSION["in_session"] !=  1 ){header("location:index.php");}   
	require "model/conexion72.php";
	$db_konecta		 =  new  db_konecta();
	$sql_login_uso =  "select login  from intranet.asignacion_ID where skill in(3000, 3001 , 3002 , 3005 ) and activo =  1 group by login "; 

 	$result_login =    $db_konecta->query_db_ext($sql_login_uso);	
	$data_complete  = array();
	$logines  = ""; 

	while( $row =  mysql_fetch_array($result_login) ) {
		$data_complete[] =  $row;
	}
	$total =  count($data_complete); 	
	$flag = 0; 
	foreach ($data_complete as $row) {
	
		if ( $flag ==  ($total- 1)   ) {
			$logines .= $row["login"];				
		}else{
			$logines .= $row["login"] ." , ";				
		}		
		$flag ++;
	}




	/*Sacamos los disponibles */
	$sql_disponibles =  "select * from kapd_Movistar_Mexico_Portabilidad.logines_porta_2016 where login not in(".$logines.")"; 
	$logines_disponibles =  $db_konecta->query_db_local($sql_disponibles); 
	$data_logines  = array();
	while( $row =  mysql_fetch_array($logines_disponibles) ) {
		$data_logines[] =  $row;	
	}

	$permisos_view =  "permisos_no_view"; 
	if ($_SESSION["user"] == "Levifm" ||  $_SESSION["user"] == "jgovinda"  ) {
		 $permisos_view =  "permisos_view"; 
	}
?>






<div class="<?=$permisos_view;?>">
	<table  style='font-size:.8em;' class='pull-right text-center col-lg-4'>
		<tr>
			<td>#</td>
			<td>Login disponible </td>
		</tr>
		<?php
			$x= 1;
			foreach ($data_logines as $row) {
				echo "<tr>";		
				echo $db_konecta->td($x);	
				echo $db_konecta->td($row["login"]);	
				echo "</tr>";
				$x++;		
			}
		?>
	</table>
</div>




<br>

<div class='col-lg-12 col-md-12'> 

	<form class='form-alta-user' method='POST'  action ="controller/restro_usuario.php"  id='form-alta-user'> 		
		<label>
			Login 
			<input type="text" name="login"  id="login" value="<?=$data_logines["0"]["login"]?>" readonly>
		</label>
		<label>
			Usuario
			<input type="text" name="user" id="user" required style="text-transform: uppercase;"  >
			<input type="hidden" value="<?=$_SESSION["user"];?>" name="user_creacion"    >
		</label>
		<label>
			Nombre 
			<input type="text" name="nombre" required style="text-transform: uppercase;"  >
		</label>
		<label>
			Apellido paterno
			<input type="text" name="apellido_paterno" required style="text-transform: uppercase;"  >
		</label>
		<label>
			Apellido materno
			<input type="text" name="apellido_materno" required style="text-transform: uppercase;"  >
		</label>

		<label>
			RFC
			<input type="text" name="rfc" style="text-transform: uppercase;" required >
		</label>


		<label>
			Celular
			<input type="text" type='tel' name="celular" maxlength="10" >
		</label>

		<label>
			Cargo
			<select name="cargo">
				<option value='Agente'>Agente</option>
				<option value='Supervisor'>Supervisor</option>
				<option value='Coordinador'>Coordinador</option>
				
				<option value='Generico'>Generico</option>
				<option value='Gerente'>Gerente</option>
				<option value='Director'>Director</option>
				<option value='WFM'>WFM</option>
				<option value='Desarrollador'>Desarrollador</option>
				<option value='Validacion'>Validacion</option>
				<option value='Back Office'>Back Office</option>
				<option value='Formador'>Formador</option>			
			</select>
		</label>


		<label>
			País
			<select name='pais'>
                	
                	
                	<option value="MEXICO">
                		MEXICO
                	</option >
                	<option value="COLOMBIA">
                		COLOMBIA
					</option>
					<option value="ESPAÑA">
						ESPAÑA
					</option>
					<option value="PERU" >
                		PERU
                	</option >
                </select>
		</label>
		
		<button type="submit">
			Registrar
		</button>
	</form>



</div>




























<script type="text/javascript">
$("#form-alta-user").submit(registra_usuario);
function registra_usuario(e){
		
	url = "controller/restro_usuario.php";		
	$.ajax({

		url : url , 
		type : "POST" , 		
		data :  $("#form-alta-user").serialize() , 
		beforeSend: function(){
			$(".usuarios_encontrados").html("Registrando");	
			
		}

	}).done(function(data){

		$(".usuarios_encontrados").html(data);	
	}).fail(function(){

		alert("Error al registrar ");
	});

	e.preventDefault();
}
</script>
<style type="text/css">
.permisos_no_view{
	display: none;
}
</style>
