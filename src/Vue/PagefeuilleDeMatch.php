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

        $idmatch = $_GET['idmatch'];
        $row = matchs_trouver($pdo, $idmatch);

        $date      = $row['DATE'];
        $heure     = $row['HEURE'];
        $equipe    = $row['EQUIPEADV'];
        $lieu      = $row['LIEU'];
        $domicile  = $row['DOMICILE'];
        $victoire  = $row['VICTOIRE'];
        $resultat  = $row['RESULTAT'];

        echo"$date $heure $equipe $lieu $domicile $victoire $resultat";

        

    ?>
</body>
</html>