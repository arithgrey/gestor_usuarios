<?php
    error_reporting(E_ALL);

    echo "<h2>TCP/IP Connection</h2>\n";
    $service_port = getservbyname('www', 'tcp');
    $address = gethostbyname('localhost');

    /* Crear un socket TCP/IP. */
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false) {
        echo "socket_create() falló: razón: " . socket_strerror(socket_last_error()) . "\n";
    } else {
        echo "OK.\n";
    }

    echo "Intentando conectar a '$address' en el puerto '$service_port'...";
    $result = socket_connect($socket, $address, $service_port);
    if ($result === false) {
        echo "socket_connect() falló.\nRazón: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
    } else {
        echo "OK.\n";
    }

    $in = "HEAD / HTTP/1.1\r\n";
    $in .= "Host: localhost\r\n";
    $in .= "Connection: Close\r\n\r\n";
    $out = '';
    echo "Enviando petición HTTP HEAD ...";
    socket_write($socket, $in, strlen($in));
    echo ".\n";
    echo "Leyendo respuesta:\n\n";
    while ($out = socket_read($socket, 2048)) {
        echo "<br><br><br><br><br><br>";
        echo $out;

    }
    echo "Cerrando socket...";
    socket_close($socket);
    echo "OK.\n\n";
?>