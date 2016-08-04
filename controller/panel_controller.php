<?php 
include ("model/general_model.php");
class panel_controller
{
	/*Construye el panel*/
	function get_panel($color, $inicio , $fin, $title){
		
		
		$posiciones =  new general_model();		
		$style =  "";
		$table ="<table class='table' border='1' style='font-size:.7em;'>"; 
		$table .="<tr style='background: #286090; color:white;' >
					 <td colspan='7' style='font-size:10px !important;' class='text-center'>
						 <strong>". $title ."</strong>
					 </td>
				 </tr>";
		$b =0; 
		for ($a = $inicio; $a <= $fin; $a++) { 		
			/**/
			$table .= "<tr style='background:". $color .";'  class='text-center'>";				
			if ($a%2 != 0  ){								
				/********** ********************* ***********************/								
				$data =  $posiciones->posiciones_local($a);	

				$result_data=  mysql_fetch_array($data);
				$info =   "" . $result_data["pc_ip"] . "<br>" . $result_data["modelo_telefono"] . "<br>"  . "". $result_data["voz_extension"];  								

				$table .= $this->get_td("<br><span>" . $a . "</span>" , "style='background:white; color:black; border: none; border-collapse: collapse; ' border='0'  " );
				$table .=  $this->get_td( $info  , "data-toggle='modal' data-target='#posiciones_modal'  class='posicion_edit'  id='". $a ."' "); 
				$table .= $this->get_td("", "style='background:white; color:black; border: none; border-collapse: collapse; ' border='0'  "); 
				/*para b */
				$b=$a +1; 
				$data_b =  $posiciones->posiciones_local($b);	
				$result_data_b =  mysql_fetch_array($data_b);


				$info_b =  "" . $result_data_b["pc_ip"]. "<br>" . $result_data_b["modelo_telefono"] . "<br>" . "".$result_data_b["voz_extension"];  				
				$table .=  $this->get_td( $info_b ,  " data-toggle='modal' data-target='#posiciones_modal' class='posicion_edit'  id='". $b ."' "  ); 	
				$table .= $this->get_td("<br><span>" . $b . "</span>" , "style='background:white; color:black; border: none; border-collapse: collapse; ' border='0' " );	
			}
			$table .= "</tr>";									
		}	
		$table .="</table>";
		return $table; 	
	}
	/**/
	function get_td($val , $extra=''){
		return "<td ". $extra .">". $val."</td>";
	}
	/**/
}
?>
