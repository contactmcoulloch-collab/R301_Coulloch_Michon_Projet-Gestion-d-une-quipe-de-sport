<?php
/// Connexion MySQL
$server='mysql-projetphp-michon-coulloch.alwaysdata.net:3306';
$db='projetphp-michon-coulloch_bd';
$login='442040_user';
$mdp='$iutinfo';

try {
    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

/// AFFICHAGE DU FORMULAIRE
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
<title>Modification joueur</title>
</head>
<body>

<h2>Modifier le joueur</h2>

<form action="modifJoueur.php?
idjoueur=<?php echo $idjoueur; ?>&
nom=<?php echo $nom; ?>&
prenom=<?php echo $prenom; ?>&
licence=<?php echo $licence; ?>" method="post">

Nom :
<input type="text" name="Nom" value="<?php echo $nom; ?>"><br>

Prénom :
<input type="text" name="Prenom" value="<?php echo $prenom; ?>"><br>

N° Licence :
<input type="text" name="Licence" value="<?php echo $licence; ?>"><br>

<input type="submit" value="Sauvegarder">
</form>

</body>
</html>

<?php
}

else {

    $idjoueur = $_GET['idjoueur'];

    $newnom = $_POST['Nom'];
    $newprenom = $_POST['Prenom'];
    $newlicence = $_POST['Licence'];

    $req = $linkpdo->prepare(
        "UPDATE JOUEUR 
         SET NOM = :nvnom,
             PRENOM = :nvprenom,
             NUMERODELICENCE = :nvlicence
         WHERE IDJOUEUR = :idjoueur"
    );

    $var = array(
        'nvnom' => $newnom,
        'nvprenom' => $newprenom,
        'nvlicence' => $newlicence,
        'idjoueur' => $idjoueur
    );

    $req->execute($var);

    header('Location: PageJoueurs.php');
}
?>
