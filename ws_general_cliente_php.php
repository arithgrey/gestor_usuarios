<?php
	require "lib/nusoap.php";
	$cliente = new nusoap_client("http://172.72.80.72/gestor_usuarios/ws_general.php");
	$error = $cliente->getError();
	if ($error) {
	    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
	}
	$result = $cliente->call("get_test", array("ok jxxxxxxxxxxxxx"));
	$result2 = $cliente->call("get_test2");



	echo $result;	
	echo "<br>";
	echo $result2;
?>