<?php
	session_start();	
	if(!isset($_SESSION["authenticated"])) {		
		session_unset();
		session_destroy();
		header("Location: ../index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver cotizacion</title>

    <script src="../libraries/jquery-3.4.1.min.js"></script>

    <link rel="stylesheet" href="../libraries/DataTables/datatables.css">
    <script src="../libraries/DataTables/datatables.js"></script>

    <script src="../libraries/sweetalert2.all.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/navHamburgesa.css">

</head>
    <body>
    <div class="full-menu">
        <nav id="menu" class="menu">
            <ul>
                <li><a href="../views/viewQuote.php" class="verCoti">Ver cotizaciones</a></li>
                <li><a href="../views/priceCreationIndex.php">Crear Cotizacion</a></li>
                <li><a href="../models/logOut.php">Cerrar sesion</a></li>
            </ul>
        </nav>
    </div>
    <div class="hamburguer">
        <div class="lines line-top"></div>
        <div class="lines line-mid"></div>
        <div class="lines line-bottom"></div>
    </div>
    <main class="mainContainer">
    </main>
    <script>
        document.querySelector(".hamburguer").addEventListener("click", function(){
            document.querySelector(".full-menu").classList.toggle("active");
            document.querySelector(".hamburguer").classList.toggle("close-hamburguer");
        });
    </script>
    <script src="../models/apis/quotesView.js" type="module"></script>
    
</body>
</html>