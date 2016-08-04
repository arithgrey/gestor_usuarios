<?php 
class general{	
		
	function construye_resumen($data){

		$table ="<table class='text-center pull-right' border='1' style='font-size:.8em;'>"; 
		$table .= "<tr style='background: #286090; color:white;'>";
		$table .=  $this->get_td("Sin Ip");
		$table .=  $this->get_td("Sin Extensión");
		$table .=  $this->get_td("Sin Modelo");
		$table .=  $this->get_td("Sin Servidor aes");
		$table .= "</tr>";
	while( $row =  mysql_fetch_array($data) ) {

			
			$sin_ip = $row["sin_ip"];
			$sin_ext = $row["sin_ext"];
			$sin_modelo = $row["sin_modelo"];
			$sin_srv_aes = $row["sin_srv_aes"];

				$table .= "<tr>";
				$table .=  $this->get_td($sin_ip , "style='width:100px;' "); 
				$table .=  $this->get_td($sin_ext  , "style='width:100px;' "); 
				$table .=  $this->get_td($sin_modelo , "style='width:100px;' "); 
				$table .=  $this->get_td($sin_srv_aes  , "style='width:100px;' "); 
				$table .= "</tr>";



		}
		$table .="</table>"; 
		return $table;
	}
	/*Resumen de tipificaciones*/	
	function construye_plano($data){

		$tablero ="";
		$pasillos =  $data["pasillos"];
		$posiciones =  $this->get_array($data["posiciones"]);
		$num_pasillo = 1; 


		$tablero .= "<table>"; 
		$tablero .= "<tr>"; 
		while( $row =  mysql_fetch_array($pasillos) ) {

		 	$inicio = $row["pos_ini"];
		 	$fin = $row["pos_fin"];		 	
		 	$tablero .="<td>" . $this->get_pasillo($inicio , $fin , $num_pasillo , $posiciones  ) ."</td>";
		 	$tablero .="<td style='width:20px;'></td>";

		 	$num_pasillo ++;
		}
		$tablero .= "</tr>"; 
		$tablero .= "</table>"; 
		return $tablero;
	}/**/
	
