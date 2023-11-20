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
                <?php 

                    $resultado = $conn -> query("SELECT usuario.id_usuario, rol.nombre AS rol, usuario.username, usuario.correo
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
                                echo "<td><a href='inicioSesion.php'><button class='btn_carrito'> Modificar </button></a>
                                        <a href='inicioSesion.php'><button class='btn_carrito'> Eliminar </button></a>";
                                            echo "</tr>";


                                $datos = $resultado->fetch_assoc();
                            } 
                    echo "</table>";
                ?>
            </div>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>