<?php	
	error_reporting(E_ALL ^ E_NOTICE);

	include_once("../models/config/db.php");

	$sql = "SELECT Q.id_quote, Q.applicant_name, Q.applicant_email, Q.dependency, Q.obra, Q.address, Q.city, Q.date, Q.subtotal, Q.iva, Q.totalquotes, S.id_service, S.id_quote, S.description, S.unit, S.quantity, S.price, S.total FROM quotes AS Q JOIN services AS S ON Q.id_quote = S.id_quote";

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