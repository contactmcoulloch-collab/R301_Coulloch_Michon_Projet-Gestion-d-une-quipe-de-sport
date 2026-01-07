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

    $idjoueur = $_GET['idjoueur'];
    $nom = $_GET['nom'];
    $prenom = $_GET['prenom'];
    $licence = $_GET['licence'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Suppression joueur</title>
</head>
<body>

<h2>Voulez-vous vraiment supprimer ce joueur ?</h2>

<form action="supprJoueur.php" method="post">
ID Joueur :<input type="text" name="ID" value="<?php echo $idjoueur; ?>"><br>
Nom :<input type="text" name="Nom" value="<?php echo $nom; ?>"><br>
Prénom :<input type="text" name="Prenom" value="<?php echo $prenom; ?>"><br>
N° Licence :<input type="text" name="Licence" value="<?php echo $licence; ?>"><br>

<input type="submit" value="Supprimer">
</form>

</body>
</html>

<?php
}
/// SUPPRESSION
else {

    $idjoueur = $_POST['ID'];

    $req = $linkpdo->prepare(
        'DELETE FROM JOUEUR WHERE IDJOUEUR = :idjoueur;'
    );

    $req->execute(array(
        'idjoueur' => $idjoueur
    ));

    header('Location: Pagejoueurs.php');
}
?>
