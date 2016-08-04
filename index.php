<?php   
    session_start();     
    if ($_SESSION["in_session"] ==  1  ){
        include "gestor.php";     
    }else{
        include "user_login.php";
    } 
?>