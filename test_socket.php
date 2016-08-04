<?php
?>
<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="js/j1.js"></script>
<script src="js/j2.js"></script>
<script src="js/j3.js"></script>
</head>
<body>

    <textarea id="caja" cols="100" rows="20"></textarea><br/>
    <input id="mensaje" type="text" size="105"></input>
    <button onClick="enviar(document.getElementById('mensaje').value);">Enviar</button>
    <button onClick="desconectar()">Desconectar</button>



</body>
</html> 
<script type="text/javascript">
	
	var mysocket = new WebSocket("ws://172.72.80.72/gestor_posiciones/test_socket2.php");
	mysocket.onopen = function(evt){
	   escribir("Websocket abierto");
	};
	function escribir(texto){
      valor = document.getElementById("caja").value;
      document.getElementById("caja").value = valor + texto + "\n";     
    }
    function enviar(texto) {
      mysocket.send(texto);
      escribir("ENVIADO: " + texto);
    }
    function desconectar(){		
      mysocket.close();      
    }

</script>