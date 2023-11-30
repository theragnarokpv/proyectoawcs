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
            <div class="row">
                <div class="col-md-4">
                    <button type='button' id="boton_agregar" class='btn btn_carrito' data-bs-toggle='modal' data-bs-target='#agregarusuario'> Agregar Usuario </button>
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

                    $resultado = $conn -> query("SELECT usuario.id_usuario, usuario.id_rol, rol.nombre AS rol, usuario.username, usuario.password, usuario.nombre, usuario.apellidos, usuario.correo, usuario.telefono, usuario.ruta_imagen
                    FROM usuario
                    INNER JOIN rol ON usuario.id_rol = rol.id_rol");


                    $datos = $resultado->fetch_assoc();

                    echo "<table class='table table-striped table-hover'>";
                        echo "<thead>";
                            echo "<tr>";
                                echo "<th scope='col'>#</th>";
                                echo "<th scope='col'>Rol</th>";
                                echo "<th scope='col'>Usuario</th>";
                                echo "<th scope='col'>correo</th>";
                                echo "<th scope='col'>Botones</th>";
                            echo "</tr>";
                        echo "</thead>";

                        echo "<tbody>";
                            echo "<tr>";
                            while ($datos != null){
                                echo "<th scope='row'>$datos[id_usuario]</th>";
                                echo "<td>$datos[rol]</td>";
                                echo "<td>$datos[username]</td>";
                                echo "<td>$datos[correo]</td>";
                                echo "<td><button type='button' class='btn btn_carrito' data-bs-toggle='modal' data-bs-target='#modificarusuario' 
                                data-id='$datos[id_usuario]' data-id-rol='$datos[id_rol]' data-rol'$datos[rol]' 
                                data-username='$datos[username]' data-password='$datos[password]' data-nombre='$datos[nombre]' 
                                data-apellidos='$datos[apellidos]' data-correo='$datos[correo]' data-telefono='$datos[telefono]' data-imagen='$datos[ruta_imagen]'> Modificar </button>
                                        <a href='include/functions/usuario_eliminar.php?usuario=$datos[id_usuario]'><button class='btn_carrito'> Eliminar </button></a>";
                                echo "</tr>";


                                $datos = $resultado->fetch_assoc();
                            } 
                    echo "</table>";
                ?>
            </div>

            <!-- Modal para agregar producto -->
            <div class="modal fade" id="agregarusuario" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formAgregarUsuario">
                                <div class="mb-3">
                                    <label for="agregar_username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="agregar_username" name="agregar_descripcion">
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_contra" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="agregar_contra" name="agregar_contra">
                                </div>
                                <div class="mb-3">
                                    <label for="agregar_correo" class="form-label">Correo:</label>
                                    <input type="email" class="form-control" id="agregar_correo" name="agregar_correo">
                                </div>
                                <!-- Agrega más campos según tus necesidades -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="guardarUsuario()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para mmodificar usuarios -->
            <div class="modal fade" id="modificarusuario" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Producto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formmodifUsuario">
                                <div class="mb-3">
                                    <label for="modif_id_usuario" class="form-label">ID Usuario:</label>
                                    <input type="text" class="form-control" id="modif_id_usuario" name="modif_id_usuario" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="modif_rol" class="form-label">Roles:</label>
                                    <select class="form-select" id="modif_rol" name="modif_rol">
                                        <!-- Opciones de categorías se llenarán dinámicamente con JavaScript -->
                                    </select>
                                    <input type="hidden" id="modif_id_rol" name="modif_id_rol">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="modif_username" name="modif_username">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_contra" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="modif_contra" name="modif_contra">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_nombre" class="form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="modif_nombre" name="modif_nombre">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_apellidos" class="form-label">Apellidos:</label>
                                    <input type="text" class="form-control" id="modif_apellidos" name="modif_apellidos">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_correo" class="form-label">Correo:</label>
                                    <input type="email" class="form-control" id="modif_correo" name="modif_correo">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_telefono" class="form-label">Telefono:</label>
                                    <input type="text" class="form-control" id="modif_telefono" name="modif_telefono">
                                </div>
                                <div class="mb-3">
                                    <label for="modif_imagen" class="form-label">Imagen:</label>
                                    <img src="" alt="Imagen del Producto" id="modif_imagen" class="img-fluid">
                                    <input type="file" name="modif_imagen" id="modif_subir_imagen">
                                </div>
                                <!-- Agrega más campos según tus necesidades -->
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" onclick="modificarUsuario()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/modal_usuarios.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>
</html>