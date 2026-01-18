<!DOCTYPE html>
<html lang="fr">
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

$joueurs = listerJoueurs($pdo);
$matchs = matchs_lister($pdo);

$titre="Statistiques équipe";

require __DIR__ . '/menu.php';
?>

<h2>Statistiques Matchs</h2>

<table>
    <th>Nombre de Matchs Total</th>
    <th>Nombre de Victoires</th>
    <th>Nombre de Défaites</th>
    <th>Nombre de Matchs nuls</th>
    <th>Pourcentages Victoires</th>
    <th>Pourcentage Défaites</th>
    <th>Pourcentage Matchs nuls</th>

    <?php
//    foreach($matchs as $row){
//     echo "
//     <tr>
//     <td>".$row["IDMATCH"]."</td>
//     <td>".postePrefere($pdo,$row["IDJOUEUR"])."</td>
//     <td>".countTitulaire($pdo,$row["IDJOUEUR"])."</td>
//     <td>".countRemplace($pdo,$row["IDJOUEUR"])."</td>
//     <td>".moyenneEval($pdo,$row["IDJOUEUR"])."</td>
//     <td>".pourcentageVictoire($pdo,$row["IDJOUEUR"])."</td>
//     <td>Pas encore fait</td>
//     </tr>";
    
//    }
?>
</table>

</br>

<h2>Infos Joueurs</h2>
<table>
    <thead>
    <th>Nom du Joueur</th> 
    <th>Statut actuel</th>
    <th>Poste préféré</th>
    <th>Nombre de Selection en tant que Titulaire</th>
    <th>Nombre de Selection en tant que Remplaçants</th>
    <th>Moyenne Evaluation</th>
    <th>Pourcentage de Victoires</th>
    <th>Nimbre de séléctions consécutive</th>
    </thead>
   <tbody> 
   <?php
   foreach($joueurs as $row){
    echo "
    <tr>
    <td>".$row["NOM"]."</td>
    <td>ooooooooo</td> 
    <td>".postePrefere($pdo,$row["IDJOUEUR"])."</td>
    <td>".countTitulaire($pdo,$row["IDJOUEUR"])."</td>
    <td>".countRemplace($pdo,$row["IDJOUEUR"])."</td>
    <td>".moyenneEval($pdo,$row["IDJOUEUR"])."</td>
    <td>".pourcentageVictoire($pdo,$row["IDJOUEUR"])."%</td>
    <td>Pas encore fait</td>
    </tr>";
    
   }
   ?> 
  </tbody> 
</table>
</body>
</html>
