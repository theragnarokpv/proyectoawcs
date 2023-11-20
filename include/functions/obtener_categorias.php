<?php
// obtener_categorias.php
include "conexion.php";

// Consulta para obtener las categorías
$query = "SELECT id_categoria, descripcion FROM categoria";
$result = $conn->query($query);

// Almacenar las categorías en un array asociativo
$categorias = array();
while ($row = $result->fetch_assoc()) {
    $categorias[] = $row;
}

// Devolver las categorías en formato JSON
header('Content-Type: application/json');
echo json_encode($categorias);
?>