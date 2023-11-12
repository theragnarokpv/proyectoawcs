<?php
    $servername = "localhost";
    $database = "valhalla";
    $username = "ragnar";
    $password = "valhalla123";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>