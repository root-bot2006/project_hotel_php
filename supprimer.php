<?php
   require "connexion.php";

if (isset($_POST['id_client'])) {
    $id = (int) $_POST['id_client'];
    mysqli_query($conn, "DELETE FROM clients WHERE id_client=$id");
}
header("Location : lire.php");
exit;
?>