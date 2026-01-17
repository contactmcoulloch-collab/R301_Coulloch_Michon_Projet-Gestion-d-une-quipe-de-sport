<!DOCTYPE html>
<html lang="fr">
<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';

$idjoueur_prepa = "";

if ($_GET['action']=='liste'){
    $idmatch = $_GET['idmatch'];
} if ($_GET['action']=='retirer'){
    $idmatch = $_GET['idmatch'];
    $idjoueur = $_GET['idjoueur'];
    retirer_joueurs($pdo,$idjoueur,$idmatch);
} else if ($_GET['action']=='preparer'){
    $idmatch = $_GET['idmatch'];
    $idjoueur = $_GET['idjoueur'];
    $idmatch_prepa = $_GET['idmatch'];
    $idjoueur_prepa = $_GET['idjoueur'];
    $joueur_prepa = lirejoueur($pdo, $idjoueur_prepa);
} else if ($_GET['action']=='ajouter'){
    $idmatch = $_POST['idmatch'];
    $idjoueur = $_POST['idjoueur'];
    $titulaire = $_POST['titulaire'];
    $poste = $_POST['poste'];
    ajouter_joueurs($pdo,$poste,$titulaire,0,$idjoueur,$idmatch);
}

$currentMatch = matchs_trouver($pdo, $idmatch);
?>
<head>
<meta charset="UTF-8">
<title>Feuille de match</title>
<style>
table, th, td {
  border:1px solid black;
}
</style>
</head>

<body>
    <?php

        $date      = $currentMatch['DATE'];
        $heure     = $currentMatch['HEURE'];
        $equipe    = $currentMatch['EQUIPEADV'];
        $lieu      = $currentMatch['LIEU'];
        $domicile  = $currentMatch['DOMICILE'];
        $victoire  = $currentMatch['VICTOIRE'];
        $resultat  = $currentMatch['RESULTAT'];

        echo"$date $heure $equipe $lieu $domicile $victoire $resultat";

        $inscrits = allParticipants($pdo, $idmatch);
        ?>
        <h4> Joueurs inscrits a ce match : </h4>
        <br>
        <table>
            <thead>
                <tr><th>Nom</h><th>Poids</th><th>Titulaire</th></tr>
    <?php
        foreach ($inscrits as $joueurOccupe) {
            echo "<tr><td>" . $joueurOccupe['NOM'] . "  " . $joueurOccupe['PRENOM'] . "</td><td>"  . $joueurOccupe['POIDS'] . "</td><td>"  . $joueurOccupe['POSTE'] . "</td><td>"  . $joueurOccupe['TITULAIRE'] . 
            "</td><td>" . "<a href='index.php?controleur=feuille&action=retirer&idmatch=".$idmatch."&idjoueur=".$joueurOccupe['IDJOUEUR']."'> retirer du match </a>" . "</td></tr>";
        }

        $disponibles = listerJoueursDispos($pdo);

        if ($idjoueur_prepa != "" ) {
            echo '
<form action="index.php?controleur=feuille&action=ajouter" method="post">

<input type="hidden" name="idjoueur" value="' . $idjoueur_prepa .'"><br>
<input type="hidden" name="idmatch" value="' . $idmatch_prepa . '">
Ajouter ' . $joueur_prepa["NOM"] . "  " . $joueur_prepa["PRENOM"] . '<br>
poids : ' . $joueur_prepa["POIDS"] . ' <br>
Taille : ' . $joueur_prepa["TAILLE"] . ' <br>
Titulaire :
<select name="titulaire">
<option value="Titulaire">Oui</option>   
<option value="Remplaçant">Non</option> 
</select>

Poste :
<select name="poste">
<option>Avant</option>   
<option>Centre</option>  
<option>Arriere</option> 
</select>
<br>



<input type="submit" value="Ajouter">
</form>
<br>
';
}

        echo "<h4> Joueurs libres : </h4> <br>";
        foreach ($disponibles as $joueurLibre) {
            echo "Nom: " . $joueurLibre['NOM'] . " - Prénom: " . $joueurLibre['PRENOM'] . "<a href='index.php?controleur=feuille&action=preparer&idmatch=".$idmatch."&idjoueur=".$joueurLibre['IDJOUEUR']."'> ajouter au match </a>" . "<br>";
        }
    ?>
</body>
</html>