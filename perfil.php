<?php
    include "include/functions/conexion.php";
    session_start();

    $id_usuario = $_SESSION['id_usuario'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Valhalla</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">
</head>

<body>
    <?php 
        include "include/Templates/header.php"; 

        $resultado = $conn -> query("SELECT * FROM usuario WHERE id_usuario = $id_usuario");

        $datos = $resultado->fetch_assoc();
    
    
    ?>
        <div class="container-fluid">
            <div class="row text-center">
                <div id="tit">
                    <div>PERFIL</div>
                </div>
            </div>

            <div id="perfil_datos" class="row">

            <?php

                $resultado = $conn -> query("SELECT * FROM usuario WHERE id_usuario = $id_usuario");

                $datos = $resultado->fetch_assoc();
                echo "<div class='row'>";
                    echo "<div class='col-md-6 justify-content-center' id='avatar_usuario'>";
                        echo "<img src='{$datos['ruta_imagen']}' alt='' class='profile-img'>";
                        echo "<div class='datosperfil' id='usuario'> {$datos['username']}</div>";
                    echo "</div>";
                    echo "<div class='col-md-6'>";
                    echo "</div>";
                echo "</div";

                echo "<div class='row'>";
                    echo "<div class='col-md-2'></div>";
                    echo "<div class='col-md-4 text-center'>";
                        echo "<div class='tituloperfil'>Nombre:</div>";
                        echo "<div class='datosperfil'> {$datos['nombre']}</div>";
                    echo "</div>";
                    echo "<div class='col-md-4 text-center'>";
                        echo "<div class='tituloperfil'>Apellidos:</div>";
                        echo "<div class='datosperfil'> {$datos['apellidos']} </div>";
                    echo "</div>";
                    echo "<div class='col-md-2'></div>";
                echo "</div";

                echo "<div class='row'>";
                    echo "<div class='col-md-2'></div>";
                    echo "<div class='col-md-4 text-center'>";
                        echo "<div class='tituloperfil'>Telefono:</div>";
                        echo "<div class='datosperfil'> {$datos['telefono']} </div>";
                    echo "</div>";
                    echo "<div class='col-md-4 text-center'>";
                        echo "<div class='tituloperfil'>Correo Electronico:</div>";
                        echo "<div class='datosperfil'> {$datos['correo']} </div>";
                    echo "</div>";
                    echo "<div class='col-md-2'></div>";
                echo "</div";

                echo "<div class='row'>";
                    echo "<div class='col-md-12 text-center'>";
                        echo "<a href='editarperfil.php' class='btn btn_carrito mt-3'>Editar</a>";
                    echo"</div>";
                echo "</div";
            ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>