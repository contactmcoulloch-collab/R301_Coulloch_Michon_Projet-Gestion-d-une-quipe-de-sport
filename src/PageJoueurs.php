<!DOCTYPE html>
<html lang="en">
<?php
///Connexion au serveur MySQL
$server='mysql-projetphp-michon-coulloch.alwaysdata.net:3306';
 $db='projetphp-michon-coulloch_bd';
 $login='442040_user';
 $mdp='$iutinfo';
//  try {
//    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
//    }
//    ///Capture des erreurs éventuelles
//    catch (Exception $e) {
//      die('Erreur : ' . $e->getMessage());
//      } 
//      $lreq ="Select * from projetphp-michon-coulloch_bd.JOUEUR"
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
    <td>".$row['id']."</td>
    <td>".$row['nom']."</td>
    <td>".$row['prenom']."</td>
    <td>".$row['nLicence']."</td>
    <td><a href='modification.php?nom=".$row['nom']."&prenom=".$row['prenom']."&adresse=".$row['adresse']."&codepost=".$row['codepost']."&ville=".$row['ville']."&telephone=".$row['telephone']."&trt=R'>Détails</a></td>";
} 
  echo"</table>";
  ?>
</body>
</html>