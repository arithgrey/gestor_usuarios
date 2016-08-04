<?php

	class db_konecta
	{	
		function query_db_local($dinamic_query){
			
			$user = "tmp_developer";
			$pw   = "G4YummqPxZnJhMeR";
			$db = "intranet";	

			$cn=mysql_connect("172.72.80.72",$user,$pw) or mysql_error();
			mysql_select_db($db,$cn);
			mysql_query("SET NAMES 'utf8'");
			
			$r = mysql_query($dinamic_query)or(die(mysql_error()));	
			return $r;
		}

		function query_db_ext($dinamic_query){
					
			$user = "user_script_kapd";
			$pw   = "bpKchrvXUMKzGcJh";
			$db = "intranet";
			
			$cn=mysql_connect("172.15.9.212",$user,$pw) or mysql_error();
			mysql_select_db($db,$cn);
			mysql_query("SET NAMES 'utf8'");
			
			$r = mysql_query($dinamic_query)or(die(mysql_error()));	
			return $r;
		}
		/**/
		function td($val , $extra='' ){
			return "<td $extra>" . $val . "</td>"; 
		}
		
	
	}

	

?>