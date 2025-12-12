<!DOCTYPE html>
<html lang="en">
<?php
///Connexion au serveur MySQL
$server='mysql-projetphp-michon-coulloch.alwaysdata.net:3306';
 $db='projetphp-michon-coulloch_bd';
 $login='442040_user';
 $mdp='$iutinfo';
  try {
    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    }
///Capture des erreurs éventuelles
catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
      } 
$lreq = "SELECT * FROM JOUEUR";
$req = $linkpdo->prepare($lreq);
$req->execute();
     ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Joueurs</title>
</head>
<body>
    <a1>Liste des Joueurs</a1>
    <style>
table, th, td {
  border:1px solid black;
}
</style>
</br></br></br>
<?php echo 
 "<table>
 <thead>
    <tr>
    <th>Identifiant</th>
    <th>Nom</th>
    <th>Prénom</th>
    <th>N° de licence</th>
    <th>Détails</th>
  </tr></thead><tbody>";
   while ($row = $req->fetch(PDO::FETCH_ASSOC)){
    echo"
    <td>".$row['IDJOUEUR']."</td>
    <td>".$row['NOM']."</td>
    <td>".$row['PRENOM']."</td>
    <td>".$row['NUMERODELICENCE']."</td>
    <td><a href='details.php?idjoueur=".$row['IDJOUEUR']."&trt=R'>Détails</a></td>";} 
  echo"</table>";
  ?>
</body>
</html>