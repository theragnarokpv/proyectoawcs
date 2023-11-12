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

    <section class="main-content">
        <div class="container">
            <div class="row">
                <?php
                    if (isset($_GET['codigo'])) {

                        $id = $_GET['codigo'];
                    } 
    
                    $resultado = $conn -> query("SELECT * FROM producto WHERE id_producto= $id");

                    $datos = $resultado->fetch_assoc();
            
            
                    
                    if(!empty($datos)){
                       echo" <h2 class='name_pag'>Iniciar Sesión</h2>";
                            echo"<div class='login-container'>";
                            echo"<img src=",$datos['ruta_imagen']," alt='Foto de Perfil' class='profile-picture'>";
        
        
                                echo"<form action='login.php' method='post' >";
                                    echo"<label for='email' >Correo Electrónico:</label>";
                                    echo"<input type='email' name='email' required>";

                                    echo"<label for='password'>Contraseña:</label>";
                                    echo"<input type='password' name='password' required>";

                                    echo"<button type='submit'>Entrar</button>";
                
                                    echo"<div class='recover-content-pass'>";
                                        echo"<h6 class='recover'>¿Olvidaste tu contraseña?</h6>";
                                        echo"<a href='recovery.html' class='recover redi-link' >Recuperar</a>";
                                    echo"</div>";
                                    echo" <div class='recover-content-log'>";
                                        echo"<h6 class='recover'>¿No tienes cuenta?</h6>";
                                        echo"<a href='recovery.html' class='recover redi-link' >Registrarse</a>";
                                    echo"</div>";
            
                                echo"</form>";
                                
            
                            echo"</div>";
                
        
                        echo "Nombre: ",$datos['descripcion'], "<br>" ;
                        echo "Correo: ",$datos['detalle'], "<br>";
                        echo "Telefono: ",$datos['precio'];
                    }
            
        ?>

            </div>
        </div>
    </section>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>