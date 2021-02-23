<?php

	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
  		return $data;
	}

    $id = test_input($_POST["id"]);

	include_once("../../config/config.php");
	$conn = connectBDD();

	if($conn->connect_error){
		die("<br/>Falló el intento de conexión a la base de datos: ".$conn->connect_error."<br/>");
	}
    
    $sql = "DELETE FROM convocatoria WHERE id_convocatoria = '".$id."' ";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();

?>