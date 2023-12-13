<?php
include "conexion.php";

// Verificar si se recibieron datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $descripcion = $_POST["descripcion"];

    $archivo_nombre = $_FILES['ruta_imagen']['name'];
    $archivo_tmp = $_FILES['ruta_imagen']['tmp_name'];
    $archivo_tipo = $_FILES['ruta_imagen']['type'];

    /* VERIFICACION DE DATOS */
    $descripcionOk = false;

    if ($descripcion == "") {
        print "<p class=\¨aviso\"> No ha escrito el nombre para la categoria. </p>\n";
        print "\n";
    } else {
        $descripcionOk = true;
    }

    if($descripcion){
        $permitidos = array('image/jpeg', 'image/jpg', 'image/png');
        if (in_array($archivo_tipo, $permitidos)) {
            $carpeta_destino = '../../server/categorias/';
            $archivo_destino = $carpeta_destino . $archivo_nombre;
            move_uploaded_file($archivo_tmp, $archivo_destino);
    
    
            $ruta_guardar_bd = str_replace('../../server', '/ambiente/server', $archivo_destino);
    
            $sql = "INSERT INTO categoria (descripcion, ruta_imagen)
            VALUES (?, ?)";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bind_param("ss",  $descripcion, $ruta_guardar_bd);
    
            try {
                $stmt->execute();
                $response = ['status' => 'success', 'message' => 'Categoria agregada con éxito'];
            } catch (PDOException $e) {
                $response = ['status' => 'error', 'message' => 'Error al actualizar la categoria: ' . $e->getMessage()];
            }
        } else {
            echo "Formato de archivo no permitido. Sube una imagen en formato JPEG, JPG o PNG.";
        }
        echo json_encode($response);

    }
} else {
    // Si la solicitud no es de tipo POST, devolver un error
    $response = ['status' => 'error', 'message' => 'Método no permitido'];
    echo json_encode($response);
}
?>