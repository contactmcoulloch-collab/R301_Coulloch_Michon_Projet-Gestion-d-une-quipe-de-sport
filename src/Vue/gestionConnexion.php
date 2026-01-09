<?php
 class gestionConnexion {
    
public function connexion(){
///Connexion au serveur MySQL
$server='mysql-projetphp-michon-coulloch.alwaysdata.net:3306';
 $db='projetphp-michon-coulloch_bd';
 $login='442040_user';
 $mdp='$iutinfo';
  try {
    $linkpdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
    return $linkpdo;
    }
///Capture des erreurs éventuelles
catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
      } 
    }
}
      ?>