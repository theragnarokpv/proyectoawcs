<?php
include "conexion.php"; // Asegúrate de tener la ruta correcta al archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["username"];
    $contrasena = $_POST["password"];

    // Verificar la autenticación
    $sql = "SELECT id_usuario, id_rol, username, password FROM valhalla.usuario WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario); // "s" indica que $usuario es una cadena de texto
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id_usuario, $id_rol, $username, $password_hash);

    if ($stmt->fetch() && password_verify($contrasena, $password_hash)) {
        // Autenticación exitosa
        session_start();
        $_SESSION['id_usuario'] = $id_usuario;
        $_SESSION['id_rol'] = $id_rol;
        $_SESSION['username'] = $username;
        
        header("Location: ../../index.php"); // Redirigir a la página principal después del inicio de sesión exitoso
        exit();
    } else {
        // Autenticación fallida
        echo "Usuario o contraseña incorrectos";
    }

    $stmt->close();
}
?>
