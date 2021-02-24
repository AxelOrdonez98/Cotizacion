<?php
	include_once("../models/config/db.php");

	if($conn->connect_error){
		die("<br/>Falló el intento de conexión a la base de datos: ".$conn->connect_error."<br/>");
	}

	$sql = "SELECT * FROM convocatoria";

	$resultSet = $conn->query($sql) or die ($conn->error);

    $response = "";

	while($row = $resultSet->fetch_assoc()){	
        $timestamp = strtotime($row["fecha_inicio"]);

        $response .= '<option value="'.$row["id_convocatoria"].'">'.date("Y", $timestamp).' '.$row["calendario"].'</option>';
    }
	
	echo $response;
                       
?>