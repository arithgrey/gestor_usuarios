<?php
	require "lib/nusoap.php";
	
	function get_test($text){
		return  $text; 
	}
	
	function get_test2(){
		return "ok";
	} 
	$server = new soap_server();
	
	$server->register("get_test");
	$server->register("get_test2");
	$server->service($HTTP_RAW_POST_DATA);

?>