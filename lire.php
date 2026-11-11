<?php
require "connexion.php";
$query = "SELECT r.id_reservation, c.nom, c.prenom, c.telephone, c.email, 
                 ch.numero, ch.type_chambre, ch.prix, r.date_arrivee, r.date_depart 
          FROM reservations r
          JOIN clients c ON r.id_client = c.id_client
          JOIN chambres ch ON r.id_chambre = ch.id_chambre";

$resultat = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des réservations</title>
</head>
<body>
    <h2>Liste globale des réservations et des clients</h2>
    
    <table border="1" cellpadding="8">
        <tr>
            <th>ID Résa</th>
            <th>Client</th>
            <th>Téléphone</th>
            <th>Email</th>
            <th>Chambre n°</th>
            <th>Type</th>
            <th>Prix</th>
            <th>Arrivée</th>
            <th>Départ</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($resultat)) { ?>
            <tr>
                <td><?php echo $row['id_reservation']; ?></td>
                <td><?php echo $row['prenom'] . ' ' . $row['nom']; ?></td>
                <td><?php echo $row['telephone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>Chambre n°<?php echo $row['numero']; ?></td>
                <td><?php echo $row['type_chambre']; ?></td>
                <td><?php echo $row['prix']; ?> FCFA</td>
                <td><?php echo $row['date_arrivee']; ?></td>
                <td><?php echo $row['date_depart']; ?></td>
                <td>
                    <a href="modifier.php?id=<?php echo $row['id_reservation']; ?>">Modifier</a> | 
                    <a href="supprimer.php?id=<?php echo $row['id_reservation']; ?>" onclick="return confirm('Voulez-vous vraiment supprimer ?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <br>
    <a href="index.php">Faire une autre réservation</a>
</body>
</html>