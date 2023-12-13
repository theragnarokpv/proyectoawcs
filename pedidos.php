<?php
    include "include/functions/conexion.php";
    session_start();
    $conexion = $conn;

    $idUsuario = $_SESSION['id_usuario'];
    $consultaPedidos = "SELECT * FROM compra WHERE id_usuario = $idUsuario";
    $resultadoPedidos = mysqli_query($conexion, $consultaPedidos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Valhalla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">
</head>
<body>
    <?php
        include "include/Templates/header.php";
    ?>

    <div class="container-fluid">
        <div class="row text-center">
            <h2 id="titulo-pedidos">Pedidos</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>

        <div id="pedidos-container" class="col-md-6">
        <?php
        // Iterar a través de los resultados de la consulta de pedidos
        while ($pedido = mysqli_fetch_assoc($resultadoPedidos)) {
            $idCompra = $pedido['id_compra'];
            $fechaCompra = $pedido['fecha_compra'];
            $totalPagar = $pedido['total_pagar'];

            // Consulta para obtener los productos de cada pedido
            $consultaProductos = "SELECT p.descripcion, dc.cantidad, dc.subtotal 
                                  FROM detalle_compra dc
                                  JOIN producto p ON dc.id_producto = p.id_producto
                                  WHERE dc.id_compra = $idCompra";
            $resultadoProductos = mysqli_query($conexion, $consultaProductos);
        ?>
            <div class="pedido-box">
                <div class="pedido_productos text-start">
                    <?php
                    // Iterar a través de los resultados de la consulta de productos
                    while ($producto = mysqli_fetch_assoc($resultadoProductos)) {
                        echo "<p>{$producto['cantidad']} x {$producto['descripcion']} - ₡{$producto['subtotal']}</p>";
                    }
                    ?>
                </div>

                <div class="pedido_datos text-end">
                    <div class="pedido_fecha">
                        <?php echo "Fecha del Pedido: <br> $fechaCompra"; ?>
                    </div>

                    <div class="pedido_total">
                        <?php echo "Total a Pagar: <br> ₡$totalPagar"; ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
        </div>

        <div class="col-md-5"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
