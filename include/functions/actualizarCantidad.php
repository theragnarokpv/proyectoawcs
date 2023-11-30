<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si los datos esperados están presentes
    if (isset($_POST['codigo']) && isset($_POST['nuevaCantidad'])) {
        // Obtener los datos del formulario
        $codigo = $_POST['codigo'];
        $nuevaCantidad = $_POST['nuevaCantidad'];

        // Verificar si el código está en el carrito
        if (isset($_SESSION['carrito'][$codigo])) {
            // Actualizar la cantidad en el carrito
            $_SESSION['carrito'][$codigo]['cantidad'] = $nuevaCantidad;

            // Después de actualizar la cantidad en el carrito
            echo json_encode(['success' => true, 'newQuantity' => $_SESSION['carrito'][$codigo]['cantidad']]);
        } else {
            // Enviar una respuesta JSON indicando que el producto no está en el carrito
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado en el carrito']);
        }
    } else {
        // Enviar una respuesta JSON indicando datos incompletos
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    }
} else {
    // Enviar una respuesta JSON indicando que el método de solicitud no es válido
    echo json_encode(['success' => false, 'message' => 'Método de solicitud no válido']);
}
?>