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
        <div class="admin">
            <div class="opciones_admin">
                <a class="item_admin" href='adminpedidos.php'><i class="bi bi-backpack4-fill"></i> Pedidos</a>
                <a class="item_admin" href='adminproductos.php'><i class="bi bi-box2-fill"></i> Productos</a>
                <a class="item_admin" href='admincategorias.php'><i class="bi bi-bookmark-fill"></i> Categorias</a>
                <?php
                // Verificar si el id_rol del usuario es igual a 3
                    if ($id_rol_usuario == 1) {
                        echo '<a href="adminusuarios.php"><i class="bi bi-people-fill"></i>Usuarios</a>';
                    }
                ?>
            </div>
        </div>
    </header>    


</body>
</html>