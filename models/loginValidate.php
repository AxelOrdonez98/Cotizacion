<?php
	function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
	}
	
	$email = test_input($_POST["userEmail"]);
	$password 	= test_input($_POST["userPassword"]);

	include_once("config/db.php");

	if($conn->connect_error){
		die("<br/>Falló el intento de conexión a la base de datos: ".$conn->connect_error."<br/>");
	}
	$SQL_SELECT = 'SELECT id , email, password FROM usuarios WHERE email="'.$email.'" AND password="'.$password.'"';
	$resultSet = $conn->query($SQL_SELECT) or die ($conn->error);

	session_start();
	while($line = $resultSet->fetch_assoc()){
		$UserEmail 	= $line["email"];
		$_SESSION["authenticated"] = true;
	}
	if ($_SESSION["authenticated"]) {
		$_SESSION["UserEmail"] 	= $UserEmail;
		echo true;
		$_SESSION['start'] = time(); // Taking now logged in time.
			// Ending a session in 30 minutes from the starting time.
		$_SESSION['expire'] = $_SESSION['start'] + (15 * 60);
	}
?>