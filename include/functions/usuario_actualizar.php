<?php
include "conexion.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST["id_usuario"];
    $id_rol = $_POST["id_rol"];
    $username = $_POST["username"];
    $contrasena = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    $archivo_nombre = $_FILES['ruta_imagen']['name'];
    $archivo_tmp = $_FILES['ruta_imagen']['tmp_name'];
    $archivo_tipo = $_FILES['ruta_imagen']['type'];

    $idUsuarioOk = false;
    $idRolOk = false;
    $usernameOk = false;
    $contrasenaOk = false;
    $nombreOk = false;
    $apellidosOk = false;
    $correoOk = false;
    $telefonoOk = false;

    if ($id_usuario == "") {
        print "<p class=\¨aviso\"> No se ha enviado un id de usuario. </p>\n";
        print "\n";
    } elseif (!is_numeric($id_usuario)) {
        print "<p class=\¨aviso\"> El id del usuario no es válido. </p>\n";
        print "\n";
    } else {
        $idUsuarioOk = true;
    }

    if ($id_rol == "") {
        print "<p class=\¨aviso\"> No se ha enviado un id de rol. </p>\n";
        print "\n";
    } elseif (!is_numeric($id_rol)) {
        print "<p class=\¨aviso\"> El id del rol no es válido. </p>\n";
        print "\n";
    } else {
        $idRolOk = true;
    }

    if ($username == "") {
        print "<p class=\¨aviso\"> No ha escrito un username. </p>\n";
        print "\n";
    } else {
        $usernameOk = true;
    }

    if ($contrasena == "") {
        print "<p class=\¨aviso\"> No ha escrito una contraseña. </p>\n";
        print "\n";
    } else {
        $contrasenaOk = true;
    }

    if ($correo == "") {
        print "<p class=\¨aviso\"> No ha escrito un correo. </p>\n";
        print "\n";
    } else {
        $correoOk = true;
    }

    if($idUsuarioOk && $idRolOk && $usernameOk && $contrasenaOk && $correoOk){
        if (!empty($archivo_nombre)) {
            // Se ha seleccionado un nuevo archivo
            $permitidos = array('image/jpeg', 'image/jpg', 'image/png');
            if (in_array($archivo_tipo, $permitidos)) {
                $carpeta_destino = '../../server/usuarios/';
                $archivo_destino = $carpeta_destino . $archivo_nombre;
                move_uploaded_file($archivo_tmp, $archivo_destino);
                $ruta_guardar_bd = str_replace('../../server', '/ambiente/server', $archivo_destino);
            } else {
                echo "Formato de archivo no permitido. Sube una imagen en formato JPEG, JPG o PNG.";
                exit;
            }
        } else {
            // No se seleccionó un nuevo archivo, mantener la ruta anterior
            $ruta_guardar_bd = $_POST['ruta_imagen_actual'];
        }

    
            $sql = "UPDATE usuario SET
            id_rol = ?,
            username = ?,
            password = ?,
            nombre = ?,
            apellidos = ?,
            correo = ?,
            telefono = ?,
            ruta_imagen = ?
            WHERE id_usuario = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("isssssssi", $id_rol, $username, $password, $nombre, $apellidos, $correo, $telefono, $ruta_guardar_bd, $id_usuario);

            try {
                $stmt->execute();
                $response = ['status' => 'success', 'message' => 'Usuario actualizado con éxito'];
            } catch (PDOException $e) {
                $response = ['status' => 'error', 'message' => 'Error al actualizar el usuario: ' . $e->getMessage()];
            }

            // Devolver la respuesta al cliente (JavaScript)
            echo json_encode($response);


    }
} else {
    $response = ['status' => 'error', 'message' => 'Método no permitido'];
    echo json_encode($response);
}
?>