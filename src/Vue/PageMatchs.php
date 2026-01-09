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

$lreq = "SELECT * FROM LE_MATCH";
$req = $linkpdo->prepare($lreq);
$req->execute();
?>

<head>
<meta charset="UTF-8">
<title>Liste des Matchs</title>
<style>
table, th, td { border:1px solid black; }
</style>
</head>

<body>
<h2>Liste des Matchs</h2>

<?php
echo "<table>
<thead>
<tr>
<th>ID</th>
<th>Date</th>
<th>Heure</th>
<th>Adversaire</th>
<th>Lieu</th>
<th>Domicile</th>
<th>Victoire</th>
<th>Résultat</th>
<th>Modifier</th>
<th>Supprimer</th>
</tr>
</thead><tbody>";

while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

    $domicile = ($row['DOMICILE'] == 1) ? "Oui" : "Non";
    $victoire = ($row['VICTOIRE'] == 1) ? "Gagné" : "Perdu";

    echo "<tr>
    <td>".$row['IDMATCH']."</td>
    <td>".$row['DATE']."</td>
    <td>".$row['HEURE']."</td>
    <td>".$row['EQUIPEADV']."</td>
    <td>".$row['LIEU']."</td>
    <td>".$domicile."</td>
    <td>".$victoire."</td>
    <td>".$row['RESULTAT']."</td>
    <td><a href='modifMatch.php?IDMATCH=".$row['IDMATCH']."&
DATE=".$row['DATE']."&
HEURE=".$row['HEURE']."&
EQUIPEADV=".$row['EQUIPEADV']."&
LIEU=".$row['LIEU']."&
DOMICILE=".$row['DOMICILE']."&
VICTOIRE=".$row['VICTOIRE']."&
RESULTAT=".$row['RESULTAT']."&
trt=R'>Modifier</a></td>
<td>
    <a href='supprMatch.php?
IDMATCH=".$row['IDMATCH']."&
DATE=".$row['DATE']."&
HEURE=".$row['HEURE']."&
EQUIPEADV=".$row['EQUIPEADV']."&
LIEU=".$row['LIEU']."&
DOMICILE=".$row['DOMICILE']."&
VICTOIRE=".$row['VICTOIRE']."&
RESULTAT=".$row['RESULTAT']."&
trt=R'>Supprimer</a>
</tr>";
}
echo "</tbody></table>";
?>
</body>
</html>
