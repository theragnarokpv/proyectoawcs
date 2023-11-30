<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['pedido'])) {
    // Obtener el id del producto a eliminar
    $id_pedido = $_GET['pedido'];

    // Consulta SQL para eliminar el producto
    $sql = "DELETE FROM compra WHERE id_compra = $id_pedido";
    $sqlb = "DELETE FROM detalle_compra WHERE id_compra = $id_pedido";

    $stmt = $conn->prepare($sql);
    $stmtb = $conn->prepare($sqlb);

    try {
        $stmtb->execute();
        $stmt->execute();
        $response = ['status' => 'success', 'message' => 'Producto eliminado con éxito'];
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error al eliminar el producto: ' . $e->getMessage()];
    }

    // Redirigir a la página principal después de la eliminación
    header("Location: ../../adminpedidos.php");
    exit();
} else {
    // Si la solicitud no es de tipo GET o no se proporciona un id, devolver un error
    $response = ['status' => 'error', 'message' => 'Solicitud no válida'];
    echo json_encode($response);
}
?>