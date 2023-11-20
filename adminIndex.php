<?php
session_start();

$id_rol_usuario = $_SESSION['id_rol'] ?? null;

// Verifica que se haya iniciado sesión y el rol sea menor o igual a 2
if (isset($_SESSION['id_usuario']) && $id_rol_usuario !== null && $id_rol_usuario <= 2) {
    // Usuario autenticado y es un administrador
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Valhalla Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">
</head>
<body>
    <div class="contrainer">
        <?php
            include "include/Templates/header.php";
        ?>

        <div id="titAdmin">
            BIENVENIDO AL MODO ADMIN
        </div>

        <section class="layout">
            <div class="cuerpo_carta">
                <div class="card">
                    <a href="">
                        <div class="card-body">
                            PEDIDOS
                        </div>
                    </a>
                </div>
            </div>
            <div class="cuerpo_carta">
                <div class="card">
                    <a href="adminproductos.php">
                        <div class="card-body">
                            PRODUCTOS
                        </div>
                    </a>
                </div>
            </div>
            <div class="cuerpo_carta">
                <div class="card">
                    <a href="">
                        <div class="card-body">
                            CATEGORIAS
                        </div>
                    </a>
                </div>
            </div>
            <div class="cuerpo_carta">
                <div class="card">
                    <a href="">
                        <div class="card-body">
                        </div>
                    </a>
                </div>
            </div>
            <div class="cuerpo_carta">
                <div class="card">
                    <a href="adminusuarios.php">
                        <div class="card-body">
                            USUARIOS
                        </div>
                    </a>
                </div>
            </div>
            <div class="cuerpo_carta">
                <div class="card">
                    <a href="">
                        <div class="card-body">
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>


<?php
} else {
    // Usuario no autenticado o no es un administrador, redirige a la página de inicio de sesión
    header("Location: inicioSesion.php");
    exit();
}
?>