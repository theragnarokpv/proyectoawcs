<?php
    include "include/functions/conexion.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecno-Stream - Método de Pago</title>
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
        <div class="form-label registro-label">Método de Entrega:</div>
    </div>

    <div class="container_registro">
        <form action="include/functions/MetodoPago.php" method="post" class="form-inline row">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="local" id="RadioLocal">
                        <label class="form-check-label metodo_pago" for="local">
                            Retiro en local
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="domicilio" id="RadioDomicilio">
                        <label class="form-check-label  metodo_pago" for="domicilio">
                           Entrega a Domicilio
                        </label>
                    </div>
                </div>
            </div>

            <div id="localOptions" class="row">
                <div class="col-md-6">
                    <div class="form-label registro-label">Tienda:</div>
                    <select class="form-control registro-input" id="tienda" name="tienda" style="width:350px; height: 45px; " required>
                        <option value="Cartago">Tienda Cartago</option>
                        <option value="SanJose">Tienda San Jose</option>
                    </select>
                </div>
            </div>

            <div id="domicilioOptions" class="row">
                <div class="col-md-6">
                    <div class="form-label registro-label">Provincia:</div>
                    <input type="text" class="form-control registro-input" id="provincia" name="provincia" style="width:350px; color: white;" required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Cantón:</div>
                    <input type="text" class="form-control registro-input" id="canton" name="canton" style="width:350px; color: white;" required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Distrito:</div>
                    <input type="text" class="form-control registro-input" id="distrito" name="distrito" style="width:350px; color: white;" required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Datos Adicionales:</div>
                    <textarea class="form-control registro-input" id="datos_adicionales" name="datos_adicionales" style="width:350px; color: white;"></textarea>
                </div>
            </div>

            <div class="row">
                <div id="tit_carrito">
                    <div class="form-label registro-label">Datos de la tarjeta:</div>
                </div>
            </div>

            <div id="tarjetaOptions" class="row">
                <div class="col-md-6">
                    <div class="form-label registro-label">Número de Tarjeta:</div>
                    <input type="text" class="form-control registro-input" id="num_tarjeta" name="num_tarjeta" style="width:350px;color: white; " required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Número de Seguridad:</div>
                    <input type="text" class="form-control registro-input" id="num_seguridad" name="num_seguridad" style="width:350px;color: white; " required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Nombre del Propietario:</div>
                    <input type="text" class="form-control registro-input" id="nombre_propietario" name="nombre_propietario" style="width:350px;color: white; " required>
                </div>
                <div class="col-md-6">
                    <div class="form-label registro-label">Fecha de Expiración:</div>
                    <input type="text" class="form-control registro-input" id="fecha_expiracion" name="fecha_expiracion" style="width:350px;color: white; " required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <a href="carrito.php" class="btn btn_carrito mt-3">Volver</a>
                </div>
                <div class="col-md-7">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn_carrito mt-3">Confirmar</button>
                </div>
            </div>

        </form>
    </div>

    <script>
    </script>

</body>

</html>
