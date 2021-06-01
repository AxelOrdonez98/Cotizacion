<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inicio</title>
        <link rel="shortcut icon" href="public/img/icons/icono_de_pagina.png">

        <script src="libraries/jquery-3.4.1.min.js"></script>
        <script src="libraries/sweetalert2.all.min.js"></script>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto:wght@500&family=Ubuntu&display=swap" rel="stylesheet"> 

        <link rel="stylesheet" href="public/css/main.css">
    </head>
    <body class="ContainerFirts">
        <div class="containerCenter">
            <div class="formLogin" >
                <h1 class="titulos">Bienvenido</h1>
                <h3 class="noTitulos">Inicia sesion</h3>
                <div id="firtsForm">
                    <input type="text" id="email" placeholder="Ingrese su correo" class="inputsLogin">
                    <input type="password" id="password" placeholder="Ingrese su contraseña" class="inputsLogin">
                    <input type="submit" value="Ingresar" class="ingresar">
                </div>
            </div>
        </div>
    </body>
    <script src="models/login.js" type="module"></script>
</html>