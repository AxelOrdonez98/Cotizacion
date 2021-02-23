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

    $sql = "INSERT INTO convocatoria (calendario, fecha_inicio, fecha_fin, tipo, estado) VALUES ('".$calendario."', '".$fecha_inicio."', '".$fecha_fin."', '".$tipo."','".$estado."') ";
    $respond = array();

    if ($conn->query($sql) === TRUE) {
        $lastId = $conn->insert_id;

        $respond["msg"] = "success inserting data";
        $respond["lastId"] = $lastId;
        echo json_encode($respond);
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

?>