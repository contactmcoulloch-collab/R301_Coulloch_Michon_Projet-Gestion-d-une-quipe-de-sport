<?php
declare(strict_types=1);

$config = require __DIR__ . '/../config/configuration.php';
 $server = $config['base']['server'];
 $db = $config['base']['db'];
 $login = $config['base']['login'];
 $mdp = $config['base']['mdp'];
try {
    $pdo = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
