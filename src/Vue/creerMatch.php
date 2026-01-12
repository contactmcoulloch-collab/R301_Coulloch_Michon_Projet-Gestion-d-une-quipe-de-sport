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

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Création Match</title>
</head>
<body>

<h2>Créer le match</h2>

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
    <option value="Oui">Oui</option>
    <option value="Non">Non</option>
</select>
<br>

Victoire :
<select name="Victoire">
    <option value="Oui">Oui</option>
    <option value="Non">Non</option>
</select>
<br>

Résultat :
<input type="text" name="Resultat" value="<?php echo $resultat; ?>"><br>

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