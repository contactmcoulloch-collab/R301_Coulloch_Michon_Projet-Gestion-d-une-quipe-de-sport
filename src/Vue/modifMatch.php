<?php
/// Connexion MySQL
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';

/// AFFICHAGE DU FORMULAIRE avec données en base
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

$idjoueur=$_GET['idmatch'];

    $row = matchs_trouver($pdo, $idjoueur);
    $idmatch = $row['IDMATCH'];
    $date = $row['DATE'];
    $heure = $row['HEURE'];
    $equipe = $row['EQUIPEADV'];
    $lieu =$row['LIEU'];
    $domicile=$row['DOMICILE'];
    $victoire=$row['VICTOIRE'];
    $resultat=$row['RESULTAT'];
$titre="Modifier le match";

require __DIR__ . '/menu.php'; ?>
</h2>

<form action="index.php?controleur=match&action=modifier"
method="post">

ID Match :<input type="text" name="IDMATCH" value="<?php echo $idmatch; ?>"><br>
Date :<input type="date" name="DATE" value="<?php echo $date; ?>"><br>
Heure :<input type="time" name="HEURE" value="<?php echo $heure; ?>"><br>
Adversaire :<input type="text" name="EQUIPEADV" value="<?php echo $equipe; ?>"><br>
Lieu :<input type="text" name="LIEU" value="<?php echo $lieu; ?>"><br>
Domicile (1=oui, 0=non) :<input type="text" name="DOMICILE" value="<?php echo $domicile; ?>"><br>
Victoire (1=oui, 0=non)  :<input type="text" name="VICTOIRE" value="<?php echo $victoire; ?>"><br>
Résultat :<input type="text" name="RESULTAT" value="<?php echo $resultat; ?>"><br>
<input type="submit" value="Sauvegarder">
</form>

</body>
</html>

<?php
}
else {

    $idmatch = $_POST['IDMATCH'];

    $date     = $_POST['DATE'];
    $heure    = $_POST['HEURE'];
    $equipeadv   = $_POST['EQUIPEADV'];
    $lieu     = $_POST['LIEU'];
    $domicile      = $_POST['DOMICILE'];
    $victoire = $_POST['VICTOIRE'];
    $resultat = $_POST['RESULTAT'];

     matchs_modifier($pdo, $idmatch, $date, $heure, $equipeadv, $lieu, $domicile, $victoire, $resultat);


   header('Location: index.php?controleur=match&action=liste');
}
?>
