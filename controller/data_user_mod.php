<?php
	session_start();
    if($_SESSION["in_session"] !=  1 ){header("location:index.php");}   	
	require "model/conexion72.php";
	$db_konecta = new  db_konecta();


	/*sacamos data usuario */
	$user_busqueda = $_GET["user"];	
	$query_get = "SELECT c.nombre  as nombre_cargo , u.* FROM  intranet.usuario  u  
				 inner join intranet.cargo_alta  c  on  
				 u.cargo =  c.id 
				WHERE username_usuario =  '". $user_busqueda  ."'"; 	



	
	/*Los datos de intranet */		
	$result_user =    $db_konecta->query_db_local($query_get);		
	$data_complete  = array();
	while( $row =  mysql_fetch_array($result_user) ) {
		$data_complete[] =  $row;
	}
	$data_complete =  $data_complete[0];


	$id =  $data_complete["id"];                          
	$locacion =  $data_complete["locacion"];                    
	$login  =  $data_complete["login"];                       
	                        
	$nombre =  $data_complete["nombre"];                      
	$apellidos_usuario=  $data_complete["apellidos_usuario"];           
	$username_usuario =  $data_complete["username_usuario"];            
	$estado=  $data_complete["estado"];   


	if ($estado ==  "1"){
		$estado =  "<option value='1' selected>  Activo
					</option>
					<option value='2'>  Baja
					</option>
					";
	
		$estado_val =1;   
	}else{
		
		$estado =  "<option value='1' >  Activo
					</option>
					<option value='2' selected>  Baja
					</option>
					";
	

		$estado_val =0; 
	}
	
	$ubicacion=  $data_complete["ubicacion"];                     	
	$cargo =  $data_complete["cargo"];                       	
	$localidad=  $data_complete["localidad"];                  	
	$telefonoMovil=  $data_complete["telefonoMovil"];               
	      
	$turno=  $data_complete["turno"];                       


	$sql_asignacion =  "select * from  intranet.asignacion_ID where  usr = '". $user_busqueda ."' order by fecha_alta "; 
	$result_user_asignaciones =    $db_konecta->query_db_ext($sql_asignacion);		
	$data_complete_asignaciones  = array();
	while( $row =  mysql_fetch_array($result_user_asignaciones) ) {
		$data_complete_asignaciones[] =  $row;
	}
	$data_complete_asignaciones =  $data_complete_asignaciones;
?>
<br>
<h4>
	Última actividad
</h4>
<table style='width:100%; font-size:.8em;' class='text-center' border=1 >

	<tr style='background:rgb(77, 157, 194); color:white;'>
		<?php
			echo  $db_konecta->td("nif");	
			echo  $db_konecta->td("nom");
			echo  $db_konecta->td("app");
			
			echo  $db_konecta->td("usr");	
			echo  $db_konecta->td("login");
			echo  $db_konecta->td("skill");

			echo  $db_konecta->td("activo");	
			echo  $db_konecta->td("fecha_alta");
			echo  $db_konecta->td("fecha_baja");
		
		?>
	</tr>
	<?php 

	foreach ($data_complete_asignaciones as $row) {
		
		 	 	 	 	 		 
		echo "<tr>";
		echo  $db_konecta->td($row["nif"]);	
		echo  $db_konecta->td($row["nom"]);
		echo  $db_konecta->td($row["app"]);
		
		echo  $db_konecta->td($row["usr"]);	
		echo  $db_konecta->td($row["login"]);
		echo  $db_konecta->td($row["skill"]);
		echo  $db_konecta->td($row["activo"]);	
		echo  $db_konecta->td($row["fecha_alta"]);
		echo  $db_konecta->td($row["fecha_baja"]);
		
		echo "</tr>";
				
	}

	?>

</table>

<hr>

<form action="controller/actualiza.php" method ="POST" id="form-actualizacion-usuario">
	
<div style=" padding:10px;">
	<div class="form-group">
	  <label class="control-label" for="">
	  	Usuario
	  </label>  
	  <div class="col-md-3">
	  		<input id="usuario" value="<?=$username_usuario;?>" name="usuario" placeholder="Usuario" class="form-control input-sm" 
	  		type="text"  readonly  >    
	  </div>
	</div>

	<input type="hidden" name="user_mod" value="<?=$_SESSION['user']?>">
	


	<div class="form-group">
	  <label class=" control-label" for="">
	  	Login 
	  </label>  
	  <div class="col-md-3">
	  <input id="usuario" value="<?=$login;?>" name="login" placeholder="Login" class="form-control input-sm" type="text"  readonly >    
	  </div>
	</div>


	<div class="form-group">
	  <label class=" control-label" for="nombre">nombre</label>  
	  <div class="col-md-3">
	  <input id="nombre" name="nombre"  value= "<?=$nombre;?>" placeholder="Nombre del usuario" class="form-control input-sm" type="text">	    
	  </div>
	</div>
	<div class="form-group">
		<label class=" control-label" for="nombre">
			País
		</label>  
		 <div class="col-md-3">


		 	

			<select class='form-control ' name='npais'  >                 	
				<?php 
					$ubicaciones = array(  "MEXICO" , "COLOMBIA" ,  "ESPAÑA" , "PERU"  );
					for($a=0; $a <count($ubicaciones) ; $a++) { 

						if ($ubicacion == $ubicaciones[$a] ) {
							echo "<option value='". $ubicaciones[$a]."' selected >  " . $ubicaciones[$a] . "</option>";	
						}else{
							echo "<option value='". $ubicaciones[$a]."'  >  " . $ubicaciones[$a] . "</option>";	
						}
						
					}
				?>
		         
		     </select>
		</div>     
    </div> 

	<input type="hidden"  name='iduser' value="<?=$id;?>">
	<div class="form-group">
	  <label class="control-label" for="telefonoMovil">telefonoMovil</label>  
	  <div class="col-md-3">
	  <input id="telefonoMovil" name="telefonoMovil"  value="<?=$telefonoMovil;?>" placeholder="telefonoMovil" class="form-control input-sm" type="text">
	    
	  </div>
	</div>



</div>

<hr>
<input type="submit">
<!-- Text input-->	
</form>

<script type="text/javascript" src="js/actualizacion.js"></script>