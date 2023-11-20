<?php
    include "include/functions/conexion.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecno-Stream - Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">

    <style>
        /* Agrega estilos específicos aquí */
        #pedidos-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 70vh; /* Ajusta la altura al 100% de la ventana */
        }

        #titulo-pedidos {
            color: white;
        }

        .pedido-box {
            background: rgb(73, 24, 140);
            background: radial-gradient(circle, rgba(73, 24, 140, 1) 0%, rgba(21, 2, 62, 1) 57%);
            color: white;
            font-size: 20px;
            padding: 10px;
            margin-top: 20px;
            width: 80%;
            border-radius: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <?php
        include "include/Templates/header.php";
    ?>

    <div id="pedidos-container">
        <h2 id="titulo-pedidos">Pedidos</h2>

        <?php
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            $totalCompra = 0;

            // Inicia el recuadro de pedido
            echo "<div class='pedido-box'>";

            foreach ($_SESSION['carrito'] as $codigo => $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $totalCompra += $subtotal;

                // Muestra cada producto dentro del mismo recuadro de pedido
                echo "<p>{$producto['descripcion']} - Total: ₡{$subtotal}</p>";
            }

            // Muestra el estado del pedido y el total de la compra al final del recuadro
            echo "<p>Estado: Recibido</p>";
            echo "<p>Total de la compra: ₡{$totalCompra}</p>";

            // Cierra el recuadro de pedido
            echo "</div>";
        } else {
            echo "<p class='total_pagar'>No hay artículos en el carrito.</p>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
