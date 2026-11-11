<?php
include "connexion.php";
?>
<?php
include "connexion.php";
if (isset($_POST['enregistrer'])) {
    $id = (int) $_POST['id_client'];
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "UPDATE clients SET nom='$nom', prenom='$prenom', telephone='$telephone', email='$email' WHERE id_client=$id");

    // On retourne à la liste
    header("Location: lire.php");
    exit;
}

$id = (int) $_GET['id'];
$resultat = mysqli_query($conn, "SELECT * FROM clients WHERE id_client=$id");
$client = mysqli_fetch_assoc($resultat);

if (!$client) {
    die("Client introuvable");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier un client</title>
</head>
<body>
  <h2>Modifier le client</h2>
  <form method="post">
    <input type="hidden" name="id_client" value="<?php echo $client['id_client']; ?>">
    Nom : <input type="text" name="nom" value="<?php echo $client['nom']; ?>"><br>
    Prénom : <input type="text" name="prenom" value="<?php echo $client['prenom']; ?>"><br>
    Téléphone : <input type="text" name="telephone" value="<?php echo $client['telephone']; ?>"><br>
    Email : <input type="text" name="email" value="<?php echo $client['email']; ?>"><br>
    <button type="submit" name="enregistrer">Enregistrer</button>
  </form>
  <a href="lire.php">Retour</a>
</body>
</html>