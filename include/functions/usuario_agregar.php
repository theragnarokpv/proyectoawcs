<?php
    include "conexion.php"; // Asegúrate de tener la ruta correcta al archivo de conexión

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir datos del formulario
        $id_rol = 3;
        $usuario = $_POST["username"];
        $correo = $_POST["correo"];
        $contrasena = password_hash($_POST["contra"], PASSWORD_DEFAULT);
        

        $usuarioOk = false;
        $correoOk = false;
        $contrasenaOk = false;

        if ($usuario == "") {
            print "<p class=\¨aviso\"> No ha escrito un usuario. </p>\n";
            print "\n";
        } else {
            $usuarioOk = true;
        }

        if ($correo == "") {
            print "<p class=\¨aviso\"> No ha un correo. </p>\n";
            print "\n";
        } else {
            $correoOk = true;
        }

        if ($contrasena == "") {
            print "<p class=\¨aviso\"> No ha un correo. </p>\n";
            print "\n";
        } else {
            $contrasenaOk = true;
        }

        if($usuarioOk && $correoOk && $contrasenaOk){
                $sql = "INSERT INTO usuario (id_rol, username, password, correo)
                VALUES ($id_rol, '$usuario', '$contrasena', '$correo')";

                try {
                    $stmt->execute();
                    $response = ['status' => 'success', 'message' => 'Usuario Agregado con éxito'];
                } catch (PDOException $e) {
                    $response = ['status' => 'error', 'message' => 'Error al agregar al usuario: ' . $e->getMessage()];
                }

            echo json_encode($response);
        }
    } else {
        $response = ['status' => 'error', 'message' => 'Método no permitido'];
        echo json_encode($response);
    }
?>