	function get_pasillo($inicio , $fin , $num_pasillo,  $posiciones  ){
		
		$style = "<div class='col-lg-6 col-md-6  col-sm-6 ' >";
		$table ="<table class='table tb-pasillo'  style='font-size:.7em;'>"; 
		$table .="<tr style='background: #286090; color:white;' >
					 <td colspan='7' style='font-size:10px !important;' class='text-center'>
						 <strong>Pasillo".$num_pasillo."</strong>
					 </td>
				 </tr>";
		$b =0; 
		$color  ="";
		for ($a = $inicio; $a <= $fin; $a++) { 		
			
			$table .= "<tr  class='text-center'>";				
			if ($a%2 != 0  ){								
				/******************************* ***********************/																
				$info =   $this->get_data_posicion($posiciones,  $a );
				$info_iconos = $info["iconos"];

				$table .= $this->get_td($info_iconos);				
				$table .= $this->get_td( $info["informacion"]); 				
				$table .= $this->get_td("" , "style='background: rgb(108, 186, 222) !important;' "); 				
				/*para b */
				$b=$a +1; 	

				$info_b = $this->get_data_posicion($posiciones,  $b );
				$info_iconos_b = $info_b["iconos"];
				$table .= $this->get_td( $info_b["informacion"]); 	
				$table .= $this->get_td($info_iconos_b);
				
			}
			$table .= "</tr>";									
		}	
		$table .="</table>";
		return $table;
	}
	function get_data_posicion($data, $puesto , $flag_ubicacion = 0 ){
	
		$info = "";
		$icon = ""; 
		$existe =0; 
		foreach ($data as $row) {
			$info = "<div data-toggle='modal' data-target='#posiciones_modal'  class=' posicion_edit '  id='". $puesto  ."'  > + </div>";  				
			if ($row["puesto"] == $puesto ) {

				$pc_ip  = $row["pc_ip"];
				$modelo_telefono  = $row["modelo_telefono"];
				$voz_extension  = $row["voz_extension"];		
				$user =  $row["usuario"];	
				$servicio =  $row["servicio"];

				$servicio =  str_replace ( '_' , ' ' , $servicio);

				$login =  $row["login"];
				$srv_aes =  $row["srv_aes"];
							
				$flag_faltante =0; 		
				if ( strlen($pc_ip) < 4 || strlen($modelo_telefono) < 4  || strlen($voz_extension )  < 4  || strlen($srv_aes) < 4 ){														
					$flag_faltante ++; 
				}	
			
				$info = "<div data-toggle='modal' data-target='#posiciones_modal'  class=' posicion_edit '  id='". $puesto  ."'  > " . $pc_ip . "<br>" . $modelo_telefono  . "<br>"  ."". $voz_extension ."<br><span class='user_lb' >" . $user . "</span><br>" . $login . "<br>" .$servicio ."</div>";  								
				$existe ++; 
				break;
			}	
		}		
		$info_puesto["informacion"] = $info;		
		$info_puesto["iconos"] = $this->get_iconos_ubicacion($flag_ubicacion ,$puesto , $flag_faltante , $existe );
		$info_puesto["exists"] = $existe;
		return $info_puesto;		
	}
	/**/
	function get_iconos_ubicacion($flag ,  $puesto , $flag_faltante , $existe ){

		$class_ubicacion =  ""; 
		if ($flag == 1 ) {
			$class_ubicacion =  "class='peru-section-icon' style='vertical-align:bottom;' "; 
		}


		if ($existe > 0 ) {
			$icon = "<div $class_ubicacion >";	
			switch ($flag){
				/*Para México*/
				case 0:
					$icon .= "<br>
							<div style='' title='Número de puesto'>
							<strong>". $puesto ."</strong>
							</div>
							<i class='elimina-posicion  fa fa-minus-circle fa-2x' style='color:#286090;' id='".  $puesto ."' title='Eliminar los datos del puesto seleccionado'  data-toggle='modal' data-target='#posiciones_del_modal'  ></i>";
					break;
				/*Para Perú*/
				case 1:
					$icon .= "<div class='puesto-p'>" . $puesto ."</div> 							
							 <i class='elimina-posicion  fa fa-minus-circle fa-2x icon-p' style='color:#286090;' id='".  $puesto ."' title='Eliminar los datos del puesto seleccionado'  data-toggle='modal' data-target='#posiciones_del_modal'>						
							</i>";		
					break;
				default:				
					break;
			}
			/**/
			if ($flag_faltante == 1 ){
					$icon .= "<i style='color:#D07474;'  class='fa fa-exclamation-triangle fa-2x icon-faltante-p' aria-hidden='true' title='Indica que hace falta información en ésta posición'>
							  </i>";
			}
			$icon .= "</div>";

		}
			



		return $icon; 

	}
	/**/
	function get_campania($data){
		
		$option = ""; 
		while( $row =  mysql_fetch_array($data) ) {
			$option .="<option value='". $row["campania"]."'> ". $row["campania"]  ."</option>";
		}
		return $option;
	}
	/**/
	function get_td($val ,  $extra = '' ){
		return  "<td $extra  >" . $val  ."</td>";
	}
	function get_array($result){

		$data =  array();
		while( $row_ext =  mysql_fetch_array($result) ) {
			$data[] =  $row_ext;
		}
		return $data;
	}
	/**/

