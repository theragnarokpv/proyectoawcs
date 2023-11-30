<?php
    include "conexion.php"; // Asegúrate de tener la ruta correcta al archivo de conexión

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $id_rol = 3;
        $usuario = $_POST["usuario"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $contrasena = password_hash($_POST["contrasena"], PASSWORD_DEFAULT); // Encriptar la contraseña
        $telefono = $_POST["telefono"];
        
        // Puedes asignar un valor predeterminado para otros campos si es necesario

        // Insertar datos en la tabla de usuarios
        $sql = "INSERT INTO usuario (id_rol, username, password, nombre, apellidos, correo, telefono)
                VALUES ($id_rol, '$usuario', '$contrasena', '$nombre', '$apellidos', '$correo', '$telefono')";

        $stmt = $conn->prepare($sql);

        // Puedes asignar un rol por defecto o obtenerlo de alguna manera // Por ejemplo, asignando el rol con id 1


        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Usuario registrado exitosamente";
        } else {
            echo "Error al registrar el usuario";
        }


        // Redirige de vuelta a la página de referencia
        header("Location: ../../iniciosesion.php");
    }
?>
