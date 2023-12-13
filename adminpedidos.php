<?php
    include "include/functions/conexion.php";
    session_start();

    $conexion = $conn;

    $id_rol_usuario = $_SESSION['id_rol'] ?? null;

    // Verifica que se haya iniciado sesión y el rol sea menor o igual a 2
    if (isset($_SESSION['id_usuario']) && $id_rol_usuario !== null && $id_rol_usuario <= 2) {
        // Usuario autenticado y es un administrador
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
        include "include/Templates/navadmin.php";
    ?>

    <section class="main-content">
        <div class="container">
            <div class="row">

                <?php 
                    $query = "SELECT c.*, u.nombre as nombre_usuario , u.apellidos as apellidos_usuario
                    FROM valhalla.compra c
                    JOIN valhalla.usuario u ON c.id_usuario = u.id_usuario";
                    $resultado = mysqli_query($conexion, $query);

                    if ($resultado) {
                        // Inicializar el contador para el número de filas
                        $contador = 1;

                        // Imprimir la tabla
                        echo "<table class='table table-striped table-hover'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th scope='col'>#</th>";
                        echo "<th scope='col'>Cliente</th>";
                        echo "<th scope='col'>Productos</th>";
                        echo "<th scope='col'>Fecha</th>";
                        echo "<th scope='col'>Metodo de Entrega</th>";
                        echo "<th scope='col'>Botones</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";

                        // Iterar sobre los resultados
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            // Obtener los detalles de la compra
                            $idCompra = $fila['id_compra'];
                            $idUsuario = $fila['id_usuario'];
                            $totalPagar = $fila['total_pagar'];
                            $metodoEntrega = $fila['metodo_entrega'];
                            $fechaCompra = $fila['fecha_compra'];
                            $nombreUsuario = $fila['nombre_usuario'];
                            $apellidosUsuario = $fila['apellidos_usuario'];
                            $provincia = $fila['provincia'];
                            $canton = $fila['canton'];
                            $distrito = $fila['distrito'];
                            $adicionales = $fila['datos_adicionales'];

                            // Obtener los productos relacionados con la compra
                            $queryProductos = "SELECT p.descripcion, dc.cantidad
                                            FROM valhalla.detalle_compra dc
                                            JOIN valhalla.producto p ON dc.id_producto = p.id_producto
                                            WHERE dc.id_compra = $idCompra";
                            $resultadoProductos = mysqli_query($conexion, $queryProductos);
                            $productos = array();

                            while ($producto = mysqli_fetch_assoc($resultadoProductos)) {
                                $productos[] = $producto['descripcion'] . " (Cantidad: " . $producto['cantidad'] . ")";
                            }

                            // Imprimir la fila de la tabla
                            echo "<tr>";
                            echo "<th scope='row'>$contador</th>";
                            echo "<td>$nombreUsuario $apellidosUsuario</td>";
                            echo "<td class='admin_producto'>" . implode("<br>", $productos) . "</td>";
                            echo "<td>$fechaCompra</td>";
                            echo "<td>$metodoEntrega <br> $provincia <br> $canton <br> $distrito  <br> $adicionales </td>";
                            echo "<td>
                                <a href='include/functions/pedido_eliminar.php?pedido=$idCompra'><button class='btn_admin'>Eliminar</button></a>
                            </td>";
                            echo "</tr>";

                            // Incrementar el contador
                            $contador++;
                        }

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "Error en la consulta: " . mysqli_error($conexion);
                    }

                    // Cerrar la conexión
                    mysqli_close($conexion);
                    ?>

            </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/modal_categorias.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>
</html>

<?php
} else {
    // Usuario no autenticado o no es un administrador, redirige a la página de inicio de sesión
    header("Location: inicioSesion.php");
    exit();
}
?>