	/************************************TERMINA PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU PERU *************************************/
	function construye_plano_PE($data){

		$data_pasillos  = $this->get_array($data["pasillos"]);
		$data_posiciones = $this->get_array($data["posiciones"]);
		return  $this->plano_PE($data_pasillos , $data_posiciones); 
	}
	/**/
	function plano_PE($data_pasillos , $data_posiciones){		
		
		$pasillos =  $data["pasillos"]; 
		$tb =""; 
		$total = 0;
		$fg = 0; 

		$table_pasillos   =  array(); 

		foreach ($data_pasillos as  $row ){		
			$tb =""; 			
			$tb .=  "<table class='text-center table-interna-peru' border='1'  >";						
			$tb .=  $this->get_pasillos_pe($row["pasillo"] , $row["pos_ini"]  , $row["pos_fin"] ,  $row["total"] , $data_posiciones );			
			$tb .=  "</table>"; 	
				
				$table_pasillos[$fg] =  $tb;
				$fg ++; 
		}


		$table = "<table class='tb-pasillo'>"; 
		$ftb = 0; 
		$numero = 0;
		$z =1; 
		$dinamic_table = ""; 
		for ($a=0; $a < count($table_pasillos); $a++) { 							
				if ($ftb == 0 ) {$table .=  "<tr>";}					
					/*Formamos tables */
					if ($z ==1){
						$table .=  $this->get_td("<div class='tabl-i'>" . $table_pasillos[$a+1] ."</div>", "style='float:left;'  " );	
						$table .= $this->get_td("" , " class=' posicion_edit ' ");
						$table .=  $this->get_td("<div class='tabl-i'>" . $table_pasillos[$a] ."</div>" , "style='float:right;' ");										
					}else if ($z == 2) {$z =0;}			
					$z++;
				
				$ftb ++; 
				if ($ftb == 2 ){
					$table .=  "</tr><tr></tr>"; 	
					$ftb = 0;
				}
				$numero ++;
				
		}
		$table .= "</table>"; 
		return $table; 
		
	}
	/**/
	function get_pasillos_pe($pasillo , $inicio , $fin , $total , $data_posiciones  ){
		
		
		$numero_columnas = $total; 
		$media_numero_columnas =  $numero_columnas/2; 	
		$inicio_mas_corte =  $inicio + $media_numero_columnas; 		
		$inicio_mas_1 =  $inicio +1; 
		$fin_menos_corte =  $fin - $media_numero_columnas; 

		$tb =  "<tr>"; 



		for ($inicio_mas_corte; $inicio_mas_corte  > $inicio; $inicio_mas_corte -- ){ 					
			$info =    $this->get_data_posicion($data_posiciones , $inicio_mas_corte  , 1 );

			$tb .=  $this->get_td( "<div class='p-inf'> " .  $info["informacion"] . $info["iconos"] . "</div>"  );

		}




		$info = $this->get_data_posicion($data_posiciones , $inicio , 1  );		

		$tb .=  $this->get_td("Mando <br>" . $info["informacion"] . "<div style='background:white; color:black;'>" .  $info["iconos"] ."</div>"   , " class='title-mando posicion_edit' rowspan = '2' ");	
		$tb .= $this->get_td("Pasillo <br>" . $pasillo , "rowspan = '2' ");
		$tb .=  "</tr>";

		$tb .=  "<tr>";
		for ($fin; $fin > $fin_menos_corte; $fin -- ){ 		
			$info =  $this->get_data_posicion($data_posiciones , $fin , 1  );

				if (strlen($info["exists"]) > 0 ) {
					$tb .=  $this->get_td( "<div class='p-inf'> "  . $info["informacion"] . $info["iconos"] . "</div>" );	
				}else{
					$tb .=  $this->get_td( "<div class='p-inf'> "  . $info["informacion"]  . "</div>" );
				}

			
		}
		

		//
		$tb .=  "</tr>";

		return $tb;

	}
	/************************************TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU TERMINA PERU *************************************/


	/*************************PERU SALA 1 INICIA   PERU SALA 1 INICIA  PERU SALA 1 INICIA   PERU SALA 1 INICIA *****/
	function construye_plano_PE_S2($data){

		$pasillos =  $this->get_array($data["pasillos"]);		
		$posiciones = $this->get_array($data["posiciones"]);
		return $this->get_pasillos_PE_S2($pasillos , $posiciones );

	}





	function construye_plano_PE_S1($data){

		$pasillos =  $this->get_array($data["pasillos"]);		
		$posiciones = $this->get_array($data["posiciones"]);
		return $this->get_pasillos_PE_S1($pasillos , $posiciones );

	}

	function get_pasillos_PE_S2($pasillos , $posiciones ){

		
		$data_complete  = array();
		foreach ($pasillos as $row) {

			switch ($row["pasillo"]) {
					case 1:
						$data_complete[0]=$this->create_tb_horizontal_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones ); 	
						break;						
					case 2:
						$data_complete[1]= $this->create_tb_horizontal($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones ); 				
						break;	

					case 3:
						$data_complete[2]= $this->create_tb_horizontal_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones ); 	
						break;	
						
					case 4:
						$data_complete[3]=  $this->create_tb_horizontal_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones ); 	
						break;	
					
					case 5:
						$data_complete[4]= $this->get_tb_vertical_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"]  , $posiciones ); 
						break;	

