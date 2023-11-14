<?php
    include "include/functions/conexion.php"
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

    <section class="main-content">
        <div class="container">
            <div class="row">
                <?php 
                    $resultado = $conn -> query("SELECT * FROM producto WHERE id_categoria = 1");

                    $datos = $resultado->fetch_assoc();

                    while ($datos != null){
                        echo "<div class='col-md-3'>";
                            echo "<div class='product'>";
                                echo "<a href='#' class='product-link'><img src='{$datos['ruta_imagen']}' alt='{$datos['descripcion']}' class='product-image'></a>";
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
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>