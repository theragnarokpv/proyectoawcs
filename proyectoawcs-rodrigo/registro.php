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
</head>

<body>
    <?php
    include "include/Templates/header.php";
    ?>

    <div id="tit_carrito">
        Registro de Cuenta
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-inline">
                <div class="mb-3">
                        <label id="tit_carrito" for="Usuario" class="form-label">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label id="tit_carrito" for="nombre" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label id="tit_carrito" for="apellidos" class="form-label">Apellidos:</label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label id="tit_carrito" for="correo" class="form-label">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="correo" name="correo" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label id="tit_carrito" for="contrasena" class="form-label">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                    </div>
                    <br>
                    <div class="mb-3">
                        <label id="tit_carrito" for="confirmar_contrasena" class="form-label">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="confirmar_contrasena"
                            name="confirmar_contrasena" required>
                    </div>
                    <div class="mb-3">
                        <label id="tit_carrito" for="Telefono" class="form-label">Teléfono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <br>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <br>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>