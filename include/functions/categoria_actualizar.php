<?php
include "conexion.php";

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_categoria = $_POST["id_categoria"];
    $descripcion = $_POST["descripcion"];
    // Puedes agregar más campos según tus necesidades

    // Actualizar el producto en la base de datos
    $sql = "UPDATE categoria SET
            descripcion = ?
            WHERE id_categoria = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("si", $descripcion,  $id_categoria);

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