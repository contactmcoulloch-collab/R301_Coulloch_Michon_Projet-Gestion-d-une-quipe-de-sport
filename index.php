<?php
declare(strict_types=1);


// Point d'entrée unique avec page par defaut = accueil
$controleur = $_GET['controleur'] ?? 'accueil';
$action = $_GET['action'] ?? '';

// Routage sur page demandée
switch ($controleur) {
    case 'joueur':
        if ( $action == 'creer'){
            require __DIR__ . '/src/Vue/creerJoueur.php';
            } 
        else if ( $action == 'modifier'){
            require __DIR__ . '/src/Vue/modifJoueur.php';
            }
        else if ( $action == 'supprimer'){
            require __DIR__ . '/src/Vue/supprJoueur.php';
            }
        else{
            require __DIR__ . '/src/Vue/PageJoueurs.php';
        }
        break;

    case 'match':
        if ( $action == 'creer'){
            require __DIR__ . '/src/Vue/creerMatch.php';
            } 
        else if ( $action == 'modifier'){
            require __DIR__ . '/src/Vue/modifMatch.php';
            }
        else if ( $action == 'supprimer'){
            require __DIR__ . '/src/Vue/supprMatch.php';
            }
        else if ( $action == 'feuille'){
            require __DIR__ . '/src/Vue/PageFeuilleDeMatch.php';
            }
        else{
            require __DIR__ . '/src/Vue/PageMatchs.php';
        }
        break;
    case 'feuille':
        if ( $action == 'creer'){
            require  __DIR__ . '/src/Vue/creerParticiper.php';
        }
        break;

    // case 'stats':
    //     require __DIR__ . '/src/controleurs/stats_controleur.php';
    //     break;

    case 'accueil':
    default:
        require __DIR__ . '/src/Vue/pageAcceuil.php';
        break;
}
?>