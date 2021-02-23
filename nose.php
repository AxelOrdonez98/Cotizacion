<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500&family=Ubuntu&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="public/css/pdfStyle.css">
</head>

<body>
    <page size="A4" id="pdf" class="pagina">
        <div class="barra"></div>
        <p class="pImg">
            <img src="public/img/logoUFV.jpg" class="logo">
        </p>
        <main>
            <table>
                <tr>
                    <th class="info">FECHA:</th>
                    <td class="restInfo">09/12/20</td>
                </tr>
                <tr>
                    <th scope="row" class="info">DEPENCIA:</th>
                    <td class="restInfo">CONTROL Y SISTEMAS AZ</td>
                </tr>
                <tr>
                    <th class="info">OBRA:</th>
                    <td class="restInfo">PROTECCION PARA VENTANAS EN CASETAS</td>
                </tr>
                <tr>
                    <th class="info">LUGAR:</th>
                    <td class="restInfo">CASETA DE VIGILANCIA</td>
                </tr>
                <tr>
                    <th class="info">CIUDAD:</th>
                    <td class="restInfo">IXTLAHUACAN DE LOS MEMRILLOS, JALISCO</td>
                </tr>
            </table>
            <p class="terminoYCondiciones">
                A quien corresponda. Se anexa la cotizacion correspondiente sobres los trabajos requeridos y
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
                </tr>
                <tr>
                    <td class="tablaInfo">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, quod.</td>
                    <td class="tablaInfo">Metros</td>
                    <td class="tablaInfo">3</td>
                    <td class="tablaInfo">3</td>
                    <td class="tablaInfo">9</td>
                </tr>
                <tr>
                    <td class="tablaInfo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, nobis!</td>
                    <td class="tablaInfo">Kg</td>
                    <td class="tablaInfo">5</td>
                    <td class="tablaInfo">5</td>
                    <td class="tablaInfo">25</td>
                </tr>
                <tr>
                    <td class="tablaInfo">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta, nobis!</td>
                    <td class="tablaInfo">L</td>
                    <td class="tablaInfo">4</td>
                    <td class="tablaInfo">4</td>
                    <td class="tablaInfo">16</td>
                </tr>
                <tr>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="infoFinal">SUBTOTAL:</td>
                    <td class="precios" id="subTotal">50</td>
                </tr>
                <tr>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="infoFinal">IVA (16%):</td>
                    <td class="precios" id="iva">8.0000</td>
                </tr>
                <tr>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="vacio"></td>
                    <td class="infoFinal">TOTAL:</td>
                    <td class="precios" id="total">58.0000</td>
                </tr>
            </table>        
        </main>
        <br><br>
        <div class="contacto">
            <p class="infoContacto">
                <strong>Atentamente</strong>
                <br>
                Ing. Miguel Ángel Ordóñez Brito
                <br>
                <br>
                <strong>Contacto</strong>
                <br>
                <img src="https://img.icons8.com/material/15/000000/whatsapp--v1.png"/> : +52 33 1668 5806
                <br>
                <img src="https://img.icons8.com/ios-filled/15/000000/new-post.png"/> : miguel.tecmanbrite@gmail.com
                <br>
                <img src="https://img.icons8.com/ios-glyphs/15/000000/google-maps.png"/> : Calle Doblon #4037, Col Lagos de Oriente. Gdl, Jal
            </p>
            <div class="barraAbajo"></div>
        </div>
    </page>
</body>

</html>