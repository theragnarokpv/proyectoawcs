<?php
    include "include/functions/conexion.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Valhalla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">
</head>

<body>
    <?php
    include "include/Templates/header.php";
    ?>

    <div id="tit_carrito">
        Registro de Cuenta
    </div>

    <div class="container_registro">
        <form method="post" class="form-inline row" id="formRegistro">
            <div id="pnlMensaje" title="Error" style="display:none">
                <div>
                    <strong>Atención!</strong> Se ha presentado el siguiente problema.
                    <br />
                    <br />
                    <p id="bnlMensajes"></p>
                </div>
            </div>
            <div id="pnlInfo" title="Mensaje" style="display : none;">
                <div>
                    <strong>Información!</strong> Procesamiento éxitoso.
                    <br />
                    <br />
                    <p id="blInfo"></p>
                </div>
            </div>


            <div class="row">
                <div class="col-md-6">
                    <div class="form-label registro-label">Usuario:</div>
                    <input type="text" class="form-control registro-input" id="usuario_registro" name="usuario" style="width:350px;" required>
                </div>
                <div class="col-md-6">
                <div class="form-label registro-label">Nombre:</div>
                    <input type="text" class="form-control registro-input" id="nombre" name="nombre" style="width:350px;" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-label registro-label">Apellidos:</div>
                    <input type="text" class="form-control registro-input" id="apellidos" name="apellidos" style="width:350px;" required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Correo Electrónico:</div>
                    <input type="email" class="form-control registro-input" id="correo" name="correo" style="width:350px;" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-label registro-label">Contraseña:</div>
                    <input type="password" class="form-control registro-input" id="contrasena" name="contrasena" style="width:350px;" required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Confirmar Contraseña:</div>
                    <input type="password" class="form-control registro-input" id="confirmar_contrasena" name="confirmar_contrasena" style="width:350px;" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-4">
                    <div for="Telefono" class="form-label registro-label">Teléfono:</div>
                    <input type="text" class="form-control registro-input" id="telefono" name="telefono" style="width:350px;" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <button type="submit" id="btn_registrar">Registrarse</button>
                </div>
            </div>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/registro.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>

</html>