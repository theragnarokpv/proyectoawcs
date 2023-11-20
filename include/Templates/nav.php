<?php 
    include "include/functions/conexion.php"
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
        <div class="sidebar">
            <div class="sidebar-logos">
                <?php 
                    $resultado = $conn -> query("SELECT * FROM categoria");

                    $datos = $resultado->fetch_assoc();

                    while ($datos != null){
                        echo "<a href='index.php?idcat={$datos['id_categoria']}'><img src='{$datos['ruta_imagen']}' alt='{$datos['descripcion']}' class='sidebar-logo'></a>";
                        $datos = $resultado->fetch_assoc();
                    }
                ?>
            </div>
        </div>
    </header>    


</body>
</html>