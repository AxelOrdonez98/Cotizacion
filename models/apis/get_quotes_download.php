<?php
require_once '../../libraries/vendor/autoload.php';
require_once '../../models/config/db.php';

$mpdf = new \Mpdf\Mpdf();

$lastId = $_GET['id_quotation'];
$sql = "SELECT * FROM quotes WHERE id_quote = ".$lastId."";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      //datos de la tabla de contenido
      $applicant_name = $row['applicant_name'];
      $applicant_email = $row['applicant_email'];
      $dependency = $row['dependency'];
      $obra = $row['obra'];
      $address = $row['address'];
      $city = $row['city'];
      $date = $row['date'];
      $subtotal = $row['subtotal'];
      $iva = $row['iva'];
      $totalquotes = $row['totalquotes'];
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
        <link rel="stylesheet" href="../../public/css/pdfStyle.css">
        
    </head>

    <body>
        <page size="A4" id="pdf" class="pagina">
            <div class="barra"></div>
            <p class="pImg">
                <img src="../../public/img/logo_MAIPPE.png" class="logo">
            </p>
            <main>
            <table>
                <tr>
                    <th class="info">#COTIZACION:</th>
                    <td class="restInfo">'.$lastId.'</td>
                </tr>
                <tr>
                    <th class="info">FECHA:</th>
                    <td class="restInfo">'.$date.'</td>
                </tr>
                <tr>
                    <th class="info">EMAIL:</th>
                    <td class="restInfo">'.$applicant_email.'</td>
                </tr>
                <tr>
                    <th scope="row" class="info">DEPENCIA:</th>
                    <td class="restInfo">'.$dependency.'</td>
                </tr>
                <tr>
                    <th class="info">OBRA:</th>
                    <td class="restInfo">'.$obra.'</td>
                </tr>
                <tr>
                    <th class="info">LUGAR:</th>
                    <td class="restInfo">'.$address.'</td>
                </tr>
                <tr>
                    <th class="info">CIUDAD:</th>
                    <td class="restInfo">'.$city.'</td>
                </tr>
            </table>
                <p class="terminoYCondiciones">
                    Para el Sr. O Srita: '.$applicant_name.'. Se anexa la cotizacion correspondiente sobre los trabajos requeridos y
                    solicitados.
                </p>
                <table class="tablaCotizacionParaPDF" align="center">
                    <tr>
                        <th class="concepto">CONCEPTO</th>
                        <th class="principal">UNIDAD</th>
                        <th class="principal">CANT</th>
                        <th class="principal">P.U.</th>
                        <th class="principal">TOTAL</th>
                    </tr>';

        $sql = "SELECT * FROM services WHERE id_quote = ".$lastId."";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            //datos de la primera tabla de informacion
            $description = $row['description'];
            $unit = $row['unit'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $total = $row['total'];
            $datosPDF.='
                <tr>
                    <td class="concept tabla-coti">'.$description.'</td>
                    <td class="unit tabla-coti">'.$unit.'</td>
                    <td class="cant tabla-coti">'.$quantity.'</td>
                    <td class="price tabla-coti">'.$price.'</td>
                    <td class="sumaParaTotal tabla-coti">'.$total.'</td>
                </tr>';
            }
        }
        $datosPDF.='<tr>
                        <td class="vacio"></td>
                        <td class="vacio"></td>
                        <td class="vacio"></td>
                        <td class="infoFinal">SUBTOTAL:</td>
                        <td class="precios">'.$subtotal.'</td>
                    </tr>
                    <tr>
                        <td class="vacio"></td>
                        <td class="vacio"></td>
                        <td class="vacio"></td>
                        <td class="infoFinal">IVA (16%):</td>
                        <td class="precios">'.$iva.'</td>
                    </tr>
                    <tr>
                        <td class="vacio"></td>
                        <td class="vacio"></td>
                        <td class="vacio"></td>
                        <td class="infoFinal">TOTAL:</td>
                        <td class="precios">'.$totalquotes.'</td>
                    </tr>
                </table>
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
            </main>
            <br><br>
            <div class="contacto">
                <p class="infoContacto">
                    <strong>Atentamente:</strong>
                    <br>
                    Ing. Miguel Ángel Ordóñez Brito
                    <br>
                    <strong>Contacto:</strong>
                    <br>
                    <img src="https://img.icons8.com/material/15/000000/whatsapp--v1.png"/> : +52 33 1668 5806
                    <br>
                    <img src="https://img.icons8.com/ios-filled/15/000000/new-post.png"/> : miguel.tecmanbrite@gmail.com
                </p>
            </div>
        </page>
    </body>

    </html>';

    $mpdf->WriteHTML($datosPDF);
    $nombreArchivo = $applicant_name."_".$date."_Cotizacion.pdf";
    $mpdf->Output($nombreArchivo, "D");
?>