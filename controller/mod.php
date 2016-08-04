<?php


require "model/general_model.php";
require "model/general_model_PE.php";
require "model/general_model_chile.php";

require "general.php";
$general_model =  new general_model();
$general_model_PE =  new general_model_PE();
$general_model_chile =  new general_model_chile();


$help =  new general();
/*retorna los datos de la posicion*/
if ($_GET["action"] == "list") {
	
	$data =  $general_model ->posicion_e($_GET);
	$data_complete  = array();
	while( $row =  mysql_fetch_array($data) ) {
		$data_complete[] =  $row;
	}
	header('Content-type: application/json; charset=utf-8');
    echo json_encode($data_complete);
    exit();	
}
/*Actualizar datos de la posicion*/
if ($_POST["action"] ==  "update_data_posicion"){
	$response_db  =  $general_model ->udpate_data_posicion_e($_POST);
	echo $response_db;
}
/*remen*/
if ($_GET["action"] == "resumen") {		
	/*Resumen local*/
	$response =  $general_model->get_resumen_e($_GET);
	$data_resumen_ext =  array();
	while( $row_ext =  mysql_fetch_array($response) ) {
		$data_resumen_ext[] =  $row_ext;
	}
	echo  $help->get_resumen($data_resumen_ext );
}
/**/
if($_GET["action"] == "plano" ){

	switch ($_GET["ubicacion"]) {
		case 'MEXICO':
			$data =  $general_model->get_plano($_GET);
			echo $help->construye_plano($data);		
			break;
		case 'PERU':			
			$data =  $general_model_PE->get_plano($_GET);
			echo $help->construye_plano_PE($data);					
			break;
		case 'PERU_1':			
			$data =  $general_model_PE->get_plano_s_1($_GET);
			echo $help->construye_plano_PE_S1($data);					
			break;
		case 'PERU_2':			
			$data =  $general_model_PE->get_plano_s_2($_GET);
			echo $help->construye_plano_PE_S2($data);										
			break;
		case 'PERU_5':			
			$data =  $general_model_chile->get_plano_cargo($_GET);
			echo $help->construye_plano_CH_cargo($data);										
			break;		
		default:
			echo "País no localizado";
			break;
	}

	
}
/**/
if ($_GET["action"] ==  "camp") {		
	$data =  $general_model->get_camp($_GET);	
	echo $help->get_campania($data);
}
if ($_POST["action"] ==  "eliminar") {

	$db_response =  $general_model->elimina_posicion($_POST);	
	echo $db_response;
}
if ($_POST["action"] == "login_user"){	

	$db_response = $general_model->valida_user($_POST);	
	echo $db_response;
}
/**/
if ($_POST["action"] == "actualiza_password"){
	$db_response = $general_model->update_pass($_POST);	
	echo $db_response;	
}
/**/
if ($_GET["action"] == "carga_resumen_ubicacion") {

	$db_response = $general_model->get_resumen_ubicacion($_GET);	
	echo $help->construye_resumen($db_response);	
}
/**/
?>