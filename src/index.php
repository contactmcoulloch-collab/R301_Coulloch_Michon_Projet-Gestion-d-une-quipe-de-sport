<?php
declare(strict_types=1);

require __DIR__ . '/src/logs.php';

// Point d'entrée unique avec page par defaut = accueil
$page = $_GET['page'] ?? 'accueil';
applog($page);

// Routage sur page demandée
switch ($page) {
    case 'joueur':
        require __DIR__ . '/src/controleurs/joueur_controleur.php';
        break;

    case 'match':
        require __DIR__ . '/src/controleurs/match_controleur.php';
        break;

    case 'stats':
        require __DIR__ . '/src/controleurs/stats_controleur.php';
        break;

    case 'accueil':
    default:
        require __DIR__ . '/src/controleurs/accueil_controleur.php';
        break;
}

