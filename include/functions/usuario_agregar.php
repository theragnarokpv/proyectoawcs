<?php
    include "conexion.php"; // Asegúrate de tener la ruta correcta al archivo de conexión

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $id_rol = 3;
        $usuario = $_POST["username"];
        $correo = $_POST["correo"];
        $contrasena = password_hash($_POST["contra"], PASSWORD_DEFAULT); // Encriptar la contraseña
        
        // Puedes asignar un valor predeterminado para otros campos si es necesario

        // Insertar datos en la tabla de usuarios
        $sql = "INSERT INTO usuario (id_rol, username, password, correo)
                VALUES ($id_rol, '$usuario', '$contrasena', '$correo')";

        $stmt = $conn->prepare($sql);

        // Puedes asignar un rol por defecto o obtenerlo de alguna manera // Por ejemplo, asignando el rol con id 1


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
