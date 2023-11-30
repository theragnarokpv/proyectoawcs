<?php
    include "include/functions/conexion.php";
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tecno-Stream</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">


    <link rel="stylesheet" href="js/jquery-ui-1.12.1/jquery-ui.css">
</head>
<body>
    <?php
        include "include/Templates/header.php";
        include "include/Templates/navadmin.php";
    ?>

    <section class="main-content">
        <div class="container">

            <div class="row">
                <div class="col-md-3">
                    <button type='button' id="boton_agregar" class='btn btn_carrito' data-bs-toggle='modal' data-bs-target='#agregarproducto'> Agregar Producto</button>
                </div>

    
                <div ID="pnlMensaje" title="Error" style="display:none">
                    <div>
                        <strong>Atención!</strong> Se ha presentado el siguiente problema.
                        <br />
                        <br />
                        <p ID="blMensajes"></p>
                    </div>
                </div>
                <div ID="pnlInfo" title="Mensaje" style="display : none;">
                    <div>
                        <strong>Información!</strong> Procesamiento éxitoso.
                        <br />
                        <br />
                        <p ID="blInfo"></p>
                    </div>
                </div>
                <?php 

                    $resultado = $conn -> query("SELECT producto.id_producto, producto.id_categoria, categoria.descripcion AS categorias, producto.descripcion AS nombre_producto, producto.detalle, producto.precio, producto.existencias, producto.ruta_imagen
                    FROM producto
                    INNER JOIN categoria ON producto.id_categoria = categoria.id_categoria
                    ORDER BY producto.id_producto");


                    $datos = $resultado->fetch_assoc();

                    echo "<table class='table table-striped table-hover'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th scope='col'>#</th>";
                                echo "<th scope='col'>Categoria</th>";
                                echo "<th scope='col'>Descripcion</th>";
                                echo "<th scope='col'>Detalle</th>";
                                echo "<th scope='col'>Precio</th>";
                                echo "<th scope='col'>Existencias</th>";
                                echo "<th scope='col'>Botones</th>";
                            echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                            echo "<tr>";
                            while ($datos != null){
                                echo "<th scope='row'>$datos[id_producto]</th>";
                                echo "<td>$datos[categorias]</td>";
                                echo "<td>$datos[nombre_producto]</td>";
                                echo "<td>$datos[detalle]</td>";
                                echo "<td>$datos[precio]</td>";
                                echo "<td>$datos[existencias]</td>";
                                echo "<td><button type='button' class='btn btn_carrito' data-bs-toggle='modal' data-bs-target='#exampleModal' 
                                        data-id='$datos[id_producto]' data-id-categoria='$datos[id_categoria]' data-categoria='$datos[categorias]' data-descripcion='$datos[nombre_producto]' data-detalle='$datos[detalle]' data-precio='$datos[precio]' data-existencias='$datos[existencias]' data-imagen='$datos[ruta_imagen]'> Modificar </button>
                                        <a href='include/functions/producto_eliminar.php?producto=$datos[id_producto]'><button class='btn_carrito'> Eliminar </button></a>";
                                            echo "</tr>";


                                $datos = $resultado->fetch_assoc();
                            } 
                    echo "</table>";
                ?>
            </div>

            <!-- Modal para agregar producto -->
            <div class="modal fade" id="agregarproducto" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formAgregarProducto">
                                <div class="mb-3">
                                    <label for="agregar_categoria" class="form-label">Categoría:</label>
                                    <select class="form-select" id="agregar_categoria" name="agregar_categoria">
                                        <!-- Opciones de categorías se llenarán dinámicamente con JavaScript -->
                                    </select>
                                    <input type="hidden" id="agregar_id_categoria" name="agregar_id_categoria">
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_descripcion" class="form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="agregar_descripcion" name="agregar_descripcion">
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_detalle" class="form-label">Detalle:</label>
                                    <textarea class="form-control" id="agregar_detalle" name="agregar_detalle"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_precio" class="form-label">Precio:</label>
                                    <input type="text" class="form-control" id="agregar_precio" name="agregar_precio">
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_existencias" class="form-label">Existencias:</label>
                                    <input type="textarea" class="form-control" id="agregar_existencias" name="agregar_existencias">
                                </div>
                                <div class="mb-3">
                                    <label for="existencias" class="form-label">Imagen:</label>
                                    <img src="" alt="Imagen del Producto" id="agregar_imagen" class="img-fluid">
                                    <input type="file" name="agregar_imagen" id="agregar_imagen">
                                </div>
                                <!-- Agrega más campos según tus necesidades -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarProducto()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para modificar un producto-->
            <div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formModificarProducto">
                                <div class="mb-3">
                                    <label for="id_producto" class="form-label">ID Producto:</label>
                                    <input type="text" class="form-control" id="id_producto" name="id_producto" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="categoria" class="form-label">Categoría:</label>
                                    <select class="form-select" id="categoria" name="categoria">
                                        <!-- Opciones de categorías se llenarán dinámicamente con JavaScript -->
                                    </select>
                                    <input type="hidden" id="id_categoria" name="id_categoria">
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion" class="form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="descripcion" name="descripcion">
                                </div>
                                <div class="mb-3">
                                    <label for="detalle" class="form-label">Detalle:</label>
                                    <textarea class="form-control" id="detalle" name="detalle"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="precio" class="form-label">Precio:</label>
                                    <input type="text" class="form-control" id="precio" name="precio">
                                </div>
                                <div class="mb-3">
                                    <label for="existencias" class="form-label">Existencias:</label>
                                    <input type="textarea" class="form-control" id="existencias" name="existencias">
                                </div>
                                <div class="mb-3">
                                    <label for="existencias" class="form-label">Imagen:</label>
                                    <img src="" alt="Imagen del Producto" id="imagen" class="img-fluid">
                                    <input type="file" name="imagen" id="imagen">
                                </div>
                                <!-- Agrega más campos según tus necesidades -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarCambios()">Guardar cambios</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/modal_productos.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
    
</body>
</html>