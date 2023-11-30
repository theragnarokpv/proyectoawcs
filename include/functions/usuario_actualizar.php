<?php
include "conexion.php";

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_usuario = $_POST["id_usuario"];
    $id_rol = $_POST["id_rol"];
    $username = $_POST["username"];
    $contrasena = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    // Puedes agregar más campos según tus necesidades

    // Actualizar el producto en la base de datos
    $sql = "UPDATE usuario SET
            id_rol = ?,
            username = ?,
            password = ?,
            nombre = ?,
            apellidos = ?,
            correo = ?,
            telefono = ? 
            WHERE id_usuario = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("issssssi", $id_rol, $username, $password, $nombre, $apellidos, $correo, $telefono, $id_usuario);

    try {
        $stmt->execute();
        $response = ['status' => 'success', 'message' => 'Producto actualizado con éxito'];
    } catch (PDOException $e) {
        $response = ['status' => 'error', 'message' => 'Error al actualizar el producto: ' . $e->getMessage()];
    }

    // Devolver la respuesta al cliente (JavaScript)
    echo json_encode($response);
} else {
    // Si la solicitud no es de tipo POST, devolver un error
    $response = ['status' => 'error', 'message' => 'Método no permitido'];
    echo json_encode($response);
}
?>