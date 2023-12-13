<?php
session_start();

if (isset($_SESSION['carrito'])) {
    // Limpiar el carrito
    unset($_SESSION['carrito']);

    // Redirigir a la página del carrito
    header('Location: ../../carrito.php');
    exit();
} else {
    // El carrito ya está vacío, redirigir a la página del carrito
    header('Location: ../../carrito.php');
    exit();
}
?>
