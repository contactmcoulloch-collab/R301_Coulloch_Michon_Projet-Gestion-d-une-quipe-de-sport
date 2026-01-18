
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';

$matchs = matchs_lister($pdo);
$titre="Liste des matchs";

require __DIR__ . '/menu.php'; ?>

<a href= "index.php?controleur=match&action=creer">Planifier un match</a>
<br>
<br>
<?php
echo '<table>
<thead>
<tr><th colspan="10">Liste des matchs</th></tr>

<tr>
<th>Date</th>
<th>Heure</th>
<th>Adversaire</th>
<th>Lieu</th>
<th>Domicile</th>
<th>Victoire</th>
<th>Résultat</th>
<th>Modifier</th>
<th>Supprimer</th>
<th>Feuille</th>
</tr>
</thead><tbody>';

foreach ($matchs as $row){

    switch ($row["DOMICILE"]){
        case 1:
            $domicile = "Oui";
            break;
        case 0:
            $domicile = "Non";
            break;
    }
    switch ($row["VICTOIRE"]){
        case 2:
            $victoire = "Gagné";
            break;
        case 1:
            $victoire = "Match Nul";
            break;
        case 0:
            $victoire = "Défaite";
            break;
    }

    echo '<tr>
   <td>'.$row["DATE"].'</td>
    <td>'.$row["HEURE"].'</td>
    <td>'.$row["EQUIPEADV"].'</td>
    <td>'.$row["LIEU"].'</td>
    <td>'.$domicile.'</td>
    <td>'.$victoire.'</td>
    <td>'.$row["RESULTAT"].'</td>
    <td>
 <a href="./index.php?controleur=match&action=modifier&idmatch='.$row["IDMATCH"].'">Modifier</a></td>
<td>
<a href="index.php?controleur=match&action=supprimer&idmatch='.$row["IDMATCH"].'">Supprimer</a>
</td>
<td>
    <a href="index.php?controleur=feuille&action=liste&idmatch='.$row["IDMATCH"].'">Voir la feuille de match</a></td>
</tr>';
}
echo "</tbody></table>";
?>
</body>
</html>
