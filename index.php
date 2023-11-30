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
        include "include/Templates/nav.php";
    ?>

    <div class="btn-mas">
        <button type='button' id="boton_buscar" class='btn' data-bs-toggle='modal' data-bs-target='#filtrarproductos'><img src="img/buscar.png" alt="Busqueda" class="other-logo"></button>
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

    <section class="main-content">
        <div class="container">
            <div class="row">
                <?php 
                    if (isset($_GET['idcat'])) {
                        $id = $_GET['idcat'];

                        $resultado = $conn -> query("SELECT * FROM producto where id_categoria = $id");
                    } else {
                        $resultado = $conn -> query("SELECT * FROM producto");
                    }

                    $datos = $resultado->fetch_assoc();
                    
                    if (isset($_GET['idcat'])) {
                        $id = $_GET['idcat'];

                        $datoCat = $conn -> query("SELECT descripcion FROM categoria where id_categoria = $id");
                        $titcat = $datoCat->fetch_assoc();

                        echo "<div id='tit_carrito'>";
                        echo    "{$titcat['descripcion']}";
                        echo"</div>";
                    }

                    while ($datos != null){
                        echo "<div class='col-md-3'>";
                            echo "<div class='product'>";
                                echo "<a href='producto.php?codigo={$datos['id_producto']}' class='product-link'><img src='{$datos['ruta_imagen']}' alt='{$datos['descripcion']}' class='product-image'></a>";
                                echo "<h3 class='product-name'>{$datos['descripcion']}</h3>";
                                echo "<h3 class='product-price'>₡ {$datos['precio']}</h3>";
                                echo"<a href='include/functions/agregarCarrito.php?codigo={$datos['id_producto']}'><button class='btn_compra' ><i class='bi bi-cart-plus-fill'></i>AÑADIR</button></a>";
                            echo"</div>";
                        echo"</div>";

                        $datos = $resultado->fetch_assoc();
                    }
                
                ?>
            </div>
        </div>
    </section>

    <!-- Modal para agregar categoria -->
    <div class="modal fade" id="filtrarproductos" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Buscar Producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formFiltrarProducto">
                        <div class="mb-3">
                            <label for="filtrar_precio_minimo" class="form-label">Precio Minimo:</label>
                            <input type="text" class="form-control" id="filtrar_precio_minimo" name="filtrar_precio_minimo">
                        </div>
                        <div class="mb-3">
                            <label for="filtrar_precio_maximo" class="form-label">Precio Maximo:</label>
                            <input type="text" class="form-control" id="filtrar_precio_maximo" name="filtrar_precio_maximo">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_producto" class="form-label">Descripcion producto:</label>
                            <input type="text" class="form-control" id="descripcion_producto" name="descripcion_producto">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" id="buscarProductos">Buscar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/filtrar.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>
</body>
</html>