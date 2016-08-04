<?php   
    session_start();
    if($_SESSION["in_session"] !=  1 ){header("location:index.php");}   
    require "controller/model/conexion72.php";
    $db_konecta = new  db_konecta();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta charset='utf8'>
<link rel="stylesheet" href="css/b1.css">
<link rel="stylesheet" href="css/b2.css">
<script src="js/j1.js"></script>
<script src="js/j2.js"></script>
<script src="js/j3.js"></script>




<script type="text/javascript">
$(document).ready(function(){

  WebSocketTest();


});

function WebSocketTest(){

  var wsUri = "ws://172.72.80.72/gestor_usuarios/";  
  websocket = new WebSocket(wsUri);

    //Connected to server
    websocket.onopen = function(ev) {
        alert('Connected to server ');
    }
   
    //Connection close
    websocket.onclose = function(ev) {
        alert('Disconnected');
    };
   
    //Message Receved
    websocket.onmessage = function(ev) {
        alert('Message '+ev.data);
    };
    //Error
    websocket.onerror = function(ev) {
        alert('Error '+ ev.data);
    };

}

</script>