					default:
						$tb .= "";	
						break;
			}		
		}
		

		
	
	$tb .= "<div class='container'>"; 
		$tb .=  "<div class='col-lg-6 col-md-6  pull-left'>"; 				
			$tb .=  "<div class='row' style='float-left' >"; 
				$tb .= $data_complete[0];				
			$tb .=  "</div  ><br>"; 	
			$tb .=  "<div class='row' style='float-left'  > "; 
				$tb .= $data_complete[1];
			$tb .=  "</div><br>"; 	
				$tb .= $data_complete[2];
			$tb .=  "<div class='row' style='float-left'>"; 	
				$tb .= $data_complete[3];	
			$tb .=  "</div><br>"; 					
		$tb .=  "</div>";
		$tb .=  "<div class='col-lg-6 col-md-6   pull-right'>";  				
				$tb .= $data_complete[4];
		$tb .=  "</div>";		
	$tb .=  "</div>"; 				

		return $tb;
	}
	/**/




	/**/
	function get_pasillos_PE_S1($pasillos , $posiciones ){

		$tb ="<div class='container'>";
		$tb .="<div class='col-lg-8 col-md-8'>"; 
		foreach ($pasillos as $row) {			
			switch ($row["pasillo"]) {
					case 1:
						$tb .= "<div class='row'>" . $this->create_tb_horizontal_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones )."</div>"; 
						break;						
					case 2:
						$tb .= "<br><div class='row'>" . $this->create_tb_horizontal($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones ) ."</div>"; 				
						break;	

					case 3:
						$tb .= "<br><div class='row'>" . $this->create_tb_horizontal($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones   ) ."</div>"; 				
						break;	
					
					case 4:
						$tb .= "<br>
									<div class='row' >
									
									<div class='si-1' style='float-left;'  >
										" . $this->create_tb_horizontal($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"]  , $posiciones  ) ."
									</div>"; 				
						break;	
					
					case 5:
							$tb .= "<div class='si-2 ' style='float-rigth;' >
									" . $this->get_tb_vertical_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"] , $posiciones  ) ."
									</div> 
								</div></div>"; 				
						break;	

					case 6:
							$tb .= "<div class='col-lg-4 col-md-4' >
									" . $this->get_tb_vertical_retorno($row["pasillo"] , $row["pos_ini"] , $row["pos_fin"]  , $posiciones ) ."
									</div>";
							break;	
					default:
						$tb .= "";	
						break;
			}		
		}

		$tb .= "</div>";
		return $tb;
	}
	/**/
	function create_tb_horizontal_retorno($pasillo , $inicio , $fin , $posiciones ){

		$tb ="<table class='table-s-1 text-center' border=1 style='font-size: .8em;'>";
		$tb .=  "<tr>";
		for ($fin; $fin >=  $inicio ; $fin-- ){ 
			
			$info =    $this->get_data_posicion($posiciones , $fin  , 1 );
			$tb .=  $this->get_td( "<div class='p-inf'> " .  $info["informacion"] . $info["iconos"] . "</div>" , "class='td-sala-1' " );		
		}	
		$tb .=  "</tr>";
		$tb .=  "</table>";
		return $tb;
	}
	/**/
	function create_tb_horizontal($pasillo , $inicio , $fin , $posiciones ){

		$tb ="<table class='table-s-1 text-center' border=1  style='font-size: .8em;' >";
		$tb .=  "<tr>";

		for ($a=$inicio; $a <= $fin ; $a++){

			$info =    $this->get_data_posicion($posiciones , $a  , 1 );
			$tb .=  $this->get_td( "<div class='p-inf'> " .  $info["informacion"] . $info["iconos"] . "</div>" , "class='td-sala-1' " );
		}
		$tb .=  "</tr>";
		$tb .=  "</table>";
		return $tb;
	}
	/**/
	function get_tb_vertical_retorno($pasillo , $inicio , $fin , $posiciones  ){
		$tb = "<table class='table-s-1 text-center' border=1 style='font-size: .8em;' >";
		for ($fin; $fin >=  $inicio ; $fin--) { 
			
			$tb .= "<tr>";
			//$tb .=  $this->get_td($fin  , "class='td-sala-1' ");
			$info =    $this->get_data_posicion($posiciones , $fin  , 1 );
			$tb .=  $this->get_td( "<div class='p-inf'> " .  $info["informacion"] . $info["iconos"] . "</div>" , "class='td-sala-1' " );

			$tb .= "</tr>";
		}
		$tb .= "</table>";
		return $tb;
	}
	/*************************PERU SALA 1 TERMINA PERU SALA 1 TERMINA  PERU SALA 1 TERMINA  PERU SALA 1 TERMINA */








	/**chile chile chile chilechile chilechile chilechile chilechile chilechile chilechile chilechile chilechile chile */
	function construye_plano_CH_cargo($data){

		$data_pasillos  = $this->get_array($data["pasillos"]);
		$data_posiciones = $this->get_array($data["posiciones"]);
		return  $this->plano_PE($data_pasillos , $data_posiciones); 
	}



















}
?>