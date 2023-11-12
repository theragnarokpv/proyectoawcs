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
        include "include/Templates/nav.php";
    ?>
    <h2 class="name_pag">Iniciar Sesión</h2>
        <div class="login-container">
        
        
            <form action="login.php" method="post" >
                <label for="email" class="sesion-label">Correo Electrónico:</label>
                    <input type="email"  name="email" required>

                    <label for="password" class="sesion-label">Contraseña:</label>
                <input type="password" name="password" required>

                <button type="submit" class="btn-log">Entrar</button>
                
                <div class="recover-content-pass">
                    <h6 class="recover">¿Olvidaste tu contraseña?</h6>
                    <a href="recovery.html" class="recover redi-link" >Recuperar</a>
                </div>
                <div class="recover-content-log">
                    <h6 class="recover">¿No tienes cuenta?</h6>
                    <a href="recovery.html" class="recover redi-link" >Registrarse</a>
                </div>
            
            </form>
            <img src="https://cdn.vectorstock.com/i/preview-1x/08/19/gray-photo-placeholder-icon-design-ui-vector-35850819.jpg" alt="Foto de Perfil" class="profile-picture">
            
        </div>
        

    
     
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>