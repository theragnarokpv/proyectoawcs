<?php
session_start();
include "conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $conexion = $conn;

    // Datos de entrega (si se selecciona este método de pago)
    $tienda = isset($_POST['tienda']) ? $_POST['tienda'] : null;
    $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : null;
    $canton = isset($_POST['canton']) ? $_POST['canton'] : null;
    $distrito = isset($_POST['distrito']) ? $_POST['distrito'] : null;
    $datosAdicionales = isset($_POST['datos_adicionales']) ? $_POST['datos_adicionales'] : null;

    // Aquí deberías validar y sanitizar los datos según tus necesidades

    // Insertar la compra en la base de datos

    $total = 0;

    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $codigo => $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $total += $subtotal;
            
            // ... tu código anterior ...
        }
    }

    $_SESSION['total_carrito'] = $total;

    $idUsuario = $_SESSION['id_usuario'];
    $totalPagar = $_SESSION['total_carrito'];
    $metodoEntrega = 'domicilio';

    $insertCompraSQL = "INSERT INTO compra (id_usuario, total_pagar, metodo_entrega, tienda, provincia, canton, distrito, datos_adicionales)
                        VALUES ($idUsuario, $totalPagar, '$metodoEntrega', '$tienda', '$provincia', '$canton', '$distrito', '$datosAdicionales')";

    if (mysqli_query($conexion, $insertCompraSQL)) {
        $idCompra = mysqli_insert_id($conexion);

        // Insertar detalles de la compra en la base de datos
        foreach ($_SESSION['carrito'] as $codigo => $producto) {
            $idProducto = $producto['id_producto'];
            $cantidad = $producto['cantidad'];
            $precioUnitario = $producto['precio'];
            $subtotal = $cantidad * $precioUnitario;

            $insertDetalleSQL = "INSERT INTO detalle_compra (id_compra, id_producto, cantidad, precio_unitario, subtotal)
                                VALUES ($idCompra, $idProducto, $cantidad, $precioUnitario, $subtotal)";

            mysqli_query($conexion, $insertDetalleSQL);
        }

        // Aquí puedes realizar otras acciones necesarias, como limpiar el carrito, enviar confirmaciones, etc.

        // Redirigir a una página de confirmación o a donde sea necesario
        header("Location: ../../pagohecho.php");
        exit();
    } else {
        echo "Error al insertar la compra en la base de datos: " . mysqli_error($conexion);
    }

    mysqli_close($conexion);
} else {
    // Enviar una respuesta JSON indicando que el método de solicitud no es válido
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}
?>