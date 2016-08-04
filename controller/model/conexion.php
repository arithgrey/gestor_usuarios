<?php

	$user = "user_script_kapd";
	$pw   = "bpKchrvXUMKzGcJh";
	$db = "intranet";

	$cn=mysql_connect("172.15.9.212",$user,$pw) or mysql_error();
	mysql_select_db($db,$cn);
	mysql_query("SET NAMES 'utf8'");

?>