<?php
session_start();

try {
    function obtenerProductoPorId($id) {
        require_once "conexion.php";
    
        $query = "SELECT * FROM producto WHERE id_producto = $id";
        $result = $conn->query($query);
    
        if ($result && $result->num_rows > 0) {
            $producto = $result->fetch_assoc();
            $result->close();
            return $producto;
        }
    
        return null;
    }



    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
    
        $producto = obtenerProductoPorId($codigo);
    
        if ($producto) {
            $producto['cantidad'] = 1;
            
            if (isset($_SESSION['carrito'][$codigo])) {
                $_SESSION['carrito'][$codigo]['cantidad']++;
            } else {
                $_SESSION['carrito'][$codigo] = $producto;
            }
    
                // Almacena la URL de referencia en la sesión
                $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

                // Redirige de vuelta a la página de referencia
                header("Location: " . $_SESSION['referer']);
        } else {
            echo "Producto no encontrado.";
        }
    } else {
        echo "ID de producto no especificado.";
    }
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage(), 0);

    // Muestra un mensaje de error al usuario
    echo "Ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.";
}

?>