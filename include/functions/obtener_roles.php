<?php
// obtener_categorias.php
include "conexion.php";

// Consulta para obtener las categorías
$query = "SELECT id_rol, nombre FROM rol";
$result = $conn->query($query);

// Almacenar las categorías en un array asociativo
$roles = array();
while ($row = $result->fetch_assoc()) {
    $roles[] = $row;
}

// Devolver las categorías en formato JSON
header('Content-Type: application/json');
echo json_encode($roles);
?>