<?php
include "conexion.php";

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_producto = $_POST["id_producto"];
    $id_categoria = $_POST["id_categoria"];
    $descripcion = $_POST["descripcion"];
    $detalle = $_POST["detalle"];
    $precio = $_POST["precio"];
    $existencias = $_POST["existencias"];
    // Puedes agregar más campos según tus necesidades

    // Actualizar el producto en la base de datos
    $sql = "UPDATE producto SET
            id_categoria = ?,
            descripcion = ?,
            detalle = ?,
            precio = ?,
            existencias = ?
            WHERE id_producto = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issdii", $id_categoria, $descripcion, $detalle, $precio, $existencias, $id_producto);

    try {
        $stmt->execute();
        $response = ['status' => 'success', 'message' => 'Producto actualizado con éxito'];
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error al actualizar el producto: ' . $e->getMessage()];
    }

    // Devolver la respuesta al cliente (JavaScript)
    echo json_encode($response);
} else {
    // Si la solicitud no es de tipo POST, devolver un error
    $response = ['status' => 'error', 'message' => 'Método no permitido'];
    echo json_encode($response);
}
?>