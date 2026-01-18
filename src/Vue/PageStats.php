<!DOCTYPE html>
<html lang="fr">
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';
?>

<h2>Statisqtiques Matchs</h2>

<table>
    <th>Nombre de Matchs Total</th>
    <th>Nombre de Victoires</th>
    <th>Nombre de Défaites</th>
    <th>Nombre de Matchs nuls</th>
    <th>Pourcentages Victoires</th>
    <th>Pourcentage Défaites</th>
    <th>Pourcentage Matchs nuls</th>
</table>

</br>

<h2>Infos Joueurs</h2>
<table>
    <th>Statut actuel</th>
    <th>Poste préféré</th>
    <th>Nombre de Selection en tant que Titulaire</th>
    <th>Nombre de Selection en tant que Remplaçants</th>
    <th>Moyenne Evaluation</th>
    <th>Pourcentage de Victoires</th>
    <th>Nimbre de séléctions consécutive</th>
</table>
</body>
</html>
