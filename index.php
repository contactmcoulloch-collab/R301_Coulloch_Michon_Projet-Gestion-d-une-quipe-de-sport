<?php
declare(strict_types=1);


// Point d'entrée unique avec page par defaut = accueil
$controleur = $_GET['controleur'] ?? '';
$action = $_GET['action'] ?? '';
// var_dump($_GET);

// Routage sur page demandée
switch ($controleur) {
    case 'joueur':
        if ($action == 'creer') {
            require __DIR__ . '/src/Vue/creerJoueur.php';
        } else if ($action == 'modifier') {
            require __DIR__ . '/src/Vue/modifJoueur.php';
        } else if ($action == 'supprimer') {
            require __DIR__ . '/src/Vue/supprJoueur.php';
        } else if ($action == 'commenter') {
            require __DIR__ . '/src/Vue/commenterJoueur.php';
        } else {
            require __DIR__ . '/src/Vue/PageJoueurs.php';
        }
        break;

    case 'match':
        if ($action == 'creer') {
            require __DIR__ . '/src/Vue/creerMatch.php';
        } else if ($action == 'modifier') {
            require __DIR__ . '/src/Vue/modifMatch.php';
        } else if ($action == 'supprimer') {
            require __DIR__ . '/src/Vue/supprMatch.php';
        } else if ($action == 'feuille') {
            require __DIR__ . '/src/Vue/PageFeuilleDeMatch.php';
        } else {
            require __DIR__ . '/src/Vue/PageMatchs.php';
        }
        break;
    case 'feuille':
        if ($action == 'liste') {
            require __DIR__ . '/src/Vue/PageFeuilleDeMatch.php';
        } else if ($action == 'ajouter') {
            require __DIR__ . '/src/Vue/PageFeuilleDeMatch.php';
        } else if ($action == 'preparer') {
            require __DIR__ . '/src/Vue/PageFeuilleDeMatch.php';
        } else if ($action == 'retirer') {
            require __DIR__ . '/src/Vue/PageFeuilleDeMatch.php';
        }
        break;

    case 'stats':
        if ($action == 'liste') {
            require __DIR__ . '/src/Vue/PageStats.php';
        } else {
            require __DIR__ . '/src/Vue/PageStats.php';
        }
        break;

    case 'accueil':
        if ($action == 'connecter') {
            $isconnecte = 1;
            require __DIR__ . '/src/Vue/pageAcceuil.php';
        } else if ($action == 'menuGen') {
            $isconnecte = 2;
            require __DIR__ . '/src/Vue/pageAcceuil.php';
        }
        break;

    default:
        $isconnecte = 0;
        require __DIR__ . '/src/Vue/pageAcceuil.php';
        break;
}


?>