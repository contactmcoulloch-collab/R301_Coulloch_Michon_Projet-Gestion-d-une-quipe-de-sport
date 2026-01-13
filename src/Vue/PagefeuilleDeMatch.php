<!DOCTYPE html>
<html lang="fr">
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

?>
<head>
<meta charset="UTF-8">
<title>Feuille de match</title>
<style>
table, th, td {
  border:1px solid black;
}
</style>
</head>

<body>
    <?php
        require __DIR__ . '/../DAO/connexion_DAO.php';
        require __DIR__ . '/../DAO/match_DAO.php';
        require __DIR__ . '/../DAO/participer_DAO.php';
        require __DIR__ . '/../DAO/joueur_DAO.php';

        $idmatch = $_GET['idmatch'];
        $currentMatch = matchs_trouver($pdo, $idmatch);

        $date      = $currentMatch['DATE'];
        $heure     = $currentMatch['HEURE'];
        $equipe    = $currentMatch['EQUIPEADV'];
        $lieu      = $currentMatch['LIEU'];
        $domicile  = $currentMatch['DOMICILE'];
        $victoire  = $currentMatch['VICTOIRE'];
        $resultat  = $currentMatch['RESULTAT'];

        echo"$date $heure $equipe $lieu $domicile $victoire $resultat";

        $tab = allParticipants($pdo, $idmatch);
        
        echo "<h4> Joueurs a ce match : </h4> <br>";
        foreach ($tab as $joueurOccupe) {
            echo "Nom: " . $joueurOccupe['NOM'] . " - Prénom: " . $joueurOccupe['PRENOM'] . "<a> retirer du match </a>" . "<br>";
        }

        $tab2 = listerJoueurs($pdo);

        echo "<h4> Joueurs libres : </h4> <br>";
        foreach ($tab2 as $joueurLibre) {
            echo "Nom: " . $joueurLibre['NOM'] . " - Prénom: " . $joueurLibre['PRENOM'] . "<a href='index.php?controleur=feuille&action=creer&idmatch=".$idmatch."&idjoueur=".$joueurLibre['IDJOUEUR']."'> ajouter au match </a>" . "<br>";
        }
    ?>
</body>
</html>