<?php 
    include "include/functions/conexion.php";
    $id_rol_usuario = $_SESSION['id_rol'] ?? null;


    if (isset($_GET['cerrar_sesion'])) {
        session_destroy(); // Destruye todos los datos de la sesión
        // Redirige a la página principal o a donde desees después de cerrar sesión

            // Almacena la URL de referencia en la sesión
            $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];

            // Redirige de vuelta a la página de referencia
            header("Location: " . $_SESSION['referer']);
        exit();
    }
?>  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="container">
                <a href="index.php" id="link_contenido">
                    <div class="logo-container">
                        <img src="img/casa-inteligente.png" alt="Logo" class="logo">
                        <h1 class="store-name">TIENDA VALHALLA</h1>
                    </div>
                </a>
                <div class="other-logos">
                    <a href="carrito.php"><img src="img/carrito-de-compras (1).png" alt="Compras" class="other-logo"></a>

                    <?php if (isset($_SESSION['id_usuario'])) : ?>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" id="btn_usuario" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="img/perfil-del-usuario.png" alt="Usuario" class="other-logo">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark" id="drop">
                        <?php
                        // Verificar si el id_rol del usuario es igual a 3
                            if ($id_rol_usuario <= 2) {
                                echo '<li><a class="dropdown-item" href="adminIndex.php">Administración</a></li>';
                            }
                        ?>
                            <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                            <li><a class="dropdown-item" href="pedidos.php">Pedidos</a></li>
                            <li><a class="dropdown-item" href="?cerrar_sesion=1">Cerrar sesión</a></li>
                        </ul>
                    </div>
                    <?php else : ?>
                        <!-- Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión -->
                        <a href="inicioSesion.php" class="btn">
                            <img src="img/perfil-del-usuario.png" alt="Usuario" class="other-logo">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

</body>
</html>