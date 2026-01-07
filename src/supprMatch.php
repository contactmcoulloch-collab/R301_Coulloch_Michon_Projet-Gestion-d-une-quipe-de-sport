<?php
/// Connexion MySQL
$server='mysql-projetphp-michon-coulloch.alwaysdata.net:3306';
$db='projetphp-michon-coulloch_bd';
$login='442040_user';
$mdp='$iutinfo';

try {
    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if (array_key_exists('trt', $_GET)) {

    $idmatch   = $_GET['IDMATCH'];
    $date      = $_GET['DATE'];
    $heure     = $_GET['HEURE'];
    $equipe    = $_GET['EQUIPEADV'];
    $lieu      = $_GET['LIEU'];
    $domicile  = $_GET['DOMICILE'];
    $victoire  = $_GET['VICTOIRE'];
    $resultat  = $_GET['RESULTAT'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Suppression Match</title>
</head>
<body>

<h2>Voulez-vous vraiment supprimer ce match ?</h2>

<form action="supprMatch.php" method="post">

ID Match :<input type="text" name="IDMATCH" value="<?php echo $idmatch; ?>"><br>
Date :<input type="date" name="DATE" value="<?php echo $date; ?>"><br>
Heure :<input type="time" name="HEURE" value="<?php echo $heure; ?>"><br>
Adversaire :<input type="text" name="EQUIPEADV" value="<?php echo $equipe; ?>"><br>
Lieu :<input type="text" name="LIEU" value="<?php echo $lieu; ?>"><br>
Domicile (1=oui, 0=non) :<input type="text" name="DOMICILE" value="<?php echo $domicile; ?>"><br>
Victoire (1=oui, 0=non)  :<input type="text" name="VICTOIRE" value="<?php echo $victoire; ?>"><br>
Résultat :<input type="text" name="RESULTAT" value="<?php echo $resultat; ?>"><br>
<input type="submit" value="Supprimer">
</form>

</body>
</html>

<?php
}

else {

    $idmatch = $_POST['IDMATCH'];

    $req = $linkpdo->prepare(
        "DELETE FROM LE_MATCH WHERE IDMATCH = :id"
    );

    $req->execute(array(
        'id' => $idmatch
    ));

    header('Location: PageMatchs.php');
}
?>
