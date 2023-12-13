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
    <title>Tecno-Stream</title>
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
                <form action="">

                <?php

                    $resultado = $conn -> query("SELECT * FROM usuario WHERE id_usuario = $id_usuario");

                    $datos = $resultado->fetch_assoc();
                    echo "<div class='row'>";
                        echo "<div class='col-md-7 justify-content-center' id='avatar_usuario'>";
                            echo "<div id='grupo_imagen'>";
                                echo "<img id='usuario_imagen' src='{$datos['ruta_imagen']}' alt='' class='profile-img'>";
                                echo "<input type='file' name='imagen' id='modif_imagen_perfil'>";
                            echo "</div>";
                            echo "<input type='text' class='perfil-input' id='input-usuario' name='username' value='{$datos['username']}' required>";
                        echo "</div>";
                        echo "<div class='col-md-5'>";
                        echo "</div>";
                    echo "</div>";

                    echo "<div class='row'>";
                        echo "<div class='col-md-2'></div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>Nombre:</div>";
                            echo "<input type='text' class='perfil-input' id='input-nombre' name='nombre' value='{$datos['nombre']}' required>";
                        echo "</div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>Apellidos:</div>";
                            echo "<input type='text' class='perfil-input' id='input-apellidos' name='apellidos' value='{$datos['apellidos']}' required>";
                        echo "</div>";
                        echo "<div class='col-md-2'></div>";
                    echo "</div>";

                    echo "<div class='row'>";
                        echo "<div class='col-md-2'></div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>telefono:</div>";
                            echo "<input type='text' class='perfil-input' id='input-telefono' name='telefono' value='{$datos['telefono']}' >";
                        echo "</div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>Correo Electronico:</div>";
                            echo "<input type='text' class='perfil-input' id='input-correo' name='correo' value='{$datos['correo']}' required>";
                        echo "</div>";
                        echo "<div class='col-md-2'></div>";
                    echo "</div>";

                    echo "<div class='row'>";
                        echo "<div class='col-md-2'></div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>Contraseña Anterior:</div>";
                            echo "<input type='text' class='perfil-input' id='input-viejacontra' name='viejacontra'  required>";
                        echo "</div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>Nueva Contraseña:</div>";
                            echo "<input type='text' class='perfil-input' id='input-nuevacontra' name='nuevacontra' required>";
                        echo "</div>";
                        echo "<div class='col-md-2'></div>";
                    echo "</div>";

                    echo "<div class='row'>";
                        echo "<div class='col-md-2'></div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<div class='tituloperfil'>Confirmar Nueva Contraseña:</div>";
                            echo "<input type='text' class='perfil-input' id='input-nueva_contra' name='nueva_contra'  required>";
                        echo "</div>";
                        echo "<div class='col-md-4 text-center'>";
                            echo "<a href='editarperfil.php' id='btn_confirmar' class='btn btn_carrito'>Confirmar</a>";
                        echo "</div>";
                        echo "<div class='col-md-2'></div>";
                    echo "</div>";
                ?>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="js/jquery-3.7.1.js"></script>
    <script src="js/editar_perfil.js"></script>
    <script src="js/jquery-ui-1.12.1/jquery-ui.js"></script>

</body>

</html>