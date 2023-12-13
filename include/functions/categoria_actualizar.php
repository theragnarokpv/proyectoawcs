<?php
include "conexion.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_categoria = $_POST["id_categoria"];
    $descripcion = $_POST["descripcion"];

    $archivo_nombre = $_FILES['ruta_imagen']['name'];
    $archivo_tmp = $_FILES['ruta_imagen']['tmp_name'];
    $archivo_tipo = $_FILES['ruta_imagen']['type'];


    /* VERIFICACION DE DATOS */
    $idCategoriaOk = false;
    $descripcionOk = false;

    if ($id_categoria == "") {
        print "<p class=\¨aviso\"> No se ha enviado una categoria necesaria. </p>\n";
        print "\n";
    } elseif (!is_numeric($id_categoria)) {
        print "<p class=\¨aviso\"> El dato de la categoria no es válido. </p>\n";
        print "\n";
    } else {
        $idCategoriaOk = true;
    }

    if ($descripcion == "") {
        print "<p class=\¨aviso\"> No ha escrito nombre para la categoria. </p>\n";
        print "\n";
    } else {
        $descripcionOk = true;
    }

    if($idCategoriaOk && $descripcion){
        $permitidos = array('image/jpeg', 'image/jpg', 'image/png');
        if (in_array($archivo_tipo, $permitidos)) {
            $carpeta_destino = '../../server/categorias/';
            $archivo_destino = $carpeta_destino . $archivo_nombre;
            move_uploaded_file($archivo_tmp, $archivo_destino);
    
    
            $ruta_guardar_bd = str_replace('../../server', '/ambiente/server', $archivo_destino);
    
            $sql = "UPDATE categoria SET
            descripcion = ?,
            ruta_imagen = ?
            WHERE id_categoria = ?";

            $stmt = $conn->prepare($sql);

            $stmt->bind_param("ssi", $descripcion, $ruta_guardar_bd,  $id_categoria);

            try {
                $stmt->execute();
                $response = ['status' => 'success', 'message' => 'Categoria actualizada con éxito'];
            } catch (PDOException $e) {
                $response = ['status' => 'error', 'message' => 'Error al actualizar la categoria: ' . $e->getMessage()];
            }
        } else {
            echo "Formato de archivo no permitido. Sube una imagen en formato JPEG, JPG o PNG.";
        }
        echo json_encode($response);

    }
} else {
    $response = ['status' => 'error', 'message' => 'Método no permitido'];
    echo json_encode($response);
}
?>