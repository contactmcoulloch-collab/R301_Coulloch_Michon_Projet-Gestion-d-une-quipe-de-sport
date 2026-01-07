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

$lreq = "SELECT * FROM JOUEUR";
$req = $linkpdo->prepare($lreq);
$req->execute();
?>
<head>
<meta charset="UTF-8">
<title>Mes Joueurs</title>
<style>
table, th, td {
  border:1px solid black;
}
</style>
</head>

<body>
<h2>Liste des joueurs</h2>

<?php
echo "<table>
<thead>
<tr>
<th>ID</th>
<th>Nom</th>
<th>Prénom</th>
<th>N° Licence</th>
<th>Modifier</th>
<th>Supprimer</th>

</tr>
</thead><tbody>";

while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>
    <td>".$row['IDJOUEUR']."</td>
    <td>".$row['NOM']."</td>
    <td>".$row['PRENOM']."</td>
    <td>".$row['NUMERODELICENCE']."</td>
    <td>
      <a href='modifJoueur.php?
      idjoueur=".$row['IDJOUEUR']."&
      nom=".$row['NOM']."&
      prenom=".$row['PRENOM']."&
      licence=".$row['NUMERODELICENCE']."&
      trt=R'>Modifier</a>
    </td>
    <td>
<a href='supprJoueur.php?
idjoueur=".$row['IDJOUEUR']."&
nom=".$row['NOM']."&
prenom=".$row['PRENOM']."&
licence=".$row['NUMERODELICENCE']."&
trt=R'>Supprimer</a>
</td>

    </tr>";
}

echo "</tbody></table>";
?>
</body>
</html>
