<?php	
	include_once("../config/db.php");

	$sql = "SELECT * FROM quotes";

	$resultSet = $conn->query($sql) or die ($conn->error);

    $data = array();

	while($row = $resultSet->fetch_assoc()){	
        $data[] = array( 
			"nCotizacion"=>$row['id_quote'],
            "nombre"=>$row['applicant_name'],
            "fecha"=>$row['date'],
			"correo"=>$row['applicant_email'],
			"dependecia"=>$row['dependency'],
			"obra"=>$row['obra'],
			"lugar"=>$row['address'],
			"ciudad"=>$row['city']
        );
    }
    $response = array(
        "data" => $data
    );
	echo json_encode($response);         
?>