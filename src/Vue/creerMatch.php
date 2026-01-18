<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/match_DAO.php';

/// AFFICHAGE DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $idMatch = '';
    $date = '';
    $heure = '';
    $equipeAdv = '';
    $lieu = '';
    $domicile = '';
    $victoire = '';
    $resultat = '';

$titre ="Planifier un match";
require __DIR__ . '/menu.php';

?>


<div class="panel">
<form action="index.php?controleur=match&action=creer" method="post">

IdMatch:
<input type="text" name="idMatch" value="<?php echo $idMatch; ?>"><br>

Date :
<input type="date" name="Date" value="<?php echo $date; ?>"><br>

Heure :
<input type="time" name="Heure" value="<?php echo $heure; ?>"><br>

Équipe Adverse :
<input type="text" name="EquipeAdv" value="<?php echo $equipeAdv; ?>"><br>

Lieu :
<input type="text" name="Lieu" value="<?php echo $lieu; ?>"><br>

Domicile :
<select name="Domicile">
    <option value="Oui" SELECTED>Oui</option>
    <option value="Non">Non</option>
</select>
<br>



<input type="hidden" name="Resultat" value=""><br>

<input type="submit" value="Créer">
</form>
</div>
</body>
</html>

<?php
} else {

    $idMatch = $_POST['idMatch'];
    $date = $_POST['Date'];
    $heure = $_POST['Heure'];
    $equipeAdv = $_POST['EquipeAdv'];
    $lieu = $_POST['Lieu'];
    $domicile = $_POST['Domicile'];
    $victoire = $_POST['Victoire'];
    $resultat = $_POST['Resultat'];

    // Call to the function to create match
    matchs_creer($pdo, $idMatch, $date, $heure, $equipeAdv, $lieu, $domicile, $victoire, $resultat);
    header('Location: index.php?controleur=match&action=');
}
?>