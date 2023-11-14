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
    ?>

    <div id="tit_carrito">
        CARRITO DE COMRPRAS
    </div>

    <div class="container">
        <?php
            echo "<div id='datos_prod'>";
                if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                    $total = 0;
                    foreach ($_SESSION['carrito'] as $codigo => $producto) {
                        $subtotal = $producto['precio'] * $producto['cantidad'];
                         $total += $subtotal;

                        echo "<div class='tarj_cuerpo'>";
                            echo "<div class='img_prod'>";
                                echo "<img src='{$producto['ruta_imagen']}' alt=''>";
                            echo "</div>";

                            echo "<div class='tarj_info'>";
                                echo "<div class='nom_prod'>{$producto['descripcion']}</div>";
                                
                                echo "<div class='tarj_precio'>";
                                    echo "<div class='precio_prod'>₡ {$producto['precio']}</div>";
                                    echo "<div class='cant_prod'>x {$producto['cantidad']}</div>";
                                echo "</div>";
                            echo "</div>";

                            echo "<div class='eliminar_prod'>";
                                echo "<a href='include/functions/eliminarProducto.php?codigo={$codigo}'><button type='button' class='btn btn-danger'><i class='bi bi-x-circle-fill' id='circle_x'></i></button></a>";
                            echo "</div>";
                        echo "</div>";

                    }

                } else {
                    echo "<p class='total_pagar'>El carrito está vacío.</p>";
                }
            echo "</div>";


            echo "<div id='precio_total'>";
                echo "<div id='cuadro_precio'>";
                    echo "<div id='tit_precio'>";
                        echo "Total a pagar";
                    echo "</div>";

                    echo "<div class='total'>";
                        echo "₡ $total";
                    echo "</div>";
                echo "</div>";

                echo "<div id='btn_opciones'>";
                    echo "<div class='limpiar>";
                        echo "<a href='#'><button class='btn_carrito' >Limpiar historial</button></a>";
                    echo "</div>";

                    echo "<div class='terminar'>";
                        echo "<a href='#'><button class='btn_carrito' >Terminar Proceso</button></a>";
                    echo "</div>";
                
                echo "</div>";

            echo "</div>";
        ?>

    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>