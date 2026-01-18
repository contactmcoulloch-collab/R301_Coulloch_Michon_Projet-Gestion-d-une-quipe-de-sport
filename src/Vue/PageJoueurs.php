<!DOCTYPE html>
<html lang="fr">
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

$joueurs = listerJoueurs($pdo);
$titre = "Liste des joueurs";
require __DIR__ . '/menu.php';
?>


<a href= "index.php?controleur=joueur&action=creer">Creer Joueur</a>
<br>
<br>
<?php
echo '<table>
<thead>
<tr><th colspan="6">Liste des joueurs</th></tr>
<tr>
<th>Nom</th>
<th>Prénom</th>
<th>N° Licence</th>
<th>Modifier</th>
<th>Supprimer</th>

</tr>
</thead><tbody>';

foreach ($joueurs as $row) {
    echo "<tr>
    <td>".$row['NOM']."</td>
    <td>".$row['PRENOM']."</td>
    <td>".$row['NUMERODELICENCE']."</td>
    <td>
      <a href='./index.php?controleur=joueur&action=commenter&idjoueur=".$row['IDJOUEUR']."'>Commenter</a>
    </td>
    <td>
      <a href='./index.php?controleur=joueur&action=modifier&idjoueur=".$row['IDJOUEUR']."'>Modifier</a>
    </td>
    <td>
<a href='index.php?controleur=joueur&action=supprimer&idjoueur=".$row['IDJOUEUR']."'>Supprimer</a>
</td>

    </tr>";
}

echo "</tbody></table>";
?>
</body>
</html>
