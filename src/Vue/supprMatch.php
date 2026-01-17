<?php
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
    $idmatch = $_GET['idmatch'];

    matchs_supprimer($pdo, $idmatch);


    header('Location: index.php?controleur=match&action=list');
?>
