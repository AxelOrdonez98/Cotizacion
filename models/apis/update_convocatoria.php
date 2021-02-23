<?php

	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
          $data = htmlspecialchars($data);
          $data = strtoupper($data);

  		return $data;
    }
    
    $jsonString = file_get_contents("php://input");
    $json = json_decode($jsonString);

    $id = test_input($json->id);
    $calendario = test_input($json->calendario);
    $fecha_inicio = test_input($json->fecha_inicio);
    $fecha_fin = test_input($json->fecha_fin);
    $tipo = test_input($json->tipo);
    $estado = test_input($json->estado);

	include_once("../../config/config.php");
	$conn = connectBDD();

	if($conn->connect_error){
		die("<br/>Falló el intento de conexión a la base de datos: ".$conn->connect_error."<br/>");
	}
    
    $sql = "UPDATE convocatoria SET calendario = '".$calendario."', fecha_inicio = '".$fecha_inicio."', fecha_fin = '".$fecha_fin."', tipo = '".$tipo."',estado = '".$estado."' WHERE id_convocatoria = '".$id."' ";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

?>