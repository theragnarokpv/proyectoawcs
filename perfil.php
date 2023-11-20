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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/casa-inteligente.ico" type="image/x-icon">
    <style>
        body {
            background-color: #f0f0f0; /* Color de fondo */
            color: white; /* Color del texto */
        }

        h2, p {
            color: white; /* Color del texto */
        }
    </style>
</head>

<body>
    <?php
    include "include/Templates/header.php";
    ?>

    <div id="tit_carrito">
        PERFIL
    </div>

    <?php
        $sql = "SELECT * FROM valhalla.usuario ORDER BY id_usuario DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Imprimir datos del último perfil
            $row = $result->fetch_assoc();
            echo "<h2>" . $row["nombre"] . " " . $row["apellidos"] . "</h2>";
            echo "<p>Username: " . $row["username"] . "</p>";
            echo "<p>Correo: " . $row["correo"] . "</p>";
            // Otros campos y datos que desees mostrar
            echo "<img src='" . $row["ruta_imagen"] . "' alt='Imagen de perfil'>";
        } else {
            echo "0 results";
        }

        // Cerrar la conexión
        $conn->close();
    ?>

</body>
</html>

