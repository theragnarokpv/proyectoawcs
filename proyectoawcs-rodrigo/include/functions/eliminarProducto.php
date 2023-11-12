<?php
session_start();

try{
    if (isset($_GET['codigo'])) {
        $codigo = $_GET['codigo'];
    
        if (isset($_SESSION['carrito'][$codigo])) {
            // Elimina el producto del carrito usando el código como clave
            unset($_SESSION['carrito'][$codigo]);
        }
    }    
} catch (Exception $e){
    error_log("Error: " . $e->getMessage(), 0);

    // Muestra un mensaje de error al usuario
    echo "Ha ocurrido un error. Por favor, inténtalo de nuevo más tarde.";
}


header("Location: ../../carrito.php");