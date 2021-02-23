<?php
    $server="67.227.237.232";
    $usuario="maosende_admin";
    $contra="[e]]Sp}zez.!-9+O";
    $db="maosende_dbcoline";
    
    $conn = new mysqli($server, $usuario, $contra, $db);
    if ($conn->connect_error) {
        die("La coneccion a la base de datos fallo: " . $conn->connect_error);
    }
?>