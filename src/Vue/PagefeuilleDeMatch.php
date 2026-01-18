<!DOCTYPE html>
<html lang="fr">
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

$idjoueur_prepa = "";

if ($_GET['action'] == 'liste') {
    $idmatch = $_GET['idmatch'];
}
if ($_GET['action'] == 'retirer') {
    $idmatch = $_GET['idmatch'];
    $idjoueur = $_GET['idjoueur'];
    retirer_joueurs($pdo, $idjoueur, $idmatch);
} else if ($_GET['action'] == 'preparer') {
    $idmatch = $_GET['idmatch'];
    $idjoueur = $_GET['idjoueur'];
    $idmatch_prepa = $_GET['idmatch'];
    $idjoueur_prepa = $_GET['idjoueur'];
    $joueur_prepa = lirejoueur($pdo, $idjoueur_prepa);
} else if ($_GET['action'] == 'ajouter') {
    $idmatch = $_POST['idmatch'];
    $idjoueur = $_POST['idjoueur'];
    $titulaire = $_POST['titulaire'];
    $poste = $_POST['poste'];
    ajouter_joueurs($pdo, $poste, $titulaire, 0, $idjoueur, $idmatch);
}

$currentMatch = matchs_trouver($pdo, $idmatch);
$inscrits = allParticipants($pdo, $idmatch);
$disponibles = listerJoueursDispos($pdo,$idmatch);
$titre="Feuille de match";

require __DIR__ . '/menu.php'; ?>


    <div class="panel titre">
        <h3>Feuille de match du <?php echo $currentMatch["DATE"] ?>
            à <?php echo $currentMatch["HEURE"] ?>
            &nbsp Equipe adverse : <?php echo $currentMatch["EQUIPEADV"] ?>
            &nbsp Lieu : <?php echo $currentMatch["LIEU"] ?>
        </h3>
    </div>

    <div class="container2">
        <?php
        if ($idjoueur_prepa == "") {
            echo '        <div class="col-1">
            <table>
                <thead>
                    <tr><th colspan="5">Joueurs libres :</th></tr>
                    <tr>
                        <th>Nom</h>
                        <th>Taille</th>
                        <th>Poids</th>
                        <th>Stats joueur</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> ';

            foreach ($disponibles as $joueurLibre) {
                echo "<tr><td>" . $joueurLibre['NOM'] . "  " . $joueurLibre['PRENOM'] . "</td><td>" . $joueurLibre['POIDS'] . "</td><td>" . $joueurLibre['TAILLE'];
                echo "</td><td> &nbsp </td><td>" . "<a href='index.php?controleur=feuille&action=preparer&idmatch=" . $idmatch . "&idjoueur=" . $joueurLibre['IDJOUEUR'] . "'> ajouter au match </a></td></tr>";
            }
            echo '

                </tbody>
            </table>
        </div> ';
        }
        if ($idjoueur_prepa != "") {
            echo '
            <div class="col-1">
            <form action="index.php?controleur=feuille&action=ajouter" method="post">
            
            <input type="hidden" name="idjoueur" value="' . $idjoueur_prepa . '"><br>
            <input type="hidden" name="idmatch" value="' . $idmatch_prepa . '">
            <h4> Ajouter ' . $joueur_prepa["NOM"] . "  " . $joueur_prepa["PRENOM"] . '<br> </h4>
            
            poids : ' . $joueur_prepa["POIDS"] . ' <br>
            Taille : ' . $joueur_prepa["TAILLE"] . ' <br>
            Stats  : ' . $joueur_prepa["TAILLE"] . ' <br>

            Titulaire :
            <select name="titulaire">
            <option value="Titulaire">Oui</option>   
            <option value="Remplaçant">Non</option> 
            </select>
            <br>
            Poste :
            <select name="poste">
            <option>Avant</option>   
            <option>Centre</option>  
            <option>Arriere</option> 
            </select>
            <br>
            
            
            
            <input type="submit" value="Ajouter">
            </form>
            </div>
            ';
        } ?>

        <div class="col-3 ">
            <table>
                <thead>
                        <tr><th colspan="5"> Joueurs inscrits a ce match :</th></tr>
                <tr>
                        <th>Nom</h>
                        <th>No Licence</th>
                        <th>Poste</th>
                        <th>Titulaire</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($inscrits as $joueurOccupe) {
                        echo "<tr><td>" . $joueurOccupe['NOM'] . "  " . $joueurOccupe['PRENOM'] . "</td><td>" . $joueurOccupe['NUMERODELICENCE'] . "</td><td>" . $joueurOccupe['POSTE'] . "</td><td>" . $joueurOccupe['TITULAIRE'];
                        echo "</td><td>" . "<a href='index.php?controleur=feuille&action=retirer&idmatch=" . $idmatch . "&idjoueur=" . $joueurOccupe['IDJOUEUR'] . "'> retirer du match </a>" . "</td></tr>";
                    }
                    ?>

                </tbody>
            </table>

        </div>
</body>

</html>