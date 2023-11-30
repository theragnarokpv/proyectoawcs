<?php
include "conexion.php";
session_start();

// Obtener los valores del formulario
$minPrice = isset($_POST['minPrice']) ? $_POST['minPrice'] : null;
$maxPrice = isset($_POST['maxPrice']) ? $_POST['maxPrice'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;

// Construir la consulta SQL con consultas preparadas para evitar inyección SQL
$sql = "SELECT * FROM producto WHERE 1";

// Agregar condiciones solo si se proporcionan los valores
if (!empty($minPrice)) {
    $sql .= " AND precio >= ?";
}

if (!empty($maxPrice)) {
    $sql .= " AND precio <= ?";
}

if (!empty($description)) {
    $sql .= " AND descripcion LIKE ?";
}

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Agregar los valores y tipos de datos para cada parámetro
if (!empty($minPrice)) {
    $stmt->bind_param("d", $minPrice);
}

if (!empty($maxPrice)) {
    $stmt->bind_param("d", $maxPrice);
}

if (!empty($description)) {
    $description = "%" . $description . "%";
    $stmt->bind_param("s", $description);
}

// Ejecutar la consulta
$resultado = $stmt->execute();

// Verificar si la consulta fue exitosa
if ($resultado) {
    // Obtener resultados
    $resultados = $stmt->get_result();

    // Procesar los resultados
    while ($datos = $resultados->fetch_assoc()) {
        // Llamar a la función de impresión
        imprimirProducto($datos);
    }
} else {
    // Manejar el error si la consulta falla
    echo "";
    echo "Error en la consulta: " . $stmt->error;
}

// Cerrar la conexión
$conn->close();

// Función para imprimir un producto
function imprimirProducto($datos) {
    echo "<div class='col-md-3'>";
    echo "<div class='product'>";
    echo "<a href='producto.php?codigo={$datos['id_producto']}' class='product-link'><img src='{$datos['ruta_imagen']}' alt='{$datos['descripcion']}' class='product-image'></a>";
    echo "<h3 class='product-name'>{$datos['descripcion']}</h3>";
    echo "<h3 class='product-price'>₡ {$datos['precio']}</h3>";
    echo "<a href='include/functions/agregarCarrito.php?codigo={$datos['id_producto']}'><button class='btn_compra' ><i class='bi bi-cart-plus-fill'></i>AÑADIR</button></a>";
    echo "</div>";
    echo "</div>";
}
?>