<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['producto'])) {
    // Obtener el id del producto a eliminar
    $id_producto = $_GET['producto'];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM producto WHERE id_producto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);

    try {
        $stmt->execute();
        $response = ['status' => 'success', 'message' => 'Producto eliminado con éxito'];
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error al eliminar el producto: ' . $e->getMessage()];
    }

    // Redirigir a la página principal después de la eliminación
    header("Location: ../../adminproductos.php");
    exit();
} else {
    // Si la solicitud no es de tipo GET o no se proporciona un id, devolver un error
    $response = ['status' => 'error', 'message' => 'Solicitud no válida'];
    echo json_encode($response);
}
?>
