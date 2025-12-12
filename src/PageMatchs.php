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
$lreq = "SELECT * FROM LE_MATCH";
$req = $linkpdo->prepare($lreq);
$req->execute();
     ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Matchs</title>
</head>
<body>
    <a1>Liste des Matchs</a1>
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
    <th>Date de la rencontre</th>
    <th>Heure de début du match</th>
    <th>Adversaires</th>
    <th>Lieu</th>
    <th>A domicile ?</th>
    <th>Gagné ou perdu ?</th>
    <th>Score final</th>
  </tr></thead><tbody>";
   while ($row = $req->fetch(PDO::FETCH_ASSOC)){
    if ($row['DOMICILE'] == 1){
        $domicile = "Oui";
    } else {
        $domicile = "Non";
    }
    if ($row['VICTOIRE']==1){
        $victoire= "Gagné";
    }else{
        $victoire="Perdu";
    }
    echo"
    <td>".$row['IDMATCH']."</td>
    <td>".$row['DATE']."</td>
    <td>".$row['HEURE']."</td>
    <td>".$row['EQUIPEADV']."</td>
    <td>".$row['LIEU']."</td>
    <td>".$domicile."</td>
    <td>".$victoire."</td>
    <td>".$row['RESULTAT']."</td>
    <td><a href='modifmatch.php?IDMATCH=".$row['IDMATCH']."&trt=R'>Modifier</a></td>";} 
  echo"</table>";
  ?>
</body>
</html>