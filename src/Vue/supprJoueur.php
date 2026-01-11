<?php
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';
    $idjoueur = $_GET['idjoueur'];

    supprimerJoueur($pdo, $idjoueur);

    header('Location: index.php?controleur=joueur&action=');
?>
