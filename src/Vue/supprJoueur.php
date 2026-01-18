<?php
require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';
    $idjoueur = $_GET['idjoueur'];

   retirer_joueurs_allMatch($pdo,$idjoueur);
    supprimer_commentaires($pdo, $idjoueur);
    supprimerJoueur($pdo, $idjoueur);

    header('Location: index.php?controleur=joueur&action=liste');
?>
