<?php
require_once '../libraries/vendor/autoload.php';
require_once '../models/config/db.php';

$content = file_get_contents("php://input");
$json = json_decode($content, true);
$fechaVolteada = date("d-m-y", strtotime($json["fecha"]));

$mpdf = new \Mpdf\Mpdf();

$sql = "INSERT INTO `quotes`(`applicant_name`, `applicant_email`, `dependency`, `obra`, `address`, `city`, `date`,`subtotal`, `iva`, `totalquotes`) VALUES ('{$json["dependenciaCliente"]}','{$json["emailCliente"]}','{$json["dependenciaCliente"]}','{$json["obraCliente"]}','{$json["direccionCliente"]}','{$json["ciudadCliente"]}','{$json["fecha"]}', '{$json["subtotal"]}', '{$json["iva"]}', '{$json["total"]}')";

if ($conn->query($sql) === TRUE) {
    $lastId = $conn->insert_id;
    $dbdata["success"] = "New record created successfully";
    $dbdata["lastId"] =  $lastId;
    foreach ($json["tabla"] as $key => $array) {
        if ($array != null){
            $sql2 = "INSERT INTO `services`(`id_quote`, `description`, `unit`, `quantity`, `price`, `total`) VALUES ('{$lastId}','{$array["concept"]}','{$array["unit"]}','{$array["cant"]}','{$array["price"]}','{$array["sumaParaTotal"]}')";
            if ($conn->query($sql2) === TRUE) {
                $dbdata["array".$key.""] = "New record created successfully";
            }
            else {
                $dbdata["error_array".$key.""] = "Error: " . $sql2 . "<br>" . $conn->error;
            }
        }
    }
}

$datosPDF = '<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500&family=Ubuntu&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../public/css/pdfStyle.css">
    
</head>

<body>
    <page size="A4" id="pdf" class="pagina">
        <div class="barra"></div>
        <p class="pImg">
            <img src="../public/img/logoUFV.jpg" class="logo">
        </p>
        <main>
        <table>
            <tr>
                <th class="info">FECHA:</th>
                <td class="restInfo">'. $fechaVolteada.'</td>
            </tr>
            <tr>
                <th class="info">EMAIL:</th>
                <td class="restInfo">'.$json["emailCliente"].'</td>
            </tr>
            <tr>
                <th scope="row" class="info">DEPENCIA:</th>
                <td class="restInfo">'.$json["dependenciaCliente"].'</td>
            </tr>
            <tr>
                <th class="info">OBRA:</th>
                <td class="restInfo">'.$json["obraCliente"].'</td>
            </tr>
            <tr>
                <th class="info">LUGAR:</th>
                <td class="restInfo">'.$json["direccionCliente"].'</td>
            </tr>
            <tr>
                <th class="info">CIUDAD:</th>
                <td class="restInfo">'.$json["ciudadCliente"].'</td>
            </tr>
        </table>
            <p class="terminoYCondiciones">
                Para el Sr. O Srita: '.$json["nombreCliente"].'. Se anexa la cotizacion correspondiente sobres los trabajos requeridos y
                solicitados.
            </p>
            <p class="terminoYCondiciones">
                TERMINOS Y CONDICIONES:
            </p>
            <ul>
                <li type="disc">
                    <dt>PRECIO:</dt>
                </li>
                <dd>Los precios son solo en moneda nacional (Pesos mexicanos) y ya incluye el impuesto sobre el valor
                    añadido (IVA)</dd>
                <li type="disc">
                    <dt>FORMA DE PAGO:</dt>
                </li>
                <dd>Se require de un 50% de anticipo y el resto al finalizar la obra</dd>
                <li type="disc">
                    <dt>TIEMPO DE INICIO:</dt>
                </li>
                <dd>Una vez aceptado la cotizacion, se iniciara el trabajo 3 dias despues</dd>
                <li type="disc">
                    <dt>VIGENCIA DE PRESUPUESTO:</dt>
                </li>
                <dd>La cotizacion sera valida, solo 30 dias del calendario</dd>
            </ul>
            <table class="tablaCotizacionParaPDF" align="center">
                <tr>
                    <th class="concepto">CONCEPTO</th>
                    <th class="principal">UNIDAD</th>
                    <th class="principal">CANT</th>
                    <th class="principal">P.U.</th>
                    <th class="principal">TOTAL</th>
                </tr>';

    foreach ($json["tabla"] as $key => $array) {
        if ($array != null){
            $datosPDF.='
            <tr>
                <td class="concept tabla-coti">'.$array["concept"].'</td>
                <td class="unit tabla-coti">'.$array["unit"].'</td>
                <td class="cant tabla-coti">'.$array["cant"].'</td>
                <td class="price tabla-coti">'.$array["price"].'</td>
                <td class="sumaParaTotal tabla-coti">'.$array["sumaParaTotal"].'</td>
            </tr>';
        }
    }
    $datosPDF.='<tr>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="infoFinal">SUBTOTAL:</td>
                    <td class="precios">'.$json["subtotal"].'</td>
                </tr>
                <tr>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="infoFinal">IVA (16%):</td>
                    <td class="precios">'.$json["iva"].'</td>
                </tr>
                <tr>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="infoFinal">TOTAL:</td>
                    <td class="precios">'.$json["total"].'</td>
                </tr>
            </table>        
        </main>
        <br><br>
        <div class="contacto">
            <p class="infoContacto">
                <strong>Atentamente:</strong>
                <br>
                Ing. Miguel Ángel Ordóñez Brito
                <br>
                <br>
                <strong>Contacto:</strong>
                <br>
                <img src="https://img.icons8.com/material/15/000000/whatsapp--v1.png"/> : +52 33 1668 5806
                <br>
                <img src="https://img.icons8.com/ios-filled/15/000000/new-post.png"/> : miguel.tecmanbrite@gmail.com
                <br>
                <img src="https://img.icons8.com/ios-glyphs/15/000000/google-maps.png"/> : Calle Doblon #4037, Col Lagos de Oriente. Gdl, Jal
            </p>
        </div>
    </page>
</body>

</html>';

$mpdf->WriteHTML($datosPDF);
$mpdf->Output("Cotizacion.pdf");
?>