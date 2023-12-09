


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
                    <a href="adminpedidos.php">
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
                    <a href="admincategorias.php">
                        <div class="card-body">
                            CATEGORIAS
                        </div>
                    </a>
                </div>
            </div>

            <?php
            // Verificar si el id_rol del usuario es igual a 3
                if ($id_rol_usuario == 1) {
                    echo '<div class="cuerpo_carta">';
                        echo '<div class="card">';
                            echo '<a href="adminusuarios.php">';
                                echo '<div class="card-body">Usuarios</div>';
                            echo '</a>';
                        echo '</div>';
                    echo '</div>';
                }
            ?>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
