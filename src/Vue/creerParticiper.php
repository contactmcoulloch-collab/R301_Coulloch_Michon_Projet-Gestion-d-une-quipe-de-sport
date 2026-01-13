<?php

require __DIR__ . '/../DAO/connexion_DAO.php';
require __DIR__ . '/../DAO/joueur_DAO.php';
require __DIR__ . '/../DAO/participer_DAO.php';

$idmatch = $_GET['idmatch'];
$idjoueur = $_GET['idjoueur'];

/// AFFICHAGE DU FORMULAIRE
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $idparticiper = '';  // Initialize idparticiper
    $poste = '';
    $titulaire = '';
    $note = '';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Création joueur</title>
</head>
<body>

<h2>Créer le joueur</h2>

<div class="panel">
<form action="index.php?controleur=feuille&action=creer" method="post">

Id Participer:
<input type="text" name="idParticiper" value="<?php echo $idparticiper; ?>" required><br>

Poste :
<input type="text" name="Poste" value="<?php echo $poste; ?>" required><br>

Titulaire :
<select name="Titulaire" required>
    <option value="1">Oui</option>
    <option value="0">Non</option>
</select><br>

Note :
<input type="number" name="Note" value="<?php echo $note; ?>" step="0.1" min="0" max="10" required><br>

<input type="hidden" name="IdMatch" value="<?php echo $idmatch; ?>">
<input type="hidden" name="IdJoueur" value="<?php echo $idjoueur; ?>">

<input type="submit" value="Créer">
</form>
</div>
</body>
</html>

<?php
} else {
    $idjoueur = $_POST['IdJoueur'];
    $idmatch = $_POST['IdMatch'];

    $idparticiper = $_POST['idParticiper'];
    $poste = $_POST['Poste'];
    $titulaire = $_POST['Titulaire'];
    $note = $_POST['Note'];
    
    // Use the values directly from the POST data
    creer_participer($pdo, $idparticiper, $poste, $titulaire, $note, $idjoueur, $idmatch);

    header('Location: index.php?controleur=match&action=feuille&idmatch='. $idmatch);
}
?>
