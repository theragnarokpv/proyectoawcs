<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['usuario'])) {
    // Obtener el id del producto a eliminar
    $id_usuario = $_GET['usuario'];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM usuario WHERE id_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    try {
        $stmt->execute();
        $response = ['status' => 'success', 'message' => 'Producto eliminado con éxito'];
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error al eliminar el producto: ' . $e->getMessage()];
    }

    // Redirigir a la página principal después de la eliminación
    header("Location: ../../adminusuarios.php");
    exit();
} else {
    // Si la solicitud no es de tipo GET o no se proporciona un id, devolver un error
    $response = ['status' => 'error', 'message' => 'Solicitud no válida'];
    echo json_encode($response);
}
?>
