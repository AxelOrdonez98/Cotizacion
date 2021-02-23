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
        <title>Crear Cotizacion</title>
        <script src="../libraries/jquery-3.4.1.min.js"></script>
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
                <li><a href="../views/viewQuote.php">Ver cotizaciones</a></li>
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
        <div>
            <div>
                <input class="inputMainCreation" type="text" id="inputName" placeholder="Ingrese el nombre del solicitante" required>
            </div>
            <div>
                <input class="inputMainCreation" type="email" id="inputEmail" placeholder="Ingrese el email electronico del solicitante" required>
            </div>
            <div>
                <input class="inputMainCreation" type="text" id="inputDepence" placeholder="Ingresa la dependencia" required>
            </div>
            <div>
                <input class="inputMainCreation" type="text" id="inputObra" placeholder="Ingresa la obra" required>
            </div>
            <div>
                <input class="inputMainCreation" type="text" id="inputPlace" placeholder="Ingresa la direccion" required>
            </div>
            <div>
                <input class="inputMainCreation" type="text" id="inputCity" placeholder="Ingresa la ciudad" required>
            </div>
            <div>
                <input class="inputMainCreation" type="date" id="inputDate" value="<?php echo Date("Y-m-d"); ?>" require>
            </div>
            <div class="tableMainView">
                <table  id="mainTable">
                    <tr>
                        <th class="oculto">CONCEPTO</th>
                        <th>UNIDAD</th>
                        <th>CANT</th>
                        <th>P.U.</th>
                        <th>TOTAL</th>
                        <th></th>
                    </tr>
                    <tr class="rowSubtotal general">
                        <td class="vacio tdDeBorrar"></td>
                        <td class="vacio tdDeBorrar"></td>
                        <td class="tdDeBorrar">SUBTOTAL</td>
                        <td class="tdDeBorrar" id="subTotal"></td>
                        <td class="vacio tdDeBorrar"></td>
                    </tr>
                    <tr class="general">
                        <td class="vacio tdDeBorrar"></td>
                        <td class="vacio tdDeBorrar"></td>
                        <td class="tdDeBorrar">IVA (16%)</td>
                        <td class="tdDeBorrar" id="iva"></td>
                        <td class="vacio tdDeBorrar"></td>
                    </tr>
                    <tr class="general">
                        <td class="vacio tdDeBorrar"></td>
                        <td class="vacio tdDeBorrar"></td>
                        <td class="tdDeBorrar">TOTAL</td>
                        <td class="tdDeBorrar" id="total"></td>
                        <td class="vacio tdDeBorrar"></td>
                    </tr>
                </table>
            </div>
            <button class="buttonCreation" id="aggregateService">Agregar producto / servicio</button>
            <br>
            <button class="buttonCreation" id="generatePDF">Generar PDF</button>           
        </div>
    </main>
    <script>
        document.querySelector(".hamburguer").addEventListener("click", function(){
            document.querySelector(".full-menu").classList.toggle("active");
            document.querySelector(".hamburguer").classList.toggle("close-hamburguer");
        });
    </script>
    <script src="../models/createQuote.js" type="module"></script>
    <script src="../models/geratePDF.js" type="module"></script>
</html>