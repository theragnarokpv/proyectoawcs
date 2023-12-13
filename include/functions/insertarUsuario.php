<?php
    include "conexion.php"; // Asegúrate de tener la ruta correcta al archivo de conexión

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $id_rol = 3;
        $usuario = $_POST["usuario"];
        $nombre = $_POST["nombre"];
        $apellidos = $_POST["apellidos"];
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];
        $confirmarContra = $_POST["confirmarContrasena"];

        $telefono = $_POST["telefono"];


        /* VERIFICAR DE DATOS */
        $usuarioOk = false;
        $nombreOk = false;
        $apellidosOk = false;
        $correoOk = false;
        $contrasenaOk = true;

        if ($usuario == ""){
            print "<p class=\¨aviso\"> No ha escrito un usuario valido. </p>\n";
            print "\n";
        } else {
            $usuarioOk = true;
        }

        if ($nombre == ""){
            print "<p class=\¨aviso\"> No ha escrito un nombre </p>\n";
            print "\n";
        } else {
            $nombreOk = true;
        }

        if ($apellidos == ""){
            print "<p class=\¨aviso\"> No ha escrito el o los apellidos</p>\n";
            print "\n";
        } else {
            $apellidosOk = true;
        }

        if ($correo == ""){
            print "<p class=\¨aviso\"> No ha escrito un correo electronico </p>\n";
            print "\n";
        } else {
            $correoOk = true;
        }

        // if ($contrasena == "" or $confirmarContra == ""){
        //     print "<p class=\¨aviso\"> No ha escrito contraseñas </p>\n";
        //     print "\n";
        // } elseif ($contrasena !== $confirmarContra ) {
        //     print "<p class=\¨aviso\"> El dato de la categoria no es válido. </p>\n";
        //     print "\n";
        // }else {
        //     $contrasenaoOk = true;
        // }


        if ($usuarioOk && $nombreOk && $apellidosOk && $correoOk && $contrasenaOk) {
            $contrasenaEncripta = password_hash($contrasena, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuario (id_rol, username, password, nombre, apellidos, correo, telefono)
                    VALUES ($id_rol, '$usuario', '$contrasenaEncripta', '$nombre', '$apellidos', '$correo', '$telefono')";
    
            $stmt = $conn->prepare($sql);
    
    
            // Ejecutar la consulta
            if ($stmt->execute()) {
                $response = ['status' => 'success', 'message' => 'Usuario actualizado con éxito'];
                exit();
            } else {
                $response = ['status' => 'error', 'message' => 'Error al actualizar el usuario: ' . $e->getMessage()];
            }
    
    
            // Redirige de vuelta a la página de referencia
        }

    }
?>
