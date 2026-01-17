<!DOCTYPE html>
<html lang="fr">
<!DOCTYPE html>
<html lang="fr">
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';

$matchs = matchs_lister($pdo);
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

<a href= "index.php?controleur=match&action=creer">Planifier un match</a>
<br>
<br>
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

foreach ($matchs as $row){

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
    <td>
 <a href='./index.php?controleur=match&action=modifier&idmatch=".$row['IDMATCH']."'>Modifier</a></td>
<td>
<a href='index.php?controleur=match&action=supprimer&idmatch=".$row['IDMATCH']."'>Supprimer</a>
</td>
<td>
    <a href='index.php?controleur=match&action=feuille&idmatch=".$row['IDMATCH']."'>Voir la fiche de match</a></td>
</tr>";
}
echo "</tbody></table>";
?>
</body>
</html>
