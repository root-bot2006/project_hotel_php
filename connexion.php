<?php
$conn = mysqli_connect("localhost", "root", "", "hotel");
    if(!$conn) {
        die ("Erreur de connexion : " .mysqli_connect_error());
    }
    mysqli_set_charset($conn, "utf8mb4");
?>