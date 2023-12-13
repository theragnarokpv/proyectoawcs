<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_categoria = $_POST["id_categoria"];
    $descripcion = $_POST["descripcion"];
    $detalle = $_POST["detalle"];
    $precio = $_POST["precio"];
    $existencias = $_POST["existencias"];


    $archivo_nombre = $_FILES['ruta_imagen']['name'];
    $archivo_tmp = $_FILES['ruta_imagen']['tmp_name'];
    $archivo_tipo = $_FILES['ruta_imagen']['type'];

    /* VERIFICACION DE DATOS */
    $idCategoriaOk = false;
    $descripcionOk = false;
    $detalleOk = false;
    $precioOk = false;
    $existenciasOk = false;


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
        print "<p class=\¨aviso\"> No ha escrito el nombre para el producto. </p>\n";
        print "\n";
    } else {
        $descripcionOk = true;
    }


    if ($detalle == "") {
        print "<p class=\¨aviso\"> No ha escrito el detalle del producto. </p>\n";
        print "\n";
    } else {
        $detalleOk = true;
    }


    if ($precio == "") {
        print "<p class=\¨aviso\"> No se ha colocado un precio. </p>\n";
        print "\n";
    } else {
        $precioOk = true;
    }

    if ($existencias == "") {
        print "<p class=\¨aviso\"> No se ha enviado un numero de existencias. </p>\n";
        print "\n";
    } elseif (!is_numeric($existencias)) {
        print "<p class=\¨aviso\"> El numero de existencias no es válido. </p>\n";
        print "\n";
    } else {
        $existenciasOk = true;
    }

    if($idCategoriaOk && $descripcionOk && $detalleOk && $precioOk && $existenciasOk){
        $permitidos = array('image/jpeg', 'image/jpg', 'image/png');
        if (in_array($archivo_tipo, $permitidos)) {
            $carpeta_destino = '../../server/productos/';
            $archivo_destino = $carpeta_destino . $archivo_nombre;
            move_uploaded_file($archivo_tmp, $archivo_destino);
    
    
            $ruta_guardar_bd = str_replace('../../server', '/ambiente/server', $archivo_destino);
    
            $sql = "INSERT INTO producto(id_categoria, descripcion, detalle, precio, existencias, ruta_imagen)
                VALUES (?, ?, ?, ?, ?, ?)";
    
            $stmt = $conn->prepare($sql);
    
            $stmt->bind_param("issdis", $id_categoria, $descripcion, $detalle, $precio, $existencias, $ruta_guardar_bd);
    
            try {
                $stmt->execute();
                $response = ['status' => 'success', 'message' => 'Producto actualizado con éxito'];
            } catch (PDOException $e) {
                $response = ['status' => 'error', 'message' => 'Error al actualizar el producto: ' . $e->getMessage()];
            }
        } else {
            echo "Formato de archivo no permitido. Sube una imagen en formato JPEG, JPG o PNG.";
        }
    
        // Devolver la respuesta al cliente (JavaScript)
        echo json_encode($response);
    }
} else {
    // Si la solicitud no es de tipo POST, devolver un error
    $response = ['status' => 'error', 'message' => 'Método no permitido'];
    echo json_encode($response);
}
?>