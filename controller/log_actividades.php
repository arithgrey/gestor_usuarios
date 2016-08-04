<?php

	require "model/conexion72.php";
	$db_konecta = new  db_konecta();
	$sql =  "SELECT * FROM  kapd.log_control_users WHERE  fecha = CURRENT_DATE() and  usr is not null and  
	usr  !=  ''     order by id";
	$result =    $db_konecta->query_db_local($sql);		
	$data_complete  = array();
	while( $row =  mysql_fetch_array($result) ) {
		$data_complete[] =  $row;
	}

?>

<div>
	<hr>
	<h3>
		<small style="margin-left:20px; color:white; ">
			Log de movimientos 
		</small>
	</h3>
		
		<div class='well'>
			<div style="overflow-y:scroll; height:180px;  font-size:.8em;">
				<table style="width:100%; "  class='text-center'  > 
					<?php

						foreach ($data_complete as $row) {
							
							echo "<tr>";							
							echo  $db_konecta->td($row["usr"]);
							echo  $db_konecta->td($row["fecha"]);
							echo  $db_konecta->td($row["hora"]);
							echo  $db_konecta->td($row["tipo"]);
							echo  $db_konecta->td($row["accion"]);
							echo "</tr>";
							
						}

					?>

				</table>
			</div>	
		</div>	
	
</div>

