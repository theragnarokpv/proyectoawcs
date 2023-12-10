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
</head>
<body>
    <?php
        include "include/Templates/header.php";
        include "include/Templates/navadmin.php";
    ?>

    <section class="main-content">
        <div class="container">
            <div class="row adaco">
                <div class="col-md-4">
                    <button type='button' id="boton_agregar" class='btn btn_carrito' data-bs-toggle='modal' data-bs-target='#agregarcategoria'> Agregar Categoria</button>
                </div>

                <?php 

                    $resultado = $conn -> query("SELECT id_categoria, descripcion, ruta_imagen
                    FROM categoria ORDER BY id_categoria");


                    $datos = $resultado->fetch_assoc();

                    echo "<table class='table  table-striped table-hover'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th scope='col'>#</th>";
                                echo "<th scope='col'>Descripcion</th>";
                                echo "<th scope='col'>Imagenes</th>";
                                echo "<th scope='col'>Botones</th>";
                            echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                            echo "<tr>";
                            while ($datos != null){
                                echo "<th scope='row'>$datos[id_categoria]</th>";
                                echo "<td>$datos[descripcion]</td>";
                                echo "<td class='catimg_adm'> <img src='$datos[ruta_imagen]' alt=''></td>";
                                echo "<td><button type='button' class='btn btn_carrito' data-bs-toggle='modal' data-bs-target='#modificarcategoria' 
                                data-id='$datos[id_categoria]' data-descripcion='$datos[descripcion]' data-imagen='$datos[ruta_imagen]'> Modificar </button>
                                        <a href='include/functions/categoria_eliminar.php?cat=$datos[id_categoria]'><button class='btn_carrito'> Eliminar </button></a>";
                                            echo "</tr>";


                                $datos = $resultado->fetch_assoc();
                            } 
                    echo "</table>";
                ?>
            </div>

            <!-- Modal para agregar categoria -->
            <div class="modal fade" id="agregarcategoria" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formAgregarCategoria">
                                <div class="mb-3">
                                    <label for="agregar_descripcion" class="form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="agregar_descripcion" name="agregar_descripcion">
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_imagen" class="form-label">Imagen:</label>
                                    <img src="" alt="Imagen del Producto" id="agregar_imagen" class="img-fluid">
                                    <input type="file" name="agregar__imagen" id="agregar_imagen">
                                </div>
                                
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarCategoria()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para modificar categoria-->
            <div class="modal fade" id="modificarcategoria" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Categoria</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formModificarCategoria">
                                <div class="mb-3">
                                    <label for="modif_id_categoria" class="form-label">ID Categoria:</label>
                                    <input type="text" class="form-control" id="modif_id_categoria" name="modif_id_categoria" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="modif_descripcion" class="form-label">Descripción:</label>
                                    <input type="text" class="form-control" id="modif_descripcion" name="modif_descripcion">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_imagen" class="form-label">Imagen:</label>
                                    <img src="" alt="Imagen del Producto" id="modif_imagen" class="img-fluid">
                                    <input type="file" name="modif_imagen" id="modif_imagen">
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
    <script src="js/modal_categorias.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>
</html>