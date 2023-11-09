<?php
    include "include/functions/conexion.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecno-Stream - Pago Realizado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">

    <style>
        /* Agrega estilos específicos aquí */
        #exito-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh; /* Ajusta la altura al 100% de la ventana */
        }

        #exito-texto {
            color: white;
            margin-top: 35px; /* Ajusta el espacio entre la imagen y el texto */
        }

        .btn_carrito {
            background: rgb(73, 24, 140);
            background: radial-gradient(circle, rgba(73, 24, 140, 1) 0%, rgba(21, 2, 62, 1) 57%);
            color: white;
            font-size: 20px;
            padding: 10px 20px 10px 20px;
            font-weight: bold;
            border-radius: 15px;
            margin-top: 40px; /* Ajusta el espacio entre el texto y el botón */
        }
    </style>
</head>
<body>
    <?php
        include "include/Templates/header.php";
    ?>

    <div id="exito-container">
        <img src="img/cheque.png"Imagen de Confirmación de Pago" class="img-fluid" style="width: 20%;">
        <h2 id="exito-texto">¡Pago Realizado!</h2>
        <h2 id="exito-texto">La factura sera enviada al correo asociado.</h2>
        
        <!-- Botón para volver a la página principal -->
        <a href="index.php" class="btn btn_carrito mt-3">Volver a la Página Principal</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
