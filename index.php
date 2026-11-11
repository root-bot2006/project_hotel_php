
<?php
require "connexion.php";

if (isset($_POST['valider'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    $id_chambre = (int) $_POST['id_chambre'];

    $date_arrivee = mysqli_real_escape_string($conn, $_POST['date_arrivee']);
    $date_depart = mysqli_real_escape_string($conn, $_POST['date_depart']);

    mysqli_query($conn, "INSERT INTO clients (nom, prenom, telephone, email) VALUES ('$nom', '$prenom', '$telephone', '$email')");
    $id_client = mysqli_insert_id($conn);


    mysqli_query($conn, "INSERT INTO reservations (id_client, id_chambre, date_arrivee, date_depart) VALUES ($id_client, $id_chambre, '$date_arrivee', '$date_depart')");

    header("Location: lire.php");
    exit;
}

$chambres = mysqli_query($conn, "SELECT * FROM chambres");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Réservation</title>
</head>
<body>
    <h2>Formulaire d'inscription et de réservation</h2>
    
    <form method="post">
        <h3>Informations du client</h3>
        Nom : <input type="text" name="nom" required><br><br>
        Prénom : <input type="text" name="prenom" required><br><br>
        Téléphone : <input type="tel" name="telephone" required><br><br>
        Email : <input type="email" name="email"><br><br>

        <h3>Choix de la chambre</h3>
        Chambre : 
        <select name="id_chambre" required>
            <option value="">-- Sélectionnez une chambre --</option>
            <?php while ($ch = mysqli_fetch_assoc($chambres)) { ?>
                <option value="<?php echo $ch['id_chambre']; ?>">
                    Chambre n°<?php echo $ch['numero']; ?> (<?php echo $ch['type']; ?>) — <?php echo $ch['prix']; ?> FCFA
                </option>
            <?php } ?>
        </select><br><br>

        <h3>Séjour</h3>
        Date d'arrivée : <input type="date" name="date_arrivee" required><br><br>
        Date de départ : <input type="date" name="date_depart" required><br><br>

        <button type="submit" name="valider">Valider la réservation</button>
    </form>
    
    <br>
    <a href="lire.php">Voir la liste des réservations / clients</a>
</body>
</html>