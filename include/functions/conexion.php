<?php
 
    $servername = "localhost";
    $database = "valhalla";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>


<?php
//ubicado temporalmente
    function Conecta() {
        $server = "localhost";
        $user = "root";
        $password = "";
        $dataBase = "valhalla";

        //1. Establecer la conexion mysqli
        $conexion = mysqli_connect($server, $user, $password, $dataBase);

        if(!$conexion){
            echo "Ocurrió un error al establecer la conexión" . mysqli_connect_error();
        }

        return $conexion;
    }

    function Desconecta($conexion) {
        mysqli_close($conexion);
    }
?>